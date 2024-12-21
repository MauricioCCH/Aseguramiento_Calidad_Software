<?php
include 'conexion.php';

if (isset($_POST['registrar'])) {
    $id_alumno = (int) $_POST['id_alumno'];
    $id_materia = (int) $_POST['id_materia'];
    $fecha = htmlspecialchars($_POST['fecha']);

    $stmt = $conexion->prepare("INSERT INTO separaciones (id_alumno, id_materia, fecha) VALUES (?, ?, ?)");
    $stmt->execute([$id_alumno, $id_materia, $fecha]);

    header('Location: index.php');
}
?>
