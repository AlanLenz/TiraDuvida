<?php
header("Content-type: application/json");

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM USUARIO WHERE NM_USUARIO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($pass, $row['SN_USUARIO'])) {
        echo "Usuário e senha corretos.";
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}
