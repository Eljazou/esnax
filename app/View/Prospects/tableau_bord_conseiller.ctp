<style>
    :root {
        /* Restored Lavender Theme Colors */
        --kt-primary: #9b90e0;
        --kt-primary-hover: #7e71cf;
        --kt-primary-light: #f4f2fc;
        --kt-primary-pale: #ece7fb;
        
        --kt-success: #5ad1a8;
        --kt-success-dark: #2f9c78;
        --kt-success-light: #e6faf3;
        
        --kt-text-dark: #2d2b42;
        --kt-text-gray: #4b5563;
        --kt-text-muted: #8b87a3;
        
        --kt-bg-body: #F9FAFB;
        --kt-border-color: #ece9f9;
        --kt-table-th-bg: #ece7fb; /* Matching header tint */
        
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        
        --shadow-sm: 0 2px 14px rgba(108,92,231,0.06);
        --shadow-md: 0 4px 20px rgba(108,92,231,0.12);
    }

    body {
        background-color: var(--kt-bg-body);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: var(--kt-text-dark);
    }

    /* Card Wrapper */
    .box {
        background: #ffffff;
        border: 1px solid var(--kt-border-color);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        transition: box-shadow 0.2s ease;
    }
    .box:hover {
        box-shadow: var(--shadow-md);
    }
    .box .box-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--kt-border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .box .box-body {
        padding: 24px;
    }

    /* Section Headers */
    .section-header {
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }
    .section-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: var(--kt-primary-light);
        color: var(--kt-primary-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }
    .box-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: var(--kt-text-dark);
    }

    /* Fixed Flexbox Search Filter Form */
    .filter-card-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 20px;
        flex-wrap: wrap;
    }
    .filter-card-label {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--kt-text-dark);
        margin: 0;
    }
    #dateform {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-grow: 1;
        max-width: 500px;
    }
    #dateform .input-group {
        display: flex;
        align-items: center;
        position: relative;
        flex-grow: 1;
    }
    #dateform .input-group-addon {
        position: absolute;
        left: 14px;
        z-index: 10;
        color: var(--kt-primary-hover);
        pointer-events: none;
    }
    #dateform .form-control {
        width: 100%;
        height: 42px;
        padding: 10px 14px 10px 40px;
        border: 1px solid var(--kt-border-color);
        background-color: #ffffff;
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--kt-text-dark);
        outline: none;
        transition: all 0.2s ease;
    }
    #dateform .form-control:focus {
        border-color: var(--kt-primary);
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15);
    }
    #dateform input[type="submit"] {
        height: 42px;
        background: var(--kt-primary);
        border: none;
        border-radius: var(--radius-sm);
        color: #ffffff;
        padding: 0 24px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s ease, box-shadow 0.2s ease;
        white-space: nowrap;
        box-shadow: 0 3px 10px rgba(155, 144, 224, 0.25);
    }
    #dateform input[type="submit"]:hover {
        background: var(--kt-primary-hover);
    }

    /* Clean Metronic Table Styling */
    .table-responsive {
        overflow-x: auto;
        border-radius: var(--radius-xl);
    }
    table.table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    table.table thead th, table.table tr th {
        background: var(--kt-table-th-bg);
        color: var(--kt-primary-hover);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .02em;
        padding: 14px 16px;
        border-bottom: 1px solid var(--kt-border-color);
        text-align: center;
    }
    table.table tr th:first-child, table.table tr td:first-child {
        text-align: left;
        padding-left: 24px;
    }
    table.table td {
        padding: 14px 16px;
        font-size: 13px;
        color: var(--kt-text-dark);
        border-bottom: 1px solid var(--kt-border-color);
        vertical-align: middle;
        text-align: center;
    }
    table.table tbody tr:last-child td {
        border-bottom: none;
    }
    table.table.table-hover tbody tr:hover td {
        background-color: var(--kt-primary-light);
    }
    table.table a {
        color: var(--kt-text-dark);
        font-weight: 600;
        text-decoration: none;
    }
    table.table a:hover {
        color: var(--kt-primary-hover);
        text-decoration: underline;
    }

    /* Refactored Visit Detail Metric Buttons */
    .detailbtn {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        padding: 6px 10px;
        background: var(--kt-primary-light);
        border: none;
        min-width: 55px;
        gap: 2px;
        transition: all 0.15s ease;
    }
    .detailbtn:hover {
        background: var(--kt-primary-pale);
    }
    .detailbtn c {
        display: block;
        font-weight: 700;
        font-size: 13px;
        color: var(--kt-text-dark);
    }
    .detailbtn c:last-child {
        color: var(--kt-success-dark);
        font-size: 11.5px;
        font-weight: 600;
    }

    /* Metronic Style Modern Modal */
    #detailModal .modal-content {
        border-radius: var(--radius-lg) !important;
        border: none !important;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        background: #fff;
    }
    #detailModal .modal-header {
        background: var(--kt-primary) !important;
        border-bottom: none !important;
        padding: 20px 24px !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    #detailModal .modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }
    #detailModal .close {
        color: #ffffff !important;
        font-size: 35px;
        font-weight: 300;
        opacity: 0.9;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: opacity 0.2s;
        margin-top: -5px;
    }
    #detailModal .close:hover {
        opacity: 1;
    }
    #detailModal .modal-body {
        padding: 24px !important;
    }
    #detailModal .table-detail th {
        background: var(--kt-primary-light);
        border: 1px solid var(--kt-border-color);
        color: var(--kt-text-dark);
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: .02em;
        font-weight: 600;
    }
    #detailModal .table-detail td {
        border: 1px solid var(--kt-border-color);
    }
    #detailModal .table-detail tr:hover td {
        background: var(--kt-primary-light);
    }
    .time {
        display: inline-block;
        font-weight: 600;
        color: var(--kt-primary-hover);
        background: var(--kt-primary-light);
        padding: 6px 12px;
        border-radius: var(--radius-sm);
        font-size: 12px;
    }
