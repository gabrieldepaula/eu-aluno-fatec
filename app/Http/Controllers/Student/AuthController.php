<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|regex:/.+@fatec.sp.gov.br/i',
                'password' => 'required|string|min:8',
            ], [
                'required' => 'Este campo é obrigatório.',
                'email' => 'E-mail inválido.',
                'regex' => 'Dados inválidos.',
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
        return view('student.login.index');
    }

    public function logout(Request $request) {
        Session::forget('student_id');
        return redirect()->route('student.login');
    }
}
