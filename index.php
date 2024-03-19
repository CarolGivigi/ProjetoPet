<?php
   require_once('./bd/ConexaoBD.php');
   require_once('./bd/querys.php');
?>

<!doctype html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PetShop tatata</title>
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
         <div class="col-md-5 rounded " style="height:500px; background-color:#0CA789;">
            <form method="POST" action="./bd/querys.php">
               <fieldset class="border rounded-3 p-2">
                  <legend class="float-none w-auto px-3 text-center estiloFonte">Seja Bem-Vindo!</legend>
                     <div class="row mt-5">               
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="servicos" class="form-label estiloFonte">Serviço</label></div>
                        <div class="col-md-6">
                           <select class="form-select estiloFonteMenor" id="servicos" name="servicos" required>
                              <option selected value="0">Nossos Serviços</option>
                              <option value="1">Banho</option>
                              <option value="2">Tosa</option>
                              <option value="3">Spa Day</option>
                              <option value="4">Hotelzinho</option>  <!-- vai ter que calcular a diaria dps. Abrir calendario com periodo -->
                           </select>
                        </div>
                     </div>
                     
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomeDono" class="form-label estiloFonte">Nome do Dono</label></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="nomeDono" pattern="[A-Za-z]+" id="nomeDono" size="15" required></div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomePet" class="form-label estiloFonte">Nome do Pet</label></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="nomePet" id="nomePet" size="15" required></div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 d-flex justify-content-end align-items-center"><label class="form-label estiloFonte">Porte do Pet</label></div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="PortePet" value="peq" required>
                           <label class="form-check-label estiloFonte" style="font-size: 20px;">
                              Pequeno (Até 10kg)
                           </label>
                        </div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="PortePet" value="med" >
                           <label class="form-check-label estiloFonte" style="font-size: 20px;" >
                              Médio (Até 18kg)
                           </label>
                        </div>
                        <div class="form-check col-md-2">
                           <input class="form-check-input" type="radio" name="PortePet" value="gran" >
                           <label class="form-check-label estiloFonte" style="font-size: 20px;">
                              Grande (Mais de 18kg)
                           </label>
                        </div>
                     </div>

                     <div class="row mt-2 text-center">
                        <div class="col md-12">
                           <label id="labelValor" class="estiloFonte" style="display:none; color:white; font-size:25px;"> Valor R$ </label> 
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