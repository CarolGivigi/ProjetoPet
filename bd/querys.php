<?php
require_once 'ConexaoBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $hora = $_POST['horaSelecionada']; //campo hidden com a hora escolhida
    $nomeDono = $_POST['nomeDono'];
    $telefone = $_POST['telefone'];
    $nomePet = $_POST['nomePet'];
    $portePet = $_POST['portePet'];
    $servico = $_POST['servicos'];
    $valor = $_POST['valor'];

    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $conexao->begin_transaction();

    try {
        // INSERIR NA TBL_PET primeiro
        $sqlPet = "INSERT INTO tbl_pet (nome, porte) VALUES ('$nomePet', '$portePet')";
        $resultadoPet = $conexao->query($sqlPet);
        if (!$resultadoPet) {
            throw new Exception("Erro ao inserir na tabela tbl_pet");
        }

        // Obter o id do pet inserido acima
        $idPetInserido = $conexao->insert_id;

        // INSERIR NA TBL_DONO
        $sqlDono = "INSERT INTO tbl_dono (nome, telefone, id_pet) VALUES ('$nomeDono', '$telefone', '$idPetInserido')";
        $resultadoDono = $conexao->query($sqlDono);
        if (!$resultadoDono) {
            throw new Exception("Erro ao inserir na tabela tbl_dono");
        }

        // Id do dono inserido
        $idDonoInserido = $conexao->insert_id;

        // Inserção do agendamento
        if ($servico !== '4'){ //se não for hotelzinho
            $sqlAgendamento = "INSERT INTO tbl_agendamento (id_dono, id_pet, id_servico, id_prof, hora_agendamento, data_agendamento, valor) 
                                SELECT '$idDonoInserido', '$idPetInserido', '$servico', fk_prof, '$hora', '$data', '$valor' 
                                FROM tbl_agenda_disponivel 
                                WHERE data = '$data' AND hora = '$hora'";
            
        }else {
            $sqlAgendamento = "INSERT INTO tbl_agendamento (id_dono, id_pet, id_servico, hora_agendamento, data_agendamento, valor) 
                                VALUES ('$idDonoInserido', '$idPetInserido', '$servico', '12:00:00', '$data', '$valor')";
            $vagaPreenchida = "";
        }

        //testa se houve erro em algum agendamento(funciona para todos)
        $resultadoAgendamento = $conexao->query($sqlAgendamento);
        if (!$resultadoAgendamento) {
            throw new Exception("Erro ao inserir na tabela de agendamento");
        }

        // Remover o horário selecionado da tabela de disponibilidade(só vai dar true quando n for hotelzinho, por causa da hora)
        $sqlRemoverHorario = "DELETE FROM tbl_agenda_disponivel WHERE data = '$data' AND hora = '$hora'";
        $resultadoRemoverHorario = $conexao->query($sqlRemoverHorario);
        if (!$resultadoRemoverHorario) {
            throw new Exception("Erro ao remover o horário da tabela tbl_agenda_disponivel");
        }

        //Diminuir vaga após agendamento do hotelzinho(variável de controle)
        if (isset($vagaPreenchida)){
            $sqlDiminuirVagas = "UPDATE tbl_agenda_disponivel_hotel SET vagas = vagas - 1  WHERE data = '$data'";
            $conexao->query($sqlDiminuirVagas);

            // Excluir linha quando o número de vagas chegar a 0
            $sqlExcluirVagasZero = "DELETE FROM tbl_agenda_disponivel_hotel WHERE data = '$data' AND vagas = 0";
            $conexao->query($sqlExcluirVagasZero);
        }

        // Commit da transação se todas as operações forem bem-sucedidas
        $conexao->commit();

        // Verificar se a consulta foi bem-sucedida
        json_encode(array("success" => true));

        echo '<script>window.location.href = "../confirmacao.php";</script>';
        exit;
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $conexao->rollback();
        json_encode(array("success" => false, "error" => $e->getMessage()));
    }
    // Fechar a conexão com o banco de dados
    $conexaoBD->fecharConexao();

}

// Função para buscar os dias disponíveis na modal
function buscarDias() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $sql = "SELECT DISTINCT data, hora FROM tbl_agenda_disponivel";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        $diasEHorariosDisponiveis = array();

        while ($row = $resultado->fetch_assoc()) {
            $data = $row['data'];
            $hora = $row['hora'];

            if (!isset($diasEHorariosDisponiveis[$data])) {
                $diasEHorariosDisponiveis[$data] = array();
            }
            $diasEHorariosDisponiveis[$data][] = $hora;
        }

        $conexaoBD->fecharConexao();

        return $diasEHorariosDisponiveis;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

function buscarDiasHotel() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $sql = "SELECT data, vagas FROM tbl_agenda_disponivel_hotel";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        $datasVagasDisponiveis = array();

        while ($row = $resultado->fetch_assoc()) {
            $data = $row['data'];
            $numeroVagas = $row['vagas'];
            $datasVagasDisponiveis[$data] = $numeroVagas;
        }

        $conexaoBD->fecharConexao();

        return $datasVagasDisponiveis;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

?>
