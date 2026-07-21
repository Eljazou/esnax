<style>
    .table tr td:nth-child(1),
    .table tr th:nth-child(1) {
        text-align: left !important;
        padding-left: 10px;
    }

    #map-canvas {
        width: 100%;
        float: left;
        height: 350px;
    }

    .skin-blue {
        padding-right: 0px !important;
    }

    .divPadding {
        padding-left: 5px;
        padding-right: 5px;
    }

    .gauge {
        position: relative;
        border-radius: 50%/100% 100% 0 0;
        background-color: var(--color, #a22);
        overflow: hidden;
    }

    .gauge:before {
        content: "";
        display: block;
        padding-top: 50%;
        /* ratio of 2:1*/
    }

    .gauge .chart {
        overflow: hidden;
    }

    .gauge .mask {
        position: absolute;
        left: 20%;
        right: 20%;
        bottom: 0;
        top: 40%;
        background-color: #fff;
        border-radius: 50%/100% 100% 0 0;
    }

    .gauge .percentage {
        position: absolute;
        top: -1px;
        left: -1px;
        bottom: 0;
        right: -1px;
        background-color: var(--background, #aaa);
        transform: rotate(var(--rotation));
        transform-origin: bottom center;
        transition-duration: 600;
    }

    .gauge:hover {
        --rotation: 100deg;
    }

    .gauge .value {
        position: absolute;
        bottom: 0%;
        left: 0;
        width: 100%;
        text-align: center;
        font-size: 50px;
    }

    .gauge .min {
        position: absolute;
        bottom: 0;
        left: 5%;
    }

    .gauge .max {
        position: absolute;
        bottom: 0;
        right: 5%;
    }

    .modal-lg {
        width: 90% !important;
    }

    .all-body-modal {
        max-height: 300px;
        overflow: auto;
    }

    .modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 22px 5px 0px;
    }

    /* style bottom */
    @media (min-width: 768px) {
        .d-md-flex {
            display: -webkit-flex !important;
            display: -ms-flexbox !important;
            display: flex !important;
        }
    }

    .flex-fill {
        -webkit-flex: 1 1 auto !important;
        -ms-flex: 1 1 auto !important;
        flex: 1 1 auto !important;
    }

    .pad {
        font-size: 13px;
    }

    .dark-mode .bg-success,
    .dark-mode .bg-success>a {
        color: #999696 !important;
    }

    .card-pane-right {
        background-color: #FFF !important;
        height: 500px;
        justify-content: space-between;
        width: 500px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .pl-4,
    .px-4 {
        padding-left: 1.5rem !important;
    }

    .pr-4,
    .px-4 {
        padding-right: 1.5rem !important;
    }

    .description-block {
        text-align: left;
        color: #3c3838;
        padding: 0 !important;
        margin: 0 !important;
    }

    .red {
        color: red;
    }

    .vert {
        color: #73ef73;
    }

    .yellow {
        color: yellow;
    }

    #map {
        height: 180px;
    }

    #datetimepicker {
        padding-right: 91px;
    }
</style>
<!-- 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php echo $this->Html->css('leaflet'); ?>

<div class="col-md-12" style="margin-bottom: 24px;padding:0px;">
    <div class="box form-group">
        <div class="box-header with-border">
            <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 6px;font-weight: normal;width: auto;text-align:left;float:left;">Pour des statistiques d'une période précise,veuillez sélectionner une date :</label>
            <div class="col-md-6" style="height: 37px;">
                <form action="<?php echo $this->Html->url(array("action" => "tableau_bord_super")); ?>/" method="get" id="dateform" autocomplete="off">
                    <div class="input-group col-lg-12" style="float:left;">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="date" class="form-control pull-right" name="date" id="datetimepicker" placeholder="Rechercher" autocomplete="off">
                    </div>
                    <input type="submit" value="Rechercher" style="float: right;top: -30px;position: relative;z-index: 999;right: 4px;-webkit-appearance:  none;background: #367fa9;border: none;border-radius: 3px;color: #fff;padding: 3px 5px;box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.52);">
                </form>
            </div>
        </div>

    </div>
