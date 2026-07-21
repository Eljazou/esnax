<?php echo $this->Html->css('dataTables.bootstrap');
		?>	
<div class="box">
      <div class="box-header">
           <h3 class="box-title"><?php echo __('Groventes'); ?></h3>
      </div>
	<div class="box-body">
         <table id="example1" class="table table-bordered table-striped">
		 <thead>
			<tr>
							<th>id</th>
							<th>grosiste_id</th>
							<th>groproduit_id</th>
							<th>user_id</th>
							<th>quantite</th>
							<th>date</th>
							<th class="actions">Actions</th>
			</tr>
	</thead>
	<?php foreach ($groventes as $grovente): ?>
	<tr>
		<td><?php echo h($grovente['Grovente']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($grovente['Grosiste']['name'], array('controller' => 'grosistes', 'action' => 'view', $grovente['Grosiste']['id'])); ?></td>
		<td><?php echo $this->Html->link($grovente['Groproduit']['name'], array('controller' => 'groproduits', 'action' => 'view', $grovente['Groproduit']['id'])); ?></td>
		<td><?php echo $this->Html->link($grovente['User']['name'], array('controller' => 'users', 'action' => 'view', $grovente['User']['id'])); ?></td>
		<td><?php echo h($grovente['Grovente']['quantite']); ?>&nbsp;</td>
		<td><?php echo h($grovente['Grovente']['date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $grovente['Grovente']['id'])); ?>
			<?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $grovente['Grovente']['id'])); ?>
			<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $grovente['Grovente']['id']), null, __('Etes-vous sur de vouloir supprimer # %s?', $grovente['Grovente']['id'])); ?>
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