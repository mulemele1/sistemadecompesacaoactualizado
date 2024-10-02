@extends('adminlte::page')

@section('title', 'Financiador por Ano')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action=" {{ route('graficos.financiador.ano') }} " method="get">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" min="1980" max="<?php date('Y'); ?>"
                                     name="data" placeholder="Ano">
                                    </div>
                                    <div class="col-md-6">
                                        <form action="simple-results.html">
                                            <div class="input-group">
                                                <select class="form-control" name="financiador_id">
                                                    @foreach ($financiadors as $financiador)
                                                        <option value="{{ $financiador->id }}"> {{ $financiador->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn bg-lightblue">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary mt-2">
                                <div class="card-header">
                                    <h3 class="card-title">Bar Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var anoProjectos = @json($anoProjectos);
    </script>
    <script>
        var months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            data: {
                datasets: [
                    {type: 'bar', label: 'Valor alocado', data: anoProjectos },
                ],
                labels: months
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
