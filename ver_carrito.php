<?php
session_start();

if (isset($_GET['eliminar'])) {
    $index = (int) $_GET['eliminar'];
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar
    }
    header("Location: ver_carrito.php");
    exit;
}

if (isset($_GET['vaciar'])) {
    unset($_SESSION['carrito']);
    header("Location: ver_carrito.php");
    exit;
}

$carrito = $_SESSION['carrito'] ?? [];
$total = array_sum(array_column($carrito, 'monto'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Donaciones - Manos Solidarias</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e3f2fd;
      margin: 0;
      padding: 20px;
    }

    .contenedor {
      max-width: 800px;
      margin: auto;
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #0d47a1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #bbdefb;
    }

    .acciones {
      margin-top: 30px;
      text-align: center;
    }

    .btn {
      display: inline-block;
      margin: 5px;
      padding: 10px 20px;
      background-color: #1976d2;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .btn:hover {
      background-color: #1565c0;
    }

    .btn-danger {
      background-color: #d32f2f;
    }

    .btn-danger:hover {
      background-color: #b71c1c;
    }

    .vacio {
      text-align: center;
      padding: 20px;
      font-style: italic;
      color: #666;
    }

    .eliminar {
      color: red;
      font-weight: bold;
      text-decoration: none;
    }

    .eliminar:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="contenedor">
    <h2>🛒 Carrito de Donaciones</h2>

    <?php if (empty($carrito)): ?>
      <p class="vacio">El carrito está vacío.</p>
      <div class="acciones">
        <a href="index.php" class="btn">← Volver al inicio</a>
      </div>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Campaña</th>
            <th>Monto (CLP)</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($carrito as $index => $item): ?>
            <tr>
              <?php
              $descripcion = isset($item['descripcion']) ? htmlspecialchars($item['descripcion']) : 'Campaña desconocida';
              $monto = isset($item['monto']) && is_numeric($item['monto']) ? floatval($item['monto']) : 0;
              ?>
              <td><?= $descripcion ?></td>
              <td>$<?= number_format($monto, 0, ',', '.') ?></td>
              <td><a class="eliminar" href="?eliminar=<?= $index ?>" onclick="return confirm('¿Eliminar esta donación?')">Eliminar</a></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <th>Total</th>
            <th>$<?= number_format($total, 0, ',', '.') ?></th>
            <td></td>
          </tr>
        </tbody>
      </table>

      <div class="acciones">
        <a href="?vaciar=1" class="btn btn-danger" onclick="return confirm('¿Vaciar todo el carrito?')">🗑 Vaciar Carrito</a>
        <a href="index.php" class="btn">← Volver al inicio</a>
        <a href="pagar.php" class="btn">💳 Ir a pagar</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
