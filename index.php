<?php
   require_once('./bd/ConexaoBD.php');
   require_once('./bd/querys.php');
?>

<!doctype html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PetShop </title> <!-- mudar dps -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
      <link rel="shortcut icon" href="./images/icons8-pet-commands-summon-16.png" />
      <link rel="stylesheet" href="./css/estilo.css">
   </head>
   <body>
   <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center" style="height:750px;">
         <div class="col-md-5 rounded " style="height:540px; background-color:#0CA789;">
            <form method="POST" action="./bd/querys.php" id="formAgendamento">
               <fieldset class="border rounded-3 p-3 ">
                  <legend class="float-none w-auto px-3 text-center estiloFonte">Seja Bem-Vindo!</legend>
                     <div class="row mt-3">               
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="servicos" class="form-label estiloFonte">Serviço</label></div>
                        <div class="col-md-6">
                        <select class="form-select estiloFonteMenor" id="servicos" name="servicos" required>
                           <option selected value="0">Nossos Serviços</option>
                           <option value="1">Banho</option>
                           <option value="2">Tosa</option>
                           <option value="3">Spa Day</option>
                           <option value="4">Hotelzinho</option>
                        </select>
                        </div>
                     </div>

                     <!-- Modal Serviços -->
                     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="tituloModal" class="estiloFonte">Agenda Disponível</h5>
                                 </div>
                                 <div class="modal-body">
                                    <table class="table">
                                       <thead>
                                          <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Data</th>
                                                <th scope="col">Hora</th>
                                          </tr>
                                       </thead>
                                       <tbody id="tabelaAgendamento">
                                          <?php
                                          // Buscar os dias e horários disponíveis
                                          $diasEHorariosDisponiveis = buscarDias();

                                          // Verificar se os dias e horários foram recuperados com sucesso
                                          if ($diasEHorariosDisponiveis) {
                                                // Loop através dos dias e horários disponíveis
                                                foreach ($diasEHorariosDisponiveis as $data => $horarios) {
                                                   echo "<tr>";
                                                   echo "<td><input type=\"radio\" name=\"data\" value=\"$data\"></td>";
                                                   echo "<td>" . date('d/m', strtotime($data)) . "</td>";
                                                   echo "<td><select class=\"hora\" name=\"hora[]\">";
                                                   echo "<option selected value=''>Selecione</option>";

                                                   // Loop através dos horários disponíveis para este dia
                                                   foreach ($horarios as $horario) {
                                                      echo "<option value='$horario' title='$horario'>$horario</option>";
                                                   }

                                                   echo "</select></td>";
                                                   echo "</tr>";
                                                }
                                          } else {
                                                // Se não houver dias e horários disponíveis, exibir uma mensagem
                                                echo "<tr><td colspan=\"3\">Nenhum dia disponível</td></tr>";
                                          }
                                          ?>
                                       </tbody>
                                       <input type="hidden" id="horaSelecionada" name="horaSelecionada" value="">
                                    </table>

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary fechaModal" data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary salvaModal" >Salvar</button>
                                 </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomeDono" class="form-label estiloFonte">Nome do Dono</label></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="nomeDono" pattern="[A-Za-z]+" id="nomeDono" size="15" required></div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="email" class="form-label estiloFonte">E-mail</label></div>
                        <div class="col-md-6"><input type="email" class="form-control" name="email" id="email" size="35" required></div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomePet" class="form-label estiloFonte">Nome do Pet</label></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="nomePet" id="nomePet" size="15" required></div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label class="form-label estiloFonte">Porte do Pet</label></div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="portePet" value="P" required>
                           <label class="form-check-label estiloFonte" style="font-size: 20px;">
                              Pequeno (Até 10kg)
                           </label>
                        </div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="portePet" value="M" >
                           <label class="form-check-label estiloFonte" style="font-size: 20px;" >
                              Médio (Até 18kg)
                           </label>
                        </div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="portePet" value="G" >
                           <label class="form-check-label estiloFonte" style="font-size: 20px;">
                              Grande (Mais de 18kg)
                           </label>
                        </div>
                     </div>

                     <div class="row mt-2 text-center">
                        <div class="col md-12">
                           <label id="labelValor" name="labelValor" class="estiloFonte" style="display:none; color:white; font-size:25px;"> Valor R$ </label> 
                           <input type="hidden" id="inputValor" name="valor" value="">           
                        </div>

                     </div>

                     <div class="row mt-2 text-center">
                        <div class="col-md-12">
                           <input type="submit" class="btn btn-light" name="agendaSv" id="agendaSv" value="Agendar">
                        </div>
                     </div>

               </fieldset>
            </form>

         </div>
      </div>
   </div>

     <!--bootstrap, jquery e script js  -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
      <script src="./js/jquery.js"></script>
      <script src="./js/scripts.js"></script>
      
   </body>
</html>