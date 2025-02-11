@extends('adminlte::page')

@section('title', 'Adicionar gestao')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova Indentidade de Gestao</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('gestaos.store') }}" method="post">
                    @csrf
                    @include('gestaos/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
