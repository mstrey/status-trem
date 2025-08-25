<?php
class CPTM extends Empresa {

    protected string $url = 'https://api.cptm.sp.gov.br/AppCPTM/v1/Linhas/ObterStatus';

    protected function obterDados() {
        $json = @file_get_contents($this->url);
        return $json ? json_decode($json, true) : null;
    }

    protected function isAlteracaoDeServico(mixed $dados) {
        if (!is_array($dados)) {
            return "Erro: Estrutura de dados da CPTM inválida.";
        }

        $problemas = [];
        foreach ($dados as $linha) {
            // O status 'NORMAL' é o status 'normal'.
            if (isset($linha['Status']) && $linha['Status'] !== 'NORMAL') {
                $problemas[] = "Linha " . $linha['Linha'] . " - Situação: " . $linha['Status'] . " - " . $linha['Descricao'];
            }
        }
        return count($problemas) > 0 ? implode("\n", $problemas) : false;
    }
}
