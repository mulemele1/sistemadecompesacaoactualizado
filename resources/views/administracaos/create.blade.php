@extends('adminlte::page')

@section('title', 'Adicionar')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo registro</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('administracaos.store') }}" method="post">
                    @csrf
                    @include('administracaos/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
