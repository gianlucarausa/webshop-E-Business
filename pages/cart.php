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
    <header>
        <div id="head" class="col-12 py-4 d-flex bg-danger text-white align-items-center">
            <div class="col-8 ps-4 d-inline-flex align-items-center">
                <image src="./images/logo.png" height="100px">
                    <div class="p-4">
                        <h2>Tritschler Webservices</h2>
                        <i>est. 2026</i>
                    </div>
            </div>
            <!--Datenbank API (Login / Warenkorb)-->
            <div id="buttons" class="text-white col-4 pe-4 d-flex justify-content-end">
                <button class="text-white btn">Login <i class="fs-5 bi bi-box-arrow-in-right"></i></button>
                <button class="text-white btn" data-bs-toggle="offcanvas" data-bs-target="#checkout-canvas"
                    href="#">Warenkorb <i class="fs-5 bi bi-cart2"></i></button>
            </div>
        </div>
        <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="btn text-white dropdown-toggle" data-bs-toggle="dropdown">
                                Unsere Karte
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Gesamte Karte</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Zu Essen</a></li>
                                <li><a class="dropdown-item" href="#">- Pasta</a></li>
                                <li><a class="dropdown-item" href="#">- Pizza</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Zu Trinken</a></li>
                                <li><a class="dropdown-item" href="#">- Mate</a></li>
                                <li><a class="dropdown-item" href="#">- Kaffee</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--Main-->
    <main class="col-12 bg-light">
        <?php
        include '../webshop/config/db.php';

        $username = $_SESSION["username"];
        $userId = $_SESSION["id"];

        print("<h2>Willkommen im Warenkorb " . $username ."</h2><br><p>Artikel im Warenkorb</p>");

        $query = "SELECT p.bezeichnung, p.preis FROM Warenkorb w, Produkt p WHERE w.kundeid=? AND w.produktid = p.id";
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
            print($row->preis);
            print("</td>");
            print("</tr>"); 
        }

        print("</table>");  
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