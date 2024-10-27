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

function oculta_duvida(viCD_DUVIDA) {

    $.ajax({
        url: vsUrl + "funcoes/controllers/OcultaDuvida.php",
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
        url: vsUrl + "funcoes/controllers/DestacaDuvida.php",
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

$('.hide_btn').click(function () {
    var duvidaId = $(this).data('duvida');
    swal({
        title: "Você deseja ocultar a dúvida selecionada?",
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
        title: "Você deseja destacar a dúvida selecionada?",
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