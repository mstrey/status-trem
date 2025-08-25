<?php
class MetroSP extends Empresa {

    protected string $url = 'https://www.metro.sp.gov.br/wp-content/themes/metrosp/direto-metro.php';

    protected function obterDados() {
        $html = @file_get_contents($this->url);
        if (!$html) {
            return null;
        }

        // Usa expressão regular para extrair a string JSON do HTML.
        if (preg_match('/var linhas = ({.*?});/', $html, $matches)) {
            $jsonString = $matches[1];
            // O json retornado possui um ; no final, então é preciso removê-lo
            $jsonString = trim($jsonString, ' ;');
            return json_decode($jsonString, true);
        }
        return null;
    }

    protected function isAlteracaoDeServico(mixed $dados) {
        if (!isset($dados['status_operacional']) || !is_array($dados['status_operacional'])) {
            return "Erro: Estrutura de dados do Metrô-SP não encontrada.";
        }

        $problemas = [];
        foreach ($dados['status_operacional'] as $linha) {
            // A situação 'Normal' é o status 'normal'.
            if (isset($linha['cor']) && strtolower($linha['cor']) !== 'normal') {
                $problemas[] = "Linha " . $linha['linha'] . " - Situação: " . $linha['cor'] . " - " . $linha['titulo'];
            }
        }
        return count($problemas) > 0 ? implode("\n", $problemas) : false;
    }
}
