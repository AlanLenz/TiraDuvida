<?php

require_once "../../includes/conexaoPdo.php";

class Resposta extends ConexaoPdo
{
    /* =============== VARIAVEIS =============== */

    private $CD_RESPOSTA;
    private $DS_RESPOSTA;
    private $IMAGEM;
    private $DT_HR;
    private $CD_PERGUNTA;
    private $retorno_dados;

    /* =============== FUNÇÃO INSERE DADOS =============== */

    public function insere_dados()
    {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                    INSERT INTO resposta (
                        DS_RESPOSTA,
                        IMAGEM,
                        DT_HR,
                        CD_PERGUNTA
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
            $insere_dados->execute(array(
                "$this->DS_RESPOSTA",
                "$this->IMAGEM",
                "$this->DT_HR",
                "$this->CD_PERGUNTA"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getCD_RESPOSTA()
    {
        return $this->CD_RESPOSTA;
    }

    function getDS_RESPOSTA()
    {
        return $this->DS_RESPOSTA;
    }

    function getIMAGEM()
    {
        return $this->IMAGEM;
    }

    function getDT_HR()
    {
        return $this->DT_HR;
    }

    function getCD_PERGUNTA()
    {
        return $this->CD_PERGUNTA;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setCD_RESPOSTA($CD_RESPOSTA)
    {
        $this->CD_RESPOSTA = $CD_RESPOSTA;
    }

    function setDS_RESPOSTA($DS_RESPOSTA)
    {
        $this->DS_RESPOSTA = $DS_RESPOSTA;
    }

    function setIMAGEM($IMAGEM)
    {
        $this->IMAGEM = $IMAGEM;
    }

    function setDT_HR($DT_HR)
    {
        $this->DT_HR = $DT_HR;
    }

    function setCD_PERGUNTA($CD_PERGUNTA)
    {
        $this->CD_PERGUNTA = $CD_PERGUNTA;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}
