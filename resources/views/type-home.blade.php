@extends('adminlte::page')

@section('title', 'SysComp')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    <div class="welcome-message mt-3">
        <h2 class="text-primary">Bem-vindo ao Sistema de Compensação!</h2>
        <p class="text-muted">Hoje é <strong>{{ \Carbon\Carbon::now()->format('l, d/m/Y') }}</strong>.</p>
        <p class="text-info">Estamos felizes em tê-lo aqui. Explore os recursos e aproveite ao máximo sua experiência!</p>
        <p class="text-warning">Caso tenha alguma dúvida, sinta-se à vontade para consultar nossa seção de ajuda ou entrar em contato com o suporte.</p>
        <p class="text-success">Vamos começar a sua jornada com o sistema!</p>
    </div>
@stop

