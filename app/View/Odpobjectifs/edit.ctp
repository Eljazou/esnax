<div class="panel panel-primary">
	<div class="panel-heading">
	<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $this->request->data['Odpobjectif']['id']), array('style'=>'float:right;','class'=>'btn bg-red btn-flat','confirm' => __('Vous êtes sur # %s?', $this->request->data['Odpobjectif']['id'])));  ?>
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;">Editer un objectif</h3>
		
    </div>
	<div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
				<?php echo $this->Form->create('Odpobjectif');
				echo $this->Form->input('id');
				?>
	<?php
		echo $this->Form->input('brochure_id',array('label' => 'Brochure','class'=>'form-control'));
		$region=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR"); 
		echo $this->Form->input('region',array("options"=>$region,'class'=>'form-control'));
		echo $this->Form->input('objectif',array('class'=>'form-control'));
		echo $this->Form->input('date_debut',array('class'=>'form-control'));
		echo $this->Form->input('date_fin',array('class'=>'form-control'));
		
	?>
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center col-md-12'))); ?>

</div>
</div>
</div>
</div>
</div>

