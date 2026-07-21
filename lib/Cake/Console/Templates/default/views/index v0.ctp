<?php
        echo "<?php echo \$this->Html->css('dataTables.bootstrap');
		?>";
	?>
	
<div class="box">
      <div class="box-header table-responsive">
           <h3 class="box-title"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h3>
		 <?php echo "\t\t\t<?php echo \$this->Html->link(__('Ajouter'), array('action' => 'add', ),array('style'=>'float:right;','class'=>'btn bg-purple btn-flat')); ?>\n";
		 ?>
      </div>
	<div class="box-body">
         <table id="example1" class="table table-bordered table-striped">
		 <thead>
			<tr>
			<?php foreach ($fields as $field): ?>
				<th><?php echo $field; ?></th>
			<?php endforeach; ?>
				<th class="actions"><?php echo "Actions"; ?></th>
			</tr>
	</thead>
	<?php
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td><?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Voir'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn btn-info')); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Editer'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn btn-warning')); ?>\n";
		echo "\t\t\t<?php echo \$this->Form->postLink(__('Supprimer'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'btn btn-danger'), __('Etes-vous sur de vouloir supprimer ?')); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
	</table>
	</div>
	</div>
	<?php
        echo "<?php echo \$this->Html->script('jquery-2.2.3.min');
        echo \$this->Html->script('bootstrap.min');
        echo \$this->Html->script('app.min');
        echo \$this->Html->script('jquery.dataTables.min');
        echo \$this->Html->script('jquery.slimscroll.min');
        echo \$this->Html->script('fastclick');
        echo \$this->Html->script('demo');
        ?>
		";
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