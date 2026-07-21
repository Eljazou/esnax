<div class="panel panel-primary">
	<div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> <?php echo __('Add User'); ?></h3>
    </div>
	<div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
				<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->input('ecole_id',array('class'=>'form-control'));
		echo $this->Form->input('etudiant_id',array('class'=>'form-control'));
		echo $this->Form->input('valide',array('class'=>'form-control'));
		echo $this->Form->input('username',array('class'=>'form-control'));
		echo $this->Form->input('password',array('class'=>'form-control'));
		echo $this->Form->input('type',array('class'=>'form-control'));
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

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ecoles'), array('controller' => 'ecoles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ecole'), array('controller' => 'ecoles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Etudiants'), array('controller' => 'etudiants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Etudiant'), array('controller' => 'etudiants', 'action' => 'add')); ?> </li>
	</ul>
</div>
