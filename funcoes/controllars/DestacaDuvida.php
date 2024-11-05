<?php

// REFERENCIA CLASSES
require_once "../model/Duvida.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$Duvida = new Duvida();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$Duvida->setCD_DUVIDA($_POST['viCD_DUVIDA']);
$Duvida->setCD_DESTAQUE('S');

//VERIFICA SE CADASTROU NO BANCO
if ($Duvida->destaca_duvida()) {
    print 1;
} else {
    print 0;
}
