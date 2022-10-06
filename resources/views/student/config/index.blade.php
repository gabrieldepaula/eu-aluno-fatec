@extends('student.template.base')

@push('js')
    <script src="{{ asset('assets/student/js/page-config-index.js') }}"></script>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Configurações</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                {{-- <a href="{{ route('student.task.new') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nova</a> --}}
            </div>
            <div class="card-body">
                {{-- <table class="table table-striped" id="items"></table> --}}
            </div>
        </div>
    </div>
</section>
@endsection