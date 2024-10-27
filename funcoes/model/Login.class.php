<?php

require_once "../../includes/conexao-pdo.php";

class Login extends ConexaoPdo

{

    /* =============== VARIAVEIS =============== */

    private $usuario;
    private $senha;
    private $tipo_usuario;

    /* =============== FUNÇÃO LOGIN =============== */

    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = parent::getDB();

        $login = $pdo->prepare("
            SELECT
                u.CD_USUARIO,
                u.NM_USUARIO,
                u.SN_USUARIO,
                u.TP_USUARIO
            FROM
                usuario u
            WHERE
                u.NM_USUARIO = ? AND SN_USUARIO = ? AND ST_USUARIO = 'A'
        ");
        $login->bindValue(1, $this->usuario);
        $login->bindValue(2, $this->senha);
        $login->execute();
        if ($login->rowCount() == 1):
            $dados = $login->fetch(PDO::FETCH_OBJ);

            $this->tipo_usuario = $dados->TP_USUARIO;

            switch ($dados->TP_USUARIO) {
                case 'A':
                    // Lógica para o tipo de usuário Aluno
                    $_SESSION['tipo_usuario'] = 'A';
                    break;
                case 'P':
                    // Lógica para o tipo de usuário Professor
                    $_SESSION['tipo_usuario'] = 'P';
                    break;
                case 'C':
                    // Lógica para o tipo de usuário Coordenador
                    $_SESSION['tipo_usuario'] = 'C';
                    break;
            }

            $_SESSION['usuario_id'] = $dados->CD_USUARIO;
            $_SESSION['usuario_login'] = $dados->NM_USUARIO;

            return true;
        else:
            return false;
        endif;
    }

    /* =============== FUNÇÃO QUE BUSCA O TIPO DE USUÁRIO =============== */

    public function getCodigoUsuario()
    {
        switch ($this->tipo_usuario) {
            case 'A':
                return 'A';
            case 'P':
                return 'P';
            case 'C':
                return 'C';
            default:
                return '0'; // Valor padrão para tipos desconhecidos
        }
    }

    /* =============== FUNÇÃO LOGOFF =============== */

    public function logoff()
    {
        // Inicia a sessão, se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Remove todas as variáveis de sessão
        $_SESSION = [];

        // Destrói a sessão
        session_destroy();

        if (!isset($_SESSION['usuario_id'])):
            return true;
        else:
            return false;
        endif;
    }

    /* =============== GETTERS E SETTERS =============== */

    function getUsuario()
    {
        return $this->usuario;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }
}
