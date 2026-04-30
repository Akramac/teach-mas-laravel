<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Exam;
use App\Models\ExamQuestLongTextJunction;
use App\Models\ExamQuestMultiChoiceJunction;
use App\Models\ExamQuestSpanJunction;
use App\Models\ExamQuestTartibJunction;
use App\Models\ExamQuestTawsilJunction;
use App\Models\HashUrlExam;
use App\Models\QuestionLongText;
use App\Models\QuestionMultiChoice;
use App\Models\QuestionSpan;
use App\Models\QuestionTartib;
use App\Models\QuestionTawsil;
use App\Models\Student;
use App\Models\StudentExamJunction;
use App\Models\StudentTeacherJunction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function showExam()
    {
        // Simulate fetching categories from a database or service
        $categoriesResult = Categorie::all();

        // Prepare data to be passed to the view
        $data['categories'] = $categoriesResult;

        // Return the view with the data
        return view('teacher.teacherExam', $data);
    }

    public function addExamData(Request $request){
                // Validate the incoming request
                $validator = Validator::make($request->all(), [
                    'title_exam' => 'required|string'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Get the authenticated user's ID
                $userId = Auth::id();

                // Get the teacher ID based on the authenticated user
                $teacher = Teacher::find($userId);

                $idTeacher = $teacher ? $teacher->id : null;

                // Retrieve input values
                $titleExam = $request->input('title_exam');
                $durationExam = $request->input('usr_time_exam');

                // Handle boolean inputs
                $allowScreenRecord = $request->has('record-screen') && $request->input('record-screen') === 'on';
                $allowCameraRecord = $request->has('record-camera') && $request->input('record-camera') === 'on';
                $randomQuestions = $request->has('check-random-questions') && $request->input('check-random-questions') === 'on';
                $noRemakeExam = $request->has('check-no-retake-exam') && $request->input('check-no-retake-exam') === 'on';

                // Save the exam data to the database
                $exam = Exam::create([
                    'teacher_id' => $idTeacher,
                    'title_exam' => $titleExam,
                    'duration_exam' => $durationExam,
                    'allow_screen_record' => $allowScreenRecord,
                    'allow_camera_record' => $allowCameraRecord,
                    'random_questions' => $randomQuestions,
                    'no_remake_exam' => $noRemakeExam,
                    'show_results' => true,
                    'categorie_id' => $request->input('select-category'),
                ]);

                if (!$exam) {
                    return redirect()->back()->with('error', 'Error Adding Exam')->withInput();
                }

                // Handle multiple choice questions
                $numQuestMulti = $request->input('count-quest-mutli');
                for ($i = 1; $i <= $numQuestMulti; $i++) {
                    if ($request->input('quest_mutliple-' . $i) == 'quest_mutliple') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-multi-" . $i);
                        $noSpecificTime = $request->has('no-specific-time-multi-' . $i) && $request->input('no-specific-time-multi-' . $i) == 'on';

                        $resultId = $this->addMultipleChoiceQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($resultId) {
                            $this->add_mutli_choice_junction($resultId, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding question Multi with choices')->withInput();
                        }
                    }
                }

                // Handle long text questions
                $numQuestLong = $request->input('count-quest-long-text');
                for ($i = 1; $i <= $numQuestLong; $i++) {
                    if ($request->input('quest_long_text-' . $i) == 'quest_long_text') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-long-" . $i);
                        $noSpecificTime = $request->has('no-specific-time-long-' . $i) && $request->input('no-specific-time-long-' . $i) == 'on';

                        $resultId = $this->addLongTextQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($resultId) {
                            $this->add_long_text_junction($resultId, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding Long Text question')->withInput();
                        }
                    }
                }


                $numQuestTartib = $request->input('count-quest-tartib');
                for ($i = 1; $i <= $numQuestTartib; $i++) {
                    if ($request->input('quest_tartib-' . $i) == 'quest_tartib') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-tartib-" . $i);

                        // No specific time for question
                        $noSpecificTime = $request->has('no-specific-time-tartib-' . $i) && $request->input('no-specific-time-tartib-' . $i) == 'on';

                        $resultId = $this->addTartibQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($resultId) {
                            $this->add_tartib_junction($resultId, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding Tartib question')->withInput();
                        }
                    }
                }

                $numQuestSpan = $request->input('count-quest-span');
                for ($i = 1; $i <= $numQuestSpan; $i++) {
                    if ($request->input('quest_span-' . $i) == 'quest_span') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-span-" . $i);

                        // No specific time for question
                        $noSpecificTime = $request->has('no-specific-time-span-' . $i) && $request->input('no-specific-time-span-' . $i) == 'on';

                        $resultId = $this->addSpanQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($resultId) {
                            $this->add_span_junction($resultId, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding Long Text question')->withInput();
                        }
                    }
                }

                $numQuestTawsil = $request->input('count-quest-tawsil');
                for ($i = 1; $i <= $numQuestTawsil; $i++) {
                    if ($request->input('quest_tawsil-' . $i) == 'quest_tawsil') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-tawsil-" . $i);

                        // No specific time for question
                        $noSpecificTime = $request->has('no-specific-time-tawsil-' . $i) && $request->input('no-specific-time-tawsil-' . $i) == 'on';

                        $resultId = $this->addTawsilQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($resultId) {
                            $this->add_tawsil_junction($resultId, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding Long Text question')->withInput();
                        }
                    }
                }

                // Generate URL for student to show their exam

                $hash= Str::random(10);
                $url = route('student/activate-exam', [$exam->id, $idTeacher, $hash]);
                session()->flash('showUrl', $url);
                session()->flash('success', 'Exam added successfully');

                // Save the hash URL
                $this->add_hash_url(null, $exam->id, $idTeacher, $hash);

                return redirect()->route('showExam');
            }


    public function editExamByTeacher($idExam='',$idTeacher=''){
        $data['title'] = 'Student Page By Teacher';

        // Get question multi or single choice
        $listQuestionsSingleChoice = QuestionMultiChoice::join('exam_question_multi_choice', 'exam_question_multi_choice.question_multi_choice_id', '=', 'question_multi_choice.id')
            ->join('exams', 'exams.id', '=', 'exam_question_multi_choice.exam_id')
            ->where('exams.id', $idExam)
            ->select('question_multi_choice.*')
            ->get();
        $data['listQuestionsSingleChoice'] = $listQuestionsSingleChoice;

        // Get question long text
        $listQuestionsLongText = QuestionLongText::join('exam_question_long_text', 'exam_question_long_text.question_long_text_id', '=', 'question_long_text.id')
            ->join('exams', 'exams.id', '=', 'exam_question_long_text.exam_id')
            ->where('exams.id', $idExam)
            ->select('question_long_text.*')
            ->get();
        $data['listQuestionsLongText'] = $listQuestionsLongText;

        // Get question tawsil
        $listQuestionsTawsil = QuestionTawsil::join('exam_question_tawsil', 'exam_question_tawsil.question_tawsil_id', '=', 'question_tawsil.id')
            ->join('exams', 'exams.id', '=', 'exam_question_tawsil.exam_id')
            ->where('exams.id', $idExam)
            ->select('question_tawsil.*')
            ->get();
        $data['listQuestionsTawsil'] = $listQuestionsTawsil;

        // Get question tartib
        $listQuestionsTartib = QuestionTartib::join('exam_question_tartib', 'exam_question_tartib.question_tartib_id', '=', 'question_tartib.id')
            ->join('exams', 'exams.id', '=', 'exam_question_tartib.exam_id')
            ->where('exams.id', $idExam)
            ->select('question_tartib.*')
            ->get();
        $data['listQuestionsTartib'] = $listQuestionsTartib;

        // Get question span
        $listQuestionsSpan = QuestionSpan::join('exam_question_span', 'exam_question_span.question_span_id', '=', 'question_span.id')
            ->join('exams', 'exams.id', '=', 'exam_question_span.exam_id')
            ->where('exams.id', $idExam)
            ->select('question_span.*')
            ->get();
        $data['listQuestionsSpan'] = $listQuestionsSpan;

        // Get exam details
        $durationExam = Exam::select('id', 'title_exam', 'categorie_id', 'duration_exam', 'allow_screen_record', 'allow_camera_record', 'random_questions', 'no_remake_exam')
            ->where('id', $idExam)
            ->first();

        $data['idExam'] = $idExam;
        $data['idTeacher'] = $idTeacher;

        if ($durationExam) {
            $data['durationExam'] = $durationExam->duration_exam;
            $data['title_exam'] = $durationExam->title_exam;
            $data['categorie_id'] = $durationExam->categorie_id;
            $data['id_exam'] = $durationExam->id;
            $data['allowScreenRecord'] = $durationExam->allow_screen_record;
            $data['allowCameraRecord'] = $durationExam->allow_camera_record;
            $data['randomQuestions'] = $durationExam->random_questions;
            $data['noRetakeExam'] = $durationExam->no_remake_exam;
        } else {
            $data['durationExam'] = '';
            $data['allowScreenRecord'] = '';
            $data['allowCameraRecord'] = '';
            $data['randomQuestions'] = '';
            $data['noRetakeExam'] = '';
        }

        // Get categories
        $categoriesResult = Categorie::all();
        $data['categories'] = $categoriesResult;

        // Load the view
        return view('teacher.teacherEditExam', $data);
    }

    public function studentListExamByTeacher($idTeacher = '')
    {

        $data['title'] = 'Student Page By Teacher';

        // Get list of exams by teacher
        $examsResult = Exam::where('teacher_id', $idTeacher)
            ->orderBy('created_at', 'desc')
            ->get();

        $data['exams_by_student'] = $examsResult;

        // Get number of students passed the exam by exam
        $arrayLinksByExam = [];
        foreach ($examsResult as $exam) {
            $id_Exam = $exam->id;
            $resultLinksByExam = HashUrlExam::where('teacher_id', $idTeacher)
                ->where('exam_id', $id_Exam)
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->limit(1)
                ->get();

            if ($resultLinksByExam->isNotEmpty()) {
                $arrayLinksByExam[$id_Exam] = $resultLinksByExam->first();
            }
        }
        $data['arrayLinksByExam'] = $arrayLinksByExam;

        return view('teacher.studentListExamByTeacher', $data);
    }

    public function administrateExamByTeacher($idExam = '')
    {

        $data['title'] = 'Student Page By Teacher';

        // Get the teacher's ID based on the authenticated user
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $idTeacher = $teacher ? $teacher->id : null;

        // Get all students (you may want to filter this based on the teacher)
        $studentResult = Student::all();
        $data['students_by_teacher'] = $studentResult;

        // Get all students who passed the exam
        $studentsPassedExamResult = Student::whereHas('studentExams', function ($query) use ($idExam) {
            $query->where('exam_id', $idExam);
        })->distinct()->get();

        $data['studentsPassedExamResult'] = $studentsPassedExamResult;

        // Get detailed information about students who passed the exam
        $studResult = Student::whereIn('id', $studentsPassedExamResult->pluck('id'))
            ->with('responseExams') // Assuming you have a relationship defined for responses
            ->get();

        $data['studentsPassedExamResult'] = $studResult;

        // Get the exam details
        $examResult = Exam::find($idExam);
        $data['exam'] = $examResult;

        return view('teacher.administrateExam', $data);
    }

    public function affectExamByTeacher($idExam = '')
    {   $data['title'] = 'Student Page By Teacher';

        // Get the authenticated teacher's ID
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $idTeacher = $teacher ? $teacher->id : null;

        // Get all students by the connected teacher
        $studentsByTeacher = Student::all(); // Adjust this if you want to filter by teacher
        $data['students_by_teacher'] = $studentsByTeacher;

        // Get all students who passed the exam
        $studentsPassedExamResult = Student::whereHas('studentExams', function ($query) use ($idExam) {
            $query->where('exam_id', $idExam);
        })->distinct()->get();

        $data['studentsPassedExamResult'] = $studentsPassedExamResult;

        // Get the exam details
        $exam = Exam::find($idExam);
        $data['exam'] = $exam ? $exam : [];

        return view('teacher.affectationExam', $data);
    }

    public function affectation(Request $request){
        $arrayStudents=$request->input('array_students');
        $idExam=$request->input('exam_id');
        $idTeacher=$request->input('id_teacher');


        foreach ($arrayStudents as $idStudent){
            $data['student_id']=$idStudent;
            $data['exam_id']=$idExam;
            $data['teacher_id']=$idTeacher;
            //check duplicate
            $isDuplicated = $this->isDuplicateAffectationStudentExam($data);
            if(!($isDuplicated)){
                //Insert data into Review Table
                $resultAffectation = $this->add_affectation_student_exam(
                    $idStudent,
                    $idExam
                );
            }
            $isDuplicated2 = $this->isDuplicateAffectationStudentTeacher($data);
            if(!($isDuplicated2)){
                //Insert data into Review Table
                $resultAffectation = $this->add_affectation_student_teacher(
                    $idStudent,
                    $idTeacher
                );
            }

        }
    }

            private function handleFileUpload(Request $request, $inputName)
            {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $fileName = time() . '_' . preg_replace("/\s+/", "", $file->getClientOriginalName());
                    $file->storeAs('uploads', $fileName, 'public'); // Store in public/uploads
                    return $fileName;
                }
                return null;
            }

            private function addMultipleChoiceQuestion(Request $request, $i, $fileName, $noSpecificTime)
            {
                $fileName = null;
                if ($request->hasFile("file-uploaded-multi-" . $i)) {
                    $file = $request->file("file-uploaded-multi-" . $i);
                    $rand = rand();
                    $fileName = $rand . preg_replace("/\s+/", "", $file->getClientOriginalName());

                    // Store the file in the public/uploads directory
                    $filePath = $file->storeAs('uploads', $fileName, 'public');

                    // Check if the file was uploaded successfully
                    if (!$filePath) {
                        return redirect()->back()->with('error', 'Error uploading image');
                    }
                }

                // No specific time for question
                $isNoSpecificTime = $request->input('no-specific-time-multi-' . $i);
                $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;

                $idQuestionMulti=$request->input('id-quest-multi-'.$i);
                if(!isset($idQuestionMulti) || $idQuestionMulti==''){
                // Prepare data for adding choices
                $result = $this->add_data_choices(
                    Auth::id(),
                    $request->input('title-question-multi-' . $i),
                    $request->input('usr_time-multi-' . $i),
                    $request->input('indeterminate-checkbox-single-' . $i),
                    $request->input('option-multi-1-' . $i),
                    $request->input('correct-option-multi-1-' . $i),
                    $request->input('option-multi-2-' . $i),
                    $request->input('correct-option-multi-2-' . $i),
                    $request->input('option-multi-3-' . $i),
                    $request->input('correct-option-multi-3-' . $i),
                    $request->input('option-multi-4-' . $i),
                    $request->input('correct-option-multi-4-' . $i),
                    $request->input('option-multi-5-' . $i),
                    $request->input('correct-option-multi-5-' . $i),
                    $request->input('option-multi-6-' . $i),
                    $request->input('correct-option-multi-6-' . $i),
                    $request->input('file-uploaded-multi-' . $i),
                    $request->input('points-multi-' . $i),
                    $fileName,
                    $request->input('data-file-uploaded-multi-' . $i),
                    $noSpecificTime
                );
                return $result;
                }else{
                    $result = $this->update_data_choices(
                        $idQuestionMulti,
                        Auth::id(),
                        $request->input('title-question-multi-' . $i),
                        $request->input('usr_time-multi-' . $i),
                        $request->input('indeterminate-checkbox-single-' . $i),
                        $request->input('option-multi-1-' . $i),
                        $request->input('correct-option-multi-1-' . $i),
                        $request->input('option-multi-2-' . $i),
                        $request->input('correct-option-multi-2-' . $i),
                        $request->input('option-multi-3-' . $i),
                        $request->input('correct-option-multi-3-' . $i),
                        $request->input('option-multi-4-' . $i),
                        $request->input('correct-option-multi-4-' . $i),
                        $request->input('option-multi-5-' . $i),
                        $request->input('correct-option-multi-5-' . $i),
                        $request->input('option-multi-6-' . $i),
                        $request->input('correct-option-multi-6-' . $i),
                        $request->input('file-uploaded-multi-' . $i),
                        $request->input('points-multi-' . $i),
                        $fileName,
                        $request->input('data-file-uploaded-multi-' . $i),
                        $noSpecificTime
                    );

                    if(isset($result) & $result!='' ) {
                        Session::put('success','Updated correctly!');
                    }else{
                        Session::put('error','Update error!');
                    }
                }
            }

            private function addLongTextQuestion(Request $request, $i, $fileName, $noSpecificTime)
            {
                // Initialize file name
                $fileName = null;

                // Check if the file is uploaded
                if ($request->hasFile("file-uploaded-long-" . $i)) {
                    $file = $request->file("file-uploaded-long-" . $i);
                    $rand = rand();
                    $fileName = $rand . preg_replace("/\s+/", "", $file->getClientOriginalName());

                    // Store the file in the public/uploads directory
                    $filePath = $file->storeAs('uploads', $fileName, 'public');

                    // Check if the file was uploaded successfully
                    if (!$filePath) {
                        return redirect()->back()->with('error', 'Error uploading image');
                    }
                }

                // No specific time for question
                $isNoSpecificTime = $request->input('no-specific-time-long-' . $i);
                $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;

                $idQuestionLong=$request->input('id-quest-long-'.$i);
                if(!isset($idQuestionLong) || $idQuestionLong==''){
                // Prepare data for adding long text question
                $result = $this->add_data_long_text(
                    Auth::id(),
                    $request->input('title-question-long-' . $i),
                    $request->input('correct-question-long-' . $i),
                    $request->input('usr_time-long-' . $i),
                    $request->input('file-uploaded-long-' . $i),
                    $request->input('points-long-' . $i),
                    $fileName,
                    $noSpecificTime);

                return $result;
                }else{
                    $result = $this->update_data_long_text(
                        $idQuestionLong,
                        $this->session->userdata('id'),
                        $this->input->post('title-question-long-'.$i),
                        $this->input->post('correct-question-long-'.$i),
                        $this->input->post('usr_time-long-'.$i),
                        $this->input->post('file-uploaded-long-'.$i),
                        $this->input->post('points-long-'.$i),
                        $fileName,
                        $noSpecificTime

                    );
                    if(isset($result) & $result!='' ) {
                        Session::put('success','Updated correctly!');
                    }else{
                        Session::put('error','Update error!');
                    }
                }
            }

            private function addTawsilQuestion(Request $request, $i, $fileName, $noSpecificTime)
            {
                // Initialize file name
                $fileName = null;

                // Check if the file is uploaded
                if ($request->hasFile("file-uploaded-tawsil-" . $i)) {
                    $file = $request->file("file-uploaded-tawsil-" . $i);
                    $rand = rand();
                    $fileName = $rand . preg_replace("/\s+/", "", $file->getClientOriginalName());

                    // Store the file in the public/uploads directory
                    $filePath = $file->storeAs('uploads', $fileName, 'public');

                    // Check if the file was uploaded successfully
                    if (!$filePath) {
                        return redirect()->back()->with('error', 'Error uploading image');
                    }
                }
                $idQuestionTawsil=$request->input('id-quest-tawsil-'.$i);
                // No specific time for question
                 $isNoSpecificTime = $request->input('no-specific-time-tawsil-' . $i);
                 $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;
                if(!isset($idQuestionTawsil) || $idQuestionTawsil=='') {
                    // Prepare data for adding long text question
                    $result = $this->add_data_tawsil(
                        Auth::id(),
                        $request->input('title-question-tawsil-' . $i),
                        $request->input('usr_time-tawsil-' . $i),
                        $request->input('option-tawsil-1-' . $i),
                        $request->input('link-option-tawsil-1-' . $i),
                        $request->input('option-tawsil-2-' . $i),
                        $request->input('link-option-tawsil-2-' . $i),
                        $request->input('option-tawsil-3-' . $i),
                        $request->input('link-option-tawsil-3-' . $i),
                        $request->input('option-tawsil-4-' . $i),
                        $request->input('ink-option-tawsil-4-' . $i),
                        $request->input('option-tawsil-5-' . $i),
                        $request->input('link-option-tawsil-5-' . $i),
                        $request->input('option-tawsil-6-' . $i),
                        $request->input('link-option-tawsil-6-' . $i),
                        $request->input('file-uploaded-tawsil-' . $i),
                        $request->input('points-tawsil-' . $i),
                        $fileName,
                        $noSpecificTime);

                    return $result;
                }else{
                    $result = $this->update_data_tawsil(
                        $idQuestionTawsil,
                        Auth::id(),
                        $request->input('title-question-tawsil-' . $i),
                        $request->input('usr_time-tawsil-' . $i),
                        $request->input('option-tawsil-1-' . $i),
                        $request->input('link-option-tawsil-1-' . $i),
                        $request->input('option-tawsil-2-' . $i),
                        $request->input('link-option-tawsil-2-' . $i),
                        $request->input('option-tawsil-3-' . $i),
                        $request->input('link-option-tawsil-3-' . $i),
                        $request->input('option-tawsil-4-' . $i),
                        $request->input('ink-option-tawsil-4-' . $i),
                        $request->input('option-tawsil-5-' . $i),
                        $request->input('link-option-tawsil-5-' . $i),
                        $request->input('option-tawsil-6-' . $i),
                        $request->input('link-option-tawsil-6-' . $i),
                        $request->input('file-uploaded-tawsil-' . $i),
                        $request->input('points-tawsil-' . $i),
                        $fileName,
                        $noSpecificTime

                    );
                    if(isset($result) & $result!='' ) {
                        Session::put('success','Updated correctly!');
                    }else{
                        Session::put('error','Update error!');
                    }
                }
            }

            private function addTartibQuestion(Request $request, $i, $fileName, $noSpecificTime)
            {
                // Initialize file name
                $fileName = null;

                // Check if the file is uploaded
                if ($request->hasFile("file-uploaded-tartib-" . $i)) {
                    $file = $request->file("file-uploaded-tartib-" . $i);
                    $rand = rand();
                    $fileName = $rand . preg_replace("/\s+/", "", $file->getClientOriginalName());

                    // Store the file in the public/uploads directory
                    $filePath = $file->storeAs('uploads', $fileName, 'public');

                    // Check if the file was uploaded successfully
                    if (!$filePath) {
                        return redirect()->back()->with('error', 'Error uploading image');
                    }
                }

                // No specific time for question
                $isNoSpecificTime = $request->input('no-specific-time-tartib-' . $i);
                $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;
                $idQuestionTartib=$request->input('id-quest-tartib-'.$i);
                if(!isset($idQuestionTartib) || $idQuestionTartib=='') {


                // Prepare data for adding long text question
                $result = $this->add_data_tartib(
                    Auth::id(),
                    $request->input('title-question-tartib-'.$i),
                    $request->input('usr_time-tartib-'.$i),
                    $request->input('option-to-order-1-'.$i),
                    $request->input('option-to-order-2-'.$i),
                    $request->input('option-to-order-3-'.$i),
                    $request->input('option-to-order-4-'.$i),
                    $request->input('option-to-order-5-'.$i),
                    $request->input('option-to-order-6-'.$i),
                    $request->input('file-uploaded-tartib-'.$i),
                    $request->input('points-tartib-'.$i),
                    $fileName,
                    $noSpecificTime);

                return $result;
                }else{
                    $result = $this->update_data_tartib(
                        $idQuestionTartib,
                        Auth::id(),
                        $request->input('title-question-tartib-'.$i),
                        $request->input('usr_time-tartib-'.$i),
                        $request->input('option-to-order-1-'.$i),
                        $request->input('option-to-order-2-'.$i),
                        $request->input('option-to-order-3-'.$i),
                        $request->input('option-to-order-4-'.$i),
                        $request->input('option-to-order-5-'.$i),
                        $request->input('option-to-order-6-'.$i),
                        $request->input('file-uploaded-tartib-'.$i),
                        $request->input('points-tartib-'.$i),
                        $fileName,
                        $noSpecificTime
                    );
                    if(isset($result) & $result!='' ) {
                        Session::put('success','Updated correctly!');
                    }else{
                        Session::put('error','Update error!');
                    }
                }
            }

            private function addSpanQuestion(Request $request, $i, $fileName, $noSpecificTime)
            {
                // Initialize file name
                $fileName = null;

                // Check if the file is uploaded
                if ($request->hasFile("file-uploaded-span-" . $i)) {
                    $file = $request->file("file-uploaded-span-" . $i);
                    $rand = rand();
                    $fileName = $rand . preg_replace("/\s+/", "", $file->getClientOriginalName());

                    // Store the file in the public/uploads directory
                    $filePath = $file->storeAs('uploads', $fileName, 'public');

                    // Check if the file was uploaded successfully
                    if (!$filePath) {
                        return redirect()->back()->with('error', 'Error uploading image');
                    }
                }

                $wordsConcat=$request->input('words-list-span-'.$i);
                $inputTextWithWords=preg_replace("/\s+/", "", $request->input('input-text-with-words-span-'.$i));

                // No specific time for question
                $isNoSpecificTime = $request->input('no-specific-time-span-' . $i);
                $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;
                $idQuestionSpan=$request->input('id-quest-span-'.$i);
                if(!isset($idQuestionSpan) || $idQuestionSpan=='') {
                    // Prepare data for adding long text question
                    $result = $this->add_data_span(
                        Auth::id(),
                        $request->input('title-question-span-'.$i),
                        $request->input('input-text-with-words-span-'.$i),
                        $wordsConcat,
                        $request->input('usr_time-span-'.$i),
                        $inputTextWithWords,
                        $request->input('points-span-'.$i),
                        $fileName,
                        $noSpecificTime);

                    return $result;
                }else{
                    $result = $this->update_data_span(
                        $idQuestionSpan,
                        Auth::id(),
                        $request->input('title-question-span-'.$i),
                        $request->input('input-text-with-words-span-'.$i),
                        $wordsConcat,
                        $request->input('usr_time-span-'.$i),
                        $inputTextWithWords,
                        $request->input('points-span-'.$i),
                        $fileName,
                        $noSpecificTime
                    );
                    if(isset($result) & $result!='' ) {
                        Session::put('success','Updated correctly!');
                    }else{
                        Session::put('error','Update error!');
                    }
                }
            }


            private function add_long_text_junction($questionId, $examId)
            {
                $data = [
                    'question_long_text_id' => $questionId,
                    'exam_id' => $examId,
                ];


                // Insert the data into the database
                $question = ExamQuestLongTextJunction::create($data);

                // Return the ID of the newly created question
                return $question->id;
            }

            private function add_tartib_junction($questionId, $examId)
            {
                $data = [
                    'question_tartib_id' => $questionId,
                    'exam_id' => $examId,
                ];


                // Insert the data into the database
                $question = ExamQuestTartibJunction::create($data);

                // Return the ID of the newly created question
                return $question->id;
            }

            private function add_span_junction($questionId, $examId)
            {
                $data = [
                    'question_span_id' => $questionId,
                    'exam_id' => $examId,
                ];


                // Insert the data into the database
                $question = ExamQuestSpanJunction::create($data);

                // Return the ID of the newly created question
                return $question->id;
            }

            private function add_mutli_choice_junction($questionId, $examId)
            {
                $data = [
                    'question_multi_choice_id' => $questionId,
                    'exam_id' => $examId,
                ];


                // Insert the data into the database
                $question = ExamQuestMultiChoiceJunction::create($data);

                // Return the ID of the newly created question
                return $question->id;
            }

            private function add_tawsil_junction($questionId, $examId)
            {
                $data = [
                    'question_tawsil_id' => $questionId,
                    'exam_id' => $examId,
                ];


                // Insert the data into the database
                $question = ExamQuestTawsilJunction::create($data);

                // Return the ID of the newly created question
                return $question->id;
            }

    function add_data_choices($userID, $title,$timepick,$CheckUnique,$option1,$correctOption1,$option2,$correctOption2,$option3,$correctOption3,$option4,$correctOption4,$option5,$correctOption5,$option6,$correctOption6,$fileUrl,$points,$image,$dataFile,$noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'is_single_choice' => ($CheckUnique === 'single') ? 1 : 0,
            'option_1' => $option1,
            'correct_option_1' => $correctOption1,
            'option_2' => $option2,
            'correct_option_2' => $correctOption2,
            'option_3' => $option3,
            'correct_option_3' => $correctOption3,
            'option_4' => $option4,
            'correct_option_4' => $correctOption4,
            'option_5' => $option5,
            'correct_option_5' => $correctOption5,
            'option_6' => $option6,
            'correct_option_6' => $correctOption6,
            'file_url' => $fileUrl,
            'points' => $points,
            'image' => $image,
            'data_file' => $dataFile,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image !== null) {
            $data['image'] = $image;
        }

        // Insert the data into the database
        $question = QuestionMultiChoice::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }
    function update_data_choices($idQuestionMulti,$userID, $title,$timepick,$CheckUnique,$option1,$correctOption1,$option2,$correctOption2,$option3,$correctOption3,$option4,$correctOption4,$option5,$correctOption5,$option6,$correctOption6,$fileUrl,$points,$image,$dataFile,$noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'is_single_choice' => ($CheckUnique === 'single') ? 1 : 0,
            'option_1' => $option1,
            'correct_option_1' => $correctOption1,
            'option_2' => $option2,
            'correct_option_2' => $correctOption2,
            'option_3' => $option3,
            'correct_option_3' => $correctOption3,
            'option_4' => $option4,
            'correct_option_4' => $correctOption4,
            'option_5' => $option5,
            'correct_option_5' => $correctOption5,
            'option_6' => $option6,
            'correct_option_6' => $correctOption6,
            'file_url' => $fileUrl,
            'points' => $points,
            'image' => $image,
            'data_file' => $dataFile,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image !== null) {
            $data['image'] = $image;
        }

        $questionMulti = QuestionMultiChoice::find($idQuestionMulti);
        $questionMulti->update($data);
        return $idQuestionMulti;
    }

    function add_data_long_text($userID, $title,$correct,$timepick,$fileUrl,$points,$image,$noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'correct_long_text' => $correct,
            'duration' => $timepick,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image !== null) {
            $data['image'] = $image;
        }

        $question = QuestionLongText::create($data);

        return $question->id;
    }
    function update_data_long_text($idQuestionLong,$userID, $title,$correct,$timepick,$fileUrl,$points,$image,$noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'correct_long_text' => $correct,
            'duration' => $timepick,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image !== null) {
            $data['image'] = $image;
        }

        $questionLongText = QuestionLongText::find($idQuestionLong);
        $questionLongText->update($data);
        return $idQuestionLong;
    }

    public function add_data_tawsil($userID, $title, $timepick, $option1, $linkOption1, $option2, $linkOption2, $option3, $linkOption3, $option4, $linkOption4, $option5, $linkOption5, $option6, $linkOption6, $fileUrl, $points, $image, $noSpecificTime)
    {
        // Prepare the data array
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'option_1' => $option1,
            'link_option_1' => $linkOption1,
            'option_2' => $option2,
            'link_option_2' => $linkOption2,
            'option_3' => $option3,
            'link_option_3' => $linkOption3,
            'option_4' => $option4,
            'link_option_4' => $linkOption4,
            'option_5' => $option5,
            'link_option_5' => $linkOption5,
            'option_6' => $option6,
            'link_option_6' => $linkOption6,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        // Add image to the data array if it is not null
        if ($image !== null) {
            $data['image'] = $image;
        }

        // Insert the data into the database
        $question = QuestionTawsil::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }
    public function update_data_tawsil($idQuestionTawsil,$userID, $title, $timepick, $option1, $linkOption1, $option2, $linkOption2, $option3, $linkOption3, $option4, $linkOption4, $option5, $linkOption5, $option6, $linkOption6, $fileUrl, $points, $image, $noSpecificTime)
    {
        // Prepare the data array
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'option_1' => $option1,
            'link_option_1' => $linkOption1,
            'option_2' => $option2,
            'link_option_2' => $linkOption2,
            'option_3' => $option3,
            'link_option_3' => $linkOption3,
            'option_4' => $option4,
            'link_option_4' => $linkOption4,
            'option_5' => $option5,
            'link_option_5' => $linkOption5,
            'option_6' => $option6,
            'link_option_6' => $linkOption6,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        // Add image to the data array if it is not null
        if ($image !== null) {
            $data['image'] = $image;
        }

        $questionTawsil = QuestionTawsil::find($idQuestionTawsil);
        $questionTawsil->update($data);
        return $idQuestionTawsil;
    }

    function add_data_tartib($userID, $title, $timepick, $option1, $option2, $option3, $option4, $option5, $option6, $fileUrl, $points, $image, $noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'option_to_order_1' => $option1,
            'option_to_order_2' => $option2,
            'option_to_order_3' => $option3,
            'option_to_order_4' => $option4,
            'option_to_order_5' => $option5,
            'option_to_order_6' => $option6,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image != null) {
            $data['image'] = $image;
        }

        // Insert the data into the question_tartib table
        $questionTartib = QuestionTartib::create($data);

        // Return the ID of the newly created record
        return $questionTartib->id;
    }

    function update_data_tartib($idQuestionTartib,$userID, $title, $timepick, $option1, $option2, $option3, $option4, $option5, $option6, $fileUrl, $points, $image, $noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'duration' => $timepick,
            'option_to_order_1' => $option1,
            'option_to_order_2' => $option2,
            'option_to_order_3' => $option3,
            'option_to_order_4' => $option4,
            'option_to_order_5' => $option5,
            'option_to_order_6' => $option6,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image != null) {
            $data['image'] = $image;
        }

        $questionTartib = QuestionTartib::find($idQuestionTartib);
        $questionTartib->update($data);
        return $idQuestionTartib;
    }

    function add_data_span($userID, $title, $textSpan, $words, $timepick, $fileUrl, $points, $image, $noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'span_text' => $textSpan,
            'words' => $words,
            'duration' => $timepick,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image != null) {
            $data['image'] = $image;
        }

        // Insert the data into the question_span table
        $questionSpan = QuestionSpan::create($data);

        // Return the ID of the newly created record
        return $questionSpan->id;
    }
    function update_data_span($idQuestionSpan,$userID, $title, $textSpan, $words, $timepick, $fileUrl, $points, $image, $noSpecificTime)
    {
        $data = [
            'user_id' => $userID,
            'title' => $title,
            'span_text' => $textSpan,
            'words' => $words,
            'duration' => $timepick,
            'file_url' => $fileUrl,
            'points' => $points,
            'no_specific_time' => $noSpecificTime,
        ];

        if ($image != null) {
            $data['image'] = $image;
        }

        $questionSpan = QuestionSpan::find($idQuestionSpan);
        $questionSpan->update($data);
        return $idQuestionSpan;
    }
    function add_hash_url($idStudent,$idExam,$idTeacher,$hash)
    {
        $dataHash['student_id']=$idStudent;
        $dataHash['exam_id']=$idExam;
        $dataHash['teacher_id']=$idTeacher;
        $dataHash['hash']=$hash;
        $hashUrl = HashUrlExam::create($dataHash);

        return $hashUrl->id;
    }

    private function add_affectation_student_exam($idStudent,$idExam)
    {
        $data = [
            'student_id' => $idStudent,
            'exam_id' => $idExam,
        ];


        // Insert the data into the database
        $result = StudentExamJunction::create($data);

        return $result->id;
    }

    private function add_affectation_student_teacher($idStudent,$idTeacher)
    {
        $data = [
            'student_id' => $idStudent,
            'teacher_id' => $idTeacher,
        ];


        // Insert the data into the database
        $result = StudentTeacherJunction::create($data);

        return $result->id;
    }

    public function isDuplicateAffectationStudentExam($data)
    {
        $results = StudentExamJunction::where([
            ['student_id', '=', $data['student_id']],
            ['exam_id', '=', $data['exam_id']],
        ])->get();

        //If there are rows, means this review is duplicated
        if($results->isNotEmpty()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function isDuplicateAffectationStudentTeacher($data)
    {
        $results = StudentTeacherJunction::where([
            ['student_id', '=', $data['student_id']],
            ['teacher_id', '=', $data['teacher_id']],
        ])->get();

        //If there are rows, means this review is duplicated
        if($results->isNotEmpty()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
