<style>
/* ==========================================================================
   METRONIC PREMIUM EVALUATION LAYOUT (LAVENDER STYLE)
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

/* Main Body Overhaul */
body {
    padding-bottom: 100px !important; /* Safety margin for floating actions panel */
    font-family: 'Poppins', sans-serif !important;
    background-color: #FAF9FE;
    color: #4A3E75;
}

/* Master Evaluation Row-Cards */
.evaluation-box {
    margin-bottom: 30px;
    border-radius: 16px;
    background: #ffffff;
    border: 1px solid #EAE6FF !important;
    box-shadow: 0 4px 24px rgba(144, 125, 250, 0.04) !important;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Header Sections Styling */
.evaluation-box .box-header {
    background: #ffffff;
    padding: 20px 24px;
    border-bottom: 1px solid #FAF9FE;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.evaluation-box .box-title {
    font-size: 15px;
    font-weight: 700;
    color: #332A5B;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.evaluation-box .box-title i {
    color: #907DFA;
    font-size: 18px;
}

/* Sub-block Averages Pill Badge */
.avg-pill-badge {
    background: #F3F1FF;
    color: #7966E3;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12.5px;
    font-weight: 600;
    border: 1px solid #E1DCFF;
}

/* Form Input Configurations */
.evaluation-box .box-body {
    padding: 24px;
}

.form-group label {
    font-size: 12px;
    font-weight: 600;
    color: #9C93D9;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control {
    height: 44px;
    border: 1.5px solid #EAE6FF;
    border-radius: 10px;
    padding: 10px 16px;
    font-size: 14px;
    color: #554B82;
    font-weight: 500;
    background-color: #ffffff;
    transition: all 0.2s ease;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #907DFA;
    background-color: #ffffff;
    box-shadow: 0 0 0 3.5px rgba(144, 125, 250, 0.12) !important;
}

textarea.form-control {
    height: auto;
    min-height: 100px;
    resize: vertical;
}

/* Inner Section Divider Lines */
.section-header {
    background: linear-gradient(90deg, #F3F1FF 0%, rgba(243, 241, 255, 0) 100%);
    padding: 12px 20px;
    font-weight: 600;
    border-left: 4px solid #907DFA;
    margin: 25px 0 15px 0;
    color: #6C5AA7;
    text-transform: uppercase;
    font-size: 11.5px;
    letter-spacing: 0.06em;
    border-radius: 0 8px 8px 0;
}

/* Diagnostic Table Rows */
.q-row {
    border-bottom: 1px solid #FAF9FE;
    padding: 18px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    background: #ffffff;
    transition: background 0.2s ease, box-shadow 0.2s ease;
    border-radius: 8px;
}

.q-row:hover {
    background: #FDFDFF;
    box-shadow: inset 3.5px 0 0 #AFA2FF;
}

.q-text {
    flex: 1;
    font-size: 14px;
    line-height: 1.6;
    color: #4A3E75;
    font-weight: 500;
}

/* Custom Warning Wrapper Box Context */
.box-warning { border-top: none !important; }
.box-warning .box-title i { color: #F39C12; }

/* ==========================================================================
   STICKY BOTTOM CONTROL FOOTER
   ========================================================================== */
.fixed-score-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-top: 1px solid #EAE6FF;
    z-index: 1040;
    box-shadow: 0 -8px 30px rgba(144, 125, 250, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 40px;
}

.footer-vmp {
    font-size: 14.5px;
    font-weight: 600;
    color: #7966E3;
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-vmp i {
    font-size: 16px;
    color: #907DFA;
}

/* Centered Live Analytics Score Frame */
.footer-score {
    text-align: center;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    color: #6C5AA7;
    font-size: 13.5px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.score-val {
    font-size: 28px;
    font-weight: 700;
    color: #907DFA;
    line-height: 1;
}

.score-percent-symbol {
    font-size: 18px;
    font-weight: 700;
    color: #907DFA;
    margin-right: 12px;
}

.score-points-count {
    color: #A197D4;
    font-weight: 500;
    margin-left: 15px;
}

/* Performance Assessment State Badges */
.badge-footer {
    font-size: 12px;
    font-weight: 600;
    padding: 6px 16px;
    border-radius: 30px;
    display: inline-block;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.bg-red {
    background: linear-gradient(135deg, #ED4C5C 0%, #FF7381 100%) !important;
    color: #ffffff !important;
}

.bg-orange {
    background: linear-gradient(135deg, #F39C12 0%, #FFB641 100%) !important;
    color: #ffffff !important;
}

.bg-green {
    background: linear-gradient(135deg, #1B9E5A 0%, #3CD083 100%) !important;
    color: #ffffff !important;
}

/* Submit Control Action Button */
.footer-actions {
    min-width: 200px;
    text-align: right;
}

.footer-actions .btn-success {
    background: linear-gradient(135deg, #7966E3 0%, #907DFA 100%) !important;
    border: none !important;
    font-size: 14px;
    font-weight: 600;
    padding: 12px 26px;
    border-radius: 10px;
    letter-spacing: 0.2px;
    box-shadow: 0 4px 14px rgba(144, 125, 250, 0.3) !important;
    transition: all 0.2s ease;
}

.footer-actions .btn-success:hover {
    transform: translateY(-1.5px);
    box-shadow: 0 6px 20px rgba(144, 125, 250, 0.45) !important;
}
</style>

<div class="row">
    <?php echo $this->Form->create('Evaluation', array('id' => 'EvaluationForm')); ?>
    <?php echo $this->Form->hidden('user_id', array('value' => $user["User"]["id"])); ?>

    <div class="col-md-12">
        <!-- Informations Générales -->
        <div class="box box-primary evaluation-box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> BILAN DE VISITES EN DOUBLE</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Période - Début</label>
                            <?php echo $this->Form->input('periode_debut', array('type' => 'text', 'class' => 'form-control datepicker', 'label' => false, 'required' => true, 'placeholder' => 'AAAA-MM-JJ')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Période - Fin</label>
                            <?php echo $this->Form->input('periode_fin', array('type' => 'text', 'class' => 'form-control datepicker', 'label' => false, 'required' => true, 'placeholder' => 'AAAA-MM-JJ')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOC 1 -->
        <div class="box box-default evaluation-box" id="box_b1">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-folder-open text-muted"></i> BLOC 1 : PRÉPARATION ET PRÉSENTATION DES VISITES</h3>
                <div><span class="avg-pill-badge">Moyenne: <span id="avg_b1">0.0</span> / 4</span></div>
            </div>
            <div class="box-body">
                <div class="section-header">Section 1 : Préparation des visites</div>
                <div class="q-row">
                    <div class="q-text">Le délégué planifie-t-il ses visites de manière efficace via le CRM ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_1')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué définit-il des objectifs clairs des visites ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_2')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué prépare-t-il des messages pertinents ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_3')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué organise-t-il efficacement ses moyens promotionnels ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_4')); ?>
                </div>
                <div class="section-header">Section 2 : Présentation</div>
                <div class="q-row">
                    <div class="q-text">Le délégué adopte-t-il une présentation conforme aux standards ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_5')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué adopte-t-il une attitude professionnelle incluant posture, comportement, respect et tenue vestimentaire lors des interactions ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q1_6')); ?>
                </div>
            </div>
            <?php echo $this->Form->hidden('score_b1', array('id' => 'input_score_b1')); ?>
        </div>

        <!-- BLOC 2 -->
        <div class="box box-default evaluation-box" id="box_b2">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-comments text-muted"></i> BLOC 2 : TECHNIQUE DE VENTE ET DE COMMUNICATION</h3>
                <div><span class="avg-pill-badge">Moyenne: <span id="avg_b2">0.0</span> / 4</span></div>
            </div>
            <div class="box-body">
                <div class="q-row">
                    <div class="q-text">Le délégué introduit-il clairement le produit et capte-t-il l’attention ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_1')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué communique-t-il de manière claire et structurée ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_2')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué utilise-t-il efficacement les supports visuels ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_3')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué identifie et traite-t-il efficacement les objections ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_4')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué fait-il preuve d’écoute active ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_5')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué parvient-il à garder l’entretien focalisé sur le produit et les objectifs définis ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q2_6')); ?>
                </div>
            </div>
            <?php echo $this->Form->hidden('score_b2', array('id' => 'input_score_b2')); ?>
        </div>

        <!-- BLOC 3 -->
        <div class="box box-default evaluation-box" id="box_b3">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-line-chart text-muted"></i> BLOC 3 : ENGAGEMENT ET ANALYSE POST-VISITES</h3>
                <div><span class="avg-pill-badge">Moyenne: <span id="avg_b3">0.0</span> / 4</span></div>
            </div>
            <div class="box-body">
                <div class="section-header">Section 1 : Conclure et engagement</div>
                <div class="q-row">
                    <div class="q-text">Le délégué conclut-il efficacement les visites ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q3_1')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué obtient-il l'engagement des médecins ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q3_2')); ?>
                </div>
                <div class="section-header">Section 2 : Reporting et analyse</div>
                <div class="q-row">
                    <div class="q-text">Le délégué réalise-t-il un reporting CRM complet et précis ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q3_3')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué analyse-t-il la visite (résultats, objections, opportunités) ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q3_4')); ?>
                </div>
                <div class="q-row">
                    <div class="q-text">Le délégué identifie-t-il des actions de suivi pertinentes ?</div>
                    <?php echo $this->element('q_radios', array('name' => 'q3_5')); ?>
                </div>
            </div>
            <?php echo $this->Form->hidden('score_b3', array('id' => 'input_score_b3')); ?>
        </div>

        <!-- Observations -->
        <div class="box box-warning evaluation-box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Observations & Plan d'Action</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Observations générales</label>
                            <?php echo $this->Form->textarea('observations_generales', array('class' => 'form-control', 'rows' => 3)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Plan d'amélioration</label>
                            <?php echo $this->Form->textarea('plan_amelioration', array('class' => 'form-control', 'rows' => 3)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Appréciation VM</label>
                            <?php echo $this->Form->textarea('appreciation_vm', array('class' => 'form-control', 'rows' => 3)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STICKY FOOTER -->
    <div class="fixed-score-footer">
        <div class="footer-vmp">
            <i class="fa fa-user"></i> <strong id="foot_vmp_name"><?php echo h($user['User']['name']); ?></strong>
        </div>
        <div class="footer-score">
            <span>SCORE :</span>
            <span class="score-val" id="foot_score_pct">0</span>
            <span class="score-percent-symbol">%</span>
            <span id="foot_badge" class="badge-footer bg-red">En attente</span>
            <span class="score-points-count">(<span id="foot_points">0</span> / <span id="foot_max">68</span> pts)</span>
        </div>
        <div class="footer-actions">
            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> ENREGISTRER</button>
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
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'fr',
            autoclose: true
        });

        $('input[type="radio"]').on('change', function() {
            calculateScores();
        });

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

            // Bloc 2 (Fixed selector target conflict mismatch from original template typo)
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

            // Update Footer Values
            $('#foot_points').text(totalPoints);
            $('#foot_max').text(totalMaxPoints);
            $('#input_total_points').val(totalPoints);

            var pct = (totalMaxPoints > 0) ? ((totalPoints / totalMaxPoints) * 100).toFixed(1) : 0;
            $('#foot_score_pct').text(pct);
            $('#input_total_percentage').val(pct);

            var badge = $('#foot_badge');
            badge.removeClass('bg-red bg-orange bg-green');
            if (pct < 50) {
                badge.addClass('bg-red').text('Insuffisant');
            } else if (pct < 75) {
                badge.addClass('bg-orange').text('Accompagnement');
            } else {
                badge.addClass('bg-green').text('Senior / Conforme');
            }
        }
        calculateScores();
    });
</script>