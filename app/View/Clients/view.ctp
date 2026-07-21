<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php
// Example string representing JSON-encoded vendors data
$vendeurJson = $client['Client']['vendeur'];

// Decode JSON string into PHP array
$vendeurs = json_decode($vendeurJson, true);
?>
<!-- esna/client/view -->
<style>
	.client-view{--bg:#F5F4FB;--surface:#FFFFFF;--surface-alt:#F7F6FC;--border:#E6E3F5;--text:#2B2545;--text-muted:#7A7391;
		--primary:#7C5CFA;--primary-dark:#5B3FD9;--primary-soft:#F1EDFF;
		--success:#1D9A6C;--success-soft:#E5F7EF;--danger:#E0393E;--danger-soft:#FCEAEA;--warning:#DC9A2E;--warning-soft:#FBF2E1;
		--radius:10px;--radius-sm:6px;--shadow:0 1px 2px rgba(60,40,120,.05),0 2px 8px rgba(60,40,120,.07);
		font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;color:var(--text);background:var(--bg);padding:18px;display:block;}
	.client-view *{box-sizing:border-box;}
	.client-view h1,.client-view h2,.client-view h3,.client-view h4{font-family:'Inter',sans-serif;color:var(--text);}

	.cv-grid{display:flex;flex-wrap:wrap;gap:16px;margin:0 0 16px 0;}
	.cv-main{flex:1 1 720px;min-width:0;}
	.cv-side{flex:0 0 300px;max-width:300px;}
	@media (max-width:900px){.cv-side{flex:1 1 100%;max-width:100%;}}

	.cv-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);margin-bottom:16px;}
	.cv-card-header{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
	.cv-card-title{font-size:15px;font-weight:700;margin:0;letter-spacing:.1px;}
	.cv-card-body{padding:16px 18px;}

	.cv-stats{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:16px;}
	.cv-stat{flex:1 1 200px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:16px 18px;position:relative;overflow:hidden;}
	.cv-stat-top{display:flex;align-items:flex-start;justify-content:space-between;}
	.cv-stat-value{font-size:30px;font-weight:800;line-height:1.1;margin:0;}
	.cv-stat-label{font-size:13px;color:var(--text-muted);font-weight:500;margin:4px 0 0 0;}
	.cv-stat-icon{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;flex:0 0 auto;}
	.cv-stat.cv-blue .cv-stat-icon{background:var(--primary-soft);color:var(--primary-dark);}
	.cv-stat.cv-green .cv-stat-icon{background:var(--success-soft);color:var(--success);}
	.cv-stat.cv-green .cv-stat-value{color:var(--success);}
	.cv-stat.cv-red .cv-stat-icon{background:var(--danger-soft);color:var(--danger);}
	.cv-stat.cv-red .cv-stat-value{color:var(--danger);}
	.cv-stat.cv-amber .cv-stat-icon{background:var(--warning-soft);color:var(--warning);}
	.cv-stat-toggle{border:none;background:var(--surface-alt);width:26px;height:26px;border-radius:50%;color:var(--text-muted);cursor:pointer;font-size:12px;}
	.cv-stat-toggle:hover{background:var(--border);}
	.cv-stat-detail{display:none;margin-top:12px;padding-top:12px;border-top:1px dashed var(--border);max-height:180px;overflow-y:auto;font-size:13px;color:var(--text-muted);line-height:1.9;}
	.cv-stat-detail i.fa-clock{color:var(--primary-dark);margin-right:6px;width:12px;}

	.cv-profile{background:linear-gradient(135deg,var(--primary) 0%,var(--primary-dark) 100%);border-radius:var(--radius);box-shadow:var(--shadow);padding:22px 24px;margin-bottom:16px;color:#fff;}
	.cv-profile-top{display:flex;flex-wrap:wrap;align-items:center;gap:12px;justify-content:space-between;}
	.cv-profile-name-row{display:flex;flex-wrap:wrap;align-items:center;gap:10px;}
	.cv-profile-name{font-size:26px;font-weight:800;margin:0;}
	.cv-badge{display:inline-flex;align-items:center;border:1.5px solid rgba(255,255,255,.55);border-radius:999px;padding:4px 14px;font-size:14px;font-weight:600;background:rgba(255,255,255,.1);}
	.cv-profile-sexe{font-size:14px;font-weight:600;opacity:.9;}
	.cv-profile-actions{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}

	.cv-btn{display:inline-flex;align-items:center;gap:6px;border-radius:var(--radius-sm);padding:9px 16px;font-size:13.5px;font-weight:600;border:1px solid transparent;cursor:pointer;text-decoration:none;line-height:1.3;transition:filter .12s ease,transform .05s ease;}
	.cv-btn:active{transform:translateY(1px);}
	.cv-btn:hover{filter:brightness(0.95);text-decoration:none;}
	.cv-btn-onprofile{background:rgba(255,255,255,.18);color:#fff;border-color:rgba(255,255,255,.4);}
	.cv-btn-onprofile:hover{background:rgba(255,255,255,.28);color:#fff;}
	.cv-btn-warning{background:var(--warning);color:#fff;}
	.cv-btn-warning:hover{color:#fff;}
	.cv-btn-primary{background:var(--primary-dark);color:#fff;}
	.cv-btn-primary:hover{color:#fff;}
	.cv-btn-block-group{display:flex;gap:10px;flex-wrap:wrap;padding:16px 18px;border-top:1px solid var(--border);}
	.cv-btn-block-group .cv-btn{flex:1 1 180px;justify-content:center;padding:11px 16px;}

	.cv-info-columns{display:flex;flex-wrap:wrap;}
	.cv-info-col{flex:1 1 280px;min-width:240px;}
	.cv-info-col+.cv-info-col{border-left:1px solid var(--border);}
	@media (max-width:620px){.cv-info-col+.cv-info-col{border-left:none;border-top:1px solid var(--border);}}
	.cv-info-row{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;padding:11px 20px;border-bottom:1px solid var(--border);font-size:14px;}
	.cv-info-row:last-child{border-bottom:none;}
	.cv-info-label{color:var(--text-muted);font-weight:500;flex:0 0 auto;}
	.cv-info-value{font-weight:600;text-align:right;}
	.cv-vendor-btn{border:none;background:var(--primary-soft);color:var(--primary-dark);border-radius:999px;padding:4px 12px;font-size:13px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;}
	.cv-vendor-btn:hover{background:#E3DDFA;}

	.cv-table{width:100%;border-collapse:collapse;font-size:13.5px;}
	.cv-table th{text-align:left;background:var(--surface-alt);color:var(--text-muted);font-weight:700;text-transform:uppercase;font-size:11.5px;letter-spacing:.04em;padding:10px 14px;border-bottom:1px solid var(--border);}
	.cv-table td{padding:11px 14px;border-bottom:1px solid var(--border);vertical-align:middle;}
	.cv-table tr:last-child td{border-bottom:none;}
	.cv-table tr:hover td{background:var(--surface-alt);}
	.cv-pill{display:inline-block;padding:3px 11px;border-radius:999px;font-size:12px;font-weight:700;}
	.cv-pill-green{background:var(--success-soft);color:var(--success);}
	.cv-pill-red{background:var(--danger-soft);color:var(--danger);}
	.cv-pill-amber{background:var(--warning-soft);color:var(--warning);}

	.cv-side-stat{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:16px 18px;display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
	.cv-side-stat-icon{width:40px;height:40px;border-radius:10px;background:var(--primary-soft);color:var(--primary-dark);display:flex;align-items:center;justify-content:center;font-size:17px;}
	.cv-side-stat h4{margin:0 0 2px 0;font-size:15px;font-weight:700;}
	.cv-side-stat p{margin:0;font-size:12.5px;color:var(--text-muted);}

	.card{border-radius:var(--radius-sm);padding:12px 14px;background:var(--surface);border:1px solid var(--border);box-shadow:none;margin-bottom:10px;}
	.card-date{background:var(--primary-soft);color:var(--primary-dark);padding:2px 10px;border-radius:20px;font-size:11.5px;font-weight:600;border:none;}
	.card-title{padding:8px 0 2px 0;margin:0;font-size:17px;font-weight:700;font-family:'Inter',sans-serif;display:block;}
	.card-user-name{float:right;background:var(--warning-soft);color:var(--warning);padding:2px 10px;border-radius:20px;font-size:11.5px;font-weight:600;border:none;}
	.card-body{display:flex;align-items:center;width:100%;justify-content:space-between;flex-direction:column-reverse;}
	.qte-gadget{display:inline;background:var(--surface-alt);border:1px solid var(--border);border-radius:50px;font-size:22px;font-weight:700;padding:4px 12px;}
	.all-cards{height:auto;overflow:auto;}

	.nav-tabs-custom{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;margin-bottom:16px;}
	.nav-tabs-custom>.nav-tabs{border-bottom:1px solid var(--border);background:var(--surface-alt);margin:0;padding:0 8px;}
	.nav-tabs-custom>.nav-tabs>li>a{color:var(--text-muted);font-weight:600;font-size:14px;border:none!important;border-radius:0!important;padding:14px 16px;background:transparent!important;}
	.nav-tabs-custom>.nav-tabs>li.active>a{color:var(--primary-dark);background:var(--surface)!important;border-bottom:2px solid var(--primary)!important;}
	.nav-tabs-custom .tab-content{padding:18px;}

	.timeline{list-style:none;padding:0;margin:0;position:relative;}
	.timeline:before{content:"";position:absolute;top:0;bottom:0;left:18px;width:2px;background:var(--border);}
	.timeline>li{position:relative;margin-bottom:14px;list-style:none;}
	.timeline>li.time-label{display:flex;align-items:center;gap:10px;margin:18px 0 12px 0;}
	.timeline>li.time-label:first-child{margin-top:0;}
	.timeline>li.time-label>span.bg-red{background:var(--text)!important;color:#fff;font-weight:700;font-size:12.5px;padding:5px 12px;border-radius:999px;}
	.timeline>li.time-label>span.bg-green{background:var(--success-soft)!important;color:var(--success)!important;font-weight:700;font-size:12px;padding:5px 12px;border-radius:999px;}
	.timeline>li>.fa.bg-blue{position:absolute;left:9px;top:4px;width:20px;height:20px;border-radius:50%;background:var(--primary)!important;color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;z-index:2;}
	.timeline-item{margin-left:46px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:14px 16px;position:relative;}
	.timeline-item>.time{float:right;color:var(--text-muted);font-size:12.5px;font-weight:600;}
	.timeline-header{font-size:16px!important;font-weight:700!important;margin:0 0 8px 0;color:var(--text);}
	.timeline-body{font-size:13.5px;color:var(--text);border-top:1px solid var(--border);padding-top:10px;margin-top:4px;}
	.timeline-footer{border-top:1px solid var(--border);margin-top:10px;padding-top:10px;display:flex;align-items:center;}

	.objet{padding:0px;float:left;width:auto;margin-right:3px;margin-left:0px;}
	.objet .optionh{min-width:80px;width:auto;float:left;border-radius:5px;padding:2px 0px 2px 5px;color:#fff;background:var(--primary);z-index:99;position:relative;}
	.objet .optionh .fa{float:right;height:100%;width:25px;text-align:center;line-height:20px;border-left:1px solid;padding:2px;cursor:pointer;margin-left:2px;}
	.objet .optionb{min-width:80px;width:auto;left:0px;border-radius:5px;padding:7px 8px;margin-top:20px;margin-bottom:4px;display:none;background:var(--primary-dark);list-style:none;color:#fff;position:relative;z-index:9;}
	.objet .optionb li{color:#fff;}

	.client-view body{padding-right:0px!important;}
	.client-view .nopad{padding-left:0!important;margin:11px 2px;padding-right:0!important;}
	.image-checkbox{cursor:pointer;margin-bottom:0;outline:0;}
	.blocker{z-index:1039;}
	#gadget_modal{overflow:initial;}
	.client-view .p-0{padding:0;}
	.client-view .pl-0{padding-left:0;}
	.client-view .detail_viste{max-height:829px;overflow-y:scroll;}
	.client-view .box{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);margin-bottom:16px;}
	.client-view .box-header{padding:14px 18px;border-bottom:1px solid var(--border);}
	.client-view .box-title{font-size:15px;font-weight:700;margin:0;}
	.client-view .box-body{padding:16px 18px;}
	.client-view .modal-header{background:var(--primary-dark)!important;}
	.client-view .modal-content{border-radius:var(--radius);}
	.client-view #map-canvas,.client-view #maap-canvas{border-radius:var(--radius-sm);overflow:hidden;border:1px solid var(--border);}

	/* ============================================================
	   Organized "field row" override for the Les appels / Stock
	   temps réel tabs. These target the existing hand-floated
	   label/value markup by its literal inline-style fingerprint,
	   so no PHP or HTML structure needs to change.
	   ============================================================ */
	.client-view .tab-pane .col-xs-12[style*="padding:0px;margin: 6px 0px;"]{
		display:flex!important;flex-wrap:wrap;align-items:baseline!important;
		gap:4px 10px;padding:10px 14px!important;margin:0!important;
		border-bottom:1px solid var(--border);font-size:13.5px;float:none!important;width:100%!important;
	}
	.client-view .tab-pane .col-xs-12[style*="padding:0px;margin: 6px 0px;"]:last-child{border-bottom:none;}
	.client-view .tab-pane .col-xs-12[style*="padding:0px;margin: 6px 0px;"] > b[style*="width: 248px"]{
		float:none!important;width:auto!important;margin-right:0!important;
		color:var(--text-muted)!important;font-weight:600!important;font-size:12.5px!important;
		text-transform:uppercase;letter-spacing:.02em;flex:0 0 auto;
	}
	.client-view .tab-pane .col-xs-12[style*="padding:0px;margin: 6px 0px;"] > b[style*="width: 248px"] > b[style*="float:right"]{
		display:none!important;
	}
	.client-view .tab-pane .col-xs-12[style*="padding:0px;margin: 6px 0px;"]::after{
		content:"";flex:1 1 auto;order:1;
	}
	.client-view .tab-pane .col-md-6[style*="border-left"]{
		border-left:1px solid var(--border)!important;
	}

	/* Pills used inside those rows (Objections / Réclamations / Qualifications) */
	.client-view .tab-pane .label.label-primary{
		display:inline-block!important;float:none!important;margin:2px 4px 2px 0!important;
		background:var(--primary-soft)!important;color:var(--primary-dark)!important;
		border-radius:999px!important;padding:3px 11px!important;font-size:12px!important;font-weight:700!important;
	}
	.client-view .tab-pane .timeline-header + .label.label-primary{
		margin-left:0!important;background:var(--surface-alt)!important;color:var(--text)!important;
	}
	.client-view .badge.badge-pill.badge-info{
		background:var(--primary-soft)!important;color:var(--primary-dark)!important;
		border-radius:999px!important;font-weight:700!important;padding:5px 12px!important;font-size:12px!important;
	}

	/* Grid modals (Objections / Veille / Concurrence popups) */
	#myModal .modal-header,#myModal1 .modal-header,#myModal2 .modal-header{
		background:var(--primary-dark)!important;
	}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="client-view">

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

<!-- ============================================================
     Stat cards: visites / retards / action en cours
     ============================================================ -->
<div class="cv-stats">

	<div class="cv-stat cv-blue">
		<div class="cv-stat-top">
			<div>
				<p class="cv-stat-value"><?php
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
				<p class="cv-stat-label">Nombre de visites</p>
			</div>
			<div class="cv-stat-icon"><i class="fa fa-eye"></i></div>
		</div>
		<div style="margin-top:10px;">
			<button type="button" onclick="boxtog(1)" class="cv-stat-toggle" title="Plus de détails"><i id="icon1" class="fa fa-plus"></i></button>
		</div>
		<div class="box-body box1 cv-stat-detail">
			<?php
			foreach ($details as $key => $value)
				echo "<i class='fa fa-clock'></i> $value<br>";
			?>
		</div>
	</div>

	<div class="cv-stat cv-<?php
		$dateretard = $this->requestAction('/clients/system_get_retard_list_client/' . $client['Client']['id']);
		$r = $i - $dateretard['nobre'];
		if ($r < 0)
			echo 'red';
		else
			echo 'green';
		?>">
		<div class="cv-stat-top">
			<div>
				<p class="cv-stat-value">
					<?php
					echo $r;
					unset($dateretard['nobre']);
					?>
				</p>
				<p class="cv-stat-label">Nombre de retards</p>
			</div>
			<div class="cv-stat-icon"><i class="fa fa-clock-o"></i></div>
		</div>
		<div style="margin-top:10px;">
			<button type="button" onclick="boxtog(2)" class="cv-stat-toggle" title="Plus de détails"><i id="icon2" class="fa fa-plus"></i></button>
		</div>
		<div class="box-body box2 cv-stat-detail">
			<?php
			foreach ($dateretard as $key => $value)
				echo "<i class='fa fa-clock'></i> $value<br>";
			?>
		</div>
	</div>

	<div class="cv-stat cv-amber">
		<div class="cv-stat-top">
			<div>
				<?php
				if (count($client['Action']) == 0) {
					echo '<p class="cv-stat-value">----</p>';
				} else {
					$now = time();
					$your_date = strtotime($client['Action'][0]['date_fin']);
					$datediff = $your_date - $now;
					$j = floor($datediff / (60 * 60 * 24));
					if ($j > 0) {
						echo "<p class=\"cv-stat-value\">$j j</p>";
					} else {
						echo '<p class="cv-stat-value">----</p>';
					}
				}
				?>
				<p class="cv-stat-label">Action en cours</p>
			</div>
			<div class="cv-stat-icon"><i class="fa fa-star"></i></div>
		</div>
	</div>

</div>

<div class="cv-grid">
	<div class="cv-main">

		<!-- ============================================================
		     Profile header
		     ============================================================ -->
		<div class="cv-profile">
			<div class="cv-profile-top">
				<div class="cv-profile-name-row">
					<h1 class="cv-profile-name"><?php echo $client['Client']['nom'] . ' ' . $client['Client']['prenom']; ?></h1>
					<?php if ((AuthComponent::user('role') == 'Admin')) { ?>
						<span class="cv-badge"><?php echo $client['Client']['potentialite']; ?></span>
					<?php } ?>
					<?php
					if ($client['Type']['name'] == 'Pharmacie') {
						echo '<span class="cv-badge">CA : ' . $client['Client']['activite'] . '</span>';
					}
					?>
				</div>
				<span class="cv-profile-sexe"><?php
					if ($client['Client']['sexe'] == 'h') {
						echo '<i class="fa fa-user"></i> Homme';
					} elseif ($client['Client']['sexe'] == 'f') {
						echo '<i class="fa fa-user"></i> Femme';
					}
					?></span>
			</div>

			<div class="cv-profile-actions">
				<?php
				if ($this->requestAction('/droits/getrole/visites/add') == 1)
					echo $this->Html->link(__('Visiter'), array('controller' => 'visites', 'action' => 'add', $client['Client']['id']), array("class" => "cv-btn cv-btn-onprofile"));
				if ($this->requestAction('/droits/getrole/actions/add') == 1)
					echo $this->Html->link(__('Demander une action'), array('controller' => 'actions', 'action' => 'add', $client['Client']['id']), array("class" => "cv-btn cv-btn-onprofile"));
				if ($this->requestAction('/droits/getrole/packs/add') == 1)
					echo $this->Html->link(__('Ajouter un pack'), array('controller' => 'packs', 'action' => 'add', $client['Client']['id']), array("class" => "cv-btn cv-btn-onprofile"));
				if ($this->requestAction('/droits/getrole/clients/remettre0') == 1)
					echo $this->Html->link(__('Remettre à 0'), array('action' => 'remettre0', $client['Client']['id']), array("class" => "cv-btn cv-btn-onprofile"));
				if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
					<a href="#gadget_modal" rel="modal:open" class="cv-btn cv-btn-warning btn-gadget">Ajouter gadget</a>
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

		<!-- ============================================================
		     Info card (details + coordonnées)
		     ============================================================ -->
		<div class="cv-card">
			<?php if ($client['Type']['name'] == 'Médecin' || $client['Type']['id'] == '5') { ?>
				<div class="cv-info-columns">
					<div class="cv-info-col">
						<div class="cv-info-row">
							<span class="cv-info-label">Code</span>
							<span class="cv-info-value"><?php
								$typ = substr($client['Category']['name'], 0, 3);
								$typ = strtoupper($typ);
								echo $client['Secteur']["code_region"] . $client['Secteur']["code_ville"] . $client['Secteur']["code_secteur"] . $typ . $client['Client']['id'];
								?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Type</span>
							<span class="cv-info-value"><?php echo $client['Type']['name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Secteur</span>
							<span class="cv-info-value"><?php echo $client['Secteur']['full_name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Catégorie</span>
							<span class="cv-info-value"><?php echo $client['Category']['name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Tendance</span>
							<span class="cv-info-value"><?php echo $client['Category1']['name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Titre</span>
							<span class="cv-info-value"><?php echo h($client['Client']['titre']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Activité</span>
							<span class="cv-info-value"><?php echo h($client['Client']['activite']); ?></span>
						</div>
						<?php if (!empty($client['Hopital']['name'])): ?>
							<div class="cv-info-row">
								<span class="cv-info-label">Hôpital</span>
								<span class="cv-info-value"><?php echo h($client['Hopital']['name']); ?></span>
							</div>
						<?php endif; ?>
						<div class="cv-info-row">
							<span class="cv-info-label">Exercice</span>
							<span class="cv-info-value"><?php echo h($client['Client']['exercice']); ?></span>
						</div>
					</div>
					<div class="cv-info-col">
						<div class="cv-info-row">
							<span class="cv-info-label">GSM</span>
							<span class="cv-info-value"><?php echo h($client['Client']['tel']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">E-mail</span>
							<span class="cv-info-value"><?php echo h($client['Client']['mail']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Fixe</span>
							<span class="cv-info-value"><?php echo h($client['Client']['fixe']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Fax</span>
							<span class="cv-info-value"><?php echo h($client['Client']['fax']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Adresse</span>
							<span class="cv-info-value"><?php echo h($client['Client']['adress']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Date de recrutement</span>
							<span class="cv-info-value"><?php
								$cc = explode(' ', $client['Client']['created']);
								echo $cc[0];
								?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Vendeurs</span>
							<span class="cv-info-value">
								<button class="cv-vendor-btn" data-toggle="modal" data-target="#popup_vendor">
									<i class="fa fa-users"></i>
									<span class="count_vd"><?php echo count($vendeurs ?? []); ?></span>
								</button>
							</span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Remarque</span>
							<span class="cv-info-value"><?php echo $client['Client']['rmq']; ?></span>
						</div>
					</div>
				</div>
			<?php
			} else {
			?>
				<div class="cv-info-columns">
					<div class="cv-info-col">
						<div class="cv-info-row">
							<span class="cv-info-label">Code Wavesoft</span>
							<span class="cv-info-value"><?php echo $client['Client']['code_wavsoft']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Client de centre d'appel</span>
							<span class="cv-info-value"><?php
								$clientcall = array("0" => "Non", "1" => "Oui");
								echo $clientcall[$client['Client']['client_call']]; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Type</span>
							<span class="cv-info-value"><?php echo $client['Type']['name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Dirigeant</span>
							<span class="cv-info-value"><?php echo $client['Client']['dirigent']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Secteur</span>
							<span class="cv-info-value"><?php echo $client['Secteur']['full_name']; ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Adresse</span>
							<span class="cv-info-value"><?php echo h($client['Client']['adress']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Date de recrutement</span>
							<span class="cv-info-value"><?php echo h($client['Client']['date_recrutement']); ?></span>
						</div>
					</div>
					<div class="cv-info-col">
						<div class="cv-info-row">
							<span class="cv-info-label">GSM</span>
							<span class="cv-info-value"><?php echo h($client['Client']['tel']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">E-mail</span>
							<span class="cv-info-value"><?php echo h($client['Client']['mail']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Fixe</span>
							<span class="cv-info-value"><?php echo h($client['Client']['fixe']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Fax</span>
							<span class="cv-info-value"><?php echo h($client['Client']['fax']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Présentoir</span>
							<span class="cv-info-value"><?php echo h($client['Client']['dirigent']); ?></span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Vendeurs</span>
							<span class="cv-info-value">
								<button class="cv-vendor-btn" data-toggle="modal" data-target="#popup_vendor">
									<i class="fa fa-users"></i>
									<span class="count_vd"><?php if (is_array($vendeurs))
																echo count($vendeurs);
															else
																echo "0"; ?></span>
								</button>
							</span>
						</div>
						<div class="cv-info-row">
							<span class="cv-info-label">Remarque</span>
							<span class="cv-info-value"><?php echo $client['Client']['rmq']; ?></span>
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
				<div class="cv-btn-block-group">
					<?php if ($client['Type']['name'] == 'Pharmacie') { ?>
						<button type="button" class="cv-btn cv-btn-primary export-client-btn"
							data-client-id="<?php echo $client['Client']['id']; ?>">
							Exporter
						</button>
					<?php } ?>

					<?php
					if ($this->requestAction('/droits/getrole/clients/edit') == 1)
						echo $this->Html->link(
							'Editer',
							array('action' => 'edit', $client['Client']['id']),
							array('class' => 'cv-btn cv-btn-warning')
						);
					else if ($this->requestAction('/droits/getrole/clientsproposes/edit') == 1)
						echo $this->Html->link(
							'Proposer une modification',
							array('controller' => 'clientsproposes', 'action' => 'edit', $client['Client']['id']),
							array('class' => 'cv-btn cv-btn-warning')
						);
					?>
				</div>
			<?php endif; ?>
		</div>

		<?php if (!empty($client['Action'])): ?>
			<div class="cv-card">
				<div class="cv-card-header">
					<h3 class="cv-card-title">Historique des actions</h3>
				</div>
				<div class="cv-card-body" style="padding:0;">
					<table class="cv-table">
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
											echo '<span class="cv-pill cv-pill-amber">Prochainement</span>';
										else if ($j >= 0)
											echo '<span class="cv-pill cv-pill-green">En cours</span>';
										else
											echo '<span class="cv-pill cv-pill-red">Terminé</span>';
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
			<div class="cv-card">
				<div class="cv-card-header">
					<h3 class="cv-card-title">La liste des affectations</h3>
				</div>
				<div class="cv-card-body" style="padding:0;">
					<table class="cv-table">
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
					<div class="cv-card-body" style="display:flex;gap:16px;flex-wrap:wrap;align-items:flex-end;border-top:1px solid var(--border);">
						<div style="flex:1 1 220px;">
							<label for="regions" style="display:block;font-size:13px;font-weight:600;color:var(--text-muted);margin-bottom:6px;">VMP</label>
							<select class="form-control" id="regions">
								<option value="0">Choisissez un VMP</option>
								<?php foreach ($users as $userid => $username) { ?>
									<option value="<?php echo $userid; ?>"><?php echo $username; ?></option>
								<?php } ?>
							</select>
						</div>
						<div style="flex:1 1 220px;" id="ville"></div>
						<?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'cv-btn cv-btn-primary submit', 'div' => false)); ?>
					</div>
				<?php //endif;    
				?>

			</div>
		<?php endif; ?>
	</div>
	<!-- ./cv-main -->

	<!-- ============================================================
	     Sidebar
	     ============================================================ -->
	<div class="cv-side">
		<div class="cv-side-stat">
			<div>
				<h4><?php
					if (!empty($client['Visite']))
						echo strftime("%A %d-%m-%Y", strtotime($client['Visite'][0]['date']));
					else
						echo '---';
					?></h4>
				<p>Date dernière visite</p>
			</div>
			<div class="cv-side-stat-icon"><i class="fa fa-calendar"></i></div>
		</div>

		<?php if ($this->requestAction('/droits/getrole/gadgetclients/add') == 1): ?>
			<div class="cv-card">
				<div class="cv-card-header">
					<h3 class="cv-card-title">Gadgets</h3>
				</div>
				<div class="cv-card-body all-cards">
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
									<div style="margin-top:8px;">
										<?php echo $this->Html->link("Supprimer", array("controller" => "gadgetclients", "action" => "supprimer", $gadget['Gadgetclient']['id']), array('class' => 'cv-btn cv-btn-warning', 'style' => 'padding:5px 12px;font-size:12px;')); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- ./cv-side -->
</div>
<!-- ./cv-grid -->


<div class="cv-grid">
	<div class="cv-main" style="flex-basis:100%;">
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
							<li class="time-label">
								<span class="bg-red"><?php echo strftime("%A %d-%m-%Y", strtotime($visite['date'][0])); ?></span>
								<span class="bg-green"><?php echo $visite["timer"]; ?></span>
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
									<span class="bg-light-blue" style="float:right;padding:2px 6px;border-radius:5px;font-size:15px;margin-right:3px;line-height:27px;text-shadow:0px 1px 1px rgba(0,0,0,0.95);font-weight:bold;box-shadow:inset 1px 1px 3px rgba(101,101,101,0.65);color:#fff;margin-top:3px;">
										<i class="material-icons"><?php echo ($visite['type_visite'] == 'solo') ? 'person' : 'people'; ?></i>
										<?php echo $visite['type_visite']; ?>
									</span>
									<h3 class="timeline-header"><?php echo $user; ?></h3>
                                    <div class="timeline-body">
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
									<div class="timeline-footer">
										<?php if ($this->requestAction('/droits/getrole/visites/edit') == 1): ?>
											<a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'edit', $visite['id'])); ?>" title="Editer"><i class="fa fa-edit"></i></a>
										<?php endif;
										if ($this->requestAction('/droits/getrole/visites/archive') == 1): ?>
											<a class="btn btn-danger btn-xs" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'archive', $visite['id'], 0)); ?>" title="Archive"><i class="fa fa-archive"></i></a>
										<?php endif; ?>
										&nbsp;
										<?php
										if (!empty($visite['latitude']) && AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") {
											$pos = strpos($visite['longitude'], "n");
											$poss = strpos($visite['longitude'], "0.0");
											if (!empty($visite['longitude']) && $pos === false && $poss === false) {
												echo '<a data-toggle="modal" onclick="clikgeo(' . $ii . ')" data-target="#myModalmap" class="btn btn-info btn-xs" style="float:right;background:#e2141e;font-size:14px;padding:1px 8px;" title="Position visite"><input type="hidden" class="latc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['longitude']) . '"><input type="hidden" class="lengc' . $ii . '" value="' . str_replace(",", ".", $client['Client']['latitude']) . '"><input type="hidden" class="latv' . $ii . '" value="' . str_replace(",", ".", $visite['latitude']) . '"><input type="hidden" class="lengv' . $ii . '" value="' . str_replace(",", ".", $visite['longitude']) . '"><i class="fa fa-map-marker"></i></a>';
											}
										}
										?>
									</div>
								</div>
							</li>
							<?php
								$ii++;
							endforeach;
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
															</b><span class="cv-pill cv-pill-green"
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
if (!empty($client['Commande'])): ?>
	<div class="cv-card">
		<div class="cv-card-header">
			<h3 class="cv-card-title"><?php echo __('Commandes'); ?></h3>
		</div>
		<div class="cv-card-body" style="padding:0;">
			<table class="cv-table">
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
								<?php echo $this->Html->link(__('Visualiser'), array('controller' => 'commandes', 'action' => 'view', $commande['id']), array('class' => 'cv-btn cv-btn-onprofile', 'style' => 'background:var(--primary-soft);color:var(--primary-dark);border-color:transparent;')); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur' && AuthComponent::user('role') != "Super viseur") { ?>
	<div class="cv-card">
		<div class="cv-card-header">
			<h3 class="cv-card-title">La liste des visites sur map</h3>
		</div>
		<div class="cv-card-body">
			<div id="maap-canvas" style="min-height: 400px;"></div>
		</div>
	</div>
<?php } ?>

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
						<table class="cv-table">
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
		<input type="submit" value="Envoyer" class="cv-btn cv-btn-primary">
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q&amp;"></script>
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
