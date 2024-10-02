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
    @include('desembolsodafs.partials.validations') 
    <div class="form-group">
        <label for="daf_id">Fonte</label>
        <select class="form-control" name="daf_id">
            @foreach ($gestaos as $administracao)
                <option value="{{ $administracao->id }}" {{ (isset($desembolsodaf) && $desembolsodaf->daf_id == $administracao->id) ? 'selected' : '' }}>
                    {{ $administracao->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="projecto_id">Projecto</label>
        <select class="form-control" name="projecto_id">
            @foreach ($projectos as $projecto)
                <option value="{{ $projecto->id }}" {{ (isset($desembolsodaf) && $desembolsodaf->projecto_id == $projecto->id) ? 'selected' : '' }}>
                    {{ $projecto->acronimo }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="administracao_id">Orcado a</label>
        <select class="form-control" name="administracao_id">
            @foreach ($gerencias as $recepcao)
                <option value="{{ $recepcao->id }}" {{ (isset($desembolsodaf) && $desembolsodaf->administracao_id == $recepcao->id) ? 'selected' : '' }}>
                    {{ $recepcao->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="text" name="valor" value="{{ $desembolsodaf->valor ?? old('valor') }}" class="form-control" id="valor" placeholder="Enter valor">
    </div>
    <div class="form-group">
        <label for="data">Data do desembolsodaf</label>
        <input type="date" name="data" value="{{ $desembolsodaf->data ?? old('data') }}" class="form-control" id="data" placeholder="Digite a data">
    </div>

    <div class="form-group">
        <label for="status">Estado</label>
        <select class="form-control" name="status" id="status" onchange="atualizarEstado()" required>
            <!--<option value="">Selecione o Estado</option>-->
            <option value="PENDENTE" {{ (isset($desembolsodaf) && $desembolsodaf->status == 'PENDENTE') ? 'selected' : '' }}>PENDENTE</option>
            <option value="APROVADO" {{ (isset($desembolsodaf) && $desembolsodaf->status == 'APROVADO') ? 'selected' : '' }}>APROVADO</option>
            <option value="NAO APROVADO" {{ (isset($desembolsodaf) && $desembolsodaf->status == 'NAO APROVADO') ? 'selected' : '' }}>NÃO APROVADO</option>
            </select>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-secondary">Salvar</button>
    <a href="{{ route('desembolsodafs.list') }}" class="btn btn-default">Cancelar</a>
</div>

<script>
    function atualizarEstado() {
        var select = document.getElementById('status');
        var selectedValue = select.value;

        // Remover classes anteriores
        select.classList.remove('estado-aprovado', 'estado-nao-aprovado', 'estado-pendente');

        // Adicionar a classe baseada no valor selecionado
        if (selectedValue === 'APROVADO') {
            select.classList.add('estado-aprovado');
        } else if (selectedValue === 'NAO APROVADO') {
            select.classList.add('estado-nao-aprovado');
        } else if (selectedValue === 'PENDENTE') {
            select.classList.add('estado-pendente');
        }
    }

    // Chamar a função ao carregar a página, para aplicar a classe correta se já houver um estado selecionado
    window.onload = function() {
        atualizarEstado();
    };
</script>