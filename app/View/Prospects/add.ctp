<?php echo $this->Html->css('dataTables');
		?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="panel panel-success">
	<div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Ajouter Prospect'); ?></h3>
    </div>
	
        
            
                <div class="panel-body">
				<?php echo $this->Form->create('Prospect'); ?>
	<?php
		echo $this->Form->input('tyncode',array('class'=>'form-control'));
		echo $this->Form->input('societe',array('class'=>'form-control'));
		echo $this->Form->input('devis',array('class'=>'form-control'));
		echo $this->Form->input('nom',array('class'=>'form-control'));
		echo $this->Form->input('prenom',array('class'=>'form-control'));
		echo $this->Form->input('adresse1',array('class'=>'form-control'));
		echo $this->Form->input('adresse2',array('class'=>'form-control'));
		echo $this->Form->input('ville',array('class'=>'form-control'));
		echo $this->Form->input('pays',array('class'=>'form-control'));
		echo $this->Form->input('tel',array('class'=>'form-control'));
		echo $this->Form->input('portable',array('class'=>'form-control'));
		echo $this->Form->input('fax',array('class'=>'form-control'));
		echo $this->Form->input('mail',array('class'=>'form-control'));
		echo $this->Form->input('region',array('class'=>'form-control'));
		echo $this->Form->input('categorie',array('class'=>'form-control'));
		echo $this->Form->input('type',array('class'=>'form-control'));
	?>
	
</div>
<div class="box-footer">
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-success','div' => array('class' => 'well text-center'))); ?>

</div>
</div>
</div>
</div>




