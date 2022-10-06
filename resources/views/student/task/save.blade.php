@extends('student.template.base')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/student/js/page-task-save.js') }}"></script>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@if($task->exists) Editar Tarefa @else Cadastrar Tarefa @endif</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('student.task.save', ['task' => $task]) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="form-group">
                                <label>Matéria</label>
                                <select name="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
                                    <option value="">Selecione</option>
                                    @foreach($student->subjects()->active()->get() as $subject)
                                        <option value="{{ $subject->id }}" @if(old('subject_id', $task->subject_id) == $subject->id) selected @endif>{{ $subject->title }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Observações</label>
                                <textarea name="notes" cols="30" rows="5" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $task->notes) }}</textarea>
                                @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Data de Entrega</label>
                                  <div class="input-group date" id="delivery_date_input" data-target-input="nearest">
                                      <input type="text" name="delivery_date" class="form-control datetimepicker-input @error('delivery_date') is-invalid @enderror" data-target="#delivery_date_input" value="{{ old('delivery_date', $task->exists ? $task->delivery_date->format('d/m/Y H:i') : '') }}"/>
                                      <div class="input-group-append" data-target="#delivery_date_input" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                      @error('delivery_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                  </div>
                              </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('student.task.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection