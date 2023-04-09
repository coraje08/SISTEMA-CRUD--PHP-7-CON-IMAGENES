<?php 
session_start();
include_once('config/connect.php');

$database = new Connection();
$db = $database->open();

if(isset($_POST['eliminar'])){

$idEmp=trim($_POST['idEmp']);
    ////////////// Actualizar la tabla /////////
    $consulta = "DELETE FROM empleados WHERE `idEmp`=:idEmp";
    $sql = $db->prepare($consulta);
    $sql->bindParam(':idEmp',$idEmp,PDO::PARAM_INT);
    $sql->execute();

if($sql->rowCount() > 0)
{
    $count = $sql -> rowCount();
    $_SESSION['message'] ="El registro se elimino correctamente";
    header('location: index.php');
}
else{
    $_SESSION['message'] ="No se puedo eliminar el registro";
    header('location: index.php');
    print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
 //cerrar la conexion de la base de datos
$database->close();
?>