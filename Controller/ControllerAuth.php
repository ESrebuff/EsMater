<?php

require_once 'Model/Auth.php';
require_once 'View/View.php';

class ControllerAuth {

    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }
    
    public function random($length) {
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr( str_shuffle( str_repeat( $alphabet, $length ) ), 0, $length );
    }
    
    // Hash le mot de passe
    public function hashPassword($password){
        return password_hash($_POST['password'], PASSWORD_BCRYPT);
    }
    
    public function usernameIsUniq($username){
        if($this->auth->usernameIsUniqAuth($username)){
            $users = $this->auth->usernameIsUniqAuth($username);
            return $users;
        }
    }
    
    public function emailIsUniq($email){
        if($this->auth->emailIsUniqAuth($email)){
            $users = $this->auth->emailIsUniqAuth($email);
            return $users;
        }
    }
    
    // Enregistre l'utilisateur, Hash le mot de passe, crée un token de 60 caractère envoie l'email
    public function register($username, $email, $password){
        $password = $this->hashPassword($password);
        $token = $this->random(60);
        $this->auth->registerAuth($username, $email, $password, $token);
        session_start();
        $_SESSION["flash"]["success"] = "Un email de confirmation vous a été envoyé pour valider votre compte";
        header('Location: index.php?action=linkView&swicthTo=Login');
    }
    
    public function errors($errors){
        $view = new View("Register");
        $view->generate(array('errors' => $errors));
    }
    
    public function confirmationToken($user_id, $token){
        $user = $this->auth->confirmationTokenAt($user_id, $token);
         session_start();
        if(!$user){
            $_SESSION["flash"]["danger"] = "Ce lien n'est plus valide";
            $view = new view("Login");
            $view->generate(array());
        }else {
            $_SESSION["flash"]["success"] = "Votre compte à bien été validé";
            $_SESSION["auth"] = $user;
            $this->auth->deleteTokenAt($user_id);
            header('Location: index.php?action=linkView&swicthTo=Account');
        }
    }
    
    public function loginUser($username, $password, $remember){
        $user = $this->auth->loginUserAuth($username, $password);
        if(!$user){
            session_start();
            $_SESSION["flash"]["danger"] = "Identifiant ou mot de passe incorrecte";
            $view = new view("Login");
            $view->generate(array());
        }else {
            if($remember){
                session_start();
                $_SESSION["flash"]["success"] = "Vous êtes maintenant connecté";
                $_SESSION["auth"] = $user;
                $token = $this->random(250);
                $user_id = $user['id'];
                $this->auth->rememberTokenAuth($token, $user_id);
                setcookie('remember', $user_id . '==' . $token . sha1($user_id . "ravioli"), time() + 60 * 60 * 24 * 7);
                header('Location: index.php?action=linkView&swicthTo=Account');
            } else {
                session_start();
                $_SESSION["flash"]["success"] = "Vous êtes maintenant connecté";
                $_SESSION["auth"] = $user;
                header('Location: index.php?action=linkView&swicthTo=Account');
                }
        }
    }

    public function updatePassword($user_id, $password){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $user = $this->auth->updatePasswordAuth($user_id, $passwordHash);
        session_start();
        $_SESSION["flash"]["success"] = "Votre mot de passe a bien été mis à jours";
        header('Location: index.php?action=linkView&swicthTo=Account');
    }
    
    public function newPassword($email){
        $user = $this->auth->sendEmailRemember($email);
        if(!$user){
            session_start();
            $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cette adresse";
            header('Location: index.php?action=linkView&swicthTo=Forget');
        }else {
            session_start();
            $reset_token = $this->random(60);
            $this->auth->resetToken($reset_token, $user['id']);
            $_SESSION['flash']['success'] = "Un email pour réinitialiser votre mot de passe à bien été envoyé";
            mail($email, 'Réinitialisation de votre mot de passe', "Afin de réinitialisation votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost/projets/MVC/addClientSpace/sitePersoFinDeFormation/index.php?action=forgetPasswordAuth&id={$user['id']}&token=$reset_token");
            header('Location: index.php?action=linkView&swicthTo=Login');
            exit();
        }
    }

    public function verifyTokenAuth($user_id, $token){
        $user = $this->auth->verifyTokenAuth($user_id, $token);
        if(!$user){
            session_start();
            $_SESSION['flash']['danger'] = "Ce lien n'est pas valide";
            header('Location: index.php?action=linkView&swicthTo=Login');
        } else {
            session_start();
            $view = new View("Reset");
            $view->generate(array('user' => $user));
        }
    }
        
    public function resetPassword($user_id, $password){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $this->auth->resePasswordAuth($user_id, $passwordHash);
        $user = $this->auth->getAuth($user_id);
        session_start();
        $_SESSION["flash"]["success"] = "Votre mot de passe a bien été modifier";
        $_SESSION["auth"] = $user;
        header('Location: index.php?action=linkView&swicthTo=Account');
        exit();
    }
    
    public function loginByRememberToken($remember_token){
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $user = $this->auth->getAuthByRememberToken($user_id);
        if($user){
           $expected  = $user_id . '==' . $user['remember_token'] . sha1($user_id . "ravioli");
            if($expected == $remember_token){
                session_start();
                $_SESSION["auth"] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
            } else {
                setcookie('remember', NULL, -1);
            }
        } else {
            setcookie('remember', NULL, -1);
        }
            
    }
    
}