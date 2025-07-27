<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST["descripcion"];
    $tipo = $_POST["tipo"];
    $lugar = $_POST["lugar"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $estado = $_POST["estado"] ?? "Activo";

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Evento Registrado</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f9ff;
                padding: 2rem;
                text-align: center;
            }
            .resultado {
                background-color: #e6ffe6;
                border: 1px solid #9fd89f;
                border-radius: 10px;
                padding: 1.5rem;
                display: inline-block;
                max-width: 500px;
                text-align: left;
            }
            .resultado h2 {
                color: #2d702d;
                margin-bottom: 1rem;
            }
            .resultado p {
                margin: 0.4rem 0;
            }
            a {
                display: inline-block;
                margin-top: 1.5rem;
                text-decoration: none;
                color: #005fa3;
            }
        </style>
    </head>
    <body>
        <div class='resultado'>
            <h2>Evento registrado exitosamente</h2>
            <p><strong>Descripción:</strong> $descripcion</p>
            <p><strong>Tipo:</strong> $tipo</p>
            <p><strong>Lugar:</strong> $lugar</p>
            <p><strong>Fecha:</strong> $fecha</p>
            <p><strong>Hora:</strong> $hora</p>
            <p><strong>Estado:</strong> $estado</p>
            <a href='index.php'>Volver a la página principal</a>
        </div>
    </body>
    </html>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Evento</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image:url(img/manos.png);
      background-size: cover;
      background-position: center center;
      background-attachment: fixed;
    }

    .formulario-evento {
      max-width: 500px;
      margin: auto;
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .formulario-evento h2 {
      text-align: center;
      color: #005fa3;
      margin-bottom: 1.5rem;
    }
    .formulario-evento label {
      display: block;
      margin-bottom: 0.3rem;
      font-weight: bold;
    }
    .formulario-evento input,
    .formulario-evento select {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .formulario-evento button {
      width: 100%;
      padding: 0.7rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }
    .formulario-evento button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <form method="POST" action="registrar_evento.php" class="formulario-evento">
    <h2>Registrar Nuevo Evento</h2>

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" id="descripcion" required>

    <label for="tipo">Tipo:</label>
    <input type="text" name="tipo" id="tipo" required>

    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" id="lugar" required>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" id="hora" required>

    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
      <option value="Activo">Activo</option>
      <option value="Finalizado">Finalizado</option>
    </select>

    <button type="submit">Registrar Evento</button>
  </form>
</body>
</html>
