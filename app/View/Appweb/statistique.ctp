<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <style type="text/css">
        .all-elements {
            margin-top: 90px;
        }

        body {
            height: 0;
            background: #fbfbfb;
            font-family: 'Poppins', sans-serif;
        }

        .custom:focus {
            border-color: #6456d59e;
            outline: none !important;
            box-shadow: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #007bff;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #ffffff;
            color: #5e54a9;
            border: 1px solid #6557cc;
        }

        .nav-pills .nav-link {
            border: 1px solid #888697;
            font-size: 14px;
            font-weight: 400;
            border-radius: 50px;
            text-align: center;
            padding: 10px 15px;
            position: relative;
            color: #6e7295;
        }

        .nav-pills .nav-item {
            width: 48%;

        }

        .nav-pills {
            gap: 5px;
            width: 100%;
            padding: 15px;
            display: flex;
            justify-content: space-around;
            margin-bottom: 0 !important;
            margin-top: 13px;

        }

        .butttons {
            display: flex;
            justify-content: space-evenly;
            padding: 15px;
            gap: 9px;
        }

        .sy-btn {
            width: 48%;
            font-size: 14px;
            color: #fff;
            background-color: #9f97e2 !important;
            border: 0;
            border-color: transparent;
            box-shadow: none !important;
            border-radius: 12px;
            cursor: not-allowed;
        }

        .title-type {
            margin-bottom: 0;
        }

        .s2-btn {
            color: #fff;
            background-color: #56d564 !important;
        }

        .br-shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important;
            border-radius: 12px !important;
        }

        .title-circle {
            font-size: 14px;
            font-weight: 400 !important;
            text-align: start !important;
            color: #6e7295;
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

        .tile-pages {
            font-size: 17px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        .arrow {
            padding: 0px;
            font-size: 24px;
            color: #695cd4;
            margin-top: 3px;
        }
    </style>

    <div class="hide-content">
        <div class="row my-header">
            <div class="col-12" style="height: 25px;">
                <div class="row">
                    <div class="col-2" style=" padding: 0px;">
                        <a href="<?php echo $this->Html->url(array("action" => "index", $code, $lan, $lon)); ?>" class="btn_spiner">
                            <i class="fa-solid fa-angle-left arrow"></i></a>
                    </div>
                    <div class="col-8" style=" padding: 0px;">
                        <p class="tile-pages">Statistique</p>
                    </div>
                    <div class="col-2"></div>

                </div>
            </div>

        </div>

        <div class=" all-elements">
            <div class="CardInner">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-jour-tab" data-toggle="pill" href="#pills-jour" role="tab" aria-controls="pills-jour" aria-selected="true">Par Jour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-semaine-tab" data-toggle="pill" href="#pills-semaine" role="tab" aria-controls="pills-semaine" aria-selected="false">Par Semaine</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-jour" role="tabpanel" aria-labelledby="pills-jour-tab">
                        <div class="butttons"> <button type="button" class="btn btn-primary btn-lg sy-btn">
                                <p class="title-type"><?php echo $data['Médecin']['jour']; ?></p>
                                Médecin
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg sy-btn s2-btn">
                                <p class="title-type"><?php echo $data['Pharmacie']['jour']; ?></p>Pharmacie
                            </button>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-2 shadow br-shadow">
                                <h2 class="h6 font-weight-bold mb-4 title-circle">Médecin</h2>

                                <div id="chart">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-2 shadow br-shadow">
                                <h2 class="h6 font-weight-bold mb-4 title-circle">Pharmacie</h2>

                                <div id="chart1">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="pills-semaine" role="tabpanel" aria-labelledby="pills-semaine-tab">
                        <div class="butttons"> <button type="button" class="btn btn-primary btn-lg sy-btn">
                                <p class="title-type"><?php echo $data['Médecin']['nb_visiter']; ?></p>
                                Médecin
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg sy-btn s2-btn">
                                <p class="title-type"><?php echo $data['Pharmacie']['nb_visiter']; ?></p>Pharmacie
                            </button>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-2 shadow br-shadow">
                                <h2 class="h6 font-weight-bold mb-4 title-circle">Médecin</h2>

                                <div id="chart2">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-2 shadow br-shadow">
                                <h2 class="h6 font-weight-bold mb-4 title-circle">Pharmacie</h2>

                                <div id="chart3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        console.log();
        var med_jour = <?php echo ($data['Médecin']['globaljour'] * 100); ?>;
        var phar_jour = <?php echo ($data['Pharmacie']['globaljour'] * 100); ?>;
        var med_semaine = <?php echo ($data['Médecin']['objectifjour'] * 100); ?>;
        var phar_semaine = <?php echo ($data['Pharmacie']['objectifjour'] * 100); ?>;
        var options1 = {
            chart: {
                height: 185,
                type: "radialBar"
            },

            series: [med_jour],

            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "60%"
                    },

                    dataLabels: {
                        showOn: "always",
                        name: {
                            offsetY: -10,
                            show: false,
                            color: "#888",
                            fontSize: "13px"
                        },
                        value: {
                            color: "#111",
                            fontSize: "14px",
                            show: true,
                            offsetY: 5,
                            offsetX: 0
                        }
                    }
                }
            },

            stroke: {
                lineCap: "round",
            },
            labels: [""]
        };

        var chart1 = new ApexCharts(document.querySelector("#chart"), options1);
        chart1.render();

        var options2 = {
            chart: {
                height: 185,
                type: "radialBar"
            },

            series: [phar_jour],

            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "60%"
                    },

                    dataLabels: {
                        showOn: "always",
                        name: {
                            offsetY: -10,
                            show: false,
                            color: "#888",
                            fontSize: "13px"
                        },
                        value: {
                            color: "#111",
                            fontSize: "14px",
                            show: true,
                            offsetY: 5,
                            offsetX: 0
                        }
                    }
                }
            },

            stroke: {
                lineCap: "round",
            },
            labels: [""]
        };

        var chart2 = new ApexCharts(document.querySelector("#chart1"), options2);
        chart2.render();
        var options3 = {
            chart: {
                height: 185,
                type: "radialBar"
            },

            series: [med_semaine],

            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "60%"
                    },

                    dataLabels: {
                        showOn: "always",
                        name: {
                            offsetY: -10,
                            show: false,
                            color: "#888",
                            fontSize: "13px"
                        },
                        value: {
                            color: "#111",
                            fontSize: "14px",
                            show: true,
                            offsetY: 5,
                            offsetX: 0
                        }
                    }
                }
            },

            stroke: {
                lineCap: "round",
            },
            labels: [""]
        };

        var chart3 = new ApexCharts(document.querySelector("#chart2"), options3);
        chart3.render();
        var options4 = {
            chart: {
                height: 185,
                type: "radialBar"
            },

            series: [phar_semaine],

            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "60%"
                    },

                    dataLabels: {
                        showOn: "always",
                        name: {
                            offsetY: -10,
                            show: false,
                            color: "#888",
                            fontSize: "13px"
                        },
                        value: {
                            color: "#111",
                            fontSize: "14px",
                            show: true,
                            offsetY: 5,
                            offsetX: 0
                        }
                    }
                }
            },

            stroke: {
                lineCap: "round",
            },
            labels: [""]
        };

        var chart4 = new ApexCharts(document.querySelector("#chart3"), options4);
        chart4.render();
    </script>

</body>

</html>