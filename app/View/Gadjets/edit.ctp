<div class="panel panel-primary">
	<div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> <?php echo __('Editer Gadget'); ?></h3>
    </div>
	<div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
				<?php echo $this->Form->create('Gadjet'); ?>
	<?php
		echo $this->Form->input('id',array('class'=>'form-control'));
		echo $this->Form->input('user_id',array('label' => 'utilisateur','class'=>'form-control'));
		echo $this->Form->input('echantillon_id',array('label' => 'Echnatillon','class'=>'form-control'));
		echo $this->Form->input('quantite',array('label' => 'Quantité','class'=>'form-control'));
		echo $this->Form->input('date_debut',array('label' => 'Date début','class'=>'form-control'));
		echo $this->Form->input('date_fin',array('label' => 'Date fin','class'=>'form-control'));
		echo $this->Form->input('archive',array('label' => 'Archive','class'=>'form-control'));
	?>
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center'))); ?>
</div>
</div>
</div>
</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $this->Form->value('Gadjet.id')), null, __('Etes-vous sur de vouloir supprimer  # %s?' , $this->Form->value('Gadjet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Liste des Gadgets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Liste des utilisateurs'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouveau utilisateur'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Liste des échantillons'), array('controller' => 'echantillons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouveau échantillon'), array('controller' => 'echantillons', 'action' => 'add')); ?> </li>
	</ul>
</div>
