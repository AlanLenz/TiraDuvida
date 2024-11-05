<?php

require_once "../../includes/conexao-pdo.php";

class Duvida extends ConexaoPdo
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
                        CD_DESTAQUE,
                        NR_CURTIDAS,
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
                        ?,
                        ?,
                        ?
                    );
                ');
            $insere_dados->execute(array(
                "$this->DS_TITULO",
                "$this->CD_DESTAQUE",
                "$this->NR_CURTIDAS",
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
    
            // Primeiro, obtenha o valor atual de CD_DESTAQUE para a dúvida especificada
            $consulta_duvida = $pdo->prepare('
                SELECT
                    ST_DUVIDA
                FROM
                    duvida
                WHERE
                    CD_DUVIDA = ?
            ');
            $consulta_duvida->execute([$this->CD_DUVIDA]);
            $resultado_duvida = $consulta_duvida->fetch(PDO::FETCH_ASSOC);
    
            // Verifique o valor atual de CD_DESTAQUE e alterne entre 'S' e 'N'
            $this->ST_DUVIDA = ($resultado_duvida['ST_DUVIDA'] === 'OC') ? 'P' : 'OC';
    
            // Atualize o campo CD_DESTAQUE com o novo valor
            $oculta_duvida = $pdo->prepare('
                UPDATE duvida SET 
                    ST_DUVIDA = ?
                WHERE 
                    CD_DUVIDA = ?
            ');
    
            $oculta_duvida->execute([
                $this->ST_DUVIDA,
                $this->CD_DUVIDA
            ]);
    
            $this->setRetorno_dados($this->CD_DUVIDA);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function responde_duvida() {
        try {

            $pdo = parent::getDB();

            $responde_duvida = $pdo->prepare('
                UPDATE duvida SET 
                    ST_DUVIDA = \'R\'
                WHERE
                    CD_DUVIDA = ?;
            ');

            $responde_duvida->execute(array(
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
    
            // Primeiro, obtenha o valor atual de CD_DESTAQUE para a dúvida especificada
            $consulta_destaque = $pdo->prepare('
                SELECT
                    CD_DESTAQUE
                FROM
                    duvida
                WHERE
                    CD_DUVIDA = ?
            ');
            $consulta_destaque->execute([$this->CD_DUVIDA]);
            $resultado_destaque = $consulta_destaque->fetch(PDO::FETCH_ASSOC);
    
            // Verifique o valor atual de CD_DESTAQUE e alterne entre 'S' e 'N'
            $this->CD_DESTAQUE = ($resultado_destaque['CD_DESTAQUE'] === 'S') ? 'N' : 'S';
    
            // Atualize o campo CD_DESTAQUE com o novo valor
            $destaca_duvida = $pdo->prepare('
                UPDATE duvida SET 
                    CD_DESTAQUE = ?
                WHERE 
                    CD_DUVIDA = ?
            ');
    
            $destaca_duvida->execute([
                $this->CD_DESTAQUE,
                $this->CD_DUVIDA
            ]);
    
            $this->setRetorno_dados($this->CD_DUVIDA);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function obter_numero_curtidas() {
        try {
            $pdo = parent::getDB();

            $consulta = $pdo->prepare('
                SELECT
                    NR_CURTIDAS
                FROM
                    duvida
                WHERE
                    CD_DUVIDA = ?
            ');
            $consulta->execute([$this->CD_DUVIDA]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            
            // Retorna o número de curtidas, ou 0 se não houver um valor definido
            return $resultado ? (int)$resultado['NR_CURTIDAS'] : 0;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return 0;
        }
    }

    public function atualiza_numero_curtidas() {
        try {
            $pdo = parent::getDB();
    
            // Conta o número de curtidas (CURTIDA = 1) para a dúvida especificada
            $consulta = $pdo->prepare('
                SELECT
                    COUNT(*) as totalCurtidas 
                FROM
                    curtida_duvida_aluno 
                WHERE
                    CD_DUVIDA = ? AND
                    CURTIDA = 1
            ');
            $consulta->execute([$this->CD_DUVIDA]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
            // Atualiza o campo NR_CURTIDAS na tabela duvida
            $atualiza = $pdo->prepare('
                UPDATE
                    duvida
                SET
                    NR_CURTIDAS = ? 
                WHERE
                    CD_DUVIDA = ?
            ');
            $atualiza->execute([$resultado['totalCurtidas'], $this->CD_DUVIDA]);
    
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
    

    public function atualiza_curtidas($CD_ALUNO) {
        try {
            $pdo = parent::getDB();
    
            // Verifica se já existe uma entrada para o aluno e dúvida específicos
            $consulta = $pdo->prepare('
                SELECT
                    CURTIDA
                FROM
                    curtida_duvida_aluno 
                WHERE
                    CD_ALUNO = ? AND
                    CD_DUVIDA = ?
            ');
            $consulta->execute([$CD_ALUNO, $this->CD_DUVIDA]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                // Se existe uma entrada, alterna o valor de CURTIDA entre 1 e 0
                $novo_valor = ($resultado['CURTIDA'] == 1) ? 0 : 1;
    
                $atualiza = $pdo->prepare('
                    UPDATE
                        curtida_duvida_aluno 
                    SET
                        CURTIDA = ? 
                    WHERE
                        CD_ALUNO = ? AND
                        CD_DUVIDA = ?
                ');
                $atualiza->execute([$novo_valor, $CD_ALUNO, $this->CD_DUVIDA]);
    
            } else {
                // Se não existe uma entrada, insere uma nova com CURTIDA = 1
                $insere = $pdo->prepare('
                    INSERT INTO curtida_duvida_aluno (CD_ALUNO, CD_DUVIDA, CURTIDA) 
                    VALUES (?, ?, 1)
                ');
                $insere->execute([$CD_ALUNO, $this->CD_DUVIDA]);
            }
    
            // Atualiza o total de curtidas na tabela duvida
            $this->atualiza_numero_curtidas();
    
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
