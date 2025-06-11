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
    <title>Home - Mengukir Jejak</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/logokecil.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style type="text/css">
        .tentang {
            text-align: justify;
        }

        .img-fixed-size {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
    </style>
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
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Selamat Datang di Mengukir jejak!</h1>
                <p class="lead mb-0">Kisah perjalanan, petualangan, dan setiap jejak bermakna. Mari berbagi cerita dan inspirasi!</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <?php
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
                            ORDER BY id_kontributor DESC limit 1";
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
                        $data_potongan_artikel = potong_artikel($data_isi, 250);

                        ?>
                        <div class="card mb-4">
                            <a
                                href="detail.php?id=<?php echo $data_id_kontributor; ?>&id_kategori=<?php echo $data_idkategori; ?>"><img
                                    class="card-img-top" src="admin/<?php echo $data_gambar; ?>" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $data_tanggal; ?></div>
                                <h2 class="card-title"><?php echo $data_judul; ?></h2>
                                <p class="card-text"><?php echo $data_potongan_artikel; ?></p>
                                <a class="btn btn-primary"
                                    href="detail.php?id=<?php echo $data_id_kontributor; ?>&id_kategori=<?php echo $data_idkategori; ?>">Selengkapnya
                                    →</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='alert alert-warning'>Tidak ada artikel yang ditemukan.</div>";
                }
                ?>

                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <?php
                    $sql_post = "SELECT 
                            kontributor.id AS id_kontributor,
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
                            where kontributor.id < (SELECT MAX(id) FROM kontributor)
                            ORDER BY kontributor.id DESC limit 6";
                    $result_post = mysqli_query($koneksi, $sql_post);
                    $nomor_urut = 0;
                    if (mysqli_num_rows($result_post) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result_post)) {
                            $nomor_urut++;
                            $data_tanggal = $row['date'];
                            $data_judul = $row['title'];
                            $data_kategori = $row['name'];
                            $data_penulis = $row['username'];
                            $data_gambar = $row['picture'];
                            $data_id_kontributor = $row['id_kontributor'];
                            $data_idkategori = $row['id'];
                            $data_isi = $row['content'];
                            $data_potongan_artikel = potong_artikel($data_isi, 250);
                            ?>
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a
                                        href="detail.php?id=<?php echo $data_id_kontributor; ?>&id_kategori=<?php echo $data_idkategori; ?>"><img
                                            class="card-img-top img-fixed-size" src="admin/<?php echo $data_gambar; ?>"
                                            alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?php echo $data_tanggal; ?></div>
                                        <h2 class="card-title h4"><?php echo $data_judul; ?></h2>
                                        <p class="card-text"><?php echo $data_potongan_artikel; ?></p>
                                        <a class="btn btn-primary"
                                            href="detail.php?id=<?php echo $data_id_kontributor; ?>&id_kategori=<?php echo $data_idkategori; ?>">Selengkapnya
                                            →</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Tidak ada artikel yang ditemukan.</div>";
                    }
                    ?>
                </div>
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
                <!-- Kategori widget-->
                <div class="card mb-4">
                    <div class="card-header">Kategori</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="list-group">
                                    <?php
                                    $sql = "SELECT * FROM kategori order by id desc";
                                    $result = mysqli_query($koneksi, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        $nomor_urut = 0;
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nomor_urut++;
                                            $data_id_kategori = $row['id'];
                                            $data_nama = $row['name'];
                                            $data_keterangan = $row['description'];
                                            ?>
                                            <a href="kategori.php?id_kategori=<?php echo $data_id_kategori; ?>"
                                                class="list-group-item list-group-item-action"><?php echo $data_nama; ?></a>
                                            <?php
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning'>Tidak ada kategori yang ditemukan.</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Tentang</div>
                    <div class="card-body tentang">Berbagi kisah perjalanan, petualangan baru, dan refleksi tentang
                        kehidupan. Ikuti setiap langkah kami, temukan inspirasi, dan mari bersama mengukir jejak
                        berharga di setiap fase hidup. Silakan <a href="#!">hubungi kami</a> jika ada pertanyaan.</div>
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