@extends('student.auth.template.base')
@section('content')
<div class="login-box">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <a href="{{ route('student.forgot-password') }}" class="h1" style="font-family: 'Fugaz One';"><b>EuAluno</b>Fatec</a>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">
                    {!! session('message') !!}
                </div>
            @endif
            <p class="login-box-msg">Esqueceu sua senha? Digite seu e-mail abaixo que enviaremos um link para você cadastrar uma nova.</p>
            <form method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger btn-block">Solicitar nova senha</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('student.login') }}">Entrar</a>
            </p>
        </div>
    </div>
</div>
@endsection