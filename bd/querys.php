<?php
// Criar uma instância da classe de conexão
require_once 'ConexaoBD.php';

 // Captura os valores do formulário e insere no banco
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $hora = $_POST['horario'];
    $nomeDono = $_POST['nomeDono'];
    $nomePet = $_POST['nomePet'];
    $portePet = $_POST['portePet'];
    $servico = $_POST['servicos'];
    $valor = $_POST['valor'];

    //Criar uma instância da conexão com o banco de dados
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    //INSERIR NA TBL_PET primeiro
    $sqlPet = "INSERT INTO tbl_pet (nome, porte) VALUES ('$nomePet', '$portePet')";
    $resultado = $conexao->query($sqlPet);

    //obter o id do pet inserido acima
    $idPetInserido = $conexao->insert_id;

    $sqlDono = "INSERT INTO tbl_dono (nome, id_pet) VALUES ('$nomeDono', '$idPetInserido')";
    $resultado = $conexao->query($sqlDono);

    //id dono inserido
    $idDonoInserido = $conexao->insert_id;

    //inserção agendamento
    $sqlAgendamento = "INSERT INTO tbl_agendamento (id_dono, id_pet, id_servico, id_prof, hora_agendamento, data_agendamento, valor) 
                       SELECT '$idDonoInserido', '$idPetInserido', '$servico', fk_prof, '$hora', '$data', '$valor' 
                       FROM tbl_agenda_disponivel 
                       WHERE data = '$data' AND hora = '$hora'";

    $resultado = $conexao->query($sqlAgendamento);
    
    //Verificar se a consulta foi bem-sucedida
    if ($resultado) {
        json_encode(array("success" => true));
        echo '<script>window.location.href = "../confirmacao.php";</script>';
        exit;
    } else {
        json_encode(array("success" => false));
    }

    // Fechar a conexão com o banco de dados
    $conexaoBD->fecharConexao();
}

// Função para buscar os horários disponíveis na modal
    function buscarHorarios() {
        // Criar uma instância da classe de conexão
        $conexaoBD = new ConexaoBD();
        $conexao = $conexaoBD->conexao;
    
        // Query SQL para buscar os horários disponíveis
        $sql = "SELECT DISTINCT hora FROM tbl_agenda_disponivel";
    
        // Executar a query
        $resultado = $conexao->query($sql);
    
        // Verificar se a query foi bem-sucedida
        if ($resultado) {
            // Inicializar um array para armazenar os horários disponíveis
            $horarios = array();
    
            // Loop através dos resultados e adicionar os horários ao array
            while ($row = $resultado->fetch_assoc()) {
                $horarios[] = $row['hora'];
            }
    
            // Retornar os horários disponíveis
            return $horarios;
        } else {
            // Se houver um erro na query, retornar false
            return false;
        }
        $conexaoBD->fecharConexao();
    }
 
 // Função para buscar os dias disponíveis na modal
    function buscarDias() {
        // Criar uma instância da classe de conexão
        $conexaoBD = new ConexaoBD();
        $conexao = $conexaoBD->conexao;
    
        // Query SQL para buscar os dias disponíveis
        $sql = "SELECT DISTINCT data FROM tbl_agenda_disponivel";
    
        // Executar a query
        $resultado = $conexao->query($sql);
    
        // Verificar se a query foi bem-sucedida
        if ($resultado) {
            // Inicializar um array para armazenar os dias disponíveis
            $diasDisponiveis = array();
    
            // Loop através dos resultados e adicionar os dias ao array
            while ($row = $resultado->fetch_assoc()) {
                $diasDisponiveis[] = $row['data'];
            }
    
            // Retornar os dias disponíveis
            return $diasDisponiveis;
        } else {
            // Se houver um erro na query, retornar false
            return false;
        }
        $conexaoBD->fecharConexao();
    }


?>