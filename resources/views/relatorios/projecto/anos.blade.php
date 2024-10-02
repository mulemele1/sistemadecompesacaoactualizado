@extends('adminlte::page')

@section('title', 'Projectos por Anos')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action=" {{ route('relatorios.projecto.anos') }} " method="get">
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
                                            <label for="number" class="form-control">Ano</label>
                                            <input type="number" min="2022" max="2030" class="form-control"
                                                value="{{ old('data') }}" name="data" placeholder="Ano inicial">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                        <label for="number" class="form-control">Ano</label>
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ano</th>
                                                <th>Acronimo</th>
                                                <th>Saldo</th>
                                                <th>Gasto</th>
                                                <th>Desembolsado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($tabela)
                                                @foreach ($tabela as $table)
                                                    <tr>
                                                        <td>{{ $table[0] }}</td>
                                                        <td>{{ $table[1] }}</td>
                                                        <td>{{ $table[2] }}</td>
                                                        <td>{{ $table[3] }}</td>
                                                        <td>{{ $table[4] }}</td>
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
    @include('layouts.datatable')
@endsection
