<?php
header("Access-Control-Allow-Origin: *");

$id_usuario = $_GET["id_usuario"];

$sql = "SELECT * FROM pedidos WHERE Id_Usuario = $id_usuario";
$lista = array();

$con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');
$res = mysqli_query($con, $sql);

while ($rear = mysqli_fetch_array($res)) {
    $lista[] = $rear;
}

mysqli_close($con);
echo json_encode($lista);
?>
