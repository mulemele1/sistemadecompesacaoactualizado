@extends('adminlte::page')

@section('title', 'Lista de Gestões')

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

    .btn-custom {
        width: 70px;
        /* ajuste conforme necessário */
        height: 30px;
        margin-top: 6px;
        /* ajuste a distância para baixo */
        display: flex;
        /* usa flexbox para alinhar os botões */
        justify-content: center;
        /* centraliza horizontalmente */
        align-items: center;
        /* centraliza verticalmente */
        margin-right: 10px;
        /* espaço entre os botões */
    }

    .button-container {
        display: flex;
        /* usa flexbox para alinhar os botões */
        margin-top: 2px;
        /* ajusta a distância para baixo */
    }

    .table-responsive {
        overflow-x: auto;
        /* permite rolagem horizontal */
    }

    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
            /* Muda a direção dos botões em telas menores */
        }

        .btn-custom {
            width: 100%;
            /* Botões ocupam toda a largura em telas menores */
            margin-right: 0;
            /* Remove margem em telas menores */
            margin-bottom: 5px;
            /* Adiciona espaço entre os botões */
        }
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
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Gestões</h3>
                                <div class="card-tools">
                                    <a href="{{ route('gestaos.create') }}" class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Nome</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gestaos as $gestao)
                                                <tr>
                                                    <td>{{ $gestao->id }}</td>
                                                    <td>{{ $gestao->name }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('gestaos.edit', $gestao->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger"
                                                                onclick="confirmDelete({{ $gestao->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- /.table-responsive -->
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

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Você tem certeza?",
            text: "Esta gestão será deletada permanentemente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, delete!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar o formulário de exclusão
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url('gestaos') }}/' + id; // Altere para a rota correta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(methodInput);
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@include('layouts.datatable')
@endsection