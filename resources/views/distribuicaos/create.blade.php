@extends('adminlte::page')

@section('title', 'Realizar Distribuição')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova Distribuição</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('distribuicaos.store') }}" method="post">
                    @csrf
                    @include('distribuicaos/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
