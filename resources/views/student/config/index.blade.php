@extends('student.template.base')

@push('js')
    <script src="{{ asset('assets/student/js/page-config-index.js') }}"></script>
    <script>
        const login_url = '{{ route('student.login') }}';
    </script>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fas fa-check"></i> {!! session('message') !!}
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Configurações</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <form method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Meus Dados</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" disabled>
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                </div>
                                <div class="col-4">

                                    <div class="form-group">
                                        <label>Nova senha</label>
                                        <input type="password" name="password" class="form-control @error('email') is-invalid @enderror">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirmação da nova senha</label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                        @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Meus Curso</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Selecione a sua FATEC</label>
                                <select name="college_id" class="form-control select2 select2-danger @error('college_id') is-invalid @enderror" data-placeholder="Selecione" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">Selecione</option>
                                    @foreach($colleges as $college)
                                        <option value="{{ $college->id }}" @if(old('college_id', $student->college_id) == $college->id) selected @endif>{{ $college->title }}</option>
                                    @endforeach
                                </select>
                                @error('college_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Selecione o seu curso</label>
                                <select name="course_id" class="form-control select2 select2-danger @error('course_id') is-invalid @enderror" data-placeholder="Selecione" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">Selecione</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if(old('course_id', $student->course_id) == $course->id) selected @endif>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Selecione todas as matérias que está cursando neste semestre</label>
                                <div class="select2-danger">
                                    <select name="subjects[]" multiple="multiple" data-placeholder="Selecione" class="form-control select2 select2-danger @error('subjects') is-invalid @enderror" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Selecione</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}" @if(in_array($subject->id, old('subjects', $student->subjects->pluck('id')->toArray()))) selected @endif>{{ $subject->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('subjects') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Apagar Conta</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-danger btn-delete-account"><i class="fas fa-trash"></i> Apagar conta e todas as minhas tarefas</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{ route('student.home.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection