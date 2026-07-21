<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<div id="pretModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-xs-12" style="margin-top: 8%;max-height: 370px;overflow: auto;border-radius: 6px;font-size: 16px;padding: 0px;">
            <div class="modal-header col-xs-12" style="background:#469ed1;color: #fff;">
                <h2 class="modal-title" id="gridModalLabel" style="width: auto;float: left;">Demande de Prêt : Règles et conditions</h2>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 35px;float: right;margin-top: -11px;">×</button> -->
            </div>
			<div class="modal-body col-xs-12">
				<div class="col-xs-12">
					<p>L’avantage prêt personnel accordé au salarié est mis en place afin de supporter les employés et les aider pour subvenir à un imprévu et/ ou situation urgente dans la limite du plafond accordé par la société et sous réserve des conditions financières de la société.</p>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Le prêt ne doit être demandé que pour des raisons urgentes.</span>
					<span class="col-xs-12" style="margin-bottom:12px;">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Le prêt est accordé sur la base des conditions spécifiées par la société.</span>
					<p>Les conditions pour obtenir le prêt sont les suivantes :</p>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Le montant du Prêt est plafonné à deux mois de salaire .</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Seuls les employés titulaires qui ont au moins une année de service ont le droit de déposer une demande de prêt.</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Le prêt est à amortir dans une durée de 12 mois au maximum</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Une lettre écrite, datée et signée par le demandeur est obligatoire afin d'expliquer le motif du prêt.</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> le prêt ne sera que débloqué qu’après la légalisation de la signature d’un écrit de reconnaissance de dette.  En cas de départ, le reliquat du prêt devient exigible immédiatement.</span>
					<br>
				</div>
			</div>
			<div class="modal-footer col-xs-12">
				<span style="float:left;"><input type="checkbox" class="check" value=""><b> j'ai lu et j'accepte les conditions</b></span><button type="button" class="btn btn-primary valider" style="float:right;">Valider</button>
			</div>
		</div>
	</div>
</div>

<div id="avanceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-xs-12" style="margin-top: 8%;max-height: 370px;overflow: auto;border-radius: 6px;font-size: 16px;padding: 0px;">
            <div class="modal-header col-xs-12" style="background:#469ed1;color: #fff;">
                <h2 class="modal-title" id="gridModalLabel" style="width: auto;float: left;">Demande d’avance sur Salaire : Règles et conditions</h2>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 35px;float: right;margin-top: -11px;">×</button> -->
            </div>
			<div class="modal-body col-xs-12">
				<div class="col-xs-12">
					<p>Tout employé est en droit de faire une demande d’avance sur salaire à condition que :</p>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> L’employé est confirmé dans son poste.</span>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> L’employé n’ait pas de prêt en cours vis-à-vis de la société</span>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> L’employé n’est pas en période de préavis</span>
					<span class="col-xs-12" style="margin-bottom:12px;">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> L’employé n’ait pas effectué plus que 3 demandes d’avance dans l’année.</span>
					<p>Si toutes ces conditions sont réunies, l’employé peut alors déposer  une avance sur salaire . Toutefois, il est à signaler que :</p>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;(1) L’avance sur salaire est prélevée sur le salaire du même mois.</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;(2) l’avance sur salaire ne doit pas excéder 50% du salaire net, et ne peut être accordée avant le 10 du mois.</span>
					<br>
					<span class="col-xs-12">&nbsp;&nbsp;&nbsp;(3) Les avances ne sont pas accordées aux salariés bénéficiant d’une domiciliation de salaire auprès de la Banque, sauf accord express de la Direction Générale. Cet accord est limité au quart (¼) du salaire net.</span>
					<br>
				</div>
			</div>
			<div class="modal-footer col-xs-12">
				<span style="float:left;"><input type="checkbox" class="check" value=""><b> j'ai lu et j'accepte les conditions</b></span><button type="button" class="btn btn-primary valider" style="float:right;">Valider</button>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"> Formulaire de demande </h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Avence'); ?>
                    <?php
                    $sizes = array('Pret' => 'Demande d\'un prêt','Avance' => 'Demande d\'une avance');
					//$sizes = array('Avance' => 'Demande d\'une avance');
                    echo $this->Form->input('type', array('label' => "Type de damande",'options' => $sizes,'class'=>'form-control'));
                    echo $this->Form->input('montant', array('class' => 'form-control montant'));
					?>
					<div class="input text col-md-12 tranche" style="padding:0px;display:block;">
						<label class="col-md-12" style="padding:0px;">Echéance</label>
						<?php
							echo $this->Form->input('echeances', array('class' => 'form-control epmois','label'=>false,'div'=>array('class'=>'col-md-6','style'=>"padding:0px;")));
						?>
						<span class="col-md-6 pmois" style="text-align:right;"><b><big></big>/Mois</b></span>
					</div>
					<?php
                    echo $this->Form->input('motif', array('class' => 'form-control'));
                    ?>
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large envoyer','disabled'=>'disabled','div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(window).load(function() {
	var options = '<option selected>Choisissez</option>';
	$('select').prepend(options);
});

$('select').on('change',function(){
	var that = $(this).val();
		if(that == 'Avance'){
			$("#avanceModal").modal();
			$('.tranche').hide();
		}
		if(that == 'Pret'){
			$("#pretModal").modal();
			$('.tranche').show();
		}
});
$('.valider').click(function(){
	var check = $(".check");
	$("#pretModal").modal('hide');
	$("#avanceModal").modal('hide');
	if(check.is(':checked')){
		$('.envoyer').removeAttr('disabled');
	}else {
		return false;
	}
});
$('.epmois').on('keyup',function(){
	var tranche = $(this).val();
	var montant = $('.montant').val();
	var prix = (montant/tranche).toFixed(2);
	if(tranche == '' || tranche == 0)
	$('.pmois big').text('');
	else
	$('.pmois big').text(prix+' Dh');
});
</script>