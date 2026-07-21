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
@media (max-width:810px){
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
</style>
<div class="panel panel-primary">
    <div class="panel-heading col-lg-8 col-xs-12">
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
        <div class="col-lg-8 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Visite',array("style"=>"float: left; width: 100%; height: auto;")); ?>
					<?php
						echo $this->Form->hidden('client_id', array('value' => $client_id));
						echo $this->Form->input('date', ['type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'label' => "Date de visite"]); 
					?>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<div class="col-xs-6">
							<input type="radio" name="data[Visite][type_visite]" value="client" id="solo" checked style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><label for="solo">Client</label>
						</div>
						<div class="col-xs-6">
							<input type="radio" name="data[Visite][type_visite]" value="pas client" id="double" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"><label for="double">Pas client</label>
						</div>
					</div>
					
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
							<?php
								
									echo "Activité de la pharmacie";
							?><sup style="color:red;">*</sup>
						</label>
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
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">Adoption des produits Esnapharm <sup style="color:red;"></sup></label>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="100" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"  class="concur"><b style="font-weight:normal;"> Exclusif </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="50" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"  class="concur"><b style="font-weight:normal;"> Fidèle </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Visite][veille]" value="-+" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;"  class="concur"><b style="font-weight:normal;"> Rare </b>
						</span>
					</div>
					<!--<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						
						// <?php
                            // echo $this->Form->input('produits', array('name' => "data[Visite][produits]", 'label' => 'La liste des produits partenaire', 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 esna',"style"=>"padding:0px;"));
                            // ?>
                     </div>-->
					<div class="input text selectgame" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<?php 
								
									$prod_label="liste des produits partenaire de PRESCRIPTION";
									$boit_label="Nombre de boites vendues par semaine";
									$prodc_label="liste des produits partenaire de CONSEIL";
								
								
							?>
						<?php
							echo $this->Form->input('games', array('name' => "data[Visite][produits]", 'label' => $prod_label, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple","style"=>"padding:0px;"));
							
                        ?>
                    </div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;padding: 3px 6px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;"><?php echo $boit_label; ?></label>
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
					<div class="input text selectgame" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
					<?php echo $this->Form->input('games', array('name' => "data[Visite][produitsNP]", 'label' => $prodc_label, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple","style"=>"padding:0px;")); ?>
					</div>
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;padding: 3px 6px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0;"><?php echo $boit_label; ?></label>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boitesC]" class="boits" value="5" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 5 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boitesC]" class="boits" value="10" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 10 </b>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4">
							<input type="radio" name="data[Produit][nbr_boitesC]" class="boits" value="20" style="float:left;width: 17px;height: 16px;margin-top: 3px;margin-left: 2px;" disabled required="required"><b style="font-weight:normal;"> 20 </b>
						</span>
					</div>
					
					<div class="input text" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
						<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Noms des principaux prescripteurs</label>
						<?php
                            echo $this->Form->input('clientsSecteurs', array('name' => "data[Visite][prescripteurs]", 'label' => false, 'class' => 'col-md-12 col-sm-12 col-xs-12 form-control select2 produits', 'multiple' => "multiple","style"=>"padding:0px;"));
                        ?>
                    </div>
									
					
					<div class="input text col-md-12 col-sm-12 col-xs-12" style="margin: 4px 0px;float: left;width: 100%;border-top: 3px solid #eee;padding: 3px 6px;border-radius:5px;">
                    <?php
						echo $this->Form->input('commentaire', array('label' => 'Commentaire', 'class' => 'form-control'));
                    ?>
					</div>
					
						<div class="col-xs-12" style="padding:0px;">
							<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;">
								<b style="line-height: 27px;">Veille (1):</b>
								<span class="veilletogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="veille(0)"><i id="veilleicon0" class="fa fa-minus"></i></span>
							</h4>
							<div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px; margin-top:0px; background:#fefefe;" class="col-xs-12 veille0 concur">
								<div class="col-md-6 col-xs-12">	
									<div class="col-md-12 col-xs-12">
										<label class="col-xs-12" style="padding: 0px;">Produit :</label>
										<select name="data[veillep][0][produit_id]" class="form-control select2 prodv">
											<option value="">Choisissez</option>
											<?php foreach ($games as $k=>$v):?>
												<option value="<?php echo $k ; ?>"><?php echo $v ; ?></option>
											<?php endforeach ; ?>
										</select>
									</div>
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Emplacement produits :</label>
										<select name="data[veillep][0][emplacement]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;">
											<option value="">Choisissez</option>
											<option value="Etageres">étagères</option>
											<option value="Presentoirs">présentoirs</option>
											<option value="Absent">Absent</option>
										</select>
									</div>	
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Stocks disponibles au moment de la visite :</label>
										<input name="data[veillep][0][stock]" class="form-control" min="0" placeholder="Stock" type="number">
									</div>
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">PLV en place :</label>
										<select name="data[veillep][0][plv]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;">
											<option value="">Choisissez</option>
											<option value="Panneau">Panneau</option>
											<option value="Affiche">Affiche</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 veille_div" style="margin-bottom:10px;padding:0px;" id="1">
						</div>
						<div class="col-xs-12">
							<b class="ajouter_veille btn btn-primary" style="float:right;">Ajouter veille</b>
						</div>
						
						
						<div class="col-xs-12" style="padding:0px;">
							<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius: 4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;">
								<b style="line-height: 27px;">Concurrence (1):</b>
								<span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="concur(0)"><i id="concuricon0" class="fa fa-minus"></i></span>
							</h4>
							<div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px; margin-top:0px; background:#fefefe;" class="col-xs-12 concur0 concur">
								<div class="col-md-6 col-xs-12">	
									<div class="col-md-12 col-xs-12">
										<label class="col-xs-12" style="padding: 0px;">Produit :</label>
										<select name="data[RapportConcurance][0][produit_id]" class="form-control select2 prodc">
											<option value="">Choisissez</option>
											<?php foreach ($games as $k=>$v):?>
												<option value="<?php echo $k ; ?>"><?php echo $v ; ?></option>
											<?php endforeach ; ?>
										</select>
									</div>
									<div class="col-md-12 col-xs-12">
										<label class="col-xs-12" style="padding: 0px;">Produit concurrent :</label>
										<input type="text" name="data[RapportConcurance][0][produit_concurant]" class="col-xs-12" placeholder="Rédigez le nom du concurrent" style="float:left; padding:6px 8px;font-weight:bold;">
									</div>
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Emplacement produits :</label>
										<select name="data[RapportConcurance][0][emplacement]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;">
											<option value="">Choisissez</option>
											<option value="Etageres">étagères</option>
											<option value="Presentoirs">présentoirs</option>
											<option value="Absent">Absent</option>
										</select>
									</div>	
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Stocks disponibles au moment de la visite :</label>
										<input name="data[RapportConcurance][0][stock]" class="form-control" min="0" placeholder="Stock" type="number">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="col-md-12 col-xs-12">
										<label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">PLV en place :</label>
										<select name="data[RapportConcurance][0][plv]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;">
											<option value="">Choisissez</option>
											<option value="Panneau">Panneau</option>
											<option value="Affiche">Affiche</option>
										</select>
									</div>
									<div class="col-md-12 col-xs-12">
										<label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Type de l’offre :</label>
										<div class="col-xs-4">
											<input type="checkbox" name="data[RapportConcurance][0][type_offre][]"  value="Pack"><b> Pack</b>
										</div>
										<div class="col-xs-4">
											<input type="checkbox" name="data[RapportConcurance][0][type_offre][]" value="Action"><b> Action</b>
										</div>
										<div class="col-xs-4">
											<input type="checkbox" name="data[RapportConcurance][0][type_offre][]" value="Autres"><b> Autres</b>
										</div>
									</div>
									<div class="col-md-12 col-xs-12" style="margin-top: 11px;">
										<label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Degrés d’agressivité :</label>
										<div class="col-xs-4">
											<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Tres agressive"><b> Très agressive</b>
										</div>
										<div class="col-xs-4">
											<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Agressive"><b> Agressive</b>
										</div>
										<div class="col-xs-4">
											<input type="radio" name="data[RapportConcurance][0][agressivite][]" value="Peu agressive"><b> Peu agressive</b>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 concurr_pharm" style="margin-bottom:10px;padding:0px;" id="1">
						</div>
						<div class="col-xs-12">
							<b class="ajouterconcur_pharm btn btn-primary" style="float:right;">Ajouter concurrence</b>
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
	 $('.selectgame .select2-container').on('focusout',function(){
		var esna = $('.selectgame .select2-container .select2-selection__choice').length;
		//alert(esna);
			if(esna == 0){
				$('.boits').attr('disabled','disabled');
				
			}else {
				$('.boits').removeAttr('disabled');
			}
	 });
	 $('.selectgame .produits').change(function(){
			$('.boits').removeAttr('disabled');
			/*if(esna != 'Choisissez un produit'){
				$('.boits').attr('disabled','disabled');
				console.log(esna);
			}else {
				$('.boits').removeAttr('disabled');
				console.log(esna);
			}*/
		});

function concurcl(id){
	$(".concurclose"+id).parent().remove();
	$(".concur"+id).remove();
}
function concur(id){
	$(".concur"+id).toggle();
		var clas = $("#concuricon"+id).attr("class");
		if(clas=='fa fa-minus'){
			$("#concuricon"+id).attr("class", "fa fa-plus");
		}
		if(clas=='fa fa-plus'){
			$("#concuricon"+id).attr("class", "fa fa-minus");
		}
}
function veillecl(id){
	$(".veilleclose"+id).parent().remove();
	$(".veille"+id).remove();
}
function veille(id){
	$(".veille"+id).toggle();
		var clas = $("#veilleicon"+id).attr("class");
		if(clas=='fa fa-minus'){
			$("#veilleicon"+id).attr("class", "fa fa-plus");
		}
		if(clas=='fa fa-plus'){
			$("#veilleicon"+id).attr("class", "fa fa-minus");
		}
}
$('.ajouterconcur').click(function(){
	$(".concurtogg").each(function(){
		var btntogg = $(this).children().attr("class");
		if(btntogg=='fa fa-minus'){
				$(this).trigger('click');
			}
	});
	//var ci = $(".concure").length;
	var cu = $(".concurr").attr('id');
	
	$('.concurr').append(div);
	$(".concurr").attr('id',ci+1);
	$(".esna1").select2();
});	
$('.ajouterconcur_pharm').click(function(){
	$(".concurtogg").each(function(){
		var btntogg = $(this).children().attr("class");
		if(btntogg=='fa fa-minus'){
				$(this).trigger('click');
			}
	});
	//var ci = $(".concur").length;
	var cu = $(".concurr_pharm").attr('id');
	var ci = parseInt(cu);
	console.log(ci);
	var div = '<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius:4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;"><b style="line-height: 27px;">Concurrence ('+(ci+1)+'):</b><span class="concurclose'+ci+'" style="float:right;cursor:pointer;padding:4px;color:#074c75;margin-left:5px;" onclick="concurcl('+ci+')"><i class="fa fa-times"></i></span><span class="concurtogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="concur('+ci+')"><i id="concuricon'+ci+'" class="fa fa-minus"></i></span></h4><div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px;margin-top:0px;background:#fefefe;" class="col-xs-12 concur'+ci+' concur"><div class="col-md-6 col-xs-12"><div class="col-md-12 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Produit :</label><select name="data[RapportConcurance]['+ci+'][produit_id]" class="form-control select2 prodc"><option value="">Choisissez</option><?php foreach ($games as $k=>$v):?><option value="<?php echo $k ; ?>"><?php echo $v ; ?></option><?php endforeach ; ?></select></div><div class="col-md-12 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Produit concurrent :</label><input type="text" name="data[RapportConcurance]['+ci+'][produit_concurant]" class="col-xs-12" placeholder="Rédigez le nom du concurrent" style="float:left; padding:6px 8px;font-weight:bold;"></div><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Emplacement produits :</label><select name="data[RapportConcurance]['+ci+'][emplacement]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;"><option value="">Choisissez</option><option value="Etageres">étagères</option><option value="Presentoirs">présentoirs</option><option value="Absent">Absent</option></select></div><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Stocks disponibles au moment de la visite :</label><input name="data[RapportConcurance]['+ci+'][stock]" class="form-control" min="0" placeholder="Stock" type="number"></div></div><div class="col-md-6 col-xs-12"><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">PLV en place :</label><select name="data[RapportConcurance]['+ci+'][plv]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;"><option value="">Choisissez</option><option value="Panneau">Panneau</option><option value="Affiche">Affiche</option></select></div><div class="col-md-12 col-xs-12"><label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Type de l’offre :</label><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance]['+ci+'][type_offre][]" value="Pack"><b> Pack</b></div><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance]['+ci+'][type_offre][]" value="Action"><b> Action</b></div><div class="col-xs-4"><input type="checkbox" name="data[RapportConcurance]['+ci+'][type_offre][]" value="Autres"><b> Autres</b></div> </div><div class="col-md-12 col-xs-12" style="margin-top: 11px;"><label class="col-xs-12" style="padding: 0px;margin-bottom: 11px;">Degrés d’agressivité :</label><div class="col-xs-4"><input type="radio" name="data[RapportConcurance]['+ci+'][agressivite][]" value="Tres agressive"><b> Très agressive</b></div><div class="col-xs-4"><input type="radio" name="data[RapportConcurance]['+ci+'][agressivite][]" value="Agressive"><b> Agressive</b></div><div class="col-xs-4"><input type="radio" name="data[RapportConcurance]['+ci+'][agressivite][]" value="Peu agressive"><b> Peu agressive</b></div></div></div></div>';
	$('.concurr_pharm').append(div);
	$(".concurr_pharm").attr('id',ci+1);
	$(".prodc").select2();
});
/****/

$('.ajouter_veille').click(function(){
	$(".veilletogg").each(function(){
		var btntogg = $(this).children().attr("class");
		if(btntogg=='fa fa-minus'){
				$(this).trigger('click');
			}
	});
	//var ci = $(".concur").length;
	var cu = $(".veille_div").attr('id');
	var ci = parseInt(cu);
	console.log(ci);
	var div = '<h4 class="col-xs-12 bg-blue" style="border: 1px solid #aaa; border-top-right-radius:4px; border-top-left-radius: 4px; padding: 5px 6px; margin-bottom: 0px;"><b style="line-height: 27px;">Veille ('+(ci+1)+'):</b><span class="veilleclose'+ci+'" style="float:right;cursor:pointer;padding:4px;color:#074c75;margin-left:5px;" onclick="veillecl('+ci+')"><i class="fa fa-times"></i></span><span class="veilletogg" style="float:right;cursor:pointer;padding:4px;color:#074c75;" onclick="veille('+ci+')"><i id="veilleicon'+ci+'" class="fa fa-minus"></i></span></h4><div style="border:1px solid #aaa; border-bottom-right-radius:4px; border-bottom-left-radius:4px; padding:10px 0px;margin-top:0px;background:#fefefe;" class="col-xs-12 veille'+ci+' concur"><div class="col-md-6 col-xs-12"><div class="col-md-12 col-xs-12"><label class="col-xs-12" style="padding: 0px;">Produit :</label><select name="data[veillep]['+ci+'][produit_id]" class="form-control select2 prodv"><option value="">Choisissez</option><?php foreach ($games as $k=>$v):?><option value="<?php echo $k ; ?>"><?php echo $v ; ?></option><?php endforeach ; ?></select></div><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Emplacement produits :</label><select name="data[veillep]['+ci+'][emplacement]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;"><option value="">Choisissez</option><option value="Etageres">étagères</option><option value="Presentoirs">présentoirs</option><option value="Absent">Absent</option></select></div></div><div class="col-md-6 col-xs-12"><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">Stocks disponibles au moment de la visite :</label><input name="data[veillep]['+ci+'][stock]" class="form-control" min="0" placeholder="Stock" type="number"></div><div class="col-md-12 col-xs-12"><label class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">PLV en place :</label><select name="data[veillep]['+ci+'][plv]" class="col-md-12 form-control" style="padding:0px;text-transform: capitalize;"><option value="">Choisissez</option><option value="Panneau">Panneau</option><option value="Affiche">Affiche</option></select></div></div></div>';
	$('.veille_div').append(div);
	$(".veille_div").attr('id',ci+1);
	$(".prodv").select2();
});
$(window).load(function(){
	$(function () {
        $(".esna").select2();
        $(".produits, .prodv, .prodc").select2();
	});
});
</script>