</style>

<?php echo $this->Html->script('jquery-2.2.3.min'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
</script>

<!-- Filter Section -->
<div class="col-md-12" style="margin-bottom: 24px; padding:0px;"> 
    <div class="box">
        <div class="box-header">
            <div class="filter-card-wrapper">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-filter"></i></span>
                    <label class="filter-card-label">Pour des statistiques d'une période précise, veuillez sélectionner une date :</label>
                </div>
                <form action="<?php echo $this->Html->url(array("action" => "tableau_bord_conseiller")); ?>/" method="get" id="dateform" autocomplete="off">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </span>
                        <input type="text" class="form-control" name="date" id="datepicker" placeholder="Rechercher" autocomplete="off">
                    </div>
                    <input type="submit" value="Rechercher">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Summary Detail view -->
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top: 8%; max-height: 450px; overflow: hidden; display: flex; flex-direction: column;">
            <div class="modal-header">
                <h2 class="modal-title" id="gridModalLabel">Détail</h2>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="overflow-y: auto; flex-grow: 1; display: flex; gap: 20px; align-items: flex-start;">
                <table class="table table-bordered table-detail" style="width:75%; margin: 0;">
                    <thead>
                        <tr>
                            <th>Campagne</th>
                            <th>Société</th>
                            <th>Type client</th>
                            <th>Etat</th>
                            <th>Duree</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic contents injection here -->
                    </tbody>
                </table>
                <div style="width:25%; text-align: right;">
                    <b class="time"></b>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$detail = array();
$solo = array();
$gps = array();
$ids = "0";
$cc = array();
foreach ($users as $vmp):
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="section-header">
                        <span class="section-icon"><i class="fa fa-users"></i></span>
                        <h3 class="box-title">
                            Rapport des visites de l'équipe de <?php echo $vmp['super']['User']['name']; ?>
                        </h3>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" border="0">
                        <thead>
                            <tr>
                                <th><?php echo __('VM'); ?></th>
                                <?php
                                for ($i = 1; $i < 8; $i++) {
                                    $nbDay = date('N', strtotime($date));
                                    $monday = new DateTime($date);
                                    $date_debut = $monday->modify('-' . ($nbDay - $i) . ' days')->format('d-m-Y');
                                    echo "<th>$date_debut</th>";
                                }
                                ?>
                                <th>%</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($vmp as $vm) {
                                echo "<tr><td>" . $this->Html->link($vm['User']['name'], array('action' => 'view', $vm['User']['id'])) . "</td>";
                                $t = 0;
                                $objectif = 0;
                                $total = 0;
                                for ($i = 1; $i < 8; $i++) {
                                    $vv = 0;
                                    $nbDay = date('N', strtotime($date));
                                    $monday = new DateTime($date);
                                    $date_debut = $monday->modify('-' . ($nbDay - $i) . ' days')->format('Y-m-d');
                                    $udid = 0;
                                    foreach ($vm["appels"] as $visite) {
                                        $v = $visite['Rapportprocpect'];
                                        $cc[$visite["Client"]["id"]]["name"] = $visite["Client"]["nom"];
                                        $cc[$visite["Client"]["id"]]["type_pharmacie"] = $visite["Client"]["type_pharmacie"];
                                        $cc[$visite["Client"]["id"]]["etat"] = $visite["Prospectfeuille"]["etat"];
                                        $cc[$visite["Client"]["id"]]["date"] = $visite["Rapportprocpect"]["created"];
                                        $cc[$visite["Client"]["id"]]["duree"] = $visite["Rapportprocpect"]["duree"];
                                        $cc[$visite["Client"]["id"]]["campgane"] = "";
                                        if ($date_debut <= date("Y-m-d", strtotime($v['created'])) && $date_debut." 23:59:59" >=$v['created']) {
                                            foreach ($campagnes as $campagne) {
                                                if ($visite["Prospectfeuille"]["prospectcompagne_id"] == $campagne["Prospectcompagne"]["id"]) {
                                                    $cc[$visite["Client"]["id"]]["campgane"] = $campagne["Prospectcompagne"]["name"];
                                                    $objectif = $campagne["Prospectcompagne"]["objectif"];
                                                    break;
                                                }
                                            }
                                            $dateaffiche = $v['created'];
                                            $d = explode(" ", $v['created']);
                                            $detail[$visite['User']['id']][$d[0]][$v['client_id']] = $dateaffiche;
                                            $ids = $ids . "," . $v['client_id'];

                                            $vv++;
                                            $udid = $visite['User']['id'] . "_" . $date_debut;
                                        }
                                    }

                                    echo "<td><b class='detailbtn' style='cursor:pointer;' id='$udid'><c id='" . $udid . "_m'>$vv</c><c id='" . $udid . "_p'>0</c> </b></td>";
                                    $total += $vv;
                                }

                                $objectif = $objectif * 5;
                                $porcentage = 0;
                                if ($objectif != 0)
                                    $porcentage = round($total / $objectif * 100, 0);
                                echo "<td style='font-weight: 600;'>" . $porcentage . "% </td>";
                                echo "<td style='color: var(--kt-text-gray);'>" . $objectif . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
endforeach;
echo $this->Html->script('jquery-2.2.3.min');
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEpnSCwdoRPf5V3vIWy7j6wzjewQRC8uE&amp;"></script>
<script>
    var clients = <?php echo json_encode($cc); ?>;
    var detail = <?php echo json_encode($detail); ?>;
    var solo = <?php echo json_encode($solo); ?>;
    for (user_id in detail) {
        for (date in detail[user_id]) {
            var nombremedcin = 0;
            var nombrepharmacie = 0;
            for (client_id in detail[user_id][date]) {
                if (typeof (clients[client_id]) == 'undefined')
                    continue;
                if (clients[client_id]['type_pharmacie'] == "Client")
                    nombremedcin++;
                else
                    nombrepharmacie++;
            }
            document.getElementById(user_id + "_" + date + "_m").innerText = nombremedcin;
            document.getElementById(user_id + "_" + date + "_p").innerText = nombrepharmacie;
        }
    }

    var mapscord = [];
    $(".detailbtn").click(function () {
        mapscord = [];
        var data = $(this).attr('id');
        data = data.split("_");
        var id = data[0];
        var date = data[1];
        var arr = [];
        var key;
        var a, b, x, y, v, z;
        for (key in detail[id][date]) {
            arr.push(key + " " + detail[id][date][key]);
            arr.sort(function (a, b) {
                a = a.split(" ");
                b = b.split(" ");
                x = a[1];
                y = b[1];
                v = a[2];
                z = b[2];
                if (x < y) return -1;
                if (x > y) return 1;
                if (x == y) {
                    if (v < z) return -1;
                    if (v > z) return 1;
                }
                return 0;
            });
        }
        var i = 0;
        $(".table-detail .tremove").remove();
        for (i; i < arr.length; i++) {
            arr[i] = arr[i].toString().split(" ");
            var idc = arr[i][0];
            var nom = clients[idc]['name'];
            var activite = clients[idc]['campgane'];
            var pot = clients[idc]['type_pharmacie'];
            var pot1 = clients[idc]['etat'];
            var duree = clients[idc]['duree'];
            var tr = "<tr class='tremove'><td><a target='_blank' href='https://connectlabo.com/clients/view/" + arr[i][0] + "'>" + nom + "</a></td><td>" + activite + "</td><td>" + pot + "</td><td>" + pot1 + "</td><td>" + duree + "</td><td>" + arr[i][1] + " " + arr[i][2] + "</td></tr>";
            $(".table-detail").append(tr);
        }
        $("#detailModal").modal();
        setTimeout(function () {
            time();
        }, 300);
    });

    function time() {
        $(".time").text("");
        var trl = $(".table-detail .tremove").length;
        var date_debut = $(".table-detail .tremove:eq(0) td:eq(4)").text();
        var date_fin = $(".table-detail .tremove:eq(" + (trl - 1) + ") td:eq(4)").text();
        var time = (new Date(date_fin) - new Date(date_debut)) / 60 / 60 / 1000;
        if (time >= 1)
            $(".time").text(Math.round(time) + " Heure(s)");
        if (time < 1) {
            time = time * 60;
            $(".time").text(Math.round(time) + " Minute(s)");
        }
    }
</script>