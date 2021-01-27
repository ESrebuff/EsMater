<?php

namespace MyApp\Model;

require_once 'Model.php';

class Booking extends Model {
    
    public function getBookedByMixed($mixedId){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE mix = :mix';
        $req = $this->executeRequest($sql, array('mix' => $mixedId));
        return $req->fetch();
    }
    
    public function getBookedByPostId($post_id){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE post_id = :post_id';
        $req = $this->executeRequest($sql, array('post_id' => $post_id));
        return $req->fetch();
    }
    
    public function getBookings(){
        $sql = 'select * FROM t_booking' . ' order by post_id asc';
        $bookings = $this->executeRequest($sql);
        return $bookings;
    }
    
    public function getMyBookings($userId){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE user_id = :user_id';
        $myBookings = $this->executeRequest($sql, array('user_id' => $userId));
        return $myBookings;
    }
    
    public function addBooked($idPost, $userId, $username, $user_avatar, $mixed, $img, $title, $date){
        $sql = 'insert into t_booking(date, user_id, post_id, username, user_avatar, mix, img, title, dated_post)' . ' values(NOW(), :user_id, :post_id, :username, :user_avatar, :mix, :img, :title, :dated_post)';
        $booked = $this->executeRequest($sql, array('user_id' => $userId, 'post_id' => $idPost, 'username' => $username, 'user_avatar' => $user_avatar, 'mix' => $mixed, 'img' => $img, 'title' => $title, 'dated_post' => $date));
    }
    
    public function updateBookingAndImg($title, $img, $idPost){
        $sql = 'UPDATE t_booking SET title = :title, img = :img' . 'WHERE post_id = :post_id';
        $req = $this->executeRequest($sql, array('title' => $title, 'img' => $img, 'post_id' => $idPost));
        return $req;
    }
    
    public function updateBooking($title, $idPost){
        $sql = 'UPDATE t_booking SET title = :title' . 'WHERE post_id = :post_id';
        $req = $this->executeRequest($sql, array('title' => $title, 'post_id' => $idPost));
        return $req;
    }
    
    public function deleteBookings($idPost){
        $sql = 'DELETE FROM t_booking' . ' WHERE post_id = :post_id';
        $req = $this->executeRequest($sql, array('post_id' => $idPost));
        return $req;
    }
    
    public function deleteBooking($idBooking){
        $sql = 'DELETE FROM t_booking' . ' WHERE id = :id';
        $req = $this->executeRequest($sql, array('id' => $idBooking));
        return $req;
    }
    
}