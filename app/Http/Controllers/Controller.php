<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getStudent() {
        $studentId = Session::get('student_id');
        $student = Student::find($studentId);
        return $student;
    }
}
