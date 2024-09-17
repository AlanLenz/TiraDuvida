function modalAluno(cdDisciplina, nmDisciplina, nmProfessor) {

    let box_comm = document.querySelector("#iModalAlunos");
    while (box_comm.firstChild) {
        box_comm.firstChild.remove();
    }

    let vsUrl = $("#vsUrl").val();

    $.ajax({
        url: vsUrl + 'funcoes/controllers/modal-alunos.php',
        method: 'POST',
        data: {
            cdDisciplina: cdDisciplina
        },
        dataType: 'json',
    }).done(function (result) {
        // console.log(result);

        let modal_aluno = '<div class="modal fade exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
            '<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title" id="exampleModalLabel"><i class="far fa-users"></i> Integrantes de <b>' + nmDisciplina + '</b></h5>' +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<ul class="integrantes-materia">' +
            '<span class="text-center">Professor(a):</span>' +
            '<li class="modal-professor">' + nmProfessor + '</li>' +
            '<span class="text-center">Alunos:</span>';

        for (let i = 0; i < result.qtdAluno; i++) {
            modal_aluno += '<li>' + result.nmAluno[i] + '</li>';

        }

        modal_aluno += '</ul>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn_dark" data-bs-dismiss="modal"><span><small>Fechar</small> <small>Fechar</small></span></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#iModalAlunos').prepend(modal_aluno);

        $('.exampleModal').modal('show');
    });


}