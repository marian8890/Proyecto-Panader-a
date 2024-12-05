<?php
// Configuración de base de datos  
$host = 'localhost';  
$dbname = 'Barberia_alura';  
$username = 'BDMarian';  
$password = '2652297885';  

try {  
    // Crear la conexión  
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    // Obtener el nombre de usuario del formulario  
    $user_input = $_POST['login-email'];  

    // Consulta para verificar si el usuario existe  
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username");  
    $stmt->bindParam(':username', $user_input);  
    $stmt->execute();  

    // Verificar si se encontró algún usuario  
    if ($stmt->rowCount() > 0) {  
        echo "El usuario existe.";  
    } else {  
        echo "El usuario no existe, debe registrarse.";  
    }  
} catch(PDOException $e) {  
    echo "Error: " . $e->getMessage();  
}  

// Cerrar la conexión  
$conn = null;  
?>
