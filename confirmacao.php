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
         <div class="col-md-5 rounded  text-center" style="height:150px; background-color:#0CA789;">
            <label class="float-none w-auto px-3 estiloFonte">Esperamos Vocês!</label>
            <div class="row  d-flex justify-content-center align-items-center">
               <div class="col-md-5 mt-3">
                   <button class="btn btn-light voltar">Voltar ao Site</button>
               </div>
            </div>
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