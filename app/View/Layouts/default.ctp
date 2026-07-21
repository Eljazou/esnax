<?php ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM VMP</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
    // Metronic core theme = Bootstrap 5.3 + Metronic components, served from
    // app/webroot/css/metronic/. The previous '/metronic/demo1/dist/assets/...'
    // paths resolved to app/webroot/metronic/, which is an empty directory in
    // this repo, so no theme CSS was loading at all.
    // The matching plugins.bundle.css is not shipped here; the third-party
    // plugin styles it carried (select2, datatables, flatpickr) are loaded
    // per-view or from the CDN links below.
    echo $this->Html->css('/css/metronic/css/style.bundle');
    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <!-- kept for your existing fa- icon classes throughout the menu/views -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <style type="text/css">
        :root {
            --lb-primary: #7c6ff0;
            --lb-primary-dark: #5b4fd6;
            --lb-primary-light: #ede9fe;
            --lb-border: #e5e0fb;
            --lb-text: #1e1b3a;
            --lb-muted: #64748b;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f6f5fb !important;
        }

        /* ================= HEADER ================= */
        #kt_app_header {
            background-color: #ffffff !important;
            border-bottom: 1px solid var(--lb-border) !important;
            box-shadow: 0 2px 12px rgba(31, 29, 74, 0.04) !important;
        }

        #kt_app_header .fs-3.text-primary,
        #kt_app_header .fs-3 {
            color: var(--lb-primary) !important;
            font-weight: 700 !important;
        }

        /* ================= SIDEBAR COLLAPSE: LOGO SWAP ================= */
        .app-sidebar-logo-minimize {
            display: none !important;
        }

        [data-kt-app-sidebar-minimize="on"] .app-sidebar-logo-default {
            display: none !important;
        }

        [data-kt-app-sidebar-minimize="on"] .app-sidebar-logo-minimize {
            display: flex !important;
        }

        /* ================= SIDEBAR COLLAPSE: SEARCH BAR SWAP ================= */
        .sidebar-search-icon {
            display: none !important;
        }

        .sidebar-search-icon-btn {
            background-color: #f6f5fb !important;
            border: 1px solid var(--lb-border) !important;
            border-radius: 10px !important;
            color: var(--lb-muted) !important;
            width: 34px;
            height: 34px;
        }

        .sidebar-search-icon-btn:hover {
            background-color: var(--lb-primary-light) !important;
            color: var(--lb-primary-dark) !important;
        }

        [data-kt-app-sidebar-minimize="on"] .sidebar-search-full {
            display: none !important;
        }

        [data-kt-app-sidebar-minimize="on"] .sidebar-search-icon {
            display: flex !important;
        }

        .app-navbar-item .btn-icon {
            background-color: var(--lb-primary-light) !important;
            color: var(--lb-primary) !important;
            border-radius: 10px !important;
        }

        .app-navbar-item .btn-icon:hover {
            background-color: var(--lb-primary) !important;
            color: #fff !important;
        }

        .app-navbar-item .badge-circle {
            background-color: var(--lb-primary) !important;
            color: #fff !important;
            font-size: 10px !important;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
        }

        /* admin avatar bubble */
        .lb-avatar-bubble {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--lb-primary) 0%, #a89bff 100%);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            flex-shrink: 0;
        }

        /* ================= SIDEBAR ================= */
        #kt_app_sidebar {
            background-color: #ffffff !important;
            border-right: 1px solid var(--lb-border) !important;
        }

        /* quick-search input inside sidebar */
        #RechercherLienDirect {
            background-color: #f6f5fb !important;
            border: 1px solid var(--lb-border) !important;
            border-radius: 10px !important;
            padding: 10px 14px !important;
        }

        #kt_app_sidebar .menu-link,
        #kt_app_sidebar .menu-item > .menu-link,
        #kt_app_sidebar .menu-item .menu-link {
            color: var(--lb-muted) !important;
            border-radius: 10px !important;
            padding: 10px 12px !important;
            font-size: 11px !important;
            font-weight: 400 !important;
            transition: all .15s ease !important;
        }

        #kt_app_sidebar .menu-link:hover,
        #kt_app_sidebar .menu-item:hover > .menu-link {
            color: var(--lb-primary-dark) !important;
            background-color: var(--lb-primary-light) !important;
        }

        #kt_app_sidebar .menu-item.menu-accordion.hover > .menu-link,
        #kt_app_sidebar .menu-item.here > .menu-link,
        #kt_app_sidebar .menu-item.active > .menu-link {
            color: #fff !important;
            background-color: var(--lb-primary) !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 14px rgba(124, 111, 240, 0.3) !important;
        }

        .menu-icon i {
            color: inherit !important;
            font-size: 13px !important;
        }

        #kt_app_sidebar .menu-sub-accordion {
            background-color: #ffffff !important;
            border: 1px solid var(--lb-border) !important;
            border-radius: 10px !important;
            margin: 4px 0 8px 0 !important;
            padding: 4px !important;
        }

        #kt_app_sidebar .menu-sub-accordion .menu-item > .menu-link,
        #kt_app_sidebar .menu-sub-accordion .menu-link,
        #kt_app_sidebar .menu-sub-accordion .menu-link:link,
        #kt_app_sidebar .menu-sub-accordion .menu-link:visited {
            background-color: #ffffff !important;
            color: var(--lb-muted) !important;
            font-weight: 500 !important;
            font-size: 11px !important;
            padding: 8px 12px 8px 30px !important;
            box-shadow: none !important;
        }

        #kt_app_sidebar .menu-sub-accordion .menu-link:hover,
        #kt_app_sidebar .menu-sub-accordion .menu-item:hover > .menu-link,
        #kt_app_sidebar .menu-sub-accordion .menu-item.active > .menu-link,
        #kt_app_sidebar .menu-sub-accordion .menu-item.here > .menu-link {
            background-color: var(--lb-primary) !important;
            color: #fff !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 14px rgba(124, 111, 240, 0.22) !important;
        }

        .badge-light-danger {
            background-color: #fce7f3 !important;
            color: #f472b6 !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
        }

        /* ================= UTILITIES ================= */
        .fixed-botton {
            position: fixed;
            bottom: 39px;
            right: 20px;
            z-index: 9999;
            text-align: right;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .fixed-botton:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 768px) {
            .name_user {
                display: none;
            }
        }
    </style>
