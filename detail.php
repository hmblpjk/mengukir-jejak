<?php
require 'admin/function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detail Artikel - Mengukir Jejak</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/logokecil.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/logokecil.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <?php
                    $data_id_kontributor = $_GET['id'];
                    $data_id_kategori = $_GET['id_kategori'];
                    $sql = "SELECT 
                            kontributor.id AS id_kontributor,
                            kontributor.id_kategori,
                            artikel.date,
                            artikel.title,
                            artikel.content,
                            penulis.username,
                            kategori.name,
                            kategori.id,
                            artikel.picture
                        FROM 
                            kontributor
                        JOIN 
                            artikel ON kontributor.id_artikel = artikel.id
                        JOIN 
                            penulis ON kontributor.id_penulis = penulis.id
                        JOIN 
                            kategori ON kontributor.id_kategori = kategori.id
                            WHERE kontributor.id = '$data_id_kontributor' AND kategori.id = '$data_id_kategori'";
                    $result = mysqli_query($koneksi, $sql);
                    $nomor_urut = 0;
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nomor_urut++;
                            $data_tanggal = $row['date'];
                            $data_judul = $row['title'];
                            $data_kategori = $row['name'];
                            $data_penulis = $row['username'];
                            $data_gambar = $row['picture'];
                            $data_id_kontributor = $row['id_kontributor'];
                            $data_idkategori = $row['id'];
                            $data_isi = $row['content'];
                            ?>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1"><?php echo $data_judul; ?></h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2">Ditulis pada <?php echo $data_tanggal; ?> oleh
                                    <?php echo $data_penulis; ?>
                                </div>
                                <!-- Post categories-->
                                <a class="badge bg-secondary text-decoration-none link-light"
                                    href="kategori.php?id_kategori=<?php echo $data_id_kategori; ?>"><?php echo $data_kategori; ?></a>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="admin/<?php echo $data_gambar; ?>"
                                    alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <div class="fs-5 mb-4">
                                    <?php echo $data_isi; ?>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-outline-primary" onclick="history.back()">Kembali ke Beranda</a>
                                </div>
                            </section>
                            <?php
                        }
                    } else {
                        echo "<p>Artikel tidak ditemukan.</p>";
                    }
                    ?>
                </article>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Pencarian</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Masukkan kata kunci..."
                                aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Cari!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Artikel Terkait</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="list-group">
                                    <?php
                                    $data_id_kontributor = $_GET['id'];
                                    $data_id_kategori = $_GET['id_kategori'];
                                    $sql = "SELECT 
                            kontributor.id AS id_kontributor,
                            kontributor.id_kategori,
                            artikel.date,
                            artikel.title,
                            artikel.content,
                            penulis.username,
                            kategori.name,
                            kategori.id,
                            artikel.picture
                        FROM 
                            kontributor
                        JOIN 
                            artikel ON kontributor.id_artikel = artikel.id
                        JOIN 
                            penulis ON kontributor.id_penulis = penulis.id
                        JOIN 
                            kategori ON kontributor.id_kategori = kategori.id
                            where kontributor.id_kategori = '$data_id_kategori' AND kontributor.id < '$data_id_kontributor'
                            ORDER BY id_kontributor DESC";
                                    $result = mysqli_query($koneksi, $sql);
                                    $nomor_urut = 0;
                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nomor_urut++;
                                            $data_tanggal = $row['date'];
                                            $data_judul = $row['title'];
                                            $data_kategori = $row['name'];
                                            $data_penulis = $row['username'];
                                            $data_gambar = $row['picture'];
                                            $data_id_kontributor = $row['id_kontributor'];
                                            $data_idkategori = $row['id'];
                                            $data_isi = $row['content'];
                                            ?>
                                            <a href="detail.php?id=<?php echo $data_id_kontributor; ?>&id_kategori=<?php echo $data_idkategori; ?>" class="list-group-item list-group-item-action"><?php echo $data_judul; ?></a>
                                            <?php
                                        }
                                    } else {
                                        echo "<p>Tidak ada artikel terkait.</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Mengukir Jejak 2025</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>