<div class="box">
<h2><?php echo __('Marketing'); ?></h2>
		 			<?php echo $this->Html->link(__('Editer'), array('action' => 'edit'), array('class'=>'btn bg-purple btn-flat', 'style'=>'float:right;'));?>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($marketing['Marketing']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ligne'); ?></dt>
		<dd>
			<?php echo $this->Html->link($marketing['Ligne']['name'], array('controller' => 'lignes', 'action' => 'view', $marketing['Ligne']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Game'); ?></dt>
		<dd>
			<?php echo $this->Html->link($marketing['Game']['name'], array('controller' => 'games', 'action' => 'view', $marketing['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($marketing['User']['name'], array('controller' => 'users', 'action' => 'view', $marketing['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Annee'); ?></dt>
		<dd>
			<?php echo h($marketing['Marketing']['annee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($marketing['Marketing']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Previsions'); ?></dt>
		<dd>
			<?php echo h($marketing['Marketing']['previsions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($marketing['Marketing']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="box-body table-responsive">
            <div class="box-footer">
                <div class="related">
	<h3><?php echo __('Related Mar Details'); ?></h3>
	<?php if (!empty($marketing['MarDetail'])): ?>
	<table class="table table-bordered table-striped">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Marketing Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Vm'); ?></th>
		<th><?php echo __('Consomation'); ?></th>
		<th><?php echo __('Commentaire'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($marketing['MarDetail'] as $marDetail): ?>
		<tr>
			<td><?php echo $marDetail['id']; ?></td>
			<td><?php echo $marDetail['marketing_id']; ?></td>
			<td><?php echo $marDetail['user_id']; ?></td>
			<td><?php echo $marDetail['vm']; ?></td>
			<td><?php echo $marDetail['consomation']; ?></td>
			<td><?php echo $marDetail['commentaire']; ?></td>
			<td><?php echo $marDetail['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Voir'), array('controller' => 'mar_details', 'action' => 'view', $marDetail['id']),array('class'=>'btn btn-info')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mar_details', 'action' => 'edit', $marDetail['id']),array('class'=>'btn btn-warning')); ?>
				<?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'mar_details', 'action' => 'delete', $marDetail['id']),array('class'=>'btn btn-danger'), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mar Detail'), array('controller' => 'mar_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
</div>
</div>
