<?php
    $pct = $evaluation['Evaluation']['total_percentage'];
    $colorClass = ($pct >= 75) ? 'bg-green' : (($pct >= 50) ? 'bg-orange' : 'bg-red');
    $statusText = ($pct >= 75) ? 'Senior / Conforme' : (($pct >= 50) ? 'Accompagnement requis' : 'Insuffisant');
?>
<style>
    body { padding-bottom: 80px; }
    .report-card { border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: none; }
    .report-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
    .report-table th, .report-table td { border: 1px solid #eee; padding: 12px; }
    .report-table th { background: #f8f9fa; color: #555; font-weight: 600; width: 25%; }
    .block-header { background: #3c8dbc !important; color: #fff; padding: 10px 15px; font-weight: bold; border-radius: 5px 5px 0 0; }
    .section-header { background: #f1f4f6 !important; font-weight: bold; color: #444; border-left: 4px solid #3c8dbc; padding: 8px 15px; }
    .score-circle { width: 28px; height: 28px; border-radius: 50%; display: inline-block; border: 1px solid #ddd; text-align: center; line-height: 26px; font-size: 13px; font-weight: bold; margin: 0 3px; color: #ccc; }
    .score-active { background: #3c8dbc; color: #fff; border-color: #367fa9; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    .well-custom { background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 15px; margin-top: 5px; min-height: 80px; }
    
    .fixed-score-footer {
        position: fixed; bottom: 0; left: 0; right: 0; height: 75px;
        background: rgba(255,255,255,0.95); border-top: 3px solid #3c8dbc; z-index: 1030;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.15); display: flex;
        justify-content: space-between; align-items: center; padding: 0 40px;
        backdrop-filter: blur(5px);
    }
    .footer-score-val { font-size: 28px; font-weight: 800; margin: 0 15px; }
    .footer-badge { font-size: 18px; padding: 8px 25px; border-radius: 30px; }
    
    .alert-accomp { background-color: #fcf8e3; border: 1px solid #faebcc; color: #8a6d3b; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 5px solid #f39c12; }
    
    @media print {
        .fixed-score-footer, .btn-no-print { display: none !important; }
        body { padding-bottom: 0; }
        .report-card { box-shadow: none; border: 1px solid #eee; }
    }
</style>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn btn-default btn-no-print"><i class="fa fa-arrow-left"></i> Retour à l'historique</a>
        <button onclick="window.print();" class="btn btn-primary pull-right btn-no-print"><i class="fa fa-print"></i> Télécharger / Imprimer</button>
    </div>

    <div class="col-md-12">
        <div class="box box-solid report-card">
            <div class="box-body">
                <div class="text-center" style="margin-bottom: 40px;">
                    <h2 style="margin: 0; font-weight: 800; color: #3c8dbc; letter-spacing: 1px;">RAPPORT D'ÉVALUATION</h2>
                    <p class="text-muted">Visite en double - Délégué Médical</p>
                </div>

                <table class="report-table">
                    <tr>
                        <th>Délégué Médical :</th>
                        <td><strong><?php echo h($evaluation['User']['name']); ?></strong></td>
                        <th>Date de saisie :</th>
                        <td><?php echo date('d/m/Y à H:i', strtotime($evaluation['Evaluation']['created'])); ?></td>
                    </tr>
                    <tr>
                        <th>Période évaluée :</th>
                        <td>Du <?php echo h($evaluation['Evaluation']['periode_debut']); ?> au <?php echo h($evaluation['Evaluation']['periode_fin']); ?></td>
                        <th>Évaluateur :</th>
                        <td><strong><?php echo h($evaluation['Chef']['name']); ?></strong></td>
                    </tr>
                </table>

                <!-- Bloc 1 -->
                <?php if($evaluation['Evaluation']['score_b1'] > 0): ?>
                <div class="block-header">BLOC 1 : PRÉPARATION ET PRÉSENTATION DES VISITES <span class="pull-right">MOYENNE: <?php echo $evaluation['Evaluation']['score_b1']; ?> / 4</span></div>
                <table class="report-table" style="border-top: none;">
                    <tr class="section-header"><td colspan="2">Préparation des visites</td></tr>
                    <?php $q = array('q1_1' => 'Planification via CRM', 'q1_2' => 'Objectifs clairs', 'q1_3' => 'Messages pertinents', 'q1_4' => 'Moyens promotionnels');
                    foreach($q as $f => $l): ?>
                    <tr><td><?php echo $l; ?></td><td class="text-right" width="180px"><?php renderScore($evaluation['Evaluation'][$f]); ?></td></tr>
                    <?php endforeach; ?>
                    <tr class="section-header"><td colspan="2">Présentation</td></tr>
                    <?php $q = array('q1_5' => 'Présentation standards', 'q1_6' => 'Attitude professionnelle');
                    foreach($q as $f => $l): ?>
                    <tr><td><?php echo $l; ?></td><td class="text-right"><?php renderScore($evaluation['Evaluation'][$f]); ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>

                <!-- Bloc 2 -->
                <?php if($evaluation['Evaluation']['score_b2'] > 0): ?>
                <div class="block-header" style="margin-top: 20px;">BLOC 2 : TECHNIQUE DE VENTE ET DE COMMUNICATION <span class="pull-right">MOYENNE: <?php echo $evaluation['Evaluation']['score_b2']; ?> / 4</span></div>
                <table class="report-table">
                    <?php $q = array('q2_1' => 'Introduction et attention', 'q2_2' => 'Structure des axes', 'q2_3' => 'Utilisation des visuels', 'q2_4' => 'Traitement objections', 'q2_5' => 'Écoute active', 'q2_6' => 'Focalisation entretien');
                    foreach($q as $f => $l): ?>
                    <tr><td><?php echo $l; ?></td><td class="text-right" width="180px"><?php renderScore($evaluation['Evaluation'][$f]); ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>

                <!-- Bloc 3 -->
                <?php if($evaluation['Evaluation']['score_b3'] > 0): ?>
                <div class="block-header" style="margin-top: 20px;">BLOC 3 : ENGAGEMENT ET ANALYSE POST-VISITES <span class="pull-right">MOYENNE: <?php echo $evaluation['Evaluation']['score_b3']; ?> / 4</span></div>
                <table class="report-table">
                    <tr class="section-header"><td colspan="2">Conclure et engagement</td></tr>
                    <?php $q = array('q3_1' => 'Conclusion efficace', 'q3_2' => 'Engagement obtenu');
                    foreach($q as $f => $l): ?>
                    <tr><td><?php echo $l; ?></td><td class="text-right" width="180px"><?php renderScore($evaluation['Evaluation'][$f]); ?></td></tr>
                    <?php endforeach; ?>
                    <tr class="section-header"><td colspan="2">Reporting et analyse</td></tr>
                    <?php $q = array('q3_3' => 'Reporting CRM complet', 'q3_4' => 'Analyse de visite', 'q3_5' => 'Actions de suivi');
                    foreach($q as $f => $l): ?>
                    <tr><td><?php echo $l; ?></td><td class="text-right"><?php renderScore($evaluation['Evaluation'][$f]); ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>

                <!-- SECTION ANALYTIQUE -->
                <div class="row btn-no-print" style="margin-top: 30px;">
                    <!-- Top & Flop -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-success" style="border-top-width: 3px; border-radius: 8px;">
                                    <div class="box-header with-border">
                                        <h3 class="box-title" style="color: #00a65a; font-weight: bold;"><i class="fa fa-thumbs-o-up"></i> Top 3 Forces</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                                            <?php foreach($topForces as $label => $score): ?>
                                                <li><i class="fa fa-check text-success" style="margin-right: 10px;"></i> <strong><?php echo $label; ?></strong> <span class="pull-right text-muted"><?php echo $score; ?>/4</span></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-danger" style="border-top-width: 3px; border-radius: 8px;">
                                    <div class="box-header with-border">
                                        <h3 class="box-title" style="color: #dd4b39; font-weight: bold;"><i class="fa fa-warning"></i> Top 3 Axes d'amélioration</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                                            <?php foreach($topAxes as $label => $score): ?>
                                                <li><i class="fa fa-arrow-down text-danger" style="margin-right: 10px;"></i> <strong><?php echo $label; ?></strong> <span class="pull-right text-muted"><?php echo $score; ?>/4</span></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Graphics -->
                    <div class="col-md-6">
                        <div class="box box-solid" style="border: 1px solid #eee; border-radius: 8px;">
                            <div class="box-header with-border" style="background: #fafafa;">
                                <h3 class="box-title" style="font-size: 14px; font-weight: bold;"><i class="fa fa-pie-chart" style="color: #3c8dbc;"></i> Profil de Visite (Radar)</h3>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <div style="position: relative; height: 280px; width: 100%;">
                                    <canvas id="radarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-solid" style="border: 1px solid #eee; border-radius: 8px;">
                            <div class="box-header with-border" style="background: #fafafa;">
                                <h3 class="box-title" style="font-size: 14px; font-weight: bold;"><i class="fa fa-line-chart" style="color: #00a65a;"></i> Évolution Historique</h3>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <div style="position: relative; height: 280px; width: 100%;">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observations -->
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <label><i class="fa fa-commenting-o"></i> Observations générales :</label>
                        <div class="well-custom text-muted"><?php echo !empty($evaluation['Evaluation']['observations_generales']) ? nl2br(h($evaluation['Evaluation']['observations_generales'])) : 'Aucune observation.'; ?></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-6">
                        <label><i class="fa fa-line-chart"></i> Plan d'amélioration :</label>
                        <div class="well-custom text-muted"><?php echo !empty($evaluation['Evaluation']['plan_amelioration']) ? nl2br(h($evaluation['Evaluation']['plan_amelioration'])) : 'Aucun plan défini.'; ?></div>
                    </div>
                    <div class="col-md-6">
                        <label><i class="fa fa-star-o"></i> Appréciation VM :</label>
                        <div class="well-custom text-muted"><?php echo !empty($evaluation['Evaluation']['appreciation_vm']) ? nl2br(h($evaluation['Evaluation']['appreciation_vm'])) : 'Aucune appréciation.'; ?></div>
                    </div>
                </div>

                <!-- Explanation Context for Accompagnement -->
                <?php if ($pct >= 50 && $pct < 75): ?>
                <div class="alert-accomp">
                    <h4 style="margin-top: 0;"><i class="fa fa-info-circle"></i> Nécessite un Accompagnement</h4>
                    <p>Le score de <strong><?php echo $pct; ?>%</strong> indique que le délégué possède les bases mais que certains automatismes ou techniques doivent être renforcés. 
                    Un accompagnement terrain régulier est préconisé pour corriger les points faibles relevés dans ce bilan et viser le niveau <strong>Senior</strong> (> 75%).</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="fixed-score-footer btn-no-print">
    <div style="font-size: 1.2em;"><strong>RÉSULTAT DES VISITES :</strong></div>
    <div style="flex: 1; text-align: center;">
        <span class="footer-score-val <?php echo str_replace('bg-', 'text-', $colorClass); ?>"><?php echo $pct; ?> %</span>
        <span class="footer-badge <?php echo $colorClass; ?>"><?php echo $statusText; ?></span>
    </div>
    <div>
        <button onclick="window.print();" class="btn btn-primary btn-lg"><i class="fa fa-file-pdf-o"></i> EXPORTER LE RAPPORT</button>
    </div>
</div>

<?php 
function renderScore($val) {
    for($i=1; $i<=4; $i++) {
        $active = ($val == $i) ? 'score-active' : '';
        echo "<span class='score-circle $active'>$i</span> ";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // RADAR CHART (Profil de Visite)
    var ctxRadar = document.getElementById('radarChart');
    if(ctxRadar) {
        new Chart(ctxRadar.getContext('2d'), {
            type: 'radar',
            data: {
                labels: ['Préparation (B1)', 'Vente & Com (B2)', 'Engagement (B3)'],
                datasets: [{
                    label: 'Note sur 4',
                    data: [
                        <?php echo isset($evaluation['Evaluation']['score_b1']) ? (float)$evaluation['Evaluation']['score_b1'] : 0; ?>,
                        <?php echo isset($evaluation['Evaluation']['score_b2']) ? (float)$evaluation['Evaluation']['score_b2'] : 0; ?>,
                        <?php echo isset($evaluation['Evaluation']['score_b3']) ? (float)$evaluation['Evaluation']['score_b3'] : 0; ?>
                    ],
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60, 141, 188, 1)',
                    pointBackgroundColor: 'rgba(60, 141, 188, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(60, 141, 188, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 4,
                        ticks: { stepSize: 1, backdropColor: 'transparent' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // LINE CHART (Evolution Historique)
    var ctxLine = document.getElementById('lineChart');
    if(ctxLine) {
        var historyDates = <?php echo json_encode($historyDates); ?>;
        var historyScores = <?php echo json_encode($historyScores); ?>;
        
        new Chart(ctxLine.getContext('2d'), {
            type: 'line',
            data: {
                labels: historyDates.length > 0 ? historyDates : ['N/A'],
                datasets: [{
                    label: 'Score Global (%)',
                    data: historyScores.length > 0 ? historyScores : [0],
                    borderColor: '#00a65a',
                    backgroundColor: 'rgba(0, 166, 90, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#00a65a',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 100,
                        title: { display: true, text: 'Score en %' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }
});
</script>
