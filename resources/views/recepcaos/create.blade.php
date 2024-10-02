@extends('adminlte::page')

@section('title', 'Adicionar recepção')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova recepção</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('recepcaos.store') }}" method="post">
                    @csrf
                    @include('fontes/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
