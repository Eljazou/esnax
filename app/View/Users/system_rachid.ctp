<?php foreach($users as $vmp): ?>
	<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Rapport de visite d'equipe de <?php echo $vmp['super']['User']['name'];  ?>
                                    </h3>
                                </div>
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover"  border="1">
                                        <tbody>
                                            <tr>
                                                <th><?php echo __('VM'); ?></th>
												<?php
													$past_weeks = 4;
													$relative_time = strtotime("-5 week +1 day");//time();
													for($week_count=0;$week_count<$past_weeks;$week_count++) {
														$monday = strtotime("next Monday", $relative_time);
														$sunday = strtotime("Sunday", $monday);
														echo "<th>".date("d-m-Y", $monday)." (S".date("W", strtotime(date("Y-m-d", $monday))).")</th>";
														$relative_time = $monday;
													}
												?>
												<th>total visite</th>
												<th>Objectif</th>
												<th>Progression</th>
                                            </tr>
                                            <?php
											$objectif=0;
                                            foreach ($vmp as $visite)
											{
												$objectif=0;
												echo "<tr><td >".$visite['User']['name']."</td>";
												$t=0;
												$daba=date("W", strtotime(date("Y-m-d")));
												$past_weeks = $daba-1;
												$relative_time = strtotime("-$daba week +1 day");//time();
												for($week_count=0;$week_count<$past_weeks;$week_count++) {
													$monday = strtotime("next Monday", $relative_time);
													$sunday = strtotime("Sunday", $monday);													
													$date_debut=date("Y-m-d", $monday);
													$date_fin=date("Y-m-d", $sunday);
													$obj=$this->requestAction('/objectifs/system_get_objectif_by_date/'.$visite['User']['id'].'/'.$date_debut);
													$objectifSemaine=0;
													//existe plans de tourné de la semaine 
													$plan=$this->requestAction('/plantournes/system_existeplanification/'.$visite['User']['id'].'/'.$date_debut);
													if($plan!=0)
													{
														foreach( $obj as $ob)
														{
															$objectifSemaine=$objectifSemaine+$ob['Objectif']['objectif'];
															$objectif=$ob['Objectif']['objectif']+$objectif;
														}
													}
													$vv=0;
													foreach($visite['Visite'] as $v)
													{
														if ($date_debut <= $v['date'] && "$date_fin 23:59:59" >= $v['date'])
															$vv++;
													}
													$t=$t+$vv;
													$c="";
													if($objectifSemaine==0)
														$col=0;
													else
														$col=round($vv/$objectifSemaine, 2)*100;
													if($col<50)
														$c="red";
													else if($col<75 && $col>=50)
														$c="#eac812";
													else
														$c="green";
													if($week_count+5>$past_weeks)
														echo "<td style='color:$c;'>$col %</td>";
													$relative_time = $monday;
												}
												
												echo "<td >".$t."</td>";
												echo "<td >".$objectif."</td>";
												if($objectif==0)
													$t=0;
												else
													$t=round($t/$objectif, 2)*100;
												if($t<50)
													$c="red";
												else if($t<75 && $t>=50)
													$c="#eac812";
												else
													$c="green";
												echo "<td style='color:$c;' >$t%</td>";
												echo "</tr>";
											}
											
											?>
                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>