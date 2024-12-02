@extends('adminlte::page')

@section('title', 'Lista de Participantes')

@section('content')

<style>
    .table {
        background-color: #e3f2fd;
        color: #333;
    }

    .table th {
        background-color: #90caf9;
        color: #fff;
        text-align: center;
    }

    .table td {
        background-color: #e3f2fd;
        color: #000;
        text-align: center;
        vertical-align: middle;
    }

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
        height: 30px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 5px;
    }

    .button-container {
        display: flex;
        justify-content: flex-start;
        gap: 5px;
        margin-top: 2px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table-responsive {
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .button-container {
            flex-direction: column;
        }

        .btn-custom {
            width: 100%;
            margin-right: 0;
            margin-bottom: 5px;
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
                                <h3 class="card-title">Lista de Participantes</h3>
                                <div class="card-tools">
                                    <a href="{{ route('participantes.create') }}" class="btn-sm bg-lightblue">Adicionar</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <!--<div class="button-container" id="exemplo">
                                    
                                    <button class="btn btn-info btn-custom">Show</button>
                                    <button class="btn btn-info btn-custom">Entries</button>
                                    <button class="btn btn-info btn-custom">Copy</button>
                                    <button class="btn btn-success btn-custom">Excel</button>
                                    <button class="btn btn-warning btn-custom">Importar</button>
                                    <button class="btn btn-primary btn-custom">Exportar</button>
                                </div>-->

                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Projecto</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($participantes as $participante)
                                                <tr>
                                                    <td>{{ $participante->codigo }}</td>
                                                    <td>{{ $participante->acronimo }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a role="button" class="btn bg-lightblue" href="{{ route('participantes.edit', $participante->id) }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn bg-danger" onclick="confirmDelete({{ $participante->id }})">
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
            text: "Esta entrada será deletada permanentemente!",
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
                form.action = '/participantes/' + id; // Altere para a rota correta
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
                    text: "Sua entrada foi deletada.",
                    icon: "success"
                });
            }
        });
    }
</script>

@include('layouts.datatable')

@endsection
