@extends('adminlte::page')

@section('title', 'Secretaria por Ano')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <!-- Título do Relatório -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>RELATÓRIO DA SECRETARIA POR PROJECTO</h5>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Pesquisa -->
                <form action="{{ route('relatorios.administracao.ano') }}" method="get">
                    <section class="content">
                        <div class="container-fluid">
                            @if ($val)
                                <div class="alert alert-danger alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Erro de Intervalo</h5>
                                </div>
                            @endif

                            <div class="row">
                                <!-- Campo Data Inicial -->
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="data" class="form-control">Data Inicial</label>
                                        <input type="date" min="2020-01-01" max="2030-12-31" class="form-control"
                                               value="{{ old('data') ?? $data }}" name="data" required>
                                    </div>
                                </div>

                                <!-- Campo Data Final -->
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="data2" class="form-control">Data Final</label>
                                        <input type="date" min="2020-01-01" max="2030-12-31" class="form-control"
                                               value="{{ old('data2') ?? $data2 }}" name="data2" required>
                                    </div>
                                </div>

                                <!-- Campo Projeto -->
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="projecto_id" class="form-control">Projecto</label>
                                        <select class="form-control" name="projecto_id" required>
                                            <option value="" selected disabled>Selecione projecto</option>
                                            @foreach ($projectos as $projecto)
                                                <option value="{{ $projecto->id }}"
                                                        {{ isset($selectedProjecto) && $selectedProjecto == $projecto->id ? 'selected' : '' }}>
                                                    {{ $projecto->acronimo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Botão de Pesquisa -->
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn bg-lightblue btn-block">
                                        <i class="fa fa-search"></i> Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!-- Tabela de Resultados -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Projecto</th>
                                            <th>Ano do Desembolso</th>
                                            <th>Valor Desembolsado</th>
                                            <th>Gasto</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($tabela))
                                            @foreach ($tabela as $table)
                                                <tr>
                                                    <td>{{ $table['acronimo'] }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($table['data'])->format('Y') }}</td>
                                                    <td>{{ number_format($table['desembolso'], 2, ',', '.') }}</td>
                                                    <td>{{ number_format($table['gasto'], 2, ',', '.') }}</td>
                                                    <td>{{ number_format($table['saldo'], 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach

                                            <!-- Exibição do Total -->
                                            <tr style="font-weight: bold; background-color: #f2f2f2;">
                                                <td>Total</td>
                                                <td></td>
                                                <td>{{ number_format($totalDesembolso, 2, ',', '.') }}</td>
                                                <td>{{ number_format($totalGasto, 2, ',', '.') }}</td>
                                                <td>{{ number_format($totalSaldo, 2, ',', '.') }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Nenhum dado encontrado</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim card-body -->
        </div> <!-- Fim card -->
    </div> <!-- Fim col-12 -->
</div> <!-- Fim row -->

@include('layouts.datatable')
@endsection
