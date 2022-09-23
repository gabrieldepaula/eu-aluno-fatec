<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\College;
use App\Models\Subject;
use App\Models\Student;
use App\Notifications\StudentVerifyEmail;
use App\Notifications\StudentForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {

        if(Session::get('student_id')) return redirect()->route('student.home.index');

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|regex:/.+@fatec.sp.gov.br/i',
                'password' => 'required|string|min:8',
            ], [
                'required' => 'Este campo é obrigatório.',
                'email' => 'E-mail inválido.',
                'regex' => 'E-mail inválido.',
                'string' => 'Caracteres inválidos.',
                'min' => 'Este campo deve conter pelo menos :min caracteres.'
            ]);

            if($validator->fails()) {
                return redirect()->route('student.login')->withErrors($validator)->withInput();
            }

            $validated = $validator->safe()->only(['email', 'password']);
            $student = Student::active()->where('email', $validated['email'])->first();

            if(!$student || !Hash::check($validated['password'], $student->password)) {
                $validator->errors()->add('email', 'Dados inválidos.');
                return redirect()->route('student.login')->withErrors($validator)->withInput();
            }

            Session::put('student_id', $student->id);
            return redirect()->route('student.home.index');
        }

        $data = [
            'body_class' => 'login-page',
        ];

        return view('student.auth.login', compact('data'));
    }

    public function logout(Request $request) {
        Session::invalidate();
        return redirect()->route('student.login');
    }

    public function register(Request $request) {

        if(Session::get('student_id')) return redirect()->route('student.home.index');

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:100',
                'email' => 'required|email|unique:App\Models\Student,email|regex:/.+@fatec.sp.gov.br/i',
                'password' => 'required|string|min:8|max:50|confirmed',
            ], [
                'required' => 'Este campo é obrigatório.',
                'email' => 'E-mail inválido.',
                'unique' => 'E-mail já cadastrado',
                'regex' => 'E-mail inválido.',
                'string' => 'Caracteres inválidos.',
                'min' => 'Este campo deve conter pelo menos :min caracteres.',
                'max' => 'Este campo deve conter no máximo :max caracteres.',
                'confirmed' => 'As senhas não coincidem.',
            ]);

            if($validator->fails()) {
                return redirect()->route('student.register')->withErrors($validator)->withInput();
            }

            $validated = $validator->safe()->only(['name', 'email', 'password']);

            $student = new Student();
            $student->fill($validated);
            $student->email_verification_token = Str::random(50);
            $student->save();
            $student->notify(new StudentVerifyEmail($student->email_verification_token));

            return redirect()->route('student.register')->with('message', 'Enviamos um e-mail para o endereço fornecido, clique no link para ativar a sua conta. <a href="'.route('student.login').'">Voltar para o login.</a>');
        }

        $data = [
            'body_class' => 'register-page',
        ];

        return view('student.auth.register', compact('data'));
    }

    public function verifyEmail(Request $request, $token) {

        $student = Student::where('email_verification_token', $token)->where('active', 0)->whereNull('email_verified_at')->firstOrFail();
        $student->email_verification_token = null;
        $student->email_verified_at = now();
        $student->active = true;
        $student->save();

        Session::put('student_id', $student->id);

        return redirect()->route('student.home.index');
    }

    public function forgotPassword(Request $request) {

        if(Session::get('student_id')) return redirect()->route('student.home.index');

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:students,email|regex:/.+@fatec.sp.gov.br/i',
            ], [
                'required' => 'Este campo é obrigatório.',
                'email' => 'E-mail inválido.',
                'exists' => 'E-mail não encontrado.',
                'regex' => 'E-mail inválido.',
            ]);

            if($validator->fails()) {
                return redirect()->route('student.forgot-password')->withErrors($validator)->withInput();
            }

            $validated = $validator->safe()->only(['email']);

            $student = Student::active()->where('email', $validated['email'])->first();
            $student->forgot_password_token = Str::random(50);
            $student->save();

            $student->notify(new StudentForgotPassword($student->forgot_password_token));

            return redirect()->route('student.forgot-password')->with('message', 'Enviamos um e-mail para o endereço fornecido. Clique no link para cadastrar uma nova senha. <a href="'.route('student.login').'">Voltar para o login.</a>');
        }

        $data = [
            'body_class' => 'login-page',
        ];

        return view('student.auth.forgot-password', compact('data'));
    }

    public function recoverPassword(Request $request, $token = null) {

        $student = Student::active()->where('forgot_password_token', $token)->firstOrFail();

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|max:50|confirmed',
            ], [
                'required' => 'Este campo é obrigatório.',
                'string' => 'Caracteres inválidos.',
                'min' => 'Este campo deve conter pelo menos :min caracteres.',
                'max' => 'Este campo deve conter no máximo :max caracteres.',
                'confirmed' => 'As senhas não coincidem.',
            ]);

            if($validator->fails()) {
                return redirect()->route('student.recover-password', ['token' => $token])->withErrors($validator)->withInput();
            }

            $validated = $validator->safe()->only(['password']);

            $student->password = $validated['password'];
            $student->save();

            Session::put('student_id', $student->id);

            return redirect()->route('student.home.index');
        }

        $data = [
            'body_class' => 'login-page',
        ];

        return view('student.auth.recover-password', compact('data'));
    }

    public function completeRegistration(Request $request) {

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'college_id' => 'required|exists:colleges,id',
                'course_id' => 'required|exists:courses,id',
                'subjects' => 'required|array',
                'subjects.*' => 'exists:subjects,id',
            ], [
                'required' => 'Este campo é obrigatório.',
                'array' => 'Dados inválidos.',
                'exists' => 'Dados inválidos.',
            ]);

            if($validator->fails()) {
                return redirect()->route('student.complete-registration')->withErrors($validator)->withInput();
            }

            $validated = $validator->safe()->only(['college_id', 'course_id', 'subjects']);

            $student = $this->getStudent();
            $student->college_id = $validated['college_id'];
            $student->course_id = $validated['course_id'];
            $student->complete = 1;
            $student->save();

            $student->subjects()->sync($validated['subjects']);

            return redirect()->route('student.home.index');
        }

        $colleges = College::active()->orderBy('name', 'asc')->get();
        $courses = Course::active()->orderBy('name', 'asc')->get();
        $subjects = Subject::active()->orderBy('name', 'asc')->get();

        return view('student.auth.complete-registration', compact('colleges', 'courses', 'subjects'));
    }
}
