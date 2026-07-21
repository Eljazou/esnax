<div class="card">
    <div class="card-header">
        <h3 class="card-title fw-bold"><?php echo __('Organiser les brochures'); ?></h3>
    </div>
    <div class="card-body">
        <?php echo $this->Form->create('Brochureorganise');
        $i = 0;
        foreach ($lignes as $kligne => $vligne): ?>
            <div class="mb-6">
                <h3 class="fs-5 fw-bold text-gray-900 mb-4"><?php echo $vligne; ?></h3>
                <div class="row g-4">
                    <?php foreach ($brochures as $value):
                        $ordere = $id = "";
                        foreach ($organiser as $val) {
                            if ($val['Brochureorganise']['brochure_id'] == $value["Brochure"]["id"] &&
                                $val['Brochureorganise']['ligne_id'] == $kligne && $val['Brochureorganise']['category_id'] == $cat_id) {
                                $ordere = $val['Brochureorganise']['ordre'];
                                $id = $val['Brochureorganise']['id'];
                            }
                        }
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <label class="fw-semibold fs-7 text-gray-700 mb-1 d-block">
                                <?php echo $value["Brochure"]["name"]; ?>
                            </label>
                            <?php echo $this->Form->input("$i.ordre", array('value' => $ordere, 'placeholder' => 'order', 'label' => false, 'class' => 'form-control form-control-sm')); ?>
                        </div>
                        <?php
                        if ($id == '') {
                            echo $this->Form->hidden("$i.category_id", array('value' => $cat_id));
                            echo $this->Form->hidden("$i.ligne_id", array('value' => $kligne));
                            echo $this->Form->hidden("$i.brochure_id", array('value' => $value["Brochure"]["id"]));
                        } else {
                            echo $this->Form->hidden("$i.id", array('value' => $id));
                        }
                        $i++;
                    endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="text-center mt-6">
            <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary')); ?>
        </div>
    </div>
</div>