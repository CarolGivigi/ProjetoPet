$(document).ready(function(){
    //pegar valor do serviço selecionado
    $("#servicos").change(function(){
        var servicoSelecionado = $(this).val();
        alert(servicoSelecionado);
    })

    //pegar valor do porte selecionado
    $('input[name="PortePet"]').on('change', function() {
        var porteSelecionado = $(this).val();
        alert(porteSelecionado);
    });

    //se option e checkbox estiverem marcados, exibir label com o valor
    function exibeValor(){
        // if ($(this).is(':checked')) {
        
    }
    
})