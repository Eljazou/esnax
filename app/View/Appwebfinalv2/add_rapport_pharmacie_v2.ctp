<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/lucide@0.344.0/dist/umd/lucide.min.js"></script>

<?php 
echo $this->Html->css('connectpro-theme');
echo $this->Html->css('/app/View/Appwebfinal/my_style'); 
echo $this->Html->css('all'); 
?>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: var(--font-family, 'Inter', sans-serif);
        background: #f4f6f9;
        margin: 0;
    }

    .header {
        position: fixed;
        top: 0;
        display: flex;
        width: 100%;
        padding: 0 20px;
        z-index: 99;
        margin: 0;
        left: 0;
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
        border-bottom: 1px solid #d4e0d9;
        height: 70px;
        justify-content: space-between;
        align-items: center;
    }

    .header p {
        font-size: 17px;
        font-weight: 600;
        font-family: var(--font-family, 'Inter', sans-serif);
        margin: 0;
    }

    .btn-back {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: #f4f8f6;
        display: flex; align-items: center; justify-content: center;
        color: #1a2e24;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #e6f5ee;
        color: #006241;
        text-decoration: none;
    }

    .all-elements {
        margin-top: 85px;
        padding: 0 14px 100px;
    }

    .section-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 16px;
        border: 1px solid #d4e0d9;
        box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
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
        color: #006241;
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
        background: #e6f5ee;
        color: #006241;
        border-color: #006241;
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
        background: #e6f5ee;
        color: #006241;
        border-color: #006241;
        font-weight: 600;
    }

    .form-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        font-family: var(--font-family, 'Inter', sans-serif);
        background: #fafafa;
        transition: border .2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #006241;
        background: #fff;
        box-shadow: 0 4px 16px rgba(0, 98, 65, 0.08);
    }

    .field-group.is-invalid .form-input,
    .form-input.is-invalid {
        border-color: #ef5350;
        background: #fff5f5;
    }

    .field-group.is-invalid .chip-group,
    .field-group.is-invalid .radio-group {
        border: 1px solid #ef5350;
        padding: 8px;
        border-radius: 8px;
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
        background: #006241;
        color: #fff;
        border: none;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
        font-family: var(--font-family, 'Inter', sans-serif);
        margin-top: 10px;
    }

    .btn-add:active {
        background: #004d33;
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

    .analyse-block,
    .concurrent-block {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        position: relative;
        border-left: 3px solid #006241;
    }

    .concurrent-block {
        border-left-color: #ff7043;
    }

    .field-group {
        margin-bottom: 12px;
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
        border-color: #006241;
        border-radius: 10px;
    }

    .image-checkbox .fa {
        position: absolute;
        display: block !important;
        color: #006241;
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
        background-color: #006241;
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
        background: linear-gradient(135deg, #006241, #00875A);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        font-family: var(--font-family, 'Inter', sans-serif);
        cursor: pointer;
        flex: 2;
        display: none;
    }

    .btn-submit:active {
        background: linear-gradient(135deg, #004d33, #006241);
    }

    .btn-prev,
    .btn-next {
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        font-family: var(--font-family, 'Inter', sans-serif);
        cursor: pointer;
        flex: 1;
    }

    .btn-prev {
        background: #e0e0e0;
        color: #555;
    }

    .btn-next {
        background: linear-gradient(135deg, #006241, #00875A);
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
        <a class="btn_spiner btn-back"
            href="<?php echo $this->Html->url(array("action" => "view_client", $code, $client_id)); ?>">
            <i data-lucide="chevron-left"></i>
        </a>
    </div>
    <div style="padding:0">
        <p>Rapport Pharmacie V2</p>
    </div>
    <div style="width:40px"></div>
</div>

<div class="all-elements">
    <?php echo $this->Form->create('Visite', array('id' => 'rapportPharmacieV2Form', 'novalidate' => 'novalidate')); ?>
    <?php echo $this->Form->hidden('client_id', array('value' => $client_id)); ?>

    <!-- ========== I. PROFIL PHARMACIE ========== -->
    <div class="section-card">
        <h3 class="section-title"><i data-lucide="store"></i> Profil Pharmacie</h3>

        <div class="field-group">
            <label class="form-label">Type de pharmacie</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="type_actif" name="data[Visite][type_pharmacie]"
                        value="client_actif"><label class="radio-pill-label" for="type_actif">Client actif</label></div>
                <div><input type="radio" class="radio-pill" id="type_occ" name="data[Visite][type_pharmacie]"
                        value="client_occasionnel"><label class="radio-pill-label" for="type_occ">Client
                        occasionnel</label></div>
                <div><input type="radio" class="radio-pill" id="type_prospect" name="data[Visite][type_pharmacie]"
                        value="prospect"><label class="radio-pill-label" for="type_prospect">Prospect</label></div>
            </div>
        </div>

        <div class="field-group">
            <label class="form-label">Niveau d'activité globale</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="act_forte" name="data[Visite][niveau_activite]"
                        value="forte_rotation"><label class="radio-pill-label" for="act_forte">Forte rotation</label>
                </div>
                <div><input type="radio" class="radio-pill" id="act_moyenne" name="data[Visite][niveau_activite]"
                        value="moyenne_rotation"><label class="radio-pill-label" for="act_moyenne">Moyenne
                        rotation</label></div>
                <div><input type="radio" class="radio-pill" id="act_faible" name="data[Visite][niveau_activite]"
                        value="faible_rotation"><label class="radio-pill-label" for="act_faible">Faible rotation</label>
                </div>
            </div>
        </div>

        <div class="field-group">
            <label class="form-label">Positionnement</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="pos_hopital" name="data[Visite][positionnement]"
                        value="proche_hopital"><label class="radio-pill-label" for="pos_hopital">Proche hôpital
                        public</label></div>
                <div><input type="radio" class="radio-pill" id="pos_clinique" name="data[Visite][positionnement]"
                        value="proche_clinique"><label class="radio-pill-label" for="pos_clinique">Proche clinique
                        privée</label></div>
                <div><input type="radio" class="radio-pill" id="pos_cabinet" name="data[Visite][positionnement]"
                        value="proche_cabinet"><label class="radio-pill-label" for="pos_cabinet">Proche cabinet</label>
                </div>
                <div><input type="radio" class="radio-pill" id="pos_aucune" name="data[Visite][positionnement]"
                        value="aucune_proximite"><label class="radio-pill-label" for="pos_aucune">Aucune proximité
                        médicale</label></div>
            </div>
        </div>
    </div>

    <!-- ========== II. ANALYSE PAR PRODUIT ========== -->
    <div class="section-card">
        <h3 class="section-title"><i data-lucide="package"></i> Analyse par Produit</h3>
        <div id="analyse-container">
            <!-- JS Inject -->
        </div>
        <button type="button" class="btn-add" onclick="addAnalyse()"><i data-lucide="plus"></i> Ajouter un
            produit</button>
    </div>

    <!-- ========== III. CONCURRENCE ========== -->
    <div class="section-card">
        <h3 class="section-title"><i data-lucide="git-compare"></i> Concurrence</h3>
        <div class="field-group">
            <label class="form-label">Existe-t-il une offre concurrente signalée ?</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="conc_oui" name="data[Visite][existe_concurrence]"
                        value="oui" onclick="toggleConcurrence(true)"><label class="radio-pill-label"
                        for="conc_oui">Oui</label></div>
                <div><input type="radio" class="radio-pill" id="conc_non" name="data[Visite][existe_concurrence]"
                        value="non" onclick="toggleConcurrence(false)" checked><label class="radio-pill-label"
                        for="conc_non">Non</label></div>
            </div>
        </div>

        <div id="concurrence-container" style="display: none; margin-top: 15px;">
            <!-- JS Inject -->
        </div>
        <button type="button" id="btn-add-concurrent" class="btn-add" onclick="addConcurrent()"
            style="background:#ff7043; display: none;"><i data-lucide="plus"></i> Ajouter un concurrent</button>
    </div>

    <!-- ========== 4. COMMENTAIRE ========== -->
    <div class="section-card">
        <h3 class="section-title"><i data-lucide="message-square"></i> Commentaire complémentaire</h3>
        <textarea class="form-input" name="data[Visite][commentaire]" rows="3" placeholder="Précisez ici..."></textarea>
    </div>

    <!-- ========== 5. REQUETE CRM ========== -->
    <div class="section-card">
        <h3 class="section-title"><i data-lucide="bell" style="color:#ff9800"></i> Requête à remonter à l'équipe
            CRM</h3>
        <textarea class="form-input" name="data[Visite][requete_crm]" rows="3" placeholder="Précisez ici..."></textarea>
    </div>

    <!-- ========== 6. ODP ========== -->
    <?php if (count($ordres) > 0): ?>
        <div class="section-card">
            <h3 class="section-title"><i data-lucide="image"></i> Ordre de présentation (ODP)</h3>
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

    <?php echo $this->Form->end(); ?>
</div>

<!-- Submit button -->
<div class="submit-section">
    <button type="button" id="btn-prev" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i>
        Précédent</button>
    <button type="button" id="btn-next" class="btn-next" onclick="nextStep()">Suivant <i
            data-lucide="arrow-right"></i></button>
    <button type="submit" id="btn-submit-wizard" form="rapportPharmacieV2Form" class="btn-submit">
        <i data-lucide="send"></i> Enregistrer
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // ---- Games data for JS cloning ----
    var gamesOptions = '<?php $opts = "<option value=\"\">Choisissez un produit ODP</option>";
    foreach ($games as $k => $g) {
        $g = addslashes($g);
        $opts .= "<option value=\"$k\">$g</option>";
    }
    echo $opts; ?>';

    // ---- Analyse par Produit (repeatable) ----
    var analyseIndex = 0;
    function addAnalyse() {
        var i = analyseIndex++;
        var html = `
    <div class="analyse-block" data-index="${i}">
        <button type="button" class="btn-remove" onclick="$(this).parent().remove()"><i data-lucide="x"></i></button>

        <div class="field-group">
            <label class="form-label">Produit concerné</label>
            <select class="form-input" name="data[AnalyseProduit][${i}][produit_id]" required>
                ${gamesOptions}
            </select>
        </div>

        <div class="field-group">
            <label class="form-label">Situation du produit (Disponibilité)</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="disp_rupt_${i}" name="data[AnalyseProduit][${i}][disponibilite]" value="rupture_grossiste" onchange="toggleDispo(${i})"><label class="radio-pill-label" for="disp_rupt_${i}">Rupture Grossiste</label></div>
                <div><input type="radio" class="radio-pill" id="disp_0_${i}" name="data[AnalyseProduit][${i}][disponibilite]" value="0_boites" onchange="toggleDispo(${i})"><label class="radio-pill-label" for="disp_0_${i}">0 boites</label></div>
                <div><input type="radio" class="radio-pill" id="disp_autre_${i}" name="data[AnalyseProduit][${i}][disponibilite]" value="autre" onchange="toggleDispo(${i})"><label class="radio-pill-label" for="disp_autre_${i}">Sinon préciser le nombre de boîtes</label></div>
            </div>
            
            <div id="div_grossiste_${i}" style="display: none; margin-top: 8px;">
                <input type="text" class="form-input" name="data[AnalyseProduit][${i}][grossiste]" placeholder="Préciser Quel Grossiste : ...">
            </div>
            
            <div id="div_dispo_boites_${i}" style="display: none; margin-top: 8px;">
                <input type="number" class="form-input" name="data[AnalyseProduit][${i}][dispo_boites]" placeholder="Nombre de boîtes (ex: 3)">
            </div>
        </div>

        <div class="field-group">
            <label class="form-label">Rotation mensuelle</label>
            <input type="number" class="form-input" name="data[AnalyseProduit][${i}][rotation_boites]" placeholder="Sélectionner le nombre de boîtes :" style="margin-bottom: 8px;">
            <input type="text" class="form-input" name="data[AnalyseProduit][${i}][prescripteurs]" placeholder="Mentionner les prescripteurs : ...">
        </div>

        <div class="field-group">
            <label class="form-label">Produit conseillé par la pharmacie ?</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="cons_oui_${i}" name="data[AnalyseProduit][${i}][produit_conseille]" value="oui" onchange="toggleConseil(${i})"><label class="radio-pill-label" for="cons_oui_${i}">Oui</label></div>
                <div><input type="radio" class="radio-pill" id="cons_non_${i}" name="data[AnalyseProduit][${i}][produit_conseille]" value="non" onchange="toggleConseil(${i})"><label class="radio-pill-label" for="cons_non_${i}">Non</label></div>
                <div><input type="radio" class="radio-pill" id="cons_pas_${i}" name="data[AnalyseProduit][${i}][produit_conseille]" value="pas_infos" onchange="toggleConseil(${i})"><label class="radio-pill-label" for="cons_pas_${i}">Pas d'infos</label></div>
            </div>

            <div id="div_promesse_${i}" style="display: none; margin-top: 15px;">
                <label class="form-label">Promesse de mise en place du produit</label>
                <div class="radio-group" style="margin-bottom: 8px;">
                    <div><input type="radio" class="radio-pill" id="prom_oui_${i}" name="data[AnalyseProduit][${i}][promesse]" value="oui" onchange="togglePromesse(${i})"><label class="radio-pill-label" for="prom_oui_${i}">Oui</label></div>
                    <div><input type="radio" class="radio-pill" id="prom_non_${i}" name="data[AnalyseProduit][${i}][promesse]" value="non" onchange="togglePromesse(${i})"><label class="radio-pill-label" for="prom_non_${i}">Non</label></div>
                </div>
            </div>

            <div id="div_nombre_boites_${i}" style="display: none; margin-top: 8px;">
                <input type="number" class="form-input" name="data[AnalyseProduit][${i}][nombre_boites]" placeholder="Préciser le nombre de boîtes : ...">
            </div>
        </div>
    </div>
    `;
        $('#analyse-container').append(html);
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // ---- Concurrents (repeatable) ----
    var concIndex = 0;
    function addConcurrent() {
        var i = concIndex++;
        var html = `
    <div class="concurrent-block" data-index="${i}">
        <button type="button" class="btn-remove" onclick="$(this).parent().remove()"><i data-lucide="x"></i></button>

        <div class="field-group">
            <label class="form-label">Si "Oui" , préciser le produit concerné :</label>
            <select class="form-input" name="data[Concurrent][${i}][produit_id]" required style="margin-bottom: 8px;">
                ${gamesOptions}
            </select>
            <input type="text" class="form-input" name="data[Concurrent][${i}][produit_concurrent]" placeholder="Préciser le produit concurrent : ...">
        </div>

        <div class="field-group">
            <label class="form-label">Type de l'offre</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="offre_remise_${i}" name="data[Concurrent][${i}][type_offre]" value="remise" onchange="toggleOffre(${i})"><label class="radio-pill-label" for="offre_remise_${i}">Remise</label></div>
                <div><input type="radio" class="radio-pill" id="offre_autres_${i}" name="data[Concurrent][${i}][type_offre]" value="autres" onchange="toggleOffre(${i})"><label class="radio-pill-label" for="offre_autres_${i}">Autres</label></div>
            </div>

            <div id="div_remise_${i}" style="display: none; margin-top: 15px;">
                <label class="form-label">Si "Remise", préciser le type :</label>
                <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                    <span style="font-size: 9px; font-weight: 500; min-width: 120px; padding-top: 8px;">Bons d'achat</span>
                    <input type="text" class="form-input" name="data[Concurrent][${i}][remise_bons]" placeholder="Préciser : ...">
                </div>
                <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                    <span style="font-size: 9px; font-weight: 500; min-width: 120px; padding-top: 8px;">Financière</span>
                    <input type="text" class="form-input" name="data[Concurrent][${i}][remise_financiere]" placeholder="Préciser : ...">
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="font-size: 9px; font-weight: 500; min-width: 120px; padding-top: 8px;">Unités gratuites</span>
                    <input type="text" class="form-input" name="data[Concurrent][${i}][remise_unites]" placeholder="Préciser : ...">
                </div>
            </div>
        </div>

        <div class="field-group">
            <label class="form-label">Emplacement</label>
            <div class="radio-group">
                <div><input type="radio" class="radio-pill" id="emp_vitrine_${i}" name="data[Concurrent][${i}][emplacement]" value="vitrine"><label class="radio-pill-label" for="emp_vitrine_${i}">Vitrine</label></div>
                <div><input type="radio" class="radio-pill" id="emp_comptoir_${i}" name="data[Concurrent][${i}][emplacement]" value="visible_comptoir"><label class="radio-pill-label" for="emp_comptoir_${i}">Visible comptoir</label></div>
                <div><input type="radio" class="radio-pill" id="emp_stock_${i}" name="data[Concurrent][${i}][emplacement]" value="stock"><label class="radio-pill-label" for="emp_stock_${i}">Non exposé (Stock)</label></div>
            </div>
        </div>
    </div>
    `;
        $('#concurrence-container').append(html);
    }

    // ---- Togglers ----
    function toggleDispo(i) {
        var val = $('input[name="data[AnalyseProduit][' + i + '][disponibilite]"]:checked').val();
        if (val === 'rupture_grossiste') {
            $('#div_grossiste_' + i).show();
            $('#div_dispo_boites_' + i).hide();
        } else if (val === 'autre') {
            $('#div_grossiste_' + i).hide();
            $('#div_dispo_boites_' + i).show();
        } else {
            $('#div_grossiste_' + i).hide();
            $('#div_dispo_boites_' + i).hide();
        }
    }

    function toggleConseil(i) {
        var val = $('input[name="data[AnalyseProduit][' + i + '][produit_conseille]"]:checked').val();
        if (val === 'non') {
            $('#div_promesse_' + i).show();
            var promVal = $('input[name="data[AnalyseProduit][' + i + '][promesse]"]:checked').val();
            if (promVal === 'oui') {
                $('#div_nombre_boites_' + i).show();
            } else {
                $('#div_nombre_boites_' + i).hide();
            }
        } else if (val === 'oui') {
            $('#div_promesse_' + i).hide();
            $('input[name="data[AnalyseProduit][' + i + '][promesse]"]').prop('checked', false);
            $('#div_nombre_boites_' + i).show();
        } else {
            $('#div_promesse_' + i).hide();
            $('input[name="data[AnalyseProduit][' + i + '][promesse]"]').prop('checked', false);
            $('#div_nombre_boites_' + i).hide();
        }
    }

    function togglePromesse(i) {
        var val = $('input[name="data[AnalyseProduit][' + i + '][promesse]"]:checked').val();
        if (val === 'oui') {
            $('#div_nombre_boites_' + i).show();
        } else {
            $('#div_nombre_boites_' + i).hide();
        }
    }

    function toggleConcurrence(show) {
        if (show) {
            $('#concurrence-container').show();
            $('#btn-add-concurrent').show();
            if ($('#concurrence-container').children().length === 0) {
                addConcurrent();
            }
        } else {
            $('#concurrence-container').hide();
            $('#btn-add-concurrent').hide();
        }
    }

    function toggleOffre(i) {
        var val = $('input[name="data[Concurrent][' + i + '][type_offre]"]:checked').val();
        if (val === 'remise') {
            $('#div_remise_' + i).show();
        } else {
            $('#div_remise_' + i).hide();
        }
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
        $('.field-group, .odp-grid, .analyse-block, .concurrent-block').removeClass('is-invalid');
        $('.step-validation-msg').remove();
    }

    function validateCurrentStep() {
        clearWizardValidation();
        var $current = $($steps[currentStep]);
        var isValid = true;
        var firstInvalidField = null;

        function markInvalid($el, msg) {
            isValid = false;
            var $group = $el.closest('.field-group');
            if (!$group.length) $group = $el.parent();
            
            if (!$group.hasClass('is-invalid')) {
                $group.addClass('is-invalid');
                if ($group.find('.step-validation-msg').length === 0) {
                    $group.append('<div class="step-validation-msg validation-message" style="display:block">' + msg + '</div>');
                }
            }
            if (!firstInvalidField) {
                firstInvalidField = $group[0];
            }
        }

        var processedGroups = {};

        $current.find('input, select, textarea').each(function() {
            var $field = $(this);
            var name = $field.attr('name');
            if (!name) return true;
            
            if (name.indexOf('commentaire') !== -1 || name.indexOf('requete_crm') !== -1) {
                return true; 
            }

            if ($field.attr('type') === 'hidden') return true;

            if (!$field.parent().is(':visible')) {
                return true;
            }

            if ($field.is(':radio') || $field.hasClass('chip-check')) {
                if (processedGroups[name]) return true;
                processedGroups[name] = true;

                if ($field.is(':radio')) {
                    var safeName = name.replace(/\[/g, '\\[').replace(/\]/g, '\\]');
                    if ($('input[name="' + safeName + '"]:checked').length === 0) {
                        markInvalid($field, 'Veuillez faire un choix');
                    }
                } else if ($field.is(':checkbox')) {
                    var $chipGroup = $field.closest('.chip-group');
                    if ($chipGroup.length && $chipGroup.find('input[type="checkbox"]:checked').length === 0) {
                        markInvalid($field, 'Veuillez sélectionner au moins une option');
                    }
                }
            } else if ($field.is('input[type="text"], input[type="number"], select')) {
                if (name.indexOf('remise_') !== -1) {
                    var match = name.match(/\[(\d+)\]/);
                    if (match) {
                        var idx = match[1];
                        var b = $.trim($('input[name="data[Concurrent]['+idx+'][remise_bons]"]').val());
                        var f = $.trim($('input[name="data[Concurrent]['+idx+'][remise_financiere]"]').val());
                        var u = $.trim($('input[name="data[Concurrent]['+idx+'][remise_unites]"]').val());
                        if (b === '' && f === '' && u === '') {
                            markInvalid($field, 'Veuillez renseigner au moins une remise');
                        }
                    }
                } else {
                    if ($.trim($field.val()) === '') {
                        markInvalid($field, 'Ce champ est obligatoire');
                    }
                }
            }
        });

        // Containers
        if ($current.find('#analyse-container').length && $current.find('.analyse-block').length === 0) {
            isValid = false;
            var $cont = $('#analyse-container');
            $cont.append('<div class="step-validation-msg validation-message" style="display:block">Veuillez ajouter au moins un produit</div>');
            firstInvalidField = firstInvalidField || $cont[0];
        }

        if ($current.find('#concurrence-container').length && $('#conc_oui').is(':checked')) {
            if ($current.find('.concurrent-block').length === 0) {
                isValid = false;
                var $cont2 = $('#concurrence-container');
                $cont2.append('<div class="step-validation-msg validation-message" style="display:block">Veuillez ajouter au moins un concurrent</div>');
                firstInvalidField = firstInvalidField || $cont2[0];
            }
        }

        // ODP hidden input validation
        var $odpInput = $current.find('#VisiteOrder');
        if ($odpInput.length > 0) {
            if ($.trim($odpInput.val()) === '') {
                markInvalid($odpInput.closest('.section-card').find('.odp-grid'), 'Veuillez sélectionner l\'ordre de présentation');
            }
        }

        $current.find('input, select, textarea').off('change.valid input.valid').on('change.valid input.valid', function() {
            var $g = $(this).closest('.field-group');
            if (!$g.length) $g = $(this).parent();
            $g.removeClass('is-invalid');
            $g.find('.step-validation-msg').remove();
        });

        if (!isValid && firstInvalidField) {
            setTimeout(function () { firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 80);
        }

        return isValid;
    }

    function validateWizardForm(form) {
        return validateCurrentStep();
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
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        addAnalyse();
        $steps = $('.section-card');
        showStep(0);

        $('#rapportPharmacieV2Form').on('submit', function (e) {
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
            if (!validateCurrentStep()) return;
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
