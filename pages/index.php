<?php
    include '../includes/session_check.php';
    $_SESSION['category'] = "index";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | Tritschler Webservices</title>
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
        <?php 
        include("../webshop/config/db.php");
        $sql = "Select * From Produkt";
        $statement = $mysqli->prepare($sql);
        $statement-> execute();
        $result = $statement->get_result();

        echo('<div class="d-flex flex-wrap">');
        while($row = $result->fetch_object()){
        echo("<div class=\"card\" style=\"width:400px\">
                <img class=\"card-img-top\" src=\"$row->bild\" alt=\"Card image\">
                <div class=\"card-body\">
                    <h4 class=\"card-title\">$row->bezeichnung</h4>
                    <p class=\"card-text\">$row->beschreibung</p>
                    <p class=\"card-text\">$row->preis €</p>
                    <form action=\"addToCart.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"productId\" value=\"$row->id\">
                        <a>$row->id</a>
                        <button type=\"submit\" class=\"btn btn-danger btn-lg\">Zum Warenkorb hinzufügen</button>
                    </form>
                </div>
            </div>");
        }
        echo('</div>');
        ?>
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