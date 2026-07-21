<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="my_style.css" />
    <?php echo $this->Html->css('glightbox'); ?>
    <style>
        .ag-format-container {
            width: 1142px;
            margin: 0 auto;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fbfbfb;
        }

        .ag-courses_box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .ag-courses_item {
            -ms-flex-preferred-size: calc(33.33333% - 30px);
            flex-basis: calc(33.33333% - 30px);

            margin: 0 3px 12px;

            overflow: hidden;
            border-radius: 28px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .ag-courses-item_link {
            display: block;
            padding: 30px 20px;
            background-color: white;

            overflow: hidden;

            position: relative;
        }

        .ag-courses-item_link:hover,
        .ag-courses-item_link:hover .ag-courses-item_date,
        .fa-arrow-right {
            text-decoration: none;
            color: #fff;
        }

        .ag-courses-item_link:hover .ag-courses-item_bg {
            -webkit-transform: scale(10);
            -ms-transform: scale(10);
            transform: scale(10);
        }

        .ag-courses-item_title {
            margin: 0;
            overflow: hidden;
            font-weight: bold;
            font-size: 30px;
            color: #8a8383;
            z-index: 2;
            position: relative;
            padding-bottom: 12px;
        }

        .ag-courses-item_date-box {
            font-size: 18px;
            color: #1c1a1a;

            z-index: 2;
            position: relative;
        }

        .ag-courses-item_date {
            font-weight: bold;
            color: #f9b234;

            -webkit-transition: color 0.5s ease;
            -o-transition: color 0.5s ease;
            transition: color 0.5s ease;
        }

        .ag-courses-item_bg {
            height: 128px;
            width: 128px;
            background-color: #6cc4fe;

            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;

            border-radius: 50%;

            -webkit-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
            background-color: #9270f6;
        }

        .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
            background-color: #5a7bf5;
        }

        .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
            background-color: #fa5ce0;
        }

        .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
            background-color: #1ea6c6;
        }

        .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
            background-color: #eb9e6f;
        }

        .fa-arrow-right,
        .fa-delete-left {
            font-size: 15px;
            padding-left: 15px;
            color: #78829c;
        }



        .ag-courses-item_link:hover .ag-courses-item_title,
        .ag-courses-item_link:hover .ag-courses-item_date-box,
        .ag-courses-item_link:hover .ag-courses-item_date-box .fa-arrow-right {
            color: #fff;
        }

        @media only screen and (max-width: 979px) {
            .ag-courses_item {
                -ms-flex-preferred-size: calc(50% - 30px);
                flex-basis: calc(50% - 30px);
            }

            .ag-courses-item_title {
                font-size: 17px;
            }
        }

        @media only screen and (max-width: 767px) {
            .ag-format-container {
                width: 96%;
            }
        }

        @media only screen and (max-width: 639px) {
            .ag-courses_item {
                -ms-flex-preferred-size: 100%;
                flex-basis: 100%;
            }

            .ag-courses-item_title {
                line-height: 1;
                font-size: 17px;
            }

            .ag-courses-item_link {
                padding: 20px 15px;
                text-decoration: none;
            }

            .ag-courses-item_date-box {
                font-size: 16px;
            }
        }

        .fa-solid,
        .fas {
            font-weight: 900;
            font-size: 100px;
            font-weight: 900;
            font-size: 20px;
            border-radius: 70px;
        }



        .all-elements {
            margin-top: 96px !important;
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
            font-size: 17px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        /* message vide brochure */
        .empty-message {
            margin: 50px 20px;
            max-width: 400px;
            background-color: #fef6f9;
            color: #c94f7c;
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            font-size: 18px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .empty-message i {
            font-size: 30px;
            margin-bottom: 10px;
            display: block;
            color: #e08dac;
        }
    </style>
</head>

<body>


    <div class="hide-content">
        <div class="row my-header">
            <div class="col-12" style="height: 25px;">
                <div class="row">
                    <div class="col-3" style=" padding: 0px;">
                        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>">
                            <i class="fa-solid fa-angle-left arrow"></i></a>
                    </div>
                    <div class="col-9" style=" padding: 0px;">
                        <p class="tile-pages">Brochures</p>
                    </div>

                </div>
            </div>

        </div>

        <div class="all-elements">
            <div class="grid">
                <?php
                $hasBrochure = false;

                foreach ($data as $d) {
                    $d = $d["Brochure"];
                    if (!empty($d["file"])) {
                        $hasBrochure = true;
                ?>
                        <div class="ag-format-container">
                            <div class="ag-courses_box">
                                <div class="ag-courses_item">
                                    <a href="<?php echo $this->Html->url("/img/brochures/" . $d["file"]); ?>" class="ag-courses-item_link glightbox" data-gallery="group-<?php echo $d["id"]; ?>">
                                        <div class="ag-courses-item_bg"></div>
                                        <div class="ag-courses-item_title"><?php echo $d["name"] ?></div>
                                        <div class="ag-courses-item_date-box"><?php echo $d["gamme"]; ?>
                                            <span class="ag-courses-item_date" style="float: right;">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </span>
                                        </div>
                                    </a>
                                    <?php if (!empty($d["file2"])) { ?>
                                        <a href="<?php echo $this->Html->url("/img/brochures/" . $d["file2"]); ?>" class="glightbox d-none" data-gallery="group-<?php echo $d["id"]; ?>"></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }

                if (!$hasBrochure) {
                    echo "<div class='empty-message'>
                            Aucune brochure n’est disponible pour le moment.
                          </div>";
                }
                
                ?>
            </div>
        </div>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
        <script src='https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js'></script>

        <?php echo $this->Html->script('glightbox'); ?>
        <script>
            var lightbox = GLightbox({
                selector: '.glightbox'
            });

            lightbox.on('open', (target) => {
                console.log('Lightbox opened');
            });
        </script>

</body>

</html>