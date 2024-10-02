@extends('adminlte::page')

@section('title', 'Editar dispensa')

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $dispensa->id }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('dispensas.update', $dispensa->id) }} " method="post">
                    @method('put')
                    @include('dispensas.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
