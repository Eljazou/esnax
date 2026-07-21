<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
echo $this->Html->css('bootstrap');
echo $this->Html->css('font-awesome.min');
echo $this->Html->css('style.min');
echo $this->Html->css('skin-blue.min');
echo $this->Html->css('mystyle');
?>
<style>
    .modebar-btn {
        display: none;
    }

    .all-elements {
        margin-top: 91px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #fbfbfb;
    }

    .my-header {
        position: fixed;
        top: 0px;
        display: flex;
        width: 100%;
        padding: 0px 0px 0px 22px;
        z-index: 99;
        margin: 0;
        left: 0px;
        background-color: #ffffff;
        box-shadow: 0 1px 15px rgba(0, 0, 0, .04), 0 1px 6px rgba(0, 0, 0, .04);
        align-content: center;
        height: 70px;
    }

    .arrow {
        padding: 0px;
        font-size: 24px;
        color: #695cd4;
        margin-top: 3px;
    }

    .tile-pages {
        font-size: 21px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
    }

    .all-box {
        padding: 0;
    }

    .box-title {
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
        color: #6a5fc4;
    }
</style>
<title>Statistique</title>
</head>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('raphael.min');
echo $this->Html->script('justgage');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="row my-header">
    <div class="col-12" style="height: 31px;">
        <div class="row">
            <div class="col-3" style=" padding: 0px;">
                <a href="<?php echo $this->Html->url(array("action" => "index", $code, $lan, $lon)); ?>">
                    <i class="fa-solid fa-angle-left arrow"></i></a>
            </div>
            <div class="col-9" style=" padding: 0px;">
                <p class="tile-pages">Les statistiques</p>
            </div>

        </div>
    </div>

</div>
<div class="container">
    <div class=" all-elements">
        <div class="row">
            <div class="col-12 all-box">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nombre de visites par date</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        // Some raw data (not necessarily accurate)
                                        var data = google.visualization.arrayToDataTable([
                                            ['Date', 'Visites'],
                                            <?php $date = "";
                                            foreach ($data["date"] as $key => $value) {
                                                $date .= "['$key',$value],";
                                            }
                                            echo rtrim($date, ",");
                                            ?>
                                        ]);

                                        var options = {
                                            vAxis: {
                                                title: 'Nombre de visites'
                                            },
                                            hAxis: {
                                                title: 'Date'
                                            },
                                            seriesType: 'bars',
                                            series: {
                                                5: {
                                                    type: 'line'
                                                }
                                            }
                                        };

                                        var chart = new google.visualization.ComboChart(document.getElementById('date'));
                                        chart.draw(data, options);
                                    }
                                </script>
                                <div class="box-body" id="date" style="height: 360px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Visite par potentialité</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <script type="text/javascript">
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChart);

                                        function drawChart() {

                                            var data = google.visualization.arrayToDataTable([
                                                ['Potentialité', 'Nombre de visite'],
                                                <?php $date = "";
                                                foreach ($data["pot"] as $key => $value) {
                                                    $date .= "['$key',$value],";
                                                }
                                                echo rtrim($date, ",");
                                                ?>
                                            ]);
                                            var options = {
                                                title: ''
                                            };

                                            var chart = new google.visualization.PieChart(document.getElementById('pot'));

                                            chart.draw(data, options);
                                        }
                                    </script>
                                    <div class="box-body" id="pot" style="height: 360px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Visite par catégorie</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <script type="text/javascript">
                                        google.charts.load('current', {
                                            'packages': ['corechart']
                                        });
                                        google.charts.setOnLoadCallback(drawChart);

                                        function drawChart() {
                                            var data = google.visualization.arrayToDataTable([
                                                ['Catégorie', 'Nombre'],
                                                <?php $date = "";
                                                foreach ($data["cat"] as $key => $value) {
                                                    $date .= "['$key',$value],";
                                                }
                                                echo rtrim($date, ",");
                                                ?>
                                            ]);
                                            var options = {
                                                title: ''
                                            };
                                            var chart = new google.visualization.PieChart(document.getElementById('cat'));
                                            chart.draw(data, options);
                                        }
                                    </script>
                                    <div class="box-body" id="cat" style="height: 360px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Progression des visites du mois</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="g1" class="gauge" style='height: 400px;'></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function(event) {

                                            var g1 = new JustGage({
                                                id: 'g1',
                                                value: <?php echo $data["gauge"]["objectifmois"] ?>,
                                                min: 0,
                                                max: 100,
                                                symbol: '%',
                                                pointer: true,
                                                gaugeWidthScale: 0.6,
                                                levelColors: [
                                                    "#fc0526",
                                                    "#f9a801",
                                                    "#f7f70e",
                                                    "#c9d107",
                                                    "#0be50b",
                                                ],
                                                counter: true
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Progression des visites du semaine</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="g2" class="gauge" style='height: 400px;'></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function(event) {

                                            var g2 = new JustGage({
                                                id: 'g2',
                                                value: <?php echo $data["gauge"]["objectifsemaine"] ?>,
                                                min: 0,
                                                max: 100,
                                                symbol: '%',
                                                pointer: true,
                                                gaugeWidthScale: 0.6,
                                                levelColors: [
                                                    "#fc0526",
                                                    "#f9a801",
                                                    "#f7f70e",
                                                    "#c9d107",
                                                    "#0be50b",
                                                ],
                                                counter: true
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Progression d'aujourd'hui</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="g3" class="gauge" style='height: 400px;'></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function(event) {

                                            var g3 = new JustGage({
                                                id: 'g3',
                                                value: <?php echo $data["gauge"]["objectifjour"] ?>,
                                                min: 0,
                                                max: 100,
                                                symbol: '%',
                                                pointer: true,
                                                gaugeWidthScale: 0.6,
                                                levelColors: [
                                                    "#fc0526",
                                                    "#f9a801",
                                                    "#f7f70e",
                                                    "#c9d107",
                                                    "#0be50b",
                                                ],
                                                counter: true
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>