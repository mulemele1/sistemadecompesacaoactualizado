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

<div class="container">
    @yield('content')
</div>
@csrf

<div class="card-body">
    @include('projectos.partials.validations')
    <form id="projectForm" onsubmit="return false;">
        <div class="form-group">
            <label for="acronimo">Acrônimo</label>
            <input type="text" name="acronimo" value="{{ $projecto->acronimo ?? old('acronimo') }}" class="form-control" id="acronimo"
                placeholder="Digite o Acronimo">
        </div>

        <div class="form-group">
            <label for="fonte_id">Financiador</label>
            <select class="form-control" name="fonte_id" id="fonte_id">
                @if (isset($fonte))
                    <option value="{{ $fonte->id }}" selected>{{ $fonte->name }}</option>
                @endif
                @foreach ($fontes as $item)
                    <option value="{{ $item->id }}" {{ isset($fonte) && $fonte->id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="valor_orcamental">Valor Orçamental</label>
            <input type="number" name="valor_orcamental" value="{{ $projecto->valor_orcamental ?? old('valor_orcamental') }}" class="form-control" id="valor_orcamental"
                placeholder="Coloque o Valor Orçamental">
        </div>
        <div class="form-group">
            <label for="valor_participante">Valor por Participante</label>
            <input type="number" name="valor_participante" value="{{ $projecto->valor_participante ?? old('valor_participante') }}" required class="form-control" id="valor_participante"
                placeholder="Coloque o Valor por participante">
        </div>

        <div class="form-group">
            <label for="valor_nao_programado">Valor da visita não programada</label>
            <input type="number" name="valor_nao_programado" value="{{ $projecto->valor_nao_programado ?? old('valor_nao_programado') }}" required class="form-control" id="valor_nao_programado"
                placeholder="Coloque o Valor da visita não programada">
        </div>

        <div class="form-group">
            <label for="data">Data de fim do  Projeto</label>
            <input type="date" name="data_prevista_termino" value="{{ $projecto->data_prevista_termino ?? old('data_prevista_termino') }}" class="form-control" id="data_prevista_termino"
            placeholder="Digite a data do fim do Projecto">
        </div>
        <!--<div class="form-group">
            <label for="status">Estado do Projeto</label>
            <select name="status" class="form-control" id="status">
                <option value="ATIVO" {{ (isset($projecto) && $projecto->status == 'ATIVO') ? 'selected' : '' }}>Ativo</option>
                <option value="INATIVO" {{ (isset($projecto) && $projecto->status == 'INATIVO') ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>-->
        <button type="submit" class="btn btn-secondary" onclick="salvar()">Salvar</button>
        <a href="{{ route('projectos.list') }}" class="btn btn-default">Cancelar</a>
    </form>
</div>
<!-- /.card-body -->

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script>
    function salvar() {
        // Aqui você pode adicionar a lógica para salvar os dados no servidor
        // Por exemplo, usando AJAX ou um formulário HTML normal

        // Simulando um envio bem-sucedido
        Swal.fire({
            title: "Salvo",
            text: "Bom trabalho!",
            icon: "success",
            timer: 15000
        }).then((result) => {
            if (result.isConfirmed) {
                // Aqui você pode redirecionar ou realizar outra ação após clicar em OK
                console.log("Usuário clicou em OK");
                
                // Exemplo: redirecionar para outra página
                // window.location.href = '/outra-pagina';
            }
        });
    }
</script>