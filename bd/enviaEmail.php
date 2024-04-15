<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    function enviarEmail($para, $assunto, $mensagem) {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'projetopet87@gmail.com';                     
            $mail->Password   = 'ProjetoP3t2024';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                 
            
            //Recipients
            $mail->setFrom('projetopet87@gmail.com', 'Mailer');
            $mail->addAddress('projetopet87@gmail.com', 'OIE');  
            $mail->isHTML(true);                                 
            $mail->Subject = $assunto;

            $mail->Body = $mensagem;

            $mail->send();
            echo 'ENVIADO';
        } catch (Exception $e) {
            echo "NÃO ENVIADO. Mailer Error: {$mail->ErrorInfo}";
        }
    }


//require 'D:\Programas\xampp\htdocs\ProjetoPet\PHPMailer-master\src\Exception.php';
//require 'D:\Programas\xampp\htdocs\ProjetoPet\PHPMailer-master\src\PHPMailer.php';
//require 'D:\Programas\xampp\htdocs\ProjetoPet\PHPMailer-master\src\SMTP.php';    


    // $mail = new PHPMailer(true);
    // try {
    //     // Configurações do servidor SMTP
    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.live.com';  // Altere para o host SMTP do seu provedor de e-mail
    //     $mail->SMTPAuth = true;
    //     $mail->Username = 'carol.givigi@hotmail.com'; // Altere para o seu e-mail
    //     $mail->Password = 'P3pn1n@csg'; // Altere para a sua senha
    //     $mail->SMTPSecure = 'ssl'; // tls ou ssl, dependendo da configuração do seu servidor
    //     $mail->Port = 587; // Porta do SMTP

    //     // Remetente e destinatário
    //     $mail->setFrom('carol.givigi@hotmail.com', 'Carolina');
    //     $mail->addAddress($para);

    //     // Conteúdo do e-mail
    //     $mail->isHTML(true);
    //     $mail->Subject = $assunto;
    //     $mail->Body = $mensagem;

    //     // Envia e-mail
    //     $mail->send();
    //     return true; // E-mail enviado com sucesso
    // } catch (Exception $e) {
    //     return false; // Falha ao enviar o e-mail
    // }

            // Parâmetros para o e-mail
        // $para = $email;
        // $assunto = "Confirmação de Agendamento";
        // $mensagem = "Olá $nomeDono,<br><br>O seu agendamento foi confirmado com sucesso para o dia $data às $hora.<br><br>Atenciosamente,<br> Pet Shop da Carol.";




?>