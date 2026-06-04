<?php
    include "../includes/session_check.php";
    include '../webshop/config/db.php';

    $kundId= $_SESSION["user_id"];
    $prodId= $_POST["productId"];

    $query = "INSERT INTO Warenkorb (kundeid, produktid) VALUES (?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ii", $kundId, $prodId);
    if(!$statement->execute()) {
        print("Query fehlgeschlagen: ".$statement->error);
    }
?>