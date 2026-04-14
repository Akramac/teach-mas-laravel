<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Edit Profile';

        // Return the view with the data
        return view('security.editProfile', $data);
    }
    public function editProfileData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'image' => 'nullable|image|max:2048', // Optional image validation
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return redirect()->back()->withInput()->with('error','Problem modifing Profile: '.$errorMessage);
        }
        $user=Auth::user();
        $session_id = $request->input('id');

        // Handle file upload if an image is provided
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            $uploadPath = 'uploads/';

            // Store the file
            $filePath=$file->storeAs($uploadPath,$fileName,'public');

            // Update the user's image in the database

            if($user){
                $user->image=$fileName;
                $user->save();
                Session::put('image',$fileName);
            }else{
                return redirect()->back()->withInput()->with('success','Profile modified succesfully! ');
            }
        }
            // Update email and username
            $email = $request->input('email');
            $userName = $request->input('name');

            if ($user) {
                $user->email = $email;
                $user->name = $userName;
                $user->save();
            }

            return redirect()->back()->withInput()->with('success','Profile modified succesfully! ');

    }

}
