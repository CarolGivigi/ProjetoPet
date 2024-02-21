<!doctype html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PetShop tatata</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body>
   <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center" style="height:750px;">
         <div class="col-md-5 bg-danger rounded " style="height:475px;">
            <form>
               <div><label class="form-label">Serviço</label></div>
               <div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Dropdown link
                  </a>

                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
               </div>
               
               <div>
                  <label class="form-label">Nome do Dono</label>
                  <input type="text" class="form-control" name="nomeDono" size="15">
               </div>
               <div>
                  <label class="form-label">Nome do Pet</label>
                  <input type="text" class="form-control" name="nomePet" size="15">
               </div>
               <div>
                  <label class="form-label">Porte do Pet</label>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="PortePet" checked>
                     <label class="form-check-label" for="flexRadioDefault1">
                        Pequeno (Até 5kg)
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="PortePet" >
                     <label class="form-check-label" for="flexRadioDefault2">
                        Médio (Até 10kg)
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="PortePet" >
                     <label class="form-check-label" for="flexRadioDefault2">
                        Grande (Mais de 10kg)
                     </label>
                  </div>
               </div>





            </form>
         </div>
      </div>
   </div>
      



   




      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   </body>
</html>