<?php
session_start();
include_once('config/connect.php');

$database = new Connection(); //instanciamos la conexion
$db = $database->open();

if(isset($_POST['insertar'])){
///////////// Informacion enviada por el formulario /////////////
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$telefono=$_POST['telefono'];
$carrera=$_POST['carrera'];
$pais=$_POST['pais'];

	//varibales de la imagen
	$imgFile = $_FILES['imagen']['name'];
	$tmp_dir = $_FILES['imagen']['tmp_name'];
	$imgSize = $_FILES['imagen']['size'];
	//fin de las variable de la imagen

			$upload_dir = 'imagenes/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			//$userpic = rand(1000,1000000).".".$imgExt;
			  $imagen = $imgFile;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize < 1000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$imagen);
				}
				else{
					$_SESSION['message'] = "Su archivo es muy grande.";
				}
			}
			else{
				$_SESSION['message'] = "Solo archivos JPG, JPEG, PNG & GIF son permitidos.";		
			} // fin del code

///////// Fin informacion enviada por el formulario ///

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into empleados(nombres,apellidos,telefono, carrera, pais, imagen) values(:nombres,:apellidos,:telefono, :carrera, :pais, :imagen)";

$sql = $db->prepare($sql);

$sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
$sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR, 25);
$sql->bindParam(':telefono',$telefono,PDO::PARAM_INT);
$sql->bindParam(':carrera',$carrera,PDO::PARAM_STR,25);
$sql->bindParam(':pais',$pais,PDO::PARAM_STR,25);
$sql->bindParam(':imagen',$imagen);


$sql->execute();

$lastInsertId = $db->lastInsertId();
if($lastInsertId>0){
	$_SESSION['message'] ="Se agrego correctamente el empleado";
	header('location: index.php');
	
}
else{

	$_SESSION['message'] ="No se pudo registrar el empleado";
	header('location: index.php');
	
	print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado

$database->close(); //cerramos la conexion
?>