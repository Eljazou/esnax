<style>
/* ================== MODERN RESTYLE (CSS/SVG only — no PHP touched) ================== */
.ptg-wrapper{
	--ptg-purple: #7C6FF0;
	--ptg-purple-dark: #6152d9;
	--ptg-purple-soft: #EFECFD;
	--ptg-teal: #14b8a6;
	--ptg-teal-soft: #E6F9F6;
	--ptg-text: #2c2e3a;
	--ptg-muted: #8a8fa3;
	--ptg-border: #ececf5;
	font-family: inherit;
	color: var(--ptg-text);
}

/* ---- generic card look for every .box on the page ---- */
.ptg-wrapper .box{
	background: #fff;
	border: 1px solid var(--ptg-border);
	border-radius: 16px !important;
	box-shadow: 0 4px 18px rgba(124,111,240,0.08);
	overflow: hidden;
	margin-bottom: 20px;
}
.ptg-wrapper .box.box-solid,
.ptg-wrapper .box.box-info{
	border-top: none;
}
.ptg-wrapper .box-header{
	background: transparent;
	border: none !important;
	padding: 18px 22px;
	display: flex;
	align-items: center;
	gap: 12px;
}
.ptg-wrapper .box-header .box-title{
	font-weight: 600 !important;
	font-size: 15px !important;
	color: var(--ptg-text) !important;
	margin: 0 !important;
	display: flex;
	align-items: center;
	gap: 12px;
}
.ptg-wrapper .box-body{
	padding: 0 22px 22px 22px;
}

/* icon chip shown before a box title */
.ptg-icon-chip{
	width: 34px;
	height: 34px;
	min-width: 34px;
	border-radius: 10px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
}
.ptg-icon-chip.teal{ background: var(--ptg-teal-soft); color: var(--ptg-teal); }
.ptg-icon-chip.purple{ background: var(--ptg-purple-soft); color: var(--ptg-purple); }
.ptg-icon-chip svg{ width: 18px; height: 18px; display:block; }

/* round action button top-right of a box (plus / sliders / chevron) */
.ptg-wrapper .box-tools{
	margin-left: auto;
}
.ptg-wrapper .box-tools .btn-box-tool,
.ptg-action-btn{
	width: 34px;
	height: 34px;
	border-radius: 10px;
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple-dark) !important;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	border: none;
	transition: background .15s ease, transform .15s ease;
}
.ptg-wrapper .box-tools .btn-box-tool:hover,
.ptg-action-btn:hover{
	background: var(--ptg-purple);
	color: #fff !important;
}
.ptg-wrapper .box-tools .btn-box-tool i{
	font-size: 14px;
}

/* ---- Date filter card ---- */
.ptg-date-card .box-header{
	padding: 20px 22px;
}
.ptg-date-label{
	font-weight: 600;
	font-size: 15px;
	color: var(--ptg-text);
	display: flex;
	align-items: center;
	gap: 12px;
	white-space: nowrap;
}
.ptg-date-field-wrap{
	position: relative;
	width: 100%;
	max-width: 420px;
}
.ptg-date-field-wrap .input-group{
	width: 100%;
}
.ptg-date-field-wrap .input-group-addon{
	background: #fff !important;
	border: 1px solid var(--ptg-border) !important;
	border-right: none !important;
	border-radius: 12px 0 0 12px !important;
	color: var(--ptg-purple);
}
.ptg-date-field-wrap .form-control{
	border: 1px solid var(--ptg-border) !important;
	border-left: none !important;
	border-radius: 0 12px 12px 0 !important;
	box-shadow: none !important;
	height: 42px;
	padding-right: 34px;
	color: var(--ptg-text);
	font-size: 14px;
}
.ptg-date-field-wrap .form-control:focus{
	border-color: var(--ptg-purple) !important;
}
.ptg-chevron{
	position: absolute;
	right: 12px;
	top: 50%;
	transform: translateY(-50%);
	pointer-events: none;
	color: var(--ptg-muted);
}
.ptg-chevron svg{ width: 16px; height: 16px; display: block; }

