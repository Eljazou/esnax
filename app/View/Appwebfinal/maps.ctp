<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>
    <style type="text/css">
        .CardInner {
            padding: 5px 5px;
            background-color: #fafbfd;
            border-radius: 12px;
            margin: 10px;
        }

        .row-CardInner {
            align-items: center
        }

        .all-elements {
            margin-top: 67px;
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

        body {
            height: 92%;
            padding: 0;
            margin: 0;
            background: #fbfbfb;
            font-family: 'Poppins', sans-serif;
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
            font-family: 'Poppins', sans-serif;
        }

        .arrow {
            padding: 0px;
            font-size: 24px;
            color: #695cd4;
            margin-top: 3px;
        }



        #map {
            height: 100%;
            width: 100%;
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
            background-color: #6456d5;
            border: 0;
            border-color: #6456d5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-modal:hover,
        .btn-modal:active,
        .btn-modal:focus {
            background-color: #6456d5 !important;
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
        <div class="row my-header">
            <div class="col-12" style="height: 25px;">
                <div class="row">
                    <div class="col-2" style=" padding: 0px;">
                        <a href="<?php echo $this->Html->url(array("action" => "index", $code, $latitude, $longitude)); ?>" class="btn_spiner">
                            <i class="fa-solid fa-angle-left arrow"></i></a>
                    </div>
                    <div class="col-8" style=" padding: 0px;">
                        <p class="tile-pages">Localisation des clients</p>
                    </div>
                    <div class="col-2"></div>

                </div>
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

        <div class="modal fade" id="client_viewModalLong" tabindex="-1" role="dialog" aria-labelledby="client_viewModalLongModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewclientModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-light fa-xmark-large"></i></span>
                        </button>

                    </div>
                    <div class="modal-body viewclient_body">
                        <div class="center">
                            <a href="" class="btn btn-primary tel btn-modal">
                                <i class="fa-solid fa-phone"></i>
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
            $(document).ready(function() {

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
                    attitudeAmplitudeArray.forEach(function(dataPoint) {
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