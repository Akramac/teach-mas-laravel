<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class PasswordController extends Controller
{
    public function changePassword()
    {
        $data['title'] = 'Change Password';

        // Return the view with the data
        return view('security.changePassword', $data);
    }

    public function changePasswordData(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:4'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Get the first validation error message
            $errorMessage = $validator->errors()->first();

            // Redirect back with input and the specific error message
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        if(!Hash::check($request->current_password,Auth::user()->getAuthPassword())){
            return redirect()->back()->withInput()->with('error', 'Current password is incorrect.');
        }

        $user = Auth::user();
        $user->password= Hash::make($request->new_password);
        $user->save();

        // Return the view with the data
        return redirect()->route('showExam')->with('success','Password changed!');
    }
}
