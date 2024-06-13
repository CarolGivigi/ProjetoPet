<?php
require_once 'ConexaoBD.php';

function obterFuncionarios() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;
    
    $query = "SELECT * FROM tbl_profissional";

    $result = $conexao->query($query);

    $funcionarios = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $funcionarios[] = $row;
        }
    }
    $conexao->close();
    return $funcionarios;
}

function obterServicos() {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;
    
    $query = "SELECT * FROM tbl_servico";

    $result = $conexao->query($query);

    $servicos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $servicos[] = $row;
        }
    }
    $conexao->close();
    return $servicos;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'excluirFunc':
                if (isset($_POST['idFunc'])) {
                    $idFunc = $_POST['idFunc'];
                    $resultado = excluirFunc($idFunc);
                    echo json_encode(array("success" => $resultado));
                } else {
                    echo json_encode(array("success" => false, "message" => "ID do funcionário não fornecido."));
                }
            break;
            case 'editarFunc':
                // if (isset($_POST['idFunc']) && isset($_POST['novoNome'])) {
                //     $idFunc = $_POST['idFunc'];
                //     $novoNome = $_POST['novoNome'];
                //     $resultado = editarFunc($idFunc, $novoNome);
                //     echo json_encode(array("success" => $resultado));
                // } else {
                //     echo json_encode(array("success" => false, "message" => "Dados do funcionário não fornecidos."));
                // }
            break;
            case 'adicionarFunc':
                if (isset($_POST['nome'])) {
                    $nome = $_POST['nome'];
                    $resultado = adicionarFunc($nome);
                    echo json_encode(array("success" => $resultado !== false, "id" => $resultado));
                } else {
                    echo json_encode(array("success" => false, "message" => "Nome do funcionário não fornecido."));
                }
            break;
            case 'excluirServ':
                if (isset($_POST['idServ'])) {
                    $idServ = $_POST['idServ'];
                    $resultado = excluirServ($idServ);
                    echo json_encode(array("success" => $resultado));
                } else {
                    echo json_encode(array("success" => false, "message" => "ID do serviço não fornecido."));
                }
                break;
            case 'editarServ':
                // if (isset($_POST['idServ']) && isset($_POST['novoNome'])) {
                //     $idFunc = $_POST['idFunc'];
                //     $novoNome = $_POST['novoNome'];
                //     $resultado = editarFunc($idFunc, $novoNome);
                //     echo json_encode(array("success" => $resultado));
                // } else {
                //     echo json_encode(array("success" => false, "message" => "Dados do funcionário não fornecidos."));
                // }
            break;
            case 'adicionarServ':
                if (isset($_POST['nome'])) {
                    $nome = $_POST['nome'];
                    $resultado = adicionarServ($nome);
                    echo json_encode(array("success" => $resultado !== false, "id" => $resultado));
                } else {
                    echo json_encode(array("success" => false, "message" => "Nome do serviço não fornecido."));
                }
            break;
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Ação não especificada."));
    }
}

function excluirFunc($idFunc) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $idFunc = $conexao->real_escape_string($idFunc);
    $sql = "DELETE FROM tbl_profissional WHERE id = '$idFunc'";

    if ($conexao->query($sql) === TRUE) {
        $conexaoBD->fecharConexao();
        return true;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

// function editarFunc($idFunc, $novoNome) {
//     $conexaoBD = new ConexaoBD();
//     $conexao = $conexaoBD->conexao;
//     $idFunc = $conexao->real_escape_string($idFunc);
//     $novoNome = $conexao->real_escape_string($novoNome);
//     $sql = "UPDATE tbl_profissional SET nome = '$novoNome' WHERE id = '$idFunc'";
//     if ($conexao->query($sql) === TRUE) {
//         $conexaoBD->fecharConexao();
//         return true;
//     } else {
//         $conexaoBD->fecharConexao();
//         return false;
//     }
// }

function adicionarFunc($nome) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $nome = $conexao->real_escape_string($nome);
    $sql = "INSERT INTO tbl_profissional (nome) VALUES ('$nome')";

    if ($conexao->query($sql) === TRUE) {
        $id = $conexao->insert_id;
        $conexaoBD->fecharConexao();
        return $id;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}


function excluirServ($idServ) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $idServ = $conexao->real_escape_string($idServ);
    $sql = "DELETE FROM tbl_servico WHERE id = '$idServ'";

    if ($conexao->query($sql) === TRUE) {
        $conexaoBD->fecharConexao();
        return true;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

// function editarServ($idFunc, $novoNome) {
//     $conexaoBD = new ConexaoBD();
//     $conexao = $conexaoBD->conexao;
//     $idFunc = $conexao->real_escape_string($idFunc);
//     $novoNome = $conexao->real_escape_string($novoNome);
//     $sql = "UPDATE tbl_profissional SET nome = '$novoNome' WHERE id = '$idFunc'";
//     if ($conexao->query($sql) === TRUE) {
//         $conexaoBD->fecharConexao();
//         return true;
//     } else {
//         $conexaoBD->fecharConexao();
//         return false;
//     }
// }

function adicionarServ($nome) {
    $conexaoBD = new ConexaoBD();
    $conexao = $conexaoBD->conexao;

    $nome = $conexao->real_escape_string($nome);
    $sql = "INSERT INTO tbl_servico (nome) VALUES ('$nome')";

    if ($conexao->query($sql) === TRUE) {
        $id = $conexao->insert_id;
        $conexaoBD->fecharConexao();
        return $id;
    } else {
        $conexaoBD->fecharConexao();
        return false;
    }
}

?>
