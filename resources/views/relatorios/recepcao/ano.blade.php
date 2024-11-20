@extends('adminlte::page')

@section('title', 'RELATÓRIO DA RECEPÇÃO POR LOCAL')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
            <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>RELATÓRIO DA RECEPÇÃO POR LOCAL</h5>
                        </div>
                    </div>
                </div>
                <form action="{{ route('relatorios.recepcao.ano') }}" method="get">
                    <section class="content">
                        <div class="container-fluid">
                            @if ($val)
                                <div class="alert alert-danger alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Erro de Intervalo</h5>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="data" class="form-control">Data Inicial</label>
                                        <input type="date" min="2020-01-01" max="2030-12-31" class="form-control"
                                               value="{{ old('data') ?? $data }}" name="data" placeholder="Data Inicial" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="data2" class="form-control">Data Final</label>
                                        <input type="date" min="2020-01-01" max="2030-12-31" class="form-control"
                                               value="{{ old('data2') ?? $data2 }}" name="data2" placeholder="Data Final" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="recepcao_id" class="form-control">Recepção</label>
                                        <select class="form-control" name="recepcao_id" required>
                                            <option value=""></option>
                                            @foreach ($recepcaos as $recepcao)
                                                <option value="{{ $recepcao->id }}" 
                                                    {{ isset($recepcao_id) && $recepcao_id == $recepcao->id ? 'selected' : '' }}>
                                                    {{ $recepcao->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="projecto_id" class="form-control">Projecto</label>
                                        <select class="form-control" name="projecto_id" required>
                                            <option value=""></option>
                                            @foreach ($projectos as $projecto)
                                                <option value="{{ $projecto->id }}" 
                                                    {{ isset($projecto_id) && $projecto_id == $projecto->id ? 'selected' : '' }}>
                                                    {{ $projecto->acronimo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn bg-lightblue btn-block">
                                        <i class="fa fa-search"></i> Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Recepção</th>
            <th>Projecto</th>
            <th>Data Desembolso</th>
            <th>Valor Distribuido</th>
            <th>Valor Gasto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @isset($tabela)
            @foreach ($tabela as $table)
                <tr>
                    <td>{{ $table['recepcao'] }}</td>
                    <td>{{ $table['projecto'] }}</td>
                    <td>
                        {{ $table['data_desembolso'] !== 'Não encontrado' ? \Carbon\Carbon::parse($table['data_desembolso'])->format('d/m/Y') : 'Não encontrado' }}
                    </td>
                    <td>
                        {{ is_numeric($table['valor_desembolso']) ? number_format($table['valor_desembolso'], 2, ',', '.') : 'Não encontrado' }}
                    </td>
                    
                    <td>
                        {{ is_numeric($table['valor_gasto']) ? number_format($table['valor_gasto'], 2, ',', '.') : 'Não encontrado' }}
                    </td>
                    <td>
                        {{ is_numeric($table['saldo']) ? number_format($table['saldo'], 2, ',', '.') : 'Não encontrado' }}
                    </td>
                </tr>
            @endforeach
           <!-- <tr style="font-weight: bold; background-color: #f2f2f2;">
                <td>Total</td>
                <td></td>
                <td></td>
                <td>{{ number_format($totalDesembolsado, 2, ',', '.') }}</td>
                <td>{{ number_format($totalGasto, 2, ',', '.') }}</td>
                <td>{{ number_format($totalDesembolsado - $totalGasto, 2, ',', '.') }}</td>
            </tr>
-->
        @endisset
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
@include('layouts.datatable')
@endsection