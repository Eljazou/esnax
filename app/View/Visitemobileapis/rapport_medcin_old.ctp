<?php $i=0; foreach ($produits as $key => $p) { 
    $pro=str_replace("'","\'",$p);
    $produits[$key]=$pro;
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<style>
    b{
        margin-left: 10px;
    }
    .radio label{
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
    #image-gallery .prev, #image-gallery .next {
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
    .iv-snap-view{opacity:1 !important;}
    .popup{width:100%;height:100%;float:none;top:0;z-index:9999;position:fixed;background:#000;}
    .broch{cursor:pointer;float:right;}
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
    input[type='readonly']{
        cursor:no-drop;
    }
    @media (max-width:810px){
        .nopad {
            margin:10px 0px!important;
        }
        .panel-heading.col-lg-8,.panel-body .col-lg-8{
            width:100% !important;
        }
    }
    @media (max-width:991px){
        .concur select{
            margin-top:0px !important;
            margin-bottom:10px;
        }
    }
    .concur .col-xs-8{padding:0px;}
    .concur .col-xs-9{padding:0px;}
    .concur .col-xs-12 span.col-xs-4{padding-left:0px;}
    .payment-form{padding:0px;}
    .select2-dropdown{width:324px !important;}

    .for-pad{
            padding: 14px 0;

    }
    .tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
    .tabs li{
        color: #222;
        display: inline-flex;
        flex-direction: row;
        padding: 10px 5px;
        cursor: pointer;
    }
    .no-padding{
        padding: 2px;
    }
    .ch span{
        margin:6px 0;
        padding:2px
    }
    .select2-container .select2-selection--single {
    height: 35px!important;
    }
    /* order */
    .nopad {
        padding-left: 0 !important;
        margin: 11px 0;
        padding-right: 0 !important;
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
    #VisiteOrder{
        opacity: 0;
        width: 0;
        float: left; /* Reposition so the validation message shows over the label */
    }
    .img-responsive{
        border: 1px solid;
        border-radius: 8px;
    }
    .message_erreur{
        color: red;
        font-size: 12px;
        padding: 0;
        display: none;
    }
</style>
<div class="row">
<div class=" col-md-2"></div>
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
                    echo $this->Form->hidden('client_id', array('value' => $client_id));
					echo $this->Form->hidden('user_id', array('value' => $user_id));
                    echo $this->Form->hidden('latitude', array('value' => $latitude));
                    echo $this->Form->hidden('longitude', array('value' => $longitude));
                    echo $this->Form->hidden('timer', array('value' => $timer));
                    echo $this->Form->hidden('date', array('value' => $timer));
                    ?>   
                        <div class="input text radio" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <div class="col-xs-6">
                                <input type="radio" name="data[Visite][type_visite]" value="solo" id="solo" checked style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><label for="solo"> Visite solo</label>
                            </div>
                            <div class="col-xs-6">
                                <input type="radio" name="data[Visite][type_visite]" value="double" id="double" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><label for="double"> Visite en double</label>
                            </div>
                        </div>
                        <?php
                        if (empty($infosclient[0]['clients']['sexe'])) {
                            ?>
                            <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                                <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">GENRE <sup style="color:red;">*</sup></label>

                                <span class="col-md-6 col-sm-6 col-xs-6">
                                    <input type="radio" name="data[Client][sexe]" value="h" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> HOMME </b>
                                </span>
                                <span class="col-md-6 col-sm-6 col-xs-6">
                                    <input type="radio" name="data[Client][sexe]" value="f" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required"><b style="font-weight:normal;"> FEMME </b>
                                </span>
                                <br>
                            </div>

                        <?php } ?>
                        <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">Potentialité du cabinet (comment jugez-vous l’activité du cabinet ?)<sup style="color:red;">*</sup></label>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][partenaires]" value="bien" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="parte"><b style="font-weight:normal;"> BIEN </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][partenaires]" value="moyen" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="parte"><b style="font-weight:normal;"> MOYEN </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][partenaires]" value="faible" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="parte"><b style="font-weight:normal;"> FAIBLE </b>
                            </span>
                        </div>
                        <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">Adoption produits Esnapharm <sup style="color:red;">*</sup></label>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][veille]" value="100" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> Exclusif </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][veille]" value="50" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> Fidèle </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4">
                                <input type="radio" name="data[Visite][veille]" value="-+" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> Rare </b>
                            </span>
                        </div>
                        <!--<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                                
                                // <?php
                        // echo $this->Form->input('produits', array('name' => "data[Visite][produits]", 'label' => 'La liste des produits partenaire', 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 esna',"style"=>"padding:0px;"));
                        // 
                        ?>
     </div>-->
                        <div class="input text selectgame" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <label>Adoption produit </label>
                            <?php
                            echo $this->Form->input('games', array('name' => "data[Visite][produits]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple", "style" => "padding:0px;"));
                            ?>
                        </div>
                        <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">Nombre de prescription estimé/semaine</label>
                                <span >
                                        <select name="data[Visite][produit_nbr_boite_adoption]" id="nbr_prescription" class="form-control" required="required">
                                            <?php for ($i=0; $i <= 20; $i++) { 
                                                if($i==0){?>
                                                    <option value="">Choisissez</option>
                                                    <option value="<?php echo $i++ ?>">0</option>
                                                <?php } ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>                                    
                                </span>
                                <span class="message_erreur">Ce champ est obligatoire</span>
                        <div class="input text" style="margin: 4px 0px;float: left;width: 100%;padding: 3px 6px;">
                            <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">Potentialité produit </label>
                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <input type="radio" name="data[Produit][nbr_boites]" class="boits" value="1" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 1 </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <input type="radio" name="data[Produit][nbr_boites]" class="boits" value="2" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 2 </b>
                            </span>
                            <span class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <input type="radio" name="data[Produit][nbr_boites]" class="boits" value="3" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 3</b>
                            </span>
                        </div>
                        <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">DEMANDE PRODUITS NON PRESENTES</label>
                            <?php
                            echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple", "style" => "padding:0px;"));
                            ?>
                        </div>
                        <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                            <label class="col-xs-12" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;margin-top:5px;">
                                <b style="line-height: 27px;">OBJECTIONS (1):</b> <span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#aaa;" onclick="concur(0)"><i id="concuricon0" class="fa fa-minus"></i></span>
                            </label>
                            <div style="border:1px solid #aaa;border-bottom-right-radius:4px;border-bottom-left-radius:4px;padding:10px 0px;margin-top:0px;" class="col-xs-12 concur0 concure">

                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-top: 8%;">
                                    <select name="data[Visite][produitO][0]" class="form-control select2 esna">
                                        <option value="" selected>Choisissez</option>
                                        <?php foreach ($produits as $key => $p) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $p; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-9 col-sm-12 col-xs-12 ch">
                                    <span class="col-md-4 col-sm-12 col-xs-12 check0">
                                        <input type="checkbox" name="data[Visite][objection][0]" value="prix" onclick="check(0)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">PRIX</b>
                                    </span>
                                    <span class="col-md-8 col-sm-12 col-xs-12">
                                        <input type="text" name="data[objections][mot_cles][0]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 5px 2px;width: 30%;border-radius: 6px;">
                                        <input type="text" name="data[objections][mot_cles][1]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][2]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                    </span>

                                    <span class="col-md-4 col-sm-12 col-xs-12 check1">
                                        <input type="checkbox" name="data[Visite][objection][1]" value="indication" onclick="check(1)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">INDICATION</b>
                                    </span>
                                    <span class="col-md-8 col-sm-12 col-xs-12">
                                        <input type="text" name="data[objections][mot_cles][3]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][4]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][5]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 5px 2px;width: 30%;">
                                    </span>

                                    <span class="col-md-4 col-sm-12 col-xs-12 check2">
                                        <input type="checkbox" name="data[Visite][objection][2]" value="pathologie" onclick="check(2)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">PATHOLOGIE</b>
                                    </span>
                                    <span class="col-md-8 col-sm-12 col-xs-12">
                                        <input type="text" name="data[objections][mot_cles][6]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][7]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][8]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                    </span>

                                    <span class="col-md-4 col-sm-12 col-xs-12 check3">
                                        <input type="checkbox" name="data[Visite][objection][3]" value="posologie" onclick="check(3)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">POSOLOGIE</b>
                                    </span>
                                    <span class="col-md-8 col-sm-12 col-xs-12">
                                        <input type="text" name="data[objections][mot_cles][9]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][10]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][11]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                    </span>

                                    <span class="col-md-4 col-sm-12 col-xs-12 check4">
                                        <input type="checkbox" name="data[Visite][objection][4]" value="presentation" onclick="check(4)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
                                        <b style="font-weight:normal;">PRESENTATION</b>
                                    </span>
                                    <span class="col-md-8 col-sm-12 col-xs-12">
                                        <input type="text" name="data[objections][mot_cles][12]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][13]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                        <input type="text" name="data[objections][mot_cles][14]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 5px 2px;border-radius: 6px;width: 30%;">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 concurr" style="margin-bottom:10px;padding:3px 6px;" id="1">
                        </div>
                        <div class="col-xs-12">
                            <b class="ajouterconcur btn btn-primary" style="float:right;">Ajouter Objections</b>
                        </div>
                        <?php
                        foreach ($ordres as $key => $value) :?>
                        <div class="col-xs-4 col-sm-4 col-md-4 nopad text-center">
                            <label class="image-checkbox">
                                <?php if($value["Brochure"]["logo"]!="" && $value["Brochure"]["logo"]!=null):?>
                                    <img class="img-responsive" style="width:381px;height:130px" src="<?php echo $this->Html->url("/img/brochures/".$value["Brochure"]["logo"])?>" />
                                <?php else:?>
                                    <img class="img-responsive" style="width:381px;height:130px" src="https://dummyimage.com/300x300/000/fff" />
                                <?php endif;?>
                                <input type="checkbox" class="checkbox" id="<?php echo $value["Brochure"]["id"]; ?>" name="image[]" value="" />
                                <i class="fa fa-"><?php echo $value["Brochureorganise"]["ordre"]; ?></i>
                                <i class="order hidden" id="i<?php echo $value["Brochure"]["id"]; ?>"></i>
                            </label>
                        </div>
                        <?php endforeach;
                            if(count($ordres)>0)
                                echo $this->Form->input('order',array('label'=>false,'required'));
                            else
                                echo $this->Form->input('order',array('label'=>false));
                        ?>
                        <div class="input text col-md-12 col-sm-12 col-xs-12" >
                            <?php
                            echo $this->Form->input('commentaire', array('required','label' => 'Commentaire', 'class' => 'form-control'));
                            ?>
                        </div>
                    </ul>

                    <?php echo $this->Form->end(array('label' => 'Enregistrer le rapport de la visite', 'class' => 'btn btn-primary btn-large submit','onclick'=>'handle_submit(event)', 'div' => array('class' => 'well text-center  col-md-12 col-sm-12 col-xs-12'))); ?>

                </div>

            </div>
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
(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(["../widgets/datepicker"], factory);
    } else {
        factory(jQuery.datepicker);
    }
}(function (datepicker) {
    datepicker.regional.fr = {
        closeText: "Fermer",
        prevText: "Précédent",
        nextText: "Suivant",
        currentText: "Aujourd'hui",
        monthNames: ["janvier", "février", "mars", "avril", "mai", "juin",
            "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
        monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
            "juil.", "août", "sept.", "oct.", "nov.", "déc."],
        dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
        dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
        dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
        weekHeader: "Sem.",
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""};
    datepicker.setDefaults(datepicker.regional.fr);

    return datepicker.regional.fr;

}));
//step months old: 0
$("#datepicker").datepicker({stepMonths: 1}, $.datepicker.regional['fr']);
$("#datepicker").datepicker("setDate", new Date());
var pastdate = new Date(new Date().getTime() - (60 * 24 * 60 * 60 * 1000));
var pdate = pastdate.getFullYear() + "-" + (pastdate.getMonth() + 1) + "-" + pastdate.getDate();
/*code pour limitter la date*/
$("#datepicker").datepicker('option', {minDate: new Date(pdate), maxDate: new Date(), startDate: new Date()});


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
$(window).load(function () {
    $('#VisiteProduits').prepend('<option value="" disabled selected>Choisissez un produit</option>');
});
$('.selectgame .select2-container').on('focusout', function () {
    var esna = $('.selectgame .select2-container .select2-selection__choice').length;
    //alert(esna);
    if (esna == 0) {
        $('.boits').attr('disabled', 'disabled');

    } else {
        $('.boits').removeAttr('disabled');
    }
});
$('.selectgame .produits').change(function () {
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
$('.ajouterconcur').click(function () {
    $(".concurtogg").each(function () {
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

$(function () {
    $(".esna").select2();
    $(".produits").select2();
});
$("#add").click(function() {
    var i=$("#stockv ul").length;
    $("#stockv").append('<ul class="tabs" style="margin-bottom:17px;border: 1px solid #3c8dbc;border-radius: 6px;padding: 7px;margin-top: 6px;"><li id="li'+i+'"></li><li><div class="input text"><label for="Stockvisite'+i+'Quantite">Quantité</label><input name="data[Stockvisite]['+i+'][quantite]" class="form-control" type="text" id="Stockvisite'+i+'Quantite"></div></li><li><div class="input text"><label for="Stockvisite'+i+'Commentaire">Commentaire</label><input name="data[Stockvisite]['+i+'][commentaire]" class="form-control" style="width: 318px;" type="text" id="Stockvisite'+i+'Commentaire"></div></li></ul>');
    $('#div0').clone().attr('id', 'div'+i).appendTo('#li'+i);
    $('#div'+i+'  #Stockvisite0ProduitId').attr('name','data[Stockvisite]['+i+'][produit_id]');
})
// image gallery
// init the state from the input
function checked() {
    $(".image-checkbox").each(function () {
    if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
        $(this).addClass('image-checkbox-checked');
    }
    else {
        $(this).removeClass('image-checkbox-checked');
    }
    });   
}
checked();
var count=1;
// sync the state to the input
$(".image-checkbox").on("click", function (e) {
var $checkbox = $(this).find('input[type="checkbox"]');
  if($checkbox.prop("checked")==true)
  {
    $(".image-checkbox").each(function () {
        $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked",false);
        $(this).removeClass('image-checkbox-checked');
        count=1
        $("#VisiteOrder").attr("value","")
    })
  }else
  {
    $(this).toggleClass('image-checkbox-checked');
    $checkbox.prop("checked",!$checkbox.prop("checked"))
    var id=$checkbox.attr("id");
    var order=$("#VisiteOrder").val();
    order+=id+",";
    $("#VisiteOrder").attr("value",order)
    // $("#VisiteOrder").val(order)
    $("#i"+id).text(count)
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


    
    function handle_submit(event){
        var nbr_prescription = $("#nbr_prescription").val();
        if(nbr_prescription != ""){
            $("#nbr_prescription").css("border", "1px solid #d2d6de");
            $(".message_erreur").css("display", "none");
        } else {
            event.preventDefault();
            $("#nbr_prescription")[0].scrollIntoView(); // or use .focus() if you want to focus the element
            $("#nbr_prescription").css("border", "1px solid red");
            $(".message_erreur").css("display", "block");
        }
    }
</script>