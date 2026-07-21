<?php echo $this->Html->css('daterangepicker');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
?>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>
<?php echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<style>
	@media (max-width: 810px) {
		.concur .col-xs-6 .col-xs-4 {
			padding: 2px;
		}
	}

	.box .nav-stacked>li {
		border-bottom: 1px solid #f4f4f4;
		margin: 0;
		padding-left: 6px;
		min-height: 38px;
		height: auto;
		width: 100%;
		float: left;
		margin-bottom: 2px;
		padding-right: 4px;
	}

	.modal .objet {
		padding: 0px;
		float: left;
		width: 100%;
		margin-right: 3px;
		margin-left: 0px;
		border: 1px solid #337ab7;
	}

	.modal .objet .optionh {
		min-width: 80px;
		width: 100%;
		float: left;
		border-radius: 0px;
		padding: 2px 0px 2px 5px;
		color: #337ab7;
		border-bottom: 1px solid;
		background: none;
		z-index: 99;
		position: relative;
	}

	.modal .objet .optionh .fa {
		float: right;
		height: 100%;
		width: 25px;
		text-align: center;
		line-height: 20px;
		border-left: 1px solid;
		padding: 2px;
		cursor: pointer;
		margin-left: 2px;
	}

	.modal .objet .optionb {
		min-width: 80px;
		width: 100%;
		left: 0px;
		border-radius: 5px;
		padding: 7px 8px;
		margin-bottom: 4px;
		display: none;
		background: none;
		list-style: none;
		color: #337ab7;
		position: relative;
		z-index: 9;
		text-shadow: none !important;
		margin: 0px;
		box-shadow: none !important;
	}

	.modal .objet .optionb li {
		color: #337ab7;
		text-shadow: none;
		border-bottom: 1px dashed;
	}

	.select2-dropdown {
		width: 324px !important;
	}
