<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Edit Profile';

        // Return the view with the data
        return view('security.editProfile', $data);
    }
}
