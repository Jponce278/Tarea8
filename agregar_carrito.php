<?php
session_start();

$monto = $_POST['monto'] ?? 0;
$descripcion = $_POST['descripcion'] ?? "Campaña desconocida";

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$_SESSION['carrito'][] = [
    'descripcion' => htmlspecialchars($descripcion),
    'monto' => htmlspecialchars($monto)
];

header("Location: ver_carrito.php");
exit;
?>
