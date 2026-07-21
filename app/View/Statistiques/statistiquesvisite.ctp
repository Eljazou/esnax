<?php
// debug(count($visites), 0, 0);exit();
if (!isset($visites))
    $visites = array();
if (!isset($clientnonvisites))
    $clientnonvisites = array();
if (!isset($nombredeclientvisiter))
    $nombredeclientvisiter = 0;

if (!isset($potentialite))
    $potentialite = array();
if (!isset($potentialite["yes"]))
    $potentialite["yes"] = array();
if (!isset($potentialite["non"]))
    $potentialite["non"] = array();

if (!isset($categorie))
    $categorie = array();
if (!isset($categorie["yes"]))
    $categorie["yes"] = array();
if (!isset($categorie["non"]))
    $categorie["non"] = array();
if (!isset($frequences))
    $frequences = array();

ksort($potentialite["yes"]);
ksort($potentialite["non"]);

$frequencess = array_count_values($frequences);
?>

<!--
  NOTE ON SCRIPTS REMOVED FROM THIS VIEW (do not re-add):
  - jquery-2.2.3.min / a second moment.js copy: Metronic's plugins.bundle.js already
    loads a modern jQuery + moment globally. Re-loading an old jQuery here overwrote
    window.$ with a plugin-less copy AFTER Metronic had already attached DataTables /
    select2 / etc. to the original one, which is why $(...).DataTable() failed and
    plugins.bundle.js threw "e.indexOf is not a function" elsewhere on the page.
  - buttons.flash + pdfmake/vfs_fonts from cdn.rawgit.com: rawgit.com has been shut
    down for years, that <script> tag was 404-ing silently on every page load.
  - daterangepicker plugin: replaced by the self-contained "lb-range" date range
    picker (see the LBRangePicker script below), so no external plugin/css is
    loaded for #reservationtime anymore — keep it that way.
  If Excel/CSV/Print export ever needs to change, only touch the two script tags
  below (dataTables.buttons + buttons.html5/print + a live pdfmake CDN), nothing else.
