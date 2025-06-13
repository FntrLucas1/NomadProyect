<?php
$servername = "localhost";
$username = "usuario";
$password = "contraseña";
$dbname = "trekking_outdoor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>