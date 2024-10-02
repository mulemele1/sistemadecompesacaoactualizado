@extends('adminlte::page')

@section('title', 'Editar fonte')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $fonte->name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('fontes.update', $fonte->id) }} " method="post">
                    @method('put')
                    @include('fontes.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
