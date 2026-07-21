<style type="text/css">
    /* Theme Core Global Parameters */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Unified Content Containers */
    .report-card-custom {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 30px;
    }
    .report-card-custom .box-header-custom {
        background: #ffffff;
        padding: 22px 24px;
        border-bottom: 1px solid var(--theme-border);
    }
    .report-card-custom .box-title-custom {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--theme-text-dark);
        line-height: 1.4;
    }
    .report-card-custom .box-body-custom {
        padding: 0;
    }

    /* Core Matrix Table Layout */
    .table-report-custom {
        width: 100% !important;
        margin-bottom: 0;
        border-collapse: collapse;
        table-layout: fixed; /* Fixes text drift alignment bugs */
    }
    
    /* Header Row Matrix */
    .table-report-custom thead th {
        background-color: var(--theme-primary-light);
        color: var(--theme-primary);
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.6px;
        font-weight: 700;
        padding: 14px 24px;
        border: none;
        border-bottom: 2px solid var(--theme-border);
    }

    /* Body Data Rows */
    .table-report-custom tbody td {
        padding: 14px 24px;
        vertical-align: middle !important;
        border: none;
        border-bottom: 1px solid var(--theme-border);
        color: var(--theme-text-dark);
        font-size: 14px;
        font-weight: 500;
        word-wrap: break-word;
    }
    .table-report-custom tbody tr:last-child td {
        border-bottom: none;
    }
    .table-report-custom tbody tr:hover {
        background-color: var(--theme-primary-light);
    }

    /* Clean Styled Badges for Metrics */
    .report-badge {
        display: inline-block;
        min-width: 38px;
        padding: 4px 10px;
        border-radius: 20px;
        background-color: var(--theme-primary-pale);
        color: var(--theme-primary);
        font-weight: 700;
        font-size: 12px;
        text-align: center;
    }
    .report-badge-outline {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        background-color: transparent;
        border: 1px solid var(--theme-border);
        color: var(--theme-text-muted);
        font-weight: 600;
        font-size: 12px;
    }
</style>

<?php
foreach ($data as $vmp):
    if ($vmp['User']['id'] == 4 || $vmp['User']['id'] == 2) {
        continue;
    }
    
    $public = $prive = 0;
    $activite = array();
    $cat = $pot = $potcat = $types = $actvitepot = array();
    $i = 0;
    
    foreach ($vmp["Client"] as $client) {
        $c = $client["clients"];
        $i++;
        
        // Categories
        if (!isset($cat[$client['categories']["name"]])) {
            $potcat[$client['categories']["name"]][$c["potentialite"]] = 1;
            $cat[$client['categories']["name"]] = 1;
        } else {
            if (!isset($potcat[$client['categories']["name"]][$c["potentialite"]])) {
                $potcat[$client['categories']["name"]][$c["potentialite"]] = 1;
            } else {
                $potcat[$client['categories']["name"]][$c["potentialite"]] = $potcat[$client['categories']["name"]][$c["potentialite"]] + 1;
            }
            $cat[$client['categories']["name"]] = $cat[$client['categories']["name"]] + 1;
        }
        
        $client = $client["clients"];
        
        // Potentialité
        if (!isset($pot[$client["potentialite"]])) {
            $pot[$client["potentialite"]] = 1;
        } else {
            $pot[$client["potentialite"]] = $pot[$client["potentialite"]] + 1;
        }
        
        // public ou privé avec pot
        if (!isset($actvitepot[$client["potentialite"]][$client['activite']])) {
            $actvitepot[$client["potentialite"]][$client['activite']] = 1;
        } else {
            $actvitepot[$client["potentialite"]][$client['activite']] = $actvitepot[$client["potentialite"]][$client['activite']] + 1;
        }
        
        if (!isset($activite[$client['activite']])) {
            $activite[$client['activite']] = 0;
        }
        $activite[$client['activite']] = $activite[$client['activite']] + 1;
        
        if (!isset($types[$client["type_id"]])) {
            $types[$client["type_id"]] = array();
            $types[$client["type_id"]]["nombre"] = 1;
            $types[$client["type_id"]]["localise"] = 0;
            $types[$client["type_id"]]["nonlocalise"] = 0;
            if ($client["longitude"] != '' && $client["longitude"] != null) {
                $types[$client["type_id"]]["localise"] = 1;
            } else {
                $types[$client["type_id"]]["nonlocalise"] = 1;
            }
        } else {
            $types[$client["type_id"]]["nombre"] = $types[$client["type_id"]]["nombre"] + 1;
            if ($client["longitude"] != '' && $client["longitude"] != null) {
                $types[$client["type_id"]]["localise"] = $types[$client["type_id"]]["localise"] + 1;
            } else {
                $types[$client["type_id"]]["nonlocalise"] = $types[$client["type_id"]]["nonlocalise"] + 1;
            }
        }
    }
