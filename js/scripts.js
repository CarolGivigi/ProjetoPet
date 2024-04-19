$(document).ready(function(){
    //serão usados para atualizar data e hora na modal
    var dataSelecionada;
    var horarioSelecionado;
    var servicoSelecionado;
    var porteSelecionado;

    // Função para obter a data e a hora selecionadas
    function pegaDataHora() {
        dataSelecionada = $('input[name="data"]:checked').val();
        horarioSelecionado = $(this).find('option:selected').prop('title'); 
    }
    // Chamar a função quando o valor do select for alterado
    $('.hora').change(function() {
        pegaDataHora.call(this); 
    });

    // Mostrar modal
    $('#servicos').on('change', function() {
        // Ocultar todas as modais
        $('.modal').modal('hide');

        // Obter o valor selecionado do serviço
        servicoSelecionado = $("#servicos").val();
        
        // Verificar se o serviço selecionado é diferente de 0 (Nossos Serviços)
        if (servicoSelecionado !== "0") {
            if (servicoSelecionado == "4") {
                $('#modalHotel').modal('show');
            } else {
                $('#modalServicos').modal('show');
            }
        }
    });

    $('.dataHotel').change(function() {
        var dataHotel = $(this).find('option:selected').attr('data-vagas');
        $('#labelVagas').text(dataHotel).css('font-weight', 'bold');
    
        // Converte o valor para um número inteiro
        var numDiarias = parseInt(dataHotel);
    
        if (numDiarias >= 5) {
            $('#labelVagas').css('color', 'green'); 
        } else if (numDiarias == 4) {
            $('#labelVagas').css('color', 'green'); 
        } else if (numDiarias == 3) {
            $('#labelVagas').css('color', 'orange'); 
        } else if (numDiarias == 2 || numDiarias == 1) {
            $('#labelVagas').css('color', 'red'); 
        }
    });
      
    //Botão 'salvar' modal
    $('.salvaModal').click(function() {
        $('.modal').modal('hide');
    });

    //mostrar valor se select e checkbox estiverem selecionados
    var labelValor = document.getElementById("labelValor");
    function mostraValor(){
        labelValor.textContent = "Valor R$ ";
        if ((servicoSelecionado !== null && servicoSelecionado !== "0") && (porteSelecionado !== undefined)){
            //serviço: banho
            if(servicoSelecionado == 1){
                if(porteSelecionado == "P"){
                    labelValor.textContent += 45;
                } else if(porteSelecionado == "M"){
                    labelValor.textContent += 55;
                } else if(porteSelecionado == "G"){
                    labelValor.textContent += 65;
                }
            //serviço: tosa
            } else if(servicoSelecionado == 2){
                if(porteSelecionado == "P"){
                    labelValor.textContent += 50;
                } else if(porteSelecionado == "M"){
                    labelValor.textContent += 65;
                } else if(porteSelecionado == "G"){
                    labelValor.textContent += 75;
                }
            //serviço: spa day
            } else if(servicoSelecionado == 3){
                if(porteSelecionado == "P"){
                    labelValor.textContent += 150;
                } else if(porteSelecionado == "M"){
                    labelValor.textContent += 200;
                } else if(porteSelecionado == "G"){
                    labelValor.textContent += 250;
                }
            //serviço: hotelzinho
            } else if(servicoSelecionado == 4){
                var numDiarias = document.getElementById('numDiarias').value;
                if (porteSelecionado == "P") {
                    labelValor.textContent += 100 * numDiarias;
                } else if (porteSelecionado == "M") {
                    labelValor.textContent += 140 * numDiarias;
                } else if (porteSelecionado == "G") {
                    labelValor.textContent += 180 * numDiarias;
                }
            }
            labelValor.style.display = "block"; // Mostra a label
        } else if(servicoSelecionado == 0 ) {
            labelValor.textContent = "";
        } else {
            labelValor.style.display = "none"; // Oculta a label
        }
    }    

     //pegar valor do porte selecionado
    $('input[name="portePet"]').on('change', function() {
        porteSelecionado = $(this).val();
        mostraValor();
    });

    //Enviar dados
    $('#formAgendamento').submit(function(e) {
        e.preventDefault(); // Impede o envio do formulário padrão

        //Atualizar a data e a hora selecionadas uma última vez, caso o usuário tenha feito alguma alteração desde o último "Salvar"
        pegaDataHora();

        //pegar parte numérica da label valor
        var valor = labelValor.textContent;
        var achaNumero = valor.match(/\d+/);
        valor = achaNumero ? parseInt(achaNumero[0]) : 0;

        $('#inputValor').val(valor); //coloca o valor no campo hidden, pois label n envia por post

        var horaSelecionada = '';
        $('select[name="hora[]"]').each(function() {
            var hora = $(this).val();
            if (hora !== '') {
                horaSelecionada = hora;
                return false; // Sai do loop quando encontrar a primeira hora não vazia
            }
        });
        
        $('#horaSelecionada').val(horaSelecionada); // Atribui a hora selecionada ao campo oculto
        this.submit(); // Envia o formulário
    });

    //voltar do confirmação
    $('.voltar').click(function() {
        window.location.href = "index.php";
    });
}); 