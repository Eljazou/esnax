<div class="panel panel-primary">
	<div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> <?php echo __('Editer la commande'); ?></h3>
    </div>
	<div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
				<?php echo $this->Form->create('Commande'); ?>
	<?php
		echo $this->Form->input('id',array('class'=>'form-control'));
		echo $this->Form->input('user_id',array('label' => 'Utilisateur','class'=>'form-control'));
		echo $this->Form->input('client_id',array('label' => 'Client','class'=>'form-control'));
	?>
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center'))); ?>
</div>
</div>
</div>
</div>
</div>
