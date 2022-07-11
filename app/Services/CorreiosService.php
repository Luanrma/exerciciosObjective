<?php

namespace App\Services;

use SebastianBergmann\Type\ObjectType;
use SimpleXMLElement;

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

    public function calculateShipping(array $params)
    {
        $data = [
            "nCdEmpresa" => $this->codigoEmpresa,
            "sDsSenha" => $this->senhaEmpresa,
            "nCdServico" => $params['codigoServico'],
            "sCepOrigem" => $params['cepOrigem'],
            "sCepDestino" => $params['cepDestino'],
            "nVlPeso" => $params['peso'],
            "nCdFormato" => $params['formato'],
            "nVlComprimento" => $params['comprimento'],
            "nVlLargura" => $params['largura'],
            "nVlAltura" => $params['altura'],
            "nVlDiametro" => $params['diametro'],
            "sCdMaoPropria" => $params['maoPropria'] ? 'S' : 'N',
            "nVlValorDeclarado" => $params['valorDeclarado'],
            "sCdAvisoRecebimento" => $params['avisoRecebimento'] ? 'S' : 'N',
            "StrRetorno" => 'xml'
        ];

        $query = http_build_query($data);

        $result = $this->sendRequest('/calculador/CalcPrecoPrazo.aspx?' . $query);

        return $result ? $result->cServico : null;   
    }

    private function sendRequest($resource)
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

        return strlen($response) ? new SimpleXMLElement($response) : null;
    }
}