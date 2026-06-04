<?php
    $mysqli = new mysqli("mysqldb", "root", "example", "webshop");
		if ($mysqli->connect_errno) {
		    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
		}
?>