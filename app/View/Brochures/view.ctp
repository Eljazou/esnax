<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css'>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

	/* Everything below is stuff Metronic doesn't already give us for free:
	   the brand accent color, and styling for the 3rd-party owl-carousel arrows. */

	#brochure-view-page {
		font-family: 'Plus Jakarta Sans', sans-serif;
	}

	#brochure-view-page .text-indigo { color: #8c7ef2 !important; }
	#brochure-view-page .bg-indigo-subtle { background-color: #f5f6ff !important; }
	#brochure-view-page .bg-pink-subtle { background-color: #fff0f3 !important; }

	#brochure-view-page .btn-indigo {
		background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%);
		color: #ffffff;
		border: none;
	}
	#brochure-view-page .btn-indigo:hover { color: #ffffff; opacity: .92; }

	#brochure-view-page .btn-indigo-soft {
		background: #f5f6ff;
		color: #8c7ef2;
		border: 1px solid #e1e3fd;
	}
	#brochure-view-page .btn-indigo-soft:hover {
		background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%);
		color: #ffffff;
	}

	#brochure-view-page .badge-indigo { background: #f5f6ff; color: #8c7ef2; }

	/* owl-carousel isn't a Metronic component, so its nav arrows need their own styling */
	#brochure-view-page .gallery-carousel { position: relative; }
	#brochure-view-page .gallery-carousel .owl-nav {
		position: absolute;
		top: 50%;
		right: -14px;
		transform: translateY(-50%);
	}
	#brochure-view-page .gallery-carousel .owl-prev { display: none; }
	#brochure-view-page .gallery-carousel .owl-next {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		background: #ffffff;
		border: 1px solid #f1f1f8;
		box-shadow: 0 4px 14px rgba(140, 126, 242, .08);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	#brochure-view-page .gallery-carousel .owl-next::before {
		content: "›";
		font-size: 22px;
		color: #8c7ef2;
		line-height: 1;
	}
</style>

