<style>  
  .btn-custom {
    width: 70px; /* ajuste conforme necessário */
    height: 30px;
    margin-top: 6px; /* ajuste a distância para baixo */
    justify-content: center; /* centraliza horizontalmente */
    align-items: center; /* centraliza verticalmente /*
    display: flex; /* usa flexbox para alinhar os botões */
    margin-right: 10px; /* espaço entre os botões */
    }
    .button-container {
    display: flex; /* usa flexbox para alinhar os botões */
    margin-top: 2px; /* ajusta a distância para baixo */
    }
</style>

<div class="row mb-3">
    <div class="col-12 button-container">
        <!--<button onclick="window.history.back();" class="btn btn-secondary btn-custom" style="margin-right: 10px;">Voltar</button>-->
    </div>
</div>

@csrf

<div class="card-body">

    @include('participantes.partials.validations')

    <div class="form-group">

        <label for="codigo">Código</label>

        <input type="text" name="codigo" value="{{ $participante->codigo ?? old('codigo') }}" class="form-control"

        id="codigo" placeholder="Enter codigo">

    </div>

    <div class="form-group">

        <label for="name">Projecto</label>

        <select class="form-control" name="projecto_id">

            @if (isset($projecto))

            <option value="{{ $projecto->id }}" selected> {{ $projecto->acronimo }}</option>

            @foreach ($projectos as $projecto)

            <option value="{{ $projecto->id }}"> {{ $projecto->acronimo }}</option>

            @endforeach

            @else

            @foreach ($projectos as $projecto)

            <option value="{{ $projecto->id }}"> {{ $projecto->acronimo }}</option>

            @endforeach

            @endif

        </select>

    </div>

</div>

<!-- /.card-body -->

<div class="card-footer">

<button type="submit" class="btn btn-secondary">Salvar</button>
<a href="{{ route('participantes.list') }}" class="btn btn-default">Cancelar</a>

</div>

