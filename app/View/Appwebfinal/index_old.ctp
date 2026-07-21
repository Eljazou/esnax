<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style type="text/css">
	.header-title {
		/* font-size: 53px; */
		margin: 0 0 0 47px;
	}

	.all-elements {
		display: flex;
		align-items: center;
		margin: 0;
		/* margin-bottom: 20px; */
	}

	.card-home {
		display: flex;
		height: 158px;
		width: 100%;
		background: white;
		border-radius: 10px;
		justify-content: center;
		align-items: center;
		/* box-shadow: rgba(17, 17, 26, 0.05) 0px 4px 16px, rgb(235 235 240 / 5%) 0px 8px 32px; */
		box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
	}

	.card-home a {
		font-weight: 500;
		letter-spacing: -0.01em;
		line-height: 19px;
		font-style: normal;
		font-size: 13px;
		display: flex;
		align-content: center;
		justify-content: center;
		flex-direction: column;
		text-decoration: none;
		height: 100%;
		width: 100%;
		padding-left: 15px;
		font-family: 'Poppins', sans-serif;
	}

	.card-home i {
		font-size: 24px;
		color: #7165d6;
	}

	.col-name {
		text-align: right;
	}

	.icon-client {
		width: 35px;
		widisplay: inline-block;
		vertical-align: middle;
	}

	.my-header {
		margin: 0;
		padding: 23px 0px 3px 6px;
	}

	.tile-pages {
		font-size: 25px;
		font-weight: 500;
		font-family: 'Poppins', sans-serif;
	}

	.icon-profil {
		/* font-size: 60px; */
	}

	.cercle {
		width: 54px;
		height: 54px;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-content: center;
		flex-wrap: wrap;
	}

	.cercle1 {
		background: #ffffff;
	}

	.cercle2 {
		background: #eeecfa;
	}

	.cercle3 {
		background: #eeecfa;
		margin-top: 14px;
	}

	.cercle4 {
		background: #ffffff;
	}

	.hand {
		padding-left: 13px;
		font-size: 21px;
	}

	.name-hand {
		display: flex;
	}

	body {
		height: 100%;
		background: #fbfbfb;
	}

	.card-alert {
		padding: 45px 12px 12px 12px;
		font-family: 'Poppins', sans-serif;
		border-radius: 10px;
		margin-bottom: 19px;
	}

	.fa-door-open {
		color: #050606;
		/* font-size: 90px; */
		padding-left: 77px;
		padding-bottom: 33px;
	}


	.logout {
		font-size: 25px;
		padding-left: 18px;
	}

	.fa-sm {
		/* font-size: 62px; */
	}

	.title-card {
		font-size: 16px;
		font-weight: 500;
		font-family: 'Poppins', sans-serif;
		margin-top: 36px;
	}

	.card-imag {
		background-position: unset;
		background-size: cover;
		/* box-shadow: rgb(34 34 187 / 20%) 16px 13px 34px 12px; */
		background-image: linear-gradient(rgb(113 101 214), rgb(113 101 214 / 83%)), url(/img/bg2.jpg);
	}

	.t4 {
		color: #ffffff;
		/* margin: 0px -15px 0px -15px; */
	}

	.t1 {
		color: #5a5b5e;
	}

	.t3 {
		color: #5a5b5e;
	}

	.t2 {
		color: #ffffff;
	}

	.cercle5 {
		background: #eeecfa;
	}

	.color-t1 {
		color: #fafbfd;
		text-align: start;
		font-size: 13px;
		margin-bottom: 0;
		font-weight: 400;
	}

	.color-green {
		background-image: linear-gradient(rgb(0 200 102 / 70%), rgb(0 200 102 / 97%)), url(/img/bg2.jpg);
		background-position: unset;
		height: 100%;
		background-size: unset;
		background-color: #00c866;

	}

	.color-red {
		background-color: #fe0000;
		background-image: linear-gradient(rgb(254 0 0 / 84%), rgb(254 0 0 / 76%)), url(/img/bg2.jpg);
		background-position: unset;
		height: 100%;
		background-size: unset;
	}

	.color-orange {
		background-image: linear-gradient(rgb(253 173 28 / 73%), rgb(253 173 28)), url(/img/bg2.jpg);
		background-position: unset;
		height: 100%;
		background-size: unset;
		background-color: #fdad1c;

	}

	.color-t2 {
		color: #fafbfd;
		text-align: end;
		font-size: 13px;
		margin-bottom: 0;
		font-weight: 500;
	}

	.container-card i {
		font-size: 21px;
	}

	.container-title {
		padding: 0 !important;
		line-height: 22px;
		font-family: 'Poppins', sans-serif;
	}

	.t2:hover {
		color: #ffffff;
	}

	.t3:hover {
		color: #5a5b5e;
	}



	.modal-footer {
		display: flex;
		flex-wrap: nowrap;
		justify-content: center;
		border-top: 0;
	}

	.btn-secondary {
		color: #545454;
		background-color: #ffffff;
		border-color: #cacaca;
		width: 50%;
		padding: 8px;
		border-radius: 8px;
	}

	.btn-danger {
		color: #fff;
		background-color: #7e56da;
		border-color: #7e56da;
		width: 50%;
		padding: 8px;
		border-radius: 8px;
	}

	.btn-danger:hover {
		background-color: #6a3ece !important;
		border-color: #6a3ece !important;
		box-shadow: none !important;
	}

	.modal-content {
		border-radius: 12px;
	}

	.modal-body {
		padding: 0px 14px 0px 28px;
	}

	.modal-header {
		padding: 14px 11px 2px 27px;
		border-bottom: 0;
	}

	.close:hover {
		border: none;
		outline: none;
	}

	/* my style  */
	.page-content {
		position: relative;
		top: 25%;
	}

	.page-wrapper {
		height: 100%;
	}

	.page-wrapper {
		height: 100%;
	}

	.header.header-fixed {
		top: 0;
		left: 0;
		right: 0;
		margin-left: auto;
		margin-right: auto;
	}

	.header {
		position: fixed;
		min-height: 60px;
		max-width: 600px;
		z-index: 10;
		padding: 10px 24px 3px 24px;
	}

	.header-content {
		display: flex;
		justify-content: space-between;
		padding: 10px 0 15px;
		font-size: 24px;
	}

	h6.title {
		font-size: 25px;
	}

	.title-visite {
		display: flex;
		align-items: center;
	}

	.title-visite p {
		font-size: 16px;
		font-weight: 600;
	}

	.all-alert {
		position: relative;
	}

	.titre-alert {
		position: absolute;
		z-index: 9;
		width: 100%;
		left: 14px;
		top: 3px;
	}
