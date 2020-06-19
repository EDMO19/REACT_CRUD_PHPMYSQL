<?php
include('cors.php');
include('bd.php');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$description=$data['description'];
$price = $data['price'];
$quantity = $data['quantity'];
$modelo = new Conexion();
$db = $modelo->getConnection();

$sql = "Update products set description='$description', price='$price', quantity = '$quantity' where id = '$id'";

$query = $db->prepare($sql);
$query->execute();

echo "actualizacion exitosa"
?>