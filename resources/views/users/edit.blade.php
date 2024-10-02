@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar Usuário {{ $user->name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('users.update', $user->id) }} " method="post">
                    @method('put')
                    @include('users.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
