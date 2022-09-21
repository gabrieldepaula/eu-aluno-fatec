<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request) {

        $student = $this->getStudent();

        return view('student.home.index');
    }
}
