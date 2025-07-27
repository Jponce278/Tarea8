<?php
require_once "conexion.php";
$proyectos = $conn->query("SELECT * FROM proyecto LIMIT 3");
$donantes = $conn->query("SELECT * FROM donante LIMIT 3");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proyectos y Donantes</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .tabla-box { max-width: 700px; margin: 2rem auto; background: #fff; border-radius: 10px; box-shadow: 0 0 10px #ccc; padding: 2rem; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 2rem; }
    th, td { padding: 10px; border-bottom: 1px solid #ccc; }
    th { background: #bbdefb; }
    h2 { color: #1976d2; }
  </style>
</head>
<body>
  <div class="tabla-box">
    <h2>Proyectos Registrados</h2>
    <table>
      <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Responsable</th></tr>
      <?php while ($row = $proyectos->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= htmlspecialchars($row["descripcion"]) ?></td>
          <td><?= htmlspecialchars($row["responsable"]) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <h2>Donantes Registrados</h2>
    <table>
      <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Dirección</th><th>Teléfono</th></tr>
      <?php while ($row = $donantes->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id_donante"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= htmlspecialchars($row["email"]) ?></td>
          <td><?= htmlspecialchars($row["direccion"]) ?></td>
          <td><?= htmlspecialchars($row["telefono"]) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
