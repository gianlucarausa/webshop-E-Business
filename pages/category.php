<?php 
include("../webshop/config/db.php");
if(isset($_GET['category'])){
    if($_GET['category'] == "all"){
    $categoryTitel = "Gesamte Karte";
    $category = "Kategorie"; //das ist um später einfach einen Select * From Kategorie machen zu können
    } else if($_GET['category'] == 1){
        $categoryTitel = "Zu Trinken";
        $category = $_GET['category'];
    } else if($_GET['category'] == 2 ){
        $categoryTitel = "Zu Essen";
        $category = $_GET['category'];
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    echo("<title>Kategorie | $categoryTitel</title>")
    ?>
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

        while($row = $result->fetch_object()){
        echo("<a>".$row->bezeichnung."<a/>");
        }

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