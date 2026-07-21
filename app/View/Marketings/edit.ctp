<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Editer l'action</h3>
	</div>
	<div class="panel-body">
		<div class="col-lg-6">
			<div class="panel panel-primary">
				<div class="card-body">
					<?php echo $this->Form->create('Marketing'); ?>
					<?php
					echo $this->Form->input('id', array('class' => 'form-control'));

					echo $this->Form->input('ligne_id', array('class' => 'form-control'));
					echo $this->Form->input('game_id', array("label" => "Gamme", 'class' => 'form-control'));
					echo $this->Form->input('user_id', array("label" => "Responsable", 'class' => 'form-control'));
					$annee = array();
					for ($i = (date("Y") - 1); $i < date("Y") + 5; $i++)
						$annee[$i] = $i;
					echo $this->Form->input('annee', array("options" => $annee, 'class' => 'form-control'));
					echo $this->Form->input('echantillons', array('class' => 'form-control'));
					echo $this->Form->input('actions', array('class' => 'form-control'));
					echo $this->Form->input('packs', array('class' => 'form-control'));
					echo $this->Form->input("ca", array("label" => "Chiffre d'affaire", 'class' => 'form-control'));
					echo $this->Form->input("budget", array('class' => 'form-control'));
					?>
				</div>
			</div>
			<div class="panel-footer">
				<?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'text-center'))); ?>
			</div>
		</div>
	</div>