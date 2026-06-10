<?php
    $error = null;
    include '../includes/session_check.php';
    include '../webshop/config/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $benutzername_email = $_POST["benutzername_email"];
        $passwort = $_POST["passwort"];


        $sql="SELECT id, benutzername FROM Kunde WHERE (email = ? OR benutzername = ?) AND password = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param('sss', $benutzername_email, $benutzername_email, $passwort);
        $statement->execute();
        $result = $statement->get_result();
        $anzahl = $result->num_rows;

        
        if($anzahl ===1){
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['benutzername'];
            header("Location: index.php");
            exit();
        }else{
            $error = '<div class="alert alert-warning"> Benutzer nicht gefunden!</div>';
        }

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Tritschler Webservices</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP-Webshop für Essen mit hoher Qualitaet">
    <meta name="author" content="thu">
    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="../webshop/images/fav2.png">
</head>

<body class="d-flex flex-column">
    <!--Header-->
    <?php
    include("../includes/header.php");
    ?>
    <!--Main-->
    <main class="col-12 bg-light">
        <div class="container mt-5">
<div class="row">
    <div class=" col-md-6 mx-auto">
        <?php

            if($error){
                echo $error;
            }

        ?>
        <h3>melden Sie sich an!</h3>
        <br>
        <form method="post">
            <label>Benutzername oder Email </label> 
            <input class="form-control" type="text" name="benutzername_email"><br>
                        
            <label>Passwort</label> 
            <input class="form-control" type="password" name="passwort">
            <br>
            <input style="margin-bottom: 80px;" class="btn btn-danger" type="submit" value="Anmelden">
        </form>
    </div>
</div>
</div>
    </main>
    <!--Footer-->
    <footer class="col-12">
        <nav class="navbar navbar-expand-sm bg-danger">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Impressum</a>
                    </li>
                    <text class="nav-link text-white"> | </text>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Datenschutzerklärung</a>
                    </li>
                    <text class="nav-link text-white"> | </text>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Erklärung zur Barrierefreiheit</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="container-fluid bg-secondary text-white d-flex justify-content-center">
            <i class="nav-link">Copyright <i class="bi bi-c-circle"></i> | Tritschler Webservices</i>
        </nav>
    </footer>
</body>

</html>