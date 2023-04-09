<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $row['idEmp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              
                <center><h4 class="modal-title" id="myModalLabel">Editar Empleado</h4></center>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form  action="EditarRegistro.php?id=<?php echo $row['idEmp']; ?>" method="POST" enctype="multipart/form-data">
				<!-- Tambien se envia el IDEMP pero lo estoy ocultando con el hidden -->
				<input type="text" name="idEmp" hidden="" value="<?php echo $row['idEmp']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombres:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nombres" value="<?php echo $row['Nombres']; ?>">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Apellidos:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="apellidos" value="<?php echo $row['Apellidos']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Telefono:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="telefono" value="<?php echo $row['Telefono']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Carrera:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="carrera" value="<?php echo $row['Carrera']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pais:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pais" value="<?php echo $row['Pais']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Imagen:</label>
					</div>
					<div class="col-sm-10">
						<img src="imagenes/<?php echo $row['imagen']; ?>" height="150" width="150"/>
						<input type="text" hidden value="<?php echo $row['imagen'];?>" name="imagen">
						<input class="form-control" type="file" name="imagen" accept="image/*" />
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="actualizar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Borrar -->
<div class="modal fade" id="delete_<?php echo $row['idEmp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              
                <center><h4 class="modal-title" id="myModalLabel">Borrar Empleado</h4></center>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

            <form  action="BorrarRegistro.php?id=<?php echo $row['idEmp']; ?>" method="POST">	
            	<input type="number" name="idEmp" hidden="" value="<?php echo $row['idEmp']; ?>">

            	<p class="text-center">¿Esta seguro de Borrar el registro?</p>
				<h2 class="text-center"><?php echo $row['Nombres'].' '.$row['Apellidos']; ?></h2>
			</div>
            <div class="modal-footer">
            	 <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
            	<button type="submit" name="eliminar" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
            </form>


            </div>

        </div>
    </div>
</div>