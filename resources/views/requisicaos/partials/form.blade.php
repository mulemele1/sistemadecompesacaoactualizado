<style>
    .btn-custom {
        width: 70px;
        height: 30px;
        margin-top: 6px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 10px;
    }

    .button-container {
        display: flex;
        margin-top: 2px;
    }
</style>

<div class="row mb-3">
    <div class="col-12 button-container">
        <!--<button onclick="window.history.back();" class="btn btn-secondary btn-custom" style="margin-right: 10px;">Voltar</button>-->
    </div>
</div>

@csrf
<div class="card-body">
    @include('requisicaos.partials.validations') 

    <div class="form-group">
        <label for="recepcao_id">Recepção</label>
        <select class="form-control" name="recepcao_id">
            @foreach ($recepcaos as $recepcao)
                <option value="{{ $recepcao->id }}" {{ (isset($administracao) && $administracao->recepcao_id == $recepcao->id) ? 'selected' : '' }}>
                    {{ $recepcao->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="projecto_id">Projecto</label>
        <select class="form-control" name="projecto_id">
            @foreach ($projectos as $projecto)
                <option value="{{ $projecto->id }}" {{ (isset($administracao) && $administracao->projecto_id == $projecto->id) ? 'selected' : '' }}>
                    {{ $projecto->acronimo }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="administracao_id">Entidade requerida</label>
        <select class="form-control" name="administracao_id">
            @foreach ($administracaos as $administracao)
                <option value="{{ $administracao->id }}" {{ (isset($administracao) && $administracao->administracao_id == $administracao->id) ? 'selected' : '' }}>
                    {{ $administracao->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="text" name="valor" value="{{ $requisicao->valor ?? old('valor') }}" class="form-control" id="valor"
            placeholder="Enter valor">
    </div>

    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-secondary">Salvar</button>
        <a href="{{ route('requisicaos.list') }}" class="btn btn-default">Cancelar</a>
    </div>