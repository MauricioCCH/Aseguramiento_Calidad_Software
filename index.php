<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Matrícula</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Gestión de Matrícula</h1>
    <section>
        <h2>Agregar Alumno</h2>
        <form action="alumno.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="text" name="cedula" placeholder="Cédula" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <button type="submit" name="agregar">Agregar</button>
        </form>
    </section>
</body>
</html>
    <section>
        <h2>Agregar Materia</h2>
        <form action="materia.php" method="POST">
            <input type="text" name="materia" placeholder="Materia" required>
            <input type="text" name="docente" placeholder="Docente" required>
            <input type="text" name="paralelo" placeholder="Paralelo" required>
            <input type="text" name="especializacion" placeholder="Especialización" required>
            <button type="submit" name="agregar">Agregar Materia</button>
        </form>
    </section>

    <section>
        <h2>Registrar Separación</h2>
        <form action="separacion.php" method="POST">
            <select name="id_alumno" required>
                <option value="">Seleccione Alumno</option>
                <?php
                $query = $conexion->query("SELECT * FROM alumnos");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']} {$row['apellido']}</option>";
                }
                ?>
            </select>
            <select name="id_materia" required>
                <option value="">Seleccione Materia</option>
                <?php
                $query = $conexion->query("SELECT * FROM materias");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>
            <input type="date" name="fecha" required>
            <button type="submit" name="registrar">Registrar Separación</button>
        </form>
    </section>

    <section>
        <h2>Separaciones Registradas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Materia</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $conexion->query("SELECT separaciones.id, alumnos.nombre AS alumno, materias.nombre AS materia, fecha 
                        FROM separaciones
                        JOIN alumnos ON separaciones.id_alumno = alumnos.id
                        JOIN materias ON separaciones.id_materia = materias.id");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['alumno']}</td>
                            <td>{$row['materia']}</td>
                            <td>{$row['fecha']}</td>
                            <td>
                                <a href='editar_separacion.php?id={$row['id']}'>Editar</a> |
                                <a href='eliminar_separacion.php?id={$row['id']}'>Eliminar</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
