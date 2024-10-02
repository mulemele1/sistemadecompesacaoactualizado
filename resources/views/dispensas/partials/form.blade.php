<script>
    // Função para alternar os campos de valor
    function toggleValorFields() {
        const valorInput = document.getElementById('valor_input');
        const variavelInput = document.getElementById('variavel_input');
        const especialInput = document.getElementById('especial_input');
        const valorField = document.getElementById('valor');
        const valorVariavelField = document.getElementById('valor_variavel');
        const valorEspField = document.getElementById('valor_esp');
        const motivoField = document.getElementById('motivo');
        const motivoEspField = document.getElementById('motivo_esp');

        // Limpa os campos ao selecionar um novo radio button
        valorField.value = '0.00';
        motivoField.value = '';
        valorVariavelField.value = '0.00';
        motivoEspField.value = '';
        valorEspField.value = '0.00';

        // Se o campo "Valor da visita" estiver selecionado
        if (document.getElementById('valor_visita').checked) {
            valorInput.style.display = 'block';
            variavelInput.style.display = 'none';
            especialInput.style.display = 'none';
            valorField.readOnly = false; // Permite edição
        } 
        // Se o campo "Valor da visita não programada" estiver selecionado
        else if (document.getElementById('valor_esp').checked) {
            valorInput.style.display = 'none';
            variavelInput.style.display = 'none';
            especialInput.style.display = 'block';
            valorEspField.value = 'Valor automático'; // Substitua pelo valor real
            valorEspField.readOnly = true; // Impede edição
        } 
        // Se o campo "Valor variável" estiver selecionado
        else if (document.getElementById('valor_variado').checked) {
            valorInput.style.display = 'none';
            variavelInput.style.display = 'block';
            especialInput.style.display = 'none';
            valorVariavelField.readOnly = false; // Permite edição
        } 
        // Se nenhum campo estiver selecionado
        else {
            valorInput.style.display = 'none';
            variavelInput.style.display = 'none';
            especialInput.style.display = 'none';
        }
    }

    // Função para atualizar o valor automaticamente baseado no projeto selecionado
    function updateInputValue(selectElement) {
        const selectedProjectId = selectElement.value;
        const projectValues = {
            1: { valor: '100.00', saldo: true }, // Exemplo: ID do projeto 1
            2: { valor: '0.00', saldo: false }, // Exemplo: ID do projeto 2
            // Adicione mais IDs e valores conforme necessário
        };

        const valorField = document.getElementById('valor');
        
        if (projectValues[selectedProjectId]) {
            valorField.value = projectValues[selectedProjectId].valor;
            
            // Alerta se não houver saldo
            if (!projectValues[selectedProjectId].saldo) {
                alert(`O PROJECTO ${selectElement.options[selectElement.selectedIndex].text} não tem Valor para participante.`);
            }
        } else {
            valorField.value = '0.00'; // Valor padrão se o projeto não tiver um valor definido
        }
    }

    // Inicializa o formulário com o valor da visita selecionado
    window.onload = function() {
        document.getElementById('valor_visita').checked = true;
        toggleValorFields(); // Chama a função para exibir o campo correto
    }
</script>

@csrf
<div class="card-body">
    @include('requisicaos.partials.validations')
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projecto">Projecto</label>
                <select class="form-control" id="projecto" name="projecto_id" onchange="updateInputValue(this)">
                    <option value="" class="placeholder-option">Selecione o projecto</option>
                    @if (isset($projecto))
                        <option value="{{ $projecto->id }}" selected>{{ $projecto->acronimo }}</option>
                    @endif
                    @foreach ($projectos as $proj)
                        <option value="{{ $proj->id }}">{{ $proj->acronimo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="recepcao">Recepção</label>
                <select class="form-control" id="recepcao" name="recepcao_id">
                    <option value="" class="placeholder-option">Selecione a Recepção</option>
                    @if (isset($recepcao))
                        <option value="{{ $recepcao->id }}" selected>{{ $recepcao->name }}</option>
                    @endif
                    @foreach ($recepcaos as $rec)
                        <option value="{{ $rec->id }}">{{ $rec->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="participante">Participante</label>
                <select class="form-control" id="participante" name="participante_id">
                    <option value="" class="placeholder-option">Selecione o participante</option>
                    @if (isset($participante))
                        <option value="{{ $participante->id }}" selected>{{ $participante->codigo }}</option>
                    @endif
                    @foreach ($participantes as $part)
                        <option value="{{ $part->id }}">{{ $part->codigo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="visita">Visita</label>
                <input type="text" name="visita" id="visita" value="{{ $dispensa->visita ?? old('visita') }}" class="form-control" placeholder="Escreva a visita">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Tipo de Valor</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_valor" id="valor_visita" value="visita" onchange="toggleValorFields()">
                <label class="form-check-label" for="valor_visita">Valor da visita</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_valor" id="valor_esp" value="especial" onchange="toggleValorFields()">
                <label class="form-check-label" for="valor_especial">Valor da visita não programada</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_valor" id="valor_variado" value="variado" onchange="toggleValorFields()">
                <label class="form-check-label" for="valor_variado">Valor variável</label>
            </div>
        </div>
    </div>

    <div class="row" id="valor_input" style="display:none;">
        <div class="col-md-6">
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" name="valor" id="valor" value="{{ $dispensa->valor ?? old('valor') }}" class="form-control" placeholder="Escreva o valor" readonly>
            </div>
        </div>
    </div>

    <div class="row" id="especial_input" style="display:none;">
        <div class="col-md-6">
            <div class="form-group">
                <label for="valor_esp">Valor Especial</label>
                <input type="text" name="valor_esp" id="valor_esp" class="form-control" placeholder="Escreva o valor da visita não programada">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="motivo_esp">Motivo da visita não programada</label>
                <textarea name="motivo_esp" id="motivo_esp" class="form-control" placeholder="Escreva o motivo da visita não programada"></textarea>
            </div>
        </div>
    </div>

    <div class="row" id="variavel_input" style="display:none;">
        <div class="col-md-6">
            <div class="form-group">
                <label for="valor_variavel">Valor da visita não programada</label>
                <input type="text" name="valor_variavel" id="valor_variavel" value="{{ $dispensa->valor_variavel ?? old('valor_variavel') }}" class="form-control" placeholder="Escreva o valor da visita não programada">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="motivo">Motivo</label>
                <textarea name="motivo" id="motivo" class="form-control" placeholder="Escreva o motivo">{{ $dispensa->motivo ?? old('motivo') }}</textarea>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-secondary">Salvar</button>
    <a href="{{ route('dispensas.list') }}" class="btn btn-default">Cancelar</a>
</div>
