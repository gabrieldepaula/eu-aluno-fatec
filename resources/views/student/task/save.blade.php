@extends('student.template.base')

@push('js')
    <script src="{{ asset('assets/student/js/page-task-index.js') }}"></script>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@if($item->exists) Editar Tarefa @else Cadastrar Tarefa @endif</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                form
            </div>
            <div class="card-footer">
                <a href="{{ route('student.task.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
    </div>
</section>
@endsection