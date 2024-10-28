@extends('adminlte::page')

@section('title', 'Projectos por Anos')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('relatorios.projecto.anos') }}" method="get">
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
                                        <label for="number" class="form-control">Data Inicial</label>
                                        <input type="date" min="2020" max="2030" class="form-control"
                                            value="{{ old('data') ?? $data }}" name="data" placeholder="Ano">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="number" class="form-control">Data Final</label>
                                        <input type="date" min="2020" max="2030" class="form-control"
                                            value="{{ old('data2') ?? $data2 }}" name="data2" placeholder="Ano">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="distribuicao" class="form-control">Recepção</label>
                                        <select class="form-control" name="recepcao_id">
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
                                            <th>Acrônimo</th>
                                            <th>Data Desembolsado</th>
                                            <th>Valor Desembolsado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($tabela)
                                            @foreach ($tabela as $table)
                                                <tr>
                                                    <td>{{ $table[0] }}</td>
                                                    <td>{{ $table[1] }}</td>
                                                    <td>{{ number_format($table[2], 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                            <tr style="font-weight: bold; background-color: #f2f2f2;">
                                                <td>Total</td>
                                                <td></td>
                                                <td>{{ number_format($totalDesembolsado, 2, ',', '.') }}</td>
                                            </tr>
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
