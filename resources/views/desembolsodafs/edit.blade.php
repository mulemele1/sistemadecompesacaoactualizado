@extends('adminlte::page')

@section('title', 'Editar desembolso')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $desembolsodaf->id }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('desembolsodafs.update', $desembolsodaf->id) }} " method="post">
                    @method('put')
                    @include('desembolsodafs.partials.form')
                </form> 
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
