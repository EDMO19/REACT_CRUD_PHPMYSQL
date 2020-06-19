<?php
include('cors.php');
include('bd.php');

$array = array();
$modelo = new Conexion();
$db = $modelo->getConnection();
$sql = 'Select * from books';
$query = $db->prepare($sql);
$query->execute();

    while($fila = $query->fetch()){
        $array[] = array(
            "id" => $fila['id'],
            "title" => $fila['title'],
            "author" => $fila['author'],
            "synopsis" => $fila['synopsis'],
            "price" => $fila['price'],
            "stock" => $fila['stock']
        );
    }
    $json = json_encode($array);
    echo $json;
?>