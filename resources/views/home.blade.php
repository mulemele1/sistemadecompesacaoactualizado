@extends('adminlte::page')

@section('title', 'SysComp')

@cannot('is_admin')
@section('content')
<div class="container mt-3">
<h2 class="text-primary text-center">Bem-vindo ao Sistema de Compensação!</h2>
    <!-- Seção de botões -->
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-4 col-4">
            <a href="participantes/create" class="link-card">
                <div class="card azul">
                    <h3 class="card-title">ADICIONAR NOVO PARTICIPANTE</h3>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-4">
        <a href="dispensas/create" class="link-card">
                <div class="card rosa">
                    <h3 class="card-title">ADICIONAR NOVA DESPESA</h3>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-4">
            
        <a href="requisicaos/create" class="link-card">
                <div class="card azul-escuro">
                    <h3 class="card-title">REQUISIÇÃO DA RECEPÇÃO</h3>
                </div>
            </a>
        </div>
    </div>


    <div class="row align-items-center">
        <!-- Texto à esquerda -->
        <div class="col-md-12">
            <div class="welcome-message">
                
                <div class="alert alert-info text-center mt-4">
                    <h5>
                        <p class="text-muted">
                            Hoje é <strong id="data-atual">{{ ucfirst(\Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d/m/Y')) }}</strong>
                        </p>
                        <div class="text-muted d-flex justify-content-center align-items-center">
                            <div id="hora" class="calendar-box"></div>
                            <span class="separator">:</span>
                            <div id="minuto" class="calendar-box"></div>
                            <span class="separator">:</span>
                            <div id="segundo" class="calendar-box"></div>
                        </div>
                    </h5>
                </div>
                <p class="text-info text-center">Explore os recursos e aproveite ao máximo sua experiência!</p>
                <p class="text-success text-center">Vamos começar a sua jornada com o sistema!</p>
            </div>
        </div>

        <!-- Imagem à direita
        <div class="col-md-6 text-center">
            <img src="{{ asset('storage/criação-de-site-1.png') }}" alt="Design Responsivo" class="img-fluid h-30 w-100"
                style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        </div>
         -->
    </div>

    <!-- Gráfico de Pizza -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Relação da Recepção com as Despesas por Projeto</h3>
                </div>
                <div class="card-body">
                    <canvas id="recepcaoDespesasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .calendar-box {
        display: inline-block;
        width: 50px;
        height: 60px;
        background-color: #f8f9fa;
        color: #333;
        font-size: 2em;
        font-weight: bold;
        line-height: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin: 0 2px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .separator {
        font-size: 2em;
        font-weight: bold;
        margin: 0 5px;
        color: #333;
    }

    .card {
        margin: 10px auto;
        padding: 20px;
        height: 150px;
        border-radius: 10px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .card:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
        transform: scale(1.01);
    }

    .card-title {
        font-weight: 300;
        color: #ffffff;
        font-size: 1.2rem;
    }

    .link-card {
        text-decoration: none;
    }

    .azul {
        background: radial-gradient(#1fe4f5, #3fbafe);
    }

    .rosa {
        background: radial-gradient(#fbc1cc, #fa99b2);
    }

    .azul-escuro {
        background: radial-gradient(#76b2fe, #b69efe);
    }

    @media (max-width: 768px) {
        .card {
            height: 100px;
        }

        .card-title {
            font-size: 0.9rem;
        }

        .col-4 {
            max-width: 33.33%;
        }
    }

    .card {
        margin: 10px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
        transition: all 0.2s;
    }

    .card-title {
        font-weight: bold;
    }

    .link-card {
        text-decoration: none;
    }

    .azul {
        background: radial-gradient(#1fe4f5, #3fbafe);
    }

    .rosa {
        background: radial-gradient(#fbc1cc, #fa99b2);
    }

    .azul-escuro {
        background: radial-gradient(#76b2fe, #b69efe);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    
    function atualizarHora() {
        const agora = new Date();
        const horas = agora.getHours().toString().padStart(2, '0');
        const minutos = agora.getMinutes().toString().padStart(2, '0');
        const segundos = agora.getSeconds().toString().padStart(2, '0');
        atualizarElemento('hora', horas);
        atualizarElemento('minuto', minutos);
        atualizarElemento('segundo', segundos);
    }

    function atualizarElemento(id, novoValor) {
        const elemento = document.getElementById(id);
        if (elemento.textContent !== novoValor) {
            elemento.textContent = novoValor;
        }
    }

    setInterval(atualizarHora, 1000);
    atualizarHora();
</script>
@endsection
@endcannot


@section('content')
<div class="row">
    <!-- Verifica se o usuário é administrador -->
    @can('is_admin')

            @section('content_header')
            <h2 class="text-primary text-left">Bem-vindo ao Sistema de Compensação!</h2>
            <h1 class="m-0 text-dark">Dashboard</h1>
            @endsection

            <!-- Bloco de informação para Desembolso -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Desembolso</span>
                        <span class="info-box-number">{{ number_format($desembolsos->sum('valor'), 2) . 'MT' }}</span>
                    </div>
                </div>
            </div>

            <!-- Bloco de informação para Despesa -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-lightblue elevation-1">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Despesa</span>
                        <span
                            class="info-box-number">{{ number_format($dispensas->sum('valor') + $dispensas->sum('valor_variavel'), 2) . 'MT' }}</span>
                    </div>
                </div>
            </div>

            <div class="clearfix hidden-md-up"></div>

            <!-- Bloco de informação para Distribuições -->
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

            <!-- Bloco de informação para Projectos -->
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

        <!-- Tabela de Projectos -->
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
                                                <!-- Campo de pesquisa por ano -->
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
        @endsection
    @endcan