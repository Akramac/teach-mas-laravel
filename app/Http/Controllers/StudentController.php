<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\HashUrlExam;
use App\Models\ResponseExam;
use App\Models\ResponseQuestionLongText;
use App\Models\ResponseQuestionMultiChoice;
use App\Models\ResponseQuestionSpan;
use App\Models\ResponseQuestionTartib;
use App\Models\ResponseQuestionTawsil;
use App\Models\Student;
use App\Models\StudentExamJunction;
use App\Models\StudentTeacherJunction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Exam; // Assuming you have an Exam model
use App\Models\QuestionMultiChoice;
use App\Models\QuestionLongText;
use App\Models\QuestionTawsil;
use App\Models\QuestionTartib;
use App\Models\QuestionSpan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function studentExam($idExam='')
    {
        // Simulate fetching categories from a database or service
        $categoriesResult = Categorie::all();

        // Prepare data to be passed to the view
        $data['categories'] = $categoriesResult;
        $data['title'] = 'Student Page';

        $listQuestionsSingleChoice = QuestionMultiChoice::select()
            ->join('exam_question_multi_choice','exam_question_multi_choice.question_multi_choice_id','=','question_multi_choice.id')
            ->join('exams','exams.id','=','exam_question_multi_choice.exam_id')
            ->where('exams.id', $idExam)
            ->get();

        $data['listQuestionsSingleChoice'] = $listQuestionsSingleChoice;

        // Get question long text
        $listQuestionsLongText = QuestionLongText::select()
            ->join('exam_question_long_text', 'exam_question_long_text.question_long_text_id', '=', 'question_long_text.id')
            ->join('exams', 'exams.id', '=', 'exam_question_long_text.exam_id')
            ->where('exams.id', $idExam)
            ->get();
        $data['listQuestionsLongText'] = $listQuestionsLongText;

        // Get question tawsil
        $listQuestionsTawsil = QuestionTawsil::select()
            ->join('exam_question_tawsil', 'exam_question_tawsil.question_tawsil_id', '=', 'question_tawsil.id')
            ->join('exams', 'exams.id', '=', 'exam_question_tawsil.exam_id')
            ->where('exams.id', $idExam)
            ->get();
        $data['listQuestionsTawsil'] = $listQuestionsTawsil;

        // Get question tartib
        $listQuestionsTartib = QuestionTartib::select()
            ->join('exam_question_tartib', 'exam_question_tartib.question_tartib_id', '=', 'question_tartib.id')
            ->join('exams', 'exams.id', '=', 'exam_question_tartib.exam_id')
            ->where('exams.id', $idExam)
            ->get();
        $data['listQuestionsTartib'] = $listQuestionsTartib;

        // Get question span
        $listQuestionsSpan = QuestionSpan::select()
            ->join('exam_question_span', 'exam_question_span.question_span_id', '=', 'question_span.id')
            ->join('exams', 'exams.id', '=', 'exam_question_span.exam_id')
            ->where('exams.id', $idExam)
            ->get();
        $data['listQuestionsSpan'] = $listQuestionsSpan;

        //get teacher id
        $exam=Exam::select('teacher_id','id')->where('id',$idExam)->first();
        $data['idExam'] = $exam ? $exam->id : '';
        $data['idTeacher'] = $exam ? $exam->teacher_id : '';

        // Get exam duration and settings
        $durationExam =Exam::select('duration_exam', 'allow_screen_record', 'allow_camera_record', 'random_questions')
                            ->where('id',$idExam)
                            ->first();

        $data['durationExam'] = $durationExam ? $durationExam->duration_exam : '';
        $data['allowScreenRecord'] = $durationExam ? $durationExam->allow_screen_record : '';
        $data['allowCameraRecord'] = $durationExam ? $durationExam->allow_camera_record : '';
        $data['randomQuestions'] = $durationExam ? $durationExam->random_questions : '';

        // Return the view with the data
        return view('student.studentExam', $data);
    }

    public function activateExamUrl($idExam='',$idTeacher='',$hash='')
    {
        $idUser = Auth::id(); // Get the user ID from the session

        // Retrieve the student ID based on the user ID
        $student = Student::find($idUser);

        $idStudent = $student ? $student->id : null;

        $data = [
            'student_id' => $idStudent,
            'exam_id' => $idExam,
            'id_teacher' => $idTeacher,
        ];

        // Check hash URL
        $dataHash = [
            'hash' => $hash,
            'student_id' => $idStudent,
            'exam_id' => $idExam,
            'id_teacher' => $idTeacher,
        ];

        $isAllowed = $this->isAllowed($dataHash);
        if ($isAllowed) {
            $hashResult = HashUrlExam::where('teacher_id', $idTeacher)
                ->where('exam_id', $idExam)
                ->where('hash', $hash)
                ->first();

            if ($hashResult) {
                $idHash = $hashResult->id;
                $concatStudents = $hashResult->student_id;

                // Update student IDs
                $dataHaash = [
                    'student_id' => $concatStudents ? $concatStudents . ';' . $idStudent : $idStudent,
                    'used_once_by_student' => true,
                ];

                $hashResult->update($dataHaash);
                Session::flash('success', 'Exam added to your list!');
            }
        } else {
            Session::flash('error', 'You are not allowed!');
            return redirect()->route('showExam');
        }

        // Check for duplicate affectation
        $isDuplicated = $this->isDuplicateAffectationStudentExam($data);
        if (!$isDuplicated) {
            // Insert data into Review Table
            $this->add_affectation_student_exam($idStudent, $idExam);
        } else {
            Session::flash('error', 'Exam already affected!');
            return redirect()->route('showExam');
        }

        $isDuplicated2 = $this->isDuplicateAffectationStudentTeacher($data);
        if (!$isDuplicated2) {
            // Insert data into Review Table
            $this->add_affectation_student_teacher($idStudent, $idTeacher);
        }

        Session::flash('success', 'Exam affected successfully!');
        return redirect()->route('showExam');
    }

    public function studentListExam($idTeacher = '')
    {
        // Set the language (if using localization)
        Session::put('site_lang', 'english');

        $data['title'] = 'Student Page';

        // List of categories
        $data['allCategories'] = Categorie::limit(6)->get();

        // Get the authenticated student's ID
        $student = Student::where('user_id', Auth::id())->first();
        $idStudent = $student ? $student->id : null;
        $data['idStudent'] = $idStudent;

        // Get the teacher IDs associated with the student
        $arrayTeachers = [];
        if ($idStudent) {
            $teacherStudentResult = DB::table('student_teacher')
                ->where('student_id', $idStudent)
                ->pluck('teacher_id');

            $arrayTeachers = $teacherStudentResult->toArray();
        }

        // Get the list of teachers for the student
        if (!empty($arrayTeachers)) {
            $data['listTeachers'] = Teacher::whereIn('id', $arrayTeachers)
                ->distinct()
                ->get(['name', 'id']);
        } else {
            $data['listTeachers'] = [];
        }

        // List of response exams by student
        $data['listreponsesExam'] = ResponseExam::where('student_id', $idStudent)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

        // Get exams based on the teacher filter
        if ($idTeacher != '' && $idTeacher != 'all') {
            $data['listExams'] = Exam::join('student_exam', 'student_exam.exam_id', '=', 'exams.id')
                ->where('student_exam.student_id', $idStudent)
                ->where('teacher_id', $idTeacher)
                ->orderBy('exams.created_at', 'desc')
                ->get();
        } elseif ($idTeacher == 'all' || $idTeacher == '') {
            if (!empty($arrayTeachers)) {
                $data['listExams'] = Exam::join('student_exam', 'student_exam.exam_id', '=', 'exams.id')
                    ->where('student_exam.student_id', $idStudent)
                    ->whereIn('exams.teacher_id', $arrayTeachers)
                    ->orderBy('exams.created_at', 'desc')
                    ->get();
            } else {
                $data['listExams'] = [];
            }
        }

        return view('student.studentListExam', $data);
    }

    public function studentAddExamToDB(Request $request)
    {
        // Set the language (if using localization)
        Session::put('site_lang', 'english');
        // Load language files if necessary (Laravel handles localization differently)

        $data['title'] = 'Student Page';

        $idUser = Auth::id();
        // Get the student ID
        $student = Student::where('user_id', $idUser)->first();
        $idStudent = $student ? $student->id : null;

        // Validate the request
        $validator = Validator::make($request->all(), [
            'idExam' => 'required',
            'idTeacher' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->all() as $key => $value) {
            $numbers = range(0, 9);
            $result = str_replace($numbers, "", $key);

            // Get the teacher ID
            $exam = Exam::find($request->input('idExam'));
            $idTeacher = $exam ? $exam->teacher_id : null;

            switch ($result) {
                case 'select-options-cards-':
                    $pieces = explode("-", $key);
                    $idQuest = $pieces[3];
                    if (!is_array($request->input($key))) {
                        $response = $request->input($key);
                        $this->insert_options_choices(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            $response,
                            $response,
                            $response,
                            $response,
                            $response,
                            $response
                        );
                    } else {
                        $responses = $request->input($key);
                        $this->insert_options_choices(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            ...array_pad($responses, 6, null) // Pad the array to ensure 6 responses
                        );
                    }
                    break;

                case 'long-text-':
                    $pieces = explode("-", $key);
                    $idQuest = $pieces[2];

                    $questLongText = DB::table('question_long_text')->where('id', $idQuest)->first();
                    if ($questLongText) {
                        $this->insert_long_text(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            $questLongText->correct_long_text,
                            $request->input($key)
                        );
                    }
                    break;

                case 'tawsil-input-':
                    $pieces = explode("-", $key);
                    $idQuest = $pieces[2];

                    $questTawsil = DB::table('question_tawsil')->where('id', $idQuest)->first();
                    if ($questTawsil) {
                        $pieces = explode(";", $request->input($key));
                        $this->insert_tawsil(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            $questTawsil->option_1,
                            $pieces[1] ?? null,
                            $questTawsil->option_2,
                            $pieces[2] ?? null,
                            $questTawsil->option_3,
                            $pieces[3] ?? null,
                            $questTawsil->option_4,
                            $pieces[4] ?? null,
                            $questTawsil->option_5,
                            $pieces[5] ?? null,
                            $questTawsil->option_6,
                            $pieces[6] ?? null
                        );
                    }
                    break;

                case 'tartib-input-':
                    $pieces = explode("-", $key);
                    $idQuest = $pieces[2];

                    $questTartib = DB::table('question_tartib')->where('id', $idQuest)->first();
                    if ($questTartib) {
                        $pieces = explode(";", $request->input($key));
                        $this->insert_tartib(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            $questTartib->option_to_order_1,
                            $pieces[1] ?? null,
                            $questTartib->option_to_order_2,
                            $pieces[2] ?? null,
                            $questTartib->option_to_order_3,
                            $pieces[3] ?? null,
                            $questTartib->option_to_order_4,
                            $pieces[4] ?? null,
                            $questTartib->option_to_order_5,
                            $pieces[5] ?? null,
                            $questTartib->option_to_order_6,
                            $pieces[6] ?? null
                        );
                    }
                    break;

                case 'input-text-with-words-span-':
                    $pieces = explode("-", $key);
                    $idQuest = $pieces[5];

                    $questSpan = DB::table('question_span')->where('id', $idQuest)->first();
                    if ($questSpan) {
                        $this->insert_span(
                            Auth::id(),
                            $idTeacher,
                            $idStudent,
                            $idQuest,
                            $request->input('idExam'),
                            $questSpan->span_text,
                            $request->input($key)
                        );
                    }
                    break;
            }
        }

        // Mark exam as passed
        $this->mark_exam_as_passed(
            $idTeacher,
            $idStudent,
            $request->input('idExam'),
            $request->input('screen-url-input'),
            $request->input('video-url-input')
        );

        Session::flash('success', 'You have registered your exam successfully!');
        //return redirect()->route('studentExam');
    }

    public function isAllowed($data)
    {
        // Check if a record exists with the given exam_id, teacher_id, and hash
        $exists = HashUrlExam::where('exam_id', $data['exam_id'])
            ->where('teacher_id', $data['id_teacher'])
            ->where('hash', $data['hash'])
            ->exists();

        return $exists; // Returns true if a record exists, false otherwise
    }
    public function isDuplicateAffectationStudentExam($data)
    {
        // Check if a record exists with the given student_id and exam_id
        $exists = StudentExamJunction::where('student_id', $data['student_id'])
            ->where('exam_id', $data['exam_id'])
            ->exists();

        return $exists; // Returns true if a record exists, false otherwise
    }
    function add_affectation_student_exam($idStudent,$idExam)
    {   $dataJunction = [
            'student_id' => $idStudent,
            'exam_id' => $idExam,
        ];

        // Insert the data into the student_exam table
        StudentExamJunction::create($dataJunction);

        return $idExam;
    }
    public function isDuplicateAffectationStudentTeacher($data)
    {
        $exists = StudentTeacherJunction::where('student_id', $data['student_id'])
            ->where('teacher_id', $data['id_teacher'])
            ->exists();

        return $exists; // Returns true if a record exists, false otherwise
    }
    function add_affectation_student_teacher($idStudent,$idTeacher)
    {   $dataJunction = [
        'student_id' => $idStudent,
        'teacher_id' => $idTeacher,
        ];

        // Insert the data into the student_exam table
        StudentTeacherJunction::create($dataJunction);

        return $idTeacher;
    }

    function insert_options_choices($userID,$teacherID,$studentID, $questID,$examID,$responseOption1,$responseOption2,$responseOption3,$responseOption4,$responseOption5,$responseOption6)
    {

        $data['user_id']=$userID;
        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['question_multi_id']=$questID;
        $data['exam_id']=$examID;
        $data['response_option_1']=$responseOption1;
        $data['response_option_2']=$responseOption2;
        $data['response_option_3']=$responseOption3;
        $data['response_option_4']=$responseOption4;
        $data['response_option_5']=$responseOption5;
        $data['response_option_6']=$responseOption6;

        // Insert the data into the database
        $question = ResponseQuestionMultiChoice::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }
    function insert_long_text($userID,$teacherID,$studentID, $questID,$examID,$correctText,$responseText)
    {

        $data['user_id']=$userID;
        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['question_long_id']=$questID;
        $data['exam_id']=$examID;
        $data['reponse_long_text']=$responseText;
        $data['correct_long_text']=$correctText;

        // Insert the data into the database
        $question = ResponseQuestionLongText::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }

    function insert_tawsil($userID,$teacherID,$studentID, $questID,$examID,$option1,$responseOption1,$option2,$responseOption2,$option3,$responseOption3,$option4,$responseOption4,$option5,$responseOption5,$option6,$responseOption6)
    {

        $data['user_id']=$userID;
        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['question_tawsil_id']=$questID;
        $data['exam_id']=$examID;
        $data['response_option_1']=$responseOption1;
        $data['correct_option_1']=$option1;
        $data['response_option_2']=$responseOption2;
        $data['correct_option_2']=$option2;
        $data['response_option_3']=$responseOption3;
        $data['correct_option_3']=$option3;
        $data['response_option_4']=$responseOption4;
        $data['correct_option_4']=$option4;
        $data['response_option_5']=$responseOption5;
        $data['correct_option_5']=$option5;
        $data['response_option_6']=$responseOption6;
        $data['correct_option_6']=$option6;

        // Insert the data into the database
        $question = ResponseQuestionTawsil::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }
    function insert_tartib($userID,$teacherID,$studentID, $questID,$examID,$option1,$responseOption1,$option2,$responseOption2,$option3,$responseOption3,$option4,$responseOption4,$option5,$responseOption5,$option6,$responseOption6)
    {

        $data['user_id']=$userID;
        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['question_tartib_id']=$questID;
        $data['exam_id']=$examID;
        $data['reponse_option_to_order_1']=$responseOption1;
        $data['correct_order_1']=$option1;
        $data['reponse_option_to_order_2']=$responseOption2;
        $data['correct_order_2']=$option2;
        $data['reponse_option_to_order_3']=$responseOption3;
        $data['correct_order_3']=$option3;
        $data['reponse_option_to_order_4']=$responseOption4;
        $data['correct_order_4']=$option4;
        $data['reponse_option_to_order_5']=$responseOption5;
        $data['correct_order_5']=$option5;
        $data['reponse_option_to_order_6']=$responseOption6;
        $data['correct_order_6']=$option6;

        // Insert the data into the database
        $question = ResponseQuestionTartib::create($data);

        // Return the ID of the newly created question
        return $question->id;
    }
    function insert_span($userID,$teacherID,$studentID, $questID,$examID,$correctText,$responseText)
    {

        $data['user_id']=$userID;
        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['question_span_id']=$questID;
        $data['exam_id']=$examID;
        $data['reponse_span']=$responseText;
        $data['correct_span']=$correctText;

        // Insert the data into the database
        $question = ResponseQuestionSpan::create($data);

        // Return the ID of the newly created question
        return $question->id;

    }
    function mark_exam_as_passed($teacherID,$studentID,$examID,$fileScreen,$fileVideo)
    {

        $data['teacher_id']=$teacherID;
        $data['student_id']=$studentID;
        $data['exam_id']=$examID;
        $data['file_screen']=$fileScreen;
        $data['file_video']=$fileVideo;

        // Insert the data into the database
        $question = ResponseExam::create($data);

        // Return the ID of the newly created question
        return $question->id;

    }
}
