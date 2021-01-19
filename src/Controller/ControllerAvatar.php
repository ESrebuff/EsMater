<?php

namespace MyApp\Controller;

class ControllerAvatar {
    
    private $auth;
    private $comment;
    private $post;
    private $tools;

    public function __construct() {
        $this->auth = new \MyApp\Model\Auth();
        $this->comment = new \MyApp\Model\Comment();
        $this->post = new \MyApp\Model\Post();
        $this->tools = new \MyApp\Function\Tools();
    }
    
    // Verify and add a img with all the good conditions
    public function addAvatar($img, $authId, $userId){
        $maxSize = 2097152;
        $ext = strtolower(substr(strrchr($img['name'], '.'), 1));
        $allow_ext = array('jpg', 'jpeg',  'gif', 'png');
        if($img['size'] <= $maxSize){
            if(in_array($ext, $allow_ext)){
                $nameImg = $userId . "." . $ext;
                $result = move_uploaded_file($img['tmp_name'], "src/Content/images/avatars/" . $nameImg);
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