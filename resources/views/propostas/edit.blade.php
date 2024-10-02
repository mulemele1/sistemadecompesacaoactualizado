@extends('adminlte::page')

@section('title', 'Editar proposta')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $proposta->descricao }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('propostas.update', $proposta->id) }} " method="post">
                    @method('put')
                    @include('propostas.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
