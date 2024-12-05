<?php
// Configuraciones de la base de datos
$servername = "localhost"; 
$username = "BDMarian"; 
$password = "2652297885"; 
$dbname = "barberia_alura"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión con la base de datos falló " . $conn->connect_error);

} else{
    echo "Conexión exitosa";
}

// Obtener datos del formulario
$email = $_POST['register-email'];
$password = $_POST['register-password'];
$confirm_password = $_POST['register-confirm-password'];



// Verificar que las contraseñas coincidan
if ($password !== $confirm_password) {
    die("<script>alert('Las contraseñas no coinciden.'); history.back();</script>");
}

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar la consulta SQL
$sql = "INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("ss", $email, $hashed_password);

// Ejecutar la consulta y verificar el resultado
if ($stmt->execute()) {
    echo "<script>alert('El cliente [$email] se agregó correctamente'); location.href='../login.html';</script>";
    
} else {
    echo "Error al enviar el formulario: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>