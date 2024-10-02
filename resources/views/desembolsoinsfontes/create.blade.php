@extends('adminlte::page')

@section('title', 'Realizar desembolsoinsfontes')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo desembolso</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('desembolsoinsfontes.store') }}" method="post">
                    @csrf
                    @include('desembolsoinsfontes/partials/form')
                </form>
            </div> 
            <!-- /.card -->
        </div>
    </div>
@endsection
