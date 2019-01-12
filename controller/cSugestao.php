<?php

@session_start();

require_once "../action/aSugestao.php";
require_once "../interface/ifControle.php";
require_once '../phpmailer/PHPMailerAutoload.php';

class cSugestao extends aSugestao implements ifControle {
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

        if (isset($form["SUG_ID"])) {
            $this->setSug_id($form["SUG_ID"]);
        }
        
        if (isset($form["SUG_DESCRICAO"])) {
            $this->setSug_descricao($form["SUG_DESCRICAO"]);
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
        
        if($this->getSug_descricao() == '') {
            print "Informe a descrição";
            die;
        }
        
        $this->getUsuario()->setUsu_id($_SESSION['usu_id']);
        $this->setSug_ip($_SERVER['REMOTE_ADDR']);

        $from = $_SESSION['usu_email'];
        $fromName = $_SESSION['usu_nome'].' '.$_SESSION['usu_sobrenome'];
        $destinatario = "#####";  // (Email de destinatário)
        $descricao = $this->getSug_descricao();
        $ip = $this->getSug_ip();
            
        $subject = "Nova sugestao!";
        $body = "Nova sugestão!<br/><br/><br/>
        Foi enviada uma nova sugestão por $fromName, com a seguinte descricão:<br/>
        $descricao. IP acessado: $ip";        

        if($this->phpMailer($from, $fromName, $destinatario, $subject, $body)) {
            if($this->Insert()) {
                return true;
            } else {
                print "Ocorreu algum erro e não foi possível enviar uma nova sugestão! Entre em contato com o suporte!";
                die;
            }
        } else {
            print "Ocorreu algum erro e não foi possível enviar uma nova sugestão! Entre em contato com o suporte!";
            die;
        }
    }
    
    public function validarDadosComuns() {
        // ...
    }
}
