@extends('adminlte::page')

@section('title', 'Lista de Requisições')

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

    /* Estilos personalizados */
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
        font-weight: bold;
        padding: 5px;
        border-radius: 5px;
        color: white;
        text-align: center;
        display: inline-block;
        width: 100px;
    }

    .status-aprovado {
        background-color: green;
    }

    .status-nao-aprovado {
        background-color: red;
    }

    .status-pendente {
        background-color: orange;
    }
</style>

<!-- Botão Voltar -->
<div class="row mb-3">
    <div class="col-12 button-container">
        <a href="{{ url('/home') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<!-- Tabela de Requisições -->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Requisições CISPOC</h3>
                                <div class="card-tools">
                                    <a href="{{ route('requisicaocispos.create') }}"
                                        class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Administração</th>
                                                <th>Projecto</th>
                                                <th>Entidade Requerida</th>
                                                <th>Valor</th>
                                                <th>Data da Requisição</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requisicaocispos as $requisicao)
                                                <tr>
                                                    <td>{{ $requisicao->nome }}</td> <!-- Ajustado de nAme para nome -->
                                                    <td>{{ $requisicao->acronimo }}</td>
                                                    <td>{{ $requisicao->name }}</td>
                                                    <td>{{ number_format($requisicao->valor, 2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($requisicao->created_at)->format('d/m/Y') }}
                                                    </td>

                                                    <td>
                                                        <div class="btn-group" style="gap: 10px;">
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('requisicaocispos.edit', $requisicao->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger"
                                                                onclick="confirmDelete({{ $requisicao->id }})">
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

<!-- Inclusão de SweetAlert2 para confirmar exclusões -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Você tem certeza?",
            text: "Esta requisição será deletada permanentemente!",
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
                form.action = '/requisicaocispos/' + id;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.innerHTML = `
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${csrfToken}">
                `;
                document.body.appendChild(form);
                form.submit();

                Swal.fire({
                    title: "Deletado!",
                    text: "A requisição foi deletada.",
                    icon: "success"
                });
            }
        });
    }
</script>

@include('layouts.datatable')
@endsection