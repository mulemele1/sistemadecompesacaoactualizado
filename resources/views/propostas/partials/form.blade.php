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
    </style>   
    
    <div class="row mb-3">
        <div class="col-12 button-container">
            <!--<button onclick="window.history.back();" class="btn btn-secondary btn-custom" style="margin-right: 10px;">Voltar</button>-->
        </div>
    </div>



@csrf
<div class="card-body">
    @include('propostas.partials.validations')
    
    <!-- Remova o campo de número da proposta -->
    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea name="descricao" class="form-control" id="descricao" placeholder="Digite a descrição" readonly>VALOR DE COMPENSAÇÃO</textarea>
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
                <option value="" selected></option>
                @foreach ($projectos as $projecto)
                    <option value="{{ $projecto->id }}"> {{ $projecto->acronimo }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="valor_requisicao">Valor de Requisição</label>
        <input type="number" name="valor_requisicao" value="{{ old('valor_requisicao') }}" class="form-control" id="valor_requisicao"
            placeholder="Coloque o valor de Requisição">
    </div>
    <div class="form-group">
        <label for="data">Data da Proposta</label>
        <input type="date" name="data_prop" value="{{ old('data_prop') }}" class="form-control"
            id="data" placeholder="Digite a data">
    </div>
    <!--
    <label for="status">Estado da Proposta</label>
    <select name="status" class="form-control" id="status">
        <option value="Aprovada" {{ (isset($proposta) && $proposta->status == 'Aprovada') ? 'selected' : '' }}>Aprovada</option>
        <option value="Nao aprovada" {{ (isset($proposta) && $proposta->status == 'Nao aprovada') ? 'selected' : '' }}>Nao aprovada</option>
    </select>
    -->
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-secondary">Salvar</button>
    <a href="{{ route('propostas.list') }}" class="btn btn-default">Cancelar</a>
</div>
