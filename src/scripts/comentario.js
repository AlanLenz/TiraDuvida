$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*FORM*/
    $("#form_create_comentario").on('submit', (function (e) {

        $('#botao_create_comentario').html('<i class="fa fa-spinner fa-pulse"></i> Aguarde...');
        $("#botao_create_comentario").prop('disabled', true);

        e.preventDefault();
        $.ajax({
            url: vsUrl + "src/controllers/SalvaDadosComentario.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (vsReturn) {
                $("#botao_create_comentario").html('<span><small>Enviar</small> <small>Enviar</small></span>');
                $("#botao_create_comentario").prop("disabled", false);
                if (vsReturn == "1") {
                    LimpaForm();
                    Sucesso();
                } else {
                    Aviso();
                }
            },
            error: function (vsReturn) {
                $("#botao_create_comentario").html('<span><small>Enviar</small> <small>Enviar</small></span>');
                $("#botao_create_comentario").prop("disabled", false);
                alert('Erro: ' + vsReturn);
            }
        });
        return false;
    }));

});

function LimpaForm() {
    $("#iResposta").val("");
}