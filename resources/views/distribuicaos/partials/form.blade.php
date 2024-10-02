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
    @include('distribuicaos.partials.validations')
    <div class="form-group">
        <label for="name">Administração</label>
        <select class="form-control" name="administracao_id">
            @if (isset($administracao))
                <option value="{{ $administracao->id }}" selected> {{ $administracao->nome }}</option>
                @foreach ($administracaos as $administracao)
                    <option value="{{ $administracao->id }}"> {{ $administracao->nome }}</option>
                @endforeach
            @else
                @foreach ($administracaos as $administracao)
                    <option value="{{ $administracao->id }}"> {{ $administracao->nome }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="projecto_id">Projecto</label>
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

    <div class="form-group">
        <label for="recepcao_id">Recepcao</label>
        <select class="form-control" name="recepcao_id">
            @if (isset($recepcao))
                <option value="{{ $recepcao->id }}" selected> {{ $recepcao->name}}</option>
                @foreach ($recepcaos as $recepcao)
                    <option value="{{ $recepcao->id }}"> {{ $recepcao->name}}</option>
                @endforeach
            @else
                @foreach ($recepcaos as $recepcao)
                    <option value="{{ $recepcao->id }}"> {{ $recepcao->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="text" name="valor" value="{{ $distribuicao->valor ?? old('valor') }}" class="form-control"
            id="valor" placeholder="Enter valor">
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-secondary">Salvar</button>
    <a href="{{ route('distribuicaos.list') }}" class="btn btn-default">Cancelar</a>
</div>
