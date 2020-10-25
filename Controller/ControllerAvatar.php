<?php

require_once 'Model/Auth.php';
require_once 'Model/Comment.php';
require_once 'Model/Post.php';
require_once 'View/View.php';

class ControllerAvatar {
    
    private $auth;
    private $comment;

    public function __construct() {
        $this->auth = new Auth();
        $this->comment = new Comment();
        $this->post = new Post();
    }
    
    public function addAvatar($img, $authId){
        $maxSize = 2097152;
        $ext = strtolower(substr($img['name'],-3));
        $allow_ext = array('jpg', 'jpeg',  'gif', 'png');
        if($img['size'] <= $maxSize){
            if(in_array($ext, $allow_ext)){
                $result = move_uploaded_file($img['tmp_name'], "Content/images/avatars/".$img['name']);
                if($result){
                    $user = $this->auth->updateAvatar($authId, $img['name']);
                    $this->comment->updateAvatarComment($authId, $img['name']);
                    $this->post->updateAvatarPost($authId, $img['name']);
                    if($user){
                        session_start();
                        $_SESSION['flash']['success'] = "Votre photo de profil à bien été modifié";
                        $user = $this->auth->getAuth($authId);
                        $_SESSION["auth"] = $user;
                        header('Location: index.php?action=linkView&swicthTo=Account');
                    }
                } else{
                    session_start();
                    $_SESSION['flash']['danger'] = "Erreur durant l'importation de votre photo de profi";
                    header('Location: index.php?action=linkView&swicthTo=Account');
                }
            } else{
                session_start();
                $_SESSION['flash']['danger'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                header('Location: index.php?action=linkView&swicthTo=Account');
            }
        } else{
            session_start();
            $_SESSION['flash']['danger'] = "Votre photo de profil ne doit pas dépasser 2Mo";
            header('Location: index.php?action=linkView&swicthTo=Account');
        }
    }
}