<?php

@session_start();
require_once "../config/configuracoes.php";

class conexao extends configuracoes {

    private $user = "postgres";
    private $password = "root";
    private $host = "localhost";
    private $database = "helpdesk";
    private static $instance;
    
    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getHost() {
        return $this->host;
    }

    public function getDatabase() {
        return $this->database;
    }
    
    private function Connect() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO("pgsql:host=localhost;dbname=helpdesk", "postgres", "root");
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("ERRO AO CONECTAR O BANCO " . $e->getMessage());
            }
        }
        return self::$instance;
    }
    
    public function RunQuery($sql) {
        try {
            $stm = $this->Connect()->prepare($sql);
            $executou = $stm->execute();
            if (!$executou) {
                $erro = $stm->errorInfo();
            }
            return $executou;
        } catch (PDOException $e) {
            print "Erro ao tentar manipular dados: ". $e->getMessage(). "\n";
            die;
        }
    }

    public function RunSelect($sql) {
        try {
            $stm = $this->Connect()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            print "Desculpe, mas não houve comunicação com o banco de dados. Por favor tente novamente.";
        }
    }

}