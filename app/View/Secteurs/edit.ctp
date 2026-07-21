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
    .edit-secteur-wrap { background: var(--canvas); padding: 6px 2px 20px; font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif; }
    .lav-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); overflow: hidden; }
    .lav-card.accent-top { border-top: 3px solid var(--accent); }
    .lav-card-header { display: flex; align-items: center; gap: 10px; padding: 18px 22px; border-bottom: 1px solid var(--border); }
    .lav-card-header .hdr-ic { color: var(--accent); font-size: 15px; }
    .lav-card-header .lav-card-title { font-size: 16px; font-weight: 700; color: var(--ink); margin: 0; flex: 1; }
    .lav-card-body { padding: 24px 26px; }

    .field-group { margin-bottom: 18px; }
    .field-group label.control-label { font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 6px; display: block; }
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
</style>

<div class="edit-secteur-wrap">
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="lav-card accent-top">
            <div class="lav-card-header">
                <i class="fa fa-pencil hdr-ic"></i>
                <h3 class="lav-card-title"><?php echo __('Éditer le secteur'); ?></h3>
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Retour', array('action' => 'index'), array('class' => 'btn-lav-back', 'escape' => false)); ?>
            </div>
            <div class="lav-card-body">
                <?php echo $this->Form->create('Secteur', array('class' => 'form-horizontal')); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>

                <div class="section-eyebrow"><i class="fa fa-map-o"></i> Région</div>
                <div class="field-group">
                    <label class="control-label">Région</label>
                    <?php echo $this->Form->input('region', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom de la région')); ?>
                </div>
                <div class="field-group">
                    <label class="control-label">Région IMS</label>
                    <?php echo $this->Form->input('region_ims', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom IMS de la région')); ?>
                </div>

                <hr class="section-divider">

                <div class="section-eyebrow"><i class="fa fa-building-o"></i> Ville</div>
                <div class="field-group">
                    <label class="control-label">Ville</label>
                    <?php echo $this->Form->input('ville', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom de la ville')); ?>
                </div>
                <div class="field-group">
                    <label class="control-label">Ville IMS</label>
                    <?php echo $this->Form->input('ville_ims', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom IMS de la ville')); ?>
                </div>

                <hr class="section-divider">

                <div class="section-eyebrow"><i class="fa fa-map-marker"></i> Secteur</div>
                <div class="field-group">
                    <label class="control-label">Secteur</label>
                    <?php echo $this->Form->input('secteur', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom du secteur')); ?>
                </div>
                <div class="field-group">
                    <label class="control-label">Secteur IMS</label>
                    <?php echo $this->Form->input('secteur_ims', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'Nom IMS du secteur')); ?>
                </div>

                <hr class="section-divider">

                <!-- ============ CARTE GPS ============ -->
                <div class="section-eyebrow"><i class="fa fa-globe"></i> Zone GPS</div>
                <div class="field-group">
                    <div class="map-info-bar">
                        <span class="info-text"><i class="fa fa-info-circle"></i> Dessinez ou modifiez le polygone pour délimiter la zone du secteur.</span>
                        <span class="gps-status empty" id="gps_status">
                            <i class="fa fa-times-circle"></i> Non défini
                        </span>
                    </div>
                    <div id="map-secteur"></div>
                    <?php
                    // Récupérer la valeur GPS existante
                    $gpsValue = '';
                    if (!empty($this->request->data['Secteur']['gps'])) {
                        $gpsValue = $this->request->data['Secteur']['gps'];
                    }
                    ?>
                    <input type="hidden" name="data[Secteur][gps]" id="gps_field" value="<?php echo h($gpsValue); ?>">
                </div>

                <div class="field-group" style="margin-top:24px;">
                    <button type="submit" class="btn-lav-primary">
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

    // Données GPS existantes
    var existingGps = <?php echo (!empty($gpsValue) ? $gpsValue : '[]'); ?>;

    // Initialiser la carte centrée sur le Maroc
    var map = L.map('map-secteur').setView([31.7917, -7.0926], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Groupe pour les polygones
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // Charger le polygone existant s'il y en a un
    if (existingGps && existingGps.length > 0) {
        var latlngs = [];
        for (var i = 0; i < existingGps.length; i++) {
            latlngs.push([existingGps[i][0], existingGps[i][1]]);
        }
        var polygon = L.polygon(latlngs, {
            color: '#3c8dbc',
            weight: 3,
            fillColor: '#3c8dbc',
            fillOpacity: 0.25
        });
        drawnItems.addLayer(polygon);
        map.fitBounds(polygon.getBounds(), { padding: [30, 30] });
        updateGpsStatus(true, existingGps.length);
    }

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
        drawnItems.clearLayers();
        drawnItems.addLayer(e.layer);
        updateGpsField();
    });

    map.on(L.Draw.Event.EDITED, function() {
        updateGpsField();
    });

    map.on(L.Draw.Event.DELETED, function() {
        updateGpsField();
    });

    function updateGpsField() {
        var coords = [];
        drawnItems.eachLayer(function(layer) {
            var latLngs = layer.getLatLngs()[0];
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

    setTimeout(function() { map.invalidateSize(); }, 300);

})(jQuery);
</script>
