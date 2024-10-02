@extends('adminlte::page')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@section('title', 'SysComp')

@section('content_header')
    <div class="row">
        <div class="col-md-10">
            <h1 class="m-0 text-dark">Landing Page</h1>
        </div>
        <div class="col-md-2">
            <div class="btn-group">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-default">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-default">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn btn-default">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
@stop
@section('content')
    <div>
    </div>
    {{-- <div class="col-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                </p>
            </div>

            <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                </span>
                <span>
                    <i class="fas fa-square text-gray"></i> Last year
                </span>
            </div>
        </div>
    </div>
</div> --}}
@stop
