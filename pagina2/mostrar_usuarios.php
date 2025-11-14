<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "seguros");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si quieren filtrar por departamento ?dept=Autos o Vivienda etc.
$departamentoSeleccionado = isset($_GET['dept']) ? $_GET['dept'] : "";

// Consulta general
if ($departamentoSeleccionado == "") {
    $sql = "SELECT * FROM empleados ORDER BY departamento, nombre_completo";
} else {
    $sql = "SELECT * FROM empleados WHERE departamento = '$departamentoSeleccionado' ORDER BY nombre_completo";
}

$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados Registrados</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h2 { text-align: center; }
        table {
            width: 80%; margin: auto; border-collapse: collapse;
            background: white; box-shadow: 0 0 10px #ccc;
        }
        th, td {
            padding: 10px; border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #0077ff; color: white;
        }
        select, button {
            padding: 10px; margin: 10px;
        }
        .contenedor {
            text-align: center;
            margin-bottom: 20px;
        }
        a.boton {
            display: inline-block;
            padding: 10px 15px;
            background: #0077ff; 
            color: white; 
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<h2>Empleados Registrados</h2>

<div class="contenedor">
    <form method="GET" action="mostrar_usuarios.php">
        <label>Filtrar por departamento:</label>
        <select name="dept">
            <option value="">Todos</option>
            <option value="Autos">Autos</option>
            <option value="Vivienda">Vivienda</option>
            <option value="Salud">Salud</option>
            <option value="Vida">Vida</option>
            <option value="Electrónicos">Electrónicos</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <a class="boton" href="index.html">Registrar nuevo empleado</a>
</div>

<table>
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Departamento</th>
    </tr>

    <?php  
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>".$fila['nombre_completo']."</td>
                    <td>".$fila['email']."</td>
                    <td>".$fila['telefono']."</td>
                    <td>".$fila['departamento']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay empleados registrados</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php $conexion->close(); ?>
