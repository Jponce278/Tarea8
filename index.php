<?php
session_set_cookie_params([
  'lifetime' => 3600,
  'secure' => true,
  'httponly' => true,
  'samesite' => 'Strict'
]);
session_start();
include_once 'conexion.php';

if (!isset($_SESSION['user_agent'])) {
  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
  $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
  $_SESSION['last_activity'] = time();
} elseif ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
  session_unset();
  session_destroy();
  exit("Sesión comprometida.");
} elseif (time() - $_SESSION['last_activity'] > 3600) {
  session_unset();
  session_destroy();
}
$_SESSION['last_activity'] = time();

$logueado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manos Solidarias - Unidos por el Cambio</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <div class="login-bar">
    <?php if ($logueado): ?>
     <span>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> | <a href="logout.php">Cerrar sesión</a></span> | <a href="ver_carrito.php" class="btn-carrito">🛒 Ver Carrito</a>
    <?php else: ?>
      <form action="login.php" method="POST" class="form-login">
        <input type="text" name="usuario" placeholder="Usuario" required>
       <input type="password" name="clave" placeholder="Clave" required>
        <button type="submit">Iniciar Sesión</button> | <a href="ver_carrito.php" class="btn-carrito">🛒 Ver Carrito</a>
      </form>
    <?php endif; ?>
  </div>

  <header class="encabezado">
    <h1 class="titulo">Manos Solidarias - Unidos por el Cambio</h1>
    <p class="subtitulo">Organización sin fines de lucro</p>
    <nav class="nav-flex">
      <ul class="menu">
        <li><a href="#proyectos">Proyectos</a></li>
        <li><a href="#eventos">Eventos</a></li>
        <li><a href="#donaciones">Donaciones</a></li>
        <li><a href="#registro-evento">Registrar Evento</a></li>
        <li><a href="registrar_proyecto.php">Registrar Proyecto</a></li>
        <li><a href="registrar_donante.php">Registrar Donante</a></li>
        <li><a href="ver_tablas.php" class="btn">Ver proyectos y donantes</a></li>
        <li><a href="ver_donaciones.php">Ver Donaciones</a></li>
        <li><a href="consulta_avanzada_donaciones.php">Consulta Avanzada de Donaciones</a></li>
        <li><a href="#notificaciones">Notificaciones</a></li>
      </ul>
      <div class="search-bar">
        <input type="text" id="busqueda" placeholder="Buscar proyecto..." />
        <button onclick="buscarProyecto()">Buscar</button>
      </div>
    </nav>

  </header>

  <section id="proyectos">
    <h2>Proyectos Actuales</h2>
    <div class="carousel-container">
      <button id="btn-prev" class="carousel-btn">←</button>
      <div id="carousel" class="carousel">
      </div>
      <button id="btn-next" class="carousel-btn">→</button>
    </div>
  </section>


  <section id="eventos">
    <h2>Eventos Actuales</h2>

    <div class="filtros-eventos">
      <form method="GET" action="#eventos">
        <select name="tipo">
          <option value="">Tipo de evento</option>
          <option value="Salud">Salud</option>
          <option value="Educativo">Educativo</option>
          <option value="Voluntariado">Voluntariado</option>
          <option value="Conferencia">Conferencia</option>
          <option value="Campaña Social">Campaña Social</option>
          <option value="Evento Cultural">Evento Cultural</option>
          <option value="Campaña Solidaria">Campaña Solidaria</option>
          <option value="Formación">Formación</option>
          <option value="Recreativo">Recreativo</option>
          <option value="Cultural">Cultural</option>
          <option value="Solidaridad">Solidaridad</option>
        </select>

        <input type="date" name="fecha" />

        <select name="orden">
          <option value="">Ordenar por...</option>
          <option value="reciente">Más reciente</option>
          <option value="antiguo">Más antiguo</option>
        </select>

        <button type="submit">Filtrar</button>
      </form>
    </div>

    <div id="results-container">
      <?php include 'eventos.php'; ?>
    </div>
  </section>


  <section id="donaciones">
    <h2>Realiza tu Donación</h2>

    <?php if (!$logueado): ?>
      <p style="color: #c00; font-weight: bold;">Por seguridad, se recomienda iniciar sesión antes de donar. Sin embargo, puedes continuar.</p>
    <?php endif; ?>

    <form action="procesar_donacion.php" method="POST">
      <label for="nombre">Nombre (opcional):</label>
      <input type="text" id="nombre" name="nombre" />

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" required />

      <label for="monto">Monto:</label>
      <input type="number" id="monto" name="monto" required />

      <label>
        <input type="checkbox" name="contacto" /> Deseo recibir noticias
      </label>

      <button type="submit">Donar</button>
    </form>

    <div class="formulario-donacion">
      <form action="agregar_carrito.php" method="POST" class="form-donacion">
        <label for="campania">Selecciona una campaña (evento):</label>
        <select name="descripcion" required>
          <option value="">Seleccione una campaña</option>
          <?php foreach ($eventos as $evento): ?>
            <option value="<?= htmlspecialchars($evento->descripcion) ?>">
              <?= htmlspecialchars($evento->descripcion) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <label for="monto">Monto a donar (opcional):</label>
        <input type="number" name="monto" id="monto" step="any" min="1" placeholder="Ej: 5000">

        <button type="submit">Apoyar campaña</button>
      </form>

      <p class="recomendacion">
        Puedes realizar una donación sin estar logueado, pero por seguridad se recomienda iniciar sesión.
      </p>
    </div>
  </section>

  <section id="registro">
    <h2>Registrar Nuevo Evento</h2>
    <a href="registrar_evento.php"><button>Ir al formulario</button></a>
  </section>

  <section id="notificaciones">
    <h2>Logros y Campañas</h2>
    <div id="notificaciones-container"></div>
  </section>

  <footer>
    <p>© 2025 Manos Solidarias - Todos los derechos reservados.</p>
  </footer>

  <script src="proyectos.js"></script>
  <script src="notificaciones.js"></script>
  <script src="donaciones.js"></script>
  <script src="busqueda.js"></script>
</body>
</html>
