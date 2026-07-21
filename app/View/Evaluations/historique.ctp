<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style>
/* ==========================================================================
   METRONIC PREMIUM HISTORY LAYOUT (LAVENDER PROFILE)
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

/* Main Wrapper */
.history-card-container {
    font-family: 'Poppins', sans-serif !important;
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #EAE6FF;
    box-shadow: 0 4px 24px rgba(144, 125, 250, 0.03);
    margin-bottom: 40px;
    overflow: hidden;
}

/* Master Header Group */
.history-master-header {
    padding: 24px 30px;
    border-bottom: 1px solid #FAF9FE;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}

.history-master-header .box-title {
    font-size: 18px;
    font-weight: 700;
    color: #332A5B;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.history-master-header .box-title i {
    color: #907DFA;
    font-size: 20px;
}

/* Action Buttons Navigation */
.btn-back-dashboard {
    background-color: #F3F1FF !important;
    color: #7966E3 !important;
    font-weight: 600;
    font-size: 12.5px;
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid #E1DCFF !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-back-dashboard:hover {
    background-color: #7966E3 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(121, 102, 227, 0.2);
}

/* Individual Mode Profile Header Block */
.individual-header {
    background: linear-gradient(135deg, #7966E3 0%, #907DFA 100%);
    color: #ffffff;
    padding: 24px 30px;
    border-radius: 14px;
    margin: 20px 30px 10px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 8px 24px rgba(144, 125, 250, 0.15);
}

.individual-header .user-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.individual-header .user-info .avatar-circle {
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
}

.individual-header .user-info h3 {
    margin: 0 0 4px 0;
    font-weight: 700;
    font-size: 20px;
    letter-spacing: 0.3px;
}

.individual-header .user-info small {
    font-size: 13px;
    opacity: 0.9;
    font-weight: 400;
}

.stat-box-container {
    display: flex;
    gap: 30px;
    text-align: center;
}

.stat-box-item .stat-value {
    font-size: 26px;
    font-weight: 800;
    line-height: 1.1;
}

.stat-box-item .stat-label {
    font-size: 12px;
    opacity: 0.85;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 4px;
}

/* Structural Hierarchy Headings */
.sup-heading {
    background: #F8F7FD;
    border-bottom: 1px solid #EAE6FF;
    font-weight: 700;
    font-size: 14px;
    color: #332A5B;
    padding: 14px 24px;
    margin-top: 30px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sup-heading i {
    color: #907DFA;
}

.vmp-heading {
    font-weight: 600;
    color: #4A3E75;
    padding: 16px 24px 8px 24px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
}

.vmp-heading i {
    color: #A197D4;
}

/* Premium Datatable Styling Matrix */
.history-table-wrapper {
    padding: 10px 24px 24px 24px;
}

.history-table-wrapper .table {
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid #EAE6FF !important;
    border-radius: 12px;
    overflow: hidden;
    background: #ffffff;
}

.history-table-wrapper .table thead {
    background: #FAF9FE;
}

.history-table-wrapper .table thead th {
    font-size: 12.5px;
    font-weight: 600;
    color: #6C5AA7;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 14px 16px;
    border-bottom: 1px solid #EAE6FF !important;
    border-top: none !important;
}

.history-table-wrapper .table tbody td {
    padding: 16px;
    font-size: 13.5px;
    color: #4A3E75;
    font-weight: 500;
    vertical-align: middle !important;
    border-bottom: 1px solid #FAF9FE !important;
}

.history-table-wrapper .table tbody tr:last-child td {
    border-bottom: none !important;
}

/* Ovals Percentage Badges */
.score-label {
    padding: 6px 16px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 13px;
    display: inline-block;
    text-align: center;
    min-width: 85px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

.bg-green {
    background: linear-gradient(135deg, #1B9E5A 0%, #3CD083 100%) !important;
    color: #ffffff !important;
}

.bg-orange {
    background: linear-gradient(135deg, #F39C12 0%, #FFB641 100%) !important;
    color: #ffffff !important;
}

.bg-red {
    background: linear-gradient(135deg, #ED4C5C 0%, #FF7381 100%) !important;
    color: #ffffff !important;
}

/* Dynamic Colorful Action Buttons Matrix */
.history-table-wrapper .actions {
    display: flex;
    justify-content: center;
    gap: 6px;
}

.history-table-wrapper .actions .btn-xs {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: none !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    color: #ffffff !important;
}

.history-table-wrapper .actions .btn-xs:hover {
    transform: translateY(-1.5px);
}

.history-table-wrapper .actions .btn-info {
    background: #7966E3 !important; /* Premium Matte Purple */
    box-shadow: 0 3px 10px rgba(121, 102, 227, 0.25);
}

.history-table-wrapper .actions .btn-primary {
    background: #3B97FF !important; /* Electric Blue */
    box-shadow: 0 3px 10px rgba(59, 151, 255, 0.25);
}

.history-table-wrapper .actions .btn-warning {
    background: #FFC107 !important; /* Vivid Yellow-Orange */
    box-shadow: 0 3px 10px rgba(255, 193, 7, 0.25);
}
</style>

<div class="history-card-container">
    <div class="history-master-header">
        <?php if(!empty($isIndividuel)): ?>
            <h3 class="box-title"><i class="fa fa-user"></i> Historique de : <?php echo h($vmpName); ?></h3>
        <?php else: ?>
            <h3 class="box-title"><i class="fa fa-history"></i> Historique Global des Évaluations</h3>
        <?php endif; ?>
        
        <div>
            <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn-back-dashboard">
                <i class="fa fa-arrow-left"></i> Retour au tableau de bord
            </a>
        </div>
    </div>

    <div class="box-body-content">
        <!-- Profile View Header Section -->
        <?php if(!empty($isIndividuel)):
            $totalEvals = 0;
            $scores = array();
            foreach ($groupedHistory as $supName => $vmps) {
                foreach ($vmps as $vmpName2 => $evaluations) {
                    foreach ($evaluations as $eva) {
                        $totalEvals++;
                        if (!empty($eva['Evaluation']['total_percentage'])) {
                            $scores[] = (float) $eva['Evaluation']['total_percentage'];
                        }
                    }
                }
            }
            $avgScore = count($scores) > 0 ? round(array_sum($scores) / count($scores), 1) : null;
            $bestScore = count($scores) > 0 ? max($scores) : null;
            $worstScore = count($scores) > 0 ? min($scores) : null;
        ?>
        <div class="individual-header">
            <div class="user-info">
                <div class="avatar-circle">
                    <?php echo mb_strtoupper(mb_substr($vmpName, 0, 1)); ?>
                </div>
                <div>
                    <h3><?php echo h($vmpName); ?></h3>
                    <small><?php echo $totalEvals; ?> évaluation(s) au total</small>
                </div>
            </div>
            <div class="stat-box-container">
                <?php if($avgScore !== null): ?>
                <div class="stat-box-item">
                    <div class="stat-value"><?php echo $avgScore; ?>%</div>
                    <div class="stat-label">Moyenne</div>
                </div>
                <div class="stat-box-item">
                    <div class="stat-value" style="color: #A6FFCC;"><?php echo $bestScore; ?>%</div>
                    <div class="stat-label">Meilleur</div>
                </div>
                <div class="stat-box-item">
                    <div class="stat-value" style="color: #FFC5D0;"><?php echo $worstScore; ?>%</div>
                    <div class="stat-label">Plus bas</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(empty($groupedHistory)): ?>
            <div style="padding: 30px;">
                <div class="alert alert-info" style="border-radius: 10px; margin: 0;">Aucun historique disponible.</div>
            </div>
        <?php else: ?>

            <?php foreach ($groupedHistory as $supName => $vmps): ?>
                <!-- Supervisor Title Heading -->
                <div class="sup-heading"><i class="fa fa-users"></i> Supervisé par : <?php echo h($supName); ?></div>

                <?php foreach ($vmps as $vmpName2 => $evaluations): ?>
                    <!-- Representative Sub-Heading (Global View Only) -->
                    <?php if(empty($isIndividuel)): ?>
                        <div class="vmp-heading"><i class="fa fa-user"></i> Délégué Médical : <span style="font-weight: 700; color: #7966E3; margin-left: 4px;"><?php echo h($vmpName2); ?></span></div>
                    <?php endif; ?>

                    <div class="history-table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Période Évaluée</th>
                                        <th class="text-center">Score B1 (Prép.)</th>
                                        <th class="text-center">Score B2 (Vente)</th>
                                        <th class="text-center">Score B3 (Engag.)</th>
                                        <th class="text-center">Score Global</th>
                                        <th>Date du Bilan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($evaluations as $eva):
                                        $pct = isset($eva['Evaluation']['total_percentage']) ? $eva['Evaluation']['total_percentage'] : null;
                                        $hasScore = ($pct !== null && $pct !== '');
                                        $colorClass = '';
                                        if($hasScore) {
                                            $colorClass = ($pct >= 75) ? 'bg-green' : (($pct >= 50) ? 'bg-orange' : 'bg-red');
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($eva['Evaluation']['periode_debut'])): ?>
                                                <span style="color: #6C5AA7; font-weight: 600;">Du <?php echo h($eva['Evaluation']['periode_debut']); ?> au <?php echo h($eva['Evaluation']['periode_fin']); ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center" style="font-weight: 600; color: #554B82;"><?php echo !empty($eva['Evaluation']['score_b1']) ? $eva['Evaluation']['score_b1'] : '-'; ?></td>
                                        <td class="text-center" style="font-weight: 600; color: #554B82;"><?php echo !empty($eva['Evaluation']['score_b2']) ? $eva['Evaluation']['score_b2'] : '-'; ?></td>
                                        <td class="text-center" style="font-weight: 600; color: #554B82;"><?php echo !empty($eva['Evaluation']['score_b3']) ? $eva['Evaluation']['score_b3'] : '-'; ?></td>
                                        <td class="text-center">
                                            <?php if($hasScore): ?>
                                                <span class="score-label <?php echo $colorClass; ?>">
                                                    <?php echo number_format($pct, 2, '.', ''); ?> %
                                                </span>
                                            <?php else: ?>
                                                <span class="label label-default" style="border-radius: 20px; padding: 4px 10px;">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="color: #746A9F; font-size: 13px;"><?php echo date('d/m/Y à H:i', strtotime($eva['Evaluation']['created'])); ?></td>
                                        <td class="text-center">
                                            <div class="actions">
                                                <a href="<?php echo $this->Html->url(array('action' => 'view', $eva['Evaluation']['id'])); ?>" class="btn btn-info btn-xs" title="Voir le rapport"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo $this->Html->url(array('action' => 'edit', $eva['Evaluation']['id'])); ?>" class="btn btn-primary btn-xs" title="Modifier"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo $this->Html->url(array('action' => 'archive', $eva['Evaluation']['id'], 0)); ?>" class="btn btn-warning btn-xs" title="Archiver" onclick="return confirm('Voulez-vous archiver cette fiche ?')"><i class="fa fa-archive"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
?>