<?php

require_once '../config/complemento.php';

class dao extends complemento {
    
    private $sqlContaLinhas = "select count(*) from %s where 1=1 %s";
    
    public function ContaLinhas($tabela, $where = "") {
        try {
            $sql = sprintf($this->sqlContaLinhas, $tabela, $where); 
            $rs = $this->RunSelect($sql);
            return $rs[0]["count"];
        } catch (Exception $e) {
            echo "Caught exception:", $e->getMessage(), "\n";
        }
    }

    public function Query($sql) {
        try {
            return $this->RunSelect($sql);
        } catch (Exception $e) {
            echo "Caught exception:", $e->getMessage(), "\n";
        }
    }
    
    public function Dml($sql) {
        try {
            $retorno = $this->RunQuery($sql); 
            return $retorno;
        } catch (PDOException $e) {
            print "Erro ao tentar manipular dados: ". $e->getMessage(). "\n";
            die;
        }
    }

}

