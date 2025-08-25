<?php
include_once('Empresa.php');

class Trensurb extends Empresa {

    protected string $url = 'https://sisop.trensurb.gov.br/App/getSituacaoOperacional.php?user=trensite&senha=h1ATPtmrKiOxe3qC';

    protected function obterDados() {
        $json = @file_get_contents($this->url);
        return $json ? json_decode($json, true) : null;
    }

    protected function isAlteracaoDeServico(mixed $dados) {
        if (!isset($dados['situacao'])) {
            return "Erro: Estrutura de dados da Trensurb não encontrada.";
        }

        // A situação 'Em Operação Normal' é o status 'normal'.
        if ($dados['situacao'] !== 'Em Operação Normal') {
            return "Situação: {$dados['situacao']} - Descrição: {$dados['descricao']}";
        }
        return false;
    }
}
