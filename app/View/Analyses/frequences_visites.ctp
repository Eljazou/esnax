<?php
echo $this->Html->css('daterangepicker');
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->script('jquery-2.2.3.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('daterangepicker');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* ===== Design tokens (Metronic 8 / BS5 - lavender system) ===== */
    .pv-wrapper {
        --accent: #7C5CFA;
        --accent-2: #9b82fb;
        --accent-soft: #f1ecff;
        --accent-soft-2: #e5dbfe;
        --text: #2d2b45;
        --text-muted: #6a6785;
        --border: #ece7fb;
        --blue: #3b82f6;
        --blue-soft: #dbebfc;
        --green: #1f9d55;
        --green-soft: #e5f8ee;
        --red: #e6524d;
        --red-soft: #fdecec;
        font-family: 'Poppins', sans-serif;
        color: var(--text);
    }

    .pv-wrapper .card {
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(124, 92, 250, 0.08);
        margin-bottom: 24px;
    }

    .pv-wrapper .card-header {
        border-bottom: none;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 24px 14px 24px;
    }

    .pv-wrapper .card-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent-soft), var(--accent-soft-2));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 16px;
    }

    .pv-wrapper .card-icon.icon-blue {
        background: linear-gradient(135deg, var(--blue-soft), #c7dffb);
        color: var(--blue);
    }

    .pv-wrapper .card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text);
        margin: 0;
    }

    .pv-wrapper .card-body {
        padding: 6px 24px 24px 24px;
    }

    /* Period banner */
    .pv-date-banner {
        background: linear-gradient(90deg, var(--accent-soft) 0%, #fbfaff 100%);
        border-radius: 18px 18px 0 0;
        padding: 22px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin: -1px -1px 20px -1px;
    }

    .pv-date-banner .pv-date-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--accent);
        margin: 0;
    }

    .pv-wrapper .input-group {
        border: 1.5px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        min-width: 260px;
    }

    .pv-wrapper .input-group-text {
        background: #faf9ff;
        border: none;
        border-right: 1.5px solid var(--border);
        color: var(--accent);
    }

    .pv-wrapper .input-group .form-control {
        border: none;
        box-shadow: none;
        font-size: 14px;
        padding: 11px 16px;
    }

    .pv-wrapper .form-group label,
    .pv-wrapper label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 600;
        color: #454358;
        margin-bottom: 6px;
    }

    .pv-wrapper .form-group {
        margin-bottom: 18px;
    }

    .pv-wrapper .form-control,
    .pv-wrapper .select2-container .select2-selection {
        border-radius: 12px !important;
        border: 1.5px solid var(--border) !important;
        box-shadow: none !important;
        min-height: 42px;
        width: 100% !important;
    }

    .pv-wrapper .select2-selection__rendered {
        line-height: 40px !important;
        padding-left: 14px !important;
    }

    .pv-wrapper .select2-selection__arrow {
        height: 40px !important;
    }

    .pv-wrapper .select2-container {
        width: 100% !important;
    }

    .pv-wrapper .btn-search {
        background: linear-gradient(90deg, var(--accent), var(--accent-2)) !important;
        border: none !important;
        border-radius: 999px !important;
        padding: 11px 26px !important;
        font-weight: 600;
        font-size: 14px;
        color: #fff !important;
        box-shadow: 0 6px 18px rgba(124, 92, 250, 0.3) !important;
    }

    .pv-wrapper .btn-search:hover {
        filter: brightness(0.95);
        color: #fff !important;
    }

    .pv-wrapper .my-btn-excel {
        background: var(--green-soft) !important;
        color: var(--green) !important;
        border-radius: 999px !important;
        border: none !important;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 18px !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .pv-wrapper .my-btn-excel:hover {
        filter: brightness(0.97);
    }

    .buttons-excel {
        display: none;
    }

    /* Stat cards */
    .pv-stats-row {
        display: flex;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .pv-stat-card {
        flex: 1;
        min-width: 150px;
        text-align: left;
        padding: 20px;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .pv-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pv-stat-icon svg {
        width: 18px;
        height: 18px;
    }

    .pv-stat-card h4 {
        margin: 0;
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .pv-stat-card .num {
        font-size: 24px;
        font-weight: 700;
    }

    .pv-stat-card.stat-clients { background: var(--accent-soft); }
    .pv-stat-card.stat-clients .pv-stat-icon { background: var(--accent-soft-2); }
    .pv-stat-card.stat-clients .pv-stat-icon svg { stroke: var(--accent); }
    .pv-stat-card.stat-clients .num { color: var(--accent); }

    .pv-stat-card.stat-visites { background: var(--blue-soft); }
    .pv-stat-card.stat-visites .pv-stat-icon { background: #c7dffb; }
    .pv-stat-card.stat-visites .pv-stat-icon svg { stroke: var(--blue); }
    .pv-stat-card.stat-visites .num { color: var(--blue); }

    .pv-stat-card.stat-moyenne { background: var(--accent-soft); }
    .pv-stat-card.stat-moyenne .pv-stat-icon { background: var(--accent-soft-2); }
    .pv-stat-card.stat-moyenne .pv-stat-icon svg { stroke: var(--accent); }
    .pv-stat-card.stat-moyenne .num { color: var(--accent); }

    .pv-stat-card.stat-periode { background: var(--red-soft); }
    .pv-stat-card.stat-periode .pv-stat-icon { background: #fbdada; }
    .pv-stat-card.stat-periode .pv-stat-icon svg { stroke: var(--red); }
    .pv-stat-card.stat-periode .num { color: var(--red); }

    .pv-stat-card.stat-optimal { background: var(--green-soft); }
    .pv-stat-card.stat-optimal .pv-stat-icon { background: #d6f3e4; }
    .pv-stat-card.stat-optimal .pv-stat-icon svg { stroke: var(--green); }
    .pv-stat-card.stat-optimal .num { color: var(--green); }

    /* Legend */
    .pv-legend {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin: 15px 0 20px;
        flex-wrap: wrap;
        background: #faf9ff;
        border-radius: 12px;
        padding: 14px 18px;
    }

    .pv-legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 6px 14px;
    }

    .pv-legend-box {
        width: 14px;
        height: 14px;
        border-radius: 4px;
    }

    .pv-chart-container {
        height: 500px;
        margin: 10px auto 0;
        position: relative;
    }

    /* Table */
    .pv-wrapper table.dataTable thead th {
        background: #faf9ff !important;
        color: #4a4863 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid var(--border) !important;
    }

    .pv-wrapper table.dataTable tbody td {
        font-size: 13.5px;
        color: #454358;
        vertical-align: middle;
    }

    .pv-wrapper table.table-striped > tbody > tr:nth-of-type(odd) > * {
        background: #fbfaff;
    }

    .pv-wrapper .badge-pill-success { background: #3fb37f; border-radius: 999px; padding: 5px 12px; font-weight: 500; }
    .pv-wrapper .badge-pill-warning { background: #e6b93d; border-radius: 999px; padding: 5px 12px; font-weight: 500; }
    .pv-wrapper .badge-pill-danger  { background: #f4544e; border-radius: 999px; padding: 5px 12px; font-weight: 500; }

    .pv-wrapper .dataTables_filter input {
        border-radius: 999px !important;
        border: 1.5px solid var(--border) !important;
        padding: 6px 14px !important;
        font-size: 13px;
        box-shadow: none !important;
    }

    .pv-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 999px !important;
        border: 1px solid var(--border) !important;
        color: var(--text-muted) !important;
    }

    .pv-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: #fff !important;
    }
</style>

<div class="pv-wrapper">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="pv-date-banner">
                        <div class="card-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <p class="pv-date-title">Période</p>
                    </div>

                    <?php echo $this->Form->create('Analyse', array('id' => 'dateform', 'autocomplete' => 'off')); ?>

                    <div class="input-group col-lg-10 col-md-10 col-12 float-end mb-4">
                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        <input type="text" class="form-control" value="<?php echo h($dateaafficherdansleview); ?>" name="date" id="reservationtime">
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('activite', array(
                            "label" => "Choisissez l'activité",
                            "name" => "activite",
                            'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                            'class' => 'form-control',
                            'value' => $activite
                        ));
                        echo $this->Form->input('potentialite', array(
                            "label" => "Choisissez potentialité",
                            "name" => "potentialite",
                            'options' => array("A1" => "A1", "A2" => "A2", "A3" => "A3", "B1" => "B1", "B2" => "B2", "B3" => "B3", "C1" => "C1", "C2" => "C2", "C3" => "C3"),
                            'class' => 'form-control select2',
                            'multiple' => 'multiple',
                            'value' => $potentialite_selected
                        ));
                        if (AuthComponent::user('role') != 'Super viseur')
                            echo $this->Form->input('secteur', array(
                                "label" => "La liste des secteurs",
                                "name" => "secteur",
                                'options' => $secteurs,
                                'class' => 'form-control select2',
                                'multiple' => 'multiple',
                                'value' => $selected_secteur
                            ));
                        echo $this->Form->input('category', array(
                            "label" => "La liste des spécialité",
                            "name" => "category",
                            'options' => $categories,
                            'class' => 'form-control select2',
                            'multiple' => 'multiple',
                            'value' => isset($selected_categories) ? array_values($selected_categories) : array()
                        ));
                        ?>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('user', array(
                            'label' => 'La liste des VM',
                            'name' => 'users',
                            'options' => $allusers,
                            'class' => 'form-control select2',
                            'multiple' => 'multiple',
                            'value' => isset($selected_users) ? array_keys($selected_users) : array()
                        ));
                        echo $this->Form->input('ligne', array(
                            "label" => "Les lignes",
                            "name" => "ligne",
                            'options' => $lignes,
                            'class' => 'form-control select2',
                            'multiple' => 'multiple',
                            'value'=> $selected_lignes
                        ));
                        echo $this->Form->input('type', array(
                            "label" => "Type de client",
                            "name" => "type",
                            'options' => array("1" => "Medcin", "2" => "Pharmacie"),
                            'class' => 'form-control select2',
                            'multiple' => 'multiple',
                            'value' => isset($selected_types) ? array_values($selected_types) : array()
                        ));
                        ?>
                    </div>

                    <div class="col-12" style="clear:both;">
                        <input type="submit" value="Rechercher" class="btn btn-search" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Calculs PHP
    $totalClients = count($visitesParClient);
    $totalVisites = 0;
    foreach ($visitesParClient as $client) {
        $totalVisites += $client['nb_visites'];
    }
    $moyenne = $totalClients > 0 ? $totalVisites / $totalClients : 0;

    // Compter les mois "couverts" (mois inclusifs) entre 2 dates
    $dates = explode(' -- ', $dateaafficherdansleview);
    $nbMois = 0;

    if (count($dates) === 2) {
        $start = new DateTime($dates[0]);
        $end   = new DateTime($dates[1]);

        if ($end < $start) {
            $tmp = $start;
            $start = $end;
            $end = $tmp;
        }

        $nbMois = ($end->format('Y') - $start->format('Y')) * 12
                + ($end->format('n') - $start->format('n'))
                + 1;
    }

    // Calcul des zones basées sur nbMois
    $minOpt = max(0, $nbMois - 2);
    $maxOpt = $nbMois + 2;
    $minAcc = max(0, $nbMois - 3);
    $maxAcc = $nbMois + 3;

    // Calcul du pourcentage dans la zone optimale
    $clientsOptimal = 0;
    foreach ($visitesParClient as $client) {
        $nb = $client['nb_visites'];
        if ($nb >= $minOpt && $nb <= $maxOpt) {
            $clientsOptimal++;
        }
    }
    $pourcentageOptimal = $totalClients > 0 ? round(($clientsOptimal / $totalClients) * 100, 1) : 0;
    ?>

    <!-- Graphique -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon"><i class="fa fa-bar-chart"></i></div>
                    <h3 class="card-title">Distribution de la Fréquence des Visites</h3>
                </div>
                <div class="card-body">
                    <div class="pv-stats-row">
                        <div class="pv-stat-card stat-clients">
                            <div class="pv-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <h4>Total Clients</h4>
                            <div class="num"><?php echo $totalClients; ?></div>
                        </div>
                        <div class="pv-stat-card stat-visites">
                            <div class="pv-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <h4>Total Visites</h4>
                            <div class="num"><?php echo $totalVisites; ?></div>
                        </div>
                        <div class="pv-stat-card stat-moyenne">
                            <div class="pv-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M6 21a6 6 0 0 1 12 0"/></svg>
                            </div>
                            <h4>Moyenne/Client</h4>
                            <div class="num"><?php echo number_format($moyenne, 1); ?></div>
                        </div>
                        <div class="pv-stat-card stat-periode">
                            <div class="pv-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <h4>Période (Mois)</h4>
                            <div class="num"><?php echo $nbMois; ?></div>
                        </div>
                        <div class="pv-stat-card stat-optimal">
                            <div class="pv-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            </div>
                            <h4>% Zone Optimale</h4>
                            <div class="num"><?php echo $pourcentageOptimal; ?>%</div>
                        </div>
                    </div>

                    <div class="pv-legend">
                        <div class="pv-legend-item">
                            <div class="pv-legend-box" style="background: #00a65a;"></div>
                            <span>Zone optimale (<?php echo $minOpt; ?> à <?php echo $maxOpt; ?> visites)</span>
                        </div>
                        <div class="pv-legend-item">
                            <div class="pv-legend-box" style="background: #f39c12;"></div>
                            <span>Zone acceptable (<?php echo $minAcc; ?>-<?php echo $minOpt - 1; ?> et <?php echo $maxOpt + 1; ?>-<?php echo $maxAcc; ?> visites)</span>
                        </div>
                        <div class="pv-legend-item">
                            <div class="pv-legend-box" style="background: #dd4b39;"></div>
                            <span>Hors zone (&lt;<?php echo $minAcc; ?> ou &gt;<?php echo $maxAcc; ?> visites)</span>
                        </div>
                    </div>

                    <div class="pv-chart-container">
                        <canvas id="chartVisites"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon icon-blue"><i class="fa fa-table"></i></div>
                    <h3 class="card-title" style="flex:1;">Détail par Client</h3>
                    <button class="btn my-btn-excel" onclick="$('.buttons-excel').click()">
                        <i class="fa fa-file-excel-o"></i> Excel
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableClients">
                        <thead>
                            <tr>
                                <th>ID Client</th>
                                <th>Nom du Client</th>
                                <th>Nombre de Visites</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($visitesParClient as $client):
                                $nb = $client['nb_visites'];
                                if ($nb >= $minOpt && $nb <= $maxOpt) {
                                    $statut = '<span class="badge-pill-success">Optimal</span>';
                                } elseif ($nb >= $minAcc && $nb <= $maxAcc) {
                                    $statut = '<span class="badge-pill-warning">Acceptable</span>';
                                } else {
                                    $statut = '<span class="badge-pill-danger">Hors zone</span>';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $client['client_id']; ?></td>
                                    <td><?php echo h($client['client_nom']); ?></td>
                                    <td><strong><?php echo $nb; ?></strong></td>
                                    <td><?php echo $statut; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Daterangepicker
        $('#reservationtime').daterangepicker({
            locale: {
                format: "YYYY-MM-DD",
                separator: " -- ",
                applyLabel: "Valider",
                cancelLabel: "Annuler",
                daysOfWeek: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                firstDay: 1
            }
        });

        // Select2
        $('.select2').select2();

        // DataTable
        $('#tableClients').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            },
            dom: 'Bfrtip',
            buttons: ['excel'],
            order: [
                [2, 'desc']
            ],
            pageLength: 25
        });

        // Préparation des données pour le graphique
        var dist = <?php echo json_encode($distribution); ?>;
        var nbMois = <?php echo $nbMois; ?>;

        // Calcul des zones
        var minOpt = Math.max(0, nbMois - 2);
        var maxOpt = nbMois + 2;
        var minAcc = Math.max(0, nbMois - 3);
        var maxAcc = nbMois + 3;

        // Trier et préparer les données
        var keys = Object.keys(dist).map(Number).sort(function(a, b) {
            return a - b
        });
        var labels = [],
            data = [],
            colors = [];

        keys.forEach(function(k) {
            labels.push(k + (k > 1 ? ' visites' : ' visite'));
            data.push(dist[k]);

            var color = '#dd4b39';
            if (k >= minOpt && k <= maxOpt) {
                color = '#00a65a';
            } else if (k >= minAcc && k <= maxAcc) {
                color = '#f39c12';
            }
            colors.push(color);
        });

        var ctx = document.getElementById('chartVisites').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de clients',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            fontSize: 12,
                            suggestedMax: Math.max(...data) * 1.2
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Nombre de clients',
                            fontSize: 14
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontSize: 11,
                            autoSkip: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Fréquence des visites',
                            fontSize: 14
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            return chartData.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel.toFixed(1);
                        }
                    }
                },
                animation: {
                    onComplete: function() {
                        var chartInstance = this.chart;
                        var ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        ctx.fillStyle = '#333';

                        this.data.datasets.forEach(function(dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function(bar, index) {
                                var value = dataset.data[index];
                                ctx.fillText(value.toFixed(1), bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                }
            }
        });

    });
</script>
