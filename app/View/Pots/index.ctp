<?php
echo $this->Html->css('select2.min');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!--
  NOTE — scripts removed from this view, do not re-add:
  jquery-2.2.3.min / bootstrap.min / app.min / jquery.dataTables.min / jquery.slimscroll.min /
  fastclick / demo / select2.full.min / a second moment.js / dataTables.bootstrap.css /
  _all-skins.min.css / chart.js (unused in this view).
  These are the legacy AdminLTE stack. Metronic's own bundle already provides jQuery,
  DataTables, select2 and moment globally — re-loading them here overwrites those and
  is what broke things last time. If DataTables Buttons export ever needs touching,
  only the two script tags below (buttons + a live pdfmake CDN) should change.
-->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
    :root{
        --primary:#6C63F5; --primary-dark:#5a52e0; --primary-light:#ede9ff;
        --blue:#4c63f5; --blue-bg:#dbe3fc;
        --green:#2ea862; --green-bg:#d3f3e0;
        --red:#e2554e; --red-bg:#fad6d4;
        --pink:#ea5a94; --pink-bg:#fde8ef;
        --orange:#e8973a; --orange-bg:#fdf0e2;
    }
    body,.box,table,.form-control,.filter-label{ font-family:'Poppins',sans-serif; }

    /* -- top summary cards (pastel, matching statistiquesvisite design) -- */
    .stat-card{
        border:none; border-radius:16px; overflow:hidden;
        box-shadow:0 4px 20px rgba(0,0,0,.06); height:100%;
    }
    .stat-card .stat-card-body{ padding:20px 22px; }
    .stat-card .stat-label{
        font-size:12.5px; font-weight:700; letter-spacing:.4px;
        text-transform:uppercase; opacity:.85; display:block;
    }
    .stat-card .stat-number{ font-size:26px; font-weight:700; display:block; margin-top:2px; }
    .stat-card .progress{ height:3px; margin:10px 0 8px; }
    .stat-card .stat-desc{ font-size:12.5px; opacity:.75; }

    .stat-card.blue{ background:#eaf0fd; }
    .stat-card.blue .stat-label,
    .stat-card.blue .stat-number,
    .stat-card.blue .stat-desc{ color:#4e73df; }
    .stat-card.blue .progress{ background:rgba(78,115,223,.15); }
    .stat-card.blue .progress-bar{ background:#4e73df; }

    .stat-card.green{ background:#e8f8f0; }
    .stat-card.green .stat-label,
    .stat-card.green .stat-number,
    .stat-card.green .stat-desc{ color:#2e9e68; }
    .stat-card.green .progress{ background:rgba(46,158,104,.15); }
    .stat-card.green .progress-bar{ background:#2e9e68; }

    .stat-card.red{ background:#fdecec; }
    .stat-card.red .stat-label,
    .stat-card.red .stat-number,
    .stat-card.red .stat-desc{ color:#e0453f; }
    .stat-card.red .progress{ background:rgba(224,69,63,.15); }
    .stat-card.red .progress-bar{ background:#e0453f; }

    /* -- filter card -- */
    .filter-card{ background:#fff; border-radius:18px; padding:30px 32px 24px; box-shadow:0 4px 16px rgba(108,99,245,.06); border:none; }
    .filter-field{ display:flex; align-items:flex-start; gap:14px; margin-bottom:22px; }
    .filter-icon-box{ width:44px; height:44px; min-width:44px; border-radius:12px; display:flex;
        align-items:center; justify-content:center; margin-top:22px; }
    .filter-icon-box.purple{ background:var(--primary-light); color:var(--primary); }
    .filter-icon-box.blue{ background:#e1edfd; color:#3f8cf0; }
    .filter-icon-box.pink{ background:var(--pink-bg); color:var(--pink); }
    .filter-icon-box.green{ background:var(--green-bg); color:var(--green); }
    .filter-icon-box.orange{ background:var(--orange-bg); color:var(--orange); }
    .filter-field-body{ flex:1; min-width:0; }
    .filter-field-body label,.filter-field .filter-label{ font-weight:600; font-size:13.5px; color:#2b2b45; display:block; margin-bottom:8px; }
    .filter-card .form-control,.filter-card .select2-container .select2-selection,.filter-card input[type="text"]{
        border:1.5px solid #e7e6f7 !important; border-radius:10px !important; height:auto !important;
        min-height:42px !important; padding:8px 14px !important; font-size:14px !important; box-shadow:none !important;
    }
    .filter-card .form-control:focus,.filter-card input[type="text"]:focus{ border-color:var(--primary) !important; outline:none; }
    .filter-card .input-group-addon{ border-radius:10px 0 0 10px !important; border:1.5px solid #e7e6f7 !important;
        border-right:none !important; background:#fafaff; color:var(--primary); }
    .filter-card #reservationtime{ border-radius:0 10px 10px 0 !important; border-left:none !important; cursor:pointer; }
    .btn-search-pill{ background:linear-gradient(135deg,var(--primary),#5479f7); border:none; border-radius:24px;
        color:#fff !important; padding:11px 30px; font-weight:600; font-size:14px; box-shadow:0 6px 16px rgba(108,99,245,.32);
        display:inline-flex; align-items:center; gap:8px; cursor:pointer; }
    .btn-search-pill:hover{ background:linear-gradient(135deg,#5f56ee,#3f66e6); color:#fff; }

    /* -- general boxes -- */
    .box{ border-radius:18px !important; border:none !important; box-shadow:0 4px 16px rgba(108,99,245,.06) !important; background:#fff !important; }
    .box .box-header{ border:none !important; padding:20px 22px 6px; }
    .box .box-title{ font-size:15.5px; font-weight:700; color:#2b2b45; }
    .box .box-body{ padding:16px 22px 22px; }

    /* -- mini per-VM stat tiles (replaces old AdminLTE .info-box) -- */
    .mini-stat{ border-radius:16px; box-shadow:0 3px 10px rgba(108,99,245,.05); display:flex; align-items:center;
        gap:14px; padding:14px 16px; height:100%; }
    .mini-stat .mini-stat-icon{ width:40px; height:40px; min-width:40px; border-radius:12px; display:flex;
        align-items:center; justify-content:center; font-size:16px; }
    .mini-stat .mini-stat-label{ font-size:11px; font-weight:700; color:#8d8da8; text-transform:uppercase; letter-spacing:.3px; display:block; }
    .mini-stat .mini-stat-number{ font-size:19px; font-weight:700; color:#2b2b45; }
    .mini-stat.green{ background:#eafaf1; } .mini-stat.green .mini-stat-icon{ background:var(--green-bg); color:var(--green); }
    .mini-stat.red{ background:#fdeceb; } .mini-stat.red .mini-stat-icon{ background:var(--red-bg); color:var(--red); }
    .mini-stat.blue{ background:#eaf0fd; } .mini-stat.blue .mini-stat-icon{ background:var(--blue-bg); color:var(--blue); }

    /* -- tables -- */
    table.table thead th{ background:#f4f2ff; color:#5b52e0; font-weight:700; font-size:13px; border:none !important; white-space:nowrap; }
    table.table-bordered td,table.table-bordered th{ border-color:#eef0fa !important; }
    table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#fbfbff; }
    .red-row{ background-color:#fdecec !important; }

    .table-toolbar{ display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:14px; }
    .dt-button,.btn-export{ background:#fff !important; color:var(--primary) !important; border:1.5px solid var(--primary) !important;
        border-radius:20px !important; padding:8px 20px !important; font-weight:600 !important; font-size:14px !important;
        display:inline-flex; align-items:center; gap:8px; float:none !important; margin:0 !important; }
    .dt-button:hover,.btn-export:hover{ background:var(--primary) !important; color:#fff !important; }
    .dataTables_filter input{ border:1.5px solid #e7e6f7 !important; border-radius:20px !important; padding:8px 16px 8px 34px !important; font-size:14px; }
    .dataTables_wrapper .dataTables_filter{ float:right; margin-bottom:10px; }
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:10px; color:#b9b9d1; padding:50px 20px; }
    .dt-empty-state svg{ color:var(--primary); opacity:.55; }
    .dt-empty-state span{ font-size:14px; color:#9a9ab5; font-weight:500; }

    .ml-6{ margin-left:6px; }
    .btn-info.btn-sm{ background:var(--primary-light); color:var(--primary); border:none; border-radius:16px; font-weight:600; padding:5px 14px; }
    .btn-info.btn-sm:hover{ background:var(--primary); color:#fff; }

    /* -- self-contained date range picker (no external plugin dependency) -- */
    .lb-range-popup{ position:absolute; z-index:9999; background:#fff; border:1px solid #e7e6f7; border-radius:14px;
        box-shadow:0 10px 34px rgba(108,99,245,.2); padding:16px; font-family:'Poppins',sans-serif; user-select:none; }
    .lb-range-panels{ display:flex; gap:22px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:#eef0fa; }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:#2b2b45; font-size:14.5px; }
    .lb-range-nav{ border:none; background:var(--primary-light); color:var(--primary); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:#ded8ff; }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--primary); text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:#2b2b45; cursor:pointer; }
    .lb-range-day:hover{ background:var(--primary-light); }
    .lb-range-day.other-month{ color:#b9b9d1; opacity:.5; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--primary); }
    .lb-range-day.in-range{ background:var(--primary-light); border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:var(--primary) !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; justify-content:space-between; margin-top:14px; border-top:1px solid #eef0fa; padding-top:10px; }
    .lb-range-clear-btn{ border:none; background:none; color:var(--primary); font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:var(--primary-light); }
    .lb-range-apply-btn{ border:none; background:var(--primary); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:6px 14px; border-radius:16px; }
    .lb-range-apply-btn:hover{ background:var(--primary-dark); }
    .lb-range-input-open{ border-color:var(--primary) !important; box-shadow:0 0 0 3px var(--primary-light) !important; }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="col-xs-12" style="margin-bottom:24px;">

            <div class="row g-3 mb-3">
                <div class="col-md-4 col-xs-4">
                    <div class="stat-card blue">
                        <div class="stat-card-body">
                            <span class="stat-label">Nombre de visites</span>
                            <span class="stat-number"><?php echo "0"; ?></span>
                            <div class="progress"><div class="progress-bar" style="width:100%"></div></div>
                            <span class="stat-desc">dans la période <?php echo "0"; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-4">
                    <div class="stat-card green">
                        <div class="stat-card-body">
                            <span class="stat-label">Nombre de Clients visités</span>
                            <span class="stat-number"><?php echo "0"; ?></span>
                            <div class="progress"><div class="progress-bar" style="width:100%"></div></div>
                            <span class="stat-desc">dans la période <?php echo "0"; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-4">
                    <div class="stat-card red">
                        <div class="stat-card-body">
                            <span class="stat-label">Nombre de Clients non visités</span>
                            <span class="stat-number"><?php echo "0"; ?></span>
                            <div class="progress"><div class="progress-bar" style="width:100%"></div></div>
                            <span class="stat-desc">dans la période <?php echo "0"; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box form-group filter-card">
                <div class="box-body" style="padding:0;">
                    <div class="col-xs-12" style="padding:0;">
                        <form action="<?php echo $this->Html->url("/pots/index") ?>" method="post" id="dateform" autocomplete="off">

                            <div class="filter-field" style="width:100%;">
                                <div class="filter-icon-box purple">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                </div>
                                <div class="filter-field-body">
                                    <label class="filter-label">Choisissez une date</label>
                                    <div class="input-group col-lg-6 col-md-8 col-xs-12" style="padding:0;">
                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                        <input type="text" <?php if ($dateaafficherdansleview != "") echo 'value="' . $dateaafficherdansleview . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6" style="padding:0;">
                                <div class="filter-field">
                                    <div class="filter-icon-box purple">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('activite', array(
                                        "label" => "Choisissez une activité",
                                        "name" => "activite",
                                        'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                                        'class' => 'form-control pull-right',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>

                                <div class="filter-field">
                                    <div class="filter-icon-box purple">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.59 2.59a2 2 0 0 0-2.83 0L2.59 9.76a2 2 0 0 0 0 2.83l8.82 8.82a2 2 0 0 0 2.83 0l7.17-7.17a2 2 0 0 0 0-2.83z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('game_id', array(
                                        "multiple" => "true",
                                        "label" => "Choisissez une gamme",
                                        'class' => 'form-control pull-right choix_multi select2',
                                        'multiple' => 'multiple',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>

                                <div class="filter-field">
                                    <div class="filter-icon-box green">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('secteur_id', array(
                                        "multiple" => "true",
                                        "label" => "La liste des secteurs",
                                        'options' => $secteurs,
                                        'class' => 'form-control pull-right choix_multi select2',
                                        'multiple' => 'multiple',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>

                                <div class="filter-field">
                                    <div class="filter-icon-box pink">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v6a4 4 0 0 0 8 0V2"/><path d="M12 12v3a6 6 0 0 1-6 6 6 6 0 0 1-6-6V9"/><circle cx="18" cy="16" r="3"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('category_id', array(
                                        "multiple" => "true",
                                        "label" => "La liste des spécialité",
                                        'class' => 'form-control pull-right choix_multi select2',
                                        'multiple' => 'multiple',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6" style="padding:0;">
                                <div class="filter-field">
                                    <div class="filter-icon-box blue">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('user', array(
                                        "multiple" => "true",
                                        "label" => "La liste des VM",
                                        "name" => "users",
                                        'options' => $users_listes,
                                        'class' => 'form-control pull-right choix_multi vm select2',
                                        'multiple' => 'multiple',
                                        'value' => $selected_users,
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>

                                <div class="filter-field">
                                    <div class="filter-icon-box pink">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                    </div>
                                    <?php
                                    echo $this->Form->input('ligne', array(
                                        "multiple" => "true",
                                        "label" => "Les lignes",
                                        "name" => "ligne",
                                        'options' => $lignes,
                                        'class' => 'form-control pull-right choix_multi select2',
                                        'multiple' => 'multiple',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>

                                <div class="filter-field">
                                    <div class="filter-icon-box orange">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    </div>
                                    <?php
                                    $typess = array("1" => "Medcin", "2" => "Pharmacie",);
                                    echo $this->Form->input('type', array(
                                        "multiple" => "true",
                                        "label" => "Type de client",
                                        "name" => "type",
                                        'options' => $typess,
                                        'class' => 'form-control pull-right choix_multi select2',
                                        'multiple' => 'multiple',
                                        'div' => 'filter-field-body'
                                    ));
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding:0; margin-top:6px;">
                                <button type="submit" class="btn-search-pill" style="float:right;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($allusers as $k => $user): ?>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Clients de l'utilisateur : <?php echo h($user['name']); ?></h3>
                    </div>
                    <div class="box-body" style="max-height:400px; overflow-y:auto;">
                        <table class="example1 table table-bordered table-striped">
                            <thead>
                                <tr><th>Nom</th><th>Catégorie</th><th>Secteur</th><th>Pot</th><th>Visité</th><th>#</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $table_pot = array();
                                $nb_client_visiter = $nb_client_non_visiter = $nb_visites = 0;
                                foreach ($user['Clients'] as $kk => $client):
                                    if ($client["nb_visite"] == 0)
                                        $nb_client_non_visiter++;
                                    else {
                                        $nb_client_visiter++;
                                        $nb_visites += $client["nb_visite"];
                                    }
                                    $pot = "--";
                                    if (isset($client['pot'])) {
                                        $pot = $client['pot'];
                                        $indice1 = substr($pot, 0, 2);
                                        $indice2 = substr($pot, 1, 2);
                                        if (empty($table_pot)) {
                                            $pots_name = ["AH", "AM", "AL", "BH", "BM", "BL", "CH", "CM", "CL"];
                                            foreach ($pots_name as $v) $table_pot[$v] = ["nombre" => 0, "clients" => []];
                                            $pots_name = ["HH", "HM", "HL", "MH", "MM", "ML", "LH", "LM", "LL"];
                                            foreach ($pots_name as $v) $table_pot[$v] = ["nombre" => 0, "clients" => []];
                                        }
                                        $table_pot[$indice1]["nombre"]++;
                                        $table_pot[$indice2]["nombre"]++;
                                        $last_pot = $client;
                                        $last_pot["Pots"] = $client["Pots"][0];
                                        $table_pot[$indice1]["clients"][] = $last_pot;
                                        $table_pot[$indice2]["clients"][] = $last_pot;
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $this->Html->link($client['nom'] . " " . $client["prenom"], array("controller" => "clients", "action" => "view", $client['id'])); ?></td>
                                        <td><?php echo $categories[$client['category_id']]; ?></td>
                                        <td><?php echo $allsecteurs[$client['secteur_id']]["region"] . " " . $allsecteurs[$client['secteur_id']]["ville"] . " " . $allsecteurs[$client['secteur_id']]["secteur"]; ?></td>
                                        <td><?php echo $pot; ?></td>
                                        <td><?php echo $client["nb_visite"]; ?></td>
                                        <td>
                                            <?php if ($pot != "--") { ?>
                                                <button class="btn btn-info btn-sm" onclick='showPotsModal(<?php echo json_encode($client["id"]); ?>, 
                                                    <?php echo json_encode($client["nom"]); ?>, 
                                                    <?php echo json_encode($client["Pots"], JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS); ?>
                                                )'>
                                                    Voir Pots
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 pl-0">
                    <div class="mini-stat green">
                        <div class="mini-stat-icon"><i class="fa fa-thumbs-up"></i></div>
                        <div>
                            <span class="mini-stat-label">Nbr clients visités</span>
                            <span class="mini-stat-number"><?php echo $nb_client_visiter; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pl-0">
                    <div class="mini-stat red">
                        <div class="mini-stat-icon"><i class="fa fa-thumbs-down"></i></div>
                        <div>
                            <span class="mini-stat-label">Nbr clients non visités</span>
                            <span class="mini-stat-number"><?php echo $nb_client_non_visiter; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pl-0 pr-0">
                    <div class="mini-stat blue">
                        <div class="mini-stat-icon"><i class="fa fa-user-md"></i></div>
                        <div>
                            <span class="mini-stat-label">Nbr total de visites</span>
                            <span class="mini-stat-number"><?php echo $nb_visites; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <?php
                    $indices = [
                        "Indice 1 et 2" => ["AH", "BH", "CH", "AM", "BM", "CM", "AL", "BL", "CL"],
                        "Indice 2 et 3" => ["HH", "HM", "HL", "MH", "MM", "ML", "LH", "LM", "LL"]
                    ];
                    $names = [
                        "Indice 1 et 2" => ["--", "--", "--"],
                        "Indice 2 et 3" => ["Réguliers", "Occasionnels", "Avertis"]
                    ];
                    foreach ($indices as $indice => $pots_name): ?>
                        <div class="box-body" style="max-height:400px; overflow-y:auto; padding:10px;">
                            <div class="box-header" style="margin-bottom:10px;">
                                <h4 class="box-title" style="margin:0;"><?php echo ucfirst($indice) . " de : " . $user['name']; ?></h4>
                            </div>
                            <table class="table table-bordered table-condensed" style="font-size:12px;">
                                <thead>
                                    <tr><?php foreach ($names[$indice] as $k => $name) echo "<th>" . $name . "</th>"; ?></tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($pots_name); $i += 3): ?>
                                        <tr>
                                            <?php for ($j = 0; $j < 3; $j++):
                                                $pot = isset($pots_name[$i + $j]) ? $pots_name[$i + $j] : null;
                                                $nombre = $pot && isset($table_pot[$pot]) ? $table_pot[$pot]["nombre"] : 0;
                                            ?>
                                                <td>
                                                    <?php if ($pot): ?>
                                                        <strong><?php echo $pot; ?></strong>
                                                        <div style="margin-top:5px; color:#666;"><?php echo $nombre; ?></div>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endfor; ?>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="modal fade" id="potsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius:18px; overflow:hidden;">
                    <div class="modal-header" style="background:var(--primary-light); border:none;">
                        <h5 class="modal-title" style="color:#2b2b45; font-weight:700;">Détails des Pots</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body"><p>Chargement...</p></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header"><h3 class="box-title">La liste des visites de tout les VM choisi</h3></div>
            <div class="box-body">
                <div class="table-toolbar">
                    <button type="button" class="btn-export export-excel-trigger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                        Export Excel
                    </button>
                </div>
                <div style="max-height:400px; overflow-y:auto;">
                    <table class="example1 main-table table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>VM</th><th>Code Client</th><th>Nom & Prénom</th><th>Spécialité</th><th>Tandance</th>
                                <th>Secteur</th><th>Ville IMS</th><th>secteur IMS</th><th>Activité</th><th>POT</th>
                                <th>POT V2</th><th>POT V2(Gamme)</th><th>Nb Visite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $table_pot = array();
                            $nb_client_visiter = $nb_client_non_visiter = $nb_visites = 0;
                            foreach ($allusers as $k => $user):
                                foreach ($user['Clients'] as $kk => $client):
                                    $class_status = "";
                                    if ($client["nb_visite"] == 0) {
                                        $nb_client_non_visiter++;
                                        $class_status = "red-row";
                                    } else {
                                        $nb_client_visiter++;
                                        $nb_visites += $client["nb_visite"];
                                        $class_status = "";
                                    }
                                    $pot = "--"; $gamme = "--";
                                    if (isset($client['pot'])) $pot = $client['pot'];
                                    if (isset($client['gamme'])) $gamme = $client['gamme'];
                            ?>
                                    <tr class="<?php echo $class_status; ?>">
                                        <td><?php echo $user["name"]; ?></td>
                                        <td><?php echo $client['id']; ?></td>
                                        <td><?php echo $this->Html->link($client['nom'] . " " . $client["prenom"], array("controller" => "clients", "action" => "view", $client['id'])); ?></td>
                                        <td><?php echo $categories[$client['category_id']]; ?></td>
                                        <td><?php if ($client['category1_id'] != null) echo $categories[$client['category1_id']]; ?></td>
                                        <td><?php echo $allsecteurs[$client['secteur_id']]["region"] . " " . $allsecteurs[$client['secteur_id']]["ville"] . " " . $allsecteurs[$client['secteur_id']]["secteur"]; ?></td>
                                        <td><?php echo mb_convert_encoding($allsecteurs[$client['secteur_id']]["ville_ims"], "UTF-8", "ISO-8859-1"); ?></td>
                                        <td><?php echo $allsecteurs[$client['secteur_id']]["secteur_ims"]; ?></td>
                                        <td><?php echo $client['activite']; ?></td>
                                        <td><?php echo $client['potentialite']; ?></td>
                                        <td><?php echo $pot; ?></td>
                                        <td><?php echo $gamme; ?></td>
                                        <td><?php echo $client["nb_visite"]; ?></td>
                                    </tr>
                            <?php endforeach;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header" style="background:var(--primary-light); border:none;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirmDeleteLabel" style="color:#2b2b45; font-weight:700;">Confirmation</h4>
            </div>
            <div class="modal-body">Vous êtes sûr que tu veux supprimer ce potentielité ?<br>Si oui, cliquez sur Supprimer.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" id="modalDeleteBtn" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showPotsModal(clientId, clientName, potsData) {
        try {
            var modalBody = '';
            if (potsData && potsData.length > 0) {
                modalBody += '<table class="exemple1 table table-bordered">';
                modalBody += '<thead><tr><th>Pot</th><th>Patient</th><th>Indication</th><th>Prescription</th><th>Gamme</th><th>Date</th><th>#</th></tr></thead><tbody>';
                potsData.forEach(function (pot) {
                    modalBody += '<tr>' +
                        '<td>' + (pot.pot || 'N/A') + '</td>' +
                        '<td>' + (pot.pot_patient || 'N/A') + '</td>' +
                        '<td>' + (pot.pot_indication || 'N/A') + '</td>' +
                        '<td>' + (pot.pot_prescription || 'N/A') + '</td>' +
                        '<td>' + (pot.gamme || 'N/A') + '</td>' +
                        '<td>' + (pot.created || 'N/A') + '</td>' +
                        '<td><a class="btn btn-warning" href="<?php echo $this->Html->url("/pots/edit"); ?>/' + pot.id + '">Edit</a>' +
                        '<button class="btn btn-danger ml-6" onclick=removePot("<?php echo $this->Html->url("/pots/delete"); ?>/' + pot.id + '")>Supprimer</button></td>' +
                        '</tr>';
                });
                modalBody += '</tbody></table>';
            } else {
                modalBody = '<p>Aucun pot disponible pour ce client.</p>';
            }
            var modal = document.getElementById('potsModal');
            if (modal) {
                var titleElement = modal.querySelector('.modal-title');
                var bodyElement = modal.querySelector('.modal-body');
                if (titleElement) titleElement.textContent = 'Détails des Pots pour ' + clientName;
                if (bodyElement) bodyElement.innerHTML = modalBody;
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $(modal).modal('show');
                } else {
                    console.error('jQuery ou Bootstrap Modal non chargé');
                }
            }
        } catch (error) {
            console.error("Erreur dans showPotsModal:", error);
        }
    }

    function removePot(deleteUrl) {
        var modalDeleteBtn = document.getElementById('modalDeleteBtn');
        if (modalDeleteBtn) {
            modalDeleteBtn.onclick = null;
            modalDeleteBtn.onclick = function () {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                var csrfToken = document.querySelector('meta[name="csrfToken"]');
                if (csrfToken) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '_Token[key]';
                    input.value = csrfToken.content;
                    form.appendChild(input);
                }
                document.body.appendChild(form);
                form.submit();
            };
        }
        var confirmModal = document.getElementById('confirmDeleteModal');
        if (confirmModal) {
            if (typeof $ !== 'undefined' && $.fn.modal) {
                $(confirmModal).modal('show');
            } else {
                console.error('jQuery ou Bootstrap Modal non chargé');
            }
        }
    }
</script>

<script>
    var emptyStateHtml = '<div class="dt-empty-state">' +
        '<svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">' +
        '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>' +
        '<path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>' +
        '<span>Aucune donnée disponible dans le tableau</span></div>';

    /*
      IMPORTANT: select2 init is deliberately its OWN $(function(){...}) block, run
      independently from the DataTable init below. Previously both lived in one
      callback — if any .example1 table threw while initializing, select2() never
      ran, which is why "Choisissez une gamme" / "La liste des secteurs" showed up
      as raw expanded multi-selects instead of collapsed dropdowns.
    */
    $(function () {
        $('.choix_multi').select2({ placeholder: 'Choisissez...', allowClear: true, width: '100%' });
    });

    $(function () {
        $('.example1').each(function () {
            try {
                var isMain = $(this).hasClass('main-table');
                $(this).DataTable({
                    paging: false,
                    lengthChange: false,
                    searching: true,
                    ordering: false,
                    info: false,
                    autoWidth: true,
                    bSort: false,
                    iDisplayLength: 250,
                    aaSorting: [],
                    dom: isMain ? 'frtip' : 'Bfrtip',
                    buttons: ['excel'],
                    language: { emptyTable: emptyStateHtml, zeroRecords: emptyStateHtml, search: '', searchPlaceholder: 'Search...' }
                });
            } catch (e) {
                console.error('DataTable init failed for one .example1 table:', e);
            }
        });

        $('.export-excel-trigger').on('click', function () {
            try {
                $('.main-table').DataTable().button('.buttons-excel').trigger();
            } catch (e) {
                console.error('Excel export trigger failed:', e);
            }
        });
    });

    /* ---------- Themed date range picker (self-contained, no external library) ---------- */
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
