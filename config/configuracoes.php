<?php

@session_start();

class configuracoes {

    private $dao;

    public function getDao() {
        return $this->dao;
    }

    public function setDao($dao) {
        $this->dao = $dao;
    }
    
    public function getDataDoSistema() {
        return date("d/m/Y");
    }

    public function quotedstr($texto) {
        if (trim($texto) == '') {
            $texto = 'null';
        } else {
            $texto = "'" . $texto . "'";
        }
        return $texto;
    }

    public function phpMailer($from, $fromName, $destinatario, $subject, $body) {
            $mail = new PHPMailer();

            $mail->IsSMTP(); // Define que a mensagem será SMTP
//            $mail->Host = "ssl://smtp.gmail.com:465";  // Specify main and backup server
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;            // Enable SMTP authentication
            $mail->Username = '####';        // SMTP username  (Email)
            $mail->Password = '#####';    // SMTP password   (Senha do email)
            $mail->SMTPSecure = 'tls';      // tls or ssl connection as req

            $mail->From = $from; // Seu e-mail
            $mail->FromName = $fromName; // Seu nome
//            $mail->SMTPDebug = 3;
            // Define o(s) destinatário(s)  
            $mail->AddAddress("$destinatario");

            // Define os dados técnicos da Mensagem
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML

            // Define a mensagem (Texto e Assunto)
            $mail->Subject  = $subject;
            $mail->Body = $body;

            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();

            // Limpa os destinatários e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
            
            if (!$enviado) {
                print "Não foi possível enviar o e-mail! Entre em contato com o suporte!<br/><br/>";
                print "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
            } else {
                return true;
            }

    }
    
    public function getHashMD5($string) {
        return md5($string);
    }

}
