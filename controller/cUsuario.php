<?php

@session_start();

require_once "../action/aUsuario.php";
require_once "../action/aLogAcesso.php";
require_once "../interface/ifControle.php";
require_once '../phpmailer/PHPMailerAutoload.php';

class cUsuario extends aUsuario implements ifControle {

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
    
    private function verificarRepeticao($tabela, $sql) {
        return $this->ContaLinhas($tabela, $sql);
    }

    public function recebeDadosForm() {
        
        $form = $this->getForm();

        if (isset($form["USU_ID"])) {
            $this->setUsu_id($form["USU_ID"]);
        }
        
        if (isset($form["USU_NOME"])) {
            $this->setUsu_nome($form["USU_NOME"]);
        }
        
        if (isset($form["USU_SOBRENOME"])) {
            $this->setUsu_sobrenome($form["USU_SOBRENOME"]);
        }
        
        if (isset($form["USU_LOGIN"])) { 
            $this->setUsu_login($form["USU_LOGIN"]);
        }
        
        if (isset($form["USU_SENHA"])) {
            $this->setUsu_senha($form["USU_SENHA"]);
        }
        
        if (isset($form["USU_EMAIL"])) {
            $this->setUsu_email($form["USU_EMAIL"]);
        }
        
        if (isset($form["USU_SETOR"])) {
            $this->setUsu_setor($form["USU_SETOR"]);
        }

        if (isset($form["USU_RAMAL"])) {
            $this->setUsu_ramal($form["USU_RAMAL"]);
        }
        
        if (isset($form["USU_TIPO"])) {
            $this->setUsu_tipo($form["USU_TIPO"]);
        }
        
        if (isset($form["USU_ATIVO"])) {
            $this->setUsu_ativo($form["USU_ATIVO"]);
        }
        
        if (isset($form["USU_LOGIN_EMAIL"])) {
            $this->setUsu_loginEmail($form["USU_LOGIN_EMAIL"]);
        }
        
        if (isset($form["USU_COD_SEG"])) {
            $this->setUsu_codSeguranca($form["USU_COD_SEG"]);
        }
        
        if (isset($form["USU_NOVA_SENHA"])) {
            $this->setUsu_novaSenha($form["USU_NOVA_SENHA"]);
        }
        
        if (isset($form["USU_NOVA_SENHA_REP"])) {
            $this->setUsu_novaSenhaRep($form["USU_NOVA_SENHA_REP"]);
        }        

        $this->setAcao(@$form["acao"]);

        return $this->defineAcaoAFazer();
    }
    
    private function defineAcaoAFazer() {
        if($this->getAcao() == 'inserirUsuario') {
            return $this->validarInsert();
        }
        if($this->getAcao() == 'efetuarLogin') {
            return $this->validarLogin();
        }
        if($this->getAcao() == 'recuperarSenha') {
            return $this->validarRecuperarSenha();
        }
        if($this->getAcao() == 'alterarSenha') {
            return $this->alterarSenha();
        }
    }
    
    public function validarLogin() {
        $this->validarDadosComuns();
        $rsLogin = $this->SelectLogin(false);
        //LOG DE ACESSO DO USUARIO
        if (sizeof($rsLogin) > 0) {
            $logAcesso = new aLogAcesso;
            $logAcesso->setLac_usu_id($rsLogin[0]["usu_id"]);
            $logAcesso->setLac_ip($_SERVER['REMOTE_ADDR']);
            if ($rsLogin[0]["case"] == "LOGIN_SUCESSO") {
                $logAcesso->Insert();
                
                $this->setUsu_id($rsLogin[0]['usu_id']);
                $this->setUsu_nome($rsLogin[0]['usu_nome']);
                $this->setUsu_sobrenome($rsLogin[0]['usu_sobrenome']);
                $this->setUsu_tipo($rsLogin[0]['usu_tipo']);
            }
        }
        return $rsLogin;
    }

