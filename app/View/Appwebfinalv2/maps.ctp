<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Lucide Icons -->
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.344.0/dist/umd/lucide.min.js"></script>
</head>

<body>
    <style type="text/css">
        .CardInner {
            padding: 0;
            background-color: transparent;
            margin: 0;
            height: 100%;
        }

        .row-CardInner {
            margin: 0;
            height: 100%;
        }

        .all-elements {
            padding-top: 76px;
            /* Header height approx */
            height: 100vh;
            box-sizing: border-box;
            margin-top: 0;
        }


        .page-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
            padding: 20px 20px 16px;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
            border-bottom: 1px solid #d4e0d9;
            box-sizing: border-box;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-back {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f4f8f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a2e24;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #e6f5ee;
            color: #006241;
            text-decoration: none;
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a2e24;
            margin: 0;
        }

        body {
            height: 100vh;
            padding: 0;
            margin: 0;
            background: var(--bg, #f7faf8);
            font-family: var(--font-family, 'Inter', sans-serif);
            overflow: hidden;
            /* Prevent body scroll so map takes everything */
        }

        .hide-content,
        .all-elements,
        .CardInner,
        .row-CardInner {
            height: 100%;
        }

        .tile-pages {
            font-size: 17px;
            font-weight: 500;
            font-family: var(--font-family, 'Inter', sans-serif);
        }





        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
            /* Keep it below header */
        }

        .custom-marker {
            display: inline-block;
            text-align: center;
            line-height: 1.2;
            font-size: 20px;
        }

        .fa-map-marker-alt {
            font-size: 40px;
        }

        .icon_marker {
            width: 25px !important;
            background: transparent !important;
        }

        .center {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .btn-modal {
            border-radius: 50%;
            height: 70px;
            width: 70px;
            font-size: 12px;
            background: linear-gradient(135deg, #006241, #00875A);
            border: 0;
            border-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-modal:hover,
        .btn-modal:active,
        .btn-modal:focus {
            background: linear-gradient(135deg, #006241, #00875A) !important;
            border: 0 !important;
            box-shadow: none;
        }

        .btn-modal i {
            font-size: 20px;
        }

        .table-modal {
            margin-top: 16px;
        }
    </style>
    <div class="hide-content">
        <div class="page-header">
            <div class="header-top">
                <a href="<?php echo $this->Html->url(array("action" => "index", $code, $latitude, $longitude)); ?>"
                    class="btn-back btn_spiner">
                    <i data-lucide="chevron-left" style="width: 20px; height: 20px;"></i>
                </a>
                <h1 class="header-title">Localisation des clients</h1>
            </div>
        </div>

        <div class=" all-elements">
            <div class="CardInner">
                <div class="row row-CardInner">
                    <div id="map"></div>



                </div>

            </div>
        </div>
        <!-- modal clien_view   -->

        <div class="modal fade" id="client_viewModalLong" tabindex="-1" role="dialog"
            aria-labelledby="client_viewModalLongModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewclientModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i data-lucide="x"></i></span>
                        </button>

                    </div>
                    <div class="modal-body viewclient_body">
                        <div class="center">
                            <a href="" class="btn btn-primary tel btn-modal">
                                <i data-lucide="phone"></i>
                            </a>
                            <button type="button" class="btn btn-primary btn-rounded btn-icon potentialite btn-modal">
                            </button>

                        </div>
                        <div>
                            <table class="table table-modal">

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" href="" class="btn btn-success btn_view_detail">Voir détail</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

                <?php
                $filtredarray = [];

                // Iterate over each element in $data
                //proch howa 1  o programmer howa 0
                $i = 0;
                $color = "#454545";
                foreach ($data as $key => $datavalue) {
                    if ($datavalue['latitude'] != "") {
                        if ($datavalue['type'] == "1") {
                            if ($datavalue['proche'] == 1) {
                                $icon = "<img class='icon_marker' src='/img/marker-green.png'>";
                            } else {
                                $icon = "<img class='icon_marker' src='/img/marker-red.png'>";
                            }
                        } else if ($datavalue['type'] == "2") {
                            if ($datavalue['proche'] == "1") {
                                $icon = " <img class='icon_marker' src='/img/marker-bleu.png'>";
                            } else {
                                $icon = "<img class='icon_marker' src='/img/marker-red.png'>";
                            }
                        } else if ($datavalue['type'] == "3") {
                            if ($datavalue['proche'] == "1") {
                                $icon = "<img class='icon_marker' src='/img/marker-bleu.png'>";
                            } else {
                                $icon = "<img class='icon_marker' src='/img/marker-yellow.png'>";
                            }
                        }
                        $href_icon = "<a  data-toggle='modal' class='btn_marker' data-target='#client_viewModalLong' onclick='remplimodal(" . $key . ")'>" . $icon . "</a>";
                        array_push($filtredarray, array(
                            'latitude' => $datavalue['latitude'],
                            'longitude' => $datavalue['longitude'],
                            'color' => $color,
                            'icon' => $href_icon
                        ));
                        $i++;
                    }
                }

                ?>
                var attitudeAmplitudeArray = <?php echo json_encode($filtredarray); ?>;
                console.log(attitudeAmplitudeArray);
                var map = L.map('map', {
                    zoomControl: false
                }).setView([<?php echo $latitude . "," . $longitude ?>], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: ''
                }).addTo(map);
                // Add my current position marker
                L.marker([<?php echo $latitude . "," . $longitude ?>], {
                    icon: L.divIcon({
                        className: 'custom-marker',
                        iconSize: [10, 10], // Adjust the size as needed
                        html: "<img class='icon_marker' src='/img/mylocation.png'>"
                    })
                }).addTo(map);

                // Add markers with different colors and larger size for each data point
                if (attitudeAmplitudeArray.length !== 0) {
                    attitudeAmplitudeArray.forEach(function (dataPoint) {
                        L.marker([dataPoint.latitude, dataPoint.longitude], {
                            icon: L.divIcon({
                                className: 'custom-marker',
                                iconSize: [10, 10], // Adjust the size as needed
                                html: dataPoint.icon
                            })
                        }).addTo(map);
                    });
                }

            });
            var data = <?php echo json_encode($data); ?>;

            function remplimodal(id) {

                var detailclient = data[id];
                console.log(detailclient);

                $("#viewclientModalLabel").empty();
                $("#viewclientModalLabel").append(detailclient.name);
                $(".btn_view_detail").attr("href", '<?php echo $this->Html->url(array("action" => "view_client", $code)); ?>' + '/' + detailclient.id);
                if (detailclient.tel == "" && detailclient.fixe == "") {
                    $(".tel").hide();
                } else {
                    if (detailclient.tel == "") {
                        if (detailclient.fixe == "") {
                            $(".tel").hide();
                        } else {
                            $(".tel").attr("href", 'tel:+212' + detailclient.fixe);
                            $(".tel").show();
                        }
                    } else {
                        $(".tel").attr("href", 'tel:+212' + detailclient.tel);
                        $(".tel").show();
                    }

                }

                $(".potentialite").empty();
                $(".potentialite").append(detailclient.potentialite);
                //remplire le tableau de modal
                $(".table-modal").empty();
                $(".table-modal").append("<tr><th>Catégorie</th><td> :" + detailclient.category + "</td>");
                $(".table-modal").append("<tr><th>Mail</th><td> :" + detailclient.mail + "</td>");
                $(".table-modal").append("<tr><th>Secteur</th><td> :" + detailclient.secteur + "</td>");
                $(".table-modal").append("<tr><th>Ville</th><td> :" + detailclient.ville + "</td>");


            }
        </script>


</body>

</html>