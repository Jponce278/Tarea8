<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
if (empty($carrito)) {
  header("Location: ver_carrito.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Pago - Manos Solidarias</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .formulario-pago {
      max-width: 600px;
      margin: 2rem auto;
      padding: 2rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .formulario-pago h2 {
      text-align: center;
      margin-bottom: 1rem;
    }
    .formulario-pago label {
      display: block;
      margin: 10px 0 5px;
    }
    .formulario-pago input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
    }
    .formulario-pago button {
      background-color: #1976d2;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: block;
      width: 100%;
    }
    .formulario-pago button:hover {
      background-color: #1565c0;
    }
  </style>
</head>
<body>
  <div class="formulario-pago">
    <h2>Formulario de Pago</h2>
    <form action="procesar_pago.php" method="POST">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" required>

      <label for="apellido">Apellido</label>
      <input type="text" name="apellido" required>

      <label for="direccion">Dirección</label>
      <input type="text" name="direccion" required>

      <label for="telefono">Teléfono</label>
      <input type="text" name="telefono" required>

      <label for="correo">Correo electrónico</label>
      <input type="email" name="correo" required>

      <label for="tarjeta">Número de tarjeta</label>
      <input type="text" name="tarjeta" required pattern="\d{13,16}" title="Ingrese entre 13 y 16 dígitos">

      <label for="cvv">CVV</label>
      <input type="text" name="cvv" required pattern="\d{3}" title="3 dígitos">

      <label for="expiracion">Fecha de expiración</label>
      <input type="month" name="expiracion" required min="<?= date('Y-m') ?>">

      <button type="submit">Confirmar Donación</button>
    </form>
  </div>
</body>
</html>
