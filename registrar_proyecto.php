<?php
require_once "conexion.php";

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $responsable = trim($_POST["responsable"] ?? "");

    if ($nombre && $descripcion && $responsable) {
        $stmt = $conn->prepare("INSERT INTO proyecto (nombre, descripcion, responsable) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $descripcion, $responsable);
        $stmt->execute();
        $mensaje = "Proyecto registrado exitosamente.";
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Proyecto</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .formulario-box { max-width: 500px; margin: 2rem auto; background: #fff; border-radius: 12px; box-shadow: 0 0 12px #bbb; padding: 2rem; }
    .formulario-box label { display: block; margin: 10px 0 5px; font-weight: bold; }
    .formulario-box input, .formulario-box textarea { width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
    .formulario-box button { margin-top: 12px; background: #1976d2; color: #fff; border: none; border-radius: 6px; padding: 10px 18px; font-size: 16px; cursor: pointer; }
    .mensaje { text-align: center; margin: 10px 0; color: #1976d2; }
  </style>
</head>
<body>
  <div class="formulario-box">
    <h2>Registrar Proyecto</h2>
    <?php if ($mensaje): ?><div class="mensaje"><?= $mensaje ?></div><?php endif; ?>
    <form method="POST" onsubmit="return validarProyecto()">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" required>
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" rows="3" required></textarea>
      <label for="responsable">Responsable:</label>
      <input type="text" name="responsable" id="responsable" required>
      <button type="submit">Agregar Proyecto</button>
    </form>
  </div>
  <script>
    function validarProyecto() {
      // Validación sencilla en JS
      return document.getElementById('nombre').value.trim() &&
        document.getElementById('descripcion').value.trim() &&
        document.getElementById('responsable').value.trim();
    }
  </script>
</body>
</html>
