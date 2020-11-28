<?php

require_once 'Function/Tools.php';
require_once 'Model/Auth.php';
require_once 'Model/Comment.php';
require_once 'Model/Post.php';
require_once 'View/View.php';

class ControllerAvatar {
    
    private $auth;
    private $comment;
    private $post;
    private $tools;

    public function __construct() {
        $this->auth = new Auth();
        $this->comment = new Comment();
        $this->post = new Post();
        $this->tools = new Tools();
    }
    
    // Verify and add a img with all the good conditions
    public function addAvatar($img, $authId, $userId){
        $maxSize = 2097152;
        $ext = strtolower(substr($img['name'],-3));
        $allow_ext = array('jpg', 'jpeg',  'gif', 'png');
        if($img['size'] <= $maxSize){
            if(in_array($ext, $allow_ext)){
                $nameImg = $userId . "." . $ext;
                $result = move_uploaded_file($img['tmp_name'], "Content/images/avatars/" . $nameImg);
                if($result){
                    $user = $this->auth->updateAvatar($authId, $nameImg);
                    $this->comment->updateAvatarComment($authId, $nameImg);
                    $this->post->updateAvatarPost($authId, $nameImg);
                    if($user){
                        $user = $this->auth->getAuth($authId);
                        $_SESSION["auth"] = $user;
                        $this->tools->flashMessage("success", "Votre photo de profil à bien été modifié", "Account");
                    }
                } else{
                    session_start();
                    $this->tools->flashMessage("danger", "Erreur durant l'importation de votre photo de profi", "Account");
                }
            } else{
                session_start();
                $this->tools->flashMessage("danger", "Votre photo de profil doit être au format jpg, jpeg, gif ou png", "Account");
            }
        } else{
            session_start();
            $this->tools->flashMessage("danger", "Votre photo de profil ne doit pas dépasser 2Mo", "Account");
        }
    }
}