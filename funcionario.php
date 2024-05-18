<?php
require_once('./bd/querysFunc.php');
$agendamentos = obterAgendamentos();

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PetShop da Nina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./images/icons8-pet-commands-summon-16.png" />
    <link rel="stylesheet" href="./css/estilo2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row mt-3 d-flex justify-content-center align-items-center text-center">
        <div class="col-sm"><img src="./images/logo.png" style="width: 300px; height: auto;"> </div>
    </div>
    <div class="row mb-5 mt-3">
        <div class="col-sm-9">
            <label class="estiloFonteMenor">Próximos Agendamentos:</label>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Dono</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Pet</th>
                        <th scope="col">Profissional</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($agendamentos)) : ?>
                        <?php foreach ($agendamentos as $agendamento) : ?>
                            <tr>
                                <td><?php echo (new DateTime($agendamento['data_agendamento']))->format('d/m'); ?></td>
                                <td><?php echo (new DateTime($agendamento['hora_agendamento']))->format('H:i'); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['dono']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['telefone']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['pet']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['profissional'] ?? 'Hotelzinho'); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['servico']); ?></td>
                                <td><?php echo 'R$ ' . htmlspecialchars($agendamento['valor']); ?></td>
                                <td>
                                    <span id="excluirAg" title="Excluir" class="glyphicon glyphicon-remove" style="margin-right: 5px; cursor: pointer;" data-id="<?php echo $agendamento['id']; ?>"></span>
                                    <span id="confAg" title="Finalizar" class="glyphicon glyphicon-check" style="margin-right: 5px; cursor: pointer;" data-id="<?php echo $agendamento['id']; ?>"></span>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8">Nenhum agendamento encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-9">
            <div>
            <span id="toggleServicos" style="cursor: pointer;">&#x25B6; Mostrar Serviços Finalizados</span>
            </div>
            <table id="tabelaServicosFinalizados" class="table table-striped" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Dono</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Pet</th>
                        <th scope="col">Profissional</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $agendamentosFinalizados = obterFinalizados(); ?>
                    <?php if (!empty($agendamentosFinalizados)) : ?>
                        <?php foreach ($agendamentosFinalizados as $agendamento) : ?>
                            <tr>
                                <td><?php echo (new DateTime($agendamento['data_agendamento']))->format('d/m'); ?></td>
                                <td><?php echo (new DateTime($agendamento['hora_agendamento']))->format('H:i'); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['dono']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['telefone']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['pet']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['profissional'] ?? 'Hotelzinho'); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['servico']); ?></td>
                                <td><?php echo 'R$ ' . htmlspecialchars($agendamento['valor']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8">Nenhum agendamento finalizado encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>

<!-- Icones Bootstrap (Bi) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!--bootstrap, jquery e script js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="./js/jquery.js"></script>
<script src="./js/scriptsFunc.js"></script>
</body>
</html>
