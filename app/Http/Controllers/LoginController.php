<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        // Return the view with the data
        return view('security.login', $data);
    }
}
