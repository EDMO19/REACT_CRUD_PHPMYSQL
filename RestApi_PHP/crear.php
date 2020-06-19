<?php
include('cors.php');
include('bd.php');

$data = json_decode(file_get_contents("php://input"),true);
$description = $data['description'];
$price = $data['price'];
$quantity = $data['price'];
if(empty($description) && empty($price)){

}else{
    $modelo = new Conexion();
    $db = $modelo->getConnection();
    $sql = "Insert into products(description, price, quantity) values('$description','$price', '$quantity')";
    $query = $db->prepare($sql);
    $query->execute();

    echo $query;
}

?>