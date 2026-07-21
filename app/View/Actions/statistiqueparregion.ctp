<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo $this->Html->css('daterangepicker');
    ?>
<?php echo $this->Html->css('dataTables.bootstrap');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @media (max-width: 980px){
            .tablebox{margin-top:0px !important;}
        }
        .dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
    .dt-button:hover{color:#fff;background:#1a486f;}

    /* ===== Design system restyle (spr) ===== */
    .spr-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
    }
    .spr-wrapper .box{
        background:#fff;
        border:none;
        border-radius:18px;
        box-shadow:0 4px 24px rgba(108,99,245,0.08);
        padding:0;
        overflow:hidden;
    }
    .spr-icon-badge{
        width:44px;
        height:44px;
        min-width:44px;
        border-radius:13px;
        background:linear-gradient(135deg,#efeeff,#e3e0ff);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .spr-icon-badge svg{
        width:20px;
        height:20px;
        stroke:#6C63F5;
    }
    /* date filter banner */
    .spr-datebanner{
        background:linear-gradient(90deg,#f4f2ff,#eceaff);
        border-radius:18px;
        padding:26px 30px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:24px;
        flex-wrap:wrap;
    }
    .spr-datebanner-left{
        display:flex;
        align-items:center;
        gap:18px;
    }
    .spr-datebanner-title{
        font-size:16.5px;
        font-weight:600;
        color:#2d2b45;
        margin:0;
    }
    .spr-datebanner-sub{
        font-size:13.5px;
        color:#8b87a8;
        margin-top:2px;
    }
    .spr-wrapper #dateform{
        min-width:280px;
    }
    .spr-wrapper .input-group{
        border:1.5px solid #ded9fb;
        border-radius:12px;
        overflow:hidden;
        background:#fff;
    }
    .spr-wrapper .input-group-addon{
        background:#faf9ff;
        border:none;
        border-right:1.5px solid #ded9fb;
        color:#6C63F5;
    }
    .spr-wrapper .input-group .form-control{
        border:none;
        box-shadow:none;
        font-size:14px;
        padding:11px 16px;
    }
    /* per-team report card header */
    .spr-report-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:14px;
        padding:20px 24px;
        flex-wrap:wrap;
    }
    .spr-report-header-left{
        display:flex;
        align-items:center;
        gap:14px;
    }
    .spr-report-title{
        font-size:16.5px;
        font-weight:600;
        color:#2d2b45;
        margin:0;
    }
    .spr-report-title .spr-team-name{
        color:#6C63F5;
        font-weight:700;
    }
    .spr-wrapper .dt-buttons{
        margin:0;
    }
    .spr-wrapper .dt-button,
    .spr-wrapper .dt-buttons .btn{
        border-radius:999px !important;
        border:none !important;
        font-weight:600 !important;
        font-size:13.5px !important;
        padding:8px 18px !important;
        margin:0 !important;
        float:none !important;
    }
    .spr-wrapper .buttons-excel{background:#e8f8ee !important;color:#1f9d55 !important;}
    .spr-wrapper .box-body.table-responsive{
        padding:0 24px 24px 24px;
    }
    .spr-wrapper table.dataTable thead th{
        background:#faf9ff;
        color:#4a4863;
        font-weight:600;
        font-size:13px;
        border-bottom:2px solid #ece9fb;
    }
    .spr-wrapper table.dataTable tbody td{
        font-size:13.5px;
        color:#454358;
        vertical-align:middle;
    }
    .spr-wrapper table.dataTable tbody tr:hover{
        background:#faf9ff;
    }
    .spr-wrapper .badge.bg-red{background:#f4544e;border-radius:999px;padding:4px 10px;}
    .spr-wrapper .badge.bg-yellow{background:#e6b93d;border-radius:999px;padding:4px 10px;color:#4a3c07;}
    .spr-wrapper .badge.bg-green{background:#3fb37f;border-radius:999px;padding:4px 10px;}
    .spr-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:999px !important;
        border:1px solid #e7e5f7 !important;
        margin:0 3px;
        color:#6a6785 !important;
    }
    .spr-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:#6C63F5 !important;
        border-color:#6C63F5 !important;
        color:#fff !important;
    }
    .spr-wrapper .dataTables_empty{
        color:#9a97b3;
        padding:36px 0 !important;
    }
    </style>
    <div class="spr-wrapper">
	<div class="row ">
        <div class="col-md-12" style="margin-bottom: 24px;"> 
            <div class="box form-group" style="border-radius:18px;box-shadow:none;">
                <div class="spr-datebanner">
                    <div class="spr-datebanner-left">
                        <div class="spr-icon-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p class="spr-datebanner-title">Pour des statistiques d'une période précise,</p>
                            <div class="spr-datebanner-sub">veuillez sélectionner une date :</div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:0;">
                        <form action="/actions/statistiqueparregion/" method="get" id="dateform">
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
<?php foreach ($info as $vmp): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="margin-bottom:22px;">
                <div class="spr-report-header">
                    <div class="spr-report-header-left">
                        <div class="spr-icon-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h3 class="spr-report-title">
                            Rapport des actions de l'équipe de <span class="spr-team-name"><?php echo $vmp['super']['User']['name']; ?></span>
                        </h3>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover example1"  border="0" >
                        <thead>
                            <tr>
                                <th>Etat</th>
                                <th>Responsable</th>
                                <th>Gamme</th>
								<?php if(AuthComponent::user('role')=="Responsable promotion" || AuthComponent::user('role')=="Admin")
								{
									echo "<th>Montant</th>";
									echo "<th>Nature</th>";
									echo "<th>Description</th>";
								}
									?>
                                <th>Client</th>
                                <th>Type</th>
                                <th>POT</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Durée</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($info[$vmp['super']['User']['id']] as $v) : 
                            if(!isset($v['Action'])) 
                                continue;
                            ?>
                                <tr>
                                    <td><?php
                                        $now = time();
                                        $your_date = strtotime($v["Action"]['date_fin']);
                                        $datediff = $your_date - $now;
                                        $j = floor($datediff / (60 * 60 * 24));
                                        if ($v["Action"]['date_debut'] > date('Y-m-d'))
                                            echo '<span class="badge bg-yellow">Prochainement</span>';
                                        else if ($j >= 0)
                                            echo '<span class="badge bg-green">En cours</span>';
                                        else
                                            echo '<span class="badge bg-red">Terminé</span>';
                                        ?></td>
                                    <td><?php echo $this->Html->link($v["User"]["name"],array("controller"=>"users",'action'=>'view',$v['User']['id'])); ?></td>
                                    <td><?php echo $v["Action"]["game_id"]; ?></td>
									<?php if(AuthComponent::user('role')=="Responsable promotion" || AuthComponent::user('role')=="Admin")
									{
										echo "<td>".$v["Action"]["name"]."</td>";
										echo "<td>".$v["Action"]["nature"]."</td>";
										echo "<td>".$v["Action"]["description"]."</td>";
										
									}?>
									 
                                    <td><?php echo $this->Html->link($v["Client"]["nom"]." ".$v["Client"]["prenom"],array("controller"=>"clients",'action'=>'view',$v['Client']['id'])); ?></td>
									<td><?php echo $types[$v["Client"]["type_id"]]; ?></td>
                                    <td><?php echo $v["Client"]["potentialite"]; ?></td>
                                    <td><?php echo $v["Action"]["date_debut"]; ?></td>
                                    <td><?php echo $v["Action"]["date_fin"]; ?></td>
                                    <td><?php
                                        $now = strtotime($v["Action"]['date_debut']);
                                        $your_date = strtotime($v["Action"]['date_fin']);
                                        $datediff = $your_date - $now;
                                        $j = floor($datediff / (60 * 60 * 24));
                                        echo "$j jours";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $now = time();
                                        $your_date = strtotime($v["Action"]['date_fin']);
                                        $datediff = $your_date - $now;
                                        $j = floor($datediff / (60 * 60 * 24));
                                        if ($v["Action"]['date_debut'] > date('Y-m-d'))
                                            echo '----';
                                        else if ($j >= 0)
                                            echo "$j jours";
                                        else
                                            echo '----';
                                        ?>
                                    </td>

                                </tr>
                        <?php endforeach;   ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
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
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('daterangepicker'); ?>
<script>
        $(function () {
        $(".example1").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "order": [1, 1],
            "iDisplayLength": 50,
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
                    //document.getElementById('note').innerHTML = '<?php //echo $notetotal;    ?>';
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
                        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
                            var startDate = picker.startDate;
                            var endDate = picker.endDate;
                            var action = $('#dateform').attr('action');
                            var date = action + "?date=" + startDate + "--" + endDate;
                            $('#dateform').attr('action', date);
                            $('#dateform').submit();
                        });

                    });

                    function boxtog() {
                        $('.boxlistes').toggle(300);
                        var clas = $("#icon").attr("class");
                        if (clas == 'fa fa-minus') {
                            $("#icon").attr("class", "fa fa-plus");
                        }
                        if (clas == 'fa fa-plus') {
                            $("#icon").attr("class", "fa fa-minus");
                        }
                    }
	function boxtogl(id){
		$('.boxlistes'+id).toggle(300);
		var clas = $("#icon"+id).attr("class");
		if(clas=='fa fa-minus'){
			$("#icon"+id).attr("class", "fa fa-plus");
		}
		if(clas=='fa fa-plus'){
			$("#icon"+id).attr("class", "fa fa-minus");
		}
	}
	
</script>
