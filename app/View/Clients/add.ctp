<?php  ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* =========================================================
       COMPACT SINGLE-COLUMN THEME — lavender / white / soft shadows
       Matches the "Editer la Brochure" card vibe
       ========================================================= */
    body, .panel, .panel-heading, .panel-body, label, input, select, button, h3, .panel-title {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-sizing: border-box !important;
    }
    *, *::before, *::after { box-sizing: border-box !important; }

    body { background: #eef0f7 !important; overflow-x: hidden !important; }

    /* 1. OUTER CARD — single column, fixed max-width, centered like the brochure editor */
    .panel-primary {
        background: #ffffff !important;
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 10px 30px rgba(31, 41, 82, 0.06) !important;
        padding: 28px 32px 24px 32px !important;
        margin: 20px auto !important;
        max-width: 720px !important;
        width: 100% !important;
        float: none !important;
        overflow: hidden !important;
    }

    /* nested panels created by the branch markup shouldn't double up on card styling */
    .panel-primary .panel-primary {
        box-shadow: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        max-width: none !important;
        background: transparent !important;
    }

    .client-form-wrap { width: 100% !important; max-width: 100% !important; float: none !important; }

    /* 2. HEADER — icon badge + title + subtitle */
    .panel-heading {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        border-bottom: 1px solid #eef0f7 !important;
        border-radius: 0 !important;
        width: 100% !important;
        float: none !important;
        padding: 0 0 18px 0 !important;
        margin: 0 0 20px 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 14px !important;
    }
    .panel-heading::before {
        content: '';
        width: 46px; height: 46px; min-width: 46px;
        border-radius: 13px;
        background: linear-gradient(135deg, #ece9ff 0%, #e1e3fd 100%);
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238c7ef2' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2'/><circle cx='9' cy='7' r='4'/><path d='M22 21v-2a4 4 0 0 0-3-3.87'/><path d='M16 3.13a4 4 0 0 1 0 7.75'/></svg>");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 20px;
    }
    .panel-heading .heading-text { display: flex; flex-direction: column; gap: 2px; }
    .panel-heading .heading-sub {
        font-size: 13px; font-weight: 500; color: #8b8da8; margin: 0;
    }
    .panel-title, h3 {
        font-size: 21px !important;
        font-weight: 800 !important;
        color: #1a1d36 !important;
        margin: 0 !important;
    }

    /* 3. SECTION GROUPS — replace the old 2-column split, everything stacks in one column */
    .form-section { margin-bottom: 18px; }
    .form-section:last-of-type { margin-bottom: 4px; }

    .section-tag {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12.5px;
        font-weight: 700;
        color: #6c63f7;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 12px;
        padding-top: 4px;
    }
    .section-tag .dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: #8c7ef2;
        box-shadow: 0 0 0 4px rgba(140,126,242,0.15);
    }
    .section-tag.blue { color: #4a90e2; }
    .section-tag.blue .dot { background: #4a90e2; box-shadow: 0 0 0 4px rgba(74,144,226,0.15); }
    .section-tag.pink { color: #e2679a; }
    .section-tag.pink .dot { background: #e2679a; box-shadow: 0 0 0 4px rgba(226,103,154,0.15); }
    .section-tag.orange { color: #e2924a; }
    .section-tag.orange .dot { background: #e2924a; box-shadow: 0 0 0 4px rgba(226,146,74,0.15); }

    /* every field group is now a single full-width block, no more floated col-lg-6 */
    .panel-body.form-horizontal.payment-form,
    .panel-body.form-horizontal.payment-form .col-lg-6,
    .panel-body.form-horizontal.payment-form .col-lg-12,
    .panel-body.form-horizontal.payment-form .col-lg-10,
    .panel-body.form-horizontal.payment-form .col-md-10,
    .panel-body.form-horizontal.payment-form .col-md-6,
    .panel-body.form-horizontal.payment-form .col-md-12 {
        float: none !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        display: block !important;
    }

    /* two fields side-by-side within a section, kept tight and responsive */
    .field-pair { display: flex; gap: 14px; }
    .field-pair > .input { flex: 1 1 0; min-width: 0; }
    @media (max-width: 640px) {
        .field-pair { flex-direction: column; gap: 0; }
    }

    /* 4. LABELS — compact */
    .panel-body label {
        font-size: 11.5px !important;
        font-weight: 700 !important;
        color: #6b6d85 !important;
        margin-bottom: 5px !important;
        margin-top: 8px !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: inline-block;
    }
    .panel-body .input { margin-bottom: 2px !important; }

    /* 5. INPUTS / SELECTS — compact height like the brochure editor fields */
    .panel-body input[type="text"],
    .panel-body input[type="email"],
    .panel-body input[type="tel"],
    .panel-body select {
        height: 40px !important;
        width: 100% !important;
        background-color: #ffffff !important;
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        padding: 6px 14px !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #2b2c45 !important;
        transition: all 0.18s ease !important;
        box-shadow: none !important;
    }
    .panel-body input[type="text"]:focus,
    .panel-body input[type="email"]:focus,
    .panel-body input[type="tel"]:focus,
    .panel-body select:focus {
        background-color: #ffffff !important;
        border-color: #8c7ef2 !important;
        color: #1a1d36 !important;
        box-shadow: 0 0 0 3px rgba(140, 126, 242, 0.15) !important;
        outline: none !important;
    }

    /* select2 boxes to match, compact */
    .select2-container { width: 100% !important; max-width: 100% !important; }
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        min-height: 40px !important;
        background-color: #ffffff !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow: hidden !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        color: #2b2c45 !important;
        font-size: 13.5px !important;
        padding-left: 14px !important;
        padding-right: 30px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
    }
    .select2-selection__rendered { box-sizing: border-box !important; }

    /* 6. MAP / COORDINATE CARD — compact, matches section card look from the old theme */
    #map-card {
        background: #f8f9fd !important;
        border: 1px solid #eef0fb !important;
        border-radius: 14px !important;
        padding: 16px 18px !important;
        margin: 4px 0 18px 0 !important;
        clear: both;
        width: 100% !important;
    }
    #map-card table.table { margin-bottom: 10px !important; width: 100%; }
    #map-card table.table td { border: none !important; padding: 4px 10px 4px 0 !important; vertical-align: middle; }
    #map-card label[for*="lat"], #map-card label[for*="lng"] { color: #8c7ef2 !important; margin: 0 !important; }
    #map-canvas {
        border-radius: 12px !important;
        overflow: hidden !important;
        border: 1.5px solid #e4e6fb !important;
        width: 100% !important;
        height: 300px !important;
    }

    /* 7. FOOTER — Annuler (outline) + Envoyer (gradient), side by side like the brochure editor */
    .well.text-center {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        display: flex !important;
        justify-content: flex-end !important;
        gap: 12px !important;
        padding: 8px 0 0 0 !important;
        margin: 0 !important;
        width: 100% !important;
        float: none !important;
    }

    .btn-cancel {
        height: 42px;
        padding: 0 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff !important;
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #6b6d85 !important;
        text-decoration: none !important;
        transition: all 0.15s ease !important;
    }
    .btn-cancel:hover { background: #f8f9fd !important; color: #2b2c45 !important; text-decoration: none !important; }

    .panel-body button[type="submit"],
    .panel-body .btn-primary,
    .panel-body input[type="submit"] {
        height: 42px !important;
        padding: 0 30px !important;
        background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(140, 126, 242, 0.28) !important;
        cursor: pointer !important;
        margin: 0 !important;
        float: none !important;
        transition: transform 0.15s ease, box-shadow 0.15s ease !important;
    }
    .panel-body button[type="submit"]:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 10px 22px rgba(140, 126, 242, 0.38) !important;
    }
    .panel-body button[type="submit"]:active { transform: scale(0.98) !important; }

    /* misc: hospital field slide-toggle spacing */
    #hopital-field-add { margin-top: 4px; }
</style>
<?php echo $this->Html->css('select2.min'); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="heading-text">
            <h3 class="panel-title"><?php echo __('Ajouter un client'); ?></h3>
            <p class="heading-sub">Renseignez les informations du nouveau client</p>
        </div>
    </div>
    <div class="panel-body client-form-wrap">
        <?php
        $k = '';
        if ($type == null || $type == 'Médecin' ||  $type == 'Autres professions de la santé' ):
            ?>
            <div class="panel-body form-horizontal payment-form">
                <?php echo $this->Form->create('Client'); ?>

                <div class="form-section">
                    <div class="section-tag orange"><span class="dot"></span>Informations professionnelles</div>

                    <div class="input select"><label for="ClientsTypeId">Type</label>
                        <select name="data[Client][type_id]" onchange="location = this.value;" class="form-control" id="ClientsTypeId">
                            <option value="">(choisissez)</option>
                            <?php
                            foreach ($types as $key => $value) {
                                $selected = '';
                                if ($type == $value) {
                                    $selected = "selected";
                                    $k = $this->Form->input('type_id', array('type' => 'hidden', 'value' => $key));
                                }
                                echo "<option $selected value='" . $this->Html->url(array('action' => 'add', $value)) . "'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    echo $k;
                    echo $this->Form->input('secteur_id', array('label' => 'Secteur', 'class' => 'form-control select2'));
                    echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                    ?>
                    <div class="field-pair">
                        <div class="input select">
                            <label for="ClientCategoryId1">Tendance</label>
                            <select name="data[Client][category1_id]" class="form-control" id="ClientCategoryId1">
                                <option value="">Choisissez</option>
                                <?php
                                foreach ($categories as $key => $value) {
                                    echo "<option value='$key'>$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientCategoryId2">Titre</label>
                            <select name="data[Client][titre]" class="form-control" id="ClientCategoryId2">
                                <option value="Docteur">Docteur</option>
                                <option value="Professeur">Professeur</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-pair">
                        <div class="input select">
                            <label for="ClientActiviteSelectAdd">Activité</label>
                            <select name="data[Client][activite]" class="form-control" id="ClientActiviteSelectAdd">
                                <option value="Prive">Privé</option>
                                <option value="Publique">Publique</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientCategoryId4">Exercice</label>
                            <select name="data[Client][exercice]" class="form-control" id="ClientCategoryId4">
                                <option value="Centre de sante"> Centre de santé</option>
                                <option value="Cabinet prive">Cabinet privé</option>
                                <option value="Hopital">Hôpital</option>
                                <option value="Penitencier">Pénitencier</option>
                                <option value="Clinique">Clinique</option>
                            </select>
                        </div>
                    </div>
                    <div class="input select" id="hopital-field-add" style="display:none;">
                        <label>Hôpital</label>
                        <select name="data[Client][hopital_id]" id="ClientHopitalSelectAdd" class="form-control" style="width:100%">
                            <option value="">-- Choisir ou créer un hôpital --</option>
                            <?php foreach ($all_hopitals as $h_id => $h_name): ?>
                                <option value="<?php echo $h_id; ?>"><?php echo h($h_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field-pair">
                        <div class="input select">
                            <label for="ClientCategoryId5">Patients par Jour</label>
                            <select name="data[Client][A]" class="form-control" id="ClientCategoryId5">
                                <option value="A">Plus de 20</option>
                                <option value="B">Entre 10 et 20</option>
                                <option value="C">Moins de 10</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientCategoryId6">Adoption des produits Esnapharm</label>
                            <select name="data[Client][1]" class="form-control" id="ClientCategoryId6">
                                <option value="1">Exclusif</option>
                                <option value="2">Fidèle</option>
                                <option value="3">Rare</option>
                                <option value="4">Non</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->input('produits', array('name' => "data[Client][produits]", 'label' => 'La liste des gammes', 'class' => 'form-control select2', 'multiple' => "multiple"));
                    ?>
                </div>

                <div class="form-section">
                    <div class="section-tag blue"><span class="dot"></span>Coordonnées</div>
                    <div class="field-pair">
                        <?php echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control')); ?>
                    </div>
                    <?php echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control')); ?>
                    <div class="field-pair">
                        <?php echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control')); ?>
                    </div>
                    <?php
                    echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                    echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                    ?>
                </div>

            <?php
        elseif ($type == 'Pharmacie'):
            ?>
            <div class="panel-body form-horizontal payment-form">
                <?php echo $this->Form->create('Client'); ?>

                <div class="form-section">
                    <div class="section-tag orange"><span class="dot"></span>Informations professionnelles</div>

                    <div class="input select"><label for="ClientsTypeId">Type</label>
                        <select name="data[Client][type_id]" onchange="location = this.value;" class="form-control" id="ClientsTypeId">
                            <option value="">(choisissez)</option>
                            <?php
                            foreach ($types as $key => $value) {
                                $selected = '';
                                if ($type == $value) {
                                    $selected = "selected";
                                    $k = $this->Form->input('type_id', array('type' => 'hidden', 'value' => $key));
                                }
                                echo "<option $selected value='" . $this->Html->url(array('action' => 'add', $value)) . "'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    echo $k;
                    $types=array("Client"=>"Client","Prospect"=>"Prospect");
                    echo $this->Form->input('type_pharmacie', array('label' =>'type pharmacie', 'class' => 'form-control','options' =>$types));
                    echo $this->Form->input('secteur_id', array('label' => 'Secteur', 'class' => 'form-control select2'));
                    echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                    echo $this->Form->input('code_wavsoft', array( 'class' => 'form-control'));
                    ?>
                    <div class="field-pair">
                        <div class="input select">
                            <label for="ClientCategoryId7">Type de pharmacie</label>
                            <select name="data[Client][A]" class="form-control" id="ClientCategoryId7">
                                <option value="A">Pharmacie grande</option>
                                <option value="B">Pharmacie moyenne</option>
                                <option value="C">Pharmacie petite</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientCategoryId8">Emplacement du pharmacie</label>
                            <select name="data[Client][e]" class="form-control" id="ClientCategoryId8">
                                <option value="Centre">Centre</option>
                                <option value="Moyen">Moyen</option>
                                <option value="Periphérique">Périphérique</option>
                            </select>
                        </div>
                    </div>
                    <div class="input select">
                        <label>Commande des produits</label>
                        <select name="data[Client][1]" class="form-control">
                            <option value="1">Commande (cliente directe)</option>
                            <option value="2">Pack (cliente indirecte)</option>
                            <option value="3">Non cliente</option>
                        </select>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-tag blue"><span class="dot"></span>Coordonnées</div>
                    <div class="field-pair">
                        <?php echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control')); ?>
                    </div>
                    <?php echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control')); ?>
                    <div class="field-pair">
                        <?php echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control')); ?>
                    </div>
                    <?php
                    echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                    echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                    ?>
                </div>

            <?php
        else :
            ?>
            <div class="panel-body form-horizontal payment-form">
                <?php echo $this->Form->create('Client'); ?>

                <div class="form-section">
                    <div class="section-tag orange"><span class="dot"></span>Informations professionnelles</div>

                    <div class="input select"><label for="ClientsTypeId">Type</label>
                        <select name="data[Client][type_id]" onchange="location = this.value;" class="form-control" id="ClientsTypeId">
                            <option value="">(choisissez)</option>
                            <?php
                            foreach ($types as $key => $value) {
                                $selected = '';
                                if ($type == $value) {
                                    $selected = "selected";
                                    $k = $this->Form->input('type_id', array('type' => 'hidden', 'value' => $key));
                                }
                                echo "<option $selected value='" . $this->Html->url(array('action' => 'add', $value)) . "'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    echo $k;
                    $types=array("Client"=>"Client","Prospect"=>"Prospect");
                    echo $this->Form->input('type_pharmacie', array('label' =>'Type de client', 'class' => 'form-control','options' =>$types));
                    echo $this->Form->input('secteur_id', array('label' => 'Secteur', 'class' => 'form-control select2'));
                    echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                    echo $this->Form->input('code_wavsoft', array( 'class' => 'form-control'));
                    ?>
                </div>

                <div class="form-section">
                    <div class="section-tag blue"><span class="dot"></span>Coordonnées</div>
                    <div class="field-pair">
                        <?php echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control')); ?>
                    </div>
                    <?php echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control')); ?>
                    <div class="field-pair">
                        <?php echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control')); ?>
                        <?php echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control')); ?>
                    </div>
                    <?php
                    echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                    echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                    ?>
                </div>
            <?php endif; ?>

                <div class="form-section">
                    <div class="section-tag pink"><span class="dot"></span>Localisation</div>
                    <div id="map-card">
                        <table class="table">
                            <tr>
                                <td><label>Latitude:</label></td><td><?php echo $this->Form->input('latitude', array( 'id' => 'latitude_mag','label'=>false)); ?></td>
                                <td><label>Longitude:</label></td><td><?php echo $this->Form->input('longitude', array( 'id' => 'longitude_mag','label'=>false)); ?></td>
                            </tr>
                        </table>
                        <div id="map-canvas"></div>
                    </div>
                </div>

                <?php
                echo $this->Form->end(array(
                    'label' => 'Envoyer',
                    'class' => 'btn btn-primary btn-large',
                    'div' => false
                ));
                ?>
                <div class="well text-center">
                    <?php echo $this->Html->link('Annuler', array('action' => 'index'), array('class' => 'btn-cancel')); ?>
                </div>
            </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>
<script>
    $(function () {
        $("#ClientSecteurId").select2();

        $("#ClientProduits").select2({
            placeholder: '-- Sélectionner les gammes --',
            allowClear: true,
            language: { noResults: function() { return 'Aucune gamme trouvée'; } }
        });

        $('#ClientHopitalSelectAdd').select2({
            tags: true,
            placeholder: '-- Choisir ou créer un hôpital --',
            allowClear: true,
            language: { noResults: function() { return 'Aucun hôpital trouvé'; } },
            createTag: function(params) {
                var term = $.trim(params.term);
                if (!term) return null;
                return { id: '__new__:' + term, text: term + ' (nouveau)', newTag: true };
            }
        });

        $('#ClientActiviteSelectAdd').on('change', function() {
            if ($(this).val() === 'Publique') {
                $('#hopital-field-add').slideDown(200);
            } else {
                $('#hopital-field-add').slideUp(200);
                $('#ClientHopitalSelectAdd').val(null).trigger('change');
            }
        });
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEpnSCwdoRPf5V3vIWy7j6wzjewQRC8uE&amp;"></script>
<script>
    var map;
    var markers = [];
    function initialize() {
        var haightAshbury = new google.maps.LatLng(<?php
                    if (!empty($this->request->data['Client']['latitude'])) {
                        echo $this->request->data['Client']['latitude'];
                        ?>, <?php
                        echo $this->request->data['Client']['longitude'];
                    } else {
                        echo "33.536814 , -7.600853";
                    }
                    ?>);
        var mapOptions = {
            zoom: 10,
            center: haightAshbury,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        google.maps.event.addListener(map, 'click', function (event) {
            addMarker(event.latLng);
            document.getElementById("latitude_mag").value = event.latLng.lat();
            document.getElementById("longitude_mag").value = event.latLng.lng();
        });
    }

    function addMarker(location) {
        deleteOverlays();
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            animation: google.maps.Animation.DROP
        });
        markers.push(marker);
    }
    function deleteOverlays() {
        if (markers) {
            for (i in markers) {
                markers[i].setMap(null);
            }
            markers.length = 0;
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