/* ---- table styling shared by every box (per-VM tables + recap) ---- */
.ptg-wrapper .table{
	border-collapse: separate;
	border-spacing: 0;
}
.ptg-wrapper .table thead tr th,
.ptg-wrapper .table tbody tr:first-child th,
.ptg-wrapper .table tbody tr:first-child td{
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple-dark);
	font-weight: 600;
	font-size: 12.5px;
	text-transform: uppercase;
	letter-spacing: .02em;
	border: none !important;
	padding: 12px 14px !important;
}
.ptg-wrapper .table tbody tr:first-child th:first-child,
.ptg-wrapper .table tbody tr:first-child td:first-child{
	border-radius: 10px 0 0 10px;
}
.ptg-wrapper .table tbody tr:first-child th:last-child,
.ptg-wrapper .table tbody tr:first-child td:last-child{
	border-radius: 0 10px 10px 0;
}
.ptg-wrapper .table tbody tr:not(:first-child) td{
	border-top: 1px solid var(--ptg-border) !important;
	padding: 12px 14px;
	font-size: 13.5px;
	color: var(--ptg-text);
	vertical-align: middle;
}
.ptg-wrapper .table-hover tbody tr:hover{
	background: #fafaff;
}

/* Les informations legend table keeps its own light look */
.ptg-wrapper .no-margin td{
	border: none !important;
	padding: 6px 10px !important;
	background: transparent !important;
}

/* time chips inside the per-visit column */
.ptg-wrapper .time_visite{
	border: 1px solid var(--ptg-border);
	box-shadow: none;
	background: #fafaff;
	padding: 5px 10px;
	border-radius: 8px;
	margin: 3px;
}

/* labels in the legend box */
.ptg-wrapper .label{
	border-radius: 5px;
}
</style>
<div class="ptg-wrapper">
<?php
// Consolidation des appels CSS et JS
echo $this->Html->css(['daterangepicker', 'dataTables.bootstrap', '_all-skins.min']);
echo $this->Html->script(['jquery-2.2.3.min', 'select2.full.min', 'bootstrap.min', 'app.min', 'jquery.dataTables.min', 'jquery.slimscroll.min', 'fastclick', 'demo']);


function distance($longitude,$latitude,$client_longitude,$client_latitude)
{
	
	$distance= "-1";
	if($longitude!="" && $longitude!=0)
	{
		$distance= "-1";
		if($client_longitude!="" && $client_longitude!=0 && $client_longitude!="0.0" && $client_longitude!=null)
		{
			$lat1=$client_latitude;
			$lon1=$client_longitude;
			$lat2=$latitude;
			$lon2=$longitude;
			$theta = $lon1 - $lon2;
			//echo "$lat1 --- $lon1 --- $lat2 --- $lon2<br>";
			@$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

			
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$distance=round($miles * 1.609344 ,1);
		}
	}
	return $distance;
}
?>
<div class="row">
	<div class="col-md-12" style="margin-bottom: 24px;"> 
		<div class="box form-group ptg-date-card">
			<div class="box-header with-border">
				<label class="ptg-date-label" style="margin:0;">
					<span class="ptg-icon-chip teal">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
					</span>
					Date
				</label>
				<div class="col-md-6 ptg-date-field-wrap" style="padding-left:0;">
					<form action="<?php echo $this->Html->url(array("action"=>"pointage")); ?>" method="get" id="dateform">
						<div class="input-group col-lg-12" style="float:left;">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
						</div>
						<span class="ptg-chevron">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
						</span>
					</form>
				</div>
			</div>
		</div>
	</div>		
</div>
<div class="row">
	<div class="col-md-12" style="margin-bottom: 24px;"> 
	<div class="box box-info collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
				<span class="ptg-icon-chip teal">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="11" x2="12" y2="16"></line><circle cx="12" cy="8" r="0.5" fill="currentColor" stroke="currentColor"></circle></svg>
				</span>
				Les informations
			  </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
              <div class="table-responsive">
                <table class="table no-margin">
                  <tbody>
                  <tr>
					<td><span style="padding-left: 38px;    padding-top: 7px;margin-left:2px" class="label label-danger">  </span> </td>
					<td>Client localisé et visite pas chez client (au-delà de 500m)</td>
                  </tr>
                  <tr>
				  <td><span style="padding-left: 38px;    padding-top: 7px;margin-left:2px;background:#30d930 !important" class="label label-success">  </span> </td>
				  <td>Client localisé et visite chez client (moins de 500m)</td>
                  </tr>
                  <tr>
				  <td><span style="padding-left: 38px;padding-top: 7px;margin-left:2px" class="label label-warning">  </span> </td>
				  <td>Client non localisé mais visite localisée</td>
                  </tr>
				  <tr>
				  <td><span style="padding-left: 38px;padding-top: 7px;    margin-left:2px;" class="label label-info">  </span> </td>
				  <td>Client localisé mais visite non localisée</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
	</div>		
