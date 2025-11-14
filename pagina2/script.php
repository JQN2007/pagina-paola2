<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "seguros");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre_completo'];
$email = $_POST['email'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];
$departamento = $_POST['departamento'];

// Encriptar contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO empleados (nombre_completo, email, password, telefono, departamento)
        VALUES ('$nombre', '$email', '$password_hash', '$telefono', '$departamento')";

if ($conexion->query($sql) === TRUE) {
    header("Location: mostrar_usuarios.php");
exit();

} else {
    echo "Error al registrar: " . $conexion->error;
}

$conexion->close();
?>
