<?php

require_once 'Model/Model.php';

class Booking extends Model {
    
    public function getBookedByMixed($mixedId){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE mix = ?';
        $req = $this->executeRequest($sql, array($mixedId));
        return $req->fetch();
    }
    
    public function getBookedByPostId($post_id){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE post_id = ?';
        $req = $this->executeRequest($sql, array($post_id));
        return $req->fetch();
    }
    
    public function getBookings(){
        $sql = 'select * FROM t_booking' . ' order by post_id asc';
        $bookings = $this->executeRequest($sql);
        return $bookings;
    }
    
    public function getMyBookings($userId){
        $sql = 'SELECT * ' . ' FROM t_booking' . ' WHERE user_id = ?';
        $myBookings = $this->executeRequest($sql, array($userId));
        return $myBookings;
    }
    
    public function addBooked($idPost, $userId, $username, $mixed, $img, $title, $date){
        $sql = 'insert into t_booking(date, user_id, post_id, username, mix, img, title, dated_post)' . ' values(NOW(), ?, ?, ?, ?, ?, ? , ?)';
        $booked = $this->executeRequest($sql, array($userId, $idPost, $username, $mixed, $img, $title, $date));
    }
    
    public function updateBookingAndImg($title, $img, $idPost){
        $sql = 'UPDATE t_booking SET title = ?, img = ?' . 'WHERE post_id = ?';
        $req = $this->executeRequest($sql, array($title, $img, $idPost));
        return $req;
    }
    
    public function updateBooking($title, $idPost){
        $sql = 'UPDATE t_booking SET title = ?' . 'WHERE post_id = ?';
        $req = $this->executeRequest($sql, array($title, $idPost));
        return $req;
    }
    
    public function deleteBooking($idPost){
        $sql = 'DELETE FROM t_booking' . ' WHERE post_id = ?';
        $req = $this->executeRequest($sql, array($idPost));
        return $req;
    }
    
}