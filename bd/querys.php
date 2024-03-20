<?php
// Criar uma instância da classe de conexão
require_once 'ConexaoBD.php';

$conexaoBD = new ConexaoBD();

// Captura os valores do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $nomeDono = $_POST['nomeDono'];
   $nomePet = $_POST['nomePet'];
   $portePet = $_POST['PortePet'];
   $servico = $_POST['servicos'];
   $data = $_POST['data'];
   $hora = $_POST['hora'];
   $prof = $_POST['prof'];

   echo $data . $hora . $prof;
   
   // Inserção no banco de dados
   $sqlPet = "INSERT INTO tbl_pet (nome, porte, id_servico) VALUES ('$nomePet','$portePet','$servico')";
   
   // Executar a consulta SQL para o pet
   $resultadoPet = $conexaoBD->conexao->query($sqlPet);
   
   // Recuperar o último ID inserido na tabela pet
   $ultimoIdPet = $conexaoBD->conexao->insert_id;

   // Inserção no banco de dados para o dono com o id do pet relacionado
   $sqlDono = "INSERT INTO tbl_dono (nome, id_pet) VALUES ('$nomeDono', '$ultimoIdPet')";

   

   $conexaoBD->fecharConexao();

   header("Location: ../index.php");
   exit; // Garantir que o script pare de ser executado após o redirecionamento
}

?>