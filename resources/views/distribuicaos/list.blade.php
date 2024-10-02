@extends('adminlte::page')

@section('title', 'Lista de Distribuições')

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
        justify-content: center;
        /* centraliza horizontalmente */
        align-items: center;
        /* centraliza verticalmente */
        display: flex;
        /* usa flexbox para alinhar os botões */
        margin-right: 10px;
        /* espaço entre os botões */
    }

    .button-container {
        display: flex;
        /* usa flexbox para alinhar os botões */
        margin-top: 2px;
        /* ajusta a distância para baixo */
    }

    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
            /* Muda a direção dos botões em telas menores */
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
                                <h3 class="card-title">Lista de Distribuições</h3>
                                <div class="card-tools">
                                    <a href="{{ route('distribuicaos.create') }}"
                                        class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Administração</th>
                                                <th>Projecto</th>
                                                <th>Recepção</th>
                                                <th>Valor</th>
                                                <th>Data da Distribuição</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($distribuicaos as $distribuicao)
                                                <tr>
                                                    <td>{{ $distribuicao->nome }}</td>
                                                    <td>{{ $distribuicao->acronimo }}</td>
                                                    <td>{{ $distribuicao->recepcao_nome }}</td>
                                                    <td>{{ number_format($distribuicao->valor, 2) }}</td>
                                                    <td>{{ $distribuicao->created_at }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('distribuicaos.edit', $distribuicao->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger"
                                                                onclick="confirmDelete({{ $distribuicao->id }})">
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
            text: "Esta distribuição será deletada permanentemente!",
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
                form.action = '/distribuicaos/' + id; // Altere para a rota correta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.innerHTML = `
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${csrfToken}">
                `;
                document.body.appendChild(form);
                form.submit();

                Swal.fire({
                    title: "Deletado!",
                    text: "A distribuição foi deletada.",
                    icon: "success"
                });
            }
        });
    }
</script>

@include('layouts.datatable')
@endsection