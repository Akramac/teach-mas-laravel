<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Register';

        // Return the view with the data
        return view('security.register', $data);
    }

    public function register(Request $request)
    {
        $validator  = $this->validator($request->all());
        $userType=$request->input('user_type');
        $userLevel='';
        if ($userType === 'teacher') {
            $userLevel = 'ROLE_TEACHER';
        } elseif ($userType === 'student') {
            $userLevel = 'ROLE_STUDENT';
        } elseif ($userType === 'admin') {
            $userLevel = 'ROLE_ADMIN';
        }
        $verification_key = Str::random(20);

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return redirect()->back()->withInput()->with('error','Problem registrating: '.$errorMessage);
        }
        try {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'user_level'=>$userLevel,
                'verification_key'=>$verification_key,
                'password'=>Hash::make($request->password),
            ]);

            // Return the view with the data
            return redirect()->route('login')->with('success','Registration successful!');

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error','Problem registrating'.$e->getMessage());
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required', 'string'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }


}
