<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Demande d\'une action'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Action'); ?>
                    <?php
                    echo $this->Form->hidden('client_id', array('value' => $client_id));?>
                    <div class="col-md-6 col-xs-6" style="padding-left: 0px;">
                        <?php
                        echo $this->Form->input('date_debut', ['type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'label' => "Date début"]);
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-6" style="padding-right: 0px;">
                        <?php
                        echo $this->Form->input('date_fin', ['type' => 'text',"required"=>"required", 'class' => 'form-control', 'id' => 'datepicker1', 'label' => "Date fin"]);
                        ?>
                    </div>
                    <?php 
					echo $this->Form->input('game_id', array('label' => 'Gamme', 'class' => 'form-control choix_multi',"multiple","name" => "gamme[]"));
					$option=array("F"=>"F","SF"=>"SF");
					echo $this->Form->input('nature', array('label' => 'Nature action','options' => $option,  'class' => 'form-control'));
					
					echo $this->Form->input('name', array("type"=>"text",'label' => 'Action',  'class' => 'form-control','onkeypress'=>'if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;'));
					echo $this->Form->input('description', array('label' => 'Description', 'class' => 'form-control'));
					
					echo $this->Form->end(array('label' => 'Ajouter',"required"=>"required", 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    (function (factory) {
        if (typeof define === "function" && define.amd) {
            define(["../widgets/datepicker"], factory);
        } else {
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {
        datepicker.regional.fr = {
            closeText: "Fermer",
            prevText: "Précédent",
            nextText: "Suivant",
            currentText: "Aujourd'hui",
            monthNames: ["janvier", "février", "mars", "avril", "mai", "juin",
                "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
                "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
            weekHeader: "Sem.",
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""};
        datepicker.setDefaults(datepicker.regional.fr);

        return datepicker.regional.fr;

    }));
    $("#datepicker").datepicker($.datepicker.regional['fr']);
    $("#datepicker1").datepicker($.datepicker.regional['fr']);
</script>
<?php
echo $this->Html->css('select2.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
 ?>
<script>
    $(function () {
            $('.choix_multi').select2();
        });
</script>