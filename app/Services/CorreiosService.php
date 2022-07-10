<?php

namespace App\Services;

class CorreiosService
{
    const URL_BASE = 'http://ws.correios.com.br';

    const SERVICO_SEDEX = '04014';
    const SERVICO_SEDEX_12 = '04782';
    const SERVICO_SEDEX_10 = '04790';
    const SERVICO_SEDEX_HOJE = '04804';
    const SERVICO_PAC = '04510';

    const FORMATO_CAIXA_PACOTE = 1;
    const FORMATO_ROLO_PRISMA = 2;
    const FORMATO_ENVELOPE = 3;

    private $codigoEmpresa;
    private $senhaEmpresa;

    public function __construct($codigoEmpresa = '', $senhaEmpresa = '')
    {
        $this->codigoEmpresa = $codigoEmpresa;
        $this->senhaEmpresa = $senhaEmpresa;
    }

    public function calcularFrete(
        $codigoServico,
        $cepOrigem,
        $cepDestino,
        $peso,
        $formato,
        $comprimento,
        $altura,
        $largura,
        $diametro = 0,
        $maoPropria = false,
        $valorDeclarado = 0,
        $avisoRecebimento = false
    )
    {
        $parametros = [
            "nCdEmpresa" => $this->codigoEmpresa,
            "sDsSenha" => $this->senhaEmpresa,
            "nCdServico" => $codigoServico,
            "sCepOrigem" => $cepOrigem,
            "sCepDestino" => $cepDestino,
            "nVlPeso" => $peso,
            "nCdFormato" => $formato,
            "nVlComprimento" => $comprimento,
            "nVlLargura" => $largura,
            "nVlAltura" => $altura,
            "nVlDiametro" => $diametro,
            "sCdMaoPropria" => $maoPropria ? 'S' : 'N',
            "nVlValorDeclarado" => $valorDeclarado,
            "sCdAvisoRecebimento" => $avisoRecebimento ? 'S' : 'N',
            "StrRetorno" => 'xml'
        ];

        $query = http_build_query($parametros);

        $resultado = $this->get('/calculador/CalcPrecoPrazo.aspx?' . $query);

        return $resultado ? $resultado->cServico : null;   
    }

    public function get($resource)
    {
        $endPoint = SELF::URL_BASE . $resource;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $response = curl_exec($curl);
                
        curl_close(($curl));

        return strlen($response) ? simplexml_load_string($response) : null;
    }
}