</div>
<?php
$data=array();
$visite1_longitude=$visite1_latitude=0;
foreach ($visites as $value) 
{
	
	if($visite1_latitude==0)
	{
		$visite1_longitude=$value["Visite"]["longitude"];
		$visite1_latitude=$value["Visite"]["latitude"];
	}
	$value["Visite"]["client_longitude"]=$value["Client"]["longitude"];
	$value["Visite"]["client_latitude"]=$value["Client"]["latitude"];
	$value["Visite"]["distance"]=distance($value["Visite"]["longitude"],$value["Visite"]["latitude"],$value["Client"]["longitude"],$value["Client"]["latitude"]);
		
	$nom=$value["User"]["name"];
    $v=$value["Visite"];
	$v["user_id"]=$nom;
    $d= explode(" ", $v["date"]);
    if($d[1]=="00:00:00")
    {
        $dd= explode(" ", $v["created"]);
        $dd=$dd[1];
    }
    else
        $dd=$d[1];
	
    if(!isset($data[$v["user_id"]][$d[0]]))
    {
        $data[$v["user_id"]][$d[0]]["date_debut"]=$d[0]." ".$dd;
        $data[$v["user_id"]][$d[0]]["date_fin"]=$d[0]." ".$dd;
		$visite1_latitude=$v["voloiseau"]=0;
		$data[$v["user_id"]][$d[0]]["data"][]=$v;
		$data[$v["user_id"]][$d[0]]["timer"]=0;
		$data[$v["user_id"]][$d[0]]["timer_nombre"]=0;
    }
    else
    {
		$v["voloiseau"]=distance($v["longitude"],$v["latitude"],$visite1_longitude,$visite1_latitude);
		$visite1_longitude=$v["longitude"];
		$visite1_latitude=$v["latitude"];
	
		$data[$v["user_id"]][$d[0]]["data"][]=$v;
        $dd1=$d[0]." ".$dd;
        $dds1=strtotime($dd1);
        $dd2=$data[$v["user_id"]][$d[0]]["date_debut"];
        $dds2=strtotime($dd2);
        if($dds1<$dds2)
            $data[$v["user_id"]][$d[0]]["date_debut"]=$d[0]." ".$dd;
        $dd2=$data[$v["user_id"]][$d[0]]["date_fin"];
        $dds2=strtotime($dd2);
        if($dds1>$dds2)
            $data[$v["user_id"]][$d[0]]["date_fin"]=$d[0]." ".$dd;
    }
	
	//timer
	$datatimer=explode(" ",$value["Visite"]["timer"]);
	if($value["Client"]["activite"]=="Prive" && count($datatimer)==2)
	{
		$timer=$datatimer[0];
		if($datatimer[1]=="min")
		{
			$timer=$timer*60;
		}
		else if($datatimer[1]=="heure")
		{
			//max une heure pour ne pas faussé la data
			$timer=3600;
		}
		$data[$v["user_id"]][$d[0]]["timer"]+=$timer;
		$data[$v["user_id"]][$d[0]]["timer_nombre"]++;
	}
}
?>
<div class="row">
	<?php 
	$localisations=array();
	foreach($data as $user => $p):?>
		<div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
						<span class="ptg-icon-chip purple">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4 4-6 8-6s8 2 8 6"></path></svg>
						</span>
                        <?php echo $user; ?> 
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover"  border="0">
                        <tbody>
                            <tr>
                                <th>Date</th>
								<th>N° Visite</th>
								<th>Temp Moyen chez medcin</th>
                                <th>Premier visite</th>
                                <th>Denier visite</th>
								<th>Info</th>
                                <th>Total</th>
								<td>Localisation</td>
								<!-- <td>Vol oiseau</td> -->
								
                            </tr>
                            <?php 
							$moyenne_debut=$moyenne_fin=$nbvisite=0;
							$moyenne_time=$nombre_jour_for_time=0;
							foreach($p as $id => $v):
								$nbvisite++;
								$timer="0";
								if($v["timer_nombre"]!=0)
								{
									$timer= round($v["timer"]/60/$v["timer_nombre"],0);
								}
								$nombre_jour_for_time++;
								$moyenne_time+=$timer;
								$v["date_debut"]= date('H:i',strtotime( $v["date_debut"]));
								$v["date_fin"]= date('H:i',strtotime( $v["date_fin"]));
								$moyenne_debut+=str_replace(":",'',$v["date_debut"]);
								$moyenne_fin+=str_replace(":",'',$v["date_fin"]);
								
							?>
                            <tr>
                                <td><?php echo $id; ?></td>
								<td><?php echo count($v["data"]); ?></td>
								<td><?php //if($timer==0) $timer="--"; 
								echo $timer;?> Min</td>
                                <td><?php echo $v["date_debut"]; ?></td>
                                <td><?php echo $v["date_fin"];?></td>
								<td class="td_time">
									<?php 
									$clientLocaliser=$visiteReel=$voloiseau=0;
									$br=1;
									foreach($v["data"] as $visite)
									{
										$style="";
										if($visite["client_longitude"]=="" || $visite["client_longitude"]==null)
											$style='color: #ffd000; ';
										if($visite["distance"]!=-1)
										{
											$clientLocaliser++;
											$voloiseau+=$visite["voloiseau"];
											if($visite["distance"]<=0.8)
											{
												$visiteReel++;
												$style='color: #30d930;';
											}
											else
												$style='color: red; ';
										}
											
										$d= explode(" ", $visite["date"]);
										if($d[1]=="00:00:00")
										{
											$dd= explode(" ", $visite["created"]);
											$heure=$dd[1];
										}
										else
											$heure=$d[1];
										$heure=explode(":",$heure);?>
										<span class="time_visite">
											<?php  echo $this->Html->link("$heure[0]:$heure[1] ",array('controller'=>'clients','action'=>"view",$visite["client_id"]),array("style"=>"$style font-size: large;","target"=>"_blanck"));?></span>

										<?php
										$pos = strpos($visite['longitude'], "n");
										$poss = strpos($visite['longitude'], "0.0");
										if(!empty($visite['longitude']) && $pos === false && $poss === false)
											// echo '<i class="fa fa-map-marker"></i></a>';
										if($br%7==0)
											echo "<br>";
										$br++;
									}
										
									?>
								</td>
                                <td><?php $start = date_create($v["date_debut"]);
                                            $end = date_create($v["date_fin"]);
                                            $diff=date_diff($end,$start);
                                            echo $diff->h." H ".$diff->i." min ";  ?>
								</td>
								<td> <?php
								if(!isset($localisations[$user]))
								{
									$localisations[$user]=array();
									$localisations[$user]["visiteReel"]=$visiteReel;
									$localisations[$user]["clientLocaliser"]=$clientLocaliser;
									$localisations[$user]["voloiseau"]=$voloiseau;
								}
								else
								{
									$localisations[$user]["visiteReel"]=$localisations[$user]["visiteReel"]+$visiteReel;
									$localisations[$user]["clientLocaliser"]=$localisations[$user]["clientLocaliser"]+$clientLocaliser;
									$localisations[$user]["voloiseau"]=$localisations[$user]["voloiseau"]+$voloiseau;
								}
								echo $visiteReel."/".$clientLocaliser;
									if($clientLocaliser!=0)
										echo " (".round($visiteReel/$clientLocaliser*100,1); 
									else 
										echo "( 100 " ?> %)</td>
								<!-- <td><?php echo $voloiseau ?> Km</td> -->
                            </tr>
                            <?php endforeach;
								if($nbvisite==0)
									$nbvisite=1;
								if($nombre_jour_for_time==0)
									$nombre_jour_for_time=1;
								$moyenne[$user]["heure_debut"]=strtoheur(round($moyenne_debut/$nbvisite,0));
								$moyenne[$user]["heure_fin"]=strtoheur(round($moyenne_fin/$nbvisite,0));
								$moyenne[$user]["time"]=round($moyenne_time/$nombre_jour_for_time,0);
								
							?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach;?>
	<div class="col-xs-12">
            <div class="box">
                <div class="box-header">
					<h3 class="box-title">
						<span class="ptg-icon-chip purple">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="20" x2="4" y2="12"></line><line x1="12" y1="20" x2="12" y2="6"></line><line x1="20" y1="20" x2="20" y2="15"></line></svg>
						</span>
						Recape
					</h3>
					<div class="box-tools pull-right">
						<span class="ptg-action-btn">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"></line><circle cx="9" cy="6" r="2"></circle><line x1="4" y1="12" x2="20" y2="12"></line><circle cx="16" cy="12" r="2"></circle><line x1="4" y1="18" x2="20" y2="18"></line><circle cx="10" cy="18" r="2"></circle></svg>
						</span>
					</div>
				</div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover"  border="0">
			<tbody>
				<tr>
					<th>VM</th>
					<th>Moyenne temp</th>
					<th>Moyenne date debut</th>
					<th>Moyenne date fin</th>
					<td>Nombre clients localisé</td>
					<td>Nombre visite réelle</td>
					<td>Pourcentage</td>
					<!-- <td>Vol oiseau</td> -->
				</tr>
				<?php foreach($localisations as $user=>$loc): ?>
					<tr>
						<td><?php echo $user ?></td>
						<td><?php echo $moyenne[$user]["time"] ?> Min</td>
						<td><?php echo $moyenne[$user]["heure_debut"] ?></td>
						<td><?php echo $moyenne[$user]["heure_fin"] ?></td>
						<td><?php echo $loc["clientLocaliser"] ?></td>
						<td><?php echo $loc["visiteReel"] ?></td>
						<td><?php $porcentage=100;
							if($loc["clientLocaliser"]!=0) 
								$porcentage=round($loc["visiteReel"]/$loc["clientLocaliser"]*100,1); 
							echo $porcentage; ?> %
						</td>
						<!-- <td><?php echo $loc["voloiseau"] ?> Km</td> -->
					</tr>
				<?php endforeach; ?>
			<tbody>
		</table>
	</div>
	</div>
	</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');?>
