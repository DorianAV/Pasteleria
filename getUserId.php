<?php
header("Access-Control-Allow-Origin: *");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$response = array();


if (isset($_SESSION['id_usuario'])) {
  
    $response['success'] = true;
    $response['id_usuario'] = $_SESSION['id_usuario'];
} else {
    
    $response['success'] = false;
    $response['message'] = 'No se ha iniciado sesión';
}

$response['id_usuario'] = $_SESSION['id_usuario'];


echo json_encode($response);
?>
