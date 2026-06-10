<?php
$error = null;


include '../webshop/config/db.php';
include '../includes/session_check.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $benutzername = $_POST["benutzername"];
    $vorname = $_POST["vorname"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $ort = $_POST["ort"];
    $plz = $_POST["plz"];
    $straße = $_POST["straße"];
    $hausnummer = $_POST["hausnummer"];
    $passwort = $_POST["passwort"];

    $sqlCheck="SELECT id FROM Kunde WHERE email = ? OR benutzername = ?";
    $checkStatement = $mysqli->prepare($sqlCheck);
    $checkStatement->bind_param('ss', $email, $benutzername);
    $checkStatement->execute();
    $checkResult = $checkStatement->get_result();
    $checkAnzahl = $checkResult->num_rows;
    
    if($checkAnzahl >0){
        $error = '
            <div class="alert alert-warning" role="alert">
            Benutzer ist bereits angelegt!
            </div>
        ';
        
    } 
    else {


    $sql = "INSERT INTO Kunde (benutzername, vorname, name, email, ort, plz, strasse, hausnummer, password)
            VALUES (?,?,?,?,?,?,?,?,?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('sssssisis',
        $benutzername,
        $vorname,
        $name,
        $email,
        $ort,
        $plz,
        $straße,
        $hausnummer,
        $passwort
    );
    
    if($statement->execute()){
    
    $sqlId="SELECT id, benutzername FROM Kunde WHERE email = ?";
    $idStatement = $mysqli->prepare($sqlId);
    $idStatement->bind_param('s', $email);
    $idStatement->execute();
    $result = $idStatement->get_result();
    $anzahl = $result->num_rows;
    
    if($anzahl ===1){
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['benutzername'];
        header("Location: index.php");
        exit();
    }
    }else{
        $error = '
            <div class="alert alert-danger" role="alert">
            Fehler bei der Registrierung!
            </div>
        ';
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Registrieren</title>
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
<link rel="icon" type="image/png" href="./images/fav2.png">
</head>

<body class="d-flex flex-column">
<!--Header-->
<?php
include '../includes/header.php';
?>
<!--Main-->
<main class="col-12 bg-light">



<div class="container mt-5">
<div class="row">
    <div class=" col-md-6 mx-auto">
        <?php

            if($error){
                echo($error);
            }

        ?>
        <h3>Bitte registriere dich :)</h3>
        <br>
        <form method="post">
            <label>Benutzername </label> 
            <input class="form-control" type="text" name="benutzername"><br>

            <label>Vorname </label> 
            <input class="form-control" type="text" name="vorname"><br>

            <label>Name </label>
            <input class="form-control" type="text" name="name"><br>

            <label>Email</label>
            <input class="form-control" type="email" name="email"><br>

            <label>Ort </label>
            <input class="form-control" type="text" name="ort"><br>

            <label>Plz</label>
            <input class="form-control" type="number" name="plz"><br>

            <label>Straße</label>
            <input class="form-control" type="text" name="straße"><br>

            <label>Hausnummer</label>
            <input class="form-control" type="number" name="hausnummer"><br>
                        
            <label>Passwort</label> 
            <input class="form-control" type="password" name="passwort">
            
            <br>
            <input style="margin-bottom: 80px;" class="btn btn-danger" type="submit" value="Registrieren">
            <div>

            </div>
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