<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">

<?php
// Example string representing JSON-encoded vendors data
$vendeurJson = $client['Client']['vendeur'];

// Decode JSON string into PHP array
$vendeurs = json_decode($vendeurJson, true);
?>
<!-- esna/client/view -->
<style>
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

	.objet {
		padding: 0px;
		float: left;
		width: auto;
		margin-right: 3px;
		margin-left: 0px;
	}

	.objet .optionh {
		min-width: 80px;
		width: auto;
		float: left;
		border-radius: 5px;
		padding: 2px 0px 2px 5px;
		color: #fff;
		background: #3c8dbc;
		z-index: 99;
		position: relative;
	}

	.objet .optionh .fa {
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

	.objet .optionb {
		min-width: 80px;
		width: auto;
		left: 0px;
		border-radius: 5px;
		padding: 7px 8px;
		margin-top: 20px;
		margin-bottom: 4px;
		display: none;
		background: #3480ad;
		list-style: none;
		color: #fff;
		position: relative;
		z-index: 9;
	}

	.objet .optionb li {
		color: #fff;
	}

	.timeline>li>.timeline-item>.timeline-header {
		font-size: 19px;
		font-weight: 600;
	}

	body {
		padding-right: 0px !important;
	}

	/* order */
	.nopad {
		padding-left: 0 !important;
		margin: 11px 2px;
		padding-right: 0 !important;
	}

	/*image gallery*/
	.image-checkbox {
		cursor: pointer;
		margin-bottom: 0;
		outline: 0;
	}

	.blocker {
		z-index: 1039;
	}

	#gadget_modal {
		overflow: initial;
	}

	/*  cards gadget style  */
	.card {
		border-radius: 0.5rem;
		padding: 9px;
		background: white;
		box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
		--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
		--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
		margin-bottom: 10px;
	}

	.card-date {
		background: #9fd3ff;
		padding: 2px 8px;
		border-radius: 20px;
		font-size: 12px;
		border: 1px solid #c3def5;
	}

	.card-title {
		padding: 8px 2px;
		margin: 0;
		font-size: 20px;
		font-weight: 600;
		font-family: 'Inter', sans-serif;
		display: inline-block;
	}

	.card-user-name {
		float: right;
		background: #f9cd57;
		padding: 2px 8px;
		border-radius: 20px;
		font-size: 12px;
		border: 1px solid #ffdf89;
	}

	.card-body {
		display: flex;
		align-items: center;
		width: 100%;
		justify-content: space-between;
		flex-direction: column-reverse;
	}

	.qte-gadget {
		display: inline;
		background: gainsboro;
		border-radius: 50px;
		font-size: 28px;
		font-weight: 700;
		padding: 4px 9px;

	}

	.all-cards {
		/* height: 836px; */
		height: auto;
		overflow: auto;
	}

	/* style Les dernières adoptions du produit right */
	.products-list .product-info {
		margin-left: 0;
	}

	.adoption_data {
		display: flex;
		flex-direction: column;
	}

	.sub_adopt {
		display: flex;
		justify-content: space-between;
		padding: 0 12px;
	}

	.p-0 {
		padding: 0;
	}

	.pl-0 {
		padding-left: 0;
	}

	.detail_viste {
		max-height: 829px;
		overflow-y: scroll;
	}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<div id="myModalmap" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Maps <b style="float:right;margin-right:10px;"></b></h4>
			</div>
			<div class="modal-body" style="height: 480px;">
				<div id="map-canvas" class="col-md-12" style="height: 480px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>

	</div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="width: 90%;">
		<div class="modal-content col-xs-12"
			style="margin-top: 8%;overflow: auto;border-radius: 6px;font-size: 16px;padding: 0px;">
			<div class="modal-header col-xs-12" style="background:#469ed1;color: #fff;">
				<h3 class="modal-title" id="gridModalLabel" style="width: auto;float: left;"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"
					style="font-size: 35px;float: right;margin-top: -11px;">×</button>
			</div>
			<div class="modal-body col-xs-12">
				<div class="table-responsive col-xs-12">
					<table class="table table-bordred">

					</table>
				</div>
			</div>
			<div class="modal-footer col-xs-12">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="width: 90%;">
		<div class="modal-content col-xs-12"
			style="margin-top: 8%;overflow: auto;border-radius: 6px;font-size: 16px;padding: 0px;">
			<div class="modal-header col-xs-12" style="background:#469ed1;color: #fff;">
				<h3 class="modal-title" id="gridModalLabel" style="width: auto;float: left;"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"
					style="font-size: 35px;float: right;margin-top: -11px;">×</button>
			</div>
			<div class="modal-body col-xs-12">
				<div class="table-responsive col-xs-12">
					<table class="table table-bordred">
						<thead>
							<tr>
								<th>Produits</th>
								<th>Emplacement produits</th>
								<th>PLV en place</th>
								<th>Stocks disponibles au moment de la visite</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="modal-footer col-xs-12">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>
