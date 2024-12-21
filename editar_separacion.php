<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Asegurar que sea un número

    $query = $conexion->prepare("SELECT * FROM separaciones WHERE id = ?");
    $query->execute([$id]);
    $separacion = $query->fetch(PDO::FETCH_ASSOC);

    if (!$separacion) {
        die("Separación no encontrada.");
    }
}

if (isset($_POST['editar'])) {
    $id = (int) $_POST['id'];
    $id_alumno = (int) $_POST['id_alumno'];
    $id_materia = (int) $_POST['id_materia'];
    $fecha = htmlspecialchars($_POST['fecha']);

    $stmt = $conexion->prepare("UPDATE separaciones SET id_alumno = ?, id_materia = ?, fecha = ? WHERE id = ?");
    $stmt->execute([$id_alumno, $id_materia, $fecha, $id]);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Separación</title>
<style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header */
        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #4CAF50;
            padding: 20px 0;
            margin: 0;
        }

        /* Form Container */
        form {
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: black;
        }

        form input, form select{
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    margin-bottom:inherit;
        }
        form button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form button {
            background-color: #2e7d32; /* Verde oscuro */
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        form button:hover {
            background-color: #1b5e20;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #2e7d32;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
</style>
</head>
<body>
    <h1>Editar Separación</h1>
    <form action="editar_separacion.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($separacion['id']) ?>">

        <label for="id_alumno">Alumno:</label>
        <select name="id_alumno" id="id_alumno" required>
            <option value="">Seleccione Alumno</option>
            <?php
            $alumnos = $conexion->query("SELECT * FROM alumnos");
            while ($row = $alumnos->fetch(PDO::FETCH_ASSOC)) {
                $selected = $row['id'] == $separacion['id_alumno'] ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nombre']} {$row['apellido']}</option>";
            }
            ?>
        </select>

        <label for="id_materia">Materia:</label>
        <select name="id_materia" id="id_materia" required>
            <option value="">Seleccione Materia</option>
            <?php
            $materias = $conexion->query("SELECT * FROM materias");
            while ($row = $materias->fetch(PDO::FETCH_ASSOC)) {
                $selected = $row['id'] == $separacion['id_materia'] ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nombre']}</option>";
            }
            ?>
        </select>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($separacion['fecha']) ?>" required>

        <button type="submit" name="editar">Guardar Cambios</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>
