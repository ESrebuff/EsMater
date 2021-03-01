<?php

private $mail;

$this->mail = new \MyApp\Tools\FunctionMail();

$key = "jedoismettrelareponsedelappeldelabasededonnee";
$subject = "activation de votre compte";
$message = "Liens d'activation de votre compte, <a href='#'>http//www/activation.php$key Cliquer ici</a>";
$sender = "estebanianis@gmail.com";

        $this->mail->sendmail($subject, $message, $sender);
        $this->mail->getmail($subject, $message, $sender);