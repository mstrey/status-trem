<?php
include_once('IServicoTransporte.php');

abstract class Empresa implements IServicoTransporte {
    /**
     * @var string A URL da API da empresa.
     */
    protected string $url;

    public const LOG_FILE = '/app/console.log';

    protected function gravaLog(string $texto) {
        $hora = date('Y-m-d H:i:s 0');
        file_put_contents(self::LOG_FILE, "$hora >> $texto\n", FILE_APPEND);
    }

    public function __construct() {
    }

    /**
     * Método abstrato para obter os dados da API.
     * Cada classe concreta deve implementar este método para lidar com
     * a estrutura de resposta específica da sua API.
     *
     * @return mixed Os dados da API, geralmente um array ou objeto.
     */
    abstract protected function obterArrStatus();

    /**
     * Método que simula o salvamento de dados em um serviço Elastic (ELK).
     *
     * @param array $status dados de status da linha
     */
    protected function salvarStatus(array $status) {
        $empresa = get_class($this);
        $registro = <<<JSON
            {
                "empresa": "$empresa",
                "linha": "{$status['linha']}",
                "descricao": "{$status['descricao']}",
                "status": "{$status['status']}"
            }
JSON;
        $this->gravaLog("***** JSON INI *****\n");
        $this->gravaLog($registro);
        $this->gravaLog("***** JSON FIM *****\n");
    }

    /**
     * Orquestra a verificação e o salvamento dos dados.
     * Implementa a lógica principal do projeto.
     */
    public function checarStatus() {
        $this->gravaLog("##### " . get_class($this) . " INI #####\n");
        $arrStatus = $this->obterArrStatus();
        foreach ($arrStatus as $status) {
            $this->salvarStatus($status);
        }
        $this->gravaLog("##### " . get_class($this) . " FIM #####\n");
    }
}
