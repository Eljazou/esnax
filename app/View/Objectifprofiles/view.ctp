<div class="objectifprofiles view">
<h2><?php echo __('Objectifprofile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($objectifprofile['Objectifprofile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($objectifprofile['Objectifprofile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($objectifprofile['Type']['name'], array('controller' => 'types', 'action' => 'view', $objectifprofile['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Objectif'); ?></dt>
		<dd>
			<?php echo h($objectifprofile['Objectifprofile']['objectif']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($objectifprofile['Objectifprofile']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Objectifprofile'), array('action' => 'edit', $objectifprofile['Objectifprofile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Objectifprofile'), array('action' => 'delete', $objectifprofile['Objectifprofile']['id']), null, __('Are you sure you want to delete # %s?', $objectifprofile['Objectifprofile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Objectifprofiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Objectifprofile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
