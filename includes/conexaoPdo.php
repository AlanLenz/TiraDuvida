<?php

include_once "../config.php";

abstract class ConexaoPdo {

    private static $instance = null;

    private static function conectaPdo() {

        try {
            if (self::$instance == null):
                $dsn = "mysql:host=".SERVIDOR.";dbname=".BANCO.";charset=utf8";
                self::$instance = new PDO($dsn, USUARIO, SENHA);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
        return self::$instance;
    }

    protected static function getDB() {
        return self::conectaPdo();
    }

}


