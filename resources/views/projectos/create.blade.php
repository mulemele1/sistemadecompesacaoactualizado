@extends('adminlte::page')

@section('title', 'Adicionar Projecto')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo projecto</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('projectos.store') }}" method="post">
                    @csrf
                    @include('projectos/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
