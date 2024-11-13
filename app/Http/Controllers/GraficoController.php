<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administracao;
use App\Models\Desembolsodaf;
use App\Models\Desembolsoins;
use App\Models\Desembolsoinsfonte;
use App\Models\Dispensa;
use App\Models\Distribuicao;
use App\Models\Participante;
use App\Models\Projecto;
use App\Models\Recepcao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller para manipulação de gráficos e relatórios financeiros
 */
class GraficoController extends Controller
{
    /**
     * Método para gerar um gráfico de desembolsos por projeto em um intervalo de anos
     *
     * @param Request $request Objeto de requisição contendo os parâmetros necessários
     * @return \Illuminate\View\View View com os dados para o gráfico
     */
    public function projectoAnos(Request $request)
    {
        $val = false;
        $desembolsodafs = Desembolsoinsfonte::all();
        $uniqueRows = []; // Array para armazenar linhas únicas

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

                foreach ($interval as $y) {
                    foreach ($desembolsodafs as $adm) {
                        $tEntradas = DB::table('desembolsoinsfontes')->where('fonte_id', $adm->id)
                            ->whereYear('created_at', '=', $y)->sum('valor');
                        $tSaidas = DB::table('desembolsodafs')->where('daf_id', $adm->id)
                            ->whereYear('created_at', '=', $y)->sum('valor');
                        $saldo = $tEntradas - $tSaidas;

                        // Verifique se esta combinação já foi adicionada
                        $key = $y . '-' . $adm->daf_id;
                        if (!isset($uniqueRows[$key])) {
                            $uniqueRows[$key] = [$y, 'DELEGAÇÃO', $saldo, $tSaidas, $tEntradas];
                            $sum += $saldo;
                            $sum2 += $tEntradas;
                            $sum3 += $tSaidas;
                        }
                    }
                }

                return view('relatorios/fontedaf/anos', [
                    'desembolsodafs' => $desembolsodafs,
                    'tabela' => $uniqueRows,
                    'val' => $val,
                    'sum' => $sum,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ]);
            } else {
                $val = true;
                return view('relatorios/projecto/anos', compact('desembolsodafs', 'val'));
            }
        } else {
            return view('relatorios/projecto/anos', compact('desembolsodafs', 'val'));
        }
    }

    /**
     * Método para gerar um gráfico de desembolsos por projeto em um ano específico
     *
     * @param Request $request Objeto de requisição contendo os parâmetros necessários
     * @return \Illuminate\View\View View com os dados para o gráfico
     */
    public function projectoAno(Request $request)
    {
        /** 
         * $val = false;
        *$projectos = Projecto::all(['id', 'acronimo']);
        *$data = $request->data;
        *$data2 = $request->data2;
        *$project_id = $request->projecto_id;

        *if ($data && $data2 && $project_id !== null) {
        *    if ($data < $data2) {
        *        $startDate = Carbon::createFromFormat('Y-m-d', $data);
        *       $endDate = Carbon::createFromFormat('Y-m-d', $data2);

        *        $tabela = [];
        *        $totalDesembolsado = 0;

        *        // Buscando os desembolsos para o intervalo de datas
        *        $desembolsoinsfontes = DB::table('desembolsoinsfontes')
        *            ->where('projecto_id', $project_id)
        *           ->whereBetween('created_at', [$startDate, $endDate])
        *            ->select('valor', 'data')
        *            ->select('valor', 'data')
        *            ->orderBy('data')
        *            ->get();

        *        foreach ($desembolsoinsfontes as $desembolso) {
        *            $acronimo = $projectos->find($project_id)->acronimo;
        *            $valorDesembolsado = $desembolso->valor;
        *            $totalDesembolsado += $valorDesembolsado;

        *            $tabela[] = [
        *                $acronimo,
        *                $desembolso->data,
        *                $valorDesembolsado
        *            ];
        *        }

        *        $projecto = Projecto::find($project_id);

        *        return view('relatorios/projecto/ano', compact('projectos', 'tabela', 'val', 'data', 'data2', 'projecto', 'totalDesembolsado'));
        *    } else {
        *        $val = true;
        *        return view('relatorios/projecto/ano', compact('projectos', 'val'));
        *    }
        *} else {
        *    return view('relatorios/projecto/ano', compact('projectos', 'val', 'data', 'data2'));
        *}
    *}
         * 
         * 
         */
        $val = false;
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data;
        $data2 = $request->data2;
        $project_id = $request->projecto_id;

        // Inicialização das variáveis
        $totalDesembolsado = 0;
        $totalGastos = 0;
        $saldo = 0;
        $tabela = []; // Inicialize $tabela como um array vazio

        // Lógica de processamento ao receber uma requisição válida
        if ($data && $data2 && $project_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Recuperar os desembolsos
                $desembolsos = DB::table('desembolsoinsfontes')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('data', [$startDate, $endDate])
                    ->select('valor as valor_desembolsado', 'data as data_desem')
                    ->get();

                // Recuperar os gastos
                $gastos = DB::table('desembolsodafs')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_gasto', 'created_at')
                    ->get();

                // Calcular totais
                $totalDesembolsado = $desembolsos->sum('valor_desembolsado');
                $totalGastos = $gastos->sum('valor_gasto');
                $saldo = $totalDesembolsado - $totalGastos; // Calculo do saldo

                // Obter o acrônimo do projeto
                $acronimo = $projectos->find($project_id)->acronimo;

                // Adicionar uma única linha na tabela
                $tabela[] = [
                    'acronimo' => $acronimo,                       // Acrônimo do Projeto
                    'data' => $startDate->format('Y'),     // Ano do Desembolso (apenas o ano do início)
                    'desembolso' => $totalDesembolsado,            // Total Valor Desembolsado
                    'gasto' => $totalGastos,                        // Total Gasto
                    'saldo' => $saldo                               // Saldo
                ];
            } else {
                $val = true; // Flag para indicar erro de intervalo
            }
        }

        // Passa tudo para a view, incluindo a variável $tabela única
        return view('relatorios/projecto/ano', compact('projectos', 'tabela', 'val', 'data', 'data2', 'totalDesembolsado', 'totalGastos', 'saldo'));

    }

    /**
     * Método para gerar um gráfico de administração por ano
     *
     * @param Request $request Objeto de requisição contendo os parâmetros necessários
     * @return \Illuminate\View\View View com os dados para o gráfico
     */
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
                        $tEntradas = DB::table('desembolsos')->where('administracao_id', $adm->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $tSaidas = DB::table('distribuicaos')->where('administracao_id', $adm->id)
                            ->whereYear('created_at', '=', $year)->sum('valor');
                        $saldo = $tEntradas - $tSaidas;
                        $sum = $saldo + $sum;
                        $sum2 = $tEntradas + $sum2;
                        $sum3 = $tSaidas + $sum3;
                        $tabela[] = [$y, $adm->nome, $saldo, $tSaidas, $tEntradas];
                    }
                }
                return view('relatorios/administracao/anos', compact('administracaos', 'tabela', 'val','sum','sum2','sum3'));
            } else {
                $val = true;
                return view('relatorios/administracao/anos', compact('administracaos', 'val'));
            }
        } else {
            return view('relatorios/administracao/anos', compact('administracaos', 'val'));
        }
    }

    /**
     * Método para gerar um gráfico de administração por ano
     *
     * @param Request $request Objeto de requisição contendo os parâmetros necessários
     * @return \Illuminate\View\View View com os dados para o gráfico
     */
    public function administracaoAno(Request $request)
    {
        $val = false;
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data;
        $data2 = $request->data2;
        $project_id = $request->projecto_id;

        // Inicialização das variáveis
        $totalDesembolsado = 0;
        $totalGastos = 0;
        $saldo = 0;
        $tabela = [];

        // Lógica de processamento ao receber uma requisição válida
        if ($data && $data2 && $project_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Recuperar os desembolsos
                $desembolsos = DB::table('desembolsos')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('data_desem', [$startDate, $endDate])
                    ->select('valor as valor_desembolsado', 'data_desem')
                    ->get();

                // Recuperar os gastos
                $gastos = DB::table('distribuicaos')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_gasto', 'created_at')
                    ->get();

                // Calcular totais
                $totalDesembolsado = $desembolsos->sum('valor_desembolsado');
                $totalGastos = $gastos->sum('valor_gasto');
                $saldo = $totalDesembolsado - $totalGastos; // Calculo do saldo

                // Obter o acrônimo do projeto
                $acronimo = $projectos->find($project_id)->acronimo;

                // Adicionar uma única linha na tabela
                $tabela[] = [
                    'acronimo' => $acronimo,
                    'data' => $startDate->format('Y'),
                    'desembolso' => $totalDesembolsado,
                    'gasto' => $totalGastos,
                    'saldo' => $saldo
                ];
            } else {
                $val = true;
            }
        }

        return view('relatorios/administracao/ano', compact('projectos', 'tabela', 'val', 'data', 'data2', 'totalDesembolsado', 'totalGastos', 'saldo'));
    }

    /**
     * Método para gerar um gráfico de recepção por ano
     *
     * @param Request $request Objeto de requisição contendo os parâmetros necessários
     * @return \Illuminate\View\View View com os dados para o gráfico
     */
    public function recepcaoAnos(Request $request)
    {
        $val = false;
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data;
        $data2 = $request->data2;
        $project_id = $request->projecto_id;

        // Inicialização das variáveis
        $totalDesembolsado = 0;
        $totalGasto = 0;
        $saldo = 0;
        $tabela = [];

        // Lógica de processamento ao receber uma requisição válida

        if ($data && $data2 && $project_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Recuperar os desembolsos
                $desembolsos = DB::table('distribuicaos')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_desembolsado', 'created_at as data_desem')
                    ->get();

                // Recuperar os gastos, incluindo múltiplos campos
                $gastos = DB::table('dispensas')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_gasto', 'valor_variavel as valor_gasto2', 'valor_esp as valor_gasto3', 'created_at as data_gasto', 'created_at')
                    ->get();

                // Somatório de valor_desembolso para o projeto pesquisado
                $totalDesembolsado = $desembolsos->sum('valor_desembolsado');

                // Somatório de valor_gasto, valor_gasto2 e valor_gasto3 para o projeto pesquisado
                $totalGasto = $gastos->reduce(function ($carry, $item) {
                    return $carry + $item->valor_gasto + $item->valor_gasto2 + $item->valor_gasto3;
                }, 0);

                // Cálculo do saldo
                $saldo = $totalDesembolsado - $totalGasto;

                // Obter o acrônimo do projeto
                $acronimo = $projectos->find($project_id)->acronimo;

                // Adicionar uma única linha na tabela
                $tabela[] = [
                    'acronimo' => $acronimo,                  // Acrônimo do Projeto
                    'data' => $startDate->format('Y'),        // Ano do Desembolso (apenas o ano do início)
                    'desembolso' => $totalDesembolsado,       // Total Valor Desembolsado
                    'gasto' => $totalGasto,                   // Total Gasto
                    'saldo' => $saldo                         // Saldo
                ];
            } else {
                $val = true; // Flag para indicar erro de intervalo
            }
        }

        // Passa tudo para a view, incluindo a variável $tabela única
        return view('relatorios.recepcao.anos', compact('projectos', 'tabela', 'val', 'data', 'data2', 'totalDesembolsado', 'totalGasto', 'saldo'));
    }


    public function recepcaoAno(Request $request)
    {
        $val = false;
        $data = $request->data;
        $data2 = $request->data2;
        $recepcao_id = $request->recepcao_id;
        $projecto_id = $request->projecto_id;

        $recepcaos = Recepcao::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']);

        $tabela = [];
        $totalDesembolsado = 0;
        $totalGasto = 0;
        $saldo = 0;

        if ($data && $data2 && $recepcao_id && $projecto_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Obtendo todos os desembolsos para o projeto especificado
                $distribuicaos = DB::table('distribuicaos')
                    ->where('recepcao_id', $recepcao_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('projecto_id', $projecto_id)
                    ->select('valor as valor_desembolso', 'created_at as data_desembolso', 'recepcao_id', 'projecto_id')
                    ->get();

                // Obtendo todos os gastos para o projeto especificado
                $gastos = DB::table('dispensas')
                    ->where('recepcao_id', $recepcao_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('projecto_id', $projecto_id)
                    ->select('valor as valor_gasto', 'valor_variavel as valor_gasto2', 'valor_esp as valor_gasto3', 'created_at as data_gasto')
                    ->get();

                $name = $recepcaos->find($recepcao_id)->name ?? 'Não encontrado';
                $projectAcronym = $projectos->find($projecto_id)->acronimo ?? 'Não encontrado';

                // Somatório de valor_desembolso para o projeto pesquisado
                $totalDesembolsado = $distribuicaos->sum('valor_desembolso');

                // Somatório de valor_gasto, valor_gasto2 e valor_gasto3 para o projeto pesquisado
                $totalGasto = $gastos->reduce(function ($carry, $item) {
                    return $carry + $item->valor_gasto + $item->valor_gasto2 + $item->valor_gasto3;
                }, 0);

                // Cálculo do saldo
                $saldo = $totalDesembolsado - $totalGasto;

                // Montagem de uma única entrada na tabela para o projeto pesquisado
                $tabela[] = [
                    'recepcao' => $name,
                    'projecto' => $projectAcronym,
                    'data_desembolso' => $startDate->format('Y'),
                    'valor_desembolso' => $totalDesembolsado,
                    'valor_gasto' => $totalGasto,
                    'saldo' => $saldo
                ];

                return view('relatorios.recepcao.ano', compact('recepcaos', 'tabela', 'val', 'data', 'data2', 'recepcao_id', 'totalDesembolsado', 'totalGasto', 'projectos'));
            } else {
                $val = true;
                return view('relatorios.recepcao.ano', compact('recepcaos', 'val', 'projectos'));
            }
        } else {
            return view('relatorios.recepcao.ano', compact('recepcaos', 'val', 'data', 'data2', 'projectos'));
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
        $projectos = Projecto::all(['id', 'acronimo']);
        $data = $request->data;
        $data2 = $request->data2;
        $project_id = $request->projecto_id;

        // Inicialização das variáveis
        $totalDesembolsado = 0;
        $totalGastos = 0;
        $saldo = 0;
        $tabela = []; // Inicialize $tabela como um array vazio

        // Lógica de processamento ao receber uma requisição válida
        if ($data && $data2 && $project_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Recuperar os desembolsos
                $desembolsos = DB::table('distribuicaos')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_desembolsado', 'created_at as data_desem')
                    ->get();

                // Recuperar os gastos
                $gastos = DB::table('dispensas')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_gasto','valor_variavel as valor_gasto2','valor_esp as valor_gasto3', 'created_at')
                    ->get();

                // Calcular totais
                $totalDesembolsado = $desembolsos->sum('valor_desembolsado');
                $totalGastos = $gastos->sum('valor_gasto');
                $totalGastos2 = $gastos->sum('valor_gasto2');
                $totalGastos3 = $gastos->sum('valor_gasto3');
                $saldo = $totalDesembolsado - $totalGastos - $totalGastos2 - $totalGastos3; // Calculo do saldo

                // Obter o acrônimo do projeto
                $acronimo = $projectos->find($project_id)->acronimo;

                // Adicionar uma única linha na tabela
                $tabela[] = [
                    'acronimo' => $acronimo,                       // Acrônimo do Projeto
                    'created_at' => $startDate->format('Y'),     // Ano do Desembolso (apenas o ano do início)
                    'desembolso' => $totalDesembolsado,            // Total Valor Desembolsado
                    'valor' => $totalGastos,
                    'valor_variavel' => $totalGastos2,
                    'valor_esp' => $totalGastos3,                    
                    'saldo' => $saldo                               // Saldo
                ];
            } else {
                $val = true; // Flag para indicar erro de intervalo
            }
        }

        // Passa tudo para a view, incluindo a variável $tabela única
        return view('relatorios/participante/anoN', compact('projectos', 'tabela', 'val', 'data', 'data2', 'totalDesembolsado', 'totalGastos', 'saldo'));

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
        $data = $request->data;
        $data2 = $request->data2;
        $recepcao_id = $request->recepcao_id;
        $projecto_id = $request->projecto_id;

        $recepcaos = Recepcao::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']);

        $tabela = [];
        $totalDesembolsado = 0;
        $totalGasto = 0;
        $saldo = 0;

        if ($data && $data2 && $recepcao_id && $projecto_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Obtendo todos os desembolsos para o projeto especificado
                $distribuicaos = DB::table('distribuicaos')
                    ->where('recepcao_id', $recepcao_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('projecto_id', $projecto_id)
                    ->select('valor as valor_desembolso', 'created_at as data_desembolso', 'recepcao_id', 'projecto_id')
                    ->get();

                // Obtendo todos os gastos para o projeto especificado
                $gastos = DB::table('dispensas')
                    ->where('recepcao_id', $recepcao_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('projecto_id', $projecto_id)
                    ->select('valor as valor_gasto', 'valor_variavel as valor_gasto2', 'valor_esp as valor_gasto3', 'created_at as data_gasto')
                    ->get();

                $name = $recepcaos->find($recepcao_id)->name ?? 'Não encontrado';
                $projectAcronym = $projectos->find($projecto_id)->acronimo ?? 'Não encontrado';

                // Somatório de valor_desembolso para o projeto pesquisado
                $totalDesembolsado = $distribuicaos->sum('valor_desembolso');

                // Somatório de valor_gasto, valor_gasto2 e valor_gasto3 para o projeto pesquisado
                $totalGasto = $gastos->reduce(function ($carry, $item) {
                    return $carry + $item->valor_gasto + $item->valor_gasto2 + $item->valor_gasto3;
                }, 0);

                // Cálculo do saldo
                $saldo = $totalDesembolsado - $totalGasto;

                // Montagem de uma única entrada na tabela para o projeto pesquisado
                $tabela[] = [
                    'recepcao' => $name,
                    'projecto' => $projectAcronym,
                    'data_desembolso' => $startDate->format('Y'),
                    'valor_desembolso' => $totalDesembolsado,
                    'valor_gasto' => $totalGasto,
                    'saldo' => $saldo
                ];

                return view('relatorios.participante.anoV', compact('recepcaos', 'tabela', 'val', 'data', 'data2', 'recepcao_id', 'totalDesembolsado', 'totalGasto', 'projectos'));
            } else {
                $val = true;
                return view('relatorios.participante.anoV', compact('recepcaos', 'val', 'projectos'));
            }
        } else {
            return view('relatorios.participante.anoV', compact('recepcaos', 'val', 'data', 'data2', 'projectos'));
        }
    }






    public function fontedafAnos(Request $request)
    {
        $val = false;
        $desembolsodafs = Desembolsodaf::all();
        $uniqueRows = []; // Array para armazenar linhas únicas

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

                foreach ($interval as $y) {
                    foreach ($desembolsodafs as $adm) {
                        $tEntradas = DB::table('desembolsodafs')->where('daf_id', $adm->id)
                            ->whereYear('created_at', '=', $y)->sum('valor');
                        $tSaidas = DB::table('desembolsos')->where('gerencia_id', $adm->id)
                            ->whereYear('created_at', '=', $y)->sum('valor');
                        $saldo = $tEntradas - $tSaidas;

                        // Verifique se esta combinação já foi adicionada
                        $key = $y . '-' . $adm->daf_id;
                        if (!isset($uniqueRows[$key])) {
                            $uniqueRows[$key] = [$y, 'DAF', $saldo, $tSaidas, $tEntradas];
                            $sum += $saldo;
                            $sum2 += $tEntradas;
                            $sum3 += $tSaidas;
                        }
                    }
                }

                return view('relatorios/fontedaf/anos', [
                    'desembolsodafs' => $desembolsodafs,
                    'tabela' => $uniqueRows,
                    'val' => $val,
                    'sum' => $sum,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ]);
            } else {
                $val = true;
                return view('relatorios/fontedaf/anos', compact('desembolsodafs', 'val'));
            }
        } else {
            return view('relatorios/fontedaf/anos', compact('desembolsodafs', 'val'));
        }
    }

    public function fontedafAno(Request $request)
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

        // Inicialização das variáveis
        $totalDesembolsado = 0;
        $totalGastos = 0;
        $saldo = 0;
        $tabela = []; // Inicialize $tabela como um array vazio

        // Lógica de processamento ao receber uma requisição válida
        if ($data && $data2 && $project_id !== null) {
            if ($data < $data2) {
                $startDate = Carbon::createFromFormat('Y-m-d', $data);
                $endDate = Carbon::createFromFormat('Y-m-d', $data2);

                // Recuperar os desembolsos
                $desembolsos = DB::table('desembolsodafs')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('data', [$startDate, $endDate])
                    ->select('valor as valor_desembolsado', 'data as data_desem')
                    ->get();

                // Recuperar os gastos
                $gastos = DB::table('desembolsos')
                    ->where('projecto_id', $project_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->select('valor as valor_gasto', 'created_at')
                    ->get();

                // Calcular totais
                $totalDesembolsado = $desembolsos->sum('valor_desembolsado');
                $totalGastos = $gastos->sum('valor_gasto');
                $saldo = $totalDesembolsado - $totalGastos; // Calculo do saldo

                // Obter o acrônimo do projeto
                $acronimo = $projectos->find($project_id)->acronimo;

                // Adicionar uma única linha na tabela
                $tabela[] = [
                    'acronimo' => $acronimo,                       // Acrônimo do Projeto
                    'data' => $startDate->format('Y'),     // Ano do Desembolso (apenas o ano do início)
                    'desembolso' => $totalDesembolsado,            // Total Valor Desembolsado
                    'gasto' => $totalGastos,                        // Total Gasto
                    'saldo' => $saldo                               // Saldo
                ];
            } else {
                $val = true; // Flag para indicar erro de intervalo
            }
        }

        // Passa tudo para a view, incluindo a variável $tabela única
        return view('relatorios/fontedaf/ano', compact('projectos', 'tabela', 'val', 'data', 'data2', 'totalDesembolsado', 'totalGastos', 'saldo'));

    }

}
