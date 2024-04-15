<?php 
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");

// Permitir los métodos GET y POST
header("Access-Control-Allow-Methods: GET, POST");

// Permitir los encabezados de solicitud 'Content-Type'
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si se proporcionó un parámetro Id_Pedido en la solicitud
if(isset($_GET['Id_Pedido'])) {
    $Id_Pedido = $_GET['Id_Pedido'];

    // Establecer conexión con la base de datos
    $con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');

    if($con === false) {
        die("Error: No se pudo conectar. " . mysqli_connect_error());
    }

    // Consultar la base de datos para obtener el pedido con el Id_Pedido proporcionado
    $sql = "SELECT * FROM pedidos WHERE Id_Pedido='$Id_Pedido'";
    $pedido = array();

    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0) {
        // Recorrer los resultados y almacenarlos en un array
        while($rear = mysqli_fetch_array($res)){
            $pedido[] = $rear;
        }

        // Enviar la respuesta en formato JSON
        echo json_encode($pedido);
    } else {
        echo "No se encontró ningún pedido con el Id especificado.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
} else {
    echo "El Id de pedido es necesario para realizar la búsqueda.";
}
?>
