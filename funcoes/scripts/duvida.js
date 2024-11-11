vsUrl = $("#vsUrl").val();

// Função para capturar valores de parâmetros da URL
$(document).ready(function () {
    function getParameterByName(name) {
        var url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
});

// Função para redirecionar a página com o status e preservar outros parâmetros
$('input[type=checkbox]').on('change', function () {
    var status = $(this).val();

    // Obtém os valores de curso, período e disciplina
    var curso = getParameterByName('curso');
    var periodo = getParameterByName('periodo');
    var disciplina = getParameterByName('disciplina');

    // Monta a nova URL com os parâmetros existentes e o novo status
    var newUrl = "?status=" + status;

    if (curso) newUrl += "&curso=" + curso;
    if (periodo) newUrl += "&periodo=" + periodo;
    if (disciplina) newUrl += "&disciplina=" + disciplina;

    // Redireciona para a nova URL
    window.location.href = newUrl;
});

function atualizarNumeroCurtidas(novoNumeroCurtidas, viCD_DUVIDA) {
    const elementoCurtidas = document.querySelector(`.like_btn[data-duvida="${viCD_DUVIDA}"]`);
    
    if (elementoCurtidas) {
        elementoCurtidas.innerHTML = `<i class="far fa-thumbs-up"></i> ${novoNumeroCurtidas}`;
    }
}

function atualiza_curtidas(viCD_DUVIDA, viCD_ALUNO) {
    $.ajax({
        url: vsUrl + "funcoes/controllars/AtualizaCurtidasDuvida.php",
        type: "POST",
        dataType: "json",
        data: {
            viCD_DUVIDA: viCD_DUVIDA,
            viCD_ALUNO: viCD_ALUNO
        },
        success: function (data) {
            if (data.status === 1) {
                mostrarMensagemSucesso();
                atualizarNumeroCurtidas(data.novoNumeroCurtidas, viCD_DUVIDA);
            } else {
                Aviso();
            }
        },
        error: function () {
            Aviso();
        }
    });
}


function mostrarMensagemSucesso() {
    const mensagem = document.createElement("div");
    mensagem.className = "mensagem-sucesso";
    mensagem.innerText = "Curtida atualizada com sucesso!";
    document.body.appendChild(mensagem);

    // Remove a mensagem após 1 segundo e meio
    setTimeout(() => {
        mensagem.remove();
    }, 1500);
}


function oculta_duvida(viCD_DUVIDA) {

    $.ajax({
        url: vsUrl + "funcoes/controllars/OcultaDuvida.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viCD_DUVIDA: viCD_DUVIDA
        }),
        success: function (data) {
            if (data == "1") {
                Sucesso();
            } else {
                Aviso();
            }
        },
        error: function () {
            Aviso();
        }
    });
}

function destaca_duvida(viCD_DUVIDA) {

    $.ajax({
        url: vsUrl + "funcoes/controllars/DestacaDuvida.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viCD_DUVIDA: viCD_DUVIDA
        }),
        success: function (data) {
            if (data == "1") {
                Sucesso();
            } else {
                Aviso();
            }
        },
        error: function () {
            Aviso();
        }
    });
}

$('.like_btn').click(function () {
    var duvidaId = $(this).data('duvida');
    var alunoId = $("#iCdAluno").val();
    atualiza_curtidas(duvidaId, alunoId);
});

$('.hide_btn').click(function () {
    var duvidaId = $(this).data('duvida');
    swal({
        title: "Você deseja atualizar a dúvida selecionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim",
        closeOnConfirm: false
    }, function () {
        oculta_duvida(duvidaId);
    });
});


$('.highlight_btn').click(function () {
    var duvidaId = $(this).data('duvida');
    swal({
        title: "Você deseja atualizar a dúvida selecionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#57f9ab",
        confirmButtonText: "Sim",
        closeOnConfirm: false
    }, function () {
        destaca_duvida(duvidaId);
    });
});


function Sucesso() {
    swal({
        title: "Sucesso!",
        text: "Dúvida atualizada com sucesso!",
        type: "success"
    }, function () {
        location.reload();
    });
}

function Aviso() {
    swal("Aviso!", "Ocorreu um erro na operação!", "warning");
}