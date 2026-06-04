<?php
    include "../includes/session_check.php";
    include '../webshop/config/db.php';

    if(!isLoggedIn()) {
        header("location: ./index.php");
    }

    $cartId= $_POST["cart_id"];
    
    $query = "DELETE FROM Warenkorb WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $cartId);
    if(!$statement->execute()) {
        print("Query fehlgeschlagen: ".$statement->error);
    } else {
        header("location: ./cart.php");
    }
        
?>