</div>
<?php $id = "global"; ?>

<div class="row">
    <div class="col-md-12">
        <div class="box ">
            <div class="box-header with-border">
                <h3 class="box-title">Détails</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" id="statistiques_mail">
                <section>
                    <div class="col-md-12" style="float: left;width: 100%;padding: 0px;">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding">
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <div id="<?php echo $id; ?>specailites" style="width:100%;max-width:600px;height:200px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding" id="<?php echo $id; ?>" id="<?php echo $id; ?>">
                            <h3>Objectif global</h3>
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <div class="gauge" style="width: 100%; max-width:600px;height:100%; --rotation:<?php echo round((180 * $objectifglobal / 100), 0); ?>deg; --color:#DCE35B; --background:#e9ecef;">
                                        <div class="percentage"></div>
                                        <div class="mask"></div>
                                        <span class="value"><?php echo $objectifglobal; ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding">
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <div id="<?php echo $id; ?>visites" style="width:100%; max-width:600px;height:200px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float: left;width: 100%;padding: 0px;">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding">
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <div id="<?php echo $id; ?>pots" style="width:100%; max-width:600px;height:200px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding" id="<?php echo $id; ?>">
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <div id="<?php echo $id; ?>nbvsitiesbydate" style="width:100%;max-width:600px;height:200px"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 divPadding">
                            <div class="small-box bg-white box box-default collapsed-box" style="border-top:0px;">
                                <div class="inner">
                                    <canvas id="<?php echo $id; ?>types" style="width:100%;max-width:600px;height:200px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- ./box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- ww -->


<div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-xs-12" style="border-radius: 6px;font-size: 16px;padding: 0px;">
            <div class="modal-head col-xs-12" style="background:#469ed1;color: #fff;">
                <h2 class="modal-title" id="gridModalLabel" style="width: auto;float: left;">Détail :</h2>
                <span class="modal-title-time"><b class="time"></b></span>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 35px;float: right;">×</button>
            </div>
            <div class="modal-body col-xs-12">
                <div class="all-body-modal">
                    <table class="table table-bordred table-detail col-xs-10" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Nom & Prénom</th>
                                <th>Activité</th>
                                <th>POT</th>
                                <th>POT1</th>
                                <th>Date</th>
                                <th>Timer</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-xs-2" style="width:25%;"><b class="time"></b></div> -->
                <div class="col-xs-2 pull-right" style="margin-top: 5px;">
                    <button data-toggle="modal" data-target="#detailMap" type="button" class="btn btn-primary bg-green detailmap">
                        <i class="fa fa-map-marker" style="margin-right: 6px;"></i>Détail Maps
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="detailMap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Maps <b style="float:right;margin-right:10px;"></b></h4>
            </div>
            <div class="modal-body" style="height: 480px;">
                <div id="map-canvas" class="col-md-12" style="height: 480px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<?php
$detail = array();
$solo = array();
$gps = array();
$visites_array = array();
$ids = "0";
foreach ($users as $vmp) :
    // debug($vmp);
    if ($vmp['super']['User']['id'] == 2)
        continue;

