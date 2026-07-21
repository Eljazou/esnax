<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
<?php $i = 0;
foreach ($produits as $key => $p) {
    $pro = str_replace("'", "\'", $p);
    $produits[$key] = $pro;
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<style>
    b {
        margin-left: 10px;
    }

    .input label {
        margin-left: 10px;
    }

    #image-gallery {
        width: 100%;
        position: relative;
        height: 650px;
        background: #000;
    }

    #image-gallery .image-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 50px;
    }

    #image-gallery .prev,
    #image-gallery .next {
        position: absolute;
        height: 65px;
        margin-top: -66px;
        top: 50%;
        width: 91px;
        -webkit-filter: drop-shadow(0px 0px 3px #fff);
    }

    #image-gallery .prev {
        left: 20px;
        cursor: pointer;
    }

    #image-gallery .next {
        right: 20px;
        cursor: pointer;
    }

    #image-gallery .footer-info {
        position: absolute;
        height: 50px;
        width: 100%;
        left: 0;
        bottom: 0;
        line-height: 50px;
        font-size: 24px;
        text-align: center;
        color: white;
        border-top: 1px solid #FFF;
    }

    .iv-snap-view {
        opacity: 1 !important;
    }

    .popup {
        width: 100%;
        height: 100%;
        float: none;
        top: 0;
        z-index: 9999;
        position: fixed;
        background: #000;
    }

    .broch {
        cursor: pointer;
        float: right;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }

    .panel.panel-primary .col-lg-8 {
        float: none !important;
        margin: auto !important;
        background: #fff !important;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.27) !important;
        padding-top: 8px;
    }

    .panel-heading.col-lg-8 {
        width: 65.666667%;
    }

    input[type='readonly'] {
        cursor: no-drop;
    }

    @media (max-width:810px) {

        .panel-heading.col-lg-8,
        .panel-body .col-lg-8 {
            width: 100% !important;
        }
    }

    @media (max-width:991px) {
        .concur select {
            margin-top: 0px !important;
            margin-bottom: 10px;
        }
    }

    .concur .col-xs-8 {
        padding: 0px;
    }

    .concur .col-xs-9 {
        padding: 0px;
    }

    .concur .col-xs-12 span.col-xs-4 {
        padding-left: 0px;
    }

    .payment-form {
        padding: 0px;
    }

    .select2-dropdown {
        width: 324px !important;
    }

    .for-pad {
        padding: 14px 0;

    }

    .tabs {
        margin: 0px;
        padding: 0px;
        list-style: none;
    }

    .tabs li div {
        width: 100%;
    }

    .tabs li {
        color: #222;
        width: 100%;
        display: inline-flex;
        flex-direction: row;
        padding: 10px 18px;
        cursor: pointer;
    }

    .no-padding {
        padding: 3px;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    @media screen and (max-device-width: 640px) and (orientation: landscape) {
        .no-padding {
            padding: 0;
            margin-bottom: 14px;
        }

        .VisiteObjectionStock {
            width: 100%;
            padding: 5px;
        }

        .emp .select2.select2-container.select2-container--default {
            width: 107% !important;
        }
    }

    .select2-container--default .select2-selection--single,
    .select2-selection .select2-selection--single {
        padding: 0px 0px !important;
    }

    /* header */
    .header {
        position: fixed;
        top: 0px;
        display: flex;
        width: 100%;
        padding: 0px 0px 0px 22px;
        z-index: 99;
        margin: 0;
        left: 0px;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,50,30,0.06), 0 1px 2px rgba(0,50,30,0.04);
        height: 70px;
        justify-content: space-between;
        align-content: center;
        align-items: center;
    }

    .header p {
        font-size: 17px;
        font-weight: 500;
        font-family: var(--font-family, 'Inter', sans-serif);
        margin: 0;
    }

    .arrow {
        padding: 0px;
        font-size: 24px;
        color: #006241;
        margin-top: 3px;
    }

    .content-header {
        padding: 0px 15px 0 15px;
    }

    .all-elements {
        margin-top: 101px;
    }
