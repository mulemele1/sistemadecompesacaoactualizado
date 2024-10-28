<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administracao;
use App\Models\Distribuicao;
use App\Models\Participante;
use App\Models\Projecto;
use App\Models\Recepcao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GraficoController extends Controller
{
    public function projectoAnos(Request $request)
    {
        $val = false;
        $data = $request->data;
        $data2 = $request->data2;
        $recepcao_id = $request->recepcao_id;
    
        // Carregar todas as recepções para o dropdown
        $recepcaos = Recepcao::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']); // Adicionando todos os projectos
    
        if ($data && $data2 && $recepcao_id != null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);
    
                $tabela = [];
                $totalDesembolsado = 0;
    
                // Buscar desembolsos para o intervalo de datas e recepcao_id específico
                $distribuicaos = DB::table('distribuicaos')
                    ->where('recepcao_id', $recepcao_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor', 'created_at as data', 'recepcao_id', 'projecto_id') // Incluindo o projeto
                    ->orderBy('created_at')
                    ->get();
    
                foreach ($distribuicaos as $desembolso) {
                    $name = $recepcaos->find($recepcao_id)->name;
                    $acronimo = $projectos->find($desembolso->projecto_id)->acronimo; // Recuperando o projeto
                    $valorDesembolsado = $desembolso->valor;
                    $totalDesembolsado += $valorDesembolsado;
    
                    $tabela[] = [
                        $name,                     // Nome da recepção
                        $acronimo,                // Nome do projecto
                        $desembolso->data,        // Data
                        $valorDesembolsado        // Valor Desembolsado
                    ];
                }
    
                return view('relatorios/projecto/anos', compact('recepcaos', 'tabela', 'val', 'data', 'data2', 'recepcao_id', 'totalDesembolsado'));
            } else {
                $val = true;
                return view('relatorios/projecto/anos', compact('recepcaos', 'val'));
            }
        } else {
            return view('relatorios/projecto/anos', compact('recepcaos', 'val', 'data', 'data2'));
        }
    }
    


    
