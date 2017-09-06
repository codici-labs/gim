<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Flama CMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />
      	<?php echo add_style('bootstrap.min');?>
        <?php echo add_style('override');?>
        <?php echo add_jscript('jquery-1.11.1.min');?>		
        <?php echo add_jscript('bootstrap.min');?>
        <?php echo add_style('gradients');?>
     	<link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed" rel="stylesheet">
      <style type="text/css">
      table tr td{padding: 8px;}
      .login{
      	background-color: #fff;
      	width: 480px;
      	margin: auto;
      	padding: 10px;
      	margin-top: 150px;
      }
      </style>
		
    </head>
<body>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>
<?php echo form_open($this->uri->uri_string()); ?>
<div class="login">
<table width="400" align="center" bgcolor="#fff">
	<tr>
		<td colspan="3" style="text-align:center;">
			<span class="glyphicon glyphicon-fire"></span>
			<h3>Flama CMS</h3>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login); ?></td>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
	</tr>

	
	<tr>
		<td colspan="3">
		<?php echo form_submit('reset', 'Get a new password'); ?>
		
			

		</td>
	</tr>
</table>
<?php echo form_close(); ?>
</div>

    
</body>
</html>