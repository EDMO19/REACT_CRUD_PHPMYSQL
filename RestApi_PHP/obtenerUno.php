<?php
include('cors.php');
include('bd.php');

$array=array();
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$modelo = new Conexion();
$db = $modelo->getConnection();
$sql = "Select id, description, price, quantity from products where id = '$id'";
$query = $db->prepare($sql);
$query->execute();

    while($fila = $query->fetch()){
        $array[] = array(
            "id"=>$fila['id'],
            "description"=>$fila['description'],
            "price"=>$fila['price'],
            "quantity"=>$fila['quantity']
        );
    }

    $json = json_encode($array);

    echo $json;

?>