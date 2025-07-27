<?php
session_set_cookie_params([
    'lifetime' => 3600,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
ini_set('session.gc_maxlifetime', 3600);
session_start();

session_regenerate_id(true);

if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['last_activity'] = time();
} elseif ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    exit("Sesión comprometida.");
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 3600) {
    session_unset();
    session_destroy();
    exit("Sesión expirada por inactividad.");
}
$_SESSION['last_activity'] = time();

// Procesar login (simulado)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if ($usuario === "admin" && $clave === "prueba2025") {
        $_SESSION["usuario"] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o clave incorrectos";
    }
}
?>
