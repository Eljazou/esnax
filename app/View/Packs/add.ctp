<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Demande un pack'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Pack');
						 echo $this->Form->hidden('client_id', array('value' => $client_id));
						 echo $this->Form->input('nombre', array("type"=>"number",'label' => 'Nombre de pack', 'class' => 'form-control'));
						 
						 for($i=0;$i<5;$i++):
					?>
					
						<div class="col-md-6 col-xs-6" style="padding-left: 0px;">
							<?php echo $this->Form->input("Packdetail.$i.game_id", ['class' => 'form-control','label' => "Gamme"]); ?>
						</div>
						<div class="col-md-6 col-xs-6" style="padding-right: 0px;">
                        <?php echo $this->Form->input("Packdetail.$i.nombre", ["type"=>"number",'class' => 'form-control','label' => "Nombre"]);?>
						</div>
                  
                    <?php 
					endfor;
					echo $this->Form->end(array('label' => 'Ajouter',"required"=>"required", 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>

