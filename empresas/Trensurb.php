<?php
include_once('Empresa.php');

class Trensurb extends Empresa {

    protected string $url = 'https://sisop.trensurb.gov.br/App/getSituacaoOperacional.php?user=trensite&senha=h1ATPtmrKiOxe3qC';

    protected const ARR_SITUACAO_NORMAL = [4];
    
    protected function obterDados() {
        $json = @file_get_contents($this->url);
        return $json ? json_decode($json, true) : null;
    }

    protected function isAlteracaoDeServico(mixed $dados) {
        if (!isset($dados['status-situacao-operacional'])) {
            return "Erro: Estrutura de dados da Trensurb não encontrada.\n" . print_r($dados, true);
        }

        if (!in_array($dados['status-situacao-operacional'], self::ARR_SITUACAO_NORMAL)) {
            return "Situação: {$dados['situacao']} - Descrição: {$dados['descricao']} - {$dados['motivo']}";
        }
        return false;
    }
}
