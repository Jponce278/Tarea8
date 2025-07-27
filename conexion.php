<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$database = 'organizacion';

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
