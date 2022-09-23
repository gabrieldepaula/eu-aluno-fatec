@extends('student.template.base')

@push('js')
    <script src="{{ asset('assets/student/js/page-complete-registration-index.js') }}"></script>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Complete o seu cadastro</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <form method="POST">
        @csrf
        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label>Selecione a sua FATEC</label>
                    <select name="college_id" class="form-control select2 select2-danger @error('college_id') is-invalid @enderror" data-placeholder="Selecione" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="">Selecione</option>
                        @foreach($colleges as $college)
                            <option value="{{ $college->id }}" @if(old('college_id') == $college->id) selected @endif>{{ $college->name }}</option>
                        @endforeach
                    </select>
                    @error('college_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Selecione o seu curso</label>
                    <select name="course_id" class="form-control select2 select2-danger @error('course_id') is-invalid @enderror" data-placeholder="Selecione" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="">Selecione</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->name }}</option>
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
                                <option value="{{ $subject->id }}" @if(in_array($subject->id, old('subjects', []))) selected @endif>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subjects') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </div>
    </form>


</section>
@endsection