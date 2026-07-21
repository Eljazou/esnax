<?php echo $this->Html->css('daterangepicker');
echo $this->Html->css('dataTables.bootstrap');

?>

<style>
    @media (max-width:1237px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
.direct-chat-info {
    font-size: 17px!important;
}
.direct-chat-text
{ 
    font-size: 23px;
}
.box-header{
    color: #333;
    background-color: #f5f5f5;
}
.motant{
    background: black;
    color: white;
    font-size: 20px;
    font-weight: 700;
    padding: 10px 15px;
    position: relative;
    bottom: -7px;
    right: 15px;
}
.name_user{
    position: relative;
    top: 18px;
}

</style>
<div class="row">
<!--maps modal  -->
<div id="visitemaps" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Maps <b style="float:right;margin-right:10px;"></b></h4>
            </div>
            <div class="modal-body" style="height: 480px;">
                <div id="map" class="col-md-12" style="height: 480px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal -->
<div class="col-md-12">

<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">
            <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
            echo __('Note de frais'); ?>
        </h3>
        <div class="col-md-12" style="margin-bottom: 24px;"> 
                
                    <?php echo $this->Form->create('Notefrai',array("type"=>"get","url"=>array("action"=>"notedefrais"))); ?>
                        <div class="input-group col-lg-6" style="float:left;">
                            
                            <label for="">Date </label>
                            <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> 
                                   class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
                        </div>
                        <div class="col-md-6">
                        <?php 
                    echo $this->Form->input('user_id', array('label' => "VM", 'class' => 'form-control select2'));
                     ?>
                        </div>
                        <?php
                        echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12 col-xs-12','style'=>'margin:10px 0px;'))); ?>
                    

    </div>
    </div>
    <?php if(!empty($info)):?>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Itinéraire</th>
                    <th>Kilométrage urbain</th>
                    <th>Kilométrage interville</th>
                    <th>Total</th>
                    <th>Hôtel</th>
                    <th>Restaurant</th>
                    <th>Divers</th>
                    <th>Km Reél</th>
                    <th>N° Visite</th>
                </tr>
            </thead>
            <?php
            $urbain = $interville = $hotel = $restaurant = $divers = $kmreel=0;
            foreach ($info as $date => $note):
				//samedi et dimanche demi frais 
				$samedi="";
				if(date('N', strtotime($date)) > 5) 
				{
					$note["urbain"]=round($note["urbain"]/2,0);
					$note["interville"]=round($note["interville"]/2,0);
					$note["hotel"]=round($note["hotel"]/2,0);
					$note["restaurant"]=round($note["restaurant"]/2,0);
					$note["divers"]=round($note["divers"]/2,0);
					$samedi="red";
				}
				//------------------Fin-----------------//
                $urbain = $urbain + $note["urbain"] ;
                $interville = $interville + $note["interville"];
                $hotel = $hotel + $note["hotel"];
                $restaurant = $restaurant + $note["restaurant"];
                $divers = $divers + $note["divers"];
				if(isset($reels[$date]) && !is_nan($reels[$date]))
					$kmreel+=$reels[$date];
                ?>
                <tr>
                    <td style="color: <?php echo $samedi ?>;"><?php echo $date; ?></td>
                    <td><?php echo $note["itineraire"]; ?></td>
                    <td><?php echo $note["urbain"]; ?> Km</td>
                    <td><?php echo $note["interville"]; ?> Km</td>
                    <td><?php echo $note["interville"] + $note["urbain"]; ?> Km</td>
                    <td><?php echo $note["hotel"]; ?> DH</td>
                    <td><?php echo $note["restaurant"]; ?> DH</td>
                    <td><?php echo $note["divers"]; ?> DH</td>
                    <td><?php if(isset($reels[$date]))
									echo $reels[$date]; ?> Km</td>
                    <td><button data-toggle="modal" id="<?php echo $date; ?>" data-target="#visitemaps"  type="button" class="btn btn-primary bg-green visitemaps"><?php echo count($gps[$date]); ?></button></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h1>RECAP de <?php echo $user["User"]["name"] ?></h1>
        <table class="table table-bordered table-striped">
            <tr>
                <td>KILOMETRAGE</td>	
                <td>IND KM</td>
                <td>KM</td>
                <td>MONTANT</td>
                <td>AUTRES FRAIS</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>KM urbain</td>	
                <td><?php echo $user["User"]["kilometrage_urbain"]; ?> DH</td>
                <td><?php echo $urbain; ?> Km / Réel <?php  echo $kmreel; ?> km</td>
                <td><?php $km= $urbain*$user["User"]["kilometrage_urbain"]; echo $km; ?> DH</td>
                <td>HOTEL</td>
                <td>RESTAURANT</td>
                <td>DIVERS</td>
            </tr>
           
            <tr>
                <td>KM INTERVILLE</td>	
                <td><?php echo $user["User"]["kilometrage_interville"]; ?> DH</td>
                <td><?php  echo $interville; ?> Km</td>
                <td><?php $km= $interville*$user["User"]["kilometrage_interville"]; echo $km; ?> DH</td>
                <td><?php echo $hotel ?> DH</td>
                <td><?php echo $restaurant ?> DH</td>
                <td><?php echo $divers ?> DH</td>
            </tr>
            
            <tr>
                <th>Total</th>	
                <td>&nbsp;</td>
                <td><?php  echo $urbain+$interville; ?> Km </td>
                <th><?php 
				$kmmax=2500;
				
				$totalkm=($urbain+$interville);
				if($totalkm<$kmmax)
				{
					$km= $urbain*$user["User"]["kilometrage_urbain"]+ $interville*$user["User"]["kilometrage_interville"];
				}
				else
				{
					$km= $user["User"]["kilometrage_urbain"]*$kmmax+(($totalkm-$kmmax)*0.6);
					echo $user["User"]["kilometrage_urbain"]."*$kmmax+(($totalkm-$kmmax)*0.6) = ";
				}
				 
				echo $km; ?> DH</th>
                <th>Total</th> 
                <td>&nbsp;</td>
                <th><?php echo $divers+$restaurant+$hotel ?> DH</th>
            </tr>
        </table>
		<h1>RECAP des congés et absences <?php echo $user["User"]["name"] ?></h1>
        <table class="table table-bordered table-striped">
            <tr>
                <?php
				unset($dataabsence["total"]);
				foreach($dataabsence as $type=>$abs)
				{
					echo "<th>".$type."</th>";
					echo "<td>".$abs["nombre"]."</td>";
					echo "<td>".$abs["dates"]."</td>";
				}?>
            </tr>
		</table>
    </div>
    <?php 	
        $objectiftotal=$nbvisitetotal=$taux=0;
        foreach($objectif as $k=>$v)
            $objectiftotal+=$v;
        foreach($nb_visites as $k=>$v)
            $nbvisitetotal+=$v;
        if($objectiftotal!=0)
            $taux=round($nbvisitetotal/$objectiftotal*100,1);
		
		//demande de RH
		$encientaux=$taux;
		if($taux>=85)
		{
			$encientaux=$taux;
			$taux=100;
		}
        $theorique=$divers+$restaurant+$hotel+$km;
    ?>
<div class="row" style="margin:36px 0px;">
    <div class="col-lg-12" style="padding: 0 25px;">
        <div class="panel panel-primary" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="panel-heading" style="width: 100%;">
                <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;">
                    </span>Ajustement de note de frais
						<?php $pret=$this->requestaction("/avences/system_get_pret_for_notedefrais/".$user["User"]["id"]);
							
							if(!empty($pret))
							{
								echo "<span style='color: red; font-weight: bold;'>VM a un ".$pret["Avence"]["type"]." de montant ".$pret["Avence"]["montant"]." DH demander le".$pret["Avence"]["created"]." </span>";
							}
						?>
					</h3>
            </div>
            <div class="panel-body" style="padding: 21px 0;box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px!important;">
                <div class="col-lg-9">
                    <div class="panel panel-primary">
                        <div class="panel-body form-horizontal payment-form">
                            <?php 
							
							$types=array();
							$types[0]="Choisissez la nature d'ajustement";
							
							if(!empty($notevalidations))
							{
								$tps=explode(";",$notevalidations["Notevalidation"]["choix"]);
								foreach($tps as $k=>$v)
								{
									if(strlen($v)<2)
										continue;
									$types[$v]=$v;
								}
							}

							echo $this->Form->create('Notefrai',array("url"=>array("action"=>"ajustement")));
							echo $this->Form->hidden('date_debut', array('value' =>$date_debut));
							echo $this->Form->hidden('date_fin', array('value' =>$date_fin ));
							echo $this->Form->hidden('mois', array('value' =>$mois ));
							echo $this->Form->hidden('user_id', array('value' =>$user["User"]["id"]));
							echo $this->Form->hidden('taux', array('value' =>$taux ));
							echo $this->Form->input('nature', array("options"=>$types,'label' => "Nature d'ajustement",'class' => 'form-control'));
							echo $this->Form->input('ajustement', array('label' => 'Ajustement du montant','class' => 'form-control'));
							echo $this->Form->input('commentaire', array('label' => 'Commentaire','class' => 'form-control'));
								
							
							if(empty($noteajouter)){
								echo $this->Form->hidden('next_user_auto_id', array('value' =>$next_user_auto_id));
								echo $this->Form->hidden('thiorique', array('value' =>$theorique));
								echo $this->Form->hidden('definitif', array('label' => 'Note de frais definitif', "value"=>round($theorique*$taux/100,1),'class' => 'form-control','readonly'));								
								echo $this->Form->end(array('label' => 'Ajouter la note de frais', 'class' => 'btn btn-primary btn-large',"id"=>"envoyedata" ,'div' => array('class' => 'well text-center col-md-12 col-xs-12','style'=>'margin:10px 0px;')));
							}
							else 
							{
								echo $this->Form->hidden('thiorique', array("value"=>$noteajouter["Notefrai"]["thiorique"],'class' => 'form-control'));
								echo $this->Form->hidden('definitif', array('label' => 'Note de frais definitif', "value"=>round($theorique*$taux/100,1)+$noteajouter["Notefrai"]["ajustement"],'class' => 'form-control'));
                                ?>
								<div class="well text-center col-md-12 col-xs-12" style="margin:10px 0px;">
									<input class="btn btn-primary btn-large" type="submit" value="Ajouter la note de frais">
								</div>
								<?php echo $this->Form->end();
							}
							?>
                           <div class="col-md-12">
                                <div class="box box-warning direct-chat direct-chat-warning collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Historiques des ajustements</h3>
                                        <div class="box-tools pull-right">
                                            <span data-toggle="tooltip" title="" class="badge bg-yellow badge_ajustement" data-original-title="3 New Messages"></span>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="direct-chat-messages histo_ajust">
                                        <?php 
										$ajustement=0;
										foreach($noteajustements as $c): 
											if(strlen($c["Noteajustement"]["nature"])<3) 
												continue;
											$ajustement+=$c["Noteajustement"]["ajustement"]; ?>
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name name_user pull-left"><?php echo $c["User"]["name"];?></span>
                                                    <span class="direct-chat-timestamp pull-right motant"><?php echo $c["Noteajustement"]["ajustement"];?> DH</span>
                                                </div>
                                                <div class="direct-chat-text">
                                                    Nature : <?php echo $c["Noteajustement"]["nature"];?>
													<br>
                                                    <?php echo $c["Noteajustement"]["commentaire"];?>
                                                </div>
												<span class="direct-chat-timestamp pull-right"><?php echo  $c["Noteajustement"]["created"];?></span>
                                            </div>
                                        <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                                <!--/.direct-chat -->
                            </div> 
							
							
							<div class="col-md-12">
                                <div class="box box-warning direct-chat direct-chat-warning collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Historiques des validations</h3>
                                        <div class="box-tools pull-right">
                                            <span data-toggle="tooltip" title="" class="badge bg-yellow badge_validation" data-original-title="3 New Messages"></span>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="direct-chat-messages histo_valid">
                                        <?php 
										$ajustement=0;
										foreach($noteajustements as $c): 
											if(strlen($c["Noteajustement"]["nature"])>2) 
												continue;?>
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left"><?php echo $c["User"]["name"];?></span>
                                                    
                                                </div>
                                                <div class="direct-chat-text">
                                                    Etat : <?php 
													$nature="Comentaire";
													if($c["Noteajustement"]["nature"]==1) 
														$nature="Valider";
													elseif($c["Noteajustement"]["nature"]==-1) 
														$nature="Réfusé";
													echo $nature;?>
													<br>
                                                    <?php echo $c["Noteajustement"]["commentaire"];?>
                                                </div>
												<span class="direct-chat-timestamp pull-right"><?php echo  $c["Noteajustement"]["created"];?></span>
                                            </div>
                                        <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                                <!--/.direct-chat -->
                            </div> 
                        
						
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 28px;">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                            <h3 id="theorique"><?php echo $theorique; ?><sup style="font-size: 20px">DH</sup></h3>
                                <p>Total Théorique</p>
                            </div>
                        </div>
                        </div>
						<div class="col-lg-12 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3 id="ajustement" ><?php echo $ajustement ?><sup style="font-size: 20px">DH</sup></h3>
                                    <p>Ajustement de note de frais</p>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-12 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="final"><?php echo $theorique+$ajustement;?><sup style="font-size: 20px">DH</sup></h3>
                                    <p>Note de frais final <br>Theorique +Ajustement</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="box-footer text-center">
                    <button class="btn btn-success" onclick="valide_user('accept')">Accepter</button>
                     <button class="btn btn-danger" onclick="valide_user('refuse')">Refusée</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
</div>
</div>
</div>


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
        echo $this->Form->create('Notefrai', array('class' => 'notefraisform', 'url' => array('action' => 'valider', 1, $mois)));
        ?>
        <input type="hidden" name="data[Notefrai][ids_remove]" id="input_ids" value="<?php echo $user["User"]["id"] ?>">
        <?php echo $this->Form->input('commentaire', array('class' => 'form-control select2'));
        
     ?>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="remove_tiri()">Fermer</button>
<button type="button" class="btn btn-primary" onclick="submit_form()">Envoyer</button>
</div>
</div>

</div>

</div>

<?php
//                        AAAABBBDDD HAMIDD   9ra hadchi 
//hna il faut attention une fois cliquer 3la button submit désactive button bach maysiftch requete deux fois !!!!!!//
//dibutton valider une fois ycliquer tal3 model fih commentaire   khass ykouno deux button whda validé et l'autre réfusé 
//si il clique 3la refusé badel 1 b -1 f action ["action"=>"valider",-1,$user["User"]["id"],$mois]];

// echo $this->Form->create('Notefrai',["url"=>["action"=>"valider",1,$user["User"]["id"],$mois]]);
// echo $this->Form->input('commentaire', array('class' => 'form-control select2'));
// echo $this->Form->end(array('label' => 'Ajouter'));


echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
    echo $this->Html->script('daterangepicker');
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q&amp;"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(function() {
    var table = $('#example1, #example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "bSort": false,
        "iDisplayLength": 50,
        "aaSorting": [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    format: {
                        body: function (data, row, column, node) {
                            // Remove 'DH', '&nbsp;' and any other HTML entities
                            return data.replace(/&nbsp;/g, ' ').replace(' DH', '').trim();
                        }
                    }
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
                var date = action+"?date="+startDate+"--"+endDate;
                $('#dateform').attr('action', date);
                $('#dateform').submit();
            });
    });
