<header>
        <div id="head" class="col-12 py-4 d-flex bg-danger text-white align-items-center">
            <div class="col-8 ps-4 d-inline-flex align-items-center">
                <image src="../webshop/images/logo.png" height="100px">
                    <div class="p-4">
                        <h2>Tritschler Webservices</h2>
                        <i>est. 2026</i>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <?php
                        if(isLoggedIn()){
                           $userId = $_SESSION['user_id'];
                           $username = "";
                           include("../webshop/config/db.php");
                          $sql = "SELECT vorname FROM Kunde WHERE id = ?";
                          $statement = $mysqli->prepare($sql);
                          $statement->bind_param("i", $userId);
                          $statement->execute();
                          $result = $statement->get_result();
                          $row = $result->fetch_object();
                          $username = $row->vorname;
                          echo("<h3>Hallo $username !</h3>");
                        }
                        ?>
                    </div>
            </div>
            <!--Datenbank API (Login / Warenkorb)-->
            <div id="buttons" class="text-white col-4 pe-4 d-flex justify-content-end">
                <?php
                if(isLoggedIn()){
                    echo '<a href="logout.php" class="text-white btn">Logout <i class="fs-5 bi bi-box-arrow-in-right"></i></a>';
                }else{  
                     echo '<a href="register.php" class="text-white btn">Registrieren <i class="fs-5 bi bi-box-arrow-in-right"></i></a>';
                     echo '<a href="login.php" class="text-white btn">Login <i class="fs-5 bi bi-box-arrow-in-right"></i></a>';
                }
                ?>
                <a class="text-white btn" href="cart.php">Warenkorb <i class="fs-5 bi bi-cart2"></i></a>
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
                                <li><a class="dropdown-item" href="category.php?category=all">Gesamte Karte</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="category.php?category=1">Zu Trinken</a></li>
                                <li><a class="dropdown-item" href="category.php?category=3">- Mate</a></li>
                                <li><a class="dropdown-item" href="category.php?category=4">- Kaffee</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="category.php?category=2">Zu Essen</a></li>
                                <li><a class="dropdown-item" href="category.php?category=5">- Pizza</a></li>
                                <li><a class="dropdown-item" href="category.php?category=6">- Pasta</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex" action="./search.php" method="GET">
                            <input class="form-control me-2" type="text" name="search" placeholder="Suche">
                            <button class="btn btn-secondary" type="submit">Suche</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

