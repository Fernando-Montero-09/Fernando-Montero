<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo  = trim($_POST['titulo'] ?? '');
    $artista = trim($_POST['artista'] ?? '');
    $genero  = trim($_POST['genero'] ?? '');
    $anio    = trim($_POST['anio'] ?? '');

    if ($titulo === '' || $artista === '') {
        echo json_encode(["success" => false, "mensaje" => "Título y artista son obligatorios"]);
        exit;
    }

    $imagen = '';

    // Manejo de la subida del archivo (imagen de portada)
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $carpetaDestino = __DIR__ . '/uploads/';
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

        if (in_array($extension, $extensionesPermitidas)) {
            $nombreArchivo = uniqid('cancion_', true) . '.' . $extension;
            $rutaDestino = $carpetaDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                $imagen = $nombreArchivo;
            }
        }
    }

    $stmt = $conexion->prepare("INSERT INTO canciones (titulo, artista, genero, anio, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titulo, $artista, $genero, $anio, $imagen);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "mensaje" => "Canción agregada correctamente"]);
    } else {
        echo json_encode(["success" => false, "mensaje" => "Error al guardar: " . $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["success" => false, "mensaje" => "Método no permitido"]);
}
?>
