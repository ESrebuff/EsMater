<?php

require_once 'Controller/ControllerHome.php';
require_once 'Controller/ControllerPost.php';
require_once 'Controller/ControllerLinkView.php';
require_once 'Controller/ControllerAuth.php';
require_once 'Controller/ControllerAvatar.php';
require_once 'View/View.php';
require_once 'Function/functions.php';


class Router {

  private $ctrlHome;
  private $ctrlPost;
  private $ctrlLinkView;
  private $ctrlAuth;
  private $ctrlAvatar;

  public function __construct() {
    $this->ctrlHome = new ControllerHome();
    $this->ctrlPost = new ControllerPost();
    $this->ctrlLinkView = new ControllerLinkView();
    $this->ctrlAuth = new ControllerAuth();
    $this->ctrlAvatar = new ControllerAvatar();
      
  }

  // Traite une requête entrante
  public function routerRequest() {
    try {
        
        if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
            $remember_token = $_COOKIE['remember'];
            $this->ctrlAuth->loginByRememberToken($remember_token);        
        }
        
        if(isset($_GET['action'])) {
            if ($_GET['action'] == 'post') {
                $idPost = intval($this->getParameter($_GET, 'id'));
                if ($idPost != 0) {
                    $this->ctrlPost->post($idPost);
                }
                else
                    throw new Exception("Identifiant de billet non valide");
            }
            
            else if ($_GET['action'] == 'comment') {
                session_start();
                $auth = $_SESSION["auth"];
                $author = $this->getParameter($auth, 'username');
                $content = $this->getParameter($_POST, 'content');
                $user_id = $this->getParameter($auth, 'id');
                $user_avatar = $this->getParameter($auth, 'avatar');
                $idPost = $this->getParameter($_POST, 'id');
                $this->ctrlPost->comment($author, $content, $idPost, $user_id, $user_avatar);    
            }
            
            else if ($_GET['action'] == 'addPost'){
                if(!empty($_FILES)){
                    session_start();
                    $auth = $_SESSION["auth"];
                    $img = $_FILES['img'];
                    $title = $_POST['title'];
                    $author = $_SESSION["auth"]['username'];
                    $content = $_POST['content'];
                    $user_id = $_SESSION["auth"]['id'];
                    $user_avatar = $_SESSION["auth"]['avatar'];
                    $this->ctrlPost->addPost($img, $title, $author, $content, $user_id, $user_avatar);
                }else {
                    session_start();
                    $_SESSION['flash']['danger'] = "Vous devez inserez une image";
                    header('Location: index.php?action=linkView&swicthTo=AddPost');
                }
            }
            
            else if ($_GET['action'] == 'register') {
                if(!empty($_POST)){
                    $errors = array();
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if(empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)){
                        $errors['username'] = "Votre pseudo n'est pas valide";
                    } else {
                        if($this->ctrlAuth->usernameIsUniq($username)){
                            $errors['username'] = "Ce pseudo est déjà utilisé";
                        }
                    }
                    
                    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errors['email'] = "Votre email n'est pas valide";
                    } else {
                        if($this->ctrlAuth->emailIsUniq($email)){
                            $errors['email'] = "Cet email est déjà utilisé";
                        }
                    }
                    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
                        $errors['password'] = "Vous devez rentrez un mot de passe valide";
                    }
                    
                    if(empty($errors)){
                        $this->ctrlAuth->register($username, $email, $password);
                    } else {
                        $this->ctrlAuth->errors($errors);
                    }
                }
            }
            else if ($_GET['action'] == 'confirm'){
                $this->ctrlAuth->confirmationToken($_GET['id'], $_GET['token']);
            }
            
            else if ($_GET['action'] == 'linkView') {
                $this->ctrlLinkView->linkView($_GET['swicthTo']);
            }
            
            else if ($_GET['action'] == 'logout'){
                sessionOn();
                setcookie('remember', NULL, -1);
                unset($_SESSION['auth']);
                $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
                $view = new View("Login");
                $view->generate(array());
            }
            
            else if ($_GET['action'] == 'login') {
                if(isset($_SESSION['auth'])){
                    header("Location: index.php?action=linkView&swicthTo=Account");
                    exit();
                } else if(!empty($_POST) && !empty($_POST["username"]) && !empty($_POST["password"])){
                    if(!empty($_POST['remember'])){
                        $remember = true;
                        $this->ctrlAuth->loginUser($_POST["username"], $_POST["password"], $remember);
                    } else {
                        $remember = false;
                        $this->ctrlAuth->loginUser($_POST["username"], $_POST["password"], $remember);
                    }
                }
            }
            
            else if ($_GET['action'] == 'updatePassword') {
                if(!empty($_POST)){
                    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
                        session_start();
                        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
                        header('Location: index.php?action=linkView&swicthTo=Account');
                    }else {
                        session_start();
                        $this->ctrlAuth->updatePassword($_SESSION["auth"]['id'], $_POST['password']);
                    }
                }
            }
            
            else if ($_GET['action'] == 'forgot'){
                if(!empty($_POST) && !empty($_POST['email'])){
                    $this->ctrlAuth->newPassword($_POST['email']);
                }
            }
            
            else if ($_GET['action'] == 'forgetPasswordAuth'){
                if(isset($_GET['id']) && isset($_GET['token'])){
                    $this->ctrlAuth->verifyTokenAuth($_GET['id'], $_GET['token']);
                } else{
                    header('location: index.php?action=linkView&swicthTo=Login');
                    exit();
                }
            }
            
            else if ($_GET['action'] == 'reset') {
                if(!empty($_POST)){
                    if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){;
                        $this->ctrlAuth->resetPassword($_GET['id'], $_POST['password']);
                    }else {
                        
                    }
                }
            }
            
            else if ($_GET['action'] == 'avatar'){
                if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
                    $this->ctrlAvatar->addAvatar($_FILES['avatar'], $_GET['id']);
                }else {
                     header('location: index.php?action=linkView&swicthTo=Account');
                    exit();
                }
            }
            
            else if ($_GET['action'] == 'deleteComment'){
                $idComment = $_GET['idComment'];
                $idPost = $_GET['id'];
                session_start();
                if(isset($_SESSION["auth"])){
                    $user_id = $_SESSION['auth']['id'];
                    $this->ctrlPost->deleteComment($idComment, $user_id, $idPost);
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
            
            else if ($_GET['action'] == 'editComment') {
                $idComment = $_GET['idComment'];
                $idPost = intval($this->getParameter($_GET, 'id'));
                session_start();
                if(isset($_SESSION['auth'])){
                    $user_id = $_SESSION['auth']['id'];
                    if ($idPost != 0) {
                        $this->ctrlPost->editComment($idPost, $idComment, $user_id);
                    } else {
                        throw new Exception("Identifiant de billet non valide");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
                
            else if ($_GET['action'] == 'updateComment') {
                $content = $this->getParameter($_POST, 'content');
                $userComm = $this->getParameter($_POST, 'user_id');
                $idComm = $this->getParameter($_POST, 'id');
                $idPost = $this->getParameter($_POST, 'postId');
                
                session_start();
                if(isset($_SESSION["auth"])){
                $user = $_SESSION["auth"]['id'];
                    if($userComm == $user){
                        $this->ctrlPost->updateComment($content, $idComm, $idPost);   
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
            
            else if ($_GET['action'] == 'deletePost'){
                $idPost = $_GET['id'];
                session_start();
                if(isset($_SESSION["auth"])){
                    $user_id = $_SESSION['auth']['id'];
                    $this->ctrlPost->deletePost($user_id, $idPost);
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
            
            else if ($_GET['action'] == 'editPost') {
                $idPost = intval($this->getParameter($_GET, 'id'));
                session_start();
                if(isset($_SESSION['auth'])){
                    $user_id = $_SESSION['auth']['id'];
                    if ($idPost != 0) {
                        $this->ctrlPost->editPost($idPost, $user_id);
                    } else {
                        throw new Exception("Identifiant de billet non valide");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
            
            else if ($_GET['action'] == 'updatePost') {
                $content = $this->getParameter($_POST, 'content');
                $userComm = $this->getParameter($_POST, 'user_id');
                $idComm = $this->getParameter($_POST, 'id');
                $idPost = $this->getParameter($_POST, 'postId');
                
                session_start();
                if(isset($_SESSION["auth"])){
                $user = $_SESSION["auth"]['id'];
                    if($userComm == $user){
                        $this->ctrlPost->updateComment($content, $idComm, $idPost);   
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                    }
                } else {
                    throw new Exception("Vous n'avez pas le droit d'accedez à cette page");
                }
            }
            
            
        }
        else {  // aucune action définie : affichage de l'accueil
            $this->ctrlHome->home();
        }
    
}
    catch (Exception $e) {
      $this->error($e->getMessage());
    }
  }

  // Affiche une erreur
  private function error($msgError) {
    $view = new View("Error");
    $view->generate(array('msgError' => $msgError));
  }
    
      // Recherche un paramètre dans un tableau
  private function getParameter($array, $name) {
    if (isset($array[$name])) {
      return $array[$name];
    }
    else
      throw new Exception("Paramètre '$name' absent");
  }
}
