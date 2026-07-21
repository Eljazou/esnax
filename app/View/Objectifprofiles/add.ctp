
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"> <?php echo __('Ajouter un objectif profile'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Objectifprofile');
                    $i=-1;
                    echo $this->Form->input('name', array('label' =>'Nom'));
                    foreach ($types as $key => $value) : $i++;
                    ?>
                        <div class="input text">
                            <label for="ObjectifObjectif">Objectif</label>
                            <input value="<?php echo $key; ?>" name="data[<?php echo $i; ?>][type]" type="hidden" >
                            <input value="<?php echo $value; ?>" name="data[<?php echo $i; ?>][name]" class="form-control"  type="text" disabled="disabled" >
                            <input value="0" name="data[<?php echo $i; ?>][objectif]" class="form-control"  type="text" >
                        </div>
                    <?php endforeach;
                    echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>