<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="width: 90%;">
		<div class="modal-content col-xs-12"
			style="margin-top: 8%;overflow: auto;border-radius: 6px;font-size: 16px;padding: 0px;">
			<div class="modal-header col-xs-12" style="background:#469ed1;color: #fff;">
				<h3 class="modal-title" id="gridModalLabel" style="width: auto;float: left;"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"
					style="font-size: 35px;float: right;margin-top: -11px;">×</button>
			</div>
			<div class="modal-body col-xs-12">
				<div class="table-responsive col-xs-12">
					<table class="table table-bordred">
						<thead>
							<tr>
								<th>Produit</th>
								<th>Produit concurrent</th>
								<th>Emplacement produits</th>
								<th>PLV en place</th>
								<th>Type de l’offre</th>
								<th>Degrés d’agressivité</th>
								<th>Stocks disponibles au moment de la visite</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="modal-footer col-xs-12">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_return" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Export Result</h4>
			</div>
			<div class="modal-body">
				<div id="export-message">
					<p class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></p>
					<p class="text-center">Export en cours...</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="row ">
	<div class="col-md-9 p-0">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua box box-default collapsed-box" style="border-top:0px;">
				<div class="inner">
					<h3><?php
						$i = 0;
						setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
						$details = array();
						foreach ($client['Visite'] as $visite) {
							if (AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur') {
								if ($visite['date'] >= $client['Client']['date_recrutement']) {
									$i++;
									$details[] = $visite['date'];
								}
							} else {
								if ($visite['date'] >= $client['Client']['date_recrutement'] && $visite['user_id'] == AuthComponent::user('id')) {
									$i++;
									$details[] = $visite['date'];
								}
							}
						}
						echo $i;
						?>
					</h3>
					<p>Nombre de visites</p>
					<div class="icon">
						<i class="ion ion-eye"></i>
					</div>
				</div>
				<div class="small-box-footer">
					<div class="box-header with-border">
						<div class="box-tools pull-right"
							style="top:-3px;width: 100%;right: 0px;padding: 0px 16px;border-bottom:1px solid #eee;">
							<b style="color:#fff;float:left;line-height: 30px;font-size: 13px;font-weight: normal;">Plus
								de détails</b>
							<button type="button" onclick="boxtog(1)" class="btn btn-box-tool" style="float: right;"><i
									id="icon1" class="fa fa-plus" style="color:#fff;"></i></button>
						</div>
					</div>
					<div class="box-body box1">
						<?php
						foreach ($details as $key => $value)
							echo "<i class='fa fa-clock'></i> $value<br>";
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<?php
			$dateretard = $this->requestAction('/clients/system_get_retard_list_client/' . $client['Client']['id']);
			$r = $i - $dateretard['nobre'];
			if ($r < 0)
				$css = 'red';
			else
				$css = 'green'
			?>
			<div class="small-box bg-<?php echo $css; ?> box box-default collapsed-box" style="border-top:0px;">
				<div class="inner">
					<h3>
						<?php
						echo $r;
						unset($dateretard['nobre']);
						?>
					</h3>
					<p>Nombre de retards</p>
					<div class="icon">
						<i class="ion ion-ios-time-outline"></i>
					</div>
				</div>
				<div class="small-box-footer">
					<div class="box-header with-border">
						<div class="box-tools pull-right"
							style="top:-3px;width: 100%;right: 0px;padding: 0px 16px;border-bottom:1px solid #eee;">
							<b style="color:#fff;float:left;line-height: 30px;font-size: 13px;font-weight: normal;">Plus
								de détails</b>
							<button type="button" onclick="boxtog(2)" class="btn btn-box-tool" style="float: right;"><i
									id="icon2" class="fa fa-plus" style="color:#fff;"></i></button>
						</div>
					</div>
					<div class="box-body box2">
						<?php
						foreach ($dateretard as $key => $value)
							echo "<i class='fa fa-clock'></i> $value<br>";
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-light-blue">
				<div class="inner">
					<?php
					$styleicon = "";
					if (count($client['Action']) == 0)
						echo '<h3>----</h3>';
					else {
						$now = time();
						$your_date = strtotime($client['Action'][0]['date_fin']);
						$datediff = $your_date - $now;
						$j = floor($datediff / (60 * 60 * 24));
						if ($j > 0) {
							//echo "<p>" . $client['Action'][0]['name'] . "</p>";
							echo "<h4>Reste $j jours</h4>";
							$styleicon = " color: #fcfc90; position: relative; top: -8px; ";
						} else
							echo '<h4>----</h4>';
					}
					echo '<p>Action en cours</p>';
					?>

				</div>
				<div class="icon">
					<i style="<?php echo $styleicon; ?>" class="ion ion-star"></i>
				</div>
			</div>
		</div>
		<div class="col-md-12" style="z-index: 99;">
			<!-- Widget: user widget style 1 -->
			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua" style="height:120px;">
					<div class="widget-user-image">
					</div>
					<style>
						@media (max-width: 450px) {
							.wud {
								margin-left: 5% !important;
							}

							.widget-user-header {
								height: 180px !important;
							}
						}
					</style>
					<!-- /.widget-user-image -->
					<h1 class="widget-user-username"
						style="margin: 0px;font-size: 30px !important;font-weight: 500;width:auto;float:left;padding:0%;">
						<?php echo $client['Client']['nom'] . ' ' . $client['Client']['prenom']; ?>
					</h1>
					<?php if ((AuthComponent::user('role') == 'Admin')) { ?>
						<h3 class="widget-user-desc"
							style="margin: auto;font-size: 25px !important;font-weight: 500;width: auto;height: 43px;line-height: 38px;float: left;text-align: center;padding: 0% 1%;border: 2px solid;border-radius: 0;left: 15%;top: -1%;position: relative;">
							<?php echo $client['Client']['potentialite']; ?>
						</h3>
					<?php } ?>
					<h3 class="widget-user-desc wud"
						style="float: right;padding: 1%;border: 2px solid;border-radius: 0%;font-size: 24px;line-height: 22px;margin-left: 0%;">
						<?php
						if ($client['Type']['name'] == 'Pharmacie') {
							echo 'CA : ' . $client['Client']['activite'];
						} else {
							// if ($client['Client']['potentialitev2'] == null) {
							// echo "--";
							// } else {
							// echo h($client['Client']['potentialitev2']);
							//}
						}
						?>
					</h3><br>
					<div class="actions" style="margin-bottom: 18px;float:left;width: 100%;padding: 0px 0px;">
						<?php
						//if ((AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur') || $client['Client']['category_id']==19 || AuthComponent::user('id')==210)
						if ($this->requestAction('/droits/getrole/visites/add') == 1)
							echo $this->Html->link(__('Visiter'), array('controller' => 'visites', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-primary btn-md bg-aqua"));
						if ($this->requestAction('/droits/getrole/actions/add') == 1)
							echo $this->Html->link(__('Demander une action'), array('controller' => 'actions', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-primary btn-md bg-aqua"));
						if ($this->requestAction('/droits/getrole/packs/add') == 1)
							echo $this->Html->link(__('Ajouter un pack'), array('controller' => 'packs', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-primary btn-md bg-aqua"));
						if ($this->requestAction('/droits/getrole/clients/remettre0') == 1)
							echo $this->Html->link(__('remettre à 0'), array('action' => 'remettre0', $client['Client']['id']), array("class" => "btn btn-primary btn-md bg-aqua"));
						if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
							<a href="#gadget_modal" rel="modal:open" class="btn btn-warning btn-gadget">Ajouter gadget</a>
						<?php endif; ?>


						<?php if ($client['Type']['name'] != 'Médecin') {
							//echo $this->Html->link(__('Ajouter une commande'), array('controller' => 'commandes', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-primary btn-md bg-aqua"));

							$token = $client['Client']['id'] * 12;
							$tok = md5($token);
							if (empty($client['Client']['tel'])) {
								$tel = 0;
							} else {
								$tel = $client['Client']['tel'];
							}
						}
						?>
						<b style="float:right;font-size: 17px;line-height: 30px;"><?php
																					if ($client['Client']['sexe'] == 'h') {
																						echo 'Homme';
																					} elseif ($client['Client']['sexe'] == 'f') {
																						echo 'Femme';
																					}
																					?>
						</b>
					</div>

					<div>

					</div>
				</div>

				<div class="box-footer no-padding">
					<?php if ($client['Type']['name'] == 'Médecin' || $client['Type']['id'] == '5') { ?>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<ul class="nav nav-stacked">
								<li>
									Code <span class="pull-right"><?php
																	$typ = substr($client['Category']['name'], 0, 3);
																	$typ = strtoupper($typ);
																	echo $client['Secteur']["code_region"] . $client['Secteur']["code_ville"] . $client['Secteur']["code_secteur"] . $typ . $client['Client']['id'];
																	?></span>
								</li>
								<li>
									Type <span class="pull-right"><?php echo $client['Type']['name']; ?></span>
								</li>
								<li>
									Secteur <span class="pull-right"><?php echo $client['Secteur']['full_name']; ?></span>
								</li>
								<li>
									Catégorie <span class="pull-right"><?php echo $client['Category']['name']; ?></span>
								</li>
								<li>
									Tendance <span class="pull-right"><?php echo $client['Category1']['name']; ?></span>
								</li>
								<li>
									Titre <span class="pull-right "><?php echo h($client['Client']['titre']); ?></span>
								</li>
								<li>
									Activité <span
										class="pull-right "><?php echo h($client['Client']['activite']); ?></span>
								</li>
								<li>
									Exercice <span
										class="pull-right "><?php echo h($client['Client']['exercice']); ?></span>
								</li>

							</ul>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12" style="float:right;">
							<ul class="nav nav-stacked">

								<li>
									GSM <span class="pull-right "><?php echo h($client['Client']['tel']); ?></span>
								</li>
								<li>
									E-mail <span class="pull-right "><?php echo h($client['Client']['mail']); ?></span>
								</li>
								<li>
									Fixe <span class="pull-right "><?php echo h($client['Client']['fixe']); ?></span>
								</li>
								<li>
									Fax <span class="pull-right "><?php echo h($client['Client']['fax']); ?></span>
								</li>
								<li>
									Adresse <span class="pull-right "><?php echo h($client['Client']['adress']); ?></span>
								</li>
								<li>
									Date de recrutement <span class="pull-right "><?php
																					$cc = explode(' ', $client['Client']['created']);
																					echo $cc[0];
																					?></span>
								</li>
								<li>Vendeurs
									<span class="pull-right ">
										<button class="btn btn-secondary" data-toggle="modal" data-target="#popup_vendor">
											<i class="fa fa-users"></i>
											<span class="count_vd"><?php echo count($vendeurs ?? []); ?></span>
										</button>
									</span>
								</li>
								<li>Remarque
									<span class="pull-right ">
										<?php echo $client['Client']['rmq']; ?>
									</span>
								</li>

							</ul>
						</div>
					<?php
					} else {
					?>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<ul class="nav nav-stacked">
								<li>
									Code Wavesoft <span
										class="pull-right"><?php echo $client['Client']['code_wavsoft']; ?></span>
								</li>
								<li>
									Client de centre d'appel<span class="pull-right"><?php
																						$clientcall = array("0" => "Non", "1" => "Oui");
																						echo $clientcall[$client['Client']['client_call']]; ?></span>
								</li>
								<li>
									Type <span class="pull-right"><?php echo $client['Type']['name']; ?></span>
								</li>
								<li>
									Dirigeant <span class="pull-right"><?php echo $client['Client']['dirigent']; ?></span>
								</li>
								<li>
									Secteur <span class="pull-right"><?php echo $client['Secteur']['full_name']; ?></span>
								</li>
								<li>
									Adresse <span class="pull-right "><?php echo h($client['Client']['adress']); ?></span>
								</li>
								<li>
									Date de recrutement <span
										class="pull-right "><?php echo h($client['Client']['date_recrutement']); ?></span>
								</li>
							</ul>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12" style="float:right;">
							<ul class="nav nav-stacked">
								<li>
									GSM <span class="pull-right "><?php echo h($client['Client']['tel']); ?></span>
								</li>
								<li>
									E-mail <span class="pull-right "><?php echo h($client['Client']['mail']); ?></span>
								</li>
								<li>
									Fixe <span class="pull-right "><?php echo h($client['Client']['fixe']); ?></span>
								</li>
								<li>
									Fax <span class="pull-right "><?php echo h($client['Client']['fax']); ?></span>
								</li>
								<li>Présentoir<span
										class="pull-right "><?php echo h($client['Client']['dirigent']); ?></span></li>
								<li>Vendeurs
									<span class="pull-right ">
										<button class="btn btn-secondary" data-toggle="modal" data-target="#popup_vendor">
											<i class="fa fa-users"></i>
											<span class="count_vd"><?php if (is_array($vendeurs))
																		echo count($vendeurs);
																	else
																		echo "0"; ?></span>
										</button>
									</span>
								</li>
								<li>Remarque
									<span class="pull-right ">
										<?php echo $client['Client']['rmq']; ?>
									</span>
								</li>
							</ul>
						</div>
					<?php
					} ?>



				</div>
				<div class="box-footer" style="display: flex;justify-content: center;align-items: center;flex-wrap: wrap;">
					<?php
					// Count how many buttons will be displayed
					$buttonCount = 0;
					if ($client['Type']['name'] == 'Pharmacie') {
						$buttonCount++;
					}
					if (
						$this->requestAction('/droits/getrole/clients/edit') == 1 ||
						$this->requestAction('/droits/getrole/clientsproposes/edit') == 1
					) {
						$buttonCount++;
					}

					// Set the width based on button count
					$buttonWidth = $buttonCount > 1 ? '45%' : '100%';
					?>

					<?php if ($client['Type']['name'] == 'Pharmacie') { ?>
						<button type="button" class="btn btn-primary export-client-btn"
							data-client-id="<?php echo $client['Client']['id']; ?>"
							style="width: <?php echo $buttonWidth; ?>; margin: 10px;">
							Exporter
						</button>
					<?php } ?>

					<?php
					if ($this->requestAction('/droits/getrole/clients/edit') == 1)
						echo $this->Html->link(
							'Editer',
							array('action' => 'edit', $client['Client']['id']),
							array(
								'class' => 'btn btn-warning',
								'style' => "width: {$buttonWidth}; margin: 10px;"
							)
						);
					else if ($this->requestAction('/droits/getrole/clientsproposes/edit') == 1)
						echo $this->Html->link(
							'Proposer une modification',
							array('controller' => 'clientsproposes', 'action' => 'edit', $client['Client']['id']),
							array(
								'class' => 'btn btn-warning',
								'style' => "width: {$buttonWidth}; margin: 10px;"
							)
						);
					?>
				</div>

			</div>

			<?php if (!empty($client['Action'])): ?>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Historique des actions</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>Responsable</th>
									<th>Gamme</th>
									<th>Date début</th>
									<th>Date fin</th>
									<th>Durée</th>
									<th>Reste</th>
									<th>Etat</th>
									<th></th>
								</tr>
								<?php
								foreach ($client['Action'] as $action):
								?>
									<tr>
										<td><?php echo $this->requestAction('/users/system_get_name_user/' . $action['user_id']); ?>
										</td>
										<td><?php
											echo $action['game_id'];
											?></td>
										<td><?php echo strftime("%A %d-%m-%Y", strtotime($action['date_debut'])); ?></td>
										<td><?php echo strftime("%A %d-%m-%Y", strtotime($action['date_fin'])); ?></td>
										<td><?php
											$now = strtotime($action['date_debut']);
											$your_date = strtotime($action['date_fin']);
											$datediff = $your_date - $now;
											$j = floor($datediff / (60 * 60 * 24));
											echo "$j jours";
											?>
										</td>
										<td>
											<?php
											$now = time();
											$your_date = strtotime($action['date_fin']);
											$datediff = $your_date - $now;
											$j = floor($datediff / (60 * 60 * 24));
											if ($action['date_debut'] > date('Y-m-d'))
												echo '----';
											else if ($j >= 0)
												echo "$j jours";
											else
												echo '----';
											?>
										</td>
										<td><?php
											if ($action['date_debut'] > date('Y-m-d'))
												echo '<span class="badge bg-yellow">Prochainement</span>';
											else if ($j >= 0)
												echo '<span class="badge bg-green">En cours</span>';
											else
												echo '<span class="badge bg-red">Terminé</span>';
											?></td>
										<td class="actions">
											<?php if ($this->requestAction('/droits/getrole/actions/edit') == 1 || $this->requestAction('/droits/getrole/actions/valider') == 1): ?>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle"
														data-toggle="dropdown">
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li> <?php
																if ($this->requestAction('/droits/getrole/actions/edit') == 1) {
																	if ($action['date_debut'] > date('Y-m-d'))
																		echo $this->Html->link('Editer', array('controller' => 'actions', 'action' => 'edit', $action['id']));
																	else if ($j >= 0)
																		echo $this->Html->link('Editer', array('controller' => 'actions', 'action' => 'edit', $action['id']));
																}
																?></li>
														<li> <?php
																if ($this->requestAction('/droits/getrole/actions/valider') == 1)
																	echo $this->Html->link('archiver', array('controller' => 'actions', 'action' => 'valider', $action['id'], -1));
																?></li>
													</ul>
												</div>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php
			endif;

			if ($this->requestAction('/droits/getrole/listes/remplire') == 1):
			?>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">La liste des affectations</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>VMP</th>
									<th>Liste</th>
									<th>Date</th>
									<th>Désaffectation</th>
								</tr>
								<?php
								foreach ($client['Affectation'] as $action):
									$liste = $this->requestAction('/listes/system_get_liste/' . $action['liste_id']);
									if (empty($liste)) {
										$liste['User']['name'] = $liste['Liste']['name'] = $liste['User']['id'] = '--';
									}
								?>
									<tr>
										<td><?php echo $this->Html->link($liste['User']['name'], array('controller' => 'users', 'action' => 'view', $liste['User']['id'])); ?>
										</td>
										<td><?php echo $this->Html->link($liste['Liste']['name'], array('controller' => 'listes', 'action' => 'view', $action['liste_id'])); ?>
										</td>
										<td><?php echo $action['created']; ?></td>
										<td><?php
											if ($action['valide'] == 1)
												echo $this->Html->link("Désaffecter", array('action' => 'desafecter', $client['Client']['id'], $action['id']));
											else
												echo $action['modified'];
											?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php
				endif;

				if ($this->requestAction('/droits/getrole/listes/remplire') == 1):


					//if (!empty($client['Affectation'])):
					$users = $this->requestAction('/users/system_get_all_user_vmp_superviseur_coordinateur');
					echo $this->Form->create('Clients', array("url" => array('action' => 'desafecter')));
					echo $this->Form->hidden('client_id', array("value" => $client['Client']['id']));
					?>
						<div class="input select col-md-5">
							<label for="ListeUserId">VMP</label>
							<select class="form-control" id="regions">
								<option value="0">Choisissez un VMP</option>
								<?php foreach ($users as $userid => $username) { ?>
									<option value="<?php echo $userid; ?>"><?php echo $username; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="input select col-md-5" id="ville"></div>
						<?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large submit', 'div' => array('class' => 'col-sm-2', 'style' => "margin-top:24px;"))); ?>
						<?php //endif;    
						?>

					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-md-3 pl-0">
		<!-- small box -->
		<div class="small-box">
			<div class="inner">
				<h4><?php
					if (!empty($client['Visite']))
						echo strftime("%A %d-%m-%Y", strtotime($client['Visite'][0]['date']));
					else
						echo '---';
					?></h4>
				<p><br>Date Dernière Visite</p>
			</div>
			<div class="icon">
				<i class="ion ion-calendar"></i>
			</div>
		</div>
		<?php if (AuthComponent::user('role') == 'Admin'): ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Les dernières adoptions du produit</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body detail_viste">
					<ul class="products-list product-list-in-box">

					</ul>
				</div>
				<!-- /.box-body -->
				<div class="box-footer text-center">
					<a href="#tab_1" class="uppercase">Voir plus</a>
				</div>
				<!-- /.box-footer -->
			</div>
		<?php endif; ?>
	</div>


	<!-- ./col -->
</div>




<div class="row">

	<?php if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
		<div class="col-md-3">
			<div class="all-cards">
				<?php
				foreach ($gadgetclientall as $gadget): ?>
					<div class="card">
						<div class="card-header">
							<span class="card-date"><?php echo $gadget['Gadgetclient']['created']; ?></span>
							<span class="card-user-name"><?php echo $gadget['User']['name']; ?></span>
						</div>
						<div class="card-body">
							<span></span>
							<h3 class="card-title"><?php echo $gadget['Gadgetclient']['name']; ?></h3>
							<div class="qte-gadget"><?php echo $gadget['Gadgetclient']['quantite']; ?></div>
							<?php
							if ($this->requestAction('/droits/getrole/gadgetclients/supprimer') == 1): ?>
								<div>
									<?php echo $this->Html->link("SUP", array("controller" => "gadgetclients", "action" => "supprimer", $gadget['Gadgetclient']['id'])); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	<?php endif; ?>



	<div class="col-md-12">
		<div class="col-md-12" style="padding: 0px;">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Les visites</a></li>
					<?php if (AuthComponent::user('role') == 'Admin'): ?>
						<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Les appels</a></li>
						<li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Stock temps réel</a></li>
					<?php endif; ?>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<div class="row">
							<div class="col-xs-12">
								<ul class="timeline">
									<?php
									$array_adopt_unique = [];
									$i = 0;
									$ii = 0;
									//debug($client['Visite']);
									$mapinf = array();
									foreach ($client['Visite'] as $visite):
										//if($visite['date']<=$client['Client']['date_recrutement'])
										//    continue;


										$user_id = 0;
										$visite['date'] = explode(' ', $visite['date']);
										if ($user_id != $visite['user_id'])
											$user = $this->requestAction('/users/system_get_name_user/' . $visite['user_id']);
										if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
											$super = $this->requestAction('/users/system_get_if_super/' . $visite['user_id']);
											if ($super == 0)
												$i++;
											else
												continue;
										}

										//echo is_string($visite['longitude']);
										$pos = strpos($visite['longitude'], "n");
										$poss = strpos($visite['longitude'], "0.0");
										if (!empty($visite['longitude']) && $pos === false && $poss === false) {
											$mapinf['visite'][] = "'" . $user . "'," . str_replace(",", ".", $visite['latitude']) . "," . str_replace(",", ".", $visite['longitude']) . ",'" . $visite['date'][0] . "'";
										}
									?>

										<li class="time-label">
											<span
												class="bg-red"><?php echo strftime("%A %d-%m-%Y", strtotime($visite['date'][0])); ?>
											</span>
											<span class="bg-green"><?php echo $visite["timer"]; ?> </span>

										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>
											<div class="timeline-item">
												<span class="time"><i class="fa fa-clock-o"></i>
													<?php
													if ($visite['date'][1] == "00:00:00") {
														$visite['date'][1] = explode(" ", $visite['created']);
														$visite['date'][1] = $visite['date'][1][1];
													}
													echo $visite['date'][1]; ?></span>
												<span class="bg-light-blue"
													style="float:right;padding: 2px 6px;border-radius:5px;font-size: 15px;margin-right: 3px;line-height: 27px;text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.95);font-weight: bold;box-shadow: inset 1px 1px 3px rgba(101, 101, 101, 0.65);color:#fff;margin-top: 3px;"><i
														class="material-icons"><?php
																				if ($visite['type_visite'] == 'solo')
																					echo 'person';
																				if ($visite['type_visite'] == 'double')
																					echo 'people';
																				?></i>
													<?php echo $visite['type_visite']; ?></span>
												<h3 class="timeline-header"><?php echo $user; ?></h3>
												<div class="timeline-body">
													<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
														<b style="width: 222px;float: left;margin-right:5px;">Commentaire <b
																style="float:right;">:</b> </b>
														<?php echo iconv('ASCII', 'UTF-8//IGNORE', $visite['commentaire']); ?>
													</div>


													<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
														<b style="width: 222px;float: left;margin-right:5px;">
															<?php
															if ($client['Type']['name'] == 'Pharmacie') {
																echo 'Veille';
															} else {
																echo 'Objections';
															}
															?>

															<b style="float:right;">:</b></b>
														<?php
														if ($client['Type']['name'] == 'Pharmacie') {
															if (!empty($visite['objection'])) {
																$obV = explode(",", $visite['objection']);
																foreach ($obV as $o) {
																	$products = explode('|', $o);
														?>
																	<div class="<?php echo $visite['id']; ?>"
																		style="float:left;padding: 0px;margin-bottom: 4px;">
																		<span class="label bg-aqua"
																			style="width: auto;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b
																				style="margin-right: 0px;"><?php
																											$pr = "";
																											$pr = $this->requestAction('/games/system_get_name_game/' . $products[0]);
																											echo $pr;
																											?>
																			</b> <i class="fa fa-plus pup<?php echo $ii; ?>"
																				style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;"
																				title="<?php echo $pr; ?>"
																				onclick="pup1(<?php echo $ii . "," . $visite['id'] . "," . $products[0]; ?>)"></i></span>
																		<div class="col-md-2 objet objet<?php echo $ii . " " . $products[0]; ?>"
																			style="display:none;">
																			<span class="optionh optionh<?php echo $ii; ?>"
																				onclick="objettog(<?php echo $ii; ?>)"><i
																					class="fa fa-plus"></i></span>
																			<ul class="optionb optionb<?php echo $ii; ?>">
																				<li><?php echo $pr; ?></li>
																				<?php for ($j = 1; $j < count($products); $j++) { ?>
																					<li><?php echo $products[$j]; ?></li>
																				<?php } ?>
																			</ul>
																		</div>
																		<?php
																		?>
																	</div>
																<?php
																	$ii++;
																}
															}
														} else {
															if (strpos($visite['objection'], '#') === 0) {
																$visiteobjection = ltrim($visite['objection'], '#');
																$obV = explode('\|\|', $visiteobjection);
																// debug($visite['objection']);
																foreach ($obV as $o) {
																	$products = explode(';', $o);
																?>
																	<div class="<?php echo $visite['id']; ?>"
																		style="float:left;padding: 0px;margin-bottom: 4px;">
																		<span class="label bg-aqua"
																			style="width: auto;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b
																				style="margin-right: 0px;"><?php
																											//debug($product);
																											$pr = "";
																											foreach ($products as $key => $p) {
																												if ($key == $products[0]) {
																													echo $p;
																													$pr = $p;
																												}
																											}
																											//echo $products[0];
																											?>
																			</b> <i class="fa fa-plus pup<?php echo $ii; ?>"
																				style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;"
																				title="<?php echo $pr; ?>"
																				onclick="pup(<?php echo $ii . "," . $visite['id'] . "," . $products[0]; ?>)"></i></span>
																		<?php
																		$objections = explode(',', $products[1]);
																		array_pop($objections);
																		foreach ($objections as $obj) {
																			$objec = explode('\|', $obj);
																		?>
																			<div class="col-md-2 objet objet<?php echo $ii . " " . $products[0]; ?>"
																				style="display:none;">
																				<span class="optionh optionh<?php echo $ii; ?>"
																					onclick="objettog(<?php echo $ii; ?>)"><?php echo $objec[0]; ?>
																					<i class="fa fa-plus"></i></span>
																				<ul class="optionb optionb<?php echo $ii; ?>">
																					<?php for ($j = 1; $j < count($objec); $j++) { ?>
																						<li><?php echo $objec[$j]; ?></li>
																					<?php } ?>
																				</ul>
																			</div>
																		<?php
																			$ii++;
																		}
																		?>
																	</div>
																<?php
																}
															} else if (strpos($visite['objection'], '*') === 0) {
																$objection = ltrim($visite['objection'], '*');
																$objections = explode(',', $objection);
																array_pop($objections);
																//debug($objections);
																foreach ($objections as $obj) {

																	$objec = explode('\|', $obj);
																?>
																	<div class="col-xs-12"
																		style="float:left;padding: 0px;margin-bottom: 4px;width:auto;min-width:100px;">
																		<div class="col-md-12 objet objet<?php echo $ii; ?>">
																			<span class="optionh optionh<?php echo $ii; ?>"
																				onclick="objettog(<?php echo $ii; ?>)"><?php echo $objec[0]; ?>
																				<i class="fa fa-plus"></i></span>
																			<ul class="optionb optionb<?php echo $ii; ?>">
																				<?php for ($j = 1; $j < count($objec); $j++) { ?>
																					<li><?php echo $objec[$j]; ?></li>

																				<?php } ?>
																			</ul>
																		</div>
																		<?php $ii++; ?>
																	</div><?php
																		}
																	} else {
																		echo $visite['objection'];
																	}
																}
																			?>
													</div>
													<?php if ($client['Type']['name'] == 'Pharmacie') { ?>
														<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 222px;float: left;margin-right:5px;">
																Concurrence
																<b style="float:right;">:</b></b>
															<?php
															if ($client['Type']['name'] == 'Pharmacie') {
																if (!empty($visite['concurrence_p'])) {
																	$obV = explode(",", $visite['concurrence_p']);
																	foreach ($obV as $o) {
																		$products = explode('|', $o);
															?>
																		<div class="<?php echo $visite['id']; ?>"
																			style="float:left;padding: 0px;margin-bottom: 4px;">
																			<span class="label bg-aqua"
																				style="width: auto;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b
																					style="margin-right: 0px;"><?php
																												$pr = "";
																												$pr = $this->requestAction('/games/system_get_name_game/' . $products[0]);
																												echo $pr;
																												//echo $products[0];
																												?>
																				</b> <i class="fa fa-plus pup<?php echo $ii; ?>"
																					style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;"
																					title="<?php echo $pr; ?>"
																					onclick="pup2(<?php echo $ii . "," . $visite['id'] . "," . $products[0] . '1'; ?>)"></i></span>
																			<div class="col-md-2 objet objet<?php echo $ii . " " . $products[0] . '1'; ?>"
																				style="display:none;">
																				<span class="optionh optionh<?php echo $ii; ?>"
																					onclick="objettog(<?php echo $ii; ?>)"><i
																						class="fa fa-plus"></i></span>
																				<ul class="optionb optionb<?php echo $ii; ?>">
																					<li><?php echo $pr; ?></li>
																					<?php for ($j = 1; $j < count($products); $j++) { ?>
																						<li><?php echo $products[$j]; ?></li>
																					<?php } ?>
																				</ul>
																			</div>

																		</div>
															<?php
																		$ii++;
																	}
																}
															}
															?>
														</div><?php } ?>
													<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
														<b style="width: 222px;float: left;margin-right:5px;">Potentialité
															cabinet <b style="float:right;">:</b> </b>
														<?php
														if ($visite['veille'] == "100")
															$pott = '1';
														elseif ($visite['veille'] == "50")
															$pott = '2';
														else
															$pott = '3';
														if ($visite['partenaires'] == 'bien')
															$pttt = "A";
														elseif ($visite['partenaires'] == 'moyen')
															$pttt = "B";
														else
															$pttt = "C";
														echo "<b>$pttt$pott</b>";
														?>
													</div>
													<?php
													// if ($client['Type']['name'] != 'Pharmacie') { 
													?>
													<!-- <div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
												<b style="width: 222px;float: left;margin-right:5px;">échantillons donnés <b style="float:right;">:</b> </b>
												<?php
												// $ech = explode("||", $visite['echantillons']);
												// $ec = explode("-", $visite['echantillons']);
												// if (count($ec) > 1) {
												// for ($ch = 0; $ch < count($ech); $ch++) {
												// $ec = explode("-", $ech[$ch]);
												// if ($ec[0] != '' && $ec[0] != null) {
												// $nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
												// echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;vertical-align: middle;float:left;'>$nomch</b><span class='label-warning' style='width: auto;padding: 7px 5px;margin-left: 5px;'>$ec[1]</span></span>";
												// }
												// }
												// }
												?>
											</div>
										<?php
										// } 
										?> -->
													<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
														<!-- <b style="width: 222px;float: left;margin-right:5px;">
												<?php
												// if ($client['Type']['name'] == 'Pharmacie') {
												//     echo 'liste des produits partenaire<br>de PRESCRIPTION ';
												// } else {
												//     echo 'La liste des produits partenaires';
												// }
												?>
												<b style="float:right;line-height: 0px;">:</b> </b> -->
														<?php
														//$ech=  explode("||", $visite['produits']);
														// if (!empty($visite['produits'])) {
														//     $ec = explode("\|", $visite['produits']);
														// 	$produitnames = "";
														// 	if (strpos($ec[0], '*') === 0) {

														// 		$pps = explode(",", str_replace("*", "", $ec[0]));
														// 		foreach ($pps as $e) {
														// 			if (isset($gammes[$e]))
														// 				$produitnames = $produitnames . "," . $gammes[$e];
														// 			else if (isset($produits[$e]))
														// 				$produitnames = $produitnames . "," . $produits[$e];
														// 		}

														// 	}
														// 	$produitnames=trim($produitnames,",");
														//     echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-top: 10px;float: left;'><b style='margin-right: 8px;'>$produitnames</b><span class='label-warning' style='width: auto;padding: 7px 5px;margin-left: 6px;'>$ec[1]</span></span>";
														// }
														?>
													</div>
													<!-- <div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
											<b style="width: 222px;float: left;margin-right:5px;">Nombre de prescription estimé/semaine <b style="float:right;">:</b> </b> <?php echo $visite['produit_nbr_boite_adoption']; ?>
										</div> -->


													<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
														<b style="width: 222px;float: left;margin-right:5px;">
															<?php
															if ($client['Type']['name'] == 'Pharmacie') {
																echo 'liste des produits partenaire<br>de CONSEIL ';
															} else {
																echo 'Produits demandés non présentés';
															}
															?>

															<b style="float:right;line-height: 0px;">:</b> </b>
														<!-- -->
														<?php
														//$ech=  explode("||", $visite['produits']);
														if ($client['Type']['name'] == 'Pharmacie') {
															if (!empty($visite['produitsNP'])) {
																$ec = explode("|", $visite['produitsNP']);
																$produitnames = "";
																if (strpos($ec[0], '*') === 0) {

																	$pps = explode(",", str_replace("*", "", $ec[0]));
																	foreach ($pps as $e) {
																		if (isset($gammes[$e]))
																			$produitnames = $produitnames . "," . $gammes[$e];
																		else if (isset($produits[$e]))
																			$produitnames = $produitnames . "," . $produits[$e];
																	}
																}
																$produitnames = trim($produitnames, ",");
																echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 7px;margin-top: 10px;float: left;'><b style='margin-right: 8px;'>$produitnames</b><span class='label-warning' style='width: auto;padding: 7px 5px;margin-left: 6px;'>$ec[1]</span></span>";
															}
														} else {
															if (!empty($visite['produitsNP'])) {
																$ec = explode("|", $visite['produitsNP']);
																$i = 0;
																foreach ($ec as $e) {
																	$nomch = $this->requestAction('/games/system_get_name_game/' . $ec[$i]);
																	echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;float:left;'><b style='margin-right: 8px;'>$nomch</b></span>";
																	$i++;
																}
															}
														}
														?>
													</div>
													<?php $visitesorders = $this->requestAction('/visiteordres/system_get_visiteordre/' . $visite['id']);
													// debug($visitesorders);
													if (!empty($visitesorders)): ?>
														<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 222px;float: left;margin-right:5px;">Order de
																présentation <b style="float:right;line-height: 0px;">:</b></b>
															<div class="row">
																<?php foreach ($visitesorders as $key => $value): ?>
																	<div class="col-md-2 nopad text-center">
																		<label class="image-checkbox">
																			<?php
																			$logobrochure = "https://dummyimage.com/300x300/000/fff";
																			if ($value["Brochure"]["logo"] != "" && $value["Brochure"]["logo"] != null)
																				$logobrochure = "/img/brochures/" . $value["Brochure"]["logo"]; ?>
																			<img class="img-responsive" style="height:130px"
																				src="<?php echo $this->Html->url($logobrochure); ?>" />
																		</label>
																	</div>
																<?php endforeach; ?>
															</div>
														</div>
													<?php endif; ?>
													<!-- -->
													<!-- <?php if ($client['Type']['name'] == 'Pharmacie') { ?>
														<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 222px;float: left;margin-right:5px;">Noms des
																principaux<br>prescripteurs
																<b style="float:right;line-height: 0px;">:</b> </b>

															<?php
																if (!empty($visite['prescripteurs'])) {
																	$ec = explode("\|", $visite['prescripteurs']);
																	$i = 0;
																	foreach ($ec as $e) {
																		$nomch = $this->requestAction('/clients/system_get_name_client/' . $ec[$i]);
																		echo "<span class='label label-success' style='width: auto;padding: 5px 9px;margin-right: 3px;vertical-align: middle;float:left;margin-top: 10px;float: left;'><b style='margin-right: 8px;'>$nomch</b></span>";
																		$i++;
																	}
																}
															?>
														</div>
													<?php } ?> -->
													<!-- -->
												</div>
												<div class="timeline-footer">
													<?php if ($this->requestAction('/droits/getrole/visites/edit') == 1): ?>
														<a class="btn btn-primary btn-xs"
															href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'edit', $visite['id'])); ?>"
															title="Editer"><!-- Editer --><i class="fa fa-edit"></i></a>
													<?php
													endif;
													if ($this->requestAction('/droits/getrole/visites/archive') == 1):
													?>
														<a class="btn btn-danger btn-xs"
															href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'archive', $visite['id'], 0)); ?>"
															title="Archive"><!-- Archive --><i class="fa fa-archive"></i></a>
													<?php endif; ?>
													<b>&nbsp;</b>
													<?php
													if (!empty($visite['latitude']) && AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") {
														$pos = strpos($visite['longitude'], "n");
														$poss = strpos($visite['longitude'], "0.0");
														if (!empty($visite['longitude']) && $pos === false && $poss === false) {
															echo '<a data-toggle="modal" onclick="clikgeo(' . $ii . ')" data-target="#myModalmap" class="btn btn-info btn-xs map' . $ii . '"  style="float:right; background:#e2141e; font-size: 14px;padding: 1px 8px;"  title="Etat du visite"><input type="hidden" class="latc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['longitude']) . '"><input type="hidden" class="lengc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['latitude']) . '"><input type="hidden" class="latv' . $ii . '" value="' . str_replace(",", ".", $visite['latitude']) . '"><input type="hidden" class="lengv' . $ii . '" value="' . str_replace(",", ".", $visite['longitude']) . '"><i class="fa fa-map-marker"></i></a>';
														}
													}
													?>
												</div>
											</div>
										</li>
									<?php
										$ii = $ii + 1;
									endforeach;
									//var_dump($mapinf);
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_2">
						<div class="row">
							<div class="col-xs-12">
								<?php $appels = $this->requestAction("/rapportprocpects/system_get_appel_for_client/" . $client['Client']['id']);
								foreach ($appels as $appel):
									$appeldate = explode(" ", $appel["Rapportprocpect"]["created"])
								?>
									<ul class="timeline">
										<li class="time-label">
											<span class="bg-red">
												<?php echo strftime("%A %d-%m-%Y", strtotime($appeldate[0])); ?> </span>
											</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>
											<div class="timeline-item">
												<span class="badge badge-pill badge-info" style="float:right;"><i
														class="fa fa-clock-o"></i> <?php echo $appeldate[1]; ?></span>

												<h3 class="timeline-header">
													<?php echo $appel["User"]["name"] . " (" . $appel["Rapportprocpect"]["type_user"] . ")"; ?>
												</h3>
												<span class="label label-primary"
													style="font-size: 14px;    margin-left: 12px;">
													<?php echo $this->Html->image('clock-white', array('style' => 'width:19px;margin-top: -2px;')) ?>
													<?php echo $appel["Rapportprocpect"]["duree"]; ?></span>
												<div class="timeline-body">
													<div class="row">
														<div class="col-md-6">
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	CAMPAGNE
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["prospectcompagne"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Connaissance produit ?
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["connaissance"]; ?>
															</div>
															<?php if ($appel["Rapportprocpect"]["connaissance"] == "Oui"): ?>
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Disponibilité produit ?
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["disponibilite"]; ?>
																</div>

																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Avez vous réalisé des ventes?
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["vente"]; ?>
																</div>
																<?php if ($appel["Rapportprocpect"]["vente"] == "Oui"): ?>
																	<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																		<b style="width: 248px;float: left;margin-right:5px;">
																			Si oui , comment ?
																			<b
																				style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["comment"]; ?>
																	</div>
																<?php endif; ?>
															<?php endif; ?>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Voulez vous qu'un commercial?
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commercial"]; ?>
															</div>
															<?php if ($appel["Rapportprocpect"]["commercial"] == "Non"): ?>

																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Mise en place produit de la campagne
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commande"]; ?>
																</div>
															<?php endif; ?>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Pack hors campagne
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["hors_campagne"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Degré de satisfaction Call Center
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["appreciation"]; ?>
																%
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Questions
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["question"]; ?>
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Objections
																	<b style="float:right;">:</b></b>
																<?php echo '<span class="label label-primary" style="float: left;margin: 3px;">' . str_replace("|", '</span><span class="label label-primary" style="float: left;margin: 3px;">', $appel["Rapportprocpect"]["objection"]) . "</span>"; ?>
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Réclamations
																	<b style="float:right;">:</b></b>
																<?php echo '<span class="label label-primary" style="float: left;margin: 3px;">' . str_replace("|", '</span><span class="label label-primary" style="float: left;margin: 3px;">', $appel["Rapportprocpect"]["reclamation"]) . "</span>"; ?>
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Qualifications
																	<b style="float:right;">:</b></b>
																<?php echo '<span class="label label-primary" style="float: left;margin: 3px;">' . str_replace("|", '</span><span class="label label-primary" style="float: left;margin: 3px;">', $appel["Rapportprocpect"]["qualification"]) . "</span>"; ?>
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Propositions
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["proposition"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Type Achat Direct Nombre de CMD
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["type_achat_direct"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Type Achat Grossiste Nombre de CMD
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["type_achat_grossiste"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Fréquence Passage Commercial
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["frequence_passage_commercial"]; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Commande Groupée
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commande_groupee"]; ?>
															</div>

															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Objections client
																	<b style="float:right;">:</b></b>
																<?php echo '<span class="label label-primary" style="float: left;margin: 3px;">' . str_replace("|", '</span><span class="label label-primary" style="float: left;margin: 3px;">', $appel["Rapportprocpect"]["objection_two"]) . "</span>"; ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Statut Client
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["statut_client"]; ?>
															</div>


														</div>




														<?php if ($appel["Prospectfeuille"]["commercial_type"] != null): ?>
															<div class="col-md-6" style="border-left: 1px solid #e6e6e6;">
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Type d'action
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_type"]; ?>
																</div>
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Commercial
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_user_wavesoft"]; ?>
																</div>
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Opportunité concrétisée
																		<b style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_opportunite"];
																											if ($appel["Prospectfeuille"]["commercial_produits"] != null)
																												echo " (" . $appel["Prospectfeuille"]["commercial_produits"] . ")";
																											else
																												echo " (" . $appel["Prospectfeuille"]["commercial_raison"] . ")";
																											?>
																</div>
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Date de
																		<?php echo $appel["Prospectfeuille"]["commercial_type"]; ?>
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_date"]; ?>
																</div>
																<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Commentaire
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_commentaire"]; ?>
																</div>
															</div>
														<?php endif; ?>



													</div>
												</div>
												<div class="timeline-footer">
													<?php
													if ($this->requestAction('/droits/getrole/rapportprocpects/supprimer') == 1):
													?>
														<a class="btn btn-danger btn-xs"
															href="<?php echo $this->Html->url(array('controller' => 'rapportprocpects', 'action' => 'supprimer', $appel["Rapportprocpect"]['id'])); ?>"
															title="Supprimer"><i class="fa fa-archive"></i></a>
													<?php endif; ?>
													<b>&nbsp;</b>

												</div>

											</div>
										</li>
									</ul>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_3">
						<div class="row">
							<div class="col-xs-12">
								<?php
								foreach ($stockreel as $stock):
									$appeldate = explode(" ", $stock["Stockvisite"]["created"]);
								?>
									<ul class="timeline">
										<li class="time-label">
											<span class="bg-red">
												<?php echo strftime("%A %d-%m-%Y", strtotime($appeldate[0])); ?> </span>
											</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>
											<div class="timeline-item">
												<span class="badge badge-pill badge-info" style="float:right;"><i
														class="fa fa-clock-o"></i><?php echo date("H:i:s", strtotime($appeldate[1])); ?></span>

												<h3 class="timeline-header"><?php echo $stock["User"]["name"] ?></h3>
												<div class="timeline-body">
													<div class="row">
														<div class="col-md-12">
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Produit
																	<b style="float:right;">:</b>
																</b><span class="label label-success"
																	style="font-size: 13px;"><?php echo $stock["Produit"]["name"] ?></span>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Quantite
																	<b
																		style="float:right;">:</b></b><?php echo $stock["Stockvisite"]["quantite"] ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Type
																	<b style="float:right;">:</b>
																</b><?php echo $stock["Stockvisite"]["type"] ?>
															</div>
															<div class="col-xs-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Commentaire
																	<b style="float:right;">:</b>
																</b><?php echo $stock["Stockvisite"]["commentaire"] ?>
															</div>
														</div>
													</div>
												</div>
												<div class="timeline-footer">
													<b>&nbsp;</b>
												</div>
											</div>
										</li>
									</ul>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<?php
	// debug($array_adopt_unique);
	if (!empty($client['Commande'])): ?>
		<div class="col-md-9">
			<div class="box">
				<div class="box-header with-border">
					<h3><?php echo __('Commandes'); ?></h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered">
						<tr>
							<th><?php echo __('VMP'); ?></th>
							<th><?php echo __('Quantité des produits'); ?></th>
							<th><?php echo __('Total en Dhs'); ?></th>
							<th><?php echo __('Date de création'); ?></th>
							<th class="actions"></th>
						</tr>
						<?php
						$i = 0;
						foreach ($client['Commande'] as $commande):
						?>
							<tr>
								<td><?php
									$user = $this->requestAction('/users/system_get_name_user/' . $commande['user_id']);
									echo $user;
									?></td>
								<td><?php
									$info = $this->requestAction('/commandes/system_get_total_and_quantite/' . $commande['id']);
									$info = explode('||', $info);
									echo $info[1];
									?></td>
								<td><?php echo $info[0]; ?> Dhs</td>
								<td><?php echo $commande['created']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('Visualiser'), array('controller' => 'commandes', 'action' => 'view', $commande['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") { ?>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<div class="box-header with-border">
						<h3 class="box-title">La liste des visites sur map</h3><br><br>
					</div>
					<div id="maap-canvas" class="col-md-12" style="min-height: 400px;"></div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="popup_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="popup_vendorLabel">Les vendeurs</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php

					if ($client['Client']["vendeur"] != '' && is_array($vendeurs)) { ?>
						<table class="table">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Tel</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($vendeurs as $vendeur): ?>
									<tr>
										<td><?php echo $vendeur['nom']; ?></td>
										<td><?php echo $vendeur['tel']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php }
					?>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<div id="gadget_modal" class="modal">
	<?php echo $this->Form->create('Gadgetclient', array("url" => array("controller" => "gadgetclients", "action" => "add")));
	echo $this->Form->hidden('client_id', array('value' => $client["Client"]["id"]));
	echo $this->Form->input('gadgetclient_id', array("name" => "data[Gadgetclient][name]", 'class' => 'form-control')); ?>
	<?php
	echo $this->Form->input('quantite', array('class' => 'form-control', 'required' => 'required')); ?>
	<div class="modal-footer">
		<input type="submit" value="Envoyer" class="btn btn-success">
	</div>

</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#GadgetclientGadgetclientId').select2({
			tags: true
		});
	});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q&amp;"></script>
<script>
	function boxtog(id) {
		$('.box' + id).toggle(300);
		var clas = $("#icon" + id).attr("class");
		if (clas == 'fa fa-minus') {
			$("#icon" + id).attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$("#icon" + id).attr("class", "fa fa-minus");
		}
	}

	$(document).ready(function() {


		$('.export-client-btn').on('click', function(e) {
		// $('').on('click', function(e) {
			// Get client ID from button's data attribute
			var clientId = $(this).data('client-id');

			// Show the modal
			$('#modal_return').modal('show');

			// Show loading message
			$('#export-message').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></p><p class="text-center">Export en cours...</p>');

			// Perform AJAX request
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'system_export_client')); ?>/' + clientId,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					// Check if response has status
					if (response.status === 'success') {
						$('#export-message').html('<div class="alert alert-success"><i class="fa fa-check"></i> ' + response.message + '</div>');
					} else {
						// Assume success if no status is given
						$('#export-message').html('<div class="alert alert-success"><i class="fa fa-check"></i> Client exported successfully</div>');
					}

					// Close modal after delay
					setTimeout(function() {
						$('#modal_return').modal('hide');
					}, 3000); // 3 seconds
				},
				error: function(xhr, status, error) {
					var errorMessage;

					try {
						var response = JSON.parse(xhr.responseText);
						errorMessage = response.message || response.error || 'An error occurred during export';
					} catch (e) {
						errorMessage = 'An error occurred during export';
					}

					$('#export-message').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + errorMessage + '</div>');

					// Don't auto-close on error so user can read the message
				}
			});
		});

		$("#regions").change(function() {
			var id = $("#regions").val();
			var image = "<center><img src='/img/loading.gif' style='width: 30px;' ></center>";
			$("#ville").empty();
			$(image).appendTo("#ville");
			$("#ville").show();
			$.post(
				'/listes/system_get_liste_for_user_client_view/' + id, {
					//id: $("#ChembreBlocId").val()
				},
				function(data) {
					$("#ville").empty();
					$(data).appendTo("#ville");
					$("#ville").show();
				},
				'text' // type
			);
		});
	});
