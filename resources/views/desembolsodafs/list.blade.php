@extends('adminlte::page')

@section('title', 'Lista de Desembolsodafs')

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

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn-group {
        display: flex;
        justify-content: center;
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
                                <h3 class="card-title">LISTA DE DESEMBOLSOS Á DAF</h3>
                                <div class="card-tools">
                                    <a href="{{ route('desembolsodafs.create') }}"
                                        class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fonte</th>
                                                <th>Projecto</th>
                                                <th>Orçado a</th>
                                                <th>Valor</th>
                                                <th>Data do Desembolso</th>
                                                <!--<th>Data da Última Atualização</th>-->
                                                <th>Estado</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($desembolsodafs as $desembolso)       
                                                <tr data-id="{{ $desembolso->id }}"
                                                    data-gestao-name="{{ $desembolso->gestao_name }}"
                                                    data-projecto-acronimo="{{ $desembolso->projecto_acronimo }}"
                                                    data-gerencia-name="{{ $desembolso->gerencia_name }}"
                                                    data-valor="{{ $desembolso->valor }}"
                                                    data-status="{{ $desembolso->status }}">
                                                    <td>{{ $desembolso->gestao_name }}</td>
                                                    <td>{{ $desembolso->projecto_acronimo }}</td>
                                                    <td>{{ $desembolso->gerencia_name }}</td>
                                                    <td>{{ number_format($desembolso->valor, 2) }}</td>
                                                    <td>{{ $desembolso->data }}</td>
                                                    <td>
                                                        <span class="status 
                                                        @if($desembolso->status == 'APROVADO') status-aprovado 
                                                        @elseif($desembolso->status == 'NAO APROVADO') status-nao-aprovado 
                                                        @elseif($desembolso->status == 'PENDENTE') status-pendente 
                                                        @endif">
                                                            {{ $desembolso->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" style="gap: 10px;">
                                                            <!-- Adiciona um espaçamento entre os botões -->
                                                            <a role="button" class="btn bg-lightblue"
                                                                href="{{ route('desembolsodafs.edit', $desembolso->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger"
                                                                onclick="confirmDelete({{ $desembolso->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <div class="btn-group" style="gap: 10px;">
                                                                <button type="button" class="btn"
                                                                    style="background-color: yellow; color: black;"
                                                                    onclick="editRow({{ $desembolso->id }}, this)">
                                                                    <i class="fas fa-eye"></i>
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
            text: "Este desembolso será deletado permanentemente!",
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
                form.action = '/desembolsodafs/' + id;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.innerHTML = `
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${csrfToken}">
                `;
                document.body.appendChild(form);
                form.submit();

                Swal.fire({
                    title: "Deletado!",
                    text: "O desembolso foi deletado.",
                    icon: "success"
                });
            }
        });
    }

    function editRow(id, element) {
        const row = element.closest('tr');
        const gestaoName = row.getAttribute('data-gestao-name');
        const projectoAcronimo = row.getAttribute('data-projecto-acronimo');
        const gerenciaName = row.getAttribute('data-gerencia-name');
        const valor = row.getAttribute('data-valor');
        const status = row.getAttribute('data-status');

        Swal.fire({
            title: 'VISUALIZAR DESEMBOLSO',
            html: `
            <form id="editForm-${id}" style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%;">
                <label for="usuario" style="margin-bottom: 10px;">Usuário que está editando:</label>
                <input type="text" id="usuario-${id}" name="usuario" value="{{ Auth::user()->name }}" readonly style="margin-bottom: 15px; width: 80%; text-align: center;">
                
                <label for="nome" style="margin-bottom: 10px;">Entidade:</label>
                <input type="text" id="nome-${id}" name="nome" value="${gestaoName}" readonly style="margin-bottom: 15px; width: 80%; text-align: center;">
                
                <label for="acronimo" style="margin-bottom: 10px;">Acronimo do Projecto:</label>
                <input type="text" id="acronimo-${id}" name="acronimo" value="${projectoAcronimo}" readonly style="margin-bottom: 15px; width: 80%; text-align: center;">
                
                <label for="name" style="margin-bottom: 10px;">Nome:</label>
                <input type="text" id="name-${id}" name="name" value="${gerenciaName}" readonly style="margin-bottom: 15px; width: 80%; text-align: center;">
                
                <label for="valor" style="margin-bottom: 10px;">Valor:</label>
                <input type="number" id="valor-${id}" name="valor" value="${valor}" readonly style="margin-bottom: 15px; width: 80%; text-align: center;">
            
                <label for="status" style="margin-bottom: 10px;">Status:</label>
                <input type="text" id="status-${id}" name="status" value="${status}" readonly style="margin-bottom: 15px; width: 80%; text-align: center; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px;">
        
            </form>
        `,
            confirmButtonText: 'OK'
        });
    }



</script>

@include('layouts.datatable')
@endsection