@extends('adminlte::page')

@section('title', 'Lista de Propostas')

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

    .status {
        padding: 5px 10px;
        /* Ajuste o padding para menor */
        border-radius: 5px;
        /* Bordas arredondadas */
        display: inline-block;
        /* Para que fiquem em linha */
        text-align: center;
        /* Centraliza o texto */
        font-size: 12px;
        /* Tamanho da fonte menor */
        color: white;
        /* Texto branco */
    }

    .status-pendente {
        background-color: orange;
        /* Laranja */
    }

    .status-aprovada {
        background-color: #4CAF50;
        /* Verde */
    }

    .status-nao-aprovada {
        background-color: #F44336;
        /* Vermelho */
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
                                <h3 class="card-title">Lista de Propostas</h3>
                                <div class="card-tools">
                                    <a href="{{ route('propostas.create') }}"
                                        class="btn-sm btn bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Descrição</th>
                                            <th>Projecto</th>
                                            <th>Valor de Requisição</th>
                                            <th>Data da Proposta</th>
                                            <!--<th>Estado</th>-->
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($propostas as $proposta)
                                                                                @php
                                                                                    // Define o status padrão como 'Pendente'
                                                                                    $statusClass = 'status status-pendente'; // Classe padrão
                                                                                    $statusText = 'PENDENTE'; // Texto padrão

                                                                                    // Modifica o status com base no valor real
                                                                                    switch ($proposta->status) {
                                                                                        case 'nao_aprovada':
                                                                                            $statusClass = 'status status-nao-aprovada';
                                                                                            $statusText = 'NãO APROVADA';
                                                                                            break;
                                                                                        case 'aprovada':
                                                                                            $statusClass = 'status status-aprovada';
                                                                                            $statusText = 'APROVADA';
                                                                                            break;
                                                                                    }
                                                                                @endphp
                                                                                <tr>
                                                                                    <td>{{ $proposta->numero_prop }}</td>
                                                                                    <td>{{ $proposta->descricao }}</td>
                                                                                    <td>{{ $proposta->acronimo }}</td>
                                                                                    <td>{{ number_format($proposta->valor_requisicao, 2) }}</td>
                                                                                    <td>{{ $proposta->data_prop }}</td>
                                                                                    <!-- <td><span class="{{ $statusClass }}">{{ $statusText }}</span></td>-->
                                                                                    <td>
                                                                                        <div class="btn-group">
                                                                                            <!-- <button type="button" class="btn bg-lightblue" onclick="showEditMessage()">
                                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                                </button>-->
                                                                                            <button type="button" class="btn bg-danger"
                                                                                                onclick="confirmDelete({{ $proposta->id }})">
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

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script>
    function showEditMessage() {
        Swal.fire({
            title: "Atenção!",
            text: "Essa proposta não pode ser editada de momento.",
            icon: "info",
            confirmButtonText: "Ok"
        });
    }

    function confirmDelete(id) {
        Swal.fire({
            title: "Você tem certeza?",
            text: "Esta proposta será deletada permanentemente!",
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
                form.action = '/propostas/' + id; // Altere para a rota correta
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