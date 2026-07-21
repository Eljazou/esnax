<div class="box">
<h2><?php echo __('Pack'); ?></h2>
		 			<?php echo $this->Html->link(__('Editer'), array('action' => 'edit'), array('class'=>'btn bg-purple btn-flat', 'style'=>'float:right;'));?>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pack['Pack']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pack['User']['name'], array('controller' => 'users', 'action' => 'view', $pack['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pack['Client']['id'], array('controller' => 'clients', 'action' => 'view', $pack['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($pack['Pack']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pack['Pack']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="box-body table-responsive">
            <div class="box-footer">
                <div class="related">
	<h3><?php echo __('Related Packdetails'); ?></h3>
	<?php if (!empty($pack['Packdetail'])): ?>
	<table class="table table-bordered table-striped">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Pack Id'); ?></th>
		<th><?php echo __('Gamme Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pack['Packdetail'] as $packdetail): ?>
		<tr>
			<td><?php echo $packdetail['id']; ?></td>
			<td><?php echo $packdetail['pack_id']; ?></td>
			<td><?php echo $packdetail['gamme_id']; ?></td>
			<td><?php echo $packdetail['nombre']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Voir'), array('controller' => 'packdetails', 'action' => 'view', $packdetail['id']),array('class'=>'btn btn-info')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'packdetails', 'action' => 'edit', $packdetail['id']),array('class'=>'btn btn-warning')); ?>
				<?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'packdetails', 'action' => 'delete', $packdetail['id']),array('class'=>'btn btn-danger'), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Packdetail'), array('controller' => 'packdetails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
</div>
</div>
