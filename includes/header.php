<header>
        <div id="head" class="col-12 py-4 d-flex bg-danger text-white align-items-center">
            <div class="col-8 ps-4 d-inline-flex align-items-center">
                <image src="../webshop/images/logo.png" height="100px">
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
                </ul>
            </div>
        </nav>
    </header>