<script>
    $(function () {
        // Initialisation du DateRangePicker
        $('#reservationtime').daterangepicker({
            timePicker: true,            // Active le choix de l'heure comme sur votre image
            timePicker24Hour: true,      // Format 24h (00:00 à 23:59)
            showDropdowns: true,
            locale: {
                "format": "YYYY-MM-DD HH:mm",
                "separator": " -- ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "À",
                "customRangeLabel": "Personnalisé",
                "daysOfWeek": ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                "monthNames": ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                "firstDay": 1
            }
        });

        // Événement lors de la validation des dates
        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            // Récupération propre des dates formatées en chaînes de caractères
            var startDate = picker.startDate.format('YYYY-MM-DD HH:mm');
            var endDate = picker.endDate.format('YYYY-MM-DD HH:mm');
            
            var $form = $('#dateform');
            var baseAction = $form.attr('action').split('?')[0]; // Évite de dupliquer les paramètres existants si on reclique
            
            // Reconstruction propre de l'URL d'action du formulaire
            var newAction = baseAction + "?date=" + encodeURIComponent(startDate + "--" + endDate);
            
            $form.attr('action', newAction);
            $form.submit();
        });

        // Initialisation de vos DataTables
        $('#example1, #example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
</script>

<?php
/**
 * Convertit proprement une chaîne numérique ou brute en format HH:MM
 */
function strtoheur($temp)
{
    $temp = trim($temp);
    if (strlen($temp) == 1 || strlen($temp) == 0) return $temp;
    
    if (strlen($temp) == 2) {
        $temp = $temp . "00";
    }
    if (strlen($temp) == 3) {
        $temp = "0" . $temp;
    }
    
    $temp_arr = str_split($temp);
    $heure = (int)($temp_arr[0] . $temp_arr[1]);
    $min = (int)($temp_arr[2] . $temp_arr[3]);
    
    if ($min / 60 >= 1) {
        $heure += floor($min / 60);
        $min = $min % 60;
    }
    
    if ($heure > 23) {
        $heure = $heure % 24;
    }
    
    // Formatage final avec ajouts des zéros initiaux
    return sprintf("%02d:%02d", $heure, $min);
}
?>