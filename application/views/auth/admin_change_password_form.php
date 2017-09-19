<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Cambiar contraseña</h3>
  </div>
  <div class="panel-body">
    <?php echo form_open($this->uri->uri_string()); ?>
<table cellspacing="8" cellpadding="8">

	<tr height="52">
		<td  width="150">Apodo</td>
		<td><input class="form-control" type="text" name="username" id="username" maxlength="20" size="30" required value="<?=$user->username?>" disabled></td>
		<td style="color: red;"></td>
	</tr>

	<tr height="52">
		<td>Nueva contraseña</td>
		<td><?php echo form_password($new_password); ?></td>
		<td style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></td>
	</tr>
	<tr height="52">
		<td>Confirmar nueva contraseña</td>
		<td><?php echo form_password($confirm_new_password); ?></td>
		<td style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('change', 'Cambiar contraseña'); ?>
<?php echo form_close(); ?>
  </div>
</div>
