<?php
echo $this->Html->css('select2.min');
echo $this->Html->css('datepicker3');
?>
<style>
    body { padding-bottom: 80px; }
    .evaluation-box { margin-bottom: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .q-row { border-bottom: 1px solid #f4f4f4; padding: 15px 10px; display: flex; align-items: center; transition: background 0.2s; }
    .q-row:hover { background: #fbfbfb; }
    .q-text { flex: 1; padding-right: 20px; font-size: 14px; color: #333; }
    .section-header { background: #f4f7f9; padding: 8px 15px; font-weight: bold; border-left: 4px solid #3c8dbc; margin: 15px 0 5px 0; color: #2c3e50; text-transform: uppercase; font-size: 12px; }
    
    .fixed-score-footer {
        position: fixed; bottom: 0; left: 0; right: 0; height: 70px;
        background: #fff; border-top: 3px solid #3c8dbc; z-index: 1030;
        box-shadow: 0 -5px 15px rgba(0,0,0,0.1); display: flex;
        justify-content: space-between; align-items: center; padding: 0 30px;
    }
    .footer-vmp { font-size: 1.1em; }
    .footer-score { text-align: center; flex: 1; }
    .footer-actions { width: 220px; text-align: right; }
    .score-val { font-size: 24px; font-weight: bold; margin: 0 10px; }
    .badge-footer { font-size: 16px; padding: 5px 15px; border-radius: 20px; vertical-align: middle; margin-left: 10px; }
    .bg-green { background-color: #00a65a !important; color: #fff; }
    .bg-orange { background-color: #f39c12 !important; color: #fff; }
    .bg-red { background-color: #dd4b39 !important; color: #fff; }
</style>

<div class="row">
    <?php echo $this->Form->create('Evaluation', array('id' => 'EvaluationForm')); ?>
    <?php echo $this->Form->input('id'); ?>
    <?php echo $this->Form->hidden('user_id'); ?>
    
    <div class="col-md-12">
        <div class="box box-primary evaluation-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> MODIFIER L'ÉVALUATION</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Délégué Médical (VMP)</label>
                            <input type="text" class="form-control" value="<?php echo h($user['User']['name']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Période - Début</label>
                            <?php echo $this->Form->input('periode_debut', array('type' => 'text', 'class' => 'form-control datepicker', 'label' => false, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Période - Fin</label>
                            <?php echo $this->Form->input('periode_fin', array('type' => 'text', 'class' => 'form-control datepicker', 'label' => false, 'required' => true)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOC 1 -->
        <div class="box box-default evaluation-box" id="box_b1">
            <div class="box-header with-border">
                <h3 class="box-title">BLOC 1 : PRÉPARATION ET PRÉSENTATION DES VISITES</h3>
                <div class="box-tools pull-right"><span class="label label-info">Moyenne: <span id="avg_b1">0.0</span>/4</span></div>
            </div>
            <div class="box-body">
                <div class="section-header">Section 1 : Préparation des visites</div>
                <div class="q-row"><div class="q-text">Le délégué planifie-t-il ses visites de manière efficace via le CRM ?</div><?php echo $this->element('q_radios', array('name' => 'q1_1')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué définit-il des objectifs clairs des visites ?</div><?php echo $this->element('q_radios', array('name' => 'q1_2')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué prépare-t-il des messages pertinents ?</div><?php echo $this->element('q_radios', array('name' => 'q1_3')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué organise-t-il efficacement ses moyens promotionnels ?</div><?php echo $this->element('q_radios', array('name' => 'q1_4')); ?></div>
                <div class="section-header">Section 2 : Présentation</div>
                <div class="q-row"><div class="q-text">Le délégué adopte-t-il une présentation conforme aux standards ?</div><?php echo $this->element('q_radios', array('name' => 'q1_5')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué adopte-t-il une attitude professionnelle ?</div><?php echo $this->element('q_radios', array('name' => 'q1_6')); ?></div>
            </div>
            <?php echo $this->Form->hidden('score_b1', array('id' => 'input_score_b1')); ?>
        </div>

        <!-- BLOC 2 -->
        <div class="box box-default evaluation-box" id="box_b2">
            <div class="box-header with-border">
                <h3 class="box-title">BLOC 2 : TECHNIQUE DE VENTE ET DE COMMUNICATION</h3>
                <div class="box-tools pull-right"><span class="label label-info">Moyenne: <span id="avg_b2">0.0</span>/4</span></div>
            </div>
            <div class="box-body">
                <div class="q-row"><div class="q-text">Le délégué introduit-il clairement le produit ?</div><?php echo $this->element('q_radios', array('name' => 'q2_1')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué communique-t-il de manière claire et structurée ?</div><?php echo $this->element('q_radios', array('name' => 'q2_2')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué utilise-t-il efficacement les supports visuels ?</div><?php echo $this->element('q_radios', array('name' => 'q2_3')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué identifie et traite-t-il les objections ?</div><?php echo $this->element('q_radios', array('name' => 'q2_4')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué fait-il preuve d’écoute active ?</div><?php echo $this->element('q_radios', array('name' => 'q2_5')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué parvient-il à garder l’entretien focalisé ?</div><?php echo $this->element('q_radios', array('name' => 'q2_6')); ?></div>
            </div>
            <?php echo $this->Form->hidden('score_b2', array('id' => 'input_score_b2')); ?>
        </div>

        <!-- BLOC 3 -->
        <div class="box box-default evaluation-box" id="box_b3">
            <div class="box-header with-border">
                <h3 class="box-title">BLOC 3 : ENGAGEMENT ET ANALYSE POST-VISITES</h3>
                <div class="box-tools pull-right"><span class="label label-info">Moyenne: <span id="avg_b3">0.0</span>/4</span></div>
            </div>
            <div class="box-body">
                <div class="section-header">Section 1 : Conclure et engagement</div>
                <div class="q-row"><div class="q-text">Le délégué conclut-il efficacement les visites ?</div><?php echo $this->element('q_radios', array('name' => 'q3_1')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué obtient-il l'engagement des médecins ?</div><?php echo $this->element('q_radios', array('name' => 'q3_2')); ?></div>
                <div class="section-header">Section 2 : Reporting et analyse</div>
                <div class="q-row"><div class="q-text">Le délégué réalise-t-il un reporting CRM complet ?</div><?php echo $this->element('q_radios', array('name' => 'q3_3')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué analyse-t-il la visite ?</div><?php echo $this->element('q_radios', array('name' => 'q3_4')); ?></div>
                <div class="q-row"><div class="q-text">Le délégué identifie-t-il des actions de suivi ?</div><?php echo $this->element('q_radios', array('name' => 'q3_5')); ?></div>
            </div>
            <?php echo $this->Form->hidden('score_b3', array('id' => 'input_score_b3')); ?>
        </div>

        <div class="box box-warning evaluation-box">
            <div class="box-header with-border"><h3 class="box-title">Observations & Plan d'Action</h3></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4"><div class="form-group"><label>Observations générales</label><?php echo $this->Form->textarea('observations_generales', array('class' => 'form-control', 'rows' => 3)); ?></div></div>
                    <div class="col-md-4"><div class="form-group"><label>Plan d'amélioration</label><?php echo $this->Form->textarea('plan_amelioration', array('class' => 'form-control', 'rows' => 3)); ?></div></div>
                    <div class="col-md-4"><div class="form-group"><label>Appréciation VM</label><?php echo $this->Form->textarea('appreciation_vm', array('class' => 'form-control', 'rows' => 3)); ?></div></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="fixed-score-footer">
        <div class="footer-vmp">
            <i class="fa fa-user"></i> <strong><?php echo h($user['User']['name']); ?></strong>
        </div>
        <div class="footer-score">
            <span>SCORE ACTUEL :</span>
            <span class="score-val" id="foot_score_pct">0</span><span style="font-size: 20px; font-weight: bold;">%</span>
            <span id="foot_badge" class="badge-footer bg-red">En attente</span>
            <span style="color: #777; margin-left: 20px;">(<span id="foot_points">0</span>/<span id="foot_max">68</span> pts)</span>
        </div>
        <div class="footer-actions">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-refresh"></i> METTRE À JOUR</button>
        </div>
    </div>

    <?php echo $this->Form->hidden('total_points', array('id' => 'input_total_points')); ?>
    <?php echo $this->Form->hidden('total_percentage', array('id' => 'input_total_percentage')); ?>
    <?php echo $this->Form->end(); ?>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->script('bootstrap-datepicker.fr');
?>

<script>
$(document).ready(function() {
    $('.datepicker').datepicker({ format: 'yyyy-mm-dd', language: 'fr', autoclose: true });
    $('input[type="radio"]').on('change', function() { calculateScores(); });

    function calculateScores() {
        var totalPoints = 0;
        var totalMaxPoints = 68; // 24 (B1) + 24 (B2) + 20 (B3)
        
        // Bloc 1
        var pts1 = 0; var cnt1 = 0;
        $('#box_b1 input[type="radio"]:checked').each(function() {
            pts1 += parseInt($(this).val());
            cnt1++;
        });
        var avg1 = (cnt1 > 0) ? (pts1 / cnt1).toFixed(2) : "0.00";
        $('#avg_b1').text(avg1);
        $('#input_score_b1').val(avg1);
        
        // Bloc 2
        var pts2 = 0; var cnt2 = 0;
        $('#box_b2 input[type="radio"]:checked').each(function() {
            pts2 += parseInt($(this).val());
            cnt2++;
        });
        var avg2 = (cnt2 > 0) ? (pts2 / cnt2).toFixed(2) : "0.00";
        $('#avg_b2').text(avg2);
        $('#input_score_b2').val(avg2);

        // Bloc 3
        var pts3 = 0; var cnt3 = 0;
        $('#box_b3 input[type="radio"]:checked').each(function() {
            pts3 += parseInt($(this).val());
            cnt3++;
        });
        var avg3 = (cnt3 > 0) ? (pts3 / cnt3).toFixed(2) : "0.00";
        $('#avg_b3').text(avg3);
        $('#input_score_b3').val(avg3);

        totalPoints = pts1 + pts2 + pts3;
        $('#input_total_points').val(totalPoints);
        $('#foot_points').text(totalPoints);
        $('#foot_max').text(totalMaxPoints);
        
        var pct = ((totalPoints / totalMaxPoints) * 100).toFixed(1);
        $('#foot_score_pct').text(pct); $('#input_total_percentage').val(pct);

        var badge = $('#foot_badge');
        badge.removeClass('bg-red bg-orange bg-green');
        if(pct < 50) { badge.addClass('bg-red').text('Insuffisant'); }
        else if(pct < 75) { badge.addClass('bg-orange').text('Accompagnement'); }
        else { badge.addClass('bg-green').text('Senior / Conforme'); }
    }
    calculateScores();
});
</script>