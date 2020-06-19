<?php
include('cors.php');
include('bd.php');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if(!empty($id)){
    $modelo = new Conexion();
    $db = $modelo->getConnection();
    $sql = "Delete from books where id = '$id'";
    $query = $db->prepare($sql);
    $query->execute();

    echo "se ha eliminado el registro";
}
?>