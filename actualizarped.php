<?php
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

$data = json_decode(file_get_contents('php://input'), true);

$id_pedido = $data['Id_Pedido'];
$detalle_pedido = $data['Detalle_Pedido'];
$fecha_pedido = $data['Fecha_Pedido'];
$estado = $data['Estado'];
$id_producto = $data['Id_Producto'];
$id_usuario = $data['Id_Usuario']; // Agrega la variable para el ID del usuario

$sql = "UPDATE pedidos SET Id_Usuario='$id_usuario', Detalle_Pedido='$detalle_pedido', Fecha_Pedido='$fecha_pedido', Estado='$estado', Id_Producto='$id_producto' WHERE Id_Pedido=$id_pedido";

if ($conn->query($sql) === TRUE) {
    $response = array(
        'success' => true,
        'message' => 'Se actualizó el pedido correctamente'
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar el pedido: ' . $conn->error
    );
}

$conn->close();

echo json_encode($response);
?>
