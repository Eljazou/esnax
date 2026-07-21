<div class="box">
      <div class="box-header table-responsive">
           <h3 class="box-title">Ajouter le nombre de contacts à atteindre par région et par produit</h3>
      </div>
	  <?php echo $this->Form->create('Odpobjectif'); ?>
	  <div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-6">
					<div class="panel panel-primary">
						<div class="panel-body form-horizontal payment-form">
							<?php
								echo $this->Form->input('date_debut',array('class'=>'form-control'));
								echo $this->Form->input('date_fin',array('class'=>'form-control'));
								 ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="box-body">
         <table id="example1" class="table table-bordered table-striped">
		 <thead>
			<tr>
				<th>Regions</th>
				<?php $region_odp=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR"); 
					 foreach($region_odp as $k=>$v)
						echo "<th>$v</th>";
				?>
			</tr>
	</thead>
	<?php 
	
	foreach ($brochures as $id=>$v): 
		echo $this->Form->hidden("brochure.$id");
	?>
	<tr>
		<td> <?php echo $v; ?></td>
		<?php $region_odp=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR"); 
					 foreach($region_odp as $k=>$v)
						echo "<td>".$this->Form->input("brochure.$id.$v",array("label"=>false,'class'=>'form-control'))."</td>";
				?>
	</tr>
<?php endforeach; ?>
	</table>
	</div>
	</div>
	
<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center col-md-12'))); ?>

