<?php

echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('btn-style');
?>	
<style type="text/css">
    table.dataTable thead > tr > th {
    padding-right: inherit;
}
</style>
<div class="row">
    <div class="col-md-12">
<div class="box">
    <div class="box-header table-responsive">
        <h3 class="box-title col-md-12"><?php echo __('Prospect compagnes'); ?><?php echo $this->Html->link(__(''), array('action' => 'add',), array('class' => 'fa fa-plus btn-sc btn btn-outline-success ','style'=>'float:right;')); ?></h3>

        

    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Affaire</th>
                    <th>Chef de projet</th>
                    <th>Nom</th>
                    <th>Code wavesoft</th>
                    <th>Script</th>
                    <th><i class="ion-android-calendar"></i> debut</th>
                    <th><i class="ion-android-calendar"></i> fin</th>
                    <th>date d'ajout</th>
                    <th width="19%" colspan="3">Actions</th>
                </tr>
            </thead>
            <?php
            $i=0;
             foreach ($prospectcompagnes as $prospectcompagne): ?>
                <tr>
                    <!-- <td><?php echo h($prospectcompagne['Prospectcompagne']['id']); ?>&nbsp;</td> -->
                    <td><?php echo $this->Html->link($prospectcompagne['Prospectaffaire']['name'], array('controller' => 'prospectaffaires', 'action' => 'view', $prospectcompagne['Prospectaffaire']['id'])); ?></td>
                    <td><?php echo $this->Html->link($prospectcompagne['User']['name'], array('controller' => 'users', 'action' => 'view', $prospectcompagne['User']['id'])); ?></td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['name']); ?>&nbsp;</td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['code_wavesoft']); ?>&nbsp;</td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['type_client']); ?>&nbsp;</td>
                    <td><?php 
                    if($prospectcompagne['Prospectcompagne']['file'] != null){?>
                       
                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo $i ?>"> <i class="ion-image" style="font-size: 23px;padding: 0px;"></i></button>

                        <div class="modal fade" id="exampleModalCenter<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle<?php echo $i ?>" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <img src="/img/affaires/<?php echo h($prospectcompagne['Prospectcompagne']['file'])?>">
                            </div>
                          </div>
                        </div>
                    <?php }else{
                        echo "";
                    }
                     ?>
                        </td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['date_debut']); ?>&nbsp;</td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['date_fin']); ?>&nbsp;</td>
                    <td><?php echo h($prospectcompagne['Prospectcompagne']['created']); ?>&nbsp;</td>
                    <td class="actions" colspan="3">
                        <?php echo $this->Html->link(__(''), array('action' => 'view', $prospectcompagne['Prospectcompagne']['id']), array('class' => 'fa fa-eye btn-in btn btn-outline-info')); ?>
                        <?php echo $this->Html->link(__(''), array('action' => 'edit', $prospectcompagne['Prospectcompagne']['id']), array('class' => 'fa fa-pencil btn-wr btn btn-outline-warning')); ?>
                        <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $prospectcompagne['Prospectcompagne']['id']), array('class' => 'fa fa-trash btn-dn btn btn-outline-danger'), __('Etes-vous sur de vouloir supprimer ?')); ?>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
</div>
</div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>