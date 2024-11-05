<?php

// DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

// REFENCIA CLASSES
require_once "MontaUrlAmigavel.php";
require_once "../model/Duvida.class.php";
require_once "../model/Resposta.class.php";
require_once "../model/Arquivos.class.php";
// require_once "../class/InformacoesGerais.class.php";
// require_once "../class/EnviosEmail.class.php";

// INSTANCIA CLASSES PARA OBJETOS
$Duvida = new Duvida();
$Resposta = new Resposta();
$Arquivos = new Arquivos();
// $EnviosEmailAluno = new EnviosEmailAluno();

// ALIMENTA VARIAVEIS PARA CADASTRO DE RESPOSTA
$Resposta->setDS_RESPOSTA($_POST['nResposta']);
$Resposta->setCD_PERGUNTA($_POST['nPergunta']);
$Resposta->setDT_HR(date("Y/m/d H:i:s", time()));

$Arquivos->setArquivo_atual($_POST['nImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['nImagem']);
$Arquivos->setNome_amigavel("imagem-" . url_amigavel("resposta-" . $_POST['nPergunta']));
$Arquivos->setPasta("respostas");
$Arquivos->insere_arquivo();
$Resposta->setIMAGEM($Arquivos->getRetorno_arquivo());

$Duvida->setCD_DUVIDA($_POST['nDuvida']);

// VERIFICA SE CADASTROU NO BANCO
if ($Resposta->insere_dados() && $Duvida->responde_duvida()) {
    print 1;
} else {
    print 0;
}