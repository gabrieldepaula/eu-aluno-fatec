@extends('student.auth.template.base')
@section('content')
<div class="login-box">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <a href="{{ route('student.login') }}" class="h1" style="font-family: 'Fugaz One';"><b>EuAluno</b>Fatec</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Faça login para iniciar a sua sessão</p>
            <form method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail">
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
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block">Entrar</button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="{{ route('student.forgot-password') }}">Esqueci minha senha</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('student.register') }}" class="text-center">Cadastre-se</a>
            </p>
        </div>
    </div>
</div>
@endsection