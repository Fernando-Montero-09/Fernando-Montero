<?php
// Datos de conexión tomados de las variables de entorno definidas en docker-compose.yml
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    http_response_code(500);
    die(json_encode(["error" => "Error de conexión: " . $conexion->connect_error]));
}

// Para que los acentos (á, é, í, ó, ú, ñ) se guarden bien
$conexion->set_charset("utf8mb4");
?>
