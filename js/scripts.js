function tipoServico(){
    let selecao = document.querySelector("#servicos");
    let valorSelecao = selecao.options[selecao.selectedIndex];

    let valor = valorSelecao.value;

    alert(valor)
}