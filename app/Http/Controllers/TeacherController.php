<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Exam;
use App\Models\QuestionMultiChoice;
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

                        $result = $this->addMultipleChoiceQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($result) {
                            $this->addQuestionJunction($result, $exam->id);
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

                        $result = $this->addLongTextQuestion($request, $i, $fileName, $noSpecificTime);
                        if ($result) {
                            $this->addQuestionJunction($result, $exam->id);
                        } else {
                            return redirect()->back()->with('error', 'Error Adding Long Text question')->withInput();
                        }
                    }
                }

                // Handle other question types similarly...

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

            }

            private function addLongTextQuestion(Request $request, $index, $fileName, $noSpecificTime)
            {
                // Implement the logic to add a long text question
                // Return the result or ID of the created question
            }

            private function addQuestionJunction($questionId, $examId)
            {
                // Implement the logic to create a junction between the question and the exam
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
}
