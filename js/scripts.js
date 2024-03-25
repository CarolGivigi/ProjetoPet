$(document).ready(function(){

    //serão usados para atualizar data e hora na modal
    var dataSelecionada;
    var horarioSelecionado;
    var servicoSelecionado;
    var porteSelecionado;

    //Mostrar modal
    $('#servicos').on('change', function() {
        // Obter o valor selecionado do serviço
        servicoSelecionado = $("#servicos").val();
        
        // Verificar se o serviço selecionado é diferente de 0 (Nossos Serviços)
        if (servicoSelecionado !== "0") {
            $('#modal').modal('show');
        }
    });

    //Botão fechar modal
    $('.fechaModal').click(function() {
        $(this).closest('.modal').modal('hide'); //fecha a modal pai do botão
    });

    // Função para atualizar a data e a hora selecionadas
    function pegaDataHora() {
        dataSelecionada = $('input[name="dia"]:checked').val();
        horarioSelecionado = $('#horario').val();
    }

        //Botão salvar modal
    $('.salvaModal').click(function() {
        // Atualizar a data e a hora selecionadas
        pegaDataHora();

        // Fechar a modal
        $('#modal').modal('hide');
    });


    //pegar valor do porte selecionado
    $('input[name="portePet"]').on('change', function() {
        porteSelecionado = $(this).val();
        mostraValor();
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
                if(porteSelecionado == "P"){
                    labelValor.textContent += 100;
                } else if(porteSelecionado == "M"){
                    labelValor.textContent += 140;
                } else if(porteSelecionado == "G"){
                    labelValor.textContent += 180;
                }
            }
            labelValor.style.display = "block"; // Mostra a label
        } else if(servicoSelecionado == 0 ) {
            labelValor.textContent = "";
        } else {
            labelValor.style.display = "none"; // Oculta a label
        }
    }    


    //funções quando clicar em agendar
    $('#agendaSv').click(function(){
        var nomeDono = $('#nomeDono').val();
        var nomePet = $('#nomePet').val();   
        var valor = labelValor.textContent;

        // Pegar parte númerica da label
        var achaNumero = valor.match(/\d+/);
        valor = achaNumero ? parseInt(achaNumero[0]) : 0;

        $('#inputValor').val(valor); //coloca o valor no campo hidden, pois label n envia por post

        //Atualizar a data e a hora selecionadas uma última vez, caso o usuário tenha feito alguma alteração desde o último clique em "Salvar"
        pegaDataHora();

        $.ajax({
            type: 'POST',
            url: '../bd/querys.php',
            data: {
                // Aqui você pode adicionar outros dados do formulário, além da data e da hora selecionadas
                data: dataSelecionada,
                hora: horarioSelecionado,
                servico: servicoSelecionado,
                portePet: porteSelecionado,
                nomeDono: nomeDono,
                nomePet: nomePet,
                valor: valor,
            },
            success: function(response) {
                // Verifique se a resposta indica sucesso (você pode definir isso no PHP)
                if (response.success) {
                    // Se for um sucesso, redirecione o usuário para outra página
                    window.location.href = "../confirmacao.php";
                } else {
                    // Se houver algum problema, exiba uma mensagem de erro ou realize alguma ação adequada
                    alert("Ocorreu um erro ao processar a solicitação.");
                }
            },
            error: function(xhr, status, error) {
                // Lidar com erros de requisição AJAX aqui
                console.error(error);
            }          
            
        });
        
    });

    $('.voltar').click(function() {
        window.location.href = "index.php";
    });
}); 