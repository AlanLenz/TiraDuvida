
<?php

require_once "../model/Disciplina.class.php";

$Disciplina = new Disciplina();
$Disciplina->setCD_DISCIPLINA($_POST['viCdDisciplina']);

if ($Disciplina->consulta_dados()) {
    print $Disciplina->getRetorno_dados();
} else {
    print 0;
}