?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Rapport des visites de l'équipe de <?php echo $vmp['super']['User']['name']; ?>
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
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
                                <th>Objectif</th>
                                <th>Total</th>
                            </tr>
                            <?php
                            $objectif = 0;
                            foreach ($vmp as $visite) {

                                $objectifglobale = $objectifmedcin = $objectifpharma = 0;
                                $objectif = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $visite['User']['id'] . "/" . $date_debut);
                                //debug($objectif);
                                foreach ($objectif as $obj) {
                                    if ($obj['Type']['id'] != 2)
                                        $objectifmedcin = $obj['Objectif']['objectif'];
                                    if ($obj['Type']['id'] == 2)
                                        $objectifpharma = $obj['Objectif']['objectif'];
                                    $objectifglobale = $objectifglobale + $obj['Objectif']['objectif'];
                                }


                                echo "<tr><td>" . $this->Html->link($visite['User']['name'], array('action' => 'view', $visite['User']['id'])) . "</td>";
                                $t = 0;
                                for ($i = 1; $i < 8; $i++) {
                                    $vv = 0;
                                    $nbDay = date('N', strtotime($date));
                                    $monday = new DateTime($date);
                                    $date_debut = $monday->modify('-' . ($nbDay - $i) . ' days')->format('Y-m-d');
                                    $lat1 = $lon1 = $distance = 0;
                                    foreach ($visite['Visite'] as $v) {

                                        $v = $v["Visite"];
                                        if ($date_debut <= $v['date'] && "$date_debut 23:59:59" >= $v['date']) {
                                            //------------------ Calcule kélomtrage par jour -----------------------19/11/2020//
                                            if ($v["longitude"] != "" && $v["longitude"] != 0) {
                                                if ($lat1 == 0) {
                                                    $lat1 = $v["latitude"];
                                                    $lon1 = $v["longitude"];
                                                } else {
                                                    //echo $v["client_id"]." --".$v["id"]." :: $lat2 :: $lat1 <br>";
                                                    $lat2 = $v["latitude"];
                                                    $lon2 = $v["longitude"];
                                                    $theta = $lon1 - $lon2;
                                                    $dist = @sin(deg2rad($lat1)) * @sin(deg2rad($lat2)) +  @cos(deg2rad($lat1)) * @cos(deg2rad($lat2)) * @cos(deg2rad($theta));
                                                    $dist = acos($dist);
                                                    $dist = rad2deg($dist);
                                                    $miles = $dist * 60 * 1.1515;
                                                    $distance += round($miles * 1.609344, 2);
                                                    $lat1 = $v["latitude"];
                                                    $lon1 = $v["longitude"];
                                                }
                                            }
                                            //----------------------Fin Km----------------------------//
                                            $dateaffiche = $v['created'];
                                            $d = explode(" ", $v['date']);
                                            $datetest = explode(" ", $v['date']);
                                            if ($datetest[1] != "00:00:00")
                                                $dateaffiche = $v['date'];
                                            $detail[$visite['User']['id']][$d[0]][$v['client_id']] = $dateaffiche;

                                            //Systeme de verification c c'est une visite simple ou double  10-10-2018

                                            $solo[$visite['User']['id']][$d[0]][$v['client_id']] = "";
                                            if ($v['type_visite'] == "double") {
                                                $solo[$visite['User']['id']][$d[0]][$v['client_id']] = ""; //"(".$vmp['super']['User']['name'].') ';
                                                $solo[$vmp['super']['User']['id']][$d[0]][$v['client_id']] = "(" . $visite['User']['name'] . ') ';
                                                $detail[$vmp['super']['User']['id']][$d[0]][$v['client_id']] = $dateaffiche;
                                            }
                                            $pos = strpos($v['longitude'], "n");
                                            $poss = strpos($v['longitude'], "0.0");
                                            if (!empty($v['longitude']) && $pos === false && $poss === false)
                                                $gps[$visite['User']['id']][$d[0]][$v['client_id']] = $v['latitude'] . ',' . $v['longitude'];
                                            $ids = $ids . "," . $v['client_id'];
                                            $visites_array[$visite['User']['id']][$d[0]][$v['client_id']] = $v['timer'];
                                            $vv++;
                                        }
                                    }
                                    //ila kan visite double il faut chercher dans la table solo wach kain supervisseur kain des visites f nafs la date
                                    //10-10-2018
                                    if ($visite['User']['role'] == "Super viseur" && isset($solo[$vmp['super']['User']['id']][$date_debut])) {
                                        $temp = 0;
                                        foreach ($solo[$vmp['super']['User']['id']][$date_debut] as $r => $double) {
                                            if ($double != "")
                                                $temp++;
                                        }
                                        $vv = $vv + $temp;
                                    }
                                    $t = $t + $vv;
                                    $c = "";
                                    $udid = $visite['User']['id'] . "_" . $date_debut;
                                    if ($vv != 0) {
                                        $c = "color:#34c180;";
                                    }
                                    echo "<td data='$distance' style='font-weight:bold;$c'><b class='detailbtn' style='cursor:pointer;' id='$udid'><c id='" . $udid . "_m'>$vv</c> <br><c id='" . $udid . "_p'>0</c> </b></td>";
                                }
                                //echo "<td>$objectifglobale</td>";
                                echo "<td>$objectifmedcin <br>$objectifpharma</td>";
                                if ($objectifglobale == 0)
                                    $t = 0;
                                else
                                    $t = round($t / $objectifglobale, 2) * 100;
                                if ($t < 50)
                                    $c = "red";
                                else if ($t < 75 && $t >= 50)
                                    $c = "#f5aa02";
                                else
                                    $c = "#34c180";
                                echo "<td style='color:$c;font-weight:bold;'>$t%</td>";
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
?>

