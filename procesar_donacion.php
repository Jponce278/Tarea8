<?php
// Simulación de procesamiento de donación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = htmlspecialchars($_POST["monto"]);
    $email = htmlspecialchars($_POST["email"]);
    $nombre = !empty($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : "Donante Anónimo";
    $contacto = isset($_POST["contacto"]) ? "Sí" : "No";

    // simulamos un tiempo de espera
    sleep(3);

    // simulamos éxito

    $donacion_exitosa = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu donación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 2rem;
            text-align: center;
        }
        .mensaje {
            background-color: #e6ffe6;
            border: 1px solid #9fd89f;
            border-radius: 10px;
            padding: 1.5rem;
            display: inline-block;
            max-width: 500px;
        }
        .mensaje h2 {
            color: #2d702d;
        }
        .mensaje p {
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
<?php if (isset($donacion_exitosa) && $donacion_exitosa): ?>
    <div class="mensaje">
        <h2>¡Gracias por tu donación!</h2>
        <p><strong>Nombre:</strong> <?= $nombre ?></p>
        <p><strong>Monto:</strong> $<?= $monto ?> CLP</p>
        <p><strong>Correo:</strong> <?= $email ?></p>
        <p><strong>Desea recibir noticias:</strong> <?= $contacto ?></p>
        <p>Tu aporte es fundamental para continuar con nuestra labor.</p>
        <br>
        <a href="index.php">Volver a la página principal</a>
    </div>
<?php else: ?>
    <p>Hubo un problema con tu donación. Intenta nuevamente.</p>
<?php endif; ?>
</body>
</html>
