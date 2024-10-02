@extends('adminlte::page')

@section('title', 'Adicionar proposta')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova proposta</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('propostas.store') }}" method="post">
                    @csrf
                    @include('propostas/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
