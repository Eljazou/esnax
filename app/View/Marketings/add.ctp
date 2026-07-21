<style>
.inputs .input{
	    width: 18%;
}
.inputs{
	    display: flex;
		justify-content: space-around;
		    grid-column-gap: 14px;
}
.content-wrapper{
	min-height: 1000px !important;
}

</style>

<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ajouter Marketing</h3>
  </div>
  <div class="panel-body">
    <?php echo $this->Form->create('Marketing'); 
		echo $this->Form->input('user_id',array("label"=>"Responsable",'class'=>'form-control',"div"=>"col-md-6"));
		$annee=array();
		for($i=date("Y");$i<date("Y")+5;$i++)
			$annee[$i]=$i;
		echo $this->Form->input('annee',array("options"=>$annee,'class'=>'form-control',"div"=>"col-md-6","style"=>"margin-bottom: 45px;"));
		echo "<h2 style='padding: 17px; border-bottom: 1px solid black; '>Ajouter les provisions</h2>";
		
		for($i=0;$i<10;$i++)
		{?>
			<div class='row inputs'>
			<?php echo $this->Form->input("data.$i.ligne_id",array('class'=>'form-control'));
			echo $this->Form->input("data.$i.game_id",array("label"=>"Gamme",'class'=>'form-control'));
			echo $this->Form->input("data.$i.echantillons",array("value"=>'0','class'=>'form-control'));
			echo $this->Form->input("data.$i.actions",array("value"=>'0','class'=>'form-control'));
			echo $this->Form->input("data.$i.packs",array("value"=>'0','class'=>'form-control'));
			echo $this->Form->input("data.$i.ca",array("value"=>'0',"label"=>"Objectif nb de boîtes",'class'=>'form-control'));
			echo $this->Form->input("data.$i.budget",array("value"=>'0','class'=>'form-control'));

			 ?>
			</div>
	<?php	}
	?>
  </div>
  <div class="panel-footer">
	<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large')); ?>
	</div>
</div>
</div>
</div>
</div>