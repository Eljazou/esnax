<?php
// Préparer les données en PHP pour le JS
$regionsData = array();   // region => region_ims
$villesData  = array();   // tableau indexed pour filtrage JS
$secteursData = array();  // tableau indexed pour détection doublons

foreach ($allSecteurs as $s) {
    // Forcer UTF-8 pour éviter les erreurs json_encode si la DB est en Latin-1
    $r  = (strpos($s['Secteur']['region'], 'Ã') !== false) ? $s['Secteur']['region'] : utf8_encode($s['Secteur']['region']);
    $ri = (strpos($s['Secteur']['region_ims'], 'Ã') !== false) ? $s['Secteur']['region_ims'] : utf8_encode($s['Secteur']['region_ims']);
    $v  = (strpos($s['Secteur']['ville'], 'Ã') !== false) ? $s['Secteur']['ville'] : utf8_encode($s['Secteur']['ville']);
    $vi = (strpos($s['Secteur']['ville_ims'], 'Ã') !== false) ? $s['Secteur']['ville_ims'] : utf8_encode($s['Secteur']['ville_ims']);
    $se = (strpos($s['Secteur']['secteur'], 'Ã') !== false) ? $s['Secteur']['secteur'] : utf8_encode($s['Secteur']['secteur']);
    $si = (strpos($s['Secteur']['secteur_ims'], 'Ã') !== false) ? $s['Secteur']['secteur_ims'] : utf8_encode($s['Secteur']['secteur_ims']);

    if (!isset($regionsData[$r])) {
        $regionsData[$r] = $ri;
    }
    $key = $r . '__' . $v;
    if (!isset($villesData[$key])) {
        $villesData[$key] = array('region' => $r, 'ville' => $v, 'ville_ims' => $vi);
    }
    $skey = $r . '__' . $v . '__' . $se;
    if (!isset($secteursData[$skey])) {
        $secteursData[$skey] = array('region' => $r, 'ville' => $v, 'secteur' => $se, 'secteur_ims' => $si);
    }
}
?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

