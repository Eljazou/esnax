<?php
// Select2 is not part of the Metronic bundle shipped in this repo (plugins.bundle.js
// is absent), so this view keeps loading it from the CDN. Version pinned to 4.0.8 to
// match the select2 JS loaded below - the CSS was previously 4.1.0-rc.0 against 4.0.8 JS.
// NOTE: without plugins.bundle.css the select2 dropdown keeps its stock skin rather
// than Metronic's themed one. Cosmetic only; it still functions.
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<?php
// Example string representing JSON-encoded vendors data
$vendeurJson = $client['Client']['vendeur'];

// Decode JSON string into PHP array
$vendeurs = json_decode($vendeurJson, true);
?>
<!-- esna/client/view -->
<style>
	/* ------------------------------------------------------------------
	   Only the pieces Metronic has no equivalent for live here. Cards,
	   grid, buttons, tables, badges, pills and form controls now come from
	   style.bundle.css (Bootstrap 5.3 + Metronic) instead of this block,
	   which shrank from ~180 lines to ~60. Everything is scoped under
	   .client-view so nothing leaks into the layout or other views.
	   ------------------------------------------------------------------ */
	.client-view {
		--cv-primary: #7C5CFA;
		--cv-primary-dark: #5B3FD9;
		--cv-border: #E6E3F5;
		--cv-muted: #7A7391;
		--cv-surface-alt: #F7F6FC;
	}

	/* Gradient profile banner - Metronic has no equivalent component. */
	.client-view .cv-profile {
		background: linear-gradient(135deg, var(--cv-primary) 0%, var(--cv-primary-dark) 100%);
		color: #fff;
	}
	.client-view .cv-profile .btn {
		background: rgba(255, 255, 255, .18);
		color: #fff;
		border-color: rgba(255, 255, 255, .4);
	}
	.client-view .cv-profile .btn:hover {
		background: rgba(255, 255, 255, .28);
		color: #fff;
	}
	.client-view .cv-profile .cv-badge {
		border: 1.5px solid rgba(255, 255, 255, .55);
		background: rgba(255, 255, 255, .1);
	}

	/* Gadget cards (sidebar). Renamed from .card / .card-body / .card-title,
	   which were declared unscoped and therefore overrode Metronic's own card
	   component for the whole page - .card-body was even forced to
	   flex-direction:column-reverse, which mangled every real card here. */
	.client-view .gadget-card {
		border: 1px solid var(--cv-border);
		border-radius: 6px;
		background: #fff;
		padding: 12px 14px;
		margin-bottom: 10px;
	}
	.client-view .gadget-card-qte {
		display: inline-block;
		background: var(--cv-surface-alt);
		border: 1px solid var(--cv-border);
		border-radius: 50px;
		font-size: 22px;
		font-weight: 700;
		padding: 4px 12px;
	}
	.client-view .all-cards { height: auto; overflow: auto; }
	.client-view .detail_viste { max-height: 829px; overflow-y: scroll; }

	/* Timeline now uses Metronic's native component (.timeline / .timeline-item /
	   .timeline-line / .timeline-icon / .timeline-content) straight from
	   style.bundle.css - the previous AdminLTE-derived overrides were removed so
	   the theme's own styles apply unmodified. */

	/* Objection pop-out driven by objettog() / pup() - bespoke widget. */
	.client-view .objet { padding: 0; float: left; width: auto; margin-right: 3px; }
	.client-view .objet .optionh { min-width: 80px; width: auto; float: left; border-radius: 5px; padding: 2px 0 2px 5px; color: #fff; background: var(--cv-primary); z-index: 99; position: relative; }
	.client-view .objet .optionh .fa { float: right; height: 100%; width: 25px; text-align: center; line-height: 20px; border-left: 1px solid; padding: 2px; cursor: pointer; margin-left: 2px; }
	.client-view .objet .optionb { min-width: 80px; width: auto; left: 0; border-radius: 5px; padding: 7px 8px; margin-top: 20px; margin-bottom: 4px; display: none; background: var(--cv-primary-dark); list-style: none; color: #fff; position: relative; z-index: 9; }
	.client-view .objet .optionb li { color: #fff; }

	.client-view #map-canvas,
	.client-view #maap-canvas { border-radius: 6px; overflow: hidden; border: 1px solid var(--cv-border); }

	/* ------------------------------------------------------------------
	   Field rows in the "Les appels" / "Stock temps réel" tabs. These target
	   the existing hand-floated label/value markup by its literal inline-style
	   fingerprint, so none of the surrounding PHP has to change. Selector
	   updated .col-xs-12 -> .col-12 to follow the Bootstrap 5 grid rename.
	   ------------------------------------------------------------------ */
	.client-view .tab-pane .col-12[style*="padding:0px;margin: 6px 0px;"] {
		display: flex !important; flex-wrap: wrap; align-items: baseline !important;
		gap: 4px 10px; padding: 10px 14px !important; margin: 0 !important;
		border-bottom: 1px solid var(--cv-border); font-size: 13.5px; float: none !important; width: 100% !important;
	}
	.client-view .tab-pane .col-12[style*="padding:0px;margin: 6px 0px;"]:last-child { border-bottom: none; }
	.client-view .tab-pane .col-12[style*="padding:0px;margin: 6px 0px;"] > b[style*="width: 248px"] {
		float: none !important; width: auto !important; margin-right: 0 !important;
		color: var(--cv-muted) !important; font-weight: 600 !important; font-size: 12.5px !important;
		text-transform: uppercase; letter-spacing: .02em; flex: 0 0 auto;
	}
	.client-view .tab-pane .col-12[style*="padding:0px;margin: 6px 0px;"] > b[style*="width: 248px"] > b[style*="float:right"] { display: none !important; }
	.client-view .tab-pane .col-12[style*="padding:0px;margin: 6px 0px;"]::after { content: ""; flex: 1 1 auto; order: 1; }
	.client-view .tab-pane .col-md-6[style*="border-left"] { border-left: 1px solid var(--cv-border) !important; }

	/* Detail panels toggled by boxtog(). jQuery .toggle() flips an inline display,
	   so these need a plain display:none - Bootstrap's .d-none is !important and
	   would win over the inline style the toggle sets. */
	.client-view .cv-stat-detail {
		display: none; margin-top: 12px; padding-top: 12px;
		border-top: 1px dashed var(--cv-border); max-height: 180px; overflow-y: auto;
		font-size: 13px; color: var(--cv-muted); line-height: 1.9;
	}
	.client-view .cv-stat-detail i.fa-clock { color: var(--cv-primary-dark); margin-right: 6px; width: 12px; }

	/* Grid-modal headers: kept on the app's purple instead of Metronic's default
	   primary so they match the sidebar chrome set in Layouts/default.ctp. */
	.client-view .modal-header.cv-modal-head { background: var(--cv-primary-dark); color: #fff; }
</style>
<?php
// REMOVED: jQuery 3.5.1, Popper 1.16 and Bootstrap 4.5 JS previously loaded here.
// All three collided with the stack the layout already provides
// (jQuery 2.2.3 + Bootstrap 5.3.3):
//   - reloading jQuery replaced the instance the layout had wired up, and jQuery 3
//     removed $(window).load(), which Layouts/default.ctp still calls;
//   - Bootstrap 4's JS overwrote the Bootstrap 5 `bootstrap` global, so Metronic's
//     scripts.bundle.js and the layout's modal shim were both driving the wrong API.
// Nothing is loaded in their place - Bootstrap 5.3.3 with Popper bundled already
// comes from the layout. The jQuery .modal() calls at the bottom of this file were
// rewritten to the Bootstrap 5 API, which exposes no jQuery plugin interface.
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="client-view">

<div id="myModalmap" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Maps</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body" style="height: 480px;">
				<div id="map-canvas" class="w-100" style="height: 480px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>

	</div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header cv-modal-head">
				<h3 class="modal-title" id="gridModalLabel"></h3>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle">

					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel1" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header cv-modal-head">
				<h3 class="modal-title" id="gridModalLabel1"></h3>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>
<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header cv-modal-head">
				<h3 class="modal-title" id="gridModalLabel2"></h3>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-hidden="true"
					style="float: right;">FERMER</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_return" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Export Result</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<div id="export-message">
					<p class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></p>
					<p class="text-center">Export en cours...</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================
     Stat cards: visites / retards / action en cours
     ============================================================ -->
<div class="row g-4 mb-4">

	<div class="col-md-4">
		<div class="card h-100">
			<div class="card-body">
				<div class="d-flex align-items-start justify-content-between">
					<div>
						<p class="fs-2hx fw-bold mb-0"><?php
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
							?></p>
						<p class="fs-6 text-gray-600 fw-semibold mb-0 mt-1">Nombre de visites</p>
					</div>
					<div class="symbol symbol-40px">
						<span class="symbol-label bg-light-primary">
							<i class="fa fa-eye text-primary"></i>
						</span>
					</div>
				</div>
				<div class="mt-3">
					<button type="button" onclick="boxtog(1)" class="btn btn-icon btn-sm btn-light" title="Plus de détails"><i id="icon1" class="fa fa-plus"></i></button>
				</div>
				<div class="box1 cv-stat-detail">
					<?php
					foreach ($details as $key => $value)
						echo "<i class='fa fa-clock'></i> $value<br>";
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card h-100">
			<div class="card-body">
				<div class="d-flex align-items-start justify-content-between">
					<div>
						<p class="fs-2hx fw-bold mb-0 text-<?php
							$dateretard = $this->requestAction('/clients/system_get_retard_list_client/' . $client['Client']['id']);
							$r = $i - $dateretard['nobre'];
							if ($r < 0)
								echo 'danger';
							else
								echo 'success';
							?>">
							<?php
							echo $r;
							unset($dateretard['nobre']);
							?>
						</p>
						<p class="fs-6 text-gray-600 fw-semibold mb-0 mt-1">Nombre de retards</p>
					</div>
					<div class="symbol symbol-40px">
						<span class="symbol-label bg-light-primary">
							<i class="fa fa-clock-o text-primary"></i>
						</span>
					</div>
				</div>
				<div class="mt-3">
					<button type="button" onclick="boxtog(2)" class="btn btn-icon btn-sm btn-light" title="Plus de détails"><i id="icon2" class="fa fa-plus"></i></button>
				</div>
				<div class="box2 cv-stat-detail">
					<?php
					foreach ($dateretard as $key => $value)
						echo "<i class='fa fa-clock'></i> $value<br>";
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card h-100">
			<div class="card-body">
				<div class="d-flex align-items-start justify-content-between">
					<div>
						<?php
						if (count($client['Action']) == 0) {
							echo '<p class="fs-2hx fw-bold mb-0">----</p>';
						} else {
							$now = time();
							$your_date = strtotime($client['Action'][0]['date_fin']);
							$datediff = $your_date - $now;
							$j = floor($datediff / (60 * 60 * 24));
							if ($j > 0) {
								echo "<p class=\"fs-2hx fw-bold mb-0\">$j j</p>";
							} else {
								echo '<p class="fs-2hx fw-bold mb-0">----</p>';
							}
						}
						?>
						<p class="fs-6 text-gray-600 fw-semibold mb-0 mt-1">Action en cours</p>
					</div>
					<div class="symbol symbol-40px">
						<span class="symbol-label bg-light-primary">
							<i class="fa fa-star text-primary"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="row g-4">
	<div class="col-lg-8">

		<!-- ============================================================
		     Profile header
		     ============================================================ -->
		<div class="cv-profile card mb-4">
			<div class="card-body">
			<div class="d-flex flex-wrap align-items-center gap-3 justify-content-between">
				<div class="d-flex flex-wrap align-items-center gap-3">
					<h1 class="fs-2hx fw-bold mb-0 text-white"><?php echo $client['Client']['nom'] . ' ' . $client['Client']['prenom']; ?></h1>
					<?php if ((AuthComponent::user('role') == 'Admin')) { ?>
						<span class="badge rounded-pill fs-6 px-4 py-2 cv-badge"><?php echo $client['Client']['potentialite']; ?></span>
					<?php } ?>
					<?php
					if ($client['Type']['name'] == 'Pharmacie') {
						echo '<span class="badge rounded-pill fs-6 px-4 py-2 cv-badge">CA : ' . $client['Client']['activite'] . '</span>';
					}
					?>
				</div>
				<span class="fs-6 fw-semibold opacity-75"><?php
					if ($client['Client']['sexe'] == 'h') {
						echo '<i class="fa fa-user"></i> Homme';
					} elseif ($client['Client']['sexe'] == 'f') {
						echo '<i class="fa fa-user"></i> Femme';
					}
					?></span>
			</div>

			<div class="d-flex flex-wrap gap-2 mt-4">
				<?php
				if ($this->requestAction('/droits/getrole/visites/add') == 1)
					echo $this->Html->link(__('Visiter'), array('controller' => 'visites', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-sm"));
				if ($this->requestAction('/droits/getrole/actions/add') == 1)
					echo $this->Html->link(__('Demander une action'), array('controller' => 'actions', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-sm"));
				if ($this->requestAction('/droits/getrole/packs/add') == 1)
					echo $this->Html->link(__('Ajouter un pack'), array('controller' => 'packs', 'action' => 'add', $client['Client']['id']), array("class" => "btn btn-sm"));
				if ($this->requestAction('/droits/getrole/clients/remettre0') == 1)
					echo $this->Html->link(__('Remettre à 0'), array('action' => 'remettre0', $client['Client']['id']), array("class" => "btn btn-sm"));
				if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
					<button type="button" class="btn btn-warning btn-gadget" data-bs-toggle="modal" data-bs-target="#gadget_modal">Ajouter gadget</button>
				<?php endif;

				if ($client['Type']['name'] != 'Médecin') {
					$token = $client['Client']['id'] * 12;
					$tok = md5($token);
					if (empty($client['Client']['tel'])) {
						$tel = 0;
					} else {
						$tel = $client['Client']['tel'];
					}
				}
				?>
				</div>
			</div>
		</div>

		<!-- ============================================================
		     Info card (details + coordonnées)
		     ============================================================ -->
		<div class="card mb-4">
			<?php if ($client['Type']['name'] == 'Médecin' || $client['Type']['id'] == '5') { ?>
				<div class="row g-0">
					<div class="col-md-6">
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Code</span>
							<span class="fw-bold text-end"><?php
								$typ = substr($client['Category']['name'], 0, 3);
								$typ = strtoupper($typ);
								echo $client['Secteur']["code_region"] . $client['Secteur']["code_ville"] . $client['Secteur']["code_secteur"] . $typ . $client['Client']['id'];
								?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Type</span>
							<span class="fw-bold text-end"><?php echo $client['Type']['name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Secteur</span>
							<span class="fw-bold text-end"><?php echo $client['Secteur']['full_name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Catégorie</span>
							<span class="fw-bold text-end"><?php echo $client['Category']['name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Tendance</span>
							<span class="fw-bold text-end"><?php echo $client['Category1']['name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Titre</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['titre']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Activité</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['activite']); ?></span>
						</div>
						<?php if (!empty($client['Hopital']['name'])): ?>
							<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
								<span class="text-gray-600 fw-semibold">Hôpital</span>
								<span class="fw-bold text-end"><?php echo h($client['Hopital']['name']); ?></span>
							</div>
						<?php endif; ?>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Exercice</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['exercice']); ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">GSM</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['tel']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">E-mail</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['mail']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Fixe</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['fixe']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Fax</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['fax']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Adresse</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['adress']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Date de recrutement</span>
							<span class="fw-bold text-end"><?php
								$cc = explode(' ', $client['Client']['created']);
								echo $cc[0];
								?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Vendeurs</span>
							<span class="fw-bold text-end">
								<button class="btn btn-sm btn-light-primary rounded-pill py-1 px-3" data-bs-toggle="modal" data-bs-target="#popup_vendor">
									<i class="fa fa-users"></i>
									<span class="count_vd"><?php echo count($vendeurs ?? []); ?></span>
								</button>
							</span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Remarque</span>
							<span class="fw-bold text-end"><?php echo $client['Client']['rmq']; ?></span>
						</div>
					</div>
				</div>
			<?php
			} else {
			?>
				<div class="row g-0">
					<div class="col-md-6">
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Code Wavesoft</span>
							<span class="fw-bold text-end"><?php echo $client['Client']['code_wavsoft']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Client de centre d'appel</span>
							<span class="fw-bold text-end"><?php
								$clientcall = array("0" => "Non", "1" => "Oui");
								echo $clientcall[$client['Client']['client_call']]; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Type</span>
							<span class="fw-bold text-end"><?php echo $client['Type']['name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Dirigeant</span>
							<span class="fw-bold text-end"><?php echo $client['Client']['dirigent']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Secteur</span>
							<span class="fw-bold text-end"><?php echo $client['Secteur']['full_name']; ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Adresse</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['adress']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Date de recrutement</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['date_recrutement']); ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">GSM</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['tel']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">E-mail</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['mail']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Fixe</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['fixe']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Fax</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['fax']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Présentoir</span>
							<span class="fw-bold text-end"><?php echo h($client['Client']['dirigent']); ?></span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Vendeurs</span>
							<span class="fw-bold text-end">
								<button class="btn btn-sm btn-light-primary rounded-pill py-1 px-3" data-bs-toggle="modal" data-bs-target="#popup_vendor">
									<i class="fa fa-users"></i>
									<span class="count_vd"><?php if (is_array($vendeurs))
																echo count($vendeurs);
															else
																echo "0"; ?></span>
								</button>
							</span>
						</div>
						<div class="d-flex align-items-start justify-content-between gap-3 px-5 py-3 border-bottom">
							<span class="text-gray-600 fw-semibold">Remarque</span>
							<span class="fw-bold text-end"><?php echo $client['Client']['rmq']; ?></span>
						</div>
					</div>
				</div>
			<?php
			} ?>

			<?php
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
			?>

			<?php if ($buttonCount > 0): ?>
				<div class="card-footer d-flex flex-wrap gap-3">
					<?php if ($client['Type']['name'] == 'Pharmacie') { ?>
						<button type="button" class="btn btn-primary export-client-btn"
							data-client-id="<?php echo $client['Client']['id']; ?>">
							Exporter
						</button>
					<?php } ?>

					<?php
					if ($this->requestAction('/droits/getrole/clients/edit') == 1)
						echo $this->Html->link(
							'Editer',
							array('action' => 'edit', $client['Client']['id']),
							array('class' => 'btn btn-warning')
						);
					else if ($this->requestAction('/droits/getrole/clientsproposes/edit') == 1)
						echo $this->Html->link(
							'Proposer une modification',
							array('controller' => 'clientsproposes', 'action' => 'edit', $client['Client']['id']),
							array('class' => 'btn btn-warning')
						);
					?>
				</div>
			<?php endif; ?>
		</div>

		<?php if (!empty($client['Action'])): ?>
			<div class="card mb-4">
				<div class="card-header">
					<h3 class="card-title">Historique des actions</h3>
				</div>
				<div class="card-body p-0">
					<table class="table table-row-bordered table-hover align-middle mb-0">
						<thead>
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
						</thead>
						<tbody>
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
											echo '<span class="badge badge-light-warning">Prochainement</span>';
										else if ($j >= 0)
											echo '<span class="badge badge-light-success">En cours</span>';
										else
											echo '<span class="badge badge-light-danger">Terminé</span>';
										?></td>
									<td class="actions">
										<?php if ($this->requestAction('/droits/getrole/actions/edit') == 1 || $this->requestAction('/droits/getrole/actions/valider') == 1): ?>
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-sm">Action</button>
												<button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
													data-bs-toggle="dropdown" aria-expanded="false">
													<span class="visually-hidden">Ouvrir le menu</span>
												</button>
												<ul class="dropdown-menu">
													<li> <?php
															if ($this->requestAction('/droits/getrole/actions/edit') == 1) {
																if ($action['date_debut'] > date('Y-m-d'))
																	echo $this->Html->link('Editer', array('controller' => 'actions', 'action' => 'edit', $action['id']), array('class' => 'dropdown-item'));
																else if ($j >= 0)
																	echo $this->Html->link('Editer', array('controller' => 'actions', 'action' => 'edit', $action['id']), array('class' => 'dropdown-item'));
															}
															?></li>
													<li> <?php
															if ($this->requestAction('/droits/getrole/actions/valider') == 1)
																echo $this->Html->link('archiver', array('controller' => 'actions', 'action' => 'valider', $action['id'], -1), array('class' => 'dropdown-item'));
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
			<div class="card mb-4">
				<div class="card-header">
					<h3 class="card-title">La liste des affectations</h3>
				</div>
				<div class="card-body p-0">
					<table class="table table-row-bordered table-hover align-middle mb-0">
						<thead>
							<tr>
								<th>VMP</th>
								<th>Liste</th>
								<th>Date</th>
								<th>Désaffectation</th>
							</tr>
						</thead>
						<tbody>
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
					</div>
				<?php
			endif;

			if ($this->requestAction('/droits/getrole/listes/remplire') == 1):

				$users = $this->requestAction('/users/system_get_all_user_vmp_superviseur_coordinateur');
				echo $this->Form->create('Clients', array("url" => array('action' => 'desafecter')));
				echo $this->Form->hidden('client_id', array("value" => $client['Client']['id']));
				?>
					<div class="card-footer bg-light d-flex flex-wrap align-items-end gap-4">
						<div class="flex-grow-1" style="min-width:220px;">
							<label for="regions" class="form-label fw-semibold text-gray-600">VMP</label>
							<select class="form-select" id="regions">
								<option value="0">Choisissez un VMP</option>
								<?php foreach ($users as $userid => $username) { ?>
									<option value="<?php echo $userid; ?>"><?php echo $username; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="flex-grow-1" style="min-width:220px;" id="ville"></div>
						<?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary', 'div' => false)); ?>
					</div>
				<?php //endif;    
				?>

			</div>
		<?php endif; ?>
	</div>
	<!-- /.col-lg-8 -->

	<!-- ============================================================
	     Sidebar
	     ============================================================ -->
	<div class="col-lg-4">
		<div class="card mb-4">
			<div class="card-body d-flex align-items-center justify-content-between">
				<div>
					<h4 class="fs-5 fw-bold mb-1"><?php
						if (!empty($client['Visite']))
							echo strftime("%A %d-%m-%Y", strtotime($client['Visite'][0]['date']));
						else
							echo '---';
						?></h4>
					<p class="fs-7 text-gray-600 mb-0">Date dernière visite</p>
				</div>
				<div class="symbol symbol-40px">
					<span class="symbol-label bg-light-primary">
						<i class="fa fa-calendar text-primary"></i>
					</span>
				</div>
			</div>
		</div>

		<?php if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
			<div class="card mb-4">
				<div class="card-header">
					<h3 class="card-title">Gadgets</h3>
				</div>
				<div class="card-body all-cards">
					<?php
					foreach ($gadgetclientall as $gadget): ?>
						<div class="gadget-card">
							<div class="d-flex align-items-center justify-content-between gap-2 mb-3">
								<span class="badge badge-light-primary"><?php echo $gadget['Gadgetclient']['created']; ?></span>
								<span class="badge badge-light-warning"><?php echo $gadget['User']['name']; ?></span>
							</div>
							<div class="text-center">
								<h3 class="fs-5 fw-bold mb-2"><?php echo $gadget['Gadgetclient']['name']; ?></h3>
								<div class="gadget-card-qte"><?php echo $gadget['Gadgetclient']['quantite']; ?></div>
								<?php
								if ($this->requestAction('/droits/getrole/gadgetclients/supprimer') == 1): ?>
									<div class="mt-2">
										<?php echo $this->Html->link("Supprimer", array("controller" => "gadgetclients", "action" => "supprimer", $gadget['Gadgetclient']['id']), array('class' => 'btn btn-sm btn-warning')); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->


<div class="row g-4">
	<div class="col-12">
		<div class="card">
			<div class="card-header p-0">
				<ul class="nav nav-tabs nav-line-tabs fs-6 border-0 px-4" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab_1" type="button" role="tab" aria-controls="tab_1" aria-selected="true">Les visites</button>
					</li>
					<?php if (AuthComponent::user('role') == 'Admin'): ?>
						<li class="nav-item" role="presentation">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab_2" type="button" role="tab" aria-controls="tab_2" aria-selected="false">Les appels</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab_3" type="button" role="tab" aria-controls="tab_3" aria-selected="false">Stock temps réel</button>
						</li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="card-body tab-content">
			<div class="tab-pane fade show active" id="tab_1" role="tabpanel">
				<div class="row">
					<div class="col-12">
						<div class="timeline">
							<?php
							$ii = 0;
							$mapinf = array();
							foreach ($client['Visite'] as $visite):
								$user_id = 0;
								$visite['date'] = explode(' ', $visite['date']);
								if ($user_id != $visite['user_id'])
									$user = $this->requestAction('/users/system_get_name_user/' . $visite['user_id']);
								if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
									$super = $this->requestAction('/users/system_get_if_super/' . $visite['user_id']);
									if ($super == 0) { /* ok */ } else continue;
								}
								// Map data
								$pos = strpos($visite['longitude'], "n");
								$poss = strpos($visite['longitude'], "0.0");
								if (!empty($visite['longitude']) && $pos === false && $poss === false) {
									$mapinf['visite'][] = "'" . $user . "'," . str_replace(",", ".", $visite['latitude']) . "," . str_replace(",", ".", $visite['longitude']) . ",'" . $visite['date'][0] . "'";
								}
								// V2 detection
								$isV2 = false;
								$isPharmacieV2 = false;
								if (!empty($visite['produit_adoption']) && substr(trim($visite['produit_adoption']), 0, 1) === '{') {
									$_tmpPa = json_decode($visite['produit_adoption'], true);
									if (is_array($_tmpPa)) {
										$_first = reset($_tmpPa);
										if (is_array($_first)) {
											if (array_key_exists('objections', $_first) || array_key_exists('adoption', $_first)) {
												$isV2 = true;
											} elseif (array_key_exists('disponibilite', $_first) || array_key_exists('produit_conseille', $_first)) {
												$isPharmacieV2 = true;
											}
										}
									}
								}
								if (!$isV2 && !$isPharmacieV2 && !empty($visite['concurrence_p']) && substr(trim($visite['concurrence_p']), 0, 1) === '[') {
									$_tmpCc = json_decode($visite['concurrence_p'], true);
									if (is_array($_tmpCc)) {
										$_first = reset($_tmpCc);
										if (is_array($_first)) {
											if (array_key_exists('frequence', $_first)) {
												$isV2 = true;
											} elseif (array_key_exists('type_offre', $_first) || array_key_exists('produit_concurrent', $_first)) {
												$isPharmacieV2 = true;
											}
										}
									}
								}
								if (!$isV2 && !$isPharmacieV2) {
									if (!empty($visite['distribution_emg']) || !empty($visite['requete_crm']) || !empty($visite['objectif_visite'])) {
										if ($client['Type']['name'] == 'Pharmacie') {
											$isPharmacieV2 = true;
										} else {
											$isV2 = true;
										}
									}
								}
							?>
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line"></div>
								<!--end::Timeline line-->

								<!--begin::Timeline icon-->
								<div class="timeline-icon">
									<i class="fa fa-envelope fs-2 text-gray-500"></i>
								</div>
								<!--end::Timeline icon-->

								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<div class="d-flex flex-wrap align-items-center gap-2 mb-2">
											<span class="badge badge-light-dark"><?php echo strftime("%A %d-%m-%Y", strtotime($visite['date'][0])); ?></span>
											<span class="badge badge-light-success"><?php echo $visite["timer"]; ?></span>
											<span class="badge badge-light-primary">
												<i class="fa <?php echo ($visite['type_visite'] == 'solo') ? 'fa-user' : 'fa-users'; ?> me-1"></i>
												<?php echo $visite['type_visite']; ?>
											</span>
										</div>

										<div class="fs-5 fw-semibold mb-2"><?php echo $user; ?></div>

										<div class="d-flex align-items-center mt-1 fs-6">
											<div class="text-muted me-2 fs-7">
												<i class="fa fa-clock-o me-1"></i>
												<?php
												if ($visite['date'][1] == "00:00:00") {
													$visite['date'][1] = explode(" ", $visite['created']);
													$visite['date'][1] = $visite['date'][1][1];
												}
												echo $visite['date'][1]; ?>
											</div>
										</div>
									</div>
									<!--end::Timeline heading-->
                                    <div class="mb-5">
                                        <?php
                                        // 1. Laisse le comportement normal V2 / Pharmacie s'afficher (comme ANTIMETIL)
                                        if ($isV2) {
                                            echo $this->element('clients/visite_item_v2', compact('visite', 'client'));
                                        } elseif ($isPharmacieV2) {
                                            echo $this->element('clients/visite_item_pharmacie_v2', compact('visite', 'client'));
                                        } else {
                                            echo $this->element('clients/visite_item_v1', compact('visite', 'client', 'ii', 'gammes', 'produits'));
                                        }
                                    
                                        // 2. FORCE l'affichage de notre bloc V1 personnalisé juste en dessous, quoi qu'il arrive
                                        echo '<div style="width: 100% !important; display: block !important; clear: both !important; margin-top: 20px !important;">';
                                            echo $this->element('clients/visite_item_v1', compact('visite', 'client', 'ii', 'gammes', 'produits'));
                                        echo '</div>';
                                        ?>
                                    </div>
									<div class="d-flex align-items-center gap-2 border-top pt-3">
										<?php if ($this->requestAction('/droits/getrole/visites/edit') == 1): ?>
											<a class="btn btn-primary btn-sm" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'edit', $visite['id'])); ?>" title="Editer"><i class="fa fa-edit"></i></a>
										<?php endif;
										if ($this->requestAction('/droits/getrole/visites/archive') == 1): ?>
											<a class="btn btn-danger btn-sm" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'archive', $visite['id'], 0)); ?>" title="Archive"><i class="fa fa-archive"></i></a>
										<?php endif; ?>
										&nbsp;
										<?php
										if (!empty($visite['latitude']) && AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") {
											$pos = strpos($visite['longitude'], "n");
											$poss = strpos($visite['longitude'], "0.0");
											if (!empty($visite['longitude']) && $pos === false && $poss === false) {
												echo '<a data-bs-toggle="modal" onclick="clikgeo(' . $ii . ')" data-bs-target="#myModalmap" class="btn btn-info btn-sm" style="float:right;background:#e2141e;font-size:14px;padding:1px 8px;" title="Position visite"><input type="hidden" class="latc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['longitude']) . '"><input type="hidden" class="lengc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['latitude']) . '"><input type="hidden" class="latv' . $ii . '" value="' . str_replace(",", ".", $visite['latitude']) . '"><input type="hidden" class="lengv' . $ii . '" value="' . str_replace(",", ".", $visite['longitude']) . '"><i class="fa fa-map-marker"></i></a>';
											}
										}
										?>
									</div>
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							<?php
								$ii++;
							endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
				<div class="tab-pane fade" id="tab_2" role="tabpanel">
					<div class="row">
						<div class="col-12">
							<?php $appels = $this->requestAction("/rapportprocpects/system_get_appel_for_client/" . $client['Client']['id']);
							foreach ($appels as $appel):
								$appeldate = explode(" ", $appel["Rapportprocpect"]["created"])
							?>
								<div class="timeline">
									<!--begin::Timeline item-->
									<div class="timeline-item">
										<!--begin::Timeline line-->
										<div class="timeline-line"></div>
										<!--end::Timeline line-->

										<!--begin::Timeline icon-->
										<div class="timeline-icon">
											<i class="fa fa-phone fs-2 text-gray-500"></i>
										</div>
										<!--end::Timeline icon-->

										<!--begin::Timeline content-->
										<div class="timeline-content mb-10 mt-n1">
											<!--begin::Timeline heading-->
											<div class="pe-3 mb-5">
												<div class="d-flex flex-wrap align-items-center gap-2 mb-2">
													<span class="badge badge-light-dark"><?php echo strftime("%A %d-%m-%Y", strtotime($appeldate[0])); ?></span>
													<span class="badge badge-light-primary">
														<?php echo $this->Html->image('clock-white', array('style' => 'width:19px;margin-top: -2px;')) ?>
														<?php echo $appel["Rapportprocpect"]["duree"]; ?>
													</span>
												</div>

												<div class="fs-5 fw-semibold mb-2">
													<?php echo $appel["User"]["name"] . " (" . $appel["Rapportprocpect"]["type_user"] . ")"; ?>
												</div>

												<div class="d-flex align-items-center mt-1 fs-6">
													<div class="text-muted me-2 fs-7">
														<i class="fa fa-clock-o me-1"></i><?php echo $appeldate[1]; ?>
													</div>
												</div>
											</div>
											<!--end::Timeline heading-->
											<div class="mb-5">
												<div class="row">
													<div class="col-md-6">
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																CAMPAGNE
																<b
																	style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["prospectcompagne"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Connaissance produit ?
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["connaissance"]; ?>
														</div>
														<?php if ($appel["Rapportprocpect"]["connaissance"] == "Oui"): ?>
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Disponibilité produit ?
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["disponibilite"]; ?>
															</div>

															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Avez vous réalisé des ventes?
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["vente"]; ?>
															</div>
															<?php if ($appel["Rapportprocpect"]["vente"] == "Oui"): ?>
																<div class="col-12" style="padding:0px;margin: 6px 0px;">
																	<b style="width: 248px;float: left;margin-right:5px;">
																		Si oui , comment ?
																		<b
																			style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["comment"]; ?>
																</div>
															<?php endif; ?>
														<?php endif; ?>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Voulez vous qu'un commercial?
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commercial"]; ?>
														</div>
														<?php if ($appel["Rapportprocpect"]["commercial"] == "Non"): ?>

															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Mise en place produit de la campagne
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commande"]; ?>
															</div>
														<?php endif; ?>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Pack hors campagne
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["hors_campagne"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Degré de satisfaction Call Center
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["appreciation"]; ?>
															%
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Questions
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["question"]; ?>
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Objections
																<b style="float:right;">:</b></b>
															<?php echo '<span class="badge badge-light-primary me-1 mb-1">' . str_replace("|", '</span><span class="badge badge-light-primary me-1 mb-1">', $appel["Rapportprocpect"]["objection"]) . "</span>"; ?>
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Réclamations
																<b style="float:right;">:</b></b>
															<?php echo '<span class="badge badge-light-primary me-1 mb-1">' . str_replace("|", '</span><span class="badge badge-light-primary me-1 mb-1">', $appel["Rapportprocpect"]["reclamation"]) . "</span>"; ?>
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Qualifications
																<b style="float:right;">:</b></b>
															<?php echo '<span class="badge badge-light-primary me-1 mb-1">' . str_replace("|", '</span><span class="badge badge-light-primary me-1 mb-1">', $appel["Rapportprocpect"]["qualification"]) . "</span>"; ?>
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Propositions
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["proposition"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Type Achat Direct Nombre de CMD
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["type_achat_direct"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Type Achat Grossiste Nombre de CMD
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["type_achat_grossiste"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Fréquence Passage Commercial
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["frequence_passage_commercial"]; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Commande Groupée
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["commande_groupee"]; ?>
														</div>

														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Objections client
																<b style="float:right;">:</b></b>
															<?php echo '<span class="badge badge-light-primary me-1 mb-1">' . str_replace("|", '</span><span class="badge badge-light-primary me-1 mb-1">', $appel["Rapportprocpect"]["objection_two"]) . "</span>"; ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Statut Client
																<b
																	style="float:right;">:</b></b><?php echo $appel["Rapportprocpect"]["statut_client"]; ?>
														</div>


													</div>




													<?php if ($appel["Prospectfeuille"]["commercial_type"] != null): ?>
														<div class="col-md-6" style="border-left: 1px solid #e6e6e6;">
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Type d'action
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_type"]; ?>
															</div>
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Commercial
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_user_wavesoft"]; ?>
															</div>
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Opportunité concrétisée
																	<b style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_opportunite"];
																										if ($appel["Prospectfeuille"]["commercial_produits"] != null)
																											echo " (" . $appel["Prospectfeuille"]["commercial_produits"] . ")";
																										else
																											echo " (" . $appel["Prospectfeuille"]["commercial_raison"] . ")";
																										?>
															</div>
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Date de
																	<?php echo $appel["Prospectfeuille"]["commercial_type"]; ?>
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_date"]; ?>
															</div>
															<div class="col-12" style="padding:0px;margin: 6px 0px;">
																<b style="width: 248px;float: left;margin-right:5px;">
																	Commentaire
																	<b
																		style="float:right;">:</b></b><?php echo $appel["Prospectfeuille"]["commercial_commentaire"]; ?>
															</div>
														</div>
													<?php endif; ?>



												</div>
											</div>
											<div class="d-flex align-items-center gap-2 border-top pt-3">
												<?php
												if ($this->requestAction('/droits/getrole/rapportprocpects/supprimer') == 1):
												?>
													<a class="btn btn-danger btn-sm"
														href="<?php echo $this->Html->url(array('controller' => 'rapportprocpects', 'action' => 'supprimer', $appel["Rapportprocpect"]['id'])); ?>"
														title="Supprimer"><i class="fa fa-archive"></i></a>
												<?php endif; ?>
												<b>&nbsp;</b>

											</div>

										</div>
										<!--end::Timeline content-->
									</div>
									<!--end::Timeline item-->
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tab_3" role="tabpanel">
					<div class="row">
						<div class="col-12">
							<?php
							foreach ($stockreel as $stock):
								$appeldate = explode(" ", $stock["Stockvisite"]["created"]);
							?>
								<div class="timeline">
									<!--begin::Timeline item-->
									<div class="timeline-item">
										<!--begin::Timeline line-->
										<div class="timeline-line"></div>
										<!--end::Timeline line-->

										<!--begin::Timeline icon-->
										<div class="timeline-icon">
											<i class="fa fa-cubes fs-2 text-gray-500"></i>
										</div>
										<!--end::Timeline icon-->

										<!--begin::Timeline content-->
										<div class="timeline-content mb-10 mt-n1">
											<!--begin::Timeline heading-->
											<div class="pe-3 mb-5">
												<div class="d-flex flex-wrap align-items-center gap-2 mb-2">
													<span class="badge badge-light-dark"><?php echo strftime("%A %d-%m-%Y", strtotime($appeldate[0])); ?></span>
												</div>

												<div class="fs-5 fw-semibold mb-2"><?php echo $stock["User"]["name"] ?></div>

												<div class="d-flex align-items-center mt-1 fs-6">
													<div class="text-muted me-2 fs-7">
														<i class="fa fa-clock-o me-1"></i><?php echo date("H:i:s", strtotime($appeldate[1])); ?>
													</div>
												</div>
											</div>
											<!--end::Timeline heading-->
											<div class="mb-5">
												<div class="row">
													<div class="col-md-12">
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Produit
																<b style="float:right;">:</b>
															</b><span class="badge badge-light-success"
																style="font-size: 13px;"><?php echo $stock["Produit"]["name"] ?></span>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Quantite
																<b
																	style="float:right;">:</b></b><?php echo $stock["Stockvisite"]["quantite"] ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Type
																<b style="float:right;">:</b>
															</b><?php echo $stock["Stockvisite"]["type"] ?>
														</div>
														<div class="col-12" style="padding:0px;margin: 6px 0px;">
															<b style="width: 248px;float: left;margin-right:5px;">
																Commentaire
																<b style="float:right;">:</b>
															</b><?php echo $stock["Stockvisite"]["commentaire"] ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--end::Timeline content-->
									</div>
									<!--end::Timeline item-->
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
if (!empty($client['Commande'])): ?>
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="card-title"><?php echo __('Commandes'); ?></h3>
		</div>
		<div class="card-body p-0">
			<table class="table table-row-bordered table-hover align-middle mb-0">
				<thead>
					<tr>
						<th><?php echo __('VMP'); ?></th>
						<th><?php echo __('Quantité des produits'); ?></th>
						<th><?php echo __('Total en Dhs'); ?></th>
						<th><?php echo __('Date de création'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
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
								<?php echo $this->Html->link(__('Visualiser'), array('controller' => 'commandes', 'action' => 'view', $commande['id']), array('class' => 'btn btn-sm btn-light-primary')); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") { ?>
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="card-title">La liste des visites sur map</h3>
		</div>
		<div class="card-body">
			<div id="maap-canvas" style="min-height: 400px;"></div>
		</div>
	</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="popup_vendor" tabindex="-1" role="dialog" aria-labelledby="popup_vendorLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="popup_vendorLabel">Les vendeurs</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php

					if ($client['Client']["vendeur"] != '' && is_array($vendeurs)) { ?>
						<table class="table table-row-bordered table-hover align-middle mb-0">
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
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<div id="gadget_modal" class="modal fade" tabindex="-1" aria-labelledby="gadget_modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="gadget_modalLabel">Ajouter un gadget</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php echo $this->Form->create('Gadgetclient', array("url" => array("controller" => "gadgetclients", "action" => "add")));
				echo $this->Form->hidden('client_id', array('value' => $client["Client"]["id"]));
				echo $this->Form->input('gadgetclient_id', array("name" => "data[Gadgetclient][name]", 'class' => 'form-select')); ?>
				<?php
				echo $this->Form->input('quantite', array('class' => 'form-control', 'required' => 'required')); ?>
			</div>
			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
				<input type="submit" value="Envoyer" class="btn btn-primary">
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

</div>
<!-- /.client-view -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#GadgetclientGadgetclientId').select2({
			tags: true
		});
	});
</script>
<script>
	function boxtog(id) {
		$('.box' + id).toggle(200);
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
			bootstrap.Modal.getOrCreateInstance(document.getElementById('modal_return')).show();

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
						bootstrap.Modal.getOrCreateInstance(document.getElementById('modal_return')).hide();
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
		bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')).show();
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
		bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal1')).show();
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
		bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal2')).show();
	}
	var locations1 = [<?php
						if (!empty($mapinf['visite'])) {
							foreach ($mapinf['visite'] as $value) {
								echo '[' . $value . '],';
							}
						}
						?>];
	var locations = [];
	var leafletMap = null;

	function clikgeo(id) {
		var lat = parseFloat($(".latv" + id).attr("value"));
		var lng = parseFloat($(".lengv" + id).attr("value"));
		setTimeout(function() {
			var container = document.getElementById('map-canvas');
			// Reset map container if needed
			if (leafletMap) { leafletMap.remove(); leafletMap = null; }
			container.innerHTML = '';
			container.style.height = '450px';
			leafletMap = L.map('map-canvas').setView([lat, lng], 15);
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '© OpenStreetMap',
				maxZoom: 19
			}).addTo(leafletMap);
			// Marker visite
			L.marker([lat, lng]).addTo(leafletMap).bindPopup('<b>Position visite</b>').openPopup();
			// Marker client (si disponible)
			<?php if (!empty($client['Client']['latitude'])): ?>
			var clientLat = <?php echo str_replace(",", ".", $client['Client']['latitude']); ?>;
			var clientLng = <?php echo str_replace(",", ".", $client['Client']['longitude']); ?>;
			if (clientLat && clientLng) {
				L.marker([clientLat, clientLng], {
					icon: L.icon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34]})
				}).addTo(leafletMap).bindPopup('<b>Position client</b>');
			}
			<?php endif; ?>
			leafletMap.invalidateSize();
		}, 400);
	}
</script>
