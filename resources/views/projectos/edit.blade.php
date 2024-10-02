@extends('adminlte::page')

@section('title', 'Editar Projecto')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $projecto->acronimo }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('projectos.update', $projecto->id) }} " method="post">
                    @method('put')
                    @include('projectos.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
