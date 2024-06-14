document.addEventListener('DOMContentLoaded', function() {
    //Exibir/ocultar funcionários
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

    //Exibir/ocultar serviços
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

    // remover funcionário
    document.querySelectorAll('.glyphicon-trash').forEach(function(element) {
        element.addEventListener('click', function() {
            var idFunc = this.getAttribute('data-id');
            removerFuncionario(idFunc);
        });
    });

    //editar funcionario
    document.querySelectorAll('.editarFunc').forEach(function(editIcon) {
        editIcon.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var nomeTd = this.closest('tr').querySelector('.nomeFunc');
            var nomeAtual = nomeTd ? nomeTd.innerText : '';

            if (nomeTd) {
                var input = document.createElement('input');
                input.type = 'text';
                input.value = nomeAtual;
                var oldValue = nomeTd.innerHTML; // Salva o valor original para restauração em caso de erro

                // Substitui o conteúdo da célula pelo input
                nomeTd.innerHTML = '';
                nomeTd.appendChild(input);
                input.focus();

                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        var novoNome = input.value.trim();
                        if (novoNome !== '') {
                            $.ajax({
                                url: 'bd/querysGer.php',
                                type: 'POST',
                                data: {
                                    idFunc: id,
                                    nome: novoNome,
                                    acao: 'editarFunc'
                                },
                                success: function(response) {
                                    var result = JSON.parse(response);
                                    if (result.success) {
                                        // Atualiza o texto na célula
                                        nomeTd.textContent = novoNome;
                                        // Remove o input após a atualização bem-sucedida
                                        input.remove();
                                    } else {
                                        alert("Erro ao editar funcionário: " + result.message);
                                        // Restaura o valor original em caso de erro
                                        nomeTd.innerHTML = oldValue;
                                    }
                                },
                                error: function() {
                                    alert("Erro ao processar a solicitação.");
                                    // Restaura o valor original em caso de erro de requisição
                                    nomeTd.innerHTML = oldValue;
                                }
                            });
                        } else {
                            alert("Nome do funcionário não pode ser vazio.");
                            // Restaura o valor original se o nome for vazio
                            nomeTd.innerHTML = oldValue;
                        }
                    }
                });
            }
        });
    });

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

    //editar servico
    document.querySelectorAll('.editarServ').forEach(function(editIcon) {
        editIcon.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var nomeTd = this.closest('tr').querySelector('.nomeServ');
            var nomeAtual = nomeTd ? nomeTd.innerText : '';
    
            if (nomeTd) {
                var input = document.createElement('input');
                input.type = 'text';
                input.value = nomeAtual;
                var oldValue = nomeTd.innerHTML; 
    
                // Substitui o conteúdo da célula pelo input
                nomeTd.innerHTML = '';
                nomeTd.appendChild(input);
                input.focus();
    
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        var novoNome = input.value.trim();
                        if (novoNome !== '') {
                            $.ajax({
                                url: 'bd/querysGer.php',
                                type: 'POST',
                                data: {
                                    idServ: id, // Corrigido de idFunc para idServ
                                    nome: novoNome,
                                    acao: 'editarServ'
                                },
                                success: function(response) {
                                    var result = JSON.parse(response);
                                    if (result.success) {
                                        nomeTd.textContent = novoNome;
                                        input.remove();
                                    } else {
                                        alert("Erro ao editar serviço: " + result.message);
                                        // Restaura o valor original em caso de erro
                                        nomeTd.innerHTML = oldValue;
                                    }
                                },
                                error: function() {
                                    alert("Erro ao processar a solicitação.");
                                    nomeTd.innerHTML = oldValue;
                                }
                            });
                        } else {
                            alert("Nome do serviço não pode ser vazio.");
                            // Restaura o valor original se o nome for vazio
                            nomeTd.innerHTML = oldValue;
                        }
                    }
                });
            }
        });
    });
    
    
});
