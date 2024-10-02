@extends('adminlte::page')

@section('title', 'Editar Distribuição')

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $distribuicao->id }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('distribuicaos.update', $distribuicao->id) }} " method="post">
                    @method('put')
                    @include('distribuicaos.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
