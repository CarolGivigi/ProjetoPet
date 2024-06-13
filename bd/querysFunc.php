<?php
require_once 'ConexaoBD.php';

function obterAgendamentos() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $query = "
        SELECT 
            ag.id, 
            ag.data_agendamento, 
            ag.hora_agendamento, 
            d.nome AS dono, 
            d.telefone AS telefone,
            p.nome AS pet, 
            prof.nome AS profissional, 
            s.nome AS servico, 
            ag.valor 
        FROM tbl_agendamento ag
        JOIN tbl_dono d ON ag.id_dono = d.id
        JOIN tbl_pet p ON ag.id_pet = p.id
        LEFT JOIN tbl_profissional prof ON ag.id_prof = prof.id
        JOIN tbl_servico s ON ag.id_servico = s.id
        WHERE ag.status != 'FINALIZADO'
        ORDER BY ag.data_agendamento, ag.hora_agendamento
    ";

    $result = $conexao->query($query);

    $agendamentos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $agendamentos[] = $row;
        }
    }
    $conexao->close();
    return $agendamentos;
}

function obterFinalizados() {
        $conexaoBD = new ConexaoBD();
        $conexao = $conexaoBD->conexao;
        
        $query = "
            SELECT 
                ag.id, 
                ag.data_agendamento, 
                ag.hora_agendamento, 
                d.nome AS dono, 
                d.telefone AS telefone,
                p.nome AS pet, 
                prof.nome AS profissional, 
                s.nome AS servico, 
                ag.valor 
            FROM tbl_agendamento ag
            JOIN tbl_dono d ON ag.id_dono = d.id
            JOIN tbl_pet p ON ag.id_pet = p.id
            LEFT JOIN tbl_profissional prof ON ag.id_prof = prof.id
            JOIN tbl_servico s ON ag.id_servico = s.id
            WHERE ag.status = 'FINALIZADO'
            ORDER BY ag.data_agendamento, ag.hora_agendamento
        ";
    
        $result = $conexao->query($query);
    
        $agendamentos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $agendamentos[] = $row;
            }
        }
        $conexao->close();
        return $agendamentos;
    
    
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'excluirAgendamento':
                if (isset($_POST['idAgendamento'])) {
                    $idAgendamento = intval($_POST['idAgendamento']);
                    if (excluirAgendamento($idAgendamento)) {
                        echo json_encode(["success" => true]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Erro ao excluir o agendamento."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "ID do agendamento não fornecido."]);
                }
                break;
            case 'confAgendamento':
                if (isset($_POST['idAgendamento'])) {
                    $idAgendamento = intval($_POST['idAgendamento']);
                    if (confAgendamento($idAgendamento)) {
                        echo json_encode(["success" => true]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Erro ao confirmar o agendamento."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "ID do agendamento não fornecido."]);
                }
                break;
        }
    }
}

function excluirAgendamento($idAgendamento) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $sql = "DELETE FROM tbl_agendamento WHERE id = $idAgendamento";

    if ($conexao->query($sql) === TRUE) {
        $conexaoBD->fecharConexao();
        return true;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

function confAgendamento($idAgendamento) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $sql = "UPDATE tbl_agendamento SET status = 'FINALIZADO' WHERE id = $idAgendamento";

    if ($conexao->query($sql) === TRUE) {
        $conexaoBD->fecharConexao();
        return true;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}


?>
