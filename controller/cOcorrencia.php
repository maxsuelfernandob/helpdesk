<?php

@session_start();

require_once "../action/aOcorrencia.php";
require_once "../interface/ifControle.php";
require_once '../phpmailer/PHPMailerAutoload.php';

class cOcorrencia extends aOcorrencia implements ifControle {
    private $acao, $form;

    public function getForm() {
        return $this->form;
    }

    public function setForm($form) {
        $this->form = $form;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function setAcao($acao) {
        $this->acao = $acao;
    }

    public function recebeDadosForm() {
        
        $form = $this->getForm();

        if (isset($form["OCO_ID"])) {
            $this->setOco_id($form["OCO_ID"]);
        }
        
        if (isset($form["OCO_RELACIONADO"])) {
            $this->setOco_relacionado($form["OCO_RELACIONADO"]);
        }
        
        if (isset($form["OCO_DESCRICAO"])) {
            $this->setOco_descricao($form["OCO_DESCRICAO"]);
        }

        $this->setAcao(@$form["acao"]);

        return $this->defineAcaoAFazer();
    }
    
    private function defineAcaoAFazer() {
        if($this->getAcao() == 'inserir') {
            return $this->validarInsert();
        }
    }
    
    private function validarInsert() {
        if($this->getOco_relacionado() == '') {
            print "Informe o assunto";
            die;
        }
        
        if($this->getOco_descricao() == '') {
            print "Informe a descrição";
            die;
        }
        
        $this->getUsuario()->setUsu_id($_SESSION['usu_id']);
        $this->setOco_ip($_SERVER['REMOTE_ADDR']);
        $this->setOco_status('Aberto');
        
//        print_r($_SESSION);die;
        $from = $_SESSION['usu_email'];
        $fromName = $_SESSION['usu_nome'].' '.$_SESSION['usu_sobrenome'];
        $destinatario = "loremipsum@gmail.com";
        $assunto = $this->getOco_relacionado();
        $descricao = $this->getOco_descricao();
        $ip = $this->getOco_ip();
            
        $subject = "Nova ocorrencia solicitada!";
        $body = "Nova ocorrência!<br/><br/><br/>
        Foi aberta uma nova ocorrência por $fromName, relacionado a $assunto, com a seguinte descricão:<br/>
        $descricao. IP acessado: $ip";        
        
        if($this->phpMailer($from, $fromName, $destinatario, $subject, $body)) { 
            if($this->Insert()) {
                return true;
            } else {
                print "Ocorreu algum erro e não foi possível inserir uma nova ocorrência! Entre em contato com o suporte!";
                die;
            }
        } else {
            print "Ocorreu algum erro e não foi possível inserir uma nova ocorrência! Entre em contato com o suporte!";
            die;
        }
    }
    
    public function validarDadosComuns() {
        // ...
    }
}