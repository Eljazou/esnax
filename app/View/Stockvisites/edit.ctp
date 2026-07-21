<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="card card-info">
	<div class="card-header">
        <h3 class="card-title"><?php echo __('Edit Stockvisite'); ?></h3>
    </div>
	
        
            
                <div class="card-body">
				<?php echo $this->Form->create('Stockvisite'); ?>
	<?php
		echo $this->Form->input('id',array('class'=>'form-control'));
		echo $this->Form->input('visite_id',array('class'=>'form-control'));
		echo $this->Form->input('produit_id',array('class'=>'form-control'));
		echo $this->Form->input('quantite',array('class'=>'form-control'));
		echo $this->Form->input('commentaire',array('class'=>'form-control'));
		echo $this->Form->input('type',array('class'=>'form-control'));
	?>
	
</div>
<div class="box-footer">
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-outline-info','div' => array('class' => 'well text-center'))); ?>

</div>
</div>
</div>
</div>




