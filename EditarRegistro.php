<?php
session_start();
include_once('config/connect.php');

$database = new Connection(); //instanciamos la conexion
$db = $database->open();

if(isset($_POST['actualizar'])){
///////////// Informacion enviada por el formulario /////////////
$idEmp=trim($_POST['idEmp']);
$nombres=trim($_POST['nombres']);
$apellidos=trim($_POST['apellidos']);
$telefono=trim($_POST['telefono']);
$carrera=trim($_POST['carrera']);
$pais=trim($_POST['pais']);
$imagen=trim($_POST['imagen']); // enviado desde el input oculto


///////// Fin informacion enviada por el formulario /// 
    $imgFile = trim($_FILES['imagen']['name']);
    $tmp_dir = trim($_FILES['imagen']['tmp_name']);
    $imgSize = trim($_FILES['imagen']['size']);

    if ($imgFile) {
        $upload_dir = 'imagenes/'; // upload directory  
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $imagen = $imgFile;
            //$imagen = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions)){           
                if($imgSize < 1000000)
                {
                    unlink($upload_dir.$edit_row['imagen']);
                    move_uploaded_file($tmp_dir,$upload_dir.$imagen);
                }
                else
                {
                    $_SESSION['message'] = "Su archivo es demasiado grande mayor a 1MB";
                }
            } else{
                $_SESSION['message'] = "Solo archivos JPG, JPEG, PNG & GIF .";       
            }
    }
  

        // fin del envio de la imagen
////////////// Actualizar la tabla /////////
$consulta = "UPDATE empleados SET `nombres`= :nombres, `apellidos` = :apellidos, `telefono` = :telefono, `carrera` = :carrera, `pais` = :pais, `imagen` = :imagen WHERE `idEmp` = :idEmp";

$sql = $db->prepare($consulta);
$sql->bindParam(':idEmp',$idEmp,PDO::PARAM_INT);
$sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
$sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR, 25);
$sql->bindParam(':telefono',$telefono,PDO::PARAM_INT);
$sql->bindParam(':carrera',$carrera,PDO::PARAM_STR,25);
$sql->bindParam(':pais',$pais,PDO::PARAM_STR,25);
$sql->bindParam(':imagen',$imagen);


$sql->execute();

if($sql->rowCount() > 0)
{
    $count = $sql -> rowCount();
    $_SESSION['message'] ="EL registro ha sido actualizado correctamente";
    header('location: index.php');
}
else{
    $_SESSION['message'] ="No se pudo actualizar el registro";
    header('location: index.php');
    print_r($sql->errorInfo()); 
    }
}// Cierra envio de guardado

$database->close(); //cerramos la conexion
?>