<?php
require_once './ConexaoBD.php';

$conexaoBD = new ConexaoBD();
$conexao = $conexaoBD->conexao;

// Verificar se a agenda já foi preenchida para o dia atual
$data_atual = date('Y-m-d');
$sql_verificar_execucao = "SELECT * FROM tbl_ultima_execucao WHERE data = '$data_atual'";
$resultado_verificacao = $conexao->query($sql_verificar_execucao);

if ($resultado_verificacao->num_rows == 0) {
    // Definir o horário de trabalho
    $hora = '10:00:00';

    // Definir o id inicial do profissional
    $prof = 1;

    // Contador de dias úteis preenchidos
    $dias_preenchidos = 0;

    // Definir a data atual como ponto de partida
    $data_atual = date('Y-m-d');

    // Loop para preencher a agenda para os próximos 15 dias úteis
    while ($dias_preenchidos < 15) {
        // Verificar se a data atual é um dia útil (de segunda a sexta-feira)
        if (date('N', strtotime($data_atual)) <= 5) {
            // Verificar se o horário atual está dentro do horário de trabalho
            while ($hora <= '18:00:00') {
                // Preencher a agenda para o dia atual
                // echo('inseriu' . '<br>');
                $sql = "INSERT INTO tbl_agenda_disponivel (data, hora, fk_prof) VALUES ('$data_atual', '$hora', '$prof')";
                $conexao->query($sql);

                // Incrementar o id do profissional
                $prof++;
                if ($prof > 4) {
                    $prof = 1;
                }

                $hora = date('H:i:s', strtotime($hora . ' +2 hours'));
            }
            // Incrementar o contador de dias preenchidos
            $dias_preenchidos++;
        }
        
        echo(' dias preenchidos - '.$dias_preenchidos . '<br>');
        // Avançar para o próximo dia
        $data_atual = date('Y-m-d', strtotime($data_atual . ' +1 day'));
        echo('data ' . $data_atual . '<br>');
        $hora = '10:00:00';
    }

    // Registrar a execução
    $data_atual = date('Y-m-d');
    $sql_registrar_execucao = "INSERT INTO tbl_ultima_execucao (data) VALUES ('$data_atual')";
    $conexao->query($sql_registrar_execucao);

    echo "Agenda preenchida com sucesso para os próximos 15 dias úteis a partir de hoje.";
} else {
    echo "Agenda já foi preenchida hoje.";
}
?>
