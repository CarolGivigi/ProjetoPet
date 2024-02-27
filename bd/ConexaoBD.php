<?php
class ConexaoBD {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "projetopet";
    public $conn;

    // Método construtor
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Falha na conexão: " . $this->conn->connect_error);
        }
    }

    // Método para fechar a conexão
    public function fecharConexao() {
        $this->conn->close();
    }
}
?>