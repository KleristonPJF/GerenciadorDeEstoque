<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../PUBLICO/Login.html');
    exit;
}
?>