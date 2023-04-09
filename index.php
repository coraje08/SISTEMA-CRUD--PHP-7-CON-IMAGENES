<?php include("includes/header.php"); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-sm-offset-2">
			<h4 class="text-center p-4">EMPLEADOS STAR SHOPER</h4>
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>
<?php 
	session_start();
	if(isset($_SESSION['message'])){
		?>
		<div class="alert alert-info text-center" style="margin-top:20px;">
			<?php echo $_SESSION['message']; ?>
		</div>
		<?php

		unset($_SESSION['message']);
	}
?>
<table class="table table-border table-striped" style="margin-top:20px;">
	<thead>
		<th>ID</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Telefono</th>
		<th>Carrera</th>
		<th>Pais</th>
		<th>Foto</th>
		<th>Acción</th>
	</thead>
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('config/connect.php');

			$database = new Connection();
			$db = $database->open();
			try{
				$sql = 'SELECT * FROM empleados';
				foreach ($db->query($sql) as $row) {
					?>
					<tr>
						<td><?php echo $row['idEmp']; ?></td>
						<td><?php echo $row['Nombres']; ?></td>
						<td><?php echo $row['Apellidos']; ?></td>
						<td><?php echo $row['Telefono']; ?></td>
						<td><?php echo $row['Carrera']; ?></td>
						<td><?php echo $row['Pais']; ?></td>
						<td>
							<img src="imagenes/<?php echo $row['imagen']; ?>" class="" width="60px" height="60px" />
						</td>

						
						<td>
							<a href="#edit_<?php echo $row['idEmp']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
							<a href="#delete_<?php echo $row['idEmp']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
						</td>
						<?php include('BorrarEditarModal.php'); ?>
					</tr>
					<?php 
				}
			}
			catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
			}

			//Cerrar la Conexion
			$database->close();

		?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Agregar Nuevos Registros -->
	<?php include ("AgregarModal.php"); ?>
	
</div>

</div>
<?php include("includes/footer.php"); ?>
