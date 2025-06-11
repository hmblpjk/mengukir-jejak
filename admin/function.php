<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_blog";
$koneksi = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['btn_login'])) {
    $data_email = $_POST['email'];
    $data_password = md5($_POST['password']);
    $query = "SELECT * FROM penulis WHERE email='$data_email' AND password='$data_password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['idpenulis'] = $row['id'];
        }
    } else {
        echo "<script>alert('Email atau password salah!');</script>";
    }
    $_SESSION['email'] = $data_email;
    $_SESSION['password'] = $data_password;
    header("Location: index.php");
}

// Artikel Functions
if (isset($_POST['btn_hapus_artikel'])) {
    $id_hapus = $_POST['id_hapus_artikel'];
    // sql to delete a record
    $sql_hapus_artikel = "DELETE FROM artikel WHERE id IN (SELECT id_artikel FROM kontributor WHERE id = '$id_hapus')";
    $sql_hapus_kontributor = "DELETE FROM kontributor WHERE id = '$id_hapus'";
    if (mysqli_query($koneksi, $sql_hapus_artikel)) {
        if (mysqli_query($koneksi, $sql_hapus_kontributor)) {
            header("Location: artikel.php");
        } else {
            echo "Error deleting record: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['btn_simpan'])) {
    $target_dir = "gambar/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $data_tanggal = $_POST['tanggal'];
    $data_judul = $_POST['judul'];
    $data_isi = $_POST['isi'];
    $data_kategori = $_POST['kategori'];
    $data_gambar = $target_file;

    $sql = "INSERT INTO artikel (date, title, content, picture) VALUES ('$data_tanggal', '$data_judul', '$data_isi', '$data_gambar')";

    // Change $conn to $koneksi here
    if ($koneksi->query($sql) === TRUE) {
        $sql = "SELECT * FROM artikel ORDER BY id DESC LIMIT 1";
        // Change $conn to $koneksi here
        $result = mysqli_query($koneksi, $sql);
        $data_id_artikel = "";
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $data_id_artikel = $row['id'];
            }
        } else {
            echo "0 results";
        }
        $data_id_penulis = $_SESSION['idpenulis'];
        $sql = "INSERT INTO kontributor (id_penulis, id_kategori, id_artikel) VALUES ('$data_id_penulis', '$data_kategori', '$data_id_artikel')";

        // Change $conn to $koneksi here
        if ($koneksi->query($sql) === TRUE) {
            header("Location: artikel.php");
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        // You might want to add an error message here for the first query failure as well
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_POST['btn_ubah_artikel'])) {
    $target_dir = "gambar/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

   $data_tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $data_judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $data_isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $data_kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $data_gambar = mysqli_real_escape_string($koneksi, $target_file);
    $id_update = mysqli_real_escape_string($koneksi, $_POST['id_kontributor_update']);

    $sql_update_artikel = "UPDATE artikel SET title = '$data_judul', content = '$data_isi', picture = '$data_gambar' WHERE id = (SELECT id_artikel FROM kontributor WHERE id = '$id_update')";
    $sql_update_kontributor = "UPDATE kontributor SET id_kategori = '$data_kategori' WHERE id = '$id_update'";

    if (mysqli_query($koneksi, $sql_update_artikel)) {
        if (mysqli_query($koneksi, $sql_update_kontributor)) {
            header("Location: artikel.php");
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}


// Kategori Functions
if (isset($_POST['btn_simpan_kategori'])) {
    $data_nama = $_POST['nama'];
    $data_keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO kategori (name, description) VALUES ('$data_nama', '$data_keterangan')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: kategori.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_POST['btn_ubah_kategori'])) {
    $data_nama = $_POST['nama'];
    $data_keterangan = $_POST['keterangan'];
    $data_id_kategori = $_POST['id_kategori'];

    $sql = "UPDATE kategori SET name = '$data_nama', description = '$data_keterangan' WHERE id = '$data_id_kategori'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: kategori.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_POST['btn_hapus_kategori'])) {
    $data_id_kategori = $_POST['id_hapus_kategori'];

    $sql = "DELETE FROM kategori WHERE id = '$data_id_kategori'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: kategori.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}


// Penulis Functions
if (isset($_POST['btn_simpan_penulis'])) {
    $data_nama = $_POST['nama'];
    $data_email = $_POST['email'];
    $data_password = md5($_POST['password']);

    $sql = "INSERT INTO penulis (username, email, password) VALUES ('$data_nama', '$data_email', '$data_password')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: penulis.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_POST['btn_ubah_penulis'])) {
    $data_nama = $_POST['nama'];
    $data_email = $_POST['email'];
    $data_password = md5($_POST['password']);
    $data_id_penulis = $_POST['id_penulis_update'];


    $sql = "UPDATE penulis SET username = '$data_nama', email = '$data_email', password = '$data_password' WHERE id = '$data_id_penulis'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: penulis.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_POST['btn_hapus_penulis'])) {
    $data_id_penulis = $_POST['id_hapus_penulis'];

    $sql_get_artikel = "SELECT id_artikel FROM kontributor WHERE id_penulis = '$data_id_penulis'";
    $result_artikel = mysqli_query($koneksi, $sql_get_artikel);
    if ($result_artikel) {
        while ($row_artikel = mysqli_fetch_assoc($result_artikel)) {
            $id_artikel = $row_artikel['id_artikel'];
            // Hapus artikel
            $sql_delete_artikel = "DELETE FROM artikel WHERE id = '$id_artikel'";
            mysqli_query($koneksi, $sql_delete_artikel);
        }
    }
    
    $sql_delete_kontributor = "DELETE FROM kontributor WHERE id_penulis = '$data_id_penulis'";
    mysqli_query($koneksi, $sql_delete_kontributor);

    $sql = "DELETE FROM penulis WHERE id = '$data_id_penulis'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: penulis.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

function potong_artikel($isi_artikel, $jml_karakter) {
    while($isi_artikel[$jml_karakter] != " ") {
        $jml_karakter--;
    }
    $potongan_isi_artikel = substr($isi_artikel, 0, $jml_karakter);
    $isi_artikel_terpotong = $potongan_isi_artikel . "...";
    return $isi_artikel_terpotong;
}


function hariIndonesia($namaHari)
{
    $hari = $namaHari;
    switch ($hari) {
        case 'Sunday':
            $hari = "Minggu";
            return $hari;
            break;
        case 'Monday':
            $hari = "Senin";
            return $hari;
            break;
        case 'Tuesday':
            $hari = "Selasa";
            return $hari;
            break;
        case 'Wednesday':
            $hari = "Rabu";
            return $hari;
            break;
        case 'Thursday':
            $hari = "Kamis";
            return $hari;
            break;
        case 'Friday':
            $hari = "Jumat";
            return $hari;
            break;
        case 'Saturday':
            $hari = "Sabtu";
            return $hari;
            break;
    }
}

function bulanIndonesia($namaBulan)
{
    $bulan = $namaBulan;
    switch ($bulan) {
        case 'January':
            $bulan = "Januari";
            return $bulan;
            break;
        case 'February':
            $bulan = "Februari";
            return $bulan;
            break;
        case 'March':
            $bulan = "Maret";
            return $bulan;
            break;
        case 'April':
            $bulan = "April";
            return $bulan;
            break;
        case 'May':
            $bulan = "Mei";
            return $bulan;
            break;
        case 'June':
            $bulan = "Juni";
            return $bulan;
            break;
        case 'July':
            $bulan = "Juli";
            return $bulan;
            break;
        case 'August':
            $bulan = "Agustus";
            return $bulan;
            break;
        case 'September':
            $bulan = "September";
            return $bulan;
            break;
        case 'October':
            $bulan = "Oktober";
            return $bulan;
            break;
        case 'November':
            $bulan = "November";
            return $bulan;
            break;
        case 'December':
            $bulan = "Desember";
            return $bulan;
            break;
    }
}
?>