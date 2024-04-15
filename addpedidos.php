<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

// Configuración de la conexión a la base de datos
$host = "localhost"; // Cambia esto si tu servidor de base de datos tiene un nombre diferente
$usuario = "root"; // Cambia esto si el usuario de tu base de datos es diferente
$password = "2004"; // Cambia esto si el password de tu base de datos es diferente
$base_datos = "pasteleria"; // Cambia esto si el nombre de tu base de datos es diferente

// Establecer la conexión a la base de datos
$con = mysqli_connect($host, $usuario, $password, $base_datos);

// Verificar si la conexión se realizó correctamente
if (!$con) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos de la solicitud POST
$data = json_decode(file_get_contents("php://input"));

// Verificar si se recibieron los datos correctamente
if ($data) {
    $Id_Usuario = $data->Id_Usuario;
    $Detalle_Pedido = $data->Detalle_Pedido;
    $Fecha_Pedido = $data->Fecha_Pedido;
    $Estado = $data->Estado;
    $Id_Producto = $data->Id_Producto;

    // Escapar los valores para evitar inyección de SQL
    $Id_Usuario = mysqli_real_escape_string($con, $Id_Usuario);
    $Detalle_Pedido = mysqli_real_escape_string($con, $Detalle_Pedido);
    $Fecha_Pedido = mysqli_real_escape_string($con, $Fecha_Pedido);
    $Estado = mysqli_real_escape_string($con, $Estado);
    $Id_Producto = mysqli_real_escape_string($con, $Id_Producto);

    // Query para insertar el pedido
    $sql = "INSERT INTO pedidos (Id_Usuario, Detalle_Pedido, Fecha_Pedido, Estado, Id_Producto) 
            VALUES ('$Id_Usuario', '$Detalle_Pedido', '$Fecha_Pedido', '$Estado', '$Id_Producto')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(array("message" => "Pedido registrado correctamente"));
    } else {
        echo json_encode(array("error" => "Error al registrar el pedido: " . mysqli_error($con)));
    }
} else {
    // Manejar el caso en que no se recibieron datos correctamente
    echo json_encode(array("error" => "No se recibieron datos en la solicitud."));
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
