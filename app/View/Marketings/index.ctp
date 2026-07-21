<?php echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('select2.min');

echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>
<style type="text/css">
	/* only the bits Metronic doesn't already give us */
	.hide_element,
	.removed-div,
	.content-historique { display: none; }

	.select2-search__field { width: 10% !important; }

	.consommation-pill { cursor: pointer; }
	.metric-chart { height: 190px; }

	/* ---------- header row details (icon + light-border controls) ---------- */
	.mk-icon-badge {
		width: 34px; height: 34px; border-radius: 10px;
		background: #EEEAFF; color: #8c7ef2;
		display: inline-flex; align-items: center; justify-content: center;
		flex-shrink: 0;
	}
	.mk-icon-badge svg { width: 17px; height: 17px; }

	.mk-field { position: relative; }
	.mk-field .mk-field-icon {
		position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
		color: #b9b9c9; pointer-events: none; display: flex;
	}
	.mk-field .mk-field-icon svg { width: 14px; height: 14px; }
	.mk-field select,
	.mk-field input.form-control,
	.mk-field .select2-selection {
		border: 1px solid #ececf5 !important;
		border-radius: 10px !important;
		background: #ffffff !important;
		box-shadow: none !important;
	}
	.mk-field select { padding-left: 34px !important; }
	.mk-field .select2-selection { padding-left: 34px !important; min-height: 42px !important; }

	.btn-mk-search {
		background: linear-gradient(135deg, #8f7cf6 0%, #6c5ce7 100%) !important;
		border: none !important; color: #fff !important; border-radius: 10px !important;
		font-weight: 600 !important; display: inline-flex !important; align-items: center; gap: 8px;
	}
	.btn-mk-search svg { width: 14px; height: 14px; }

	.btn-mk-add {
		border: 1px solid #ececf5 !important; border-radius: 10px !important;
		color: #44444f !important; background: #fff !important; font-weight: 600 !important;
		display: inline-flex !important; align-items: center; gap: 8px;
	}
	.btn-mk-add svg { width: 13px; height: 13px; color: #8c7ef2; }
</style>

<!-- ============ TOP CARD: title + filters, all in one header row ============ -->
<div class="card mb-5 mb-xl-8">
	<div class="card-header border-0 pt-6 flex-wrap gap-3 align-items-center">
		<div class="card-title align-items-center gap-3">
			<span class="mk-icon-badge">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11v3a1 1 0 0 0 1 1h1l3 4h2l-1-5"/><path d="M18 4c2.5 1.5 4 4 4 7s-1.5 5.5-4 7"/><path d="M11 5 21 3v14l-10-2"/><path d="M4 9h4v6H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2z"/></svg>
			</span>
			<h3 class="fw-bold m-0"><?php echo __('Marketings'); ?></h3>
		</div>

		<div class="card-toolbar flex-wrap gap-3 align-items-center">

			<div class="mk-field">
				<span class="mk-field-icon">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
				</span>
				<select id="date_programming" class="form-select w-125px">
					<?php for ($i = date("Y") - 3; $i < date("Y") + 2; $i++) : ?>
						<option <?php if ($annee == $i) echo 'selected="selected"'; ?>><?= $i ?></option>
					<?php endfor; ?>
				</select>
			</div>

			<div class="mk-field w-300px">
				<span class="mk-field-icon">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</span>
				<?php echo $this->Form->input("games", array(
					"label" => false,
					"class" => "form-select select2",
					"multiple" => "multiple",
					"placeholder" => "Rechercher un marketing, une gamme..."
				)); ?>
			</div>

			<button id="redirectButton" class="btn btn-mk-search px-5 py-3">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				Rechercher
			</button>

			<?php if ($this->requestAction('/droits/getrole/marketings/add') == 1) : ?>
				<?php echo $this->Html->link(
					'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Ajouter',
					array('action' => 'add'),
					array('class' => 'btn btn-mk-add px-4 py-3', 'escape' => false)
				); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
$k = $e = $a = $p = $ca = $bu = 0;
$por_echant_array = [];
$por_action_array = [];
$por_pack_array = [];
$por_ca_array = [];
$por_budget_array = [];
$incret = 0;

// metric config: [array key prefix, chart-div prefix, metronic color, label]
$metrics = [
	'echantillon' => array('key' => 'echantillons', 'color' => 'primary', 'label' => 'ECHANTILLONS', 'svg' => '<path d="M9 3h6a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/><path d="M8 4H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2"/><line x1="8" y1="11" x2="16" y2="11"/><line x1="8" y1="15" x2="16" y2="15"/>'),
	'action'      => array('key' => 'actions',     'color' => 'info',    'label' => 'ACTIONS',      'svg' => '<circle cx="12" cy="12" r="8.5"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/>'),
	'pack'        => array('key' => 'packs',        'color' => 'success', 'label' => 'PACKS',        'svg' => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/>'),
	'ca'          => array('key' => 'ca',            'color' => 'danger',  'label' => 'BOITES VENDUES', 'svg' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>'),
	'budget'      => array('key' => 'budget',        'color' => 'warning', 'label' => 'BUDGET',       'svg' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'),
];
?>

<?php foreach ($marketings as $user => $ligness) :
	$por_ca = 0;
	$por_budget = 0;
	$por_all_echantiant = $por_echantiant = $por_unique_action = $por_all_action = $por_unique_pack = $por_all_pack = $por_all_ca = $por_unique_ca = $por_unique_budget = $por_all_budget = 0;

	foreach ($ligness as $ligne => $gammess) :
		$point = 0;
		foreach ($gammess as $gamme => $data) :
?>
			<div class="<?php if ($point != 0) echo "removed-div"; ?>">
				<?php if ($point == 0) :
					if (!isset($users[$user])) $users[$user] = "Globale";
				?>
					<h2 class="fw-bold mb-1"><?php echo $users[$user]; ?></h2>
					<div class="text-muted fs-7 mb-5">Vue d'ensemble des performances marketing</div>
				<?php endif; ?>

				<div class="row row-cols-1 row-cols-md-3 row-cols-xl-5 g-5 g-xl-8 mb-5">
					<?php
					$por_echantiant += (int)($data["echantillons_c"] ?? 0);
					$por_all_echantiant += (int)($data["echantillons"] ?? 0);
					$por_unique_action += $data["actions_c"];
					$por_all_action += $data["actions"];
					$por_unique_pack += $data["packs_c"];
					$por_all_pack += $data["packs"];
					$por_unique_ca += $data["ca_c"];
					$por_all_ca += $data["ca"];
					$por_unique_budget += $data["budget_c"];
					$por_all_budget += $data["budget"];

					$chart_index = array('echantillon' => $e, 'action' => $a, 'pack' => $p, 'ca' => $ca, 'budget' => $bu);

					foreach ($metrics as $slug => $m) :
					?>
						<div class="col">
							<div class="card card-xl-stretch">
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="symbol symbol-30px symbol-circle bg-light-<?php echo $m['color']; ?> me-2">
											<span class="svg-icon svg-icon-3 text-<?php echo $m['color']; ?> d-flex align-items-center justify-content-center h-100">
												<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $m['svg']; ?></svg>
											</span>
										</span>
										<span class="card-label fw-bold fs-6 mt-2"><?php echo $m['label']; ?></span>
									</h3>
								</div>
								<div class="card-body d-flex flex-column pt-0">
									<div id="chart_<?php echo $slug . '_' . $chart_index[$slug]; ?>" class="metric-chart"></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
	<?php
			$point++;
		endforeach;

		$por_echant_all = $por_all_echantiant != 0 ? round(($por_echantiant * 100 / $por_all_echantiant), 2) : 0;
		array_push($por_echant_array, $por_echant_all);

		$por_action_all = $por_all_action != 0 ? round(($por_unique_action * 100 / $por_all_action), 2) : 0;
		array_push($por_action_array, $por_action_all);

		$por_pack_all = $por_all_pack != 0 ? round(($por_unique_pack * 100 / $por_all_pack), 2) : 0;
		array_push($por_pack_array, $por_pack_all);

		$por_ca_all = $por_all_ca != 0 ? round(($por_unique_ca * 100 / $por_all_ca), 2) : 0;
		array_push($por_ca_array, $por_ca_all);

		$por_budget_all = $por_all_budget != 0 ? round(($por_unique_budget * 100 / $por_all_budget), 2) : 0;
		array_push($por_budget_array, $por_budget_all);
	endforeach;
	?>

	<div class="card mb-5 mb-xl-8">
		<div class="card-body">
			<table id="marketing_table_<?php echo $incret; ?>" class="table table-row-bordered table-striped align-middle text-center">
				<thead>
					<tr>
						<th style="width: 20px;">#</th>
						<th colspan='2'>-</th>
						<th colspan='2' class="bg-light-primary text-primary">ECHANTILLONS</th>
						<th colspan='2' class="bg-light-info text-info">ACTIONS</th>
						<th colspan='2' class="bg-light-success text-success">PACKS</th>
						<th colspan='2' class="bg-light-danger text-danger">OBJECTIF NBR DE BOÎTES</th>
						<th colspan='2' class="bg-light-warning text-warning">BUDGET MARKETING</th>
					</tr>
					<tr>
						<td>#</td>
						<td style="width: 72px;">Ligne</td>
						<td>Gamme</td>
						<td class="text-primary">Consommation</td>
						<td class="text-primary">%</td>
						<td class="text-info">Consommation</td>
						<td class="text-info">%</td>
						<td class="text-success">Consommation</td>
						<td class="text-success">%</td>
						<td class="text-danger">Consommation</td>
						<td class="text-danger">%</td>
						<td class="text-warning">Consommation</td>
						<td class="text-warning">%</td>
					</tr>
				</thead>
				<tbody>
					<?php $row_number = 1; ?>
					<?php foreach ($ligness as $ligne => $gammess) : ?>
						<?php foreach ($gammess as $gamme => $data) :
							echo "<tr><td>";
							echo $row_number++;
							if ($this->requestAction('/droits/getrole/marketings/edit') == 1 && $users[$user] != 'Globale')
								echo " " . $this->Html->link(__('Editer'), array('action' => 'edit', $data["id"]), array('class' => 'btn btn-sm btn-light-warning', 'style' => 'margin-left:6px;'));
							echo "</td>";
							echo "<td><div style='width: 50px;'>all</div></td>";
							echo "<td>" . $games[$gamme] . "</td>";

							$por = $data["echantillons"] != 0 ? round(($data["echantillons_c"] * 100 / $data["echantillons"]), 2) : 0;
						?>
							<td>
								<div onclick='modalconsomation("<?php echo $k; ?>")' role="button">
									<?php $danger = ($data["echantillons_c"] > $data["echantillons"]) ? 'badge-danger' : 'badge-light-primary'; ?>
									<span class="badge <?php echo $danger; ?> fs-7 py-3 px-4">
										<?php echo number_format($data["echantillons_c"], 0, ',', ' ') . ' / ' . number_format($data["echantillons"], 0, ',', ' '); ?>
									</span>
								</div>
								<div class="content-historique content-historique<?php echo $k++; ?>">
									<table class="table">
										<thead><tr><th>Nom</th><th>Nom d'utilisateur</th><th>Qte</th><th>Date</th></tr></thead>
										<tbody>
											<?php foreach ($data["echantillons_detail"] as $detail) : ?>
												<tr><?php echo "<td>" . $detail['Echantillon']['name'] . "</td><td>" . $detail['Echantillon']['user'] . "</td><td>" . $detail['Echantillon']['quantite'] . "</td><td>" . $detail['Echantillon']['date'] . "</td>"; ?></tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</td>
							<?php
							echo "<td>$por %</td>";
							$por = $data["actions"] != 0 ? round(($data["actions_c"] * 100 / $data["actions"]), 2) : 0;
							?>
							<td>
								<div onclick='modalconsomation("<?php echo $k; ?>")' role="button">
									<?php $danger = ($data["actions_c"] > $data["actions"]) ? 'badge-danger' : 'badge-light-info'; ?>
									<span class="badge <?php echo $danger; ?> fs-7 py-3 px-4">
										<?php echo number_format($data["actions_c"], 0, ',', ' ') . ' / ' . number_format($data["actions"], 0, ',', ' '); ?>
									</span>
								</div>
								<div class="content-historique content-historique<?php echo $k++; ?>">
									<table class="table">
										<thead><tr><th>Nom d'utilisateur</th><th>Client</th><th>Pot</th><th>Valeur</th><th>Nature</th><th>Description</th></tr></thead>
										<tbody>
											<?php foreach ($data["action_detail"] as $detail) : ?>
												<tr><?php echo "<td>" . $detail['user_name'] . "</td><td>" . $detail['client'] . "</td><td>" . $detail['pot'] . "</td><td>" . $detail['valeur'] . "</td><td>" . $detail['nature'] . "</td><td>" . $detail['description'] . "</td>"; ?></tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</td>
							<?php
							echo "<td>$por %</td>";
							$por = $data["packs"] != 0 ? round(($data["packs_c"] * 100 / $data["packs"]), 2) : 0;
							?>
							<td>
								<div onclick='modalconsomation("<?php echo $k; ?>")' role="button" style="display:inline-block;">
									<?php $danger = ($data["packs_c"] > $data["packs"]) ? 'badge-danger' : 'badge-light-success'; ?>
									<span class="badge <?php echo $danger; ?> fs-7 py-3 px-4">
										<?php echo number_format($data["packs_c"], 0, ',', ' ') . ' / ' . number_format($data["packs"], 0, ',', ' '); ?>
									</span>
								</div>
								<div class="content-historique content-historique<?php echo $k++; ?>">
									<table class="table">
										<thead><tr><th>Utilisateur</th><th>Client</th><th>Nombre</th></tr></thead>
										<tbody>
											<?php foreach ($data["pack_detail"] as $detail) : ?>
												<tr><?php echo "<td>" . $detail["user_name"] . "</td><td>" . $detail["client"] . "</td><td>" . $detail["nombre"] . "</td>"; ?></tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</td>
							<?php
							echo "<td>$por %</td>";
							$por = $data["ca"] != 0 ? round(($data["ca_c"] * 100 / $data["ca"]), 2) : 0;
							?>
							<td style="width: 188px;">
								<div onclick='modalconsomation("<?php echo $k; ?>")' role="button" style="display:inline-block;">
									<?php $danger = ($data["ca_c"] > $data["ca"]) ? 'badge-danger' : 'badge-light-danger'; ?>
									<span class="badge <?php echo $danger; ?> fs-7 py-3 px-4">
										<?php echo number_format($data["ca_c"], 0, ',', ' ') . ' / ' . number_format($data["ca"], 0, ',', ' '); ?>
									</span>
								</div>
								<button class="btn btn-icon btn-sm btn-light-danger rounded-circle ms-1" onclick='editconsomation(<?php echo $data["id"]; ?>,"ca")' type='button' title='Ajouter'>+</button>
								<div class="content-historique content-historique<?php echo $k++; ?>">
									<table class="table">
										<thead><tr><th>Vm</th><th>Consomation</th><th>Mois</th><th>Commentaire</th></tr></thead>
										<tbody>
											<?php foreach ($data["detail"] as $detail) : if ($detail["type"] == "ca") : ?>
												<tr><?php echo "<td>" . $users[$detail["vm"]] . "</td><td>" . $detail["consomation"] . "</td><td>" . $detail["mois"] . "</td><td>" . $detail["commentaire"] . "</td>"; ?></tr>
											<?php endif; endforeach; ?>
										</tbody>
									</table>
								</div>
							</td>
							<?php
							echo "<td>$por %</td>";
							$por = $data["budget"] != 0 ? round(($data["budget_c"] * 100 / $data["budget"]), 2) : 0;
							?>
							<td style="width: 188px;">
								<div onclick='modalconsomation("<?php echo $k; ?>")' role="button" style="display:inline-block;">
									<?php $danger = ($data["budget_c"] > $data["budget"]) ? 'badge-danger' : 'badge-light-warning'; ?>
									<span class="badge <?php echo $danger; ?> fs-7 py-3 px-4">
										<?php echo number_format($data["budget_c"], 0, ',', ' ') . ' / ' . number_format($data["budget"], 0, ',', ' '); ?>
									</span>
								</div>
								<button class="btn btn-icon btn-sm btn-light-warning rounded-circle ms-1" onclick='editconsomation(<?php echo $data["id"]; ?>,"budget")' type='button' title='Ajouter'>+</button>
								<div class="content-historique content-historique<?php echo $k++; ?>">
									<table class="table">
										<thead><tr><th>Vm</th><th>Consomation</th><th>Mois</th><th>Commentaire</th></tr></thead>
										<tbody>
											<?php foreach ($data["detail"] as $detail) : if ($detail["type"] == "budget") : ?>
												<tr><?php echo "<td>" . $users[$detail["vm"]] . "</td><td>" . $detail["consomation"] . "</td><td>" . $detail["mois"] . "</td><td>" . $detail["commentaire"] . "</td>"; ?></tr>
											<?php endif; endforeach; ?>
										</tbody>
									</table>
								</div>
							</td>
							<?php
							echo "<td>$por %</td>";
							echo "</tr>";
							$i++;
						endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php
	$e++; $a++; $p++; $ca++; $bu++; $incret++;
endforeach;
?>

<!-- ============ MODALS (unchanged, Metronic's bootstrap modal already styles these) ============ -->
<div class="modal fade" id="editconsomatiomodal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
				echo $this->Form->create('Marketing', array("url" => array("action" => "ajouter_consomation")));
				echo $this->Form->hidden('marketing_id', array('id' => "marketing_id"));
				echo $this->Form->hidden('type', array('id' => "type"));
				echo $this->Form->input('vm', array("options" => $users, 'class' => 'form-select'));
				$mois = array("Janvier" => "Janvier", "Fevrier" => "Fevrier", "Mars" => "Mars", "Avril" => "Avril", "Mai" => "Mai", "Juin" => "Juin", "Juillet" => "Juillet", "Aout" => "Aout", "Septembre" => "Septembre", "Octobre" => "Octobre", "Novembre" => "Novembre", "Decembre" => "Decembre");
				echo $this->Form->input('mois', array("options" => $mois, 'class' => 'form-select'));
				echo $this->Form->input('consomation', array('type' => 'number', 'autocomplete' => "off", 'class' => 'form-control', 'placeholder' => 'consomation', 'value' => '0'));
				echo $this->Form->input('commentaire', array('class' => 'form-control', 'autocomplete' => "off", 'placeholder' => 'commentaire', 'value' => ''));
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Envoyer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalconsomation" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Historique de consommation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body modal-historique"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
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
<script>
	$(function() {
		$('[id^="marketing_table"]').DataTable({
			"paging": false, "lengthChange": false, "searching": true, "ordering": false,
			"info": false, "autoWidth": true, "bSort": false, "iDisplayLength": 250, "aaSorting": [],
			"language": {
				"sProcessing": "Traitement en cours...", "sSearch": "Rechercher&nbsp;:",
				"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)", "sInfoPostFix": "",
				"sLoadingRecords": "Chargement en cours...", "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": { "sFirst": "Premier", "sPrevious": "Pr&eacute;c&eacute;dent", "sNext": "Suivant", "sLast": "Dernier" },
				"oAria": { "sSortAscending": ": activer pour trier la colonne par ordre croissant", "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant" }
			},
			dom: 'Bfrtip',
			buttons: [{ extend: 'excel', text: 'Exporter Excel' }]
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#MarketingConsomation').val('');
		$('#MarketingCommentaire').val('');
	});

	function modalconsomation(id) {
		$('#modalconsomation').modal('show');
		$('.modal-historique').empty();
		var newhistorique = $('.content-historique' + id).html();
		$('.modal-historique').html(newhistorique);
	}

	function editconsomation(id, type) {
		$('#MarketingConsomation').val('');
		$('#MarketingCommentaire').val('');
		$('#editconsomatiomodal').modal('show');
		$("#marketing_id").val(id);
		$("#type").val(type);
	}
</script>

<?php echo $this->Html->script('jquery-3.4.1.min'); ?>
<script>
	var jqNew = jQuery.noConflict();
	jqNew(function() {});
</script>

<?php echo $this->Html->script('apexcharts'); ?>
<script type="text/javascript">
	jqNew(document).ready(function() {
		var bu = <?php echo $bu; ?>;

		function renderRadial(prefix, dataArray, color, label) {
			for (var i = 0; i < bu; i++) {
				var options = {
					series: [dataArray[i]],
					colors: [color],
					chart: { height: 190, type: 'radialBar' },
					plotOptions: {
						radialBar: {
							hollow: { size: '68%' },
							dataLabels: {
								name: { fontSize: '12px', fontWeight: 600 },
								value: { fontSize: '20px', fontWeight: 700, offsetY: 6 }
							}
						}
					},
					labels: [label]
				};
				var el = document.querySelector("#chart_" + prefix + "_" + i);
				if (el) new ApexCharts(el, options).render();
			}
		}

		renderRadial('echantillon', [<?php echo implode(",", $por_echant_array); ?>], '#8c7ef2', 'ECHANTILLONS');
		renderRadial('action', [<?php echo implode(",", $por_action_array); ?>], '#4FA8E0', 'ACTIONS');
		renderRadial('pack', [<?php echo implode(",", $por_pack_array); ?>], '#34C77B', 'PACKS');
		renderRadial('ca', [<?php echo implode(",", $por_ca_array); ?>], '#E8578F', 'BOITES VENDUES');
		renderRadial('budget', [<?php echo implode(",", $por_budget_array); ?>], '#F0784A', 'BUDGET');
	});
</script>

<script>
	$('.select2').select2();
	document.getElementById('redirectButton').addEventListener('click', function() {
		var selectedYear = document.getElementById('date_programming').value;
		var selectedGames = Array.from(document.querySelector('.select2').selectedOptions).map(option => option.value);

		if (selectedYear) {
			var url = '<?php echo $this->Html->url(array("action" => "index")); ?>' + "/index/" + selectedYear + '/' + selectedGames.join(',');
			window.location.href = url;
		} else {
			alert('Veuillez sélectionner une année et des jeux.');
		}
	});
</script>