</script>
<script type="text/javascript">
	function objettog(id) {
		$('.optionb' + id).toggle();
		var clas = $(".optionh" + id + " .fa").attr("class");
		if (clas == 'fa fa-minus') {
			$(".optionh" + id + " .fa").attr("class", "fa fa-plus");
		}
		if (clas == 'fa fa-plus') {
			$(".optionh" + id + " .fa").attr("class", "fa fa-minus");
		}
	}

	function pup(i, id, prod) {
		var product = $("." + id + " .pup" + i).attr('title');
		$(".modal-title").text("Objections pour : " + product);
		var objet = $("." + id + " ." + prod).length;
		//console.log(objet);
		var table = $('#myModal .table');
		table.html('');
		for (var io = 0; io < objet; io++) {
			var option = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li").length;
			//console.log(option);
			var tr = '<tr><th>' + $("." + id + " ." + prod + ":eq(" + io + ") .optionh").text() + '</th></tr>';
			table.append(tr);
			for (var op = 0; op < option; op++) {
				//console.log($("."+id+" ."+prod+":eq("+io+") .optionh").text()+' : '+$("."+id+" ."+prod+":eq("+io+") .optionb li:eq("+op+")").text());
				var tdc = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li:eq(" + op + ")").text();
				td = '<td>&nbsp;' + tdc + '</td>';
				$("#myModal .table tbody tr:eq(" + io + ")").append(td);
			}
		}
		$("#myModal").modal();
	}

	function pup1(i, id, prod) {
		var product = $("." + id + " .pup" + i).attr('title');
		$(".modal-title").text("Veille pour : " + product);
		var objet = $("." + id + " ." + prod).length;
		//console.log(objet);
		var table = $('#myModal1 .table');
		$('#myModal1 .table tbody').html('');
		for (var io = 0; io < objet; io++) {
			var option = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li").length;
			//console.log(option);
			var tr = '<tr></tr>';
			table.append(tr);
			for (var op = 0; op < option; op++) {
				//console.log($("."+id+" ."+prod+":eq("+io+") .optionh").text()+' : '+$("."+id+" ."+prod+":eq("+io+") .optionb li:eq("+op+")").text());
				var tdc = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li:eq(" + op + ")").text();
				td = '<td>&nbsp;' + tdc + '</td>';
				$("#myModal1 .table tbody tr:eq(" + io + ")").append(td);
			}
		}
		$("#myModal1").modal();
	}

	function pup2(i, id, prod) {
		var product = $("." + id + " .pup" + i).attr('title');
		$(".modal-title").text("Concurrence pour : " + product);
		var objet = $("." + id + " ." + prod).length;
		//console.log(objet);
		var table = $('#myModal2 .table');
		$('#myModal2 .table tbody').html('');
		for (var io = 0; io < objet; io++) {
			var option = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li").length;
			//console.log(option);
			var tr = '<tr></tr>';
			table.append(tr);
			for (var op = 0; op < option; op++) {
				//console.log($("."+id+" ."+prod+":eq("+io+") .optionh").text()+' : '+$("."+id+" ."+prod+":eq("+io+") .optionb li:eq("+op+")").text());
				var tdc = $("." + id + " ." + prod + ":eq(" + io + ") .optionb li:eq(" + op + ")").text();
				td = '<td>&nbsp;' + tdc + '</td>';
				$("#myModal2 .table tbody tr:eq(" + io + ")").append(td);
			}
		}
		$("#myModal2").modal();
	}
	var locations1 = [<?php
						if (!empty($mapinf['visite'])) {
							foreach ($mapinf['visite'] as $value) {
								echo '[' . $value . '],';
							}
						}
						?>];
	var locations = [];
	var clientlat = clientleng = "";

	function clikgeo(id) {
		clientlat = $(".latv" + id).attr("value");
		clientleng = $(".lengv" + id).attr("value");
		locations = [
			[parseFloat(clientlat)],
			[parseFloat(clientleng)]
		];
		setTimeout(function() {
			initialize1()
		}, 500);
	}

	// console.log(locations[0] + ',' + locations[1]);
	// var mapDiv = document.getElementById('map-canvas');
	// var map = new google.maps.Map(mapDiv, {
	// 	center: new google.maps.LatLng(locations[0] , locations[1]),
	// 	zoom: 12,
	// 	mapTypeId: google.maps.MapTypeId.ROADMAP
	// });

	// var infowindow = new google.maps.InfoWindow();
	// var marker, i;
	// 	marker = new google.maps.Marker({
	// 		position: new google.maps.LatLng(locations[0] , locations[1]),
	// 		map: map//,
	// 				//icon: new google.maps.MarkerImage(v, new google.maps.Size(30, 35))
	// 	})


	var map;
	var markers = [];

	function initialize1() {
		var haightAshbury1 = new google.maps.LatLng(<?php
													if (!empty($client['Client']['latitude'])) {
														echo $client['Client']['latitude'] . "," . $client['Client']['longitude'];
													} else {
														echo '35.621592,-5.274718';
													}
													?>);
		var v = '/app/webroot/img/marker-b.png';
		var l_length = locations1.length;
		var mapOptions = {
			zoom: 6,
			center: new google.maps.LatLng(locations[0], locations[1]),

			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		// This event listener will call addMarker() when the map is clicked.
		var infowindow = new google.maps.InfoWindow();
		var marker, i;
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[0], locations[1]),
			map: map,

		})
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				infowindow.setContent('<b style="font-size:13px;">' + locations1[i][0] + '</b><br> <b>Date:</b> ' + locations1[i][3]);
				infowindow.open(map, marker);
			}
		})(marker, i));
		// Adds a marker at the center of the map.
		var mypos = new google.maps.LatLng(<?php
											if (!empty($client['Client']['latitude'])) {
												echo $client['Client']['latitude'] . "," . $client['Client']['longitude'];
											} else {
												echo '';
											}
											?>);


		addMarker(mypos, map, markers);
	}
