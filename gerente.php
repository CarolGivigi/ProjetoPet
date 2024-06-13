<?php
include('funcionario.php');
require_once('./bd/querysGer.php');
$funcionarios = obterFuncionarios();
$servicos = obterServicos();
?>

<html>
<body>
    <head>
        <link rel="stylesheet" href="./css/estilo2.css">
    </head>
    <div class="container-fluid">
        <!-- FUNCIONARIOS -->
        <div class="row mt-5">
            <div class="col-sm-5">
                <div>
                    <span id="toggleFunc" style="cursor: pointer; font-size:20px; color: #0c856d; -webkit-text-stroke-color: #788889; ">&#x25B6; Gerenciar Funcionários</span>
                </div>
                <table id="tabelaFunc" class="table table-striped" style="display: none;">
                    <thead>
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($funcionarios)) : ?>
                            <?php foreach ($funcionarios as $funcionario) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                    <td>
                                        <span class="glyphicon glyphicon-trash" title="Remover" style="margin-right: 5px; cursor: pointer; color: red;" data-id="<?php echo $funcionario['id']; ?>"></span>
                                        <span class="glyphicon glyphicon-pencil" title="Editar" style="margin-right: 5px; cursor: pointer;" data-id="<?php echo $funcionario['id']; ?>"></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        <?php else : ?>
                            <tr>
                                <td colspan="8">Nenhum funcionário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
                <table id="tabelaAdc" class="table" style="display: none";>
                    <tr>
                        <td>
                            <input type="text" id="novoFuncionario" placeholder="Novo Funcionário" disabled>
                        </td>
                        <td>
                            <span id="adcFuncionario" title="Adicionar Funcionário" class="glyphicon glyphicon-plus" style="margin-right: 5px; cursor: pointer; color: mediumseagreen;"></span>
                            <span id="cancelarAdicao" title="Cancelar" class="glyphicon glyphicon-remove-sign" style="margin-right: 5px; cursor: pointer; color: tomato; display: none;"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- SERVIÇOS -->
        <div class="row mt-5">
            <div class="col-sm-5">
                <div>
                    <span id="toggleServ" style="cursor: pointer; font-size:20px; color: #0c856d; -webkit-text-stroke-color: #788889; ">&#x25B6; Gerenciar Serviços</span>
                </div>
                <table id="tabelaServ" class="table table-striped" style="display: none;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($servicos)) : ?>
                            <?php foreach ($servicos as $servico) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($servico['nome']); ?></td>
                                    <td>
                                        <span class="glyphicon glyphicon-minus" title="Remover" style="margin-right: 5px; cursor: pointer; color: red;" data-id="<?php echo $servico['id']; ?>"></span>
                                        <span class="glyphicon glyphicon-pencil" title="Editar" style="margin-right: 5px; cursor: pointer;" data-id="<?php echo $servico['id']; ?>"></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        <?php else : ?>
                            <tr>
                                <td colspan="8">Nenhum serviço encontrado.</td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
                <table id="tabelaAdcServ" class="table" style="display: none";>
                    <tr>
                        <td>
                            <input type="text" id="novoServico" placeholder="Novo Serviço" disabled>
                        </td>
                        <td>
                            <span id="adcServico" title="Adicionar Serviço" class="glyphicon glyphicon-plus" style="margin-right: 5px; cursor: pointer; color: mediumseagreen;"></span>
                            <span id="cancelarAdicaoServ" title="Cancelar" class="glyphicon glyphicon-remove-sign" style="margin-right: 5px; cursor: pointer; color: tomato; display: none;"></span>
                        </td>
                    </tr>
                </table>
            </div>
                                
        </div>
    </div>


    <script src="./js/scriptsGer.js"></script>
</body>
</html>