</script>
<script type="text/javascript">
$("#NotefraiAjustement").keyup(function() {
    var ajust=$(this).val();
	$("#ajustement").text("");
    $("#ajustement").append(ajust+"<sup style='font-size: 20px'>DH</sup>");
    var theorique =$("#NotefraiThiorique").val();
    var taux=$("#NotefraiTaux").val();
	var total=parseFloat(theorique);
    total=((total*taux)/100).toFixed(1);
	total=parseFloat(total) + parseFloat(ajust);
	var finall=parseFloat(theorique) + parseFloat(ajust);
    $("#NotefraiDefinitif").val(total.toFixed(2))
    $("#note").text("");
    $("#note").append(total.toFixed(2)+"<sup style='font-size: 20px'>DH</sup>");
	$("#final").text("");
    $("#final").append(finall.toFixed(2)+"<sup style='font-size: 20px'>DH</sup>");
})
$(".visitemaps").click(function () {
            visitesmaps($(this).attr('id'))
        });
    var locations=<?php echo json_encode($gps);?>;
    function visitesmaps(date) {
    var curgpes="";
    for (let index = 0; index < locations[date].length; index++) {
         if(locations[date][index].gps!="," && locations[date][index].gps!="0.0,0.0"){
          curgpes=locations[date][index].gps;
          break;
         }
         else
         curgpes="31.792305849269,-7.080168000000015"

    }
    console.log(curgpes)
    curgpes =curgpes.split(',');
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(curgpes[0],curgpes[1]),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
   
    for (i = 0; i < locations[date].length; i++) { 
        if(locations[date][i].gps!=","){
            var gps =locations[date][i].gps.split(',');
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(gps[0],gps[1]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(locations[date][i].nom);
                infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
}
  </script>
  
  

<script>
    window.onload = function() {
		//alert("ok");
        // Sélectionnez le bouton "Send Data" par son ID
        var boutonSend = document.getElementById('envoyedata');

        // Vérifiez si le bouton existe avant de déclencher le clic
		next_user_auto_id=<?php echo $next_user_auto_id; ?>;
        if (boutonSend && next_user_auto_id!=-1) 
		{
			//alert(next_user_auto_id);
            boutonSend.click(); // Cliquez sur le bouton "Send Data"
        }



        var count_histo_ajust = $(".histo_ajust .direct-chat-msg").length;
        var count_histo_valid= $(".histo_valid .direct-chat-msg").length;
        $(".badge_ajustement").html(count_histo_ajust);
        $(".badge_validation").html(count_histo_valid);



    };
</script>


<script type="text/javascript">
    function valide_user(parm){
                    action_attr = $('.notefraisform').attr("action");
                    if(parm == "accept"){
                        
                        $('.refuse').hide();
                        $('.accept').show();
                    }else{
                        console.log(action_attr);
                        if(action_attr.includes('/1/')){
                            
                            action_attr = action_attr.split('/1/').join('/-1/');
                            $('.notefraisform').attr("action",action_attr);
                        }
                         $('.accept').hide();
                         $('.refuse').show();
                    }
                    $("#modal-valid").modal('show');
        }

        function remove_tiri(){
            var newAction = $('.notefraisform').attr("action").replace(/-/g, '');
            $('.notefraisform').attr("action", newAction);
        }
        function submit_form(){
            $(".notefraisform").submit();
        }

</script>


