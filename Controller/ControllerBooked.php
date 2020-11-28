<?php

require_once 'Model/Auth.php';
require_once 'Model/Post.php';
require_once 'Model/Booked.php';

class ControllerBooked {
    
    private $auth;
    private $post;
    private $booked;

    public function __construct() {
        $this->auth = new Auth();
        $this->post = new Post();
        $this->booked = new Booked();
    }
    
    // Add a booking with the idUser and idPost
    public function addBooked($idPost, $user){
        $exUser = $this->booked->getBookedByUser($user['id']);
        $exPost = $this->booked->getBookedByPost($idPost);
        if($exUser && $exPost){
            if($exUser['id'] !== $exPost['id']){
                $this->booked->addBooked($idPost, $user['id'], $user['username']);
                
            } else {
                session_start();
                $_SESSION["flash"]["danger"] = "Erreur imposible de vous y inscrire";
                header('Location: index.php');
            }
        }else {
            $this->booked->addBooked($idPost, $user['id'], $user['username']);
            
        }
    }
}