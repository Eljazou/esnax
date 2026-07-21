<?php echo $this->Html->css('dataTables.bootstrap');
?>
<div class="row"> 
		<div class="col-md-12"> 
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Avances & Prêts'); ?></h3>
				<?php
				echo $this->Html->link(__("Demander une avance ou un prêt"), array('action' => 'add'), array('class' => "btn bg-purple btn-flat margin", 'style' => 'float:right;'));
				?>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Type</th>
							<th>Montant</th>
							<th>Echéance</th>
							<th>Motif</th>
							<th>Etat</th>
							<th>Réponse</th>
							<th>Date d'ajout</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<?php foreach ($avences as $avence): ?>
						<tr>
							<td><?php echo $this->Html->link($avence['User']['name'], array('controller' => 'users', 'action' => 'view', $avence['User']['id'])); ?></td>
							<td><?php echo h($avence['Avence']['type']); ?></td>
							<td><?php echo h($avence['Avence']['montant']); ?>&nbsp;DH</td>
							<td><?php if($avence['Avence']['type']=='Pret')echo h($avence['Avence']['echeances']).' Mois'; ?></td>
							<td><?php echo h($avence['Avence']['motif']); ?>&nbsp;</td>
							<td><?php
								if ($avence['Avence']['valide'] == 1)
									echo "Validé";
								if ($avence['Avence']['valide'] == 0)
									echo "En cours";
								if ($avence['Avence']['valide'] == -1)
									echo "Réfusé";
								?>&nbsp;</td>
							<td><?php echo h($avence['Avence']['repense']); ?>&nbsp;</td>
							<td><?php echo h($avence['Avence']['created']); ?>&nbsp;</td>
							<td class="actions">

								<?php
								if ($avence['Avence']['user_id'] == AuthComponent::user('id') && $avence['Avence']['valide'] == 0 &&
										$this->requestAction('/droits/getrole/avences/edit') == 1)
									echo $this->Html->link(__('Editer'), array('action' => 'edit', $avence['Avence']['id']), array('class' => "btn btn-primary"));
								if (AuthComponent::user('role') == 'Admin')
									echo $this->Html->link(__('Archiver'), array('action' => 'valider', $avence['Avence']['id'], -1), array('class' => "btn btn-primary"));
								?>
							</td>
						</tr>
					<?php endforeach; ?>
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
<script>
    $(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
</script>