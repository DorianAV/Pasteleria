<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Id_usuario"]) && isset($_POST["producto_id"])) {
    
    
    $id_usuario = $_POST["Id_usuario"];
    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"]; 
    
    
    $servername = "localhost";
    $username = "root";
    $password = "2004";
    $dbname = "pasteleria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        $response = array("success" => false, "message" => "Error al conectar a la base de datos");
        http_response_code(500); 
        echo json_encode($response);
        exit;
    }

    
    $sql = "INSERT INTO pedidos2 (producto_id, Id_usuario) VALUES ('$producto_id', '$id_usuario')";

    
    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Pedido agregado correctamente");
        echo json_encode($response);
    } else {
        $response = array("success" => false, "message" => "Error al agregar el pedido: " . $conn->error);
        http_response_code(500); 
        echo json_encode($response);
    }

    
    $conn->close();

} else {
    
    $response = array("success" => false, "message" => "Datos del pedido o ID de usuario faltantes");
    http_response_code(400); 
    echo json_encode($response);
}
?>
