<?php
require_once 'ConexaoBD.php';
//require_once 'enviaEmail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $hora = $_POST['horaSelecionada']; //campo hidden com a hora escolhida
    $nomeDono = $_POST['nomeDono'];
    $email = $_POST['email'];
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
        $sqlDono = "INSERT INTO tbl_dono (nome, email, id_pet) VALUES ('$nomeDono', '$email', '$idPetInserido')";
        $resultadoDono = $conexao->query($sqlDono);
        if (!$resultadoDono) {
            throw new Exception("Erro ao inserir na tabela tbl_dono");
        }

        // Id do dono inserido
        $idDonoInserido = $conexao->insert_id;

        // Inserção do agendamento
        $sqlAgendamento = "INSERT INTO tbl_agendamento (id_dono, id_pet, id_servico, id_prof, hora_agendamento, data_agendamento, valor) 
                            SELECT '$idDonoInserido', '$idPetInserido', '$servico', fk_prof, '$hora', '$data', '$valor' 
                            FROM tbl_agenda_disponivel 
                            WHERE data = '$data' AND hora = '$hora'";

        $resultadoAgendamento = $conexao->query($sqlAgendamento);
        if (!$resultadoAgendamento) {
            throw new Exception("Erro ao inserir na tabela tbl_agendamento");
        }

        // Remover o horário selecionado da tabela de disponibilidade
        $sqlRemoverHorario = "DELETE FROM tbl_agenda_disponivel WHERE data = '$data' AND hora = '$hora'";
        $resultadoRemoverHorario = $conexao->query($sqlRemoverHorario);
        if (!$resultadoRemoverHorario) {
            throw new Exception("Erro ao remover o horário da tabela tbl_agenda_disponivel");
        }

        // Commit da transação se todas as operações forem bem-sucedidas
        $conexao->commit();

        // Verificar se a consulta foi bem-sucedida
        json_encode(array("success" => true));

        // Parâmetros para o e-mail
        // $assunto = "Confirmação de Agendamento";
        // $mensagem = "Funcionou ein";
        // $mensagem = "Olá $nomeDono,<br><br>O seu agendamento foi confirmado com sucesso para o dia $data às $hora.<br><br>Atenciosamente,<br> Pet Shop da Carol.";

        // Enviar e-mail
        //enviarEmail($email, $assunto, $mensagem); 

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