<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

session_start();

$servername = "localhost";
$username = "root";
$password = "2004";
$dbname = "pasteleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$username = $_GET["username"];
$password = $_GET["password"];

$sql = "SELECT Id_usuario, NombreUsu, Id_rol FROM usuarios WHERE NombreUsu = '$username' AND Password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION['id_usuario'] = $row["Id_usuario"];
    $_SESSION['username'] = $row["NombreUsu"];
    $_SESSION['id_rol'] = $row["Id_rol"];

    $response = array(
        'success' => true,
        'message' => 'Inicio de sesión exitoso',
        'id_usuario' => $_SESSION['id_usuario'],
        'username' => $_SESSION['username'],
        'id_rol' => $_SESSION['id_rol']
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Nombre de usuario o contraseña incorrectos'
    );
}

$conn->close();

echo json_encode($response);
?>
