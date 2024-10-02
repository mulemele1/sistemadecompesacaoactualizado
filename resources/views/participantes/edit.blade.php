@extends('adminlte::page')

@section('title', 'Editar Participante')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $participante->codigo }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('participantes.update', $participante->id) }} " method="post">
                    @method('put')
                    @include('participantes.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
