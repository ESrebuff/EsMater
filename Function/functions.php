<?php
// Try if he logged
function logged_auth_only(){
    if(session_status() == PHP_SESSION_NONE){
    session_start();
    }
    if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
    header('location: index.php?action=linkView&swicthTo=Login');
    exit();
    }
}

// Try if he are a admin
function admin_only(){
    if(!$_SESSION['auth']['role'] == 'admin'){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
    header('location: index.php?action=linkView&swicthTo=Login');
    exit();
    }
}

// Do a session
function sessionOn(){
    if(session_status() == PHP_SESSION_NONE){
    session_start();
    }
}

?>