<style>
    :root {
        --accent: #7C5CFA;
        --accent-dark: #5B3FD9;
        --accent-soft: #F1EDFF;
        --ink: #1E1B2E;
        --muted: #8B87A0;
        --border: #EAE7F5;
        --surface: #FFFFFF;
        --canvas: #F7F6FC;
        --radius-lg: 14px;
        --radius-md: 10px;
        --radius-sm: 7px;
        --shadow-card: 0 2px 10px rgba(76, 55, 168, 0.06);
        --success: #17A673;
        --danger: #E5484D;
    }

    #map-secteur {
        width: 100%;
        height: 400px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        margin-top: 8px;
    }
    .map-info-bar {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: #fff;
        padding: 10px 16px;
        border-radius: var(--radius-md);
        margin-bottom: 4px;
        font-size: 13px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .map-info-bar i { margin-right: 4px; }
    .map-info-bar .info-text { flex: 1; min-width: 220px; }
    .gps-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    .gps-status.empty { background: rgba(255,255,255,0.2); color: #fff; }
    .gps-status.filled { background: #fff; color: var(--success); }

    /* ---------- Form shell ---------- */
    .add-secteur-wrap { background: var(--canvas); padding: 6px 2px 20px; font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif; }
    .lav-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); overflow: hidden; }
    .lav-card.accent-top { border-top: 3px solid var(--accent); }
    .lav-card-header { display: flex; align-items: center; gap: 10px; padding: 18px 22px; border-bottom: 1px solid var(--border); }
    .lav-card-header .hdr-ic { color: var(--accent); font-size: 15px; }
    .lav-card-header .lav-card-title { font-size: 16px; font-weight: 700; color: var(--ink); margin: 0; flex: 1; }
    .lav-card-body { padding: 24px 26px; }

    .field-group { margin-bottom: 18px; }
    .field-group label.control-label { font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 6px; display: flex; align-items: center; gap: 4px; }
    .field-group label.control-label .req { color: var(--danger); }
    .field-group .form-control {
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 9px 12px;
        font-size: 14px;
        color: var(--ink);
        transition: border-color .15s, box-shadow .15s;
    }
    .field-group .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-soft);
        outline: none;
    }
    .field-group .form-control::placeholder { color: #B7B3CC; }
    .field-help-error {
        display: inline-flex; align-items: center; gap: 5px;
        color: var(--danger); font-size: 12px; font-weight: 600; margin-top: 6px;
    }
    .field-static-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent-soft); color: var(--accent-dark);
        border-radius: 20px; padding: 4px 12px; font-size: 12.5px; font-weight: 700;
    }
    .new-entry-block {
        background: var(--canvas);
        border: 1px dashed var(--border);
        border-radius: var(--radius-md);
        padding: 16px 18px 4px;
        margin-bottom: 18px;
    }

    .section-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 22px 0;
    }
    .section-eyebrow {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-lav-primary {
        background: var(--accent);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: var(--radius-sm);
        padding: 10px 22px;
        transition: background .15s;
    }
    .btn-lav-primary:hover { background: var(--accent-dark); color: #fff; }
    .btn-lav-primary:disabled { background: #C9C2E8; cursor: not-allowed; }
    .btn-lav-outline {
        background: #fff;
        border: 1px solid var(--border);
        color: var(--muted);
        font-weight: 600;
        border-radius: var(--radius-sm);
        padding: 10px 20px;
        transition: all .15s;
    }
    .btn-lav-outline:hover { border-color: var(--accent); color: var(--accent-dark); background: var(--accent-soft); }
    .btn-lav-back {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
        font-weight: 600;
        border-radius: var(--radius-sm);
        padding: 6px 14px;
        font-size: 13px;
    }
    .btn-lav-back:hover { border-color: var(--accent); color: var(--accent-dark); background: var(--accent-soft); }

    .alert-flash { border-radius: var(--radius-md); padding: 12px 16px; margin-bottom: 18px; font-size: 13.5px; font-weight: 600; }
</style>

<div class="add-secteur-wrap">
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="lav-card accent-top">
            <div class="lav-card-header">
                <i class="fa fa-map-marker hdr-ic"></i>
                <h3 class="lav-card-title"><?php echo __('Ajouter un secteur'); ?></h3>
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Retour', array('action' => 'index'), array('class' => 'btn-lav-back', 'escape' => false)); ?>
            </div>
            <div class="lav-card-body">
                <?php if ($this->Session->check('Message.flash')): ?>
                    <div class="alert-flash <?php echo $this->Session->read('Message.flash.element') === 'default' ? $this->Session->read('Message.flash.params.class') : 'alert alert-danger'; ?>">
                        <?php echo $this->Session->flash(); ?>
                    </div>
                <?php endif; ?>

                <?php echo $this->Form->create('Secteur', array('class' => 'form-horizontal', 'id' => 'formAddSecteur')); ?>

                <!-- ============ RÉGION ============ -->
                <div class="section-eyebrow"><i class="fa fa-map-o"></i> Région</div>
                <div class="field-group">
                    <label class="control-label">Région <span class="req">*</span></label>
                    <select name="data[Secteur][region_select]" id="region_select" class="form-control">
                        <option value="">-- Choisir une région --</option>
                        <?php foreach ($regionsData as $nom => $ims): ?>
                            <option value="<?php echo h($nom); ?>"><?php echo h($nom); ?></option>
                        <?php endforeach; ?>
                        <option value="_new_">➕ Nouvelle région</option>
                    </select>
                </div>

                <!-- Région IMS (existante) -->
                <div class="field-group" id="region_ims_existing" style="display:none;">
                    <label class="control-label">IMS Région</label>
                    <div><span class="field-static-pill" id="region_ims_val"></span></div>
                </div>

                <!-- Nouvelle région -->
                <div id="new_region_block" class="new-entry-block" style="display:none;">
                    <div class="field-group">
                        <label class="control-label">Nom région</label>
                        <input type="text" name="data[Secteur][region]" id="region_new_nom" class="form-control" placeholder="Ex: Casablanca-Settat">
                    </div>
                    <div class="field-group">
                        <label class="control-label">IMS Région</label>
                        <input type="text" name="data[Secteur][region_ims]" class="form-control" placeholder="Ex: CASA NORTH">
                    </div>
                </div>

                <hr class="section-divider">

                <!-- ============ VILLE ============ -->
                <div class="section-eyebrow"><i class="fa fa-building-o"></i> Ville</div>
                <div class="field-group">
                    <label class="control-label">Ville <span class="req">*</span></label>
                    <select name="data[Secteur][ville_select]" id="ville_select" class="form-control">
                        <option value="">-- Choisir d'abord une région --</option>
                    </select>
                </div>

                <!-- Ville IMS (existante) -->
                <div class="field-group" id="ville_ims_existing" style="display:none;">
                    <label class="control-label">IMS Ville</label>
                    <div><span class="field-static-pill" id="ville_ims_val"></span></div>
                </div>

                <!-- Nouvelle ville -->
                <div id="new_ville_block" class="new-entry-block" style="display:none;">
                    <div class="field-group">
                        <label class="control-label">Nom ville</label>
                        <input type="text" name="data[Secteur][ville]" id="ville_new_nom" class="form-control" placeholder="Ex: Mohammedia">
                    </div>
                    <div class="field-group">
                        <label class="control-label">IMS Ville</label>
                        <input type="text" name="data[Secteur][ville_ims]" class="form-control" placeholder="Ex: MOHAMMEDIA">
                    </div>
                </div>

                <hr class="section-divider">

                <!-- ============ SECTEUR ============ -->
                <div class="section-eyebrow"><i class="fa fa-map-marker"></i> Secteur</div>
                <div class="field-group">
                    <label class="control-label">Secteur <span class="req">*</span></label>
                    <input type="text" name="data[Secteur][secteur]" id="secteur_nom" class="form-control" placeholder="Nom du secteur">
                    <span id="secteur_doublon" class="field-help-error" style="display:none;">
                        <i class="fa fa-exclamation-triangle"></i> Ce secteur existe déjà dans cette ville
                    </span>
                </div>
                <div class="field-group">
                    <label class="control-label">IMS Secteur</label>
                    <input type="text" name="data[Secteur][secteur_ims]" class="form-control" placeholder="Nom IMS du secteur">
                </div>

                <hr class="section-divider">

                <!-- ============ CARTE GPS ============ -->
                <div class="section-eyebrow"><i class="fa fa-globe"></i> Zone GPS</div>
                <div class="field-group">
                    <div class="map-info-bar">
                        <span class="info-text"><i class="fa fa-info-circle"></i> Dessinez un polygone sur la carte pour délimiter la zone du secteur.</span>
                        <span class="gps-status empty" id="gps_status">
                            <i class="fa fa-times-circle"></i> Non défini
                        </span>
                    </div>
                    <div id="map-secteur"></div>
                    <input type="hidden" name="data[Secteur][gps]" id="gps_field" value="">
                </div>

                <!-- ============ SUBMIT ============ -->
                <div class="field-group" style="margin-top:24px;">
                    <button type="submit" id="btn_submit" class="btn-lav-primary">
                        <i class="fa fa-save"></i> Enregistrer
                    </button>
                    <?php echo $this->Html->link('Annuler', array('action' => 'index'), array('class' => 'btn-lav-outline')); ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php echo $this->Html->script('jquery-2.2.3.min'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script>
(function($) {
    'use strict';

    // Données chargées depuis PHP (toutes en une seule fois)
    var regions   = <?php echo json_encode($regionsData) ?: '{}'; ?>;
    var villesArr = <?php echo json_encode(array_values($villesData)) ?: '[]'; ?>;
    var sectsArr  = <?php echo json_encode(array_values($secteursData)) ?: '[]'; ?>;

    // ---- RÉGION ----
    $('#region_select').on('change', function() {
        var val = $(this).val();

        // Reset ville
        $('#ville_select').html('<option value="">-- Choisir une ville --</option>');
        $('#ville_ims_existing, #new_ville_block').hide();
        $('#ville_ims_val').text('');

        if (val === '_new_') {
            $('#new_region_block').slideDown(150);
            $('#region_ims_existing').hide();
            // Pour nouvelle région, laisser l'utilisateur saisir la ville aussi
            $('#ville_select').html('<option value="_new_">➕ Nouvelle ville</option>');
            $('#new_ville_block').slideDown(150);
        } else if (val !== '') {
            $('#new_region_block').slideUp(150);
            $('#region_ims_existing').show();
            $('#region_ims_val').text(regions[val] || '—');

            // Remplir les villes de cette région
            var $sel = $('#ville_select');
            $sel.html('<option value="">-- Choisir une ville --</option>');
            var added = {};
            for (var i = 0; i < villesArr.length; i++) {
                if (villesArr[i].region === val && !added[villesArr[i].ville]) {
                    $sel.append('<option value="' + escHtml(villesArr[i].ville) + '">' + escHtml(villesArr[i].ville) + '</option>');
                    added[villesArr[i].ville] = true;
                }
            }
            $sel.append('<option value="_new_">➕ Nouvelle ville</option>');
        } else {
            $('#new_region_block, #region_ims_existing').hide();
        }
    });

    // ---- VILLE ----
    $('#ville_select').on('change', function() {
        var val    = $(this).val();
        var region = $('#region_select').val();

        $('#ville_ims_existing, #new_ville_block').hide();
        $('#ville_ims_val').text('');

        if (val === '_new_') {
            $('#new_ville_block').slideDown(150);
        } else if (val !== '') {
            for (var i = 0; i < villesArr.length; i++) {
                if (villesArr[i].region === region && villesArr[i].ville === val) {
                    $('#ville_ims_existing').show();
                    $('#ville_ims_val').text(villesArr[i].ville_ims || '—');
                    break;
                }
            }
        }
        checkDoublon();
    });

    // ---- VÉRIFICATION DOUBLON ----
    $('#secteur_nom').on('keyup blur', checkDoublon);

    function checkDoublon() {
        var sec    = $('#secteur_nom').val().trim().toLowerCase();
        var region = $('#region_select').val();
        var ville  = $('#ville_select').val();

        // Pour nouvelle région/ville on utilise les inputs texte
        if (region === '_new_') region = $('#region_new_nom').val().trim();
        if (ville  === '_new_') ville  = $('#ville_new_nom').val().trim();

        if (!sec || !region || !ville || ville === '') {
            $('#secteur_doublon').hide();
            $('#btn_submit').prop('disabled', false);
            return;
        }

        var doublon = false;
        for (var i = 0; i < sectsArr.length; i++) {
            if (sectsArr[i].region.toLowerCase() === region.toLowerCase() &&
                sectsArr[i].ville.toLowerCase()  === ville.toLowerCase()  &&
                sectsArr[i].secteur.toLowerCase() === sec) {
                doublon = true;
                break;
            }
        }
        $('#secteur_doublon').toggle(doublon);
        $('#btn_submit').prop('disabled', doublon);
    }

    function escHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ======================================================
    // ===== CARTE LEAFLET AVEC DESSIN DE POLYGONE ==========
    // ======================================================

    // Initialiser la carte centrée sur le Maroc
    var map = L.map('map-secteur').setView([31.7917, -7.0926], 6);

    // Couche satellite + labels
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Groupe pour les polygones dessinés
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // Contrôle de dessin
    var drawControl = new L.Control.Draw({
        draw: {
            polygon: {
                allowIntersection: false,
                shapeOptions: {
                    color: '#3c8dbc',
                    weight: 3,
                    fillColor: '#3c8dbc',
                    fillOpacity: 0.25
                }
            },
            polyline: false,
            circle: false,
            circlemarker: false,
            marker: false,
            rectangle: {
                shapeOptions: {
                    color: '#3c8dbc',
                    weight: 3,
                    fillColor: '#3c8dbc',
                    fillOpacity: 0.25
                }
            }
        },
        edit: {
            featureGroup: drawnItems,
            remove: true
        }
    });
    map.addControl(drawControl);

    // Quand un polygone est dessiné
    map.on(L.Draw.Event.CREATED, function(e) {
        // Supprimer les polygones précédents (un seul secteur = un seul polygone)
        drawnItems.clearLayers();
        drawnItems.addLayer(e.layer);
        updateGpsField();
    });

    // Quand un polygone est édité
    map.on(L.Draw.Event.EDITED, function() {
        updateGpsField();
    });

    // Quand un polygone est supprimé
    map.on(L.Draw.Event.DELETED, function() {
        updateGpsField();
    });

    function updateGpsField() {
        var coords = [];
        drawnItems.eachLayer(function(layer) {
            var latLngs = layer.getLatLngs()[0]; // premier anneau du polygone
            for (var i = 0; i < latLngs.length; i++) {
                coords.push([latLngs[i].lat, latLngs[i].lng]);
            }
        });
        if (coords.length > 0) {
            $('#gps_field').val(JSON.stringify(coords));
            updateGpsStatus(true, coords.length);
        } else {
            $('#gps_field').val('');
            updateGpsStatus(false, 0);
        }
    }

    function updateGpsStatus(filled, nPoints) {
        if (filled) {
            $('#gps_status').removeClass('empty').addClass('filled')
                .html('<i class="fa fa-check-circle"></i> Zone définie (' + nPoints + ' points)');
        } else {
            $('#gps_status').removeClass('filled').addClass('empty')
                .html('<i class="fa fa-times-circle"></i> Non défini');
        }
    }

    // Forcer le recalcul de la taille de la carte (nécessaire si le conteneur est caché au départ)
    setTimeout(function() { map.invalidateSize(); }, 300);


})(jQuery);
</script>
