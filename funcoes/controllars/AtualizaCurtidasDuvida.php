<?php

// REFERENCIA CLASSES
require_once "../model/Duvida.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$Duvida = new Duvida();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$Duvida->setCD_DUVIDA($_POST['viCD_DUVIDA']);

//VERIFICA SE CADASTROU NO BANCO
if ($Duvida->atualiza_curtidas($_POST['viCD_DUVIDA'])) {
    $novoNumeroCurtidas = $Duvida->obter_numero_curtidas($_POST['viCD_DUVIDA']);
    echo json_encode(["status" => 1, "novoNumeroCurtidas" => $novoNumeroCurtidas]);
} else {
    print 0;
}