</script>



<script type="text/javascript">
	function initMap() {
		navigator.geolocation.getCurrentPosition(initialize, error);
	}

	var map2;
	var markers2 = [];

	function initialize() {
		var haightAshbury = new google.maps.LatLng(<?php
													if (!empty($client['Client']['latitude'])) {
														echo $client['Client']['latitude'] . "," . $client['Client']['longitude'];
													} else {
														echo '35.621592,-5.274718';
													}
													?>);
		var v = '/app/webroot/img/marker-b.png';
		var l_length = locations1.length;
		var mapOptions = {
			zoom: 6,
			center: haightAshbury,

			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map2 = new google.maps.Map(document.getElementById('maap-canvas'), mapOptions);
		// This event listener will call addMarker() when the map is clicked.
		var infowindow = new google.maps.InfoWindow();
		var marker, i;
		for (var i = 0; i < locations1.length; i++) {
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(locations1[i][1], locations1[i][2]),
				map: map2,

			})
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent('<b style="font-size:13px;">' + locations1[i][0] + '</b><br> <b>Date:</b> ' + locations1[i][3]);
					infowindow.open(map2, marker);
				}
			})(marker, i));
		}


		// Adds a marker at the center of the map.
		var mypos = new google.maps.LatLng(<?php
											if (!empty($client['Client']['latitude'])) {
												echo $client['Client']['latitude'] . "," . $client['Client']['longitude'];
											} else {
												echo '';
											}
											?>);


		addMarker(mypos, map2, markers2);
	}




	function addMarker(location, map, markers) {
		deleteOverlays(markers);
		var v = '/img/marker-v.png';
		var marker = new google.maps.Marker({
			position: location,
			map: map,
			icon: new google.maps.MarkerImage(v, new google.maps.Size(30, 35)),
			animation: google.maps.Animation.DROP
		});
		markers.push(marker);

	}

	// Deletes all markers in the array by removing references to them
	function deleteOverlays(markers) {
		if (markers) {
			for (i in markers) {
				markers[i].setMap(null);
			}
			markers.length = 0;
		}
	}
	google.maps.event.addDomListener(window, 'load', initialize);


	// add dernier products :
	// Sample data structure based on PHP array, converted to JavaScript
	const arrayAdoptUnique = <?php echo json_encode($array_adopt_unique); ?>;

	// jQuery code to append items
	$.each(arrayAdoptUnique, function(productName, data) {
		const listItem = `
		<li class="item">
			<div class="product-info">
				<span class="product-description">Par : ${data.user}
				<span class="label label-warning pull-right">${data.date}</span></span>
				<a href="javascript:void(0)" class="product-title">
					<span>${productName}</span>
				<div class="adoption_data">
					<div class="sub_adopt">
						<b>Nbr prescription estimé</b><span>${data.nbr_pe}</span>
					</div>
					<div class="sub_adopt">
						<b>Pot produit renseigné</b><span>${data.pot}</span>
					</div>
				</div>
				</a>
			</div>
		</li>
	`;

		// Append each list item to the products list
		$(".products-list").append(listItem);
	});
</script>