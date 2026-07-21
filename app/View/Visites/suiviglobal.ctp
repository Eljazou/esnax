 <?php
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo $this->Html->css('daterangepicker');
    ?>
<?php echo $this->Html->css('dataTables.bootstrap'); ?>	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    @media (max-width:932px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
	.table-striped > thead{
		background-color: #ffffff;
	}
    .lu-wrapper .box-body{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch;
    }
    .lu-wrapper table#example1{
        min-width:760px;
    }
    .lu-wrapper table#example1 td:first-child{
        white-space:nowrap;
        text-align:left !important;
    }
    .lu-wrapper table#example1 thead th:first-child{
        text-align:left !important;
    }
    .lu-name-cell{
        display:inline-flex;
        align-items:center;
        justify-content:flex-start;
        gap:0;
        width:100%;
        text-align:left;
    }

    /* ===== Design system restyle (lu) ===== */
    .lu-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
    }
    .lu-wrapper .box{
        background:#fff;
        border:none;
        border-radius:18px;
        box-shadow:0 4px 24px rgba(108,99,245,0.08);
        margin-bottom:20px;
    }
    .lu-banner{
        background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
        border-radius:18px;
        padding:24px 30px;
        display:flex;
        align-items:center;
        gap:18px;
    }
    .lu-icon-badge{
        width:52px;
        height:52px;
        min-width:52px;
        border-radius:50%;
        background:linear-gradient(135deg,#e3e0ff,#d3cdfb);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .lu-icon-badge svg{
        width:24px;
        height:24px;
        stroke:#6C63F5;
    }
    .lu-banner-title{
        font-size:22px;
        font-weight:700;
        color:#2d2b45;
        margin:0;
    }
    .lu-banner-sub{
        font-size:13.5px;
        color:#8b87a8;
        margin-top:2px;
    }
    .lu-wrapper .box-header{
        border:none;
        display:flex;
        justify-content:flex-end;
        padding:20px 24px 0 24px;
    }
    .lu-wrapper .box-header .box-title{
        display:none;
    }
    .lu-wrapper .dataTables_filter{
        float:none !important;
    }
    .lu-wrapper .dataTables_filter label{
        display:flex;
        align-items:center;
    }
    .lu-wrapper .dataTables_filter input{
        border-radius:999px;
        border:1.5px solid #e7e5f7;
        padding:9px 18px;
        font-size:14px;
        min-width:260px;
        margin-left:8px;
    }
    .lu-wrapper table.dataTable thead th{
        background:#faf9ff;
        color:#4a4863;
        font-weight:600;
        font-size:13.5px;
        border-bottom:2px solid #ece9fb;
    }
    .lu-wrapper table.dataTable tbody td{
        font-size:14px;
        color:#454358;
        vertical-align:middle;
    }
    .lu-wrapper table.dataTable.table-striped tbody tr.odd{
        background:#fbfaff;
    }
    .lu-avatar{
        width:36px;
        height:36px;
        border-radius:50%;
        background:linear-gradient(135deg,#6C63F5,#8c7ef2);
        color:#fff;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        font-size:12.5px;
        font-weight:700;
        margin-right:12px;
        vertical-align:middle;
    }
    .lu-role-badge{
        display:inline-block;
        background:#f1effe;
        color:#6C63F5;
        border-radius:999px;
        padding:4px 14px;
        font-size:12.5px;
        font-weight:600;
    }
    .lu-wrapper .btn-primary{
        background:transparent;
        color:#6C63F5;
        border:1.5px solid #d8d3fb;
        border-radius:999px;
        font-weight:600;
        font-size:13px;
        padding:6px 16px;
        transition:background .15s ease;
    }
    .lu-wrapper .btn-primary:hover{
        background:#f1effe;
        color:#6C63F5;
    }
    .lu-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:999px !important;
        border:1px solid #e7e5f7 !important;
        margin:0 3px;
        color:#6a6785 !important;
    }
    .lu-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:#6C63F5 !important;
        border-color:#6C63F5 !important;
        color:#fff !important;
    }
</style>
<div class="lu-wrapper">
<div class="lu-banner">
    <div class="lu-icon-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div>
        <p class="lu-banner-title"><?php echo __('La liste des utilisateurs'); ?></p>
        <div class="lu-banner-sub">Consultez et gérez les utilisateurs de l'équipe</div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('La liste des utilisateurs'); ?></h3>
    </div>
    <div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
                <?php 
                   $i=0;
				   foreach ($users as $user): 
                       /* Display-only helper: derive two-letter initials from the user's name for the avatar circle.
                          No existing data or business logic is modified. */
                       $lu_words = preg_split('/\s+/', trim($user['User']['name']));
                       $lu_initials = '';
                       foreach (array_slice($lu_words, 0, 2) as $lu_w) {
                           if ($lu_w !== '') {
                               $lu_initials .= mb_strtoupper(mb_substr($lu_w, 0, 1));
                           }
                       }
				 ?>
                <tr>
                    
                    <td><span class="lu-name-cell"><span class="lu-avatar"><?php echo h($lu_initials); ?></span><?php echo h($user['User']['name']); ?></span>&nbsp;</td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['tel']); ?>&nbsp;</td>
                    <td><span class="lu-role-badge"><?php
                        if ($user['User']['role'] == 'Super viseur')
                            echo 'Superviseur';
                        else if ($user['User']['role'] == 'Ressource humain')
                            echo 'Ressources humaines';
                        else
                            echo h($user['User']['role']);
                        ?></span>&nbsp;</td>
                    <td >
                        <div class="btn-group">
                           
                            <!--<ul class="dropdown-menu" role="menu">-->
							
                                
			<a class="btn btn-primary" href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'statistique',$user['User']['id'])); ?>">Voir</a>
                                
                            
                        </div>
                    </td>
                </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('daterangepicker');
?>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "",
				"sSearchPlaceholder": "Rechercher un utilisateur...",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}
        });
    });
	
	    $(function () {
        $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": "--",
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
            clickApply: function (e) {
                this.updateInputText();
            }
        });
    });
        /*$('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            var startDate = picker.startDate.format('DD-MM-YYYY');
            var endDate = picker.endDate.format('DD-MM-YYYY');
			var lg = $('.dateform').length;
			for(var i=0; i<lg; i++){
				var action = $('.dateform:eq('+i+')').attr('href');
				var date = action + "/" + startDate + "/" + endDate;
				$('.dateform:eq('+i+')').attr('href', date);
			}
        });*/

</script>
