$(document).ready(function(){
    //pegar valor do serviço selecionado
    var servicoSelecionado;
    $("#servicos").change(function(){
        servicoSelecionado = $(this).val();
        mostraValor();
        //alert(servicoSelecionado);
    });

    //pegar valor do porte selecionado
    var porteSelecionado;
    $('input[name="PortePet"]').on('change', function() {
        porteSelecionado = $(this).val();
        mostraValor();
        // alert(porteSelecionado);
    });

    //mostrar valor se select e checkbox estiverem selecionados
    var labelValor = document.getElementById("labelValor");
    function mostraValor(){
        labelValor.textContent = "Valor R$ ";
        if ((servicoSelecionado !== null && servicoSelecionado !== "0") && (porteSelecionado !== undefined)){
            //serviço: banho
            if(servicoSelecionado == 1){
                if(porteSelecionado == "peq"){
                    labelValor.textContent += 45;
                } else if(porteSelecionado == "med"){
                    labelValor.textContent += 55;
                } else if(porteSelecionado == "gran"){
                    labelValor.textContent += 65;
                }
            //serviço: tosa
            } else if(servicoSelecionado == 2){
                if(porteSelecionado == "peq"){
                    labelValor.textContent += 50;
                } else if(porteSelecionado == "med"){
                    labelValor.textContent += 65;
                } else if(porteSelecionado == "gran"){
                    labelValor.textContent += 75;
                }
            //serviço: spa day
            } else if(servicoSelecionado == 3){
                if(porteSelecionado == "peq"){
                    labelValor.textContent += 150;
                } else if(porteSelecionado == "med"){
                    labelValor.textContent += 200;
                } else if(porteSelecionado == "gran"){
                    labelValor.textContent += 250;
                }
            //serviço: hotelzinho
            } else if(servicoSelecionado == 4){
                if(porteSelecionado == "peq"){
                    labelValor.textContent += 100;
                } else if(porteSelecionado == "med"){
                    labelValor.textContent += 140;
                } else if(porteSelecionado == "gran"){
                    labelValor.textContent += 180;
                }
            }
            labelValor.style.display = "block"; // Mostra a label
        } else if(servicoSelecionado.val == 0 ) {
            labelValor.textContent = "";
        } else {
            labelValor.style.display = "none"; // Oculta a label
        }
    }

});