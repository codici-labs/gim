<?php echo add_jscript('function');?>  
 <?php echo add_jscript('jquery.confirm');?>
<script type="text/javascript">     
    
    var base_url = "<?php echo base_url()?>";

    $(document).ready(function () {
        result = 20;


        $("body").on('click','.remove',function(){
            var id = $(this).attr('rel');
            $.confirm({
                text: "Desea eliminar esta sede?",
                title: "Confirmación",
                confirm: function(button) {
                    window.location.replace('<?=base_url();?>admin/borrar_sede/'+id);
                   
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
            <div class="col-md-10"><h3 class="panel-title fix-title">Sedes</h3></div>
            <div class="col-md-2 text-right ">
            <? if($role != 'user'){?>   <a href="<?=base_url();?>admin/agregar_sede" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Agregar</a> <? } ?>   
            </div>
        </div>   
    </div>

    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead id="table_news">
                      <tr>
                        <th rel="nombre"><a href="<?=base_url();?>admin/sedes/nombre">Nombre</a></th>
                        <th rel="direccion"><a href="<?=base_url();?>admin/sedes/direccion">Dirección</a></th>
                        <th rel="codigo"><a href="<?=base_url();?>admin/sedes/codigo">Código</a></th>
                        <th rel="contacto"><a href="<?=base_url();?>admin/sedes/contacto">Contacto</a></th>
                        <th rel="listacorreo"><a href="<?=base_url();?>admin/sedes/mail_list">Lista de correo</a></th>
                        <? if($role != 'user'){?> 
                            <th rel="acction">Acciones</th>
                        <? } ?>   
                      </tr>
                    </thead>
                    <tbody>
                    <?foreach ($sedes as $sede) {?>
                        <tr>
                            <td><?=$sede->nombre?></td>
                            <td><?=$sede->direccion?></td>
                            <td><?=$sede->codigo?></td>
                            <td><?=$sede->contacto?></td>
                            <td><?=$sede->mail_list?></td> 
                            <? if($role != 'user'){?>                                
                                <td>
                                    <a href="<?=base_url();?>admin/editar_sede/<?=$sede->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="javascript:void(0);" class="remove" rel="<?=$sede->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
                                    
                                <td>
                            <? } ?>
                        </tr>
                    <? } ?>

                    </tbody>
                </table>          
            </div>
        </div>
    </div>
</div>    