<?php

require_once "../../includes/conexao-pdo.php";

class Disciplina extends ConexaoPdo
{
    /* =============== VARIAVEIS =============== */

    private $CD_DISCIPLINA;
    private $CD_TURNO;
    private $NR_PERIODO;
    private $DS_DISCIPLINA;
    private $ST_DISCIPLINA;
    private $CD_CURSO;
    private $retorno_dados;

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados()
    {

        try {
            $pdo = parent::getDB();

            if($this->CD_DISCIPLINA !== ""){
                $vsDisciplina = "AND ad.CD_DISCIPLINA = '" . $this->CD_DISCIPLINA . "'";
            } else {
                $vsDisciplina = "";
            }

            $consulta_dados = $pdo->prepare("
                SELECT DISTINCT
                    a.NM_ALUNO,
                    p.NM_PROFESSOR,
                    d.DS_DISCIPLINA
                FROM
                    aluno_disciplina ad
                    INNER JOIN aluno a ON a.CD_USUARIO = ad.CD_USUARIO
                    INNER JOIN usuario u ON a.CD_USUARIO = u.CD_USUARIO
                    INNER JOIN disciplina d ON d.CD_DISCIPLINA = ad.CD_DISCIPLINA
                    INNER JOIN professor_disciplina pd ON d.CD_DISCIPLINA = pd.CD_DISCIPLINA
                    INNER JOIN professor p ON pd.CD_USUARIO = pd.CD_USUARIO
                WHERE
                    u.ST_USUARIO = 'A'
                    $vsDisciplina
                GROUP BY 
                    a.NM_ALUNO
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

    function getCD_DISCIPLINA()
    {
        return $this->CD_DISCIPLINA;
    }

    function getCD_TURNO()
    {
        return $this->CD_TURNO;
    }

    function getNR_PERIODO()
    {
        return $this->NR_PERIODO;
    }

    function getDS_DISCIPLINA()
    {
        return $this->DS_DISCIPLINA;
    }

    function getST_DISCIPLINA()
    {
        return $this->ST_DISCIPLINA;
    }

    function getCD_CURSO()
    {
        return $this->CD_CURSO;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setCD_DISCIPLINA($CD_DISCIPLINA)
    {
        $this->CD_DISCIPLINA = $CD_DISCIPLINA;
    }

    function setCD_TURNO($CD_TURNO)
    {
        $this->CD_TURNO = $CD_TURNO;
    }

    function setNR_PERIODO($NR_PERIODO)
    {
        $this->NR_PERIODO = $NR_PERIODO;
    }

    function setDS_DISCIPLINA($DS_DISCIPLINA)
    {
        $this->DS_DISCIPLINA = $DS_DISCIPLINA;
    }

    function setST_DISCIPLINA($ST_DISCIPLINA)
    {
        $this->ST_DISCIPLINA = $ST_DISCIPLINA;
    }

    function setCD_CURSO($CD_CURSO)
    {
        $this->CD_CURSO = $CD_CURSO;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}
