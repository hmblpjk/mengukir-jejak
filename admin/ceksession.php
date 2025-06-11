<?php
session_start();
if (!isset($_SESSION['idpenulis'])) {
    header("Location: login.php");
    exit();
}
?>