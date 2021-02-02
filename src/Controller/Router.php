<?php

namespace MyApp\Controller;
use Exception;

class Router {
    
  private $ctrlPost;
  private $ctrlAuth;
  private $tools;

  public function __construct() {
    $this->ctrlPost = new \MyApp\Controller\ControllerPost();
    $this->ctrlAuth = new \MyApp\Controller\ControllerAuth();
    $this->tools = new \MyApp\Tools\Tools();
      
  }
// Redirection to a account page
    public function redirection(){
        $this->tools->sessionOn();
        if(isset($_SESSION['auth'])){
            $userId = $_SESSION['auth']['id'];
            $this->tools->redirectionAccount($userId);
        }
    }
    
  // Processes an incoming request
  public function routerRequest() {
    try {
        
        if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
            $remember_token = $_COOKIE['remember'];
            $this->ctrlAuth->loginByRememberToken($remember_token);        
        }
        
        if(isset($_GET['action'])) {
            
            // Get the post
            if ($_GET['action'] == 'post') {
                $idPost = intval($this->getParameter($_GET, 'id'));
                if ($idPost != 0) {
                    $this->ctrlPost->post($idPost);
                }
                else
                    throw new Exception("Identifiant de billet non valide");
            }
            
            // Comment a post
            else if ($_GET['action'] == 'comment') {
                $this->tools->sessionOn();
                $auth = $_SESSION["auth"];
                $author = $this->getParameter($auth, 'username');
                $content = htmlspecialchars($_POST['content']);
                $user_id = $this->getParameter($auth, 'id');
                $user_avatar = $this->getParameter($auth, 'avatar');
                $idPost = htmlspecialchars($_POST['id']);
                $this->ctrlPost->comment($author, $content, $idPost, $user_id, $user_avatar);    
            }
            
            // Add a post
            else if ($_GET['action'] == 'addPost'){
                $this->tools->sessionOn();
                if(!empty($_FILES)){
                    $auth = $_SESSION["auth"];
                    $img = $_FILES['img'];
                    $title = htmlspecialchars($_POST['title']);
                    $author = $_SESSION["auth"]['username'];
                    $content = $_POST['content'];
                    $user_id = $_SESSION["auth"]['id'];
                    $user_avatar = $_SESSION["auth"]['avatar'];
                    if($title && $content) {
                        $this->ctrlPost->addPost($img, $title, $author, $content, $user_id, $user_avatar);
                    } else {
                        $_SESSION['flash']['danger'] = "Il manque une information";
                        $this->redirection();
                }
                }else {
                    $_SESSION['flash']['danger'] = "Vous devez insérer une image";
                        $this->redirection();
                }
            }
            
            // index.php?action=page&number=X
            else if ($_GET['action'] == 'page') {
                //swicth to the "page" i get
                $_GET['number'] = intval($_GET['number']);
                if($_GET['number'] > 0){
                    $currentNumber = $_GET['number'];
                    $this->ctrlPost->page($currentNumber);
                } else {
                    header('Location: index.php?action=page&number=1');
                }
            }
            
            // Create a account
            else if ($_GET['action'] == 'register') {
                if(!empty($_POST)){
                    $errors = array();
                    $username = htmlspecialchars($_POST['username']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    if(empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username) || strlen($username) < 6){
                        $errors['username'] = "Votre pseudo n'est pas valide";
                    } else {
                        if($this->ctrlAuth->usernameIsUniq($username)){
                            $errors['username'] = "Ce pseudo est déjà utilisé";
                        }
                    }
                    
                    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errors['email'] = "Votre email n'est pas valide";
                    } 
                    else if($this->ctrlAuth->emailIsUniq($email)){
                        $errors['email'] = "Cet email est déjà utilisé";
                    }
        
                    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']  || strlen($password) < 8){
                        $errors['password'] = "Vous devez rentrer un mot de passe valide";
                    }
                    if(empty($errors)){
                        $this->ctrlAuth->register($username, $email, $password);
                    } else {
                        $this->ctrlAuth->errors($errors);
                    }    
                } 
            } 
            
            // Confirm account
            else if ($_GET['action'] == 'confirm'){
                $this->ctrlAuth->confirmationToken($_GET['id'], $_GET['token']);
            }
            
            // Show the account page
            else if ($_GET['action'] == 'toAccount') {
                $this->tools->logged_auth_only();
                $this->redirection();
            }
            
