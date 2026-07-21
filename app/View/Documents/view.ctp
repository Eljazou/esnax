<div class="documents view">
<h2><?php echo __('Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($document['Document']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['User']['name'], array('controller' => 'users', 'action' => 'view', $document['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document'); ?></dt>
		<dd>
			<?php echo h($document['Document']['document']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo h($document['Document']['archive']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($document['Document']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document'), array('action' => 'edit', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document'), array('action' => 'delete', $document['Document']['id']), null, __('Are you sure you want to delete # %s?', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
