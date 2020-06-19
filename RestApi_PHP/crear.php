<?php
include('cors.php');
include('bd.php');

$data = json_decode(file_get_contents("php://input"),true);
$title = $data['title'];
$author = $data['author'];
$synopsis = $data['synopsis'];
$price = $data['price'];
$stock = $data['stock'];
if(empty($description) && empty($price)){

}else{
    $modelo = new Conexion();
    $db = $modelo->getConnection();
    $sql = "Insert into books(title,author,synopsis, price, stock) values('$title','$author','$synopsis','$price', '$stock')";
    $query = $db->prepare($sql);
    $query->execute();

    echo $query;
}

?>