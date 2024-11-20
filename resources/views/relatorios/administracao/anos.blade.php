@extends('adminlte::page')

@section('title', 'RELATÓRIO DA SECRETARIA - TODOS OS PROJECTOS')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <!-- Título do Relatório -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <h5>RELATÓRIO DA SECRETARIA - TODOS OS PROJECTOS</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Formulário de Pesquisa -->
                    <form action="{{ route('relatorios.administracao.anos') }}" method="get">
                        <section class="content">
                            <div class="container-fluid">
                                
                                @if ($val)
                                    <div class="errors alert alert-danger alert-dismissible text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban error"></i> Erro de Intervalo</h5>
                                    </div>
                                @endif

                                <div class="row">
                                    <!-- Campo Ano Inicial -->
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label for="data" class="form-control">Ano Inicial</label>
                                            <input type="number" min="2022" max="2030" class="form-control" 
                                                   value="{{ old('data') }}" name="data" placeholder="Ano Inicial">
                                        </div>
                                    </div>

                                    <!-- Campo Ano Final -->
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label for="data2" class="form-control">Ano Final</label>
                                            <input type="number" min="2022" max="2030" class="form-control" 
                                                   value="{{ old('data2') }}" name="data2" placeholder="Ano Final">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn bg-lightblue">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>

                    <!-- Tabela de Resultados -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3">
                                <!-- Card Body com Tabela -->
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ano</th>
                                                <th>Nome</th>
                                                <th>Desembolsado</th>
                                                <th>Gasto</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($tabela)
                                                @foreach ($tabela as $table)
                                                    <tr>
                                                        <td>{{ $table[0] }}</td> <!-- Ano -->
                                                        <td>{{ $table[1] }}</td> <!-- Nome -->
                                                        <td>{{ number_format($table[4], 2, ',', '.') }}</td> <!-- Desembolsado -->
                                                        <td>{{ number_format($table[3], 2, ',', '.') }}</td> <!-- Gasto -->
                                                        <td>{{ number_format($table[2], 2, ',', '.') }}</td> <!-- Saldo -->
                                                    </tr>
                                                @endforeach
                                            @endisset
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

    <!-- Inclusão do Datatable -->
    @include('layouts.datatable')
@endsection
