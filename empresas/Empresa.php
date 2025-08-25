abstract class Empresa implements IServicoTransporte {
    /**
     * @var string A URL da API da empresa.
     */
    protected string $url;

    /**
     * Construtor da classe Empresa.
     *
     * @param string $url A URL da API.
     */
    public function __construct(string $url) {
        $this->url = $url;
    }

    /**
     * Método abstrato para obter os dados da API.
     * Cada classe concreta deve implementar este método para lidar com
     * a estrutura de resposta específica da sua API.
     *
     * @return mixed Os dados da API, geralmente um array ou objeto.
     */
    abstract protected function obterDados();

    /**
     * Método abstrato para verificar se há uma alteração de serviço.
     * Retorna a descrição do problema se houver, ou false caso contrário.
     *
     * @param mixed $dados Os dados obtidos da API.
     * @return string|false A descrição da alteração ou false.
     */
    abstract protected function isAlteracaoDeServico(mixed $dados);

    /**
     * Método que simula o salvamento de dados em um serviço Elastic (ELK).
     *
     * @param string $descricao A descrição da alteração de serviço.
     * @param string $hora A hora em que a alteração foi detectada.
     */
    protected function salvarDados(string $descricao, string $hora) {
        echo "--> Simulação de envio para o Elastic:\n";
        echo "  - Empresa: " . get_class($this) . "\n";
        echo "  - Hora: {$hora}\n";
        echo "  - Descrição: {$descricao}\n";
        echo "----------------------------------------\n";
    }

    /**
     * Orquestra a verificação e o salvamento dos dados.
     * Implementa a lógica principal do projeto.
     */
    public function checarStatus() {
        echo "Verificando status de " . get_class($this) . "...\n";
        $dados = $this->obterDados();
        $descricao = $this->isAlteracaoDeServico($dados);

        if ($descricao !== false) {
            $hora = date('Y-m-d H:i:s');
            echo "Status fora do normal! {$descricao}\n";
            $this->salvarDados($descricao, $hora);
        } else {
            echo "Status normal. Nenhuma alteração a ser registrada.\n";
            echo "----------------------------------------\n";
        }
    }
}
