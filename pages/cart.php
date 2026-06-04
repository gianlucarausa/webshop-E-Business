<?php
    include "../includes/session_check.php";

    if(!isLoggedIn()) {
        header("location: ./index.php");
    }
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
    <link rel="icon" type="image/png" href="./images/fav2.png">
</head>

<body class="d-flex flex-column">
    <!--Header-->
    <?php
        include "../includes/header.php";
    ?>
    <!--Main-->
    <main class="col-12 bg-light">
        <?php
        include '../webshop/config/db.php';

        $username = $_SESSION["username"];
        $userId = $_SESSION["user_id"];

        print("<h2>Willkommen im Warenkorb " . $username ."</h2><br><p>Artikel im Warenkorb</p>");

        $query = "SELECT p.bezeichnung, p.preis, w.id FROM Warenkorb w, Produkt p WHERE w.kundeid=? AND w.produktid = p.id ORDER BY w.id";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        print("<table>");
        print("<tr>");
        print("<th>Anzahl</th>");
        print("<th>Artikel</th>");
        print("<th>Preis</th>");
        print("</tr>");

        while ($row = $result->fetch_object()) {
            print("<tr>");
            print("<td>1x</td>");
            print("<td>");
            print($row->bezeichnung);
            print("</td>");
            print("<td>");
            print($row->preis." €");
            print("</td>");
            print("<td>");
            print("<form action=\"./deleteFromCart.php\" method=\"POST\">
                    <button type=\"submit\" name=\"cart_id\" value=\"$row->id\" class=\"btn btn-danger btn-lg\">x</button>
                </form>");
            print("</td>");
            print("</tr>"); 
        }

        print("</table>");
        print('<form action="./index.php" method="GET">
                    <button type="submit" class="btn btn-secondary btn-sm">Weiter Einkaufen</button>
                </form>
                <form action="./payment.php" method="GET">
                    <button type="submit" class="btn btn-success btn-lg">Bezahlen</button>
                </form>')  
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