</style>
<div class="row">
    <div class="header">
        <div class="col-md-2" style=" padding: 0px;">
            <a class="btn_spiner" href="<?php echo $this->Html->url(array("action" => "view_client", $code, $client_id)); ?>">
                <i class="fa-solid fa-angle-left arrow"></i></a>
        </div>
        <div class="col-md-2" style=" padding: 0px;">
            <p>Rapport</p>
        </div>
        <div class="col-md-2"></div>

    </div>
    <div class="all-elements">
        <div class="col-md-8 no-padding">
            <div class="box box-primary col-md-11 no-padding">
                <div class="box-header with-border col-lg-12 col-xs-12">
                    <h3 class="box-title" style="padding-left: 0px;margin-left: -7px;"><?php echo __('Rapport d\'une  visite'); ?></h3>
                </div>
                <div class="box-body no-padding">

                    <div class="col-lg-12 col-xs-12 no-padding">
                        <div class="panel panel-primary">
                            <div class="box-body no-padding  form-horizontal payment-form">
                                <?php echo $this->Form->create('Visite', array("style" => "float: left; width: 100%; height: auto;"));
                                ?>
                                <ul class="nav nav-pills nav-stacked">

                                    <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <div class="box-header with-border">
                                            <h4 class=" box-title col-md-12 col-sm-12 col-xs-12" style="padding:0;">Type de pharmacie <sup style="color:red;">*</sup></h4>
                                        </div>
                                        <div class="for-pad">
                                            <span class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="radio" name="data[Visite][type_visite]" value="Client" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> Client </b>
                                            </span>
                                            <span class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="radio" name="data[Visite][type_visite]" value="Non client" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> Non client </b>
                                            </span>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <div class="box-header with-border">
                                            <h4 class="box-title col-md-12 col-sm-12 col-xs-12" style="padding:0;">Activité de pharmacie <sup style="color:red;">*</sup></h4>
                                        </div>
                                        <div class="for-pad">
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                                <input type="radio" name="data[Visite][partenaires]" value="Bien" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> Bien </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                                <input type="radio" name="data[Visite][partenaires]" value="Moyen" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> Moyen </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                                <input type="radio" name="data[Visite][partenaires]" value="Faible" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> Faible </b>
                                            </span>
                                        </div>
                                        <br>
                                    </div>

                                    <!--  commenté en 1-28-2025 
                                    <div class="input text selectgame box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <?php
                                        echo "<div class='box-header with-border'>
                            <h4 class='box-title'>La liste des produits partenaire de prescription </h4></div>";
                                        echo $this->Form->input('games', array('name' => "data[Visite][produits]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple", "style" => "padding:0px;"));
                                        ?>
                                    </div>
                                    <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <div class="box-header with-border">
                                            <h4 class="box-title col-md-12 col-sm-12 col-xs-12" style="padding:0;">Nombre de boites vendues/semaine </h4>
                                        </div>
                                        <div class="for-pad">
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                                <input type="radio" name="data[Visite][produitschoix]" class="boits" value="5" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 5 </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                                <input type="radio" name="data[Visite][produitschoix]" class="boits" value="10" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 10 </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4 text-center ">
                                                <input type="radio" name="data[Visite][produitschoix]" class="boits" value="20" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 20 </b>
                                            </span>
                                        </div>
                                    </div> -->


                                    <?php

                                    echo '<div class="input text selectgame box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;" >';
                                    echo "<div class='box-header with-border'>
                            <h4 class='box-title'>La liste des produits partenaire de conseil </h4></div>";
                                    echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'label' => false, 'multiple' => "multiple", "style" => "padding:0px;"));
                                    echo "</div>";
                                    ?>

                                    <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <div class="box-header with-border">
                                            <h4 class="box-title col-md-12 col-sm-12 col-xs-12" style="padding:0;">Nombre de boites vendues/semaine </h4>
                                        </div>
                                        <div class="for-pad">
                                            <span class="col-md-4 col-sm-4 col-xs-4">
                                                <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="5" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 5 </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4">
                                                <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="10" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 10 </b>
                                            </span>
                                            <span class="col-md-4 col-sm-4 col-xs-4">
                                                <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="20" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 20 </b>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- <div class="input text selectgame box box-primary " style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <?php
                                        // commenté en 1-30-2025
                                        //             echo "<div class='box-header with-border'>
                                        // <h4 class='box-title'>Noms des principaux prescripteurs </h4></div>";
                                        //             echo $this->Form->input('clients', array('name' => "data[Visite][prescripteurs]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple", "style" => "padding:0px;"));
                                        ?>
                                    </div> -->

                                    <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                        <label class="col-xs-12 " style="border-bottom: 1px solid #ecf0f5; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;margin-top:5px;">
                                            <b style="line-height: 27px;">Veille :</b>
                                            <span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(1)"><i id="concuricon1" class="fa fa-minus"></i></span>
                                        </label>
                                        <div style="  padding: 10px 0px; margin-top: 0px; display: block;" class="col-xs-12 concur1 concure">

                                            <div class="col-md-3 col-sm-12 col-xs-12 ">
                                                <select name="data[Visite][objection][1][produit]" class="form-control select2 esna">
                                                    <option value="" selected>Choisissez produit</option>
                                                    <?php foreach ($games as $key => $p) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>


                                            <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
                                                <select name="data[Visite][objection][1][plv]" class="form-control select2 esna">
                                                    <option value="" selected>Choisissez PLV</option>
                                                    <?php
                                                    $types = array("Panneau" => "Panneau", "Affiche" => "Affiche");
                                                    foreach ($types as $key => $p) {
                                                    ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
                                                <select name="data[Visite][objection][1][emplacement]" class="form-control select2 esna">
                                                    <option value="" selected>Choisissez emplacement</option>
                                                    <?php
                                                    $types = array("Etageres" => "Etageres", "Presentoirs" => "Presentoirs", "Absent" => "Absent");
                                                    foreach ($types as $key => $p) {
                                                    ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
                                                <?php echo $this->Form->input("Visite.objection.1.stock", array("class" => "VisiteObjectionStock", "label" => false, 'placeholder' => "Stock disponible au moment de la visite", "type" => "number", "style" => "margin-top:2px;width: 100%;")); ?>
                                            </div>

                                        </div>
                                    </div>

                                    <?php
                                    for ($i = 2; $i < 4; $i++) :

                                    ?>

                                        <div class="input text box box-primary" style="border: 1px solid #3c8dbc; border-radius: 6px; padding: 7px;margin-top: 6px;">
                                            <label class="col-xs-12" style="border-bottom: 1px solid #ecf0f5; padding: 5px 6px; margin-bottom: 0px;margin-top:5px;">
                                                <b style="line-height: 27px;">Concurrent <?php echo $i - 1; ?> : </b>
                                                <span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(<?php echo $i ?>)">
                                                    <i id="concuricon<?php echo $i ?>" class="fa fa-minus"></i></span>
                                            </label>

                                            <div style="padding: 10px 0px; margin-top: 0px; display: block;" class="col-xs-12 concur<?php echo $i ?> concure">


                                                <select name="data[Visite][concurrence_p][<?php echo $i; ?>][produit]" class="form-control select2 esna">
                                                    <option value="" selected>Choisissez produit</option>
                                                    <?php foreach ($games as $key => $p) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                    <?php } ?>
                                                </select>



                                                <span class="col-md-6 col-sm-12 col-xs-12 check0 no-padding">
                                                    <?php echo $this->Form->input("Visite.concurrence_p.$i.produitconcurant", array("label" => false, 'placeholder' => "Produit concurrent", "style" => "width:100%")); ?>
                                                </span>
                                                <div class="col-md-12 no-padding" style="margin-top: 14px;">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 no-padding emp" style="padding-left: 0;">
                                                        <select name="data[Visite][concurrence_p][<?php echo $i; ?>][emplacement]" class="form-control select2 esna" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <option value="" selected>Choisissez emplacement</option>
                                                            <?php
                                                            $types = array("Etageres" => "Etageres", "Presentoirs" => "Presentoirs", "Absent" => "Absent");
                                                            foreach ($types as $key => $p) {
                                                            ?>
                                                                <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 no-padding">
                                                        <select name="data[Visite][concurrence_p][<?php echo $i; ?>][plv]" class="form-control select2 esna" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <option value="" selected>Choisissez PLV</option>
                                                            <?php
                                                            $types = array("Panneau" => "Panneau", "Affiche" => "Affiche");
                                                            foreach ($types as $key => $p) {
                                                            ?>
                                                                <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <?php echo $this->Form->input("Visite.concurrence_p.$i.stock", array("label" => false, 'placeholder' => "Stock disponible au moment de la visite", "type" => "number", "style" => "width:98%;text-align:center;")); ?>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding" >
                                                    <span class="col-md-3 col-sm-12 col-xs-12 check3" style="margin-bottom: 10px;">
                                                        <b style="font-weight: 600;">Type de l'offre</b>
                                                    </span>
                                                    <span class="col-md-8 col-sm-12 col-xs-12" style="padding-left: 18px;">
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Pack" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Pack </b>
                                                        </span>
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Action" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Action </b>
                                                        </span>
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Autres" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Autres </b>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 no-padding" >
                                                    <span class="col-md-3 col-sm-12 col-xs-12 check3" style="margin-bottom: 10px;">
                                                        <b style="font-weight: 600;">Degré d'agressivité</b>
                                                    </span>
                                                    <span class="col-md-9 col-sm-12 col-xs-12">
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Tres agressive" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Tres agressive </b>
                                                        </span>
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Agressive" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Agressive </b>
                                                        </span>
                                                        <span class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 col-md-4 col-sm-4 col-xs-4" value="Peu agressive" style="margin: 2px;padding: 0px 2px;width: 30%;">
                                                            <b style="font-weight:normal;"> Peu agressive </b>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>

                                    <?php if ($user["User"]["ligne_id"] == 9) { ?>
                                        <div class="input text col-md-12 col-sm-12 col-xs-12" id="stockv" style="    position: relative;">
                                            <ul class="tabs" style="margin-bottom:17px;border: 1px solid #3c8dbc;border-radius: 6px;padding: 7px;margin-top: 6px;">
                                                <li><?php echo $this->Form->input("Stockvisite.0.produit_id", array('label' => 'Produit', "options" => $produits_stock, 'div' => array('id' => 'div0'), 'class' => 'form-control')); ?></li>
                                                <li><?php echo $this->Form->input("Stockvisite.0.quantite", array('label' => 'Quantité', 'class' => 'form-control')); ?></li>
                                                <li><?php echo $this->Form->input("Stockvisite.0.commentaire", array('label' => 'Commentaire', 'class' => 'form-control', 'style' => "width: 100%;")); ?></li>
                                            </ul>
                                            <button style="position: absolute;top: 43%;right:-3.5%;" type="button" id="add" class="btn btn-success btn-large"><i class="fa fa-plus"></i></button>
                                        </div>
                                    <?php } ?>


                                    <div class="input text col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                        echo $this->Form->input('commentaire', array('label' => 'Commentaire', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                </ul>

                                <?php echo $this->Form->end(array('label' => 'Enregistrer le rapport de la visite', 'class' => 'btn btn-primary btn-large submit', 'div' => array('class' => 'well text-center  col-md-12 col-sm-12 col-xs-12'))); ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<?php
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->css('select2.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('select2.full.min');
?>
<script>
    (function(factory) {
        if (typeof define === "function" && define.amd) {
            define(["../widgets/datepicker"], factory);
        } else {
            factory(jQuery.datepicker);
        }
    }(function(datepicker) {
        datepicker.regional.fr = {
            closeText: "Fermer",
            prevText: "Précédent",
            nextText: "Suivant",
            currentText: "Aujourd'hui",
            monthNames: ["janvier", "février", "mars", "avril", "mai", "juin",
                "juillet", "août", "septembre", "octobre", "novembre", "décembre"
            ],
            monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
                "juil.", "août", "sept.", "oct.", "nov.", "déc."
            ],
            dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
            weekHeader: "Sem.",
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        datepicker.setDefaults(datepicker.regional.fr);

        return datepicker.regional.fr;

    }));
    //step months old: 0
    $("#datepicker").datepicker({
        stepMonths: 1
    }, $.datepicker.regional['fr']);
    $("#datepicker").datepicker("setDate", new Date());
    var pastdate = new Date(new Date().getTime() - (60 * 24 * 60 * 60 * 1000));
    var pdate = pastdate.getFullYear() + "-" + (pastdate.getMonth() + 1) + "-" + pastdate.getDate();
    /*code pour limitter la date*/
    $("#datepicker").datepicker('option', {
        minDate: new Date(pdate),
        maxDate: new Date(),
        startDate: new Date()
    });


    function check(id) {
        var ch = $(".check" + id + " input[type=checkbox]");
        if (ch.is(':checked')) {
            $(".mc" + id).removeAttr('disabled');
            $(".check" + id + " input[type=text]:eq(0)").trigger("click");
        } else {
            $(".mc" + id).attr('disabled', 'true');
        }
    }

    function checkd(id) {
        var ch = $(".checkd" + id + " input[type=checkbox]");
        if (ch.is(':checked')) {
            $(".n" + id).removeAttr('disabled');
        } else {
            $(".n" + id).val('0');
            $(".n" + id).attr('disabled', 'true');
        }
    }
    $(window).load(function() {
        $('#VisiteProduits').prepend('<option value="" disabled selected>Choisissez un produit</option>');
    });
    $('.selectgame .select2-container').on('focusout', function() {
        var esna = $('.selectgame .select2-container .select2-selection__choice').length;
        //alert(esna);
        if (esna == 0) {
            $('.boits').attr('disabled', 'disabled');

        } else {
            $('.boits').removeAttr('disabled');
        }
    });
    $('.selectgame .produits').change(function() {
        $('.boits').removeAttr('disabled');
        /*if(esna != 'Choisissez un produit'){
         $('.boits').attr('disabled','disabled');
         console.log(esna);
         }else {
         $('.boits').removeAttr('disabled');
         console.log(esna);
         }*/
    });

    function concurcl(id) {
        $(".concurclose" + id).parent().remove();
        $(".concur" + id).remove();
    }

    function concur(id) {
        $(".concur" + id).toggle();
        var clas = $("#concuricon" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#concuricon" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#concuricon" + id).attr("class", "fa fa-minus");
        }
    }
    $('.ajouterconcur').click(function() {
        $(".concurtogg").each(function() {
            var btntogg = $(this).children().attr("class");
            if (btntogg == 'fa fa-minus') {
                $(this).trigger('click');
            }
        });
        //var ci = $(".concure").length;
        var cu = $(".concurr").attr('id');
        var ci = parseInt(cu);
        var chi = 5 + $(".concurr input[type=checkbox]").length;
        var omc = 15 + $(".concurr input[type=text]").length;
        var div = '<label class="col-xs-12" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;margin-top:5px;"><b style="line-height: 27px;">OBJECTIONS (' + (ci + 1) + '):</b> <span class="concurclose' + ci + '" style="float:right;cursor:pointer;padding:4px;color:#aaa;margin-left:5px;" onclick="concurcl(' + ci + ')"><i class="fa fa-times"></i></span><span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(' + ci + ')"><i id="concuricon' + ci + '" class="fa fa-minus"></i></span></label><div style="border:1px solid #aaa;border-bottom-right-radius:4px;border-bottom-left-radius:4px;padding:10px 0px;" class="col-xs-12 concur' + ci + ' concure"><div class="col-md-3 col-sm-12 col-xs-12" style="margin-top: 8%;"><select name="data[Visite][produitO][' + ci + ']" class="form-control select2 esna1"><option value="" selected>Choisissez</option><?php foreach ($produits as $key => $p) { ?><option value="<?php echo $key; ?>"><?php echo $p; ?></option><?php } ?></select></div><div class="col-md-9 col-sm-12 col-xs-12"><span class="col-md-4 col-sm-4 col-xs-4 check' + chi + '"><input type="checkbox" name="data[Visite][objection][' + chi + ']" value="prix" onclick="check(' + chi + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRIX</b></span><span class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="data[objections][mot_cles][' + omc + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 1) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 2) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-4 col-xs-4 check' + (chi + 1) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 1) + ']" value="indication" onclick="check(' + (chi + 1) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">INDICATION</b></span><span class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="data[objections][mot_cles][' + (omc + 3) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 4) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 5) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-4 col-xs-4 check' + (chi + 2) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 2) + ']" value="pathologie" onclick="check(' + (chi + 2) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PATHOLOGIE</b></span><span class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="data[objections][mot_cles][' + (omc + 6) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 7) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 8) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-4 col-xs-4 check' + (chi + 3) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 3) + ']" value="posologie" onclick="check(' + (chi + 3) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">POSOLOGIE</b></span><span class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="data[objections][mot_cles][' + (omc + 9) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 10) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 11) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-4 col-xs-4 check' + (chi + 4) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 4) + ']" value="presentation" onclick="check(' + (chi + 4) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRESENTATION</b></span><span class="col-md-8 col-sm-8 col-xs-8"><input type="text" name="data[objections][mot_cles][' + (omc + 12) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 13) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 14) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span></div></div>';
        $('.concurr').append(div);
        $(".concurr").attr('id', ci + 1);
        $(".esna1").select2();
    });

    $(function() {
        $(".esna").select2();
        $(".produits").select2();
    });
    $("#add").click(function() {
        var i = $("#stockv ul").length;
        $("#stockv").append('<ul class="tabs" style="margin-bottom:17px;border: 1px solid #3c8dbc;border-radius: 6px;padding: 7px;margin-top: 6px;"><li id="li' + i + '"></li><li><div class="input text"><label for="Stockvisite' + i + 'Quantite">Quantité</label><input name="data[Stockvisite][' + i + '][quantite]" class="form-control" type="text" id="Stockvisite' + i + 'Quantite"></div></li><li><div class="input text"><label for="Stockvisite' + i + 'Commentaire">Commentaire</label><input name="data[Stockvisite][' + i + '][commentaire]" class="form-control" style="width: 100%;" type="text" id="Stockvisite' + i + 'Commentaire"></div></li></ul>');
        $('#div0').clone().attr('id', 'div' + i).appendTo('#li' + i);
        $('#div' + i + '  #Stockvisite0ProduitId').attr('name', 'data[Stockvisite][' + i + '][produit_id]');
    });
</script>
<script>
    $(function() {
        $(document).on('submit', "#VisiteRapportPharmacieForm", function(e) {
            window.ReactNativeWebView.postMessage('post')
        });
    });
</script>