<?php
$clientss = $this->requestAction("/clients/system_get_clients_ids/$ids");

$cc = array();
foreach ($clientss as $c) {
    $cc[$c["clients"]["id"]]["name"] = $c["clients"]["nom"] . " " . $c["clients"]["prenom"];
    $cc[$c["clients"]["id"]]["activite"] = $c["clients"]["activite"];
    $cc[$c["clients"]["id"]]["pot"] = $c["clients"]["potentialite"];
    $cc[$c["clients"]["id"]]["pot1"] = $c["clients"]["potentialitev2"];
    $cc[$c["clients"]["id"]]["type"] = $c["clients"]["type_id"];
}


//-----------------17/10/2021 fonction qui va me prermetre de traqué a temps réel les VM 
$derniervisite = array();

foreach ($detail as $drenieruser => $v) {
    $username = $listusers[$drenieruser];
    $vi = end($v);

    $datedujour = array_keys($v)[count($v) - 1];
    $clientid_v = key(array_slice($vi, -1, 1, true));
    $date = $vi[$clientid_v];

    if (!isset($gps[$drenieruser][$datedujour][$clientid_v]))
        continue;
    $derniervisite[$username]["gps"] = $gps[$drenieruser][$datedujour][$clientid_v];
    $derniervisite[$username]["datevisite"] = $date;
    $def = round(abs(strtotime($date) - strtotime(date("Y-m-d H:i:s"))) / 3600);
    $color = "vert";
    if ($def > 2)
        $color = "red";
    else if ($def > 1)
        $color = "yellow";

    $derniervisite[$username]["def"] = $def;
    $derniervisite[$username]["color"] = $color;
}
// debug($derniervisite);
//-----------------------------Fin------------------------//
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">VM-Derniere visite</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0" style="display: block;">
        <div class="d-md-flex">
            <div class="p-1 flex-fill" style="overflow: hidden">
                <!-- Map will be created here -->
                <div id="vm-map-markers" style="height:500px; overflow: hidden" class="mapael">

                </div>
            </div>
            <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                <?php foreach ($derniervisite as $key => $value) : ?>
                    <div class="description-block mb-4">
                        <div class="sparkbar pad" data-color="#fff"><i class="fa fa-circle <?php echo $derniervisite[$key]["color"] ?>"></i> <?php echo $key; ?></div>
                    </div>
                <?php endforeach; ?>
            </div><!-- /.card-pane-right -->
        </div><!-- /.d-md-flex -->
    </div>
    <!-- /.card-body -->
</div>

<button onclick="captureWithHtml2Canvas()">Capture with html2canvas</button>
<img id="result" alt="Screenshot will appear here" style="width: 100%;" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<?php echo $this->Html->script('leaflet'); ?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    var map = L.map('map', {
        center: [51.505, -0.09],
        zoom: 13
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);
</script>

<!-- map code  -->
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    <?php
    $keys = "['POT','Nombre de visite']";
    foreach ($specailites["global"] as $k => $v) {
        $keys = "$keys,['$k',$v]";
    }
    $keys = trim($keys, ",");
    ?>

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $keys; ?>
        ]);

        var options = {
            title: 'Graph des spécialités visités',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $id; ?>specailites'));
        chart.draw(data, options);
    }
