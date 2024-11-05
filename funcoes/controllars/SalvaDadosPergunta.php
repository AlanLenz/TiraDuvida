<?php

// DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

// REFENCIA CLASSES
require_once "MontaUrlAmigavel.php";
require_once "../model/Duvida.class.php";
require_once "../model/Pergunta.class.php";
require_once "../model/Arquivos.class.php";
// require_once "../class/EnviosEmail.class.php";

// INSTANCIA CLASSES PARA OBJETOS
$Duvida = new Duvida();
$Pergunta = new Pergunta();
$Arquivos = new Arquivos();
// $EnviosEmailAluno = new EnviosEmailAluno();

// ALIMENTA VARIAVEIS PARA CADASTRO DE RESPOSTA
$Duvida->setDS_TITULO($_POST['nTituloPergunta']);
$Duvida->setCD_DESTAQUE("N");
$Duvida->setNR_CURTIDAS(0);
$Duvida->setDT_HR(date("Y/m/d H:i:s", time()));
$Duvida->setST_DUVIDA("P");
$Duvida->setCD_ALUNO($_POST['nCdAluno']);
$Duvida->setCD_PROFESSOR($_POST['nCdProfessor']);
$Duvida->setCD_DISCIPLINA($_POST['nCdDisciplina']);

$Arquivos->setArquivo_atual($_POST['nImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['nImagem']);
$Arquivos->setNome_amigavel("imagem-" . url_amigavel($_POST['nTituloPergunta']));
$Arquivos->setPasta("perguntas");
$Arquivos->insere_arquivo();
$Pergunta->setIMAGEM($Arquivos->getRetorno_arquivo());

if ($Duvida->insere_dados()) {

    $cd_duvida_inserido = $Duvida->getRetorno_dados();

    // ALIMENTA OS DADOS DA PERGUNTA
    $Pergunta->setDS_PERGUNTA($_POST['nTextoPergunta']);
    $Pergunta->setDT_HR(date("Y/m/d H:i:s", time()));
    $Pergunta->setCD_DUVIDA($cd_duvida_inserido);

    if ($Pergunta->insere_dados()) {
        print 1;
    } else {
        print 0;
    }
} else {
    print 0;
}