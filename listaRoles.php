<?php
header("Access-Control-Allow-Origin: *");
$servername = "localhost"; 
$username = "root"; 
$password = "2004";
$database = "pasteleria"; 

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}


$sql = "SELECT * FROM rol";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $roles = array();

    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }

    echo json_encode($roles);
} else {
    echo "[]";
}

$conn->close();
?>
