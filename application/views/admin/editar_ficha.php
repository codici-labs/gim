<ol class="breadcrumb">
  <li><a href="<?=base_url();?>">Home</a></li>
  <li class="active">Editar fichas</li>
</ol>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Editar ficha</h3>
  </div>
  <div class="panel-body">
	<form method="post" action="">
	<div class="row">
		<div class="col-md-6">
			<table width="100%">
				<tr height="52">
					<td  width="150">Nombre</td>
					<td><input class="form-control" type="text" name="nombre" id="nombre" maxlength="20" size="30" required value="<?=$ficha->firstname?>"></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Apellido</td>
					<td><input class="form-control" type="text" name="apellido"  id="apellido" maxlength="20" size="30" required value="<?=$ficha->lastname?>"></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Sede</td>
					<td>
					
					<select class="form-control" name="sede_id" id="sede_id" required>
						<option value="">Elija</option>
						<?php foreach ($sedes as $sede){ ?>
							<option value="<?=$sede->id;?>" <?if($sede->id == $ficha->sede_id){echo 'selected';}?>><?=$sede->nombre;?></option>
						<?php } ?>
					</select>
					</td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Teléfono</td>
					<td><input class="form-control" type="text" name="telefono"  id="telefono" maxlength="20" size="30" required value="<?=$ficha->telefono?>"></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Interno</td>
					<td><input class="form-control" type="text" name="interno"  id="interno" maxlength="20" size="30" value="<?=$ficha->interno?>"></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Celular</td>
					<td><input class="form-control" type="text" name="celular"  id="celular" maxlength="20" size="30" value="<?=$ficha->celular?>"></td>
					<td style="color: red;"></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table cellspacing="8" cellpadding="8" width="100%">
				
				
				<tr height="52">
					<td>Email</td>
					<td><input class="form-control" type="text" name="email"  id="email" maxlength="80" size="30" required value="<?=$ficha->email?>"></td>
					
				</tr>
				
				
			
			</table>
		</div>
	</div>
	<hr>
	<div class="row" style="margin-top:30px;">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</div>
	
	</div>
	</form>
</div>
