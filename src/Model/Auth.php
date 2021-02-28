<?php

namespace MyApp\Model;

require_once 'Model.php';

class Auth extends Model {
    // Get password and try    
    public function getPassword($username){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE (username = :username OR email = :email) AND confirmed_at IS NOT NULL';
        $req = $this->executeRequest($sql, array('username' => $username, 'email' => $username));
        return $req->fetch();
    }
    
    // Get id by username
    public function usernameIsUniqAuth($username){
        $sql = 'SELECT id ' . ' FROM esmater_users' . ' WHERE username = :username';
        $user = $this->executeRequest($sql, array('username' => $username));
        return $user->fetch();
    }
    
    // Get id by email
    public function emailIsUniqAuth($email){
        $sql = 'SELECT id ' . ' FROM esmater_users' . ' WHERE email = :email';
        $user = $this->executeRequest($sql, array('email' => $email));
        return $user->fetch();
    }
     
    // Register the user with the Username Email Mdp And add a Token, send a verify email
    public function registerAuth($username, $email, $password, $token){
        $sql = 'insert into esmater_users(username, email, password, confirmation_token, avatar)' . ' values(:username, :email, :password, :confirmation_token, :avatar)';
        $this->executeRequest($sql, array('username' => $username, 'email' => $email, 'password' => $password, 'confirmation_token' => $token, 'avatar' => "default.jpg"));
        $sql = 'SELECT MAX(id) as id' . ' FROM esmater_users' ;
        $user= $this->executeRequest($sql);
        $lastFetch = $user->fetch();
        $user_id = $lastFetch['id'];
        mail($email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/projets/freshClone/EsMater/index.php?action=confirm&id=$user_id&token=$token");
    }
    
    // If the link by email been used, get the user in parameter
    public function confirmationTokenAt($user_id, $token){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE id = :id';
        $req = $this->executeRequest($sql, array('id' => $user_id));
        $user = $req->fetch();
        if($user && $user['confirmation_token'] == $token){
            return $user;
        } else{
            return $user = false;
        }
    }        
        
    // Valide the account by adding a date and destroying the token
    public function deleteTokenAt($user_id){
        $sql = 'UPDATE esmater_users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id= :id';
        $this->executeRequest($sql, array('id' => $user_id));
    }
    
    // Add a remember token to the account
    public function rememberTokenAuth($token, $user_id){
        $sql = 'UPDATE esmater_users SET remember_token = ?' . 'WHERE id = ?';
        $this->executeRequest($sql, array($token, $user_id));
    }
    
    // Get the user for login it
    public function loginUserAuth($username, $password){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE (username = :username OR email = :email) AND confirmed_at IS NOT NULL';
        $user = $this->executeRequest($sql, array('username' => $username, 'email' => $username));
        return $user->fetch();
    }
    
    // Modify the mdp
    public function updatePasswordAuth($user_id, $password){
        $sql = 'UPDATE esmater_users SET password = :password ' . ' WHERE id = :id';
        $this->executeRequest($sql, array('password' => $password, 'id' => $user_id));  
    }
    
    // Get user by email then send a email
    public function sendEmailRemember($email){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE email = :email AND confirmed_at IS NOT NULL';
        $user = $this->executeRequest($sql, array('email' => $email));
        $findUser = $user->fetch();
        if($findUser){
            return $findUser;
        }else {
            return $findUser = false;
        }
    } 
    
    // Add the resetToken and add date of it
    public function resetToken($reset_token, $user_id){
        $sql = 'UPDATE esmater_users SET reset_token = :reset_token, reset_at = NOW() WHERE id = :id';
        $this->executeRequest($sql, array('reset_token' => $reset_token, 'id' => $user_id));
    }
    
    // Get the token if the token is at the actual date with 30 mins of marge return true else false
    public function verifyTokenAuth($user_id, $token){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE id = :id AND reset_token  = :reset_token AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)';
        $req = $this->executeRequest($sql, array('id' => $user_id, 'reset_token' => $token));
        $user = $req->fetch();
        if($user){
            return $user;
        } else {
            return $user = false;
        }
    }
    
    public function resePasswordAuth($user_id, $passwordHash){
        $sql = 'UPDATE esmater_users SET password = :password, reset_at = NULL, reset_token = NULL' . ' WHERE id = :id';
        $this->executeRequest($sql, array('password' => $passwordHash, 'id' => $user_id));  
    }
    
    public function getAuth($user_id){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE id = :id';
        $req = $this->executeRequest($sql, array('id' => $user_id));
        return $req->fetch();
    }
    
    public function getAuthByRememberToken($user_id){
        $sql = 'SELECT * ' . ' FROM esmater_users' . ' WHERE id = :id';
        $req = $this->executeRequest($sql, array('id' => $user_id));
        $user = $req->fetch();
        if($user){
            return $user;
        } else {
            return $user = false;
        }
    }
    
    public function updateAvatar($authId, $img){
        $sql = 'UPDATE esmater_users SET avatar = ?' . ' WHERE id = ?';
        $user = $this->executeRequest($sql, array($img, $authId));
        return $user;
    }
    
}