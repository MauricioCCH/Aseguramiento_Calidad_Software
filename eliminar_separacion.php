<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Validación del ID

    $stmt = $conexion->prepare("DELETE FROM separaciones WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: index.php');
}
?>