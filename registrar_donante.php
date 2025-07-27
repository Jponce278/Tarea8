<?php
require_once "conexion.php";
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO donante (nombre, email, direccion, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $direccion, $telefono);

    if ($stmt->execute()) {
        echo "Donante registrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Donante</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .formulario-box { max-width: 500px; margin: 2rem auto; background: #fff; border-radius: 12px; box-shadow: 0 0 12px #bbb; padding: 2rem; }
    .formulario-box label { display: block; margin: 10px 0 5px; font-weight: bold; }
    .formulario-box input { width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
    .formulario-box button { margin-top: 12px; background: #1976d2; color: #fff; border: none; border-radius: 6px; padding: 10px 18px; font-size: 16px; cursor: pointer; }
    .mensaje { text-align: center; margin: 10px 0; color: #1976d2; }
  </style>
</head>
<body>
  <div class="formulario-box">
    <h2>Registrar Donante</h2>
    <?php if ($mensaje): ?><div class="mensaje"><?= $mensaje ?></div><?php endif; ?>
    <form action="registrar_donante.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Dirección:</label>
        <input type="text" name="direccion" required><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br>
        <button type="submit">Registrar Donante</button>
    </form>
  </div>
  <script>
    function validarDonante() {
      return document.getElementById('nombre').value.trim() &&
        document.getElementById('correo').value.trim() &&
        document.getElementById('telefono').value.trim();
    }
  </script>
</body>
</html>
