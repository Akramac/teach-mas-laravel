<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

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
}
