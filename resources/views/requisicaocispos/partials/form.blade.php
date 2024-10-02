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

<!-- Botão de voltar removido, mas pode ser descomentado para uso futuro -->
<div class="row mb-3">
    <div class="col-12 button-container">
        <!--<button onclick="window.history.back();" class="btn btn-secondary btn-custom" style="margin-right: 10px;">Voltar</button>-->
    </div>
</div>

@csrf
<div class="card-body">
    @include('requisicaocispos.partials.validations') <!-- Inclui as validações parciais, se necessário -->

    
    <!-- Campo de seleção 'Administração' -->
    <div class="form-group">
        <label for="administracao_id">Administração</label>
        <select class="form-control" name="administracao_id" id="administracao_id">
            @foreach ($administracaos as $administracao)
                <option value="{{ $administracao->id }}" {{ (old('administracao_id') == $administracao->id || (isset($requisicao) && $requisicao->administracao_id == $administracao->id)) ? 'selected' : '' }}>
                    {{ $administracao->nome }}
                </option>
            @endforeach
        </select>
    </div>
  

    <!-- Campo de seleção 'Projecto' -->
    <div class="form-group">
        <label for="projecto_id">Projecto</label>
        <select class="form-control" name="projecto_id" id="projecto_id">
            @foreach ($projectos as $projecto)
                <option value="{{ $projecto->id }}" {{ (old('projecto_id') == $projecto->id || (isset($requisicao) && $requisicao->projecto_id == $projecto->id)) ? 'selected' : '' }}>
                    {{ $projecto->acronimo }}
                </option>
            @endforeach
        </select>
    </div>
  <!-- Campo de seleção 'Orçado a' -->
  <div class="form-group">
        <label for="gerencia_id">Entidade requerida</label>
        <select class="form-control" name="gerencia_id" id="gerencia_id">
            @foreach ($gerencias as $recepcao)
                <option value="{{ $recepcao->id }}" {{ (old('gerencia_id') == $recepcao->id || (isset($requisicao) && $requisicao->recepcao_id == $recepcao->id)) ? 'selected' : '' }}>
                    {{ $recepcao->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Campo de entrada de 'Valor' -->
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="text" name="valor" value="{{ $requisicao->valor ?? old('valor') }}" class="form-control" id="valor" placeholder="Insira o valor">
    </div>
</div>
<!-- /.card-body -->

<!-- Botões de submissão -->
<div class="card-footer">
    <button type="submit" class="btn btn-secondary">Salvar</button>
    <a href="{{ route('requisicaocispos.list') }}" class="btn btn-default">Cancelar</a>
</div>
