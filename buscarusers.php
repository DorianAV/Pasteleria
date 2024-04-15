<?php 
header("Access-Control-Allow-Origin: *");
$Id_usuario = $_GET['Id_usuario'];
$sql = "SELECT * FROM usuarios WHERE Id_usuario='$Id_usuario'";
$usuario = array();

$con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');
$res = mysqli_query($con,$sql);
while($rear = mysqli_fetch_array($res)){
    $usuario[] = $rear;
}
mysqli_close($con);
echo json_encode($usuario);
?>