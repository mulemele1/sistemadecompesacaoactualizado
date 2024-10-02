<style>  
    .btn-custom {
        width: 70px; /* ajuste conforme necessário */
        height: 30px;
        margin-top: 6px; /* ajuste a distância para baixo */
        justify-content: center; /* centraliza horizontalmente */
        align-items: center; /* centraliza verticalmente */
        display: flex; /* usa flexbox para alinhar os botões */
        margin-right: 10px; /* espaço entre os botões */
    }

    .button-container {
        display: flex; /* usa flexbox para alinhar os botões */
        margin-top: 2px; /* ajusta a distância para baixo */
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input, .form-group select {
        margin-bottom: 10px; /* Adiciona espaçamento inferior */
    }
</style>

<div class="row mb-3">
    <div class="col-12 button-container">
        <!--<button onclick="window.history.back();" class="btn btn-secondary btn-custom" style="margin-right: 10px;">Voltar</button>-->
    </div>
</div>

<form action="{{ route('participantes.store') }}" method="POST">
    @csrf

    <div class="card-body">
        <!-- Validações de erro -->
        @include('participantes.partials.validations')

        <!-- Campo Código -->
        <div class="form-group">
            <label for="codigo">ID do Participante</label>
            <input type="text" name="codigo" value="{{ $participante->codigo ?? old('codigo') }}" class="form-control" id="codigo" placeholder="Insira o ID do Participante">
        </div>

        <!-- Campo Projecto -->
        <div class="form-group">
            <label for="projecto_id">Projecto</label>
            <select class="form-control" name="projecto_id" id="projecto_id">
            @foreach ($participante->projecto)
                    <option value="{{ $participante->projecto->id }}" selected>{{ $participante->projecto->acronimo }}</option>
            @endforeach

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
