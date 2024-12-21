<?php
include 'conexion.php';

if (isset($_POST['agregar'])) {
    $materia = htmlspecialchars($_POST['materia']);
    $docente = htmlspecialchars($_POST['docente']);
    $paralelo = htmlspecialchars($_POST['paralelo']);
    $especializacion = htmlspecialchars($_POST['especializacion']);

    $stmt = $conexion->prepare("INSERT INTO materias (nombre, docente, paralelo, especializacion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$materia, $docente, $paralelo, $especializacion]);

    header('Location: index.php');
}
?>