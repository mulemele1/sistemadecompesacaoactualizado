@extends('adminlte::page')

@section('title', 'SysComp')

<!-- Verifica se o usuário não é administrador -->
@cannot('is_admin')
@section('content')
    <div class="welcome-message mt-3">
        <h2 class="text-primary text-center">Bem-vindo ao Sistema de Compensação!</h2>

        <!-- Título do Relatório -->
<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-info text-center">
            <h5>
                <!-- Exibe a data atual -->
                <p class="text-muted">Hoje é <strong id="data-atual">{{ ucfirst(\Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d/m/Y')) }}</strong></p>

                
                <!-- Exibe a hora com efeito de livro de calendário, mantendo os dois pontos fixos -->
                <div class="text-muted d-flex justify-content-center align-items-center">
                    <div id="hora" class="calendar-box"></div>
                    <span class="separator">:</span>
                    <div id="minuto" class="calendar-box"></div>
                    <span class="separator">:</span>
                    <div id="segundo" class="calendar-box"></div>
                </div>
            </h5>
        </div>
    </div>
</div>

<style>
    /* Estilo para os números do "livro de calendário" */
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
        position: relative;
        transform-style: preserve-3d;
    }

    /* Estilo para os dois pontos entre os números */
    .separator {
        font-size: 2em;
        font-weight: bold;
        margin: 0 5px;
        color: #333;
    }

    /* Efeito de rotação para simular a troca de página 
    .flip {
        animation: flip 0.5s ease;
    }
*/
    /* Animação de flip para os números */
    @keyframes flip {
        0% {
            transform: rotateX(0deg);
        }
        50% {
            transform: rotateX(-90deg);
        }
        100% {
            transform: rotateX(0deg);
        }
    }
</style>

<script>
    // Função para atualizar a hora em tempo real com efeito de "livro de calendário"
    function atualizarHora() {
        const agora = new Date();
        const horas = agora.getHours().toString().padStart(2, '0');
        const minutos = agora.getMinutes().toString().padStart(2, '0');
        const segundos = agora.getSeconds().toString().padStart(2, '0');

        // Atualiza os elementos HTML para cada unidade de tempo e aplica o efeito flip
        atualizarElemento('hora', horas);
        atualizarElemento('minuto', minutos);
        atualizarElemento('segundo', segundos);
    }

    // Função auxiliar para aplicar o efeito flip somente quando o valor muda
    function atualizarElemento(id, novoValor) {
        const elemento = document.getElementById(id);
        if (elemento.textContent !== novoValor) {
            elemento.textContent = novoValor;
            elemento.classList.add('flip');

            // Remove a classe flip após a animação terminar
            setTimeout(() => {
                elemento.classList.remove('flip');
            }, 500);
        }
    }

    // Atualiza a hora a cada segundo
    setInterval(atualizarHora, 1000);

    // Exibe a hora imediatamente
    atualizarHora();
</script>

        <p class="text-info text-center">Explore os recursos e aproveite ao máximo sua experiência!</p>
        <p class="text-success text-center">Vamos começar a sua jornada com o sistema!</p>
    </div>
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
                    <span class="info-box-number">{{ number_format($dispensas->sum('valor') + $dispensas->sum('valor_variavel'), 2) . 'MT' }}</span>
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
                                                <input type="number" class="form-control" min="1980" max="{{ date('Y') }}" name="ano" placeholder="Pesquisar por ano">
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
