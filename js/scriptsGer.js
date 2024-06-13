document.addEventListener('DOMContentLoaded', function() {
    // Alternar a exibição da tabela de funcionários
    document.getElementById('toggleFunc').addEventListener('click', function() {
        var tabelaFunc = document.getElementById('tabelaFunc');
        var toggleFunc = document.getElementById('toggleFunc');
        var tabelaAdc = document.getElementById('tabelaAdc');

        if (tabelaFunc.style.display === 'none') {
            tabelaFunc.style.display = 'table';
            tabelaAdc.style.display = 'table';
            toggleFunc.innerHTML = '&#x25BC; Ocultar Funcionários';
        } else {
            tabelaFunc.style.display = 'none';
            tabelaAdc.style.display = 'none';
            toggleFunc.innerHTML = '&#x25B6; Gerenciar Funcionários';
        }
    });


    document.getElementById('toggleServ').addEventListener('click', function() {
        var tabelaServ = document.getElementById('tabelaServ');
        var toggleServ = document.getElementById('toggleServ');
        var tabelaServ = document.getElementById('tabelaServ');

        if (tabelaServ.style.display === 'none') {
            tabelaServ.style.display = 'table';
            tabelaAdcServ.style.display = 'table';
            toggleServ.innerHTML = '&#x25BC; Ocultar Serviços';
        } else {
            tabelaServ.style.display = 'none';
            tabelaAdcServ.style.display = 'none';
            toggleServ.innerHTML = '&#x25B6; Gerenciar Serviços';
        }
    });


    // Funções de Funcionario
    var adcFuncionario = document.getElementById('adcFuncionario');
    var cancelarAdicao = document.getElementById('cancelarAdicao');
    var input = document.getElementById('novoFuncionario');

    adcFuncionario.addEventListener('click', function() {
        input.disabled = false;
        input.focus();
        adcFuncionario.style.display = 'none';
        cancelarAdicao.style.display = 'inline';
    });

    cancelarAdicao.addEventListener('click', function() {
        input.disabled = true;
        input.value = '';
        adcFuncionario.style.display = 'inline';
        cancelarAdicao.style.display = 'none';
    });

    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            var texto = input.value.trim();
            if (texto !== '') {
                $.ajax({
                    url: 'bd/querysGer.php',
                    type: 'POST',
                    data: {
                        nome: texto,
                        acao: 'adicionarFunc'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            var tbody = document.querySelector('#tabelaFunc tbody');
                            var tr = document.createElement('tr');

                            var tdNome = document.createElement('td');
                            tdNome.textContent = texto;

                            var tdAcoes = document.createElement('td');
                            var spanExcluir = document.createElement('span');
                            spanExcluir.className = 'glyphicon glyphicon-trash';
                            spanExcluir.title = 'Remover';
                            spanExcluir.style.marginRight = '5px';
                            spanExcluir.style.cursor = 'pointer';
                            spanExcluir.style.color = 'red';
                            spanExcluir.setAttribute('data-id', result.id);
                            spanExcluir.addEventListener('click', function() {
                                removerFuncionario(result.id);
                            });

                            var spanEditar = document.createElement('span');
                            spanEditar.className = 'glyphicon glyphicon-pencil';
                            spanEditar.title = 'Editar';
                            spanEditar.style.marginRight = '5px';
                            spanEditar.style.cursor = 'pointer';
                            spanEditar.setAttribute('data-id', result.id);
                            spanEditar.addEventListener('click', function() {
                                alert('Função de edição não implementada.');
                            });

                            tdAcoes.appendChild(spanExcluir);
                            tdAcoes.appendChild(spanEditar);

                            tr.appendChild(tdNome);
                            tr.appendChild(tdAcoes);

                            tbody.appendChild(tr);

                            input.value = '';
                            input.disabled = true;
                            adcFuncionario.style.display = 'inline';
                            cancelarAdicao.style.display = 'none';
                        } else {
                            alert("Erro ao adicionar funcionário: " + result.message);
                        }
                    },
                    error: function() {
                        alert("Erro ao processar a solicitação.");
                    }
                });
            }
        }
    });

    function removerFuncionario(idFunc) {
        if (confirm("Remover Funcionário?")) {
            $.ajax({
                url: 'bd/querysGer.php',
                type: 'POST',
                data: {
                    idFunc: idFunc,
                    acao: 'excluirFunc'
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert("Funcionário removido com sucesso!");
                        document.querySelector('span[data-id="' + idFunc + '"]').closest('tr').remove();
                    } else {
                        alert("Erro ao remover funcionário: " + result.message);
                    }
                },
                error: function() {
                    alert("Erro ao processar a solicitação.");
                }
            });
        }
    }

    // Event listener para remover funcionário (funcionários existentes)
    document.querySelectorAll('.glyphicon-trash').forEach(function(element) {
        element.addEventListener('click', function() {
            var idFunc = this.getAttribute('data-id');
            removerFuncionario(idFunc);
        });
    });

    // Event listener para editar funcionário (ainda não implementada)
    // document.querySelectorAll('.glyphicon-pencil').forEach(function(element) {
    //     element.addEventListener('click', function() {
    //         alert('Função de edição não implementada.');
    //     });
    // });


    //Funções de Servico
    var adcServico = document.getElementById('adcServico');
    var cancelarAdicaoServ = document.getElementById('cancelarAdicaoServ');
    var inputServ = document.getElementById('novoServico');

    adcServico.addEventListener('click', function() {
        inputServ.disabled = false;
        inputServ.focus();
        adcServico.style.display = 'none';
        cancelarAdicaoServ.style.display = 'inline';
    });


    cancelarAdicaoServ.addEventListener('click', function() {
        inputServ.disabled = true;
        inputServ.value = '';
        adcServico.style.display = 'inline';
        cancelarAdicaoServ.style.display = 'none';
    });

    inputServ.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            var texto = inputServ.value.trim();
            if (texto !== '') {
                $.ajax({
                    url: 'bd/querysGer.php',
                    type: 'POST',
                    data: {
                        nome: texto,
                        acao: 'adicionarServ'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            var tbody = document.querySelector('#tabelaServ tbody');
                            var tr = document.createElement('tr');

                            var tdNome = document.createElement('td');
                            tdNome.textContent = texto;

                            var tdAcoes = document.createElement('td');
                            var spanExcluir = document.createElement('span');
                            spanExcluir.className = 'glyphicon glyphicon-minus';
                            spanExcluir.title = 'Remover';
                            spanExcluir.style.marginRight = '5px';
                            spanExcluir.style.cursor = 'pointer';
                            spanExcluir.style.color = 'red';
                            spanExcluir.setAttribute('data-id', result.id);
                            spanExcluir.addEventListener('click', function() {
                                removerServico(result.id);
                            });

                            var spanEditar = document.createElement('span');
                            spanEditar.className = 'glyphicon glyphicon-pencil';
                            spanEditar.title = 'Editar';
                            spanEditar.style.marginRight = '5px';
                            spanEditar.style.cursor = 'pointer';
                            spanEditar.setAttribute('data-id', result.id);
                            spanEditar.addEventListener('click', function() {
                                alert('Função de edição não implementada.');
                            });

                            tdAcoes.appendChild(spanExcluir);
                            tdAcoes.appendChild(spanEditar);

                            tr.appendChild(tdNome);
                            tr.appendChild(tdAcoes);

                            tbody.appendChild(tr);

                            inputServ.value = '';
                            inputServ.disabled = true;
                            adcServico.style.display = 'inline';
                            cancelarAdicaoServ.style.display = 'none';
                        } else {
                            alert("Erro ao adicionar Serviço: " + result.message);
                        }
                    },
                    error: function() {
                        alert("Erro ao processar a solicitação.");
                    }
                });
            }
        }
    });

    function removerServico(idServ) {
        if (confirm("Remover Serviço?")) {
            $.ajax({
                url: 'bd/querysGer.php',
                type: 'POST',
                data: {
                    idServ: idServ,
                    acao: 'excluirServ'
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert("Serviço removido com sucesso!");
                        document.querySelector('span[data-id="' + idServ + '"]').closest('tr').remove();
                    } else {
                        alert("Erro ao remover serviço: " + result.message);
                    }
                },
                error: function() {
                    alert("Erro ao processar a solicitação.");
                }
            });
        }
    }

    // Event listener para remover serviço
    document.querySelectorAll('.glyphicon-minus').forEach(function(element) {
        element.addEventListener('click', function() {
            var idServ = this.getAttribute('data-id');
            removerServico(idServ);
        });
    });

    // Event listener para editar serviço (ainda não implementada) FAZER
    // document.querySelectorAll('.glyphicon-pencil').forEach(function(element) {
    //     element.addEventListener('click', function() {
    //         alert('Função de edição não implementada.');
    //     });
    // });

});
