<div class="autoechantiants view">
<h2><?php echo __('Autoechantiant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($autoechantiant['Autoechantiant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($autoechantiant['Category']['name'], array('controller' => 'categories', 'action' => 'view', $autoechantiant['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gadjets'); ?></dt>
		<dd>
			<?php echo h($autoechantiant['Autoechantiant']['gadjets']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classification'); ?></dt>
		<dd>
			<?php echo h($autoechantiant['Autoechantiant']['classification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($autoechantiant['Autoechantiant']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Autoechantiant'), array('action' => 'edit', $autoechantiant['Autoechantiant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Autoechantiant'), array('action' => 'delete', $autoechantiant['Autoechantiant']['id']), null, __('Are you sure you want to delete # %s?', $autoechantiant['Autoechantiant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Autoechantiants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Autoechantiant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
