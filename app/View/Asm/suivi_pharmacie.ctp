<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
echo $this->Html->css('select2.min'); // Pour le multiselect
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('select2.full.min');

// Extensions DataTables Export (Excel)
echo $this->Html->script('https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js');
echo $this->Html->script('https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js');
echo $this->Html->css('https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css');
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
        box-shadow:var(--shadow-card); margin-bottom:20px; position:relative; overflow:hidden;
    }
    .box .box-header.with-border{ border-bottom:none; padding:22px 24px 8px 24px; }
    .box .box-body{ padding:16px 24px 24px 24px; }

    .section-header{ display:flex; align-items:center; gap:16px; }
    .section-icon{
        flex:0 0 auto; width:56px; height:56px; border-radius:50%;
        background:var(--accent-light); color:var(--accent-dark);
        display:flex; align-items:center; justify-content:center; font-size:22px;
    }
    .box-title-main{ margin:0; font-size:22px; font-weight:800; color:var(--text-dark); }
    .box-subtitle{ margin:2px 0 0 0; font-size:14px; color:var(--accent); }

    .header-decor{
        position:absolute; top:18px; right:24px; color:var(--accent-pale); font-size:34px; opacity:.9;
    }

    /* ---------- Filter form ---------- */
    .filter-inline{
        margin-bottom: 22px !important; background: var(--accent-light) !important;
        padding: 20px !important; border-radius: var(--radius-md) !important;
        border: 1px solid var(--accent-pale) !important;
        display: flex !important; flex-wrap: wrap !important; align-items: flex-end !important; gap: 18px !important;
    }
    .filter-inline .filter-field{ display:flex; flex-direction:column; }
    .filter-inline label{
        margin:0 0 6px 0 !important; white-space:nowrap; font-weight:700; font-size:13px; color:var(--text-dark);
        display:flex; align-items:center; gap:6px;
    }
    .filter-inline label i{ color:var(--accent-dark); }
    .filter-inline input.form-control,
    .filter-inline select.form-control{
        width:auto !important; border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; box-shadow:none !important; font-size:14px; min-height:42px; color:var(--text-dark);
    }
    .filter-inline input.form-control:focus,
    .filter-inline select.form-control:focus{ border-color:var(--accent) !important; }
    .filter-inline .select2-container .select2-selection--multiple{
        border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; min-height:42px;
    }
    .filter-inline .btn-primary{
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        padding:10px 20px !important; font-weight:600; font-size:14px; box-shadow:none !important;
        align-self:center !important;
    }
    .filter-inline .btn-primary:hover{ background:var(--accent-dark) !important; }

    /* ---------- Custom date pickers (vanilla JS, no external dependency) ---------- */
    .filter-inline .date-field-wrap{ position:relative; }
    .filter-inline input.lb-date-input{
        border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; padding:9px 38px 9px 12px !important; font-size:14px; min-height:42px;
        box-shadow:none !important; color:var(--text-dark); cursor:pointer; width:150px;
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

    /* ---------- Table container ---------- */
    .table-responsive{
        padding:0 !important; border-radius:var(--radius-md) !important; border:1px solid var(--border-color) !important;
        overflow:hidden;
    }
    .dt-buttons{ padding:16px 16px 0 16px; margin-bottom:0 !important; }
    .dataTables_filter{ padding:16px 16px 0 16px; margin:0 !important; }
    .dataTables_filter label{ display:flex !important; align-items:center; width:100%; }
    .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px 9px 34px !important; min-width:230px; font-size:13.5px !important;
        background:#fafafa url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 12px center;
        background-size:14px 14px; margin-left:8px;
    }
    .dataTables_filter input:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }

    .dt-button{
        width:auto !important; float:none !important; margin:0 !important;
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:13.5px !important; font-weight:600; line-height:1 !important;
        padding:9px 16px !important; border-radius:var(--radius-sm) !important;
        background:var(--mint-light) !important; color:var(--mint-dark) !important;
        border:1px solid #cdeee1 !important; box-shadow:none !important;
    }
    .dt-button:hover{ background:#d8f4e9 !important; }

    #pharmaciesTable{ width:100% !important; border-collapse:collapse !important; margin-top:16px !important; }
    #pharmaciesTable thead th{
        background:var(--accent-pale) !important; color:var(--accent-dark) !important;
        font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:1px solid #ddd6f7 !important; padding:12px 12px !important; white-space:nowrap;
    }
    #pharmaciesTable tbody td{
        border:1px solid var(--border-color) !important; padding:11px 12px !important;
        font-size:13px; color:var(--text-dark); vertical-align:middle;
    }
    #pharmaciesTable.table-striped tbody tr:nth-of-type(odd){ background:#fcfbff; }
    #pharmaciesTable tbody tr:hover td{ background:var(--accent-light) !important; }
    #pharmaciesTable a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    #pharmaciesTable a:hover{ color:var(--accent-dark); text-decoration:underline; }

    /* ---------- Badges / labels ---------- */
    .label-primary{ background:var(--accent-pale) !important; color:var(--accent-dark) !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .label-warning{ background:#fff4e2 !important; color:#e08a17 !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .label-success{ background:var(--mint-light) !important; color:var(--mint-dark) !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .label-danger{ background:#fdeaf1 !important; color:#e0457b !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .label-default{ background:var(--border-color) !important; color:var(--text-muted) !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .btn-visites-detail.btn-success{
        background:var(--mint-light) !important; color:var(--mint-dark) !important; border:1px solid #cdeee1 !important;
        border-radius:20px !important; font-weight:700; box-shadow:none !important;
    }
    .btn-visites-detail.btn-success:hover{ background:#d8f4e9 !important; }

    /* ---------- Empty state ---------- */
    #pharmaciesTable .dataTables_empty{ padding:56px 20px !important; text-align:center; border:1px solid var(--border-color) !important; }
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:8px; color:var(--text-muted); }
    .dt-empty-state .dt-empty-icon{
        width:60px; height:60px; border-radius:50%; background:var(--accent-light); color:var(--accent-dark);
        display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:4px;
    }
    .dt-empty-state .dt-empty-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .dt-empty-state .dt-empty-sub{ font-size:12.5px; }

    /* ---------- Footer / pagination ---------- */
    .dataTables_wrapper .dataTables_info{ color:var(--text-muted) !important; font-size:13px !important; padding:16px !important; }
    .dataTables_wrapper .dataTables_paginate{ padding:12px 16px !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 14px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ color:var(--text-muted) !important; opacity:.5; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled){
        background:var(--accent-light) !important; color:var(--accent-dark) !important; border-color:var(--accent) !important;
    }

    /* ---------- Modal ---------- */
    .modal-content{ border-radius:var(--radius-md); overflow:hidden; border:none; }
    .modal-body table.table thead th{ background:var(--accent-light); color:var(--text-dark); font-size:12.5px; text-transform:uppercase; letter-spacing:.02em; border:none; }
    .modal-footer .btn-default{ border-radius:var(--radius-sm); }
    .btn-show-map.btn-info{
        background:var(--accent-light) !important; color:var(--accent-dark) !important; border:1px solid var(--accent-pale) !important;
        border-radius:20px !important; box-shadow:none !important;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-medkit"></i></span>
                    <div>
                        <h3 class="box-title-main">Suivi Pharmacies</h3>
                        <p class="box-subtitle">(visitées &amp; non visitées)</p>
                    </div>
                </div>
                <span class="header-decor"><i class="fa fa-plus-square"></i></span>
            </div>
            <div class="box-body">
                <!-- Filtres -->
                <form action="<?php echo $this->Html->url(array('action' => 'suivi_pharmacie')); ?>" method="post" class="filter-inline">

                    <div class="filter-field">
                        <label for="date_debut"><i class="fa fa-calendar-o"></i>Du :</label>
                        <div class="date-field-wrap">
                            <input type="text" name="data[Filtre][date_debut]" id="date_debut" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_debut); ?>">
                            <i class="fa fa-calendar date-field-icon"></i>
                        </div>
                    </div>

                    <div class="filter-field">
                        <label for="date_fin"><i class="fa fa-calendar-o"></i>Au :</label>
                        <div class="date-field-wrap">
                            <input type="text" name="data[Filtre][date_fin]" id="date_fin" class="form-control lb-date-input" autocomplete="off" value="<?php echo h($date_fin); ?>">
                            <i class="fa fa-calendar date-field-icon"></i>
                        </div>
                    </div>

                    <div class="filter-field">
                        <label for="ligne_id"><i class="fa fa-list-ul"></i>Ligne :</label>
                        <select name="data[Filtre][ligne_id]" id="ligne_id" class="form-control" style="width: 180px;">
                            <option value="">-- Choisir une ligne --</option>
                            <?php foreach ($lignes_list as $lid => $lname): ?>
                                <option value="<?php echo $lid; ?>" <?php echo ($selected_ligne == $lid) ? 'selected' : ''; ?>>
                                    <?php echo h($lname); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="filter-field">
                        <label for="users"><i class="fa fa-users"></i>Utilisateurs :</label>
                        <select name="data[Filtre][users][]" id="users" class="form-control select2" multiple="multiple" data-placeholder="Sélectionner un ou plusieurs VMP" style="width: 380px;">
                            <?php foreach ($users_list as $id => $name): ?>
                                <option value="<?php echo $id; ?>" <?php echo (in_array($id, $selected_users)) ? 'selected' : ''; ?>>
                                    <?php echo h($name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtrer</button>
                </form>

                <!-- Tableau Principal -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="pharmaciesTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>VM</th>
                                <th>Code Client</th>
                                <th>Code Wavesoft</th>
                                <th>Nom</th>
                                <th>Spécialité</th>
                                <th>Secteur</th>
                                <th>GSM</th>
                                <th>Fixe</th>
                                <th>Adresse</th>
                                <th>Nb Visite</th>
                                <th>Visite instantanée (%)</th>
                                <th>Présence dans la liste</th>
                                <th>Localisée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $user_id => $clients): ?>
                                <?php foreach ($clients as $client_id => $row):
                                    // Calculs
                                    $nb_visites = $row['Client']['nb_visite'];
                                    $nb_instant = $row['Client']['instantane'];
                                    $pourcentage = 0;
                                    if ($nb_visites > 0) {
                                        $pourcentage = round(($nb_instant / $nb_visites) * 100, 2);
                                    }

                                    // Localisée : Est-ce qu'elle a des coordonnées GPS renseignées sur sa fiche client ?
                                    $is_localisee = ($row['Client']['localiser'] > 0 || (!empty($row['Client']['latitude']) && !empty($row['Client']['longitude']))) ? 'Oui' : 'Non';

                                    // Présence : vérifie si le user attitré de la pharm correspond au user_id qui a fait la visite
                                    $presence_liste = isset($row['Client']['affecter']) && $row['Client']['affecter'] == 1 ? 'Oui' : 'Non';
                                ?>
                                    <tr>
                                        <td><?php echo h($users_list[$user_id]); ?></td>
                                        <td><?php echo $row['Client']['id']; ?></td>
                                        <td><?php echo h($row['Client']['code_wavsoft']); ?></td>
                                        <?php
                                        $url_client = $this->Html->url(array(
                                            'controller' => 'clients',
                                            'action' => 'view',
                                            $row['Client']['id'],
                                            $date_debut,
                                            $date_fin
                                        ));
                                        ?>
                                        <td>
                                            <a href="<?php echo $url_client; ?>" target="_blank">
                                                <?php echo $row['Client']['nom'] . " " . $row['Client']['prenom']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo h($row['Client']['category']); ?></td>
                                        <td><?php echo h($row['Client']['secteur']); ?></td>
                                        <td><?php echo h($row['Client']['tel']); ?></td>
                                        <td><?php echo h($row['Client']['fixe']); ?></td>
                                        <td style="font-size:12px; max-width:200px;"><?php echo h($row['Client']['adress']); ?></td>

                                        <td style="text-align:center; font-weight:bold;">
                                            <?php if ($nb_visites > 0): ?>
                                                <?php
                                                $visiteData = array(
                                                    'client_nom' => $row['Client']['nom'],
                                                    'client_lat' => $row['Client']['latitude'],
                                                    'client_lng' => $row['Client']['longitude'],
                                                    'vm_nom' => $users_list[$user_id],
                                                    'visites' => isset($row['DetailVisites']) ? $row['DetailVisites'] : array()
                                                );
                                                ?>
                                                <button type="button" class="btn btn-success btn-xs btn-visites-detail"
                                                    data-toggle="modal" data-target="#modalDetailVisites"
                                                    data-info='<?php echo htmlspecialchars(json_encode($visiteData), ENT_QUOTES, 'UTF-8'); ?>'>
                                                    <?php echo $nb_visites; ?> <i class="fa fa-search-plus"></i>
                                                </button>
                                            <?php else: ?>
                                                <span class="label label-default" style="font-size:13px;">0</span>
                                            <?php endif; ?>
                                        </td>

                                        <td style="text-align:center;">
                                            <?php if ($nb_visites > 0): ?>
                                                <?php echo $pourcentage; ?>%
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        <td style="text-align:center;">
                                            <?php if ($presence_liste == 'Oui'): ?>
                                                <span class="label label-primary">Oui</span>
                                            <?php else: ?>
                                                <span class="label label-warning">Non</span>
                                            <?php endif; ?>
                                        </td>

                                        <td style="text-align:center;">
                                            <?php if ($is_localisee == 'Oui'): ?>
                                                <span class="label label-success">Oui</span>
                                            <?php else: ?>
                                                <span class="label label-danger">Non</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclusion de Leaflet pour la carte gratuite -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<!-- Modal pour les détails des visites -->
<div class="modal fade" id="modalDetailVisites" tabindex="-1" role="dialog" aria-labelledby="modalDetailVisitesLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #9b90e0; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDetailVisitesLabel">Détails des visites</h4>
            </div>
            <div class="modal-body">
                <h5 id="modalClientNom" style="font-weight: bold; color: #333;"></h5>
                <h6 id="modalVmNom" style="color: #666; margin-bottom: 20px;"></h6>

                <!-- Tableau des visites -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tableModalVisites">
                        <thead>
                            <tr>
                                <th>Date et Heure</th>
                                <th>Distance Pharmacie/Visite</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyModalVisites">
                            <!-- Rempli en JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Conteneur pour la carte Leaflet -->
                <hr>
                <h5 style="font-weight: bold; margin-top:20px;">Localisation sur la Carte</h5>
                <div id="mapVisite" style="height: 350px; width: 100%; border: 1px solid #ccc; background-color: #eee; border-radius: 4px;"></div>
                <div id="mapWarning" style="color: red; display: none; margin-top: 10px; font-weight: bold;">
                    <i class="fa fa-warning"></i> Coordonnées GPS incomplètes pour afficher la carte.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<script>
    var map = null;
    var markers = [];

    // Fonction pour calculer la distance (similaire au PHP)
    function distanceEnMetres(lat1, lon1, lat2, lon2) {
        if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
        } else {
            var radlat1 = Math.PI * lat1 / 180;
            var radlat2 = Math.PI * lat2 / 180;
            var theta = lon1 - lon2;
            var radtheta = Math.PI * theta / 180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180 / Math.PI;
            dist = dist * 60 * 1.1515;
            dist = dist * 1.609344 * 1000;
            return Math.round(dist);
        }
    }

    // Afficher la carte et les points
    function afficherCarteVisite(clientLat, clientLng, visiteLat, visiteLng, clientNom) {
        // Cacher l'avertissement
        $('#mapWarning').hide();
        $('#mapVisite').show();

        // Si l'un des deux (client ou visite) n'a pas de data GPS
        if (!clientLat || !clientLng || parseFloat(clientLat) == 0) {
            $('#mapVisite').hide();
            $('#mapWarning').text("La Pharmacie n'a pas de coordonnées GPS enregistrées.").show();
            return;
        }

        if (!visiteLat || !visiteLng || parseFloat(visiteLat) == 0) {
            $('#mapVisite').hide();
            $('#mapWarning').text("Le VMP n'avait pas son GPS activé lors de cette visite.").show();
            return;
        }

        clientLat = parseFloat(clientLat);
        clientLng = parseFloat(clientLng);
        visiteLat = parseFloat(visiteLat);
        visiteLng = parseFloat(visiteLng);

        // Si la carte n'est pas encore initialisée
        if (map === null) {
            map = L.map('mapVisite').setView([clientLat, clientLng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
        }

        // Nettoyer les anciens marqueurs
        for (var i = 0; i < markers.length; i++) {
            map.removeLayer(markers[i]);
        }
        markers = [];

        // Icônes personnalisées
        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Marqueur Pharmacie
        var markerClient = L.marker([clientLat, clientLng], {
                icon: redIcon
            }).addTo(map)
            .bindPopup("<b>Pharmacie:</b> " + clientNom);
        markers.push(markerClient);

        // Marqueur Visite
        var markerVisite = L.marker([visiteLat, visiteLng]).addTo(map)
            .bindPopup("<b>Position du VM</b> lors de la validation");
        markers.push(markerVisite);

        // Ajuster la vue pour voir les deux points
        var group = new L.featureGroup(markers);
        var bounds = group.getBounds();

        // maxZoom: 15 empêche la carte de faire un zoom arrière complet mondial
        // si les deux points (Pharmacie et Visite) ont les mêmes coordonnées.
        map.fitBounds(bounds.pad(0.2), {
            maxZoom: 15
        });

        // Corriger le bug d'affichage de Leaflet dans les Modales
        setTimeout(function() {
            map.invalidateSize();
            // Refaire le fitBounds après que la modale ait fini de s'ouvrir pour avoir la vraie largeur
            map.fitBounds(bounds.pad(0.2), {
                maxZoom: 15
            });
        }, 300);
    }

    $(document).ready(function() {
        // Clic sur le bouton de détails des visites
        $('.btn-visites-detail').on('click', function() {
            var dataInfo = $(this).data('info');

            $('#modalClientNom').text("Pharmacie : " + dataInfo.client_nom);
            $('#modalVmNom').text("Visiteur : " + dataInfo.vm_nom);

            var tbody = $('#tbodyModalVisites');
            tbody.empty();

            $('#mapVisite').hide(); // Cacher la carte initialement
            $('#mapWarning').hide();

            if (dataInfo.visites && dataInfo.visites.length > 0) {
                $.each(dataInfo.visites, function(idx, visite) {

                    var dist = "Inconnue";
                    if (dataInfo.client_lat && dataInfo.client_lng && visite.latitude && visite.longitude) {
                        dist = distanceEnMetres(dataInfo.client_lat, dataInfo.client_lng, visite.latitude, visite.longitude) + " m";
                    } else {
                        dist = "GPS Indisponible";
                    }

                    // Bouton Voir sur la carte pour cette visite spécifique
                    var btnCarte = "<button class='btn btn-info btn-xs btn-show-map' " +
                        "data-clat='" + dataInfo.client_lat + "' data-clng='" + dataInfo.client_lng + "' " +
                        "data-vlat='" + visite.latitude + "' data-vlng='" + visite.longitude + "' " +
                        "data-cnom='" + dataInfo.client_nom.replace(/'/g, "\\'") + "'>" +
                        "<i class='fa fa-map-marker'></i> Voir sur Carte</button>";

                    var tr = "<tr>" +
                        "<td>" + visite.created + "</td>" +
                        "<td>" + dist + "</td>" +
                        "<td>" + btnCarte + "</td>" +
                        "</tr>";
                    tbody.append(tr);
                });

                // Si une seule visite, on dessine la carte direct
                if (dataInfo.visites.length === 1) {
                    afficherCarteVisite(
                        dataInfo.client_lat, dataInfo.client_lng,
                        dataInfo.visites[0].latitude, dataInfo.visites[0].longitude,
                        dataInfo.client_nom
                    );
                }

            } else {
                tbody.append("<tr><td colspan='3' class='text-center'>Aucun détail disponible (Visites peut-être trop anciennes).</td></tr>");
            }
        });

        // Clic sur Voir Carte (délégué car dynamique)
        $('#tbodyModalVisites').on('click', '.btn-show-map', function() {
            afficherCarteVisite(
                $(this).data('clat'), $(this).data('clng'),
                $(this).data('vlat'), $(this).data('vlng'),
                $(this).data('cnom')
            );
        });

        // Corriger l'affichage carte lors de l'ouverture compléte de la modale
        $('#modalDetailVisites').on('shown.bs.modal', function() {
            if (map !== null) {
                map.invalidateSize();
            }
        });

        // Initialiser select2 pour le choix multiple
        $('.select2').select2({
            language: "fr"
        });

        // Initialiser DataTables
        $('#pharmaciesTable').DataTable({
            "language": {
                "search": "",
                "searchPlaceholder": "Search...",
                "lengthMenu": "Afficher _MENU_ éléments",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtré depuis _MAX_ éléments au total)",
                "zeroRecords": "Aucune donnée ne correspond à votre sélection.",
                "emptyTable": '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-clipboard"></i></span><div class="dt-empty-title">Aucune donnée disponible</div><div class="dt-empty-sub">Aucune donnée ne correspond à votre sélection.</div></div>',
                "paginate": {
                    "previous": "Previous",
                    "next": "Next"
                }
            },
            "pageLength": 25,
            "order": [
                [0, "asc"],
                [3, "asc"]
            ], // Tier par VM puis Nom
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Exporter en Excel',
                className: 'btn btn-success',
                title: 'Suivi_Pharmacies_' + $('#date_debut').val() + '_au_' + $('#date_fin').val()
            }]
        });
    });

    // ---------- Themed date pickers (self-contained, no external library) ----------
    // Built from scratch so it never depends on a CDN being reachable.
    // Wrapped in its own IIFE, completely independent from the jQuery/DataTables/select2
    // init above, so an error in any of those can never prevent the calendars from initializing.
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

        function initAll() {
            ['date_debut', 'date_fin'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el && !LBCalendar.instances.some(function(inst){ return inst.input === el; })) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        }

        document.addEventListener('DOMContentLoaded', initAll);
        // In case this script runs after DOMContentLoaded already fired
        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            initAll();
        }
    })();
</script>
