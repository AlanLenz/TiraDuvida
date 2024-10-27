vsUrl = $("#vsUrl").val();

function abre_modal_alunos(viCdDisciplina) {

    $.ajax({
        url: vsUrl + "funcoes/controllers/RetornaModalAlunos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viCdDisciplina: viCdDisciplina
        }),
        success: function (data) {
            if (data !== 0) {
                $("#dsDisciplina").html(data[0].DS_DISCIPLINA);
                data.forEach(function (aluno) {
                    $("#nmAluno").append("<p>" + aluno.NM_ALUNO + "</p>");
                });
                $("#modal_visualizar_alunos").modal("show");
            } else {
                AvisoPersonalizado("Dados não encontrados!");
            }
        },
        error: function () {
            Erro();
        }
    });
}

$('#modal_visualizar_alunos').on('hidden.bs.modal', function () {
    $("#dsDisciplina").html('');
    $("#nmAluno").html('');
});