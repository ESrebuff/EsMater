<?php
require_once 'Model/Model.php';

class Auth extends Model {
        
    // Get id by username
    public function usernameIsUniqAuth($username){
        $sql = 'SELECT id ' . ' FROM users' . ' WHERE username=?';
        $user = $this->executeRequest($sql, array($username));
        return $user->fetch();
    }
    
    // Get id by email
    public function emailIsUniqAuth($email){
        $sql = 'SELECT id ' . ' FROM users' . ' WHERE email=?';
        $user = $this->executeRequest($sql, array($email));
        return $user->fetch();
    }
     
    // Register the user with the Username Email Mdp And add a Token, send a verify email
    public function registerAuth($username, $email, $password, $token){
        $sql = 'insert into users(username, email, password, confirmation_token, avatar)' . ' values(?, ?, ?, ?, ?)';
        $this->executeRequest($sql, array($username, $email, $password, $token, "default.jpg"));
        $sql = 'SELECT MAX(id) as id' . ' FROM users' ;
        $user= $this->executeRequest($sql);
        $lastFetch = $user->fetch();
        $user_id = $lastFetch['id'];
        mail($email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/projets/MVC/addClientSpace/sitePersoFinDeFormation/index.php?action=confirm&id=$user_id&token=$token");
    } 
    
    // If the link by email been used, get the user in parameter
    public function confirmationTokenAt($user_id, $token){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE id=?';
        $req = $this->executeRequest($sql, array($user_id));
        $user = $req->fetch();
        if($user && $user['confirmation_token'] == $token){
            return $user;
        } else{
            return $user = false;
        }
    }        
        
    // Valide the account by adding a date and destroying the token
    public function deleteTokenAt($user_id){
        $sql = 'UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id=?';
        $this->executeRequest($sql, array($user_id));
    }
    
    // Add a remember token to the account
    public function rememberTokenAuth($token, $user_id){
        $sql = 'UPDATE users SET remember_token = ?' . 'WHERE id = ?';
        $this->executeRequest($sql, array($token, $user_id));
    }
    
    // Get the user for login it
    public function loginUserAuth($username, $password){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE (username = ? OR email = ?) AND confirmed_at IS NOT NULL';
        $user = $this->executeRequest($sql, array($username, $username));
        $findUser = $user->fetch();
        if($findUser){
            if(password_verify($_POST['password'], $findUser['password'])){
                return $findUser;
            } else{
                return $findUser = false;
            }
        }return $findUser = false;
    }
    
    // Modify the mdp
    public function updatePasswordAuth($user_id, $password){
        $sql = 'UPDATE users SET password = ? ' . ' WHERE id = ?';
        $this->executeRequest($sql, array($password, $user_id));  
    }
    
    // Get the user by the username or email
    public function sendTokenRemember($username, $password){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE (username = ? OR email = ?) AND confirmed_at IS NOT NULL';
        $user = $this->executeRequest($sql, array($username, $username));
        $findUser = $user->fetch();
        if($findUser){
            if(password_verify($_POST['password'], $findUser['password'])){
                return $findUser;
            } else{
                return $findUser = false;
            }
        }return $findUser = false;
    }
    
    // Get user by email then send a email
    public function sendEmailRemember($email){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE email = ? AND confirmed_at IS NOT NULL';
        $user = $this->executeRequest($sql, array($email));
        $findUser = $user->fetch();
        if($findUser){
            return $findUser;
        }else {
            return $findUser = false;
        }
    } 
    
    // Add the reseToken and add date of it
    public function resetToken($reset_token, $user_id){
        $sql = 'UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id=?';
        $this->executeRequest($sql, array($reset_token, $user_id));
    }
    
    // Get the token if the token is at the actual date with 30 mins of marge return true else false
    public function verifyTokenAuth($user_id, $token){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE id = ? AND reset_token  = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)';
        $req = $this->executeRequest($sql, array($user_id, $token));
        $user = $req->fetch();
        if($user){
            return $user;
        } else {
            return $user = false;
        }
    }
    
    
    public function resePasswordAuth($user_id, $passwordHash){
        $sql = 'UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL' . ' WHERE id = ?';
        $this->executeRequest($sql, array($passwordHash, $user_id));  
    }
    
    public function getAuth($user_id){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE id = ?';
        $req = $this->executeRequest($sql, array($user_id));
        return $req->fetch();
    }
    
    public function getUserByName($usernale){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE username = ?';
        $req = $this->executeRequest($sql, array($usernale));
        return $req->fetch();
    }
    
    public function getAuthByRememberToken($user_id){
        $sql = 'SELECT * ' . ' FROM users' . ' WHERE id = ?';
        $req = $this->executeRequest($sql, array($user_id));
        $user = $req->fetch();
        if($user){
            return $user;
        } else {
            return $user = false;
        }
    }
    
    public function updateAvatar($authId, $img){
        $sql = 'UPDATE users SET avatar = ?' . ' WHERE id = ?';
        $user = $this->executeRequest($sql, array($img, $authId));
        return $user;
    }
    
}