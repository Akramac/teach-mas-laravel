<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        // Return the view with the data
        return view('security.login', $data);
    }

    public function validation(Request $request)
    {
        $validator  = $this->validator($request->all());

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return redirect()->back()->withInput()->with('error','Problem login: '.$errorMessage);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended('teacher/teacherExam');
        }

        // Return the view with the data
        return redirect()->route('login')->with('error','Bad credentials!');

    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }

}
