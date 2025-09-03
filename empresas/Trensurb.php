<?php
include_once('Empresa.php');

class Trensurb extends Empresa {

    protected string $url = 'https://sisop.trensurb.gov.br/App/getSituacaoOperacional.php?user=trensite&senha=h1ATPtmrKiOxe3qC';

    protected const ARR_SITUACAO_NORMAL = [4];

    protected function obterArrStatus() {
        $json = @file_get_contents($this->url);
        $linha = json_decode($json, true) ?? [];
        $this->gravaLog("$$$$$ DADOS INI $$$$$\n");
        $this->gravaLog(print_r($linha, true));
        $this->gravaLog("$$$$$ DADOS FIM $$$$$\n");
        $arrDados = [];
        
        $arrDados[] = [
            "linha" => "Principal",
            "status" => $this->getStatus($linha['status-situacao-operacional']),
            "descricao" => "{$linha['descricao-situacao-operacional']} - {$linha['motivo']}"
        ];
        return $arrDados;
    }

    private function getStatus(string $id) {
        return match ($id) {
            "4" => "Operação Normal",
            //4 => "Operação com alteração de serviço.",
            default => "Operação com alteração de serviço."
        };
    }

}
