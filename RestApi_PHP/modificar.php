<?php
include('cors.php');
include('bd.php');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$title=$data['title'];
$author=$data['author'];
$synopsis=$data['synopsis'];
$price = $data['price'];
$stock = $data['stock'];
$modelo = new Conexion();
$db = $modelo->getConnection();

$sql = "Update books set title='$title', author='$author', synopsis='$synopsis', price='$price', stock='$stock' where id = '$id'";

$query = $db->prepare($sql);
$query->execute();

echo "actualizacion exitosa"
?>