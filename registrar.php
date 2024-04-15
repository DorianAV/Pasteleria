<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$json = json_decode(file_get_contents("php://input"));

$NombreUsu = $json->NombreUsu;
$Password = $json->Password;
$Id_rol = 2; // Asignamos automáticamente el valor 2 al Id_rol

$con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');

if (!$con) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$sql = "INSERT INTO usuarios (NombreUsu, Password, Id_rol) VALUES ('$NombreUsu', '$Password', '$Id_rol')";

if (mysqli_query($con, $sql)) {
    echo json_encode(array("message" => "Usuario registrado correctamente"));
} else {
    echo json_encode(array("message" => "Error al registrar usuario: " . mysqli_error($con)));
}

mysqli_close($con);
?>
