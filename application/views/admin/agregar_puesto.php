<?php echo add_jscript('jquery.multi-select');?>   
<?php echo add_style('multi-select');?>  
<?php echo add_style('edit');?>
<ol class="breadcrumb">
  <li><a href="<?=base_url();?>">Home</a></li>
  <li class="active">Agregar puestos</li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
		<div class="col-md-10"><h3 class="panel-title">Agregar puesto</h3></div>
		<div class="col-md-2 text-right"><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-default">Volver</a></div>
	</div>
	  
	  
	</div>
	<div class="panel-body">
		<!-- aca contenido de la seccion-->
		<form method="post" action="">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12"><h4>Detalles del puesto</h4>
						<hr>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required > 
						</div> 					  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="codigo">Código</label>
							<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" required > 
						</div>					  
					</div>
				
					
				</div>
				
				
				 
				  
			
			</div>
			
		</div>
		<hr>
		<div class="row" style="margin-top:30px;">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</div>
	</form>
		<!-- / fin contenido -->
	</div>
</div>