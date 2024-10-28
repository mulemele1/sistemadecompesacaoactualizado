@extends('adminlte::page')

@section('title', 'Projectos por ano')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form action=" {{ route('relatorios.projecto.ano') }} " method="get">
                    <section class="content">
                        <div class="container-fluid">
                            @if ($val)
                                <div class="errors alert alert-danger alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban error"></i>Erro de Intervalo</h5>
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
                                    <form action="simple-results.html">
                                        <div class="input-group">
                                            <label for="projecto" class="form-control">Projecto</label>
                                            <select class="form-control" name="projecto_id">
                                                @if (isset($projecto))
                                                    <option value="{{ $projecto->id }}" selected>
                                                        {{ $projecto->acronimo }}
                                                    </option>
                                                    @foreach ($projectos as $projecto)
                                                        <option value="{{ $projecto->id }}"> {{ $projecto->acronimo }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value=""></option>
                                                    @foreach ($projectos as $projecto)
                                                        <option value="{{ $projecto->id }}"> {{ $projecto->acronimo }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    </form>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Acrônimo</th>
                                            <th>Data Desembolso</th>
                                            <th>Valor Desembolso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($tabela)
                                            @foreach ($tabela as $table)
                                                <tr>
                                                    <td>{{ $table[0] }}</td> <!-- Acrônimo -->
                                                    <td>{{ $table[1] }}</td> <!-- Data -->
                                                    <td>{{ number_format($table[2], 2, ',', '.') }}</td>
                                                    <!-- Valor Desembolsado -->
                                                </tr>
                                            @endforeach

                                            <!-- Exibição do total desembolsado -->
                                            <tr style="font-weight: bold; background-color: #f2f2f2;">
                                                <td>Total</td>
                                                <td></td> <!-- Célula vazia para a Data -->
                                                <td>{{ number_format($totalDesembolsado, 2, ',', '.') }}</td>
                                                <!-- Total do valor desembolsado -->
                                            </tr>
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
@include('layouts.datatable')
@endsection