public function projectoAno(Request $request)
{
    $val = false;
    $projectos = Projecto::all(['id', 'acronimo']);
    $data = $request->data;
    $data2 = $request->data2;
    $project_id = $request->projecto_id;

    if ($data && $data2 && $project_id != null) {
        if ($data < $data2) {
            $startDate = Carbon::createFromFormat('Y-m-d', $data);
            $endDate = Carbon::createFromFormat('Y-m-d', $data2);

            $tabela = [];
            $totalDesembolsado = 0; // Inicializa o acumulador para o total

            // Buscando os desembolsos para o intervalo de datas
            $desembolsoinsfontes = DB::table('desembolsoinsfontes')
                ->where('projecto_id', $project_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->select('valor', 'data') // Corrigido para 'created_at'
                ->orderBy('data') // Ordena pelos desembolsos pela data
                ->get();

            // Preenchendo a tabela com os dados necessários
            foreach ($desembolsoinsfontes as $desembolso) {
                $acronimo = $projectos->find($project_id)->acronimo;
                $valorDesembolsado = $desembolso->valor;
                $totalDesembolsado += $valorDesembolsado; // Acumula o valor desembolsado

                $tabela[] = [
                    $acronimo,                              // Acrônimo
                    $desembolso->data, // Data formatada
                    $valorDesembolsado                      // Valor Desembolsado
                ];
            }

            $projecto = Projecto::find($project_id);

            // Passar o total para a view
            return view('relatorios/projecto/ano', compact('projectos', 'tabela', 'val', 'data', 'data2', 'projecto', 'totalDesembolsado'));
        } else {
            $val = true;
            return view('relatorios/projecto/ano', compact('projectos', 'val'));
        }
    } else {
        return view('relatorios/projecto/ano', compact('projectos', 'val', 'data', 'data2'));
    }
}



    
    public function administracaoAnos(Request $request)
    {
        $val = false;
        $administracaos = Administracao::all();
        if ($request->data) {
            $year = $request->data;
            $year2 = $request->data2;
            $interval = null;
            $sum = 0;
            $sum2 = 0;
            $sum3 = 0;
            if ($year2 > $year) {
                while ($year2 > $year) {
                    $interval[] = $year + 1;
                    $year = $year + 1;
                }
                foreach ($interval as $i => $y) {
                    foreach ($administracaos as $adm) {
                        $tEntradas = DB::table('distribuicaos')->where('administracao_id', $adm->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $tSaidas = DB::table('requisicaos')->where('administracao_id', $adm->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $saldo = $tEntradas - $tSaidas;
                        $sum = $saldo + $sum;
                        $sum2 = $tEntradas + $sum2;
                        $sum3 = $tSaidas + $sum3;
                        $tabela[] = [$y, $adm->nome, $saldo, $tSaidas, $tEntradas];
                    }
                }
                return view('relatorios/administracao/anos', compact('administracaos', 'tabela', 'val', 'sum', 'sum2', 'sum3'));
            } else {
                $val = true;
                return view('relatorios/administracao/anos', compact('administracaos', 'val'));
            }
        } else {
            return view('relatorios/administracao/anos', compact('administracaos', 'val'));
        }
    }
    public function administracaoAno(Request $request)
    {
        /*$administracaos = Administracao::all();
        if ($request->data && $request->administracao_id != null) {
            $administra_id = $request->administracao_id;
            $year = $request->data;
            $sum = 0;
            $sum2 = 0;
            $sum3 = 0;
            $months = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            foreach ($months as $i => $m) {
                $tEntradas = DB::table('distribuicaos')->where('administracao_id', $administra_id)->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $tSaidas = DB::table('requisicaos')->where('administracao_id', $administra_id)->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $saldo = $tEntradas - $tSaidas;
                $sum = $saldo + $sum;
                $sum2 = $tEntradas + $sum2;
                $sum3 = $tSaidas + $sum3;
                $tabela[] = [$i + 1, $m, $administracaos->find($administra_id)->nome, $saldo, $tSaidas, $tEntradas];
            }
            return view('relatorios/administracao/ano', compact('administracaos', 'months', 'tabela', 'sum', 'sum2', 'sum3', 'year'));
        } else {
            return view('relatorios/administracao/ano', compact('administracaos'));
        }*/
        $val = false;
        $administracaos = Administracao::all();
        $data = $request->data;
        $data2 = $request->data2;
        $administracao_id = $request->administracao_id;

        if ($data && $data2 && $administracao_id != null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                $sum = 0;
                $sum2 = 0;
                $sum3 = 0;
                $tabela = [];

                while ($startDate <= $endDate) {
                    $tEntradas = DB::table('distribuicaos')
                        ->where('administracao_id', $administracao_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $tSaidas = DB::table('requisicaos')
                        ->where('administracao_id', $administracao_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $saldo = $tEntradas - $tSaidas;
                    $sum += $saldo;
                    $sum2 += $tEntradas;
                    $sum3 += $tSaidas;
                    $tabela[] = [$startDate->format('d/m/Y'), $saldo, $tSaidas, $tEntradas];
                    $startDate->addDay();
                }
                $administracao = Administracao::find($administracao_id);
                return view('relatorios/administracao/ano', compact('administracaos', 'tabela', 'sum', 'sum2', 'sum3', 'val', 'data', 'data2', 'administracao'));
            } else {
                $val = true;
                return view('relatorios/administracao/ano', compact('administracaos', 'val'));
            }
        } else {
            return view('relatorios/administracao/ano', compact('administracaos', 'val', 'data', 'data2'));
        }
    }
    public function recepcaoAnos(Request $request)
    {
        $val = false;
        $recepcaos = Recepcao::all();
        if ($request->data) {
            $year = $request->data;
            $year2 = $request->data2;
            $interval = null;
            $sum = 0;
            $sum2 = 0;
            $sum3 = 0;
            if ($year2 > $year) {
                while ($year2 > $year) {
                    $interval[] = $year + 1;
                    $year = $year + 1;
                }
                foreach ($interval as $i => $y) {
                    foreach ($recepcaos as $recep) {
                        $tEntradas = DB::table('requisicaos')->where('recepcao_id', $recep->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $tSaidas = DB::table('dispensas')->where('recepcao_id', $recep->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $saldo = $tEntradas - $tSaidas;
                        $sum = $saldo + $sum;
                        $sum2 = $tEntradas + $sum2;
                        $sum3 = $tSaidas + $sum3;
                        $tabela[] = [$y, $recep->name, $saldo, $tSaidas, $tEntradas];
                    }
                }
                return view('relatorios/recepcao/anos', compact('recepcaos', 'tabela', 'val', 'sum', 'sum2', 'sum3'));
            } else {
                $val = true;
                return view('relatorios/recepcao/anos', compact('recepcaos', 'val'));
            }
        } else {
            return view('relatorios/recepcao/anos', compact('recepcaos', 'val'));
        }
    }
    public function recepcaoAno(Request $request)
    {
        /*$recepcaos = Recepcao::all();
        if ($request->data && $request->recepcao_id != null) {
            $recep_id = $request->recepcao_id;
            $year = $request->data;
            $sum = 0;
            $sum2 = 0;
            $sum3 = 0;
            $months = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            foreach ($months as $i => $m) {
                $tEntradas = DB::table('requisicaos')->where('recepcao_id', $recep_id)->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $tSaidas = DB::table('dispensas')->where('recepcao_id', $recep_id)->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $saldo = $tEntradas - $tSaidas;
                $sum = $saldo + $sum;
                $sum2 = $tEntradas + $sum2;
                $sum3 = $tSaidas + $sum3;
                $tabela[] = [$i + 1, $m, $recepcaos->find($recep_id)->name, $saldo, $tSaidas, $tEntradas];
            }
            return view('relatorios/recepcao/ano', compact('recepcaos', 'months', 'tabela', 'sum', 'sum2', 'sum3', 'year'));
        } else {
            return view('relatorios/recepcao/ano', compact('recepcaos'));
        }*/
        $val = false;
        $recepcaos = Recepcao::all();
        $data = $request->data;
        $data2 = $request->data2;
        $recepcao_id = $request->recepcao_id;

        if ($data && $data2 && $recepcao_id != null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                $sum = 0;
                $sum2 = 0;
                $sum3 = 0;
                $tabela = [];

                while ($startDate <= $endDate) {
                    $tEntradas = DB::table('requisicaos')
                        ->where('recepcao_id', $recepcao_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $tSaidas = DB::table('dispensas')
                        ->where('recepcao_id', $recepcao_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $saldo = $tEntradas - $tSaidas;
                    $sum += $saldo;
                    $sum2 += $tEntradas;
                    $sum3 += $tSaidas;
                    $tabela[] = [$startDate->format('d/m/Y'), $saldo, $tSaidas, $tEntradas];
                    $startDate->addDay();
                }
                $recepcao = Recepcao::find($recepcao_id);
                return view('relatorios/recepcao/ano', compact('recepcaos', 'tabela', 'sum', 'sum2', 'sum3', 'val', 'data', 'data2', 'recepcao'));
            } else {
                $val = true;
                return view('relatorios/recepcao/ano', compact('recepcaos', 'val'));
            }
        } else {
            return view('relatorios/recepcao/ano', compact('recepcaos', 'val', 'data', 'data2'));
        }
    }
    public function participanteAnoDN(Request $request)
    {
        /*$participante = Participante::all();
        if ($request->data) {
            $year = $request->data;
            $sum = 0;
            $months = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            foreach ($months as $i => $m) {
                $tSaidas = DB::table('dispensas')->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $sum = $tSaidas + $sum;
                $tabela[] = [$i + 1, $m, $tSaidas];
            }
            return view('relatorios/participante/anoN', compact('participante', 'months', 'tabela', 'sum', 'year'));
        } else {
            return view('relatorios/participante/anoN', compact('participante'));
        }*/
        $val = false;
        $participantes = Participante::all();
        $data = $request->data;
        $data2 = $request->data2;

        if ($data && $data2) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                $sum = 0;
                $tabela = [];

                while ($startDate <= $endDate) {
                    $tSaidas = DB::table('dispensas')
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $sum += $tSaidas;
                    $tabela[] = [$startDate->format('d/m/Y'), $sum];
                    $startDate->addDay();
                }
                return view('relatorios/participante/anoN', compact('participantes', 'tabela', 'sum', 'val', 'data', 'data2'));
            } else {
                $val = true;
                return view('relatorios/participante/anoN', compact('participantes', 'val'));
            }
        } else {
            return view('relatorios/participante/anoN', compact('participantes', 'val', 'data', 'data2'));
        }
    }
    public function participanteAnoDV(Request $request)
    {
        /*$participante = Participante::all();
        if ($request->data) {
            $year = $request->data;
            $sum = 0;
            $sum2 = 0;
            $months = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            foreach ($months as $i => $m) {
                $tSaidas = DB::table('dispensas')->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor');
                $tSaidasVariaveis = DB::table('dispensas')->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $i + 1)->sum('valor_variavel');
                $sum = $tSaidas + $sum;
                $sum2 = $tSaidasVariaveis + $sum2;
                $tabela[] = [$i + 1, $m, $tSaidas, $tSaidasVariaveis];
            }
            return view('relatorios/participante/anoV', compact('participante', 'months', 'tabela', 'sum', 'sum2', 'year'));
        } else {
            return view('relatorios/participante/anoV', compact('participante'));
        }*/
        $val = false;
        $participantes = Participante::all();
        $data = $request->data;
        $data2 = $request->data2;

        if ($data && $data2) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                $sum = 0;
                $sum2 = 0;
                $tabela = [];

                while ($startDate <= $endDate) {
                    $tSaidas = DB::table('dispensas')
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $tSaidasVariaveis = DB::table('dispensas')
                        ->whereDate('created_at', $startDate)
                        ->sum('valor_variavel');
                    $sum += $tSaidas;
                    $sum2 += $tSaidasVariaveis;
                    $tabela[] = [$startDate->format('d/m/Y'), $sum, $sum2];
                    $startDate->addDay();
                }
                return view('relatorios/participante/anoV', compact('participantes', 'tabela', 'sum','sum2', 'val', 'data', 'data2'));
            } else {
                $val = true;
                return view('relatorios/participante/anoV', compact('participantes', 'val'));
            }
        } else {
            return view('relatorios/participante/anoV', compact('participantes', 'val', 'data', 'data2'));
        }
    }

    public function fonteAno(Request $request)
    {
        /*$val = false;
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data; $data2 = $request->data2; $project_id = $request->projecto_id;
        if ($data && $data2 && $project_id != null) {
            if ($data < $data2) {
                $year = $data;
                $sum = 0;
                $sum2 = 0;
                $sum3 = 0;
                $months = [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ];
                foreach ($months as $i => $m) {
                    $tEntradas = DB::table('desembolsos')
                        ->where('projecto_id', $project_id)
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $i + 1)
                        ->sum('valor');
                    $tSaidas = DB::table('dispensas')
                        ->where('projecto_id', $project_id)
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $i + 1)
                        ->sum('valor');
                    $saldo = $tEntradas - $tSaidas;
                    $sum = $saldo + $sum;
                    $sum2 = $tEntradas + $sum2;
                    $sum3 = $tSaidas + $sum3;
                    $tabela[] = [$i + 1, $m, $projectos->find($project_id)->acronimo, $saldo, $tSaidas, $tEntradas];
                }
                $projecto = Projecto::find($project_id);
                return view('relatorios/projecto/ano', compact('projectos', 'months', 'tabela', 'sum', 'sum2', 'sum3', 'val', 'data', 'data2', 'projecto'));
            } else {
                $val = true;
                return view('relatorios/projecto/ano', compact('projectos', 'val'));
            }
        } else {
            return view('relatorios/projecto/ano', compact('projectos', 'val', 'data', 'data2'));
        }*/
        $val = false;
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data;
        $data2 = $request->data2;
        $project_id = $request->projecto_id;

        if ($data && $data2 && $project_id != null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                $sum = 0;
                $sum2 = 0;
                $sum3 = 0;
                $tabela = [];

                while ($startDate <= $endDate) {
                    $tEntradas = DB::table('desembolsos')
                        ->where('projecto_id', $project_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $tSaidas = DB::table('dispensas')
                        ->where('projecto_id', $project_id)
                        ->whereDate('created_at', $startDate)
                        ->sum('valor');
                    $saldo = $tEntradas - $tSaidas;
                    $sum += $saldo;
                    $sum2 += $tEntradas;
                    $sum3 += $tSaidas;
                    $tabela[] = [$startDate->format('d/m/Y'), $saldo, $tSaidas, $tEntradas];
                    $startDate->addDay();
                }
                $projecto = Projecto::find($project_id);
                return view('relatorios/projecto/ano', compact('projectos', 'tabela', 'sum', 'sum2', 'sum3', 'val', 'data', 'data2', 'projecto'));
            } else {
                $val = true;
                return view('relatorios/projecto/ano', compact('projectos', 'val'));
            }
        } else {
            return view('relatorios/projecto/ano', compact('projectos', 'val', 'data', 'data2'));
        }
    }
}
