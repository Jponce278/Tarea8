<?php
require_once "conexion.php";

$query = "SELECT 
            p.nombre AS nombre_proyecto, 
            COUNT(d.id_donacion) AS total_donaciones, 
            SUM(d.monto) AS monto_total
          FROM donacion d
          JOIN proyecto p ON d.id_proyecto = p.id
          GROUP BY p.id
          HAVING total_donaciones > 2";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta Avanzada de Donaciones</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 36px;
            box-shadow: 0 4px 32px rgba(33, 150, 243, 0.07);
        }
        h2 {
            color: #1565c0;
            margin-bottom: 25px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #f8f9fa;
            margin-top: 20px;
        }
        th, td {
            padding: 14px;
            text-align: left;
        }
        th {
            background: #bbdefb;
            color: #0d47a1;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background: #e3f2fd;
        }
        tr:hover {
            background: #c8e6fc;
        }
        .volver {
            margin: 30px 0 0 0;
            display: flex;
            justify-content: center;
        }
        .btn {
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 22px;
            font-size: 16px;
            text-decoration: none;
            transition: background 0.3s;
            cursor: pointer;
        }
        .btn:hover {
            background: #0d47a1;
        }
        @media (max-width: 700px) {
            .container { padding: 10px; }
            th, td { padding: 6px; font-size: 14px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Proyectos con más de dos donaciones</h2>
        <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Nombre Proyecto</th>
                <th>Número de Donaciones</th>
                <th>Monto Total Recaudado</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre_proyecto']) ?></td>
                <td><?= $row['total_donaciones'] ?></td>
                <td>$<?= number_format($row['monto_total'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p style="text-align:center;">No hay proyectos con más de dos donaciones.</p>
        <?php endif; ?>
        <div class="volver">
            <a href="index.php" class="btn">← Volver al inicio</a>
        </div>
    </div>
</body>
</html>
