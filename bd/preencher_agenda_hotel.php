<?php
require_once './ConexaoBD.php';

$conexaoBD = new ConexaoBD();
$conexao = $conexaoBD->conexao;

// Definir a data atual como ponto de partida
$data_atual = date('Y-m-d');
$dias_preenchidos = 0;

// Loop para preencher a agenda para os próximos 15 dias
while ($dias_preenchidos < 15) {
    // Inserir a data na tabela do hotel
    $sql = "INSERT INTO tbl_agenda_disponivel_hotel (data, vagas) VALUES ('$data_atual','5')";
    $conexao->query($sql);
    // Incrementar o contador de dias preenchidos
    $dias_preenchidos++;
    // Avançar para o próximo dia
    $data_atual = date('Y-m-d', strtotime($data_atual . ' +1 day'));
}

// Registrar a execução
$data_atual = date('Y-m-d');
$sql_registrar_execucao = "INSERT INTO tbl_ultima_execucao (data) VALUES ('$data_atual')";
$conexao->query($sql_registrar_execucao);

echo "Agenda preenchida com sucesso para os próximos 15 dias a partir de hoje.";
?>
