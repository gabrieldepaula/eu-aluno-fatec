@extends('student.auth.template.base')

@section('content')<div class="login-box">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <a href="{{ route('student.login') }}" class="h1" style="font-family: 'Fugaz One';"><b>EuAluno</b>Fatec</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Cadastre uma nova senha abaixo.</p>
            <form method="post">
                @csrf
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
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger btn-block">Atualizar senha</button>
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