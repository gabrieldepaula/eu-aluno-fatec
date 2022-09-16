<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        // $student = \App\Models\Student::find(5);
        // $student->notify(new \App\Notifications\StudentVerifyEmail($student->email_verification_token));
        // dd('foi');

        return view('student.home.index');
    }
}
