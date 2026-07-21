<?php                                    ?>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style type="text/css">
        .badge-danger {
            background: #c20844;
            margin: 0;
            float: right;
            margin-right: 20px;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            <a href="<?php
                        if (1 == $this->requestAction('/droits/getrole/users/tableau_bord_super'))
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'tableau_bord_super'));
                        else
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'view'));
                        ?>" class="logo">
                <span class="logo-mini" style="font-weight: lighter;">
                    <e style="font-weight: bold;">CRM </e>VMP
                </span>
                <span class="logo-lg" style="font-weight: lighter;">
                    <e style="font-weight: bold;">CRM </e>VMP
                </span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'system_naissance')); ?>" class="dropdown-toggle" style="color:red">
                                <i class="fa fa-birthday-cake" aria-hidden="true" style="font-size: 18px;color:white"></i>
                                <span class="label label-success"><?php echo $this->requestAction(array('controller' => 'users', 'action' => 'system_naissance', 1));  ?></span>
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="<?php echo $this->Html->url(array('controller' => 'boitemails', 'action' => 'index')); ?>" class="dropdown-toggle">
                                <i class="fa fa-envelope-o"></i>
                                <?php $nombremessage = $this->requestAction('/boitemails/system_get_nombre_mail'); ?>
                                <span class="label label-success"><?php echo $nombremessage; ?></span>
                            </a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view')); ?>">
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
                <ul class="sidebar-menu" id="menu" style="overflow-x: hidden;overflow-y: scroll;">
                    <li class="header"><input type="text" value="" placeholder="Rechercher lien direct" class="col-md-12" onkeyup="searchmenu(this.value)" style="float:left;background: transparent;border: 1px solid #797878;color: #bfbfbf;outline: none !important;padding: 5px;font-size: 12px;"></li>
                    <?php
                    $role = $this->requestAction('/droits/getrole/brochures/index');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'marketings', 'action' => 'index')); ?>">
                                <i class="fa fa-bullhorn"></i>
                                <span>Marketing</span><span class="right badge badge-danger">New</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'brochures', 'action' => 'index')); ?>">
                                <i class="fa fa-book"></i>
                                <span><?php
                                        if (AuthComponent::user('role') == 'Admin')
                                            echo "Programme produit";
                                        else
                                            echo "Brochures";
                                        ?>
                                </span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/formations/index');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'index')); ?>">
                                <i class="fa fa-flask"></i>
                                <span>Formations</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/clients/allclients');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'allclients'));
                                        //echo $this->Html->url(array('controller' => 'clients', 'action' => 'index')); 
                                        ?>">
                                <i class="fa fa-users"></i>
                                <span>Liste des clients</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/notefrais/notedefrais');
                    $role2 = $this->requestAction('/droits/getrole/notefrais/validation');
                    $role3 = $this->requestAction('/droits/getrole/notefrais/automatique_note_de_frais');
                    $role4 = $this->requestAction('/droits/getrole/notevalidations/index');
                    $role5 = $this->requestAction('/droits/getrole/notefrais/exporter');

                    if ($role3 == 1 || $role1 == 1 || $role2 == 1 || $role4 == 1  || $role5 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-money"></i> <span>Note de frais</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Génération manuel', array('controller' => 'notefrais', 'action' => 'notedefrais')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Génération automatique', array('controller' => 'notefrais', 'action' => 'automatique_note_de_frais')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Valider', array('controller' => 'notefrais', 'action' => 'validation')) . '</li> ';
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Exporter', array('controller' => 'notefrais', 'action' => 'exporter', 1)) . '</li> ';
                                if ($role4 == 1)
                                    echo '<li>' . $this->Html->link('Règles de validation', array('controller' => 'notevalidations', 'action' => 'index')) . '</li> ';
                                ?>

                            </ul>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/gadjets/index');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'gadjets', 'action' => 'index')); ?>">
                                <i class="fa fa-rocket"></i>
                                <span>Echantillons</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/listes/view');
                    $role2 = $this->requestAction('/droits/getrole/listes/listeretard');
                    $role3 = $this->requestAction('/droits/getrole/listes/feuilleroute');
                    if ($role1 == 1 || $role2 == 1 || $role3 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-cogs"></i> <span>Mon listing</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Liste de la semaine', array('controller' => 'listes', 'action' => 'view')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Liste de retards', array('controller' => 'listes', 'action' => 'listeretard')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Créé une feuille de route', array('controller' => 'listes', 'action' => 'feuilleroute')) . '</li> ';

                                ?>

                            </ul>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/echantillons/stockvmp');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'echantillons', 'action' => 'stockvmp')); ?>">
                                <i class="fa fa-align-left"></i>
                                <span>Stock des échantillons</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/clientsproposes/add');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'clientsproposes', 'action' => 'add')); ?>">
                                <i class="fa fa-user-plus"></i>
                                <span>Proposer un client</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/rapports/index');
                    $role2 = $this->requestAction('/droits/getrole/rapports/visites');
                    if ($role1 == 1 || $role2 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-check"></i> <span>Rapports</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo "<li>" . $this->Html->link('Rapport hebdomadaire', array('controller' => 'rapports', 'action' => 'index')) . "</li>";
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Rapports des visites', array('controller' => 'rapports', 'action' => 'visites')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role = $this->requestAction('/droits/getrole/grosistes/index');
                    if ($role == 1):
                    ?>
                        <li class="">
                            <a href="<?php echo $this->Html->url(array('controller' => 'grosistes', 'action' => 'index')); ?>">
                                <i class="fa fa-clock-o"></i>
                                <span>Sorti grossiste</span>
                            </a>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/users/index');
                    $role2 = $this->requestAction('/droits/getrole/users/affectation');
                    $role3 = $this->requestAction('/droits/getrole/objectifs/index');
                    $role4 = $this->requestAction('/droits/getrole/evaluations/index');
                    $role5 = $this->requestAction('/droits/getrole/visites/pointage');
                    $role6 = $this->requestAction('/droits/getrole/listes/getlisteforallclients');
                    if ($role6 == 1 || $role5 == 1 || $role1 == 1 || $role2 == 1 || $role3 == 1 || $role4 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-cogs"></i> <span>Gestion des utilisateurs</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if ($role1 == 1): ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des utilisateurs', array('controller' => 'users', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role2 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Affectation', array('controller' => 'users', 'action' => 'affectation')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role3 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des objectifs', array('controller' => 'objectifs', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role4 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Evaluations', array('controller' => 'evaluations', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Pointage', array('controller' => 'visites', 'action' => 'pointage')) . '</li> ';
                                if ($role6 == 1)
                                    echo '<li>' . $this->Html->link('toutes les listes', array('controller' => 'listes', 'action' => 'getlisteforallclients')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/notefrais/index');
                    $role2 = $this->requestAction('/droits/getrole/actions/valider');
                    $role4 = $this->requestAction('/droits/getrole/clientsproposes/valider');
                    $role5 = $this->requestAction('/droits/getrole/commandes/index');
                    $role6 = $this->requestAction('/droits/getrole/gadjets/admin');
                    $role7 = $this->requestAction('/droits/getrole/documents/valider');
                    $role8 = $this->requestAction('/droits/getrole/avences/valider');
                    $role9 = $this->requestAction('/droits/getrole/listes/validerFuilleDeRoute');
                    $role10 = $this->requestAction('/droits/getrole/absences/valider');
                    $role11 = $this->requestAction('/droits/getrole/packs/valider');
                    if ($role11 == 1 || $role10 == 1 || $role9 == 1 || $role8 == 1 || $role7 == 1 || $role6 == 1 || $role5 == 1 || $role1 == 1 || $role2 == 1 || $role4 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-check"></i> <span>Validation</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo "<li>" . $this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'index')) . "</li>";
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Actions', array('controller' => 'actions', 'action' => 'valider')) . '</li> ';
                                if ($role4 == 1)
                                    echo '<li>' . $this->Html->link('Clients', array('controller' => 'clientsproposes', 'action' => 'valider')) . '</li> ';
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'index')) . '</li> ';
                                if ($role6 == 1)
                                    echo '<li>' . $this->Html->link('Echantillons', array('controller' => 'gadjets', 'action' => 'admin')) . '</li> ';
                                if ($role7 == 1)
                                    echo '<li>' . $this->Html->link('Documents', array('controller' => 'documents', 'action' => 'valider')) . '</li> ';
                                if ($role8 == 1)
                                    echo '<li>' . $this->Html->link('Avances', array('controller' => 'avences', 'action' => 'valider')) . '</li> ';
                                if ($role9 == 1)
                                    echo '<li>' . $this->Html->link('Feuilles de route', array('controller' => 'listes', 'action' => 'validerFuilleDeRoute')) . '</li> ';
                                if ($role10 == 1)
                                    echo '<li>' . $this->Html->link('Absences et congés', array('controller' => 'absences', 'action' => 'valider')) . '</li> ';
                                if ($role11 == 1)
                                    echo '<li>' . $this->Html->link('Packs', array('controller' => 'packs', 'action' => 'valider')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
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
                    $role11 = $this->requestAction('/droits/getrole/clients/trouverdoublons');
                    $role12 = $this->requestAction('/droits/getrole/groproduits/index');
                    $role13 = $this->requestAction('/droits/getrole/grosistes/index');
                    $role14 = $this->requestAction('/droits/getrole/jourferiers/index');
                    $role15 = $this->requestAction('/droits/getrole/autoechantiants/index');
                    $role16 = $this->requestAction('/droits/getrole/lignes/index');
                    $role17 = $this->requestAction('/droits/getrole/brochures/organiser');
                    $role18 = $this->requestAction('/droits/getrole/notefraissecteurs/index');
                    $role19 = $this->requestAction('/droits/getrole/odpobjectifs/index');
                    if (
                        $role19 == 1 || $role16 == 1 || $role15 == 1 || $role14 == 1 || $role12 == 1 || $role11 == 1 || $role9 == 1 || $role1 == 1 ||
                        $role2 == 1 || $role17 == 1 || $role3 == 1 || $role4 == 1 || $role5 == 1 || $role6 == 1 || $role7 == 1
                        || $role8 == 1 || $role18 == 1
                    ):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user"></i> <span>Administration</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if ($role1 == 1): ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des secteurs', array('controller' => 'secteurs', 'action' => 'index')); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ($role2 == 1): ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des spécialités', array('controller' => 'categories', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role3 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des type de clients', array('controller' => 'types', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role4 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des droits', array('controller' => 'droits', 'action' => 'gestion')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role5 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des échantillons', array('controller' => 'echantillons', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role6 == 1):
                                ?>
                                    <li>
                                        <?php echo $this->Html->link('Gestion des gammes', array('controller' => 'games', 'action' => 'index')); ?>
                                    </li>
                                <?php
                                endif;
                                if ($role7 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des produits', array('controller' => 'produits', 'action' => 'index')) . '</li> ';
                                if ($role8 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des offres', array('controller' => 'offres', 'action' => 'index')) . '</li> ';
                                if ($role9 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des objectifes profile', array('controller' => 'objectifprofiles', 'action' => 'index')) . '</li> ';
                                if ($role10 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des rapports', array('controller' => 'rapports', 'action' => 'index')) . '</li> ';
                                if ($role11 == 1)
                                    echo '<li>' . $this->Html->link('Clients en double', array('controller' => 'clients', 'action' => 'trouverdoublons')) . '</li> ';
                                if ($role12 == 1)
                                    echo '<li>' . $this->Html->link('Produits de grossistes', array('controller' => 'groproduits', 'action' => 'index')) . '</li> ';
                                if ($role13 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des grossistes', array('controller' => 'grosistes', 'action' => 'index')) . '</li> ';
                                if ($role14 == 1)
                                    echo '<li>' . $this->Html->link('Gestion jours fériés', array('controller' => 'jourferiers', 'action' => 'index')) . '</li> ';
                                if ($role15 == 1)
                                    echo '<li>' . $this->Html->link('gestion automatique échantillons', array('controller' => 'autoechantiants', 'action' => 'index')) . '</li> ';
                                if ($role16 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des lignes', array('controller' => 'lignes', 'action' => 'index')) . '</li> ';
                                if ($role17 == 1)
                                    echo '<li>' . $this->Html->link('Organisation des brochures', array('controller' => 'brochures', 'action' => 'organiser')) . '</li> ';
                                if ($role18 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des notes de frais', array('controller' => 'notefraissecteurs', 'action' => 'index')) . '</li> ';
                                if ($role19 == 1)
                                    echo '<li>' . $this->Html->link('ODP contacts', array('controller' => 'odpobjectifs', 'action' => 'index')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/users/admin_statistique');
                    $role2 = $this->requestAction('/droits/getrole/clients/statistique_visites');
                    $role3 = $this->requestAction('/droits/getrole/users/tableau_bord_super');
                    $role4 = $this->requestAction('/droits/getrole/secteurs/index');
                    $role5 = $this->requestAction('/droits/getrole/categories/index');
                    $role6 = $this->requestAction('/droits/getrole/types/index');
                    $role7 = $this->requestAction('/droits/getrole/clients/statistique_pot');
                    $role8 = $this->requestAction('/droits/getrole/actions/statistiqueparregion');
                    $role9 = $this->requestAction('/droits/getrole/visites/suiviglobal');
                    $role10 = $this->requestAction('/droits/getrole/grosistes/statistiqueglobal');
                    $role11 = $this->requestAction('/droits/getrole/clients/statistiqueListeParVM');
                    $role12 = $this->requestAction('/droits/getrole/statistiques/statistiquesvisite');
                    $role13 = $this->requestAction('/droits/getrole/statistiques/statclient');
                    $role14 = $this->requestAction('/droits/getrole/stockvisites/index');
                    $role15 = $this->requestAction('/droits/getrole/clients/infoClientParMois');
                    $role16 = $this->requestAction('/droits/getrole/boiteidees/index');
                    $role17 = $this->requestAction('/droits/getrole/gadgetclients/statistique');
                    if ($role17 == 1 || $role16 == 1 || $role15 == 1 || $role14 == 1 || $role13 == 1 || $role12 == 1 || $role11 == 1 || $role10 == 1 || $role9 == 1 || $role8 == 1 || $role1 == 1 || $role2 == 1 || $role3 == 1 || $role4 == 1 || $role5 == 1 || $role6 == 1 || $role7 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-cogs"></i> <span>Statistiques</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role14 == 1)
                                    echo '<li>' . $this->Html->link('Stock temps réel', array('controller' => 'stockvisites', 'action' => 'index')) . '</li> ';
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Employées', array('controller' => 'users', 'action' => 'admin_statistique')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Clients par visite', array('controller' => 'clients', 'action' => 'statistique_visites')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Statistique VMP/Jours', array('controller' => 'users', 'action' => 'tableau_bord_super')) . '</li> ';
                                if ($role4 == 1)
                                    echo "<li>" . $this->Html->link('Statistiques des secteurs', array('controller' => 'secteurs', 'action' => 'index')) . "</li>";
                                if ($role5 == 1)
                                    echo "<li>" . $this->Html->link('Statistiques des spécialités', array('controller' => 'categories', 'action' => 'index')) . "</li>";
                                if ($role6 == 1)
                                    echo "<li>" . $this->Html->link('Statistique des type de clients', array('controller' => 'types', 'action' => 'index')) . "</li>";
                                if ($role7 == 1)
                                    echo "<li>" . $this->Html->link('Statistique Pot', array('controller' => 'clients', 'action' => 'statistique_pot')) . "</li>";
                                if ($role8 == 1)
                                    echo "<li>" . $this->Html->link('Statistique Actions', array('controller' => 'actions', 'action' => 'statistiqueparregion')) . "</li>";
                                if ($role9 == 1)
                                    echo "<li>" . $this->Html->link('Statistique des visites', array('controller' => 'visites', 'action' => 'suiviglobal')) . "</li>";
                                if ($role10 == 1)
                                    echo "<li>" . $this->Html->link('Statistique des grossiste', array('controller' => 'grosistes', 'action' => 'statistiqueglobal')) . "</li>";
                                if ($role11 == 1)
                                    echo "<li>" . $this->Html->link('Statistique des listes par VM', array('controller' => 'clients', 'action' => 'statistiqueListeParVM')) . "</li>";
                                if ($role12 == 1)
                                    echo "<li>" . $this->Html->link('Statistique global', array('controller' => 'statistiques', 'action' => 'statistiquesvisite')) . "</li>";
                                if ($role13 == 1)
                                    echo "<li>" . $this->Html->link('Stat Covid19', array('controller' => 'statistiques', 'action' => 'statclient')) . "</li>";
                                if ($role15 == 1)
                                    echo "<li>" . $this->Html->link('Suivi clients par mois', array('controller' => 'clients', 'action' => 'infoClientParMois')) . "</li>";
                                if ($role16 == 1)
                                    echo "<li>" . $this->Html->link('Boite idees', array('controller' => 'boiteidees', 'action' => 'index')) . "</li>";
                                if ($role17 == 1)
                                    echo "<li>" . $this->Html->link('Statistiques gadgets client', array('controller' => 'gadgetclients', 'action' => 'statistique')) . "</li>";
                                ?>

                            </ul>
                        </li>
                    <?php
                    endif;
                    //$role1 = $this->requestAction('/droits/getrole/documents/index');
                    //$role2 = $this->requestAction('/droits/getrole/absences/index');
                    //$role3 = $this->requestAction('/droits/getrole/absences/index');
                    //$role4 = $this->requestAction('/droits/getrole/avences/index');
                    //$role5 = $this->requestAction('/droits/getrole/absences/attribuerconge');
                    //if ($role5 == 1 || $role1 == 1 || $role2 == 1 || $role3 == 1 || $role4 == 1):
                    if (1 == 3):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Mon coin RH</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Documents administratifs', array('controller' => 'documents', 'action' => 'index')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Mes absences', array('controller' => 'absences', 'action' => 'index')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Mes congés', array('controller' => 'absences', 'action' => 'conge')) . '</li> ';
                                if ($role4 == 1)
                                    echo '<li>' . $this->Html->link('Prêts & Avances', array('controller' => 'avences', 'action' => 'index')) . '</li> ';
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Solde de congés', array('controller' => 'absences', 'action' => 'attribuerconge')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/prospectaffaires/index');
                    $role2 = $this->requestAction('/droits/getrole/prospects/affectation');
                    $role3 = $this->requestAction('/droits/getrole/prospects/teleconseiller');
                    $role4 = $this->requestAction('/droits/getrole/rapportprocpects/fuille_route_conseiller');
                    $role5 = $this->requestAction('/droits/getrole/rapportprocpects/export_feuille');
                    $role6 = $this->requestAction('/droits/getrole/prospects/import');
                    $role7 = $this->requestAction('/droits/getrole/prospects/tableau_bord_conseiller');
                    $role8 = $this->requestAction('/droits/getrole/rapportprocpects/opportunites');
                    $role9 = $this->requestAction('/droits/getrole/prospectcompagnes/affectation_auto_excel');
                    $role10 = $this->requestAction('/droits/getrole/commandes/index');
                    if ($role10 == 1 || $role9 == 1 || $role8 == 1 || $role7 == 1 || $role6 == 1 || $role5 == 1 || $role4 == 1 || $role1 == 1 || $role2 == 1 || $role3 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Centre téléconseiller</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role7 == 1)
                                    echo '<li>' . $this->Html->link('Tableau de bord', array('controller' => 'prospects', 'action' => 'tableau_bord_conseiller')) . '</li> ';
                                if ($role10 == 1)
                                    echo '<li>' . $this->Html->link('Les commandes', array('controller' => 'commandes', 'action' => 'index')) . '</li> ';
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des affaires', array('controller' => 'prospectaffaires', 'action' => 'index')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des affectations', array('controller' => 'prospects', 'action' => 'affectation')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des téléconseillers', array('controller' => 'prospects', 'action' => 'teleconseiller')) . '</li> ';
                                if ($role4 == 1)
                                    echo '<li>' . $this->Html->link('Mes appels', array('controller' => 'rapportprocpects', 'action' => 'fuille_route_conseiller')) . '</li> ';
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Export des actions', array('controller' => 'rapportprocpects', 'action' => 'export_feuille')) . '</li> ';
                                if ($role6 == 1)
                                    echo '<li>' . $this->Html->link('Import des prospects', array('controller' => 'prospects', 'action' => 'import')) . '</li> ';
                                if ($role8 == 1)
                                    echo '<li>' . $this->Html->link('Gestion des opportunités', array('controller' => 'rapportprocpects', 'action' => 'opportunites')) . '</li> ';
                                if ($role9 == 1)
                                    echo '<li>' . $this->Html->link('Importation des compagnes', array('controller' => 'prospectcompagnes', 'action' => 'affectation_auto_excel')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/digitals/traitement_administratif');
                    $role2 = $this->requestAction('/droits/getrole/digitals/traitement_commercail');
                    if ($role1 == 1 || $role2 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Centre digital</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Traitement administratif', array('controller' => 'digitals', 'action' => 'traitement_administratif')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Traitement commercial', array('controller' => 'digitals', 'action' => 'traitement_commercail')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                    $role1 = $this->requestAction('/droits/getrole/services/set_liste_to_user');
                    if ($role1 == 1):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Services</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Importation commercial', array('controller' => 'services', 'action' => 'set_liste_to_user')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
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
                    $role16 = $this->requestAction('/droits/getrole/categories/archive');
                    $role17 = $this->requestAction('/droits/getrole/secteurs/archive');
                    $role18 = $this->requestAction('/droits/getrole/games/archive');
                    $role19 = $this->requestAction('/droits/getrole/listes/archive');
                    $role20 = $this->requestAction('/droits/getrole/documents/archive');
                    $role21 = $this->requestAction('/droits/getrole/documents/archive');
                    if (
                        $role21 == 1 || $role20 == 1 || $role19 == 1 || $role15 == 1 || $role14 == 1 || $role2 == 1 || $role3 == 1 || $role4 == 1 || $role5 == 1 || $role6 == 1 ||
                        $role7 == 1 || $role8 == 1 || $role9 == 1 || $role10 == 1 || $role11 == 1 || $role12 == 1 || $role13 == 1 || $role16 == 1 || $role17 == 1 || $role18 == 1 || $role19 == 1
                    ):
                    ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-archive"></i> <span>Archive</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if ($role1 == 1)
                                    echo '<li>' . $this->Html->link('Evaluation', array('controller' => 'evaluations', 'action' => 'archive')) . '</li> ';
                                if ($role2 == 1)
                                    echo '<li>' . $this->Html->link('Brochures', array('controller' => 'brochures', 'action' => 'archive')) . '</li> ';
                                if ($role3 == 1)
                                    echo '<li>' . $this->Html->link('Formations', array('controller' => 'formations', 'action' => 'archive')) . '</li> ';
                                if ($role4 == 1)
                                    echo '<li>' . $this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'archive')) . '</li> ';
                                if ($role5 == 1)
                                    echo '<li>' . $this->Html->link('Clients', array('controller' => 'clients', 'action' => 'archive')) . '</li> ';
                                if ($role6 == 1)
                                    echo '<li>' . $this->Html->link('Actions', array('controller' => 'actions', 'action' => 'archive')) . '</li> ';
                                if ($role7 == 1)
                                    echo '<li>' . $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'archive')) . '</li> ';
                                if ($role8 == 1)
                                    echo '<li>' . $this->Html->link('Echantillons', array('controller' => 'echantillons', 'action' => 'archive')) . '</li> ';
                                if ($role9 == 1)
                                    echo '<li>' . $this->Html->link('Visites', array('controller' => 'visites', 'action' => 'archive')) . '</li> ';
                                if ($role10 == 1)
                                    echo '<li>' . $this->Html->link('Utilisateurs', array('controller' => 'users', 'action' => 'archive')) . '</li> ';
                                if ($role11 == 1)
                                    echo '<li>' . $this->Html->link('Proposition des clients', array('controller' => 'clientsproposes', 'action' => 'archive')) . '</li> ';
                                if ($role12 == 1)
                                    echo '<li>' . $this->Html->link('Produits', array('controller' => 'produits', 'action' => 'archive')) . '</li> ';
                                if ($role13 == 1)
                                    echo '<li>' . $this->Html->link('Offres', array('controller' => 'offres', 'action' => 'archive')) . '</li> ';
                                if ($role14 == 1)
                                    echo '<li>' . $this->Html->link('Rapports', array('controller' => 'rapports', 'action' => 'archive')) . '</li> ';
                                if ($role15 == 1)
                                    echo '<li>' . $this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'archive')) . '</li> ';
                                if ($role16 == 1)
                                    echo '<li>' . $this->Html->link('Spécialités', array('controller' => 'categories', 'action' => 'archive')) . '</li> ';
                                if ($role17 == 1)
                                    echo '<li>' . $this->Html->link('Secteurs', array('controller' => 'secteurs', 'action' => 'archive')) . '</li> ';
                                if ($role18 == 1)
                                    echo '<li>' . $this->Html->link('Gammes', array('controller' => 'games', 'action' => 'archive')) . '</li> ';
                                if ($role19 == 1)
                                    echo '<li>' . $this->Html->link('Listes', array('controller' => 'listes', 'action' => 'archive')) . '</li> ';
                                if ($role20 == 1)
                                    echo '<li>' . $this->Html->link('Documents', array('controller' => 'documents', 'action' => 'archive')) . '</li> ';
                                if ($role21 == 1)
                                    echo '<li>' . $this->Html->link('Avences', array('controller' => 'avences', 'action' => 'archive')) . '</li> ';
                                ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </section>
        </aside>

        <!-- Modal pour le chat IA -->
        <div class="modal fade" id="chat-ia-modal" tabindex="-1" role="dialog" aria-labelledby="chatIAModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="chatIAModalLabel">Chat avec IA</h4>
                    </div>
                    <div class="modal-body">
                        <div style="height: 358px;">
                            <!-- Zone de chat -->
                            <div class="box box-primary direct-chat direct-chat-primary">
                                <div class="box-body">
                                    <div class="direct-chat-messages" id="ia-chat-messages" style="height: 300px; overflow-y: auto;">
                                        <!-- Les messages s'afficheront ici -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">IA Assistant</span>
                                                <span class="direct-chat-timestamp pull-right">Maintenant</span>
                                            </div>
                                            <div class="direct-chat-text">
                                                Bonjour, comment puis-je vous aider aujourd'hui?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <form id="ia-chat-form">
                                        <div class="input-group">
                                            <input type="text" id="ia-chat-input" name="message" placeholder="Écrivez votre message..." class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Envoyer</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
            <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">ESNAPHARM</a>.</strong> All rights reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <div class="fixed-bottom" style="padding: 20px; text-align: right;">
        <button id="open-chat-ia" class="btn btn-primary btn-lg">
            <i class="fa fa-comments"></i> Chat with IA
        </button>
    </div>
    <?php
    echo $this->Html->script('jquery-2.2.3.min');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('app.min');
    ?>
</body>
<script>
    $(window).load(function() {
        var text1 = $("#flashMessage").text();
        var htm1 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text1;
        $("#flashMessage").html(htm1);
        $("#flashMessage").attr("class", "alert alert-success fade in");
        $("#flashMessage").attr("style", "background:#3c8dbc !important;border-color:#3c8dba;");
        var text2 = $("#authMessage").text();
        var htm2 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text2;
        $("#authMessage").html(htm2);
        $("#authMessage").attr("class", "alert alert-danger fade in");
        var h = $(window).height();
        $(".sidebar-menu").height(h - 45);
    });

    function searchmenu(va) {
        var v = va.toLowerCase();
        var menu = document.getElementById("menu");
        for (i = 0; i < menu.getElementsByTagName('li').length; i++) {
            var lien = menu.getElementsByTagName('li')[i].innerText.toLowerCase();
            menu.getElementsByTagName('li')[i].style.display = "none";
            menu.getElementsByTagName('li')[0].style.display = "block";
            if (lien.indexOf(v) !== -1) {
                menu.getElementsByTagName('li')[i].style.display = "block";
                menu.getElementsByTagName('li')[i].parentNode.style.display = "block";
            }
        }
        for (j = 0; j < menu.getElementsByTagName('ul').length; j++) {
            if (va === "") {
                $(".treeview ul:eq(" + j + ")").hide();
            }
        }
    }
</script>






<!-- Script pour gérer le chat IA -->
<script>
    $(function() {
        // Ouvrir le modal de chat
        $('#open-chat-ia').click(function() {
            $('#chat-ia-modal').modal('show');
        });

        // Gérer l'envoi du message
        $('#ia-chat-form').submit(function(e) {
            e.preventDefault();

            var message = $('#ia-chat-input').val();
            if (message.trim() === '') return;

            // Ajouter le message de l'utilisateur au chat
            appendUserMessage(message);

            // Vider le champ de texte
            $('#ia-chat-input').val('');


            // Récupérer le contenu HTML de la section content-header
            var contentHeaderHtml = "<?php $d = $this->viewVars;
                                        unset($d["content_for_layout"]);
                                        echo addslashes(json_encode($d)); ?>";

            // Envoyer le message à l'IA via AJAX
            $.ajax({
                url: '<?php echo $this->Html->url(["controller" => "iaservices", "action" => "system_askia"]); ?>',
                type: 'POST',
                data: {
                    message: message,
                    html: contentHeaderHtml // Envoi du contenu HTML de la section
                },
                dataType: 'json',
                beforeSend: function() {
                    // Ajouter un indicateur de chargement
                    $('#ia-chat-messages').append(
                        '<div class="text-center" id="ia-loading"><i class="fa fa-spinner fa-spin"></i> En attente de réponse...</div>'
                    );
                    scrollChatToBottom();
                },
                success: function(response) {
                    // Supprimer l'indicateur de chargement
                    $('#ia-loading').remove();

                    // Ajouter la réponse de l'IA au chat
                    appendIAMessage(response.message || "Désolé, je n'ai pas pu traiter votre demande.");
                },
                error: function() {
                    // Supprimer l'indicateur de chargement
                    $('#ia-loading').remove();

                    // Ajouter un message d'erreur
                    appendIAMessage("Désolé, une erreur est survenue. Veuillez réessayer plus tard.");
                }
            });
        });

        // Fonction pour ajouter un message de l'utilisateur au chat
        function appendUserMessage(message) {
            var now = new Date();
            var timeStr = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();

            var userMessageHtml = `
      <div class="direct-chat-msg right">
        <div class="direct-chat-info clearfix">
          <span class="direct-chat-name pull-right">Vous</span>
          <span class="direct-chat-timestamp pull-left">${timeStr}</span>
        </div>
        <div class="direct-chat-text">
          ${escapeHtml(message)}
        </div>
      </div>
    `;

            $('#ia-chat-messages').append(userMessageHtml);
            scrollChatToBottom();
        }

        // Fonction pour ajouter un message de l'IA au chat
        function appendIAMessage(message) {
            var now = new Date();
            var timeStr = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();

            var iaMessageHtml = `
      <div class="direct-chat-msg">
        <div class="direct-chat-info clearfix">
          <span class="direct-chat-name pull-left">IA Assistant</span>
          <span class="direct-chat-timestamp pull-right">${timeStr}</span>
        </div>
        <div class="direct-chat-text">
          ${escapeHtml(message)}
        </div>
      </div>
    `;

            $('#ia-chat-messages').append(iaMessageHtml);
            scrollChatToBottom();
        }

        // Fonction pour faire défiler le chat vers le bas
        function scrollChatToBottom() {
            var chatContainer = document.getElementById('ia-chat-messages');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Fonction pour échapper les caractères HTML pour éviter les injections XSS
        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;")
                .replace(/\n/g, "<br>");
        }
    });
</script>
<?php //debug($d); 
?>

</html>
<?php //echo $this->element('sql_dump');   
?>