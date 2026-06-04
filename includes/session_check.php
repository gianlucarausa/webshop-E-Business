<?php
session_start();


if(isset($_SESSION['last_activity'])){
        if(time()-$_SESSION['last_activity']>600){
            header('location: ../pages/logout.php');
        }
}

$_SESSION['last_activity'] = time();


function isLoggedIn() : bool{

    if(isset($_SESSION['user_id'])){
        return true;
    }
    return false;
}

?>