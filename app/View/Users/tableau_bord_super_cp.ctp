<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">


<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    .content-header {
        font-family: "Poppins", sans-serif !important;
    }

    .box {
        border-radius: 12px;
    }

    .box .box-title {
        margin: 0;
        font-size: 15px;
        height: 35px;
    }

    .boxes-statistique {
        display: -webkit-box;
        overflow-x: scroll;
        width: 99%;
        margin-left: 3px;
        margin-bottom: 12px;

    }

    .box-status {
        margin-bottom: 10px;
    }

    .div-number-status {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding-left: 14px;
        column-gap: 12px;
    }

    .circle {
        width: 16px;
        height: 16px;
        border-radius: 50px;
        display: inline-flex;
        background: brown;
    }

    .number-status {
        font-size: 30px;
        font-weight: 600;
    }

    .td-vm-name {
        display: flex;
        justify-content: flex-start;
        padding-left: 7px;
        align-items: flex-start;

    }

    /* style vm -name on table */

    .me-3 {
        margin-right: .75rem !important;
    }

    .symbol {
        display: inline-block;
        flex-shrink: 0;
        position: relative;
        border-radius: .475rem;
    }

    .symbol.symbol-50px .symbol-label {
        width: 50px;
        height: 50px;
        overflow: hidden;
        border-radius: 50%;
    }

    .symbol .symbol-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: #252F4A;
        /* background-color: #f9f9f9; */
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }





    .d-direction {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
    }

    .mysymbole {
        position: relative;
        border-radius: 50%;
        height: 57px;
    }

    .symbol-circle {
        position: relative;
        border-radius: 50%;
    }

    .symbol-circle-success {
        border: 4px solid #17C653 !important;
    }

    .symbol-circle-warning {
        border: 4px solid #ff641a !important;
    }

    .symbol-circle-danger {
        border: 4px solid #f8285a !important;
    }

    .bg-light-danger {
        background-color: #ffeef3 !important;
        color: #f8285a;
    }

    .bg-light-warning {
        background-color: #fff8dd !important;
        color: #f6c000;
    }

    .bg-light-success {
        background-color: #dfffea !important;
        color: #17c653;
    }


    .symbol-circle-danger::after {
        content: '\f071';
        font-family: "Font Awesome 5 pro";
        background-color: #F8285A;
    }

    .symbol-circle-warning::after {
        content: '\f06a';
        font-family: "Font Awesome 5 pro";
        background-color: #ff641a;
    }

    .symbol-circle-success::after {
        content: '\f058';
        font-family: "Font Awesome 5 pro";
        background-color: #17C653;
    }


    .symbol-circle-danger::after,
    .symbol-circle-warning::after,
    .symbol-circle-success::after {
        border-radius: 50px;
        font-size: 10px;
        color: white;
        position: absolute;
        z-index: 99;
        bottom: -12px;
        right: 31%;
        height: 20px;
        width: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bg-light-warning .symbol-label {
        color: #ff641a !important;
    }

    .bg-light-danger .symbol-label {
        color: #F8285A !important;
    }

    .bg-light-success .symbol-label {
        color: #17C653 !important;
    }


    .w-100 {
        width: 100%;
    }

    .text-left {
        text-align: left;
    }



    /* this style for colore bg td for evry day */
    .mytables>tbody>tr>td {
        padding: 0;
    }

    .visite_number,
    .p-8 td {
        padding: 8px 3px !important;

    }

    .visite_number:hover {
        cursor: pointer;
        background-color: #00000012 !important;
    }
</style>

<div class="row">
    <div class="col-md-5">
        <h2>Tableau de bord</h2>
    </div>
    <div class="col-md-7">
        <div class="box box-solid box-status">
            <div class="box-body">
                <label for="weekPicker">Sélectionner une semaine :</label>
                <input type="week" id="weekPicker" class="form-control" />
            </div>
        </div>
    </div>
    <?php
    foreach ($users as $user_supe_key => $super) {
        if ($user_supe_key == 2 || $user_supe_key == 416)
            continue;
    ?>
        <div class="col-md-12">

            <div class="boxes-statistique row boxes_<?php echo $user_supe_key; ?>">
                <div class="col-md-3">
                    <div class="box box-solid box-status">
                        <div class="box-body">
                            <h3 class="box-title title-status">Nombre vmp</h3>
                            <div class="div-number-status">
                                <span class="circle"></span>
                                <span class="number-status nbr_vmp"></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-solid box-status">
                        <div class="box-body">
                            <h3 class="box-title title-status">Objectif total</h3>
                            <div class="div-number-status">
                                <span class="circle"></span>
                                <span class="number-status tt_objectif"></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-solid box-status">
                        <div class="box-body">
                            <h3 class="box-title title-status">Objectif realisée</h3>
                            <div class="div-number-status">
                                <span class="circle"></span>
                                <span class="number-status tt_objectif_realise"></span>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            <div class="box box-solid">
                <div class="box-header with-border">

                    <h3 class="box-title"> Rapport des visites de l'équipe de <?php echo $super[0]['User']['name']; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table mytables table-striped  table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo 'VM'; ?></th>
                                <th>Type</th>
                                <?php
                                for ($i = 1; $i < 8; $i++) {
                                    $nbDay = date('N', strtotime($date));

                                    // Attempt to create a DateTime object
                                    try {
                                        $monday = new DateTime($date);
                                    } catch (Exception $e) {
                                        echo "Error: " . $e->getMessage();
                                        exit;
                                    }

                                    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                                    $formatter->setPattern('EEE:d - MMM');

                                    // Modify the date only if the DateTime object was created successfully
                                    if ($monday) {
                                        $monday->modify('-' . ($nbDay - $i) . ' days');
                                        $date_debut = $formatter->format($monday);

                                        // Remove the dot at the end of the day abbreviation
                                        $date_debut = str_replace('.', '', $date_debut);

                                        // Output the formatted date
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
                            $count_vmp = count($super);
                            $totale_objectif = 0; //this for objectif in boxes top
                            $tt_objectif_realise = 0; //this for objectif in boxes top
                            $arr_all_objectif_detail = []; //this for detail how much pharmacie medecin in boxes top ...
                            $useAlternateBg = false; // this for color bg of odd row 

                            foreach ($super as $key_vmp => $vmp) {
                                // this for porcent of objectif for eache vm this for cadre around image vm calucule porcent all objectif not based type client
                                $all_obj_vm = 0;
                                $all_obj_vm_realise = 0;
                                // this for bg colo of odd row 
                                $myBgColor = $useAlternateBg ? '#f9f9f9' : '#ffffff';
                                $useAlternateBg = !$useAlternateBg;

                                $count_objectif = count($vmp['Objectif']);
                                $i = 0;

                                if (empty($vmp['Objectif'])) { ?>
                                    <tr style="background-color: <?php echo $myBgColor; ?>;" class="p-8 mytr tr_<?php echo $key_vmp; ?>">
                                        <td> <?php echo $vmp['User']['name']; ?> </td>
                                        <td colspan='10'>Aucune visite,ou merci de vérifier l'objectif.</td>
                                    </tr>
                                <?php
                                }
                                foreach ($vmp['Objectif'] as $objectif) {
                                    $rowspan = "";
                                    $class_mytr = "";
                                    $objectif_day = $objectif['objectif'] / 5;
                                    $style_border = "";
                                    if ($i == 0) {
                                        $rowspan = $count_objectif;
                                        $class_mytr = "mytr tr_" . $key_vmp;
                                        $style_border = "border-top: 3px solid #b8b8b8;";
                                    }
                                ?>
                                    <tr style="background-color: <?php echo $myBgColor . ';' . $style_border; ?>" class="<?php echo $class_mytr;  ?>">
                                        <?php
                                        if ($i == 0) { ?>
                                            <td rowspan="<?php echo $count_objectif; ?>">
                                                <div class="td-vm-name">
                                                    <?php if (isset($vmp['User']['image'])) { ?>

                                                        <div class="symbol symbol-circle symbol-50px  me-3">
                                                            <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                                <div class="symbol-label">
                                                                    <?php echo $this->Html->image('users/' . $vmp['User']['image'], array('class' => 'w-100')); ?>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    <?php } else { ?>

                                                        <div class="symbol symbol-circle symbol-50px  me-3">
                                                            <a href="<?php echo $this->Html->url(array('action' => 'view', $vmp['User']['id'])) ?>">
                                                                <div class="symbol-label fs-3">
                                                                    <?php
                                                                    if (isset($vmp['User']['name'])) {
                                                                        echo substr($vmp['User']['name'], 0, 1);
                                                                    } else {
                                                                        echo 'Vide'; // default text if name is not set
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    <?php } ?>
                                                    <div class="d-direction">
                                                        <?php echo  $this->Html->link($vmp['User']['name'], array('action' => 'view', $vmp['User']['id']), array('class' => 'text-left')) ?>
                                                        <span><?php echo $vmp['User']['role']; ?></span>
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
                                            $vv = 0;
                                            $nbDay = date('N', strtotime($date));
                                            $monday = new DateTime($date);
                                            $date_debut = $monday->modify('-' . ($nbDay - $i) . ' days')->format('Y-m-d');
                                            $cl_bg_td = "";

                                        ?>
                                            <td>
                                                <?php
                                                $count_visite = isset($vmp['Visite'][$date_debut][$objectif['type']])
                                                    ? count($vmp['Visite'][$date_debut][$objectif['type']])
                                                    : 0;
                                                if ($count_visite == ($objectif_day - 1)) {
                                                    $cl_bg_td = "bg-light-warning";
                                                } elseif ($count_visite < $objectif_day) {
                                                    $cl_bg_td = "bg-light-danger";
                                                } else {
                                                    $cl_bg_td = "bg-light-success";
                                                }
                                                $data = $vmp['Visite'][$date_debut] ?? [];
                                                $data_visites_json = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                                                $current_type = htmlspecialchars($objectif['type'] ?? '', ENT_QUOTES, 'UTF-8');
                                                echo "<div class='visite_number {$cl_bg_td}' data-visites='{$data_visites_json}' data-current-type='{$current_type}' onclick='showVisiteModal(this)'><b>{$count_visite}</b></div>";
                                                $total_visite_week += $count_visite;
                                                ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <?php
                                            $totale_objectif += $objectif['objectif'];
                                            echo "<b>" . $objectif['objectif'] . "</b>"; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $c = "";
                                            $porcent_per_objectif = round($total_visite_week / $objectif['objectif'], 2) * 100;
                                            if ($porcent_per_objectif < 50) {
                                                $c = "#F8285A";
                                            } else if ($porcent_per_objectif < 75 && $porcent_per_objectif >= 50) {
                                                $c = "#f5aa02";
                                            } else {
                                                $c = "#34c180";
                                            }

                                            echo "<b style='color:" . $c . "'>" . $total_visite_week . " | " . $porcent_per_objectif . "% </b>";

                                            // hadi knkhdem biha f top boxes for calcule Objectif realisée
                                            $tt_objectif_realise += $total_visite_week;

                                            $all_obj_vm += $objectif['objectif'];
                                            $all_obj_vm_realise += $total_visite_week;

                                            // put data in $arr_all_objectif_detail
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

                                // this for calcule porcent of all type client of vm that for cadr image
                                if ($all_obj_vm != 0) {
                                    $porcent_all_obj_vm = round($all_obj_vm_realise / $all_obj_vm, 2) * 100;
                                } else {
                                    $porcent_all_obj_vm = 0; // Or null, or "N/A", depending on what you prefer
                                }
                                ?>
                                <input type="hidden" id="vm_<?php echo $key_vmp; ?>" data-index="<?php echo $key_vmp; ?>" class="vm_hidden" value="<?php echo $porcent_all_obj_vm; ?>">

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->



            </div>
            <!-- /.box -->
        </div>
        <script>
            let count_vmp = <?php echo $count_vmp; ?>;
            let tt_objectif = <?php echo $totale_objectif; ?>;
            let tt_objectif_realise = <?php echo $tt_objectif_realise; ?>;
            let arr_all_objectif_detail = <?php echo json_encode($arr_all_objectif_detail); ?>;


            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .nbr_vmp').textContent = count_vmp;
            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .tt_objectif').textContent = tt_objectif;
            document.querySelector('.boxes_<?php echo $user_supe_key; ?> .tt_objectif_realise').textContent = tt_objectif_realise;

            const container = document.querySelector('.boxes_<?php echo $user_supe_key; ?>');

            for (const [key, values] of Object.entries(arr_all_objectif_detail)) {
                const boxHTML = `
            <div class="col-md-3">
                <div class="box box-solid box-status">
                    <div class="box-body">
                        <h3 class="box-title title-status">${key}</h3>
                        <div class="div-number-status">
                            <span class="circle"></span>
                            <span class="number-status">${values.realisee}/${values.objectif}</span><br/>
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
    <div class="modal-dialog modal-lg">
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
<!-- Add these in your <head> section -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // this code for cadre around image or badge vm
    $(document).ready(function() {
        $(".mytables").each(function() {
            // For each .myboxs container
            console.log($(this));
            $(this).find(".vm_hidden").each(function() {
                // For each .vm_hidden inside the current .myboxs
                let index = $(this).data("index"); // Get data-index attribute
                console.log(index);
                let value = parseFloat($(this).val()); // Get value as number

                // Build the target selector for the tr and symbol
                let $symbol = $(".tr_" + index + " .symbol");

                // First, remove all related classes (optional cleanup)
                $symbol.removeClass("symbol-circle-danger bg-light-danger symbol-circle-warning bg-light-warning symbol-circle-success bg-light-success");

                // Now apply classes based on value
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
    // scripte for click on number for show visites #

    $(document).ready(function() {
        // Click handler for the visite_number divs
        $(document).on('click', '.visite_number', function() {
            // Get the data from the clicked div
            var visitesData = JSON.parse($(this).attr('data-visites'));
            var currentType = $(this).attr('data-current-type');

            // Clear previous content
            $('#modal-default .nav-tabs').empty();
            $('#modal-default .tab-content').empty();

            // Get all unique types from the data
            var types = [];
            for (var type in visitesData) {
                if (visitesData.hasOwnProperty(type)) {
                    types.push(type);
                }
            }

            // Create tabs
            types.forEach(function(type, index) {
                var isActive = (type === currentType) ? 'active' : '';

                // Add tab header
                $('#modal-default .nav-tabs').append(
                    '<li class="' + isActive + '"><a href="#tab_' + index + '" data-toggle="tab">' + type + '</a></li>'
                );

                // Add tab content
                var tabContent = '<div class="tab-pane ' + isActive + '" id="tab_' + index + '">';

                // Add the visits data
                if (visitesData[type] && visitesData[type].length > 0) {
                    tabContent += '<table class="table table-bordered">';
                    tabContent += '<thead><tr><th>Nom & Prénom</th><th>Activité</th><th>POT</th><th>Date</th><th>Timer</th></tr></thead>';
                    tabContent += '<tbody>';

                    visitesData[type].forEach(function(visite) {
                        tabContent += '<tr>';
                        tabContent += '<td>' + ((visite.client_nom || '') + ' ' + (visite.client_prenom || '')).trim() + '</td>';
                        tabContent += '<td>' + (visite.client_activite || 'N/A') + '</td>';
                        tabContent += '<td>' + (visite.client_potentialite || 'N/A') + '</td>';
                        tabContent += '<td>' + (visite.date || 'N/A') + '</td>';
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

            // Add map tab
            $('#modal-default .nav-tabs').append('<li><a href="#tab_map" data-toggle="tab">Map</a></li>');

            // Create the map tab content
            var mapTabContent = '<div class="tab-pane" id="tab_map">';
            mapTabContent += '<div id="map-container" style="height: 400px; width: 100%;"></div>';
            mapTabContent += '</div>';
            $('#modal-default .tab-content').append(mapTabContent);

            // Add the close button back to the nav tabs
            $('#modal-default .nav-tabs').append(
                '<li class="pull-right">' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">×</span></button>' +
                '</li>'
            );

            // Show the modal
            $('#modal-default').modal('show');

            // Initialize map after modal is shown
            $('#modal-default').on('shown.bs.modal', function() {
                // Make sure we only initialize the map once per modal show
                if (!$(this).data('map-initialized')) {
                    initLeafletMap(visitesData);
                    $(this).data('map-initialized', true);
                }
            });

            // Reset the map initialization flag when the modal is hidden
            $('#modal-default').on('hidden.bs.modal', function() {
                $(this).data('map-initialized', false);
            });
        });

        // Function to initialize the Leaflet map
        function initLeafletMap(visitesData) {
            // Collect all visits in a single array
            var allVisits = [];
            for (var type in visitesData) {
                if (visitesData.hasOwnProperty(type) && Array.isArray(visitesData[type])) {
                    allVisits = allVisits.concat(visitesData[type]);
                }
            }

            // If no visits, don't proceed
            if (allVisits.length === 0) {
                $('#map-container').html('<p>No location data available</p>');
                return;
            }

            // Sort visits by date
            allVisits.sort(function(a, b) {
                return new Date(a.date) - new Date(b.date);
            });

            // Initialize the map
            var map = L.map('map-container');

            // Add the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Define custom icon for markers
            function createCustomIcon(color) {
                return new L.Icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41],
                    className: 'custom-icon-' + color,
                    // Use CSS to style the icon according to color
                    // We'll add CSS for this dynamically
                });
            }

            // Add CSS for custom colored markers
            var style = document.createElement('style');
            style.innerHTML = `
            .custom-icon-red img {
                filter: hue-rotate(140deg) saturate(5) brightness(0.9);
            }
            .custom-icon-black img {
                filter: brightness(0) saturate(100%);
            }
            .custom-icon-blue img {
                filter: hue-rotate(220deg) saturate(1.5);
            }
        `;
            document.head.appendChild(style);

            // Create icons
            var redIcon = createCustomIcon('red');
            var blackIcon = createCustomIcon('black');
            var blueIcon = createCustomIcon('blue');

            var markers = [];
            var routePoints = [];

            // Add markers for all visits and collect points for the route
            allVisits.forEach(function(visit, index) {
                var isFirst = (index === 0);
                var isLast = (index === allVisits.length - 1);

                // Skip if no valid coordinates
                if (!visit.latitude || !visit.longitude) return;

                var visitLatLng = L.latLng(parseFloat(visit.latitude), parseFloat(visit.longitude));
                routePoints.push(visitLatLng);

                // Choose icon based on position
                var icon = isFirst ? redIcon : (isLast ? blackIcon : blueIcon);

                // Create marker for visit location
                var marker = L.marker(visitLatLng, {
                    icon: icon,
                    title: ((visit.client_nom || '') + ' ' + (visit.client_prenom || '')).trim()
                }).addTo(map);

                // Add popup with visit information
                marker.bindPopup(`
                <strong>${((visit.client_nom || '') + ' ' + (visit.client_prenom || '')).trim()}</strong><br>
                Date: ${visit.date || 'N/A'}<br>
                Timer: ${visit.timer || 'N/A'}<br>
                POT: ${visit.client_potentialite || 'N/A'}<br>
                ${isFirst ? '<b>First Visit</b>' : (isLast ? '<b>Last Visit</b>' : '')}
            `);

                markers.push(marker);
            });

            // Create a line connecting all visit points in sequence
            if (routePoints.length > 1) {
                var routeLine = L.polyline(routePoints, {
                    color: 'blue',
                    weight: 3,
                    opacity: 0.7
                }).addTo(map);
            }

            // Fit the map to show all markers
            if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1)); // Add 10% padding around the bounds
            } else {
                // Default view if no valid markers
                map.setView([33.5731, -7.5898], 12); // Default to Casablanca
            }

            // Fix the map display issue - force a redraw when tab is shown
            $('a[data-toggle="tab"][href="#tab_map"]').on('shown.bs.tab', function(e) {
                map.invalidateSize();
            });
        }

        // code for week date picker  :


        $('#weekPicker').on('click', function() {
            this.showPicker && this.showPicker(); // optional trigger
        });

        $('#weekPicker').on('change', function() {
            const weekValue = $(this).val(); // e.g. "2025-W21"
            if (weekValue) {
                const [year, week] = weekValue.split('-W');
                const mondayDate = getIsoWeekMonday(parseInt(year), parseInt(week));
                window.location.href = '?date=' + mondayDate;
            }
        });

        function getIsoWeekMonday(year, week) {
            // Get date of the Monday of the given ISO week
            const simple = new Date(Date.UTC(year, 0, 1 + (week - 1) * 7));
            const day = simple.getUTCDay();
            const isoMonday = simple;
            if (day <= 4) {
                // Mon-Thu: subtract day-1
                isoMonday.setUTCDate(simple.getUTCDate() - day + 1);
            } else {
                // Fri-Sun: add 8-day
                isoMonday.setUTCDate(simple.getUTCDate() + 8 - day);
            }
            return isoMonday.toISOString().split('T')[0]; // YYYY-MM-DD
        }



    });
</script>