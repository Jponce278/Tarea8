<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
  header("Location: index.php");
  exit;
}

$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';

unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gracias por tu donación</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .agradecimiento {
      max-width: 600px;
      margin: 2rem auto;
      background: #e8f5e9;
      padding: 2rem;
      border-radius: 10px;
      text-align: center;
    }
    .agradecimiento ul {
      text-align: left;
      margin-top: 1rem;
    }
    .btn-volver {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #388e3c;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }
    .btn-volver:hover {
      background-color: #2e7d32;
    }
  </style>
</head>
<body>
  <div class="agradecimiento">
    <h2>🎉 ¡Gracias por apoyar nuestras campañas, <?= htmlspecialchars($nombre) ?>!</h2>
    <p>Has donado a las siguientes campañas:</p>
    <ul>
      <?php foreach ($carrito as $item): ?>
        <li><?= htmlspecialchars($item['descripcion']) ?> - $<?= number_format($item['monto'], 0, ',', '.') ?></li>
      <?php endforeach; ?>
    </ul>
    <a href="index.php" class="btn-volver">← Volver al Inicio</a>
  </div>
</body>
</html>
