<?php

require_once "../../includes/conexao.php";

class Login extends Conexao
{
    /* =============== VARIAVEIS =============== */

    private $usuario;
    private $senha;
    private $tipo_usuario;

    /* =============== FUNÇÃO LOGIN =============== */

    public function login()
    {
        if (!isset($_SESSION)) {
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

    /* =============== FUNÇÃO LOGOFF =============== */

    // public static function logoff() {
    //     if (!isset($_SESSION)) {
    //         session_start();
    //     }

    //     if ($_COOKIE['wd_logado']):
    //         setcookie('wd_id_usuario', '', time() + 86400, '/');
    //         setcookie('wd_nome', '', time() + 86400, '/');
    //         setcookie('wd_login', '', time() + 86400, '/');
    //         setcookie('wd_imagem_perfil', '', time() + 86400, '/');
    //         setcookie('wd_status', '', time() + 86400, '/');
    //         setcookie('wd_logo_principal', '', time() + 86400, '/');
    //         setcookie('wd_whatsapp', '', time() + 86400, '/');
    //         setcookie('wd_email', '', time() + 86400, '/');
    //         setcookie('id_conteudo_personalizado', '', time() + 86400, '/');
    //         setcookie('titulo_conteudo_personalizado', '', time() + 86400, '/');
    //         setcookie('largura_conteudo_personalizado', '', time() + 86400, '/');
    //         setcookie('altura_conteudo_personalizado', '', time() + 86400, '/');
    //         setcookie('wd_logado', '', time() + 86400, '/');
    //         return true;
    //     else:
    //         return false;
    //     endif;
    // }

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
