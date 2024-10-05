@extends('adminlte::page')

@section('title', 'SysComp')

@cannot('is_admin')
@section('content')
<div class="welcome-message mt-3">
    <h2 class="text-primary">Bem-vindo ao Sistema de Compensação!</h2>

    <p class="text-muted">Hoje é <strong>{{ \Carbon\Carbon::now()->format('l, d/m/Y') }}</strong>.</p>
    <p class="text-info">Explore os recursos e aproveite ao máximo sua experiência!</p>

    <p class="text-success">Vamos começar a sua jornada com o sistema!</p>
</div>
@endsection
@endcannot

@section('content')
<div class="row">
    @can('is_admin')
            @section('content_header')
            <h1 class="m-0 text-dark">Dashboard</h1>
            @endsection

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Desembolso</span>
                        <span class="info-box-number">
                            {{ number_format($desembolsos->sum('valor'), 2) . 'MT' }}
                        </span>
                    </div>
                </div>
            </div>



            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Despesa</span>
                        <span class="info-box-number">
                            {{ number_format($dispensas->sum('valor') + $dispensas->sum('valor_variavel'), 2) . 'MT' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Distribuições</span>
                        <span class="info-box-number">{{ $distribuicaos->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-list"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Projectos</span>
                        <span class="info-box-number">{{ $projectos->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3">
                                    <form action="{{ route('recuperar') }}" method="get">
                                        <div class="card-header">
                                            <h3 class="card-title">Projectos</h3>
                                            <div class="card-tools">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="1980" max="{{ date('Y') }}"
                                                        name="ano" placeholder="Pesquisar por ano">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn bg-lightblue">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Acronimo</th>
                                                        <th>Valor Desembolsado</th>
                                                        <th>Valor Dispensado</th>
                                                        <th>Saldo</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dados as $projecto)
                                                                                            @php
                                                                                                $saldo = $projecto[1];
                                                                                                $statusClass = $saldo <= 0 ? 'btn-danger' : 'btn-success';
                                                                                                $statusText = $saldo <= 0 ? 'Negativo' : 'Positivo';
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td>{{ $projecto[0] }}</td>
                                                                                                <td>{{ number_format($projecto[3]) . 'MT' }}</td>
                                                                                                <td>{{ number_format($projecto[2]) . 'MT' }}</td>
                                                                                                <td>{{ number_format($saldo, 2) . 'MT' }}</td>
                                                                                                <td>
                                                                                                    <button class="btn {{ $statusClass }} text-white">
                                                                                                        {{ $statusText }}
                                                                                                    </button>
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
<!--
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Delegação</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fonte</th>
                            <th>Projecto</th>
                            <th>Valor Alocado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finSoma as $entidade)
                            <tr>
                                <td>{{ $entidade->name }}</td>
                                <td>{{ $entidade->acronimo }}</td>
                                <td>{{ number_format($entidade->total, 2) . ' MT' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>Total: </td>
                            <td>{{ number_format($finSoma->sum('total'), 2) . ' MT' }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
-->
        @endsection
    @endcan