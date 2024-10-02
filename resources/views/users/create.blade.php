@extends('adminlte::page')

@section('title', 'Adicionar Usuário')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo Usuário</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    @include('users/partials/form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