-->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
    /* ===== Design system (svs) — purple theme, Bootstrap 5 / Metronic native ===== */
    .svs{ font-family:'Poppins',sans-serif; }

    /* -- stat cards (pastel) -- */
    .svs .stat-card{
        border:none; border-radius:16px; overflow:hidden;
        box-shadow:0 4px 20px rgba(0,0,0,.06); height:100%;
    }
    .svs .stat-card .card-body{ padding:20px 22px; }
    .svs .stat-card .stat-label{
        font-size:12.5px; font-weight:700; letter-spacing:.4px;
        text-transform:uppercase; opacity:.85;
    }
    .svs .stat-card .stat-number{ font-size:26px; font-weight:700; display:block; margin-top:2px; }
    .svs .stat-card .progress{ height:3px; margin:10px 0 8px; }
    .svs .stat-card .stat-desc{ font-size:12.5px; opacity:.75; }

    .svs .stat-card.bg-blue{ background:#eaf0fd; }
    .svs .stat-card.bg-blue .stat-label,
    .svs .stat-card.bg-blue .stat-number,
    .svs .stat-card.bg-blue .stat-desc{ color:#4e73df; }
    .svs .stat-card.bg-blue .progress{ background:rgba(78,115,223,.15); }
    .svs .stat-card.bg-blue .progress-bar{ background:#4e73df; }

    .svs .stat-card.bg-green{ background:#e8f8f0; }
    .svs .stat-card.bg-green .stat-label,
    .svs .stat-card.bg-green .stat-number,
    .svs .stat-card.bg-green .stat-desc{ color:#2e9e68; }
    .svs .stat-card.bg-green .progress{ background:rgba(46,158,104,.15); }
    .svs .stat-card.bg-green .progress-bar{ background:#2e9e68; }

    .svs .stat-card.bg-red{ background:#fdecec; }
    .svs .stat-card.bg-red .stat-label,
    .svs .stat-card.bg-red .stat-number,
    .svs .stat-card.bg-red .stat-desc{ color:#e0453f; }
    .svs .stat-card.bg-red .progress{ background:rgba(224,69,63,.15); }
    .svs .stat-card.bg-red .progress-bar{ background:#e0453f; }

    /* -- filter card -- */
    .svs-filterbox{
        background:#fff; border:none; border-radius:18px;
        box-shadow:0 4px 24px rgba(108,99,245,.08); padding:26px 30px;
    }
    .svs-filterbox .svs-date-row{
        display:flex; align-items:center; gap:16px; flex-wrap:wrap;
        padding-bottom:20px; margin-bottom:22px; border-bottom:1px solid #eeecf9;
    }
    .svs-icon-badge{
        width:40px; height:40px; min-width:40px; border-radius:12px;
        background:linear-gradient(135deg,#efeeff,#e3e0ff);
        display:flex; align-items:center; justify-content:center;
    }
    .svs-icon-badge svg{ width:18px; height:18px; stroke:#6C63F5; }
    .svs-date-label{ font-size:15px; font-weight:600; color:#2d2b45; margin:0; }
    .svs-filterbox .input-group{ border:1.5px solid #e7e5f7; border-radius:12px; flex:1; min-width:260px; }
    .svs-filterbox .input-group-text{ background:#faf9ff; border:none; border-right:1.5px solid #e7e5f7; color:#6C63F5; }
    .svs-filterbox .input-group .form-control{ border:none; box-shadow:none; padding:11px 16px; }
    .svs-field-label{ display:flex; align-items:center; gap:8px; font-size:13.5px; font-weight:600; color:#454358; margin-bottom:6px; }
    .svs-field-label svg{ width:15px; height:15px; stroke:#6C63F5; }
    .svs-filterbox .form-control,
    .svs-filterbox .select2-container .select2-selection{
        border-radius:12px !important; border:1.5px solid #e7e5f7 !important;
        box-shadow:none !important; min-height:42px;
    }
    .svs-filterbox .select2-selection__rendered{ line-height:40px !important; padding-left:14px !important; }
    .svs-filterbox .select2-selection__arrow{ height:40px !important; }
    .svs-filterbox .btn-search{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2); border:none; border-radius:999px;
        padding:10px 22px; font-weight:600; font-size:14px;
        box-shadow:0 6px 18px rgba(108,99,245,.3); color:#fff;
    }

    /* -- content cards (charts / tables / maps) -- */
    .svs .card{
        border:none; border-radius:16px; box-shadow:0 4px 20px rgba(108,99,245,.07);
        margin-bottom:22px; overflow:hidden;
    }
    .svs .card-header{
        border:none; display:flex; align-items:center; gap:12px; padding:20px 24px 14px; position:relative;
    }
    .svs .card-header:before{
        content:''; width:7px; height:22px; min-width:7px; border-radius:4px;
        background:linear-gradient(180deg,#6C63F5,#8c7ef2);
    }
    .svs .card-header .card-title{ font-size:16px; font-weight:600; color:#2d2b45; margin:0; }
    .svs .card-header .card-tools{ margin-left:auto; }
    .svs .card-header .btn-tool{ color:#6C63F5; }
    .svs .card-body{ padding:20px 24px 24px; }

    .svs table.dataTable thead th{
        background:#faf9ff !important; color:#4a4863 !important; font-weight:600 !important;
        font-size:13px; border-bottom:2px solid #ece9fb !important;
    }
    .svs table.dataTable tbody td{ font-size:13.5px; color:#454358; vertical-align:middle; border-color:#eeecf9 !important; }
    .svs table.dataTable tbody tr:hover{ background:#f4f2ff !important; }
    .svs .dt-button, .svs .buttons-csv, .svs .buttons-excel, .svs .buttons-print, .svs .btn-download{
        border-radius:999px !important; border:none !important; font-weight:600 !important;
        font-size:12.5px !important; padding:7px 16px !important; margin:4px 6px 10px 0 !important;
        display:inline-flex !important; align-items:center; gap:5px;
    }
    .svs .buttons-csv, .svs .buttons-print, .svs .btn-download{ background:#f1effe !important; color:#6C63F5 !important; }
    .svs .buttons-excel{ background:#e8f8ee !important; color:#1f9d55 !important; }
    .svs .dataTables_filter input{ border-radius:999px !important; border:1.5px solid #e7e5f7 !important; padding:6px 14px !important; }
    .svs .dataTables_paginate .paginate_button{ border-radius:999px !important; border:1px solid #e7e5f7 !important; margin:0 3px; color:#6a6785 !important; }
    .svs .dataTables_paginate .paginate_button.current{ background:#6C63F5 !important; border-color:#6C63F5 !important; color:#fff !important; }
    .svs .modal-content{ border-radius:16px; border:none; }
    .svs .logo-soceite img{ border-radius:6px; }

    /* -- self-contained date range picker (no external plugin dependency) -- */
    .lb-range-popup{ position:absolute; z-index:9999; background:#fff; border:1px solid #e7e5f7; border-radius:14px;
        box-shadow:0 10px 34px rgba(108,99,245,.2); padding:16px; font-family:'Poppins',sans-serif; user-select:none; }
    .lb-range-panels{ display:flex; gap:22px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:#eeecf9; }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:#2d2b45; font-size:14.5px; }
    .lb-range-nav{ border:none; background:#efeeff; color:#6C63F5; width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:#ded8ff; }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:#6C63F5; text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:#2d2b45; cursor:pointer; }
    .lb-range-day:hover{ background:#efeeff; }
    .lb-range-day.other-month{ color:#b9b9d1; opacity:.5; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px #6C63F5; }
    .lb-range-day.in-range{ background:#efeeff; border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:#6C63F5 !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; justify-content:space-between; margin-top:14px; border-top:1px solid #eeecf9; padding-top:10px; }
    .lb-range-clear-btn{ border:none; background:none; color:#6C63F5; font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:#efeeff; }
    .lb-range-apply-btn{ border:none; background:#6C63F5; color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:6px 14px; border-radius:16px; }
    .lb-range-apply-btn:hover{ background:#5a52e0; }
    .lb-range-input-open{ border-color:#6C63F5 !important; box-shadow:0 0 0 3px #efeeff !important; }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<div class="row svs">
    <div class="col-12 mb-4">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <div class="stat-card bg-blue">
                    <div class="card-body">
                        <span class="stat-label">Nombre de visites</span>
                        <span class="stat-number"><?php echo count($visites); ?></span>
                        <div class="progress"><div class="progress-bar" style="width:100%"></div></div>
                        <span class="stat-desc">dans la période <?php echo $dateaafficherdansleview; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-green">
                    <div class="card-body">
                        <span class="stat-label">Nombre de Clients visités</span>
                        <span class="stat-number"><?php echo $nombredeclientvisiter; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo count($visites) == 0 ? 0 : ($nombredeclientvisiter * 100) / count($visites); ?>%"></div>
                        </div>
                        <span class="stat-desc">dans la période <?php echo $dateaafficherdansleview; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-red">
                    <div class="card-body">
                        <span class="stat-label">Nombre de Clients non visités</span>
                        <span class="stat-number"><?php echo count($clientnonvisites); ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo count($visites) == 0 ? 0 : (count($clientnonvisites) * 100) / count($visites); ?>%"></div>
                        </div>
                        <span class="stat-desc">dans la période <?php echo $dateaafficherdansleview; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="svs-filterbox">
            <form action="<?php echo $this->Html->url("/statistiques/statistiquesvisite") ?>" method="post" id="dateform" autocomplete="off">
                <div class="svs-date-row">
                    <div class="svs-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <p class="svs-date-label">Choisissez une date</p>
                    <div class="input-group flex-nowrap" style="max-width:520px;">
                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        <input type="text" <?php if ($dateaafficherdansleview != "") echo 'value="' . $dateaafficherdansleview . '"'; ?> class="form-control" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                            Choisissez une activité
                        </div>
                        <?php
                        echo $this->Form->input('category', array(
                            "id" => "FilterActivite",
                            "label" => false,
                            "name" => "activite",
                            'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                            'class' => 'form-control mb-3'
                        ));
                        ?>

                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15 9 22 9.5 17 14.5 18.5 22 12 18 5.5 22 7 14.5 2 9.5 9 9 12 2"/></svg>
                            Choisissez potentialité
                        </div>
                        <?php
                        echo $this->Form->input('potentialite', array(
                            "multiple" => "true",
                            "label" => false,
                            "name" => "potentialite",
                            'options' => array(
                                "A1" => "A1", "A2" => "A2", "A3" => "A3", "A4" => "A4",
                                "B1" => "B1", "B2" => "B2", "B3" => "B3", "B4" => "B4",
                                "C1" => "C1", "C2" => "C2", "C3" => "C3", "C4" => "C4"
                            ),
                            'class' => 'form-control mb-3 choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        ?>

                        <?php if (AuthComponent::user('role') != 'Super viseur') : ?>
                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            La liste des secteurs
                        </div>
                        <?php
                        echo $this->Form->input('category', array(
                            "id" => "FilterSecteur",
                            "multiple" => "true",
                            "label" => false,
                            "name" => "secteur",
                            'options' => $secteurs,
                            'class' => 'form-control mb-3 choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        endif;
                        ?>

                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg>
                            La liste des spécialité
                        </div>
                        <?php
                        echo $this->Form->input('category', array(
                            "id" => "FilterCategorie",
                            "multiple" => "true",
                            "label" => false,
                            "name" => "category",
                            'options' => $categories,
                            'class' => 'form-control choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        ?>
                    </div>

                    <div class="col-md-6">
                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            La liste des VM
                        </div>
                        <?php
                        echo $this->Form->input('user', array(
                            'type' => 'select',
                            'label' => false,
                            'name' => 'users',
                            'options' => $users,
                            'class' => 'form-control mb-3 choix_multi vm select2',
                            'multiple' => 'multiple',
                            'selected' => !empty($this->request->data['users']) ? $this->request->data['users'] : array()
                        ));
                        ?>

                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                            Les lignes
                        </div>
                        <?php
                        echo $this->Form->input('ligne', array(
                            "multiple" => "true",
                            "label" => false,
                            "name" => "ligne",
                            'options' => $lignes,
                            'class' => 'form-control mb-3 choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        $typess = array("1" => "Medcin", "2" => "Pharmacie");
                        ?>

                        <div class="svs-field-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M6 21a6 6 0 0 1 12 0"/></svg>
                            Type de client
                        </div>
                        <?php
                        echo $this->Form->input('type', array(
                            "multiple" => "true",
                            "label" => false,
                            "name" => "type",
                            'options' => $typess,
                            'class' => 'form-control choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        ?>
                    </div>

                    <div class="col-12 mt-2 text-end">
                        <input type="submit" value="Rechercher" class="btn-search">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Activité des clients</h3></div>
            <div class="card-body">
                <div class="col-12" style="box-shadow:1px 0px 3px rgba(0,0,0,0.08);">
                    <div id="piechart_3d" style="width:100%;height:500px;"></div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead>
                            <tr><th>Activité</th><th>Visités</th><th>Non visités</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Publique<?php
                                            if (isset($activite["yes"]["Publique"])) {
                                                $total = $activite["yes"]["Publique"] + $activite["non"]["Publique"];
                                                if ($total == 0) $total = 1;
                                                $poryes = round($activite["yes"]["Publique"] / $total * 100, 2);
                                                $pornon = round($activite["non"]["Publique"] / $total * 100, 2);
                                            } else {
                                                $activite["yes"]["Publique"] = 0;
                                                $activite["non"]["Publique"] = 0;
                                                $poryes = 0;
                                                $pornon = 0;
                                            }
                                            ?></td>
                                <td><?php echo $activite["yes"]["Publique"] . " ($poryes %)"; ?></td>
                                <td><?php echo $activite["non"]["Publique"] . " ($pornon %)"; ?></td>
                            </tr>
                            <tr>
                                <td>Privé<?php
                                            if (isset($activite["yes"]["Prive"])) {
                                                $total = $activite["yes"]["Prive"] + $activite["non"]["Prive"];
                                                if ($total == 0) $total = 1;
                                                $poryes = round($activite["yes"]["Prive"] / $total * 100, 2);
                                                $pornon = round($activite["non"]["Prive"] / $total * 100, 2);
                                            } else {
                                                $activite["yes"]["Prive"] = 0;
                                                $activite["non"]["Prive"] = 0;
                                                $poryes = 0;
                                                $pornon = 0;
                                            }
                                            ?></td>
                                <td><?php echo $activite["yes"]["Prive"] . " ($poryes %)"; ?></td>
                                <td><?php echo $activite["non"]["Prive"] . " ($pornon %)"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Visites par potentialité</h3></div>
            <div class="card-body">
                <div class="col-12" style="box-shadow:1px 0px 3px rgba(0,0,0,0.08);">
                    <div id="bar_chart1" style="width:100%;height:500px;"></div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead><tr><th>potentialité</th><th>Visiter</th><th>Non visiter</th></tr></thead>
                        <tbody>
                            <?php
                            foreach ($potentialite["yes"] as $key => $value) {
                                $i = 0;
                                foreach ($potentialite["non"] as $k => $v) {
                                    if ($k == $key) {
                                        $i = 1;
                                        $total = $value + $v;
                                        if ($total == 0) $total = 1;
                                        $potyes = round($value / $total * 100, 2);
                                        $potnon = round($v / $total * 100, 2);
                                        echo "<tr><td>$key</td><td>$value ( $potyes % )</td><td>$v ( $potnon % )</td></tr>";
                                        break;
                                    }
                                }
                                if ($i == 0)
                                    echo "<tr><td>$key</td><td>$value ( 100 % )</td><td>0 ( 0 % )</td></tr>";
                            }
                            foreach ($potentialite["non"] as $key => $value) {
                                $i = 0;
                                foreach ($potentialite["yes"] as $k => $v) {
                                    if ($k == $key) { $i = 1; break; }
                                }
                                if ($i == 0) {
                                    echo "<tr><td>$key</td><td>0 ( 0 % )</td><td>$value (100 % )</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Visites par spécialité</h3></div>
            <div class="card-body">
                <div class="col-12" style="box-shadow:1px 0px 3px rgba(0,0,0,0.08);">
                    <div id="bar_chart2" style="width:100%;height:500px;margin-bottom:19px;"></div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead><tr><th>spécialité</th><th>Visiter</th><th>Non visiter</th></tr></thead>
                        <tbody>
                            <?php
                            $categories[] = "";
                            $categories["null"] = "";
                            foreach ($categorie["yes"] as $k => $v) {
                                $i = 0;
                                foreach ($categorie["non"] as $key => $value) {
                                    if ($k == $key) {
                                        $total = $value + $v;
                                        if ($total == 0) $total = 1;
                                        $potyes = round($v / $total * 100, 2);
                                        $potnon = round($value / $total * 100, 2);
                                        if (!isset($categories[$k])) $categories[$k] = "";
                                        echo "<tr><td>$categories[$k]</td><td>$v ( $potyes % )</td><td>$value ( $potnon % )</td></tr>";
                                        $i = 1;
                                        break;
                                    }
                                }
                                if ($i == 0) {
                                    if (!isset($categories[$k])) $categories[$k] = "";
                                    echo "<tr><td>$categories[$k]</td><td>$v ( 100 % )</td><td>0 ( 0 % )</td></tr>";
                                }
                            }
                            foreach ($categorie["non"] as $k => $v) {
                                $i = 0;
                                foreach ($categorie["yes"] as $key => $value) {
                                    if ($k == $key) { $i = 1; break; }
                                }
                                if ($i == 0) {
                                    if (!isset($categories[$k])) $categories[$k] = "";
                                    echo "<tr><td>$categories[$k]</td><td>0 ( 0 % )</td><td>$v ( 100 % )</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Fréquences des visites</h3></div>
            <div class="card-body">
                <div class="col-12" style="box-shadow:1px 0px 3px rgba(0,0,0,0.08);">
                    <div id="bar_chart3" style="width:100%;height:500px;margin-bottom:19px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">La liste des visites</h3></div>
            <div class="card-body">
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead>
                            <tr>
                                <th>VM</th><th>Client</th><th>Type pharmacie</th><th>code wavsoft</th>
                                <th>Secteur</th><th>Activite</th><th>POT</th><th>Nombre de visite</th><th>Date du visite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $existe = array();
                            $maps = $clientsmaps = "";
                            foreach ($visites as $visite) :
                                if (!empty($visite["Visite"]['longitude']) && strlen($visite["Visite"]['longitude']) > 4)
                                    $maps = $maps . "['" .
                                        $visite["User"]["name"] . "','" .
                                        str_replace("'", " ", $visite["Client"]["nom"]) . "','" .
                                        $visite["Visite"]["latitude"] . "','" .
                                        $visite["Visite"]["longitude"] . "','" .
                                        $visite["Visite"]["date"] . "','" .
                                        $visite["Client"]["potentialite"] . "','" .
                                        $types[$visite["Client"]["type_id"]] . "','" .
                                        $categories[$visite["Client"]["category_id"]] . "'],
                                ";
                                if (isset($existe[$visite["Visite"]["client_id"]]))
                                    continue;
                                if (!empty($visite["Client"]['longitude']) && strlen($visite["Client"]['longitude']) > 4)
                                    $clientsmaps = $clientsmaps . "['" . $visite["User"]["name"] . "','" . str_replace("'", " ", $visite["Client"]["nom"]) . "','" . $visite["Client"]["latitude"] . "','" . $visite["Client"]["longitude"] . "','" . $visite["Visite"]["date"] . "','" . $visite["Client"]["potentialite"] . "','" . $types[$visite["Client"]["type_id"]] . "','" . $categories[$visite["Client"]["category_id"]] . "'],
                                ";
                                $existe[$visite["Visite"]["client_id"]] = $visite["Visite"]["client_id"];
                            ?>
                                <tr>
                                    <td><?php echo $visite["User"]["name"] ?></td>
                                    <td><?php echo $this->Html->link($visite["Client"]["nom"] . " " . $visite["Client"]["prenom"], array("controller" => "clients", "action" => "view", $visite["Client"]["id"])); ?></td>
                                    <td><?php echo $visite["Client"]["type_pharmacie"]; ?></td>
                                    <td><?php echo $visite["Client"]["code_wavsoft"]; ?></td>
                                    <td><?php echo $allsecteurs[$visite["Client"]["secteur_id"]]; ?></td>
                                    <td><?php echo $visite["Client"]["activite"] ?></td>
                                    <td><?php echo $visite["Client"]["potentialite"] ?></td>
                                    <td><?php echo $frequences[$visite["Client"]["id"]] ?></td>
                                    <td><?php echo $visite["Visite"]["date"] ?></td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">La liste des clients non visites</h3></div>
            <div class="card-body">
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead><tr><th>Client</th><th>Activite</th><th>POT</th></tr></thead>
                        <tbody>
                            <?php foreach ($clientnonvisites as $client): ?>
                                <tr>
                                    <td><?php echo $this->Html->link($client["Client"]["nom"] . " " . $client["Client"]["prenom"], array("controller" => "clients", "action" => "view", $client["Client"]["id"])); ?></td>
                                    <td><?php echo $client["Client"]["activite"] ?></td>
                                    <td><?php echo $client["Client"]["potentialite"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($ordredeprentation)) :
        $classement = array();
        for ($i = 1; $i <= count($ordredeprentation); $i++) $classement[$i] = "C $i";
    ?>
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">ODP</h3></div>
            <div class="card-body">
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead>
                            <tr><td>Brochure</td><?php foreach ($classement as $key => $values) echo "<th>$values</th>"; ?><td>Total</td></tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($brochures as $brochure) {
                                $total = 0;
                                echo '<tr><td><div class="logo-soceite">
                                    <img class="img-fluid" style="width:116px;height:23px !important;object-fit:cover;" src="' . $this->Html->url("/img/brochures/" . $brochure["Brochure"]["logo"]) . '" />
                                    </div></td>';
                                foreach ($classement as $k => $v) {
                                    $kain = 0;
                                    foreach ($ordredeprentation as $key => $value) {
                                        foreach ($value as $idd => $vv) {
                                            if ($k == $key && $idd == $brochure["Brochure"]["id"]) {
                                                $kain = 1;
                                                $total += $vv["nombre"];
                                                echo "<td>" . $vv["nombre"] . "</td>";
                                            }
                                        }
                                    }
                                    if ($kain == 0) echo "<td>0</td>";
                                }
                                echo "<td>$total</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">ODP en %</h3></div>
            <div class="card-body">
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead>
                            <tr><td>Brochure</td><?php foreach ($classement as $key => $values) echo "<th>$values</th>"; ?><td>Seuil de présentation</td></tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($brochures as $brochure) {
                                $total = 0;
                                echo '<tr><td><div class="logo-soceite">
                                    <img class="img-fluid" style="width:116px;height:23px !important;object-fit:cover;" src="' . $this->Html->url("/img/brochures/" . $brochure["Brochure"]["logo"]) . '" />
                                    </div></td>';
                                foreach ($classement as $k => $v) {
                                    foreach ($ordredeprentation as $key => $value) {
                                        foreach ($value as $idd => $vv) {
                                            if ($k == $key && $idd == $brochure["Brochure"]["id"]) {
                                                $total += $vv["nombre"];
                                            }
                                        }
                                    }
                                }
                                foreach ($classement as $k => $v) {
                                    $kain = 0;
                                    foreach ($ordredeprentation as $key => $value) {
                                        foreach ($value as $idd => $vv) {
                                            if ($k == $key && $idd == $brochure["Brochure"]["id"]) {
                                                $kain = 1;
                                                echo "<td>" . round($vv["nombre"] / $total * 100, 2) . " %</td>";
                                            }
                                        }
                                    }
                                    if ($kain == 0) echo "<td>0 %</td>";
                                }
                                echo "<td>" . round($total / count($visites) * 100, 2) . " %</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Produits de la campagne</h3></div>
            <div class="card-body">
                <div class="col-12" style="box-shadow:1px 0px 3px rgba(0,0,0,0.08);">
                    <div id="chart_boite" style="width:100%;height:500px;margin-bottom:19px;"></div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered display" id="example1">
                        <thead>
                            <tr>
                                <th>VM</th><th>Nom</th><th>POT</th><th>Spécialité</th><th>Secteur</th>
                                <th>Gamme</th><th>POT Gamme</th><th>POT 1</th><th>POT 2</th><th>POT 3</th><th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $chartboite = "";
                            $chart = array();
                            foreach ($p_presanter as $visite_id => $presanter) {
                                foreach ($presanter as $client) {
                                    foreach ($client as $key => $value) {
                                        $total = $value["1"] * 5 + $value["2"] * 10 + $value["3"] * 20;
                                        echo "<tr><td>" . $value["Client"]["user"] . "</td>";
                                        echo "<td>" . $this->Html->link($value["Client"]["nom"] . " " . $value["Client"]["prenom"], array("controller" => "clients", "action" => "view", $value["Client"]["id"])) . "</td>";
                                        echo "<td>" . $value["Client"]["potentialite"] . "</td>";
                                        echo "<td>" . $categories[$value["Client"]["category_id"]] . "</td>";
                                        echo "<td>" . $allsecteurs[$value["Client"]["secteur_id"]] . "</td>";
                                        echo "<td>$key</td>";
                                        echo "<td>" . $value["pot"] . "</td>";
                                        echo "<td>" . $value["1"] . "</td>";
                                        echo "<td>" . $value["2"] . "</td>";
                                        echo "<td>" . $value["3"] . "</td>";
                                        echo "<td>" . $value["date"] . "</td>";
                                        if (!isset($chart[$key])) $chart[$key] = 0;
                                        $chart[$key] = $total + $chart[$key];
                                    }
                                }
                            }
                            foreach ($chart as $k => $v) $chartboite = $chartboite . "['$k',$v],";
                            $chartboite = trim($chartboite, ",");
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cartographie des visites</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map-canvas" style="position:relative;overflow:hidden;width:100%;height:88vh"></div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Détail</h4>
                                <div class="card-tools">
                                    <span data-toggle="tooltip" title="" class="badge bg-success message-date" data-original-title="3 New Messages"></span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="#" method="post" id="dateform2">
                                <div class="modal-body" style="max-height:60vh;height:auto;overflow-y:auto;text-align:justify;">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped"><tbody></tbody></table>
                                    </div>
                                    <div class="col-12 action"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cartographie des clients</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map-canvas2" style="position:relative;overflow:hidden;width:100%;height:88vh"></div>
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">Détail</h4>
                                <div class="card-tools">
                                    <span data-toggle="tooltip" title="" class="badge bg-success message-date" data-original-title="3 New Messages"></span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="#" method="post" id="dateform3">
                                <div class="modal-body" style="max-height:60vh;height:auto;overflow-y:auto;text-align:justify;">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped"><tbody></tbody></table>
                                    </div>
                                    <div class="col-12 action"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.choix_multi').select2({
            placeholder: 'Choisissez...',
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: false,
            closeOnSelect: true
        });
    });

    $(function () {
        try {
            $('.display').DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: ['csv', 'excel', 'print']
            });
        } catch (e) {
            console.error('DataTable (.display) init failed:', e);
        }
    });

    $(function () {
        try {
            $('#example1').DataTable({
                paging: false,
                lengthChange: false,
                searching: true,
                ordering: false,
                info: false,
                autoWidth: true,
                bSort: false,
                iDisplayLength: 250,
                aaSorting: [],
                dom: 'Bfrtip',
                buttons: ['excel']
            });
        } catch (e) {
            console.error('DataTable (#example1) init failed:', e);
        }
    });
</script>

<script>
    /* ---------- Themed date range picker (self-contained, no external library) ----------
       Replaces the old jQuery daterangepicker plugin. Same markup/id (#reservationtime),
       same "YYYY-MM-DD -- YYYY-MM-DD" value format posted to the server, but styled to
       match the "svs" purple design system used across this view. */
    (function () {
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
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Activité', 'Visiter', "non visiter"],
            <?php
            $activitee = "['Publique'," . $activite["yes"]["Publique"] . "," . $activite["non"]["Publique"] . "]";
            $activitee .= ",['Prive'," . $activite["yes"]["Prive"] . "," . $activite["non"]["Prive"] . "]";
            echo $activitee;
            ?>
        ]);
        var options = {
            title: 'Activité des clients',
            vAxis: { title: '%' },
            hAxis: { title: 'Activité' },
            seriesType: 'bars',
            series: { 5: { type: 'line' } }
        };
        var chart = new google.visualization.ComboChart(document.getElementById('piechart_3d'));
        google.visualization.events.addListener(chart, 'ready', function () {
            $('#piechart_3d').prepend('<a href="' + chart.getImageURI() + '" class="btn-download btn btn-primary" style="margin-top:20px;" download="' + chart.getImageURI() + '"><i class="fa fa-download"></i> Exporter</a>');
        });
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawVisualization);
    function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
            ['Potentialité', 'Visites', "Non visiter"],
            <?php
            $potentialitee = '';
            foreach ($potentialite["yes"] as $key => $value) {
                $i = 0;
                foreach ($potentialite["non"] as $k => $v) {
                    if ($k == $key) { $i = 1; $potentialitee .= "['$key',$value,$v],"; break; }
                }
                if ($i == 0) $potentialitee .= "['$key',$value,0],";
            }
            foreach ($potentialite["non"] as $key => $value) {
                $i = 0;
                foreach ($potentialite["yes"] as $k => $v) { if ($k == $key) { $i = 1; break; } }
                if ($i == 0) $potentialitee .= "['$key',0,$value],";
            }
            echo rtrim($potentialitee, ",");
            ?>
        ]);
        var options = {
            title: 'Visites par potentialité',
            vAxis: { title: 'nombre de visites' },
            hAxis: { title: 'Potentialité' },
            seriesType: 'bars',
            series: { 5: { type: 'line' } }
        };
        var chart = new google.visualization.ComboChart(document.getElementById('bar_chart1'));
        google.visualization.events.addListener(chart, 'ready', function () {
            $('#bar_chart1').prepend('<a href="' + chart.getImageURI() + '" class="btn-download btn btn-primary" style="margin-top:20px;" download="' + chart.getImageURI() + '"><i class="fa fa-download"></i> Exporter</a>');
        });
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawVisualization1);
    function drawVisualization1() {
        var data = google.visualization.arrayToDataTable([
            ['Spécialité', 'Visites', "Non visiter"],
            <?php
            $catghraph = "";
            foreach ($categories as $k => $v) {
                $yes = isset($categorie["yes"][$k]) ? $categorie["yes"][$k] : 0;
                $non = isset($categorie["non"][$k]) ? $categorie["non"][$k] : 0;
                if ($non != 0 || $yes != 0) $catghraph .= "['$v',$yes,$non],";
            }
            echo rtrim($catghraph, ",");
            ?>
        ]);
        var options = {
            title: 'Visites par spécialité',
            vAxis: { title: 'nombre de visites' },
            hAxis: { title: 'Spécialité', textStyle: { fontSize: 12 } },
            seriesType: 'bars',
            series: { 5: { type: 'line' } }
        };
        var chart = new google.visualization.ComboChart(document.getElementById('bar_chart2'));
        google.visualization.events.addListener(chart, 'ready', function () {
            $('#bar_chart2').prepend('<a href="' + chart.getImageURI() + '" class="btn-download btn btn-primary" style="margin-top:20px;" download="' + chart.getImageURI() + '"><i class="fa fa-download"></i> Exporter</a>');
        });
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawVisualization3);
    function drawVisualization3() {
        var data = google.visualization.arrayToDataTable([
            ['Fréquences', 'Clients'],
            <?php
            ksort($frequencess);
            $frequencese = '';
            foreach ($frequencess as $key => $value) $frequencese .= "['$key',$value],";
            echo rtrim($frequencese, ",");
            ?>
        ]);
        var options = {
            title: 'Fréquences des visites',
            vAxis: { title: 'fréquences' },
            hAxis: { title: 'nombre de visites' },
            seriesType: 'bars',
            series: { 5: { type: 'line' } }
        };
        var chart = new google.visualization.ComboChart(document.getElementById('bar_chart3'));
        google.visualization.events.addListener(chart, 'ready', function () {
            $('#bar_chart3').prepend('<a href="' + chart.getImageURI() + '" class="btn-download btn btn-primary" style="margin-top:20px;" download="' + chart.getImageURI() + '"><i class="fa fa-download"></i> Exporter</a>');
        });
        chart.draw(data, options);
    }

    var superarray = {
        <?php
        foreach ($equipes as $k => $value) {
            $ids = "";
        ?> "<?php echo $k; ?>id": [{
                "data": <?php
                        foreach ($value as $key => $v) $ids .= ",'" . $key . "'";
                        $ids = ltrim($ids, ',');
                        ?>[<?php echo $ids; ?>]
            }],
        <?php } ?>
    };
    var item = [];
    $('.vm').on('select2:select', function (e) {
        var array = [];
        var ids = $(this).val() + 'id';
        if (ids.indexOf(',') > -1) {
            var idsi = ids.split(',');
            ids = idsi[idsi.length - 1];
        }
        if (ids in superarray) {
            array = superarray[ids][0].data;
            var select = [ids.replace('id', '')];
            for (var i = 0; i < array.length; i++) select.push(array[i]);
            $('.vm').select2('val', [select]);
            item += select;
        }
    });
</script>

<script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(function () {
        var data = google.visualization.arrayToDataTable([
            ['Gamme', 'Nombre de boite/semaine'],
            <?php echo $chartboite; ?>
        ]);
        var options = { title: 'Nombre de boite/semaine', is3D: true };
        var chart = new google.visualization.PieChart(document.getElementById('chart_boite'));
        chart.draw(data, options);
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q"></script>
<?php echo $this->Html->script('markerclusterer_compiled'); ?>
<script>
    function initialize() {
        var locations = [<?php echo $maps; ?>];
        var locationsclients = [<?php echo $clientsmaps; ?>];
        var center = new google.maps.LatLng(33.5719036, -7.5873685);

        var map = new google.maps.Map(document.getElementById('map-canvas'), { zoom: 5, center: center, mapTypeId: google.maps.MapTypeId.ROADMAP });
        var map2 = new google.maps.Map(document.getElementById('map-canvas2'), { zoom: 5, center: center, mapTypeId: google.maps.MapTypeId.ROADMAP });

        var markers = [];
        var markers2 = [];

        for (var i = 0; i < locations.length; i++) {
            var latLng = new google.maps.LatLng(locations[i][2], locations[i][3]);
            var marker = new google.maps.Marker({ position: latLng });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    $('#myModal .table tbody').empty();
                    $('#myModal .action').empty();
                    var htm = '<tr><th>Nom de l\'utilisateur</th><td>' + locations[i][0] + '</td></tr><tr><th>Nom & Prénom de client</th><td>' + locations[i][1] + '</td></tr><tr><th>Potentialite</th><td>' + locations[i][5] + '</td></tr><tr><th>type</th><td>' + locations[i][6] + '</td></tr><tr><th>Spécialité</th><td>' + locations[i][7] + '</td></tr>';
                    $('#myModal .table tbody').append(htm);
                    $('#myModal .message-date').empty().append(locations[i][4]);
                    var modal = new bootstrap.Modal(document.getElementById('myModal'));
                    modal.show();
                };
            })(marker, i));
            markers.push(marker);
        }
        new MarkerClusterer(map, markers, { maxZoom: 9, imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });

        for (var i = 0; i < locationsclients.length; i++) {
            var latLng2 = new google.maps.LatLng(locationsclients[i][2], locationsclients[i][3]);
            var marker2 = new google.maps.Marker({ position: latLng2 });
            google.maps.event.addListener(marker2, 'click', (function (marker2, i) {
                return function () {
                    $('#myModal2 .table tbody').empty();
                    $('#myModal2 .action').empty();
                    var htm = '<tr><th>Nom de l\'utilisateur</th><td>' + locationsclients[i][0] + '</td></tr><tr><th>Nom & Prénom de client</th><td>' + locationsclients[i][1] + '</td></tr><tr><th>Potentialite</th><td>' + locationsclients[i][5] + '</td></tr><tr><th>type</th><td>' + locationsclients[i][6] + '</td></tr><tr><th>Spécialité</th><td>' + locationsclients[i][7] + '</td></tr>';
                    $('#myModal2 .table tbody').append(htm);
                    $('#myModal2 .message-date').empty().append(locationsclients[i][4]);
                    var modal2 = new bootstrap.Modal(document.getElementById('myModal2'));
                    modal2.show();
                };
            })(marker2, i));
            markers2.push(marker2);
        }
        new MarkerClusterer(map2, markers2, { maxZoom: 9, imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
