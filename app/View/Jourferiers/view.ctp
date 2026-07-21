<div class="jourferiers view">
<h2><?php echo __('Jourferier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jourferier['Jourferier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($jourferier['Jourferier']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Debut'); ?></dt>
		<dd>
			<?php echo h($jourferier['Jourferier']['date_debut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Fin'); ?></dt>
		<dd>
			<?php echo h($jourferier['Jourferier']['date_fin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($jourferier['Jourferier']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Jourferier'), array('action' => 'edit', $jourferier['Jourferier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Jourferier'), array('action' => 'delete', $jourferier['Jourferier']['id']), null, __('Are you sure you want to delete # %s?', $jourferier['Jourferier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jourferiers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jourferier'), array('action' => 'add')); ?> </li>
	</ul>
</div>
