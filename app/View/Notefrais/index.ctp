<?php

?>
<style type="text/css">
    /*.coltotal{
        display: flex;
    }*/
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/fr.js"></script>
<style type="text/css">
    tr th:first-child .checkbox{
        top: -11px;
        right: -19px;
    }
    .users{
        margin-top: 25px;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        height: 261px;
        align-content: space-around;
    }  
    .span_user{
        background: #5a5a5a;
        padding: 3px;
        font-size: 12px;
        border-radius: 4px;
        color: white;
    } 
</style>

<style type="text/css">
/* ================== METRONIC RESTYLE (CSS/SVG only — no PHP/JS logic touched) ================== */
/* Purple Metronic theme, reusing Bootstrap 5 / Metronic utility classes wherever possible.
   Only the few things Metronic utilities can't express (brand tint, icon chips, datepicker fix) are custom. */
.ptg-wrapper{
	--bs-primary: #6C63F5;
	--bs-primary-rgb: 108, 99, 245;
	--ptg-purple: #6C63F5;
	--ptg-purple-dark: #5750d9;
	--ptg-purple-soft: #EEECFE;
	--ptg-text: #2c2e3a;
	--ptg-muted: #8a8fa3;
	--ptg-border: #ececf5;
}

/* ---- compact notice banner (Metronic "notice" pattern) ---- */
.ptg-notice{
	background: var(--ptg-purple-soft);
	border: 1px dashed #c9c3fb;
	border-radius: 12px;
	padding: 12px 16px;
}
.ptg-notice-icon{
	width: 34px;
	height: 34px;
	min-width: 34px;
	border-radius: 50%;
	background: #fff;
	box-shadow: 0 2px 6px rgba(108,99,245,.15);
}
.ptg-notice-icon svg{ width: 17px; height: 17px; color: var(--ptg-purple); }
.ptg-notice-text{ font-size: 13px; line-height: 1.5; font-weight: 600; color: var(--ptg-purple-dark); }
.ptg-notice-status svg{ width: 15px; height: 15px; color: var(--ptg-purple); }

/* ---- main card ---- */
.ptg-card{
	border: 1px solid var(--ptg-border);
	border-radius: 14px;
	box-shadow: 0 4px 14px rgba(108,99,245,.07);
}
.ptg-card > .card-header{
	min-height: auto;
	padding: 12px 16px;
	background: transparent;
}
.ptg-card > .card-body{ padding: 12px 16px; }
.ptg-card > .card-footer{ padding: 12px 16px; background: transparent; }

/* ---- icon chip used for calendar + total ---- */
.ptg-icon-chip{
	width: 28px;
	height: 28px;
	min-width: 28px;
	border-radius: 8px;
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple);
}
.ptg-icon-chip svg{ width: 15px; height: 15px; }

