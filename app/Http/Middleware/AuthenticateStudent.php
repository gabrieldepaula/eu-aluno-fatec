<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $studentId = Session::get('student_id');

        if(!$studentId) {
            return redirect()->route('student.login');
        }

        $student = Student::findOrFail($studentId);

        if(!$student->complete && $request->route()->getName() != 'student.home.index') {
            return redirect()->route('student.home.index');
        }

        View::share('student', $student);

        return $next($request);
    }
}
