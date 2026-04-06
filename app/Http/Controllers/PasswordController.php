<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        $data['title'] = 'Change Password';

        // Return the view with the data
        return view('security.changePassword', $data);
    }
}
