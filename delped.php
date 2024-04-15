
<?php 
header("Access-Control-Allow-Origin: *");

if(isset($_GET['Id_Pedido'])) {
    $Id_Pedido = $_GET['Id_Pedido'];

    $con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');
    $sql = "DELETE FROM pedidos WHERE Id_Pedido = '$Id_Pedido'";
    $res = mysqli_query($con, $sql);
    mysqli_close($con);

    echo json_encode($res);
} else {
    echo json_encode(array("error" => "No se proporcionó el ID del pedido."));
}
?>