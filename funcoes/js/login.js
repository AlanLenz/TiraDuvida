$("#botao_enviar_email").click(function() {
    Swal.fire({
        title: "Email enviado!",
        text: "Caso o usuário tenha sido informado corretamente você estará recebendo um e-mail em alguns instantes com as instruções para redefinir sua senha.",
        icon: "success"
    });
});

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});