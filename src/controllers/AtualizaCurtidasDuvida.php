<?php

// REFERENCIA CLASSES
require_once "../model/Duvida.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$Duvida = new Duvida();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$viCD_DUVIDA = $_POST['viCD_DUVIDA'];
$viCD_ALUNO = $_POST['viCD_ALUNO'];

// Verifica se as variáveis estão definidas
if (isset($viCD_DUVIDA) && isset($viCD_ALUNO)) {
    // Atualiza curtidas e obtem o número atualizado de curtidas
    if ($Duvida->atualiza_curtidas($viCD_DUVIDA, $viCD_ALUNO)) {
        $novoNumeroCurtidas = $Duvida->obter_numero_curtidas($viCD_DUVIDA);
        echo json_encode(["status" => 1, "novoNumeroCurtidas" => $novoNumeroCurtidas]);
    } else {
        echo json_encode(["status" => 0]);
    }
} else {
    echo json_encode(["status" => 0, "error" => "Dados incompletos."]);
}
