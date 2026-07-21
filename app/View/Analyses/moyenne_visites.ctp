<?php

?>
<!--
  NOTE ON SCRIPTS REMOVED FROM THIS VIEW (do not re-add):
  - jquery-2.2.3.min / the duplicate moment.js copy: Metronic's plugins.bundle.js already
    loads a modern jQuery + moment globally. Re-loading an old jQuery here overwrote
    window.$ with a plugin-less copy AFTER Metronic had already attached DataTables /
    select2 / etc. to the original one, which is why $(...).DataTable() failed.
  - jquery.dataTables.min.js core: also already provided by Metronic's bundle — no
    need to load it a second time here.
  - buttons.flash.min.js / buttons.print.min.js: unused (only `excelHtml5` is ever
    invoked below).
  - pdfmake/vfs_fonts from cdn.rawgit.com: rawgit.com has been shut down for years,
    that <script> tag was 404-ing silently on every page load. buttons.html5 needs
    pdfmake loaded first even when only excelHtml5 is used, so it's kept here but
    pointed at a live cdnjs mirror.
  Versions are pinned to match statistiquesvisite.ctp (buttons 1.2.2 / jszip 2.5.0)
  so the two pages don't load conflicting DataTables Buttons builds.
-->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<style>
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-light:#f1effd;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    /* NOTE: overflow:hidden used to be on the generic .box-body rule below,
       which clipped select2 / daterangepicker dropdowns inside the filter
       card. It now only applies to .chart-body (the canvas wrappers, which
       need it to contain Chart.js resize/animation overflow). */

    /* ---------- Generic card shell ---------- */
    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px; border-top:3px solid var(--border-color);
    }
    .box-primary{ border-top-color:var(--accent); }
    .box-success{ border-top-color:#1a9c74; }
    .box-warning{ border-top-color:#f39c12; }
    .box-info{ border-top-color:#17a2b8; }

    .box .box-header.with-border{ border-bottom:1px solid var(--border-color); padding:16px 20px; display:flex; align-items:center; justify-content:space-between; }
    .box-title{ font-weight:700; font-size:15px; color:var(--text-dark); margin:0; display:flex; align-items:center; }
    .box-title i{
        display:inline-flex; align-items:center; justify-content:center;
        width:28px; height:28px; border-radius:8px; margin-right:9px; font-size:13px;
        background:var(--accent-light); color:var(--accent);
    }
    .box-primary .box-title i{ background:#efeafc; color:#6c5ce7; }
    .box-success .box-title i{ background:#e6f9f0; color:#1a9c74; }
    .box-warning .box-title i{ background:#fff4e5; color:#f39c12; }
    .box-info .box-title i{ background:#e6f7fb; color:#17a2b8; }

    .box-header .btn-default{
        background:#fff !important; border:1px solid var(--border-color) !important;
        color:var(--text-dark) !important; border-radius:20px !important;
        padding:7px 16px !important; font-size:12.5px !important; font-weight:600;
        box-shadow:none !important;
    }
    .box-header .btn-default:hover{ border-color:var(--accent) !important; color:var(--accent) !important; }

    .box-footer{ background:#fafafa !important; border-top:1px solid var(--border-color) !important; padding:10px 20px !important; }
    .box-footer .text-muted{ color:var(--text-muted) !important; font-size:12.5px; }
    .box-footer strong{ color:var(--text-dark); }

    /* ---------- Filter card ---------- */
    .filter-box.box-body{ padding:24px !important; overflow:visible !important; height:auto !important; }
    #dateform{ overflow:visible; }
    #dateform .input,
    #dateform .select_vm{
        margin-bottom:20px !important; clear:both !important; display:block !important; overflow:hidden;
    }
    #dateform label{
        display:flex; align-items:center; gap:9px; font-weight:700;
        font-size:13.5px; color:var(--text-dark); margin-bottom:8px; float:none !important; width:auto !important;
    }
    #dateform label .field-icon{
        width:30px; height:30px; border-radius:9px; display:inline-flex; align-items:center; justify-content:center;
        font-size:13px; flex:0 0 auto;
    }
    .field-icon.f-indigo{ background:#efeafc; color:#6c5ce7; }
    .field-icon.f-pink{ background:#fdeaf1; color:#e0457b; }
    .field-icon.f-blue{ background:#e8f0fd; color:#3d7be0; }
    .field-icon.f-purple{ background:#f1e8fd; color:#8b3de0; }
    .field-icon.f-green{ background:#e6f9f0; color:#1a9c74; }
    .field-icon.f-mint{ background:#e6faf5; color:#0fb894; }
    .field-icon.f-teal{ background:#e6f7fb; color:#17a2b8; }

    #dateform .form-control,
    #dateform select.pull-right,
    #dateform .select2.pull-right,
    #dateform .select2-container{
        float:none !important; width:100% !important; display:block !important;
    }
    #dateform .form-control,
    #dateform .select2-container .select2-selection--single,
    #dateform .select2-container .select2-selection--multiple{
        border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fafafa !important; min-height:42px; box-shadow:none !important;
        font-size:14px; color:var(--text-dark);
    }
    #dateform .form-control:focus,
    #dateform .select2-container--focus .select2-selection{ border-color:var(--accent) !important; background:#fff !important; }
    #dateform .select2-selection__rendered{ line-height:40px !important; padding-left:12px !important; color:var(--text-muted) !important; }
    #dateform .select2-selection__arrow{ height:40px !important; }
    .select_vm{ border:1px solid var(--border-color); border-radius:var(--radius-sm); padding:6px; overflow-y:auto; max-height:110px; background:#fafafa; }
    .select_vm .select2-container{ margin-bottom:0 !important; }

    #dateform input[type="submit"].btn-search{
        -webkit-appearance:none; appearance:none;
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        color:#fff !important; padding:11px 24px !important; font-weight:600; font-size:14px;
        box-shadow:0 4px 14px rgba(108,92,231,0.3) !important; cursor:pointer;
    }
    #dateform input[type="submit"].btn-search:before{ font-family:"FontAwesome"; content:"\f002"; margin-right:8px; }
    #dateform input[type="submit"].btn-search:hover{ background:var(--accent-dark) !important; }

    /* Date range pill */
    .date-range-wrap{ float:none !important; width:100% !important; max-width:420px; margin:0 0 24px 0 !important; }
    .date-range-wrap .input-group-addon{
        background:#fff !important; border:1px solid var(--border-color) !important; border-right:none !important;
        border-radius:20px 0 0 20px !important; color:var(--accent) !important; padding-left:16px;
    }
    .date-range-wrap .form-control{
        border:1px solid var(--border-color) !important; border-left:none !important;
        border-radius:0 20px 20px 0 !important; background:#fff !important; box-shadow:none !important;
        min-height:44px; font-size:14px; color:var(--text-dark);
    }
    .date-range-wrap .form-control:focus{ border-color:var(--accent) !important; }
    .date-range-wrap .form-control{ cursor:pointer; }
    .date-range-wrap .form-control.lb-range-input-open{
        border-color:var(--accent) !important; box-shadow:0 0 0 3px var(--accent-light) !important;
    }

    /* ---------- Themed date range picker (self-contained, no external library) ---------- */
    /* Ported from pots/index.ctp — remapped to this page's --accent tokens. */
    .lb-range-popup{ position:absolute; z-index:9999; background:#fff; border:1px solid var(--border-color); border-radius:14px;
        box-shadow:0 10px 34px rgba(108,92,231,.2); padding:16px; font-family:inherit; user-select:none; }
    .lb-range-panels{ display:flex; gap:22px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:var(--border-color); }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .lb-range-nav{ border:none; background:var(--accent-light); color:var(--accent); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:var(--accent-pale, var(--accent-light)); }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--accent); text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:var(--text-dark); cursor:pointer; }
    .lb-range-day:hover{ background:var(--accent-light); }
    .lb-range-day.other-month{ color:var(--text-muted); opacity:.5; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--accent); }
    .lb-range-day.in-range{ background:var(--accent-light); border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:var(--accent) !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; justify-content:space-between; margin-top:14px; border-top:1px solid var(--border-color); padding-top:10px; }
    .lb-range-clear-btn{ border:none; background:none; color:var(--accent); font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:var(--accent-light); }
    .lb-range-apply-btn{ border:none; background:var(--accent); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:6px 14px; border-radius:16px; }
    .lb-range-apply-btn:hover{ background:var(--accent-dark); }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }

    /* ---------- DataTables (per-panel export tables) ---------- */
    .table-responsive .dt-buttons{ margin-bottom:10px; }
    .dt-button{
        width:auto !important; float:none !important; margin:0 !important;
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:12.5px !important; font-weight:600; line-height:1 !important;
        padding:8px 14px !important; border-radius:var(--radius-sm) !important;
        background:#e6f9f0 !important; color:#1a9c74 !important;
        border:1px solid #cdeee1 !important; box-shadow:none !important;
    }
    .dt-button:hover{ background:#d8f4e9 !important; }
    table.dataTable{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    table.dataTable thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:10px 12px !important;
    }
    table.dataTable tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:9px 12px !important; font-size:13px; color:var(--text-dark);
    }
    table.dataTable tbody tr:hover td{ background:var(--accent-light); }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:5px !important; padding:5px 10px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:12.5px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background:var(--accent-light) !important; color:var(--accent) !important; border-color:var(--accent) !important;
    }

    /* ---------- Chart panels ---------- */
    .chart-body{
        position: relative;
        height: 370px;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            margin-bottom: 20px;
        }

        .chart-body {
            height: 300px;
        }
    }
</style>
<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group">
            <div class="box-header with-border" style="border-bottom:none;">
            </div>
            <div class="box-body filter-box">
                <form action="<?php echo $this->Html->url("/analyses/moyenne_visites") ?>" method="post" id="dateform"
                    autocomplete="off">
                    <div class="input-group date-range-wrap">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo h($dateaafficherdansleview); ?>" name="date" id="reservationtime" placeholder="Rechercher">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('category', array(
                            "label" => array('text' => '<span class="field-icon f-indigo"><i class="fa fa-briefcase"></i></span>Choisissez l\'activté', 'escape' => false),
                            "name" => "activite",
                            'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                            'class' => 'form-control pull-right',
                            'value' => $activite_selected
                        ));
                        echo $this->Form->input('potentialite', array(
                            "multiple" => "true",
                            "label" => array('text' => '<span class="field-icon f-pink"><i class="fa fa-star"></i></span>Choisissez potentialité', 'escape' => false),
                            "name" => "potentialite",
                            'options' => array(
                                "A1" => "A1",
                                "A2" => "A2",
                                "A3" => "A3",
                                "B1" => "B1",
                                "B2" => "B2",
                                "B3" => "B3",
                                "C1" => "C1",
                                "C2" => "C2",
                                "C3" => "C3"
                            ),
                            'class' => 'form-control pull-right choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        if (AuthComponent::user('role') != 'Super viseur')
                            echo $this->Form->input('secteur', array(
                                "multiple" => "true",
                                "label" => array('text' => '<span class="field-icon f-blue"><i class="fa fa-building"></i></span>La liste des secteurs', 'escape' => false),
                                "name" => "secteur",
                                'options' => $secteurs,
                                'class' => 'form-control pull-right choix_multi select2',
                            ));

                        echo $this->Form->input('category', array(
                            "multiple" => "true",
                            "label" => array('text' => '<span class="field-icon f-purple"><i class="fa fa-heart"></i></span>La liste des spécialité', 'escape' => false),
                            "name" => "category",
                            'options' => $categories,
                            'class' => 'form-control pull-right choix_multi select2'
                        ));
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-6 ">
                        <label><span class="field-icon f-green"><i class="fa fa-server"></i></span>La liste des VM</label>
                        <div class="select_vm">
                            <?php
                            echo $this->Form->input('user', array(
                                "multiple" => "true",
                                "label" => false,
                                "name" => "users",
                                'options' => $allusers,
                                'class' => 'form-control pull-right choix_multi vm select2',
                                'value' => array_values($selected_users)
                            ));
                            ?>
                        </div>
                        <?php
                        echo $this->Form->input('ligne', array(
                            "multiple" => "true",
                            "label" => array('text' => '<span class="field-icon f-mint"><i class="fa fa-list-ul"></i></span>Les lignes', 'escape' => false),
                            "name" => "ligne",
                            'options' => $lignes,
                            'class' => 'form-control pull-right choix_multi vm select2',
                            'multiple' => 'multiple'
                        ));
                        $types = array("1" => "Medcin", "2" => "Pharmacie",);
                        echo $this->Form->input('type', array(
                            "multiple" => "true",
                            "label" => array('text' => '<span class="field-icon f-teal"><i class="fa fa-user"></i></span>Type de client', 'escape' => false),
                            "name" => "type",
                            'options' => $types,
                            'class' => 'form-control pull-right choix_multi vm select2',
                            'multiple' => 'multiple'
                        ));
                        ?>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Rechercher" class="btn-search" style="float: right;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vue CakePHP 2 pour affichage des statistiques -->
<?php
// Traitement des données côté PHP UNIQUEMENT
$regions_data = array();
$regions_data_global = array();
$regions_labels = array();
if (isset($data_moyenne['par_region'])) {
    foreach ($data_moyenne['par_region'] as $region => $data) {
        if ($region !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $regions_labels[] = $region;
            $regions_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $regions_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$lignes_data = array();
$lignes_data_global = array();
$lignes_labels = array();
if (isset($data_moyenne['par_ligne'])) {
    foreach ($data_moyenne['par_ligne'] as $ligne => $data) {
        if ($ligne !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $lignes_labels[] = 'Ligne ' . $ligne;
            $lignes_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $lignes_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}
$vm_data = array();
$vm_data_global = array();
$vm_labels = array();
if (isset($data_moyenne['par_vm'])) {
    foreach ($data_moyenne['par_vm'] as $vm => $data) {
        if ($vm !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $vm_labels[] = $tout_user_pour_affchage_dans_le_view[$vm];
            $vm_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $vm_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$supers_data = array();
$supers_data_global = array();
$supers_labels = array();
if (isset($data_moyenne['par_super'])) {
    foreach ($data_moyenne['par_super'] as $super => $data) {

        if ($super !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {

            // Fix: check key exists
            if (isset($tout_user_pour_affchage_dans_le_view[$super])) {
                $supers_labels[] = $tout_user_pour_affchage_dans_le_view[$super];
            } else {
                $supers_labels[] = "Inconnu ($super)"; // or skip it
            }

            $supers_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $supers_data_global[] = $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}


$mois_data = array();
$mois_data_global = array();
$mois_labels = array();
if (isset($data_moyenne['par_mois'])) {
    foreach ($data_moyenne['par_mois'] as $mois => $data) {
        if ($mois !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $mois_labels[] = $mois;
            $mois_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $mois_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$moyenne_globale_region = isset($data_moyenne['par_region']['_moyenne_globale']) ? (float) $data_moyenne['par_region']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_ligne = isset($data_moyenne['par_ligne']['_moyenne_globale']) ? (float) $data_moyenne['par_ligne']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_super = isset($data_moyenne['par_super']['_moyenne_globale']) ? (float) $data_moyenne['par_super']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_mois = isset($data_moyenne['par_mois']['_moyenne_globale']) ? (float) $data_moyenne['par_mois']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_vm = isset($data_moyenne['par_vm']['_moyenne_globale']) ? (float) $data_moyenne['par_vm']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
?>
<div class="clearfix"></div>
<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Moyenne par Région</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartRegion', 'region.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartRegion" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneRegion">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableRegion" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Ligne -->
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-line-chart"></i> Moyenne par Ligne</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartLigne', 'ligne.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartLigne" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneLigne">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableLigne" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Graphique par Superviseur -->
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i> Moyenne par équipe</h3>
                <button class="btn btn-xs btn-default pull-right"
                    onclick="downloadChart('chartSuper', 'superviseur.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartSuper" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneSuper">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableSuper" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Mois -->
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fa fa-calendar"></i> Moyenne par Mois</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartMois', 'mois.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartMois" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneMois">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableMois" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Graphique par vm -->
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i> Moyenne par VMP</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartVm', 'vmp.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartVm" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneVm">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableVm" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Taux de réalisation des objectifs en % par Région</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartRegion', 'region.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartRegionGlobal" width="400" height="300"></canvas>
            </div>

            <div class="table-responsive">
                <table id="tableRegionGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Ligne -->
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-line-chart"></i> Taux de réalisation des objectifs en % par Ligne</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartLigne', 'ligne.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartLigneGlobal" width="400" height="300"></canvas>
            </div>
            <div class="table-responsive">
                <table id="tableLigneGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- Graphique par Superviseur -->
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i>Taux de réalisation des objectifs en % par équipe</h3>
                <button class="btn btn-xs btn-default pull-right"
                    onclick="downloadChart('chartSuper', 'superviseur.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartSuperGlobal" width="400" height="300"></canvas>
            </div>
            <div class="table-responsive">
                <table id="tableSuperGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Mois -->
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fa fa-calendar"></i>Taux de réalisation des objectifs en % par Mois</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartMoisGlobal', 'mois.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartMoisGlobal" width="400" height="300"></canvas>
            </div>
            <div class="table-responsive">
                <table id="tableMoisGlobal" class="table table-bordered table-striped"></table>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <!-- Graphique par vm -->
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i>Taux de réalisation des objectifs en % par VMP</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartVm', 'vmp.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body chart-body">
                <canvas id="chartVmGlobal" width="400" height="300"></canvas>
            </div>
            <div class="table-responsive">
                <table id="tableVmGlobal" class="table table-bordered table-striped"></table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script type="text/javascript">
    // --- Fonction téléchargement chart en PNG
    function downloadChart(canvasId, filename) {
        var link = document.createElement('a');
        link.href = document.getElementById(canvasId).toDataURL('image/png');
        link.download = filename;
        link.click();
    }
    // Configuration générale des graphiques
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;

    // Couleurs pour les différents graphiques
    var colors = {
        region: '#6c5ce7',
        vm: '#f39c12',
        ligne: '#1a9c74',
        super: '#f39c12',
        mois: '#17a2b8'
    };

    // Fonction pour créer un graphique
    function createChart(canvasId, data, color, title) {
        var ctx = document.getElementById(canvasId).getContext('2d');
        console.log('canvasId :', canvasId);
        var titre = 'Pourcentage de réalisation';

        if (canvasId == "chartRegion" || canvasId == "chartLigne" || canvasId == "chartSuper" || canvasId == "chartVm") {
            titre = "Moyenne visites/jour";
        }
        if (canvasId == "chartMois") {
            titre = "Moyenne visites/mois";
        }
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: titre,
                    data: data.values,
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            // Add extra space on top dynamically
                            suggestedMax: Math.max(...data.values) * 1.2, // adds 20% more space
                            callback: function(value) {
                                return value.toFixed(1);
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel.toFixed(2);
                        }
                    }
                },
                animation: {
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = "12px Arial";
                        ctx.fillStyle = "#444";
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset, i) {
                            var meta = this.getDatasetMeta(i);
                            meta.data.forEach(function(bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data.toFixed(1), bar._model.x, bar._model.y - 5);
                            });
                        }, this);
                    }
                }
            }
        });

    }

    // Variables JavaScript avec données PHP
    var vmData = {
        labels: <?php echo json_encode($vm_labels); ?>,
        values: <?php echo json_encode($vm_data); ?>
    };
    var vm_data_global = {
        labels: <?php echo json_encode($vm_labels); ?>,
        values: <?php echo json_encode($vm_data_global); ?>
    };

    var regionsData = {
        labels: <?php echo json_encode($regions_labels); ?>,
        values: <?php echo json_encode($regions_data); ?>
    };
    var regions_data_global = {
        labels: <?php echo json_encode($regions_labels); ?>,
        values: <?php echo json_encode($regions_data_global); ?>
    };

    var lignesData = {
        labels: <?php echo json_encode($lignes_labels); ?>,
        values: <?php echo json_encode($lignes_data); ?>
    };
    var lignes_data_global = {
        labels: <?php echo json_encode($lignes_labels); ?>,
        values: <?php echo json_encode($lignes_data_global); ?>
    };

    var supersData = {
        labels: <?php echo json_encode($supers_labels); ?>,
        values: <?php echo json_encode($supers_data); ?>
    };
    var supers_data_global = {
        labels: <?php echo json_encode($supers_labels); ?>,
        values: <?php echo json_encode($supers_data_global); ?>
    };

    var moisData = {
        labels: <?php echo json_encode($mois_labels); ?>,
        values: <?php echo json_encode($mois_data); ?>
    };
    var mois_data_global = {
        labels: <?php echo json_encode($mois_labels); ?>,
        values: <?php echo json_encode($mois_data_global); ?>
    };

    // Initialisation quand le DOM est prêt
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM chargé, initialisation des graphiques...');
        // Affichage des moyennes globales
        document.getElementById('moyenneRegion').innerHTML = '<?php echo number_format($moyenne_globale_region, 2); ?>';
        document.getElementById('moyenneLigne').innerHTML = '<?php echo number_format($moyenne_globale_ligne, 2); ?>';
        document.getElementById('moyenneSuper').innerHTML = '<?php echo number_format($moyenne_globale_super, 2); ?>';
        document.getElementById('moyenneMois').innerHTML = '<?php echo number_format($moyenne_globale_mois, 2); ?>';
        document.getElementById('moyenneVm').innerHTML = '<?php echo number_format($moyenne_globale_vm, 2); ?>';

        // Création des graphiques avec vérification
        try {
            if (regionsData.labels.length > 0) {
                console.log('Création graphique régions');
                createChart('chartRegion', regionsData, colors.region, 'Régions');
                createChart('chartRegionGlobal', regions_data_global, colors.region, 'Régions Objectifs');
            }
            if (vmData.labels.length > 0) {
                console.log('Création graphique VMP');
                createChart('chartVm', vmData, colors.vm, 'VMP');
                createChart('chartVmGlobal', vm_data_global, colors.vm, 'VMP Objectifs');
            }

            if (lignesData.labels.length > 0) {
                console.log('Création graphique lignes');
                createChart('chartLigne', lignesData, colors.ligne, 'Lignes');
                createChart('chartLigneGlobal', lignes_data_global, colors.ligne, 'Lignes Objectifs');
            }

            if (supersData.labels.length > 0) {
                console.log('Création graphique superviseurs');
                createChart('chartSuper', supersData, colors.super, 'Superviseurs');
                createChart('chartSuperGlobal', supers_data_global, colors.super, 'Superviseurs Objectifs');
            }

            if (moisData.labels.length > 0) {
                console.log('Création graphique mois');
                createChart('chartMois', moisData, colors.mois, 'Mois');
                createChart('chartMoisGlobal', mois_data_global, colors.mois, 'Mois Objectifs');
            }
        } catch (error) {
            console.error('Erreur lors de la création des graphiques:', error);
        }
    });
    // --- Fonction pour créer un tableau DataTable
    function createTable(tableId, labels, values) {
        console.log('Création tableau:', tableId);
        var title = "Moyenne visites/jour";
        if (tableId.includes('tableRegionGlobal') || tableId.includes('tableLigneGlobal') || tableId.includes('tableMoisGlobal') || tableId.includes('tableSuperGlobal') || tableId.includes('tableMoisGlobal') || tableId.includes('tableVmGlobal')) {
            title = "Pourcentage de réalisation";
        }
        if (tableId == "tableMois") {
            title = "Moyenne visites/mois";
        }
        var table = $('#' + tableId).DataTable({
            data: labels.map(function(label, i) {
                return [label, values[i].toFixed(2)];
            }),
            columns: [{
                    title: "Nom"
                },
                {
                    title: title
                }
            ],
            destroy: true,
            dom: 'Bfrtip',
            searching: false,
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export Excel',
                className: 'btn btn-success btn-sm'
            }]
        });
    }

    // --- Initialisation après DOM chargé
    document.addEventListener('DOMContentLoaded', function() {
        // Création des tableaux à partir des mêmes données
        if (regionsData.labels.length > 0) {
            createTable('tableRegion', regionsData.labels, regionsData.values);
            createTable('tableRegionGlobal', regionsData.labels, regions_data_global.values);
        }
        if (lignesData.labels.length > 0) {
            createTable('tableLigne', lignesData.labels, lignesData.values);
            createTable('tableLigneGlobal', lignesData.labels, lignes_data_global.values);
        }
        if (supersData.labels.length > 0) {
            createTable('tableSuper', supersData.labels, supersData.values);
            createTable('tableSuperGlobal', supersData.labels, supers_data_global.values);
        }
        if (moisData.labels.length > 0) {
            createTable('tableMois', moisData.labels, moisData.values);
            createTable('tableMoisGlobal', moisData.labels, mois_data_global.values);
        }
        if (vmData.labels.length > 0) {
            createTable('tableVm', vmData.labels, vmData.values);
            createTable('tableVmGlobal', vmData.labels, vm_data_global.values);
        }
    });
</script>

<script>
    /* ---------- Themed date range picker (self-contained, no external library) ---------- */
    /* Ported from pots/index.ctp: same reasoning as the calendar fix on the action
       edit page — no CDN dependency, so a dead/blocked host can't break it, and it
       matches this theme's palette natively instead of relying on the daterangepicker
       plugin (which also assumed a global jQuery instance that's no longer guaranteed
       to have plugins attached to it after the AdminLTE cleanup). */
    (function() {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }

        function parseRangeValue(val) {
            if (!val) return { start: null, end: null };
            var parts = val.split(' -- ');
            var toDate = function (s) {
                var p = (s || '').trim().split('-');
                if (p.length !== 3) return null;
                var d = new Date(parseInt(p[0], 10), parseInt(p[1], 10) - 1, parseInt(p[2], 10));
                return isNaN(d.getTime()) ? null : d;
            };
            return { start: toDate(parts[0]), end: toDate(parts[1]) };
        }

        function LBRangePicker(input) {
            this.input = input;
            var parsed = parseRangeValue(input.value);
            this.start = parsed.start;
            this.end = parsed.end;
            this.viewDate = this.start ? new Date(this.start) : new Date();
            this.popup = null;
            this._outsideHandler = null;
            this._reflowHandler = null;
            this.bind();
        }

        LBRangePicker.prototype.bind = function () {
            var self = this;
            this.input.setAttribute('readonly', 'readonly');
            this.input.addEventListener('click', function (e) {
                e.stopPropagation();
                if (self.popup) self.close(); else self.open();
            });
        };

        LBRangePicker.prototype.open = function () {
            var self = this;
            this.popup = document.createElement('div');
            this.popup.className = 'lb-range-popup';
            document.body.appendChild(this.popup);
            this.input.classList.add('lb-range-input-open');
            this.position();
            this.render();
            this._outsideHandler = function (e) { if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) self.close(); };
            this._reflowHandler = function () { self.position(); };
            setTimeout(function () {
                document.addEventListener('click', self._outsideHandler);
                window.addEventListener('resize', self._reflowHandler);
                window.addEventListener('scroll', self._reflowHandler, true);
            }, 0);
        };

        LBRangePicker.prototype.position = function () {
            if (!this.popup) return;
            var rect = this.input.getBoundingClientRect();
            this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
            this.popup.style.left = (window.scrollX + rect.left) + 'px';
        };

        LBRangePicker.prototype.close = function () {
            if (this.popup) { this.popup.parentNode.removeChild(this.popup); this.popup = null; }
            this.input.classList.remove('lb-range-input-open');
            if (this._outsideHandler) { document.removeEventListener('click', this._outsideHandler); this._outsideHandler = null; }
            if (this._reflowHandler) {
                window.removeEventListener('resize', this._reflowHandler);
                window.removeEventListener('scroll', this._reflowHandler, true);
                this._reflowHandler = null;
            }
        };

        LBRangePicker.prototype.updateInputText = function () {
            if (this.start && this.end) this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.end);
            else if (this.start) this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.start);
            else this.input.value = '';
            this.input.dispatchEvent(new Event('change'));
        };

        LBRangePicker.prototype.renderPanel = function (year, month, showPrev, showNext) {
            var self = this;
            var today = stripTime(new Date());
            var html = '<div class="lb-range-panel"><div class="lb-range-header">';
            html += '<button type="button" class="lb-range-nav' + (showPrev ? '' : ' lb-range-nav-hidden') + '" data-nav="prev">&#8249;</button>';
            html += '<span class="lb-range-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
            html += '<button type="button" class="lb-range-nav' + (showNext ? '' : ' lb-range-nav-hidden') + '" data-nav="next">&#8250;</button></div>';
            html += '<div class="lb-range-weekdays">';
            WEEKDAYS.forEach(function (w) { html += '<span>' + w + '</span>'; });
            html += '</div><div class="lb-range-grid">';

            var firstDay = new Date(year, month, 1);
            var startOffset = (firstDay.getDay() + 6) % 7;
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var daysInPrevMonth = new Date(year, month, 0).getDate();
            var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

            for (var i = 0; i < totalCells; i++) {
                var dayNum, cellDate, otherMonth = false;
                if (i < startOffset) { dayNum = daysInPrevMonth - startOffset + i + 1; cellDate = new Date(year, month - 1, dayNum); otherMonth = true; }
                else if (i >= startOffset + daysInMonth) { dayNum = i - startOffset - daysInMonth + 1; cellDate = new Date(year, month + 1, dayNum); otherMonth = true; }
                else { dayNum = i - startOffset + 1; cellDate = new Date(year, month, dayNum); }

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

        LBRangePicker.prototype.render = function () {
            var self = this;
            var leftYear = this.viewDate.getFullYear();
            var leftMonth = this.viewDate.getMonth();
            var rightRef = new Date(leftYear, leftMonth + 1, 1);

            var html = '<div class="lb-range-panels">';
            html += this.renderPanel(leftYear, leftMonth, true, false);
            html += '<div class="lb-range-divider"></div>';
            html += this.renderPanel(rightRef.getFullYear(), rightRef.getMonth(), false, true);
            html += '</div><div class="lb-range-footer">';
            html += '<button type="button" class="lb-range-clear-btn" data-action="clear">Annuler</button>';
            html += '<button type="button" class="lb-range-apply-btn" data-action="apply">Valider</button></div>';
            this.popup.innerHTML = html;

            var navBtns = this.popup.querySelectorAll('[data-nav]');
            for (var n = 0; n < navBtns.length; n++) {
                navBtns[n].addEventListener('click', function (e) {
                    e.stopPropagation();
                    self.viewDate.setMonth(self.viewDate.getMonth() + (this.getAttribute('data-nav') === 'next' ? 1 : -1));
                    self.render();
                    self.position();
                });
            }

            var dayBtns = this.popup.querySelectorAll('.lb-range-day');
            for (var d = 0; d < dayBtns.length; d++) {
                dayBtns[d].addEventListener('click', function (e) {
                    e.stopPropagation();
                    var p = this.getAttribute('data-date').split('-');
                    var picked = new Date(parseInt(p[0], 10), parseInt(p[1], 10) - 1, parseInt(p[2], 10));
                    if (!self.start || (self.start && self.end)) { self.start = picked; self.end = null; }
                    else if (picked < self.start) { self.end = self.start; self.start = picked; }
                    else self.end = picked;
                    self.render();
                    self.position();
                });
            }

            var clearBtn = this.popup.querySelector('[data-action="clear"]');
            if (clearBtn) clearBtn.addEventListener('click', function (e) { e.stopPropagation(); self.start = null; self.end = null; self.updateInputText(); self.close(); });

            var applyBtn = this.popup.querySelector('[data-action="apply"]');
            if (applyBtn) applyBtn.addEventListener('click', function (e) { e.stopPropagation(); self.updateInputText(); self.close(); });
        };

        function initRangePicker() {
            var el = document.getElementById('reservationtime');
            if (el && !el._lbRangeBound) { el._lbRangeBound = true; new LBRangePicker(el); }
        }
        document.addEventListener('DOMContentLoaded', initRangePicker);
        if (document.readyState === 'interactive' || document.readyState === 'complete') initRangePicker();
    })();

    /*
      IMPORTANT: select2 init is deliberately its OWN $(function(){...}) block, run
      independently from the DataTable init below. Previously both lived in one
      callback — if `.display').DataTable()` threw, select2() never ran, which is
      why the filter selects showed up as raw expanded multi-selects instead of
      collapsed dropdowns (see pots/index.ctp for the same fix).
    */
    $(function() {
        $('.choix_multi').select2();
    });

    $(function() {
        try {
            $('.display').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
        } catch (e) {
            console.error('DataTable (.display) init failed:', e);
        }
    });
</script>

