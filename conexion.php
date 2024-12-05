<?php
// 1º - Conexión a la base de datos
$host = 'localhost';  
$dbname = 'Barberia_alura';  
$username = 'BDMarian';  
$password = '2652297885'; 

$conn = new mysqli($host, $username, $password, $dbname);

// 2º - Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// 3º- Obtener datos del formulario
$nombreapellido = $_POST['nombreapellido'];
$correoelectronico = $_POST['correoelectronico'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$recibirnovedades = isset($_POST['recibirnovedades']) ? 1 : 0;

// 4º - Insertar datos en la base de datos
$sql = "INSERT INTO datosclientealura (nombre, correo, telefono, mensaje)
        VALUES ('$nombreapellido', '$correoelectronico', '$telefono', '$mensaje')";

if ($conn->query($sql) === TRUE) {
    echo "<script> alert('El cliente [$nombreapellido] se agrego correctemente'); location.href='../contacto.html'; </script>";
} else {
    echo "Error al enviar el formulario: " . $conn->error;
}

// 5º - Cerrar la conexión
$conn->close();
?>
