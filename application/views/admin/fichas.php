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
                            <th rel="id">Id</th>
                            <th rel="nombre">Nombre</th>
                            <th rel="direccion">Apellido</th>
                            <th rel="contacto">Teléfono</th>
                            <th rel="contacto">Interno</th>
                            <th rel="contacto">Celular</th>
                            <th rel="contacto">Sede</th>
                            <th rel="codigo">email</th>
                            <? if($role == 'sysadmin') { ?>
                                <th rel="acction">Acciones</th>
                            <? } ?> 
                        </tr>
                    </thead>
                    <tbody>
                        <?foreach ($fichas as $ficha) {?>
                            <tr>
                                <td><?=$ficha->id?></td>
                                <td><?=$ficha->firstname?></td>
                                <td><?=$ficha->lastname?></td>
                                <td><?=$ficha->telefono?></td>                           
                                <td><?=$ficha->interno?></td>                           
                                <td><?=$ficha->celular?></td>                           
                                <td><?=$ficha->sede?></td>                           
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
            </div>
        </div>
    </div>
</div>    