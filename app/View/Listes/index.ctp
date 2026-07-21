<?php echo $this->Html->css('dataTables.bootstrap');
?>	
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Listes'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Utilisateur</th>
                    <th>Nom</th>
                    <th>Semaine</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($listes as $liste): ?>
                <tr>
                    <td><?php echo h($liste['Liste']['id']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($liste['User']['name'], array('controller' => 'users', 'action' => 'view', $liste['User']['id'])); ?></td>
                    <td><?php echo h($liste['Liste']['name']); ?>&nbsp;</td>
                    <td><?php echo h($liste['Liste']['semaine']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php echo $this->Html->link(__('Voir'), array('action' => 'view', $liste['Liste']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $liste['Liste']['id'])); ?></li>
                                <li><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $liste['Liste']['id']), null, __('Etes-vous sur de vouloir supprimer # %s?', $liste['Liste']['id'])); ?></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
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
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>