</script>
<script>
    <?php
    $data = "";
    foreach ($nbvsitiesbydate as $k => $v) {
        if (!isset($v["types"]["global"]["Pharmacie"]))
            $v["types"]["global"]["Pharmacie"] = 0;
        if (!isset($v["types"]["global"]["Médecin"]))
            $v["types"]["global"]["Médecin"] = 0;

        $data = $data . "," . "['$k'," . $v["types"]["global"]["Médecin"] . "," . $v["types"]["global"]["Pharmacie"] . "]";
    } ?>


    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Médecin', 'Pharmacie']
            <?php echo $data; ?>
        ]);

        var options = {
            title: 'Visite par jour',
            vAxis: {
                title: 'Visite'
            },
            hAxis: {
                title: 'Jour'
            },
            seriesType: 'bars',
            isStacked: true,

        };

        var chart = new google.visualization.ComboChart(document.getElementById("<?php echo $id; ?>nbvsitiesbydate"));
        chart.draw(data, options);
    }
</script>


<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);
    <?php $keys = "['Type','Nombre de visite']";
    foreach ($visites["global"] as $k => $v) {
        $keys = "$keys,['$k',$v]";
    }
    $keys = trim($keys, ",");
    ?>

    function drawChart() {
        var data = google.visualization.arrayToDataTable([<?php echo $keys; ?>]);

        var options = {
            title: 'État de la saisie instantané',
            legend: 'none',
            pieSliceText: 'label',
        };

        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $id; ?>visites'));
        chart.draw(data, options);
    }
</script>


<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    <?php $keys = "['POT','Nombre de visite']";
    foreach ($pots["global"] as $k => $v) {
        $keys = "$keys,['$k',$v]";
    }
    $keys = trim($keys, ",");
    ?>

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $keys; ?>
        ]);

        var options = {
            title: 'Potentialités des clients visités',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $id; ?>pots'));
        chart.draw(data, options);
    }
</script>

<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    <?php $keys = "['Type','Nombre de visite']";
    foreach ($types["global"] as $k => $v) {
        $keys = "$keys,['$k',$v]";
    }
    $keys = trim($keys, ",");
    ?>

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $keys; ?>
        ]);

        var options = {
            title: 'Type de client par visite'
        };

        var chart = new google.visualization.PieChart(document.getElementById('paychart5'));
        chart.draw(data, options);
    }
</script>
<script>
    <?php $keys = $values = $colors = "";
    foreach ($types["global"] as $k => $v) {
        $keys = "$keys,'$k'";
        $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        $colors = "$colors,'#$rand'";
        $total = 0;
        $values = "$values,$v";
    }
    $keys = trim($keys, ",");
    $values = trim($values, ",");
    $colors = trim($colors, ",");
    ?>

    var xValues = [<?php echo $keys; ?>];
    var yValues = [<?php echo $values; ?>];
    var barColors = [<?php echo $colors; ?>];

    new Chart("<?php echo $id; ?>types", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Type de client par visite"
            }
        }
    });
</script>



