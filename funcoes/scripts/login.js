$(document).ready(function () {

    vsUrl = $("#vsUrl").val();
    
    $("#aviso_erro").hide();

    /*FORM LOGIN*/
    $("#formLoginUser").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "funcoes/controllers/login.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                switch (data) {
                    case 1:
                        window.location.href = "disciplinas-aluno";
                        break;
                    case 2:
                        window.location.href = "periodos-professor";
                        break;
                    case 3:
                        window.location.href = "periodos-professor";
                        break;
                    case 0:
                        CloseLoading();
                        $("#aviso_erro").show();
                        break;
                    default:
                        CloseLoading();
                        $("#aviso_erro").show();
                        break;
                }
            },
            error: function () {
                fecha_loader();
                Erro();
            }
        });
        return false;
    }));
});

function Loading() {
    $(".preloader").fadeIn();
}
function CloseLoading() {
    $(".preloader").fadeOut();
}