<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\HashUrlExam;
use App\Models\Student;
use App\Models\StudentExamJunction;
use App\Models\StudentTeacherJunction;
use Illuminate\Http\Request;
use App\Models\Exam; // Assuming you have an Exam model
use App\Models\QuestionMultiChoice;
use App\Models\QuestionLongText;
use App\Models\QuestionTawsil;
use App\Models\QuestionTartib;
use App\Models\QuestionSpan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $exam=Exam::select('teacher_id')->where('id',$idExam)->first();
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

        // Insert the data into the student_exam_junction table
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

        // Insert the data into the student_exam_junction table
        StudentTeacherJunction::create($dataJunction);

        return $idTeacher;
    }
}
