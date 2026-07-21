<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Editer'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Autoechantiant'); ?>
                    <?php
                    echo $this->Form->input('id', array('class' => 'form-control'));
                    $data=$this->request->data["Autoechantiant"]["gadjets"];
                    $data= explode("||", $data);
                    for ($i = 0; $i < 5; $i++) {
                        echo '<div class="box-header"><h4> '.($i+1) .' echantillon</h4>';
                        if(isset($data[$i]))
                        {
                            $info= explode("&&", $data[$i]);
                            echo $this->Form->input('a.'.$i.'.echantillons', array('label' => "Echantillon",'class' => 'form-control',
                                'type'=>'select', 'options'=>$echantillons, 'default'=>$info[0]));
                            echo $this->Form->input('a.'.$i.'.nombre', array('label' => "Nombre de boite",'class' => 'form-control','value'=>$info[1]));
                        }
                        else
                        {
                            echo $this->Form->input('a.'.$i.'.echantillons', array('label' => "Echantillon",'class' => 'form-control'));
                            echo $this->Form->input('a.'.$i.'.nombre', array('label' => "Nombre de boite",'class' => 'form-control'));
                        }
                        echo "</div>";
                    }
                    ?>
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>