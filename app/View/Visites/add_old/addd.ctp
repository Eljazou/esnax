<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<style>
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
</style>
<div class="panel panel-primary">
    <div class="panel-heading col-lg-8">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"><?php echo __('Rapport d\'une  visite'); ?></h3>
    </div>
    <div class="panel-body">
        <!--<div class="col-lg-3 broch">
                <div class="info-box">
        <span class="info-box-icon bg-light-blue"><i class="fa fa-bold"></i></span>
        <div class="info-box-content" style="height: 100%;vertical-align: middle;line-height: 79px;">
            <span class="info-box-text" style="font-size: 23px;color: #999;">Brochures</span>
        </div>
    </div>
        </div>-->
        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Visite',array("style"=>"float: left; width: 100%; height: auto;")); ?>
					<?php
						echo $this->Form->hidden('client_id', array('value' => $client_id));
						echo $this->Form->input('date', ['type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'label' => "Date de visite"]);
					?>
					<?php if($infosclient[0]['clients']['type_id']==1){ 
					?>
					<?php if(empty($infosclient[0]['clients']['sexe'])){ ?>
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
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">POT CAB<sup style="color:red;">*</sup></label>
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
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">CONCURRENTS <sup style="color:red;">*</sup></label>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="100" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> 100 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="50" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> 50 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="-+" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" required="required" class="concur"><b style="font-weight:normal;"> -+ </b>
						</span>
					</div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<!--<label class="col-md-12" style="padding:0px;">Produit donné</label>-->
						<!-- <select name="esna" class="col-md-12 form-control select2 esna" style="padding:0px;" required="required"> -->
							<!-- <option value="1">ANTI</option> -->
							<!-- <option value="2">BIO</option> -->
							<!-- <option value="3">MG</option> -->
							<!-- <option value="4">M20</option> -->
							<!-- <option value="5">HEPN</option> -->
							<!-- <option value="6">ERB</option> -->
							<!-- <option value="7">DOR</option> -->
							<!-- <option value="8">TRIV</option> -->
							<!-- <option value="9">EXTRA</option> -->
						<!-- </select> -->
						<?php
                            echo $this->Form->input('produits', array('name' => "data[Visite][produits]", 'label' => 'La liste des produits partenaire', 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 esna',"style"=>"padding:0px;"));
                            ?>
                    </div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;padding: 3px 6px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">N° BTS préscri/J </label>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boites]" class="boits" value="5" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 5 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boites]" class="boits" value="10" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 10 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boites]" class="boits" value="20" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 20 </b>
						</span>
					</div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">DEMANDE PRODUITS NON PRESENTES</label>
					<!--	<select name="produits" class="col-md-12 form-control select2 produits" multiple style="padding:0px;" required="required">
							<option value="1">ANTI</option>
							<option value="2">BIO</option>
							<option value="3">MG</option>
							<option value="4">M20</option>
							<option value="5">HEPN</option>
							<option value="6">ERB</option>
							<option value="7">DOR</option>
							<option value="8">TRIV</option>
							<option value="9">EXTRA</option>
						</select>-->
						<?php
                            echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple","style"=>"padding:0px;"));
                            ?>
                    </div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<label class="col-md-4 col-sm-4 col-xs-4" style="padding:0px;">OBJECTIONS</label>
						<label class="col-md-8 col-sm-8 col-xs-8" style="padding:0px;">MOTS CLES</label>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="col-md-4 col-sm-4 col-xs-4 check0">
								<input type="checkbox" name="data[Visite][objection][0]" value="prix" onclick="check(0)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
								<b style="font-weight:normal;">PRIX</b>
							</span>
							<span class="col-md-8 col-sm-8 col-xs-8">
								<input type="text" name="data[objections][mot_cles][0]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][1]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][2]" class="mc0 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;">
							</span>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="col-md-4 col-sm-4 col-xs-4 check1">
								<input type="checkbox" name="data[Visite][objection][1]" value="indication" onclick="check(1)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
								<b style="font-weight:normal;">INDICATION</b>
							</span>
							<span class="col-md-8 col-sm-8 col-xs-8">
								<input type="text" name="data[objections][mot_cles][3]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][4]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][5]" class="mc1 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;">
							</span>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="col-md-4 col-sm-4 col-xs-4 check2">
								<input type="checkbox" name="data[Visite][objection][2]" value="pathologie" onclick="check(2)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
								<b style="font-weight:normal;">PATHOLOGIE</b>
							</span>
							<span class="col-md-8 col-sm-8 col-xs-8">
								<input type="text" name="data[objections][mot_cles][6]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][7]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][8]" class="mc2 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;">
							</span>
						</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="col-md-4 col-sm-4 col-xs-4 check3">
								<input type="checkbox" name="data[Visite][objection][3]" value="posologie" onclick="check(3)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
								<b style="font-weight:normal;">POSOLOGIE</b>
							</span>
							<span class="col-md-8 col-sm-8 col-xs-8">
								<input type="text" name="data[objections][mot_cles][9]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][10]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][11]" class="mc3 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;">
							</span>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="col-md-4 col-sm-4 col-xs-4 check4">
								<input type="checkbox" name="data[Visite][objection][4]" value="presentation" onclick="check(4)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
								<b style="font-weight:normal;">PRESENTATION</b>
							</span>
							<span class="col-md-8 col-sm-8 col-xs-8">
								<input type="text" name="data[objections][mot_cles][12]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled required="required" placeholder="Mot cle 1" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][13]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 2" style="margin: 2px;padding: 0px 2px;width: 30%;">
								<input type="text" name="data[objections][mot_cles][14]" class="mc4 col-md-4 col-sm-4 col-xs-4" disabled placeholder="Mot cle 3" style="margin: 2px;padding: 0px 2px;width: 30%;">
							</span>
						</div>
					</div>
					<?php }
						else{ ?>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">PRODUITS</label>
						<span class="col-md-4 col-sm-4 col-xs-4 check0" style="padding:1px;border:1px solid #aaa;width:32%;margin:1px;">
							<input type="checkbox" name="prod" value="anti" onclick="check(0)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
							<b style="font-weight:normal;width:auto;float:left;margin-right:3px;">ANTI</b>
							<input type="number" name="prod0" min="0" class="mc0" disabled required="required" style="width: 38px;height:19px;float:right;" placeholder="0">
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 check1" style="padding:1px;border:1px solid #aaa;width:32%;margin:1px;">
							<input type="checkbox" name="prod" value="bio" onclick="check(1)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
							<b style="font-weight:normal;width:auto;float:left;margin-right:3px;">BIO</b>
							<input type="number" name="prod1" min="0" class="mc1" disabled required="required" style="width: 38px;height:19px;float:right;" placeholder="0">
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 check2" style="padding:1px;border:1px solid #aaa;width:32%;margin:1px;">
							<input type="checkbox" name="prod" value="mg" onclick="check(2)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
							<b style="font-weight:normal;width:auto;float:left;margin-right:3px;">MG</b>
							<input type="number" name="prod2" min="0" class="mc2" disabled required="required" style="width: 38px;height:19px;float:right;" placeholder="0">
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 check3" style="padding:1px;border:1px solid #aaa;width:32%;margin:1px;">
							<input type="checkbox" name="prod" value="m20" onclick="check(3)" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;">
							<b style="font-weight:normal;width:auto;float:left;margin-right:3px;">M20</b>
							<input type="number" name="prod3" min="0" class="mc3" disabled required="required" style="width: 38px;height:19px;float:right;" placeholder="0">
						</span>
					</div>
					<?php } ?>
					<div class="input text col-md-12 col-sm-12 col-xs-12" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                    <?php
						echo $this->Form->input('commentaire', array('label' => 'Commentaire', 'class' => 'form-control'));
                    ?>
					</div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                        <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;"><?php echo __('Les brochures présentées'); ?></label>
                        <?php $i = 0; ?>
                        <input name="data[Brochure][<?php echo $i; ?>][client_id]" value="<?php echo $client_id; ?>" type="hidden">
                        <?php foreach ($brochures as $value) {
                            ?>
                            <div class="col-md-4 col-sm-4 col-xs-4" style="padding:4;">
                                <input name="data[Brochure][<?php echo $i; ?>][client_id]" value="<?php echo $client_id; ?>" type="hidden">
                                <label>
                                    <input type="checkbox"  name="data[Brochure][<?php echo $i; ?>][brochure_id]" value="<?php echo $value['Brochure']['id']; ?>">
                                    <a href="<?php echo $this->Html->url("/img/brochures/" . $value['Brochure']['file']); ?>" target="_blanck">
                                        <?php echo $value['Brochure']['name']; ?> 
                                    </a>
                                </label>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                        <label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;"><?php echo __('Les échantillons à donner'); ?></label>
                        <?php $i = 0; 
                            foreach ($stock as $value) {
                            ?>
                            <div class="col-md-4 col-sm-4 col-xs-4" style="padding:4px; width:100%;float:left;">
                                <label class="checkd<?php echo $i; ?>">
                                    <input type="checkbox" name="data[Stockgadjet][<?php echo $i; ?>][echantillon_id]" value="<?php echo $value['Echantillon']['id']; ?>" onclick="checkd(<?php echo $i; ?>)" id="checkd<?php echo $i; ?>">
                                        <?php echo $value['Echantillon']['name']." : (".$value['Stockgadjet']['quantite'].")"; ?> 
                                </label>
                                <input name="data[Stockgadjet][<?php echo $i; ?>][quantite]" class="n<?php echo $i; ?>" min="0" value="0" type="number" disabled style="float:right;">
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <?php echo $this->Form->end(array('label' => 'Enregistrer le rapport de la visite', 'class' => 'btn btn-primary btn-large submit','div' => array('class' => 'well text-center  col-md-12 col-sm-12 col-xs-12'))); ?>
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
    /*$('document').ready(function(){
     var hgt = $('body').height();
     var popup = '<div class="col-md-12 popup" style="display:none;"><div id="image-gallery"><b onclick="$(\'.popup\').hide();" style="cursor:pointer;width: auto;height: auto;z-index: 999999;position: absolute;top:0;right:0;color: #fff;float: right;font-size: 30px;"><i class="fa fa-times"></i></b><div class="image-container"></div><img src="/img/left.svg" class="prev"/><img src="/img/right.svg"  class="next"/><div class="footer-info"><span class="current"></span>/<span class="total"></span></div></div></div>'
     $('body').prepend(popup);
     $('.popup').css('height',hgt+'px !important');
     var a = <?php echo $i; ?>;
     if(a!=0){
     $('.popup').show();
     }
     });*/
	$(function () {
        $(".esna").select2();
        $(".produits").select2();
	});
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
	//$("#datepicker").datepicker({stepMonths: 0}, $.datepicker.regional['fr']);
    $("#datepicker").datepicker({stepMonths: 1}, $.datepicker.regional['fr']);
    $("#datepicker").datepicker("setDate", new Date());
	var pastdate = new Date(new Date().getTime()-(1*24*60*60*1000));
	var pdate = pastdate.getFullYear()+"-"+(pastdate.getMonth()+1)+"-"+pastdate.getDate();
	//$("#datepicker").datepicker('option', {minDate: new Date(pdate), maxDate: new Date(), startDate: new Date()});

    /*$(function () {
     var images = [<?php foreach ($brochures as $value) : ?>{
         small : '/img/brochures/<?php echo $value['Brochure']['file']; ?>',
         big : '/img/brochures/<?php echo $value['Brochure']['file']; ?>'
         },<?php endforeach; ?>];
     
     var curImageIdx = 1,
     total = images.length;
     var wrapper = $('#image-gallery'),
     curSpan = wrapper.find('.current');
     var viewer = ImageViewer(wrapper.find('.image-container'));
     
     //display total count
     wrapper.find('.total').html(total);
     
     function showImage(){
     var imgObj = images[curImageIdx - 1];
     viewer.load(imgObj.small, imgObj.big);
     curSpan.html(curImageIdx);
     }
     
     wrapper.find('.next').click(function(){
     curImageIdx++;
     if(curImageIdx > total) curImageIdx = 1;
     showImage();
     });
     
     wrapper.find('.prev').click(function(){
     curImageIdx--;
     if(curImageIdx < 0) curImageIdx = total;
     showImage();
     });
     
     //initially show image
     showImage();
     
     });
     
     $(".broch").click(function() {
     var a = <?php echo $i; ?>;
     if(a!=0){
     $('.popup').show();
     }
     });*/
	 function check(id){
		var ch = $(".check"+id+" input[type=checkbox]");
		if(ch.is(':checked')){
			$(".mc"+id).removeAttr('disabled');
			$(".check"+id+" input[type=text]:eq(0)").trigger("click");
		}else{ 
			$(".mc"+id).attr('disabled','true');
		}
	 }
	 function checkd(id){
		var ch = $(".checkd"+id+" input[type=checkbox]");
		if(ch.is(':checked')){
			$(".n"+id).removeAttr('disabled');
		}else {
			$(".n"+id).val('0');
			$(".n"+id).attr('disabled','true');
		}
	 }
	 $(window).load(function(){
		 $('#VisiteProduits').prepend('<option value="" disabled selected>Choisissez un produit</option>');
	 });
		
		var esna='';
	 $('.esna').change(function(){
			esna = $('.select2-selection__rendered').text();
			$('.boits').removeAttr('disabled');
			/*if(esna != 'Choisissez un produit'){
				$('.boits').attr('disabled','disabled');
				console.log(esna);
			}else {
				$('.boits').removeAttr('disabled');
				console.log(esna);
			}*/
		});
	
</script>