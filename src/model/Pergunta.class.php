<?php

require_once "../../includes/conexaoPdo.php";

class Pergunta extends ConexaoPdo
{
    /* =============== VARIAVEIS =============== */

    private $CD_PERGUNTA;
    private $DS_PERGUNTA;
    private $IMAGEM;
    private $DT_HR;
    private $CD_DUVIDA;
    private $retorno_dados;

    /* =============== FUNÇÃO INSERE DADOS =============== */

    public function insere_dados()
    {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                    INSERT INTO pergunta (
                        DS_PERGUNTA,
                        IMAGEM,
                        DT_HR,
                        CD_DUVIDA
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
            $insere_dados->execute(array(
                "$this->DS_PERGUNTA",
                "$this->IMAGEM",
                "$this->DT_HR",
                "$this->CD_DUVIDA"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getCD_PERGUNTA()
    {
        return $this->CD_PERGUNTA;
    }

    function getDS_PERGUNTA()
    {
        return $this->DS_PERGUNTA;
    }

    function getIMAGEM()
    {
        return $this->IMAGEM;
    }

    function getDT_HR()
    {
        return $this->DT_HR;
    }

    function getCD_DUVIDA()
    {
        return $this->CD_DUVIDA;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setCD_PERGUNTA($CD_PERGUNTA)
    {
        $this->CD_PERGUNTA = $CD_PERGUNTA;
    }

    function setDS_PERGUNTA($DS_PERGUNTA)
    {
        $this->DS_PERGUNTA = $DS_PERGUNTA;
    }

    function setIMAGEM($IMAGEM)
    {
        $this->IMAGEM = $IMAGEM;
    }

    function setDT_HR($DT_HR)
    {
        $this->DT_HR = $DT_HR;
    }

    function setCD_DUVIDA($CD_DUVIDA)
    {
        $this->CD_DUVIDA = $CD_DUVIDA;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}
