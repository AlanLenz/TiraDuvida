
<?php

session_start();

$cdDisciplina = $_POST['cdDisciplina'];

require_once "../../includes/conexao-mysqli.php";

$alunos_qry = "SELECT
        a.NM_ALUNO
    FROM
        aluno_disciplina ad,
        aluno a,
        usuario u
    WHERE
        a.CD_USUARIO = ad.CD_USUARIO
        AND a.CD_USUARIO = u.CD_USUARIO
        AND u.ST_USUARIO = 'A'
        AND ad.CD_DISCIPLINA = '$cdDisciplina'";

$alunos_exec = mysqli_query($mysqli, $alunos_qry);

if (mysqli_num_rows($alunos_exec) >= 1) {

    $qtdAluno = 0;
    while ($dados_aluno = mysqli_fetch_array($alunos_exec)) {
        $nmAluno[$qtdAluno] = $dados_aluno['NM_ALUNO'];
        $qtdAluno++;
    }

    $result = [
        'nmAluno' => $nmAluno,
        'qtdAluno' => $qtdAluno
    ];

    echo json_encode($result);
} else {
    echo json_encode("Nenhum aluno encontrado.");
}


?>