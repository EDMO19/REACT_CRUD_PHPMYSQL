<?php
include('cors.php');
include('bd.php');

if(empty($_GET['desc']) && empty($_GET['price'])){
echo "no funciono";
}else{
    echo $_GET['desc'];
    $description = $_GET['desc'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity'];
    $modelo = new Conexion();
    $db = $modelo->getConnection();

    $sql = "Insert into products(description, price, quantity) values(:description,:price, :quantity)";
    $query = $db->prepare($sql);
    $query->bindParam(':description',$description);
    $query->bindParam(':price',$price);
    $query->bindParam(':quantity',$quantity);

    $query->execute();

    echo $query;
}

?>