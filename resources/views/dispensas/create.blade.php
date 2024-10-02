@extends('adminlte::page')

@section('title', 'Realizar dispensa')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Nova despensa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dispensas.store') }}" method="post">
                    @include('dispensas/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@include('layouts.escondido')
@endsection
