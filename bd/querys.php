<?php
// Criar uma instância da classe de conexão
require_once 'ConexaoBD.php';

$conexaoBD = new ConexaoBD();

// Captura os valores do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $nomeDono = $_POST['nomeDono'];
   $nomePet = $_POST['nomePet'];

   // Inserção no banco de dados
   $sqlDono = "INSERT INTO tbl_dono (nome) VALUES ('$nomeDono')";
   $sqlPet = "INSERT INTO tbl_pet (nome) VALUES ('$nomePet')";

   // Executar as consultas SQL
   $resultadoDono = $conexaoBD->conexao->query($sqlDono);
   $resultadoPet = $conexaoBD->conexao->query($sqlPet);

   // Verificar se ocorreu algum erro na inserção do dono
   // if ($resultadoDono === TRUE) {
   //     echo "Dono inserido com sucesso!";
   // } else {
   //     echo "Erro na inserção do dono: " . $conexaoBD->conexao->error;
   // }

   // // Verificar se ocorreu algum erro na inserção do pet
   // if ($resultadoPet === TRUE) {
   //     echo "Pet inserido com sucesso!";
   // } else {
   //     echo "Erro na inserção do pet: " . $conexaoBD->conexao->error;
   // }

   // Fechar a conexão ao final do script
   $conexaoBD->fecharConexao();
}
?>