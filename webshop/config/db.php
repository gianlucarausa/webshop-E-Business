<?php
    $mysqli = new mysqli("localhost", "root", "example", "webshop");
		if ($mysqli->connect_errno) {
		    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
		}
?>