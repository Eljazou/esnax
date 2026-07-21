<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<?php echo $this->Html->css('/app/View/Appwebfinal/my_style');
echo $this->Html->css('all'); ?>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        margin: 0;
    }

    .header {
        position: fixed;
        top: 0;
        display: flex;
        width: 100%;
        padding: 0 0 0 22px;
        z-index: 99;
        margin: 0;
        left: 0;
        background-color: #fff;
        box-shadow: 0 1px 15px rgba(0, 0, 0, .04), 0 1px 6px rgba(0, 0, 0, .04);
        height: 70px;
        justify-content: space-between;
        align-items: center;
    }

    .header p {
        font-size: 17px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .arrow {
        padding: 0;
        font-size: 24px;
        color: #695cd4;
        margin-top: 3px;
    }

    .all-elements {
        margin-top: 85px;
        padding: 0 14px 100px;
    }

    .section-card {
        background: #fff;
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        display: none;
    }

    .section-card.active {
        display: block;
    }

    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #009688;
        font-size: 18px;
    }

    .chip-group {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .chip-check {
        display: none;
    }

    .chip-label {
        display: inline-block;
        padding: 8px 14px;
        background: #f0f0f0;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 500;
        color: #555;
        cursor: pointer;
        transition: all .2s;
        border: 2px solid transparent;
    }

    .chip-check:checked+.chip-label {
        background: #e0f2f1;
        color: #00796b;
        border-color: #009688;
        font-weight: 600;
    }

    .radio-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .radio-pill {
        display: none;
    }

    .radio-pill-label {
        padding: 8px 16px;
        background: #f0f0f0;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 500;
        color: #555;
        cursor: pointer;
        transition: all .2s;
        border: 2px solid transparent;
        text-align: center;
    }

    .radio-pill:checked+.radio-pill-label {
        background: #e0f2f1;
        color: #00796b;
        border-color: #009688;
        font-weight: 600;
    }

    .form-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
        transition: border .2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #009688;
        background: #fff;
    }

    .field-group.is-invalid .form-input,
    .form-input.is-invalid {
        border-color: #ef5350;
        background: #fff5f5;
    }

    .validation-message {
        display: none;
        margin-top: 6px;
        color: #d32f2f;
        font-size: 10px;
        font-weight: 600;
    }

    .field-group.is-invalid .validation-message {
        display: block;
    }

    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23555' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
    }

    .form-label {
        font-size: 9px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
        display: block;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #009688;
        color: #fff;
        border: none;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        margin-top: 10px;
    }

    .btn-add:active {
        background: #00796b;
    }

    .btn-remove {
        background: #ef5350;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 8px;
        right: 8px;
    }

    .feedback-block,
    .concurrent-block,
    .emg-produit-block {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        position: relative;
        border-left: 3px solid #009688;
    }

    .concurrent-block {
        border-left-color: #ff7043;
    }

    .emg-produit-block {
        border-left-color: #7c4dff;
    }

    .field-group {
        margin-bottom: 12px;
    }

    .emg-toggle {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
    }

    #emg-produits-container {
        display: none;
    }

    /* ODP */
    .image-checkbox {
        cursor: pointer;
        box-sizing: border-box;
        border: 2px solid transparent;
        margin-bottom: 0;
        outline: 0;
        position: relative;
        display: inline-block;
    }

    .image-checkbox input[type="checkbox"] {
        display: none;
    }

    .image-checkbox-checked {
        border-color: #009688;
        border-radius: 10px;
    }

    .image-checkbox .fa {
        position: absolute;
        display: block !important;
        color: #009688;
        background-color: #fff;
        padding: 6px;
        top: 0;
        font-size: 14px;
        font-weight: bold;
        right: 0;
        border-radius: 0 8px 0 8px;
    }

    .image-checkbox .order {
        position: absolute;
        color: white;
        background-color: #009688;
        padding: 6px 10px;
        bottom: 0;
        right: 0;
        border-radius: 8px 0 8px 0;
        display: none;
    }

    .image-checkbox-checked .order {
        display: block !important;
        font-size: 9px;
        font-weight: bold;
    }

    .img-responsive {
        border-radius: 8px;
        width: 100%;
        height: 100px;
        object-fit: cover;
    }

    #VisiteOrder {
        opacity: 0;
        width: 0;
        display: none;
    }

    .submit-section {
        padding: 14px;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, .08);
        z-index: 98;
        display: flex;
        gap: 10px;
    }

    .btn-submit {
        width: 100%;
        padding: 0px;
        background: linear-gradient(135deg, #009688, #00796b);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        flex: 2;
        display: none;
    }

    .btn-submit:active {
        background: linear-gradient(135deg, #00796b, #004d40);
    }

    .btn-prev,
    .btn-next {
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        flex: 1;
    }

    .btn-prev {
        background: #e0e0e0;
        color: #555;
    }

    .btn-next {
        background: linear-gradient(135deg, #009688, #00796b);
        color: #fff;
    }

    .odp-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .odp-grid .odp-item {
        width: calc(33.33% - 6px);
    }
</style>

<div class="header">
    <div style="padding:0">
        <a class="btn_spiner"
            href="<?php echo $this->Html->url(array("action" => "view_client", $code, $client_id)); ?>">
            <i class="fa-solid fa-angle-left arrow"></i>
        </a>
    </div>
    <div style="padding:0">
        <p>Rapport V2</p>
    </div>
    <div style="width:40px"></div>
</div>

<div class="all-elements">
    <?php echo $this->Form->create('Visite', array('id' => 'rapportV2Form', 'novalidate' => 'novalidate')); ?>
    <?php echo $this->Form->hidden('client_id', array('value' => $client_id)); ?>

    <!-- ========== 1. OBJECTIF DE VISITE ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-bullseye"></i> Objectif de visite</h3>
        <div class="chip-group">
            <?php
            $objectifs = array(
                'nouveau_produit' => 'Présenter un nouveau produit',
                'echelle_adoption' => "Développer l'échelle d'adoption",
                'suivre_prescriptions' => 'Suivre les prescriptions',
                'fideliser_prescripteur' => 'Fidéliser le prescripteur',
                'repondre_demande' => 'Répondre à une demande',
                'clarifier_doutes' => 'Clarifier des doutes, objections et malentendus'
            );
            foreach ($objectifs as $val => $label): ?>
                <div>
                    <input type="checkbox" class="chip-check" id="obj_<?php echo $val; ?>"
                        name="data[Visite][objectif_visite][]" value="<?php echo $val; ?>">
                    <label class="chip-label" for="obj_<?php echo $val; ?>"><?php echo $label; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ========== 2. FEEDBACK PRODUITS ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-capsules"></i> Feedback Produits</h3>
        <div id="feedback-container">
            <div class="feedback-block" data-index="0">
                <div class="field-group">
                    <label class="form-label">Produit ODP</label>
                    <select class="form-input" name="data[FeedbackProduit][0][produit_id]" required>
                        <option value="">Choisissez un produit</option>
                        <?php foreach ($games as $k => $g): ?>
                            <option value="<?php echo $k; ?>"><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field-group">
                    <label class="form-label">Catégorie d'objection</label>
                    <div class="chip-group">
                        <?php
                        $cats = array('prix' => 'Prix', 'presentation' => 'Présentation', 'efficacite' => 'Efficacité', 'msg_principal_1' => 'Message principal 1', 'tolerance' => 'Tolérance', 'disponibilite' => 'Disponibilité', 'msg_principal_2' => 'Message principal 2', 'autre' => 'Autre', 'msg_secondaire' => 'Message Secondaire');
                        foreach ($cats as $cv => $cl): ?>
                            <div>
                                <input type="checkbox" class="chip-check" id="obj0_<?php echo $cv; ?>"
                                    name="data[FeedbackProduit][0][objections][]" value="<?php echo $cv; ?>">
                                <label class="chip-label" for="obj0_<?php echo $cv; ?>"><?php echo $cl; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="field-group">
                    <label class="form-label">Retour du médecin</label>
                    <div class="radio-group">
                        <div><input type="radio" class="radio-pill" id="ret0_p" name="data[FeedbackProduit][0][retour]"
                                value="positif"><label class="radio-pill-label" for="ret0_p">😊 Positif</label></div>
                        <div><input type="radio" class="radio-pill" id="ret0_m" name="data[FeedbackProduit][0][retour]"
                                value="mitige"><label class="radio-pill-label" for="ret0_m">😐 Mitigé</label></div>
                        <div><input type="radio" class="radio-pill" id="ret0_n" name="data[FeedbackProduit][0][retour]"
                                value="negatif"><label class="radio-pill-label" for="ret0_n">😞 Négatif</label></div>
                    </div>
                </div>
                <div class="field-group">
                    <label class="form-label">Préciser</label>
                    <input type="text" class="form-input" name="data[FeedbackProduit][0][preciser]"
                        placeholder="Précisez ici...">
                </div>
                <div class="field-group">
                    <label class="form-label">Niveau d'adoption</label>
                    <div class="radio-group">
                        <div><input type="radio" class="radio-pill" id="ado0_r"
                                name="data[FeedbackProduit][0][adoption]" value="regulier"><label
                                class="radio-pill-label" for="ado0_r">Régulier</label></div>
                        <div><input type="radio" class="radio-pill" id="ado0_o"
                                name="data[FeedbackProduit][0][adoption]" value="occasionnel"><label
                                class="radio-pill-label" for="ado0_o">Occasionnel</label></div>
                        <div><input type="radio" class="radio-pill" id="ado0_pa"
                                name="data[FeedbackProduit][0][adoption]" value="pas_adoption"><label
                                class="radio-pill-label" for="ado0_pa">Pas d'adoption</label></div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn-add" onclick="addFeedback()"><i class="fa-solid fa-plus"></i> Ajouter un
            produit</button>
    </div>

    <!-- ========== 3. PRESCRIPTION CONCURRENTS ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-scale-unbalanced"></i> Prescription des concurrents</h3>
        <div id="concurrent-container">
            <div class="concurrent-block" data-index="0">
                <div class="field-group">
                    <label class="form-label">Produit ODP concerné</label>
                    <select class="form-input" name="data[Concurrent][0][produit_id]">
                        <option value="">Choisissez un produit</option>
                        <?php foreach ($games as $k => $g): ?>
                            <option value="<?php echo $k; ?>"><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field-group">
                    <label class="form-label">Produit concurrent</label>
                    <input type="text" class="form-input" name="data[Concurrent][0][concurrent]"
                        placeholder="Nom du produit concurrent">
                </div>
                <div class="field-group">
                    <label class="form-label">Fréquence de prescription</label>
                    <div class="radio-group">
                        <div><input type="radio" class="radio-pill" id="freq0_r" name="data[Concurrent][0][frequence]"
                                value="regulierement"><label class="radio-pill-label"
                                for="freq0_r">Régulièrement</label></div>
                        <div><input type="radio" class="radio-pill" id="freq0_m" name="data[Concurrent][0][frequence]"
                                value="moderement"><label class="radio-pill-label" for="freq0_m">Modérément</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn-add" onclick="addConcurrent()" style="background:#ff7043"><i
                class="fa-solid fa-plus"></i> Ajouter un concurrent</button>
    </div>

    <!-- ========== 4. DISTRIBUTION EMG ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-box-open"></i> Distribution EMG par produit</h3>
        <div class="emg-toggle">
            <div><input type="radio" class="radio-pill" id="emg_oui" name="data[Emg][distribue]" value="1"
                    onclick="toggleEmg(true)"><label class="radio-pill-label" for="emg_oui">✅ Oui</label></div>
            <div><input type="radio" class="radio-pill" id="emg_non" name="data[Emg][distribue]" value="0"
                    onclick="toggleEmg(false)" checked><label class="radio-pill-label" for="emg_non">❌ Non</label></div>
        </div>
        <div id="emg-produits-container">
            <div id="emg-list">
                <div class="emg-produit-block" data-index="0">
                    <div class="field-group">
                        <label class="form-label">Produit</label>
                        <select class="form-input" name="data[EmgProduit][0][produit_id]">
                            <option value="">Choisissez</option>
                            <?php foreach ($games as $k => $g): ?>
                                <option value="<?php echo $k; ?>"><?php echo $g; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="form-label">Quantité</label>
                        <input type="number" class="form-input" name="data[EmgProduit][0][quantite]" placeholder="0"
                            min="0">
                    </div>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addEmgProduit()" style="background:#7c4dff"><i
                    class="fa-solid fa-plus"></i> Ajouter un produit</button>
        </div>
    </div>

    <!-- ========== 5. COMMENTAIRE ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-comment-dots"></i> Commentaire complémentaire</h3>
        <textarea class="form-input" name="data[Visite][commentaire]" rows="3" placeholder="Précisez ici..."></textarea>
    </div>

    <!-- ========== 6. ODP ========== -->
    <?php if (count($ordres) > 0): ?>
        <div class="section-card">
            <h3 class="section-title"><i class="fa-solid fa-images"></i> Ordre de présentation (ODP)</h3>
            <div class="odp-grid">
                <?php foreach ($ordres as $value): ?>
                    <div class="odp-item">
                        <label class="image-checkbox">
                            <?php if (!empty($value["Brochure"]["logo"])): ?>
                                <img class="img-responsive"
                                    src="<?php echo $this->Html->url("/img/brochures/" . $value["Brochure"]["logo"]) ?>" />
                            <?php else: ?>
                                <img class="img-responsive"
                                    src="https://dummyimage.com/200x100/eee/999&text=<?php echo urlencode($value["Brochure"]["name"]); ?>" />
                            <?php endif; ?>
                            <input type="checkbox" class="checkbox" id="<?php echo $value["Brochure"]["id"]; ?>" name="image[]"
                                value="" />
                            <i class="fa fa-"><?php echo $value["Brochureorganise"]["ordre"]; ?></i>
                            <i class="order hidden" id="i<?php echo $value["Brochure"]["id"]; ?>"></i>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php echo $this->Form->input('order', array('label' => false, 'required')); ?>
        </div>
    <?php endif; ?>

    <!-- ========== 7. REQUETE CRM ========== -->
    <div class="section-card">
        <h3 class="section-title"><i class="fa-solid fa-bell" style="color:#ff9800"></i> Requête à remonter à l'équipe
            CRM</h3>
        <textarea class="form-input" name="data[Visite][requete_crm]" rows="3" placeholder="Précisez ici..."></textarea>
    </div>

    <?php echo $this->Form->end(); ?>
</div>

<!-- Submit button -->
<div class="submit-section">
    <button type="button" id="btn-prev" class="btn-prev" onclick="prevStep()"><i class="fa-solid fa-arrow-left"></i>
        Précédent</button>
    <button type="button" id="btn-next" class="btn-next" onclick="nextStep()">Suivant <i
            class="fa-solid fa-arrow-right"></i></button>
    <button type="submit" id="btn-submit-wizard" form="rapportV2Form" class="btn-submit">
        <i class="fa-solid fa-paper-plane"></i> Enregistrer
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // ---- Games data for JS cloning ----
    var gamesOptions = '<?php $opts = "<option value=\"\">Choisissez</option>";
    foreach ($games as $k => $g) {
        $g = addslashes($g);
        $opts .= "<option value=\"$k\">$g</option>";
    }
    echo $opts; ?>';

    var objCats = <?php
    $cats = array('prix' => 'Prix', 'presentation' => 'Présentation', 'efficacite' => 'Efficacité', 'msg_principal_1' => 'Message principal 1', 'tolerance' => 'Tolérance', 'disponibilite' => 'Disponibilité', 'msg_principal_2' => 'Message principal 2', 'autre' => 'Autre', 'msg_secondaire' => 'Message Secondaire');
    echo json_encode($cats);
    ?>;

    // ---- Feedback Produits (repeatable) ----
    var fbIndex = 1;
    function addFeedback() {
        var i = fbIndex++;
        var chipsHtml = '';
        $.each(objCats, function (val, label) {
            chipsHtml += '<div><input type="checkbox" class="chip-check" id="obj' + i + '_' + val + '" name="data[FeedbackProduit][' + i + '][objections][]" value="' + val + '"><label class="chip-label" for="obj' + i + '_' + val + '">' + label + '</label></div>';
        });
        var html = '<div class="feedback-block" data-index="' + i + '">' +
            '<button type="button" class="btn-remove" onclick="$(this).parent().remove()"><i class="fa-solid fa-times"></i></button>' +
            '<div class="field-group"><label class="form-label">Produit ODP</label><select class="form-input" name="data[FeedbackProduit][' + i + '][produit_id]" required>' + gamesOptions + '</select></div>' +
            '<div class="field-group"><label class="form-label">Catégorie d\'objection</label><div class="chip-group">' + chipsHtml + '</div></div>' +
            '<div class="field-group"><label class="form-label">Retour du médecin</label><div class="radio-group">' +
            '<div><input type="radio" class="radio-pill" id="ret' + i + '_p" name="data[FeedbackProduit][' + i + '][retour]" value="positif"><label class="radio-pill-label" for="ret' + i + '_p">😊 Positif</label></div>' +
            '<div><input type="radio" class="radio-pill" id="ret' + i + '_m" name="data[FeedbackProduit][' + i + '][retour]" value="mitige"><label class="radio-pill-label" for="ret' + i + '_m">😐 Mitigé</label></div>' +
            '<div><input type="radio" class="radio-pill" id="ret' + i + '_n" name="data[FeedbackProduit][' + i + '][retour]" value="negatif"><label class="radio-pill-label" for="ret' + i + '_n">😞 Négatif</label></div>' +
            '</div></div>' +
            '<div class="field-group"><label class="form-label">Préciser</label><input type="text" class="form-input" name="data[FeedbackProduit][' + i + '][preciser]" placeholder="Précisez ici..."></div>' +
            '<div class="field-group"><label class="form-label">Niveau d\'adoption</label><div class="radio-group">' +
            '<div><input type="radio" class="radio-pill" id="ado' + i + '_r" name="data[FeedbackProduit][' + i + '][adoption]" value="regulier"><label class="radio-pill-label" for="ado' + i + '_r">Régulier</label></div>' +
            '<div><input type="radio" class="radio-pill" id="ado' + i + '_o" name="data[FeedbackProduit][' + i + '][adoption]" value="occasionnel"><label class="radio-pill-label" for="ado' + i + '_o">Occasionnel</label></div>' +
            '<div><input type="radio" class="radio-pill" id="ado' + i + '_pa" name="data[FeedbackProduit][' + i + '][adoption]" value="pas_adoption"><label class="radio-pill-label" for="ado' + i + '_pa">Pas d\'adoption</label></div>' +
            '</div></div></div>';
        $('#feedback-container').append(html);
    }

    // ---- Concurrents (repeatable) ----
    var ccIndex = 1;
    function addConcurrent() {
        var i = ccIndex++;
        var html = '<div class="concurrent-block" data-index="' + i + '">' +
            '<button type="button" class="btn-remove" onclick="$(this).parent().remove()"><i class="fa-solid fa-times"></i></button>' +
            '<div class="field-group"><label class="form-label">Produit ODP concerné</label><select class="form-input" name="data[Concurrent][' + i + '][produit_id]">' + gamesOptions + '</select></div>' +
            '<div class="field-group"><label class="form-label">Produit concurrent</label><input type="text" class="form-input" name="data[Concurrent][' + i + '][concurrent]" placeholder="Nom du produit concurrent"></div>' +
            '<div class="field-group"><label class="form-label">Fréquence</label><div class="radio-group">' +
            '<div><input type="radio" class="radio-pill" id="freq' + i + '_r" name="data[Concurrent][' + i + '][frequence]" value="regulierement"><label class="radio-pill-label" for="freq' + i + '_r">Régulièrement</label></div>' +
            '<div><input type="radio" class="radio-pill" id="freq' + i + '_m" name="data[Concurrent][' + i + '][frequence]" value="moderement"><label class="radio-pill-label" for="freq' + i + '_m">Modérément</label></div>' +
            '</div></div></div>';
        $('#concurrent-container').append(html);
    }

    // ---- EMG ----
    function toggleEmg(show) {
        $('#emg-produits-container').toggle(show);
    }
    var emgIndex = 1;
    function addEmgProduit() {
        var i = emgIndex++;
        var html = '<div class="emg-produit-block" data-index="' + i + '">' +
            '<button type="button" class="btn-remove" onclick="$(this).parent().remove()"><i class="fa-solid fa-times"></i></button>' +
            '<div class="field-group"><label class="form-label">Produit</label><select class="form-input" name="data[EmgProduit][' + i + '][produit_id]">' + gamesOptions + '</select></div>' +
            '<div class="field-group"><label class="form-label">Quantité</label><input type="number" class="form-input" name="data[EmgProduit][' + i + '][quantite]" placeholder="0" min="0"></div></div>';
        $('#emg-list').append(html);
    }

    // ---- ODP (image gallery click order) ----
    var odpCount = 1;
    $(".image-checkbox").on("click", function (e) {
        var $checkbox = $(this).find('input[type="checkbox"]');
        if ($checkbox.prop("checked")) {
            $(".image-checkbox").each(function () {
                $(this).find('input[type="checkbox"]').prop("checked", false);
                $(this).removeClass('image-checkbox-checked');
            });
            odpCount = 1;
            $("#VisiteOrder").attr("value", "");
        } else {
            $(this).toggleClass('image-checkbox-checked');
            $checkbox.prop("checked", !$checkbox.prop("checked"));
            var id = $checkbox.attr("id");
            var order = $("#VisiteOrder").val();
            order += id + ",";
            $("#VisiteOrder").attr("value", order);
            $("#i" + id).text(odpCount);
            e.preventDefault();
            odpCount++;
        }
    });

    // ---- Validation + Submit ----
    function clearWizardValidation() {
        $('.field-group').removeClass('is-invalid');
        $('.form-input').removeClass('is-invalid');
        $('.validation-message').remove();
    }

    function isRequiredFieldEnabled($field) {
        var enabled = true;

        $field.parents().each(function () {
            if (this.tagName && this.tagName.toLowerCase() === 'form') {
                return false;
            }

            var $parent = $(this);
            if ($parent.hasClass('section-card')) {
                return;
            }

            if ($parent.css('display') === 'none' || $parent.css('visibility') === 'hidden') {
                enabled = false;
                return false;
            }
        });

        return enabled;
    }

    function getFieldLabel($field) {
        if ($field.attr('id') === 'VisiteOrder') {
            return 'Ordre de présentation (ODP)';
        }

        var label = $.trim($field.closest('.field-group').find('.form-label:first').text());
        return label || 'Ce champ';
    }

    function showRequiredFieldError(field) {
        var $field = $(field);
        var $section = $field.closest('.section-card');
        var stepIndex = $steps.index($section);

        if (stepIndex >= 0) {
            currentStep = stepIndex;
            showStep(currentStep);
        }

        var $group = $field.closest('.field-group');
        if (!$group.length) {
            $group = $field.closest('.input');
        }
        var message = getFieldLabel($field) + ' est obligatoire.';

        if ($group.length) {
            $group.addClass('is-invalid');
            if ($group.find('.validation-message').length === 0) {
                $group.append('<div class="validation-message">' + message + '</div>');
            }
        } else {
            $field.addClass('is-invalid');
        }

        setTimeout(function () {
            var scrollTarget = $group.length ? $group[0] : field;
            scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });

            if ($field.is(':visible') && field.type !== 'hidden') {
                field.focus();
            }

            if ($field.is(':visible') && field.reportValidity) {
                field.reportValidity();
            }
        }, 80);
    }

    function validateWizardForm(form) {
        clearWizardValidation();

        var invalidField = null;
        $(form).find('[required]').each(function () {
            if (this.disabled || !isRequiredFieldEnabled($(this))) {
                return;
            }

            if (!this.checkValidity()) {
                invalidField = this;
                return false;
            }
        });

        if (invalidField) {
            showRequiredFieldError(invalidField);
            return false;
        }

        return true;
    }

    function handleSubmitV2() {
        if (window.ReactNativeWebView) {
            window.ReactNativeWebView.postMessage('post');
        }
    }

    // ---- Step Wizard ----
    var currentStep = 0;
    var $steps;

    $(document).ready(function () {
        $steps = $('.section-card');
        showStep(0);

        $('#rapportV2Form').on('submit', function (e) {
            if (!validateWizardForm(this)) {
                e.preventDefault();
                return false;
            }

            handleSubmitV2();
        });
    });

    function showStep(index) {
        $steps.removeClass('active');
        $($steps[index]).addClass('active');

        if (index === 0) {
            $('#btn-prev').hide();
        } else {
            $('#btn-prev').show();
        }

        if (index === $steps.length - 1) {
            $('#btn-next').hide();
            $('#btn-submit-wizard').show();
        } else {
            $('#btn-next').show();
            $('#btn-submit-wizard').hide();
        }

        window.scrollTo(0, 0);
    }

    function nextStep() {
        if (currentStep < $steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }
</script>