</style>
<div class="row">
	<div class="col-md-12" style="margin-bottom: 24px;">
		<div class="box form-group">
			<div class="box-header with-border">
				<label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Date du rapport</label>
				<div class="col-md-6">
					<form action="/rapports/add/" method="get" id="dateform">
						<div class="input-group col-lg-12" style="float:left;">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="margin-bottom: 10px;">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo __('Ajouter un rapport'); ?></h3>
			</div>
			<div class="box-body">
				<div class="col-lg-12" style="padding:0px;">
					<div class="panel panel-primary">
						<div class="panel-body form-horizontal payment-form" style="padding:0px;">
							<?php
							echo $this->Form->create('Rapport', array('type' => 'file'));
							echo $this->Form->hidden('date_debut', array('value' => $date_debut));
							echo $this->Form->hidden('date_fin', array('value' => $date_fin));
							?>
							<div class="col-xs-12" style="margin-bottom: 6px;">
								<h4 class="col-xs-12"><b for="RapportTitre">Titre :</b></h4>
								<input name="data[Rapport][titre]" class="form-control" type="text" id="RapportTitre">
							</div>
							<div class="col-xs-12" style="margin-bottom: 6px;">
								<h4 class="col-xs-12"><b for="RapportDescription">Description :</b></h4>
								<textarea name="data[Rapport][description]" class="form-control" id="RapportDescription" style="max-width:100%;"></textarea>
							</div>
							<div class="col-xs-12" style="margin-bottom: 6px;">
								<h4 class="col-xs-12"><b>Activité :</b>
									<span style="font-weight: normal;">(comment jugez-vous l’activité de ce mois ?)</span>
								</h4>
								<div class="col-xs-4">
									<input type="radio" name="data[Rapport][activite]" value="Bonne" style="height: 15px;width: 15px;padding: 15px;"> <b style="line-height: 16px;font-size: 16px;">Bonne</b>
								</div>
								<div class="col-xs-4">
									<input type="radio" name="data[Rapport][activite]" value="Moyenne" style="height: 15px;width: 15px;padding: 15px;"> <b style="line-height: 16px;font-size: 16px;">Moyenne</b>
								</div>
								<div class="col-xs-4">
									<input type="radio" name="data[Rapport][activite]" value="Faible" style="height: 15px;width: 15px;padding: 15px;"> <b style="line-height: 16px;font-size: 16px;">Faible</b>
								</div>
							</div>
							<div class="col-xs-12" style="border-top: 1px solid #eee;">
								<h4 class="col-xs-12"><b>Réalisation globale visites :</b>
									<span style="font-weight: normal;">(quelle est votre réalisation de l’objectif des visites de ce mois en pourcentage ?)</span>
								</h4>
								<div class="col-sm-6 col-xs-4">
									<input type="text" name="data[Rapport][globale]" class="col-sm-4 col-xs-6" value="" style="float:left;padding:2px 4px;font-size:16px;font-weight:bold;text-align: left;margin-right:4px;"> <b style="line-height: 30px;font-size: 20px;z-index: 999;position: absolute;left: 29%;">%</b>
								</div>
							</div>
							<div class="col-xs-12">
								<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;">
									<b style="line-height: 27px;">Concurrence (1):</b>
									<!-- <span class="concurclose0" style="float:right;cursor:pointer;padding:4px;color:#074c75;margin-left:5px;" onclick="concurcl(0)"><i class="fa fa-times"></i></span> -->
									<span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="concur(0)"><i id="concuricon0" class="fa fa-minus"></i></span>
								</h4>
								<div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px; margin-top:0px; background:#fefefe;" class="col-xs-12 concur0 concur">
									<div class="col-md-6 col-xs-12">
										<div class="col-md-6 col-xs-12">
											<label class="col-xs-12" style="padding: 0px;">Produit :</label>
											<select name="data[RapportConcurance][0][produit_id]" class="form-control select2 prodc">
												<?php foreach ($produits as $k => $v): ?>
													<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-6 col-xs-12">
											<label class="col-xs-12" style="padding: 0px;">Produit concurrent :</label>
											<input type="text" name="data[RapportConcurance][0][produit_concurant]" class="col-xs-12" placeholder="Rédigez le nom du concurrent" style="float:left; padding:6px 8px;font-weight:bold;">
										</div>
										<div class="col-md-6 col-xs-12">
											<label class="col-xs-12" style="padding: 0px;">L’offre :</label>
											<textarea name="data[RapportConcurance][0][offre]" class="col-xs-12" placeholder="L’offre" style="float:left; padding:4px 8px;font-weight:bold;max-width:100%;max-height:50px;"></textarea>
										</div>
										<div class="col-md-6 col-xs-12">
											<label class="col-xs-12" style="padding: 0px;">Commentaires :</label>
											<textarea name="data[RapportConcurance][0][commentaire]" class="col-xs-12" placeholder="Commentaires" style="float:left; padding:4px 8px;font-weight:bold;max-width:100%;max-height:50px;"></textarea>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="col-md-12 col-xs-12">
											<label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Type de l’offre :</label>
											<div class="col-xs-4">
												<input type="checkbox" name="data[RapportConcurance][0][type_offre][]" value="Pack"><b> Pack</b>
											</div>
											<div class="col-xs-4">
												<input type="checkbox" name="data[RapportConcurance][0][type_offre][]" value="Action"><b> Action</b>
											</div>
											<div class="col-xs-4">
												<input type="checkbox" name="data[RapportConcurance][0][type_offre][]" value="Autres"><b> Autres</b>
											</div>
										</div>
										<div class="col-md-12 col-xs-12" style="margin-top: 11px;">
											<label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Degrés d’agressivité :</label>
											<div class="col-xs-4">
												<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Très agressive"><b> Très agressive</b>
											</div>
											<div class="col-xs-4">
												<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Agressive"><b> Agressive</b>
											</div>
											<div class="col-xs-4">
												<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Peu agressive"><b> Peu agressive</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 concurr" style="margin-bottom:10px;" id="1">
							</div>
							<div class="col-xs-12">
								<b class="ajouterconcur btn btn-primary" style="float:right;">Ajouter concurrence</b>
							</div>


							<div class="col-xs-12" style="margin-bottom: 6px;">
								<h4 class="col-xs-12"><b>Pièces jointes :</b></h4>

								<div id="drop-zone-terrain" style="border: 1.5px dashed #aaa; border-radius: 8px; padding: 32px 20px; text-align:center; cursor:pointer; background: #f9f9f9; position:relative;">
									<i class="fa fa-cloud-upload" style="font-size:32px; color:#2196F3; display:block; margin-bottom:10px;"></i>
									<p style="margin:0 0 4px; font-size:14px; font-weight:600;">Cliquez ou glissez vos fichiers ici</p>
									<p style="margin:0; font-size:12px; color:#888;">PDF, DOC, XLS — max 5 MB par fichier</p>
									<input type="file" id="file-terrain" name="data[Rapport][file_terrain][]" multiple
										accept=".pdf,.doc,.docx,.xls,.xlsx"
										style="position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer;">
								</div>

								<div id="file-list-terrain" style="margin-top:10px; display:flex; flex-direction:column; gap:6px;"></div>

								<button type="button" onclick="document.getElementById('file-terrain').click()"
									class="btn btn-default btn-sm" style="margin-top:10px;">
									+ Ajouter d'autres fichiers
								</button>
							</div>
							<?php echo $this->Form->end(array('label' => 'Ajouter', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12', 'style' => "float:left;"))); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
		color: #fff !important;
	}

	@media (max-width:1215px) {
		.box-body {
			overflow: scroll;
			overflow-y: hidden;
		}
	}

	.dt-button {
		width: auto;
		float: left;
		margin: 5px;
		font-size: 16px;
		line-height: 22px;
		padding: 3px 8px;
		background: #337ab7;
		color: #fff;
	}

	.dt-button:hover {
		color: #fff;
		background: #1a486f;
	}
</style>
<?php echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');


?>
<?php

// if(!empty($visites)){

// foreach($visites as $vi)
// {
// $usersName[]=$vi['User']['name'];
// $usersName=array_unique($usersName);
// }
// }
// if(!empty($visites)){
// foreach($usersName as $uN)
// {
// $somme[$uN]=0;
// }}
$produitdonne = array();
$gammedemande = array();
$price = "";
$indication = "";
$pathologie = "";
$posologie = "";
$presentation = "";
if (!empty($visites)) {

	$nbvisites = count($visites);
	$i = 0;
	foreach ($users as $u) {
		foreach ($visites as $v) {
			if ($u["Apartient"]["user1_id"] == $v['Visite']['user_id']) {
				$somme[$v['User']['name'] . '|' . $v['User']['id']] = 0;
			}
			if ($i < $nbvisites) {
				//get specialities of visits
				$specialities[] = $v['Client']['category_id'];
				//get secteurs of visite
				$secteurrs[] = $v['Client']['secteur_id'];
				//getProducts of visits
				$produitd = explode("|", $v['Visite']['produits']);
				if (!empty($produitd[0]))
					$produitdonne[] = $produitd[0];
				$games = explode("|", $v['Visite']['produitsNP']);
				//get gammes of product
				foreach ($games as $val) {
					if (!empty($val))
						$gammedemande[] = $val;
				}
				//get objections 
				if (strpos($v["Visite"]["objection"], '*') === 0) {
					$objections = ltrim($v["Visite"]["objection"], '*');
					$objections = explode(",", $objections);
					foreach ($objections as $obj) {
						$objec = explode("|", $obj);
						if ($objec[0] == "prix") {
							for ($j = 1; $j < count($objec); $j++) {
								$tPrice[$objec[$j]][] = $v;
								$price = $price . "|" . $objec[$j];
								$price1 = explode("|", $price);
								array_shift($price1);
							}
						} elseif ($objec[0] == "indication") {
							for ($j = 1; $j < count($objec); $j++) {
								$tIndication[$objec[$j]][] = $v;
								$indication = $indication . "|" . $objec[$j];
								$indication1 = explode("|", $indication);
								array_shift($indication1);
							}
						} elseif ($objec[0] == "pathologie") {
							for ($j = 1; $j < count($objec); $j++) {
								$tPathologie[$objec[$j]][] = $v;
								$pathologie = $pathologie . "|" . $objec[$j];
								$pathologie1 = explode("|", $pathologie);
								array_shift($pathologie1);
							}
						} elseif ($objec[0] == "posologie") {
							for ($j = 1; $j < count($objec); $j++) {
								$tPosologie[$objec[$j]][] = $v;
								$posologie = $posologie . "|" . $objec[$j];
								$posologie1 = explode("|", $posologie);
								array_shift($posologie1);
							}
						} elseif ($objec[0] == "presentation") {
							for ($j = 1; $j < count($objec); $j++) {
								$tPresentation[$objec[$j]][] = $v;
								$presentation = $presentation . "|" . $objec[$j];
								$presentation1 = explode("|", $presentation);
								array_shift($presentation1);
							}
						}
					}
				}
			}
			$i++;
		}
	}
	//frequencyprice
	if (!empty($price1)) {
		$frequencyprice = array_count_values($price1);
		arsort($frequencyprice);
		$sliced_price = array_slice($frequencyprice, 0, 10);
	}
	//frequencyindication
	if (!empty($indication1)) {
		$frequencyindication = array_count_values($indication1);
		arsort($frequencyindication);
		$sliced_indication = array_slice($frequencyindication, 0, 10);
	}
	//frequencypathologie
	if (!empty($pathologie1)) {
		$frequencypathologie = array_count_values($pathologie1);
		arsort($frequencypathologie);
		$sliced_pathologie = array_slice($frequencypathologie, 0, 10);
	}
	//frequencyposologie
	if (!empty($posologie1)) {
		$frequencyposologie = array_count_values($posologie1);
		arsort($frequencyposologie);
		$sliced_posologie = array_slice($frequencyposologie, 0, 10);
	}
	//frequencypresentation
	if (!empty($presentation1)) {
		$frequencypresentation = array_count_values($presentation1);
		arsort($frequencypresentation);
		$sliced_presentation = array_slice($frequencypresentation, 0, 10);
	}
}
$produitdonne = array_unique($produitdonne);
$gammedemande = array_unique($gammedemande);
$sommePro = array();
//debug($tPrice);
foreach ($produitdonne as $produit) {
	//echo $produit;
	$sommePro[$produit][5] = 0;
	$sommePro[$produit][10] = 0;
	$sommePro[$produit][20] = 0;
}
$sommeGam = array();
foreach ($gammedemande as $gamme) {
	//echo $produit;
	$sommeGam[$gamme] = 0;
}
//debug($specialities);
$sommeSpec = array();
if (!empty($specialities)) {
	$specialities = array_unique($specialities);
	foreach ($specialities as $spec) {
		$sommeSpec[$spec] = 0;
	}
}
$sommeSecteur = array();
if (!empty($secteurrs)) {
	$secteurrs = array_unique($secteurrs);
	foreach ($secteurrs as $spec) {
		$sommeSecteur[$spec] = 0;
	}
}
//debug($sommeSecteur);
$objectiftotal = $visiteglobale = 0;
$nbQAMtotal = $nbPCMtotal = $nbPMtotal = $nbNRtotal = $nbVisitQAMtotal = $nbVisitPCMtotal = $nbVisitPMtotal = $nbVisitNRtotal = 0;
$nbrvisites = count($visites);

//debug($sliced_price);
$nbH = $nbPu = $nbPr = 0;
$nbF = 0;
$nbPartenaireB = 0;
$nbPartenaireM = 0;
$nbPartenaireF = 0;
$clientsB = array();
$clientsM = array();
$clientsF = array();
$nbConcurentCent = 0;
$nbConcurentCinq = 0;
$nbConcurentPM = 0;
$concurrentsCent = array();
$concurrentsCinq = array();
$concurrentsPM = array();
$clientsPCM = array();
$clientsQAM = array();
$clientsPM = array();
$clientsNR = array();
//$ids=array();
$clientsG = array();
$clientsGP = array();
$clientsGC = array();
foreach ($visites as $v) {
	//Classification by specialities
	foreach ($specialities as $sp) {
		if ($sp == $v['Client']['category_id']) {
			$tSpec[$sp][] = $v;
			$sommeSpec[$sp]++;
		}
	}
	//Classification by secteurs
	foreach ($secteurrs as $sp) {
		if ($sp == $v['Client']['secteur_id']) {
			$tSec[$sp][] = $v;
			$sommeSecteur[$sp]++;
		}
	}
	//Classification by partenaires
	if ($v['Visite']['partenaires'] == "bien") {
		$nbPartenaireB++;
		//$clientsB[]=$v['Client'];
		$clientsB[] = $v;
	} else if ($v['Visite']['partenaires'] == "moyen") {
		$nbPartenaireM++;
		$clientsM[] = $v;
	} else if ($v['Visite']['partenaires'] == "faible") {
		$nbPartenaireF++;
		$clientsF[] = $v;
	}
	//Classification by concurrents
	if ($v['Visite']['veille'] == "100") {
		$concurrentsCent[] = $v;
		$nbConcurentCent++;
	} else if ($v['Visite']['veille'] == "50") {
		$concurrentsCinq[] = $v;
		$nbConcurentCinq++;
	} else if (trim($v['Visite']['veille']) == "-+") {
		$concurrentsPM[] = $v;
		$nbConcurentPM++;
	}
	//Classification by sexe
	if ($v['Client']['sexe'] == 'h') {
		$nbH++;
	} else if ($v['Client']['sexe'] == 'f') {
		$nbF++;
	}
	//Classification by activite
	if ($v['Client']['activite'] == 'Publique')
		$nbPu++;
	else
		$nbPr++;
	//Classification by potentialitev2
	if ($v['Client']['potentialitev2'] == "PCM") {
		$clientsPCM[] = $v;
	} else if ($v['Client']['potentialitev2'] == "QAM") {
		$clientsQAM[] = $v;
	} else if ($v['Client']['potentialitev2'] == "PM") {
		$clientsPM[] = $v;
	} else if ($v['Client']['potentialitev2'] == "NR") {
		$clientsNR[] = $v;
	}
	// classification by product
	$produitdonnee = explode("|", $v['Visite']['produits']);
	foreach ($produitdonne as $product) {
		if ($product == $produitdonnee[0]) {
			if ($produitdonnee[1] == 5) {
				$sommePro[$product][5]++;
			} elseif ($produitdonnee[1] == 10) {
				$sommePro[$product][10]++;
			} elseif ($produitdonnee[1] == 20) {
				$sommePro[$product][20]++;
			}
		}
	}
	//classification by gamme 

	$produistDNP = explode("|", $v['Visite']['produitsNP']);
	foreach ($gammedemande as $gamme) {
		foreach ($produistDNP as $pro) {
			if ($gamme == $pro) {
				$sommeGam[$gamme]++;
			}
		}
	}
}
$clientsG['PCM'] = $clientsPCM;
$clientsG['QAM'] = $clientsQAM;
$clientsG['PM'] = $clientsPM;
$clientsG['NR'] = $clientsNR;
$clientsGP['BIEN'] = $clientsB;
$clientsGP['MOYEN'] = $clientsM;
$clientsGP['FAIBLE'] = $clientsF;
$clientsGC[100] = $concurrentsCent;
$clientsGC[50] = $concurrentsCinq;
$clientsGC['-+'] = $concurrentsPM;
//debug($tSpec);
//debug($tSec);
if ($nbrvisites == 0) {
	$pourcentageH = $pourcentageF = $pourcentagePartB = $pourcentagePartM = $pourcentagePartF = $pourcentageConCent = $pourcentageConCinq = $pourcentageConPM = $pourcentagePu = $pourcentagePr = 0;
} else {
	$pourcentageH = round(($nbH * 100) / $nbrvisites);
	$pourcentageF = round(($nbF * 100) / $nbrvisites);
	$pourcentagePu = round(($nbPu * 100) / $nbrvisites);
	$pourcentagePr = round(($nbPr * 100) / $nbrvisites);
	$pourcentagePartB = round(($nbPartenaireB * 100) / $nbrvisites);
	$pourcentagePartM = round(($nbPartenaireM * 100) / $nbrvisites);
	$pourcentagePartF = round(($nbPartenaireF * 100) / $nbrvisites);
	$pourcentageConCent = round(($nbConcurentCent * 100) / $nbrvisites);
	$pourcentageConCinq = round(($nbConcurentCinq * 100) / $nbrvisites);
	$pourcentageConPM = round(($nbConcurentPM * 100) / $nbrvisites);
}

//echo nl2br("\r");
//echo $pourcentageConPM;

if (!empty($visites)) {
	$i = 0;
	foreach ($users as $u) {
		foreach ($visites as $v) {
			if ($u["Apartient"]["user1_id"] == $v['Visite']['user_id']) {
				$somme[$v['User']['name'] . '|' . $v['User']['id']] = $somme[$v['User']['name'] . '|' . $v['User']['id']] + 1;
			}
		}
		$i++;
	}
}
$k = 0; //debug($clientsG);
foreach ($clientsG as $key => $value) {
?>
	<div class="modal fade" id="myModalapp<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
		<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
				</div>
				<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
					<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
						<thead>
							<tr>
								<th>Client</th>
								<th>Genre</th>
								<th>Catégorie</th>
								<th>Potentialité</th>
								<th>Objections</th>
								<th>Concurrents</th>
								<th>Partenaires</th>
								<th>échantillons</th>
								<th>Produit donné</th>
								<th>Produits demandés non présentés</th>
								<th>Date</th>
								<th>Commentaire</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$ii = 0;
							$iii = 0;
							foreach ($value as $val) { ?>
								<tr>
									<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
									<td><?php if ($val['Client']['sexe'] == "f") {
											echo 'Femme';
										} elseif ($val['Client']['sexe'] == "h") {
											echo 'Homme';
										} ?> </td>
									<td><?php
										//debug($categories);
										//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
										foreach ($categories as $p => $value) {
											if ($p == $val['Client']['category_id']) {
												echo $value;
											}
										}
										?></td>
									<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
									<td>
										<?php
										if (strpos($val["Visite"]["objection"], '#') === 0) {
											$visiteobjection = ltrim($val["Visite"]["objection"], '#');
											$obV = explode('||', $visiteobjection);

											foreach ($obV as $o) {
												$products = explode(';', $o); ?>
												<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
													<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																						//debug($product);
																																																						foreach ($produits as $key => $p) {
																																																							if ($key == $products[0]) {
																																																								echo $p;
																																																							}
																																																						}
																																																						//echo $products[0];
																																																						?>
														</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
													<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
														<?php $objections = explode(',', $products[1]);
														array_pop($objections);
														foreach ($objections as $obj) {
															$objec = explode('|', $obj); ?>
															<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																	<?php for ($j = 1; $j < count($objec); $j++) { ?>
																		<li><?php echo $objec[$j]; ?></li>
																	<?php } ?>
																</ul>
															</div>
														<?php $iii++;
														} ?>
													</div>
												</div>
											<?php $ii++;
											}
										} else if (strpos($val["Visite"]["objection"], '*') === 0) {
											$objection = ltrim($val["Visite"]["objection"], '*');
											$objections = explode(',', $objection);
											array_pop($objections);
											//debug($objections);
											foreach ($objections as $obj) {
												$words = '';
												$objec = explode('|', $obj); ?>
												<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
													<b><?php echo $objec[0]; ?> :</b>
													<span><?php for ($j = 1; $j < count($objec); $j++) {
																$words = $words . ',' . $objec[$j];
																$words = ltrim($words, ',');
															} ?><?php echo $words; ?> </span>
												</div>
										<?php }
										} else {
											echo $val["Visite"]["objection"];
										} ?>
									</td>
									<td><?php echo $val["Visite"]["veille"]; ?></td>
									<td><?php echo $val["Visite"]["partenaires"]; ?></td>
									<td>
										<?php $ech =  explode("||", $val["Visite"]['echantillons']);
										$ec =  explode("-", $val["Visite"]['echantillons']);
										if (count($ec) > 1) {
											for ($ch = 0; $ch < count($ech); $ch++) {
												$ec =  explode("-", $ech[$ch]);
												$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											}
										} ?>
										&nbsp;
									</td>
									<!-- -->
									<td><?php if (!empty($val["Visite"]['produits'])) {
											$ec =  explode("|", $val["Visite"]['produits']);
											//debug( $ec);
											//echo $ec[0];
											if (strpos($ec[0], '*') === 0) {
												$gams = ltrim($ec[0], '*');
												//debug($gams);
												$gams = explode(",", $gams);

												$gam = "";
												foreach ($gams as $g) {
													//echo $g;
													$nom = $this->requestAction('/games/system_get_name_game/' . $g);
													$gam = $gam . " | " . $nom;
												}
												$gam = ltrim($gam, " | ");
												$nomch = $gam;
											} else {
												$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
											}
											//$nomch=$this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
											echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
										} ?>
										&nbsp;</td>
									<td><?php if (!empty($val["Visite"]['produitsNP'])) {
											$ec =  explode("|", $val["Visite"]['produitsNP']);
											$l = 0;
											foreach ($ec as $e) {
												$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
												$l++;
											}
										} ?>
										&nbsp;</td>
									<!-- -->

									<td><?php
										$date = strtotime($val["Visite"]["date"]);
										$dat = date('Y-m-d', $date);
										echo $dat;
										?></td>
									<td><?php echo $val["Visite"]["commentaire"]; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
<?php $k++;
} ?>

<?php
$k = 4; //debug($clientsG);
foreach ($clientsGP as $key => $value) {
?>
	<div class="modal fade" id="myModalapp<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
		<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
				</div>
				<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
					<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
						<thead>
							<tr>
								<th>Client</th>
								<th>Genre</th>
								<th>Catégorie</th>
								<th>Potentialité</th>
								<th>Objections</th>
								<th>Concurrents</th>
								<th>Partenaires</th>
								<th>échantillons</th>
								<th>Produit donné</th>
								<th>Produits demandés non présentés</th>
								<th>Date</th>
								<th>Commentaire</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$ii = 0;
							$iii = 0;
							foreach ($value as $val) { ?>
								<tr>
									<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
									<td><?php if ($val['Client']['sexe'] == "f") {
											echo 'Femme';
										} elseif ($val['Client']['sexe'] == "h") {
											echo 'Homme';
										} ?> </td>
									<td><?php
										//debug($categories);
										//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
										foreach ($categories as $p => $value) {
											if ($p == $val['Client']['category_id']) {
												echo $value;
											}
										}
										?></td>
									<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
									<td>
										<?php
										if (strpos($val["Visite"]["objection"], '#') === 0) {
											$visiteobjection = ltrim($val["Visite"]["objection"], '#');
											$obV = explode('||', $visiteobjection);

											foreach ($obV as $o) {
												$products = explode(';', $o); ?>
												<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
													<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																						//debug($product);
																																																						foreach ($produits as $key => $p) {
																																																							if ($key == $products[0]) {
																																																								echo $p;
																																																							}
																																																						}
																																																						//echo $products[0];
																																																						?>
														</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
													<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
														<?php $objections = explode(',', $products[1]);
														array_pop($objections);
														foreach ($objections as $obj) {
															$objec = explode('|', $obj); ?>
															<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																	<?php for ($j = 1; $j < count($objec); $j++) { ?>
																		<li><?php echo $objec[$j]; ?></li>
																	<?php } ?>
																</ul>
															</div>
														<?php $iii++;
														} ?>
													</div>
												</div>
											<?php $ii++;
											}
										} else if (strpos($val["Visite"]["objection"], '*') === 0) {
											$objection = ltrim($val["Visite"]["objection"], '*');
											$objections = explode(',', $objection);
											array_pop($objections);
											//debug($objections);
											foreach ($objections as $obj) {
												$words = '';
												$objec = explode('|', $obj); ?>
												<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
													<b><?php echo $objec[0]; ?> :</b>
													<span><?php for ($j = 1; $j < count($objec); $j++) {
																$words = $words . ',' . $objec[$j];
																$words = ltrim($words, ',');
															} ?><?php echo $words; ?> </span>
												</div>
										<?php }
										} else {
											echo $val["Visite"]["objection"];
										} ?>
									</td>
									<td><?php echo $val["Visite"]["veille"]; ?></td>
									<td><?php echo $val["Visite"]["partenaires"]; ?></td>
									<td>
										<?php $ech =  explode("||", $val["Visite"]['echantillons']);
										$ec =  explode("-", $val["Visite"]['echantillons']);
										if (count($ec) > 1) {
											for ($ch = 0; $ch < count($ech); $ch++) {
												$ec =  explode("-", $ech[$ch]);
												$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											}
										} ?>
										&nbsp;
									</td>
									<!-- -->
									<td><?php if (!empty($val["Visite"]['produits'])) {
											$ec =  explode("|", $val["Visite"]['produits']);
											if (strpos($ec[0], '*') === 0) {
												$gams = ltrim($ec[0], '*');
												//debug($gams);
												$gams = explode(",", $gams);

												$gam = "";
												foreach ($gams as $g) {
													//echo $g;
													$nom = $this->requestAction('/games/system_get_name_game/' . $g);
													$gam = $gam . " | " . $nom;
												}
												$gam = ltrim($gam, " | ");
												$nomch = $gam;
											} else {
												$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
											}
											echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
										} ?>
										&nbsp;</td>
									<td><?php if (!empty($val["Visite"]['produitsNP'])) {
											$ec =  explode("|", $val["Visite"]['produitsNP']);
											$l = 0;
											foreach ($ec as $e) {
												$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
												$l++;
											}
										} ?>
										&nbsp;</td>
									<!-- -->

									<td><?php
										$date = strtotime($val["Visite"]["date"]);
										$dat = date('Y-m-d', $date);
										echo $dat;
										?></td>
									<td><?php echo $val["Visite"]["commentaire"]; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
<?php $k++;
} ?>
<?php
$k = 7; //debug($clientsG);
foreach ($clientsGC as $key => $value) {
?>
	<div class="modal fade" id="myModalapp<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
		<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
				</div>
				<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
					<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
						<thead>
							<tr>
								<th>Client</th>
								<th>Genre</th>
								<th>Catégorie</th>
								<th>Potentialité</th>
								<th>Objections</th>
								<th>Concurrents</th>
								<th>Partenaires</th>
								<th>échantillons</th>
								<th>Produit donné</th>
								<th>Produits demandés non présentés</th>
								<th>Date</th>
								<th>Commentaire</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$ii = 0;
							$iii = 0;
							foreach ($value as $val) { ?>
								<tr>
									<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
									<td><?php if ($val['Client']['sexe'] == "f") {
											echo 'Femme';
										} elseif ($val['Client']['sexe'] == "h") {
											echo 'Homme';
										} ?> </td>
									<td><?php
										//debug($categories);
										//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
										foreach ($categories as $p => $value) {
											if ($p == $val['Client']['category_id']) {
												echo $value;
											}
										}
										?></td>
									<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
									<td>
										<?php
										if (strpos($val["Visite"]["objection"], '#') === 0) {
											$visiteobjection = ltrim($val["Visite"]["objection"], '#');
											$obV = explode('||', $visiteobjection);

											foreach ($obV as $o) {
												$products = explode(';', $o); ?>
												<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
													<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																						//debug($product);
																																																						foreach ($produits as $key => $p) {
																																																							if ($key == $products[0]) {
																																																								echo $p;
																																																							}
																																																						}
																																																						//echo $products[0];
																																																						?>
														</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
													<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
														<?php $objections = explode(',', $products[1]);
														array_pop($objections);
														foreach ($objections as $obj) {
															$objec = explode('|', $obj); ?>
															<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																	<?php for ($j = 1; $j < count($objec); $j++) { ?>
																		<li><?php echo $objec[$j]; ?></li>
																	<?php } ?>
																</ul>
															</div>
														<?php $iii++;
														} ?>
													</div>
												</div>
											<?php $ii++;
											}
										} else if (strpos($val["Visite"]["objection"], '*') === 0) {
											$objection = ltrim($val["Visite"]["objection"], '*');
											$objections = explode(',', $objection);
											array_pop($objections);
											//debug($objections);
											foreach ($objections as $obj) {
												$words = '';
												$objec = explode('|', $obj); ?>
												<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
													<b><?php echo $objec[0]; ?> :</b>
													<span><?php for ($j = 1; $j < count($objec); $j++) {
																$words = $words . ',' . $objec[$j];
																$words = ltrim($words, ',');
															} ?><?php echo $words; ?> </span>
												</div>
										<?php }
										} else {
											echo $val["Visite"]["objection"];
										} ?>
									</td>
									<td><?php echo $val["Visite"]["veille"]; ?></td>
									<td><?php echo $val["Visite"]["partenaires"]; ?></td>
									<td>
										<?php $ech =  explode("||", $val["Visite"]['echantillons']);
										$ec =  explode("-", $val["Visite"]['echantillons']);
										if (count($ec) > 1) {
											for ($ch = 0; $ch < count($ech); $ch++) {
												$ec =  explode("-", $ech[$ch]);
												$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											}
										} ?>
										&nbsp;
									</td>
									<!-- -->
									<td><?php if (!empty($val["Visite"]['produits'])) {
											$ec =  explode("|", $val["Visite"]['produits']);
											if (strpos($ec[0], '*') === 0) {
												$gams = ltrim($ec[0], '*');
												//debug($gams);
												$gams = explode(",", $gams);

												$gam = "";
												foreach ($gams as $g) {
													//echo $g;
													$nom = $this->requestAction('/games/system_get_name_game/' . $g);
													$gam = $gam . " | " . $nom;
												}
												$gam = ltrim($gam, " | ");
												$nomch = $gam;
											} else {
												$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
											}
											echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
										} ?>
										&nbsp;</td>
									<td><?php if (!empty($val["Visite"]['produitsNP'])) {
											$ec =  explode("|", $val["Visite"]['produitsNP']);
											$l = 0;
											foreach ($ec as $e) {
												$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
												$l++;
											}
										} ?>
										&nbsp;</td>
									<!-- -->

									<td><?php
										$date = strtotime($val["Visite"]["date"]);
										$dat = date('Y-m-d', $date);
										echo $dat;
										?></td>
									<td><?php echo $val["Visite"]["commentaire"]; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
<?php $k++;
} ?>
<?php
$op = 10; //foreach pour prix
if (!empty($sliced_price)) {
	foreach ($sliced_price as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$ii = 0;
								$iii = 0;
								foreach ($value as $val) { ?>
									<tr>
										<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
										<td><?php if ($val['Client']['sexe'] == "f") {
												echo 'Femme';
											} elseif ($val['Client']['sexe'] == "h") {
												echo 'Homme';
											} ?> </td>
										<td><?php
											//debug($categories);
											//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
											foreach ($categories as $p => $value) {
												if ($p == $val['Client']['category_id']) {
													echo $value;
												}
											}
											?></td>
										<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
										<td>
											<?php
											if (strpos($val["Visite"]["objection"], '#') === 0) {
												$visiteobjection = ltrim($val["Visite"]["objection"], '#');
												$obV = explode('||', $visiteobjection);

												foreach ($obV as $o) {
													$products = explode(';', $o); ?>
													<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
														<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																							//debug($product);
																																																							foreach ($produits as $key => $p) {
																																																								if ($key == $products[0]) {
																																																									echo $p;
																																																								}
																																																							}
																																																							//echo $products[0];
																																																							?>
															</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
														<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
															<?php $objections = explode(',', $products[1]);
															array_pop($objections);
															foreach ($objections as $obj) {
																$objec = explode('|', $obj); ?>
																<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																	<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																	<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																		<?php for ($j = 1; $j < count($objec); $j++) { ?>
																			<li><?php echo $objec[$j]; ?></li>
																		<?php } ?>
																	</ul>
																</div>
															<?php $iii++;
															} ?>
														</div>
													</div>
												<?php $ii++;
												}
											} else if (strpos($val["Visite"]["objection"], '*') === 0) {
												$objection = ltrim($val["Visite"]["objection"], '*');
												$objections = explode(',', $objection);
												array_pop($objections);
												//debug($objections);
												foreach ($objections as $obj) {
													$words = '';
													$objec = explode('|', $obj); ?>
													<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
														<b><?php echo $objec[0]; ?> :</b>
														<span><?php for ($j = 1; $j < count($objec); $j++) {
																	$words = $words . ',' . $objec[$j];
																	$words = ltrim($words, ',');
																} ?><?php echo $words; ?> </span>
													</div>
											<?php }
											} else {
												echo $val["Visite"]["objection"];
											} ?>
										</td>
										<td><?php echo $val["Visite"]["veille"]; ?></td>
										<td><?php echo $val["Visite"]["partenaires"]; ?></td>
										<td>
											<?php $ech =  explode("||", $val["Visite"]['echantillons']);
											$ec =  explode("-", $val["Visite"]['echantillons']);
											if (count($ec) > 1) {
												for ($ch = 0; $ch < count($ech); $ch++) {
													$ec =  explode("-", $ech[$ch]);
													$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
												}
											} ?>
											&nbsp;
										</td>
										<!-- -->
										<td><?php if (!empty($val["Visite"]['produits'])) {
												$ec =  explode("|", $val["Visite"]['produits']);
												if (strpos($ec[0], '*') === 0) {
													$gams = ltrim($ec[0], '*');
													//debug($gams);
													$gams = explode(",", $gams);

													$gam = "";
													foreach ($gams as $g) {
														//echo $g;
														$nom = $this->requestAction('/games/system_get_name_game/' . $g);
														$gam = $gam . " | " . $nom;
													}
													$gam = ltrim($gam, " | ");
													$nomch = $gam;
												} else {
													$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
												}
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											} ?>
											&nbsp;</td>
										<td><?php if (!empty($val["Visite"]['produitsNP'])) {
												$ec =  explode("|", $val["Visite"]['produitsNP']);
												$l = 0;
												foreach ($ec as $e) {
													$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
													$l++;
												}
											} ?>
											&nbsp;</td>
										<!-- -->

										<td><?php
											$date = strtotime($val["Visite"]["date"]);
											$dat = date('Y-m-d', $date);
											echo $dat;
											?></td>
										<td><?php echo $val["Visite"]["commentaire"]; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op=$op; //$op lekhra f foreach li 9bal foreach pour indication
if (!empty($sliced_indication)) {
	foreach ($sliced_indication as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tIndication as $key1 => $valueee) {
									if ($key == $key1) {
										foreach ($valueee as $val) { ?>
											<tr>
												<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
												<td><?php if ($val['Client']['sexe'] == "f") {
														echo 'Femme';
													} elseif ($val['Client']['sexe'] == "h") {
														echo 'Homme';
													} ?> </td>
												<td><?php //echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
													foreach ($categories as $p => $value) {
														if ($p == $val['Client']['category_id']) {
															echo $value;
														}
													}
													?></td>
												<td>
													<?php echo $val["Client"]["potentialitev2"]; ?>
												</td>
												<td>
													<?php
													if (strpos($val["Visite"]["objection"], '#') === 0) {
														$visiteobjection = ltrim($val["Visite"]["objection"], '#');
														$obV = explode('||', $visiteobjection);

														foreach ($obV as $o) {
															$products = explode(';', $o); ?>
															<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
																<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																									//debug($product);
																																																									foreach ($produits as $key => $p) {
																																																										if ($key == $products[0]) {
																																																											echo $p;
																																																										}
																																																									}
																																																									//echo $products[0];
																																																									?>
																	</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
																<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
																	<?php $objections = explode(',', $products[1]);
																	array_pop($objections);
																	foreach ($objections as $obj) {
																		$objec = explode('|', $obj); ?>
																		<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																			<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																			<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																				<?php for ($j = 1; $j < count($objec); $j++) { ?>
																					<li><?php echo $objec[$j]; ?></li>
																				<?php } ?>
																			</ul>
																		</div>
																	<?php $iii++;
																	} ?>
																</div>
															</div>
														<?php $ii++;
														}
													} else if (strpos($val["Visite"]["objection"], '*') === 0) {
														$objection = ltrim($val["Visite"]["objection"], '*');
														$objections = explode(',', $objection);
														array_pop($objections);
														//debug($objections);
														foreach ($objections as $obj) {
															$words = '';
															$objec = explode('|', $obj); ?>
															<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
																<b><?php echo $objec[0]; ?> :</b>
																<span><?php for ($j = 1; $j < count($objec); $j++) {
																			$words = $words . ',' . $objec[$j];
																			$words = ltrim($words, ',');
																		} ?><?php echo $words; ?> </span>
															</div>
													<?php }
													} else {
														echo $val["Visite"]["objection"];
													} ?>
												</td>
												<td><?php echo $val["Visite"]["veille"]; ?></td>
												<td><?php echo $val["Visite"]["partenaires"]; ?></td>
												<td>
													<?php $ech =  explode("||", $val["Visite"]['echantillons']);
													$ec =  explode("-", $val["Visite"]['echantillons']);
													if (count($ec) > 1) {
														for ($ch = 0; $ch < count($ech); $ch++) {
															$ec =  explode("-", $ech[$ch]);
															$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
														}
													} ?>
													&nbsp;
												</td>
												<!-- -->
												<td><?php if (!empty($val["Visite"]['produits'])) {
														$ec =  explode("|", $val["Visite"]['produits']);
														if (strpos($ec[0], '*') === 0) {
															$gams = ltrim($ec[0], '*');
															//debug($gams);
															$gams = explode(",", $gams);

															$gam = "";
															foreach ($gams as $g) {
																//echo $g;
																$nom = $this->requestAction('/games/system_get_name_game/' . $g);
																$gam = $gam . " | " . $nom;
															}
															$gam = ltrim($gam, " | ");
															$nomch = $gam;
														} else {
															$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
														}
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
													} ?>
													&nbsp;</td>
												<td><?php if (!empty($val["Visite"]['produitsNP'])) {
														$ec =  explode("|", $val["Visite"]['produitsNP']);
														$l = 0;
														foreach ($ec as $e) {
															$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
															$l++;
														}
													} ?>
													&nbsp;</td>
												<!-- -->

												<td><?php
													$date = strtotime($val["Visite"]["date"]);
													$dat = date('Y-m-d', $date);
													echo $dat;
													?></td>
												<td><?php echo $val["Visite"]["commentaire"]; ?></td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op=$op; //$op lekhra f foreach li 9bal foreach pour PATHOLOGIE
if (!empty($sliced_pathologie)) {
	foreach ($sliced_pathologie as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tPathologie as $key1 => $valueee) {
									if ($key == $key1) {
										foreach ($valueee as $val) { ?>
											<tr>
												<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
												<td><?php if ($val['Client']['sexe'] == "f") {
														echo 'Femme';
													} elseif ($val['Client']['sexe'] == "h") {
														echo 'Homme';
													} ?> </td>
												<td><?php //echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
													foreach ($categories as $p => $value) {
														if ($p == $val['Client']['category_id']) {
															echo $value;
														}
													}
													?></td>
												<td>
													<?php echo $val["Client"]["potentialitev2"]; ?>
												</td>
												<td>
													<?php
													if (strpos($val["Visite"]["objection"], '#') === 0) {
														$visiteobjection = ltrim($val["Visite"]["objection"], '#');
														$obV = explode('||', $visiteobjection);

														foreach ($obV as $o) {
															$products = explode(';', $o); ?>
															<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
																<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																									//debug($product);
																																																									foreach ($produits as $key => $p) {
																																																										if ($key == $products[0]) {
																																																											echo $p;
																																																										}
																																																									}
																																																									//echo $products[0];
																																																									?>
																	</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
																<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
																	<?php $objections = explode(',', $products[1]);
																	array_pop($objections);
																	foreach ($objections as $obj) {
																		$objec = explode('|', $obj); ?>
																		<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																			<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																			<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																				<?php for ($j = 1; $j < count($objec); $j++) { ?>
																					<li><?php echo $objec[$j]; ?></li>
																				<?php } ?>
																			</ul>
																		</div>
																	<?php $iii++;
																	} ?>
																</div>
															</div>
														<?php $ii++;
														}
													} else if (strpos($val["Visite"]["objection"], '*') === 0) {
														$objection = ltrim($val["Visite"]["objection"], '*');
														$objections = explode(',', $objection);
														array_pop($objections);
														//debug($objections);
														foreach ($objections as $obj) {
															$words = '';
															$objec = explode('|', $obj); ?>
															<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
																<b><?php echo $objec[0]; ?> :</b>
																<span><?php for ($j = 1; $j < count($objec); $j++) {
																			$words = $words . ',' . $objec[$j];
																			$words = ltrim($words, ',');
																		} ?><?php echo $words; ?> </span>
															</div>
													<?php }
													} else {
														echo $val["Visite"]["objection"];
													} ?>
												</td>
												<td><?php echo $val["Visite"]["veille"]; ?></td>
												<td><?php echo $val["Visite"]["partenaires"]; ?></td>
												<td>
													<?php $ech =  explode("||", $val["Visite"]['echantillons']);
													$ec =  explode("-", $val["Visite"]['echantillons']);
													if (count($ec) > 1) {
														for ($ch = 0; $ch < count($ech); $ch++) {
															$ec =  explode("-", $ech[$ch]);
															$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
														}
													} ?>
													&nbsp;
												</td>
												<!-- -->
												<td><?php if (!empty($val["Visite"]['produits'])) {
														$ec =  explode("|", $val["Visite"]['produits']);
														if (strpos($ec[0], '*') === 0) {
															$gams = ltrim($ec[0], '*');
															//debug($gams);
															$gams = explode(",", $gams);

															$gam = "";
															foreach ($gams as $g) {
																//echo $g;
																$nom = $this->requestAction('/games/system_get_name_game/' . $g);
																$gam = $gam . " | " . $nom;
															}
															$gam = ltrim($gam, " | ");
															$nomch = $gam;
														} else {
															$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
														}
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
													} ?>
													&nbsp;</td>
												<td><?php if (!empty($val["Visite"]['produitsNP'])) {
														$ec =  explode("|", $val["Visite"]['produitsNP']);
														$l = 0;
														foreach ($ec as $e) {
															$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
															$l++;
														}
													} ?>
													&nbsp;</td>
												<!-- -->

												<td><?php
													$date = strtotime($val["Visite"]["date"]);
													$dat = date('Y-m-d', $date);
													echo $dat;
													?></td>
												<td><?php echo $val["Visite"]["commentaire"]; ?></td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op=$op; //$op lekhra f foreach li 9bal foreach pour POSOLOGIE
if (!empty($sliced_posologie)) {
	foreach ($sliced_posologie as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tPosologie as $key1 => $valueee) {
									if ($key == $key1) {
										foreach ($valueee as $val) {
								?>
											<tr>
												<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
												<td><?php if ($val['Client']['sexe'] == "f") {
														echo 'Femme';
													} elseif ($val['Client']['sexe'] == "h") {
														echo 'Homme';
													} ?> </td>
												<td><?php //echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
													foreach ($categories as $p => $value) {
														if ($p == $val['Client']['category_id']) {
															echo $value;
														}
													}
													?></td>
												<td>
													<?php echo $val["Client"]["potentialitev2"]; ?>
												</td>
												<td>
													<?php
													if (strpos($val["Visite"]["objection"], '#') === 0) {
														$visiteobjection = ltrim($val["Visite"]["objection"], '#');
														$obV = explode('||', $visiteobjection);

														foreach ($obV as $o) {
															$products = explode(';', $o); ?>
															<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
																<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																									//debug($product);
																																																									foreach ($produits as $key => $p) {
																																																										if ($key == $products[0]) {
																																																											echo $p;
																																																										}
																																																									}
																																																									//echo $products[0];
																																																									?>
																	</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
																<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
																	<?php $objections = explode(',', $products[1]);
																	array_pop($objections);
																	foreach ($objections as $obj) {
																		$objec = explode('|', $obj); ?>
																		<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																			<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																			<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																				<?php for ($j = 1; $j < count($objec); $j++) { ?>
																					<li><?php echo $objec[$j]; ?></li>
																				<?php } ?>
																			</ul>
																		</div>
																	<?php $iii++;
																	} ?>
																</div>
															</div>
														<?php $ii++;
														}
													} else if (strpos($val["Visite"]["objection"], '*') === 0) {
														$objection = ltrim($val["Visite"]["objection"], '*');
														$objections = explode(',', $objection);
														array_pop($objections);
														//debug($objections);
														foreach ($objections as $obj) {
															$words = '';
															$objec = explode('|', $obj); ?>
															<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
																<b><?php echo $objec[0]; ?> :</b>
																<span><?php for ($j = 1; $j < count($objec); $j++) {
																			$words = $words . ',' . $objec[$j];
																			$words = ltrim($words, ',');
																		} ?><?php echo $words; ?> </span>
															</div>
													<?php }
													} else {
														echo $val["Visite"]["objection"];
													} ?>
												</td>
												<td><?php echo $val["Visite"]["veille"]; ?></td>
												<td><?php echo $val["Visite"]["partenaires"]; ?></td>
												<td>
													<?php $ech =  explode("||", $val["Visite"]['echantillons']);
													$ec =  explode("-", $val["Visite"]['echantillons']);
													if (count($ec) > 1) {
														for ($ch = 0; $ch < count($ech); $ch++) {
															$ec =  explode("-", $ech[$ch]);
															$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
														}
													} ?>
													&nbsp;
												</td>
												<!-- -->
												<td><?php if (!empty($val["Visite"]['produits'])) {
														$ec =  explode("|", $val["Visite"]['produits']);
														if (strpos($ec[0], '*') === 0) {
															$gams = ltrim($ec[0], '*');
															//debug($gams);
															$gams = explode(",", $gams);

															$gam = "";
															foreach ($gams as $g) {
																//echo $g;
																$nom = $this->requestAction('/games/system_get_name_game/' . $g);
																$gam = $gam . " | " . $nom;
															}
															$gam = ltrim($gam, " | ");
															$nomch = $gam;
														} else {
															$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
														}
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
													} ?>
													&nbsp;</td>
												<td><?php if (!empty($val["Visite"]['produitsNP'])) {
														$ec =  explode("|", $val["Visite"]['produitsNP']);
														$l = 0;
														foreach ($ec as $e) {
															$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
															$l++;
														}
													} ?>
													&nbsp;</td>
												<!-- -->

												<td><?php
													$date = strtotime($val["Visite"]["date"]);
													$dat = date('Y-m-d', $date);
													echo $dat;
													?></td>
												<td><?php echo $val["Visite"]["commentaire"]; ?></td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op=$op; //$op lekhra f foreach li 9bal foreach pour PRESENTATION
if (!empty($sliced_presentation)) {
	foreach ($sliced_presentation as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php echo $key; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tPresentation as $key1 => $valueee) {
									if ($key == $key1) {
										foreach ($valueee as $val) {
								?>
											<tr>
												<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
												<td><?php if ($val['Client']['sexe'] == "f") {
														echo 'Femme';
													} elseif ($val['Client']['sexe'] == "h") {
														echo 'Homme';
													} ?> </td>
												<td><?php //echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
													foreach ($categories as $p => $value) {
														if ($p == $val['Client']['category_id']) {
															echo $value;
														}
													}
													?></td>
												<td>
													<?php echo $val["Client"]["potentialitev2"]; ?>
												</td>
												<td>
													<?php
													if (strpos($val["Visite"]["objection"], '#') === 0) {
														$visiteobjection = ltrim($val["Visite"]["objection"], '#');
														$obV = explode('||', $visiteobjection);

														foreach ($obV as $o) {
															$products = explode(';', $o); ?>
															<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
																<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																									//debug($product);
																																																									foreach ($produits as $key => $p) {
																																																										if ($key == $products[0]) {
																																																											echo $p;
																																																										}
																																																									}
																																																									//echo $products[0];
																																																									?>
																	</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
																<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
																	<?php $objections = explode(',', $products[1]);
																	array_pop($objections);
																	foreach ($objections as $obj) {
																		$objec = explode('|', $obj); ?>
																		<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																			<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																			<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																				<?php for ($j = 1; $j < count($objec); $j++) { ?>
																					<li><?php echo $objec[$j]; ?></li>
																				<?php } ?>
																			</ul>
																		</div>
																	<?php $iii++;
																	} ?>
																</div>
															</div>
														<?php $ii++;
														}
													} else if (strpos($val["Visite"]["objection"], '*') === 0) {
														$objection = ltrim($val["Visite"]["objection"], '*');
														$objections = explode(',', $objection);
														array_pop($objections);
														//debug($objections);
														foreach ($objections as $obj) {
															$words = '';
															$objec = explode('|', $obj); ?>
															<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
																<b><?php echo $objec[0]; ?> :</b>
																<span><?php for ($j = 1; $j < count($objec); $j++) {
																			$words = $words . ',' . $objec[$j];
																			$words = ltrim($words, ',');
																		} ?><?php echo $words; ?> </span>
															</div>
													<?php }
													} else {
														echo $val["Visite"]["objection"];
													} ?>
												</td>
												<td><?php echo $val["Visite"]["veille"]; ?></td>
												<td><?php echo $val["Visite"]["partenaires"]; ?></td>
												<td>
													<?php $ech =  explode("||", $val["Visite"]['echantillons']);
													$ec =  explode("-", $val["Visite"]['echantillons']);
													if (count($ec) > 1) {
														for ($ch = 0; $ch < count($ech); $ch++) {
															$ec =  explode("-", $ech[$ch]);
															$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
														}
													} ?>
													&nbsp;
												</td>
												<!-- -->
												<td><?php if (!empty($val["Visite"]['produits'])) {
														$ec =  explode("|", $val["Visite"]['produits']);
														if (strpos($ec[0], '*') === 0) {
															$gams = ltrim($ec[0], '*');
															//debug($gams);
															$gams = explode(",", $gams);

															$gam = "";
															foreach ($gams as $g) {
																//echo $g;
																$nom = $this->requestAction('/games/system_get_name_game/' . $g);
																$gam = $gam . " | " . $nom;
															}
															$gam = ltrim($gam, " | ");
															$nomch = $gam;
														} else {
															$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
														}
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
													} ?>
													&nbsp;</td>
												<td><?php if (!empty($val["Visite"]['produitsNP'])) {
														$ec =  explode("|", $val["Visite"]['produitsNP']);
														$l = 0;
														foreach ($ec as $e) {
															$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
															echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
															$l++;
														}
													} ?>
													&nbsp;</td>
												<!-- -->

												<td><?php
													$date = strtotime($val["Visite"]["date"]);
													$dat = date('Y-m-d', $date);
													echo $dat;
													?></td>
												<td><?php echo $val["Visite"]["commentaire"]; ?></td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op lekhra f foreach li 9bal foreach pour secteures
if (!empty($tSec)) {
	foreach ($tSec as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php
																										foreach ($secteurs as $s => $sec) {
																											if ($s == $key) {
																												echo $sec;
																											}
																										}
																										?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$ii = 0;
								$iii = 0;
								foreach ($value as $val) { ?>
									<tr>
										<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
										<td><?php if ($val['Client']['sexe'] == "f") {
												echo 'Femme';
											} elseif ($val['Client']['sexe'] == "h") {
												echo 'Homme';
											} ?> </td>
										<td><?php
											//debug($categories);
											//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
											foreach ($categories as $p => $value) {
												if ($p == $val['Client']['category_id']) {
													echo $value;
												}
											}
											?></td>
										<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
										<td>
											<?php
											if (strpos($val["Visite"]["objection"], '#') === 0) {
												$visiteobjection = ltrim($val["Visite"]["objection"], '#');
												$obV = explode('||', $visiteobjection);

												foreach ($obV as $o) {
													$products = explode(';', $o); ?>
													<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
														<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																							//debug($product);
																																																							foreach ($produits as $key => $p) {
																																																								if ($key == $products[0]) {
																																																									echo $p;
																																																								}
																																																							}
																																																							//echo $products[0];
																																																							?>
															</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
														<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
															<?php $objections = explode(',', $products[1]);
															array_pop($objections);
															foreach ($objections as $obj) {
																$objec = explode('|', $obj); ?>
																<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																	<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																	<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																		<?php for ($j = 1; $j < count($objec); $j++) { ?>
																			<li><?php echo $objec[$j]; ?></li>
																		<?php } ?>
																	</ul>
																</div>
															<?php $iii++;
															} ?>
														</div>
													</div>
												<?php $ii++;
												}
											} else if (strpos($val["Visite"]["objection"], '*') === 0) {
												$objection = ltrim($val["Visite"]["objection"], '*');
												$objections = explode(',', $objection);
												array_pop($objections);
												//debug($objections);
												foreach ($objections as $obj) {
													$words = '';
													$objec = explode('|', $obj); ?>
													<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
														<b><?php echo $objec[0]; ?> :</b>
														<span><?php for ($j = 1; $j < count($objec); $j++) {
																	$words = $words . ',' . $objec[$j];
																	$words = ltrim($words, ',');
																} ?><?php echo $words; ?> </span>
													</div>
											<?php }
											} else {
												echo $val["Visite"]["objection"];
											} ?>
										</td>
										<td><?php echo $val["Visite"]["veille"]; ?></td>
										<td><?php echo $val["Visite"]["partenaires"]; ?></td>
										<td>
											<?php $ech =  explode("||", $val["Visite"]['echantillons']);
											$ec =  explode("-", $val["Visite"]['echantillons']);
											if (count($ec) > 1) {
												for ($ch = 0; $ch < count($ech); $ch++) {
													$ec =  explode("-", $ech[$ch]);
													$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
												}
											} ?>
											&nbsp;
										</td>
										<!-- -->
										<td><?php if (!empty($val["Visite"]['produits'])) {
												$ec =  explode("|", $val["Visite"]['produits']);
												if (strpos($ec[0], '*') === 0) {
													$gams = ltrim($ec[0], '*');
													//debug($gams);
													$gams = explode(",", $gams);

													$gam = "";
													foreach ($gams as $g) {
														//echo $g;
														$nom = $this->requestAction('/games/system_get_name_game/' . $g);
														$gam = $gam . " | " . $nom;
													}
													$gam = ltrim($gam, " | ");
													$nomch = $gam;
												} else {
													$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
												}
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											} ?>
											&nbsp;</td>
										<td><?php if (!empty($val["Visite"]['produitsNP'])) {
												$ec =  explode("|", $val["Visite"]['produitsNP']);
												$l = 0;
												foreach ($ec as $e) {
													$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
													$l++;
												}
											} ?>
											&nbsp;</td>
										<!-- -->

										<td><?php
											$date = strtotime($val["Visite"]["date"]);
											$dat = date('Y-m-d', $date);
											echo $dat;
											?></td>
										<td><?php echo $val["Visite"]["commentaire"]; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<?php
//$op lekhra f foreach li 9bal foreach pour spécialité
if (!empty($tSpec)) {
	foreach ($tSpec as $key => $value) {
?>
		<div class="modal fade" id="myModalapp<?php echo $op; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 999999;padding-right: 20px;">
			<div class="modal-dialog col-md-12" style="width:100%;padding:5px;">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabelapp" style="width: auto;float: left;"><?php
																										foreach ($categories as $c => $cat) {
																											if ($c == $key) {
																												echo $cat;
																											}
																										}
																										?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 45px;float: right;margin-top: -11px;">×</button>
					</div>
					<div class="modal-body" style="padding: 5px;float: left;max-width: 100%;overflow: auto;">
						<table class="col-md-12 col-sm-12 table table-striped display" id="" style="float:none; margin:auto; width:100%; max-height: 650px;">
							<thead>
								<tr>
									<th>Client</th>
									<th>Genre</th>
									<th>Catégorie</th>
									<th>Potentialité</th>
									<th>Objections</th>
									<th>Concurrents</th>
									<th>Partenaires</th>
									<th>échantillons</th>
									<th>Produit donné</th>
									<th>Produits demandés non présentés</th>
									<th>Date</th>
									<th>Commentaire</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$ii = 0;
								$iii = 0;
								foreach ($value as $val) { ?>
									<tr>
										<td><?php echo $val['Client']['nom'] . ' ' . $val['Client']['prenom']; ?></td>
										<td><?php if ($val['Client']['sexe'] == "f") {
												echo 'Femme';
											} elseif ($val['Client']['sexe'] == "h") {
												echo 'Homme';
											} ?> </td>
										<td><?php
											//debug($categories);
											//echo $this->requestAction('categories/system_get_name/'.$val['Client']['category_id']);
											foreach ($categories as $p => $value) {
												if ($p == $val['Client']['category_id']) {
													echo $value;
												}
											}
											?></td>
										<td><?php echo $val["Client"]["potentialitev2"]; ?></td>
										<td>
											<?php
											if (strpos($val["Visite"]["objection"], '#') === 0) {
												$visiteobjection = ltrim($val["Visite"]["objection"], '#');
												$obV = explode('||', $visiteobjection);

												foreach ($obV as $o) {
													$products = explode(';', $o); ?>
													<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
														<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																							//debug($product);
																																																							foreach ($produits as $key => $p) {
																																																								if ($key == $products[0]) {
																																																									echo $p;
																																																								}
																																																							}
																																																							//echo $products[0];
																																																							?>
															</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
														<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
															<?php $objections = explode(',', $products[1]);
															array_pop($objections);
															foreach ($objections as $obj) {
																$objec = explode('|', $obj); ?>
																<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																	<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																	<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																		<?php for ($j = 1; $j < count($objec); $j++) { ?>
																			<li><?php echo $objec[$j]; ?></li>
																		<?php } ?>
																	</ul>
																</div>
															<?php $iii++;
															} ?>
														</div>
													</div>
												<?php $ii++;
												}
											} else if (strpos($val["Visite"]["objection"], '*') === 0) {
												$objection = ltrim($val["Visite"]["objection"], '*');
												$objections = explode(',', $objection);
												array_pop($objections);
												//debug($objections);
												foreach ($objections as $obj) {
													$words = '';
													$objec = explode('|', $obj); ?>
													<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
														<b><?php echo $objec[0]; ?> :</b>
														<span><?php for ($j = 1; $j < count($objec); $j++) {
																	$words = $words . ',' . $objec[$j];
																	$words = ltrim($words, ',');
																} ?><?php echo $words; ?> </span>
													</div>
											<?php }
											} else {
												echo $val["Visite"]["objection"];
											} ?>
										</td>
										<td><?php echo $val["Visite"]["veille"]; ?></td>
										<td><?php echo $val["Visite"]["partenaires"]; ?></td>
										<td>
											<?php $ech =  explode("||", $val["Visite"]['echantillons']);
											$ec =  explode("-", $val["Visite"]['echantillons']);
											if (count($ec) > 1) {
												for ($ch = 0; $ch < count($ech); $ch++) {
													$ec =  explode("-", $ech[$ch]);
													$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
												}
											} ?>
											&nbsp;
										</td>
										<!-- -->
										<td><?php if (!empty($val["Visite"]['produits'])) {
												$ec =  explode("|", $val["Visite"]['produits']);
												if (strpos($ec[0], '*') === 0) {
													$gams = ltrim($ec[0], '*');
													//debug($gams);
													$gams = explode(",", $gams);

													$gam = "";
													foreach ($gams as $g) {
														//echo $g;
														$nom = $this->requestAction('/games/system_get_name_game/' . $g);
														$gam = $gam . " | " . $nom;
													}
													$gam = ltrim($gam, " | ");
													$nomch = $gam;
												} else {
													$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
												}
												echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
											} ?>
											&nbsp;</td>
										<td><?php if (!empty($val["Visite"]['produitsNP'])) {
												$ec =  explode("|", $val["Visite"]['produitsNP']);
												$l = 0;
												foreach ($ec as $e) {
													$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
													$l++;
												}
											} ?>
											&nbsp;</td>
										<!-- -->

										<td><?php
											$date = strtotime($val["Visite"]["date"]);
											$dat = date('Y-m-d', $date);
											echo $dat;
											?></td>
										<td><?php echo $val["Visite"]["commentaire"]; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
<?php $op++;
	}
} ?>
<div class="row" style="margin:0px;">
	<div class="col-md-12" style="float:none;margin:auto;">
		<div class="box" style="border-color:#3c8dbc;">
			<div class="box-header with-border">
				<h3 class="box-title">Statistique</h3>
			</div>
			<div class="box col-md-12" style="padding:1%;">
				<div class="col-md-12" style="padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Nombre de visites :</label>
					<div class="col-xs-4 col-md-4 text-center">
						<b style="font-size:25px;color:#00a65a;font-weight:bold;text-transform: uppercase;"><i class="fa fa-user-md" style="font-size:52px;"></i></br>
							<e class="visite-v">0 Visités</e>
						</b>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<b style="font-size:25px;color:#f56954;font-weight:bold;text-transform: uppercase;"><i class="fa fa-user-md" style="font-size:52px;"></i></br>
							<e class="visite-n">0 Non Visités</e>
						</b>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<b style="font-size:25px;color:#3c8dbc;font-weight:bold;text-transform: uppercase;"><i class="fa fa-user-md" style="font-size:52px;"></i></br>
							<e class="visite-o">0 Objectif</e>
						</b>
					</div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Visite par Potentialité :</label>
					<table class="col-md-8 col-sm-12 table table-striped" style="float:none;margin:auto;width:90%;">
						<thead>
							<tr>
								<th>Visite <b style="font-size:28px;">\</b> Potentialité</th>
								<th>PCM</th>
								<th>QAM</th>
								<th>PM</th>
								<th>NR</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Visité</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet objet0">
											<b style="font-size:22px;color:#00a65a;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh optionh0" style="color:#00a65a;font-size: 22px;font-weight: bold;" onclick="objettog(0)">
												<e class="pcm-v">0</e> <i class="fa fa-plus"></i>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet objet1">
											<b style="font-size:22px;color:#00a65a;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh optionh1" style="color:#00a65a;font-size: 22px;font-weight: bold;" onclick="objettog(1)">
												<e class="qam-v">0</e> <i class="fa fa-plus"></i>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet objet2">
											<b style="font-size:22px;color:#00a65a;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh optionh2" style="color:#00a65a;font-size: 22px;font-weight: bold;" onclick="objettog(2)">
												<e class="pm-v">0</e> <i class="fa fa-plus"></i>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet objet3">
											<b style="font-size:22px;color:#00a65a;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh optionh3" style="color:#00a65a;font-size: 22px;font-weight: bold;" onclick="objettog(3)">
												<e class="nr-v">0</e> <i class="fa fa-plus"></i>
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Non visité</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet">
											<b style="font-size:22px;color:#f56954;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh" style="color:#f56954;font-size: 22px;font-weight: bold;">
												<e class="pcm-n">0</e>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet">
											<b style="font-size:22px;color:#f56954;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh" style="color:#f56954;font-size: 22px;font-weight: bold;">
												<e class="qam-n">0</e>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet">
											<b style="font-size:22px;color:#f56954;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh" style="color:#f56954;font-size: 22px;font-weight: bold;">
												<e class="pm-n">0</e>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="col-xs-12 col-md-12 text-center">
										<div class="objet">
											<b style="font-size:22px;color:#f56954;font-weight:bold;text-transform: uppercase;">
												<i class="fa fa-user-md" style="font-size:30px;"></i>
											</b>
											<span class="optionh" style="color:#f56954;font-size: 22px;font-weight: bold;">
												<e class="nr-n">0</e>
											</span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Genre :</label>
					<div class="col-xs-6 col-md-6 text-center">
						<input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo $pourcentageH; ?>%" data-width="100%" data-height="100%" data-fgColor="#00c0ef" data-readonly="true" data-text="89%">
						<b class="knob-h">%</b>
						<div class="knob-label" style="color:#00c0ef;"><b>HOMME</b></div>
					</div>
					<div class="col-xs-6 col-md-6 text-center">
						<input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo $pourcentageF; ?>%" data-width="100%" data-height="100%" data-fgColor="#ef00a6" data-readonly="true" data-text="11%">
						<b class="knob-f">%</b>
						<div class="knob-label" style="color:#ef00a6;"><b>FEMME</b></div>
					</div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Activité :</label>
					<div class="col-xs-6 col-md-6 text-center">
						<input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo $pourcentagePu; ?>%" data-width="100%" data-height="100%" data-fgColor="#00c0ef" data-readonly="true" data-text="89%">
						<b class="knob-h">%</b>
						<div class="knob-label" style="color:#00c0ef;"><b>PUBLIC</b></div>
					</div>
					<div class="col-xs-6 col-md-6 text-center">
						<input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo $pourcentagePr; ?>%" data-width="100%" data-height="100%" data-fgColor="#ef00a6" data-readonly="true" data-text="11%">
						<b class="knob-f">%</b>
						<div class="knob-label" style="color:#ef00a6;"><b>PRIVE</b></div>
					</div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Partenaires :</label>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentagePartB; ?>%" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#00a65a" data-readonly="true" data-text="60%">
						<b class="knob-b">%</b>
						<div class="knob-label" style="color:#00a65a;margin-top:10px;">
							<div class="objet objet4">
								<span class="optionh optionh4" style="color:#00a65a;" onclick="objettog(4)"><b>BIEN </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentagePartM; ?>%" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#fdde00" data-readonly="true" data-text="22%">
						<b class="knob-m">%</b>
						<div class="knob-label" style="color:#fdde00;margin-top:10px;">
							<div class="objet objet5">
								<span class="optionh optionh5" style="color:#fdde00;" onclick="objettog(5)"><b>MOYEN </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentagePartF; ?>%" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#f56954" data-readonly="true" data-text="18%">
						<b class="knob-fi">%</b>
						<div class="knob-label" style="color:#f56954;margin-top:10px;">
							<div class="objet objet6">
								<span class="optionh optionh6" style="color:#f56954;" onclick="objettog(6)"><b>FAIBLE </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Concurrents :</label>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentageConCent; ?>%" data-skin="tron" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#00a65a" data-readonly="true" data-text="50%">
						<b class="knob-b">%</b>
						<div class="knob-label" style="color:#00a65a;margin-top:10px;">
							<div class="objet objet7">
								<span class="optionh optionh7" style="color:#00a65a;" onclick="objettog(7)"><b>Exclusif </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentageConCinq; ?>%" data-skin="tron" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#fdde00" data-readonly="true" data-text="36%">
						<b class="knob-m">%</b>
						<div class="knob-label" style="color:#fdde00;margin-top:10px;">
							<div class="objet objet8">
								<span class="optionh optionh8" style="color:#fdde00;" onclick="objettog(8)"><b>Fidèle </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-md-4 text-center">
						<input type="text" class="knob" value="<?php echo $pourcentageConPM; ?>%" data-skin="tron" data-thickness="0.2" data-width="80%" data-height="80%" data-fgColor="#f56954" data-readonly="true" data-text="14%">
						<b class="knob-fi">%</b>
						<div class="knob-label" style="color:#f56954;margin-top:10px;">
							<div class="objet objet9">
								<span class="optionh optionh9" style="color:#f56954;" onclick="objettog(9)"><b>Rare </b><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">La liste des produits donnés:</label>
					<table class="col-md-8 col-sm-12 table table-striped" style="float:none;margin:auto;width:70%;">
						<thead>
							<tr>
								<th style="width: 43%;">Produits <b style="font-size:24px;">\</b> N BTS/J</th>
								<th>5</th>
								<th>10</th>
								<th>20</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($sommePro as $key => $valuee) { ?>

								<tr>
									<td><?php
										//echo $this->requestAction('produits/system_get_name_produit/'.$key);
										foreach ($produits as $p => $value) {
											if ($p == $key) {
												echo $value;
											}
										}
										?></td>
									<td><?php echo $valuee[5]; ?></td>
									<td><?php echo $valuee[10]; ?></td>
									<td><?php echo $valuee[20]; ?></td>
								</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;margin-bottom:20px;">La liste des produits demandés non présentés :</label>
					</br>
					<?php if (!empty($sommeGam)) {

						foreach ($sommeGam as $key => $valuee) { ?>

							<span class="label label-success" style="width: auto;padding: 5px 9px;margin-right: 4px;vertical-align: middle;float:left;"><b style="margin-right: 8px;"><?php //echo $this->requestAction('games/system_get_name_game/'.$key);
																																														foreach ($gammes as $p => $value) {
																																															if ($p == $key) {
																																																echo $value;
																																															}
																																														}
																																														?></b><span class="label-warning" style="width: auto;padding: 7px 5px;margin-left: 6px;"><?php echo $valuee; ?></span></span>
						<?php }
					} else { ?>
						<div style='text-align:center'><b>
								<?php echo 'Aucun produit non présenté n\'a été demandé dans cette période'; ?>
							</b>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;margin-bottom:20px;">Les objections les plus mentionnées :</label>
					</br>
					<table class="col-md-12 col-sm-12 table table-striped" style="float:none;margin:auto;width:100%;">
						<thead>
							<tr>
								<th>Objection</th>
								<th>Mots clés</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Prix</td>
								<td><?php
									$nbre = 10;
									if (!empty($sliced_price)) {
										foreach ($sliced_price as $s => $value) { ?>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $s . ' | ' . $value; ?> </b><i class="fa fa-plus"></i>
											</span>
									<?php $nbre++;
										}
									} ?>

								</td>
							</tr>
							<tr>
								<td>INDICATION</td>
								<td><?php
									if (!empty($sliced_indication)) {
										foreach ($sliced_indication as $s => $value) { ?>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $s . ' | ' . $value; ?> </b><i class="fa fa-plus"></i>
											</span>
									<?php $nbre++;
										}
									} ?>
								</td>
							</tr>
							<tr>
								<td>PATHOLOGIE</td>
								<td><?php
									if (!empty($sliced_pathologie)) {
										foreach ($sliced_pathologie as $s => $value) { ?>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $s . ' | ' . $value; ?> </b><i class="fa fa-plus"></i>
											</span>
									<?php $nbre++;
										}
									} ?>
								</td>
							</tr>
							<tr>
								<td>POSOLOGIE</td>
								<td><?php
									if (!empty($sliced_posologie)) {
										foreach ($sliced_posologie as $s => $value) { ?>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $s . ' | ' . $value; ?> </b><i class="fa fa-plus"></i>
											</span>
									<?php $nbre++;
										}
									} ?>
								</td>
							</tr>
							<tr>
								<td>PRESENTATION</td>
								<td><?php
									if (!empty($sliced_presentation)) {
										foreach ($sliced_presentation as $s => $value) { ?>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $s . ' | ' . $value; ?> </b><i class="fa fa-plus"></i>
											</span>
									<?php $nbre++;
										}
									} ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Les secteurs:</label>
					<div class="col-md-2"></div>
					<div class="col-md-8" style="height:auto;max-height:400px;overflow:auto;">
						<table class="col-md-12 col-sm-12 table table-striped display1" id="" style="float:none;margin:auto;width:100%;">
							<thead>
								<tr>
									<th>Secteur</th>
									<th>Nombre de clients</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sommeSecteur as $s => $sec) { ?>
									<tr>
										<td>
											<?php
											foreach ($secteurs as $se => $sect) {
												if ($s == $se) {
													echo $sect;
												}
											}							?>
										</td>
										<td>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $sec; ?> </b><i class="fa fa-plus"></i>
											</span>
										</td>
									</tr>
								<?php $nbre++;
								} ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="col-md-12" style="border-top:1px solid #ddd;padding:1%;">
					<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;font-size: 16px;font-weight: normal;">Les spécialités:</label>
					<div class="col-md-2"></div>
					<div class="col-md-8" style="height:auto;max-height:400px;overflow:auto;">
						<table class="col-md-12 col-sm-12 table table-striped display1" id="" style="float:none;margin:auto;width:100%;">
							<thead>
								<tr>
									<th>Spécialité</th>
									<th>Nombre de clients</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sommeSpec as $s => $vl) { ?>
									<tr>
										<td>
											<?php
											//debug($categories);
											foreach ($categories as $c => $cat) {
												if ($c == $s) {
													echo $cat;
												}
											} ?>
										</td>
										<td>
											<span class="optionh" style="color:#3c8dbc;border: 1px solid #3c8dbc;padding: 1px 2px;margin: 0px 4px;cursor:pointer;" onclick="objettog(<?php echo $nbre; ?>)">
												<b><?php echo $vl; ?> </b><i class="fa fa-plus"></i>
											</span>
										</td>
									</tr>
								<?php $nbre++;
								} ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin:0px;">
	<div class="col-md-12" style="float:none;margin:auto;">
		<div class="box" style="border-color:#3c8dbc;">
			<div class="box-header with-border">
				<h3 class="box-title">Liste des visites</h3>
			</div>
			<?php
			if (!empty($visites)) {
				$i = 0;
				$j = 0;
				//debug($somme);
				//$datedebutinit=$date_debut;
				foreach ($somme as $key1 => $value) {

					foreach ($types as $t) {
						$objByType[$t] = 0;
						$typess[] = $t;
						//$types=array_unique($typess);
					}
					//debug($types);
					$infos = explode("|", $key1);

					$name = $infos[0];
					$id = $infos[1];


					$j++;

			?>
					<div class="box" style="padding:1%;width:98%;margin:auto;">

						<?php

						$date_begin = date("Y-m-d", strtotime('monday this week', strtotime($date_debut)));
						//echo $date_fin;
						if (date('l', strtotime($date_fin)) != 'Sunday') {
							$date_end = date("Y-m-d", strtotime('sunday this week', strtotime($date_fin)));
						} else {
							$date_end = date("Y-m-d", strtotime($date_fin));
						}
						//echo $date_end;


						$objectifglobale = 0;

						$nbraffbypotv2 = $this->requestAction('/rapports/system_get_nbr_affectation_potv2/' . $id . "/" . $date_begin . "/" . $date_end);
						while ($date_begin <= $date_end) {
							//existe plans de tourné de la semaine 
							$plan = $this->requestAction('/plantournes/system_existeplanification/' . $id . '/' . $date_begin);
							if ($plan != 0) {
								$objectif = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $id . "/" . $date_begin);
								foreach ($objectif as $obj) {
									foreach ($types as $t) {
										if ($obj['Type']['name'] == $t)
											$objByType[$t] = $objByType[$t] + $obj['Objectif']['objectif'];
									}
									$objectifglobale = $objectifglobale + $obj['Objectif']['objectif'];
								}
							}
							$date_begin = date('Y-m-d', strtotime($date_begin . ' + 7days'));
						}
						$class = "red";
						if ($objectifglobale != 0) {
							$prog = $value / $objectifglobale * 100;
							if ($prog < 50)
								$class = "red";
							else if ($prog <= 75)
								$class = "yellow";
							else
								$class = "green";
						} ?>

						<div class="box-header with-border">
							<div class="box-title col-md-10">
								<div class="col-md-2" style="font-size: 15px;"><b>Employé : </b></br><span><?php echo $name; ?></span></div>
								<div class="col-md-2" style="font-size: 15px;"><b>NB Visite : </b></br><span><?php
																												$visiteglobale = $visiteglobale + $value;
																												echo $value; ?></span></div>
								<div class="col-md-2" style="font-size: 15px;"><b>Objectif: </b></br><span><?php
																											$objectiftotal = $objectiftotal + $objectifglobale;
																											echo $objectifglobale; ?></span></div>
								<div class="col-md-2" style="font-size: 15px;"><b>Progression : </b></br>
									<div class="progress progress-xs" style="margin-top:8px;">
										<div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
																																		if ($objectifglobale != 0) {
																																			echo $value / $objectifglobale * 100;
																																		} else {
																																			echo 0;
																																		} ?>%"></div>
									</div>
								</div>
								<div class="col-md-2" style="font-size: 15px;"><b>Pourcentage : </b></br><span class="badge bg-<?php echo $class; ?>" style="padding: 1px 3px;">
										<?php if ($objectifglobale == 0)
											echo 'Objectif non renseigné,impossible de faire le calcul';
										else
											echo round($value / $objectifglobale * 100, 2) . '%'; ?>
										<button type="button" onclick="boxtogl(<?php echo $i; ?>)" class="btn btn-box-tool" style="font-size:16px; border-radius:0px;border-left:1px solid #fff;padding:0px 4px;"><i id="iconl<?php echo $i; ?>" class="fa fa-plus" style="color:#fff;"></i></button>
									</span></div>
							</div>
							<button type="button" onclick="boxtog(<?php echo $i; ?>)" class="btn btn-box-tool" style="float: right;font-size:15px;">Voir tout les visites <i id="icon<?php echo $i; ?>" class="fa fa-plus" style="color:#aaa;"></i></button>
							<div class="col-md-12 boxtogl<?php echo $i; ?>" style="display:none;overflow: scroll;overflow-y: hidden;">
								<table class="table table-bordered" style="text-align:center;">
									<thead>
										<tr>
											<th>Type</th>
											<th>Objectif</th>
											<th>N° visites effectuées</th>
											<th style="width:30%;">Progression</th>
											<th>Pourcentage</th>
											<th>Détail potentialité</th>
										</tr>
									</thead>
									<?php foreach ($objByType as $keyO => $obt):
										$nbVisit = 0;
										$nbVisitQAM = 0;
										$nbVisitPCM = 0;
										$nbVisitPM = 0;
										$nbVisitNR = 0;
										$typ = '';
									?>

										<tr>
											<td><?php echo $keyO; ?>
											</td>
											<td><?php echo $obt; ?></td>

											<td><?php foreach ($visites as $v) {
													if ($v['User']['name'] == $name) {
														//debug($types);
														if ($v["Client"]["potentialitev2"] == 'QAM') {
															$nbVisitQAM = $nbVisitQAM + 1;
														} elseif ($v["Client"]["potentialitev2"] == 'PCM') {
															$nbVisitPCM = $nbVisitPCM + 1;
														} elseif ($v["Client"]["potentialitev2"] == 'PM') {
															$nbVisitPM = $nbVisitPM + 1;
														} elseif ($v["Client"]["potentialitev2"] == 'NR') {
															$nbVisitNR = $nbVisitNR + 1;
														}

														foreach ($types as $key => $t) {
															// echo $v["Client"]["type_id"];
															// echo nl2br("\n");
															// echo 'hada lkey : '.$key;
															if ($v["Client"]["type_id"] == $key) {
																$typ = $t;
																break;
															}
														}
														if ($typ == $keyO) {
															$nbVisit = $nbVisit + 1;
														}
													}
												} ?>
												<?php echo $nbVisit; ?>
											</td>
											<?php if ($obt != 0) {
												$prog = $nbVisit / $obt * 100;
												if ($prog < 50)
													$class = "red";
												else if ($prog <= 75)
													$class = "yellow";
												else
													$class = "green";
											} elseif ($obt == 0) {
												$class = "red";
											} ?>
											<td>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
																																					if ($obt != 0) {
																																						echo $nbVisit / $obt * 100;
																																					} else {
																																						echo 0;
																																					} ?>%"></div>
												</div>
											</td>
											<td><?php if ($objectifglobale == 0) { ?>
													<span class="badge bg-<?php echo $class; ?>"><?php echo 'Objectif non renseigné,impossible de faire le calcul';
																								} else { ?></span>
													<span class="badge bg-<?php echo $class; ?>"><?php
																									if ($obt != 0) {
																										echo round($nbVisit / $obt * 100, 2);
																									} else {
																										echo 0;
																									} ?>%</span><?php } ?>
											</td>
											<td><?php if ($keyO == "Médecin"): ?><button type="button" onclick="boxtogp(<?php echo $i; ?>)" class="btn btn-box-tool" style="float: nine;margin:auto;font-size:16px;"><i id="iconp<?php echo $i; ?>" class="fa fa-plus" style="color:#aaa;"></i></button><?php endif; ?></td>
										</tr>
										<?php if ($keyO == "Médecin"): ?>
											<tbody class="boxtogp<?php echo $i; ?>" style="display:none;">
												<?php foreach ($nbraffbypotv2 as $key => $v) { ?>
													<tr>
														<td><?php echo $key; ?></td>
														<td><?php echo $v; ?></td>
														<td><?php
															if ($key == 'QAM') {
																$nbQAMtotal = $nbQAMtotal + $v;
																$nbVisitQAMtotal = $nbVisitQAM + $nbVisitQAMtotal;
																echo $nbVisitQAM;
															} elseif ($key == 'PCM') {
																$nbPCMtotal = $nbPCMtotal + $v;
																$nbVisitPCMtotal = $nbVisitPCM + $nbVisitPCMtotal;
																echo $nbVisitPCM;
															} elseif ($key == 'PM') {
																$nbPMtotal = $nbPMtotal + $v;
																$nbVisitPMtotal = $nbVisitPM + $nbVisitPMtotal;
																echo $nbVisitPM;
															} else if ($key == 'NR') {
																$nbNRtotal = $nbNRtotal + $v;
																$nbVisitNRtotal = $nbVisitNR + $nbVisitNRtotal;
																echo $nbVisitNR;
															}

															?></td>
														<?php if ($v != 0) {
															if ($key == 'QAM') {
																$prog = $nbVisitQAM / $v * 100;
															} elseif ($key == 'PCM') {
																$prog = $nbVisitPCM / $v * 100;
															} elseif ($key == 'PM') {
																$prog = $nbVisitPM / $v * 100;
															} else {
																$prog = $nbVisitNR / $v * 100;
															}
															if ($prog < 50) {
																$class = "red";
															} elseif ($prog <= 75) {
																$class = "yellow";
															} else {
																$class = "green";
															}
														} elseif ($v == 0) {
															$class = "red";
														} ?>
														<td>
															<div class="progress progress-xs">
																<div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
																																								if ($v != 0) {
																																									if ($key == 'QAM') {
																																										echo $nbVisitQAM / $v * 100;
																																									} elseif ($key == 'PCM') {
																																										echo $nbVisitPCM / $v * 100;
																																									} elseif ($key == 'PM') {
																																										echo $nbVisitPM / $v * 100;
																																									} else {
																																										echo $nbVisitNR / $v * 100;
																																									}
																																								} else {
																																									echo 0;
																																								} ?>%"></div>
															</div>
														</td>
														<td>

															<span class="badge bg-<?php echo $class; ?>"><?php
																											if ($v != 0) {
																												if ($key == 'QAM') {
																													echo round($nbVisitQAM / $v * 100, 2);
																												} elseif ($key == 'PCM') {
																													echo round($nbVisitPCM / $v * 100, 2);
																												} elseif ($key == 'PM') {
																													echo round($nbVisitPM / $v * 100, 2);
																												} else {
																													echo round($nbVisitNR / $v * 100, 2);
																												}
																											} else echo 0; ?>%</span>
														</td>
													</tr>
												<?php } ?>

											</tbody>
										<?php endif; ?>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
						<div class="box-body table-responsive boxtog<?php echo $i; ?>" style="display:none;overflow: scroll;overflow-y: hidden;">
							<table class="table table-bordered display" id=""><!-- example<?php //echo $j 
																							?> -->
								<thead>
									<tr>
										<th>Client</th>
										<th>Type</th>
										<th>Catégorie</th>
										<th>Potentialité</th>
										<th>Objection</th>
										<th>Concurrents</th>
										<th>Partenaires</th>
										<th>échantillons</th>
										<th>Produit donnée</th>
										<th>Produits demandés non présentés</th>
										<th>Date</th>
										<th>Commentaire</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php foreach ($visites as $value):
									if ($value['User']['name'] == $name):
								?>
										<tr>
											<td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?>&nbsp;</td>
											<?php
											foreach ($types as $key => $v) {
												if ($value["Client"]["type_id"] == $key) {
													$k = $v;
													break;
												}
											}
											echo "<td>$k&nbsp;</td>";
											$k = "";
											foreach ($categories as $key => $v) {
												if ($value["Client"]["category_id"] == $key) {
													$k = $v;
													break;
												}
											}
											echo "<td>$k&nbsp;</td>"; ?>
											<td>
												<?php echo $value["Client"]["potentialitev2"]; ?>
											</td>
											<td>
												<?php
												if (strpos($val["Visite"]["objection"], '#') === 0) {
													$visiteobjection = ltrim($val["Visite"]["objection"], '#');
													$obV = explode('||', $visiteobjection);

													foreach ($obV as $o) {
														$products = explode(';', $o); ?>
														<div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
															<span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
																																																								//debug($product);
																																																								foreach ($produits as $key => $p) {
																																																									if ($key == $products[0]) {
																																																										echo $p;
																																																									}
																																																								}
																																																								//echo $products[0];
																																																								?>
																</b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
															<div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
																<?php $objections = explode(',', $products[1]);
																array_pop($objections);
																foreach ($objections as $obj) {
																	$objec = explode('|', $obj); ?>
																	<div class="col-md-2 objet objeto<?php echo $iii; ?>">
																		<span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
																		<ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
																			<?php for ($j = 1; $j < count($objec); $j++) { ?>
																				<li><?php echo $objec[$j]; ?></li>
																			<?php } ?>
																		</ul>
																	</div>
																<?php $iii++;
																} ?>
															</div>
														</div>
													<?php $ii++;
													}
												} else if (strpos($val["Visite"]["objection"], '*') === 0) {
													$objection = ltrim($val["Visite"]["objection"], '*');
													$objections = explode(',', $objection);
													array_pop($objections);
													//debug($objections);
													foreach ($objections as $obj) {
														$words = '';
														$objec = explode('|', $obj); ?>
														<div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
															<b><?php echo $objec[0]; ?> :</b>
															<span><?php for ($j = 1; $j < count($objec); $j++) {
																		$words = $words . ',' . $objec[$j];
																		$words = ltrim($words, ',');
																	} ?><?php echo $words; ?> </span>
														</div>
												<?php }
												} else {
													echo $val["Visite"]["objection"];
												} ?>
											</td>
											<td><?php echo $value["Visite"]["veille"]; ?>&nbsp;</td>
											<td><?php echo $value["Visite"]["partenaires"]; ?>&nbsp;</td>
											<td><?php $ech =  explode("||", $value["Visite"]['echantillons']);
												$ec =  explode("-", $value["Visite"]['echantillons']);
												if (count($ec) > 1) {
													for ($ch = 0; $ch < count($ech); $ch++) {
														$ec =  explode("-", $ech[$ch]);
														$nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-bottom:7px;float:left;' ><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
													}
												} ?>
												&nbsp;</td>
											<td><?php if (!empty($value["Visite"]['produits'])) {
													$ec =  explode("|", $value["Visite"]['produits']);
													if (strpos($ec[0], '*') === 0) {
														$gams = ltrim($ec[0], '*');
														//debug($gams);
														$gams = explode(",", $gams);

														$gam = "";
														foreach ($gams as $g) {
															//echo $g;
															$nom = $this->requestAction('/games/system_get_name_game/' . $g);
															$gam = $gam . " | " . $nom;
														}
														$gam = ltrim($gam, " | ");
														$nomch = $gam;
													} else {
														$nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
													}
													echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;'><b style='margin-right: 8px;'>$nomch</b><span class='label-warning' style='width: auto;padding: 5px 5px;'>$ec[1]</span></span>";
												} ?>
												&nbsp;</td>
											<td><?php if (!empty($value["Visite"]['produitsNP'])) {
													$ec =  explode("|", $value["Visite"]['produitsNP']);
													$l = 0;
													foreach ($ec as $e) {
														$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$l]);
														echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;line-height: 28px;'><b style='margin-right: 8px;'>$nomch</b></span><br>";
														$l++;
													}
												} ?>
												&nbsp;</td>
											<td><b style="min-width:73px;float: left;"><?php
																						$date = strtotime($value["Visite"]["date"]);
																						$dat = date('Y-m-d', $date);
																						echo $dat;; ?></b>&nbsp;</td>
											<td><?php echo $value["Visite"]["commentaire"]; ?>&nbsp;</td>
											<td>
												<a class="btn btn-danger btn-xs" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'archive', $value['Visite']['id'], 0)); ?>" title="Archive">Archiver</a>
												&nbsp;
											</td>
										</tr>
								<?php endif;
								endforeach; ?>
							</table>
						</div>
					</div>
			<?php $i++;
				}
			} ?>
		</div>
	</div>
</div>


<style>
	.objet {
		padding: 0px;
		float: left;
		margin: auto;
		width: 100%;
		text-align: center;
	}

	.objet .optionh {
		float: none;
		border-radius: 5px;
		padding: 2px 0px 2px 5px;
		color: #fff;
		background: none;
		z-index: 2;
		position: relative;
		width: 100%;
	}

	.objet .optionh .fa {
		height: 100%;
		width: 25px;
		text-align: center;
		line-height: 20px;
		border-left: 1px solid;
		padding: 2px;
		cursor: pointer;
	}

	.objet .optionb {
		min-width: 98px;
		width: auto;
		float: none;
		margin: auto 13%;
		margin-right: 0px;
		border-radius: 5px;
		padding: 7px 8px;
		margin-top: 0px;
		display: none;
		background: #3480ad;
		list-style: none;
		color: #fff;
		position: absolute;
		z-index: 99999;
		box-shadow: 0px 2px 1px rgba(95, 94, 94, 0.43);
		max-height: 500px;
		overflow: auto;
	}

	.objet .optionb li {
		color: #fff;
		width: 100%;
		float: left;
		text-align: center;
		font-size: 13px;
		font-weight: bold;
		text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.91);
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		border: 1px solid rgba(206, 206, 206, 0.26) !important;
		vertical-align: middle;
		text-align: center;
	}

	.optionb::-webkit-scrollbar {
		width: 10px;
		height: 17px;
		background-color: rgba(255, 255, 255, 0.05);
		border: none;
		position: relative;
		z-index: 9999;
		margin-right: 33px;
	}

	.optionb::-webkit-scrollbar-thumb {
		background-color: rgba(80, 80, 80, 0.5);
		border: 1px solid rgba(132, 132, 132, 0.12);
		height: 20px;
		width: auto;
		/* border-radius:5px; */
	}

	.optionb::-webkit-scrollbar-thumb:hover {
		background-color: rgba(6, 31, 19, 0.67);
	}

	.optionb::-webkit-scrollbar-corner {
		background-color: rgba(255, 255, 255, 0);
	}
</style>
<script>
	$(function() {
		$('table.display').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"iDisplayLength": 50,
			dom: 'Bfrtip',
			buttons: [{
					extend: 'csv'
				},
				{
					extend: 'excel'
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
					}
				}
			],
		});
	});

	function listeid(id) {
		$(".inputid").attr("value", id);
		$(".lienid").attr("href", "/visites/add/" + id);
	}
	$(function() {
		$("#ClientsproposeProduits").select2();
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker'); ?>

<script>
	(function() {
		var input = document.getElementById('file-terrain');
		var dropZone = document.getElementById('drop-zone-terrain');
		var fileList = document.getElementById('file-list-terrain');
		var allFiles = [];

		function updateInput() {
			var dt = new DataTransfer();
			allFiles.forEach(function(f) {
				dt.items.add(f);
			});
			input.files = dt.files;
		}

		function renderList() {
			fileList.innerHTML = '';
			allFiles.forEach(function(file, i) {
				var ext = file.name.split('.').pop().toUpperCase();
				var size = file.size < 1024 * 1024 ?
					(file.size / 1024).toFixed(0) + ' KB' :
					(file.size / (1024 * 1024)).toFixed(1) + ' MB';

				var row = document.createElement('div');
				row.style.cssText = 'display:flex;align-items:center;gap:10px;padding:8px 12px;background:#fff;border:1px solid #ddd;border-radius:6px;';
				row.innerHTML =
					'<span style="font-size:11px;font-weight:600;padding:2px 6px;background:#eee;border-radius:3px;">' + ext + '</span>' +
					'<span style="flex:1;font-size:13px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + file.name + '</span>' +
					'<span style="font-size:12px;color:#888;">' + size + '</span>' +
					'<button type="button" data-i="' + i + '" style="background:none;border:none;cursor:pointer;font-size:18px;line-height:1;color:#999;">&times;</button>';

				row.querySelector('button').addEventListener('click', function() {
					allFiles.splice(parseInt(this.dataset.i), 1);
					updateInput();
					renderList();
				});
				fileList.appendChild(row);
			});
		}

		function addFiles(files) {
			Array.from(files).forEach(function(f) {
				if (!allFiles.find(function(x) {
						return x.name === f.name && x.size === f.size;
					}))
					allFiles.push(f);
			});
			updateInput();
			renderList();
		}

		input.addEventListener('change', function() {
			addFiles(this.files);
		});
		dropZone.addEventListener('dragover', function(e) {
			e.preventDefault();
			dropZone.style.borderColor = '#2196F3';
		});
		dropZone.addEventListener('dragleave', function() {
			dropZone.style.borderColor = '#aaa';
		});
		dropZone.addEventListener('drop', function(e) {
			e.preventDefault();
			dropZone.style.borderColor = '#aaa';
			addFiles(e.dataTransfer.files);
		});
	})();
</script>
<script>
	$(function() {
		$('#reservationtime').daterangepicker({
			format: 'MM/DD/YYYY',
			locale: {
				"format": "YYYY-MM-DD",
				"separator": " -- ",
				"applyLabel": "Valider",
				"cancelLabel": "Annuler",
				"fromLabel": "De",
				"toLabel": "à",
				"customRangeLabel": "Custom",
				"daysOfWeek": [
					"Dim",
					"Lun",
					"Mar",
					"Mer",
					"Jeu",
					"Ven",
					"Sam"
				],
				"monthNames": [
					"Janvier",
					"Février",
					"Mars",
					"Avril",
					"Mai",
					"Juin",
					"Juillet",
					"Août",
					"Septembre",
					"Octobre",
					"Novembre",
					"Décembre"
				],
				"firstDay": 1
			},
			clickApply: function(e) {
				this.updateInputText();
			}
		});
		$('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
			var startDate = picker.startDate;
			var endDate = picker.endDate;
			var action = $('#dateform').attr('action');
			var date = action + "?date=" + startDate + "--" + endDate;
			$('#dateform').attr('action', date);
			$('#dateform').submit();
		});
	});

	function boxtog(id) {
		$(".boxtog" + id).toggle();
		var clas = $("#icon" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#icon" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#icon" + id).attr("class", "fa fa-minus");
		}
	}

	function boxtogl(id) {
		$(".boxtogl" + id).toggle();
		var clas = $("#iconl" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#iconl" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#iconl" + id).attr("class", "fa fa-minus");
		}
	}

	function boxtogp(id) {
		$(".boxtogp" + id).toggle();
		var clas = $("#iconp" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#iconp" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#iconp" + id).attr("class", "fa fa-minus");
		}
	}

	function boxtogpo(id) {
		$(".boxtogpo" + id).toggle();
		var clas = $("#iconpo" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#iconpo" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#iconpo" + id).attr("class", "fa fa-minus");
		}
	}

	function boxtogprod(id) {
		$(".boxtogprod" + id).toggle();
		var clas = $("#iconpr" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#iconpr" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#iconpr" + id).attr("class", "fa fa-minus");
		}
	}

	function objettog(id) {
		var clas = $(".optionh" + id + " .fa").attr("class");
		$("#myModalapp" + id).modal('show');
		/*if (clas == 'fa fa-minus') {
		    $(".optionh"+id+" .fa").attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
		    $(".optionh"+id+" .fa").attr("class", "fa fa-minus");
		}*/
	}
</script>

<?php echo $this->Html->script('jquery.knob'); ?>
<script>
	$(function() {
		/* jQueryKnob */

		$(".knob").knob({
			/*change : function (value) {
			 //console.log("change : " + value);
			 },
			 release : function (value) {
			 console.log("release : " + value);
			 },
			 cancel : function () {
			 console.log("cancel : " + this.value);
			 },*/
			draw: function() {

				// "tron" case
				if (this.$.data('skin') == 'tron') {

					var a = this.angle(this.cv) // Angle
						,
						sa = this.startAngle // Previous start angle
						,
						sat = this.startAngle // Start angle
						,
						ea // Previous end angle
						, eat = sat + a // End angle
						,
						r = true;

					this.g.lineWidth = this.lineWidth;

					this.o.cursor &&
						(sat = eat - 0.3) &&
						(eat = eat + 0.3);

					if (this.o.displayPrevious) {
						ea = this.startAngle + this.angle(this.value);
						this.o.cursor &&
							(sa = ea - 0.3) &&
							(ea = ea + 0.3);
						this.g.beginPath();
						this.g.strokeStyle = this.previousColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
						this.g.stroke();
					}

					this.g.beginPath();
					this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
					this.g.stroke();

					this.g.lineWidth = 2;
					this.g.beginPath();
					this.g.strokeStyle = this.o.fgColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
					this.g.stroke();
					return false;
				}
			}
		});
	});

	var objectiftotal = <?php echo $objectiftotal; ?>;
	var manque = <?php echo $objectiftotal - $visiteglobale; ?>;
	var visiteglobale = <?php echo $visiteglobale; ?>;
	var nbPCMtotal = <?php echo $nbPCMtotal - $nbVisitPCMtotal; ?>;
	var nbVisitPCMtotal = <?php //echo $nbPCMtotal-$nbVisitPCMtotal;
							echo $nbVisitPCMtotal;
							?>;
	if (objectiftotal == 0) {
		var pvisite = 0;
		var pnvisite = 0;
	} else {
		var prvisite = (visiteglobale * 100) / objectiftotal;
		var pvisite = Math.round(prvisite);
		var prnvisite = (manque * 100) / objectiftotal;
		var pnvisite = Math.round(prnvisite);
	}
	$(window).load(function() {
		$('.visite-v').text(visiteglobale + ' Visités (' + pvisite + '%)');
		$('.visite-n').text(manque + ' Non visités (' + pnvisite + '%)');
		$('.visite-o').text(objectiftotal + ' Objectif');
		var pcmt = nbVisitPCMtotal + nbPCMtotal;
		var pcmv = (nbVisitPCMtotal * 100) / pcmt;
		var pcmvp = Math.round(pcmv);
		var pcmnv = (nbPCMtotal * 100) / pcmt;
		var pcmnvp = Math.round(pcmnv);
		if (pcmt == 0) {
			$('.pcm-v').text(nbVisitPCMtotal + '(0%)');
			$('.pcm-n').text(nbPCMtotal + '(0%)');
		} else {
			$('.pcm-v').text(nbVisitPCMtotal + '(' + pcmvp + '%)');
			$('.pcm-n').text(nbPCMtotal + '(' + pcmnvp + '%)');
		}
		var nbQAMtotal = <?php echo $nbQAMtotal - $nbVisitQAMtotal; ?>;
		var nbVisitQAMtotal = <?php //echo $nbQAMtotal-$nbVisitQAMtotal;
								echo $nbVisitQAMtotal;
								?>;
		var qamt = nbVisitQAMtotal + nbQAMtotal;
		var qamv = (nbVisitQAMtotal * 100) / qamt;
		var qamvp = Math.round(qamv);
		var qamnv = (nbQAMtotal * 100) / qamt;
		var qamnvp = Math.round(qamnv);
		if (qamt == 0) {
			$('.qam-v').text(nbVisitQAMtotal + '(0%)');
			$('.qam-n').text(nbQAMtotal + '(0%)');
		} else {
			$('.qam-v').text(nbVisitQAMtotal + '(' + qamvp + '%)');
			$('.qam-n').text(nbQAMtotal + '(' + qamnvp + '%)');
		}
		var nbPMtotal = <?php echo $nbPMtotal - $nbVisitPMtotal; ?>;
		var nbVisitPMtotal = <?php //echo $nbPMtotal-$nbVisitPMtotal;
								echo $nbVisitPMtotal;
								?>;
		var pmt = nbVisitPMtotal + nbPMtotal;
		var pmv = (nbVisitPMtotal * 100) / pmt;
		var pmvp = Math.round(pmv);
		var pmnv = (nbPMtotal * 100) / pmt;
		var pmnvp = Math.round(pmnv);
		if (pmt == 0) {
			$('.pm-v').text(nbVisitPMtotal + '(0%)');
			$('.pm-n').text(nbPMtotal + '(0%)');
		} else {
			$('.pm-v').text(nbVisitPMtotal + '(' + pmvp + '%)');
			$('.pm-n').text(nbPMtotal + '(' + pmnvp + '%)');
		}
		var nbNRtotal = <?php echo $nbNRtotal - $nbVisitNRtotal; ?>;
		var nbVisitNRtotal = <?php //echo $nbNRtotal-$nbVisitNRtotal;
								echo $nbVisitNRtotal; ?>;
		var nrt = nbVisitNRtotal + nbNRtotal;
		var nrv = (nbVisitNRtotal * 100) / nrt;
		var nrvp = Math.round(nrv);
		var nrnv = (nbNRtotal * 100) / nrt;
		var nrnvp = Math.round(nrnv);
		if (nrt == 0) {
			$('.nr-v').text(nbVisitNRtotal + '(0%)');
			$('.nr-n').text(nbNRtotal + '(0%)');
		} else {
			$('.nr-v').text(nbVisitNRtotal + '(' + nrvp + '%)');
			$('.nr-n').text(nbNRtotal + '(' + nrnvp + '%)');
		}
	});
	/* END JQUERY KNOB */
	function concur(id) {
		$(".concur" + id).toggle();
		var clas = $("#concuricon" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#concuricon" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#concuricon" + id).attr("class", "fa fa-minus");
		}
	}

	function concurcl(id) {
		$(".concurclose" + id).parent().remove();
		$(".concur" + id).remove();
	}
	$('.ajouterconcur').click(function() {
		$(".concurtogg").each(function() {
			var btntogg = $(this).children().attr("class");
			if (btntogg == 'fa fa-minus') {
				$(this).trigger('click');
			}
		});
		//var ci = $(".concur").length;
		var cu = $(".concurr").attr('id');
		var ci = parseInt(cu);
		console.log(ci);
		var div = '<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius:4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;"><b style="line-height: 27px;">Concurrence (' + (ci + 1) + '):</b><span class="concurclose' + ci + '" style="float:right;cursor:pointer;padding:4px;color:#074c75;margin-left:5px;" onclick="concurcl(' + ci + ')"><i class="fa fa-times"></i></span><span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="concur(' + ci + ')"><i id="concuricon' + ci + '" class="fa fa-minus"></i></span></h4><div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px;margin-top:0px;background:#fefefe;" class="col-xs-12 concur' + ci + ' concur"><div class="col-md-6 col-xs-12"><div class="col-md-6 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Produit :</label><select name="data[RapportConcurance][' + ci + '][produit_id]" class="form-control select2 prodc1"><?php foreach ($produits as $k => $v): ?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php endforeach; ?></select></div><div class="col-md-6 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Produit concurrent :</label><input type="text" name="data[RapportConcurance][' + ci + '][produit_concurant]" class="col-xs-12" placeholder="Rédigez le nom du concurrent" style="float:left; padding:6px 8px;font-weight:bold;"></div><div class="col-md-6 col-xs-12"><label class="col-xs-12" style="padding: 0px;">L’offre :</label><textarea name="data[RapportConcurance][' + ci + '][offre]" class="col-xs-12" placeholder="L’offre" style="float:left; padding:4px 8px; font-weight:bold; max-width:100%; max-height:50px;"></textarea> </div><div class="col-md-6 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Commentaires :</label><textarea name="data[RapportConcurance][' + ci + '][commentaire]" class="col-xs-12" placeholder="Commentaires" style="float:left; padding:4px 8px; font-weight:bold; max-width:100%; max-height:50px; "></textarea> </div> </div><div class="col-md-6 col-xs-12"><div class="col-md-12 col-xs-12"><label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Type de l’offre :</label><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance][' + ci + '][type_offre][]" value="Pack"><b> Pack</b></div><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance][' + ci + '][type_offre][]" value="Action"><b> Action</b></div><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance][' + ci + '][type_offre][]" value="Autres"><b> Autres</b></div> </div><div class="col-md-12 col-xs-12" style="margin-top: 11px;"><label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Degrés d’agressivité :</label><div class="col-xs-4"><input type="radio" name="data[RapportConcurance][' + ci + '][agressivite][]" value="Très agressive"><b> Très agressive</b></div><div class="col-xs-4"><input type="radio" name="data[RapportConcurance][' + ci + '][agressivite][]" value="Agressive"><b> Agressive</b></div><div class="col-xs-4"><input type="radio" name="data[RapportConcurance][' + ci + '][agressivite][]" value="Peu agressive"><b> Peu agressive</b></div></div></div></div>';
		$('.concurr').append(div);
		$(".concurr").attr('id', ci + 1);
		$(".prodc1").select2();
	});
	$(function() {
		$(".prodc").select2();
	});
</script>