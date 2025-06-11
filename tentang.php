<?php
require 'admin/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tentang - Mengukir Jejak</title>
    <link rel="icon" type="image/x-icon" href="assets/logokecil.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .tentang-content {
            text-align: justify;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/logokecil.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="tentang.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Tentang Mengukir Jejak</h1>
                <p class="lead mb-0">Kenali lebih dekat siapa kami dan tujuan kami berbagi cerita.</p>
            </div>
        </div>
    </header>
    <!-- Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body tentang-content">
                        <p>
                            <b>Mengukir Jejak</b> adalah ruang berbagi kisah perjalanan, petualangan, dan refleksi kehidupan. Kami percaya setiap langkah, pengalaman, dan cerita memiliki makna yang layak untuk dibagikan. Melalui platform ini, kami ingin menginspirasi, mengedukasi, dan menemani setiap pembaca dalam menapaki jejak hidupnya.
                        </p>
                        <p>
                            Kami terbuka untuk kolaborasi, pertanyaan, maupun saran dari para pembaca. Silakan <a href="kontak.php">hubungi kami</a> jika ingin berdiskusi atau berbagi cerita.
                        </p>
                        <p>
                            Terima kasih telah menjadi bagian dari perjalanan ini. Mari bersama-sama mengukir jejak yang bermakna!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Mengukir Jejak 2025</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>