    private function validarInsert() {
        if($this->getUsu_nome() == ''){
            print "Informe o nome!";
            die;
        }
        
        if($this->getUsu_sobrenome() == ''){
            print "Informe o sobrenome!";
            die;
        }
        
        $this->validarDadosComuns();
        
        if(!preg_match('/[A-Za-z]$/', $this->getUsu_nome())) {
            print "Nome deve conter apenas letras";
            die;
        }
        
        if(!preg_match('/[A-Za-z]$/', $this->getUsu_sobrenome())) {
            print "Sobrenome deve conter apenas letras";
            die;
        }        
        
        if(strlen($this->getUsu_login()) < 5) {
            print "Login deve conter pelo menos 5 caracteres";
            die;
        }
        
        if(strlen($this->getUsu_senha()) < 5) {
            print "Senha deve conter pelo menos 5 caracteres";
            die;
        }
        
        if($this->getUsu_email() == ''){
            print "Informe o email!";
            die;
        }
        
        if(!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/', $this->getUsu_email())) {
            print "Email inválido. Insira um email válido!";
            die;
        }
        
        if($this->getUsu_setor() == ''){
            print "Informe o setor!";
            die;
        }
        
        if(!preg_match('/[A-Za-z]$/', $this->getUsu_setor())) {
            print "Setor deve conter apenas letras";
            die;
        }
        
        if($this->getUsu_ramal()!='') {
            if(!preg_match('/^[0-9]+$/', $this->getUsu_ramal())) {
                print "Ramal deve conter apenas numeros";
                die;
            }           
        }
        
//      VERIFICAR SE O USUARIO JA EXISTE        
        if($this->verificarRepeticao("usuario", "and usu_login='" . $this->getUsu_login() . "'") > 0) {
            print "O login informado já existe no sistema!";
            die;
        }
        
        if($this->getUsu_tipo() == 'A') {
            $this->setUsu_tipo('A');
        } else {
            $this->setUsu_tipo('U');
        }

        $this->setUsu_ativo('S');
        
        if($this->Insert()) {
            $this->setForm(array("acao" => "inserir"));
//            print "Sucesso! Os dados foram armazenados com sucesso.";
            die;
        } else {
            //return $this->setaMensagem("Erro', 'Algum erro aconteceu e o registro não foi atualizado!');
            die;
        }
    }
    
    private function validarRecuperarSenha() {
        if($this->getUsu_loginEmail() == '') {
            print "Informe seu login ou email!";
            die;
        }
        
        if($dadosUsuario = $this->SelectVerificaLoginEmail()) {
            if($dadosUsuario[0]["usu_ativo"] == 'N') {
                print "O usuario informado está inativo! Entre em contato com o suporte!";
                die;
            }
            
            $usu_nome = $dadosUsuario[0]['usu_nome'];
            $usu_sobrenome = $dadosUsuario[0]['usu_sobrenome'];
            $from = "####";    // Email
            $fromName = "Suporte HelpDesk- T.I";
            $destinatario = $dadosUsuario[0]['usu_email'];
            $codigoSeguranca = substr(md5(time()), 0, 6);
            $subject = "Alteracao de senha!";
            $body = "Alteração de senha!<br/><br/><br/>
            Olá $usu_nome $usu_sobrenome, seu codigo de segurança para alterar sua senha é $codigoSeguranca.
            <a href='192.168.0.103/helpdesk/alteraSenha.php'> Clique aqui para alterar sua senha!</a>";
            
            if($this->phpMailer($from, $fromName, $destinatario, $subject, $body)) {
                $this->setUsu_codSeguranca($codigoSeguranca);
                $this->setUsu_id($dadosUsuario[0]['usu_id']);
                $this->InsertCodSeguranca();
            }
        } else {
            print "login ou email inválido!";
            die;
        }
    }
    
    public function alterarSenha() {
        if($this->getUsu_codSeguranca() == '') {
            print "Informe o codigo de seguranca recebido por email!";
            die;
        }
        
        if($this->getUsu_loginEmail() == '') {
            print "Informe seu login ou email!";
            die;
        }
        
        if($this->getUsu_novaSenha() == '') {
            print "Informe a nova senha";
            die;
        }
        
        if(strlen($this->getUsu_novaSenha()) < 5) {
            print "Nova senha deve conter pelo menos 5 caracteres";
            die;
        }
        
        if($this->getUsu_novaSenhaRep() == '') {
            print "Informe a nova senha novamente";
            die;
        }
        
        if($this->getUsu_novaSenhaRep() != $this->getUsu_novaSenha()) {
            print "A senha informada novamente, não corresponde com a nova senha informada";
            die;
        }
        
        if($dadosUsuario = $this->SelectVerificaLoginEmail()) {
            $this->setUsu_id($dadosUsuario[0]['usu_id']);
            
            if($dadosCodSeguranca = $this->SelectVerificaCodSeguranca()) {
                if($this->UpdateNovaSenha()) {
                    $this->DeleteCodSeguranca();
                } else {
                    print "Ocorreu algum erro e a senha não foi alterada! Entre em contato com o suporte!";
                    die;
                }
            } else {
                print "O código de segurança é inválido para o usuário informado!";
                die;
            }       
        }else {
            print "O login ou email informado, não existe no sistema!";
            die;
        }
    }
    
    public function validarDadosComuns() {
        if($this->getUsu_login() == ''){
            print "Informe o login!";
            die;
        }
        if($this->getUsu_senha() == ''){
            print "Informe a senha!";
            die;
        } 
    }
}
