<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Register';

        // Return the view with the data
        return view('security.register', $data);
    }
}
