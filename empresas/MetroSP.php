<?php
include_once('Empresa.php');

class MetroSP extends Empresa {

	protected string $url = 'https://www.metro.sp.gov.br/wp-content/themes/metrosp/direto-metro.php';

    protected function obterArrStatus() {
		$html = @file_get_contents($this->url);
		if (!$html) {
			return [];
		}
		$arrDados = [];
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		$xpath = new DOMXPath($dom);

		$linhas = [];
		$listItems = $xpath->query('//ol/li');
        $this->gravaLog("$$$$$ DADOS INI $$$$$\n");
        $this->gravaLog(print_r($listItems, true));
        $this->gravaLog("$$$$$ DADOS FIM $$$$$\n");
		foreach ($listItems as $item) {
			$linhaNode = $xpath->query('.//div[@class="linha-nome"]', $item)->item(0);
			$statusNode = $xpath->query('.//div[@class="linha-situacao"]', $item)->item(0);
			$infoNode = $xpath->query('.//div[contains(@class,"linha-info")]', $item)->item(0);

            $arrDados[] = [
				'linha' => trim($linhaNode->textContent),
				'status' => trim($statusNode->textContent),
				'descricao' => trim($infoNode->textContent),
            ];
		}
        return $arrDados;
    }

}
