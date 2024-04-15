<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    header('HTTP/1.1 200 OK');
    exit();
}

$json = json_decode(file_get_contents("php://input"));

$Id_usuario = $json->Id_usuario;
$NombreUsu = $json->NombreUsu;
$Password = $json->Password;
$Id_rol = $json->Id_rol;

$con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');

if (!$con) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$sql = "UPDATE usuarios SET NombreUsu='$NombreUsu', Password='$Password', Id_rol='$Id_rol' WHERE Id_usuario='$Id_usuario'";
if (mysqli_query($con, $sql)) {
    echo json_encode(array("message" => "Usuario actualizado correctamente"));
} else {
    echo json_encode(array("message" => "Error al actualizar usuario: " . mysqli_error($con)));
}

mysqli_close($con);
?>
