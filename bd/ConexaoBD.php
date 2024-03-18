<?php
class ConexaoBD {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "projetopet";
    public $conexao;

    // Método construtor
    public function __construct() {
        $this->conexao = new mysqli($this->servername, $this->username, $this->password, $this->database);
        
        if ($this->conexao->connect_error) {
            die("Falha na conexão: " . $this->conexao->connect_error);
        }
        //echo "Conexão com o banco de dados estabelecida com sucesso!";
    }

    // Método para fechar a conexão
    public function fecharConexao() {
        $this->conexao->close();
    }
}
?>