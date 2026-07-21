<style>
.box .nav-stacked>li {
    border-bottom: 1px solid #f4f4f4;
    margin: 0;
    padding-left: 6px;
    min-height: 38px;
    height: auto;
	width:100%;
	float:left;
    margin-bottom: 2px;
    padding-right: 4px;
}
</style>
<div class="row">
    <?php if (isset($client)){ ?>
        <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua col-xs-12" style="height:82px;">
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username" style="margin-left: 0px;float:left;width:auto;"><?php echo $client['Client']['nom'] . ' ' . $client['Client']['prenom']; ?></h3>
                </div>
                <div class="box-footer">
                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 4px;">
                        <ul class="nav nav-stacked">
                            <li>
                                    Type <span class="pull-right"><?php echo $client['Type']['name']; ?></span>
                            </li>
                            <li> Secteur <span class="pull-right">
                                        <?php echo $client['Secteur']['full_name']; ?>
                                    </span>
                            </li><?php if (!empty($client['Category']['id'])){?>
                            <li>Catégorie <span class="pull-right"><?php echo $client['Category']['name']; ?></span></li>
							<?php } ?>
								   <?php if (!empty($client['Category1']['id'])){?>
                            <li>Tendance <span class="pull-right"><?php echo $client['Category1']['name']; ?></span></li><?php } ?>
								   <?php if (!empty($client['Client']['titre'])){?>
                            <li>Titre <span class="pull-right "><?php echo h($client['Client']['titre']); ?></span></li><?php } ?>
							<?php if (!empty($client['Client']['activite'])){?>
                            <li>Activité <span class="pull-right "><?php echo h($client['Client']['activite']); ?></span></li><?php } ?>
							<?php if (!empty($client['Client']['exercice'])){?>
                            <li>Exercice <span class="pull-right "><?php echo h($client['Client']['exercice']); ?></span></li><?php } ?>
                        </ul>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 4px;">
                        <ul class="nav nav-stacked">
						<?php if (!empty($client['Client']['potentialite'])){?>
                            <li>Potentialité <span class="pull-right "><?php echo h($client['Client']['potentialite']); ?></span></li><?php } ?>
                            <li>E-mail <span class="pull-right "><?php echo h($client['Client']['mail']); ?></span></li>
                            <li>Fixe <span class="pull-right "><?php echo h($client['Client']['fixe']); ?></span></li>
                            <li>Fax <span class="pull-right "><?php echo h($client['Client']['fax']); ?></span></li>
                            <li>Adresse <span class="pull-right "><?php echo h($client['Client']['adress']); ?></span></li>
							<?php if (!empty($client['Client']['potentialitev2'])){?>
                            <li>Classification <span class="pull-right "><?php echo h($client['Client']['potentialitev2']); ?></span></li><?php } ?>
							<?php if (!empty($client['Client']['produit'])){?>
                            <li>Produits lié <span class="pull-right ">
                            <?php 
                            $produits=  explode(",", $client['Client']['produit']);
                            if(strlen($produits[0])>0)
                            {
                                for($i=0;$i<count($produits);$i++)
                                    echo $this->requestAction('/games/system_get_name_game/' . $produits[$i])."<br>";
                            }?>
                                </span>
                        </li><?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } 
	else {
	$client=$clientspropose;
	$client['Client']=$clientspropose['Clientspropose'];
	
}	?>

    <div class="col-md-6">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-aqua col-xs-12" style="height:82px;">
                <h3 class="widget-user-username" style="margin-left: 0px;float:left;width:auto;"><?php echo $clientspropose['Clientspropose']['nom'] . ' ' . $clientspropose['Clientspropose']['prenom']; ?></h3>

            </div>
            <div class="box-footer">
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 4px;">
                    <ul class="nav nav-stacked">
                        <li <?php 
								if ($client['Type']['name'] != $clientspropose['Type']['name'])
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>
                                Type <span class="pull-right"><?php echo $clientspropose['Type']['name']; ?></span>
                        </li>
                        <li <?php 
								if ($client['Secteur']['full_name'] != $clientspropose['Secteur']['full_name'])
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>
                                Secteur <span class="pull-right">
                                    <?php echo $clientspropose['Secteur']['full_name']; ?>
                                </span>
                        </li>
						<?php if (!empty($clientspropose['Category']['id'])){?>
                        <li <?php 
								if ($client['Category']['name'] != $clientspropose['Category']['name'])
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Catégorie <span class="pull-right"><?php echo $clientspropose['Category']['name']; ?></span></li>
							   <?php } ?>
							   <?php if (!empty($clientspropose['Category1']['id'])){?>
                        <li <?php 
								if ($client['Category1']['name'] != $clientspropose['Category1']['name'] && $clientspropose['Category']['name']!=$clientspropose['Category1']['name'])
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Tendance <span class="pull-right"><?php echo $clientspropose['Category1']['name']; ?></span></li><?php } ?>
							  <?php if (!empty($clientspropose['Clientspropose']['titre'])){?> 
                        <li <?php 
								if (h($client['Client']['titre']) != h($clientspropose['Clientspropose']['titre']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Titre <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['titre']); ?></span></li><?php } ?>
						<?php if (!empty($clientspropose['Clientspropose']['activite'])){?> 
                        <li <?php 
								if (h($client['Client']['activite']) != h($clientspropose['Clientspropose']['activite']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Activité <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['activite']); ?></span></li><?php } ?>
						<?php if (!empty($clientspropose['Clientspropose']['exercice'])){?> 
                        <li <?php 
								if (h($client['Client']['exercice']) != h($clientspropose['Clientspropose']['exercice']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Exercice <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['exercice']); ?></span></li><?php } ?>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 4px;">
                    <ul class="nav nav-stacked">
					<?php if (!empty($clientspropose['Clientspropose']['potentialite'])){?>
                        <li <?php 
								if (h($client['Client']['potentialite']) != h($clientspropose['Clientspropose']['potentialite']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Potentialité <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['potentialite']); ?></span></li><?php } ?>
                        <li <?php 
								if (h($client['Client']['mail']) != h($clientspropose['Clientspropose']['mail']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>E-mail <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['mail']); ?></span></li>
                        <li <?php 
								if (h($client['Client']['fixe']) != h($clientspropose['Clientspropose']['fixe']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Fixe <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['fixe']); ?></span></li>
                        <li <?php 
								if (h($client['Client']['fax']) != h($clientspropose['Clientspropose']['fax']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Fax <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['fax']); ?></span></li>
                        <li <?php 
								if (h($client['Client']['adress']) != h($clientspropose['Clientspropose']['adress']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Adresse <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['adress']); ?></span></li>
						<?php if (!empty($clientspropose['Clientspropose']['potentialitev2'])){?> 
                        <li <?php 
								if (h($client['Client']['potentialitev2']) != h($clientspropose['Clientspropose']['potentialitev2']))
									echo 'style="border-right: 3px solid rgba(19, 144, 57, 0.87);"';
							?>>Classification <span class="pull-right "><?php echo h($clientspropose['Clientspropose']['potentialitev2']); ?></span></li><?php } ?>
                    </ul>
                </div>
				<div class="col-md-12 col-sm-12 col-xs-12" style="padding-right: 0px;padding-left: 0px;">
					<ul class="nav nav-stacked">
						<?php if (!empty($clientspropose['Clientspropose']['produit'])){?> 
                        <li style="border-top:1px solid #eee;padding-bottom:4px;">Produits liés <span class="pull-right ">
                            <?php 
                            $produits=  explode(",", $clientspropose['Clientspropose']['produit']);
                            if(strlen($produits[0])>0)
                            {
                                for($i=0;$i<count($produits);$i++)
                                    echo $this->requestAction('/games/system_get_name_game/' . $produits[$i])." | ";
                            }?>
                                </span>
                        </li><?php } ?>
					</ul>
				</div>
            </div>   
        </div>

    </div>
	
	<div class="col-md-12">
		<div class="col-md-6" style="float:right;">
		<?php
		echo '<div class="col-xs-3">'.$this->Html->link('Editer', array('action' => 'edit', $clientspropose['Clientspropose']['id'], 1), array('class' => 'btn btn-primary btn-block btn-right', 'style' => "margin-bottom: 10px;")).'</div>';
		$valide = 2;
		if (AuthComponent::user('role') == "Super viseur")
			$valide = 2;
		if (AuthComponent::user('role') == "Responsable promotion")
			$valide = 2;
		echo '<div class="col-xs-3">'.$this->Html->link('Valider', array('action' => 'valider', $clientspropose['Clientspropose']['id'], $valide), array('class' => 'btn btn-primary btn-block btn-right', 'style' => "margin-bottom: 10px;")).'</div>';
		echo '<div class="col-xs-3">'.$this->Html->link('Archiver', array('action' => 'valider', $clientspropose['Clientspropose']['id'], -1), array('class' => 'btn btn-primary btn-block btn-right', 'style' => "margin-bottom: 10px;")).'</div>';
		?>
		</div>
	</div>
</div>