<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
?>

<style>
    :root{
        --accent:#9b90e0;
        --accent-dark:#7e71cf;
        --accent-light:#f4f2fc;
        --accent-pale:#ece7fb;
        --mint:#5ad1a8;
        --mint-dark:#2f9c78;
        --mint-light:#e6faf3;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.06);
    }

    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px;
    }
    .box .box-header.with-border{ border-bottom:none; padding:22px 24px 8px 24px; }
    .box .box-body{ padding:16px 24px 24px 24px; }

    .section-header{ display:flex; align-items:center; gap:14px; }
    .section-icon{
        flex:0 0 auto; width:46px; height:46px; border-radius:var(--radius-sm);
        background:var(--accent-light); color:var(--accent-dark);
        display:flex; align-items:center; justify-content:center; font-size:19px;
    }
    .box-title-main{ margin:0; font-size:19px; font-weight:800; color:var(--text-dark); }
    .box-subtitle{ margin:2px 0 0 0; font-size:13px; color:var(--text-muted); }

    /* ---------- Filter form ---------- */
    .filter-inline{
        margin-bottom: 25px !important; background: var(--accent-light) !important;
        padding: 18px 20px !important; border-radius: var(--radius-md) !important;
        border: 1px solid var(--accent-pale) !important; display:flex; align-items:flex-end; gap:20px; flex-wrap:wrap;
    }
    .filter-inline .form-group{ display:flex; flex-direction:column; margin:0 !important; position:relative; }
    .filter-inline label{ font-weight:700; font-size:13px; color:var(--text-dark); margin-bottom:6px !important; }

    /* ---------- Custom date pickers (vanilla JS, no external dependency) ---------- */
    .filter-inline .date-field-wrap{ position:relative; }
    .filter-inline input.lb-date-input{
        border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; padding:9px 38px 9px 12px !important; font-size:14px; min-height:42px;
        box-shadow:none !important; color:var(--text-dark); cursor:pointer; width:160px;
    }
    .filter-inline input.lb-date-input:focus{ border-color:var(--accent) !important; outline:none; }
    .filter-inline input.lb-date-input.lb-date-open{ border-color:var(--accent) !important; box-shadow:0 0 0 3px var(--accent-pale) !important; }
    .date-field-wrap .date-field-icon{
        position:absolute; right:12px; bottom:12px; color:var(--accent-dark); pointer-events:none; font-size:14px;
    }

    .lb-cal-popup{
        position:absolute; z-index:9999; background:#fff; border:1px solid var(--border-color);
        border-radius:var(--radius-md); box-shadow:0 10px 34px rgba(108,92,231,0.2);
        padding:14px; width:270px; font-family:inherit; -webkit-user-select:none; user-select:none;
    }
    .lb-cal-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-cal-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; text-transform:capitalize; }
    .lb-cal-nav{
        border:none; background:var(--accent-light); color:var(--accent-dark); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center;
        line-height:1; padding:0;
    }
    .lb-cal-nav:hover{ background:var(--accent-pale); }
    .lb-cal-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-cal-weekdays span{ font-size:11px; font-weight:700; color:var(--accent-dark); text-transform:uppercase; }
    .lb-cal-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-cal-day{
        border:none; background:transparent; padding:8px 0; border-radius:var(--radius-sm); font-size:13px;
        color:var(--text-dark); cursor:pointer;
    }
    .lb-cal-day:hover{ background:var(--accent-pale); }
    .lb-cal-day.other-month{ color:var(--text-muted); opacity:.5; }
    .lb-cal-day.today{ box-shadow:inset 0 0 0 1px var(--mint-dark); }
    .lb-cal-day.selected{ background:var(--accent) !important; color:#fff !important; font-weight:700; }
    .lb-cal-footer{ display:flex; justify-content:space-between; margin-top:10px; border-top:1px solid var(--border-color); padding-top:10px; }
    .lb-cal-today-btn, .lb-cal-clear-btn{
        border:none; background:none; color:var(--accent-dark); font-size:12.5px; font-weight:600; cursor:pointer;
        padding:5px 9px; border-radius:var(--radius-sm);
    }
    .lb-cal-today-btn:hover, .lb-cal-clear-btn:hover{ background:var(--accent-light); }

    .filter-inline .btn-primary{
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        padding:10px 20px !important; font-weight:600; font-size:14px; box-shadow:none !important;
        margin-left:0 !important;
    }
    .filter-inline .btn-primary:hover{ background:var(--accent-dark) !important; }

    /* ---------- table-dsm (stats + details) ---------- */
    .table-responsive{
        background-color:#fff !important; padding:0 !important;
        border:1px solid var(--border-color) !important; border-radius:var(--radius-md) !important;
        overflow:hidden;
    }

    .table-dsm{
        text-align:center; vertical-align:middle;
        border-collapse:collapse; border-spacing:0; width:100%; background-color:#fff;
    }
    .table-dsm th, .table-dsm td{
        padding:12px; vertical-align:middle !important;
        border:1px solid var(--border-color); border-radius:0;
    }
    .table-dsm thead tr:first-child th:first-child{ border-top-left-radius:var(--radius-sm); }
    .table-dsm thead tr:first-child th:last-child{ border-top-right-radius:var(--radius-sm); }

    .bg-dsm-head{ background-color:var(--mint-light) !important; color:var(--mint-dark) !important; font-weight:700; font-size:15px; border-color:#cdeee1 !important; }
    .bg-type-head{ background-color:var(--accent-pale) !important; color:var(--accent-dark) !important; font-weight:700; font-size:15px; border-color:#ddd6f7 !important; }
    .bg-type-head i{ margin-right:6px; opacity:.85; }

    .bg-name{ background-color:#eef0fb !important; color:var(--text-dark) !important; font-weight:700; font-size:16px; text-shadow:none; }
    .bg-row-light{ background-color:var(--accent-light) !important; font-weight:700; color:var(--text-dark); text-align:center; }
    .bg-row-dark{ background-color:#e3e2f2 !important; font-weight:700; color:var(--text-dark); text-align:center; }
    .bg-val-light{ background-color:#fafafd !important; font-weight:700; font-size:14.5px; color:#565469; }
    .bg-val-dark{ background-color:#f2f1f8 !important; font-weight:700; font-size:14.5px; color:#565469; }

    .clickable-cell{ cursor:pointer; color:var(--accent-dark); text-decoration:underline; }
    .clickable-cell:hover{ background-color:var(--accent-pale) !important; color:var(--text-dark); }

    /* ---------- Toolbar (export / search) ---------- */
    .dt-buttons{ margin-bottom:14px; }
    .dt-button{
        width:auto !important; float:none !important; margin:0 !important;
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:13.5px !important; font-weight:600; line-height:1 !important;
        padding:9px 16px !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; color:var(--accent-dark) !important;
        border:1px solid var(--border-color) !important; box-shadow:none !important;
    }
    .dt-button:hover{ background:var(--accent-light) !important; border-color:var(--accent) !important; }
    .dataTables_filter{ margin-bottom:14px !important; }
    .dataTables_filter label{ display:flex !important; align-items:center; }
    .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px 9px 34px !important; min-width:220px; font-size:13.5px !important;
        background:#fafafa url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 12px center;
        background-size:14px 14px; margin-left:8px;
    }
    .dataTables_filter input:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }

    /* ---------- Details table (real DataTable) ---------- */
    #detailsVisitesTable.table-dsm th{ font-size:13px !important; padding:11px 10px !important; white-space:nowrap; }
    #detailsVisitesTable.table-dsm td{ font-size:13px; }

    /* ---------- Empty state ---------- */
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:8px; color:var(--text-muted); padding:20px 0; }
    .dt-empty-state .dt-empty-icon{
        width:60px; height:60px; border-radius:50%; background:var(--accent-light); color:var(--accent-dark);
        display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:4px;
    }
    .dt-empty-state .dt-empty-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .dt-empty-state .dt-empty-sub{ font-size:12.5px; }

    /* ---------- Pagination ---------- */
    .dataTables_wrapper .dataTables_info{ color:var(--text-muted) !important; font-size:13px !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 13px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ color:var(--text-muted) !important; opacity:.5; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled){
        background:var(--accent-light) !important; color:var(--accent-dark) !important; border-color:var(--accent) !important;
    }

    /* ---------- Modals ---------- */
    .modal-content{ border-radius:var(--radius-md); overflow:hidden; border:none; }
    .modal-header.bg-primary{ background:var(--accent) !important; border:none; }
    .modal-header.bg-success{ background:var(--mint-dark) !important; border:none; }
    .modal-header .close{ color:#fff; opacity:.9; }
    .modal-body table.table thead th{ background:var(--accent-light); color:var(--text-dark); font-size:12.5px; text-transform:uppercase; letter-spacing:.02em; border:none; }
    .modal-body table.table td{ vertical-align:middle; font-size:13.5px; }
    .modal-footer .btn-default{ border-radius:var(--radius-sm); }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-line-chart"></i></span>
                    <div>
                        <h3 class="box-title-main">Tableau de bord Superviseurs</h3>
                        <p class="box-subtitle">Visites Doubles</p>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <!-- Filtre par dates -->
                <form action="<?php echo $this->Html->url(array('controller' => 'asm', 'action' => 'asm_visites_double')); ?>" method="post" class="form-inline filter-inline">
                    <div class="form-group">
                        <label for="date_debut">Du :</label>
                        <div class="date-field-wrap">
                            <input type="text" name="data[Filtre][date_debut]" id="date_debut" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_debut); ?>">
                            <i class="fa fa-calendar date-field-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Au :</label>
                        <div class="date-field-wrap">
                            <input type="text" name="data[Filtre][date_fin]" id="date_fin" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_fin); ?>">
                            <i class="fa fa-calendar date-field-icon"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtrer</button>
                </form>

                <!-- Tableau Principal -->
                <div class="table-responsive">
                    <table class="table-dsm">
                        <thead>
                            <tr>
                                <th class="bg-dsm-head"><i class="fa fa-home"></i>DSM</th>
                                <th class="bg-type-head"><i class="fa fa-clipboard"></i>Type de visites</th>
                                <th class="bg-type-head">S1</th>
                                <th class="bg-type-head">S2</th>
                                <th class="bg-type-head">S3</th>
                                <th class="bg-type-head">S4</th>
                                <th class="bg-type-head">S5</th>
                                <th class="bg-type-head">Total</th>
                                <th class="bg-type-head">% de realisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats as $super_id => $data): ?>
                                <tr>
                                    <td rowspan="2" class="bg-name"><?php echo h($data['nom']); ?></td>

                                    <td class="bg-row-light">Visites Solo (Obj : <?php echo $objectif_solo; ?>)</td>

                                    <!-- Visites Solo -->
                                    <?php foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $s): ?>
                                        <td class="bg-val-light <?php echo ($data['solo'][$s . '_count'] > 0) ? 'clickable-cell' : ''; ?>"
                                            <?php if ($data['solo'][$s . '_count'] > 0): ?>
                                            onclick='openDatesModal("<?php echo addslashes($data['nom']); ?>", "solo", "<?php echo $s; ?>", <?php echo json_encode($data['solo'][$s], JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'
                                            <?php endif; ?>>
                                            <?php echo $data['solo'][$s . '_count']; ?>
                                        </td>
                                    <?php endforeach; ?>

                                    <td class="bg-val-light"><?php echo $data['solo']['total_jours']; ?></td>
                                    <td class="bg-val-light"><?php echo str_replace('.', ',', $data['solo']['realisation']); ?>%</td>
                                </tr>
                                <tr>
                                    <td class="bg-row-dark">Visites Double (Obj : <?php echo $objectif_double; ?>)</td>

                                    <!-- Visites Double -->
                                    <?php foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $s): ?>
                                        <td class="bg-val-dark <?php echo ($data['double'][$s . '_count'] > 0) ? 'clickable-cell' : ''; ?>"
                                            <?php if ($data['double'][$s . '_count'] > 0): ?>
                                            onclick='openDatesModal("<?php echo addslashes($data['nom']); ?>", "double", "<?php echo $s; ?>", <?php echo json_encode($data['double'][$s], JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'
                                            <?php endif; ?>>
                                            <?php echo $data['double'][$s . '_count']; ?>
                                        </td>
                                    <?php endforeach; ?>

                                    <td class="bg-val-dark"><?php echo $data['double']['total_jours']; ?></td>
                                    <td class="bg-val-dark"><?php echo str_replace('.', ',', $data['double']['realisation']); ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <div>
                        <h3 class="box-title-main">Détails des Visites</h3>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table-dsm" id="detailsVisitesTable">
                        <thead>
                            <tr>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-calendar"></i>DATE</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-map-marker"></i>Distance Client</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-map-marker"></i>Distance Double</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-home"></i>DSM</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-user"></i>VMP</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-hashtag"></i>Code</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-id-badge"></i>Nom &amp; Prénom</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-clipboard"></i>Type de visite</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-briefcase"></i>Type client</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-star"></i>Spécialité</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-line-chart"></i>Tendance</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-map"></i>Secteur</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-bullseye"></i>Pot</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-bullseye"></i>Pot V2</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-cube"></i>POT V2 (Gamme)</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-eye"></i>Nb Visite</th>
                                <th class="bg-type-head" style="padding: 8px;"><i class="fa fa-map-pin"></i>Localisé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row_index = 0;
                            foreach ($stats as $super_id => $data):
                                foreach (['solo', 'double'] as $type):
                                    foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $semaine):
                                        if (!empty($data[$type][$semaine]) && is_array($data[$type][$semaine])):
                                            foreach ($data[$type][$semaine] as $date_key => $visites_array):
                                                if (is_array($visites_array)):
                                                    foreach ($visites_array as $v):
                                                        $row_index++;
                                                        $bg_class = ($row_index % 2 == 0) ? 'bg-val-dark' : 'bg-val-light';

                                                        $dsm_name = h($data['nom']);
                                                        $vmp_name = ($type === 'double' && !empty($v['User']['name'])) ? h($v['User']['name']) : '-';
                                                        $date_v = !empty($v['Visite']['date']) ? date('d/m/Y', strtotime($v['Visite']['date'])) : '-';

                                                        $dist_client_html = '-';
                                                        if (isset($v['distance']) && $v['distance'] !== null) {
                                                            $dist = $v['distance'];
                                                            $distance_text = $dist . ' m';
                                                            if ($dist > 1000) {
                                                                $dist_client_html = '<span class="label label-danger" style="font-size:12px;">' . $distance_text . '</span>';
                                                            } elseif ($dist >= 500 && $dist <= 1000) {
                                                                $dist_client_html = '<span class="label label-warning" style="font-size:12px;">' . $distance_text . '</span>';
                                                            } else {
                                                                $dist_client_html = '<span class="label label-success" style="font-size:12px;">' . $distance_text . '</span>';
                                                            }
                                                        }

                                                        $dist_double_html = '-';
                                                        if (isset($v['distance_double']) && $v['distance_double'] !== null) {
                                                            $dist = $v['distance_double'];
                                                            $distance_text = $dist . ' m';
                                                            if ($dist > 1000) {
                                                                $dist_double_html = '<span class="label label-danger" style="font-size:12px;">' . $distance_text . '</span>';
                                                            } elseif ($dist >= 500 && $dist <= 1000) {
                                                                $dist_double_html = '<span class="label label-warning" style="font-size:12px;">' . $distance_text . '</span>';
                                                            } else {
                                                                $dist_double_html = '<span class="label label-success" style="font-size:12px;">' . $distance_text . '</span>';
                                                            }
                                                        }

                                                        $code_disp = !empty($v['Client']['id']) ? h($v['Client']['id']) : '-';
                                                        $nom_prenom = trim((!empty($v['Client']['nom']) ? $v['Client']['nom'] : '') . ' ' . (!empty($v['Client']['prenom']) ? $v['Client']['prenom'] : ''));
                                                        $type_visite = ($type === 'double') ? 'En double' : 'Solo';
                                                        $type_client = !empty($v['Type']['name']) ? h($v['Type']['name']) : '-';
                                                        $specialite = !empty($v['Category']['name']) ? h($v['Category']['name']) : '-';
                                                        $tendance = !empty($v['Tendance']['name']) ? h($v['Tendance']['name']) : '-';
                                                        $secteur = trim((!empty($v['Secteur']['region']) ? $v['Secteur']['region'] : '') . ' ' . (!empty($v['Secteur']['ville']) ? $v['Secteur']['ville'] : '') . ' ' . (!empty($v['Secteur']['secteur']) ? $v['Secteur']['secteur'] : ''));

                                                        $pot = !empty($v['Client']['potentialite']) ? h($v['Client']['potentialite']) : '-';
                                                        $pot_v2 = !empty($potv2[$v['Client']['id']]) ? h($potv2[$v['Client']['id']]['pot']) : '-';
                                                        $pot_v2_gamme = !empty($potv2[$v['Client']['id']]) ? h($potv2[$v['Client']['id']]['gamme']) : '-';
                                                        $nb_visite = !empty($v['Client']['nb_visite']) ? h($v['Client']['nb_visite']) : '1';
                                                        $localise = (!empty($v['Visite']['latitude']) && !empty($v['Visite']['longitude'])) ? 'Oui' : 'Non';
                            ?>
                                                        <tr>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $date_v; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $dist_client_html; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $dist_double_html; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $dsm_name; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $vmp_name; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $code_disp; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $nom_prenom; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $type_visite; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $type_client; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $specialite; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $tendance; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $secteur; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $pot; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $pot_v2; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $pot_v2_gamme; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $nb_visite; ?></td>
                                                            <td class="<?php echo $bg_class; ?>"><?php echo $localise; ?></td>
                                                        </tr>
                            <?php
                                                    endforeach;
                                                endif;
                                            endforeach;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Premier Modal: Liste des dates travaillées -->
