<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<?php $i = 0;
foreach ($produits as $key => $p) {
    $pro = str_replace("'", "\'", $p);
    $produits[$key] = $pro;
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<style>
    /* style new design */
    #VisiteOrder {
        opacity: 0;
        width: 0;
        display: none;
        /* Reposition so the validation message shows over the label */
    }

    .tabs {
        margin: 0px;
        padding: 0px;
        list-style: none;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        row-gap: 10px;
    }

    .message_erreur {
        color: red;
        font-size: 12px;
        padding: 0;
        display: none;
    }

    .tabs_evalu {
        padding: 15px 26px;
        background: #eeeeee;
        border-radius: 20px;
        margin-bottom: 28px;
        padding: 15px 26px 74px;
    }

    .tab_evalu2 {
        padding: 15px 26px 1px;
    }

    .radio+.radio,
    .checkbox+.checkbox {
        margin-top: 10px;
    }

    .header_tab {
        display: flex;
        justify-content: space-between;
        padding: 10px 6px;
        margin-bottom: 0px;
        margin-top: 5px;
        background: #e1e1e1;
    }

    .concurtogg {
        padding: 4px;
    }

    .body_tab {
        padding: 15px 26px;
        background: #eeeeee;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        margin-bottom: 28px;
        margin-top: 0px;
        display: block;
    }

    .body_tab .inputs span {
        margin: 6px 0;
        padding: 2px;
    }

    .select_objection {
        height: 199px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .ajouterconcur {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        row-gap: 10px;
    }

    .space_arround {
        justify-content: space-around;
    }

    .box-body {
        padding: 30px 35px;
    }

    .date_div {
        position: relative;
    }

    label {
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        font-style: normal;
        font-size: 16px;
        color: #555;
        text-transform: capitalize;
        /* display: block; */
        margin-bottom: 5px;
    }

    .icon_calendar {
        position: absolute;
        bottom: 14px;
        right: 15px;
        font-size: 17px;
    }

    .form-control {
        background: #eeeeee;
        line-height: 30px;
        height: auto;
        border: 0;
        box-shadow: 0px -3px 0px -1px #009688;
        border-radius: 8px;
    }

    [id^="nbr_prescription"] {
        height: 40px;
        background-color: #ffffff;

    }

    .radio_content {
        padding-left: 12px;
    }

    .form-group {
        margin-bottom: 26px;
    }

    /* style radio button  */
    input[type=radio] {
        --s: 20px;
        /* control the size */
        --c: #009688;
        /* the active color */

        height: var(--s);
        aspect-ratio: 1;
        border: calc(var(--s)/8) solid #939393;
        padding: calc(var(--s)/8);
        background:
            radial-gradient(farthest-side, var(--c) 94%, #0000) 50%/0 0 no-repeat content-box;
        border-radius: 50%;
        outline-offset: calc(var(--s)/10);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
        font-size: inherit;
        transition: .3s;
        margin-left: -25px !important;
        margin: 0;
    }

    input[type=radio]:focus {
        outline: none;
    }

    input[type=radio]:active {
        outline: none;
    }

    input[type=radio]:checked {
        border-color: var(--c);
        background-size: 100% 100%;
    }

    input[type=radio]:disabled {
        background:
            linear-gradient(#939393 0 0) 50%/100% 20% no-repeat content-box;
        opacity: .5;
        cursor: not-allowed;
    }

    .radio label {
        font-size: 15px;
    }

    @media print {
        input[type=radio] {
            -webkit-appearance: auto;
            -moz-appearance: auto;
            appearance: auto;
            background: none;
        }
    }

    /* end radio style */
    /* style select 2  */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: auto !important;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single {
        height: 41px !important;
        display: flex !important;
        align-items: flex-end;
        justify-content: center;
        border: 0 !important;
        box-shadow: 0px -3px 0px -1px #009688;
        border-radius: 8px !important;
        background: #eeeeee;
    }

    /* end style select 2  */

    .body_veille {
        background: #eeeeee;
        padding: 15px 26px;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        row-gap: 20px;
    }

    .body_veille input {
        background-color: #ffffff;
    }

    .tabs select {
        height: 42px;
    }

    .container_btns {
        padding: 0px 56px 0px 15px;
        background: white;
        border-radius: 12px;
        display: flex;
        flex-wrap: nowrap;
        overflow-x: scroll;
        column-gap: 10px;
        margin-bottom: -15px;
        position: absolute;
        max-width: 100%;
    }

    @media only screen and (max-width: 600px) {
        .container_btns {
            margin-bottom: -4px;
        }
    }


    .assemble_container_btn {
        position: relative;

    }

    .btn_add_evalu {
        background-color: #009688;
        color: white;
        padding: 10px;
        position: absolute;
        border: 0;
        top: 0;
        right: 0;
        height: 54px;
        width: 45px;
        display: flex;
        align-items: center;
        border-top-right-radius: 12px;
        border-top-left-radius: 12px;
        justify-content: center;
        font-size: 25px;
    }

    .container_btns button {
        margin: 10px 0;
    }

    .all_tabs {
        background: white;
        padding: 21px 23px;
        border-bottom-left-radius: 11px;
        border-bottom-right-radius: 11px;
        z-index: 1;
        position: relative;
        top: 48px;
    }

    .tab_evalu .select2-container--default .select2-selection--single,
    .tab_evalu select {
        background: #eeeeee !important;
    }

    .btn_eval {
        background-color: #f1f1f1;
        border-color: #0c0c0c00;
        color: #1d1d1d;
        outline: none;
    }

    .btn_eval:focus {
        outline: none !important;
    }


    .container_btns .active {
        background-color: #009688;
        border: 0;
        color: #ffffff;
    }

    .selectgame .select span:nth-of-type(2) {
        display: none;
    }


    /* Image Checkbox Styling */
    .image-checkbox {
        position: relative;
        display: block;
        margin-bottom: 15px;
        border: 3px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .image-checkbox img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        display: block;
    }

    .image-checkbox .checkbox {
        position: absolute;
        opacity: 0;
        visibility: hidden;
    }

    .brochure-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 5px;
        font-size: 14px;
        display: flex;
        justify-content: space-between;
    }

    .new-order {
        background-color: #4CAF50;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        margin-right: 5px;
        visibility: hidden;
    }

    .image-checkbox-checked {
        border-color: #4CAF50;
        box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
    }

    .image-checkbox-checked .new-order {
        visibility: visible;
    }

    /* Added hover effect */
    .image-checkbox:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Order badge animation */
    @keyframes popIn {
        0% {
            transform: scale(0);
        }

        70% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .image-checkbox-checked .new-order {
        animation: popIn 0.3s forwards;
    }

    .comment-group {
        width: 100%;
        display: inline-block;
    }
</style>

<div class="row">
    <div class=" col-md-2"></div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Rapport de visite</h3>
            </div>
            <div class="box-body ">
                <?php echo $this->Form->create('Visite');
                echo $this->Form->hidden('client_id', array('value' => $client_id));
                ?>
                <div class="form-group">
                    <div class="date_div">
                        <label for="datepicker">Date de visite</label>
                        <input type="text" id="datepicker" class="form-control" name="data[Visite][date]" readonly>
                        <i class="fa-light fa-calendar icon_calendar"></i>
                    </div>
                </div>
                <?php if ($infosclient[0]['clients']['type_id'] == 1 || $infosclient[0]['clients']['type_id'] == 5) { ?>

                    <div class="form-group">
                        <label>Type visite</label>
                        <div class="row radio_content">
                            <div class="radio col-xs-6">
                                <label>
                                    <input type="radio" name="data[Visite][type_visite]" value="solo" id="solo" checked class="option-input radio">
                                    Visite solo
                                </label>
                            </div>
                            <div class="radio col-xs-6">
                                <label>
                                    <input type="radio" name="data[Visite][type_visite]" value="double" id="double" class="option-input radio">
                                    Visite en double
                                </label>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (empty($infosclient[0]['clients']['sexe'])) {
                    ?>
                        <div class="form-group">
                            <label>GENRE <sup style="color:red;">*</sup></label>
                            <div class="row radio_content">
                                <div class="radio col-xs-6">
                                    <label>
                                        <input type="radio" name="data[Client][sexe]" value="h" required="required">
                                        HOMME
                                    </label>

                                </div>
                                <div class="radio col-xs-6">
                                    <label>
                                        <input type="radio" name="data[Client][sexe]" value="f" required="required">
                                        FEMME
                                    </label>
                                </div>
                                <br>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>Potentialité du cabinet (comment jugez-vous l’activité du cabinet ?)<sup style="color:red;">*</sup></label>
                        <div class="row radio_content">
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="bien" required="required" class="parte">
                                    BIEN
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="moyen" required="required" class="parte">
                                    MOYEN
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="faible" required="required" class="parte">
                                    FAIBLE
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Adoption produits Esnapharm <sup style="color:red;">*</sup></label>
                        <div class="row radio_content">
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][veille]" value="100" required="required" class="concur">
                                    Exclusif
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][veille]" value="50" required="required" class="concur">
                                    Fidèle
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][veille]" value="-+" required="required" class="concur">
                                    Rare
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tabs_evalu">
                        <div class="assemble_container_btn">
                            <div class="container_btns">
                                <button class="btn btn_eval active" id="btn_evalu" data-id="1" onclick="clickbtn_evalu(event)">Ajout 1</button>
                            </div>
                            <button class="btn_add_evalu" onclick="add_evalu(event)">+</button>
                        </div>
                        <div class="all_tabs">
                            <div class="tab_evalu tab_evalu1">
                                <div class="form-group selectgame">
                                    <label>Adoption produit</label>
                                    <?php echo $this->Form->input('games', array('name' => "data[Visite][produit_adoption]", 'label' => false, 'class' => 'col-md-12 form-control select2 produits', "required" => "required", 'data-id' => '1', 'onchange' => 'getProduit(event)', 'id' => "VisiteGames1", 'empty' => 'Choisissez')); ?>

                                </div>
                                <div class="form-group">
                                    <label>Nombre de prescription estimé/semaine</label>
                                    <select id="nbr_prescription1" class="form-control" required="required">
                                        <?php for ($i = 0; $i <= 20; $i++) {
                                            if ($i == 0) { ?>
                                                <option value="">Choisissez</option>
                                                <option value="<?php echo $i++ ?>">0</option>
                                            <?php } ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="message_erreur">Ce champ est obligatoire</span>
                                </div>
                                <div class="form-group">
                                    <label>Potentialité produit renseigné</label>
                                    <div class="row radio_content">
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="pot1" class="boits nbr_boites1" value="1" disabled required="required">
                                                1
                                            </label>

                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="pot1" class="boits nbr_boites1" value="2" disabled required="required">
                                                2
                                            </label>
                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="pot1" class="boits nbr_boites1" value="3" disabled required="required">
                                                3
                                            </label>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label>DEMANDE PRODUITS NON PRESENTES</label>
                        <?php echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple", "style" => "padding:0px;")); ?>
                    </div>
                    <div class="form-group ">
                        <label class="col-xs-12 header_tab">
                            <b>OBJECTIONS (1):</b>
                            <div class="element_right">
                                <span class="concurtogg" onclick="concur(0)"><i id="concuricon0" class="fa fa-minus"></i></span>
                            </div>
                        </label>
                        <div class="col-xs-12 concur0 concure body_tab">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12 select_objection">
                                    <select name="data[Visite][produitO][0]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez</option>
                                        <?php foreach ($produits as $key => $p) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-9 col-sm-12 col-xs-12 inputs">
                                    <span class="col-xs-4 check0">
                                        <input type="checkbox" name="data[Visite][objection][0]" value="prix" onclick="check(0)">
                                        <b style="font-weight:normal;">PRIX</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <input type="text" name="data[objections][mot_cles][0]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1">
                                        <input type="text" name="data[objections][mot_cles][1]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2">
                                        <input type="text" name="data[objections][mot_cles][2]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3">
                                    </span>

                                    <span class="col-md-4 col-sm-4 col-xs-4 check1">
                                        <input type="checkbox" name="data[Visite][objection][1]" value="indication" onclick="check(1)">
                                        <b style="font-weight:normal;">INDICATION</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <input type="text" name="data[objections][mot_cles][3]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1">
                                        <input type="text" name="data[objections][mot_cles][4]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2">
                                        <input type="text" name="data[objections][mot_cles][5]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3">
                                    </span>

                                    <span class="col-md-4 col-sm-4 col-xs-4 check2">
                                        <input type="checkbox" name="data[Visite][objection][2]" value="pathologie" onclick="check(2)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">PATHOLOGIE</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <input type="text" name="data[objections][mot_cles][6]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1">
                                        <input type="text" name="data[objections][mot_cles][7]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2">
                                        <input type="text" name="data[objections][mot_cles][8]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3">
                                    </span>

                                    <span class="col-md-4 col-sm-4 col-xs-4 check3">
                                        <input type="checkbox" name="data[Visite][objection][3]" value="posologie" onclick="check(3)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">POSOLOGIE</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <input type="text" name="data[objections][mot_cles][9]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1">
                                        <input type="text" name="data[objections][mot_cles][10]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2">
                                        <input type="text" name="data[objections][mot_cles][11]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3">
                                    </span>

                                    <span class="col-md-4 col-sm-4 col-xs-4 check4">
                                        <input type="checkbox" name="data[Visite][objection][4]" value="presentation" onclick="check(4)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">PRESENTATION</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <input type="text" name="data[objections][mot_cles][12]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1">
                                        <input type="text" name="data[objections][mot_cles][13]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2">
                                        <input type="text" name="data[objections][mot_cles][14]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class=" concurr" id="1">
                        </div>
                        <div class="col-xs-12">
                            <b class="ajouterconcur btn btn-primary" style="float:right;">Ajouter Objections</b>
                        </div>
                        <?php foreach ($ordres as $key => $value) : ?>
                            <div class="col-xs-4 col-sm-4 col-md-4 nopad text-center">
                                <label class="image-checkbox">
                                    <?php if (!empty($value["Brochure"]["logo"])) : ?>
                                        <img class="img-responsive" src="<?php echo $this->Html->url("/img/brochures/" . $value["Brochure"]["logo"]) ?>" alt="Brochure Image" />
                                    <?php else : ?>
                                        <img class="img-responsive" src="https://dummyimage.com/381x130/000/fff" alt="Placeholder Image" />
                                    <?php endif; ?>
                                    <input type="checkbox" class="checkbox" id="<?php echo $value["Brochure"]["id"]; ?>" name="image[]" value="<?php echo $value["Brochure"]["id"]; ?>" />
                                    <div class="brochure-info">
                                        <span class="original-order"><?php echo $value["Brochureorganise"]["ordre"]; ?></span>
                                        <span class="new-order" id="i<?php echo $value["Brochure"]["id"]; ?>"></span>
                                    </div>
                                </label>
                            </div>
                        <?php endforeach; ?>

                        <?php
                        if (count($ordres) > 0) {
                            echo $this->Form->input('order', array('label' => false, 'required'));
                        } else {
                            echo $this->Form->input('order', array('label' => false));
                        }
                        ?>
                    </div>

                <?php }
                // ana hna fl myelse 
                else {
                ?>
                    <div class="form-group">
                        <label>Type de pharmacie <sup style="color:red;">*</sup></label>
                        <div class="row radio_content">
                            <div class="radio col-xs-6 col-md-6">
                                <label>
                                    <input type="radio" name="data[Visite][type_visite]" value="Client" required="required">
                                    Client
                                </label>
                            </div>
                            <div class="radio col-xs-6 col-md-6">
                                <label>
                                    <input type="radio" name="data[Visite][type_visite]" value="Non client" required="required">
                                    Non client
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Activité de pharmacie <sup style="color:red;">*</sup></label>
                        <div class="row radio_content">
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="Bien" required="required">
                                    Bien
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="Moyen" required="required">
                                    Moyen
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][partenaires]" value="Faible" required="required">
                                    Faible
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>La liste des produits partenaire de conseil</label>
                        <?php echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'label' => false, 'multiple' => "multiple")); ?>
                    </div>
                    <!-- <div class="form-group">
                        <label>Nombre de boites vendues/semaine</label>
                        <div class="row radio_content">
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="5" disabled required="required">
                                    5
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="10" disabled required="required">
                                    10
                                </label>
                            </div>
                            <div class="radio col-xs-4">
                                <label>
                                    <input type="radio" name="data[Visite][produitsNPchoix]" class="boits" value="20" disabled required="required">
                                    20
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Noms des principaux prescripteurs</label>
                        <?php echo $this->Form->input('clients', array('name' => "data[Visite][prescripteurs]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple")); ?>
                    </div>-->

                    <?php for ($i = 0; $i < 2; $i++) : ?>
                        <div class="form-group">
                            <label class="col-xs-12 header_tab">
                                <b>Veille <?php echo $i + 1; ?> :</b>
                                <div class="element_right">
                                    <span class="concurtogg" onclick="concur(<?php echo $i ?>)"><i id="concuricon<?php echo $i ?>" class="fa fa-minus"></i></span>
                                </div>
                            </label>
                            <div class="space_arround body_veille  concur<?php echo $i ?> concure">
                                <div class="col-md-6">
                                    <select name="data[Visite][objection][<?php $i ?>][produit]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez produit</option>
                                        <?php foreach ($games as $key => $p) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="data[Visite][objection][<?php echo $i ?>][plv]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez PLV</option>
                                        <?php
                                        $types = array("Panneau" => "Panneau", "Affiche" => "Affiche");
                                        foreach ($types as $key => $p) {
                                        ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="data[Visite][objection][<?php echo $i ?>][emplacement]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez emplacement</option>
                                        <?php
                                        $types = array("Etageres" => "Etageres", "Presentoirs" => "Presentoirs", "Absent" => "Absent");
                                        foreach ($types as $key => $p) {
                                        ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input("Visite.objection.$i.stock", array("label" => false, 'placeholder' => "Stock disponible au moment de la visite", "type" => "number",  "class" => "form-control")); ?>

                                </div>

                            </div>
                        </div>

                    <?php endfor;
                    for ($i = 2; $i < 4; $i++) : ?>
                        <div class="form-group">
                            <label class="header_tab">
                                <b>Concurance <?php echo $i - 1; ?> : </b>
                                <div class="element_right">
                                    <span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(<?php echo $i ?>)">
                                        <i id="concuricon<?php echo $i ?>" class="fa fa-minus"></i></span>
                                </div>
                            </label>

                            <div class="concur<?php echo $i ?> concure body_veille">

                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <select name="data[Visite][concurrence_p][<?php echo $i; ?>][produit]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez produit</option>
                                        <?php foreach ($games as $key => $p) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <span class="col-md-6 col-sm-4 col-xs-4 check0">
                                    <?php echo $this->Form->input("Visite.concurrence_p.$i.produitconcurant", array("label" => false, 'placeholder' => "Produit concurant", "class" => "form-control")); ?>

                                </span>

                                <div class="col-md-6 col-sm-8 col-xs-8">
                                    <select name="data[Visite][concurrence_p][<?php echo $i; ?>][emplacement]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez emplacement</option>
                                        <?php
                                        $types = array("Panneau" => "Panneau", "Affiche" => "Affiche");
                                        foreach ($types as $key => $p) {
                                        ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-8 col-xs-8">
                                    <select name="data[Visite][concurrence_p][<?php echo $i; ?>][plv]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez PLV</option>
                                        <?php
                                        $types = array("Etageres" => "Etageres", "Presentoirs" => "Presentoirs", "Absent" => "Absent");
                                        foreach ($types as $key => $p) {
                                        ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->input("Visite.concurrence_p.$i.stock", array("label" => false, 'placeholder' => "Stock disponible au moment de la visite", "type" => "number", "class" => "form-control")); ?>

                                </div>
                                <div class="col-md-12">
                                    <span class="col-md-3 col-sm-4 col-xs-4 check3">
                                        <b style="font-weight: 600;">Type de l'offre</b>
                                    </span>
                                    <span class="col-md-8 col-sm-8 col-xs-8">
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3" value="Pack">
                                                Pack
                                            </label>
                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3 " value="Action">
                                                Action
                                            </label>
                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][offre]" class="mc3 " value="Autres">
                                                Autres
                                            </label>
                                        </div>
                                    </span>
                                </div>
                                <div class="col-md-12" style="padding-top: 14px;">
                                    <span class="col-md-3 col-sm-4 col-xs-4 check3">
                                        <b style="font-weight: 600;">Degré d'agressivité</b>
                                    </span>
                                    <span class="col-md-9 col-sm-8 col-xs-8">
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 " value="Tres agressive">
                                                Tres agressive
                                            </label>
                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 " value="Agressive">
                                                Agressive
                                            </label>
                                        </div>
                                        <div class="radio col-xs-4">
                                            <label>
                                                <input type="radio" name="data[Visite][concurrence_p][<?php echo $i; ?>][agressivite]" class="mc3 " value="Peu agressive">
                                                Peu agressive
                                            </label>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                    <div class="form-group" id="stockv">
                        <ul class="tabs">
                            <li class="col-xs-4"><?php echo $this->Form->input("Stockvisite.0.produit_id", array('label' => 'Produit', "options" => $produits_stock, 'div' => array('id' => 'div0'), 'class' => 'form-control')); ?></li>
                            <li class="col-xs-4"><?php echo $this->Form->input("Stockvisite.0.quantite", array('label' => 'Quantité', 'class' => 'form-control')); ?></li>
                            <li class="col-xs-4"><?php echo $this->Form->input("Stockvisite.0.commentaire", array('label' => 'Commentaire', 'class' => 'form-control')); ?></li>
                            <li class="col-xs-12"><button type="button" id="add" class="btn btn-success btn-large"><i class="fa fa-plus"></i></button></li>
                        </ul>
                        <input type="hidden" name="data[Visite][produit_adoption]" value="" id="produit_val_final">

                    </div>

                <?php
                }
                ?>

                <div class="form-group comment-group">
                    <label>Commentaire <sup style="color:red;">*</sup></label>
                    <?php echo $this->Form->input('commentaire', array('name' => "data[Visite][commentaire]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control', 'placeholder' => 'Commentaire', 'required' => 'required')); ?>
                </div>

                <?php echo $this->Form->end(array('label' => 'Enregistrer le rapport de la visite', 'class' => 'btn btn-primary btn-large submit', 'onclick' => 'handle_submit(event)', 'div' => array('class' => 'well text-center  col-md-12 col-sm-12 col-xs-12'))); ?>

            </div>
        </div>
    </div>
    <div class=" col-md-2"></div>

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
    $(document).ready(function() {



        // init the state from the input
        function checked() {
            $(".image-checkbox").each(function() {
                if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                    $(this).addClass('image-checkbox-checked');
                } else {
                    $(this).removeClass('image-checkbox-checked');
                }
            });
        }

        checked();
        var count = 1;

        // sync the state to the input
        $(".image-checkbox").on("click", function(e) {
            e.preventDefault(); // Prevent default behavior

            var $checkbox = $(this).find('input[type="checkbox"]');
            var $thisCheckbox = $(this);
            var id = $checkbox.attr("id");

            if ($checkbox.prop("checked") == true) {
                // If this checkbox is already checked, uncheck everything
                $(".image-checkbox").each(function() {
                    var $cb = $(this).find('input[type="checkbox"]');
                    $cb.prop("checked", false);
                    $(this).removeClass('image-checkbox-checked');
                    // Clear the order number
                    $(this).find('.new-order').text('');
                });
                count = 1;
                $("#VisiteOrder").attr("value", "");
            } else {
                // Toggle this checkbox on
                $thisCheckbox.addClass('image-checkbox-checked');
                $checkbox.prop("checked", true);

                // Update the order value
                var order = $("#VisiteOrder").val();
                order += id + ",";
                $("#VisiteOrder").attr("value", order);

                // Display the order number in the badge
                $("#i" + id).text(count);
                count++;
            }
        });
    });


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

    // Init datepicker
    $("#datepicker").datepicker($.datepicker.regional['fr']);

    // Set today as default
    $("#datepicker").datepicker("setDate", new Date());

    // Limit to the last 3 days
    $("#datepicker").datepicker('option', {
        minDate: -2, // 2 days before today
        maxDate: 0 // today
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

    function enable_radio() {
        var selectedChoicesCount = $('.selectgame .select2-container .select2-selection__choice').length;

        var produitsChoixInput = $('input[name="data[Visite][produitschoix]"]');

        if (selectedChoicesCount === 0) {
            produitsChoixInput.attr('disabled', 'disabled').prop('checked', false);
        } else {
            produitsChoixInput.removeAttr('disabled');
        }
    };

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
        var div = '<label class="col-xs-12 header_tab"" ><b style="line-height: 27px;">OBJECTIONS (' + (ci + 1) + '):</b> <div><span class="concurclose' + ci + '" style="float:right;cursor:pointer;padding:4px;color:#aaa;margin-left:5px;" onclick="concurcl(' + ci + ')"><i class="fa fa-times"></i></span><span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(' + ci + ')"><i id="concuricon' + ci + '" class="fa fa-minus"></i></span></div></label><div class="col-xs-12 body_tab concur' + ci + ' concure"><div class="col-md-3 col-sm-12 col-xs-12" style="margin-top: 8%;"><select name="data[Visite][produitO][' + ci + ']" class="form-control select2 esna1"><option value="" selected>Choisissez</option><?php foreach ($produits as $key => $p) { ?><option value="<?php echo $key; ?>"><?php echo $p; ?></option><?php } ?></select></div><div class="col-md-9 col-sm-12 col-xs-12 ch inputs"><span class="col-md-4 col-sm-12 col-xs-12 check' + chi + '"><input type="checkbox" name="data[Visite][objection][' + chi + ']" value="prix" onclick="check(' + chi + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRIX</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + omc + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 1) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 2) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 1) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 1) + ']" value="indication" onclick="check(' + (chi + 1) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">INDICATION</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 3) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 4) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 5) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 2) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 2) + ']" value="pathologie" onclick="check(' + (chi + 2) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PATHOLOGIE</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 6) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 7) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 8) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 3) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 3) + ']" value="posologie" onclick="check(' + (chi + 3) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">POSOLOGIE</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 9) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 10) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 11) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 4) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 4) + ']" value="presentation" onclick="check(' + (chi + 4) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRESENTATION</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 12) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 13) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 14) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span></div></div>';
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
        $("#stockv").append('<ul class="tabs"><li class="col-xs-4" id="li' + i + '"></li><li class="col-xs-4"><div class="input text"><label for="Stockvisite' + i + 'Quantite">Quantité</label><input name="data[Stockvisite][' + i + '][quantite]" class="form-control" type="text" id="Stockvisite' + i + 'Quantite"></div></li><li class="col-xs-4"><div class="input text"><label for="Stockvisite' + i + 'Commentaire">Commentaire</label><input name="data[Stockvisite][' + i + '][commentaire]" class="form-control" type="text" id="Stockvisite' + i + 'Commentaire"></div></li></ul>');
        $('#div0').clone().attr('id', 'div' + i).appendTo('#li' + i);
        $('#div' + i + '  #Stockvisite0ProduitId').attr('name', 'data[Stockvisite][' + i + '][produit_id]');
    })
    // image gallery
    // init the state from the input
    // function checked() {
    //     $(".image-checkbox").each(function() {
    //         if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    //             $(this).addClass('image-checkbox-checked');
    //         } else {
    //             $(this).removeClass('image-checkbox-checked');
    //         }
    //     });
    // }
    // checked();
    // var count = 1;
    // // sync the state to the input
    // $(".image-checkbox").on("click", function(e) {
    //     var $checkbox = $(this).find('input[type="checkbox"]');
    //     if ($checkbox.prop("checked") == true) {
    //         $(".image-checkbox").each(function() {
    //             $checkbox = $(this).find('input[type="checkbox"]');
    //             $checkbox.prop("checked", false);
    //             $(this).removeClass('image-checkbox-checked');
    //             count = 1
    //             $("#VisiteOrder").attr("value", "")
    //         })
    //     } else {
    //         $(this).toggleClass('image-checkbox-checked');
    //         $checkbox.prop("checked", !$checkbox.prop("checked"))
    //         var id = $checkbox.attr("id");
    //         var order = $("#VisiteOrder").val();
    //         order += id + ",";
    //         $("#VisiteOrder").attr("value", order)
    //         // $("#VisiteOrder").val(order)
    //         $("#i" + id).text(count)
    //         e.preventDefault();
    //         count++;
    //     }
    // });


    function handle_submit(event) {

        let data_json = {};
        for (let i = 1; i <= count_evalu; i++) {
            var nbr_prescription = $("#nbr_prescription" + i).val();
            if (nbr_prescription != "") {
                $("#nbr_prescription" + i).css("border", "1px solid #d2d6de");
                $(".message_erreur" + i).css("display", "none");
            } else {
                event.preventDefault();
                $("#nbr_prescription" + i)[0].scrollIntoView(); // or use .focus() if you want to focus the element
                $("#nbr_prescription" + i).css("border", "1px solid red");
                $(".message_erreur" + i).css("display", "block");
            }

            // Get the selected option text for adoption_produit
            var adoption_produit = $('#VisiteGames' + i).find('option:selected').val();

            // Get the selected option value for nbr_prescription
            var nbr_prescription_value = $('#nbr_prescription' + i).find('option:selected').val();

            // Get the potentialite value of the checked radio button
            var potentialite = $('.nbr_boites' + i + ':checked').val();
            // Add data to the JSON object
            data_json[adoption_produit] = {
                "nb": nbr_prescription_value,
                "pot": potentialite
            };

        }
        // Convert data_json to a JSON string
        let data_json_string = JSON.stringify(data_json);

        // Log or use the data_json object
        if (Object.keys(data_json).length > 0) {
            console.log(data_json); // Output the data_json to the console
            $("#produit_val_final").val(data_json_string); // Set the JSON string as the value of the hidden input
        }
        // event.preventDefault();

    }
