<?php debug($result);
debug($supers); ?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>

	<!-- map -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://demo.adminkit.io/css/light.css" rel="stylesheet">

	<style>
		#morocco svg {
			height: 65vh;
		}

		#morocco>div>svg>g:nth-child(2),
		#morocco>div>svg>g:nth-child(4) {
			scale: 1;
			/* translate: 50px; */
		}

		/* @media only screen and (min-width: 767px) and (max-width: 990px) {
			#morocco svg {
				height: 56vh;
			}

			#morocco>div>svg>g:nth-child(2),
			#morocco>div>svg>g:nth-child(4) {
				transform: scale(0.8) translate(14px);
			}
		} */

		@media only screen and (max-width: 600px) {
			#morocco svg {
				height: 47vh;
			}

			/* #morocco>div>svg>g:nth-child(2),
			#morocco>div>svg>g:nth-child(4) {
				scale: 0.7;
				translate: 50px;
			} */
		}
	</style>
</head>

<body>
	<div class="container">

		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div id="morocco"></div>
			</div>
			<div class="col-md-6 col-sm-12">
				chart
			</div>
			<div class="col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title mb-0">Statistiques superviseur</h5>
					</div>
					<table class="table my-0 table-striped table-hover table-bordered">
						<thead class="text-center">
							<tr>
								<th class="d-xxl-table-cell">Nom</th>
								<th>Total visite</th>
								<th>Moyenne du temps d'appel</th>
								<th>Moyenne des heures de travail</th>
								<th>heures debut</th>
								<th>heures fin</th>
								<th class="d-xl-table-cell">Pourcentage visite localisée</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($supers as $key => $super) { ?>
								<tr>
									<td>
										<div class="d-flex">
											<div class="flex-grow-1 ms-3">
												<strong><?php echo $key; ?></strong>
												<div class="text-muted">
													Superviseur
												</div>
											</div>
										</div>
									</td>
									<td>
										<strong><?php echo $super['total_visite']; ?></strong>
									</td>
									<td>
										<strong><?php echo $super['moyenne_time']; ?> min</strong>
									</td>
									<td>
										<strong>
											<?php
											$startTime = new DateTime($super['heures_debut']);
											$endTime = new DateTime($super['heures_fin']);
											$interval = $startTime->diff($endTime);
											echo $interval->format('%h h %i min'); ?>
										</strong>
									</td>
									<td>
										<strong><?php echo $super['heures_debut']; ?>h</strong>
									</td>
									<td>
										<strong><?php echo $super['heures_fin']; ?>h</strong>
									</td>
									<td>
										<?php
										$mycls = "primary"; // Default class
										if ($super['pourcentage'] <= 30) {
											$mycls = "danger";
										} elseif ($super['pourcentage'] <= 50) {
											$mycls = "warning";
										} elseif ($super['pourcentage'] <= 70) {
											$mycls = "primary";
										} else {
											$mycls = "success";
										}
										?>
										<div class="d-flex flex-column w-100">
											<span class="me-2 mb-1 text-muted"><?php echo $super['pourcentage']; ?>%</span>
											<div class="progress progress-sm bg-<?php echo $mycls; ?>-light w-100">
												<div class="progress-bar bg-<?php echo $mycls; ?>" role="progressbar" style="width: <?php echo $super['pourcentage']; ?>%;"></div>
											</div>
										</div>
									</td>

								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>


			<div class="col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title mb-0">Statistiques Déléguées </h5>
					</div>
					<table class="table my-0 table-striped table-hover table-bordered">
						<thead class="text-center">
							<tr>
								<th class="d-xxl-table-cell">Nom</th>
								<th>Total visite</th>
								<th>Moyenne du temps d'appel</th>
								<th>Moyenne des heures de travail</th>
								<th>heures debut</th>
								<th>heures fin</th>
								<th class="d-xl-table-cell">Pourcentage visite localisée</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $key => $res) { ?>
								<tr>
									<td>
										<div class="d-flex">
											<div class="flex-grow-1 ms-3">
												<strong><?php echo $res['user']; ?></strong>
												<div class="text-muted">
													Super : <?php echo $res['super']; ?>
												</div>
											</div>
										</div>
									</td>
									<td>
										<strong><?php echo $res['total_visite']; ?></strong>
									</td>
									<td>
										<strong><?php echo $res['moyenne_time']; ?> min</strong>
									</td>
									<td>
										<strong>
											<?php
											$startTime = new DateTime($super['heures_debut']);
											$endTime = new DateTime($super['heures_fin']);
											$interval = $startTime->diff($endTime);
											echo $interval->format('%h h %i min'); ?>
										</strong>
									</td>
									<td>
										<strong><?php echo $res['heure_debut']; ?>h</strong>
									</td>
									<td>
										<strong><?php echo $res['heure_fin']; ?>h</strong>
									</td>
									<td>
										<?php
										$mycls = "primary"; // Default class
										if ($res['pourcentage'] <= 30) {
											$mycls = "danger";
										} elseif ($res['pourcentage'] <= 50) {
											$mycls = "warning";
										} elseif ($res['pourcentage'] <= 70) {
											$mycls = "primary";
										} else {
											$mycls = "success";
										}
										?>
										<div class="d-flex flex-column w-100">
											<span class="me-2 mb-1 text-muted"><?php echo $res['pourcentage']; ?>%</span>
											<div class="progress progress-sm bg-<?php echo $mycls; ?>-light w-100">
												<div class="progress-bar bg-<?php echo $mycls; ?>" role="progressbar" style="width: <?php echo $res['pourcentage']; ?>%;"></div>
											</div>
										</div>
									</td>

								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- map -->
	<?php echo $this->Html->script('jquery-jvectormap-2.0.5.min');
	echo $this->Html->script('MA_jvm');
	?>
</body>

</html>