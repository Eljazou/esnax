<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* =========================================================
       THEME MATCHED DESIGN — Modern Lavender & Premium Clean
       ========================================================= */
    body, .box, .box-title, .panel, .panel-body, label, input, select, textarea, button, p, span {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* 1. CONTAINER PRINCIPAL (BOX) */
    .box.box-success {
        background: #ffffff !important;
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 10px 30px rgba(31, 41, 82, 0.05) !important;
        padding: 24px 28px !important;
        margin: 20px auto !important;
    }

    /* 2. ENTÊTE DE LA PAGE */
    .box-header.with-border {
        background: transparent !important;
        border: none !important;
        border-bottom: 1px solid #eef0f7 !important;
        padding: 0 0 16px 0 !important;
        margin-bottom: 24px !important;
    }

    .box-title {
        font-size: 22px !important;
        font-weight: 800 !important;
        color: #1a1d36 !important;
        margin: 0 !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .box-title i {
        color: #8c7ef2 !important; /* Substitution du vert par la couleur accent */
    }

    /* 3. STRUCTURE DU FORMULAIRE */
    .panel.panel-default {
        border: none !important;
        background: transparent !important;
    }

    .panel-body.form-horizontal {
        padding: 0 !important;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* 4. LABELS & TYPOGRAPHIE DES APPRENTISSAGES */
    .form-group label.control-label {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #6b6d85 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left !important;
        padding-top: 10px !important;
    }

    .text-danger {
        color: #e2679a !important;
    }

    /* 5. CHAMPS DE SAISIE & SELECTS */
    .form-control, 
    .select2-container--default .select2-selection--single {
        width: 100% !important;
        background-color: #f8f9fd !important;
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        padding: 8px 14px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #2b2c45 !important;
        height: auto !important;
        transition: all 0.2s ease !important;
        box-shadow: none !important;
    }

    .form-control:focus {
        background-color: #ffffff !important;
        border-color: #8c7ef2 !important;
        box-shadow: 0 0 0 3px rgba(140, 126, 242, 0.15) !important;
        outline: none !important;
    }

    /* Ajustement Select2 standard */
    .select2-container--default .select2-selection--single {
        padding: 5px 10px !important;
        height: 40px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #2b2c45 !important;
        line-height: 28px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
    }

    /* Separateur de sections */
    hr {
        border-top: 1px solid #eef0f7 !important;
        margin: 10px 0 !important;
    }

    /* 6. FICHE DE DÉTAILS DYNAMIQUE */
    #action-details-container .alert-info {
        background-color: #ffffff !important;
        color: #2b2c45 !important;
        border: 1.5px dashed #dcdffd !important;
        border-radius: 14px !important;
        padding: 20px !important;
        box-shadow: 0 4px 15px rgba(140, 126, 242, 0.03) !important;
    }

    #action-details-container h4 {
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #8c7ef2 !important;
        margin-top: 0 !important;
        margin-bottom: 14px !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    #action-details-container p {
        font-size: 13.5px !important;
        margin-bottom: 8px !important;
        color: #5c5e76 !important;
    }

    #action-details-container p strong {
        color: #1a1d36 !important;
        font-weight: 600;
        display: inline-block;
        width: 100px;
    }

    /* 7. ALERTE WARNING (LISTE VIDE) */
    .alert-warning {
        background-color: #fff6f9 !important;
        color: #d04377 !important;
        border: 1px solid #fcdde7 !important;
        border-radius: 10px !important;
        padding: 14px !important;
        font-size: 13.5px !important;
        font-weight: 500;
    }

    /* 8. BOUTONS D'ACTION */
    .btn-success {
        height: 44px !important;
        padding: 0 24px !important;
        background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 16px rgba(140, 126, 242, 0.25) !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-success:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 8px 20px rgba(140, 126, 242, 0.35) !important;
        background: linear-gradient(135deg, #9689ff 0%, #7c6ee6 100%) !important;
    }

    .btn-default {
        height: 44px !important;
        padding: 0 24px !important;
        background: #ffffff !important;
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #6b6d85 !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        margin-left: 8px;
    }

    .btn-default:hover {
        background: #f8f9fd !important;
        color: #2b2c45 !important;
        border-color: #d0d3f0 !important;
    }
</style>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> <?php echo __('Ajouter un Rapport d\'Action Promotionnelle'); ?></h3>
    </div>
    <div class="box-body">
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body form-horizontal">
                        <?php echo $this->Form->create('Actionrapport'); ?>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Action / Médecin ciblée <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <?php 
                                if(empty($actions_list)) {
                                    echo '<div class="alert alert-warning">Aucune action active n\'est disponible pour vous actuellement (vérifiez que l\'action est validée et que la date d\'aujourd\'hui est comprise dans la période de l\'action).</div>';
                                } else {
                                    echo $this->Form->input('action_id', array('id' => 'action-select', 'label' => false, 'class' => 'form-control select2', 'options' => $actions_list, 'empty' => '-- Sélectionner un médecin en action --', 'required' => 'required'));
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Détails de l'action sélectionnée -->
                        <div class="form-group row" id="action-details-container" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="alert alert-info">
                                    <h4><i class="fa fa-info-circle"></i> Détails de l'action</h4>
                                    <p><strong>Médecin :</strong> <span id="det-medecin"></span></p>
                                    <p><strong>Gamme :</strong> <span id="det-gamme"></span></p>
                                    <p><strong>Période :</strong> Du <span id="det-debut"></span> au <span id="det-fin"></span></p>
                                    <p><strong>Durée :</strong> <span id="det-duree"></span></p>
                                    <p><strong>Remarque :</strong> <span id="det-remarque"></span></p>
                                </div>
                            </div>
                        </div>

                        <?php if(!empty($actions_list)): ?>

                            <?php 
                            $options_enquete = array('1' => '1 - Augmentation', '2' => '2 - Stabilité', '3' => '3 - Diminution', '4' => '4 - Pas de prescription');
                            $options_satisfaction = array('1' => '1 - Très faible', '2' => '2 - Faible', '3' => '3 - Modérée', '4' => '4 - Bonne', '5' => '5 - Très forte');
                            ?>

                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Enquête Médecin <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->input('enquete_medecin', array('label' => false, 'class' => 'form-control', 'options' => $options_enquete, 'empty' => '-- Choisir --', 'required' => 'required')); ?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Enquête Secrétaire <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->input('enquete_secretaire', array('label' => false, 'class' => 'form-control', 'options' => $options_enquete, 'empty' => '-- Choisir --', 'required' => 'required')); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Enquête Pharmacie <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->input('enquete_pharmacie', array('label' => false, 'class' => 'form-control', 'options' => $options_enquete, 'empty' => '-- Choisir --', 'required' => 'required')); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Niveau de Satisfaction <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->input('niveau_satisfaction', array('label' => false, 'class' => 'form-control', 'options' => $options_satisfaction, 'empty' => '-- Choisir --', 'required' => 'required')); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Commentaire</label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->input('commentaire', array('label' => false, 'type' => 'textarea', 'class' => 'form-control', 'rows' => 3)); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Enregistrer le rapport</button>
                                    <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn btn-default">Annuler</a>
                                </div>
                            </div>
                            
                        <?php endif; ?>

                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
echo $this->Html->css('select2.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('select2.full.min');
?>

<script>
    var actionsDetails = <?php echo isset($actions_json) ? json_encode($actions_json) : '{}'; ?>;
    
    $(function () {
        if ($.fn.select2) {
            $('.select2').select2({
                width: '100%'
            });
        }

        $('#action-select').on('change', function() {
            var val = $(this).val();
            if (val && actionsDetails[val]) {
                var d = actionsDetails[val];
                $('#det-medecin').text(d.client_nom);
                $('#det-gamme').text(d.gamme ? d.gamme : 'Aucune');
                $('#det-debut').text(d.date_debut);
                $('#det-fin').text(d.date_fin);
                
                var duree_txt = d.duree_totale + ' jours (Reste : ' + d.jours_restants + ' jours)';
                $('#det-duree').text(duree_txt);
                
                $('#det-remarque').text(d.remarque || '-');
                $('#action-details-container').slideDown(200);
            } else {
                $('#action-details-container').slideUp(150);
            }
        });
    });
</script>