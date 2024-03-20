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
        } else if(servicoSelecionado.val == 0 ) {
            labelValor.textContent = "";
        } else {
            labelValor.style.display = "none"; // Oculta a label
        }
    }

    // Exibir modal nos serviços
    $('#servicos').change(function() {
        // Obtém o valor selecionado
        var servicoSelecionado = $(this).val();

        if (servicoSelecionado !== 0){
            // Abre a modal correspondente ao serviço selecionado
            switch(servicoSelecionado) {
                case '1':
                    $('#modalBanho').modal('show');
                    break;
                // Adicione cases para os outros serviços, se necessário
                // case '2':
                //     $('#modalOutroServico').modal('show');
                //     break;
                // ...
            }
        }
    });

     //Botão fechar das modais
     $('.fechaModal').click(function() {
        $(this).closest('.modal').modal('hide'); //fecha a modal pai do botão
    });

    document.getElementById('salvarModal').addEventListener('click', function() {
        // Encontra o radiobutton selecionado
        var radioButton = document.querySelector('input[name="linhaAgendamento"]:checked');

        // Se algum radiobutton estiver selecionado
        if (radioButton) {
            // Obtém a linha correspondente ao radiobutton selecionado
            var linhaAgendamento = radioButton.closest('tr');

            // Obtém os dados da linha
            var data = linhaAgendamento.cells[1].innerText;
            var hora = linhaAgendamento.cells[2].innerText;
            var prof = linhaAgendamento.cells[2].innerText;

            // Envie os dados para o PHP usando AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'querys.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Resposta do servidor
                    console.log(xhr.responseText);
                }
            };
            xhr.send('data=' + data + '&hora=' + hora + '&prof=' + prof);
        } else {
            // Nenhum radiobutton selecionado
            alert('Selecione uma linha para salvar.');
        }
    });

   

    
    
    
    //funções quando clicar em agendar
    $('#agendaSv').click(function(){
        alert('Botão clicado!');
    });
});