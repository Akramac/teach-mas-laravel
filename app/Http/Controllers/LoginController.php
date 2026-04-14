<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::user() && Auth::user()->user_level ==='ROLE_TEACHER'){
            $data['title'] = 'Index Teacher';
            $categoriesResult = Categorie::all();
            $data['categories'] = $categoriesResult;
            return view('teacher/teacherExam', $data);
        }
        if(Auth::user() && Auth::user()->user_level ==='ROLE_STUDENT'){
            $data['title'] = 'Index Student';
            $categoriesResult = Categorie::all();
            $data['categories'] = $categoriesResult;
            return view('student/studentExam', $data);
        }

        $data['title'] = 'Login';

        // Return the view with the data
        return view('security.login', $data);
    }

    public function logout()
    {
        $sessionData= Session::all();
        foreach ($sessionData as $key => $value) {
            if (!in_array($key, ['session_id', 'ip_address', 'user_agent', 'last_activity'])) {
                Session::forget($key);
            }
        }

        Auth::logout();


        // Return the view with the data
        return redirect()->route('login');;
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
