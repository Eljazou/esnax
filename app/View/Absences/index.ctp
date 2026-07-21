<?php
echo $this->Html->css('dataTables.bootstrap');
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
echo $this->Html->css('daterangepicker');
?>	
<style>
    @media (max-width:936px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
	.dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
	.dt-button:hover{color:#fff;background:#1a486f;}
</style>

<div class="row ">
    <div class="col-md-12" style="margin-bottom: 24px;"> 
        <div class="box form-group">
            <div class="box-header with-border">
                <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;
                       font-weight: normal;width: auto;text-align:left;float:left;">
                    Pour des absences d'une période précise,veuillez sélectionner une date :
                </label>
                <div class="col-md-6">
                    <form action="<?php echo $this->Html->url(array("action" => "index", $user_id)); ?>" method="get" id="dateform">
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
	<?php if( AuthComponent::user('role')!='Ressource humain'){?>
<div class="col-md-12" style="float: left;width: 100%;padding: 0px;">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-orange box box-default collapsed-box" style="border-top:0px;">
            <div class="inner">
                <h3><?php echo $this->requestAction("/absences/system_get_reste/" . $user_id . "/$date_debut/$date_fin"); ?> Heures</h3>
                <p>Demandes d'autorisation de sortie</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-light-yellow box box-default collapsed-box" style="border-top:0px;">
           <div class="inner">
                <h3><?php echo $this->requestAction("/absences/system_get_reste/" . $user_id . "/$date_debut/$date_fin/justifier"); ?> Jours</h3>
                <p>Absences pour autres motifs</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div> 
        </div>
    </div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-yellow box box-default collapsed-box" style="border-top:0px;">
            <div class="inner">
                <h3><?php echo $this->requestAction("/absences/system_get_reste/" . $user_id . "/$date_debut/$date_fin/Maladie"); ?> Jours</h3>
                <p>CM</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php }?>
<div class="col-md-12" style="float: left;width: 100%;">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Liste des absences</h3>	
			<div class="btn-group pull-right" style="float:right;">
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					<i class="fa fa-bars"></i>&nbsp;Demander une absence&nbsp;<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li> <?php	echo $this->Html->link(__("Je demande une autorisation d'absence durant mes horaires de travail"), array('action' => 'add'));?></li>
					<li> <?php echo $this->Html->link(__("je déclare mon absence pour maladie justifiée"), array('action' => 'addjustifier'));?></li>
					<li> <?php echo $this->Html->link(__("je demande une autorisation d'absence pour autres motifs"), array('action' => 'demandeconge'));?></li>
				</ul>
			</div>
			<?php if(AuthComponent::user('role')=='Admin' || AuthComponent::user('role')=='Ressource humain'){ ?><a class='btn btn-primary stat' style="cursor:pointer;margin-right:5px;float:right;">Statistique</a><?php } ?>
		</div>
		<style>
			.margin{margin:5px;}
		</style>
		<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog col-md-10" style="margin:auto;float:none;width:80%;top:3%;">
		<div class="modal-content" style="background:#fff;float:left;width: 100%;padding-bottom: 27px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Détail absence</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-7">
					<img src="" class="popimg" style="width:100%;height:auto;max-height:400px;">
				</div>
				<div class="col-md-5">
					<table class="table table-bordred table-striped poptable">
						<tr>
							<td>Utilisateur :</td><td></td>
						</tr>
						<tr>
							<td>Type :</td><td></td>
						</tr>
						<tr>
							<td>Motif Absence :</td><td></td>
						</tr>
						<tr>
							<td>Date début :</td><td></td>
						</tr>
						<tr>
							<td>Date de reprise :</td><td></td>
						</tr>
						<tr>
							<td>Durée :</td><td></td>
						</tr>
						<tr>
							<td>Tranche horaire :</td><td></td>
						</tr>
						<tr>
							<td>Etat :</td><td></td>
						</tr>
						<tr>
							<td>Réponse :</td><td></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
    </div>
</div>
<!---->

		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Justificatif</th>
						<th>Utilisateur</th>
						<th>Type</th>
						<th>Motif Absence</th>
						<th>Date début</th>
						<th>Date de reprise</th>
						<th>Durée</th>
						<th>Tranche horaire</th>
						<th>Etat</th>
						<th>Réponse</th>
						<th class="actions">Actions</th>
					</tr>
				</thead>
            <?php
            $reste = array();
			$ii=0;
            foreach ($absences as $absence):
                ?>
                <tr class="elem<?php echo $ii;?>">
                    <td><?php if(!empty($absence['Absence']['file'])){ echo $this->Html->image('absences/' . $absence['Absence']['file'], array('style' => 'height: 100px;width: 100px;float: left;cursor:pointer;','class'=>'tableimg', 'onclick'=>'popup('.$ii.')'));}else { ?>
					<i class="fa fa-exclamation-triangle" style="font-size: 28px;text-align: center !important;width: 100%;float: left;    color: #aaa;"></i>
					<?php } ?>
					</td>
                    <td><?php echo $this->Html->link($absence['User']['name'], array('controller' => 'users', 'action' => 'view', $absence['User']['id'])); ?></td>
                    <td><?php echo h($absence['Absence']['type']); ?>&nbsp;</td>
                    <td><?php echo h($absence['Absence']['titre']); ?>&nbsp;</td>
                    <td><?php echo utf8_encode(strftime('%A %d-%m-%Y', strtotime($absence['Absence']['date_debut']))); ?></td>
                    <td><?php if($absence['Absence']['date_fin']!=null) echo utf8_encode(strftime('%A %d-%m-%Y', strtotime($absence['Absence']['date_fin']))); ?></td>
                    <td><?php
                        if ($absence["Absence"]["jour"] != null)
                        {
                            $d=explode("|",$absence["Absence"]["jour"]);
                            echo $d[1]-$d[0]." heure";
                        }
                        if ($absence["Absence"]['date_fin'] != null) 
                        {
                            if($absence['Absence']['type']=="Conge")
                            {
                                echo $this->requestAction('/jourferiers/system_getjourforconge/'.$absence['Absence']['date_debut'].'/'.$absence['Absence']['date_fin'])." Jours";
                            }
                            else
                            {
                                $now = strtotime($absence["Absence"]['date_debut']);
                                $your_date = strtotime($absence["Absence"]['date_fin']);
                                $datediff = $your_date - $now;
                                $j = floor($datediff / (60 * 60 * 24));
                                echo "$j jours";
                            }
                        }
                        ?></td>
                    <td><?php if ($absence["Absence"]["jour"] != null)
                        {
                            $d=explode("|",$absence["Absence"]["jour"]);
                            echo "$d[0]:00 - $d[1]:00";
                        } ?></td>
                    <td><?php
                        if ($absence['Absence']['archive'] == 1)
                            echo "Validé";
                        if ($absence['Absence']['archive'] == 0)
                            echo "En cours";
                        if ($absence['Absence']['archive'] == -1)
                            echo "Réfusé";
                        ?></td>
                    <td><?php echo $absence['Absence']['repense']; ?></td>
                    <td class="actions">
                        <div class="btn-group">
                            <?php
                            if ($absence['Absence']['user_id'] == AuthComponent::user('id') && $absence['Absence']['archive'] == 0 &&
                                    $this->requestAction('/droits/getrole/absences/edit') == 1)
                            {
                                if($absence['Absence']['type']=="Conge")
                                    echo $this->Html->link(__('Editer'), array('action' => 'editconge', $absence['Absence']['id']),array('class'=>"btn btn-primary"));
                                else
                                    echo $this->Html->link(__('Editer'), array('action' => 'edit', $absence['Absence']['id']),array('class'=>"btn btn-primary"));
                            }
                            if(AuthComponent::user('role')=='Admin')
                                echo  $this->Html->link(__('Archiver'), array('action' => 'valider', $absence['Absence']['id'], -1),array('class'=>"btn btn-primary"));
                             ?>
						</div>
                    </td>
                </tr>
            <?php $ii++; endforeach; ?>
        </table>
    </div>
    </div>
    </div>
	
    <?php if (!empty($users)): ?>

<div class="col-md-12" style="float: left;width: 100%;">
	<div class="box">
        <div class="box-header">
            <h3 class="box-title">Liste des absences des employés</h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>Demandes d'autorisation de sortie </th>
                        <th>CM</th>
                        <th>Absences pour autres motifs</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <?php
                $i = 0;
				$heur=0;
				$ma=0;
				$jus=0;
                foreach ($users['User'] as $u) :
                    ?>
                    <tr>
                        <td><?php echo $u["name"]; ?></td>
                        <td><?php echo $u["role"]; ?></td>
                        <td><?php $j= $this->requestAction("/absences/system_get_reste/" . $u["id"] . "/$date_debut/$date_fin");
									echo $j;$heur=$heur+$j;
						?> Heures</td>
                        <td><?php $m= $this->requestAction("/absences/system_get_reste/" . $u["id"] . "/$date_debut/$date_fin/Maladie");
									echo $m;$ma=$ma+$m;
						?> Jours</td>
                        <td><?php $jj=$this->requestAction("/absences/system_get_reste/" . $u["id"] . "/$date_debut/$date_fin/justifier");
									echo $jj;$jus=$jus+$jj;
						?> Jours</td>
                        <td><?php echo $this->Html->link("Voir", array("action" => "index", $u["id"]),array('class'=>'btn btn-primary')); ?></td>
                    </tr>        
                    <?php
                    $i++;
                endforeach;
                ?>
            </table>
        </div>
	</div>
</div>
<div class="col-md-12" id="stat" style="float: left;width: 100%;padding: 0px;">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-orange box box-default collapsed-box" style="border-top:0px;">
            <div class="inner">
                <h3><?php echo $heur ?> Heures</h3>
                <p>Global des absences</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-yellow box box-default collapsed-box" style="border-top:0px;">
            <div class="inner">
                <h3><?php echo $ma; ?> Jours</h3>
                <p>CM</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-light-yellow box box-default collapsed-box" style="border-top:0px;">
            <div class="inner">
                <h3><?php echo $jus ?> Jours</h3>
                <p>	Absences pour autres motifs</p>
                <div class="icon">
                    <i class="ion ion-ios-time-outline"></i>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php endif; ?>
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
<!-- --><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script> 
<?php
//echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>
<script>
		var date_now = new Date();
		var date_eng = date_now.getDate()+'-'+(date_now.getMonth()+1)+'-'+date_now.getFullYear();
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 100
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 100,
			dom: 'Bfrtip',
			buttons: [{
				extend:'excel',
				filename:'La liste des absences ' + date_eng,
				exportOptions: {
						columns: [0, 1, 2, 3, 4]
					}
				}
			]
        });
    });
    $(function () {
        $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " -- ",
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
		
	$('.stat').click(function(){
		var target = $('#stat');
			$('html,body').animate({
				scrollTop: target.offset().top - 10
			}, 1000);
	});
    });
	function popup(id){
		var popimg = $('.elem'+id+' .tableimg').attr('src');
		console.log(popimg);
		var td1 = $('.elem'+id+' td:eq(1)').text();
		var td2 = $('.elem'+id+' td:eq(2)').text();
		var td3 = $('.elem'+id+' td:eq(3)').text();
		var td4 = $('.elem'+id+' td:eq(4)').text();
		var td5 = $('.elem'+id+' td:eq(5)').text();
		var td6 = $('.elem'+id+' td:eq(6)').text();
		var td7 = $('.elem'+id+' td:eq(7)').text();
		var td8 = $('.elem'+id+' td:eq(8)').text();
		var td9 = $('.elem'+id+' td:eq(9)').text();
		$('.popimg').attr('src',popimg);
		$('.poptable tr:eq(0) td:eq(1)').text(td1);
		$('.poptable tr:eq(1) td:eq(1)').text(td2);
		$('.poptable tr:eq(2) td:eq(1)').text(td3);
		$('.poptable tr:eq(3) td:eq(1)').text(td4);
		$('.poptable tr:eq(4) td:eq(1)').text(td5);
		$('.poptable tr:eq(5) td:eq(1)').text(td6);
		$('.poptable tr:eq(6) td:eq(1)').text(td7);
		$('.poptable tr:eq(7) td:eq(1)').text(td8);
		$('.poptable tr:eq(8) td:eq(1)').text(td9);
		$("#myModal").modal("show");
	}
</script>