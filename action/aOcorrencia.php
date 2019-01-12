<?php

@session_start();
require_once '../model/mOcorrencia.php';

class aOcorrencia extends mOcorrencia {
    
    private $sqlInsert = "insert into ocorrencia (oco_relacionado, oco_descricao, oco_usu_id, oco_data, oco_ip, oco_status,
            oco_obs, oco_atendente) values (%s, %s, %s, current_timestamp, %s, %s, %s, %s)";
    private $sqlSelect = "select o.oco_id, o.oco_relacionado, o.oco_descricao, o.oco_usu_id, cast(o.oco_data as date) as oco_data, cast(o.oco_data as time) as oco_hora, o.oco_ip, o.oco_status, o.oco_obs, 
            o.oco_atendente, u.usu_nome, u.usu_setor from ocorrencia o, usuario u where o.oco_usu_id = u.usu_id %s";
    
    public function Insert() {
        $dao = new dao();
        $sql = sprintf($this->sqlInsert, $this->quotedstr($this->getOco_relacionado()), $this->quotedstr($this->getOco_descricao()), 
               $this->quotedstr($this->getUsuario()->getUsu_id()), $this->quotedstr($this->getOco_ip()), 
               $this->quotedstr($this->getOco_status()), $this->quotedstr($this->getOco_obs()), $this->quotedstr($this->getOco_atendente()));
        return $dao->Dml($sql);
    }
    
    public function Select($where='') {
        $dao = new dao();
        $sql = sprintf($this->sqlSelect, $where);
        $rs = $dao->Query($sql);
        return $rs;
    }
    
}

