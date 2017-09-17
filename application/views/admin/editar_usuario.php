<ol class="breadcrumb">
  <li><a href="<?=base_url();?>">Home</a></li>
  <li class="active">Editar usuarios</li>
</ol>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Editar usuario</h3>
  </div>
  <div class="panel-body">
	<form method="post" action="">
	<div class="row">
		<div class="col-md-6">
			<table width="100%">
				<tr height="52">
					<td  width="150">Nombre</td>
					<td><input class="form-control" type="text" name="username" id="username" maxlength="20" size="30" required value="<?=$user->username?>"></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Rol</td>
					<td>
					<select class="form-control" name="role_id" id="role_id" required>
						<option value="">Elija</option>
						<?php foreach ($roles as $role){ ?>
							<option value="<?=$role->id;?>" <?if($role->id == $user->role_id){echo 'selected';}?>><?=$role->role;?></option>
						<?php } ?>
					</select>
					</td>
					<td style="color: red;"></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table cellspacing="8" cellpadding="8" width="100%">
				<tr height="52">
					<td>Email</td>
					<td><input class="form-control" type="text" name="email"  id="email" maxlength="80" size="30" required value="<?=$user->email?>"></td>
					
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
