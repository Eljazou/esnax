<?php 
echo $this->Html->css('dataTables.bootstrap'); 

// Helper functions and patterns for universal use
$typePatterns = array(
    array('pattern' => 'decin',     'color' => '#e74c3c', 'icon' => 'fa-user-md',    'class' => 'medecin'),
    array('pattern' => 'pharmacie', 'color' => '#27ae60', 'icon' => 'fa-plus-square', 'class' => 'pharmacie'),
    array('pattern' => 'grossiste', 'color' => '#f39c12', 'icon' => 'fa-truck',       'class' => 'grossiste'),
    array('pattern' => 'clinique',  'color' => '#8e44ad', 'icon' => 'fa-hospital-o',  'class' => 'clinique'),
    array('pattern' => 'pital',     'color' => '#2980b9', 'icon' => 'fa-h-square',    'class' => 'hopital'),
);

if (!function_exists('_getTypeStyle')) {
    function _getTypeStyle($name, $patterns) {
        $lower = mb_strtolower($name, 'UTF-8');
        foreach ($patterns as $p) {
            if (stripos($lower, $p['pattern']) !== false) {
                return $p;
            }
        }
        return array('color' => '#95a5a6', 'icon' => 'fa-user', 'class' => 'other');
    }
}

if (!function_exists('_fixEncoding')) {
    function _fixEncoding($str) {
        if (strpos($str, 'Ã') !== false) {
            return utf8_decode($str);
        }
        return $str;
    }
}

