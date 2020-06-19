<?php
include('cors.php');
include('bd.php');

$array = array();
$modelo = new Conexion();
$db = $modelo->getConnection();
$sql = 'Select * from products';
$query = $db->prepare($sql);
$query->execute();

    while($fila = $query->fetch()){
        $array[] = array(
            "id" => $fila['id'],
            "description" => $fila['description'],
            "price" => $fila['price'],
            "quantity" => $fila['quantity'],
            "status" => $fila['status'],
            "created_at" => $fila['created_at'],
            "updated_at" => $fila['updated_at']
        );
    }
    $json = json_encode($array);
    echo $json;
?>