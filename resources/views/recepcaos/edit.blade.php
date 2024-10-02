@extends('adminlte::page')

@section('title', 'Editar recepções')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Editar:{{ $recepcao->name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action=" {{ route('recepcaos.update', $recepcao->id) }} " method="post">
                    @method('put')
                    @include('recepcaos.partials.form')
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
