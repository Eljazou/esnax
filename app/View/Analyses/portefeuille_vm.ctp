<?php
echo $this->Html->css([
    'dataTables.bootstrap'
]);

// JS
echo $this->Html->script([
    'jquery-2.2.3.min',
    'moment',
    'jquery-ui.min',
    'jquery.dataTables.min',
    'dataTables.bootstrap.min'
]);
?>

<?php
echo $this->Html->css('daterangepicker');
echo $this->Html->css('select2.min');
echo $this->Html->css('_all-skins.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --imp-primary: #6C63F5;
        --imp-primary-dark: #564FD1;
        --imp-primary-light: #EEECFF;
        --imp-lavender: #F3F1FF;
        --imp-text: #2E2A4A;
        --imp-muted: #8E88A8;
        --imp-radius: 20px;
        --imp-radius-sm: 12px;
        --imp-shadow: 0 6px 24px rgba(108, 99, 245, 0.08);
    }

    body, .content-wrapper, .box, .form-control, table {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .box-body {
        overflow: hidden;
        overflow-y: hidden;
    }

    /* ---------- Filter card ---------- */
    .imp-filter-card {
        background: #fff;
        border-radius: var(--imp-radius);
        box-shadow: var(--imp-shadow);
        border: none;
        padding: 28px 28px 20px;
        margin-bottom: 24px;
    }

    .imp-filter-card .box-header {
        border: none;
        padding: 0 0 4px;
    }

    .imp-filter-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--imp-text);
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .imp-filter-title svg {
        width: 20px;
        height: 20px;
        color: var(--imp-primary);
    }

    .imp-field-label {
        font-weight: 500;
        font-size: 13px;
        color: var(--imp-text);
        margin-bottom: 6px;
        display: block;
    }

    .imp-filter-card .form-group {
        margin-bottom: 18px;
    }

    .imp-filter-card .form-control,
    .imp-filter-card .select2-selection,
    .imp-filter-card .select2-selection--multiple {
        border-radius: var(--imp-radius-sm) !important;
        border: 1.5px solid #E7E4FB !important;
        min-height: 44px;
        background: #FBFAFF !important;
        box-shadow: none !important;
        font-size: 14px;
        color: var(--imp-text);
        transition: border-color .15s ease;
    }

    .imp-filter-card .form-control:focus,
    .imp-filter-card .select2-container--focus .select2-selection {
        border-color: var(--imp-primary) !important;
        background: #fff !important;
    }

    .imp-filter-card .select2-selection--multiple .select2-selection__choice {
        background: var(--imp-primary-light);
        border: none;
        color: var(--imp-primary-dark);
        border-radius: 8px;
        font-weight: 500;
        padding: 2px 8px;
    }

    .imp-filter-card .select2-selection--multiple .select2-selection__choice__remove {
        color: var(--imp-primary-dark);
    }

    .imp-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 4px;
    }

    .btn-search {
        width: auto;
        float: none;
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        padding: 11px 30px;
        background: linear-gradient(135deg, var(--imp-primary), var(--imp-primary-dark));
        color: #fff;
        border: none;
        border-radius: 999px;
        box-shadow: 0 8px 18px rgba(108, 99, 245, 0.28);
        transition: transform .15s ease, box-shadow .15s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, var(--imp-primary), var(--imp-primary-dark));
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(108, 99, 245, 0.34);
    }

    /* ---------- DataTables buttons ---------- */
    .dt-button {
        width: auto;
        float: left;
        margin: 5px;
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
        padding: 8px 16px !important;
        border-radius: 999px !important;
        border: none !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(0,0,0,.08);
    }

    .dt-button.buttons-excel,
    .dt-button.my-btn-excel {
        background: linear-gradient(135deg, #34C38F, #28a745) !important;
    }

    .dt-button.buttons-csv {
        background: linear-gradient(135deg, var(--imp-primary), var(--imp-primary-dark)) !important;
    }

    .dt-button:hover {
        color: #fff;
        opacity: .92;
        transform: translateY(-1px);
    }

    .btn-graph-export {
        background: linear-gradient(135deg, #FFB020, #F2994A) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 999px !important;
        padding: 8px 16px !important;
        font-size: 13px;
        font-weight: 500;
        margin: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,.08);
    }

    .btn-graph-export:hover {
        opacity: .92;
        transform: translateY(-1px);
    }

    .mr-2 {
        margin-right: 8px;
    }

    /* ---------- VM / Global result cards ---------- */
    .imp-card {
        background: #fff;
        border-radius: var(--imp-radius);
        box-shadow: var(--imp-shadow);
        border: none;
        overflow: hidden;
        margin-bottom: 22px;
    }

    .imp-card .box-header {
        background: var(--imp-lavender);
        border: none;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .imp-card .box-title {
        font-size: 15.5px;
        font-weight: 600;
        color: var(--imp-text);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .imp-card .box-title .imp-vm-badge {
        background: var(--imp-primary);
        color: #fff;
        border-radius: 999px;
        padding: 3px 12px;
        font-size: 12.5px;
        font-weight: 600;
    }

    .imp-card .box-title .imp-total-badge {
        background: #fff;
        color: var(--imp-primary-dark);
        border-radius: 999px;
        padding: 3px 12px;
        font-size: 12.5px;
        font-weight: 600;
        border: 1px solid var(--imp-primary-light);
    }

    .imp-card .box-tools .btn-box-tool {
        background: #fff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--imp-primary);
        border: 1px solid var(--imp-primary-light);
    }

    .imp-card .box-tools .btn-box-tool svg {
        width: 14px;
        height: 14px;
    }

    .imp-card .box-body {
        padding: 26px 24px;
    }

    .imp-section-title {
        font-size: 14.5px;
        font-weight: 600;
        color: var(--imp-text);
        margin-bottom: 14px;
    }

    .chart-container {
        height: 250px;
        position: relative;
    }

    /* ---------- Tables ---------- */
    .color-thead th {
        background: var(--imp-primary-light) !important;
        color: var(--imp-text) !important;
        font-weight: 600;
        font-size: 13px;
        border-bottom: none !important;
    }

    .table_d, .table_dd {
        border-radius: var(--imp-radius-sm);
        overflow: hidden;
        font-size: 13.5px;
    }

    .table_d td, .table_dd td {
        vertical-align: middle;
        color: var(--imp-text);
    }

    .table_d tbody tr:nth-child(odd),
    .table_dd tbody tr:nth-child(odd) {
        background: #FBFAFF;
    }

    .table_d tfoot tr,
    .table_dd tfoot tr {
        font-weight: 700 !important;
        background: var(--imp-primary-light) !important;
        color: var(--imp-text) !important;
    }

    .text-muted {
        color: var(--imp-muted) !important;
        font-size: 13.5px;
    }
</style>

<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group imp-filter-card">
            <div class="box-header with-border">
                <div class="imp-filter-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    Filtrer les statistiques
                </div>
            </div>
            <div class="box-body">
                <?php
                echo $this->Form->create('Analyse', array('id' => 'dateform', 'autocomplete' => 'off'));
                ?>
                <div class="col-md-6 col-sm-6">
                    <?php
                    echo $this->Form->input('activite', array(
                        "label" => "Choisissez l'activté",
                        "name" => "activite",
                        'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                        'class' => 'form-control pull-right',
                        'value' => $activite
                    ));
                    echo $this->Form->input('potentialite', array(
                        "multiple" => true,
                        "label" => "Choisissez potentialité",
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
                        'value' => $potentialite_selected
                    ));
                    if (AuthComponent::user('role') != 'Super viseur')
                        echo $this->Form->input('secteur', array(
                            "multiple" => "true",
                            "label" => "La liste des secteurs",
                            "name" => "secteur",
                            'options' => $secteurs,
                            'class' => 'form-control pull-right choix_multi select2',
                            'value' => $selected_secteur
                        ));
                    echo $this->Form->input('category', array(
                        "multiple" => "true",
                        "label" => "La liste des spécialité",
                        "name" => "category",
                        'options' => $categories,
                        'class' => 'form-control pull-right choix_multi select2',
                        'multiple' => 'multiple',
                        'value' => array_values($selected_categories)
                    ));
                    ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?php
                    echo $this->Form->input('user', array(
                        'multiple' => true,
                        'label' => 'La liste des VM',
                        'name' => 'users',
                        'options' => $users, // e.g. [1 => 'Alice', 2 => 'Bob', 16 => 'HADDANE JIHAD']
                        'class' => 'form-control pull-right choix_multi vm select2',
                        'value' => $selected_users
                    ));
                    echo $this->Form->input('type', array(
                        "multiple" => "true",
                        "label" => "Type de client",
                        "name" => "type",
                        'options' => $types,
                        'class' => 'form-control pull-right choix_multi vm select2',
                        'multiple' => 'multiple',
                        'value' => array_values($selected_types)
                    ));
                    ?>
                </div>
                <div class="col-md-12 imp-actions">
                    <input type="submit" value="Rechercher" class="btn btn-search" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <?php foreach ($data as $userId => $info):
        if ($info['total_clients'] == 0)
            continue; ?>
        <div class="col-md-12">
            <div class="box box-primary box-solid collapsed-box imp-card">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">
                        <span class="imp-vm-badge">VM #<?php echo $tout_user_pour_affchage_dans_le_view[$userId]; ?></span>
                        <span class="imp-total-badge">Total clients : <?php echo h($info['total_clients']); ?></span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <!-- Spécialités -->
                        <div class="col-md-6 text-center">
                            <h4 class="imp-section-title">Répartition des clients par spécialité</h4>
                            <div class="chart-container">
                                <canvas id="chart-spec-<?php echo $userId; ?>" height="250"></canvas>
                            </div>

                            <div class="table-responsive" style="max-height:200px; overflow-y:auto; margin-top:14px;">
                                <table class="table table-bordered table-condensed table-striped table_d">
                                    <thead class="color-thead">
                                        <tr>
                                            <th>Spécialité</th>
                                            <th>Nombre</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $specialites = isset($info['specialites']) ? $info['specialites'] : array();
                                        usort($specialites, function ($a, $b) {
                                            if ($a['count'] == $b['count']) {
                                                return 0;
                                            }
                                            return ($a['count'] < $b['count']) ? 1 : -1; // Descending order
                                        });

                                        $totalCount = 0;
                                        $totalPercent = 0;
                                        foreach ($specialites as $s):
                                            $totalCount += $s['count'];
                                            $totalPercent += $s['percent'];
                                        ?>
                                            <tr>
                                                <td><?php echo h($s['label']); ?></td>
                                                <td><?php echo h($s['count']); ?></td>
                                                <td><?php echo h(number_format($s['percent'], 2, ',', '')); ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        $roundedTotal = round($totalPercent, 2);

                                        if ($roundedTotal == 99.99 || $roundedTotal == 100.01) {
                                            $totalPercent = 100.00;
                                        }


                                        ?>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?php echo $totalCount; ?></td>
                                            <td><?php echo number_format($totalPercent, 2); ?>%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <!-- Tendance -->
                        <div class="col-md-6 text-center">
                            <h4 class="imp-section-title">Répartition des MG par tendance</h4>
                            <?php if (!empty($info['tendance_if_generaliste'])): ?>
                                <div class="chart-container">
                                    <canvas id="chart-tendance-<?php echo $userId; ?>" height="250"></canvas>
                                </div>

                                <div class="table-responsive" style="max-height:200px; overflow-y:auto; margin-top:14px;">
                                    <table class="table table-bordered table-condensed table-striped table_d">
                                        <thead class="color-thead">
                                            <tr>
                                                <th>Tendance</th>
                                                <th>Nombre</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tendances = isset($info['tendance_if_generaliste']) ? $info['tendance_if_generaliste'] : array();

                                            usort($tendances, function ($a, $b) {
                                                if ($a['count'] == $b['count']) {
                                                    return 0;
                                                }
                                                return ($a['count'] < $b['count']) ? 1 : -1; // Descending order by count
                                            });

                                            $totalCount = 0;
                                            $totalPercent = 0;
                                            foreach ($tendances as $t):
                                                $totalCount += $t['count'];
                                                $totalPercent += $t['percent'];
                                            ?>
                                                <tr>
                                                    <td><?php echo h($t['label']); ?></td>
                                                    <td><?php echo h($t['count']); ?></td>
                                                    <td><?php echo h($t['percent']); ?>%</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $roundedTotal = round($totalPercent, 2);
                                            if ($roundedTotal == 99.99 || $roundedTotal == 100.01) {
                                                $totalPercent = 100.00;
                                            }


                                            ?>
                                            <tr>
                                                <td>TOTAL</td>
                                                <td><?php echo $totalCount; ?></td>
                                                <td><?php echo number_format($totalPercent, 2); ?>%</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            <?php else: ?>
                                <p class="text-muted">Aucune donnée tendance (pas de généralistes)</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
    $info=$global; ?>

    <div class="col-md-12">
            <div class="box box-primary box-solid collapsed-box imp-card">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">
                        <span class="imp-vm-badge">GLOBAL</span>
                        <span class="imp-total-badge">Total clients : <?php echo h($info['total_clients']); ?></span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <!-- Spécialités -->
                        <div class="col-md-6 text-center">
                            <h4 class="imp-section-title">Répartition des clients par spécialité</h4>
                            <div class="chart-container">
                                <canvas id="chart-spec-<?php echo $userId; ?>" height="250"></canvas>
                            </div>

                            <div class="table-responsive" style=" overflow-y:auto; margin-top:14px;">
                                <table class="table table-bordered table-condensed table-striped table_dd">
                                    <thead class="color-thead">
                                        <tr>
                                            <th>Spécialité</th>
                                            <th>Nombre</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $specialites = isset($info['specialites']) ? $info['specialites'] : array();
                                        usort($specialites, function ($a, $b) {
                                            if ($a['count'] == $b['count']) {
                                                return 0;
                                            }
                                            return ($a['count'] < $b['count']) ? 1 : -1; // Descending order
                                        });

                                        $totalCount = 0;
                                        $totalPercent = 0;
                                        foreach ($specialites as $s):
                                            $totalCount += $s['count'];
                                            $totalPercent += $s['percent'];
                                        ?>
                                            <tr>
                                                <td><?php echo h($s['label']); ?></td>
                                                <td><?php echo h($s['count']); ?></td>
                                                <td><?php echo h($s['percent']); ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        $roundedTotal = round($totalPercent, 2);

                                        if ($roundedTotal == 99.99 || $roundedTotal == 100.01) {
                                            $totalPercent = 100.00;
                                        }


                                        ?>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?php echo $totalCount; ?></td>
                                            <td><?php echo number_format($totalPercent, 2); ?>%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <!-- Tendance -->
                        <div class="col-md-6 text-center">
                            <h4 class="imp-section-title">Répartition des MG par tendance</h4>
                            <?php if (!empty($info['tendance_if_generaliste'])): ?>
                                <div class="chart-container">
                                    <canvas id="chart-tendance-<?php echo $userId; ?>" height="250"></canvas>
                                </div>

                                <div class="table-responsive" style=" overflow-y:auto; margin-top:14px;">
                                    <table class="table table-bordered table-condensed table-striped table_dd">
                                        <thead class="color-thead">
                                            <tr>
                                                <th>Tendance</th>
                                                <th>Nombre</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tendances = isset($info['tendance_if_generaliste']) ? $info['tendance_if_generaliste'] : array();

                                            usort($tendances, function ($a, $b) {
                                                if ($a['count'] == $b['count']) {
                                                    return 0;
                                                }
                                                return ($a['count'] < $b['count']) ? 1 : -1; // Descending order by count
                                            });

                                            $totalCount = 0;
                                            $totalPercent = 0;
                                            foreach ($tendances as $t):
                                                $totalCount += $t['count'];
                                                $totalPercent += $t['percent'];
                                            ?>
                                                <tr>
                                                    <td><?php echo h($t['label']); ?></td>
                                                    <td><?php echo h($t['count']); ?></td>
                                                    <td><?php echo h($t['percent']); ?>%</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $roundedTotal = round($totalPercent, 2);
                                            if ($roundedTotal == 99.99 || $roundedTotal == 100.01) {
                                                $totalPercent = 100.00;
                                            }


                                            ?>
                                            <tr>
                                                <td>TOTAL</td>
                                                <td><?php echo $totalCount; ?></td>
                                                <td><?php echo number_format($totalPercent, 2); ?>%</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            <?php else: ?>
                                <p class="text-muted">Aucune donnée tendance (pas de généralistes)</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Chart.js + Datalabels -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    var dtFrench = {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher :",
        "sLengthMenu": "Afficher _MENU_ éléments",
        "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
        "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun élément à afficher",
        "sEmptyTable": "Aucune donnée disponible",
        "oPaginate": {
            "sFirst": "Premier",
            "sPrevious": "Précédent",
            "sNext": "Suivant",
            "sLast": "Dernier"
        }
    };

    $('.table_dd').DataTable({
        dom: 'Bfrtip',
        searching: false,
        paging: false,
        order: [
            [1, 'desc']
        ], // 👈 column index 1 = "Nombre", sorted descending
        language: dtFrench,
        buttons: [{
                extend: 'excelHtml5',
                text: 'Exporter Excel',
                className: 'btn btn-success btn-sm mr-2',
                footer: true
            },
            {
                extend: 'csvHtml5',
                text: 'Exporter CSV',
                className: 'btn btn-primary btn-sm mr-2',
                footer: true
            }
        ]
    });
    $('.table_d').each(function() {
        var table = $(this).DataTable({
            dom: 'Bfrtip',
            searching: false,
            order: [
                [1, 'desc']
            ], // 👈 column index 1 = "Nombre", sorted descending
            language: dtFrench,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Exporter Excel',
                    className: 'btn btn-success btn-sm mr-2',
                    footer: true
                }
            ]
        });

        // Ajoute le bouton "Exportez le graphique"
        var chartId = $(this).closest(".col-md-6").find("canvas").attr("id");
        var graphBtn = $('<button class="btn-graph-export"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>Exportez le graphique</button>');
        graphBtn.on('click', function() {
            downloadChart(chartId);
        });
        table.buttons().container().append(graphBtn);
    });
</script>
<script>
    function downloadChart(id) {
        var canvas = document.getElementById(id);
        var chart = Chart.getChart(canvas); // get Chart.js instance

        // Force chart update so datalabels are rendered
        chart.update();

        // Add white background before saving
        var ctx = canvas.getContext('2d');
        ctx.save(); // save current state
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.restore();

        // Export as PNG
        var link = document.createElement('a');
        link.href = canvas.toDataURL('image/png', 1.0); // 1.0 = best quality
        link.download = id + ".png";
        link.click();
    }


    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {

        <?php
        foreach ($data as $userId => $info):

            // Create sorted copies, without touching the original $data
            $specialitesSorted = isset($info['specialites']) ? $info['specialites'] : array();

            $specialitesSorted = isset($info['specialites']) ? $info['specialites'] : array();
            usort($specialitesSorted, function ($a, $b) {
                if ($a['count'] == $b['count']) {
                    return 0;
                }
                return ($a['count'] < $b['count']) ? 1 : -1; // Descending order
            });

            $tendanceSorted = isset($info['tendance_if_generaliste']) ? $info['tendance_if_generaliste'] : array();
            usort($tendanceSorted, function ($a, $b) {
                if ($a['count'] == $b['count']) {
                    return 0;
                }
                return ($a['count'] < $b['count']) ? 1 : -1; // Descending order
            });


        ?>
            // Check if canvas element exists before creating chart
            var specCanvas<?php echo $userId; ?> = document.getElementById("chart-spec-<?php echo $userId; ?>");
            if (specCanvas<?php echo $userId; ?>) {
                // Spécialités - Bar Chart
                new Chart(specCanvas<?php echo $userId; ?>, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_column($specialitesSorted, 'label')); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_column($specialitesSorted, 'count')); ?>,
                            backgroundColor: '#8B7FF5',
                            borderColor: '#6C63F5',
                            borderWidth: 1,
                            borderRadius: 6,
                            maxBarThickness: 42
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                top: 25 // gives space for labels above bars
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'top',
                                offset: 4,
                                clip: false,
                                formatter: (value) => value,
                                color: "#2E2A4A",
                                font: {
                                    weight: 'bold',
                                    size: 12
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#F0EEFF',
                                    display: true
                                },
                                ticks: {
                                    stepSize: 10
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 0
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

            <?php if (!empty($tendanceSorted)): ?>
                // Check if tendance canvas element exists before creating chart
                var tendanceCanvas<?php echo $userId; ?> = document.getElementById("chart-tendance-<?php echo $userId; ?>");
                if (tendanceCanvas<?php echo $userId; ?>) {
                    // Tendances - Bar Chart
                    new Chart(tendanceCanvas<?php echo $userId; ?>, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode(array_column($tendanceSorted, 'label')); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_column($tendanceSorted, 'count')); ?>,
                                backgroundColor: '#8B7FF5',
                                borderColor: '#6C63F5',
                                borderWidth: 1,
                                borderRadius: 6,
                                maxBarThickness: 42
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            layout: {
                                padding: {
                                    top: 25 // gives space for labels above bars
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    offset: 4,
                                    clip: false,
                                    formatter: (value) => value,
                                    color: "#2E2A4A",
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#F0EEFF',
                                        display: true
                                    },
                                    ticks: {
                                        stepSize: 10
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        maxRotation: 45,
                                        minRotation: 0
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                }
            <?php endif; ?>
        <?php endforeach; ?>
    });
    $('.choix_multi').select2();
</script>
