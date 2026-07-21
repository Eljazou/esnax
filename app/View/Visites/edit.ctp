<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"><?php echo __('Editer la visite'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Visite'); ?>
                    <?php
                    echo $this->Form->input('id', array('class' => 'form-control'));
                    echo $this->Form->input('commentaire', array('label' => 'Commentaire','class' => 'form-control'));
                    echo $this->Form->input('objection', array('label' => 'Objections','class' => 'form-control'));
                    echo $this->Form->input('veille', array('label' => 'Veille','class' => 'form-control'));
                    //echo $this->Form->input('date', array('label' => 'Date','class' => 'form-control'));
                    ?>
					<div class="col-md-12" style="padding:0;">
					<?php
					echo $this->Form->input('date', ['type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'label' => "Date"]);
                    ?>
					</div>
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12','style'=>'float:left;'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( [ "../widgets/datepicker" ], factory );
	} else {
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {
datepicker.regional.fr = {
	closeText: "Fermer",
	prevText: "Précédent",
	nextText: "Suivant",
	currentText: "Aujourd'hui",
	monthNames: [ "janvier", "février", "mars", "avril", "mai", "juin",
		"juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
	monthNamesShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin",
		"juil.", "août", "sept.", "oct.", "nov.", "déc." ],
	dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
	dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
	dayNamesMin: [ "D","L","M","M","J","V","S" ],
	weekHeader: "Sem.",
	dateFormat: "yy-mm-dd",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.fr );

return datepicker.regional.fr;

} ) );
    $("#datepicker").datepicker($.datepicker.regional['fr']);
</script>