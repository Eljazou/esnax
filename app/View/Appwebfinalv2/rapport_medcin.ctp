<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

    /* .tab_evalu2 {
        padding: 15px 26px 1px;
    } */

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
        padding: 0px;
    }
    /* .box-body {
        padding: 20px
    } */
    .no-padding {
        padding: 14px;
    }

    .date_div {
        position: relative;
    }

    label {
        font-family: var(--font-family, "Inter", sans-serif);
        font-weight: 600;
        font-style: normal;
        font-size: 16px;
        color: #555;
        text-transform: capitalize;
        display: block;
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

    /*image gallery*/
    .image-checkbox {
        cursor: pointer;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 1px solid transparent;
        margin-bottom: 0;
        outline: 0;
    }

    .image-checkbox input[type="checkbox"] {
        display: none;
    }

    .image-checkbox-checked {
        border-color: #4783B0;
    }

    .image-checkbox .fa {
        position: absolute;
        display: block !important;
        color: #4A79A3;
        background-color: #fff;
        padding: 10px;
        top: 0;
        font-size: 16px;
        font-weight: bold;
        right: 0;
    }

    .image-checkbox .order {
        position: absolute;
        color: white;
        background-color: green;
        padding: 10px;
        bottom: 0;
        right: 0;
    }

    .image-checkbox-checked .order {
        display: block !important;
        font-size: 16px;
        font-weight: bold;
    }

    #VisiteOrder {
        opacity: 0;
        width: 0;
        float: left;
        /* Reposition so the validation message shows over the label */
    }

    .img-responsive {
        border: 1px solid;
        border-radius: 8px;
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

    .message_erreur {
        color: red;
        font-size: 12px;
        padding: 0;
        display: none;
    }

    .well {
        margin-top: 26px;
    }
</style>
<div class="row">

    <div class="header">
        <div class="col-md-2" style=" padding: 0px;">
             <a class="btn_spiner " href="<?php echo $this->Html->url(array("action" => "view_client", $code, $client_id)); ?>">
              <i class="fa-solid fa-angle-left arrow"></i></a>
        </div>
        <div class="col-md-2" style=" padding: 0px;">
            <p>Rapport</p>
        </div>
        <div class="col-md-2"></div>

    </div>
    <div class="all-elements">
        <div class="col-md-8 no-padding">
            <div class="box box-primary col-md-11">
                <div class="box-header with-border col-lg-12 col-xs-12">
                    <h3 class="box-title" style="padding-left: 0px;margin-left: -7px;"><?php echo __('Rapport d\'une  visite'); ?></h3>
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
                                    <?php echo $this->Form->input('games', array('name' => "data[Visite][produit_adoption]", 'label' => false, 'class' => 'col-md-12 form-control select2 produits', "required" => "required", 'data-id' => '1', 'onchange' => 'getProduit(event)', 'id' => "VisiteGames1",'empty' => 'Choisissez')); ?>

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
                        <div class="row">
                            <?php
                            foreach ($ordres as $key => $value) : ?>
                                <div class="col-xs-4 col-sm-4 col-md-4 nopad text-center">
                                    <label class="image-checkbox">
                                        <?php if ($value["Brochure"]["logo"] != "" && $value["Brochure"]["logo"] != null) : ?>
                                            <img class="img-responsive" style="width:381px;height:130px" src="<?php echo $this->Html->url("/img/brochures/" . $value["Brochure"]["logo"]) ?>" />
                                        <?php else : ?>
                                            <img class="img-responsive" style="width:381px;height:130px" src="https://dummyimage.com/300x300/000/fff" />
                                        <?php endif; ?>
                                        <input type="checkbox" class="checkbox" id="<?php echo $value["Brochure"]["id"]; ?>" name="image[]" value="" />
                                        <i class="fa fa-"><?php echo $value["Brochureorganise"]["ordre"]; ?></i>
                                        <i class="order hidden" id="i<?php echo $value["Brochure"]["id"]; ?>"></i>
                                    </label>
                                </div>
                            <?php endforeach;
                            if (count($ordres) > 0)
                                echo $this->Form->input('order', array('label' => false, 'required'));
                            else
                                echo $this->Form->input('order', array('label' => false));
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="data[Visite][produit_adoption]" value="" id="produit_val_final">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                            echo $this->Form->input('commentaire', array('label' => 'Commentaire', 'class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(array('label' => 'Enregistrer le rapport de la visite', 'class' => 'btn btn-primary btn-large submit ', 'onclick' => 'handle_submit(event)', 'div' => array('class' => 'well text-center  col-md-12 col-sm-12 col-xs-12'))); ?>
                </div>



            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
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

    // Init datepicker
    $("#datepicker").datepicker($.datepicker.regional['fr']);

    // Set today as default
    $("#datepicker").datepicker("setDate", new Date());

    // Limit to the last 3 days
    $("#datepicker").datepicker('option', {
        minDate: -2,   // 2 days before today
        maxDate: 0     // today
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
    $('.selectgame .produits').on('change', function() {
        var esna = $(this).val();
        if (esna === null || esna.length === 0) {
            $('.boits').attr('disabled', 'disabled');
            $('input[name="data[Produit][nbr_boites]"]').prop('checked', false);
        } else {
            $('.boits').removeAttr('disabled');
        }
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
        var div = '<label class="col-xs-12" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;margin-top:5px;"><b style="line-height: 27px;">OBJECTIONS (' + (ci + 1) + '):</b> <span class="concurclose' + ci + '" style="float:right;cursor:pointer;padding:4px;color:#aaa;margin-left:5px;" onclick="concurcl(' + ci + ')"><i class="fa fa-times"></i></span><span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(' + ci + ')"><i id="concuricon' + ci + '" class="fa fa-minus"></i></span></label><div style="border:1px solid #aaa;border-bottom-right-radius:4px;border-bottom-left-radius:4px;padding:10px 0px;" class="col-xs-12 concur' + ci + ' concure"><div class="col-md-3 col-sm-12 col-xs-12" style="margin-top: 8%;"><select name="data[Visite][produitO][' + ci + ']" class="form-control select2 esna1"><option value="" selected>Choisissez</option><?php foreach ($produits as $key => $p) { ?><option value="<?php echo $key; ?>"><?php echo $p; ?></option><?php } ?></select></div><div class="col-md-9 col-sm-12 col-xs-12 ch"><span class="col-md-4 col-sm-12 col-xs-12 check' + chi + '"><input type="checkbox" name="data[Visite][objection][' + chi + ']" value="prix" onclick="check(' + chi + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRIX</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + omc + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 1) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 2) + ']" class="mc' + chi + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 1) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 1) + ']" value="indication" onclick="check(' + (chi + 1) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">INDICATION</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 3) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 4) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 5) + ']" class="mc' + (chi + 1) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 2) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 2) + ']" value="pathologie" onclick="check(' + (chi + 2) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PATHOLOGIE</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 6) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 7) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 8) + ']" class="mc' + (chi + 2) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 3) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 3) + ']" value="posologie" onclick="check(' + (chi + 3) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">POSOLOGIE</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 9) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 10) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 11) + ']" class="mc' + (chi + 3) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span><span class="col-md-4 col-sm-12 col-xs-12 check' + (chi + 4) + '"><input type="checkbox" name="data[Visite][objection][' + (chi + 4) + ']" value="presentation" onclick="check(' + (chi + 4) + ')" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><b style="font-weight:normal;">PRESENTATION</b></span><span class="col-md-8 col-sm-12 col-xs-12"><input type="text" name="data[objections][mot_cles][' + (omc + 12) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 13) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;"><input type="text" name="data[objections][mot_cles][' + (omc + 14) + ']" class="mc' + (chi + 4) + ' col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;"></span></div></div>';
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
        $("#stockv").append('<ul class="tabs" style="margin-bottom:17px;border: 1px solid #3c8dbc;border-radius: 6px;padding: 7px;margin-top: 6px;"><li id="li' + i + '"></li><li><div class="input text"><label for="Stockvisite' + i + 'Quantite">Quantité</label><input name="data[Stockvisite][' + i + '][quantite]" class="form-control" type="text" id="Stockvisite' + i + 'Quantite"></div></li><li><div class="input text"><label for="Stockvisite' + i + 'Commentaire">Commentaire</label><input name="data[Stockvisite][' + i + '][commentaire]" class="form-control" style="width: 318px;" type="text" id="Stockvisite' + i + 'Commentaire"></div></li></ul>');
        $('#div0').clone().attr('id', 'div' + i).appendTo('#li' + i);
        $('#div' + i + '  #Stockvisite0ProduitId').attr('name', 'data[Stockvisite][' + i + '][produit_id]');
    })
    // image gallery
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
        var $checkbox = $(this).find('input[type="checkbox"]');
        if ($checkbox.prop("checked") == true) {
            $(".image-checkbox").each(function() {
                $checkbox = $(this).find('input[type="checkbox"]');
                $checkbox.prop("checked", false);
                $(this).removeClass('image-checkbox-checked');
                count = 1
                $("#VisiteOrder").attr("value", "")
            })
        } else {
            $(this).toggleClass('image-checkbox-checked');
            $checkbox.prop("checked", !$checkbox.prop("checked"))
            var id = $checkbox.attr("id");
            var order = $("#VisiteOrder").val();
            order += id + ",";
            $("#VisiteOrder").attr("value", order)
            // $("#VisiteOrder").val(order)
            $("#i" + id).text(count)
            e.preventDefault();
            count++;
        }
    });
</script>
<script>
    $(function() {
        $(document).on('submit', "#VisiteRapportMedcinForm", function(e) {
            window.ReactNativeWebView.postMessage('post')
        });
    });
</script>
<script>
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

        // Update the button's text with the selected option's text
        if (val_produit != "Choisissez") {
            // Update the button's text with the selected option's text
            $('button[data-id="' + select_id + '"]').text("Ajout de " + val_produit);
            $('.nbr_boites' + select_id).removeAttr('disabled');
        }
        else{
            $('.nbr_boites' + select_id).attr('disabled','disabled');
        }
    }
</script>
<!-- end script tabs evaluation -->