<div id="brochure-view-page">
<div class="row g-6 mb-6">

	<!-- LEFT CARD: brochure info -->
	<div class="col-md-6">
		<div class="card h-100">
			<div class="card-body d-flex align-items-center gap-6">
				<?php if($brochure['Brochure']['logo']!=null && $brochure['Brochure']['logo']!="") :?>
					<?php echo $this->Html->image("brochures/".$brochure['Brochure']['logo'], array("class"=>"rounded-3 flex-shrink-0", "style"=>"width:130px;height:130px;object-fit:cover;")); ?>
				<?php else: ?>
					<div class="bg-indigo-subtle rounded-3 flex-shrink-0" style="width:130px;height:130px;"></div>
				<?php endif; ?>

				<div class="min-w-0">
					<h3 class="fs-2 fw-bold text-gray-900 mb-1 text-truncate"><?php echo $brochure['Brochure']['name']; ?></h3>
					<p class="text-muted fs-7 mb-4">Solution cardiovasculaire</p>

					<div class="separator my-4"></div>

					<div class="d-flex flex-wrap gap-6">
						<div class="d-flex align-items-center gap-3">
							<div class="symbol symbol-40px symbol-circle bg-pink-subtle">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff4d6d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
							</div>
							<div>
								<div class="fs-8 text-muted">Catégorie</div>
								<div class="fs-7 fw-bold text-gray-800"><?php echo $brochure['Category']['name']; ?></div>
							</div>
						</div>

						<div class="d-flex align-items-center gap-3">
							<div class="symbol symbol-40px symbol-circle bg-indigo-subtle">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8c7ef2" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							</div>
							<div>
								<div class="fs-8 text-muted">Date d'ajout</div>
								<div class="fs-7 fw-bold text-gray-800">
									<?php
										// Parse the raw database datetime string cleanly
										$rawTimestamp = strtotime($brochure['Brochure']['created']);

										$day = date("d", $rawTimestamp);
										$year = date("Y", $rawTimestamp);
										$time = date("H:i:s", $rawTimestamp);

										// Explicit manual French translation array to prevent system locale bugs
										$monthsFr = array(
											"01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril",
											"05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août",
											"09" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre"
										);
										$monthNum = date("m", $rawTimestamp);
										$frenchMonth = isset($monthsFr[$monthNum]) ? $monthsFr[$monthNum] : date("F", $rawTimestamp);

										echo $day . " " . $frenchMonth . " " . $year . "<br>" . $time;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- RIGHT CARD: gallery -->
	<div class="col-md-6">
		<div class="card h-100">
			<div class="card-header border-0 pt-6">
				<h3 class="card-title fw-bold fs-4 text-gray-900">Supports associés</h3>
				<div class="card-toolbar">
					<a href="#" class="btn btn-sm btn-light">Voir tout</a>
				</div>
			</div>
			<div class="card-body pt-0">
				<div class="gallery-carousel popup-gallery">
					<?php if($brochure['Brochure']['file']!=null && $brochure['Brochure']['file']!="") :?>
						<div class="gallery-item">
							<a href="<?php echo $this->webroot."img/brochures/".$brochure['Brochure']['file']; ?>" data-effect="mfp-zoom-in" title="">
								<?php echo $this->Html->image("brochures/".$brochure['Brochure']['file'], array("class"=>"rounded-3")); ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if($brochure['Brochure']['file2']!=null && $brochure['Brochure']['file2']!="") :?>
						<div class="gallery-item">
							<a href="<?php echo $this->webroot."img/brochures/".$brochure['Brochure']['file2']; ?>" data-effect="mfp-zoom-in" title="">
								<?php echo $this->Html->image("brochures/".$brochure['Brochure']['file2'], array("class"=>"rounded-3")); ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if($brochure['Brochure']['file3']!=null && $brochure['Brochure']['file3']!="") :?>
						<div class="gallery-item">
							<a href="<?php echo $this->webroot."img/brochures/".$brochure['Brochure']['file3']; ?>" data-effect="mfp-zoom-in" title="">
								<?php echo $this->Html->image("brochures/".$brochure['Brochure']['file2'], array("class"=>"rounded-3")); ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if($brochure['Brochure']['file4']!=null && $brochure['Brochure']['file4']!="") :?>
						<div class="gallery-item">
							<a href="<?php echo $this->webroot."img/brochures/".$brochure['Brochure']['file4']; ?>" data-effect="mfp-zoom-in" title="">
								<?php echo $this->Html->image("brochures/".$brochure['Brochure']['file4'], array("class"=>"rounded-3")); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- ORDER TABLE -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title fw-bold text-gray-900">L'ordre de présentation</h3>
				<div class="card-toolbar">
					<button type="button" class="btn btn-sm btn-indigo" data-bs-toggle="modal" data-bs-target="#add_order">Ajouter un ordre</button>
				</div>
			</div>

			<?php if (AuthComponent::user('role') != 'VMP'): ?>
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-7 gy-4 mb-0">
					<thead>
						<tr class="fw-bold text-muted text-uppercase fs-8">
							<th>Spécialité</th>
							<th>Ligne</th>
							<th>Ordre</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($brochure['Brochureorganise'] as $temp): ?>
							<tr>
								<td><?php echo $categories[$temp['category_id']]; ?></td>
								<td><?php echo $lignes[$temp['ligne_id']]; ?></td>
								<td><span class="badge badge-circle badge-indigo"><?php echo $temp['ordre']; ?></span></td>
								<td>
									<button id="<?php echo $temp['id']; ?>" onclick="edit(this.id)" class="btn btn-sm btn-indigo-soft" data-bs-toggle="modal" data-bs-target="#add_order">modifier</button>
									<?php
										if ($this->requestAction('/droits/getrole/Brochures/supprimer_ordre') == 1)
											echo $this->Form->postLink(__('Supprimer'), array('action' => 'supprimer_ordre', $temp['id']), array('class' => 'text-muted text-hover-danger fw-semibold ms-3'), 'Etes-vous sur de vouloir supprimer # %s?', $temp['id']);
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>
		</div>
	</div>

</div>
</div>

<div class="modal fade" id="add_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un ordre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php if ($this->requestAction('/droits/getrole/Brochures/ajouter_ordre') == 1): ?>
      <div class="modal-body">
			<?php echo $this->Form->create('Brochureorganise',array("url"=>array("controller"=>"brochures","action"=>"ajouter_ordre")));
			echo $this->Form->hidden('brochure_id', array('value' => $brochure['Brochure']['id']));
			echo $this->Form->input('category_id', array('label' => 'Catégorie', 'class' => 'form-control'));
			echo $this->Form->input('ligne_id', array('label' => 'Ligne', 'class' => 'form-control'));
			echo $this->Form->input('ordre', array('label' => 'Ordre', 'class' => 'form-control'));
			?>
      </div>
      <div class="modal-footer">
      	<?php echo $this->Form->end(array('label' => 'Ajouter',"id"=>"send",'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>

<script>
function edit(id) {
	const modal = document.getElementById("add_order");
    const form = document.querySelector("#add_order form");
    const link = form.getAttribute("action");
    form.setAttribute("action", `${link}/${id}`);
	submitButton = document.getElementById("send");
	submitButton.value = "Editer";
}
</script>

<script type="text/javascript">
$('.gallery-carousel').owlCarousel({
	nav:      true,
    navText:  ['',''],
	margin:   16,
	loop:     true,
	autoplay: true,
	items:    2
});

$('.popup-gallery').magnificPopup({
	delegate: '.owl-item:not(.cloned) a',
	type: 'image',
	removalDelay: 500,
	gallery:{
      enabled:true
    }
});
</script>
