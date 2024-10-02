@extends('adminlte::page')

@section('title', 'Adicionar fonte')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova fonte</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('fontes.store') }}" method="post">
                    @csrf
                    @include('fontes/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
