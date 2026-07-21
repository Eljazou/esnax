<div class="avences view">
<h2><?php echo __('Avence'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($avence['User']['name'], array('controller' => 'users', 'action' => 'view', $avence['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Montant'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['montant']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Echeances'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['echeances']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Motif'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['motif']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valide'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['valide']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($avence['Avence']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Avence'), array('action' => 'edit', $avence['Avence']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Avence'), array('action' => 'delete', $avence['Avence']['id']), null, __('Are you sure you want to delete # %s?', $avence['Avence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Avences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Avence'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
