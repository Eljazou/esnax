<?php

echo $this->Html->css('dataTables.bootstrap');
		?>	
<style>
thead tr th{font-size: 15px;font-weight: 600;padding:5px 3px !important;}
</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title" style="font-size:24px;"><?php echo __('Groproduit'); ?></h3>
		<h2 style="color: #3c8dbc;text-align:center;font-size: 38px;"><?php echo h($groproduit['Groproduit']['name']); ?></h2>
    </div>
    <div class="box-body">
          <?php if (!empty($groproduit['Grovente'])): ?>

        <table id="example1" class="table table-bordered table-striped">
		<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Grosiste Id'); ?></th>
		<th><?php echo __('Groproduit Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Quantite'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
		$i = 0;
		foreach ($groproduit['Grovente'] as $grovente): ?>
		<tr>
			<td><?php echo $grovente['id']; ?></td>
			<td><?php echo $grovente['grosiste_id']; ?></td>
			<td><?php echo $grovente['groproduit_id']; ?></td>
			<td><?php echo $grovente['user_id']; ?></td>
			<td><?php echo $grovente['quantite']; ?></td>
			<td><?php echo $grovente['date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groventes', 'action' => 'view', $grovente['id']),array("class"=>"btn btn-primary")); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groventes', 'action' => 'edit', $grovente['id']),array("class"=>"btn btn-primary")); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groventes', 'action' => 'delete', $grovente['id']),array("class"=>"btn btn-primary"), null, __('Are you sure you want to delete # %s?', $grovente['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>
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
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}
        });
    });
</script>