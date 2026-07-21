<?php

echo $this->Html->css('dataTables.bootstrap');
		?>	
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Grosistes'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Nom</th>
                    <th>Responsable</th>
                    <th>Region</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
	<?php foreach ($grosistes as $grosiste): ?>
            <tr>
                <td><?php echo h($grosiste['Grosiste']['id']); ?>&nbsp;</td>
                <td><?php echo h($grosiste['Grosiste']['name']); ?>&nbsp;</td>
                <td><?php echo $this->requestAction('/users/system_get_name_user/'.$grosiste['Grosiste']['super_id']); ?>&nbsp;</td>
                <td><?php echo h($grosiste['Grosiste']['region']); ?>&nbsp;</td>
                <td><?php echo h($grosiste['Grosiste']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Désarchiver'), array('action' => 'archive', $grosiste['Grosiste']['id'],1)); ?>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
	<?php echo $this->Html->script('jquery-2.2.3.min');
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