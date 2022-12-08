<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\College;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SaveConfigRequest;

class ConfigurationController extends Controller
{
    public function index(Request $request) {

        $colleges = College::active()->orderBy('title', 'asc')->get();
        $courses = Course::active()->orderBy('title', 'asc')->get();
        $subjects = Subject::active()->orderBy('title', 'asc')->get();

        return view('student.config.index', compact('colleges', 'courses', 'subjects'));
    }

    public function save(SaveConfigRequest $request) {

        $data = $request->safe()->only([
            'name',
            'password',
            'password_confirmation',
            'college_id',
            'course_id',
            'subjects',
        ]);

        $student = $this->getStudent();
        $student->name = $data['name'];
        $student->college_id = $data['college_id'];
        $student->course_id = $data['course_id'];

        if($data['password']) {
            $student->password = bcrypt($data['password']);
        }

        $student->save();

        $student->subjects()->sync($data['subjects']);

        return redirect()->route('student.config.index')->with('message', 'Dados atualizados com sucesso.');
    }

    public function actions(Request $request) {
        if(!$request->ajax()) {
            return response()->json(['error' => true]);
        } else {
            switch($request->input('action')) {
                case 'delete-account':

                    $student = $this->getStudent();
                    $student->subjects()->sync([]);
                    foreach($student->tasks as $task) {
                        $task->delete();
                    }
                    $student->delete();
                    Session::forget('student_id');

                    return response()->json(['error' => false]);
                break;

                default:
                    return response()->json(['error' => true]);
                break;
            }
        }
    }
}