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
        //alert(horarioSelecionado);
    }
    
    // Chamar a função quando o valor do select for alterado
    $('.hora').change(function() {
        pegaDataHora.call(this); // Chamar a função pegaDataHora com o contexto do elemento alterado
    });

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

    //Botão salvar modal
    $('.salvaModal').click(function() {
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

    //funções quando clicar em agendar(ajax estava dando pane no envio da hora)
    // $('#agendaSv').click(function(){
    //     var nomeDono = $('#nomeDono').val();
    //     var nomePet = $('#nomePet').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: '../bd/querys.php',
    //         data: {
    //             data: dataSelecionada,
    //             hora: horarioSelecionado,
    //             servico: servicoSelecionado,
    //             portePet: porteSelecionado,
    //             nomeDono: nomeDono,
    //             nomePet: nomePet,
    //             valor: valor,
    //         },
    //         success: function(response) {
    //             if (response.success) {
    //                 alert('foi')
    //                 window.location.href = "../confirmacao.php";
    //             } else {
    //                 alert(data);
    //                 // alert("Ocorreu um erro ao processar a solicitação.");
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(error);
    //         }          
    //     });

    //     // COM SERIALIZE
    //     // var dados = $('#formAgendamento').serialize()

    //     // alert(dados);
    //     // console.log(dados);

    //     // $.ajax({
    //     //     type: 'POST',
    //     //     dataType: 'json',
    //     //     url: '../bd/querys.php',
    //     //     async: true,
    //     //     data: dados,
    //     //     success: function(response) {
    //     //         if (response.success) {
    //     //             alert(data)
    //     //              // window.location.href = "../confirmacao.php";
    //     //         }
    //     //     }   
    //     // });
    // });
        
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

    $('.voltar').click(function() {
        window.location.href = "index.php";
    });
}); 