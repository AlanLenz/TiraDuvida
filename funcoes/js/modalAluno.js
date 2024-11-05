vsUrl = $("#vsUrl").val();

function abre_modal_alunos(viCdDisciplina) {

    $.ajax({
        url: vsUrl + "funcoes/controllars/RetornaModalAlunos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viCdDisciplina: viCdDisciplina
        }),
        success: function (data) {
            if (data !== 0) {
                $("#dsDisciplina").html(data[0].DS_DISCIPLINA);
                $("#nmProfessor").html(data[0].NM_PROFESSOR);
                data.forEach(function (aluno) {
                    $("#nmAluno").append("<li>" + aluno.NM_ALUNO + "</li>");
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
    $("#nmProfessor").html('');
});