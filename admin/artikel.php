<?php
require 'function.php';
require 'ceksession.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - Kelola Konten</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.css" />
  <style>
    .ck-editor__editable[role="textbox"] {
      min-height: 300px;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">Menu Utama</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Dashboard
            </a>
            <a class="nav-link" href="artikel.php">
              <div class="sb-nav-link-icon">
                <i class="bi bi-file-earmark-text-fill"></i>
              </div>
              Artikel
            </a>
            <a class="nav-link" href="kategori.php">
              <div class="sb-nav-link-icon">
                <i class="bi bi-bookmark-check-fill"></i>
              </div>
              Kategori
            </a>
            <a class="nav-link" href="penulis.php">
              <div class="sb-nav-link-icon">
                <i class="bi bi-person-fill"></i>
              </div>
              Penulis
            </a>
            <a class="nav-link" href="logout.php">
              <div class="sb-nav-link-icon">
                <i class="bi bi-door-closed-fill"></i>
              </div>
              Logout
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          <?php echo $_SESSION['email']; ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Artikel</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Silakan kelola artikel</li>
          </ol>
          <div class="card mb-4">
            <div class="card-header">
              <i class="bi bi-file-earmark-text-fill"></i>
              <button class="btn btn-primary" name="btn_artikel_baru" id="btn_artikel_baru" data-bs-toggle="modal"
                data-bs-target="#modalFormArtikel">Artikel Baru</button>
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT 
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

                      <tr>
                        <td><?php echo $nomor_urut ?></td>
                        <td><?php echo $data_tanggal ?></td>
                        <td><?php echo $data_judul ?></td>
                        <td><?php echo $data_kategori ?></td>
                        <td><?php echo $data_penulis ?></td>
                        <td><?php echo $data_gambar ?></td>
                        <td>
                          <button class="btn btn-warning btn-sm" name="btn_ubah" data-bs-toggle="modal"
                            data-bs-target="#modalUbahArtikel<?php echo $data_id_kontributor; ?>">Ubah</button>
                          <button class="btn btn-danger btn-sm" name="btn_hapus" data-bs-toggle="modal"
                            data-bs-target="#modalHapusArtikel<?php echo $data_id_kontributor; ?>">Hapus</button>
                        </td>
                      </tr>
                      <!-- Modal Hapus Artikel -->
                      <div class="modal fade" id="modalHapusArtikel<?php echo $data_id_kontributor; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Hapus Data</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form method="post">
                              <div class="modal-body mb-3">
                                Apakah Anda yakin ingin menghapus artikel <strong><?php echo $data_judul; ?></strong>
                                <div class="mt-3 mb-3 d-flex justify-content-end gap-2">
                                  <button class="btn btn-danger" name="btn_hapus_artikel">Hapus</button>
                                  <input type="hidden" name="id_hapus_artikel" value="<?php echo $data_id_kontributor; ?>">
                                  <button class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>

                      <!-- Modal Ubah Artikel -->
                      <div class="modal fade" data-bs-backdrop="static"
                        id="modalUbahArtikel<?php echo $data_id_kontributor; ?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Ubah Artikel</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Ubah Artikel -->
                            <div class="modal-body">
                              <form method="post" enctype="multipart/form-data">
                                <div class="mb-3 mt-3">
                                  <label for="tanggal" class="form-label">Tanggal:</label>
                                  <input type="text" class="form-control" id="tanggal" name="tanggal"
                                    value="<?php echo $data_tanggal; ?>" readonly>
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="judul" class="form-label">Judul:</label>
                                  <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul"
                                    name="judul" value="<?php echo $data_judul; ?>">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="kategori" class="form-label">Pilih Kategori:</label>
                                  <select class="form-select" id="kategori" name="kategori">
                                    <?php
                                    $sql = "SELECT id, name FROM kategori";
                                    $result_kategori = mysqli_query($koneksi, $sql);
                                    if (mysqli_num_rows($result_kategori) > 0) {
                                      while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                                        $data_id_kategori = $row_kategori['id'];
                                        $data_nama_kategori = $row_kategori['name'];

                                        ?>
                                        <option value="<?php echo $data_id_kategori; ?>"><?php echo $data_nama_kategori; ?>
                                        </option>
                                        <?php
                                      }
                                    } else {
                                      echo "0 results";
                                    }
                                    ?>
                                    <option value="<?php echo $data_idkategori; ?>" selected><?php echo $data_kategori; ?>
                                    </option>
                                  </select>
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="comment">Isi:</label>
                                  <textarea class="form-control" rows="5" id="ubah_isi" name="isi"><?php echo $data_isi ?></textarea>
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="gambar" class="form-label">Gambar:</label>
                                  <input class="form-control" type="file" id="gambar" name="gambar">
                                </div>
                                <div>
                                  <input type="hidden" name="id_kontributor_update" value="<?php echo $data_id_kontributor; ?>">
                                </div>
                                <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                                  <button class="btn btn-primary" name="btn_ubah_artikel">Ubah</button>
                                  <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php
                    }
                  } else {
                    echo "0 results";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your anjauyuy 2025</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
  <!-- Modal Form Artikel -->
  <div class="modal fade" data-bs-backdrop="static" id="modalFormArtikel">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Artikel</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal Form Artikel -->
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data">
            <?php
            date_default_timezone_set("Asia/Jakarta");
            $hari = date("l");
            $hari_indonesia = hariIndonesia($hari);
            $bulan = date("F");
            $bulan_indonesia = bulanIndonesia($bulan);
            $tanggal = date("d");
            $tahun = date("Y");
            $jam = date("H:i");
            $tanggal_sekarang = $hari_indonesia . ", " . $tanggal . " " . $bulan_indonesia . " " . $tahun . " | " . $jam;
            ?>
            <div class="mb-3 mt-3">
              <label for="tanggal" class="form-label">Tanggal:</label>
              <input type="text" class="form-control" id="tanggal" name="tanggal"
                value="<?php echo $tanggal_sekarang; ?>" readonly>
            </div>
            <div class="mb-3 mt-3">
              <label for="judul" class="form-label">Judul:</label>
              <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul" name="judul">
            </div>
            <div class="mb-3 mt-3">
              <label for="kategori" class="form-label">Pilih Kategori:</label>
              <select class="form-select" id="kategori" name="kategori">
                <?php
                $sql_kategori = "SELECT id, name FROM kategori";
                $hasil = mysqli_query($koneksi, $sql_kategori);
                if (mysqli_num_rows($hasil) > 0) {
                  while ($row = mysqli_fetch_assoc($hasil)) {
                    $data_id_kategori = $row['id'];
                    $data_nama_kategori = $row['name'];

                    ?>
                    <option value="<?php echo $data_id_kategori; ?>"><?php echo $data_nama_kategori; ?></option>
                    <?php
                  }
                } else {
                  echo "0 results";
                }
                ?>
              </select>
            </div>
            <div class="mb-3 mt-3">
              <label for="comment">Isi:</label>
              <textarea class="form-control" rows="5" id="isi" name="isi"></textarea>
            </div>
            <div class="mb-3 mt-3">
              <label for="gambar" class="form-label">Gambar:</label>
              <input class="form-control" type="file" id="gambar" name="gambar">
            </div>
            <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
              <button class="btn btn-primary" name="btn_simpan">Simpan</button>
              <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>

  <script>
    const {
      ClassicEditor,
      Essentials,
      Bold,
      Italic,
      Font,
      Paragraph
    } = CKEDITOR;

    ClassicEditor
      .create(document.querySelector('#isi'), {
        licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Nzk0OTQzOTksImp0aSI6ImI3YmRlZTRhLTBmYWUtNDgyZC1iMDM3LTFiMGY5NTU2MjkxNSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJ2YyI6ImM4MjUxM2U2In0.ncu3bAkKrGZ_2mnAJOlWFk6ykBbipeleuY3gowo0dN_AYvvqoCtcXHhgfECGjehMT-rflTpXv1YgeAxUJKTpZA',
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: [
          'undo', 'redo', '|', 'bold', 'italic', '|',
          'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        ]
      })
      .then( /* ... */)
      .catch( /* ... */);
  </script>

  <script>
    ClassicEditor
      .create(document.querySelector('#ubah_isi'), {
        licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Nzk0OTQzOTksImp0aSI6ImI3YmRlZTRhLTBmYWUtNDgyZC1iMDM3LTFiMGY5NTU2MjkxNSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJ2YyI6ImM4MjUxM2U2In0.ncu3bAkKrGZ_2mnAJOlWFk6ykBbipeleuY3gowo0dN_AYvvqoCtcXHhgfECGjehMT-rflTpXv1YgeAxUJKTpZA',
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: [
          'undo', 'redo', '|', 'bold', 'italic', '|',
          'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        ]
      })
      .then( /* ... */)
      .catch( /* ... */);
  </script>
</body>

</html>