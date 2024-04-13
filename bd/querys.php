<?php
require_once 'ConexaoBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $hora = $_POST['horaSelecionada']; //campo hidden com a hora escolhida
    $nomeDono = $_POST['nomeDono'];
    $email = $_POST['email'];
    $nomePet = $_POST['nomePet'];
    $portePet = $_POST['portePet'];
    $servico = $_POST['servicos'];
    $valor = $_POST['valor'];

    // Criar uma instância da conexão com o banco de dados
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    // Iniciar uma transação para garantir a consistência dos dados
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


// Função para buscar os horários disponíveis na modal(por enquanto, desativada por conta das panes do POST)
// function buscarHorarios() {
//     // Criar uma instância da classe de conexão
//     $conexaoBD = new ConexaoBD();
//     $conexao = $conexaoBD->conexao;

//     // Query SQL para buscar os horários disponíveis
//     $sql = "SELECT DISTINCT hora FROM tbl_agenda_disponivel";

//     $resultado = $conexao->query($sql);

//     // Verificar se a query foi bem-sucedida
//     if ($resultado) {
//         // Inicializar um array para armazenar os horários disponíveis
//         $horarios = array();

//         // Loop através dos resultados e adicionar os horários ao array
//         while ($row = $resultado->fetch_assoc()) {
//             $horarios[] = $row['hora'];
//         }

//         // Retornar os horários disponíveis
//         return $horarios;
//     } else {
//         // Se houver um erro na query, retornar false
//         return false;
//     }
//     $conexaoBD->fecharConexao();
// }

// Função para buscar os dias disponíveis na modal
function buscarDias() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    // Query SQL para buscar os dias e os horários disponíveis
    $sql = "SELECT DISTINCT data, hora FROM tbl_agenda_disponivel";

    // Executar a query
    $resultado = $conexao->query($sql);

    // Verificar se a query foi bem-sucedida
    if ($resultado) {
        // Inicializar um array para armazenar os dias disponíveis e os horários correspondentes
        $diasEHorariosDisponiveis = array();

        // Loop através dos resultados
        while ($row = $resultado->fetch_assoc()) {
            $data = $row['data'];
            $hora = $row['hora'];

            // Adicionar a data como chave do array, e os horários disponíveis como valores correspondentes
            if (!isset($diasEHorariosDisponiveis[$data])) {
                $diasEHorariosDisponiveis[$data] = array();
            }
            $diasEHorariosDisponiveis[$data][] = $hora;
        }

        // Fechar a conexão antes de retornar os dias e horários disponíveis
        $conexaoBD->fecharConexao();

        // Retornar os dias e horários disponíveis
        return $diasEHorariosDisponiveis;
    } else {
        // Se houver um erro na query, retornar false
        $conexaoBD->fecharConexao();
        return false;
    }
}

// function buscarDias() {
//     $conexaoBD = new ConexaoBD();
//     $conexao = $conexaoBD->conexao;

//     // Query SQL para buscar os dias disponíveis
//     $sql = "SELECT DISTINCT data FROM tbl_agenda_disponivel";

//     // Executar a query
//     $resultado = $conexao->query($sql);

//     // Verificar se a query foi bem-sucedida
//     if ($resultado) {
//         // Inicializar um array para armazenar os dias disponíveis
//         $diasDisponiveis = array();

//         // Loop através dos resultados e adicionar os dias ao array
//         while ($row = $resultado->fetch_assoc()) {
//             $diasDisponiveis[] = $row['data'];
//         }

//         // Fechar a conexão antes de retornar os dias disponíveis
//         $conexaoBD->fecharConexao();

//         // Retornar os dias disponíveis
//         return $diasDisponiveis;
//     } else {
//         // Se houver um erro na query, retornar false
//         $conexaoBD->fecharConexao();
//         return false;
//     }
// }

?>