
<?php foreach ($users as $vmp): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Rapport des visites de l'équipe de <?php echo $vmp['super']['User']['name']; ?>
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover"  border="0">
                        <tbody>
                            <tr>
                                <th>POTENTIALITE</th>
                                <th>Nbr Clients</th>
                                <th>Nbr Affectee</th>
                                <th>Nbr  Visite</th>
                                <th>Nbr de retard</th>
                                <th>NB action</th>
                                <th>Clients</th>
                            </tr>
                        </tbody>
                        <?php $i = 0; foreach ($info[$vmp['super']['User']['id']] as $v) :?>
                                <tr>
                                    <th><?php echo $v["pot"]; ?></th>
                                    <th><?php echo $v["nombre"]; ?></th>
                                    <th><?php echo $v["visite_planifier"]; ?></th>
                                    <th><?php echo $v["visite"]; ?></th>
                                    <th><?php echo $v["visite_planifier"]-$v["visite"]; ?></th>
                                    <th><?php echo $v["action"]; ?></th>
                                    <th><a class="btn btn-primary" style="cursor:pointer;" data-toggle="modal" data-target="#myModal<?php echo $i;?>">Afficher Clients</a></th>
                                </tr>
								<div id="myModal<?php echo $i++;?>" class="modal fade" role="dialog">
									<div class="modal-dialog" style="width: 66%;">
										<div class="modal-content" style="float:left;width:100%;">
											<div class="modal-header" style="float:left;width:100%;">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">La liste des clients</h4>
											</div>	
											<div class="modal-body" style="float:left;width:100%;">
												<?php $clients=  explode(',', $v["clients"]);
													foreach ($clients as $key => $value) {
														if($value==0)
															continue;
														$client=$this->requestaction("/clients/system_get_client/$value");
														//debug($client);
														$etoile="";
														if(count($client['Action'])!=0)
														{
															foreach($client['Action'] as $actions)
															{
																//debug($actions);
																if(($actions["date_debut"]>=$date_debut && $actions["date_debut"]<=$date_fin) || ($actions["date_fin"]>=$date_debut && $actions["date_fin"]<=$date_fin) )
																{
																	$etoile="<i class='fa fa-star' style='color: #fe3;'></i>";
																}
															}
														}
														echo "<span style='color:#105e8c;margin: 1px 2px;width:auto;float:left;padding: 2px 2px;border:1px solid #105e8c;border-radius:3px;'>".$this->Html->link($client["Client"]["nom"]." ".$client["Client"]["prenom"],array('action'=>'view',$value))."$etoile</span>";
													}
												?>
										  </div>
										  <div class="modal-footer" style="float:left;width:100%;">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										  </div>
										</div>
									</div>
								</div>
                        <?php endforeach;   ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>