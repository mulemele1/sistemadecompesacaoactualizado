@extends('adminlte::page')

@section('title', 'RELATÓRIO DA DAF POR LOCAL')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>RELATÓRIO DA DAF POR LOCAL</h5>
                        </div>
                    </div>
                </div>
                    <form action="{{ route('relatorios.fontedaf.anos') }}" method="get">
                        <section class="content">
                            <div class="container-fluid">
                                @if ($val)
                                    <div class="errors alert alert-danger alert-dismissible text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban error"></i>Erro de Intervalo</h5>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label for="number" class="form-control">Ano inicial</label>
                                            <input type="number" min="2022" max="2030" class="form-control"
                                                value="{{ old('data') }}" name="data" placeholder="Ano Inicial">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label for="number" class="form-control">Ano final</label>
                                            <input type="number" min="2022" max="2030" class="form-control"
                                                value="{{ old('data2') }}" name="data2" placeholder="Ano final">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3">
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
                                                        <td>{{ $table[4] }}</td> <!-- Desembolsado -->
                                                        <td>{{ $table[3] }}</td> <!-- Gasto -->
                                                        <td>{{ $table[2] }}</td> <!-- Saldo -->
                                                    </tr>
                                                @endforeach
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