<div class="modal fade" id="datesModal" tabindex="-1" role="dialog" aria-labelledby="datesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="datesModalLabel">Jours travaillés</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-hover" id="datesTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th style="text-align:center;">Nombre de visites</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Deuxième Modal: Détails des visites pour un jour donné -->
<div class="modal fade" id="visitesModal" tabindex="-1" role="dialog" aria-labelledby="visitesModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff; opacity:1;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="visitesModalLabel" style="color:#fff;">Détails des visites</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="visitesTable">
                        <thead>
                            <tr>
                                <th>VMP (Accompagné)</th>
                                <th>Client</th>
                                <th>Potentialité</th>
                                <th>Spécialité</th>
                                <th>Localisation</th>
                                <th>Date & Heure</th>
                                <th>Distance (<small>Client vs Visite</small>)</th>
                                <th>Distance (<small>Double vs Visite</small>)</th>
                                <th>Temps Val. (min)</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="$('#visitesModal').modal('hide'); $('body').addClass('modal-open');">Retour</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<script>
    var globalVisitesData = {};
    var baseUrl = '<?php echo $this->Html->url(array("controller" => "clients", "action" => "view")); ?>/';

    function openDatesModal(nom, type, semaine, datesData) {
        var tLabel = type === 'solo' ? 'Solo' : 'Double';
        $('#datesModalLabel').text('Jours travaillés - ' + nom + ' (' + tLabel + ') - ' + semaine);

        var tbody = $('#datesTable tbody');
        tbody.empty();

        $.each(datesData, function(dateStr, visitesArray) {
            var nbVisites = visitesArray.length;
            var key = encodeURIComponent(nom + '_' + type + '_' + semaine + '_' + dateStr);
            globalVisitesData[key] = visitesArray;

            var tr = $('<tr>');
            tr.append($('<td>').text(dateStr).css('vertical-align', 'middle'));

            // Le nombre de visite est cliquable comme demandÃ©
            var valBtn = $('<button>').addClass('btn btn-sm btn-info').text(nbVisites + ' visite(s)')
                .attr('onclick', "openVisitesModal('" + key + "', '" + dateStr + "')");

            tr.append($('<td>').css('text-align', 'center').append(valBtn));

            var actBtn = $('<button>').addClass('btn btn-sm btn-primary').html('<i class="fa fa-eye"></i> Détails')
                .attr('onclick', "openVisitesModal('" + key + "', '" + dateStr + "')");
            tr.append($('<td>').css('text-align', 'center').append(actBtn));

            tbody.append(tr);
        });

        $('#datesModal').modal('show');
    }

    function openVisitesModal(dataKey, dateStr) {
        var visitesArray = globalVisitesData[dataKey];
        if (!visitesArray) return;

        $('#visitesModalLabel').text('Détails des visites pour le ' + dateStr);
        var tbody = $('#visitesTable tbody');
        tbody.empty();

        $.each(visitesArray, function(index, v) {
            var tr = $('<tr>');
            tr.append($('<td>').text(v.User.name));

            var clientAnchor = $('<a>')
                .attr('href', baseUrl + v.Client.id)
                .attr('target', '_blank')
                .text(v.Client.nom + ' ' + v.Client.prenom);
            tr.append($('<td>').append(clientAnchor));

            tr.append($('<td>').text(v.Client.potentialite || '-'));

            tr.append($('<td>').text(v.Category.name));

            var loc = (v.Secteur.region || '') + ' - ' + (v.Secteur.ville || '');
            tr.append($('<td>').text(loc));

            tr.append($('<td>').text(v.Visite.date));

            var distClientCell = $('<td>');
            if (v.distance !== null && v.distance !== undefined) {
                var distanceText = v.distance + ' m';
                if (v.distance > 1000) {
                    distClientCell.html('<span class="label label-danger" style="font-size:12px;">' + distanceText + '</span>');
                } else if (v.distance >= 500 && v.distance <= 1000) {
                    distClientCell.html('<span class="label label-warning" style="font-size:12px;">' + distanceText + '</span>');
                } else {
                    distClientCell.html('<span class="label label-success" style="font-size:12px;">' + distanceText + '</span>');
                }
            } else {
                distClientCell.text('-');
            }
            tr.append(distClientCell);

            var distDoubleCell = $('<td>');
            if (v.distance_double !== null && v.distance_double !== undefined) {
                var distanceText = v.distance_double + ' m';
                if (v.distance_double > 1000) {
                    tr.css('background-color', '#ffe6e6');
                    distDoubleCell.html('<span class="label label-danger" style="font-size:12px;">' + distanceText + '</span>');
                } else if (v.distance_double >= 500 && v.distance_double <= 1000) {
                    tr.css('background-color', '#fff3cd');
                    distDoubleCell.html('<span class="label label-warning" style="font-size:12px;">' + distanceText + '</span>');
                } else {
                    tr.css('background-color', '#e6ffe6');
                    distDoubleCell.html('<span class="label label-success" style="font-size:12px;">' + distanceText + '</span>');
                }
            } else {
                distDoubleCell.text('-');
            }
            tr.append(distDoubleCell);

            var tempsValCell = $('<td>');
            if (v.temps_validation_min !== null && v.temps_validation_min !== undefined) {
                tempsValCell.text(v.temps_validation_min + ' min');
            } else {
                tempsValCell.text('-');
            }
            tr.append(tempsValCell);

            tbody.append(tr);
        });

        $('#visitesModal').modal('show');
    }

    $(document).ready(function() {
        if ($('#detailsVisitesTable').length > 0) {
            $('#detailsVisitesTable').DataTable({
                "language": {
                    "search": "",
                    "searchPlaceholder": "Rechercher...",
                    "lengthMenu": "Afficher _MENU_ éléments",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtré depuis _MAX_ éléments au total)",
                    "zeroRecords": "Aucune visite ne correspond à vos critères de recherche.",
                    "emptyTable": '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-inbox"></i></span><div class="dt-empty-title">Aucune donnée disponible dans le tableau</div><div class="dt-empty-sub">Aucune visite ne correspond à vos critères de recherche.</div></div>',
                    "paginate": {
                        "previous": "Précédent",
                        "next": "Suivant"
                    }
                },
                "pageLength": 10,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Exporter en Excel',
                        className: 'btn btn-success btn-sm',
                        title: 'Détails_Visites'
                    }
                ]
            });
        }
    });

    // ---------- Themed date pickers (self-contained, no external library) ----------
    // Built from scratch so it never depends on a CDN being reachable.
    // Kept in its own ready block, independent from the DataTable init above,
    // so an unrelated error there can never prevent the calendars from initializing.
    (function() {
        var MONTH_NAMES = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        var WEEKDAYS = ['Lu','Ma','Me','Je','Ve','Sa','Di'];

        function pad2(n){ return (n < 10 ? '0' : '') + n; }

        function parseISO(val) {
            if (!val) return null;
            var parts = val.split('-');
            if (parts.length !== 3) return null;
            var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
            return isNaN(d.getTime()) ? null : d;
        }

        function formatISO(d) {
            return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
        }

        function sameDay(a, b) {
            return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
        }

        function LBCalendar(input) {
            this.input = input;
            this.popup = null;
            this.selected = parseISO(input.value);
            this.viewDate = this.selected ? new Date(this.selected) : new Date();
            this._outsideHandler = null;
            this._reflowHandler = null;
            this.bind();
        }

        LBCalendar.instances = [];

        LBCalendar.closeAll = function(except) {
            LBCalendar.instances.forEach(function(inst) {
                if (inst !== except) inst.close();
            });
        };

        LBCalendar.prototype.bind = function() {
            var self = this;
            this.input.setAttribute('readonly', 'readonly');
            this.input.addEventListener('click', function(e) {
                e.stopPropagation();
                LBCalendar.closeAll(self);
                if (self.popup) { self.close(); } else { self.open(); }
            });
        };

        LBCalendar.prototype.open = function() {
            var self = this;
            this.popup = document.createElement('div');
            this.popup.className = 'lb-cal-popup';
            document.body.appendChild(this.popup);
            this.input.classList.add('lb-date-open');
            this.position();
            this.render();

            this._outsideHandler = function(e) {
                if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) {
                    self.close();
                }
            };
            this._reflowHandler = function() { self.position(); };

            setTimeout(function() {
                document.addEventListener('click', self._outsideHandler);
                window.addEventListener('resize', self._reflowHandler);
                window.addEventListener('scroll', self._reflowHandler, true);
            }, 0);
        };

        LBCalendar.prototype.position = function() {
            if (!this.popup) return;
            var rect = this.input.getBoundingClientRect();
            this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
            this.popup.style.left = (window.scrollX + rect.left) + 'px';
        };

        LBCalendar.prototype.close = function() {
            if (this.popup) {
                this.popup.parentNode.removeChild(this.popup);
                this.popup = null;
            }
            this.input.classList.remove('lb-date-open');
            if (this._outsideHandler) {
                document.removeEventListener('click', this._outsideHandler);
                this._outsideHandler = null;
            }
            if (this._reflowHandler) {
                window.removeEventListener('resize', this._reflowHandler);
                window.removeEventListener('scroll', this._reflowHandler, true);
                this._reflowHandler = null;
            }
        };

        LBCalendar.prototype.render = function() {
            var self = this;
            var year = this.viewDate.getFullYear();
            var month = this.viewDate.getMonth();
            var today = new Date();
            today.setHours(0, 0, 0, 0);

            var html = '';
            html += '<div class="lb-cal-header">';
            html += '<button type="button" class="lb-cal-nav" data-nav="prev">&#8249;</button>';
            html += '<span class="lb-cal-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
            html += '<button type="button" class="lb-cal-nav" data-nav="next">&#8250;</button>';
            html += '</div>';
            html += '<div class="lb-cal-weekdays">';
            WEEKDAYS.forEach(function(w) { html += '<span>' + w + '</span>'; });
            html += '</div>';
            html += '<div class="lb-cal-grid">';

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

                var classes = ['lb-cal-day'];
                if (otherMonth) classes.push('other-month');
                if (sameDay(cellDate, self.selected)) classes.push('selected');
                if (sameDay(cellDate, today)) classes.push('today');

                html += '<button type="button" class="' + classes.join(' ') + '" data-date="' + formatISO(cellDate) + '">' + dayNum + '</button>';
            }

            html += '</div>';
            html += '<div class="lb-cal-footer">';
            html += '<button type="button" class="lb-cal-today-btn" data-action="today">Aujourd\'hui</button>';
            html += '<button type="button" class="lb-cal-clear-btn" data-action="clear">Effacer</button>';
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

            var dayBtns = this.popup.querySelectorAll('.lb-cal-day');
            for (var d = 0; d < dayBtns.length; d++) {
                dayBtns[d].addEventListener('click', function(e) {
                    e.stopPropagation();
                    var val = this.getAttribute('data-date');
                    self.selected = parseISO(val);
                    self.input.value = val;
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }

            var todayBtn = this.popup.querySelector('[data-action="today"]');
            if (todayBtn) {
                todayBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var t = new Date();
                    self.selected = t;
                    self.viewDate = new Date(t);
                    self.input.value = formatISO(t);
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }

            var clearBtn = this.popup.querySelector('[data-action="clear"]');
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    self.selected = null;
                    self.input.value = '';
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            ['date_debut', 'date_fin'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        });

        // In case this script runs after DOMContentLoaded already fired (e.g. deferred include)
        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            ['date_debut', 'date_fin'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el && !LBCalendar.instances.some(function(inst){ return inst.input === el; })) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        }
    })();
</script>
