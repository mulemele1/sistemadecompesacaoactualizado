@extends('adminlte::page')

@section('title', 'Lista de Dispensas')

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
        width: 100%;
        /* Ajusta a largura para ocupar 100% em telas menores */
        max-width: 70px;
        /* Limita a largura em telas maiores */
        height: 30px;
        margin-top: 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
    }

    .button-container {
        display: flex;
        flex-wrap: wrap;
        /* Permite que os botões se movam para a linha seguinte */
        margin-top: 2px;
    }

    .text-danger {
        color: red;
        /* Destaque em vermelho */
    }

    @media (max-width: 768px) {
        .btn-custom {
            max-width: 100%;
            /* Botões ocupam a largura total em telas menores */
        }

        .table-responsive {
            overflow-x: auto;
            /* Permite rolagem horizontal */
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
                                <h3 class="card-title">Lista de Dispensas</h3>
                                <div class="card-tools">
                                    <a href="{{ route('dispensas.create') }}" class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Recepção</th>
                                                <th>Projecto</th>
                                                <th>Participante</th>
                                                <th>Visita normal</th>
                                                <th>Valor da visita normal</th>
                                                <th>Valor da visita não programada</th>
                                                <th>Motivo da visita não programada</th>
                                                <th>Valor Variavel</th>
                                                <th>Motivo</th>
                                                <th>Data da despesa</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dispensas as $dispensa)
                                                <tr>
                                                    <td>{{ $dispensa->name }}</td>
                                                    <td
                                                        class="{{ isset($dispensa->saldo) && !$dispensa->saldo ? 'text-danger' : '' }}">
                                                        {{ $dispensa->acronimo }}</td>
                                                    <td>{{ $dispensa->codigo }}</td>
                                                    <td>{{ $dispensa->visita }}</td>
                                                    <td>{{ number_format($dispensa->valor, 2) }}</td>
                                                    <td>{{ number_format($dispensa->valor_esp, 2) }}</td>
                                                    <td>{{ $dispensa->motivo_esp }}</td>
                                                    <td>{{ number_format($dispensa->valor_variavel, 2) }}</td>
                                                    <td>{{ $dispensa->motivo }}</td>
                                                    <td>{{ $dispensa->created_at }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('dispensas.edit', $dispensa->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger"
                                                                onclick="confirmDelete({{ $dispensa->id }})">
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
            text: "Esta dispensa será deletada permanentemente!",
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
                form.action = '/dispensas/' + id; // Altere para a rota correta
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
                    text: "A dispensa foi deletada.",
                    icon: "success"
                });
            }
        });
    }
</script>

@include('layouts.datatable')
@endsection