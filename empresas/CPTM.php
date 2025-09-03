<?php
include_once('Empresa.php');

class CPTM extends Empresa {

    protected string $url = 'https://api.cptm.sp.gov.br/AppCPTM/v1/Linhas/ObterStatus';

    private const ARR_LINHAS = [
        7 => "Rubi",
        10 => "Turquesa",
        11 => "Coral",
        12 => "Safira",
        13 => "Jade",
    ];

    protected function obterArrStatus() {
        $json = @file_get_contents($this->url);
        $dados = json_decode($json, true) ?? [];
        $this->gravaLog("$$$$$ DADOS INI $$$$$\n");
        $this->gravaLog(print_r($dados, true));
        $this->gravaLog("$$$$$ DADOS FIM $$$$$\n");
        $arrDados = [];
        foreach ($dados as $linha) {
            $arrDados[] = [
                "linha" => self::ARR_LINHAS[$linha['linhaId']],
                "status" => $linha['status'],
                "descricao" => $linha['descricao']
            ];
        }
        return $arrDados;
    }

}
