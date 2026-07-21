<div class="objectifs view">
<h2><?php echo __('Objectif'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($objectif['Objectif']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($objectif['Type']['name'], array('controller' => 'types', 'action' => 'view', $objectif['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($objectif['User']['name'], array('controller' => 'users', 'action' => 'view', $objectif['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Objectif'); ?></dt>
		<dd>
			<?php echo h($objectif['Objectif']['objectif']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date de création'); ?></dt>
		<dd>
			<?php echo h($objectif['Objectif']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editer l\'objectif'), array('action' => 'edit', $objectif['Objectif']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Supprimer l\'Objectif'), array('action' => 'delete', $objectif['Objectif']['id']), null, __('Etes-vous sûr de vouloir supprimer # %s?', $objectif['Objectif']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des Objectifs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouveau Objectif'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouveau Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des utilisateurs'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouveau utilisateur'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
