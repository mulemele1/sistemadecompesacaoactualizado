@extends('adminlte::page')

@section('title', 'Realizar Desembolso')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo desembolso DAF</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('desembolsodafs.store') }}" method="post">
                    @csrf
                    @include('desembolsodafs/partials/form')
                </form>
            </div> 
            <!-- /.card -->
        </div>
    </div>
@endsection
