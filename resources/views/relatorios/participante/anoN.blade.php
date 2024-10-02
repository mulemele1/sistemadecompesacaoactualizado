@extends('adminlte::page')

@section('title', 'Participante por ano')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action=" {{ route('relatorios.participanteDN.anoN') }} " method="get">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label for="number" class="form-control">Data Inicial</label>
                                            <input type="date" min="2020" max="2030" class="form-control"
                                                value="{{ old('data') ?? $data }}" name="data" placeholder="Ano">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label for="number" class="form-control">Data Final</label>
                                            <input type="date" min="2020" max="2030" class="form-control"
                                                value="{{ old('data2') ?? $data2 }}" name="data2" placeholder="Ano">
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Valor Gasto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($tabela)
                                                @foreach ($tabela as $table)
                                                    <tr>
                                                        <td>{{ $table[0] }}</td>
                                                        <td>{{ number_format($table[1], 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                        <tfoot>
                                            @isset($sum)
                                                <tr>
                                                    <td>Total:</td>
                                                    <td>{{ number_format($sum, 2) }}</td>
                                                </tr>
                                            @endisset
                                        </tfoot>
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
