<div class="formations view">
<h2><?php echo __('Formation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Catégorie'); ?></dt>
		<dd>
			<?php echo $this->Html->link($formation['Category']['name'], array('controller' => 'categories', 'action' => 'view', $formation['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fichier'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date de création'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editer la Formation'), array('action' => 'edit', $formation['Formation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Supprimer la Formation'), array('action' => 'delete', $formation['Formation']['id']), null, __(' Etes-vous sûr de vouloir supprimer # %s?', $formation['Formation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des Formations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouvelle Formation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des Catégories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouvelle Catégorie'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
