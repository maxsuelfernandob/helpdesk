<?php

@session_start();
require_once '../model/mUsuario.php';

class aUsuario extends mUsuario {
    
    private $sqlSelect = "select * from usuario";
    private $sqlInsert = "insert into usuario (usu_nome, usu_sobrenome, usu_login, usu_senha, usu_email, usu_setor, usu_ramal,
            usu_tipo, usu_ativo, usu_dataCadastrado) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, current_timestamp)";
    private $sqlSelectLogin = "select (case when usu_senha = md5(%s) then 'LOGIN_SUCESSO' when usu_senha != md5(%s) then 
            'LOGIN_ERRO'  end), usu_id, usu_nome, usu_sobrenome, usu_login, usu_email, usu_tipo, usu_ativo from usuario where 
            upper(usu_login) = upper(%s)";
    private $sqlSelectVerificaLoginEmail = "select usu_id, usu_nome, usu_sobrenome, usu_login, usu_senha, usu_email, usu_ativo 
            from usuario where usu_login = %s or usu_email = %s";
    private $sqlUpdateNovaSenha = "update usuario set usu_senha = md5(%s) where usu_email = %s or usu_login = %s";
    private $sqlInsertCodSeguranca = "insert into cod_seguranca (codseg_descricao, codseg_usu_id) values (%s, %s)";
    private $sqlSelectVerificaCodSeguranca = "select * from cod_seguranca where codseg_descricao = %s";
    private $sqlDeleteCodSeguranca = "delete from cod_seguranca where codseg_descricao = %s";
    
    public function Select($where = '') {
        $dao = new dao();
        $sql = sprintf($this->sqlSelect, $where);
        $rs = $dao->Query($sql);
        return $rs;
    }
    
    public function Insert() {
        $dao = new dao();
        $sql = sprintf($this->sqlInsert, $this->quotedstr($this->getUsu_nome()), $this->quotedstr($this->getUsu_sobrenome()),
               $this->quotedstr($this->getUsu_login()), $this->quotedstr(md5($this->getUsu_senha())), 
               $this->quotedstr($this->getUsu_email()), $this->quotedstr($this->getUsu_setor()), 
               $this->quotedstr($this->getUsu_ramal()), $this->quotedstr($this->getUsu_tipo()), 
               $this->quotedstr($this->getUsu_ativo()));
        return $dao->Dml($sql);
    }

    public function SelectLogin($retornaSql = false) {
        $dao = new dao();
        $sql = sprintf($this->sqlSelectLogin, $this->quotedstr($this->getUsu_senha()), $this->quotedstr($this->getUsu_senha()), 
               $this->quotedstr($this->getUsu_login()));
        $rs = $dao->Query($sql, $retornaSql);
        return $rs;
    }
    
    public function SelectVerificaLoginEmail() {
        $dao = new dao();
        $sql = sprintf($this->sqlSelectVerificaLoginEmail, $this->quotedstr($this->getUsu_loginEmail()), 
               $this->quotedstr($this->getUsu_loginEmail()));
        $rs = $dao->Query($sql);
        return $rs;
    }
    
    public function UpdateNovaSenha() {
        $dao = new dao();
        $sql = sprintf($this->sqlUpdateNovaSenha, $this->quotedstr($this->getUsu_novaSenha()), 
               $this->quotedstr($this->getUsu_loginEmail()), $this->quotedstr($this->getUsu_loginEmail()));
        return $dao->Dml($sql);        
    }
    
    public function InsertCodSeguranca() {
        $dao = new dao();
        $sql = sprintf($this->sqlInsertCodSeguranca, $this->quotedstr($this->getUsu_codSeguranca()), 
               $this->quotedstr($this->getUsu_id()));
        return $dao->Dml($sql); 
    }
    
    public function SelectVerificaCodSeguranca() {
        $dao = new dao();
        $sql = sprintf($this->sqlSelectVerificaCodSeguranca, $this->quotedstr($this->getUsu_codSeguranca()), 
               $this->quotedstr($this->getUsu_id()));
        $rs = $dao->Query($sql);
        return $rs;
    }
    
    public function DeleteCodSeguranca() {
        $dao = new dao();
        $sql = sprintf($this->sqlDeleteCodSeguranca, $this->quotedstr($this->getUsu_codSeguranca()));
        return $dao->Dml($sql); 
    }
    
}