<script>
    var clients = <?php echo json_encode($cc); ?>;
    var detail = <?php echo json_encode($detail); ?>;
    var solo = <?php echo json_encode($solo); ?>;
    var gps = <?php echo json_encode($gps); ?>;
    var visites_array = <?php echo json_encode($visites_array); ?>;
    console.log("cc is ", clients);
    for (user_id in detail) {
        for (date in detail[user_id]) {
            var nombremedcin = 0;
            var nombrepharmacie = 0;
            for (client_id in detail[user_id][date]) {
                if (typeof(clients[client_id]) == 'undefined')
                    continue;
                if (clients[client_id]['type'] == 1)
                    nombremedcin++;
                else
                    nombrepharmacie++;
            }
            document.getElementById(user_id + "_" + date + "_m").innerText = nombremedcin;
            document.getElementById(user_id + "_" + date + "_p").innerText = nombrepharmacie;
        }
    }

    var mapscord = [];
    $(".detailbtn").click(function() {
        mapscord = [];
        var data = $(this).attr('id');
        data = data.split("_");
        var id = data[0];
        var date = data[1];
        var arr = [];
        var key;
        var a, b, x, y, v, z;
        console.log("detail is :", detail[id]);
        for (key in detail[id][date]) {
            arr.push(key + " " + detail[id][date][key]);
            arr.sort(function(a, b) {
                a = a.split(" ");
                b = b.split(" ");
                x = a[1];
                y = b[1];
                v = a[2];
                z = b[2];
                if (x < y) {
                    return -1;
                }
                if (x > y) {
                    return 1;
                }
                if (x == y) {
                    if (v < z) {
                        return -1;
                    }
                    if (v > z) {
                        return 1;
                    }
                }
                return 0;
            });
        }
        var i = 0;
        $(".table-detail tbody .tremove").remove();
        for (i; i < arr.length; i++) {
            arr[i] = arr[i].toString();
            arr[i] = arr[i].split(" ");
            // console.log(clients);
            var idc = arr[i][0];
            var nom = clients[idc]['name'];
            var activite = clients[idc]['activite'];
            var pot = clients[idc]['pot'];
            var pot1 = clients[idc]['pot1'];
            if (clients[idc]['type'] != 1)
                nom = "<img src='/img/pharmacie.jpg'/>" + nom;
            var tr = "<tr class='tremove'><td>" + solo[id][date][key] + "<a target='_blank' href='https://connectlabo.com/clients/view/" + arr[i][0] + "'>" + nom + "</a></td><td>" + activite + "</td><td>" + pot + "</td><td>" + pot1 + "</td><td>" + arr[i][1] + " " + arr[i][2] + "</td><td>" + visites_array[id][date][idc] + "</td></tr>";
            $(".table-detail tbody").append(tr);
            // console.log(gps[id]);
            if (id in gps) {
                if (date in gps[id]) {
                    if (idc in gps[id][date]) {
                        // console.log(gps[id][date]);
                        if (gps[id][date][idc] != undefined) {
                            var latlang = gps[id][date][idc].split(',');
                            var lat = latlang[0];
                            lat = parseFloat(lat);
                            var lang = latlang[1];
                            lang = parseFloat(lang);
                            var map = [clients[idc]['name'], lat, lang, clients[idc]['type']];
                            // console.log(map);
                            mapscord.push(map);
                        }
                    }
                }
            }
        }
        $("#detailModal").modal();
        setTimeout(function() {
            time();
        }, 300);
        console.log('map is :', mapscord);
    });
    $(".detailmap").click(function() {
        $("#detailModal").modal('hide');
        $("#detailmap").modal('hide');
    });

    $('#detailMap').on('hide.bs.modal', function(e) {
        mapscord = '';
        var locations = [
            ['Erreur table géolocalisation vide', 33.56454, -7.4547878]
        ];
    });

    var locations = [
        ['Erreur table géolocalisation vide', 33.56454, -7.4547878]
    ];
    var map_canvas;
    $('#detailMap').on('shown.bs.modal', function() {

        $("#detailModal").modal('hide');
        if (mapscord == '') {
            locations = [
                ['Erreur table géolocalisation vide', 33.56454, -7.4547878]
            ];
        } else {
            locations = mapscord;
        }
        if (map_canvas) {
            map_canvas.remove();
        }

        // map_canvas = L.map('map-canvas').setView([0, 0], 12);

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 15,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map_canvas);

        setTimeout(function() {
            initialize()
        }, 500);
    });

    //var mlength = locations.length;
    function initialize() {
        map_canvas = L.map('map-canvas', {
            center: [locations[0][1], locations[0][2]],
            zoom: 12
        });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(map_canvas);



        var roadCoordinates = [];
        var marker, i;
        var markers = [];
        for (var i = 0; i < locations.length; i++) {
            //console.log(locations[i][1]);
            var roadc = {
                lat: locations[i][1],
                lng: locations[i][2]
            }
            roadCoordinates.push(roadc);
            var vicon = '<?php echo $this->webroot . "/img/blue.png"; ?>';
            if (locations[i][3] != 1)
                var vicon = '<?php echo $this->webroot . "/img/green.png"; ?>';
            if (i == 0) {
                vicon = '<?php echo $this->webroot . "/img/red.png"; ?>';
            }
            if (i == locations.length - 1) {
                vicon = '<?php echo $this->webroot . "/img/black.png"; ?>';
            }

            var marker = L.marker([locations[i][1], locations[i][2]], {
                icon: L.divIcon({
                    className: 'custom-marker',
                    iconSize: [10, 10], // Adjust the size as needed
                    html: "<img class='icon_marker' src='" + vicon + "'>"
                })
            }).addTo(map_canvas);
            marker.bindPopup("<b>" + locations[i][0] + "</b>");

            markers.push(marker);
        }

        var markerLatLngs = markers.map(function(marker) {
            console.log(console.log("lat , lang", marker));
            return marker.getLatLng();
        });
        // Create a polyline connecting all markers in the order they appear in the array
        var polyline = L.polyline(markerLatLngs, {
            color: 'blue'
        }).addTo(map_canvas);
    }


    function time() {
        $(".time").text("");
        var trl = $(".table-detail .tremove").length;

        var date_debut = $(".table-detail .tremove:eq(0) td:eq(4)").text();

        //console.log(date_debut);
        var date_fin = $(".table-detail .tremove:eq(" + (trl - 1) + ") td:eq(4)").text();

        //console.log(date_fin);
        var time = (new Date(date_fin) - new Date(date_debut)) / 60 / 60 / 1000;
        //console.log((new Date(date_fin) - new Date(date_debut)));
        if (time >= 1)
            $(".time").text(Math.round(time) + " Heure(s)");
        if (time < 1) {
            time = time * 60;
            $(".time").text(Math.round(time) + " Minute(s)");
        }
    }
    //console.log(gps);
