$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*FORM LOGIN*/
    $("#formLoginUser").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "src/controllers/ExecutaLogin.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                switch (data) {
                    case 'A':
                        window.location.href = "disciplinasAluno";
                        break;
                    case 'P':
                    case 'C':
                        window.location.href = "periodosProfessor";
                        break;
                    case 0:
                        CloseLoading();
                        AvisoPersonalizado("Usuário ou senha incorretos");
                        break;
                    default:
                        CloseLoading();
                        AvisoPersonalizado("Usuário ou senha incorretos");
                        break;
                }
            },
            error: function () {
                CloseLoading();
                Erro();
            }
        });
        return false;
    }));
});

function AvisoPersonalizado(mensagem) {
    swal("Aviso!", mensagem, "warning");
}
function Loading() {
    $(".preloader").fadeIn();
}
function CloseLoading() {
    $(".preloader").fadeOut();
}
function Erro() {
    swal("Erro!", "Se o problema persistir contate o T.I.", "error");
}