/* ---- date field: fixes the invisible-text bug (input had no explicit color) ---- */
.ptg-date-field .form-control{
	color: var(--ptg-text) !important;
	background-color: #fff !important;
	border-color: var(--ptg-border) !important;
	height: 34px;
	font-size: 13px;
}
.ptg-date-field .form-control::placeholder{ color: var(--ptg-muted); opacity: 1; }
.ptg-date-field .form-control:focus{ border-color: var(--ptg-purple) !important; box-shadow: 0 0 0 .15rem rgba(108,99,245,.15) !important; }
.ptg-date-field .input-group-text{ background:#fff; border-color: var(--ptg-border); color: var(--ptg-purple); }

/* ---- Flatpickr, compact Metronic-purple theme ---- */
.flatpickr-calendar{ border-radius: 12px; box-shadow: 0 10px 26px rgba(108,99,245,.18); border: 1px solid var(--ptg-border); }
.flatpickr-calendar.arrowTop:before,
.flatpickr-calendar.arrowTop:after{ display: none; }
.flatpickr-current-month .flatpickr-monthDropdown-months,
.flatpickr-current-month input.cur-year{ font-weight: 600; color: var(--ptg-text); }
span.flatpickr-weekday{ color: var(--ptg-purple); font-weight: 600; }
.flatpickr-day.today{ border-color: var(--ptg-purple); }
.flatpickr-day:hover{ background: var(--ptg-purple-soft); border-color: var(--ptg-purple-soft); }
.flatpickr-day.selected,
.flatpickr-day.selected:hover{ background: var(--ptg-purple); border-color: var(--ptg-purple); }
.flatpickr-months .flatpickr-prev-month:hover svg,
.flatpickr-months .flatpickr-next-month:hover svg{ fill: var(--ptg-purple); }

/* ---- total stat chip ---- */
.ptg-total-icon{
	width: 42px;
	height: 42px;
	border-radius: 10px;
	background: linear-gradient(135deg, var(--ptg-purple), var(--ptg-purple-dark));
	box-shadow: 0 4px 10px rgba(108,99,245,.3);
}
.ptg-total-icon svg{ width: 19px; height: 19px; color: #fff; }
.ptg-total-label{ font-size: 11px; font-weight: 600; letter-spacing: .04em; color: var(--ptg-muted); text-transform: uppercase; }
.ptg-total-number{ font-size: 20px; font-weight: 700; color: var(--ptg-text); }

/* ---- table: tighter header + rows ---- */
.ptg-card table.dataTable thead tr th{
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple-dark);
	border-bottom: none !important;
	padding: 8px 10px !important;
	font-size: 11.5px;
	font-weight: 600;
	text-transform: uppercase;
	letter-spacing: .02em;
}
.ptg-card table.dataTable thead tr th:first-child{ border-radius: 8px 0 0 8px; }
.ptg-card table.dataTable thead tr th:last-child{ border-radius: 0 8px 8px 0; }
.ptg-card table.dataTable tbody td{
	padding: 9px 10px;
	font-size: 13px;
	color: var(--ptg-text);
	vertical-align: middle;
}
.ptg-card table.dataTable tbody tr:hover{ background: #f5f4ff; }
.ptg-card td.dataTables_empty{ padding: 40px 10px !important; color: var(--ptg-muted); }

/* DataTables chrome */
.ptg-card .dataTables_filter input{
	border-color: var(--ptg-border) !important;
	border-radius: 8px !important;
	padding-left: 30px !important;
	background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238a8fa3' stroke-width='2'><circle cx='11' cy='11' r='7'></circle><line x1='21' y1='21' x2='16.65' y2='16.65'></line></svg>") no-repeat 8px center;
	background-size: 13px 13px;
}
.ptg-card .dt-buttons .dt-button{
	background: #21a366 !important;
	border: none !important;
	border-radius: 8px !important;
	color: #fff !important;
	padding: 6px 12px !important;
	font-size: 13px;
}
.ptg-card .dataTables_paginate .paginate_button.current{
	background: var(--ptg-purple) !important;
	border-color: var(--ptg-purple) !important;
	color: #fff !important;
	border-radius: 6px !important;
}
</style>

<script>
    // Flatpickr is vanilla JS (no jQuery involved), so it isn't affected by
    // this page loading jQuery more than once further down — unlike the
    // previous jQuery UI datepicker, whose plugin bindings that duplicate
    // load was silently wiping out.
    document.addEventListener('DOMContentLoaded', function () {
        var fp = flatpickr("#datepicker", {
            dateFormat: "d-m-Y",
            locale: "fr",
            disableMobile: true
        });
        var trigger = document.getElementById('datepicker-trigger');
        if (trigger) {
            trigger.addEventListener('click', function () { fp.open(); });
        }
    });
</script>
<div class="ptg-wrapper">

	<div class="ptg-notice d-flex align-items-start gap-3 mb-3">
		<div class="ptg-notice-icon d-flex align-items-center justify-content-center flex-shrink-0">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="20" x2="4" y2="12"></line><line x1="12" y1="20" x2="12" y2="6"></line><line x1="20" y1="20" x2="20" y2="15"></line></svg>
		</div>
		<div class="ptg-notice-text">
			Note réel=(Note Théorique - (Note Théorique *(85%-Objectif des visites)) + Ajustement<br>
			Note final=(Note Théorique + Ajustement
			<div class="ptg-notice-status d-flex align-items-center gap-2 mt-2 fw-normal">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><polyline points="8 12 11 15 16 9"></polyline></svg>
				<span>La liste des notes de frais a <?php
				if ($archive == 0)
					echo "validé";
				else
					echo "exporté"
					?></span>
			</div>
		</div>
	</div>

	<div class="card ptg-card">
		<div class="card-header d-flex align-items-center flex-wrap gap-3">
			<div class="d-flex align-items-center gap-2">
				<span class="ptg-icon-chip d-flex align-items-center justify-content-center">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				</span>
				<label class="mb-0 fs-7 fw-semibold text-dark">Pour des statistiques d'une période précise, veuillez sélectionner une date :</label>
			</div>
			<form action="" method="get" id="dateform" autocomplete="off" class="d-flex align-items-center gap-2 ms-auto">
				<div class="input-group ptg-date-field" style="max-width:220px;">
					<span class="input-group-text" id="datepicker-trigger" style="cursor:pointer;"><i class="fa fa-clock-o"></i></span>
					<input type="text" class="form-control ptg-date-input" name="date" id="datepicker" placeholder="Sélectionner une date" autocomplete="off">
				</div>
				<input type="submit" value="Rechercher" class="btn btn-primary btn-sm">
			</form>
		</div>

		<div class="card-body">
			<div class="d-flex align-items-center gap-2 mb-3">
				<span class="ptg-total-icon d-flex align-items-center justify-content-center">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v10M9.5 9.5c0-1.4 1.2-2.5 2.5-2.5s2.5 1 2.5 2.2c0 2.3-5 1.6-5 4.1 0 1.3 1.2 2.2 2.5 2.2s2.5-1.1 2.5-2.5"></path></svg>
				</span>
				<div>
					<div class="ptg-total-label">Total</div>
					<div class="ptg-total-number box-total"></div>
				</div>
			</div>

			<div class="table-responsive">
				<table id="example1" class="table table-row-dashed align-middle">
					<thead>
						<tr>
							<th><?php echo $this->Form->input('users_ids', array("label"=>false,'type' => 'checkbox','class'=>'checkbox-all')); ?></th>
							<th>VM</th>
							<th>Obj</th>
							<!-- <th>Prêt/avence</th> -->
							<th>Théorique</th>
							<?php
							foreach ($listenatures as $k => $v)
								echo "<th>$v</th>";
							?>                    
							<th>T ajustement</th>
							<th>final</th>                    
							<th>#</th>
						</tr>
					</thead>
					<?php
					$total = 0;
					$mois=date("Y_m");
					foreach ($notes as $note):
						$mois=$note['Notefrai']['mois'];
						?>
						<tr>
							<td><?php echo $this->Form->input('user_id', array("label"=>false,"value"=>$note['User']['id'],'type' => 'checkbox','class'=>'checkbox-user','user_name'=>$note['User']['name'])); ?>&nbsp;</td>
							<td><?php echo $note['User']['name']; ?>&nbsp;</td>
							<td><?php echo $note['Notefrai']['taux']; ?> %</td>
							<td><?php echo $note['Notefrai']['thiorique']; ?> DH</td>
							<?php
							$ajustement = 0;
							foreach ($listenatures as $k => $v) {
								$aj = 0;
								if (isset($dataajustements[$note['Notefrai']['id']][$v])) {
									$aj = $dataajustements[$note['Notefrai']['id']][$v];
									$ajustement += $aj;
								}
								echo "<td>$aj</td>";
							}
							?> 
							<td><?php echo $ajustement; ?> DH</td>
							<td><?php echo $note['Notefrai']['thiorique'] +$ajustement;?> DH</td>

							<td><?php echo $this->Html->link("Voir", array('action' => 'notedefrais', $note['Notefrai']['user_id'], $note['Notefrai']['date_debut'] . "--" . $note['Notefrai']['date_fin']), array('class' => 'btn btn-sm btn-light-primary')); ?></td>
						</tr>
						<?php
						$total += $note['Notefrai']['thiorique'] + $ajustement;
					endforeach;
					?>
				</table>
			</div>
		</div>
		<div class="card-footer d-flex justify-content-center gap-2">
			<button class="btn btn-sm btn-light-success" onclick="valide_user('accept')">Accepter</button>
			<button class="btn btn-sm btn-light-danger" onclick="valide_user('refuse')">Refusée</button>
		</div>
	</div>

	<!-- modal validation -->
	<div class="modal modal-valid fade" id="modal-valid" style="padding-right: 17px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" onclick="remove_tiri()">×</span></button>
					<h4 class="accept">Êtes-vous sûr(e) de valider Ca ?</h4>
					<h4 class="refuse">Êtes-vous sûr(e) de refuser Ca ?</h4>
				</div>
				<div class="modal-body">

					<?php 
					echo $this->Form->create('Notefrai',["url"=>["action"=>"valider",1,$mois]]);
					?>
					<input type="hidden" name="data[Notefrai][ids_remove]" id="input_ids">
					<?php echo $this->Form->input('commentaire', array('class' => 'form-control select2'));

					?>
					<div class="users">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="remove_tiri()">Fermer</button>
					<button type="button" class="btn btn-primary" onclick="submit_form()">Envoyer</button>
				</div>
			</div>

		</div>

	</div>
	<!-- modal empty  -->

	<div class="modal empty_modal fade" id="empty_modal" style="padding-right: 17px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" onclick="remove_tiri()">×</span></button>
				</div>
				<div class="modal-body">
					<h4>
						Vous n'avez choisi aucun element. 
					</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal" >Fermer</button>
				</div>
			</div>

		</div>

	</div>
</div>

<?php	

//                        AAAABBBDDD HAMIDD   9ra hadchi 
//hna il faut attention une fois cliquer 3la button submit désactive button bach maysiftch requete deux fois !!!!!!//
//dibutton valider une fois ycliquer tal3 model fih commentaire   khass ykouno deux button whda validé et l'autre réfusé 
//si il clique 3la refusé badel 1 b -1 f action ["action"=>"valider",-1,$user["User"]["id"],$mois]];
//meme blan mais il faut faire un choix multiple dial les users hadik $users ykoun fiha (1,2,3,4.....)
// $users="1,2,3,4";//juste pour le test
// echo $this->Form->create('Notefrai',["url"=>["action"=>"valider",1,$users,$mois]]);
// echo $this->Form->input('commentaire', array('class' => 'form-control select2'));
// echo $this->Form->end(array('label' => 'Ajouter'));

				 
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script>

    $(document).ready(function () {
        var total = <?php echo $total; ?>;
        $('.box-total').text(total + " Dhs");
    
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
            "language": {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
});

    var check_value = 0;
        $('.checkbox-all').change(function () {
            if ($(this).is(':checked')) {
                $('.checkbox-user').prop('checked', true);
            }
            else {
                $('.checkbox-user').prop('checked', false);
            }
        });

        $('.checkbox-user').change(function () {
            $('.checkbox-all').prop('checked', false);
        });


        function valide_user(parm){
            var array_ids = [];
            var users_names = [];
            var coun_check = $('.checkbox-user').length;
            for(i=0;i<coun_check ; i++){
                if ($('.checkbox-user').eq(i).is(':checked')) {
                    var ids = $('.checkbox-user').eq(i).val();
                    var names = $('.checkbox-user').eq(i).attr('user_name');
                    array_ids.push(ids);
                    users_names.push("<span class='span_user'>"+names+"</span>");
                }
            }
            $("#input_ids").val(array_ids);
            $(".users").empty();
            $(".users").html(users_names);
                if (array_ids.length == 0) {
                    $("#empty_modal").modal('show');
                }else{
                    action_attr = $('#NotefraiIndexForm').attr("action");
                    if(parm == "accept"){
                        
                        $('.refuse').hide();
                        $('.accept').show();
                    }else{
                        
                        if(action_attr.includes('/1/')){
                            
                            action_attr = action_attr.split('/1/').join('/-1/');
                            $('#NotefraiIndexForm').attr("action",action_attr);
                        }
                         $('.accept').hide();
                         $('.refuse').show();
                    }
                    $("#modal-valid").modal('show');
                }
        }

        function remove_tiri(){
            var newAction = $('#NotefraiIndexForm').attr("action").replace(/-/g, '');
            $('#NotefraiIndexForm').attr("action", newAction);
        }
        function submit_form(){
            $("#NotefraiIndexForm").submit();
        }


</script>
