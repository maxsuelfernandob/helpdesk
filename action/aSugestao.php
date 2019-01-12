<?php

@session_start();
require_once '../model/mSugestao.php';

class aSugestao extends mSugestao {
    
    private $sqlInsert = "insert into sugestao (sug_descricao, sug_usu_id, sug_data, sug_ip) values (%s, %s, current_timestamp,
                         %s)";
    private $sqlSelect = "select s.sug_id, s.sug_descricao, s.sug_usu_id, cast(s.sug_data as date) as sug_data, 
            cast(s.sug_data as time) as sug_hora, s.sug_ip, u.usu_nome, u.usu_setor from sugestao s, usuario u where 
            s.sug_usu_id = u.usu_id %s";
    
    public function Insert() {
        $dao = new dao();
        $sql = sprintf($this->sqlInsert, $this->quotedstr($this->getSug_descricao()), 
               $this->quotedstr($this->getUsuario()->getUsu_id()), $this->quotedstr($this->getSug_ip()));
        return $dao->Dml($sql);
    }
    
    public function Select($where='') {
        $dao = new dao();
        $sql = sprintf($this->sqlSelect, $where);
        $rs = $dao->Query($sql);
        return $rs;
    }
    
}

