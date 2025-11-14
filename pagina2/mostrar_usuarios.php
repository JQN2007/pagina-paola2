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
    <title>PepeSeguros - Tu seguridad, nuestra prioridad</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* NAVBAR */
        header {
            background: #0077ff;
            padding: 15px 40px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* PORTADA */
        .hero {
            background: linear-gradient(#0077ffb0, #005fccb0),
                        url('https://images.unsplash.com/photo-1521791055366-0d553872125f')
                        center/cover no-repeat;
            color: white;
            padding: 120px 20px;
            text-align: center;
        }

        .hero h2 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 20px;
        }

        /* SECCIONES DE SEGUROS */
        .contenedor {
            width: 90%;
            max-width: 1100px;
            margin: auto;
            margin-top: 50px;
        }

        .titulo {
            text-align: center;
            font-size: 30px;
            margin-bottom: 30px;
            color: #333;
        }

        .cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            width: 300px;
            padding: 20px;
            margin: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px #ccc;
            text-align: center;
        }

        .card h3 {
            color: #0077ff;
        }

        /* FORMULARIO */
        .formulario {
            background: white;
            width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #bbb;
        }

        .formulario input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        .formulario button {
            width: 100%;
            padding: 12px;
            background: #0077ff;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
        }

        .formulario button:hover {
            background: #005fcc;
        }

        footer {
            background: #0077ff;
            color: white;
            padding: 15px;
            margin-top: 40px;
            text-align: center;
        }

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

<!-- NAVBAR -->
<header>
    <h1>PepeSeguros</h1>
    <nav>
        <a href="#seguros">Seguros</a>
        <a href="index.html">Registrar empleado</a>
        <a href="mostrar_usuarios.php">Ver empleados</a>
    </nav>
</header>

<!-- PORTADA -->
<div class="hero">
    <h2>Protegemos lo que más te importa</h2>
    <p>Elegí el seguro ideal con la compañía más confiable del país.</p>
</div>

<!-- SECCIONES DE SEGUROS -->
<div id="seguros" class="contenedor">
    <h2 class="titulo">Nuestros Seguros</h2>

    <div class="cards">
        <div class="card">
            <h3>Seguro Automotor</h3>
            <p>Protección total para tu vehículo ante robos, daños y más.</p>
        </div>

        <div class="card">
            <h3>Seguro de Vivienda</h3>
            <p>Cuida tu hogar de incendios, robos, accidentes y más.</p>
        </div>

        <div class="card">
            <h3>Seguro de Salud</h3>
            <p>Asistencia médica, urgencias y cobertura nacional.</p>
        </div>

        <div class="card">
            <h3>Seguro de Vida</h3>
            <p>Tranquilidad financiera para tus seres queridos.</p>
        </div>

        <div class="card">
            <h3>Seguro de Electrónicos</h3>
            <p>Cubre celulares, computadoras, TVs y mucho más.</p>
        </div>
    </div>
</div>


<table>
    <tr>
        <th>Nombre Completo</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Departamento</th>
    </tr>

    <?php
    // 3. Mostrar cada empleado en una fila
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$fila['nombre_completo']."</td>";
            echo "<td>".$fila['email']."</td>";
            echo "<td>".$fila['telefono']."</td>";
            echo "<td>".$fila['departamento']."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay empleados registrados</td></tr>";
    }
    ?>
</table>


<footer>
    © 2025 - PepeSeguros | Todos los derechos reservados
</footer>
</body>
</html>

<?php $conexion->close(); ?>
