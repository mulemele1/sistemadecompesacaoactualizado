@extends('adminlte::page')

@section('title', 'Editar Gestão')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary mt-3">
            <div class="card-header">
                <h3 class="card-title">Editar:{{ $gestao->name }}</h3>
            </div>
        <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('gestaos.update', $gestao->id) }}" method="post">
                @csrf <!-- Adicionando a diretiva CSRF para segurança -->
                @method('PUT') <!-- Corrigido para estar em maiúsculas -->
                @include('gestaos.partials.form')
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection