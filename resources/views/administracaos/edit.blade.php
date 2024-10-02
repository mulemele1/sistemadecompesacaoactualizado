@extends('adminlte::page')

@section('title', 'Editar Representante da Secretária')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar {{ $administracao->name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('administracaos.update', $administracao->id) }} " method="post">
                    @method('put')
                    @include('administracaos.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
