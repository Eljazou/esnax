<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

<style>
/* Only what Metronic genuinely doesn't already give us. Everything else
   (cards, symbols, badges, table stripes, colors) comes from style.bundle.css */

body, .content-wrapper{ font-family:'Poppins', sans-serif !important; }
h2::after{ content:"👋"; margin-left:6px; }

.date-group{
    display:flex;
    align-items:center;
    gap:16px;
}
.date-group label{
    font-size:13px;
    font-weight:600;
    color:var(--bs-gray-600, #78829d);
    margin:0;
    white-space:nowrap;
}
.date-group input{ width:260px; }

.boxes-statistique{
    display:flex!important;
    flex-wrap:nowrap!important;
    overflow-x:auto;
    gap:10px;
}
.boxes-statistique .col-md-3{
    flex:1 1 0!important;
    width:auto!important;
    min-width:150px;
}
.boxes-statistique .card-body{
    padding:10px 14px!important;
}
.boxes-statistique .symbol.symbol-45px{
    width:36px!important;
    height:36px!important;
}
.boxes-statistique .symbol-label{
    width:36px!important;
    height:36px!important;
    font-size:14px!important;
}
.boxes-statistique .me-4{
    margin-right:.6rem!important;
}
.boxes-statistique::-webkit-scrollbar{ height:6px; }
.boxes-statistique::-webkit-scrollbar-thumb{ background:#cbd5e1; border-radius:20px; }

.created-span{ color:#8b8aa3; font-size:11px; display:block; }
.visite_number{ cursor:pointer; }

/* Flatpickr week picker — themed with the --lb-* variables already defined in your layout */
.flatpickr-calendar{
    border-radius:16px!important;
    box-shadow:0 10px 30px rgba(31,29,74,.12)!important;
    font-family:'Poppins',sans-serif!important;
}
.flatpickr-day.selected,
.flatpickr-day.selected:hover{
    background:var(--lb-primary, #7c6ff0)!important;
    border-color:var(--lb-primary, #7c6ff0)!important;
}
.flatpickr-day.week-row-hover{
    background:var(--lb-primary-light, #ede9fe)!important;
    border-radius:0!important;
}
.flatpickr-current-month,
.flatpickr-weekday{
    color:var(--lb-primary-dark, #5b4fd6)!important;
}
.flatpickr-weekwrapper .flatpickr-weeks{
    box-shadow:none!important;
}

/* icon background color cycling only — the 3 static cards already carry their
   own emoji in HTML, so no ::before here (that was causing the double icons) */
.boxes-statistique .col-md-3:nth-child(1) .symbol-label{ background:var(--bs-primary-light, #eef3ff)!important; }
.boxes-statistique .col-md-3:nth-child(2) .symbol-label{ background:var(--bs-info-light, #f0eafd)!important; }
.boxes-statistique .col-md-3:nth-child(3) .symbol-label{ background:var(--bs-success-light, #e8fff3)!important; }

/* dynamic (JS-injected) cards have an EMPTY symbol-label, so ::before is the only icon source */
.boxes-statistique .col-md-3:nth-child(4n) .symbol-label{ background:var(--bs-warning-light, #fff8dd)!important; }
.boxes-statistique .col-md-3:nth-child(4n) .symbol-label::before{ content:"🩺"; }
.boxes-statistique .col-md-3:nth-child(4n+1):not(:nth-child(1)) .symbol-label{ background:var(--bs-danger-light, #fff5f8)!important; }
.boxes-statistique .col-md-3:nth-child(4n+1):not(:nth-child(1)) .symbol-label::before{ content:"💊"; }

/* VM avatar initials cycling — pure CSS, mirrors your original nth-of-type approach */
.mytr:nth-of-type(5n+1) .symbol-label{ background:var(--bs-primary-light, #eef3ff)!important; color:var(--bs-primary, #7c6ff0)!important; }
.mytr:nth-of-type(5n+2) .symbol-label{ background:var(--bs-info-light, #f0eafd)!important; color:var(--bs-info, #93c5fd)!important; }
.mytr:nth-of-type(5n+3) .symbol-label{ background:var(--bs-danger-light, #fff5f8)!important; color:var(--bs-danger, #f472b6)!important; }
.mytr:nth-of-type(5n+4) .symbol-label{ background:var(--bs-warning-light, #fff8dd)!important; color:var(--bs-warning, #fb923c)!important; }
.mytr:nth-of-type(5n+5) .symbol-label{ background:var(--bs-success-light, #e8fff3)!important; color:var(--bs-success, #86efac)!important; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="row">
    <div class="col-md-12 ">
        <div class="row mb-5">
            <div class="col-md-5">
                <h2>Tableau de bord</h2>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="date-group">
                            <label for="weekPicker">Sélectionner une semaine :</label>
                            <input type="text" id="weekPicker" class="form-control" placeholder="Sélectionner une semaine" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    foreach ($users as $user_supe_key => $super) {
        if ($user_supe_key == 2 || $user_supe_key == 416)
            continue;
        $exisite_acm = explode("-", $user_supe_key);
        $nomsuperviseur = "l'équipe de " . $supers[$exisite_acm[0]];
        if (count($exisite_acm) > 1) {
            $nomsuperviseur = "l'équipe de " . $supers[$exisite_acm[0]] . " attacher à l'équipe de " . $supers[$exisite_acm[1]];
        }
    ?>
        <div class="col-md-12 mb-5">
            <h3><?php echo $nomsuperviseur; ?></h3>
        </div>
        <div class="col-md-12">

            <div class="boxes-statistique row mb-5 boxes_<?php echo $user_supe_key; ?>">
                <div class="col-md-3">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center py-4">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-primary fs-2">👥</span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-7 fw-semibold">Nombre vmp</span>
                                <span class="text-gray-900 fs-4 fw-bold nbr_vmp"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center py-4">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-info fs-2">🎯</span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-7 fw-semibold">Objectif total</span>
                                <span class="text-gray-900 fs-4 fw-bold tt_objectif"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center py-4">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-success fs-2">✅</span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-7 fw-semibold">Objectif realisée</span>
                                <span class="text-gray-900 fs-4 fw-bold tt_objectif_realise"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title"> Rapport des visites de l'équipe de <?php echo end($super)['User']['name']; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table mytables table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th><?php echo 'VM'; ?></th>
                                <th>Type</th>
                                <?php
                                for ($i = 1; $i < 8; $i++) {
                                    $nbDay = date('N', strtotime($date));

                                    try {
                                        $monday = new DateTime($date);
                                    } catch (Exception $e) {
                                        echo "Error: " . $e->getMessage();
                                        exit;
                                    }

                                    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                                    $formatter->setPattern('EEE:d - MMM');

                                    if ($monday) {
                                        $monday->modify('-' . ($nbDay - $i) . ' days');
                                        $date_debut = $formatter->format($monday);
                                        $date_debut = str_replace('.', '', $date_debut);
                                        echo "<th class='fw-bold'>$date_debut</th>";
                                    } else {
                                        echo "Error: Invalid date.";
                                    }
                                }
                                ?>
                                <th>Objectif</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count_vmp = 0;
                            $totale_objectif = 0;
                            $tt_objectif_realise = 0;
                            $arr_all_objectif_detail = [];
                            foreach ($super as $key_vmp => $vmp) {
                                $all_obj_vm = 0;
                                $all_obj_vm_realise = 0;

                                if ($vmp['User']['role'] != "Super viseur")
                                    $count_vmp = $count_vmp + 1;

                                $count_objectif = count($vmp['Objectif']);
                                $i = 0;

                                if (empty($vmp['Objectif'])) { ?>
                                    <tr class="mytr tr_<?php echo $key_vmp; ?>">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (isset($vmp['User']['image'])) { ?>
                                                    <div class="symbol symbol-circle symbol-50px me-3">
                                                        <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                            <div class="symbol-label">
                                                                <?php echo $this->Html->image('users/' . $vmp['User']['image'], array('class' => 'w-100')); ?>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="symbol symbol-circle symbol-50px me-3">
                                                        <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                            <div class="symbol-label fs-3 fw-bold">
                                                                <?php
                                                                if (isset($vmp['User']['name'])) {
                                                                    echo substr($vmp['User']['name'], 0, 1);
                                                                } else {
                                                                    echo 'Vide';
                                                                }
                                                                ?>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <div class="d-flex flex-column">
                                                    <?php echo  $this->Html->link($vmp['User']['name'], array('action' => 'view', $vmp['User']['id']), array('class' => 'text-gray-900 text-hover-primary fw-bold')) ?>
                                                    <span class="text-muted fs-8"><?php echo $vmp['User']['role']; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan='10'>Aucune visite,ou merci de vérifier l'objectif.</td>
                                    </tr>
                                <?php
                                }
                                $deja_exist = [];
                                $unique_objectifs = [];
                                $seen_types = [];
                                foreach ($vmp['Objectif'] as $objectif) {
                                    $key = $objectif['user_id'] . '_' . $objectif['type_id'];
                                    if (!in_array($key, $seen_types)) {
                                        $seen_types[] = $key;
                                        $unique_objectifs[] = $objectif;
                                    }
                                }
                                $count_objectif = count($unique_objectifs);
                                foreach ($unique_objectifs as $objectif) {
                                    if (!isset($deja_exist[$objectif['user_id']])) {
                                        $deja_exist[$objectif['user_id']] = [];
                                    }

                                    if (in_array($objectif['type_id'], $deja_exist[$objectif['user_id']])) {
                                        continue;
                                    }

                                    $deja_exist[$objectif['user_id']][] = $objectif['type_id'];
                                    $class_mytr = "";
                                    $objectif_day = $objectif['objectif'] / 5;
                                    if ($i == 0) {
                                        $class_mytr = "mytr tr_" . $key_vmp;
                                    }
                                ?>
                                    <tr class="<?php echo $class_mytr;  ?>">
                                        <?php
                                        if ($i == 0) { ?>
                                            <td rowspan="<?php echo $count_objectif; ?>">
                                                <div class="d-flex align-items-center">
                                                    <?php if (isset($vmp['User']['image'])) { ?>
                                                        <div class="symbol symbol-circle symbol-50px me-3">
                                                            <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                                <div class="symbol-label">
                                                                    <?php echo $this->Html->image('users/' . $vmp['User']['image'], array('class' => 'w-100')); ?>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="symbol symbol-circle symbol-50px me-3">
                                                            <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                                <div class="symbol-label fs-3 fw-bold">
                                                                    <?php
                                                                    if (isset($vmp['User']['name'])) {
                                                                        echo substr($vmp['User']['name'], 0, 1);
                                                                    } else {
                                                                        echo 'Vide';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="d-flex flex-column">
                                                        <?php echo  $this->Html->link($vmp['User']['name'], array('action' => 'view', $vmp['User']['id']), array('class' => 'text-gray-900 text-hover-primary fw-bold')) ?>
                                                        <span class="text-muted fs-8"><?php echo $vmp['User']['role']; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php }
                                        ?>

                                        <td title="<?php echo htmlspecialchars($objectif['type']); ?>">
                                            <?php
                                            $text = $objectif['type'];
                                            $words = explode(' ', $text);

                                            if (count($words) > 1) {
                                                echo htmlspecialchars($words[0]) . '...';
                                            } else {
                                                echo htmlspecialchars($text);
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        $total_visite_week = 0;

                                        for ($i = 1; $i < 8; $i++) {
                                            $nbDay = date('N', strtotime($date));
                                            $monday = new DateTime($date);
                                            $date_debut = $monday->modify('-' . ($nbDay - $i) . ' days')->format('Y-m-d');
                                            $cl_bg_td = "";
                                            $current_day = date('Y-m-d');
                                        ?>
                                            <td>
                                                <?php
                                                $count_visite = isset($vmp['Visite'][$date_debut][$objectif['type']])
                                                    ? count($vmp['Visite'][$date_debut][$objectif['type']])
                                                    : 0;
                                                if ($count_visite == ($objectif_day - 1) && $date_debut <= $current_day) {
                                                    $cl_bg_td = "badge-light-warning";
                                                } elseif ($count_visite < $objectif_day && $date_debut < $current_day) {
                                                    $cl_bg_td = "badge-light-danger";
                                                } else if ($count_visite >= $objectif_day && $date_debut <= $current_day) {
                                                    $cl_bg_td = "badge-light-success";
                                                }
                                                $data = isset($vmp['Visite'][$date_debut]) ? $vmp['Visite'][$date_debut] : [];
                                                $data_visites_json = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                                                $current_type = htmlspecialchars(isset($objectif['type']) ? $objectif['type'] : '', ENT_QUOTES, 'UTF-8');
                                                echo "<div class='visite_number badge {$cl_bg_td} fs-6' data-visites='{$data_visites_json}' data-current-type='{$current_type}'>{$count_visite}</div>";
                                                $total_visite_week += $count_visite;
                                                ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <?php
                                            $totale_objectif += $objectif['objectif'];
                                            echo "<span class='fw-bold'>" . $objectif['objectif'] . "</span>"; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $c = "";
                                            if (!empty($objectif['objectif'])) {
                                                $porcent_per_objectif = floor(($total_visite_week / $objectif['objectif']) * 100);
                                            } else {
                                                $porcent_per_objectif = 0;
                                            }
                                            if ($porcent_per_objectif < 50) {
                                                $c = "danger";
                                            } else if ($porcent_per_objectif < 75 && $porcent_per_objectif >= 50) {
                                                $c = "warning";
                                            } else {
                                                $c = "success";
                                            }

                                            echo "<span class='badge badge-light-" . $c . " fw-bold'>" . $total_visite_week . " | " . $porcent_per_objectif . "% </span>";

                                            $tt_objectif_realise += $total_visite_week;

                                            $all_obj_vm += $objectif['objectif'];
                                            $all_obj_vm_realise += $total_visite_week;

                                            if (!isset($arr_all_objectif_detail[$objectif['type']])) {
                                                $arr_all_objectif_detail[$objectif['type']] = ['objectif' => 0, 'realisee' => 0];
                                            }
                                            $arr_all_objectif_detail[$objectif['type']]['objectif'] += $objectif['objectif'];
                                            $arr_all_objectif_detail[$objectif['type']]['realisee'] += $total_visite_week;

                                            ?>
                                        </td>

                                    </tr>
                                <?php
                                    $i++;
                                }

                                if ($all_obj_vm != 0) {
                                    $porcent_all_obj_vm = round($all_obj_vm_realise / $all_obj_vm, 2) * 100;
                                } else {
                                    $porcent_all_obj_vm = 0;
                                }
                                ?>
                                <input type="hidden" id="vm_<?php echo $key_vmp; ?>" data-index="<?php echo $key_vmp; ?>" class="vm_hidden" value="<?php echo $porcent_all_obj_vm; ?>">

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            count_vmp = <?php echo $count_vmp; ?>;
            tt_objectif = <?php echo $totale_objectif; ?>;
            tt_objectif_realise = <?php echo $tt_objectif_realise; ?>;
            arr_all_objectif_detail = <?php echo json_encode($arr_all_objectif_detail); ?>;

            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .nbr_vmp').textContent = count_vmp;
            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .tt_objectif').textContent = tt_objectif;
            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .tt_objectif_realise').textContent = tt_objectif_realise;

            container = document.querySelector('.boxes_<?php echo $user_supe_key; ?>');

            for (const [key, values] of Object.entries(arr_all_objectif_detail)) {
                const boxHTML = `
            <div class="col-md-3">
                <div class="card card-flush">
                    <div class="card-body d-flex align-items-center py-4">
                        <div class="symbol symbol-45px me-4">
                            <span class="symbol-label fs-2"></span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-muted fs-7 fw-semibold">${key}</span>
                            <span class="text-gray-900 fs-4 fw-bold">${values.realisee}/${values.objectif}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
                container.insertAdjacentHTML('beforeend', boxHTML);
            }
        </script>
    <?php } ?>
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs" id="modalTabs"></ul>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="modalTabContent"></div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {
        $(".mytables").each(function() {
            $(this).find(".vm_hidden").each(function() {
                let index = $(this).data("index");
                let value = parseFloat($(this).val());

                let $symbol = $(".tr_" + index + " .symbol");

                $symbol.removeClass("symbol-circle-danger bg-light-danger symbol-circle-warning bg-light-warning symbol-circle-success bg-light-success");

                if (value < 50) {
                    $symbol.addClass("symbol-circle-danger bg-light-danger");
                } else if (value < 75 && value >= 50) {
                    $symbol.addClass("symbol-circle-warning bg-light-warning");
                } else {
                    $symbol.addClass("symbol-circle-success bg-light-success");
                }
            });
        });
    });
</script>


<script>
    var baseUrl = "<?php echo Router::url('/', true); ?>";

    $(document).ready(function() {
        $(document).on('click', '.visite_number', function() {
            var visitesData = JSON.parse($(this).attr('data-visites'));
            var currentType = $(this).attr('data-current-type');

            for (var type in visitesData) {
                if (visitesData.hasOwnProperty(type)) {
                    var seen = {};
                    visitesData[type] = visitesData[type].filter(function(visite) {
                        var key = visite.user_id + '_' + visite.client_id + '_' + visite.date;
                        if (seen[key]) return false;
                        seen[key] = true;
                        return true;
                    });
                }
            }

            $('#modal-default .nav-tabs').empty();
            $('#modal-default .tab-content').empty();

            var types = [];
            for (var type in visitesData) {
                if (visitesData.hasOwnProperty(type)) {
                    types.push(type);
                }
            }

            types.forEach(function(type, index) {
                var isActive = (type === currentType) ? 'active' : '';

                $('#modal-default .nav-tabs').append(
                    '<li class="' + isActive + '"><a href="#tab_' + index + '" data-toggle="tab">' + type + '</a></li>'
                );

                var tabContent = '<div class="tab-pane ' + isActive + '" id="tab_' + index + '">';

                if (visitesData[type] && visitesData[type].length > 0) {
                    var hasUserDouble = visitesData[type].some(function(visite) {
                        return visite.user_double && visite.user_double.trim() !== '';
                    });
                    tabContent += '<table class="table table-row-dashed">';
                    tabContent += '<thead><tr>';

                    if (hasUserDouble) {
                        tabContent += '<th class="head_double">Vm</th>';
                    }
                    tabContent += '<th>Nom & Prénom</th><th>Activité</th><th>POT</th><th>Date</th><th>Timer</th></tr></thead>';
                    tabContent += '<tbody>';

                    visitesData[type].forEach(function(visite) {
                        var clientLink = baseUrl + "clients/view/" + visite.client_id;
                        var userLink = baseUrl + "users/view/" + visite.user_id;
                        tabContent += '<tr>';
                        if (visite.user_double) {
                            tabContent += '<td><a href="' + userLink + '" target="_blank"><i class="fa-regular fa-user-group"></i>' + visite.user_double + '</a></td>';
                        }
                        tabContent += '<td><a href="' + clientLink + '" target="_blank">' + ((visite.client_nom || '') + ' ' + (visite.client_prenom || '')).trim() + '</a></td>';
                        tabContent += '<td>' + (visite.client_activite || 'N/A') + '</td>';
                        tabContent += '<td>' + (visite.client_potentialite || 'N/A') + '</td>';
                        tabContent += '<td>' + (visite.date || 'N/A') + '<span class="created-span">Date creation : ' + (visite.created || 'N/A') + '</span></td>';
                        tabContent += '<td>' + (visite.timer || 'N/A') + '</td>';
                        tabContent += '</tr>';
                    });

                    tabContent += '</tbody></table>';
                } else {
                    tabContent += '<p>No visits available</p>';
                }

                tabContent += '</div>';
                $('#modal-default .tab-content').append(tabContent);
            });

            $('#modal-default .nav-tabs').append('<li><a href="#tab_map" data-toggle="tab">Map</a></li>');

            var mapTabContent = '<div class="tab-pane" id="tab_map">';
            mapTabContent += '<div id="map-container" style="height: 400px; width: 100%;"></div>';
            mapTabContent += '</div>';
            $('#modal-default .tab-content').append(mapTabContent);

            $('#modal-default .nav-tabs').append(
                '<li class="pull-right">' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">×</span></button>' +
                '</li>'
            );

            $('#modal-default').modal('show');

            $('#modal-default').on('shown.bs.modal', function(e) {
                initLeafletMap(visitesData);
            });

            $(document).on('shown.bs.tab', 'a[data-toggle="tab"][href="#tab_map"]', function(e) {
                if (window.visiteMap) {
                    window.visiteMap.invalidateSize();
                }
            });
        });

        function initLeafletMap(visitesData) {
            var allVisits = [];
            for (var type in visitesData) {
                if (visitesData.hasOwnProperty(type) && Array.isArray(visitesData[type])) {
                    allVisits = allVisits.concat(visitesData[type]);
                }
            }

            if (allVisits.length === 0) {
                $('#map-container').html('<p>No location data available</p>');
                return;
            }

            allVisits.sort(function(a, b) {
                return new Date(a.date) - new Date(b.date);
            });

            if (window.visiteMap) {
                window.visiteMap.remove();
                window.visiteMap = null;
            }

            var map = L.map('map-container');
            window.visiteMap = map;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var firstIcon = new L.Icon({
                iconUrl: '/img/marker2/marker-icon-black-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            var lastIcon = new L.Icon({
                iconUrl: '/img/marker2/marker-icon-red-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            var defaultIcon = new L.Icon({
                iconUrl: '/img/marker2/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            var markers = [];
            var routePoints = [];

            allVisits.forEach(function(visit, index) {
                var isFirst = (index === 0);
                var isLast = (index === allVisits.length - 1);

                if (!visit.latitude || !visit.longitude) return;

                var visitLatLng = L.latLng(parseFloat(visit.latitude), parseFloat(visit.longitude));
                routePoints.push(visitLatLng);

                var icon = isFirst ? firstIcon : (isLast ? lastIcon : defaultIcon);

                var marker = L.marker(visitLatLng, {
                    icon: icon,
                    title: ((visit.client_nom || '') + ' ' + (visit.client_prenom || '')).trim()
                }).addTo(map);

                marker.bindPopup(`
            <strong>${((visit.client_nom || '') + ' ' + (visit.client_prenom || '')).trim()}</strong><br>
            Date: ${visit.date || 'N/A'}<br>
            Timer: ${visit.timer || 'N/A'}<br>
            POT: ${visit.client_potentialite || 'N/A'}<br>
            ${isFirst ? '<b>Première visite</b>' : (isLast ? '<b>Dernière visite</b>' : '')}
        `);

                markers.push(marker);
            });

            if (routePoints.length > 1) {
                var routeLine = L.polyline(routePoints, {
                    color: 'blue',
                    weight: 3,
                    opacity: 0.7
                }).addTo(map);
            }

            if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            } else {
                map.setView([33.5731, -7.5898], 12);
            }
        }

        $('#weekPicker').flatpickr({
            dateFormat: "Y-m-d",
            weekNumbers: true,
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                dayElem.addEventListener('mouseenter', function() {
                    getWeekRowDays(dayElem, fp).forEach(function(el) {
                        el.classList.add('week-row-hover');
                    });
                });
                dayElem.addEventListener('mouseleave', function() {
                    getWeekRowDays(dayElem, fp).forEach(function(el) {
                        el.classList.remove('week-row-hover');
                    });
                });
            },
            onChange: function(selectedDates) {
                if (selectedDates[0]) {
                    window.location.href = '?date=' + getIsoWeekMondayFromDate(selectedDates[0]);
                }
            }
        });

        function getWeekRowDays(dayElem, fp) {
            var allDays = Array.prototype.filter.call(fp.days.children, function(d) {
                return d.classList.contains('flatpickr-day');
            });
            var idx = allDays.indexOf(dayElem);
            var rowStart = idx - (idx % 7);
            return allDays.slice(rowStart, rowStart + 7);
        }

        function getIsoWeekMondayFromDate(date) {
            var d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
            var day = d.getUTCDay() || 7;
            d.setUTCDate(d.getUTCDate() - day + 1);
            return d.toISOString().split('T')[0];
        }
    });
</script>
