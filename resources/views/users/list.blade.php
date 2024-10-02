@extends('adminlte::page')

@section('title', 'Lista de Usuários')

@section('content')
<style>
    /* Estiliza o fundo da tabela */
    .table {
        background-color: #e3f2fd;
        /* Cor de fundo azul claro */
        color: #333;
        /* Cor de texto */
    }

    .table th {
        background-color: #90caf9;
        /* Cor de fundo para o cabeçalho da tabela */
        color: #fff;
        /* Cor do texto no cabeçalho */
        text-align: center;
    }

    .table td {
        background-color: #e3f2fd;
        /* Cor de fundo para as células */
        color: #000;
        /* Cor do texto das células */
        text-align: center;
        vertical-align: middle;
    }

    /* Botões dentro da tabela */
    .table .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        border-radius: 4px;
    }

    .table .btn-edit {
        background-color: #64b5f6;
        color: white;
    }

    .table .btn-delete {
        background-color: #e57373;
        color: white;
    }

    .table .btn-view {
        background-color: #81c784;
        color: white;
    }


    .btn-custom {
        width: 40px;
        /* Ajustado para os ícones */
        height: 30px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 5px;
    }

    .button-container {
        display: flex;
        margin-top: 2px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn-group {
        display: inline-block;
        justify-content: center;

    }

    /* ... (estilos existentes) ... */
    .btn-custom {
        width: 70px;
        height: 30px;
        margin-top: 6px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 10px;
    }

    .button-container {
        display: flex;
        margin-top: 2px;
    }
</style>

<div class="row mb-3">
    <div class="col-12 button-container">
        <a href="{{ url('/home') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                {{-- <form action=" {{ route('users.index') }} " method="get">
                    <section class="content">
                        <div class="container-fluid">
                            <h2 class="text-center display-4">Pesquisa</h2>
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <form action="simple-results.html">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control form-control-lg"
                                                placeholder="Type your keywords here">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-lg btn-default">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </form> --}}
                <div class="row">
                    <div class="col-12">

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Usuários</h3>
                                <div class="card-tools">
                                    <a href="{{ route('users.create') }}" class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nome</th>
                                            <th>Type</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->type }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <form action=" {{ route('users.delete', $user->id) }} " method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="btn-group">
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('users.edit', $user->id) }}"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <button role="button" type="submit" class="btn bg-danger"
                                                                href="{{ route('users.edit', $user->id) }}"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.datatable')
@endsection