$nbNonAffecter = $totalClients - $nbAffecter;
$pctAffecter = $totalClients > 0 ? number_format((100 * $nbAffecter / $totalClients), 0) : 0;
$pctNonAffecter = $totalClients > 0 ? number_format((100 * $nbNonAffecter / $totalClients), 0) : 0;
?>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    :root {
        --accent: #7C5CFA;
        --accent-dark: #5B3FD9;
        --accent-soft: #F1EDFF;
        --accent-soft-2: #E6DEFF;
        --ink: #1E1B2E;
        --muted: #8B87A0;
        --border: #EAE7F5;
        --surface: #FFFFFF;
        --canvas: #F7F6FC;
        --radius-lg: 14px;
        --radius-md: 10px;
        --radius-sm: 7px;
        --shadow-card: 0 2px 10px rgba(76, 55, 168, 0.06);
        --shadow-card-hover: 0 8px 24px rgba(76, 55, 168, 0.12);
        --success: #17A673;
        --success-soft: #E8FAF3;
        --warning: #F5A524;
        --warning-soft: #FFF6E5;
        --danger: #E5484D;
        --danger-soft: #FDEBEC;
        --info: #3E8BFF;
    }

    section.content { background: var(--canvas); padding: 4px 2px 20px; font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif; color: var(--ink); }
    section.content h3, section.content h4 { color: var(--ink); }

    /* ---------- KPI stat cards (replaces AdminLTE small-box) ---------- */
    .kpi-card { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); padding: 20px 22px; display: flex; align-items: center; gap: 16px; border: 1px solid var(--border); transition: box-shadow .2s, transform .2s; height: 100%; }
    .kpi-card:hover { box-shadow: var(--shadow-card-hover); transform: translateY(-2px); }
    .kpi-card .kpi-icon { width: 48px; height: 48px; min-width: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 20px; color: #fff; }
    .kpi-card .kpi-icon.kpi-accent { background: var(--accent); }
    .kpi-card .kpi-icon.kpi-success { background: var(--success); }
    .kpi-card .kpi-icon.kpi-warning { background: var(--warning); }
    .kpi-card .kpi-value { font-size: 26px; font-weight: 700; line-height: 1.15; color: var(--ink); }
    .kpi-card .kpi-label { font-size: 12.5px; color: var(--muted); font-weight: 500; margin-top: 2px; }

    /* ---------- Card shell (replaces AdminLTE box) ---------- */
    .lav-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); margin-bottom: 20px; overflow: hidden; }
    .lav-card-header { display: flex; align-items: center; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border); }
    .lav-card-header i.hdr-ic { color: var(--accent); font-size: 15px; }
    .lav-card-header .lav-card-title { font-size: 15px; font-weight: 700; color: var(--ink); margin: 0; flex: 1; }
    .lav-card-header .btn-box-tool { color: var(--muted); background: transparent; border: none; padding: 4px 8px; border-radius: var(--radius-sm); }
    .lav-card-header .btn-box-tool:hover { background: var(--accent-soft); color: var(--accent-dark); }
    .lav-card-body { padding: 18px 20px; }
    .lav-card.accent-top { border-top: 3px solid var(--accent); }
    .lav-card.success-top { border-top: 3px solid var(--success); }

    /* ---------- Profile card ---------- */
    .profile-card .profile-username { font-size: 20px; font-weight: 700; letter-spacing: .5px; color: var(--accent-dark); margin-bottom: 2px; }
    .profile-card ul.list-group-unbordered { margin: 16px 0; }
    .profile-card ul.list-group-unbordered li { border: none; border-bottom: 1px solid var(--border); padding: 10px 2px; }
    .profile-card ul.list-group-unbordered li:last-child { border-bottom: none; }
    .profile-card ul.list-group-unbordered li a { color: var(--accent); font-weight: 600; }
    .btn-lav-block { background: var(--accent); border: none; color: #fff; font-weight: 600; border-radius: var(--radius-md); padding: 10px; transition: background .15s; }
    .btn-lav-block:hover { background: var(--accent-dark); color: #fff; }

    /* ---------- DataTables polish ---------- */
    .dt-button{width:auto;float:left;margin:4px;font-size:13px;line-height:20px;padding:6px 12px;background:var(--accent);color:#fff;border:none;border-radius:var(--radius-sm);font-weight:600;}
    .dt-button:hover{color:#fff;background:var(--accent-dark);}
    table.dataTable thead th { color: var(--ink); font-weight: 700; font-size: 12.5px; text-transform: uppercase; letter-spacing: .3px; border-bottom: 2px solid var(--border) !important; }
    table.dataTable.table-striped > tbody > tr:nth-of-type(odd) { background-color: var(--accent-soft); }
    table.dataTable td, table.dataTable th { padding: 9px 12px !important; font-size: 13px; vertical-align: middle; }
    .table-scroll { max-height: 320px; overflow-y: auto; border: 1px solid var(--border); border-radius: var(--radius-md); }

    /* ---------- Status badges (replace AdminLTE label-*) ---------- */
    .badge-lav { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 20px; }
    .badge-lav-success { background: var(--success-soft); color: var(--success); }
    .badge-lav-warning { background: var(--warning-soft); color: #B67200; }
    .badge-lav-danger  { background: var(--danger-soft); color: var(--danger); }
    .badge-lav-info    { background: #E8F1FF; color: var(--info); }
    .badge-lav-neutral { background: #F1F0F5; color: var(--muted); }
    a.badge-lav { text-decoration: none; cursor: pointer; }
    a.badge-lav:hover { filter: brightness(0.94); }

    /* ---------- Map ---------- */
    #map-secteur-view {
        width: 100%; height: 500px; border-radius: var(--radius-md); border: 1px solid var(--border);
    }
    .map-legend {
        background: rgba(255,255,255,0.97); padding: 10px 14px; border-radius: var(--radius-sm); box-shadow: var(--shadow-card); font-size: 12px; line-height: 22px;
    }
    .map-legend i { width: 16px; height: 16px; display: inline-block; margin-right: 6px; vertical-align: middle; border-radius: 50%; }
    .map-header-bar {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%); color: #fff; padding: 12px 18px; border-radius: var(--radius-md); margin-bottom: 14px; font-size: 14px;
    }
    .map-header-bar.visits-bar { background: linear-gradient(135deg, #1FAE7A 0%, #0E8A5E 100%); }
    .map-header-bar .badge-map {
        background: rgba(255,255,255,0.22); color: #fff; padding: 3px 10px; border-radius: 12px; font-size: 12px; margin-left: 8px;
    }

    /* ---------- Score cards ---------- */
    .map-score-container { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; }
    .map-score-card { flex: 1; min-width: 130px; background: var(--surface); border-radius: var(--radius-md); padding: 14px 16px; text-align: center; box-shadow: var(--shadow-card); border: 1px solid var(--border); border-left: 4px solid var(--accent); transition: transform 0.2s, box-shadow .2s; }
    .map-score-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-card-hover); }
    .map-score-card .score-value { font-size: 26px; font-weight: 700; line-height: 1.1; }
    .map-score-card .score-label { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px; font-weight: 600; }
    .map-score-card .score-icon { font-size: 16px; margin-bottom: 5px; display: block; }
    .map-score-card.total       { border-left-color: var(--accent); }
    .map-score-card.medecin     { border-left-color: #e74c3c; }
    .map-score-card.pharmacie   { border-left-color: #27ae60; }
    .map-score-card.grossiste   { border-left-color: #f39c12; }
    .map-score-card.clinique    { border-left-color: #8e44ad; }
    .map-score-card.hopital     { border-left-color: #2980b9; }
    .map-score-card.other       { border-left-color: #95a5a6; }
    .score-details { font-size: 11px; margin-top: 6px; display: flex; justify-content: space-around; border-top: 1px solid var(--border); padding-top: 6px; flex-wrap: wrap; }
    .score-details span { font-weight: 600; cursor: pointer; }
    .score-gps { color: #27ae60; }
    .score-nogps { color: #e74c3c; }

    /* ---------- Filter bar ---------- */
    .filter-bar { background: var(--surface); border: 1px solid var(--border); padding: 16px 18px; border-radius: var(--radius-md); margin-bottom: 16px; box-shadow: var(--shadow-card); }
    .filter-bar .form-control { border-radius: var(--radius-sm); border: 1px solid var(--border); }
    .filter-bar .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }
    .btn-lav-filter { background: var(--accent); border: none; color: #fff; font-weight: 600; border-radius: var(--radius-sm); padding: 7px 16px; }
    .btn-lav-filter:hover { background: var(--accent-dark); color: #fff; }

    /* ---------- Visits detail section shell ---------- */
    .visits-body { background: var(--canvas); border-radius: 0 0 var(--radius-lg) var(--radius-lg); padding: 20px; }
    .visits-subheading { margin-top: 26px; border-bottom: 2px solid var(--success); padding-bottom: 10px; color: var(--success); font-weight: 700; font-size: 15px; }
    .visits-table-wrap { background: var(--surface); padding: 12px; border-radius: var(--radius-md); box-shadow: var(--shadow-card); border: 1px solid var(--border); }

    /* ---------- Modal ---------- */
    #clientModal .modal-content { border-radius: var(--radius-lg); border: none; overflow: hidden; }
    #clientModal .modal-header { background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%); color: #fff; border: none; }
    #clientModal .modal-title { font-weight: 700; }
    #clientModal .modal-footer { border-top: 1px solid var(--border); }
</style>

<section class="content">
    <div class="row g-3 mb-2">
        <div class="col-lg-4 col-xs-12 mb-3 mb-lg-0">
            <div class="kpi-card">
                <div class="kpi-icon kpi-accent"><i class="fa fa-users"></i></div>
                <div>
                    <div class="kpi-value"><?php echo $totalClients; ?></div>
                    <div class="kpi-label">Clients</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12 mb-3 mb-lg-0">
            <div class="kpi-card">
              <div class="kpi-icon kpi-success"><i class="fa fa-check-circle"></i></div>
              <div>
                <div class="kpi-value"><?php echo $nbAffecter; ?> <span style="font-size:14px;color:var(--muted);font-weight:600;">(<?php echo $pctAffecter; ?>%)</span></div>
                <div class="kpi-label">N&deg; clients affect&eacute;s</div>
              </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="kpi-card">
              <div class="kpi-icon kpi-warning"><i class="fa fa-user-plus"></i></div>
              <div>
                  <div class="kpi-value"><?php echo $nbNonAffecter; ?> <span style="font-size:14px;color:var(--muted);font-weight:600;">(<?php echo $pctNonAffecter; ?>%)</span></div>
                <div class="kpi-label">N&deg; Clients non affect&eacute;s</div>
              </div>
            </div>
      </div>
     </div>

    <div class="row">
        <div class="col-md-3">
            <div class="lav-card accent-top profile-card">
                <div class="lav-card-body box-profile">
                    <h3 class="profile-username text-center">
                        <?php
                        if ($type == 'region') echo $secteur[0]['Secteur']['code_region'];
                        else if ($type == 'ville') echo $secteur[0]['Secteur']['code_region'] . $secteur[0]['Secteur']['code_ville'];
                        else echo $secteur[0]['Secteur']['code_region'] . $secteur[0]['Secteur']['code_ville'] . $secteur[0]['Secteur']['code_secteur'];
                        ?>
                    </h3>
                    <p class="text-muted text-center">
                        <?php
                        if ($type == 'region') echo $secteur[0]['Secteur']['region'];
                        else if ($type == 'ville') echo $secteur[0]['Secteur']['ville'];
                        else echo $secteur[0]['Secteur']['secteur'];
                        ?>
                    </p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Région</b> <a href="<?php echo $this->Html->url(array('action' => 'view', $secteur[0]['Secteur']['code_region'], 'region')); ?>" class="pull-right"><?php echo $secteur[0]['Secteur']['region']; ?></a>
                            <br><small class="text-muted"><i class="fa fa-map-o"></i> IMS : <?php echo !empty($secteur[0]['Secteur']['region_ims']) ? h($secteur[0]['Secteur']['region_ims']) : 'Non défini'; ?></small>
                        </li>
                        <li class="list-group-item">
                            <b>Ville</b> 
                            <a href="<?php echo ($type != 'region') ? $this->Html->url(array('action' => 'view', $secteur[0]['Secteur']['code_ville'], 'ville')) : '#'; ?>" class="pull-right">
                                <?php echo ($type != 'region') ? $secteur[0]['Secteur']['ville'] : '--'; ?>
                            </a>
                            <br><small class="text-muted"><i class="fa fa-map-o"></i> IMS : <?php echo !empty($secteur[0]['Secteur']['ville_ims']) ? h($secteur[0]['Secteur']['ville_ims']) : 'Non défini'; ?></small>
                        </li>
                        <li class="list-group-item">
                            <b>Secteur</b> <a class="pull-right">
                                <?php echo ($type == 'secteur') ? $secteur[0]['Secteur']['secteur'] : '--'; ?>
                            </a>
                            <br><small class="text-muted"><i class="fa fa-map-o"></i> IMS : <?php echo !empty($secteur[0]['Secteur']['secteur_ims']) ? h($secteur[0]['Secteur']['secteur_ims']) : 'Non défini'; ?></small>
                        </li>
                    </ul>
                    <a href="<?php echo $this->Html->url(array('action' => 'edit', $secteur[0]['Secteur']['id'])); ?>" class="btn btn-lav-block d-block text-center"><b>Editer</b></a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="lav-card">
                <div class="lav-card-header">
                    <i class="fa fa-bar-chart-o hdr-ic"></i>
                    <h3 class="lav-card-title">Potentialité des clients</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <div class="lav-card-body">
                    <div id="bar-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="lav-card accent-top">
                <div class="lav-card-header">
                    <i class="fa fa-bar-chart-o hdr-ic"></i>
                    <h3 class="lav-card-title">Type des clients</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <div class="lav-card-body">
                    <div id="donut-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="lav-card">
                <div class="lav-card-header">
                    <i class="fa fa-bar-chart-o hdr-ic"></i>
                    <h3 class="lav-card-title">Potentialité V1 des clients</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <div class="lav-card-body">
                    <div id="bar-chartv1" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CLIENTS TABLE -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if (!empty($secteur['Client'])): ?>
                <div class="lav-card">
                    <div class="lav-card-header">
                        <i class="fa fa-address-book hdr-ic"></i>
                        <h3 class="lav-card-title">La liste des clients du secteur</h3>
                    </div>
                    <div class="lav-card-body table-scroll" style="height: 243px;">
                        <table id="example1" class="display table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Liste planifié</th>
                                    <th>Type</th>
                                    <th>Type client</th>
                                    <th>Nom</th>
                                    <th>Potentialité</th>
                                    <th>Potentialité V2</th>
                                    <th>Spécialité</th>
                                    <th>Tendance</th>
                                    <th>Activité</th>
                                    <th>GPS</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($secteur['Client'] as $client): ?>
                                <tr>
                                    <td>
                                        <?php if (isset($client["Liste"])): ?>
                                            <?php echo $this->Html->link($client['Liste']['name'], array('controller' => 'listes', 'action' => 'view', $client['Liste']['id'])); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo isset($client["Type"]["name"]) ? _fixEncoding($client["Type"]["name"]) : ''; ?></td>
                                    <td><?php echo $client['Client']['type_pharmacie']; ?></td>
                                    <td><?php echo $client['Client']['nom'] . ' ' . $client['Client']['prenom']; ?></td>
                                    <td><?php echo $client['Client']['potentialite']; ?></td>
                                    <td><?php echo $client['Client']['potentialitev2']; ?></td>
                                    <td><?php echo isset($client['Category']['name']) ? $client['Category']['name'] : ''; ?></td>
                                    <td><?php echo isset($client['Category1']['name']) ? $client['Category1']['name'] : ''; ?></td>
                                    <td><?php echo $client['Client']['activite']; ?></td>
                                    <td>
                                        <?php if ($client['Client']['hasGps']): ?>
                                            <a href="javascript:void(0);" class="badge-lav badge-lav-<?php echo $client['Client']['inZone'] ? 'success' : 'warning'; ?> go-to-gps" data-id="<?php echo $client['Client']['id']; ?>">
                                                <i class="fa fa-map-marker"></i> <?php echo $client['Client']['inZone'] ? 'In zone' : 'Out zone'; ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="badge-lav badge-lav-danger">Non</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $this->Html->link(__('Voir'), array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- SPECIALITIES TABLE -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="lav-card">
                <div class="lav-card-header">
                    <i class="fa fa-stethoscope hdr-ic"></i>
                    <h3 class="lav-card-title">Spécialités</h3>
                </div>
                <div class="lav-card-body table-scroll" style="height: 243px;">
                    <table id="example2" class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Spécialités</th>
                                <?php foreach($allPots as $pot) echo "<th>$pot</th>"; ?>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $pottotal = array();
                            $totalglobal = 0;
                            foreach ($specialites as $value):
                                $stotal = 0;
                            ?>
                            <tr>
                                <td><?php echo $value["specialite"]; ?></td>
                                <?php 
                                foreach($allPots as $pot) {
                                    if(isset($value[$pot])) {
                                        if(!isset($pottotal[$pot])) $pottotal[$pot] = 0;
                                        $pottotal[$pot] += $value[$pot];
                                        echo "<td><a href='javascript:void(0);' class='open-client-modal' data-filter-type='specialite' data-specialite='".htmlspecialchars($value['specialite'], ENT_QUOTES)."' data-pot='$pot'>{$value[$pot]}</a></td>";
                                        $stotal += $value[$pot];
                                    } else {
                                        echo "<td>0</td>";
                                    }
                                }
                                $totalglobal += $stotal;
                                ?>
                                <td><?php echo $stotal; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th>Z TOTAL</th>
                                <?php 
                                $tGlobalSafe = $totalglobal > 0 ? $totalglobal : 1;
                                foreach($allPots as $pot) {
                                    $ptot = isset($pottotal[$pot]) ? $pottotal[$pot] : 0;
                                    echo "<th>" . $ptot . " (" . number_format(100*$ptot/$tGlobalSafe,0) . " %)</th>";
                                }
                                ?>
                                <th>TOTAL</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CARTE DU SECTEUR -->
    <div class="row">
        <div class="col-md-12">
            <div class="lav-card accent-top">
                <div class="lav-card-header">
                    <i class="fa fa-map hdr-ic"></i>
                    <h3 class="lav-card-title">Carte du secteur</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <div class="lav-card-body">
                    <div class="map-header-bar">
                        <i class="fa fa-map-marker"></i>
                        <strong>Zone géographique du secteur</strong>
                        <?php if ($type == 'secteur') echo '— ' . h($secteur[0]['Secteur']['secteur']); ?>
                        <span class="badge-map">
                            <i class="fa fa-users"></i> <?php echo $totalClients; ?> clients
                        </span>
                    </div>

                    <div class="map-score-container">
                        <!-- Iteration via Controller Pre-Calculated logic -->
                        <?php foreach ($scoreByType as $stName => $stData):
                            $val = htmlspecialchars($stName, ENT_QUOTES);
                            if ($stName === 'Total') {
                                // Default Style for Total Box
                                echo '<div class="map-score-card total">';
                                echo '<span class="score-icon"><i class="fa fa-users" style="color:#3c8dbc;"></i></span>';
                                echo '<div class="score-value open-client-modal" data-filter-type="global" data-filter-val="all" style="color:#3c8dbc;cursor:pointer;" title="Cliquez pour voir">' . $stData['count'] . '</div>';
                                echo '<div class="score-label">Total Clients</div>';
                                echo '<div class="score-details">';
                                echo '<span class="score-gps open-client-modal" data-filter-type="global" data-filter-val="gps_in" title="Dans la zone"><i class="fa fa-map-marker"></i> In: ' . $stData['in_zone'] . '</span>';
                                echo '<span class="score-gps open-client-modal" data-filter-type="global" data-filter-val="gps_out" title="Hors zone" style="color:#f39c12;"><i class="fa fa-map-marker"></i> Out: ' . $stData['out_zone'] . '</span>';
                                echo '<span class="score-nogps open-client-modal" data-filter-type="global" data-filter-val="nogps" title="Sans GPS"><i class="fa fa-map-marker" style="opacity:0.5;"></i> N/A: ' . $stData['no_gps'] . '</span>';
                                echo '</div></div>';
                            } else {
                                $meta = _getTypeStyle($stName, $typePatterns);
                                echo '<div class="map-score-card ' . $meta['class'] . '">';
                                echo '<span class="score-icon"><i class="fa ' . $meta['icon'] . '" style="color:' . $meta['color'] . ';"></i></span>';
                                echo '<div class="score-value open-client-modal" data-filter-type="type" data-filter-val="' . $val . '" style="color:' . $meta['color'] . ';cursor:pointer;" title="Cliquez pour voir">' . $stData['count'] . '</div>';
                                echo '<div class="score-label">' . h($stName) . '</div>';
                                echo '<div class="score-details">';
                                echo '<span class="score-gps open-client-modal" data-filter-type="type_gps_in" data-filter-val="' . $val . '" title="Dans la zone"><i class="fa fa-map-marker"></i> In: ' . $stData['in_zone'] . '</span>';
                                echo '<span class="score-gps open-client-modal" data-filter-type="type_gps_out" data-filter-val="' . $val . '" title="Hors zone" style="color:#f39c12;"><i class="fa fa-map-marker"></i> Out: ' . $stData['out_zone'] . '</span>';
                                echo '<span class="score-nogps open-client-modal" data-filter-type="type_nogps" data-filter-val="' . $val . '" title="Sans GPS"><i class="fa fa-map-marker" style="opacity:0.5;"></i> N/A: ' . $stData['no_gps'] . '</span>';
                                echo '</div></div>';
                            }
                        endforeach; ?>
                    </div>

                    <div id="map-secteur-view"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- SUIVI DES VISITES DU SECTEUR -->
    <div class="row">
        <div class="col-md-12">
            <div class="lav-card success-top">
                <div class="lav-card-header">
                    <i class="fa fa-car hdr-ic" style="color:var(--success);"></i>
                    <h3 class="lav-card-title">Suivi des visites du secteur</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <div class="visits-body">
                    
                    <!-- Date Filter -->
                    <div class="filter-bar">
                        <?php echo $this->Form->create('Secteur', array('url' => array('action' => 'view', $secteur[0]['Secteur']['id'], $type), 'class' => 'form-inline')); ?>
                        <strong style="margin-right:15px; font-size: 15px;"><i class="fa fa-calendar" style="color:var(--accent);"></i> Filtrer la période des visites :</strong>
                        <div class="form-group" style="margin-right:10px;">
                            <label style="margin-right:5px;">Du </label>
                            <input type="date" name="data[Secteur][date_debut]" value="<?php echo h($dateDebut); ?>" class="form-control input-sm">
                        </div>
                        <div class="form-group" style="margin-right:15px;">
                            <label style="margin-right:5px;">Au </label>
                            <input type="date" name="data[Secteur][date_fin]" value="<?php echo h($dateFin); ?>" class="form-control input-sm">
                        </div>
                        <button type="submit" class="btn btn-lav-filter btn-sm"><i class="fa fa-refresh"></i> Actualiser</button>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <!-- Visit Score Cards -->
                    <div class="map-score-container" style="flex-wrap: nowrap; overflow-x: auto;">
                        <div class="map-score-card total" style="border-left-color: #605ca8;">
                            <span class="score-icon"><i class="fa fa-list-alt" style="color:#605ca8;"></i></span>
                            <div class="score-value" style="color:#605ca8;"><?php echo $visitesStats['total']; ?></div>
                            <div class="score-label">Total Visites</div>
                        </div>
                        <div class="map-score-card pharmacie" style="border-left-color: #27ae60;">
                            <span class="score-icon"><i class="fa fa-check-circle" style="color:#27ae60;"></i></span>
                            <div class="score-value" style="color:#27ae60;"><?php echo $visitesStats['vraie']; ?></div>
                            <div class="score-label">Vraies Visites (&le;500m)</div>
                            <div class="score-details">
                                <span class="score-gps"><i class="fa fa-map-marker"></i> In: <?php echo $visitesStats['vraie_in']; ?></span>
                                <span class="score-gps" style="color:#f39c12;"><i class="fa fa-map-marker"></i> Out: <?php echo $visitesStats['vraie_out']; ?></span>
                            </div>
                        </div>
                        <div class="map-score-card medecin" style="border-left-color: #e74c3c;">
                            <span class="score-icon"><i class="fa fa-times-circle" style="color:#e74c3c;"></i></span>
                            <div class="score-value" style="color:#e74c3c;"><?php echo $visitesStats['fausse']; ?></div>
                            <div class="score-label">Fausses Visites (&gt;500m)</div>
                        </div>
                        <div class="map-score-card other">
                            <span class="score-icon"><i class="fa fa-question-circle" style="color:#95a5a6;"></i></span>
                            <div class="score-value" style="color:#95a5a6;"><?php echo $visitesStats['no_gps']; ?></div>
                            <div class="score-label">Visites Sans GPS</div>
                        </div>
                    </div>

                    <!-- MAP Visites -->
                    <div class="map-header-bar visits-bar" style="margin-top: 15px;">
                        <i class="fa fa-map-o"></i> <strong>Localisation des visites réelles</strong>
                    </div>
                    <div id="map-visites-view" style="width: 100%; height: 500px; border-radius: 10px; border: 1px solid var(--border); margin-bottom: 20px;"></div>

                    <!-- TABLE Visites -->
                    <h4 class="visits-subheading">
                        <i class="fa fa-list"></i> <strong>Détail des visites effectuées dans la période</strong>
                    </h4>
                    <div class="table-responsive visits-table-wrap">
                        <table id="example3" class="display table table-bordered table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="display:none;">Date Sort</th>
                                    <th>Date</th>
                                    <th>Délégué</th>
                                    <th>Client Visité</th>
                                    <th>Commentaire</th>
                                    <th>Distance du Client</th>
                                    <th>Statut GPS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tableVisites as $tv): ?>
                                <tr>
                                    <td style="display:none;"><?php echo date('Y-m-d H:i:s', strtotime($tv['date'])); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($tv['date'])); ?></td>
                                    <td><?php echo h($tv['user']); ?></td>
                                    <td><strong><?php echo h($tv['client']); ?></strong></td>
                                    <td style="font-size: 13px; color: #555;"><?php echo mb_substr(strip_tags(str_replace('<br />', ' - ', $tv['comment'])), 0, 150) . (strlen($tv['comment']) > 150 ? '...' : ''); ?></td>
                                    <td>
                                        <?php if ($tv['distance'] !== 'N/A' && intval($tv['distance']) <= 500): ?>
                                            <b class="text-success"><?php echo h($tv['distance']); ?></b>
                                        <?php elseif ($tv['distance'] !== 'N/A'): ?>
                                            <b class="text-danger"><?php echo h($tv['distance']); ?></b>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!$tv['hasGps']): ?>
                                            <span class="badge-lav badge-lav-neutral"><i class="fa fa-ban"></i> N/A</span>
                                        <?php elseif ($tv['isVraie']): ?>
                                            <span class="badge-lav badge-lav-success"><i class="fa fa-check"></i> Vraie</span>
                                            <?php if ($tv['inZone']): ?>
                                                <span class="badge-lav badge-lav-info"><i class="fa fa-map-marker"></i> In zone</span>
                                            <?php else: ?>
                                                <span class="badge-lav badge-lav-warning"><i class="fa fa-map-marker"></i> Out zone</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge-lav badge-lav-danger"><i class="fa fa-times"></i> Fausse</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
  
    <!-- MODAL BROWSER CLIENTS -->
    <div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel">
      <div class="modal-dialog modal-lg" role="document" style="width: 90%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;opacity:1;"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="clientModalLabel"><i class="fa fa-users"></i> Liste détaillée des clients</h4>
          </div>
          <div class="modal-body">
             <div class="table-responsive">
                <table id="modalClientTable" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nom</th>
                            <th>Spécialité</th>
                            <th>Potentialité</th>
                            <th>Potentialité V2</th>
                            <th>GPS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
</section>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    $(function () {
        $('.display').DataTable({
            "paging": true, "lengthChange": false, "searching": true, "ordering": true,
            "info": true, "autoWidth": false, "iDisplayLength": 50, dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'print']
        });
    });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
            ['Potentialité', 'Nombre de clients'],
            <?php 
            foreach($potsV2Counts as $pot => $count) {
                if ($totalClients > 0) {
                    echo "['" . addslashes($pot) . " (" . number_format((100*$count/$totalClients),0) . "%)', $count],\n";
                }
            }
            ?>
        ]);
        var options = { 'legend': 'top', seriesType: 'bars', series: {5: {type: 'line'}} };
        var chart = new google.visualization.ComboChart(document.getElementById('bar-chart'));
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawVisualizationv1);
    function drawVisualizationv1() {
        var data = google.visualization.arrayToDataTable([
            ['Potentialité', 'Nombre de clients'],
            <?php foreach($potsCounts as $pot => $count) {
                echo "['" . addslashes($pot) . " (" . number_format((100*$count/$totalClients),0) . "%)', $count],\n";
            }?>			
        ]);
        var options = { 'legend': 'top', seriesType: 'bars', series: {13: {type: 'line'}} };
        var chart = new google.visualization.ComboChart(document.getElementById('bar-chartv1'));
        chart.draw(data, options);
    }
</script>

<script>
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' + label + "<br>" + Math.round(series.percent) + "%</div>";
    }

    var donutData = [
    <?php
    $c = ["#3c8dbc", "#00c0ef", "#0073b7", "#3c5dbc", "#1c8dbc", "#f39c12", "#dd4b39", "#00a65a"];
    $i = 0;
    foreach ($typesCounts as $name => $count) {
        $fixedName = _fixEncoding($name);
        echo '{label: "' . addslashes($fixedName) . '", data: ' . $count . ', color: "' . $c[$i % count($c)] . '"},';
        $i++;
    }
    ?>
    ];

    $.plot("#donut-chart", donutData, {
        series: { pie: { show: true, radius: 1, innerRadius: 0.5, label: { show: true, radius: 2 / 3, formatter: labelFormatter, threshold: 0.1 } } },
        legend: { show: false }
    });
</script>

<script>
(function($) {
    'use strict';

    var sectorGps = <?php echo json_encode($polygonArray); ?>;
    var allSectorClients = <?php echo json_encode($jsClients); ?>;
    var clientsMapObj = <?php echo json_encode($jsClientsMap); ?>;
    
    // Transform map object into array for iteration
    var clientsMap = [];
    for (var key in clientsMapObj) {
        if (clientsMapObj.hasOwnProperty(key)) clientsMap.push(clientsMapObj[key]);
    }

    if ((!sectorGps || sectorGps.length === 0) && clientsMap.length === 0) {
        $('#map-secteur-view').html(
            '<div style="display:flex;align-items:center;justify-content:center;height:200px;color:#999;font-size:16px;">' +
            '<i class="fa fa-map-o" style="font-size:40px;margin-right:15px;opacity:0.4;"></i>' +
            '<div><strong>Aucune donnée GPS</strong><br><small>Aucune zone ni localisation client disponible</small></div></div>'
        );
        return;
    }

    var map = L.map('map-secteur-view').setView([31.7917, -7.0926], 6);
    var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' });
    var satLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19, attribution: '© Esri' });
    osmLayer.addTo(map);

    L.control.layers({ 'Plan': osmLayer, 'Satellite': satLayer }, {}, { position: 'topright' }).addTo(map);

    var bounds = L.latLngBounds([]);

    // Draw Polygon
    if (sectorGps && sectorGps.length > 0) {
        var latlngs = [];
        for (var i = 0; i < sectorGps.length; i++) latlngs.push([sectorGps[i][0], sectorGps[i][1]]);
        var polygon = L.polygon(latlngs, { color: '#3c8dbc', weight: 3, fillColor: '#3c8dbc', fillOpacity: 0.15, dashArray: '5, 8' }).addTo(map);
        polygon.bindPopup('<strong><i class="fa fa-map-marker"></i> Zone du secteur</strong><br><?php echo addslashes($secteur[0]["Secteur"]["secteur"]); ?>');
        bounds.extend(polygon.getBounds());
    }

    // Legend Setup
    var typePatterns = [
        { pattern: 'decin',     color: '#e74c3c' },
        { pattern: 'pharmacie', color: '#27ae60' },
        { pattern: 'grossiste', color: '#f39c12' },
        { pattern: 'clinique',  color: '#8e44ad' },
        { pattern: 'pital',     color: '#2980b9' }
    ];
    var defaultColor = '#95a5a6';
    var typeCounts = {};

    function getTypeColor(type) {
        var lower = type.toLowerCase();
        for (var i = 0; i < typePatterns.length; i++) {
            if (lower.indexOf(typePatterns[i].pattern) !== -1) return typePatterns[i].color;
        }
        return defaultColor;
    }

    function getMarkerIcon(type) {
        var color = getTypeColor(type);
        return L.divIcon({
            className: 'custom-marker',
            html: '<div style="background:' + color + ';width:22px;height:22px;border-radius:50%;border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.45);transition:transform 0.15s;cursor:pointer;" onmouseover="this.style.transform=\'scale(1.3)\'" onmouseout="this.style.transform=\'scale(1)\'"></div>',
            iconSize: [22, 22], iconAnchor: [11, 11], popupAnchor: [0, -14]
        });
    }

    var leafletMarkers = {};

    for (var j = 0; j < clientsMap.length; j++) {
        var c = clientsMap[j];
        var inZoneHtml = c.inZone 
            ? '<span class="label label-success" style="font-size:12px;"><i class="fa fa-map-marker"></i> In Zone</span>'
            : '<span class="label label-warning" style="font-size:12px;"><i class="fa fa-map-marker"></i> Out Zone</span>';
            
        var marker = L.marker([c.lat, c.lng], { icon: getMarkerIcon(c.type) }).addTo(map);
        marker.bindPopup(
            '<div style="min-width:180px;">' +
            '<strong style="font-size:15px;">' + c.nom + '</strong><br>' +
            '<span class="label label-info" style="font-size:12px;">' + c.type + '</span> ' + inZoneHtml + '<br>' +
            '<span class="label label-warning" style="font-size:12px;">' + c.pot + '</span><br>' +
            '<small style="color:#888; font-size:12px;"><i class="fa fa-briefcase"></i> ' + c.act + '</small><br>' +
            '<a href="/clients/view/' + c.id + '" target="_blank" class="btn btn-xs btn-default bg-white" style="margin-top:6px; border:1px solid #ccc; color:#333; font-weight:bold;">' +
            '<i class="fa fa-eye"></i> Fiche client</a></div>'
        );
        bounds.extend([c.lat, c.lng]);
        leafletMarkers[c.id] = marker;

        if (!typeCounts[c.type]) typeCounts[c.type] = 0;
        typeCounts[c.type]++;
    }

    var legend = L.control({ position: 'bottomright' });
    legend.onAdd = function() {
        var div = L.DomUtil.create('div', 'map-legend');
        div.innerHTML = '<strong><i class="fa fa-list"></i> Légende</strong><br>';
        if (sectorGps && sectorGps.length > 0) div.innerHTML += '<i style="background:#3c8dbc;"></i> Zone du secteur<br>';
        for (var type in typeCounts) {
            div.innerHTML += '<i style="background:' + getTypeColor(type) + ';"></i> ' + type + ' (' + typeCounts[type] + ')<br>';
        }
        return div;
    };
    legend.addTo(map);

    if (bounds.isValid()) map.fitBounds(bounds, { padding: [40, 40], maxZoom: 15 });
    setTimeout(function() { map.invalidateSize(); }, 500);

    // Modal Interaction Logic
    var modalTable;
    function renderModalTable(filtered) {
        if (modalTable) modalTable.destroy();
        var tbodyHTML = '';
        for (var i=0; i<filtered.length; i++) {
            var c = filtered[i];
            var btnUrl = '<?php echo $this->Html->url(array("controller" => "clients", "action" => "view")); ?>/' + c.id;
            var gpsBadge = c.hasGps ? (c.inZone ? '<span class="label label-success">In Zone</span>' : '<span class="label label-warning">Out Zone</span>') : '<span class="label label-danger">Non</span>';
            tbodyHTML += '<tr><td>'+c.type+'</td><td>'+c.nom+'</td><td>'+c.spec+'</td><td>'+c.pot+'</td><td>'+c.potv2+'</td><td>'+gpsBadge+'</td><td><a href="'+btnUrl+'" class="btn btn-xs btn-primary">Voir</a></td></tr>';
        }
        $('#modalClientTable tbody').html(tbodyHTML);
        
        modalTable = $('#modalClientTable').DataTable({
            "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "iDisplayLength": 10,
            "language": { "sProcessing": "Traitement...", "sSearch": "Rechercher:", "sLengthMenu": "Afficher _MENU_ éléments", "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_", "sInfoEmpty": "0 à 0 sur 0", "sZeroRecords": "Aucun résultat", "oPaginate": { "sFirst": "Premier", "sPrevious": "Préc.", "sNext": "Suiv.", "sLast": "Dernier" } }
        });
        $('#clientModal').modal('show');
    }

    $('.open-client-modal').on('click', function(e) {
        e.preventDefault();
        var fType = $(this).data('filter-type');
        var fVal  = $(this).data('filter-val');
        var fSpec = $(this).data('specialite');
        var fPot  = $(this).data('pot');
        var filtered = [];

        if (fType === 'global') {
            if (fVal === 'all') filtered = allSectorClients;
            else if (fVal === 'gps_in') filtered = allSectorClients.filter(function(c) { return c.hasGps && c.inZone; });
            else if (fVal === 'gps_out') filtered = allSectorClients.filter(function(c) { return c.hasGps && !c.inZone; });
            else if (fVal === 'nogps') filtered = allSectorClients.filter(function(c) { return !c.hasGps; });
        } else if (fType === 'type' || fType === 'type_gps_in' || fType === 'type_gps_out' || fType === 'type_nogps') {
            filtered = allSectorClients.filter(function(c) { return c.type === fVal; });
            if (fType === 'type_gps_in') filtered = filtered.filter(function(c) { return c.hasGps && c.inZone; });
            if (fType === 'type_gps_out') filtered = filtered.filter(function(c) { return c.hasGps && !c.inZone; });
            if (fType === 'type_nogps') filtered = filtered.filter(function(c) { return !c.hasGps; });
        } else if (fType === 'specialite') {
            filtered = allSectorClients.filter(function(c) { return c.spec === fSpec && c.pot === fPot; });
        }
        
        var title = '<i class="fa fa-users"></i> Liste des clients';
        if (fType === 'specialite') title += ' - ' + fSpec + ' (' + fPot + ')';
        else if (fVal && fVal !== 'all' && fVal !== 'gps_in' && fVal !== 'gps_out' && fVal !== 'nogps') title += ' - ' + fVal;
        $('#clientModalLabel').html(title);
        renderModalTable(filtered);
    });

    $('.go-to-gps').on('click', function(e){
        e.preventDefault();
        var cid = $(this).data('id');
        var targetMarker = leafletMarkers[cid];
        if (targetMarker) {
            $('html, body').animate({ scrollTop: $("#map-secteur-view").offset().top - 100 }, 600);
            map.flyTo(targetMarker.getLatLng(), 16, { duration: 1 });
            setTimeout(function() { targetMarker.openPopup(); }, 1000);
        }
    });

    // ==========================================
    // VISITES LEAFLET MAP
    // ==========================================
    var allVisitesList = <?php echo json_encode($jsVisitesMap); ?>;
    
    // Only init visits map if we have any coords or polygon
    if (sectorGps.length > 0 || allVisitesList.length > 0) {
        var mapVisits = L.map('map-visites-view').setView([31.7917, -7.0926], 6);
        var osmLayerV = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 });
        var satLayerV = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19 });
        osmLayerV.addTo(mapVisits);
        L.control.layers({ 'Plan': osmLayerV, 'Satellite': satLayerV }, {}, { position: 'topright' }).addTo(mapVisits);
        
        var boundsV = L.latLngBounds([]);

        // Polygon
        if (sectorGps && sectorGps.length > 0) {
            var latlngsV = [];
            for (var i = 0; i < sectorGps.length; i++) latlngsV.push([sectorGps[i][0], sectorGps[i][1]]);
            var polygonV = L.polygon(latlngsV, { color: '#00a65a', weight: 3, fillColor: '#00a65a', fillOpacity: 0.15, dashArray: '5, 8' }).addTo(mapVisits);
            polygonV.bindPopup('<strong><i class="fa fa-map-marker"></i> Zone du secteur</strong>');
            boundsV.extend(polygonV.getBounds());
        }

        // Visits markers
        function getVisitIcon(isVraie, inZone) {
            var color = '#e74c3c'; // Fausse = Rouge
            if (isVraie) {
                color = inZone ? '#27ae60' : '#f39c12'; // Vraie In = Vert, Vraie Out = Orange
            }
            return L.divIcon({
                className: 'custom-marker',
                html: '<div style="background:' + color + ';width:16px;height:16px;border-radius:50%;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,0.5);"></div>',
                iconSize: [16, 16], iconAnchor: [8, 8], popupAnchor: [0, -10]
            });
        }

        for (var k = 0; k < allVisitesList.length; k++) {
            var v = allVisitesList[k];
            var markerV = L.marker([v.lat, v.lng], { icon: getVisitIcon(v.isVraie, v.inZone) }).addTo(mapVisits);
            
            var badgeHtml = v.isVraie 
                ? (v.inZone ? '<span class="label label-success">Vraie (In Zone)</span>' : '<span class="label label-warning">Vraie (Out Zone)</span>')
                : '<span class="label label-danger">Fausse</span>';

            markerV.bindPopup(
                '<div style="min-width:180px;">' +
                '<strong style="font-size:15px; color:#333;">Client: ' + v.client + '</strong><br>' +
                '<small style="color:#555; font-size:12px;"><i class="fa fa-user"></i> ' + v.user + '</small><br>' +
                '<small style="color:#888; font-size:12px;"><i class="fa fa-clock-o"></i> ' + v.date + '</small><hr style="margin:5px 0;">' +
                badgeHtml +
                '</div>'
            );
            boundsV.extend([v.lat, v.lng]);
        }

        // Visits Legend
        var legendV = L.control({ position: 'bottomright' });
        legendV.onAdd = function() {
            var div = L.DomUtil.create('div', 'map-legend');
            div.innerHTML = '<strong><i class="fa fa-info-circle"></i> Légende Visites</strong><br>';
            div.innerHTML += '<i style="background:#27ae60;"></i> Vraie (In Zone)<br>';
            div.innerHTML += '<i style="background:#f39c12;"></i> Vraie (Out Zone)<br>';
            div.innerHTML += '<i style="background:#e74c3c;"></i> Fausse (> 500m)<br>';
            return div;
        };
        legendV.addTo(mapVisits);

        if (boundsV.isValid()) mapVisits.fitBounds(boundsV, { padding: [40, 40], maxZoom: 15 });
        setTimeout(function() { mapVisits.invalidateSize(); }, 600);
    }

})(jQuery);
</script>
