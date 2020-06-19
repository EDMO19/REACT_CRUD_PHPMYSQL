<?php
include('cors.php');
include('bd.php');

$array=array();
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$modelo = new Conexion();
$db = $modelo->getConnection();
$sql = "Select * from products where id = '$id'";
$query = $db->prepare($sql);
$query->execute();

    while($fila = $query->fetch()){
        $array[] = array(
            "id"=>$fila['id'],
            "title"=>$fila['title'],
            "author"=>$fila['author'],
            "synopsis"=>$fila['synopsis'],
            "price"=>$fila['price'],
            "stock"=>$fila['stock']
        );
    }

    $json = json_encode($array);

    echo $json;

?>