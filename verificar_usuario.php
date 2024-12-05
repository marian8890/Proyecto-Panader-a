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
    $password_input = $_POST['login-password'];

    // Consulta para verificar si el usuario existe  
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :username");  
    $stmt->bindParam(':username', $user_input);  
    $stmt->execute();  

    // Verificar si se encontró algún usuario  
    if ($stmt->rowCount() > 0) {  
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password_input, $user['password'])) { // Suponiendo que las contraseñas están hasheadas  
            header("Location: venta.html"); // Redirigir a venta.html  
            exit(); // Asegúrate de usar exit después de header para detener la ejecución  
        } else {  
            echo "Contraseña incorrecta.";  
        }  
        echo "El usuario existe.";
        header("Location: venta.php"); 
    } else {  
        echo "El usuario no existe, debe registrarse.";  
    }  
} catch(PDOException $e) {  
    echo "Error: " . $e->getMessage();  
}  

// Cerrar la conexión  
$conn = null;  
?>
