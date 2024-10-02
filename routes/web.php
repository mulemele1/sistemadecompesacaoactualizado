<?php

use App\Http\Controllers\{
    AdministracaoController,
    DashboardController,
    DesembolsoinsController,
    DesembolsoController,
    DesembolsoinsfonteController,
    DesembolsodafController,
    DispensaController,
    DistribuicaoController,
    FonteController,
    GraficoController,
    ParticipanteController,
    ProjectoController,
    RecepcaoController,
    UserController,
    PropostaController,
    RequisicaoController,
    GestaoController,
    GerenciaController,
    RequisicaocispoController,
    DashboarduserController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------k
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Gráficos
Route::get('/relatorios/projecto/anos', [GraficoController::class, 'projectoAnos'])->name('relatorios.projecto.anos');
Route::get('/relatorios/projecto/ano', [GraficoController::class, 'projectoAno'])->name('relatorios.projecto.ano');
Route::get('/relatorios/administracao/anos', [GraficoController::class, 'administracaoAnos'])->name('relatorios.administracao.anos');
Route::get('/relatorios/administracao/ano', [GraficoController::class, 'administracaoAno'])->name('relatorios.administracao.ano');
Route::get('/relatorios/recepcao/anos', [GraficoController::class, 'recepcaoAnos'])->name('relatorios.recepcao.anos');
Route::get('/relatorios/recepcao/ano', [GraficoController::class, 'recepcaoAno'])->name('relatorios.recepcao.ano');
Route::get('/relatorios/participanteDN/anoN', [GraficoController::class, 'participanteAnoDN'])->name('relatorios.participanteDN.anoN');
Route::get('/relatorios/participanteDV/anoV', [GraficoController::class, 'participanteAnoDV'])->name('relatorios.participanteDV.anoV');

//Cadastros
Route::delete('/projectos/{id}', [ProjectoController::class, 'delete'])->name('projectos.delete');
Route::put('/projectos/{id}', [ProjectoController::class, 'update'])->name('projectos.update');
Route::get('/projectos/{id}/edit', [ProjectoController::class, 'edit'])->name('projectos.edit');
Route::get('/projectos/list', [ProjectoController::class, 'list'])->name('projectos.list');
Route::get('/projectos/create', [ProjectoController::class, 'create'])->name('projectos.create');
Route::post('/projectos', [ProjectoController::class, 'store'])->name('projectos.store');
Route::get('/projectos/{id}', [ProjectoController::class, 'show'])->name('projectos.show');

Route::delete('/fontes/{id}', [FonteController::class, 'delete'])->name('fontes.delete');
Route::put('/fontes/{id}', [FonteController::class, 'update'])->name('fontes.update');
Route::get('/fontes/{id}/edit', [FonteController::class, 'edit'])->name('fontes.edit');
Route::get('/fontes/list', [FonteController::class, 'list'])->name('fontes.list');
Route::get('/fontes/create', [FonteController::class, 'create'])->name('fontes.create');
Route::post('/fontes', [FonteController::class, 'store'])->name('fontes.store');
Route::get('/fontes/{id}', [FonteController::class, 'show'])->name('fontes.show');

Route::delete('/gestaos/{id}', [GestaoController::class, 'delete'])->name('gestaos.delete');
Route::put('/gestaos/{id}', [GestaoController::class, 'update'])->name('gestaos.update');
Route::get('/gestaos/{id}/edit', [GestaoController::class, 'edit'])->name('gestaos.edit');
Route::get('/gestaos/list', [GestaoController::class, 'list'])->name('gestaos.list');
Route::get('/gestaos/create', [GestaoController::class, 'create'])->name('gestaos.create');
Route::post('/gestaos', [GestaoController::class, 'store'])->name('gestaos.store');
Route::get('/gestaos/{id}', [GestaoController::class, 'show'])->name('gestaos.show');

Route::delete('/gerencias/{id}', [GerenciaController::class, 'delete'])->name('gerencias.delete');
Route::put('/gerencias/{id}', [GerenciaController::class, 'update'])->name('gerencias.update');
Route::get('/gerencias/{id}/edit', [GerenciaController::class, 'edit'])->name('gerencias.edit');
Route::get('/gerencias/list', [GerenciaController::class, 'list'])->name('gerencias.list');
Route::get('/gerencias/create', [GerenciaController::class, 'create'])->name('gerencias.create');
Route::post('/gerencias', [GerenciaController::class, 'store'])->name('gerencias.store');
Route::get('/gerencias/{id}', [GerenciaController::class, 'show'])->name('gerencias.show');

Route::delete('/administracaos/{id}', [AdministracaoController::class, 'delete'])->name('administracaos.delete');
Route::put('/administracaos/{id}', [AdministracaoController::class, 'update'])->name('administracaos.update');
Route::get('/administracaos/{id}/edit', [AdministracaoController::class, 'edit'])->name('administracaos.edit');
Route::get('/administracaos/list', [AdministracaoController::class, 'list'])->name('administracaos.list');
Route::get('/administracaos/create', [AdministracaoController::class, 'create'])->name('administracaos.create');
Route::post('/administracaos', [AdministracaoController::class, 'store'])->name('administracaos.store');
Route::get('/administracaos/{id}', [AdministracaoController::class, 'show'])->name('administracaos.show');

Route::delete('/participantes/{id}', [ParticipanteController::class, 'delete'])->name('participantes.delete');
Route::put('/participantes/{id}', [ParticipanteController::class, 'update'])->name('participantes.update');
Route::get('/participantes/{id}/edit', [ParticipanteController::class, 'edit'])->name('participantes.edit');
Route::get('/participantes/list', [ParticipanteController::class, 'list'])->name('participantes.list');
Route::get('/participantes/create', [ParticipanteController::class, 'create'])->name('participantes.create');
Route::post('/participantes', [ParticipanteController::class, 'store'])->name('participantes.store');
Route::get('/participantes/{id}', [ParticipanteController::class, 'show'])->name('participantes.show');

Route::post('/participantes/carregar', [ParticipanteController::class, 'carregar']);
Route::post('/participantes/guardar', [ParticipanteController::class, 'guardar']);
Route::post('/import', [ParticipanteController::class,"import"]);
Route::post('/participantes/import', [ParticipanteController::class, 'import'])->name('participantes.import');

Route::delete('/recepcaos/{id}', [RecepcaoController::class, 'delete'])->name('recepcaos.delete');
Route::put('/recepcaos/{id}', [RecepcaoController::class, 'update'])->name('recepcaos.update');
Route::get('/recepcaos/{id}/edit', [RecepcaoController::class, 'edit'])->name('recepcaos.edit');
Route::get('/recepcaos/list', [RecepcaoController::class, 'list'])->name('recepcaos.list');
Route::get('/recepcaos/create', [RecepcaoController::class, 'create'])->name('recepcaos.create');
Route::post('/recepcaos', [RecepcaoController::class, 'store'])->name('recepcaos.store');
Route::get('/recepcaos/{id}', [RecepcaoController::class, 'show'])->name('recepcaos.show');

Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


//Operações
Route::delete('/propostas/{id}', [PropostaController::class, 'delete'])->name('propostas.delete');
Route::put('/propostas/{id}', [PropostaController::class, 'update'])->name('propostas.update');
Route::get('/propostas/{id}/edit', [PropostaController::class, 'edit'])->name('propostas.edit');
Route::get('/propostas/list', [PropostaController::class, 'list'])->name('propostas.list');
Route::get('/propostas/create', [PropostaController::class, 'create'])->name('propostas.create');
Route::post('/propostas', [PropostaController::class, 'store'])->name('propostas.store');
Route::get('/propostas/{id}', [PropostaController::class, 'show'])->name('propostas.show');

Route::delete('/desembolsoinsfontes/{id}', [DesembolsoinsfonteController::class, 'delete'])->name('desembolsoinsfontes.delete');
Route::put('/desembolsoinsfontes/{id}', [DesembolsoinsfonteController::class, 'update'])->name('desembolsoinsfontes.update');
Route::get('/desembolsoinsfontes/{id}/edit', [DesembolsoinsfonteController::class, 'edit'])->name('desembolsoinsfontes.edit');
Route::get('/desembolsoinsfontes/list', [DesembolsoinsfonteController::class, 'list'])->name('desembolsoinsfontes.list');
Route::get('/desembolsoinsfontes/create', [DesembolsoinsfonteController::class, 'create'])->name('desembolsoinsfontes.create');
Route::post('/desembolsoinsfontes', [DesembolsoinsfonteController::class, 'store'])->name('desembolsoinsfontes.store');
Route::get('/desembolsoinsfontes/{id}', [DesembolsoinsfonteController::class, 'show'])->name('desembolsoinsfontes.show');

Route::delete('/desembolsos/{id}', [DesembolsoController::class, 'delete'])->name('desembolsos.delete');
Route::put('/desembolsos/{id}', [DesembolsoController::class, 'update'])->name('desembolsos.update');
Route::get('/desembolsos/{id}/edit', [DesembolsoController::class, 'edit'])->name('desembolsos.edit');
Route::get('/desembolsos/list', [DesembolsoController::class, 'list'])->name('desembolsos.list');
Route::get('/desembolsos/create', [DesembolsoController::class, 'create'])->name('desembolsos.create');
Route::post('/desembolsos', [DesembolsoController::class, 'store'])->name('desembolsos.store');
Route::get('/desembolsos/{id}', [DesembolsoController::class, 'show'])->name('desembolsos.show');

Route::delete('/desembolsodafs/{id}', [DesembolsodafController::class, 'delete'])->name('desembolsodafs.delete');
Route::put('/desembolsodafs/{id}', [DesembolsodafController::class, 'update'])->name('desembolsodafs.update');
Route::get('/desembolsodafs/{id}/edit', [DesembolsodafController::class, 'edit'])->name('desembolsodafs.edit');
Route::get('/desembolsodafs/list', [DesembolsodafController::class, 'list'])->name('desembolsodafs.list');
Route::get('/desembolsodafs/create', [DesembolsodafController::class, 'create'])->name('desembolsodafs.create');
Route::post('/desembolsodafs', [DesembolsodafController::class, 'store'])->name('desembolsodafs.store');
Route::get('/desembolsodafs/{id}', [DesembolsodafController::class, 'show'])->name('desembolsodafs.show');

Route::delete('/distribuicaos/{id}', [DistribuicaoController::class, 'delete'])->name('distribuicaos.delete');
Route::put('/distribuicaos/{id}', [DistribuicaoController::class, 'update'])->name('distribuicaos.update');
Route::get('/distribuicaos/{id}/edit', [DistribuicaoController::class, 'edit'])->name('distribuicaos.edit');
Route::get('/distribuicaos/list', [DistribuicaoController::class, 'list'])->name('distribuicaos.list');
Route::get('/distribuicaos/create', [DistribuicaoController::class, 'create'])->name('distribuicaos.create');
Route::post('/distribuicaos', [DistribuicaoController::class, 'store'])->name('distribuicaos.store');
Route::get('/distribuicaos/{id}', [DistribuicaoController::class, 'show'])->name('distribuicaos.show');

Route::delete('/requisicaos/{id}', [RequisicaoController::class, 'delete'])->name('requisicaos.delete');
Route::put('/requisicaos/{id}', [RequisicaoController::class, 'update'])->name('requisicaos.update');
Route::get('/requisicaos/{id}/edit', [RequisicaoController::class, 'edit'])->name('requisicaos.edit');
Route::get('/requisicaos/list', [RequisicaoController::class, 'list'])->name('requisicaos.list');
Route::get('/requisicaos/create', [RequisicaoController::class, 'create'])->name('requisicaos.create');
Route::post('/requisicaos', [RequisicaoController::class, 'store'])->name('requisicaos.store');
Route::get('/requisicaos/{id}', [RequisicaoController::class, 'show'])->name('requisicaos.show');

Route::delete('/requisicaocispos/{id}', [RequisicaocispoController::class, 'delete'])->name('requisicaocispos.delete');
Route::put('/requisicaocispos/{id}', [RequisicaocispoController::class, 'update'])->name('requisicaocispos.update');
Route::get('/requisicaocispos/{id}/edit', [RequisicaocispoController::class, 'edit'])->name('requisicaocispos.edit');
Route::get('/requisicaocispos/list', [RequisicaocispoController::class, 'list'])->name('requisicaocispos.list');
Route::get('/requisicaocispos/create', [RequisicaocispoController::class, 'create'])->name('requisicaocispos.create');
Route::post('/requisicaocispos', [RequisicaocispoController::class, 'store'])->name('requisicaocispos.store');
Route::get('/requisicaocispos/{id}', [RequisicaocispoController::class, 'show'])->name('requisicaocispos.show');

Route::delete('/dispensas/{id}', [DispensaController::class, 'delete'])->name('dispensas.delete');
Route::put('/dispensas/{id}', [DispensaController::class, 'update'])->name('dispensas.update');
Route::get('/dispensas/{id}/edit', [DispensaController::class, 'edit'])->name('dispensas.edit');
Route::get('/dispensas/list', [DispensaController::class, 'list'])->name('dispensas.list');
Route::get('/dispensas/create', [DispensaController::class, 'create'])->name('dispensas.create');
Route::post('/dispensas', [DispensaController::class, 'store'])->name('dispensas.store');
Route::get('/dispensas/{id}', [DispensaController::class, 'show'])->name('dispensas.show');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes(); 

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'list'])->name('home')->middleware('auth');
Route::get('/home', [DashboardController::class, 'recuperar'])->name('recuperar')->middleware('auth');
Route::get('/type-home', [DashboardController::class, 'typeHome'])->name('typeHome')->middleware('is_type');
