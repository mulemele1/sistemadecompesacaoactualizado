@extends('adminlte::page')

@section('title', 'Adicionar Participante')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <h3 class="card-title">Novo Participante</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('participantes.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <!-- Validações de erro -->
                        @include('participantes.partials.validations')

                        <!-- Campo Código -->
                        <div class="form-group">
                            <label for="codigo">ID do Participante</label>
                            <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control" id="codigo" placeholder="Insira o ID do Participante" required>
                        </div>

                        <!-- Campo Projecto -->
                        <div class="form-group">
                            <label for="projecto_id">Projecto</label>
                            <select class="form-control" name="projecto_id" id="projecto_id" required>
                                <option value="">Selecione um Projeto</option>
                                @foreach ($projectos as $projecto)
                                    <option value="{{ $projecto->id }}">{{ $projecto->acronimo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">Salvar</button>
                        <a href="{{ route('participantes.list') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