</style>

<div class="page-wrapper">
	<!-- Header -->
	<header class="header header-fixed">
		<div class="header-content">
			<div class="left-content">
				<a href="#" class="">
					<div class="media">
						<div class="media-35 m-r10">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108.3 108.3" style="enable-background:new 0 0 108.3 108.3;" xml:space="preserve">
								<style type="text/css">
									.st0 {
										fill: #E6E6E6;
									}

									.st1 {
										fill: #FFB8B8;
									}

									.st2 {
										fill: #575A89;
									}

									.st3 {
										fill: #2F2E41;
									}
								</style>
								<g id="Group_45" transform="translate(-191 -152.079)">
									<g id="Group_30" transform="translate(282.246 224.353)">
										<path id="Path_944" class="st0" d="M17.1-18.1c0,10.5-3,20.8-8.8,29.6c-1.2,1.9-2.5,3.6-4,5.3c-3.4,4-7.3,7.4-11.6,10.3 c-1.2,0.8-2.4,1.5-3.6,2.2c-6.5,3.6-13.7,5.8-21,6.5c-1.7,0.2-3.4,0.2-5.1,0.2c-4.7,0-9.4-0.6-14-1.8c-2.6-0.7-5.1-1.6-7.6-2.6 c-1.3-0.5-2.5-1.1-3.7-1.8c-2.9-1.5-5.6-3.3-8.2-5.3c-1.2-0.9-2.3-1.9-3.4-2.9C-95.8,1.3-97.1-33-76.8-54.9s54.6-23.3,76.5-2.9 C10.8-47.6,17.1-33.2,17.1-18.1L17.1-18.1z" />
										<path id="Path_945" class="st1" d="M-50.2-13.2c0,0,4.9,13.7,1.1,21.4s6,16.4,6,16.4s25.8-13.1,22.5-19.7s-8.8-15.3-7.7-20.8 L-50.2-13.2z" />
										<ellipse id="Ellipse_185" class="st1" cx="-40.6" cy="-25.5" rx="17.5" ry="17.5" />
										<path id="Path_946" class="st2" d="M-51.1,34.2c-2.6-0.7-5.1-1.6-7.6-2.6l0.5-13.3l4.9-11c1.1,0.9,2.3,1.6,3.5,2.3 c0.3,0.2,0.6,0.3,0.9,0.5c4.6,2.2,12.2,4.2,19.5-1.3c2.7-2.1,5-4.7,6.7-7.6L-8.8,9l0.7,8.4l0.8,9.8c-1.2,0.8-2.4,1.5-3.6,2.2 c-6.5,3.6-13.7,5.8-21,6.5c-1.7,0.2-3.4,0.2-5.1,0.2C-41.8,36.1-46.5,35.4-51.1,34.2z" />
										<path id="Path_947" class="st2" d="M-47.7-0.9L-47.7-0.9l-0.7,7.2l-0.4,3.8l-0.5,5.6l-1.8,18.5c-2.6-0.7-5.1-1.6-7.6-2.6 c-1.3-0.5-2.5-1.1-3.7-1.8c-2.9-1.5-5.6-3.3-8.2-5.3l-1.9-9l0.1-0.1L-47.7-0.9z" />
										<path id="Path_948" class="st2" d="M-10.9,29.3c-6.5,3.6-13.7,5.8-21,6.5c0.4-6.7,1-13.1,1.6-18.8c0.3-2.9,0.7-5.7,1.1-8.2 c1.2-8,2.5-13.5,3.4-14.2l6.1,4L4.9,7.3l-0.5,9.5c-3.4,4-7.3,7.4-11.6,10.3C-8.5,27.9-9.7,28.7-10.9,29.3z" />
										<path id="Path_949" class="st2" d="M-70.5,24.6c-1.2-0.9-2.3-1.9-3.4-2.9l0.9-6.1l0.7-0.1l3.1-0.4l6.8,14.8 C-65.2,28.3-67.9,26.6-70.5,24.6L-70.5,24.6z" />
										<path id="Path_950" class="st2" d="M8.3,11.5c-1.2,1.9-2.5,3.6-4,5.3c-3.4,4-7.3,7.4-11.6,10.3c-1.2,0.8-2.4,1.5-3.6,2.2l-0.6-2.8 l3.5-9.1l4.2-11.1l8.8,1.1C6.1,8.7,7.2,10.1,8.3,11.5z" />
										<path id="Path_951" class="st3" d="M-23.9-41.4c-2.7-4.3-6.8-7.5-11.6-8.9l-3.6,2.9l1.4-3.3c-1.2-0.2-2.3-0.2-3.5-0.2l-3.2,4.1 l1.3-4c-5.6,0.7-10.7,3.7-14,8.3c-4.1,5.9-4.8,14.1-0.8,20c1.1-3.4,2.4-6.6,3.5-9.9c0.9,0.1,1.7,0.1,2.6,0l1.3-3.1l0.4,3 c4.2-0.4,10.3-1.2,14.3-1.9l-0.4-2.3l2.3,1.9c1.2-0.3,1.9-0.5,1.9-0.7c2.9,4.7,5.8,7.7,8.8,12.5C-22.1-29.8-20.2-35.3-23.9-41.4z" />
										<ellipse id="Ellipse_186" class="st1" cx="-24.9" cy="-26.1" rx="1.2" ry="2.4" />
									</g>
								</g>
							</svg>
						</div>
						<h6 class="mb-0 font-13 title">👋</h6>
					</div>
				</a>
			</div>
			<div class="mid-content"></div>
			<div class="right-content d-flex align-items-center gap-3">
				<a href="<?php echo $this->Html->Url(array("action" => "logout", $code)); ?>" class="notification-badge font-20">
					<i class="fa-regular fa-arrow-right-from-bracket" style="color: #2F2E41;"></i>
				</a>
			</div>
		</div>
		<?php if (count($visiteencour) != 0) : ?>

			<?php
			$time = $visiteencour["Visite"]["timer"];
			$array_time = explode(" ", $time);
			$numbertime = (int)$array_time[0];
			$lettretime = $array_time[1];
			$colorCard = '';
			if (($numbertime <= 30 && $lettretime == "min") || $lettretime == "sec") {
				$colorCard = 'color-green';
			} elseif ($numbertime >= 30 && $numbertime <= 45 && $lettretime == "min") {
				$colorCard = 'color-orange';
			} else {
				$colorCard = 'color-red';
			}


			?>
			<a class="visite_url btn_spiner" style="display: none;" href="<?php echo $this->Html->Url(array("action" => "view_client", $code, $visiteencour["Client"]["id"], $lan, $lon)); ?>"></a>
			<div class="all-alert">
				<div class="row titre-alert">
					<div class="col col-start title-visite">
						<p class="container-title color-t1">Visite en cours</p>
					</div>


					<!-- Trigger the modal dialog -->
					<a href="#" onclick="$('#deleteConfirmationModal').modal('show'); return false;">
						<div class="col col-end">
							<i class="fa-solid fa-delete-left"></i>
						</div>
					</a>


				</div>

				<div class="container-card bg-white-box card-alert <?php echo $colorCard; ?>">
					<div class="row">
						<div class="col col-start">
							<p class="container-title color-t1">
								<?php echo $visiteencour["Client"]["nom"] . "," . $visiteencour["Client"]["prenom"]; ?>
							</p>
						</div>
						<div class="col col-end">
						</div>
					</div>
					<div class="row">
						<div class="col col-start">
							<p class="container-title color-t1">Potentialité</p>
						</div>
						<div class="col col-end color-t2">
							<?php echo $visiteencour["Client"]["potentialite"]; ?>
						</div>
					</div>
					<div class="row">
						<div class="col col-start">
							<p class="container-title color-t1">Date demarré visite</p>
						</div>
						<div class="col col-end color-t2">
							<?php
							$d = $visiteencour["Visite"]["date"];
							$d = explode(" ", $d);
							$d = explode(":", $d[1]);
							$heure = "$d[0]:$d[1]";
							echo $heure; ?>
						</div>
					</div>
					<div class="row">
						<div class="col col-start">
							<p class="container-title color-t1">Temps passé</p>
						</div>
						<div class="col col-end color-t2">
							<?php echo $visiteencour["Visite"]["timer"] ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</header>
	<!-- Header -->

	<!-- model confirm delete -->
	<!-- Add a modal dialog -->
	<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="row">
					<div class="col-11" style="text-align: center;padding-right: 0px;padding-top: 15px;">
						<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="172" height="115" viewBox="0 0 920.30414 515.08657" xmlns:xlink="http://www.w3.org/1999/xlink">
							<path id="a935b196-91fc-4d65-bd04-49275a33d175-79" data-name="Path 1" d="M333.52692,705.58229h-140.6s-2.85-41.8,14.012-42.275,14.962,18.525,36.1-7.6,46.787-24.7,50.112-9.262-6.412,27.787,11.4,23.987S348.01392,676.60726,333.52692,705.58229Z" transform="translate(-139.84793 -192.45672)" fill="#e6e6e6" />
							<path id="af9a6d89-7824-4af5-a475-6980c18ad0f3-80" data-name="Path 2" d="M260.85394,705.5923l-.475-.019c1.107-27.52,6.87-45.2,11.511-55.19,5.038-10.844,9.893-15.234,9.942-15.277l.316.355c-.048.043-4.846,4.389-9.844,15.16C267.68893,660.56526,261.95694,678.1753,260.85394,705.5923Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
							<path id="ae138407-70d7-43ff-b006-9d3240c337f6-81" data-name="Path 3" d="M311.73993,705.6483l-.456-.133a73.682,73.682,0,0,1,18.551-30.863l.319.352A73.183,73.183,0,0,0,311.73993,705.6483Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
							<path id="a7d931fe-d47e-4aa5-ae01-a0d26a3448cc-82" data-name="Path 4" d="M215.07292,705.61531l-.471-.065a51.73206,51.73206,0,0,0-4.653-30.238,41.63309,41.63309,0,0,0-7.34-10.71606l.329-.343a42.15523,42.15523,0,0,1,7.441,10.848A52.20594,52.20594,0,0,1,215.07292,705.61531Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
							<path id="b274f1e0-b558-44b1-a0b2-dcd77bbddb14-83" data-name="Path 5" d="M352.60792,706.21727h-174.845l-.04-.592c-.1-1.473-2.331-36.228,8.93-48.629a12.33392,12.33392,0,0,1,9.013-4.325c7.34-.209,11.953,2.541,15.674,4.747,7.013,4.16,11.645,6.909,28.49-13.91,18.247-22.553,37.936-27.406,49.254-24.708,7.313,1.744,12.353,6.671,13.828,13.52,1.4,6.485.952,12.578.594,17.475-.383,5.239-.685,9.376,1.467,11.252,1.8,1.565,5.381,1.707,11.281.448,12-2.56,28.748-.37,37.153,10.491,4.522,5.843,8.085,16.463-.623,33.88Zm-173.652-1.271h172.865c6.489-13.165,6.692-24.287.581-32.182-7.711-9.963-23.888-12.585-35.883-10.026-6.411,1.368-10.23,1.142-12.381-.732-2.631-2.292-2.308-6.71-1.9-12.3.352-4.815.789-10.808-.569-17.115-1.368-6.351-6.063-10.926-12.881-12.551-10.957-2.614-30.1,2.177-47.971,24.27-17.534,21.672-22.817,18.54-30.126,14.2-3.767-2.234-8.043-4.767-14.99-4.57a11.10885,11.10885,0,0,0-8.108,3.909c-10.118,11.146-8.884,42.398-8.636,47.097Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
							<path id="bca7d782-7e31-494e-97b0-f49b8df7894d-84" data-name="Path 8" d="M923.90791,706.92328h-172.216l-.033-.965-8.223-235.18h188.727Zm-170.284-2h168.352l8.117-232.145h-184.587Z" transform="translate(-139.84793 -192.45672)" fill="#3f3d56" />
							<g id="e7d5632f-8461-4dcf-9cd9-df8e3f64d5e2" data-name="Group 1">
								<rect id="ad932c98-7027-4b28-8e73-a76d8a4136e0" data-name="Rectangle 17" x="639.82597" y="321.89657" width="13.099" height="162.097" fill="#3f3d56" />
								<rect id="ae1e5d8b-7977-4a56-a24c-fbb057f76b38" data-name="Rectangle 18" x="691.40202" y="321.89657" width="13.099" height="162.097" fill="#3f3d56" />
								<rect id="bffa0855-fc38-45cc-9e39-6daa1d3e4103" data-name="Rectangle 19" x="742.97801" y="321.89657" width="13.099" height="162.097" fill="#3f3d56" />
							</g>
							<path d="M1041.59738,539.83884l-.8457-.53418L826.83762,404.12156l18.55566-29.36182.84571.53418,213.91308,135.18262Zm-212-136.33935,211.377,133.57959,16.418-25.97949-211.376-133.58106Z" transform="translate(-139.84793 -192.45672)" fill="#3f3d56" />
							<path id="b31113e7-cae2-4653-b248-af5e4acb0a6c-85" data-name="Path 10" d="M989.9499,393.22629a38.459,38.459,0,0,0-58.62,38.07l10.2,6.446a30.344,30.344,0,1,1,28.98,18.321l10.2,6.446a38.459,38.459,0,0,0,9.249-69.283Z" transform="translate(-139.84793 -192.45672)" fill="#3f3d56" />
							<rect id="bbfb7505-c422-4cd7-b125-b9dee40ff3b1" data-name="Rectangle 21" y="513.08657" width="909" height="2" fill="#3f3d56" />
							<g id="b91459ce-423d-4e92-a857-d0ba85dc07c7" data-name="Group 6">
								<path id="bc369f15-2cd9-428d-9eec-3a8fd8cc1bba-86" data-name="Path 111" d="M536.88489,691.89628h-14.564l-6.932-56.174h21.5Z" transform="translate(-139.84793 -192.45672)" fill="#feb8b8" />
								<path id="fafca8b8-1a63-4513-a3fa-e64917847011-87" data-name="Path 112" d="M494.23393,705.41828h45.771v-17.684h-28.332a17.439,17.439,0,0,0-17.439,17.439h0Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
								<path id="a38ea43e-f1b1-406e-84c8-61e7480f01b4-88" data-name="Path 113" d="M531.766,604.85129l10.046,10.545,45.452-33.727-14.826-15.563Z" transform="translate(-139.84793 -192.45672)" fill="#feb8b8" />
								<path id="b5ba90e2-8a51-4a77-95c4-5b486c8770ec-89" data-name="Path 114" d="M552.16123,620.2275l-19.54908-20.51237-12.80321,12.202,31.582,33.1382.17738-.169a17.4414,17.4414,0,0,0,.59292-24.65874Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
								<path id="b1536285-e66e-494f-8c4f-a2304265e4c3-90" data-name="Path 115" d="M430.39593,450.95329a11.94591,11.94591,0,0,1,5.715-17.4l57.179-145.727,22.288,13.345-63.518,139.8a12.01,12.01,0,0,1-21.664,9.982Z" transform="translate(-139.84793 -192.45672)" fill="#feb8b8" />
								<path id="acd6249e-4699-4411-813c-091b3a750afe-91" data-name="Path 116" d="M647.42792,461.3983a11.94507,11.94507,0,0,1-10.727-14.85l-84.354-131.869,23.891-10.2,75.836,133.523a12.01,12.01,0,0,1-4.646,23.4Z" transform="translate(-139.84793 -192.45672)" fill="#feb8b8" />
								<path id="ece4d731-f277-435f-bbc1-e3b70679d22f-92" data-name="Path 117" d="M493.8529,436.36129l14.931,221.913,35.682-3.148,7.34595-163.722,19.94,70.314,43.028,3.148-17.031-139Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
								<path id="b91f5bf0-a8c5-41a2-a26e-8e2fd84207c6-93" data-name="Path 118" d="M578.04889,551.2243l-6.3,10.495-44.073,30.434,31.484,16.792s60.869-33.583,55.622-44.078Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
								<path id="b0b7866d-f3ba-460a-97cc-8103175b89de-94" data-name="Path 119" d="M462.60693,346.57728l12.421-35a62.4941,62.4941,0,0,1,32.332-35.668h0a89.42706,89.42706,0,0,1,52.484-2.873l4.52,1.122a87.36364,87.36364,0,0,1,33.128,16c7.654,6.034,14.54,13.674,15.153,21.892a.24435.24435,0,0,0,.015.051c2.12,9.292,3.169,57.567,3.169,57.567h-18.7l2.958,65.067-.239-.471s-107.856,20.411-107.856,9.916v-67.168l-2.211-24.32Z" transform="translate(-139.84793 -192.45672)" fill="#ccc" />
								<circle id="bd3b9138-8795-4826-98b2-48d72249760b" data-name="Ellipse 12" cx="423.432" cy="41.59257" r="29.889" fill="#feb8b8" />
								<path id="e83e2647-99b5-4c80-ac3e-9e5d1f9bc81d-95" data-name="Path 120" d="M567.757,220.64529l23.208.93c2.92-.009,6.108-.112,8.332-2,3.35-2.849,2.789-8.225.995-12.241-5-11.182-16.153-15.188-28.4-14.859s-25.08,4.48-31.675,14.8-8.377,23.352-5.893,35.344a38.534,38.534,0,0,1,31.508-21.97Z" transform="translate(-139.84793 -192.45672)" fill="#2f2e41" />
							</g>
							<g id="ff061cc6-72bd-494d-9c36-32e4a4020cd7" data-name="Group 4">
								<path id="bc404282-8d4f-43f7-bc12-02f97785eba1-96" data-name="Path 81" d="M705.57123,513.00138l-84.00157-58.87289a3.60743,3.60743,0,0,1-.882-5.01481L686.619,355.0409a3.60743,3.60743,0,0,1,5.01481-.882l84.00156,58.87289a3.60742,3.60742,0,0,1,.882,5.01481l-65.92963,94.07033A3.60742,3.60742,0,0,1,705.57123,513.00138Z" transform="translate(-139.84793 -192.45672)" fill="#6c63ff" />
								<path id="ae4af9f3-88ec-4cab-9b9e-a4fc234f7062-97" data-name="Path 82" d="M724.46214,449.12032l-49.29069-34.54561a5.30063,5.30063,0,1,1,6.08441-8.6814l49.29069,34.54561a5.30063,5.30063,0,0,1-6.08441,8.6814Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
								<path id="fe48f3fd-992f-41c2-af3b-c30882e26a16-98" data-name="Path 83" d="M713.14975,465.26118l-49.29069-34.54561a5.30063,5.30063,0,1,1,6.0844-8.6814l49.29069,34.54561a5.30063,5.30063,0,0,1-6.0844,8.6814Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
								<path id="e216638f-22ba-49ea-a46c-300c78c4e875-99" data-name="Path 84" d="M701.71568,481.57565,652.425,447.03a5.30063,5.30063,0,1,1,6.0844-8.68141l49.29069,34.54561a5.30063,5.30063,0,0,1-6.0844,8.68141Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
								<path id="ee43e3d8-5f22-4b53-a964-043fec166479-100" data-name="Path 85" d="M724.32359,417.19028l-19.09171-13.38052a5.30063,5.30063,0,1,1,6.0844-8.6814L730.408,408.50887a5.30063,5.30063,0,0,1-6.08441,8.68141Z" transform="translate(-139.84793 -192.45672)" fill="#fff" />
							</g>
						</svg>

					</div>
					<div class="col-1" style="    padding: 13px 28px 0px 0px;"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class="fa-light fa-xmark-large"></i></span>
						</button></div>

				</div>

				<div class="modal-header">

					<h5 class="modal-title" id="deleteConfirmationModalLabel">Supprimer la visite</h5>

				</div>
				<div class="modal-body">
					Êtes-vous sûr(e) de vouloir supprimer cette visite ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<a href="<?php echo $this->Html->Url(array("action" => "delete_visite", $visiteencour["Visite"]["id"], $user_id)); ?>" class="btn_spiner btn btn-danger">Supprimer</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Content Start -->
	<main class="page-content space-top p-b40" id="main-content">
		<div class="container con-visite">
			<div class="all-elements">
				<div class="col-12 mb-5">
					<div class="col-12" style="padding: 0;">
						<div class="col-12">
							<div class="row">

								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 7px 0px 10px;">
									<div class="card-home card-imag">
										<a href="<?php echo $this->Html->url(array("action" => "clients", $code, $lan, $lon)); ?>" class="btn_spiner t2">
											<span class="cercle cercle1"><i class="fa-solid fa-user-group-simple" style="color: #7266d8;"></i></span>
											<p class="title-card">Clients</p>
										</a>
									</div>
								</div>
								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 10px 0px 7px;">
									<div class="card-home ">
										<a href="<?php echo $this->Html->url(array("action" => "boite", $code, $lan, $lon)); ?>" class="btn_spiner t3">

											<span class="cercle cercle2"><i class="fa-regular fa-box-archive"></i></span>
											<p class="title-card">Boîte à idées</p>

										</a>
									</div>
								</div>
								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 7px 0px 10px;">
									<div class="card-home">
										<a href="<?php echo $this->Html->url(array("action" => "maps", $code, $lan, $lon)); ?>" class="btn_spiner t3">

											<span class="cercle cercle2"><i class="fa-regular fa-location-dot"></i></span>
											<p class="title-card">Localisations des clients</p>

										</a>
									</div>
								</div>


								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 10px 0px 7px;">
									<div class="card-home card-imag">
										<a href="<?php echo $this->Html->url(array("action" => "brochure", $code, $lan, $lon)); ?>" class="btn_spiner t2">

											<span class="cercle cercle1"><i class="fa-regular fa-files"></i></span>
											<p class="title-card">Brochures</p>

										</a>
									</div>
								</div>
								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 10px 0px 7px;">
									<div class="card-home card-imag">
										<a href="<?php echo $this->Html->url(array("action" => "formations", $code, $lan, $lon)); ?>" class="btn_spiner t2">

											<span class="cercle cercle1"><i class="fa-solid fa-info"></i></span>
											<p class="title-card">Formations</p>

										</a>
									</div>
								</div>
								<div class="col-6 mb-5" style="margin-bottom: 1rem!important;padding: 0px 7px 0px 10px;">
									<div class="card-home">
										<a href="<?php echo $this->Html->url(array("action" => "statistique", $code, $lan, $lon)); ?>" class="btn_spiner t3">

											<span class="cercle cercle2">
												<i class="fa-solid fa-chart-column"></i>
											</span>
											<p class="title-card">Statistique</p>

										</a>
									</div>
								</div>


							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</main>
	<!-- Main Content End -->


	<!-- comming soon  -->
	<div class="modal fade" id="comingsoonModal" tabindex="-1" role="dialog" aria-labelledby="comingsoonModalModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="row">
					<div class="col-11" style="text-align: center;padding-right: 0px;padding-top: 15px;">
						<svg xmlns="http://www.w3.org/2000/svg" width="172" height="115" viewBox="0 0 656 458.68642" xmlns:xlink="http://www.w3.org/1999/xlink">
							<rect y="434.34322" width="656" height="2" fill="#3f3d56" />
							<g>
								<path d="M471.97092,210.81397c-6.0733-36.41747-37.72842-64.16942-75.86423-64.16942H240.14931c-38.12099,0-69.76869,27.72972-75.86421,64.12497-.70358,4.16241-1.06653,8.44331-1.06653,12.80573v135.88599c0,4.36237,.36295,8.63589,1.06653,12.79831,4.85126,28.99625,25.92996,52.49686,53.58563,60.84393,7.05095,2.13306,14.53143,3.28104,22.27859,3.28104h155.9574c7.74716,0,15.22763-1.14798,22.27859-3.28104,27.66309-8.35449,48.74921-31.86993,53.58563-60.88837,.6962-4.14758,1.05911-8.40628,1.05911-12.75388V223.57525c0-4.34758-.36292-8.61369-1.05911-12.76128h-.00003Zm-62.66592,222.28954c-4.2883,.76285-8.69516,1.16281-13.19827,1.16281H240.14931c-4.50313,0-8.90997-.39999-13.19829-1.16281-35.01768-6.22885-61.60677-36.83228-61.60677-73.64224v-45.10526c0-127.45004,103.31242-165.58582,230.76244-165.58582,41.31314,0,74.80505,33.49194,74.80505,74.80505v135.88599c-100.29059,13.42047-26.58911,67.41339-61.60678,73.64224l.00003,.00003Z" fill="#3f3d56" />
								<polygon points="349.16196 249.18644 355.16196 288.18642 443.16196 276.18642 434.66196 230.6195 349.16196 249.18644" fill="#6c63ff" />
								<rect x="381.84177" y="30.34218" width="36.38461" height="37.66125" fill="#2f2e41" />
								<polygon points="385.16196 70.18643 394.16196 43.18643 411.70447 43.18643 412.62653 70.18643 385.16196 70.18643" fill="#ffb6b6" />
								<polygon points="385.16196 70.18643 394.16196 43.18643 411.70447 43.18643 412.62653 70.18643 385.16196 70.18643" isolation="isolate" opacity=".1" />
								<path d="M394.66196,310.68642l-1,104-1,8v11.48425l15,1.51575,1-23s16-45,12-80-2-25-2-25l-24,3Z" fill="#ffb6b6" />
								<path d="M404.18408,318.85363l-36.90134,97.23831-1.97873,7.81567-4.1777,10.69742-14.52368-4.04477,7.43539-21.78796s1.46619-47.7373,17.92432-78.88422,10.9574-22.5596,10.9574-22.5596l21.26434,11.52512v.00003Z" fill="#ffb6b6" />
								<path d="M385.16196,67.18643l-27,12,17.23959,89.01208-2.72385,127.75565-18,38s-3.01575,21.73227,27.98425,7.73227,66-18,66-18l-8.5-58.5-7.5-153.5,1-34-22-14s-26.5,3.5-26.5,3.50001Z" fill="#2f2e41" />
								<path d="M370.1243,335.34322l-29.96231-50.15677,34.23959-116.98792-16.23959-89.01208,28.49045-12.19685s14.74915,14.36248,14.74915,26.20894-31.27728,242.1447-31.27728,242.1447v-.00003Z" fill="#e6e6e6" />
								<path d="M435.1243,325.34322l-27.19693-233.62811c-.34341-2.94999,.16013-5.93678,1.45178-8.6111l7.78284-16.11441,30.5,8.69685-12.26041,95.51208,32.76041,93.98792-33.03769,60.15677Z" fill="#e6e6e6" />
								<path d="M410.66196,433.68642s-19-11-21-5-3,11-3,11c0,0-5,19,10,19s14-8.64172,14-8.64172v-16.35828Z" fill="#2f2e41" />
								<path d="M344.53574,427.60598s21.69977-3.33459,21.3801,2.9819c-.3197,6.31647-1.20709,11.33768-1.20709,11.33768,0,0-2.25433,19.51712-16.22662,14.06046s-9.89713-13.14252-9.89713-13.14252l5.95078-15.23749-.00003-.00003Z" fill="#2f2e41" />
								<circle cx="404.10297" cy="33.02146" r="24.85993" fill="#ffb6b6" />
								<path d="M423.96469,10.86766c-1.15707-6.12936-7.44913-10.27514-13.66504-10.79501s-12.30453,1.82726-17.90228,4.57921c-3.79456,1.86548-7.53061,3.96811-10.60425,6.87182s-5.46063,6.69692-6.01202,10.88913c-.19507,1.48324-.1698,3.03289-.77692,4.40016-.75845,1.708-2.38654,2.86795-3.36917,4.4576-1.76227,2.85096-.95267,6.99858,1.75238,8.97753-3.40024,1.44912-6.89398,2.96069-9.48602,5.59563s-4.08878,6.70308-2.66644,10.11462c.50323,1.20699,1.33481,2.26349,1.76489,3.49843,.81668,2.34499,.03943,5.00909-1.40924,7.02585s-3.49316,3.51228-5.50174,4.97226c5.16196,1.01177,10.43097,1.80015,15.66992,1.32811s10.49707-2.30805,14.29086-5.95176c3.79379-3.64371,5.88083-9.26437,4.51974-14.34539-1.04269-3.89231-3.95898-7.30301-3.95712-11.33256,.00143-3.09747,1.7431-5.89158,3.4249-8.49271,3.67291-5.68066,7.34579-11.36132,11.01868-17.04197,.66068-1.02183,1.35739-2.07924,2.4014-2.70425,1.77606-1.06326,4.0798-.59568,5.95227,.28683,1.87244,.88252,3.58304,2.14867,5.57941,2.69585,4.07452,1.11677,8.80106-1.44789,10.08575-5.47261" fill="#2f2e41" />
								<path d="M409.27951,61.42523c-2.07159,2.0061-5.05701,2.65225-7.82379,3.46516s-5.70978,2.09141-6.95499,4.69243c-1.22101,2.55043-.33459,5.78793,1.68692,7.76505s4.95816,2.80999,7.78555,2.77077c2.82736-.03922,5.58282-.86796,8.24176-1.8301,7.27054-2.63087,14.15665-6.32148,20.37314-10.919-4.02679-1.11411-6.66107-5.81614-5.50836-9.83205,.93768-3.26677,3.80499-5.54528,5.75616-8.32809,3.35959-4.79151,3.91925-11.10753,2.80676-16.85277-1.11246-5.74524-3.73163-11.07097-6.32358-16.3176-.81934-1.65853-1.65805-3.34513-2.93619-4.68245-1.27814-1.33731-3.08783-2.29539-4.92776-2.10379-3.05334,.31795-5.00302,3.66989-5.02377,6.7397s1.32593,5.95491,2.34732,8.84988c1.05231,2.98259,1.78381,6.14409,1.50146,9.29425-.2366,2.63989-1.19669,5.21132-2.74811,7.36029-1.19809,1.65954-2.72479,3.05223-4.0275,4.63097-1.00714,1.22055-1.90009,2.60309-2.16486,4.16321-.48181,2.83914,1.18356,5.71186,.72714,8.55519-.48248,3.0056-3.6452,5.3067-6.65341,4.84085" fill="#2f2e41" />
								<g>
									<circle cx="333.2486" cy="323.64455" r="85" fill="#6c63ff" />
									<g>
										<path d="M384.17838,316.82296h-10.56668c-1.64377-9.68713-6.7168-18.46011-14.2923-24.71729-17.43427-14.39993-43.24109-11.94022-57.64099,5.49411-.04913,.05563-.09644,.11282-.14169,.17151-1.15063,1.49146-.87427,3.63333,.61716,4.784,1.49118,1.1507,3.63306,.87448,4.78394-.61697,6.25537-7.5788,15.72369-12.40167,26.31064-12.40167,16.20853,.00195,30.17899,11.40631,33.42572,27.28629h-9.31805c-.3988,.00012-.78458,.13992-1.09082,.39502-.72375,.60281-.82175,1.6781-.21915,2.40186l13.41125,16.09894c.06577,.07889,.13855,.1517,.21759,.21747,.72324,.60327,1.79871,.50583,2.40186-.21747l13.41125-16.09894c.25504-.30624,.3949-.69223,.39514-1.09082,.00027-.94186-.763-1.70566-1.70486-1.70605v.00003Z" fill="#fff" />
										<path d="M364.34329,344.7337c-1.49146-1.15063-3.63333-.87433-4.78394,.6171-4.96201,6.00781-11.83066,10.13629-19.46436,11.69922-18.46167,3.77988-36.49231-8.12213-40.27225-26.58392h9.3183c.94186-.0004,1.70514-.76419,1.70486-1.70605-.00027-.39853-.14011-.78452-.39514-1.09082l-13.41125-16.09888c-.60312-.72336-1.67862-.8208-2.40186-.21753-.07904,.06577-.15182,.13855-.21759,.21753l-13.41125,16.09888c-.6026,.72375-.50461,1.7991,.21915,2.40186,.30624,.25516,.69205,.3949,1.09082,.39502h10.56641c1.64404,9.68723,6.7168,18.46011,14.29254,24.71729,17.43427,14.39999,43.24109,11.94022,57.64099-5.49405,.04913-.05569,.09619-.11295,.14142-.17163,1.15088-1.49146,.87454-3.63327-.61691-4.784h.00006Z" fill="#fff" />
									</g>
								</g>
								<path id="uuid-da16df1e-5659-4232-96f6-61e8c639a9ec-222" d="M356.98148,237.19363c-1.02939,7.36621-5.66458,12.80598-10.35239,12.15012-4.68781-.65588-7.65225-7.15837-6.62149-14.52707,.37137-2.94914,1.4436-5.76646,3.12701-8.21626l4.75577-31.15587,14.57297,2.54338-6.23553,30.44414c.94736,2.81844,1.20581,5.82278,.75369,8.76157h-.00003Z" fill="#ffb6b6" />
								<path d="M369.66196,77.68643s-15-5-17,13-4,39.99999-4,39.99999c0,0-9,21-5,32s11,3.3307,4,12.66534-6.02478,40.04724-6.02478,40.04724l22.52478-1.13387s12.5-82.57875,12.5-84.57875-7-52-7-52v.00004Z" fill="#e6e6e6" />
								<g>
									<path id="uuid-6bf35aa9-e432-4b51-af77-8f4eb19e6e42-223" d="M467.16132,233.84998c.27881,7.43257-3.33017,13.60114-8.06033,13.7778s-8.78937-5.70491-9.06732-13.14017c-.15176-2.96857,.40961-5.93028,1.63712-8.63741l-.78369-31.507,14.79315-.05261-.798,31.0659c1.42709,2.60854,2.20859,5.52095,2.27905,8.49347l.00003,.00002Z" fill="#ffb6b6" />
									<path d="M444.06961,77.34876s15.08694-4.73121,16.76505,13.30165,3.28473,51.06508,3.28473,51.06508c0,0,8.62338,21.15744,4.42749,32.08421s-11.05774,3.13365-4.22565,12.59187c6.83212,9.45822,4.37997,36.13126,4.37997,36.13126l-22.50095-1.53612s-10.09427-78.77167-10.05853-80.77133,7.92792-62.86664,7.92792-62.86664l-.00003,.00002Z" fill="#e6e6e6" />
								</g>
							</g>
						</svg>

					</div>
					<div class="col-1" style="    padding: 13px 28px 0px 0px;"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class="fa-light fa-xmark-large"></i></span>
						</button></div>

				</div>

				<div class="modal-header">

					<h5 class="modal-title" id="deleteConfirmationModalLabel">Coming soon</h5>

				</div>
				<div class="modal-body">
					Cette fonctionnalité n'est pas disponible pour le moment. Veuillez consulter ultérieurement.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	var headerHeight = $('header').outerHeight();
	$('#main-content').css('top', headerHeight);


	$(document).ready(function() {
		$(".card-alert").on("click", function() {
			$("#loading-overlay").css('display', 'flex');
			var url = $(".visite_url").attr("href");
			window.location.href = url; // Redirect to the specified URL
		});
	});
</script>