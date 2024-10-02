@extends('adminlte::page')

@section('title', 'Lista de Projectos')

@section('content')

<div class="container">
    @yield('content')
</div>

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
        height: 30px;
        margin-top: 6px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 10px;
    }

    .button-container {
        display: flex;
        flex-wrap: wrap;
        /* Permite que os botões se ajustem */
        margin-top: 2px;
        margin-bottom: 20px;
        /* Espaço na parte inferior */
    }

    .status-active,
    .status-inactive {
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
        text-align: center;
        font-size: 12px;
        color: white;
    }

    .status-active {
        background-color: #4CAF50;
        /* Verde */
    }

    .status-inactive {
        background-color: #F44336;
        /* Vermelho */
    }

    .table-responsive {
        overflow-x: auto;
        /* Permite rolagem horizontal */
    }

    @media (max-width: 768px) {
        .btn-custom {
            width: 100%;
            /* Botões ocupam toda a largura em telas menores */
            margin-bottom: 10px;
            /* Espaço entre os botões */
        }

        .button-container {
            flex-direction: column;
            /* Empilha os botões verticalmente */
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
                                <h3 class="card-title">Lista de Projectos</h3>
                                <div class="card-tools">
                                    <a href="{{ route('projectos.create') }}" class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Acronimo</th>
                                                <th>Financiador</th>
                                                <th>Valor Orçamental</th>
                                                <th>Valor por Participante</th>
                                                <th>Valor da visita não programada</th>
                                                <th>Data de Finalização</th>
                                                <th>Estado</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projectos as $projecto)
                                                                                        @php
                                                                                            $dataFim = \Carbon\Carbon::parse($projecto->data_prevista_termino);
                                                                                            $statusClass = $dataFim->isPast() ? 'status-inactive' : 'status-active';
                                                                                            $statusText = $dataFim->isPast() ? 'INATIVO' : 'ATIVO';
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td>{{ $projecto->id }}</td>
                                                                                            <td>{{ $projecto->acronimo }}</td>
                                                                                            <td>{{ $projecto->fonte_nome }}</td>
                                                                                            <td>{{ number_format($projecto->valor_orcamental, 2) }}</td>
                                                                                            <td>{{ number_format($projecto->valor_participante, 2) }}</td>
                                                                                            <td>{{ number_format($projecto->valor_nao_programado, 2) }}</td>
                                                                                            <td>{{ $projecto->data_prevista_termino }}</td>
                                                                                            <td class="text-center">
                                                                                                <span class="{{ $statusClass }}">{{ $statusText }}</span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="btn-group">
                                                                                                    <a role="button" class="btn bg-lightblue"
                                                                                                        href="{{ route('projectos.edit', $projecto->id) }}">
                                                                                                        <i class="fas fa-pencil-alt"></i>
                                                                                                    </a>
                                                                                                    <button type="button" class="btn bg-danger"
                                                                                                        onclick="confirmDelete({{ $projecto->id }})">
                                                                                                        <i class="fas fa-trash"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
            text: "Este projeto será deletado permanentemente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, delete!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/projectos/' + id; // Altere para a rota correta
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

                Swal.fire({
                    title: "Deletado!",
                    text: "Seu projeto foi deletado.",
                    icon: "success"
                });
            }
        });
    }
</script>

@include('layouts.datatable')
@endsection