</script>

<!-- start script tabs evaluation -->
<script>
    var count_evalu = 1;

    function add_evalu(event) {
        count_evalu = parseInt($('.tab_evalu').length) + 1;
        event.preventDefault();

        var tab_evalu = $(".tab_evalu1").clone();
        $('.btn_eval').each(function() {
            $(this).removeClass('active');
        });
        var btn_evalu = $('#btn_evalu').clone().removeAttr('id').attr('data-id', count_evalu).addClass('active').text('Ajout ' + count_evalu);

        const tab_evalu_new = tab_evalu.removeClass('tab_evalu1').addClass('tab_evalu' + count_evalu);
        tab_evalu_new.find('select[name="data[Visite][produit_adoption]"]').removeAttr('id').attr('id', 'VisiteGames' + count_evalu).attr('data-id', count_evalu);
        tab_evalu_new.find('#nbr_prescription1').removeAttr('id').attr('id', 'nbr_prescription' + count_evalu);
        tab_evalu_new.find('.nbr_boites1').removeClass('nbr_boites1').addClass('nbr_boites' + count_evalu).attr('name', 'pot' + count_evalu).prop('checked', false).attr('disabled', 'disabled');
        $('.tab_evalu').fadeOut();
        $('.all_tabs').append(tab_evalu_new);
        var containerBtns = $('.container_btns');
        containerBtns.append(btn_evalu);
        // Scroll to the end of the container
        containerBtns.scrollLeft(containerBtns[0].scrollWidth);
        $('.tab_evalu' + count_evalu).fadeIn();
        $('.produits').select2();



    }

    function clickbtn_evalu(event) {
        event.preventDefault();
        var clicked_btn = event.target.dataset.id;
        console.log(clicked_btn);
        $('.btn_eval').each(function() {
            $(this).removeClass('active');
        });
        $('.tab_evalu').each(function() {
            $(this).fadeOut();
        });
        $('.tab_evalu' + clicked_btn).fadeIn(); //ok
        $('[data-id="' + clicked_btn + '"]').addClass('active');
    }

    function getProduit(event) {
        // Use the Select2 API to get the selected value and text
        var select = $(event.target);
        var select_id = select.data('id');
        var val_produit = select.find('option:selected').text(); // Get selected text
        if (val_produit != "Choisissez") {
            // Update the button's text with the selected option's text
            $('button[data-id="' + select_id + '"]').text("Ajout de " + val_produit);
            $('.nbr_boites' + select_id).removeAttr('disabled');
        } else {
            $('.nbr_boites' + select_id).attr('disabled', 'disabled');
        }
    }
</script>
<!-- end script tabs evaluation -->