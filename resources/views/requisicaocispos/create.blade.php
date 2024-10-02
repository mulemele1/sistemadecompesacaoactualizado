@extends('adminlte::page')

@section('title', 'Realizar requisição')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova requisição</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('requisicaocispos.store') }}" method="post">
                    @csrf
                    @include('requisicaocispos/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
