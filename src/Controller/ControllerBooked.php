<?php

namespace MyApp\Controller;

class ControllerBooked {
    
    private $auth;
    private $post;

    public function __construct() {
        $this->auth = new \MyApp\Model\Auth();
        $this->post = new \MyApp\Model\Post();
        $this->booked = new \MyApp\Model\Booking();
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
                $_SESSION["flash"]["danger"] = "Erreur impossible de vous y inscrire";
                header('Location: index.php');
            }
        }else {
            $this->booked->addBooked($idPost, $user['id'], $user['username']);
            
        }
    }
}