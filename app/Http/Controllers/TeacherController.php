<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Exam;
use App\Models\ExamQuestLongTextJunction;
use App\Models\ExamQuestMultiChoiceJunction;
use App\Models\ExamQuestTawsilJunction;
use App\Models\QuestionLongText;
use App\Models\QuestionMultiChoice;
use App\Models\QuestionTawsil;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
                $teacher = Teacher::select()->where('user', function ($query) use ($userId) {
                    $query->where('id', $userId);
                })->first();

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
                    'category_id' => $request->input('select-category'),
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
                            return redirect()->back()->with('error', 'Error Adding question with choices')->withInput();
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

                $numQuestTawsil = $request->input('count-quest-tawsil');
                for ($i = 1; $i <= $numQuestTawsil; $i++) {
                    if ($request->input('quest_tawsil-' . $i) == 'quest_tawsil') {
                        $fileName = $this->handleFileUpload($request, "file-uploaded-long-" . $i);

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
                $hash = rand();
                $url = route('student.activate-exam', [$exam->id, $idTeacher, $hash]);
                session()->flash('showUrl', $url);
                session()->flash('success', 'Exam added successfully');

                // Save the hash URL
                $this->examModel->add_hash_url(null, $exam->id, $idTeacher, $hash);

                return redirect()->route('index'); // Adjust the route as necessary
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

                // Prepare data for adding choices
                $result = $this->add_data_choices(
                    Auth::id(), // Assuming you are using Laravel's Auth to get the user ID
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

                // No specific time for question
                $isNoSpecificTime = $request->input('no-specific-time-tawsil-' . $i);
                $noSpecificTime = $isNoSpecificTime === 'on' ? true : null;

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
}
