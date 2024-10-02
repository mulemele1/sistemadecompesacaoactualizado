@extends('adminlte::page')

@section('title', 'Lista de Modal')

@section('content')

@csrf
<div class="card-body">
    @include('desembolsodafs.partials.validations')
<!-- Modal de Aprovação -->
<div class="modal" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">APROVAR DESEMBOLSO DA DAF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approveForm">
                    <div class="form-group mb-">
                        <label for="administracao_id">Entidade</label>
                        <input type="text" class="form-control" id="administracao_id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuário</label>
                        <input type="text" class="form-control" id="usuario" readonly>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="text" class="form-control" id="valor" readonly>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentário</label>
                        <textarea class="form-control" id="comentario" placeholder="Comentário"></textarea>
                    </div>
                    <input type="hidden" id="desembolso_id"> <!-- Campo oculto para o ID -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="confirmApprove()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
