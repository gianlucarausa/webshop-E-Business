<?php
    include "../includes/session_check.php";
    include '../webshop/config/db.php';

    if(!isLoggedIn()) {
        header("location: ./login.php");
    }

    $kundId= $_SESSION["user_id"];
    $prodId= $_POST["productId"];
    $category = $_SESSION["category"];
    

    $query = "INSERT INTO Warenkorb (kundeid, produktid) VALUES (?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ii", $kundId, $prodId);
    if(!$statement->execute()) {
        print("Query fehlgeschlagen: ".$statement->error);
    } else if($category == "index"){
        header("location: ./index.php");
    }else {
        header("location: ./category.php?category=$category");
    }
        
?>