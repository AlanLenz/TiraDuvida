<?php

// DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

// REFENCIA CLASSES
require_once "../model/Resposta.class.php";
// require_once "../class/InformacoesGerais.class.php";
// require_once "../class/EnviosEmail.class.php";

// INSTANCIA CLASSES PARA OBJETOS
$Resposta = new Resposta();
// $EnviosEmailAluno = new EnviosEmailAluno();

// ALIMENTA VARIAVEIS PARA CADASTRO DE RESPOSTA
$Resposta->setDS_RESPOSTA($_POST['nResposta']);
$Resposta->setCD_PERGUNTA($_POST['nPergunta']);
$Resposta->setDT_HR(date("Y/m/d H:i:s", time()));

// VERIFICA SE CADASTROU NO BANCO
if ($Resposta->insere_dados()) {
    print 1;
} else {
    print 0;
}