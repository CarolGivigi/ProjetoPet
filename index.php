<!doctype html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PetShop tatata</title>
      <script src="./js/scripts.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body>
   <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center" style="height:750px;">
         <div class="col-md-5 rounded " style="height:475px; background-color:#0CA789;">
            <form>
               <div class="row mt-5">               
                  <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="servicos" class="form-label ">Serviço</label></div>
                  <div class="col-md-6">
                     <select class="form-select" aria-label="Default select example" id="servicos">
                        <option selected>Nossos Serviços</option>
                        <option value="1">Banho</option>
                        <option value="2">Tosa</option>
                        <option value="3">Spa Day</option>
                        <option value="4">Hotelzinho</option>  <!-- vai ter que calcular a diaria dps. Abrir calendario com periodo -->
                     </select>
                  </div>
               </div>
               
               <div class="row mt-2">
                  <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomeDono" class="form-label">Nome do Dono</label></div>
                  <div class="col-md-6"><input type="text" class="form-control" name="nomeDono" id="nomeDono" size="15"></div>
               </div>
               <div class="row mt-2">
                  <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="nomePet" class="form-label">Nome do Pet</label></div>
                  <div class="col-md-6"><input type="text" class="form-control" name="nomePet" id="nomePet" size="15"></div>
               </div>
               <div class="row mt-2">
                  <div class="col-md-6 d-flex justify-content-end align-items-center"><label for="portePet" class="form-label">Porte do Pet</label></div>
                  <div class="form-check col-md-2">
                     <input class="form-check-input" type="radio" name="PortePet" checked>
                     <label class="form-check-label" for="flexRadioDefault1">
                        Pequeno (Até 10kg)
                     </label>
                  </div>
                  <div class="form-check col-md-2">
                     <input class="form-check-input" type="radio" name="PortePet" >
                     <label class="form-check-label" for="flexRadioDefault2">
                        Médio (Até 18kg)
                     </label>
                  </div>
                  <div class="form-check col-md-2">
                     <input class="form-check-input" type="radio" name="PortePet" >
                     <label class="form-check-label" for="flexRadioDefault2">
                        Grande (Mais de 18kg)
                     </label>
                  </div>
               </div>

               <div class="row mt-2 text-center">
                  <div class="col md-12">
                     <?php  ?><label> </label> 
                     <!-- mudar preço conforme mudar o radio button e o select -->
                  </div>

               </div>

               <div class="row mt-2 text-center">
                  <div class="col-md-12">
                     <button type="button" class="btn btn-light" name="agendaSv">Agendar</button>
                  </div>
               </div>
            </form>

         </div>
      </div>
   </div>
      



   




      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
      <script src="./js/jquery.js"></script>
      
   </body>
</html>