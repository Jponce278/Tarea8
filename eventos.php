<?php
class Evento {
    public $descripcion;
    public $tipo;
    public $lugar;
    public $fecha;
    public $hora;
    public $estado;

    public function __construct($descripcion, $tipo, $lugar, $fecha, $hora, $estado = "Activo") {
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->lugar = $lugar;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
    }

    public function mostrarEvento() {
        $color = (strtolower($this->estado) === "finalizado") ? "#ffe6e6" : "#e6f7ff";

        return "
        <div style='
            background-color: $color;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 1rem;
            margin: 10px;
            max-width: 300px;
            display: inline-block;
            vertical-align: top;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);'>
            <h3>{$this->descripcion}</h3>
            <p><strong>Tipo:</strong> {$this->tipo}</p>
            <p><strong>Lugar:</strong> {$this->lugar}</p>
            <p><strong>Fecha:</strong> {$this->fecha}</p>
            <p><strong>Hora:</strong> {$this->hora}</p>
            <p><em>Estado: {$this->estado}</em></p>
        </div>
        ";
    }
}


// Lista de eventos
$eventos = [
    new Evento("Recolección de alimentos para familias vulnerables", "Campaña Social", "Centro Comunitario", "2025-07-10", "10:00"),
    new Evento("Taller de reciclaje para niños", "Educativo", "Escuela Los Robles", "2025-08-15", "14:30"),
    new Evento("Jornada de limpieza de playas", "Voluntariado", "Playa Blanca", "2025-09-05", "09:00"),
    new Evento("Charla de derechos humanos", "Conferencia", "Teatro Municipal", "2025-10-20", "18:00"),
    new Evento("Festival solidario con música en vivo", "Evento Cultural", "Plaza Central", "2025-11-11", "16:00"),
    new Evento("Recolección de alimentos para familias vulnerables", "Campaña Social", "Centro Comunitario", "2025-07-10", "10:00"),
    new Evento("Jornada de limpieza ambiental", "Voluntariado", "Parque Central", "2025-07-12", "09:00"),
    new Evento("Taller de cocina saludable", "Educativo", "Sede Vecinal", "2025-07-14", "15:00"),
    new Evento("Feria de salud gratuita", "Salud", "Plaza de Armas", "2025-07-16", "11:00"),
    new Evento("Recolección de ropa de invierno", "Campaña Solidaria", "Centro Comunitario", "2025-07-18", "10:00"),
    new Evento("Actividad recreativa con niños", "Recreativo", "Escuela N°12", "2025-07-20", "14:30"),
    new Evento("Capacitación en primeros auxilios", "Formación", "Cruz Roja", "2025-07-22", "16:00"),
    new Evento("Taller de reciclaje", "Educativo", "Biblioteca Pública", "2025-07-24", "17:00"),
    new Evento("Campaña de donación de sangre", "Salud", "Hospital Local", "2025-07-26", "08:00"),
    new Evento("Taller de inserción laboral", "Educativo", "Sede Social", "2025-07-28", "13:00"),
    new Evento("Festival comunitario", "Cultural", "Parque Municipal", "2025-07-30", "18:00"),
    new Evento("Entrega de kits escolares", "Social", "Centro Comunitario", "2025-08-01", "10:00"),
    new Evento("Charlas sobre salud mental", "Salud", "Centro de Salud Familiar", "2025-08-03", "11:00"),
    new Evento("Cierre de campaña de invierno", "Campaña", "Salón Comunal", "2025-06-10", "12:00", "Finalizado"),
    new Evento("Entrega de alimentos navideños", "Solidaridad", "Iglesia Santa María", "2024-12-20", "09:30", "Finalizado")
];

// ----- Filtros -----
$tipo = isset($_GET["tipo"]) ? strtolower(trim($_GET["tipo"])) : "";
$fecha = isset($_GET["fecha"]) ? trim($_GET["fecha"]) : "";
$orden = $_GET["orden"] ?? "";
$ver_todo = isset($_GET["ver"]) && $_GET["ver"] === "todo";

$filtros_aplicados = $tipo !== "" || $fecha !== "" || $orden !== "";

$eventos_filtrados = array_filter($eventos, function($e) use ($tipo, $fecha) {
    return 
        ($tipo === "" || strtolower($e->tipo) === $tipo) &&
        ($fecha === "" || $e->fecha === $fecha);
});

if ($orden === "reciente") {
    usort($eventos_filtrados, fn($a, $b) => strtotime($b->fecha) - strtotime($a->fecha));
} elseif ($orden === "antiguo") {
    usort($eventos_filtrados, fn($a, $b) => strtotime($a->fecha) - strtotime($b->fecha));
}

// Mostrar resultados
if (!$filtros_aplicados && !$ver_todo) {
    $eventos_a_mostrar = array_slice($eventos, 0, 5);
} elseif ($ver_todo && !$filtros_aplicados) {
    $eventos_a_mostrar = $eventos;
} else {
    $eventos_a_mostrar = $eventos_filtrados;
}

if (count($eventos_a_mostrar) === 0) {
    echo "<p>No se encontraron eventos que coincidan con los criterios seleccionados.</p>";
} else {
    foreach ($eventos_a_mostrar as $evento) {
        echo $evento->mostrarEvento();
    }
}

// Botón de ver todos / ver menos
if (!$filtros_aplicados) {
    echo "<div style='text-align:center; margin-top: 20px;'>
        <a href='?ver=" . ($ver_todo ? "" : "todo") . "'>
            <button>" . ($ver_todo ? "Ver menos" : "Ver todos los eventos") . "</button>
        </a>
    </div>";
}
?>