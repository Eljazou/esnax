<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<style>
    /* ===================================================================
       LaboRate Indigo Card System — Tableau de bord Évaluations 360°
       (design only — no PHP logic was modified)
    =================================================================== */

    .lb-page-header {
        background: linear-gradient(135deg, #7C6FF5 0%, #9C8FFA 100%);
        border-radius: 14px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
        box-shadow: 0 4px 18px rgba(124, 111, 245, 0.18);
    }
    .lb-page-header .lb-title-group { display: flex; align-items: center; gap: 10px; }
    .lb-page-header .lb-icon-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 34px; height: 34px; background: rgba(255,255,255,0.20); border-radius: 9px;
    }
    .lb-page-header h3 { color: #fff; font-weight: 600; margin: 0; font-size: 19px; }
    .lb-btn-header {
        background: rgba(255,255,255,0.16);
        color: #fff;
        border: 1.5px solid rgba(255,255,255,0.5);
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all .15s ease;
    }
    .lb-btn-header:hover { background: rgba(255,255,255,0.28); color: #fff; text-decoration: none; }

    /* --- Bannière alerte --- */
    .lb-alert-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FEF0EF;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 18px;
    }
    .lb-alert-banner .lb-alert-left { display: flex; align-items: center; gap: 14px; }
    .lb-alert-count {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: #F04438;
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .lb-alert-banner strong { font-size: 15px; color: #7A2E27; }
    .lb-alert-banner small { color: #A9736D; }
    .lb-alert-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: #FBD9D6;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* --- En-tête équipe --- */
    .lb-team-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        background: #fff;
        border: 1px solid #EFEDFC;
        border-radius: 14px;
        padding: 14px 18px;
        margin-top: 22px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(124,111,245,0.06);
    }
    .lb-team-header .lb-team-name {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 14.5px;
        color: #453E99;
    }
    .lb-team-icon {
        width: 32px; height: 32px;
        border-radius: 9px;
        background: #EEECFF;
        color: #7C6FF5;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .lb-team-stats { display: flex; gap: 10px; flex-wrap: wrap; }
    .lb-pill-stat {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 700;
        white-space: nowrap;
    }
    .lb-pill-blue { background: #EAF0FF; color: #3D67F0; }
    .lb-pill-score-green { background: #E6F7EE; color: #1B9E5A; }
    .lb-pill-score-orange { background: #FFF4E0; color: #DB8B00; }
    .lb-pill-score-red { background: #FDECEB; color: #E5493C; }

    /* --- Recherche --- */
    .lb-team-search { display: flex; justify-content: flex-end; margin-bottom: 10px; }

    /* --- Table --- */
    .lb-eval-table-wrap {
        background: #fff;
        border: 1px solid #EFEDFC;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(124,111,245,0.06);
        padding: 8px 4px 4px;
    }
    table.lb-eval-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0 !important;
    }
    table.lb-eval-table thead th {
        background: transparent !important;
        border: none !important;
        color: #9A94C9;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
        padding: 10px 12px !important;
    }
    table.lb-eval-table tbody td {
        border: none !important;
        border-top: 1px solid #F3F1FD !important;
        padding: 10px 12px;
        vertical-align: middle;
    }
    table.lb-eval-table tbody tr:hover { background: #FBFAFF; }
    table.lb-eval-table tbody tr.row-superviseur { background: #F5F3FF !important; }
    table.lb-eval-table tbody tr.row-superviseur:hover { background: #EFEBFF !important; }

    .lb-vmp-cell { display: flex; align-items: center; gap: 10px; }
    .lb-avatar-init {
        width: 34px; height: 34px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .lb-vmp-name { font-weight: 700; font-size: 13.5px; color: #35315C; }
    .lb-vmp-sub { font-size: 11.5px; color: #A9A4D6; }
    .lb-badge-sup {
        background: #7C6FF5; color: #fff; font-size: 9.5px; font-weight: 700;
        padding: 2px 7px; border-radius: 10px; margin-left: 4px; vertical-align: middle;
    }

    .lb-score-pill {
        padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 12.5px;
        display: inline-block; min-width: 52px; text-align: center;
    }
    .lb-score-green { background: #E6F7EE; color: #1B9E5A; }
    .lb-score-orange { background: #FFF4E0; color: #DB8B00; }
    .lb-score-red { background: #FDECEB; color: #E5493C; }

    .lb-trend { font-size: 13px; font-weight: 600; }
    .lb-trend-up { color: #1B9E5A; }
    .lb-trend-down { color: #E5493C; }
    .lb-trend-stable { color: #B4AFDE; }

    .lb-rank-pill {
        padding: 3px 10px; border-radius: 20px; font-weight: 700; font-size: 12px;
        display: inline-block; min-width: 30px; text-align: center;
    }
    .lb-rank-gold { background: #FFF1C2; color: #97690A; }
    .lb-rank-silver { background: #EDEDF2; color: #6B6B76; }
    .lb-rank-bronze { background: #F3DCC6; color: #8A4E13; }
    .lb-rank-default { background: #F5F4FC; color: #A9A4D6; }
    .lb-rank-last { background: #FDECEB; color: #E5493C; }

    .lb-date-cell { display: inline-flex; align-items: center; gap: 5px; font-size: 12.5px; font-weight: 600; color: #4A3F7A; }
    .lb-days-cell { font-size: 14px; font-weight: 700; }

    .lb-status-pill {
        padding: 5px 12px; border-radius: 20px; font-weight: 700; font-size: 11.5px;
        display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
    }
    .lb-status-retard { background: #FDECEB; color: #E5493C; }
    .lb-status-ok { background: #E6F7EE; color: #1B9E5A; }
    .lb-status-none { background: #F5F4FC; color: #A9A4D6; }

    .lb-actions-cell { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
    .lb-btn-evaluer {
        background: #E6F7EE; color: #1B9E5A;
        border: none; border-radius: 8px;
        padding: 6px 12px; font-size: 12px; font-weight: 700;
        display: inline-flex; align-items: center; gap: 5px;
        transition: all .15s ease;
    }
    .lb-btn-evaluer:hover { background: #1B9E5A; color: #fff; text-decoration: none; }
    .lb-btn-hist {
        background: #F5F4FC; color: #6B6499;
        border: none; border-radius: 8px;
        width: 30px; height: 30px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all .15s ease;
    }
    .lb-btn-hist:hover { background: #7C6FF5; color: #fff; text-decoration: none; }

    .lb-muted { color: #C9C4EE; }

    /* --- DataTables controls override --- */
    .lb-eval-table-wrap .dataTables_wrapper { padding: 0 10px; }
    .lb-eval-table-wrap .dataTables_filter { margin-bottom: 10px; }
    .lb-eval-table-wrap .dataTables_filter label {
        display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #9A94C9; margin-bottom: 0;
    }
    .lb-eval-table-wrap .dataTables_filter input {
        border: 1.5px solid #E4E1FF;
        border-radius: 20px;
        padding: 7px 14px 7px 34px;
        font-size: 13px;
        color: #4A3F7A;
        outline: none;
        background: #FAFAFE url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7' stroke='%238B85C7' stroke-width='2'/%3E%3Cpath d='M21 21l-4.35-4.35' stroke='%238B85C7' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat 12px center;
        background-size: 14px;
        width: 220px;
        max-width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .lb-eval-table-wrap .dataTables_filter input:focus {
        border-color: #7C6FF5;
        box-shadow: 0 0 0 3px rgba(124,111,245,0.15);
    }
    .lb-eval-table-wrap .dataTables_info {
        color: #A9A4D6;
        font-size: 12.5px;
        padding: 12px 12px 10px;
    }
    .lb-eval-table-wrap .dataTables_paginate {
        padding: 8px 12px 12px;
    }
    .lb-eval-table-wrap .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        border: none !important;
        background: #F5F4FC !important;
        color: #6B6499 !important;
        margin: 0 3px;
        padding: 5px 12px !important;
        min-width: 32px;
        text-align: center;
    }
    .lb-eval-table-wrap .dataTables_paginate .paginate_button:hover {
        background: #EEECFF !important;
        color: #453E99 !important;
    }
    .lb-eval-table-wrap .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #7C6FF5 0%, #9C8FFA 100%) !important;
        color: #fff !important;
        box-shadow: 0 2px 6px rgba(124,111,245,0.35);
    }
    .lb-eval-table-wrap .dataTables_paginate .paginate_button.disabled {
        color: #D9D5F2 !important;
        background: #FAFAFE !important;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <div class="lb-page-header">
            <div class="lb-title-group">
                <span class="lb-icon-badge">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3v18h18M8 17V10M13 17V6M18 17v-4" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <h3>Tableau de bord des Évaluations 360° (60 Jours)</h3>
            </div>
            <a href="<?php echo $this->Html->url(array('action' => 'historique')); ?>" class="lb-btn-header">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3v5h5M3.05 13A9 9 0 1 0 6 5.3L3 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php echo ($role != 'Admin' && $role != 'Super viseur') ? 'MON HISTORIQUE' : 'HISTORIQUE GLOBAL'; ?>
            </a>
        </div>

        <!-- Bannière d'alerte si des délégués sont en retard -->
        <?php if ($alertCount > 0): ?>
            <div class="lb-alert-banner">
                <div class="lb-alert-left">
                    <span class="lb-alert-count"><?php echo $alertCount; ?></span>
                    <div>
                        <strong>Délégué(s) en retard d'évaluation !</strong>
                        <br><small>Objectif : chaque délégué doit être évalué tous les 60 jours</small>
                    </div>
                </div>
                <span class="lb-alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14.18A2 2 0 0 0 3.82 21h16.36a2 2 0 0 0 1.71-2.96L13.71 3.86a2 2 0 0 0-3.42 0z" stroke="#E5493C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
        <?php endif; ?>

        <?php if (empty($dashboardData)): ?>
            <div class="alert alert-info" style="margin-top: 20px;border-radius:14px;">
                <i class="fa fa-info-circle"></i> Vous n'avez aucune équipe assignée ou aucun Délégué Médical sous
                votre responsabilité.
            </div>
        <?php else: ?>

            <?php
            $lbAvatarPalette = array(
                array('bg' => '#EAF0FF', 'fg' => '#3D67F0'),
                array('bg' => '#F5EAFF', 'fg' => '#8B4FE5'),
                array('bg' => '#E6F7EE', 'fg' => '#1B9E5A'),
                array('bg' => '#FFF4E0', 'fg' => '#DB8B00'),
                array('bg' => '#FDECEB', 'fg' => '#E5493C'),
                array('bg' => '#EEECFF', 'fg' => '#7C6FF5'),
            );
            $lbAvatarIndex = 0;
            ?>

            <?php foreach ($dashboardData as $supName => $vmps):
                // Calculer la moyenne de l'équipe
                $teamScoresArr = array();
                foreach ($vmps as $v) {
                    if ($v['last_score'] !== null) {
                        $teamScoresArr[] = $v['last_score'];
                    }
                }
                $teamAvg = count($teamScoresArr) > 0 ? round(array_sum($teamScoresArr) / count($teamScoresArr), 1) : null;
                $teamAvgPillClass = ($teamAvg >= 75) ? 'lb-pill-score-green' : (($teamAvg >= 50) ? 'lb-pill-score-orange' : 'lb-pill-score-red');
                ?>
                <!-- En-tête superviseur avec stats équipe -->
                <div class="lb-team-header">
                    <div class="lb-team-name">
                        <span class="lb-team-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM21 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        ÉQUIPE DE : <?php echo mb_strtoupper(h($supName)); ?>
                    </div>
                    <div class="lb-team-stats">
                        <span class="lb-pill-stat lb-pill-blue">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            <?php echo count($vmps); ?> Membre(s)
                        </span>
                        <?php if ($teamAvg !== null): ?>
                            <span class="lb-pill-stat <?php echo $teamAvgPillClass; ?>">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                                Moy. Équipe : <?php echo $teamAvg; ?>%
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="lb-eval-table-wrap">
                    <div class="table-responsive">
                        <table class="table lb-eval-table datatable-team">
                            <thead>
                                <tr>
                                    <th width="22%">Délégué Médical</th>
                                    <th width="10%" class="text-center">Note Globale</th>
                                    <th width="8%" class="text-center">Tendance</th>
                                    <th width="8%" class="text-center">Rang Éq.</th>
                                    <th width="8%" class="text-center">Rang CRM</th>
                                    <th width="12%" class="text-center">Dernière Bilan</th>
                                    <th width="10%" class="text-center">Jours</th>
                                    <th width="10%" class="text-center">Statut</th>
                                    <th width="12%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vmps as $vmp):
                                    // Badge de statut
                                    $statusBadge = '';
                                    if ($vmp['status'] == 'RETARD') {
                                        $statusBadge = '<span class="lb-status-pill lb-status-retard"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01M10.29 3.86l-8.18 14.18A2 2 0 0 0 3.82 21h16.36a2 2 0 0 0 1.71-2.96L13.71 3.86a2 2 0 0 0-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> En Retard</span>';
                                    } else if ($vmp['status'] == 'NON_EVALUE') {
                                        $statusBadge = '<span class="lb-status-pill lb-status-none">Non évalué</span>';
                                    } else {
                                        $statusBadge = '<span class="lb-status-pill lb-status-ok"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg> À jour</span>';
                                    }

                                    // Couleur du score
                                    $scoreClass = '';
                                    if ($vmp['last_score'] !== null) {
                                        $scoreClass = ($vmp['last_score'] >= 75) ? 'lb-score-green' : (($vmp['last_score'] >= 50) ? 'lb-score-orange' : 'lb-score-red');
                                    }

                                    // Rang équipe
                                    $rankEq = isset($teamRanking[$vmp['vmp_id']]) ? $teamRanking[$vmp['vmp_id']] : '-';
                                    $rankEqClass = 'lb-rank-default';
                                    if ($rankEq === 1)
                                        $rankEqClass = 'lb-rank-gold';
                                    elseif ($rankEq === 2)
                                        $rankEqClass = 'lb-rank-silver';
                                    elseif ($rankEq === 3)
                                        $rankEqClass = 'lb-rank-bronze';

                                    // Rang CRM global
                                    $rankCrm = isset($globalRanking[$vmp['vmp_id']]) ? $globalRanking[$vmp['vmp_id']] : '-';
                                    $rankCrmClass = 'lb-rank-default';
                                    if ($rankCrm === 1)
                                        $rankCrmClass = 'lb-rank-gold';
                                    elseif ($rankCrm === 2)
                                        $rankCrmClass = 'lb-rank-silver';
                                    elseif ($rankCrm === 3)
                                        $rankCrmClass = 'lb-rank-bronze';
                                    elseif (is_numeric($rankCrm) && $rankCrm == $totalCrm && $totalCrm > 3)
                                        $rankCrmClass = 'lb-rank-last';

                                    // Tendance
                                    $trendIcon = '<span class="lb-trend lb-trend-stable">→</span>';
                                    if ($vmp['tendance'] == 'up') {
                                        $trendIcon = '<span class="lb-trend lb-trend-up">↑</span>';
                                    } elseif ($vmp['tendance'] == 'down') {
                                        $trendIcon = '<span class="lb-trend lb-trend-down">↓</span>';
                                    }

                                    // Avatar (design only — derived from existing name, no logic change)
                                    $lbNameParts = preg_split('/\s+/', trim($vmp['vmp_name']));
                                    $lbInitials = mb_strtoupper(mb_substr($lbNameParts[0], 0, 1) . (isset($lbNameParts[1]) ? mb_substr($lbNameParts[1], 0, 1) : ''));
                                    $lbColor = $lbAvatarPalette[$lbAvatarIndex % count($lbAvatarPalette)];
                                    $lbAvatarIndex++;
                                    ?>
                                    <tr class="<?php echo $vmp['is_superviseur'] ? 'row-superviseur' : ''; ?>">
                                        <td>
                                            <div class="lb-vmp-cell">
                                                <span class="lb-avatar-init" style="background:<?php echo $lbColor['bg']; ?>;color:<?php echo $lbColor['fg']; ?>;"><?php echo h($lbInitials); ?></span>
                                                <div>
                                                    <span class="lb-vmp-name"><?php echo h($vmp['vmp_name']); ?></span>
                                                    <?php if ($vmp['is_superviseur']): ?>
                                                        <span class="lb-badge-sup">SUP</span>
                                                    <?php endif; ?>
                                                    <br><span class="lb-vmp-sub">Nb éval. : <?php echo $vmp['count']; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Note globale -->
                                        <td class="text-center">
                                            <?php if ($vmp['last_score'] !== null): ?>
                                                <span class="lb-score-pill <?php echo $scoreClass; ?>"><?php echo $vmp['last_score']; ?>%</span>
                                            <?php else: ?>
                                                <span class="lb-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Tendance -->
                                        <td class="text-center">
                                            <?php echo $trendIcon; ?>
                                        </td>
                                        <!-- Rang Équipe -->
                                        <td class="text-center">
                                            <?php if ($rankEq !== '-'): ?>
                                                <span class="lb-rank-pill <?php echo $rankEqClass; ?>">#<?php echo $rankEq; ?></span>
                                            <?php else: ?>
                                                <span class="lb-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Rang CRM -->
                                        <td class="text-center">
                                            <?php if ($rankCrm !== '-'): ?>
                                                <span class="lb-rank-pill <?php echo $rankCrmClass; ?>">#<?php echo $rankCrm; ?>/<?php echo $totalCrm; ?></span>
                                            <?php else: ?>
                                                <span class="lb-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Dernière bilan -->
                                        <td class="text-center">
                                            <?php if ($vmp['last_date']): ?>
                                                <span class="lb-date-cell">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                    <?php echo date('d/m/Y', strtotime($vmp['last_date'])); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="lb-muted">Aucune</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Jours écoulés -->
                                        <td class="text-center">
                                            <?php if ($vmp['days'] !== null): ?>
                                                <span class="lb-days-cell" style="color: <?php echo ($vmp['days'] > 60) ? '#E5493C' : '#1B9E5A'; ?>;">
                                                    <?php echo $vmp['days']; ?>j
                                                </span>
                                            <?php else: ?>
                                                <span class="lb-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Statut -->
                                        <td class="text-center">
                                            <?php echo $statusBadge; ?>
                                        </td>
                                        <!-- Actions -->
                                        <td class="text-center">
                                            <div class="lb-actions-cell">
                                                <?php if ($role == 'Admin' || $role == 'Super viseur'): ?>
                                                    <a href="<?php echo $this->Html->url(array('action' => 'add', $vmp['vmp_id'])); ?>"
                                                        class="lb-btn-evaluer" title="Nouvelle évaluation">
                                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg>
                                                        Évaluer
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($vmp['count'] > 0): ?>
                                                    <a href="<?php echo $this->Html->url(array('action' => 'historique', $vmp['vmp_id'])); ?>"
                                                        class="lb-btn-hist" title="Voir l'historique">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('dataTables.bootstrap.min');
?>
<script>
    $(function () {
        $('.datatable-team').DataTable({
            "paging": true,
            "pageLength": 6,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json",
                "search": "",
                "searchPlaceholder": "Rechercher..."
            }
        });
    });
</script>
