@extends('student.auth.template.base')

@section('content')
<div class="register-box">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <a href="{{ route('student.register') }}" class="h1"><b>EuAluno</b>Fatec</a>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">
                    {!! session('message') !!}
                </div>
            @endif
            <p class="login-box-msg">Preencha o formulário abaixo para criar sua conta</p>
            <form method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" value="{{ old('name') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirme a sua senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block">Cadastrar</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('student.login') }}" class="text-center">Já tenho uma conta</a>
        </div>
    </div>
</div>
@endsection