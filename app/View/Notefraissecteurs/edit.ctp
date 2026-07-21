<?php echo $this->Html->css('select2.min');   ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Edit Note frais secteurs</h3>
            </div>



            <div class="box-body">
                <?php echo $this->Form->create('Notefraissecteur'); ?>
                <?php
				echo $this->Form->input('id');
                echo $this->Form->input('ville', array("options" => $villes, 'class' => 'form-control'));
                echo $this->Form->input('destination', array("options" => $villes, 'class' => 'form-control'));
                $options = array("Ville" => 'Ville de départ', 'destination'=>'destination');
                echo $this->Form->input('nuit',array('options' => $options,'class'=>'form-control'));
                echo $this->Form->input('urbain', array('class' => 'form-control'));
                echo $this->Form->input('interville', array('class' => 'form-control'));
                echo $this->Form->input('hotel', array('class' => 'form-control'));
                echo $this->Form->input('restaurant', array('class' => 'form-control'));
                echo $this->Form->input('divers', array('class' => 'form-control'));
                ?>

            </div>
            <div class="box-footer">
                <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-success', 'div' => array('class' => 'well text-center'))); ?>

            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min'); 
 echo $this->Html->script('select2.full.min'); ?>
<script type="text/javascript">
           $(function () {
        $("#NotefraissecteurVille, #NotefraissecteurDestination").select2();
    });
     </script>