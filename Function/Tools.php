<?php
require_once 'Model/Auth.php';
require_once 'Model/Comment.php';
require_once 'Model/Post.php';
require_once 'Model/Booking.php';
require_once 'View/View.php';

class Tools {
    private $auth;
    private $comment;
    private $post;
    private $booking;
    

    public function __construct() {
        $this->auth = new Auth();
        $this->comment = new Comment();
        $this->post = new Post();
        $this->booking = new Booking();
    }
    
    // Do a redirection with a flash message
    public function flashMessage($typeOfMsg, $msg, $where){
        $_SESSION['flash'][$typeOfMsg] = $msg;
        if($where){
            $view = new View($where);
            $view->generate(array());   
        }
    }
    
    // Redirection to the account with the bookings link to
    public function redirectionAccount($userId) {
        $bookings = $this->booking->getBookings();
        $myBookings = $this->booking->getMyBookings($userId);
        $view = new View("Account");
        $view->generate(array('bookings' => $bookings, 'myBookings' => $myBookings));
    }
}
