<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Exam; // Assuming you have an Exam model
use App\Models\QuestionMultiChoice;
use App\Models\QuestionLongText;
use App\Models\QuestionTawsil;
use App\Models\QuestionTartib;
use App\Models\QuestionSpan;

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
}
