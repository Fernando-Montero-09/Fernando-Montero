<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require 'conexion.php';

$sql = "SELECT * FROM canciones ORDER BY id DESC";
$resultado = $conexion->query($sql);

$canciones = [];
while ($fila = $resultado->fetch_assoc()) {
    $canciones[] = $fila;
}

echo json_encode($canciones);

$conexion->close();
?>
