<?php echo add_jscript('jquery.multi-select');?>   
<?php echo add_style('multi-select');?>  
<?php echo add_style('edit');?>
<ol class="breadcrumb">
  <li><a href="<?=base_url();?>">Inicio</a></li>
  <li class="active">Editar sede</li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
		<div class="col-md-10"><h3 class="panel-title">Editar sede</h3></div>
		<div class="col-md-2 text-right"><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-default">Volver</a></div>
	</div>
	  
	  
	</div>
	<div class="panel-body">
		<!-- aca contenido de la seccion-->
		<form method="post" action="">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12"><h4>Detalles de la sede</h4>
						<hr>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required value="<?=$sede->nombre;?>"> 
						</div> 					  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="codigo">Código</label>
							<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" required value="<?=$sede->codigo;?>"> 
						</div>					  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="direccion">Dirección</label>
							<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required value="<?=$sede->direccion;?>"> 
						</div>					  
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="contacto">Datos de contacto</label>
							<textarea class="form-control" id="contacto" name="contacto" rows="5" required ><?=$sede->contacto;?></textarea>
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
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Elija una imagen</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="images-content"></div>
      	</div>
       
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
	$(document).ready(function(){
		$('.add-image').click(function(){
			$.ajax({
			  url: '<?=base_url();?>admin/getMedia',
			  method: 'get',
			  dataType: 'json',
			  success: function(data){
			  	var c = 0;
			  	$('.images-content').html('');
			  	data.forEach(function(element) {
				     $('.images-content').append('<div class="col-md-3"><div class="select-img" data-img="<?=base_url();?>uploads/'+data[c].file+'" style="background-image:url(<?=base_url();?>uploads/'+data[c].file+');"></div></div>'); 
				     c++;
				});
				
				
			  }
			});
			$('.modal').modal();
		});

		$('.modal-body').on('click', '.select-img', function(){
			var image = $(this).data('img');
			$('#preview-image').attr('src', image);
			$('#preview-image-input').val(image);
			$('.modal').modal('hide');
		});
	});
</script>