?>
    <div class="row">
        <!-- 1. Dynamically Generated Categories / Potentialities Matrix Packs -->
        <?php foreach($potcat as $key => $pp): ?>
            <div class="col-md-6 col-xs-12">
                <div class="report-card-custom">
                    <div class="box-header-custom">
                        <h3 class="box-title_custom">Rapport des listes de <strong><?php echo h($key); ?></strong> du <?php echo h($vmp['User']['name']); ?></h3>
                    </div>
                    <div class="box-body-custom">
                        <table class="table-report-custom">
                            <thead>
                                <tr>
                                    <th style="width: 65%;">POT</th>
                                    <th style="width: 35%; text-align: right;">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pp as $k => $p): ?>
                                <tr>
                                    <td style="font-weight: 600;"><?php echo h($k); ?></td>
                                    <td style="text-align: right;">
                                        <span class="report-badge"><?php echo $p; ?></span>
                                    </td>  
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- 2. Activity Metrics Tracker Card Matrix -->
        <div class="col-md-6 col-xs-12">
            <div class="report-card-custom">
                <div class="box-header-custom">
                    <h3 class="box-title-custom">Rapport des listes de Activité du <?php echo h($vmp['User']['name']); ?></h3>
                </div>
                <div class="box-body-custom">
                    <table class="table-report-custom">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Activité</th>
                                <th style="width: 25%; text-align: right;">Nombre</th>
                                <th style="width: 25%; text-align: right;">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($activite as $activitee => $valueacti): ?>
                                <tr>
                                    <td style="font-weight: 600;"><?php echo h($activitee); ?></td>
                                    <td style="text-align: right;">
                                        <span class="report-badge"><?php echo $valueacti; ?></span>
                                    </td>  
                                    <td style="text-align: right; font-weight: 700; color: var(--theme-primary);">
                                        <?php echo ($i > 0) ? round(($valueacti / $i) * 100, 2) : "0"; ?> %
                                    </td> 
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 3. Base Potentiality Tracker Card Matrix -->
        <div class="col-md-6 col-xs-12">
            <div class="report-card-custom">
                <div class="box-header-custom">
                    <h3 class="box-title-custom">Rapport des listes de POT du <?php echo h($vmp['User']['name']); ?></h3>
                </div>
                <div class="box-body-custom">
                    <table class="table-report-custom">
                        <thead>
                            <tr>
                                <th style="width: 50%;">POT</th>
                                <th style="width: 25%; text-align: right;">Nombre</th>
                                <th style="width: 25%; text-align: right;">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pot as $key => $value) : ?>
                                <tr>
                                    <td style="font-weight: 600;"><?php echo h($key); ?></td>
                                    <td style="text-align: right;">
                                        <span class="report-badge"><?php echo $value; ?></span>
                                    </td>
                                    <td style="text-align: right; font-weight: 700; color: var(--theme-primary);">
                                        <?php echo ($i > 0) ? round(($value / $i) * 100, 2) : "0"; ?> %
                                    </td> 
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- 4. Cross-Reference Activity Potential Matrix -->
        <div class="col-md-6 col-xs-12">
            <div class="report-card-custom">
                <div class="box-header-custom">
                    <h3 class="box-title-custom">Rapport des listes de POT / Activité <?php echo h($vmp['User']['name']); ?></h3>
                </div>
                <div class="box-body-custom">
                    <table class="table-report-custom">
                        <thead>
                            <tr>
                                <th style="width: 40%;">POT</th>
                                <th style="width: 60%;">Activité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($actvitepot as $key => $value) : ?>
                                <tr>
                                    <td style="font-weight: 700; color: var(--theme-primary);"><?php echo h($key); ?></td>
                                    <td>
                                        <div style="line-height: 1.8;">
                                            <?php foreach($value as $k => $v): ?>
                                                <span style="font-weight: 600;"><?php echo h($k); ?></span> 
                                                <i class="fa fa-long-arrow-right" style="color: var(--theme-text-muted); margin: 0 4px;"></i> 
                                                <span class="report-badge" style="padding: 2px 8px; font-size: 11px; min-width: 28px;"><?php echo $v; ?></span><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 5. Specialties Distribution Card Matrix -->
        <div class="col-md-6 col-xs-12">
            <div class="report-card-custom">
                <div class="box-header-custom">
                    <h3 class="box-title-custom">Rapport des listes de spécialité <?php echo h($vmp['User']['name']); ?></h3>
                </div>
                <div class="box-body-custom">
                    <table class="table-report-custom">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Spécialité</th>
                                <th style="width: 25%; text-align: right;">Nombre</th>
                                <th style="width: 25%; text-align: right;">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cat as $key => $value) : ?>
                                <tr>
                                    <td style="font-weight: 600;"><?php echo h($key); ?></td>
                                    <td style="text-align: right;">
                                        <span class="report-badge"><?php echo $value; ?></span>
                                    </td>
                                    <td style="text-align: right; font-weight: 700; color: var(--theme-primary);">
                                        <?php echo ($i > 0) ? round(($value / $i) * 100, 2) : "0"; ?> %
                                    </td> 
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- 6. Localization & Customer Types Analytics Structural Matrix -->
        <div class="col-md-12 col-xs-12">
            <div class="report-card-custom">
                <div class="box-header-custom">
                    <h3 class="box-title-custom">Rapport des listes des type clients <?php echo h($vmp['User']['name']); ?></h3>
                </div>
                <div class="box-body-custom">
                    <div class="table-responsive" style="border: none;">
                        <table class="table-report-custom">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th style="text-align: right;">Nombre</th>
                                    <th style="text-align: right;">Localisé</th>
                                    <th style="text-align: right;">Non localisé</th>
                                    <th style="text-align: right;">% Non Loc.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($types as $key => $value) : ?>
                                    <tr>
                                        <td style="font-weight: 600;"><?php echo h($alltypes[$key]); ?></td>
                                        <td style="text-align: right;">
                                            <span class="report-badge" style="background-color: var(--theme-text-dark); color: #fff;"><?php echo $value["nombre"]; ?></span>
                                        </td>
                                        <td style="text-align: right;">
                                            <span class="report-badge" style="background-color: #e3fbeb; color: #14a347;"><?php echo $value["localise"]; ?></span>
                                        </td>
                                        <td style="text-align: right;">
                                            <span class="report-badge" style="background-color: #fdebee; color: #d92d20;"><?php echo $value["nonlocalise"]; ?></span>
                                        </td>
                                        <td style="text-align: right; font-weight: 700; color: #d92d20;">
                                            <?php echo ($value["nonlocalise"] > 0) ? round(($value["nonlocalise"] / ($value["nonlocalise"] + $value["localise"])) * 100, 0) : "0"; ?> %
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
<?php endforeach; ?>