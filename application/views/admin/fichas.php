<?php echo add_jscript('function');?>  
<?php echo add_jscript('jquery.confirm');?>
<script type="text/javascript">     
    
    var base_url = "<?php echo base_url()?>";

    $(document).ready(function () {
        result = 20;


        $("body").on('click','.remove',function(){
            var id = $(this).attr('rel');
            $.confirm({
                text: "Desea eliminar esta ficha?",
                title: "Confirmación",
                confirm: function(button) {
                    window.location.replace('<?=base_url();?>admin/borrar_ficha/'+id);
                   
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
            <div class="col-md-10"><h3 class="panel-title fix-title">Fichas</h3></div>
            <div class="col-md-2 text-right "><? if(($role == 'sysadmin') || ($role == 'admin')){?><a href="<?=base_url();?>admin/agregar_ficha" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Agregar</a><? } ?>   </div>
        </div>   
    </div>

    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-12">
                
                <table class="table table-hover">
                    <thead id="table_news">
                        <tr>
                            <th rel="direccion"><a href="<?=base_url();?>admin/fichas/lastname">Apellido</a></th>
                            <th rel="nombre"><a href="<?=base_url();?>admin/fichas/firstname">Nombre</a></th>
                            <th rel="contacto"><a href="<?=base_url();?>admin/fichas/telefono">Teléfono</a></th>
                            <th rel="contacto"><a href="<?=base_url();?>admin/fichas/interno">Interno</a></th>
                            <th rel="contacto"><a href="<?=base_url();?>admin/fichas/celular">Celular</a></th>
                            <th rel="contacto"><a href="<?=base_url();?>admin/fichas/sede">Sede</a></th>
                            <th rel="contacto"><a href="<?=base_url();?>admin/fichas/f.puesto">Puesto</a></th>
                            <th rel="codigo"><a href="<?=base_url();?>admin/fichas/email">email</a></th>
                            <? if($role == 'sysadmin') { ?>
                                <th rel="acction">Acciones</th>
                            <? } ?> 
                        </tr>
                    </thead>
                    <tbody>
                        <?foreach ($fichas as $ficha) {?>
                            <tr>
                                <td><?=$ficha->lastname?></td>
                                <td><?=$ficha->firstname?></td>
                                <td><?=$ficha->telefono?></td>                           
                                <td><? if ($ficha->interno == 0) {echo('-');} else {echo($ficha->interno);}?></td>
                                <td><? if ($ficha->celular == 0) {echo('-');} else {echo($ficha->celular);}?></td>                                                      
                                <td><?=$ficha->sede?></td>
                                <td><?=$ficha->puesto?></td>                             
                                <td><?=$ficha->email?></td>
                                <td>
                                <? if(($role == 'sysadmin') || ($role == 'admin')) { ?>
                                    <a href="<?=base_url();?>admin/editar_ficha/<?=$ficha->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="javascript:void(0);" class="remove" rel="<?=$ficha->id;?>"><span class="glyphicon glyphicon-trash"></span></a>                     
                                <? } ?>      
                                <td>
                            </tr>
                        <? } ?>

                    </tbody>
                </table>     
                <?php echo $this->pagination->create_links();?>    
            </div>
        </div>
    </div>
</div>    