<?php

namespace MyApp\Tools;

class Tools {

    private $booking;
    
    public function __construct() {
        $this->booking = new \MyApp\Model\Booking();
    }
    
    // Do a redirection with a flash message
    public function flashMessage($typeOfMsg, $msg, $where){
        $_SESSION['flash'][$typeOfMsg] = $msg;
        if($where){
            $view = new \MyApp\View\View($where);
            $view->generate(array());   
        }
    }
    
    // Redirection to the account with the bookings link to
    public function redirectionAccount($userId) {
        $bookings = $this->booking->getBookings();
        $myBookings = $this->booking->getMyBookings($userId);
        $view = new \MyApp\View\View("Account");
        $view->generate(array('bookings' => $bookings, 'myBookings' => $myBookings));
    }
    
    // Try if logged
    public function logged_auth_only(){
       if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
      if(!isset($_SESSION['auth'])){
         $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            header('location: index.php?action=linkView&swicthTo=Login');
       exit();
       }
    }
    
    // Try if logged and admin
    public function admin_only(){
       if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
      if(!isset($_SESSION['auth']) && $_SESSION['auth']['role'] == 'admin'){
         $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            header('location: index.php?action=linkView&swicthTo=Login');
       exit();
       }
    }
    
    // Do a session
    public function sessionOn(){
        if(session_status() == PHP_SESSION_NONE){
        session_start();
        }
    }   
}
