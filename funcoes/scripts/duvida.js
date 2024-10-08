vsUrl = $("#vsUrl").val();

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
    }, function() {
        location.reload();
    });
}

function Aviso() {
    swal("Aviso!", "Ocorreu um erro na operação!", "warning");
}