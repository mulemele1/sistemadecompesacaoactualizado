@extends('adminlte::page')

@section('title', 'Editar requisição')

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $requisicao->id }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('requisicaocispos.update', $requisicao->id) }} " method="post">
                    @method('put')
                    @include('requisicaocispos.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
