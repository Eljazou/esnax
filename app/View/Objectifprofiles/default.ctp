<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CRM VMP</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('style.min');
        echo $this->Html->css('skin-blue.min');
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">
                 <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view')); ?>" class="logo">
                    <span class="logo-mini" style="font-weight: lighter;"><e style="font-weight: bold;">CRM </e>VMP</span>
                    <span class="logo-lg" style="font-weight: lighter;"><e style="font-weight: bold;">CRM </e>VMP</span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <?php $nombremessage=$this->requestAction('/boitemails/system_get_nombre_mail'); ?>
                                    <span class="label label-success"><?php echo $nombremessage; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Vous avez <?php echo $nombremessage; ?> nouveaux messages</li>
                                    <li>
                                        <ul class="menu">
                                            <li><!-- start message -->
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><?php echo $this->Html->link('Voir toutes les messages',array('controller' => 'boitemails', 'action' => 'index')); ?></li>
                                </ul>
                            </li>
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="javascript:void(0);" style="cursor:default;">
									<i class="fa fa-user"></i>
                                    <span class=""><?php echo AuthComponent::user('name'); ?></span>
                                </a>
                            </li>
							 <li class="dropdown user user-menu">
								<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>" class="">
									<i class="fa fa-sign-out"></i>
                                    <span class="">Se déconnecter</span>
                                </a>
							</li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">Menu</li>
                       <?php 
                        $role = $this->requestAction('/droits/getrole/brochures/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'brochures', 'action' => 'index')); ?>">
                                <i class="fa fa-book"></i> 
                                <span><?php if (AuthComponent::user('role') == 'Admin')
                                               echo "Programme produit";
                                            else
                                                echo "Brochures";
                                    ?>
                                </span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/formations/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'index')); ?>">
                                <i class="fa fa-flask"></i> 
                                <span>Formations</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/clients/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'index')); ?>">
                                <i class="fa fa-users"></i> 
                                <span>Clients</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/notefrais/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'notefrais', 'action' => 'index')); ?>">
                                <i class="fa fa-money"></i> 
                                <span>Note de frais</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/gadjets/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'gadjets', 'action' => 'index')); ?>">
                                <i class="fa fa-rocket"></i> 
                                <span>Echantillons</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/gadjets/admin');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'gadjets', 'action' => 'admin')); ?>">
                                <i class="fa fa-rocket"></i> 
                                <span>Administration Echantillons</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/listes/view');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'listes', 'action' => 'view')); ?>">
                                <i class="fa fa-list"></i> 
                                <span>Ma liste</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/listes/listeretard');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'listes', 'action' => 'listeretard')); ?>">
                                <i class="fa fa-calendar-minus-o"></i> 
                                <span>Ma liste de retards</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/listes/roule');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'listes', 'action' => 'route')); ?>">
                                <i class="fa fa-align-left"></i> 
                                <span>Feuille de route</span>
                            </a>
                        </li>
                        <?php endif;
                        $role = $this->requestAction('/droits/getrole/clientsproposes/add');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'clientsproposes', 'action' => 'add')); ?>">
                                <i class="fa fa-user-plus"></i> 
                                <span>Proposer un client</span>
                            </a>
                        </li>
                        <?php endif;
			$role = $this->requestAction('/droits/getrole/absences/add');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'add')); ?>">
                                <i class="fa fa-clock-o"></i> 
                                <span>Demande d'absence</span>
                            </a>
                        </li>
                        <?php endif;
			$role = $this->requestAction('/droits/getrole/rapports/index');
                        if($role==1): ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'rapports', 'action' => 'index')); ?>">
                                <i class="fa fa-clock-o"></i> 
                                <span>Rapports</span>
                            </a>
                        </li>
                        <?php endif;
                        $role1 = $this->requestAction('/droits/getrole/users/index');
                        $role2 = $this->requestAction('/droits/getrole/users/affectation');
                        $role3 = $this->requestAction('/droits/getrole/objectifs/index');
                        $role4 = $this->requestAction('/droits/getrole/evaluations/index');
                        if($role1==1 || $role2==1 || $role3==1 || $role4==1):
                        ?>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-cogs"></i> <span>Gestion des utilisateurs</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if($role1==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des utilisateurs', array('controller' => 'users', 'action' => 'index')); ?>
                                    </li>
                                    <?php endif;
                                    if($role2==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Affectation', array('controller' => 'users', 'action' => 'affectation')); ?>
                                    </li>
                                    <?php endif;
                                    if($role3==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des objectifs', array('controller' => 'objectifs', 'action' => 'index')); ?>
                                    </li>
                                    <?php endif;
                                    if($role4==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Evaluations', array('controller' => 'evaluations', 'action' => 'index')); ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif;
                        $role1 = $this->requestAction('/droits/getrole/notefrais/liste');
                        $role2 = $this->requestAction('/droits/getrole/actions/valider');
                        $role3 = $this->requestAction('/droits/getrole/absences/valider');
                        $role4 = $this->requestAction('/droits/getrole/clientsproposes/valider');
                        $role5 = $this->requestAction('/droits/getrole/commandes/index');
                        if($role5==1 || $role1==1 || $role2==1 || $role3==1 || $role4==1):
                        ?>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-check"></i> <span>Validation</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if($role1==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'liste')); ?>
                                    </li>
                                    <?php endif;
                                    if($role2==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Actions', array('controller' => 'actions', 'action' => 'valider')); ?>
                                    </li>
                                    <?php endif;
                                    if($role3==1):?>
                                    <li>
                                        <?php echo $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'valider')); ?>
                                    </li>
                                    <?php endif;
                                    if($role4==1)
                                        echo '<li>'.$this->Html->link('Clients', array('controller' => 'clientsproposes', 'action' => 'valider')).'</li>';
                                    if($role5==1)
                                        echo '<li>'.$this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'index')).'</li>';
                                    
                                    ?>
                                </ul>
                            </li>
                        <?php endif;
                        $role1 = $this->requestAction('/droits/getrole/secteurs/index');
                        $role2 = $this->requestAction('/droits/getrole/categories/index');
                        $role3 = $this->requestAction('/droits/getrole/types/index');
                        $role4 = $this->requestAction('/droits/getrole/droits/gestion');
                        $role5 = $this->requestAction('/droits/getrole/echantillons/index');
                        $role6 = $this->requestAction('/droits/getrole/games/index');
                        $role7 = $this->requestAction('/droits/getrole/produits/index');
                        $role8 = $this->requestAction('/droits/getrole/offres/index');
                        $role9 = $this->requestAction('/droits/getrole/objectifprofiles/index');
                        $role10 = $this->requestAction('/droits/getrole/rapports/index');
                        if($role10==1 || $role9==1 || $role1==1 || $role2==1 || $role3==1 || $role4==1 || $role5==1 || $role6==1 || $role7==1 || $role8==1):?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user"></i> <span>Administration</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if($role1==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des secteurs', array('controller' => 'secteurs', 'action' => 'index')); ?>
                                        </li>
                                    <?php endif;?>
                                <?php if($role2==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des spécialités', array('controller' => 'categories', 'action' => 'index')); ?>
                                        </li>
                                <?php endif;
                                    if($role3==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des type de clients', array('controller' => 'types', 'action' => 'index')); ?>
                                        </li>
                                <?php endif;
                                    if($role4==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des droits', array('controller' => 'droits', 'action' => 'gestion')); ?>
                                        </li>
                                <?php endif;
                                    if($role5==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des échantillons', array('controller' => 'echantillons', 'action' => 'index')); ?>
                                        </li>
                                <?php endif;
                                    if($role6==1): ?>
                                        <li>
                                            <?php echo $this->Html->link('Gestion des gammes', array('controller' => 'games', 'action' => 'index')); ?>
                                        </li>
                                <?php endif;
                                if($role7==1)
                                        echo '<li>'.$this->Html->link('Gestion des produits', array('controller' => 'produits', 'action' => 'index')).'</li>';
                                if($role8==1)
                                        echo '<li>'.$this->Html->link('Gestion des offres', array('controller' => 'offres', 'action' => 'index')).'</li>';
                                if($role9==1)
                                        echo '<li>'.$this->Html->link('Gestion des objectifes profile', array('controller' => 'objectifprofiles', 'action' => 'index')).'</li>';
                                if($role10==1)
                                        echo '<li>'.$this->Html->link('Gestion des rapports', array('controller' => 'rapports', 'action' => 'index')).'</li>';
                                ?>
                            </ul>
                        </li>
                        <?php endif;
                        $role1 = $this->requestAction('/droits/getrole/evaluations/archive');
                        $role2 = $this->requestAction('/droits/getrole/brochures/archive');
                        $role3 = $this->requestAction('/droits/getrole/formations/archive');
                        $role4 = $this->requestAction('/droits/getrole/notefrais/archive');
                        $role5 = $this->requestAction('/droits/getrole/clients/archive');
                        $role6 = $this->requestAction('/droits/getrole/actions/archive');
                        $role7 = $this->requestAction('/droits/getrole/absences/archive');
                        $role8 = $this->requestAction('/droits/getrole/echantillons/archive');
                        $role9 = $this->requestAction('/droits/getrole/visites/archive');
                        $role10 = $this->requestAction('/droits/getrole/users/archive');
                        $role11 = $this->requestAction('/droits/getrole/clientsproposes/archive');
                        $role12 = $this->requestAction('/droits/getrole/produits/archive');
                        $role13 = $this->requestAction('/droits/getrole/offres/archive');
                        $role14 = $this->requestAction('/droits/getrole/rapports/archive');
                        $role15 = $this->requestAction('/droits/getrole/commandes/archive');
                        if($role15==1 || $role14==1 || $role2==1 || $role3==1 || $role4==1 || $role5==1 || $role6==1 || 
                                $role7==1 || $role8==1 || $role9==1 || $role10==1 || $role11==1 || $role12==1 || $role13==1):?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Archive</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if($role1==1)
                                        echo '<li>'.$this->Html->link('Evaluation', array('controller' => 'evaluations', 'action' => 'archive')).'</li>';
                                    if($role2==1)
                                        echo '<li>'.$this->Html->link('Brochures', array('controller' => 'brochures', 'action' => 'archive')).'</li>';
                                    if($role3==1)
                                        echo '<li>'.$this->Html->link('Formations', array('controller' => 'formations', 'action' => 'archive')).'</li>';
                                    if($role4==1)
                                        echo '<li>'.$this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'archive')).'</li>';
                                    if($role5==1)
                                        echo '<li>'.$this->Html->link('Clients', array('controller' => 'clients', 'action' => 'archive')).'</li>';
                                    if($role6==1)
                                        echo '<li>'.$this->Html->link('Actions', array('controller' => 'actions', 'action' => 'archive')).'</li>';
                                    if($role7==1)
                                        echo '<li>'.$this->Html->link('Absences', array('controller' => 'absences', 'action' => 'archive')).'</li>';
                                    if($role8==1)
                                        echo '<li>'.$this->Html->link('Echantillons', array('controller' => 'echantillons', 'action' => 'archive')).'</li>';
                                    if($role9==1)
                                        echo '<li>'.$this->Html->link('Visites', array('controller' => 'visites', 'action' => 'archive')).'</li>';
                                    if($role10==1)
                                        echo '<li>'.$this->Html->link('Utilisateurs', array('controller' => 'users', 'action' => 'archive')).'</li>';
                                    if($role11==1)
                                        echo '<li>'.$this->Html->link('Proposition des clients', array('controller' => 'clientsproposes', 'action' => 'archive')).'</li>';
                                    if($role12==1)
                                        echo '<li>'.$this->Html->link('Produits', array('controller' => 'produits', 'action' => 'archive')).'</li>';
                                    if($role13==1)
                                        echo '<li>'.$this->Html->link('Offres', array('controller' => 'offres', 'action' => 'archive')).'</li>';
                                    if($role14==1)
                                        echo '<li>'.$this->Html->link('Rapports', array('controller' => 'rapports', 'action' => 'archive')).'</li>';
                                    if($role15==1)
                                        echo '<li>'.$this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'archive')).'</li>';
                                ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    <?php
                    echo $this->Session->flash();
                    echo $this->fetch('content');
                    ?> 
                </section>
                <section class="content">
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    CRM VMP
                </div>
                <strong>Copyright &copy; 2016 <a href="#">ICOZ</a>.</strong> All rights reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <?php
        echo $this->Html->script('jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('app.min');
        ?>
    </body>
	<script>
			$(window).load(function(){
				var text1 = $("#flashMessage").text();
				var htm1 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;"+text1;
				$("#flashMessage").html(htm1);
				$("#flashMessage").attr("class", "alert alert-success fade in");
				$("#flashMessage").attr("style", "background:#3c8dbc !important;border-color:#3c8dba;");
				var text2 = $("#authMessage").text();
				var htm2 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;"+text2;
				$("#authMessage").html(htm2);
				$("#authMessage").attr("class", "alert alert-danger fade in");		
			});
    </script>
</html>
<?php //echo $this->element('sql_dump'); ?>