<?php

require_once "../../includes/conexao.php";

class Duvida extends Conexao
{
    /* =============== VARIAVEIS =============== */

    private $CD_DUVIDA;
    private $DS_TITULO;
    private $CD_DESTAQUE;
    private $NR_CURTIDAS;
    private $TP_RESPOSTA;
    private $DT_HR;
    private $ST_DUVIDA;
    private $CD_ALUNO;
    private $CD_PROFESSOR;
    private $CD_DISCIPLINA;
    private $retorno_dados;

    /* =============== FUNÇÃO INSERE DADOS =============== */

    public function insere_dados()
    {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                    INSERT INTO duvida (
                        DS_TITULO,
                        DT_HR,
                        ST_DUVIDA,
                        CD_ALUNO,
                        CD_PROFESSOR,
                        CD_DISCIPLINA
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
            $insere_dados->execute(array(
                "$this->DS_TITULO",
                "$this->DT_HR",
                "$this->ST_DUVIDA",
                "$this->CD_ALUNO",
                "$this->CD_PROFESSOR",
                "$this->CD_DISCIPLINA"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function oculta_duvida() {
        try {

            $pdo = parent::getDB();

            $oculta_duvida = $pdo->prepare('
                UPDATE duvida SET 
                    ST_DUVIDA = ?
                WHERE 
                    CD_DUVIDA = ?;
            ');

            $oculta_duvida->execute(array(
                "$this->ST_DUVIDA",
                "$this->CD_DUVIDA"
            ));
            $this->setRetorno_dados($this->CD_DUVIDA);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function destaca_duvida() {
        try {

            $pdo = parent::getDB();

            $oculta_duvida = $pdo->prepare('
                UPDATE duvida SET 
                    CD_DESTAQUE = ?
                WHERE 
                    CD_DUVIDA = ?;
            ');

            $oculta_duvida->execute(array(
                "$this->CD_DESTAQUE",
                "$this->CD_DUVIDA"
            ));
            $this->setRetorno_dados($this->CD_DUVIDA);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getCD_DUVIDA()
    {
        return $this->CD_DUVIDA;
    }

    function getDS_TITULO()
    {
        return $this->DS_TITULO;
    }

    function getCD_DESTAQUE()
    {
        return $this->CD_DESTAQUE;
    }

    function getNR_CURTIDAS()
    {
        return $this->NR_CURTIDAS;
    }

    function getTP_RESPOSTA()
    {
        return $this->TP_RESPOSTA;
    }

    function getDT_HR()
    {
        return $this->DT_HR;
    }

    function getST_DUVIDA()
    {
        return $this->ST_DUVIDA;
    }

    function getCD_ALUNO()
    {
        return $this->CD_ALUNO;
    }

    function getCD_PROFESSOR()
    {
        return $this->CD_PROFESSOR;
    }

    function getCD_DISCIPLINA()
    {
        return $this->CD_DISCIPLINA;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setCD_DUVIDA($CD_DUVIDA)
    {
        $this->CD_DUVIDA = $CD_DUVIDA;
    }

    function setDS_TITULO($DS_TITULO)
    {
        $this->DS_TITULO = $DS_TITULO;
    }

    function setCD_DESTAQUE($CD_DESTAQUE)
    {
        $this->CD_DESTAQUE = $CD_DESTAQUE;
    }

    function setNR_CURTIDAS($NR_CURTIDAS)
    {
        $this->NR_CURTIDAS = $NR_CURTIDAS;
    }

    function setTP_RESPOSTA($TP_RESPOSTA)
    {
        $this->TP_RESPOSTA = $TP_RESPOSTA;
    }

    function setDT_HR($DT_HR)
    {
        $this->DT_HR = $DT_HR;
    }

    function setST_DUVIDA($ST_DUVIDA)
    {
        $this->ST_DUVIDA = $ST_DUVIDA;
    }

    function setCD_ALUNO($CD_ALUNO)
    {
        $this->CD_ALUNO = $CD_ALUNO;
    }

    function setCD_PROFESSOR($CD_PROFESSOR)
    {
        $this->CD_PROFESSOR = $CD_PROFESSOR;
    }

    function setCD_DISCIPLINA($CD_DISCIPLINA)
    {
        $this->CD_DISCIPLINA = $CD_DISCIPLINA;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}
