<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Rapport d\'affichage des brochures'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Brochure'); 
                    $i=0; ?>
                    <input name="data[Brochure][<?php echo $i; ?>][client_id]" value="<?php echo $client_id; ?>" type="hidden">
                    <?php foreach ($brochures as $value) {
                        ?>
                        <div class="input text col-md-6">
                            <input name="data[Brochure][<?php echo $i; ?>][client_id]" value="<?php echo $client_id; ?>" type="hidden">
                            <label>
                                <input type="checkbox" name="data[Brochure][<?php echo $i; ?>][brochure_id]" value="<?php echo $value['Brochure']['id']; ?>">
                                <a href="/img/brochures/<?php echo $value['Brochure']['file']; ?>">
                                    <?php echo $value['Brochure']['name']; ?>
                                </a>
                            </label>
                        </div> 
                        <?php $i++; }
                        echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12')));
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>