            // Redirection to the page in parameter
            else if ($_GET['action'] == 'linkView') {
                $page = $_GET['swicthTo'];
                $view = new \MyApp\View\View($page);
                $view->generate(array());
            }
            
            // Disconnect yourself
            else if ($_GET['action'] == 'logout'){
                $this->tools->sessionOn();
                setcookie('remember', NULL, -1);
                unset($_SESSION['auth']);
                $this->tools->flashMessage("success", "Vous êtes maintenant déconnecté", "Login");
            }
            
            // Connecxion and show the account page
            else if ($_GET['action'] == 'login') {
                if(isset($_SESSION['auth'])){
                    $this->redirection();
                }       
                if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);
                    if(!empty($_POST['remember'])){
                        $remember = true;
                        $this->ctrlAuth->loginUser($username, $password, $remember);
                    } else {
                        $remember = false;
                        $this->ctrlAuth->loginUser($username, $password, $remember);
                    }
                }
            } 
            
            // Update the password
            else if ($_GET['action'] == 'updatePassword') {
                if(!empty($_POST)){
                    $password = htmlspecialchars($_POST['password']);
                    $password_confirm = htmlspecialchars($_POST['password_confirm']);
                    $this->tools->sessionOn();
                    if(empty($password) || $password != $password_confirm || strlen($password) < 8){
                        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
                        $this->redirection();
                    }else {
                        $this->ctrlAuth->updatePassword($_SESSION["auth"]['id'], $password);
                    }
                }
            }
            
            // New password in case of forgotten password from a link send by email
            else if ($_GET['action'] == 'forgot'){
                if(!empty($_POST) && !empty($_POST['email'])){
                    $email = htmlspecialchars($_POST['email']);
                    $this->ctrlAuth->newPassword($email);
                }
            }
            
            // When you click on the email, verify the id and the token, show the reset page
            else if ($_GET['action'] == 'forgetPasswordAuth'){
                if(isset($_GET['id']) && isset($_GET['token'])){
                    $this->ctrlAuth->verifyTokenAuth($_GET['id'], $_GET['token']);
                } else{
                    header('location: index.php?action=linkView&swicthTo=Login');
                }
            }
            
                        // Reset the password in case of forgotten
            else if ($_GET['action'] == 'reset') {
                if(!empty($_POST)){
                    if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                        if(strlen($_POST['password']) < 8){
                            $password = htmlspecialchars($_POST['password']);
                            $this->ctrlAuth->resetPassword($_GET['id'], $password);
                        } else {
                            session_start();
                            $this->tools->flashMessage("danger", "Vous devez rentrer un mot de passe valides", "AddPost");
                        }
                    }else {
                        throw new Exception("Une information est manquante");
                    }
                }
            }
            
            // Add a avatar img
            else if ($_GET['action'] == 'avatar'){
                $this->tools->sessionOn();
                if(isset($_SESSION["auth"])){
                    $user = $_SESSION['auth'];
                    if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
                        $this->ctrlAuth->addAvatar($_FILES['avatar'], $_GET['id'], $user['id']);
                    }else {
                        $_SESSION['flash']['danger'] = "Vous devez sélectionner une image";
                        $this->redirection();
                    }
                }
            }
            
            // Delete comment
            else if ($_GET['action'] == 'deleteComment'){
                $this->tools->sessionOn();
                $idComment = $_GET['idComment'];
                $idPost = $_GET['id'];
                if(isset($_SESSION["auth"])){
                    $user = $_SESSION['auth'];
                    $this->ctrlPost->deleteComment($idComment, $user, $idPost);
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
            
            // Edit the comment by a redirection to a page with the comment target
            else if ($_GET['action'] == 'editComment') {
                $this->tools->sessionOn();
                $idComment = $_GET['idComment'];
                $idPost = intval($this->getParameter($_GET, 'id'));
                if(isset($_SESSION['auth'])){
                    $user_id = $_SESSION['auth']['id'];
                    if ($idPost != 0) {
                        $this->ctrlPost->editComment($idPost, $idComment, $user_id);
                    } else {
                        throw new Exception("Identifiant de billet non valide");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
             
            // Send the comment after the updating and redirect to the page
            else if ($_GET['action'] == 'updateComment') {
                $this->tools->sessionOn();
                $content = htmlspecialchars($_POST['content']);
                $userComm = htmlspecialchars($_POST['user_id']);
                $idComm = htmlspecialchars($_POST['id']);
                $idPost = htmlspecialchars($_POST['postId']);
                if(isset($_SESSION["auth"]) &&  $_SESSION["auth"]["role"] == "admin"){
                $user = $_SESSION["auth"]['id'];
                    if($userComm == $user){
                        $this->ctrlPost->updateComment($content, $idComm, $idPost);   
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
            
            // Delete a post and the posible bookings link with
            else if ($_GET['action'] == 'deletePost'){
                $this->tools->sessionOn();
                $idPost = $_GET['id'];
                if(isset($_SESSION["auth"])){
                    $user_id = $_SESSION['auth']['id'];
                    $this->ctrlPost->deletePost($user_id, $idPost);
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
            
            // Edit the post by a redirection to a page with the comment target
            else if ($_GET['action'] == 'editPost') {
                $this->tools->sessionOn();
                $idPost = intval($this->getParameter($_GET, 'id'));
                if(isset($_SESSION['auth'])){
                    $user_id = $_SESSION['auth']['id'];
                    if ($idPost != 0) {
                        $this->ctrlPost->editPost($idPost, $user_id);
                    } else {
                        throw new Exception("Identifiant de billet non valide");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
            
            // Send the post after the updating and redirect to the page
            else if ($_GET['action'] == 'updatePost') {
                $this->tools->sessionOn();
                $postId = $_GET['id'];
                $title = htmlspecialchars($_POST['title']);
                $content = $_POST['content'];
                $userId = $_SESSION["auth"]['id'];
                if($_FILES['img']['name']){
                    $img = $_FILES['img'];
                    $this->ctrlPost->updatePostAndImg($postId, $title, $content, $userId, $img);
                } else {
                    $this->ctrlPost->updatePost($postId, $title, $content, $userId);
                }
            }
            
            // Add yourself to a post
            else if ($_GET['action'] == 'booked'){
                $this->tools->sessionOn();
                $idPost = intval($this->getParameter($_GET, 'id'));
                $user = $_SESSION["auth"];
                if ($idPost != 0 && $user) {
                    $this->ctrlPost->addBooking($idPost, $user);
                }
                else
                    throw new Exception("Identifiant de billet non valide");
            }
            
            else if ($_GET['action'] == 'deleteBooking') {
                $this->tools->sessionOn();
                $idBooking = $_GET['id'];
                if(isset($_SESSION["auth"])){
                    $this->ctrlPost->deleteBooking($idBooking);
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
                }
            }
            
            
            // 
            else if ($_GET['action'] == 'sendToSupport') {
                if(!empty($_POST)){
                    $errors = array();
                    $email = htmlspecialchars($_POST['email']);
                    $name = htmlspecialchars($_POST['name']);
                    $phone = htmlspecialchars($_POST['phone']);
                    $message = htmlspecialchars($_POST['message']);
                    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errors['email'] = "Votre email n'est pas valide";
                    } 
                    if(!empty($errors)){
                        $this->ctrlPost->lastPost($errors, false, false);
                    } else {
                        mail('estebanianis@gmail.com', 'Envoi depuis la page de Contact EsMater', 'Prénom : ' . $name . '. Numéro de téléphone : ' . $phone . ' Message : ' . $message , 'From: ' . $email);
                        $errors = false;
                        $notif = "Votre email à bien été envoyé";
                        $this->ctrlPost->lastPost($errors, "Home", $notif);
                    }   
                }
            }
            
            else if ($_GET['action'] == 'sendFromSupport') {
                if(!empty($_POST)){
                    $errors = array();
                    $email = htmlspecialchars($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);
                    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errors['email'] = "Votre email n'est pas valide";
                    } 
                    if(!empty($errors)){
                        $this->ctrlPost->errorRedirection($errors, false, false);
                    } else {
                        mail($email, "Ceci est un email envoyé depuis la page web EsMater", ' Message : ' . $message , 'From: ' . 'estebanianis@gmail.com');
                        $errors = false;
                        $notif = "Votre email à bien été envoyé";
                        $this->ctrlPost->errorRedirection($errors, "Account", $notif);
                    }   
                }
            }
            
        }

        else { // No action : Show the home page
            $this->ctrlPost->errorRedirection(false, "Home", false);
        }
        
    }
      
    catch (Exception $e) {
        $this->error($e->getMessage());
      }
  }

// Show error
private function error($msgError) {
    $view = new \MyApp\View\View("Error");
    $view->generate(array('msgError' => $msgError));
}

// Search a parameter in a array
private function getParameter($array, $name) {
    if (isset($array[$name])) {
        return $array[$name];
    }
    else
        throw new Exception("Paramètre '$name' absent");
    }
}
