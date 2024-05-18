document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.glyphicon-remove').forEach(function(element) {
        element.addEventListener('click', function() {
            var idAgendamento = this.getAttribute('data-id');
            //alert(idAgendamento);

            if (confirm("Cancelar o Serviço?")) {
                $.ajax({
                    url: 'bd/querysFunc.php',
                    type: 'POST',
                    data: {
                        idAgendamento: idAgendamento,
                        acao: 'excluirAgendamento'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert("Agendamento excluído com sucesso!");
                            element.closest('tr').remove(); //tira linha da tabela
                        } else {
                            alert("Erro ao excluir o agendamento: " + result.message);
                        }
                    },
                    error: function() {
                        alert("Erro ao processar a solicitação.");
                    }
                });
            }
        });
    });

    document.querySelectorAll('.glyphicon-check').forEach(function(element) {
        element.addEventListener('click', function() {
            var idAgendamento = this.getAttribute('data-id');
            // alert(idAgendamento);

            if (confirm("Finalizar o Serviço?")) {
                $.ajax({
                    url: 'bd/querysFunc.php',
                    type: 'POST',
                    data: {
                        idAgendamento: idAgendamento,
                        acao: 'confAgendamento'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert("Serviço finalizado com sucesso!");
                            element.closest('tr').remove();
                            location.reload();
                        } else {
                            alert("Erro ao Finalizar o Serviço: " + result.message);
                        }
                    },
                    error: function() {
                        alert("Erro ao processar a solicitação.");
                    }
                });
            }
        });
    });


    document.getElementById('toggleServicos').addEventListener('click', function() {
        var tabela = document.getElementById('tabelaServicosFinalizados');
        var toggleIcon = document.getElementById('toggleServicos');

        if (tabela.style.display === 'none') {
            tabela.style.display = 'table';
            toggleIcon.innerHTML = '&#x25BC; Ocultar Serviços Finalizados';
        } else {
            tabela.style.display = 'none';
            toggleIcon.innerHTML = '&#x25B6; Mostrar Serviços Finalizados';
        }
    });


});
