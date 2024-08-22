$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $('#formLoginUser').on('submit', function (event) {
        event.preventDefault();

        var username = $('#iUser').val();
        var password = $('#iPass').val();

        $.ajax({
            url: vsUrl + 'funcoes/php/login.php',
            method: 'POST',
            data: {
                user: username,
                pass: password
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // Manipula os dados recebidos
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição: ' + error);
            }
        });

        // if (username === 'usuarioProfessor' && password === 'senhaProfessor') {
        //     // Redireciona para a página desejada
        //     window.location.href = 'periodos-professor';
        // } else if (username === 'usuarioAluno' && password === 'senhaAluno') {
        //     // Redireciona para a página desejada
        //     window.location.href = 'disciplinas-aluno';
        // } else {
        //     // Exibe a mensagem de erro
        //     $('#errorMessage').show();
        //     $("#emailUser").css("border-color", "#ff0000");
        //     $("#passwordUser").css("border-color", "#ff0000");
        // }
    });
});