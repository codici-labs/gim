<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<ol class="breadcrumb">
  <li><a href="<?=base_url();?>">Home</a></li>
  <li class="active">Agregar usuarios</li>
</ol>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Agregar usuario</h3>
  </div>
  <div class="panel-body">
	<?php echo form_open($this->uri->uri_string()); ?>
	<div class="row">
		<div class="col-md-6">
			<table width="100%">
				<tr height="52">
					<td  width="150">Apodo</td>
					<td><input class="form-control" type="text" name="username" value="" id="username" maxlength="20" size="30" required></td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td  width="150">Rol</td>
					<td>
					<select class="form-control" name="role_id" id="role_id" required>
						<option value="">Elija</option>
						<?php foreach ($roles as $role){ ?>
							<option value="<?=$role->id;?>"><?=$role->role;?></option>
						<?php } ?>
					</select>
					</td>
					<td style="color: red;"></td>
				</tr>
				<tr height="52">
					<td>Email</td>
					<td><input class="form-control" type="text" name="email" value="" id="email" maxlength="80" size="30" required></td>
					<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table cellspacing="8" cellpadding="8" width="100%">
				<?php if ($use_username) { ?>
				<tr height="52">
					<td  width="150">Nombre de usuario</td>
					<td><input class="form-control" type="text" name="username" value="" id="username" maxlength="20" size="30" required></td>
					<td style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></td>
				</tr>
				<?php } ?>
				<tr height="52">
					<td>Contraseña</td>
					<td><input class="form-control" type="password" name="password" value="" id="password" maxlength="20" size="30" required></td>
					<td style="color: red;"><?php echo form_error($password['name']); ?></td>
				</tr>
				<tr height="52">
					<td>Confirmar contraseña</td>
					<td><input class="form-control" type="password" name="confirm_password" value="" id="confirm_password" maxlength="20" size="30" required></td>
					<td style="color: red;"><?php echo form_error($confirm_password['name']); ?></td>
				</tr>

				<?php if ($captcha_registration) {
					if ($use_recaptcha) { ?>
				<tr height="52">
					<td colspan="2">
						<div id="recaptcha_image"></div>
					</td>
					<td>
						<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
						<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
						<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
					</td>
				</tr>
				<tr height="52">
					<td>
						<div class="recaptcha_only_if_image">Enter the words above</div>
						<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
					</td>
					<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
					<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
					<?php echo $recaptcha_html; ?>
				</tr>
				<?php } else { ?>
				<tr height="52">
					<td colspan="3">
						<p>Enter the code exactly as it appears:</p>
						<?php echo $captcha_html; ?>
					</td>
				</tr>
				<tr height="52">
					<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
					<td><?php echo form_input($captcha); ?></td>
					<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
				</tr>
				<?php }
				} ?>
			</table>
		</div>
	</div>
	<hr>
	<div class="row" style="margin-top:30px;">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>
