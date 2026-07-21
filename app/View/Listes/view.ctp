<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
?>
<style>
    /* ===== VOS VARIABLES ===== */
    :root {
        --primary: #6C63F5;
        --primary-dark: #5a52e0;
        --primary-light: #ede9ff;
        /* Ajout de variables pour harmoniser le reste de la page */
        --primary-purple-pale: #e7e6f7;
        --text-main: #2b2b45;
        --text-muted: #746A9F;
    }

    @media (max-width: 992px) {
        .tablebox { margin-top: 0px !important; }
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }

    /* ===== BOUTONS DATATABLE & GLOBAUX (Adaptés à l'ambiance Lavande) ===== */
    .dt-button, .btn-primary, button[type="submit"] {
        width: auto !important;
        float: none !important; /* Nettoyage du float */
        display: inline-block !important;
        margin: 5px !important;
        font-size: 14.5px !important;
        font-weight: 600 !important;
        padding: 8px 16px !important;
        background: var(--primary) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(108, 99, 245, 0.15) !important;
        transition: all 0.2s ease !important;
    }

    .dt-button:hover, .btn-primary:hover, button[type="submit"]:hover {
        color: #fff !important;
        background: var(--primary-dark) !important;
        box-shadow: 0 4px 12px rgba(108, 99, 245, 0.25) !important;
    }

    /* ===== BLOCS D'OBJECTIFS (Adaptés à l'ambiance Lavande) ===== */
    .description-block,
    .Les.objectifs.en.cours + div > div, 
    [class*="objectif"] > div {
        background: var(--primary-light) !important;
        border: 1px solid var(--primary-purple-pale) !important;
        border-radius: 12px !important;
        padding: 20px !important;
        color: var(--text-main) !important;
    }


    /* ========================================================================== */
    /* ===== VOTRE CALENDRIER INTACT (Self-contained date range picker) ===== */
    /* ========================================================================== */
    .lb-range-popup{
        position:absolute; z-index:9999; background:#fff; border:1px solid #e7e6f7;
        border-radius:14px; box-shadow:0 10px 34px rgba(108,99,245,0.2);
        padding:16px; width:auto; font-family:'Poppins',sans-serif; -webkit-user-select:none; user-select:none;
    }
    .lb-range-panels{ display:flex; gap:22px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:#eef0fa; margin:2px 0; }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:#2b2b45; font-size:14.5px; text-transform:capitalize; }
    .lb-range-nav{
        border:none; background:var(--primary-light); color:var(--primary); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center;
        line-height:1; padding:0; flex:0 0 auto;
    }
    .lb-range-nav:hover{ background:#ded8ff; }
    .lb-range-nav.lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--primary); text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{
        border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px;
        color:#2b2b45; cursor:pointer;
    }
    .lb-range-day:hover{ background:var(--primary-light); }
    .lb-range-day.other-month{ color:#b9b9d1; opacity:.5; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--primary); }
    .lb-range-day.in-range{ background:var(--primary-light); border-radius:0; }
    .lb-range-day.range-start, .lb-range-day.range-end{
        background:var(--primary) !important; color:#fff !important; font-weight:700; border-radius:8px;
    }
    .lb-range-footer{ display:flex; justify-content:space-between; margin-top:14px; border-top:1px solid #eef0fa; padding-top:10px; }
    .lb-range-clear-btn{
        border:none; background:none; color:var(--primary); font-size:12.5px; font-weight:600; cursor:pointer;
        padding:5px 9px; border-radius:8px;
    }
    .lb-range-clear-btn:hover{ background:var(--primary-light); }
    .lb-range-apply-btn{
        border:none; background:var(--primary); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer;
        padding:6px 14px; border-radius:16px;
    }
    .lb-range-apply-btn:hover{ background:var(--primary-dark); }
    .lb-range-input-open{ border-color:var(--primary) !important; box-shadow:0 0 0 3px var(--primary-light) !important; }
    @media (max-width: 600px){
        .lb-range-panels{ flex-direction:column; gap:10px; }
        .lb-range-divider{ display:none; }
        .lb-range-panel{ width:250px; }
    }


    /* ========================================================================== */
    /* ===== ORGANISATION DE LA PAGE (SANS TOUCHER AU HTML/JS) ===== */
    /* ========================================================================== */

    /* 1. Les boîtes blanches principales (Cards) */
    .box, .tablebox, .panel {
        background: #ffffff !important;
        border: 1px solid var(--primary-purple-pale) !important;
        border-radius: 14px !important;
        padding: 24px !important;
        box-shadow: 0 4px 20px rgba(108, 99, 245, 0.04) !important;
        margin-bottom: 24px !important;
        clear: both !important;
    }

    /* 2. Le Header de la date (qui était cassé) */
    .box-header.with-border {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        padding-bottom: 15px !important;
        border-bottom: none !important;
    }

    .box-header.with-border .box-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
        color: var(--text-main) !important;
        font-weight: 600 !important;
        margin-bottom: 10px !important;
        float: none !important;
    }

    /* Le champ input de la date */
    .box-header.with-border .col-md-6 {
        float: none !important;
        width: 100% !important;
        max-width: 500px !important;
        padding: 0 !important;
    }

    .box-header .input-group {
        border: 1px solid var(--primary-purple-pale) !important;
        border-radius: 8px !important;
        background: #fff !important;
        display: flex !important;
        width: 100% !important;
    }

    .box-header .input-group-addon {
        background: transparent !important;
        border: none !important;
        color: var(--primary) !important;
        padding: 10px 14px !important;
    }

    .box-header input[type="text"].form-control {
        border: none !important;
        box-shadow: none !important;
        height: auto !important;
        padding: 10px 12px 10px 0 !important;
        color: var(--text-main) !important;
        font-size: 14px !important;
        width: 100% !important;
    }

    /* 3. Le Titre "2018_liste3" (On le transforme en jolie boîte) */
    div[style*="2018_liste3"], 
    .box-body h1, 
    .box-body h2,
    .list-title-header {
        font-family: 'Poppins', sans-serif !important;
        color: var(--text-main) !important;
        font-weight: 700 !important;
        font-size: 22px !important;
        background: #ffffff !important;
        padding: 16px 24px !important;
        border: 1px solid var(--primary-purple-pale) !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(108, 99, 245, 0.04) !important;
        display: inline-block !important;
        margin-bottom: 25px !important;
        clear: both !important;
        float: none !important;
    }

    /* 4. Tableaux (DataTables) plus modernes */
    table.dataTable {
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        width: 100% !important;
        margin-top: 15px !important;
    }

    table.dataTable thead th {
        background: var(--primary-light) !important;
        color: var(--primary-dark) !important;
        border: none !important;
        padding: 12px 16px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        text-transform: uppercase !important;
    }

    table.dataTable tbody td {
        background: #ffffff !important;
        border-top: 1px solid var(--primary-purple-pale) !important;
        border-bottom: 1px solid var(--primary-purple-pale) !important;
        padding: 14px 16px !important;
        color: var(--text-main) !important;
        font-size: 13.5px !important;
    }
</style>
<?php
$visites = array();
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="row" style="margin:0px;">
        <div class="col-md-12" style="margin-bottom: 24px;padding:0px;">
            <div class="box form-group">
                <div class="box-header with-border">
                    <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 6px;font-weight: normal;width: auto;text-align:left;float:left;">Pour des statistiques d'une période précise,veuillez sélectionner une date :</label>
                    <div class="col-md-6">
                        <form action="<?php echo $this->Html->url(array("action" => "view", $id)); ?>/" method="get" id="dateform">
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
        <div class="col-md-6">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active" style="height: 130px;">

                    <h5 class="widget-user-desc" style="float: right;padding: 5px;border: 2px solid;border-radius: 0%;font-size: 35px;line-height: 33px;margin-top: 23px;"><?php echo $liste['Liste']['name']; ?></h5>
                    <?php
                    if ($this->requestAction('/droits/getrole/listes/remplire') == 1)
                        echo $this->Html->link('Remplire', array('action' => 'remplire', $liste['Liste']['id']), array('style' => 'float:right;', 'class' => 'btn btn-primary btn-large'));
                    ?>

                </div>
                <div class="box-footer" style="padding-top: 23px;padding-bottom: 30px;">
                    <h4 style="padding-left:10px;margin-top: 0px;margin-bottom: 33px;">Les objectifs en cours</h4>
                    <div class="row">

                        <?php
                        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                        foreach ($types as $key => $v)
                            $type[$key] = 0;
                        $i = 0;
                        $potencialite = array();
                        $spicialiter = array();
                        $nbmedcin = 0;
                        $pot = array();
                        $pot1 = array();
                        foreach ($clients as $value) {
                            $client = $value['Client'];
                            if (!isset($pot1[$client['potentialitev2']]))
                                $pot1[$client['potentialitev2']] = 0;
                            $pot1[$client['potentialitev2']] = $pot1[$client['potentialitev2']] + 1;
                            $nbmedcin++;
                            //
                            if (!isset($pot[$client['potentialite']]))
                                $pot[$client['potentialite']] = 0;
                            $pot[$client['potentialite']] = $pot[$client['potentialite']] + 1;


                            if (!isset($type[$value['Client']['type_id']])) {
                                $type[$value['Client']['type_id']] = 1;
                                foreach ($types as $key => $v) {
                                    if ($key == $value['Client']['type_id'])
                                        $clients[$i]['Client']['type'] = $v;
                                }
                            } else {
                                $type[$value['Client']['type_id']] = $type[$value['Client']['type_id']] + 1;
                                foreach ($types as $key => $v) {
                                    if ($key == $value['Client']['type_id'])
                                        $clients[$i]['Client']['type'] = $v;
                                }
                            }
                            $i++;
                        }
                        $total = 0;
                        foreach ($objectifs as $value) {
                            foreach ($types as $key => $v) {
                                if ($key == $value['Objectif']['type_id']) {
                        ?>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <i class="fa fa-medkit" style="width:100%;text-align:center;color:#3c8dbc;"></i>
                                            <h5 class="description-header"><?php echo $v; ?></h5>
                                            <span class="description-text"><?php echo $value['Objectif']['objectif']; ?></span>
                                        </div>
                                    </div>
                        <?php
                                    $total = $total + $value['Objectif']['objectif'];
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if ($this->requestAction('/droits/getrole/listes/dupliquer') == 1):
                        $users = $this->requestAction('/users/system_get_all_user_vmp_superviseur_coordinateur');
                        echo $this->Form->create('Liste', array(
                            'url' => array('action' => 'dupliquer', $liste['Liste']['id'])
                        ));
                    ?>
                        <div class="input select col-md-12" style="margin-top: 13px;border-top: 1px solid #f1f1f1; padding-top: 27px;">
                            <div class="col-md-4">
                                <label>Dupliquer la liste pour un collaborateur</label>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" id="regions" name="data[Liste][user_id]">
                                    <option value="0">Choisissez un employé</option>
                                    <?php foreach ($users as $userid => $username) { ?>
                                        <option value="<?php echo $userid; ?>"><?php echo $username; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php echo $this->Form->end(array('label' => 'Dupliquer', 'class' => 'btn btn-primary btn-large submit', 'div' => array('class' => 'col-sm-3'))); ?>
                        </div>

                    <?php endif; ?>
                </div>
            </div>


            <!--start Etat des visites -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Etat des visites</h3>
                </div>
                <?php

                $visite = '';
                $olddate = "";
                $i = 0;
                $totalvisite = 0;
                foreach ($visit as $key => $value) {
                    $totalvisite = $totalvisite + $value;
                    do {
                        if ($olddate == date('Y-m-d', strtotime($key . ' -1 day')) || $i == 0) {
                            $olddate = $key;
                            $date = explode("-", $key);
                            $m = $date[1] - 1;
                            $date = "new Date($date[0],$m,$date[2])";
                            $visite = $visite . "[$date," . $value . "],";
                            $i = 19;
                        } else {
                            $olddate = date('Y-m-d', strtotime($olddate . ' +1 day'));
                            $date = explode("-", $olddate);
                            $m = $date[1] - 1;
                            $date = "new Date($date[0],$m,$date[2])";
                            $visite = $visite . "[$date,0],";
                        }
                        $i++;
                    } while ($i != 20);
                }
                ?>

                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawVisualization);




                    function drawVisualization() {
                        // Some raw data (not necessarily accurate)
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Visites'],

                            <?php echo $visite; ?>


                        ]);

                        var options = {

                            hAxis: {
                                title: 'Date'
                            },
                            seriesType: 'bars',
                            series: {
                                5: {
                                    type: 'line'
                                }
                            }
                        };

                        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart'));
                        chart.draw(data, options);
                    }
                </script>
                <?php if (!empty($visit)): ?>
                    <div class="box-body" id="curve_chart"></div>
                <?php endif; ?>
            </div>
            <!--end Etat des visites -->
        </div>
        <!--end left -->
        <!--start  right -->
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <div class="col-md-12">
                <div class="row">
                    <!-- start Etat des visites hebdomadaire  -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Etat des visites hebdomadaire</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Valeurs</td>
                                        <td>Pourcentage</td>
                                        <td>Progression</td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $progressinfo = $this->requestAction('/listes/system_get_progress_info/' . $liste['Liste']['id'] . "/" . $date_debut . "/" . $date_fin . "/" . $liste['Liste']['user_id'] . "/null/potv2");
                                        $progressinfoV1 = $this->requestAction('/listes/system_get_progress_info/' . $liste['Liste']['id'] . "/" . $date_debut . "/" . $date_fin . "/" . $liste['Liste']['user_id'] . "/null/potv1");
                                        // debug($progressinfo);exit;
                                        foreach ($progressinfo as $v):
                                        ?>
                                    <tr>
                                        <td><?php echo $v['type']['type']; ?></td>
                                        <td><?php
                                            $class = "";
                                            if ($v['type']['nb_type'] == 0)
                                                echo $v['type']['nb_visiter'] . '/' . $v['type']['nb_type'] . ' (0) %';
                                            else {
                                                echo $v['type']['nb_visiter'] . '/' . $v['type']['nb_type'] . ' (' . round($v['type']['nb_visiter'] / $v['type']['nb_type'] * 100, 2) . ') %';
                                                $prog = $v['type']['nb_visiter'] / $v['type']['nb_type'] * 100;
                                                if ($prog < 50)
                                                    $class = "red";
                                                else if ($prog <= 75)
                                                    $class = "yellow";
                                                else
                                                    $class = "green";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $class; ?>">
                                                <?php
                                                if ($v['type']['nb_type'] == 0)
                                                    echo $v['type']['nb_type'];
                                                else
                                                    echo round($v['type']['nb_visiter'] / $v['type']['nb_type'] * 100, 2)
                                                ?>%</span>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active" style="height:10px;">
                                                <div class="progress-bar progress-bar-<?php echo $class; ?> "
                                                    role="progressbar" aria-valuenow="
                                             <?php
                                                if ($v['type']['nb_type'] == 0)
                                                    echo 0;
                                                else
                                                    echo round($v['type']['nb_visiter'] / $v['type']['nb_type'] * 100, 2);
                                                ?>" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: <?php
                                                                    if ($v['type']['nb_type'] == 0)
                                                                        echo 0;
                                                                    else
                                                                        echo round($v['type']['nb_visiter'] / $v['type']['nb_type'] * 100, 2);
                                                                    ?>%">
                                                    <span class="sr-only">
                                                        <?php
                                                        if ($v['type']['nb_type'] == 0)
                                                            echo 0;
                                                        else
                                                            echo round($v['type']['nb_visiter'] / $v['type']['nb_type'] * 100, 2);
                                                        ?>% Complete
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end Etat des visites hebdomadaire -->
                    <!-- start Potentialité V1 clients de la liste en cours -->
                    <div class="box">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 class="box-title">Potentialités des clients de la liste en cours</h3>
                        </div>
                        <script type="text/javascript">
                            //google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawVisualizationv1);

                            function drawVisualizationv1() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['Potentialité', 'Nombre de clients'],
                                    <?php foreach ($pot as $p => $v)
                                        echo "['$p', $v]," ?>

                                ]);

                                var options = {
                                    'legend': 'top',
                                    seriesType: 'bars',
                                    series: {
                                        13: {
                                            type: 'line'
                                        }
                                    }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('bar-chartv1'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div class="box-body">
                            <div id="bar-chartv1" style="height: auto;"></div>
                        </div>
                    </div>
                    <!-- end Potentialité V1 clients de la liste en cours -->
                    <!-- start Visite Pharmacie / Pot V1 -->
                    <?php foreach ($progressinfoV1 as $v): ?>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Visite <?php echo $v['type']['type']; ?> / Pot</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Valeurs</td>
                                            <td>Pourcentage</td>
                                            <td>Progression</td>
                                        </tr>
                                        <tr>
                                            <?php foreach ($v['potentialite'] as $val): ?>
                                        <tr>
                                            <td><?php echo $val['potentialite']; ?></td>
                                            <td><?php
                                                $class = "";
                                                if ($val['nb_potentialite'] == 0)
                                                    echo $val['nb_visiter'] . '/' . $val['nb_potentialite'] . ' (0) %';
                                                else {
                                                    echo $val['nb_visiter'] . '/' . $val['nb_potentialite'] . ' (' . round($val['nb_visiter'] / $val['nb_potentialite'] * 100, 2) . ') %';
                                                    $prog = $val['nb_visiter'] / $val['nb_potentialite'] * 100;
                                                    if ($prog < 50)
                                                        $class = "red";
                                                    else if ($prog <= 75)
                                                        $class = "yellow";
                                                    else
                                                        $class = "green";
                                                }
                                                ?>
                                            </td>
                                            <td><span class="badge bg-<?php echo $class; ?>"><?php
                                                                                                if ($val['nb_potentialite'] == 0)
                                                                                                    echo $val['nb_potentialite'];
                                                                                                else
                                                                                                    echo round($val['nb_visiter'] / $val['nb_potentialite'] * 100, 2);
                                                                                                ?>%</span></td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active" style="height:10px;">
                                                    <div class="progress-bar progress-bar-<?php echo $class; ?> "
                                                        role="progressbar" aria-valuenow="
                                                 <?php
                                                    if ($val['nb_potentialite'] == 0)
                                                        echo 0;
                                                    else
                                                        echo round($val['nb_visiter'] / $val['nb_potentialite'] * 100, 2);
                                                    ?>" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?php
                                                                        if ($val['nb_potentialite'] == 0)
                                                                            echo 0;
                                                                        else
                                                                            echo round($val['nb_visiter'] / $val['nb_potentialite'] * 100, 2);
                                                                        ?>%">
                                                        <span class="sr-only">
                                                            <?php
                                                            if ($val['nb_potentialite'] == 0)
                                                                echo 0;
                                                            else
                                                                echo round($val['nb_visiter'] / $val['nb_potentialite'] * 100, 2);
                                                            ?>% Complete
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- end Visite Pharmacie / Pot V1 -->
                </div>
            </div>

        </div>

        <!-- end  right -->


        <div class="tablebox col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">La liste des clients</h3>
                </div>
                <div class="box-body table-responsive" style="height: 243px;overflow-y: scroll;overflow-x: auto;">
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Activité</th>
                                <th>Type</th>
                                <th>Spécialité</th>
                                <th>Tendance</th>
                                <th>Pot</th>
                                <th>Ville</th>
                                <th>Secteur</th>
                                <?php if (AuthComponent::user('role') == "Admin")  echo "<th>Loc</th>" ?>
                                <th style="width: 40px">Visité</th>
                            </tr>
                        </thead>
                        <?php
                        $exercice = array();
                        $map = "";

                        foreach ($clients as $value):
                            $lan = $lal = 0;
                            if ($value["Client"]["longitude"] != null && $value["Client"]["longitude"] != "")
                                $lan = $value["Client"]["longitude"];
                            if ($value["Client"]["latitude"] != null && $value["Client"]["latitude"] != "")
                                $lal = $value["Client"]["latitude"];
                            $value["Client"]["nom"] = str_replace("'", " ", $value["Client"]["nom"]);
                            $map = $map . "['" . $value["Client"]["nom"] . "'," . $lan . ',' . $lal . ',' . $value["Client"]["visite"] . "],";

                            //graph exercice public privé
                            if (isset($exercice[$value["Client"]["exercice"]]))
                                $exercice[$value["Client"]["exercice"]]["num"] = $exercice[$value["Client"]["exercice"]]["num"] + 1;
                            else {
                                $exercice[$value["Client"]["exercice"]]["name"] = $value["Client"]["exercice"];
                                $exercice[$value["Client"]["exercice"]]["num"] = 1;
                                $exercice[$value["Client"]["exercice"]]["nonvisiter"] = 0;
                                $exercice[$value["Client"]["exercice"]]["visiter"] = 0;
                            }
                            if ($value["Client"]["visite"] == 0)
                                $exercice[$value["Client"]["exercice"]]["nonvisiter"] = $exercice[$value["Client"]["exercice"]]["nonvisiter"] + 1;
                            else
                                $exercice[$value["Client"]["exercice"]]["visiter"] = $exercice[$value["Client"]["exercice"]]["visiter"] + 1;
                            //Graph spicialité
                            if (isset($spicialiter[$value["Category"]["name"]]))
                                $spicialiter[$value["Category"]["name"]]["num"] = $spicialiter[$value["Category"]["name"]]["num"] + 1;
                            else {
                                $spicialiter[$value["Category"]["name"]]["name"] = $value["Category"]["name"];
                                $spicialiter[$value["Category"]["name"]]["num"] = 1;
                                $spicialiter[$value["Category"]["name"]]["nonvisiter"] = 0;
                                $spicialiter[$value["Category"]["name"]]["visiter"] = 0;
                            }
                            if ($value["Client"]["visite"] == 0)
                                $spicialiter[$value["Category"]["name"]]["nonvisiter"] = $spicialiter[$value["Category"]["name"]]["nonvisiter"] + 1;
                            else
                                $spicialiter[$value["Category"]["name"]]["visiter"] = $spicialiter[$value["Category"]["name"]]["visiter"] + 1;
                        ?>
                            <tr>
                                <td><?php echo $value["Client"]["id"]; ?></td>
                                <td><?php
                                    echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"]));
                                    if ($value["Client"]["action"] != 0)
                                        echo "<b class='fa fa-star' style='float:right;color:#dec723;'></b>";
                                    ?></td>
                                <td><?php echo $value["Client"]["activite"]; ?></td>
                                <td><?php echo $value["Client"]["type"]; ?></td>
                                <td><?php echo $value["Category"]["name"]; ?></td>
                                <td><?php echo $value["Category1"]["name"]; ?></td>
                                <td><?php echo $value["Client"]["potentialite"]; ?></td>
                                <td><?php echo $value["Secteur"]["ville"]; ?></td>
                                <td><?php echo $value["Secteur"]["secteur"]; ?></td>
                                <?php if (AuthComponent::user('role') == "Admin") {
                                    $oui = "Non";
                                    if ($value["Client"]['longitude'] != null)
                                        $oui = "Oui";
                                    echo "<td>$oui</td>";
                                }
                                ?>
                                <td>
                                    <?php
                                    if ($value["Client"]["visite"] == 0) {
                                        echo '<span class="badge bg-red">Non</span>';
                                    } else {
                                        echo '<span class="badge bg-green">Oui</span>';
                                        //$mapinf['visite']=AuthComponent::user('id').",".$value["Client"]["id"].",";
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>


            </div>
            <div class="box">

                <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">La liste des feuilles de route</h3>
                    </div>
                    <?php
                    $feuilles = $this->requestAction('/listes/system_get_list_feuille_route/' . $liste['User']['id'] . '/' . $date_debut);
                    if (!empty($feuilles)):
                    ?>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Nombre de clients</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($feuilles as $value): ?>
                                    <tr>
                                        <td
                                            <?php if ($value['Feuilleroute']["date"] == date('Y-m-d')) echo 'style="background: #7bda63;"'; ?>>
                                            <?php echo strftime("%A %d %B %Y", strtotime($value['Feuilleroute']["date"])); ?>
                                        </td>
                                        <td><?php echo $value[0]["num"] ?></td>
                                        <td><?php echo $this->Html->link('Voir', array('action' => 'detail_feuille_route', $value['Feuilleroute']["user_id"], $value['Feuilleroute']["date"]), array('class' => 'btn btn-primary')); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php
                    if ($liste['User']['id'] == AuthComponent::user('id') && $this->requestAction('/droits/getrole/listes/feuilleroute') == 1)
                        echo $this->Html->link("Créer une feuille de route", array('action' => 'feuilleroute', $liste['User']['id']), array('class' => 'btn btn-primary btn-large', 'style' => 'float:right;margin-top:5px;'));
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistiques</h3>
                    </div>
                    <div class="col-md-10" style="float:none;margin:auto;margin-top:20px;margin-bottom:20px;">
                        <div id="specialite" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="col-md-10" style="float:none;margin:auto;padding-top:20px;margin-bottom:20px;border-top:1px solid #ddd;">
                        <div id="exercice" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Map</h3>
                </div>
                <div class="box-body">
                    <div id="map-canvas" class="col-md-12"></div>
                    <input type="hidden" class="mapzoom" value="12">
                    <input type="hidden" class="maplatleng" value="0">

                </div>
            </div>
        </div>


    </div>
    <?php //debug($spicialiter);  debug($exercice);  
    ?>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChartp);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Spécialité', 'Visité', 'Non Visité'],

                <?php foreach ($exercice as $key => $value) { ?>

                    ['<?php echo $key ?>', <?php echo $value['visiter'] ?>, <?php echo $value['nonvisiter'] ?>],
                <?php } ?>

            ]);

            var options = {
                chart: {
                    title: 'Nombre de visites effectuées et non effectuées par exercice',
                    subtitle: 'visites par mois',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('exercice'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        function drawChartp() {
            var data = google.visualization.arrayToDataTable([
                ['Spécialité', 'Visité', 'Non Visité'],

                <?php foreach ($spicialiter as $key => $value) { ?>

                    ['<?php echo $key ?>', <?php echo $value['visiter'] ?>, <?php echo $value['nonvisiter'] ?>],
                <?php } ?>

            ]);

            var options = {
                chart: {
                    title: 'Nombre de visites effectuées et non effectuées par spécialité',
                    subtitle: 'visites par mois',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('specialite'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

    <?php
    echo $this->Html->script('jquery-2.2.3.min');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('app.min');
    echo $this->Html->script('fastclick');
    echo $this->Html->script('demo');
    echo $this->Html->script('jquery.flot.min');
    echo $this->Html->script('jquery.flot.resize.min');
    echo $this->Html->script('jquery.flot.pie.min');
    echo $this->Html->script('jquery.flot.categories.min');
    echo $this->Html->script('select2.full.min');
    echo $this->Html->script('jquery.dataTables.min');
    echo $this->Html->script('jquery.slimscroll.min');

    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q"></script>
    <script>
        $(function() {
            $("#ClientsproposeProduits").select2();
            //$("#example1").DataTable();
            <?php
            // if (AuthComponent::user('role') == "Admin"):
            ?>
            $('#example1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "bSort": false,
                "iDisplayLength": 250,
                "aaSorting": [],
                dom: 'Bfrtip',
                buttons: ['csv', 'excel', 'print']
            });
            <?php
            // endif;
            ?>
        });
    </script>

    <script>
        // ---------- Themed date range picker (self-contained, no external library) ----------
        // Replaces the previous daterangepicker plugin, which silently failed to render
        // whenever its CSS/JS assets didn't load (that's why clicking the field did nothing).
        // Built the same way as the working picker on the "pots" page: no external
        // dependency, so it can never fail to open.
        (function() {
            var MONTH_NAMES = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
            var WEEKDAYS = ['Lu','Ma','Me','Je','Ve','Sa','Di'];

            function pad2(n){ return (n < 10 ? '0' : '') + n; }
            function formatISO(d){ return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
            function sameDay(a, b){ return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
            function stripTime(d){ var c = new Date(d); c.setHours(0,0,0,0); return c; }

            function parseRangeValue(val) {
                if (!val) return { start: null, end: null };
                var parts = val.split(' -- ');
                var toDate = function(s) {
                    var p = (s || '').trim().split('-');
                    if (p.length !== 3) return null;
                    var d = new Date(parseInt(p[0],10), parseInt(p[1],10) - 1, parseInt(p[2],10));
                    return isNaN(d.getTime()) ? null : d;
                };
                return { start: toDate(parts[0]), end: toDate(parts[1]) };
            }

            function LBRangePicker(input) {
                this.input = input;
                this.popup = null;
                var parsed = parseRangeValue(input.value);
                this.start = parsed.start;
                this.end = parsed.end;
                this.viewDate = this.start ? new Date(this.start) : new Date();
                this._outsideHandler = null;
                this._reflowHandler = null;
                this.bind();
            }

            LBRangePicker.prototype.bind = function() {
                var self = this;
                this.input.setAttribute('readonly', 'readonly');
                this.input.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (self.popup) { self.close(); } else { self.open(); }
                });
            };

            LBRangePicker.prototype.open = function() {
                var self = this;
                this.popup = document.createElement('div');
                this.popup.className = 'lb-range-popup';
                document.body.appendChild(this.popup);
                this.input.classList.add('lb-range-input-open');
                this.position();
                this.render();

                this._outsideHandler = function(e) {
                    if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) self.close();
                };
                this._reflowHandler = function() { self.position(); };

                setTimeout(function() {
                    document.addEventListener('click', self._outsideHandler);
                    window.addEventListener('resize', self._reflowHandler);
                    window.addEventListener('scroll', self._reflowHandler, true);
                }, 0);
            };

            LBRangePicker.prototype.position = function() {
                if (!this.popup) return;
                var rect = this.input.getBoundingClientRect();
                this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
                this.popup.style.left = (window.scrollX + rect.left) + 'px';
            };

            LBRangePicker.prototype.close = function() {
                if (this.popup) { this.popup.parentNode.removeChild(this.popup); this.popup = null; }
                this.input.classList.remove('lb-range-input-open');
                if (this._outsideHandler) { document.removeEventListener('click', this._outsideHandler); this._outsideHandler = null; }
                if (this._reflowHandler) {
                    window.removeEventListener('resize', this._reflowHandler);
                    window.removeEventListener('scroll', this._reflowHandler, true);
                    this._reflowHandler = null;
                }
            };

            LBRangePicker.prototype.updateInputText = function() {
                if (this.start && this.end) {
                    this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.end);
                } else if (this.start) {
                    this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.start);
                } else {
                    this.input.value = '';
                }
                this.input.dispatchEvent(new Event('change'));
            };

            // Renders a single month grid (used twice: left panel + right panel)
            LBRangePicker.prototype.renderPanel = function(year, month, showPrev, showNext) {
                var self = this;
                var today = stripTime(new Date());

                var html = '<div class="lb-range-panel">';
                html += '<div class="lb-range-header">';
                html += '<button type="button" class="lb-range-nav' + (showPrev ? '' : ' lb-range-nav-hidden') + '" data-nav="prev">&#8249;</button>';
                html += '<span class="lb-range-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
                html += '<button type="button" class="lb-range-nav' + (showNext ? '' : ' lb-range-nav-hidden') + '" data-nav="next">&#8250;</button>';
                html += '</div>';
                html += '<div class="lb-range-weekdays">';
                WEEKDAYS.forEach(function(w) { html += '<span>' + w + '</span>'; });
                html += '</div><div class="lb-range-grid">';

                var firstDay = new Date(year, month, 1);
                var startOffset = (firstDay.getDay() + 6) % 7; // Monday = 0
                var daysInMonth = new Date(year, month + 1, 0).getDate();
                var daysInPrevMonth = new Date(year, month, 0).getDate();
                var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

                for (var i = 0; i < totalCells; i++) {
                    var dayNum, cellDate, otherMonth = false;
                    if (i < startOffset) {
                        dayNum = daysInPrevMonth - startOffset + i + 1;
                        cellDate = new Date(year, month - 1, dayNum);
                        otherMonth = true;
                    } else if (i >= startOffset + daysInMonth) {
                        dayNum = i - startOffset - daysInMonth + 1;
                        cellDate = new Date(year, month + 1, dayNum);
                        otherMonth = true;
                    } else {
                        dayNum = i - startOffset + 1;
                        cellDate = new Date(year, month, dayNum);
                    }

                    var classes = ['lb-range-day'];
                    if (otherMonth) classes.push('other-month');
                    if (sameDay(cellDate, today)) classes.push('today');
                    if (sameDay(cellDate, self.start)) classes.push('range-start');
                    if (sameDay(cellDate, self.end)) classes.push('range-end');
                    if (self.start && self.end && cellDate > self.start && cellDate < self.end) classes.push('in-range');

                    html += '<button type="button" class="' + classes.join(' ') + '" data-date="' + formatISO(cellDate) + '">' + dayNum + '</button>';
                }

                html += '</div></div>';
                return html;
            };

            // Renders two months side by side: viewDate (left) and viewDate+1 (right)
            LBRangePicker.prototype.render = function() {
                var self = this;
                var leftYear = this.viewDate.getFullYear();
                var leftMonth = this.viewDate.getMonth();
                var rightRef = new Date(leftYear, leftMonth + 1, 1);
                var rightYear = rightRef.getFullYear();
                var rightMonth = rightRef.getMonth();

                var html = '<div class="lb-range-panels">';
                html += this.renderPanel(leftYear, leftMonth, true, false);
                html += '<div class="lb-range-divider"></div>';
                html += this.renderPanel(rightYear, rightMonth, false, true);
                html += '</div>';
                html += '<div class="lb-range-footer">';
                html += '<button type="button" class="lb-range-clear-btn" data-action="clear">Annuler</button>';
                html += '<button type="button" class="lb-range-apply-btn" data-action="apply">Valider</button>';
                html += '</div>';

                this.popup.innerHTML = html;

                var navBtns = this.popup.querySelectorAll('[data-nav]');
                for (var n = 0; n < navBtns.length; n++) {
                    navBtns[n].addEventListener('click', function(e) {
                        e.stopPropagation();
                        var dir = this.getAttribute('data-nav');
                        self.viewDate.setMonth(self.viewDate.getMonth() + (dir === 'next' ? 1 : -1));
                        self.render();
                        self.position();
                    });
                }

                var dayBtns = this.popup.querySelectorAll('.lb-range-day');
                for (var d = 0; d < dayBtns.length; d++) {
                    dayBtns[d].addEventListener('click', function(e) {
                        e.stopPropagation();
                        var val = this.getAttribute('data-date');
                        var p = val.split('-');
                        var picked = new Date(parseInt(p[0],10), parseInt(p[1],10) - 1, parseInt(p[2],10));

                        if (!self.start || (self.start && self.end)) {
                            // start a fresh range
                            self.start = picked;
                            self.end = null;
                        } else if (picked < self.start) {
                            // picked before current start -> becomes new start
                            self.end = self.start;
                            self.start = picked;
                        } else {
                            self.end = picked;
                        }
                        self.render();
                        self.position();
                    });
                }

                var clearBtn = this.popup.querySelector('[data-action="clear"]');
                if (clearBtn) {
                    clearBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        self.start = null;
                        self.end = null;
                        self.updateInputText();
                        self.close();
                    });
                }

                var applyBtn = this.popup.querySelector('[data-action="apply"]');
                if (applyBtn) {
                    applyBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        self.updateInputText();
                        self.close();
                        // Submit the GET form so the "date" query param is picked up,
                        // same behaviour as the previous plugin's apply handler.
                        var form = self.input.closest ? self.input.closest('form') : jQuery(self.input).closest('form')[0];
                        if (form) { form.submit(); }
                    });
                }
            };

            function initRangePicker() {
                var el = document.getElementById('reservationtime');
                if (el && !el._lbRangeBound) {
                    el._lbRangeBound = true;
                    new LBRangePicker(el);
                }
            }

            document.addEventListener('DOMContentLoaded', initRangePicker);
            // In case this script runs after DOMContentLoaded already fired (e.g. deferred include)
            if (document.readyState === 'interactive' || document.readyState === 'complete') {
                initRangePicker();
            }
        })();
    </script>



    <script>
        var mapzoom = $(".mapzoom").attr("value");
        var mapz = parseInt(mapzoom);
        var locations = [<?php echo $map; ?>];
        var last = parseInt(last);
        var maps = new google.maps.LatLng(33.5719036, -7.5873685);
        //console.log(locations[0][3]+","+locations[last][4]);
        function initialize() {

            var mapOptions = {
                zoom: 6,
                center: maps,
                mapTypeId: google.maps.MapTypeId.terrain
            };

            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
            google.maps.event.addListenerOnce(map, "zoom_changed", function() {
                mapz = map.getZoom();
                $(".mapzoom").attr("value", mapz);
                //console.log(oldZoom);
            });
            google.maps.event.addListenerOnce(map, "center_changed", function() {
                maps = map.getCenter();
                $(".maplatleng").attr("value", maps);
                //console.log(oldCenter);
            });
            google.maps.event.addListenerOnce(map, "mouseup, click, double_click", function() {
                maps = map.getCenter();
                $(".maplatleng").attr("value", maps);
                mapz = map.getZoom();
                $(".mapzoom").attr("value", mapz);
                //console.log(oldCenter);
            });
            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (var i = 0; i < locations.length; i++) {
                var check = locations[i][3];


                if (check == 1) {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/marker-v.png')); ?>';
                } else {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/marker-r.png')); ?>';
                }

                var markerimg = {
                    url: v,
                    size: new google.maps.Size(30, 38),
                    scaledSize: new google.maps.Size(30, 38),
                    labelOrigin: new google.maps.Point(14, 13),
                }



                if (locations[i][1] != "" && locations[i][2] != "") {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][2], locations[i][1]),
                        map: map,
                        icon: markerimg,
                        animation: google.maps.Animation.DROP
                    })
                    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));

                    google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
                        return function() {
                            infowindow.close(map, marker);
                        }
                    })(marker, i));
                } else {

                }

            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);


        $(window).load(function() {
            var h = $(window).height();
            $('#map-canvas, .annoncesmaps').height("430px");
        });
    </script>

    <?php  //echo date("i:s"); 
    ?>
