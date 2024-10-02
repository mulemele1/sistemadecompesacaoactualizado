<style>
    .btn-custom {
        width: 70px; /* ajuste conforme necessário */
        height: 30px;
        margin-top: 6px; /* ajuste a distância para baixo */
        margin-right: 10px; /* espaço entre os botões */
        display: flex; /* usa flexbox para alinhar os botões */
        justify-content: center; /* centraliza horizontalmente */
        align-items: center; /* centraliza verticalmente */
    }
    .button-container {
        display: flex; /* usa flexbox para alinhar os botões */
        margin-top: 2px; /* ajusta a distância para baixo */
    }
</style>

<div class="row mb-3">
    <div class="col-12 button-container">
        <!-- Botão Voltar descomentado 
        <button onclick="window.history.back();" class="btn btn-secondary btn-custom">Voltar</button>
        -->
    </div>
</div>

@csrf
<div class="card-body">
    @include('gerencias.partials.validations') 
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" value="{{ $gestao->name ?? old('name') }}" class="form-control" id="name"
            placeholder="Digite o nome" required>
    </div>
</div> 
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-secondary" onclick="salvar()">Salvar</button>
    <a href="{{ route('gerencias.list') }}" class="btn btn-default">Cancelar</a>
</div>

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
            icon: "success"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirecionar para a página de listagem
                window.location.href = '/pagina-de-listagem'; // Altere para a URL da sua página de listagem
            }
        });
    }
</script>