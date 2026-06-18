<?php
 include("../includes/session_check.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment | Tritschler Webservices</title>
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
// Include database connection file 
include('../webshop/config/db.php'); 
 
// If transaction data is available in the URL 
if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 
    // Get transaction information from URL 
    $userId = $_GET['item_number'];  
    $txn_id = $_GET['tx']; 
    $payment_gross = $_GET['amt']; 
    $currency_code = $_GET['cc']; 
    $payment_status = $_GET['st']; 
     
    if($payment_status == "Completed"){

    $query = "INSERT INTO Einkauf (bezahlt, kundeid, txnid) VALUES (CURDATE(), ?, ?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ii", $userId, $txn_id);
    $statement->execute();


    $query = "SELECT max(id) as max_id FROM Einkauf WHERE kundeid = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $userId);
    $statement->execute();
    $result = $statement->get_result();             
    $row = $result->fetch_object();
    $MaxId = $row->max_id;


    $query = "UPDATE Warenkorb SET einkaufid = ? WHERE kundeid = ? AND einkaufid IS NULL";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ii", $MaxId, $userId);
    $statement->execute();

    echo '      
        <div class="container mt-5">
            <div class="row">
                <div class=" col-md-6 mx-auto">
                <div class="alert alert-success" role="alert">
                    Zahlung war erfolgreich!
                </div>
                <div class="status">
                    <h4>Payment Information</h4>
                    <p><b>Reference Number:</b> ' . $userId . '</p>
                    <p><b>Transaction ID:</b> ' . $txn_id . '</p>
                    <p><b>Paid Amount:</b> ' . $payment_gross . '</p>
                    <p><b>Payment Status:</b> ' . $payment_status . '</p>
                </div>
            </div>
        </div>
    </div>
            ';

    } else {
        echo '
            <div class="alert alert-warning" role="alert">
            Zahlung war nicht erfolgreich!
            </div>
        ';
    }
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