</script>


<!-- map vm bottom -->

<script>
    var vm = <?php echo json_encode($derniervisite); ?>;
    var ke = Object.keys(vm);
    var key = "";
    var inn = 0;
    for (var k in vm) {
        if (inn == 0)
            key = vm[k].gps;
        inn++;
    }
    var ll = key.split(",")
    var map = L.map('vm-map-markers', {
        center: [ll[0], ll[1]],
        zoom: 12
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);

    var mar, m = 0;
    for (var k in vm) {
        var loc = vm[k].gps.split(",");
        var vicon = '<?php echo $this->webroot . "/img/red.png"; ?>'
        if (vm[k].color == "vert")
            vicon = '<?php echo $this->webroot . "/img/green.png"; ?>';
        if (vm[k].color == "yellow") {
            vicon = '<?php echo $this->webroot . "/img/marker/jaune.png"; ?>';
        }
        L.marker([loc[0], loc[1]], {
                icon: L.divIcon({
                    className: 'custom-marker',
                    iconSize: [10, 10], // Adjust the size as needed
                    html: "<img class='icon_marker' src='" + vicon + "'>"
                })
            }).addTo(map).bindPopup(ke[m])
            .openPopup();
        m++;
    }
</script>


<script >
    

    function captureWithHtml2Canvas() {
        const csrfToken = '<?= h($csrfToken) ?>';
        console.log(csrfToken);
        const content = document.getElementById("statistiques_mail");

        html2canvas(content).then(canvas => {
            const imageURL = canvas.toDataURL("image/png");

            fetch('save_Image', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrfToken
                    },
                    body: JSON.stringify({
                        image: imageURL
                    })
                })
                .then(response => response.text()) // Read the response as plain text
                .then(data => {
                    console.log('Raw server response:', data); // Log the raw response
                    try {
                        const jsonData = JSON.parse(data); // Try to parse the JSON
                        if (jsonData.success) {
                            console.log("Image saved successfully!");
                        } else {
                            console.error("Error saving the image:", jsonData.error);
                        }
                    } catch (err) {
                        console.error("Error parsing JSON response:", err);
                    }
                })
                .catch(err => {
                    console.error("Error sending image to the server:", err);
                });
        }).catch(err => {
            console.error("Error capturing the image with html2canvas:", err);
        });
    }
</script>

<script defer>
    $(window).on('load', function() {
        captureWithHtml2Canvas();
    });
</script>