<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ContratosController extends Controller
{

    private static function getCnpj()
    {
        try {
            $cnpj = DB::table('tbcliente')
                ->select('cnpj_cpf')
                ->where('statuss', 1)
                ->get();

            return $cnpj;
        } catch (Exception $e) {
            exit("getCnpj: " . $e->getMessage());
        }
    }

    public function getContratos()
    {
        try {
            $cnpjs = self::getCnpj();

            foreach ($cnpjs as $cnpj) {
                $contratos = Http::post('https://app.omie.com.br/api/v1/servicos/contrato/', [
                    'call' => 'ListarContratos',
                    'app_key' => '219404447262',
                    'app_secret' => '2c1d5ee2df37fe502681716fd4b0d683',
                    'param' => [
                        ["filtrar_cnpj_cpf" => $cnpj]
                    ]
                ]);
                if ($contratos->status() !== 500) {
                    foreach ($contratos['contratoCadastro'] as $contrato) {
                        $situacao = $contrato['cabecalho']['cCodSit'];
                        if ($situacao === '10') {
                            echo $cnpj . " - " . $situacao . " - " . $contrato['cabecalho']['nCodCtr'] . "\n";
                        } else {
                            echo $cnpj . " - " . $situacao . " - " . "erro" . "\n";
                        }
                    }
                }
            }

            // return json_decode($contrato);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    private static function getListaContasReceber()
    {
        try {
            $cnpjs = self::getCnpj();
            $cods_omie = [];

            foreach ($cnpjs as $cnpj) {
                $contas = Http::post('https://app.omie.com.br/api/v1/financas/contareceber/', [
                    'call' => 'ListarContasReceber',
                    'app_key' => '219404447262',
                    'app_secret' => '2c1d5ee2df37fe502681716fd4b0d683',
                    'param' => [
                        [
                            "filtrar_por_cpf_cnpj" => $cnpj->cnpj_cpf,
                            "filtrar_por_data_de" => "01/03/2023",
                            "filtrar_por_data_ate" => "16/03/2023"
                        ]
                    ]
                ]);
                if ($contas->status() !== 500) {
                    foreach ($contas['conta_receber_cadastro'] as $conta) {
                        $cod_omie = $conta['codigo_lancamento_omie'];
                        array_push($cods_omie, $cod_omie);
                    }
                }
            }
            return $cods_omie;
        } catch (Exception $e) {
            exit("getListaContasReceber: " . $e->getMessage());
        }
    }

    public function getConsultaContasReceber()
    {
        try {
            $contas = self::getListaContasReceber();

            foreach ($contas as $conta) {
                $lancamentos = Http::post('https://app.omie.com.br/api/v1/financas/contareceber/', [
                    "call" => "ConsultarContaReceber",
                    "app_key" => "219404447262",
                    "app_secret" => "2c1d5ee2df37fe502681716fd4b0d683",
                    "param" => [
                        [
                            "codigo_lancamento_omie" => $conta,
                        ]
                    ]
                ]);

                if ($lancamentos->status() !== 500) {
                    print_r($lancamentos['codigo_cliente_fornecedor']);
                    print_r($lancamentos['valor_documento']);
                    print_r($lancamentos['status_titulo']);
                    print_r($lancamentos['observacao']);
                    echo "\n";
                }
            }
        } catch (Exception $e) {
            exit("getConsultaContasReceber: " . $e->getMessage());
        }
    }
}
