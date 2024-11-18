<?php

// DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

// REFENCIA CLASSES
require_once "MontaUrlAmigavel.php";
require_once "../model/Pergunta.class.php";
require_once "../model/Arquivos.class.php";

// INSTANCIA CLASSES PARA OBJETOS
$Pergunta = new Pergunta();
$Arquivos = new Arquivos();

// ALIMENTA VARIAVEIS PARA CADASTRO DE RESPOSTA

if ($Pergunta->insere_dados()) {

    // ALIMENTA OS DADOS DA PERGUNTA
    $Pergunta->setCD_DUVIDA($_POST['nCdDuvida']);
    $Pergunta->setDS_PERGUNTA($_POST['nTextoPergunta']);
    $Pergunta->setDT_HR(date("Y/m/d H:i:s", time()));

    $Arquivos->setArquivo_atual($_POST['nImagemAtual']);
    $Arquivos->setNovo_arquivo($_FILES['nImagem']);
    $Arquivos->setNome_amigavel("imagem-" . url_amigavel($_POST['nTituloPergunta']));
    $Arquivos->setPasta("perguntas");
    $Arquivos->insere_arquivo();
    $Pergunta->setIMAGEM($Arquivos->getRetorno_arquivo());

    if ($Pergunta->insere_dados()) {
        print 1;
    } else {
        print 0;
    }
} else {
    print 0;
}
