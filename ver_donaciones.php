<?php
require_once "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Donaciones</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body { background: #f0f4f8; font-family: Arial, sans-serif; padding: 20px; }
    h2 { color: #1260a0; margin-top: 30px; }
    table { border-collapse: collapse; width: 90%; margin: auto; background: #fff; }
    th, td { border: 1px solid #b0c4de; padding: 10px 8px; text-align: left; }
    th { background: #cbe1fa; }
    tr:nth-child(even) { background: #f4faff; }
  </style>
</head>
<body>
  <h2>Consulta Simple: Lista de Donaciones</h2>
  <table>
    <tr>
      <th>ID Donación</th>
      <th>Monto</th>
      <th>Fecha</th>
      <th>ID Proyecto</th>
      <th>ID Donante</th>
    </tr>
    <?php
    
    $sql_simple = "SELECT * FROM donacion";
    $res_simple = $conn->query($sql_simple);
    while ($row = $res_simple->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id_donacion'] ?></td>
        <td>$<?= number_format($row['monto'], 0, ',', '.') ?></td>
        <td><?= htmlspecialchars($row['fecha']) ?></td>
        <td><?= $row['id_proyecto'] ?></td>
        <td><?= $row['id_donante'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <div style="margin-top: 40px;">
  <a href="index.php" style="
      display: inline-block;
      padding: 10px 30px;
      background: #00796b;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      font-size: 1.1em;
      font-weight: bold;
      transition: background 0.3s;
      box-shadow: 0 2px 5px rgba(0,0,0,0.07);
    " onmouseover="this.style.background='#004d40'" onmouseout="this.style.background='#00796b'">
    ← Volver al inicio
  </a>
</div>
</body>
</html>
