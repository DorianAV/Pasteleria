
<?php 
header("Access-Control-Allow-Origin: *");

if(isset($_GET['Id_usuario'])) {
    $Id_usuario = $_GET['Id_usuario'];

    $con = mysqli_connect('localhost', 'root', '2004', 'pasteleria');
    $sql = "DELETE FROM usuarios WHERE Id_usuario = '$Id_usuario'";
    $res = mysqli_query($con, $sql);
    mysqli_close($con);

    echo json_encode($res);
} else {
    echo json_encode(array("error" => "No se proporcionó el ID del usuario."));
}
?>
