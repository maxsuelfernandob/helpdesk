<?php

@session_start();
require_once '../db/dao.php';

class mUsuario extends dao {

    private $usu_id;
    private $usu_nome;
    private $usu_sobrenome;
    private $usu_login;
    private $usu_senha;
    private $usu_email;
    private $usu_setor;
    private $usu_ramal;
    private $usu_tipo;
    private $usu_ativo;
    
    private $usu_loginEmail;
    private $usu_codSeguranca;
    private $usu_novaSenha;
    private $usu_novaSenhaRep;
    
    function getUsu_id() {
        return $this->usu_id;
    }

    function getUsu_nome() {
        return $this->usu_nome;
    }

    function getUsu_sobrenome() {
        return $this->usu_sobrenome;
    }

    function getUsu_login() {
        return $this->usu_login;
    }

    function getUsu_senha() {
        return $this->usu_senha;
    }

    function getUsu_email() {
        return $this->usu_email;
    }

    function getUsu_setor() {
        return $this->usu_setor;
    }

    function getUsu_ramal() {
        return $this->usu_ramal;
    }

    function getUsu_tipo() {
        return $this->usu_tipo;
    }

    function getUsu_ativo() {
        return $this->usu_ativo;
    }

    function setUsu_id($usu_id) {
        $this->usu_id = $usu_id;
    }

    function setUsu_nome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    function setUsu_sobrenome($usu_sobrenome) {
        $this->usu_sobrenome = $usu_sobrenome;
    }

    function setUsu_login($usu_login) {
        $this->usu_login = $usu_login;
    }

    function setUsu_senha($usu_senha) {
        $this->usu_senha = $usu_senha;
    }

    function setUsu_email($usu_email) {
        $this->usu_email = $usu_email;
    }

    function setUsu_setor($usu_setor) {
        $this->usu_setor = $usu_setor;
    }

    function setUsu_ramal($usu_ramal) {
        $this->usu_ramal = $usu_ramal;
    }

    function setUsu_tipo($usu_tipo) {
        $this->usu_tipo = $usu_tipo;
    }

    function setUsu_ativo($usu_ativo) {
        $this->usu_ativo = $usu_ativo;
    }
    
    function getUsu_loginEmail() {
        return $this->usu_loginEmail;
    }

    function setUsu_loginEmail($usu_loginEmail) {
        $this->usu_loginEmail = $usu_loginEmail;
    }
    
    function getUsu_novaSenha() {
        return $this->usu_novaSenha;
    }

    function setUsu_novaSenha($usu_novaSenha) {
        $this->usu_novaSenha = $usu_novaSenha;
    }
    
    function getUsu_codSeguranca() {
        return $this->usu_codSeguranca;
    }

    function setUsu_codSeguranca($usu_codSeguranca) {
        $this->usu_codSeguranca = $usu_codSeguranca;
    }
    
    function getUsu_novaSenhaRep() {
        return $this->usu_novaSenhaRep;
    }

    function setUsu_novaSenhaRep($usu_novaSenhaRep) {
        $this->usu_novaSenhaRep = $usu_novaSenhaRep;
    }

}