</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">

    <?php
    echo $this->Html->script('jquery-2.2.3.min');
    ?>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <!-- ================= HEADER ================= -->
            <div id="kt_app_header" class="app-header">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                    id="kt_app_header_container">

                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px"
                            id="kt_app_sidebar_mobile_toggle">
                            <i class="fa fa-bars fs-1"></i>
                        </div>
                    </div>

                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">
                        <div class="app-navbar flex-shrink-0 ms-auto">

                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'system_naissance')); ?>"
                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative">
                                    <i class="fa fa-birthday-cake fs-2"></i>
                                    <span
                                        class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                                    <span class="badge badge-circle badge-success position-absolute top-0 start-100 translate-middle">
                                        <?php echo $this->requestAction(array('controller' => 'users', 'action' => 'system_naissance', 1)); ?>
                                    </span>
                                </a>
                            </div>

                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="<?php echo $this->Html->url(array('controller' => 'notifications', 'action' => 'index')); ?>"
                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative">
                                    <i class="fa fa-bell-o fs-2"></i>
                                    <?php $nombre_notif = $this->requestAction('/notifications/system_get_nombre_notification'); ?>
                                    <?php if ($nombre_notif): ?>
                                        <span class="badge badge-circle badge-warning position-absolute top-0 start-100 translate-middle">
                                            <?php echo $nombre_notif; ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="<?php echo $this->Html->url(array('controller' => 'boitemails', 'action' => 'index')); ?>"
                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative">
                                    <i class="fa fa-envelope-o fs-2"></i>
                                    <?php $nombremessage = $this->requestAction('/boitemails/system_get_nombre_mail'); ?>
                                    <span class="badge badge-circle badge-success position-absolute top-0 start-100 translate-middle">
                                        <?php echo $nombremessage; ?>
                                    </span>
                                </a>
                            </div>

                            <div class="app-navbar-item ms-1 ms-md-3 d-flex align-items-center">
                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view')); ?>"
                                    class="d-flex align-items-center text-decoration-none">
                                    <span class="lb-avatar-bubble">
                                        <?php echo strtoupper(substr(AuthComponent::user('name'), 0, 1)); ?>
                                    </span>
                                    <span class="name_user fw-semibold ms-2 text-dark"><?php echo AuthComponent::user('name'); ?></span>
                                </a>
                            </div>

                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>"
                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                                    title="Se déconnecter">
                                    <i class="fa fa-sign-out fs-2"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ================= /HEADER ================= -->

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                <!-- ================= SIDEBAR ================= -->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
                    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="255px" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

                    <div class="app-sidebar-logo px-6 d-flex align-items-center position-relative"
                        id="kt_app_sidebar_logo" style="min-height: 45px;">
                        <a href="<?php
                        if (1 == $this->requestAction('/droits/getrole/users/tableau_bord_super'))
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'tableau_bord_super'));
                        else
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'view'));
                        ?>" class="d-flex align-items-center text-decoration-none app-sidebar-logo-default">
                            <span class="fw-bold fs-4" style="color: var(--lb-primary);">CRM VMP</span>
                        </a>
                        <a href="<?php
                        if (1 == $this->requestAction('/droits/getrole/users/tableau_bord_super'))
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'tableau_bord_super'));
                        else
                            echo $this->Html->url(array('controller' => 'users', 'action' => 'view'));
                        ?>" class="d-flex align-items-center text-decoration-none app-sidebar-logo-minimize">
                            <span class="fw-bold fs-5" style="color: var(--lb-primary);">CRM</span>
                        </a>
                        <div id="kt_app_sidebar_toggle"
                            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                            data-kt-toggle-name="app-sidebar-minimize" title="Réduire / agrandir le menu">
                            <i class="fa fa-angle-double-left fs-4 rotate-180"></i>
                        </div>
                    </div>

                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-2"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">

                            <div class="px-6 mb-3 sidebar-search-full">
                                <input type="text" id="RechercherLienDirect" class="form-control form-control-sm"
                                    placeholder="Rechercher lien direct" onkeyup="searchmenu(this.value)">
                            </div>
                            <div class="px-6 mb-3 sidebar-search-icon d-flex justify-content-center">
                                <button type="button" class="btn btn-icon btn-sm sidebar-search-icon-btn"
                                    title="Rechercher"
                                    onclick="document.getElementById('kt_app_sidebar_toggle').click();">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="menu"
                                data-kt-menu="true">

                                <?php $role = $this->requestAction('/droits/getrole/absences/calendrier');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'calendrier')); ?>">
                                            <span class="menu-icon"><i class="fa fa-bullhorn fs-3"></i></span>
                                            <span class="menu-title">Activité hors terrain</span>
                                            <span class="badge badge-light-danger ms-2">New</span>
                                        </a>
                                    </div>
                                <?php endif;
                                $role = $this->requestAction('/droits/getrole/brochures/index');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'brochures', 'action' => 'index')); ?>">
                                            <span class="menu-icon"><i class="fa fa-book fs-3"></i></span>
                                            <span class="menu-title">
                                                <?php
                                                if (AuthComponent::user('role') == 'Admin')
                                                    echo "Programme produit";
                                                else
                                                    echo "Brochures";
                                                ?>
                                            </span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/formations/index');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'index')); ?>">
                                            <span class="menu-icon"><i class="fa fa-flask fs-3"></i></span>
                                            <span class="menu-title">Formations</span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/marketings/index');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'marketings', 'action' => 'index')); ?>">
                                            <span class="menu-icon"><i class="fa fa-bullhorn fs-3"></i></span>
                                            <span class="menu-title">Marketing</span>
                                        </a>
                                    </div>
                                <?php endif;
                                $role = $this->requestAction('/droits/getrole/clients/allclients');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'allclients')); ?>">
                                            <span class="menu-icon"><i class="fa fa-users fs-3"></i></span>
                                            <span class="menu-title">Liste des clients</span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/notefrais/notedefrais');
                                $role2 = $this->requestAction('/droits/getrole/notefrais/validation');
                                $role3 = $this->requestAction('/droits/getrole/notefrais/automatique_note_de_frais');
                                $role4 = $this->requestAction('/droits/getrole/notevalidations/index');
                                $role5 = $this->requestAction('/droits/getrole/notefrais/exporter');

                                if ($role3 == 1 || $role1 == 1 || $role2 == 1 || $role4 == 1 || $role5 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-money fs-3"></i></span>
                                            <span class="menu-title">Note de frais</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Génération manuel', array('controller' => 'notefrais', 'action' => 'notedefrais'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Génération automatique', array('controller' => 'notefrais', 'action' => 'automatique_note_de_frais'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Valider', array('controller' => 'notefrais', 'action' => 'validation'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Exporter', array('controller' => 'notefrais', 'action' => 'exporter', 1), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Règles de validation', array('controller' => 'notevalidations', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/gadjets/index');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'gadjets', 'action' => 'index')); ?>">
                                            <span class="menu-icon"><i class="fa fa-rocket fs-3"></i></span>
                                            <span class="menu-title">Echantillons</span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/listes/view');
                                $role2 = $this->requestAction('/droits/getrole/listes/listeretard');
                                $role3 = $this->requestAction('/droits/getrole/listes/feuilleroute');
                                if ($role1 == 1 || $role2 == 1 || $role3 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-cogs fs-3"></i></span>
                                            <span class="menu-title">Mon listing</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Liste de la semaine', array('controller' => 'listes', 'action' => 'view'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Liste de retards', array('controller' => 'listes', 'action' => 'listeretard'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Créé une feuille de route', array('controller' => 'listes', 'action' => 'feuilleroute'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/echantillons/stockvmp');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'echantillons', 'action' => 'stockvmp')); ?>">
                                            <span class="menu-icon"><i class="fa fa-align-left fs-3"></i></span>
                                            <span class="menu-title">Stock des échantillons</span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/clientsproposes/add');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'clientsproposes', 'action' => 'add')); ?>">
                                            <span class="menu-icon"><i class="fa fa-user-plus fs-3"></i></span>
                                            <span class="menu-title">Proposer un client</span>
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/rapports/index');
                                $role2 = $this->requestAction('/droits/getrole/rapports/visites');
                                $role3 = $this->requestAction('/droits/getrole/actionrapports/index');
                                if ($role1 == 1 || $role2 == 1 || $role3 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-check fs-3"></i></span>
                                            <span class="menu-title">Rapports</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Rapport hebdomadaire', array('controller' => 'rapports', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Rapports des visites', array('controller' => 'rapports', 'action' => 'visites'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Mes rapports d\'actions', array('controller' => 'actionrapports', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role = $this->requestAction('/droits/getrole/grosistes/index');
                                if ($role == 1):
                                    ?>
                                    <div class="menu-item">
                                        <a class="menu-link"
                                            href="<?php echo $this->Html->url(array('controller' => 'grosistes', 'action' => 'index')); ?>">
                                            <span class="menu-icon"><i class="fa fa-clock-o fs-3"></i></span>
                                            <span class="menu-title">Sorti grossiste</span>
                                        </a>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-cogs fs-3"></i></span>
                                            <span class="menu-title">Gestion des utilisateurs</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php if ($role1 == 1): ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des utilisateurs', array('controller' => 'users', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role2 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Affectation', array('controller' => 'users', 'action' => 'affectation'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role3 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des objectifs', array('controller' => 'objectifs', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role4 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Evaluations', array('controller' => 'evaluations', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Pointage', array('controller' => 'visites', 'action' => 'pointage'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('toutes les listes', array('controller' => 'listes', 'action' => 'getlisteforallclients'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-check fs-3"></i></span>
                                            <span class="menu-title">Validation</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Actions', array('controller' => 'actions', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Clients', array('controller' => 'clientsproposes', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Echantillons', array('controller' => 'gadjets', 'action' => 'admin'), array('class' => 'menu-link')) . '</div>';
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Documents', array('controller' => 'documents', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Avances', array('controller' => 'avences', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            if ($role9 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Feuilles de route', array('controller' => 'listes', 'action' => 'validerFuilleDeRoute'), array('class' => 'menu-link')) . '</div>';
                                            if ($role10 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Absences et congés', array('controller' => 'absences', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            if ($role11 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Packs', array('controller' => 'packs', 'action' => 'valider'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-user fs-3"></i></span>
                                            <span class="menu-title">Administration</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php if ($role1 == 1): ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des secteurs', array('controller' => 'secteurs', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($role2 == 1): ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des spécialités', array('controller' => 'categories', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role3 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des type de clients', array('controller' => 'types', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role4 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des droits', array('controller' => 'droits', 'action' => 'gestion'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role5 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des échantillons', array('controller' => 'echantillons', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role6 == 1):
                                                ?>
                                                <div class="menu-item">
                                                    <?php echo $this->Html->link('Gestion des gammes', array('controller' => 'games', 'action' => 'index'), array('class' => 'menu-link')); ?>
                                                </div>
                                                <?php
                                            endif;
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des produits', array('controller' => 'produits', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des offres', array('controller' => 'offres', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role9 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des objectifes profile', array('controller' => 'objectifprofiles', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role10 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des rapports', array('controller' => 'rapports', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role11 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Clients en double', array('controller' => 'clients', 'action' => 'trouverdoublons'), array('class' => 'menu-link')) . '</div>';
                                            if ($role12 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Produits de grossistes', array('controller' => 'groproduits', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role13 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des grossistes', array('controller' => 'grosistes', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role14 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion jours fériés', array('controller' => 'jourferiers', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role15 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('gestion automatique échantillons', array('controller' => 'autoechantiants', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role16 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des lignes', array('controller' => 'lignes', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role17 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Organisation des brochures', array('controller' => 'brochures', 'action' => 'organiser'), array('class' => 'menu-link')) . '</div>';
                                            if ($role18 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des notes de frais', array('controller' => 'notefraissecteurs', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role19 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('ODP contacts', array('controller' => 'odpobjectifs', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if (AuthComponent::user('role') == 'Admin'):
                                                ?>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="<?php echo $this->Html->url(array('controller' => 'hopitals', 'action' => 'index')); ?>">
                                                        Gestion des hôpitaux<span class="badge badge-light-danger ms-2">New</span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-cogs fs-3"></i></span>
                                            <span class="menu-title">Statistiques</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role14 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Stock temps réel', array('controller' => 'stockvisites', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Employées', array('controller' => 'users', 'action' => 'admin_statistique'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Clients par visite', array('controller' => 'clients', 'action' => 'statistique_visites'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique VMP/Jours', array('controller' => 'users', 'action' => 'tableau_bord_super'), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistiques des secteurs', array('controller' => 'secteurs', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistiques des spécialités', array('controller' => 'categories', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique des type de clients', array('controller' => 'types', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique Pot', array('controller' => 'clients', 'action' => 'statistique_pot'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique Actions', array('controller' => 'actions', 'action' => 'statistiqueparregion'), array('class' => 'menu-link')) . '</div>';
                                            if ($role9 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique des visites', array('controller' => 'visites', 'action' => 'suiviglobal'), array('class' => 'menu-link')) . '</div>';
                                            if ($role10 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique des grossiste', array('controller' => 'grosistes', 'action' => 'statistiqueglobal'), array('class' => 'menu-link')) . '</div>';
                                            if ($role11 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique des listes par VM', array('controller' => 'clients', 'action' => 'statistiqueListeParVM'), array('class' => 'menu-link')) . '</div>';
                                            if ($role12 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistique global', array('controller' => 'statistiques', 'action' => 'statistiquesvisite'), array('class' => 'menu-link')) . '</div>';
                                            if ($role13 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Stat Covid19', array('controller' => 'statistiques', 'action' => 'statclient'), array('class' => 'menu-link')) . '</div>';
                                            if ($role15 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Suivi clients par mois', array('controller' => 'clients', 'action' => 'infoClientParMois'), array('class' => 'menu-link')) . '</div>';
                                            if ($role16 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Boite idees', array('controller' => 'boiteidees', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role17 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Statistiques gadgets client', array('controller' => 'gadgetclients', 'action' => 'statistique'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/analyses/moyenne_visites');
                                $role2 = $this->requestAction('/droits/getrole/analyses/visite_dsm');
                                $role3 = $this->requestAction('/droits/getrole/analyses/portefeuille_vm');
                                $role4 = $this->requestAction('/droits/getrole/analyses/doublons_vm');
                                $role5 = $this->requestAction('/droits/getrole/analyses/calcule_couverture');
                                $role6 = $this->requestAction('/droits/getrole/analyses/frequences_visites');
                                $role7 = $this->requestAction('/droits/getrole/asm/suivi_pharmacie');
                                $role8 = $this->requestAction('/droits/getrole/asm/asm_visites_double');
                                if ($role1 == 1 || $role2 == 1 || $role3 == 1 || $role4 == 1 || $role5 == 1 || $role6 == 1 || $role7 == 1 || $role8 == 1): ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Analyse de Performance</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Moyenne des visites', array('controller' => 'analyses', 'action' => 'moyenne_visites'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Visites DSM', array('controller' => 'analyses', 'action' => 'visite_dsm'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Portefeuille des VMP', array('controller' => 'analyses', 'action' => 'portefeuille_vm'), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Doublons VMP', array('controller' => 'analyses', 'action' => 'doublons_vm'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Calcul de la couverture', array('controller' => 'analyses', 'action' => 'calcule_couverture'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Fréquences des visites', array('controller' => 'analyses', 'action' => 'frequences_visites'), array('class' => 'menu-link')) . '</div>';
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Suivi pharmacie', array('controller' => 'asm', 'action' => 'suivi_pharmacie'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Visites en double', array('controller' => 'asm', 'action' => 'asm_visites_double'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Centre téléconseiller</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Tableau de bord', array('controller' => 'prospects', 'action' => 'tableau_bord_conseiller'), array('class' => 'menu-link')) . '</div>';
                                            if ($role10 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Les commandes', array('controller' => 'commandes', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des affaires', array('controller' => 'prospectaffaires', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des affectations', array('controller' => 'prospects', 'action' => 'affectation'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des téléconseillers', array('controller' => 'prospects', 'action' => 'teleconseiller'), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Mes appels', array('controller' => 'rapportprocpects', 'action' => 'fuille_route_conseiller'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Export des actions', array('controller' => 'rapportprocpects', 'action' => 'export_feuille'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Import des prospects', array('controller' => 'prospects', 'action' => 'import'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gestion des opportunités', array('controller' => 'rapportprocpects', 'action' => 'opportunites'), array('class' => 'menu-link')) . '</div>';
                                            if ($role9 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Importation des compagnes', array('controller' => 'prospectcompagnes', 'action' => 'affectation_auto_excel'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/digitals/traitement_administratif');
                                $role2 = $this->requestAction('/droits/getrole/digitals/traitement_commercail');
                                if ($role1 == 1 || $role2 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Centre digital</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Traitement administratif', array('controller' => 'digitals', 'action' => 'traitement_administratif'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Traitement commercial', array('controller' => 'digitals', 'action' => 'traitement_commercail'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/pots/add');
                                $role2 = $this->requestAction('/droits/getrole/pots/import');
                                $role3 = $this->requestAction('/droits/getrole/pots/index');
                                if ($role1 == 1 || $role2 == 1 || $role3 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Portefeuille client</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Portefeuille', array('controller' => 'pots', 'action' => 'index'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Importation', array('controller' => 'pots', 'action' => 'import'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                $role1 = $this->requestAction('/droits/getrole/services/set_liste_to_user');
                                if ($role1 == 1):
                                    ?>
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Services</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Importation commercial', array('controller' => 'services', 'action' => 'set_liste_to_user'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
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
                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <span class="menu-link">
                                            <span class="menu-icon"><i class="fa fa-archive fs-3"></i></span>
                                            <span class="menu-title">Archive</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <?php
                                            if ($role1 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Evaluation', array('controller' => 'evaluations', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role2 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Brochures', array('controller' => 'brochures', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role3 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Formations', array('controller' => 'formations', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role4 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Note de frais', array('controller' => 'notefrais', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role5 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Clients', array('controller' => 'clients', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role6 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Actions', array('controller' => 'actions', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role7 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role8 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Echantillons', array('controller' => 'echantillons', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role9 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Visites', array('controller' => 'visites', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role10 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Utilisateurs', array('controller' => 'users', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role11 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Proposition des clients', array('controller' => 'clientsproposes', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role12 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Produits', array('controller' => 'produits', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role13 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Offres', array('controller' => 'offres', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role14 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Rapports', array('controller' => 'rapports', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role15 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Commandes', array('controller' => 'commandes', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role16 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Spécialités', array('controller' => 'categories', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role17 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Secteurs', array('controller' => 'secteurs', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role18 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Gammes', array('controller' => 'games', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role19 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Listes', array('controller' => 'listes', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role20 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Documents', array('controller' => 'documents', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            if ($role21 == 1)
                                                echo '<div class="menu-item">' . $this->Html->link('Avences', array('controller' => 'avences', 'action' => 'archive'), array('class' => 'menu-link')) . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ================= /SIDEBAR ================= -->

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div class="app-content flex-column-fluid" id="kt_app_content">
                            <div class="app-container container-fluid" id="kt_app_content_container">
                                <?php
                                echo $this->Session->flash();
                                echo $this->fetch('content');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div id="kt_app_footer" class="app-footer">
                        <div class="app-container container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">Copyright &copy; <?php echo date("Y"); ?></span>
                                <a href="#" class="text-gray-800 text-hover-primary">ESNAPHARM</a>
                            </div>
                            <div class="text-muted order-1 order-md-2">CRM VMP</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button id="open-chat-ia" class="fixed-botton btn btn-primary btn-lg">
        <?php echo $this->Html->image('ai-white.svg', ['alt' => 'AI Icon', 'style' => 'width: 20px; height: 20px; margin-right: 10px;']); ?>
        Chat with IA
    </button>

    <!-- Modal chat IA (Bootstrap 5 markup) -->
    <div class="modal fade" id="chat-ia-modal" tabindex="-1" aria-labelledby="chatIAModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="chatIAModalLabel">Chat with IA</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 387px;">
                    <div class="card">
                        <div class="card-body">
                            <div id="ia-chat-messages" style="height: 300px; overflow-y: auto;">
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">IA Assistant</span>
                                        <span class="text-muted fs-8">Maintenant</span>
                                    </div>
                                    <div>Bonjour, comment puis-je vous aider aujourd'hui?</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="ia-chat-form">
                                <div class="input-group">
                                    <input type="text" id="ia-chat-input" name="message"
                                        placeholder="Écrivez votre message..." class="form-control">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // jQuery is loaded near the top of <body>, above the page content, so every
    // view's inline scripts can rely on $ being defined the moment they run.
    // (select2 is NOT global - the views that use it load it themselves.)
    //
    // Metronic normally ships Bootstrap's JS inside plugins.bundle.js, which is
    // absent from this repo. scripts.bundle.js below calls the `bootstrap`
    // global, and the modal/dropdown compat shim further down needs it too, so
    // Bootstrap 5.3 (Popper included) is loaded from the CDN in its place.
    // Swap this line for a local copy once plugins.bundle.js is vendored in.
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    // Metronic UI bundle (KTMenu, KTDrawer, KTToggle, KTScroll) - drives the
    // sidebar accordion, mobile drawer and sidebar-minimize toggle. Must load
    // after Bootstrap.
    echo $this->Html->script('/js/metronic/js/scripts.bundle');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/fr.js"></script>
</body>
<script>
    $(window).load(function () {
        var text1 = $("#flashMessage").text();
        if (text1) {
            var htm1 = "<a href='#' class='close' data-bs-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text1;
            $("#flashMessage").html(htm1);
            $("#flashMessage").attr("class", "alert alert-success fade in");
        }
        var text2 = $("#authMessage").text();
        if (text2) {
            var htm2 = "<a href='#' class='close' data-bs-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;" + text2;
            $("#authMessage").html(htm2);
            $("#authMessage").attr("class", "alert alert-danger fade in");
        }
    });

    function searchmenu(va) {
        var v = va.toLowerCase();
        var menu = document.getElementById("menu");
        var items = menu.querySelectorAll('.menu-item');
        items.forEach(function (item) {
            var text = item.innerText.toLowerCase();
            item.style.display = text.indexOf(v) !== -1 || v === "" ? "" : "none";
        });
    }

    // Compat shim: several older views still use Bootstrap 3/4 modal/dropdown
    // attributes (data-toggle / data-target / data-dismiss). Metronic ships
    // Bootstrap 5, which renamed these to data-bs-*, so the old attributes get
    // silently ignored. This delegated listener makes the legacy attributes
    // work again, app-wide, without having to edit every .ctp view that still
    // uses them.
    document.addEventListener('click', function (e) {
        var opener = e.target.closest('[data-toggle="modal"]');
        if (opener) {
            var targetSelector = opener.getAttribute('data-target');
            var modalEl = targetSelector ? document.querySelector(targetSelector) : null;
            if (modalEl) {
                e.preventDefault();
                if (window.bootstrap && bootstrap.Modal) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                }
                return;
            }
        }

        var closer = e.target.closest('[data-dismiss="modal"]');
        if (closer) {
            var openModal = closer.closest('.modal');
            if (openModal) {
                if (window.bootstrap && bootstrap.Modal) {
                    var instance = bootstrap.Modal.getInstance(openModal);
                    if (instance) {
                        e.preventDefault();
                        instance.hide();
                    }
                }
            }
        }

        var dropdownOpener = e.target.closest('[data-toggle="dropdown"]');
        if (dropdownOpener) {
            e.preventDefault();
            if (window.bootstrap && bootstrap.Dropdown) {
                var dropdownInstance = bootstrap.Dropdown.getOrCreateInstance(dropdownOpener);
                dropdownInstance.toggle();
                return;
            }

            if (window.jQuery && $.fn.dropdown) {
                $(dropdownOpener).dropdown('toggle');
                return;
            }

            var $menu = $(dropdownOpener).next('.dropdown-menu');
            if (!$menu.length) {
                $menu = $(dropdownOpener).siblings('.dropdown-menu');
            }

            if (!$menu.length) {
                return;
            }

            var isOpen = $(dropdownOpener).attr('aria-expanded') === 'true';
            if (isOpen) {
                $menu.hide();
                $(dropdownOpener).attr('aria-expanded', 'false');
            } else {
                $menu.show();
                $(dropdownOpener).attr('aria-expanded', 'true');
            }
        }
    });

    // Mirror all remaining legacy data-toggle attributes (tab, tooltip, collapse, etc.)
    // to data-bs-toggle on page load, in case any BS5-native init relies on them.
    // Also restore the Bootstrap 5 dropdown wrapper class on legacy button-groups.
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-toggle]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-toggle')) {
                el.setAttribute('data-bs-toggle', el.getAttribute('data-toggle'));
            }
            if (el.getAttribute('data-toggle') === 'dropdown') {
                var parent = el.closest('.btn-group, .dropdown');
                if (parent && !parent.classList.contains('dropdown')) {
                    parent.classList.add('dropdown');
                }
            }
        });

        if (window.flatpickr) {
            document.querySelectorAll('input.datepicker, input.flatpickr, input[data-datepicker], input[name*="date"], input[id*="date"]').forEach(function (el) {
                if (el.getAttribute('data-flatpickr-init') === '1' || el.type === 'date') {
                    return;
                }

                if (el.readOnly || el.disabled) {
                    return;
                }

                flatpickr(el, {
                    locale: 'fr',
                    dateFormat: 'Y-m-d',
                    allowInput: true
                });

                el.setAttribute('data-flatpickr-init', '1');
            });
        }
    });
</script>

<!-- Script pour gérer le chat IA -->
<script>
    $(function () {
        $('#open-chat-ia').click(function () {
            var modalEl = document.getElementById('chat-ia-modal');
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        });

        $('#ia-chat-form').submit(function (e) {
            e.preventDefault();

            var message = $('#ia-chat-input').val();
            if (message.trim() === '') return;

            appendUserMessage(message);
            $('#ia-chat-input').val('');

            var contentHeaderHtml = "<?php $d = $this->viewVars;
            unset($d["content_for_layout"]);
            echo addslashes(json_encode($d)); ?>";

            $.ajax({
                url: '<?php echo $this->Html->url(["controller" => "iaservices", "action" => "system_askia"]); ?>',
                type: 'POST',
                data: {
                    message: message,
                    html: contentHeaderHtml
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#ia-chat-messages').append(
                        '<div class="text-center" id="ia-loading"><i class="fa fa-spinner fa-spin"></i> En attente de réponse...</div>'
                    );
                    scrollChatToBottom();
                },
                success: function (response) {
                    $('#ia-loading').remove();
                    appendIAMessage(response.message || "Désolé, je n'ai pas pu traiter votre demande.");
                },
                error: function () {
                    $('#ia-loading').remove();
                    appendIAMessage("Désolé, une erreur est survenue. Veuillez réessayer plus tard.");
                }
            });
        });

        function appendUserMessage(message) {
            var now = new Date();
            var timeStr = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();

            var userMessageHtml = `
      <div class="d-flex flex-column align-items-end mb-3">
        <div class="d-flex justify-content-between w-100">
          <span class="text-muted fs-8">${timeStr}</span>
          <span class="fw-bold">Vous</span>
        </div>
        <div>${escapeHtml(message)}</div>
      </div>
    `;

            $('#ia-chat-messages').append(userMessageHtml);
            scrollChatToBottom();
        }

        function appendIAMessage(message) {
            var now = new Date();
            var timeStr = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();

            var iaMessageHtml = `
      <div class="d-flex flex-column mb-3">
        <div class="d-flex justify-content-between">
          <span class="fw-bold">IA Assistant</span>
          <span class="text-muted fs-8">${timeStr}</span>
        </div>
        <div>${escapeHtml(message)}</div>
      </div>
    `;

            $('#ia-chat-messages').append(iaMessageHtml);
            scrollChatToBottom();
        }

        function scrollChatToBottom() {
            var chatContainer = document.getElementById('ia-chat-messages');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

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

</html>
<?php //echo $this->element('sql_dump');   ?>
