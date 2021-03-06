<?php echo add_jscript('function');?>  
<?php echo add_jscript('jquery.confirm');?>
<script type="text/javascript">     
    
    var base_url = "<?php echo base_url()?>";

    $(document).ready(function () {
        result = 20;


        $("body").on('click','.remove',function(){
            var id = $(this).attr('rel');
            $.confirm({
                text: "Desea eliminar esta usuario?",
                title: "Confirmación",
                confirm: function(button) {
                    window.location.replace('<?=base_url();?>admin/borrar_usuario/'+id);
                   
                },
                cancel: function(button) {
                    
                },
                confirmButton: "Yes",
                cancelButton: "No",
                post: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-default",
                dialogClass: "modal-dialog"                     
            });

        });

    });

</script>
<?php

    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php print_r($this->session->flashdata('message'));?>
        </div>
    <?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-10"><h3 class="panel-title fix-title">Usuarios</h3></div>
            <div class="col-md-2 text-right "><? if($role == 'sysadmin'){?><a href="<?=base_url();?>auth/register" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Agregar</a><? } ?>   </div>
        </div>   
    </div>

    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-12">
                <? if($role == 'user'){?>
                     <table class="table table-hover">
                        <thead id="table_news">
                          <tr>
                            <th rel="nombre"><a href="<?=base_url();?>admin/usuarios/firstname">Nombre</a></th>
                            <th rel="direccion"><a href="<?=base_url();?>admin/usuarios/lastname">Apellido</a></th>
                            <th rel="codigo"><a href="<?=base_url();?>admin/usuarios/email">email</a></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?foreach ($usuarios as $usuario) {?>
                            <tr>
                               
                                <td><?=$usuario->firstname?></td>
                                <td><?=$usuario->lastname?></td>
                                <td><?=$usuario->email?></td>
                            </tr>
                        <? } ?>

                        </tbody>
                    </table> 
                <? }else if($role == 'admin'){?>
                    <table class="table table-hover">
                        <thead id="table_news">
                          <tr>
                            <th rel="nombre"><a href="<?=base_url();?>admin/usuarios/firstname">Nombre</a></th>
                            <th rel="direccion"><a href="<?=base_url();?>admin/usuarios/lastname">Apellido</a></th>
                            <th rel="codigo"><a href="<?=base_url();?>admin/usuarios/email">email</a></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?foreach ($usuarios as $usuario) {?>
                            <tr>
                               
                                <td><?=$usuario->firstname?></td>
                                <td><?=$usuario->lastname?></td>
                                <td><?=$usuario->email?></td>
                            </tr>
                        <? } ?>

                        </tbody>
                    </table> 

                <? }else if($role == 'sysadmin'){?>
                    <table class="table table-hover">
                        <thead id="table_news">
                          <tr>
                            <th rel="username"><a href="<?=base_url();?>admin/usuarios/username">Apodo</a></th>
                            <th rel="codigo"><a href="<?=base_url();?>admin/usuarios/email">Mail</a></th>
                            <th rel="codigo"><a href="<?=base_url();?>admin/usuarios/role">Rol</a></th>
                            
                            <th rel="acction">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?foreach ($usuarios as $usuario) {?>
                            <tr>
                                <td><?=$usuario->username?></td>
                                <td><?=$usuario->email?></td>
                                <td><?=$usuario->role?></td>                         
                                <td>
                                    <? if($username != $usuario->email){?>
                                        <a href="<?=base_url();?>admin/editar_usuario/<?=$usuario->id;?>"><span class="glyphicon glyphicon-pencil" title="Editar perfil"></span></a>
                                        <a href="javascript:void(0);" class="remove" rel="<?=$usuario->id;?>"><span class="glyphicon glyphicon-trash" title="Eliminar perfil"></span></a>
                                        <a href="<?=base_url();?>auth/admin_change_password_form/<?=$usuario->id;?>"><span class="glyphicon glyphicon-lock" title="Cambiar contraseña"></span></a>           
                                    <? }else {?>
                                        <a href="<?=base_url();?>admin/perfil"><span class="glyphicon glyphicon-pencil" title="Editar perfil"></span></a>
                                        <span class="glyphicon glyphicon-trash" disabled title="Un usuario no puede borrarse a sí mismo"></span>
                                        <a href="<?=base_url();?>auth/change_password/"><span class="glyphicon glyphicon-lock"></span></a>
                                    <? } ?>
                                <td>
                            </tr>
                        <? } ?>

                        </tbody>
                    </table> 

                <? } ?>
                <?php echo $this->pagination->create_links();?>                        
            </div>
        </div>
    </div>
</div>    