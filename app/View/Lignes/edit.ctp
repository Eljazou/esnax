<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Edit ligne'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Ligne');
                    echo $this->Form->input('id', array('class' => 'form-control'));
                    echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Ligne'));
                    echo $this->Form->input('message_event', array('class' => 'form-control', 'label' => 'Message d\'événement', 'type' => 'textarea', 'style' => 'height: 100px;'));
                    echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>

