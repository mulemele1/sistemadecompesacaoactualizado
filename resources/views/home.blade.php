@extends('adminlte::page')

@section('title', 'SysComp')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard Principal</h1>
    <div class="welcome-message mt-3">
        <h2 class="text-primary">Bem-vindo ao Sistema de Compensação!</h2>
        <p class="text-muted">Hoje é <strong>{{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d/m/Y') }}</strong>.</p>

        <p class="text-info">Explore os recursos e aproveite ao máximo sua experiência com o sistema!</p>
        <!--<p class="text-success">Caso tenha alguma dúvida, sinta-se à vontade para consultar nossa seção de ajuda ou entrar em contato com o suporte.</p>
        <p class="text-success">Vamos começar a sua jornada com o sistema!</p>-->
    </div>
@stop



