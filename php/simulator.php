<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR QR Code Scanner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .navbar{
            background-color: rgba(247, 195, 95, 1);
        }
        footer{
            background-color: rgba(247, 195, 95, 1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#">Farming AR</a>
        </div>
        <section class="container-fluid hero-page ">
        <nav class="navbar navbar-expand-lg fixed-top nav-bg">
          <div class="container-fluid">
            <a class="navbar-brand mx-5" href="../index.html">
              <strong class="fs-5 ms-3">TEEN-ANIM</strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto me-5">
                <li class="nav-item mx-3">
                  <a class="nav-link fw-bold fs-5" href="modulepage.php">Modules</a>
                </li>
                <li class="nav-item mx-3">
                  <a class="nav-link fw-bold fs-5" href="Forum/community.php">Community</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    </section>
    </nav>

    <main class="container text-center mt-5">
        <h1 class="mb-3">Experience Augmented Reality in Farming</h1>
        <p class="lead">Scan the QR code below to access our AR feature and explore interactive farming experiences. 
        This feature brings farming knowledge to life and provides a hands-on way to learn about sustainable agriculture.</p>
        <div class="card mx-auto mt-4 p-3" style="width: 24em;">
            <img src="../images/qr.png" class="card-img-top" alt="QR Code for AR">
            <div class="card-body">
                <p class="card-text">Point your smartphone camera at this QR code or use a QR code scanner app to access the AR experience.</p>
            </div>
        </div>
    </main>

    <footer class=" text-white text-center py-3">
        &copy; 2024 Farming AR. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
