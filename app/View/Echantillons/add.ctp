<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"> <?php echo __('Ajouter un échantillon'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Echantillon');
                     echo $this->Form->input('game_id', array('label' => 'La gamme', 'class' => 'form-control'));
                    echo $this->Form->input('name', array('label' => 'Nom du produit', 'class' => 'form-control'));
                   echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>