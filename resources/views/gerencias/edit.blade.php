@extends('adminlte::page')

@section('title', 'Editar Gerência')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary mt-3">
            <div class="card-header">
                <h3 class="card-title">Editar:{{ $gerencia->name }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('gerencias.update', $gerencia->id) }}" method="post">
                @csrf <!-- Adicionando a diretiva CSRF para segurança -->
                @method('PUT') <!-- Corrigido para estar em maiúsculas -->
                @include('gerencias.partials.form')
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection