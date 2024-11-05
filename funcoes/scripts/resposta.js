$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*FORM*/
    $("#form_create_resposta").on('submit', (function (e) {

        $('#botao_create_resposta').html('<i class="fa fa-spinner fa-pulse"></i> Aguarde...');
        $("#botao_create_resposta").prop('disabled', true);

        e.preventDefault();
        $.ajax({
            url: vsUrl + "funcoes/controllars/SalvaDadosResposta.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (vsReturn) {
                $("#botao_create_resposta").html('<span><small>Enviar</small> <small>Enviar</small></span>');
                $("#botao_create_resposta").prop("disabled", false);
                if (vsReturn == "1") {
                    LimpaForm();
                    Sucesso();
                } else {
                    Aviso();
                }
            },
            error: function (vsReturn) {
                $("#botao_create_resposta").html('<span><small>Enviar</small> <small>Enviar</small></span>');
                $("#botao_create_resposta").prop("disabled", false);
                alert('Erro: ' + vsReturn);
            }
        });
        return false;
    }));

});

function LimpaForm() {
    $("#iResposta").val("");
}