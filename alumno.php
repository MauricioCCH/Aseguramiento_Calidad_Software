<?php
include 'conexion.php';

if (isset($_POST['agregar'])) {
    // Validación de datos
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $cedula = htmlspecialchars($_POST['cedula']);
    $direccion = htmlspecialchars($_POST['direccion']);

    // Consulta preparada para prevenir inyección SQL
    $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, apellido, cedula, direccion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $apellido, $cedula, $direccion]);

    header('Location: index.php');
}
?>