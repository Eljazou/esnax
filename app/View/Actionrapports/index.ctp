<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<style>
    :root{
        --accent:#6c5ce7;
        --accent-grad-start:#8f7cf6;
        --accent-soft:#F3F1FF;
        --accent-text:#6c5ce7;
        --text-dark:#1a1d36;
        --text-muted:#9a9aab;
        --border-soft:#F0EDFF;
        --page-bg:#F4F3FB;
        --amber:#F0784A;
        --amber-soft:#FFF1E8;
        --green:#2FBE73;
        --green-soft:#E6F7EE;
        --blue:#3B9FE0;
        --blue-soft:#EAF6FF;
        --yellow:#D4A017;
        --yellow-soft:#FFF8E1;
        --red:#E0384D;
        --red-soft:#FDECEC;
    }

    @media (max-width:1282px) {
        .box-body {
            overflow: scroll;
            overflow-y: auto;
            padding-bottom: 60px;
        }
    }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:18px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    .page-header-left{ display:flex; align-items:center; gap:16px; }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:linear-gradient(135deg, var(--accent-grad-start) 0%, var(--accent) 100%);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; color:#fff; }
    .page-header-text h3{ margin:0; color:var(--text-dark); font-weight:700; font-size:22px; }
    .page-header-text p{ margin:2px 0 0; color:var(--text-muted); font-size:13px; }
    .page-header-text .underline{
        display:inline-block; width:34px; height:3px;
        background:var(--accent); border-radius:3px; margin-top:6px;
    }
    .page-header-actions{ display:flex; gap:10px; flex-wrap:wrap; }
    .page-header-actions .btn{
        border-radius:10px;
        font-size:13px;
        font-weight:600;
        padding:9px 18px;
        border:none;
        display:inline-flex;
        align-items:center;
        gap:7px;
    }
    .btn-suivi{ background:var(--amber-soft); color:var(--amber); }
    .btn-suivi:hover{ background:#FFE4D4; color:var(--amber); }
    .btn-ajouter{ background:linear-gradient(135deg, var(--accent-grad-start), var(--accent)); color:#fff; box-shadow:0 4px 14px rgba(140,126,242,0.3); }
    .btn-ajouter:hover{ color:#fff; filter:brightness(1.03); }

    /* ===== Filter card ===== */
    .filtre-box{
        background:#fff;
        border:1px solid var(--border-soft);
        border-radius:16px;
        padding:18px 22px;
        margin-bottom:18px;
        display:flex;
        align-items:flex-end;
        gap:16px;
        flex-wrap:wrap;
    }
    .filtre-box .form-group{ margin:0; position:relative; }
    .filtre-box label{
        display:flex;
        align-items:center;
        gap:6px;
        font-size:11.5px;
        text-transform:uppercase;
        letter-spacing:.03em;
        color:var(--text-muted);
        font-weight:700;
        margin-bottom:6px;
    }
    .filtre-box label svg{ width:13px;height:13px; color:var(--accent-text); }

    /* ---------- Themed date fields (replaces native <input type="date">) ---------- */
    .filtre-box .date-field-wrap{ position:relative; }
    .filtre-box input.lb-date-input{
        border:1px solid var(--border-soft) !important;
        border-radius:10px !important;
        padding:9px 38px 9px 12px !important;
        font-size:13px;
        color:var(--text-dark);
        background:#FAF9FF !important;
        box-shadow:none !important;
        width:170px;
        cursor:pointer;
    }
    .filtre-box input.lb-date-input:focus{ outline:none; border-color:var(--accent) !important; }
    .filtre-box input.lb-date-input.lb-date-open{ border-color:var(--accent) !important; box-shadow:0 0 0 3px var(--accent-soft) !important; }
    .filtre-box .date-field-wrap .date-field-icon{
        position:absolute; right:12px; bottom:11px; color:var(--accent-text); pointer-events:none;
    }
    .filtre-box .date-field-wrap .date-field-icon svg{ width:14px; height:14px; display:block; }

    .lb-cal-popup{
        position:absolute; z-index:9999; background:#fff; border:1px solid var(--border-soft);
        border-radius:14px; box-shadow:0 10px 28px rgba(140,126,242,0.18);
        padding:14px; width:270px; font-family:inherit; -webkit-user-select:none; user-select:none;
    }
    .lb-cal-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-cal-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; text-transform:capitalize; }
    .lb-cal-nav{
        border:none; background:var(--accent-soft); color:var(--accent-text); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center;
        line-height:1; padding:0;
    }
    .lb-cal-nav:hover{ background:#e7e2ff; }
    .lb-cal-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-cal-weekdays span{ font-size:11px; font-weight:700; color:var(--accent-text); text-transform:uppercase; }
    .lb-cal-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-cal-day{
        border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px;
        color:var(--text-dark); cursor:pointer;
    }
    .lb-cal-day:hover{ background:var(--accent-soft); }
    .lb-cal-day.other-month{ color:var(--text-muted); opacity:.5; }
    .lb-cal-day.today{ box-shadow:inset 0 0 0 1px var(--green); }
    .lb-cal-day.selected{ background:var(--accent) !important; color:#fff !important; font-weight:700; }
    .lb-cal-footer{ display:flex; justify-content:space-between; margin-top:10px; border-top:1px solid var(--border-soft); padding-top:10px; }
    .lb-cal-today-btn, .lb-cal-clear-btn{
        border:none; background:none; color:var(--accent-text); font-size:12.5px; font-weight:600; cursor:pointer;
        padding:5px 9px; border-radius:8px;
    }
    .lb-cal-today-btn:hover, .lb-cal-clear-btn:hover{ background:var(--accent-soft); }

    .btn-filtrer{
        background:var(--accent);
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:600;
        font-size:13px;
        padding:10px 20px;
        display:inline-flex;
        align-items:center;
        gap:7px;
    }
    .btn-filtrer:hover{ background:#5d4dd6; color:#fff; }

    /* ===== Empty state ===== */
    .callout-soft{
        background:var(--accent-soft);
        border-radius:16px;
        padding:20px 24px;
        display:flex;
        align-items:flex-start;
        gap:14px;
    }
    .callout-soft .callout-icon{
        flex:0 0 auto;
        width:38px;height:38px;
        border-radius:10px;
        background:#fff;
        color:var(--accent-text);
        display:flex;align-items:center;justify-content:center;
    }
    .callout-soft .callout-icon svg{ width:18px;height:18px; }
    .callout-soft h4{ margin:2px 0 4px; font-size:15px; font-weight:700; color:var(--text-dark); }
    .callout-soft p{ margin:0; font-size:13px; color:var(--text-muted); }

    /* ===== Table card ===== */
    .rapports-card{
        background:#fff;
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    table.rapports-table thead tr{ background:var(--accent-soft) !important; color:var(--accent-text) !important; }
    table.rapports-table thead th{
        color:var(--accent-text) !important;
        font-size:11.5px;
        text-transform:uppercase;
        letter-spacing:.02em;
        font-weight:700;
        border-bottom:1px solid var(--border-soft) !important;
        border-top:none !important;
        padding:12px 14px;
        white-space:nowrap;
    }
    table.rapports-table tbody td{
        vertical-align:middle;
        padding:10px 14px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:13px;
    }
    table.rapports-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
    table.rapports-table tbody tr:hover{ background-color:var(--accent-soft) !important; }

    .gamme-badge{
        display:inline-block;
        padding:3px 10px;
        border-radius:20px;
        background:var(--accent-soft);
        color:var(--accent-text);
        font-size:11.5px;
        font-weight:700;
    }

    .pastel-badge{
        display:inline-block;
        padding:3px 10px;
        border-radius:20px;
        font-size:11px;
        font-weight:700;
        white-space:nowrap;
    }
    .pastel-badge.green{ background:var(--green-soft); color:var(--green); }
    .pastel-badge.blue{ background:var(--blue-soft); color:var(--blue); }
    .pastel-badge.yellow{ background:var(--yellow-soft); color:var(--yellow); }
    .pastel-badge.red{ background:var(--red-soft); color:var(--red); }
    .pastel-badge.orange{ background:var(--amber-soft); color:var(--amber); }

    /* ===== Export button ===== */
    .buttons-excel.btn{
        background:#fff !important;
        color:var(--green) !important;
        border:1px solid var(--green-soft) !important;
        border-radius:10px !important;
        font-weight:600;
        font-size:13px;
        box-shadow:none !important;
    }
    .buttons-excel.btn:hover{ background:var(--green-soft) !important; }

    /* ===== DataTables controls ===== */
    div.dataTables_wrapper div.dataTables_length select{
        border:1px solid var(--border-soft);
        border-radius:8px;
        padding:6px 28px 6px 10px;
        color:var(--text-dark);
        font-size:13px;
        font-weight:600;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239a9aab' stroke-width='2'><polyline points='6 9 12 15 18 9'/></svg>") no-repeat right 8px center;
        background-size:12px;
        appearance:none; -webkit-appearance:none;
    }
    div.dataTables_wrapper div.dataTables_length label,
    div.dataTables_wrapper div.dataTables_filter label{
        color:var(--text-muted); font-size:13px; font-weight:600;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:9px;
        padding:8px 14px 8px 34px;
        color:var(--text-dark);
        font-size:13px;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239a9aab' stroke-width='2'><circle cx='11' cy='11' r='7'/><line x1='21' y1='21' x2='16.65' y2='16.65'/></svg>") no-repeat 10px center;
        background-size:14px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus{
        outline:none; border-color:var(--accent); box-shadow:0 0 0 3px var(--accent-soft);
    }
    div.dataTables_wrapper div.dataTables_info{ color:var(--text-muted); font-size:13px; }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button{
        border-radius:8px !important;
        margin:0 2px;
        border:1px solid var(--border-soft) !important;
        color:var(--text-dark) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current{
        background:var(--accent) !important;
        border-color:var(--accent) !important;
        color:#fff !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover{
        background:var(--accent-soft) !important;
        border-color:var(--accent-soft) !important;
        color:var(--accent-text) !important;
    }
</style>

<div class="page-header-card">
    <div class="page-header-left">
        <div class="page-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
        </div>
        <div class="page-header-text">
            <h3><?php echo __('Mes Rapports d\'Actions'); ?></h3>
            <p><?php echo __('Consultez et gérez vos rapports d\'actions promotionnelles'); ?></p>
            <span class="underline"></span>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="<?php echo $this->Html->url(array('action' => 'suivi')); ?>" class="btn btn-suivi">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            Suivi des anomalies
        </a>
        <a href="<?php echo $this->Html->url(array('action' => 'add')); ?>" class="btn btn-ajouter">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Ajouter un rapport
        </a>
    </div>
</div>

<div class="box-body" style="padding:0;">

    <!-- Filtres par date -->
    <div class="filtre-box">
        <form method="get" action="<?php echo $this->Html->url(array('controller' => 'actionrapports', 'action' => 'index')); ?>" class="form-inline" style="display:flex; align-items:flex-end; gap:16px; flex-wrap:wrap;">
            <div class="form-group">
                <label><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Date début</label>
                <div class="date-field-wrap">
                    <input type="text" name="date_debut" id="datepicker_debut" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_debut); ?>">
                    <span class="date-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                </div>
            </div>
            <div class="form-group">
                <label><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Date fin</label>
                <div class="date-field-wrap">
                    <input type="text" name="date_fin" id="datepicker_fin" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_fin); ?>">
                    <span class="date-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                </div>
            </div>
            <button type="submit" class="btn-filtrer">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Filtrer
            </button>
        </form>
    </div>

    <?php if (empty($rapports)): ?>
        <div class="callout-soft">
            <span class="callout-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            </span>
            <div>
                <h4>Aucun rapport ajouté</h4>
                <p>Aucun rapport promotionnel n'a été trouvé pour la période du <?php echo date('d/m/Y', strtotime($date_debut)); ?> au <?php echo date('d/m/Y', strtotime($date_fin)); ?>.</p>
            </div>
        </div>
    <?php else: ?>

        <?php
        $labels_enquete = array('1' => 'Augmentation', '2' => 'Stabilité', '3' => 'Diminution', '4' => 'Pas de prescription');
        $labels_satisfaction = array('1' => 'Très faible', '2' => 'Faible', '3' => 'Modérée', '4' => 'Bonne', '5' => 'Très forte');
        ?>

        <div class="rapports-card">
        <div class="table-responsive">
            <table id="tableRapports" class="table table-bordered table-striped table-hover rapports-table" style="width:100%;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Délégué</th>
                        <th>Code CRM</th>
                        <th>Médecin (Nom & Prénom)</th>
                        <th>Gamme</th>
                        <th>Secteur CRM</th>
                        <th>Secteur IMS</th>
                        <?php if ($role == 'Admin'): ?>
                            <th>Nature</th>
                            <th>Montant</th>
                            <th>Description</th>
                            <th>POT</th>
                            <th>Gamme POT</th>
                        <?php endif; ?>
                        <th style="text-align:center">Enquête<br>Médecin</th>
                        <th style="text-align:center">Enquête<br>Secrétaire</th>
                        <th style="text-align:center">Enquête<br>Pharmacie</th>
                        <th style="text-align:center">Niveau<br>Satisfaction</th>
                        <th>Jours Restants</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rapports as $rapport):
                        $r = $rapport['Actionrapport'];
                        $action = $rapport['ActionDetail'];
                        $secteur = $secteurs[$action['Client']['secteur_id']];
                    ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($r['created'])); ?></td>
                            <td><?php echo isset($rapport['User']['name']) ? h($rapport['User']['name']) : ''; ?></td>
                            <td><?php echo h($action['Client']['id']); ?></td>
                            <td><?php echo isset($action['Client']['nom']) ? h($action['Client']['nom'] . ' ' . $action['Client']['prenom']) : ''; ?></td>
                            <td><span class="gamme-badge"><?php echo isset($action['Action']['game_id']) ? h($action['Action']['game_id']) : ''; ?></span></td>
                            <td><?php echo h($secteur['secteur']); ?></td>
                            <td><?php echo h($secteur['secteur_ims']); ?></td>
                            <?php if ($role == 'Admin'):
                                $pot = "-";
                                $gamme = "-";
                                if (isset($potv2[$action['Client']['id']])) {
                                    $pot = $potv2[$action['Client']['id']]["pot"];
                                    $gamme = $potv2[$action['Client']['id']]["gamme"];
                                }
                            ?>
                                <td><?php echo $action['Action']['nature']; ?></td>
                                <td><?php echo $action['Action']['name']; ?></td>
                                <td><?php echo $action['Action']['description']; ?></td>
                                <td><?php echo $pot; ?></td>
                                <td><?php echo $gamme; ?></td>
                            <?php endif; ?>


                            <td style="text-align:center">
                                <span class="pastel-badge <?php echo ($r['enquete_medecin'] == 1) ? 'green' : (($r['enquete_medecin'] == 2) ? 'blue' : (($r['enquete_medecin'] == 3) ? 'yellow' : 'red')); ?>">
                                    <?php echo isset($labels_enquete[$r['enquete_medecin']]) ? $labels_enquete[$r['enquete_medecin']] : $r['enquete_medecin']; ?>
                                </span>
                            </td>
                            <td style="text-align:center">
                                <span class="pastel-badge <?php echo ($r['enquete_secretaire'] == 1) ? 'green' : (($r['enquete_secretaire'] == 2) ? 'blue' : (($r['enquete_secretaire'] == 3) ? 'yellow' : 'red')); ?>">
                                    <?php echo isset($labels_enquete[$r['enquete_secretaire']]) ? $labels_enquete[$r['enquete_secretaire']] : $r['enquete_secretaire']; ?>
                                </span>
                            </td>
                            <td style="text-align:center">
                                <span class="pastel-badge <?php echo ($r['enquete_pharmacie'] == 1) ? 'green' : (($r['enquete_pharmacie'] == 2) ? 'blue' : (($r['enquete_pharmacie'] == 3) ? 'yellow' : 'red')); ?>">
                                    <?php echo isset($labels_enquete[$r['enquete_pharmacie']]) ? $labels_enquete[$r['enquete_pharmacie']] : $r['enquete_pharmacie']; ?>
                                </span>
                            </td>
                            <td style="text-align:center">
                                <span class="pastel-badge <?php echo ($r['niveau_satisfaction'] == 5) ? 'green' : (($r['niveau_satisfaction'] == 4) ? 'blue' : (($r['niveau_satisfaction'] == 3) ? 'yellow' : (($r['niveau_satisfaction'] == 2) ? 'orange' : 'red'))); ?>">
                                    <?php echo isset($labels_satisfaction[$r['niveau_satisfaction']]) ? $labels_satisfaction[$r['niveau_satisfaction']] : $r['niveau_satisfaction']; ?>
                                </span>
                            </td>

                            <td><?php
                                $jours_restants_rapport = '';
                                if (isset($action['Action']['date_fin']) && isset($r['created'])) {
                                    $ts_fin = strtotime($action['Action']['date_fin']);
                                    $ts_creation = strtotime($r['created']);
                                    if ($ts_fin && $ts_creation) {
                                        $jours_restants_rapport = round(($ts_fin - $ts_creation) / 86400);
                                    }
                                }
                                echo $jours_restants_rapport; ?></td>
                            <td><?php echo h($r['commentaire']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>

    <?php endif; ?>
</div>


<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('dataTables.bootstrap.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
    $(function() {
        $('#tableRapports').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Exporter Excel',
                className: 'btn buttons-excel btn-sm'
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
            }
        });
    });

    // ---------- Themed date pickers (self-contained, no external library) ----------
    // Ported from the "Visites Doubles" dashboard so both views share the same
    // calendar UX. Input values stay ISO (yyyy-mm-dd) so the existing
    // `date_debut` / `date_fin` GET params and controller logic are untouched.
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
            ['datepicker_debut', 'datepicker_fin'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        });

        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            ['datepicker_debut', 'datepicker_fin'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el && !LBCalendar.instances.some(function(inst){ return inst.input === el; })) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        }
    })();
</script>
