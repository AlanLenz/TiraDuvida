<?php

require_once "../model/Login.class.php";

$Login = new Login();
$Login->setUsuario($_POST['nUser']);
$Login->setSenha($_POST['nPass']);
// $Login->setSenha(md5($_POST['pass']));

if ($Login->login()) {
    $codigoUsuario = $Login->getCodigoUsuario();
    print $codigoUsuario;
} else {
    print 0;
}