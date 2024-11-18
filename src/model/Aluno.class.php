<?php

require_once "../../includes/conexaoPdo.php";

class Aluno extends ConexaoPdo
{
    /* =============== VARIAVEIS =============== */

    private $CD_ALUNO;
    private $RA_ALUNO;
    private $NM_ALUNO;
    private $NR_PERIODO;
    private $CD_USUARIO;
    private $retorno_dados;

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados()
    {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    a.NM_ALUNO,
                    d.DS_DISCIPLINA
                FROM
                    aluno_disciplina ad,
                    aluno a,
                    usuario u
                    LEFT JOIN disciplina d ON d.CD_DISCIPLINA = cd.DISCIPLINA 
                WHERE
                    a.CD_USUARIO = ad.CD_USUARIO
                    AND a.CD_USUARIO = u.CD_USUARIO
                    AND u.ST_USUARIO = 'A'
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0) :
                $this->setRetorno_dados(json_encode($consulta_dados->fetchAll()));
                return true;
            else :
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getCD_ALUNO()
    {
        return $this->CD_ALUNO;
    }

    function getRA_ALUNO()
    {
        return $this->RA_ALUNO;
    }

    function getNM_ALUNO()
    {
        return $this->NM_ALUNO;
    }

    function getNR_PERIODO()
    {
        return $this->NR_PERIODO;
    }

    function getCD_USUARIO()
    {
        return $this->CD_USUARIO;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setCD_ALUNO($CD_ALUNO)
    {
        $this->CD_ALUNO = $CD_ALUNO;
    }

    function setRA_ALUNO($RA_ALUNO)
    {
        $this->RA_ALUNO = $RA_ALUNO;
    }

    function setNM_ALUNO($NM_ALUNO)
    {
        $this->NM_ALUNO = $NM_ALUNO;
    }

    function setNR_PERIODO($NR_PERIODO)
    {
        $this->NR_PERIODO = $NR_PERIODO;
    }

    function setCD_USUARIO($CD_USUARIO)
    {
        $this->CD_USUARIO = $CD_USUARIO;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}
