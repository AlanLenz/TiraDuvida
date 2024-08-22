<?php
header("Content-type: application/json");

require_once '../conexao.php';

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM USUARIO WHERE NM_USUARIO = ? AND SN_USUARIO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($pass == $row['SN_USUARIO']) {
        echo json_encode("Usuário e senha corretos.");
    } else {
        echo json_encode("Senha incorreta.");
    }
} else {
    echo "Usuário não encontrado.";
}
