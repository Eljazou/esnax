<style>
    @media (max-width: 1225px){
        .col-lg-9{top: !important;}
    }
    @media (max-width: 1024px){
        .col-lg-2{margin: auto !important; border-radius: 0 !important;}
        .col-lg-9{top:0 !important;}
    }
    @media (max-width: 1183px){
        .panel-primary > .panel-heading {
            width: 50%;
        }
    }
    @media (max-width: 990px){
        .panel-primary > .panel-heading {
            width: 97% !important;
        }
    }
    .panel.panel-primary .col-lg-9 {
        float: none !important;
        margin: auto !important;
        background: #fff !important;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.27) !important;
        padding-top: 8px;
    }
</style>
<div class="panel panel-primary">					
    <div class="panel-heading col-lg-9 col-md-10 col-sm-12">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"><?php echo __('Ajouter une commande'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row col-lg-2 col-md-10 col-sm-12 headercomm" style="margin-left: 0%;margin-top: 0%;float: none;background: #fff;border-top-left-radius: 8px;border-bottom-left-radius: 8px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.27) !important;">
            <?php
            //debug($offres);
            $i = 0;
            $j = 0;
            foreach ($offres as $value) {
                ?>
                <div class="col-md-12 offre<?php echo $i; ?>" style="padding: 6px 0px;">
                    <input type="checkbox" id="name<?php echo $i; ?>" onclick="checkit(<?php echo $i; ?>)" value="0" class="checkit<?php echo $i; ?>" style="margin-top: 2px;float: left;width: 18px;height: 18px;">
                    <b style="font-size: 15px;"><?php echo $value['Offre']['titre']; ?></b>
                </div>
                <div class="col-md-12 showit<?php echo $i; ?>" style="display:none;">
                    <?php
                    if (isset($value['Offrespicial'])) {

                        foreach ($value['Offrespicial'] as $offre) {
                            ?>
                            <div class="col-md-12 shown">
                                <div class="col-xs-3">
                                    <?php foreach ($produits as $value) :
                                        if ($offre['produit_id'] == $value['Produit']['id']):
                                            ?>
                                            <input name="data[<?php echo $i; ?>][Offrespicial][produit_id]" type="hidden" value="<?php echo $value['Produit']['id']; ?>">
                                            <span class="prname"><?php echo $value['Produit']['name']; ?></span>
                <?php endif;
            endforeach; ?>
                                </div>
                                <div class="col-xs-2">
                                    <big class="prix<?php echo $i; ?>" id="<?php echo round($offre['Produit']['prix'], 2); ?>"><?php echo round($offre['Produit']['prix'], 2) . " DH"; ?></big>
                                </div>
            <?php echo $this->Form->input('quantite', array('type' => 'number', 'label' => false, 'id' => 'qte' . $i, 'value' => $offre['quantite'], 'min' => $offre['quantite'], 'name' => "data[$i][Offrespicial][quantite]", 'required' => "required", 'placeholder' => 'qte min = ' . $offre['quantite'], 'class' => 'form-control qte' . $i, 'onkeyup' => "calcultotale($i," . round($offre['Produit']['prix'], 2) . "," . $offre['reduction'] . ",this.value," . $offre['quantite'] . ",event)", 'onchange' => "calcultotale($i," . round($offre['Produit']['prix'], 2) . "," . $offre['reduction'] . ",this.value,null,event)", 'div' => array('class' => 'col-xs-3'))); ?>
                                <div class="col-xs-2">
                                    <big class=""><?php echo $offre['reduction'] . " %"; ?></big>
                                </div>
                                <div class="col-xs-2">
                                    <big class="totaler totale<?php echo $i; ?>" value="<?php echo round($offre['Produit']['prix'] * $offre['quantite'] * (1 - ($offre['reduction'] / 100)), 2); ?>"><?php echo round($offre['Produit']['prix'] * $offre['quantite'] * (1 - ($offre['reduction'] / 100)), 2) . " DH"; ?></big>
                                </div>
                                <input type="hidden" name="data[<?php echo $i; ?>][Offrespicial][prix]" class="totale prixht<?php echo $i; ?>" value="<?php echo round(($offre['Produit']['prix'] * $offre['quantite']), 2); ?>">
                                <b></b>
                                <?php
                                $i++;
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
        </div>
		
		<?php
		echo $this->Form->create('Commande');
		echo $this->Form->hidden('client_id', array('value' => $client_id));
		?>
		<div class="col-lg-2 col-md-10 col-sm-12 headerresult" style="margin-left: 64%;margin-top: 0%;float: right;z-index: 0;position: fixed;background: #fff;border-top-right-radius: 8px;border-bottom-right-radius: 8px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.27) !important;padding-right: 9px;">
			<div class="col-md-12" style="padding-left: 27%;padding-right: 0%;padding-top:8px;">
				<div class="input select">
					<label for="ClientCategoryId" style="margin:0;">Type paiement</label>
					<select name="data[Commande][paiement]" class="form-control" id="ClientCategoryId">
						<option value="Chèque">Chèque</option>
						<option value="Espèce">Espèce</option>
					</select>
				</div>
				<div class="input select">
					<input type="checkbox" name="data[Commande][surplace]" value="<?php echo "surplace"; ?>" class="flat-red" onclick="remise();">
					Réduction 2%
				</div>
			</div>
			<div class="col-md-12" style="padding-left: 27%;padding-right: 0%;">
				<div class="col-md-12" style="border-bottom:1px solid #ccc;padding: 0px 5px;">
					<label style="width:100%;margin:0;">Totale TTC</label>
					<big class="totalettc" style="width: 100%;float: left;min-height: 20px;">00.00 DH</big>
				</div>
				<div class="col-md-12" style="padding: 0px;">
					<label style="width:100%;margin:0;">Totale TTC avec remise</label>
					<big class="totaleremise" style="width: 100%;float: left;min-height: 20px;">00.00 DH</big>
				</div>
				<div class="well text-center col-md-12 col-lg-12 col-sm-12" style="float:left;"><input class="btn btn-primary btn-sm" type="submit" value="Envoyer"></div>
            </div>
		</div>
            <div class="col-lg-9 col-md-10 col-sm-12 bodycomm" id="bodycomm" style="padding-bottom:80px;">
                <div class="panel panel-primary">
                    <div class="panel-body form-horizontal payment-form">
                        <div class="row col-md-12">
                            <div class="col-xs-3">
                                <label>Produit </label>
                            </div>
                            <div class="col-xs-2">
                                <label>Prix U.I </label>
                            </div>
                            <div class="col-xs-3">
                                <label>Quantité </label>
                            </div>
                            <div class="col-xs-2">
                                <label>Remise % </label>
                            </div>
                            <div class="col-xs-2">
                                <label>Total HT </label>
                            </div>
                        </div>
                        <div class="row col-md-12 result" id="result" style="float: left;">
                        </div>
<?php
$j = $i++;
foreach ($produits as $value) {
    ?>
                            <div class="row comm comm<?php echo $j; ?> col-md-12" style="float:left;">
                                <div class="col-xs-3 productname" style="height:64px;">
                                    <input type="hidden" name="data[<?php echo $j; ?>][Offrespicial][produit_id]" value="<?php echo $value['Produit']['id']; ?>">
                                    <span><?php echo $value['Produit']['name']; ?></span>
                                </div>
                                <div class="col-xs-2" style="height:45px;">
                                    <big class="totalui ui<?php echo $j; ?>" value="<?php echo round($value['Produit']['prix'], 2); ?>"><?php echo round($value['Produit']['prix'], 2); ?> DH </big>
                                </div>
    <?php echo $this->Form->input('quantite', array('type' => 'number', 'name' => "data[$j][Offrespicial][quantite]", 'value' => "0", 'min' => '0', 'placeholder' => 'Quantité', 'class' => "form-control prodq qten$j", 'label' => false, 'onkeyup' => "calcultotalp($j,this.value,null,event)", 'onchange' => "calcultotalp($j,this.value,null,event)", 'div' => array('class' => 'col-xs-3', 'style' => 'height:45px;'))); ?>
                                <div class="col-xs-2" style="height:45px;">
                                </div>
                                <div class="col-xs-2" style="height:45px;">
                                    <big class="totalht ht<?php echo $j; ?>" value="00.00">00.00 DH </big>
                                    <input type="hidden" class="inputht<?php echo $j; ?>" name="data[<?php echo $j++; ?>][Offrespicial][prix]" value="00.00">
                                </div>
                            </div>
<?php } ?>
<?php //echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12 col-lg-12 col-sm-12', 'style' => 'float:left;'))); ?>
                    </div>
                </div>
            </div>
		</form>
     </div>
    </div>
    <script>
        var produits = {
<?php
foreach ($produits as $p) {
    echo '"' . $p["Produit"]["id"] . '":' . round($p["Produit"]["prix"], 2) . ',';
}
?>
            "0": 0};
        function checkit(id) {
            var b = $('.shown').length;
            var div = $(".showit" + id).html();
            var offre = $(".offre" + id + " b").text();
            var divinput = '<div class="divinput' + id + '" id="name' + id + '" style="border-bottom:1px solid #eee;float:left;padding-bottom:3px;margin-bottom:8px;"><b style="border-bottom:1px solid #eee;font-size:17px;padding-bottom:2px;"><i class="fa fa-tag"></i>' + offre + '</b><div style="margin-top:4px;width: 100%;float: left;">' + div + '</div></div>';
            var a = $(".checkit" + id).attr("id");
            var b = $(".divinput" + id).attr("id");
            if (a != b) {
                $('.result').append(divinput);
				searchhide();
			}
            if (a == b) {
                $('.divinput' + id).remove();
				searchshow();
            }
            alltotale();
        }
        function calcultotale(id, prix, reduction, qte, qtemin, evt) {
            var keyCode = evt.which ? evt.which : evt.keyCode;

            var numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            if (numbers.indexOf(qte) > -1 && keyCode == 8) {
                $('.qte' + id).val(null);
            }
            var r = reduction / 100;
            var rs = 1 - r;
            var tt = prix * qte * rs;
            var ttc = tt.toFixed(2);
            $('.totale' + id).text(ttc + ' DH');
            $('.totale' + id).attr("value", ttc);
            var ht = prix * qte;
            ht = ht.toFixed(2);
            $('.prixht' + id).val(ht);
            alltotale();
        }

        function calcultotalp(id, qten, qteminn, evt) {
            var b = $('.result .shown').length;
            var c = id - b;
            var keyCode = evt.which ? evt.which : evt.keyCode;

            var numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            if (numbers.indexOf(qten) > -1 && keyCode == 8) {
                $('.qten' + id).val(null);
                $('.ht' + id).text("00.00 DH");
                $('.ht' + id).val(0);
            }
            if (qten == null) {
                $('.ht' + id).text("00.00 DH");
            }
            var pui = $('.ui' + id).attr("value");
            var pht = pui * qten;
            var pht = pht.toFixed(2);
            $('.ht' + id).text(pht + " DH");
            $('.ht' + id).attr("value", pht);
            $('.inputht' + id).attr("value", pht);
            alltotale();
        }

        function alltotale() {
            var t = 0;
            var w = 0;
            var tr = $('input[type="number"]').length;//'.totaler'
            var tht = $('input[type="number"]').length;//'.totalht'
            var tttc = $('input[type="number"]').length;//'.totale'
            for (var i = 0; i < tttc; i++) {
                var a = $('.result .totale' + i).attr("value");
                var c = $('.result .prixht' + i).attr("value");
                if (a == null || c == null) {
                    a = 0;
                    c = 0;
                }
                t = t + parseFloat(a);
                w = w + parseFloat(c);
            }
            for (var i = 0; i < tht; i++) {
                var b = $('.bodycomm .ht' + i).attr("value");
                if (b == null) {
                    b = 0;
                }
                t = t + parseFloat(b);
                w = w + parseFloat(b);
            }
            t = t * 1.2;
            t = t.toFixed(2);
            $('.totaleremise').text(t + " DH");
            $('.totaleremise').attr("value", t);

            w = w * 1.2;
            w = w.toFixed(2);
            $('.totalettc').text(w + " DH");
            $('.totalettc').attr("value", w);
        }
		
		function searchhide()
		{
			for(i=0; i<$('.comm').length; i++)
			{	
				var tout = $('#bodycomm .comm:eq('+i+') span').text();
				tout = tout.toLowerCase();
				for(j=0; j<$('.result .shown').length; j++)
				{
					var result = $(".result .shown:eq("+j+") span").text();
					result = result.toLowerCase();
					if(tout.indexOf(result) !== -1)
					{	
						$('#bodycomm .comm:eq('+i+')').hide();
					}
				}
			}
        }
		
		function searchshow()
		{
			for(i=0; i<$('.comm').length; i++)
			{	
				$('#bodycomm .comm:eq('+i+')').show();
			}
        }
		function remise(val)
		{
			var vttr = $('.totaleremise').attr("value");
			var vttc = $('.totalettc').attr("value");
			var ttr = vttr;
			var ttc = vttc;
			if($('.flat-red').is(':checked') ){
				ttr = ttr/1.2;
				ttr = ttr*0.98;
				ttr = ttr*1.2;
				ttr = ttr.toFixed(2);
				ttc = ttc/1.2;
				ttc = ttc*0.98;
				ttc = ttc*1.2;
				ttc = ttc.toFixed(2);
				$('.totalettc').text(ttc+" DH");
				$('.totaleremise').text(ttr+" DH");
				$('.totalettc').attr("value", ttc);
				$('.totaleremise').attr("value", ttr);
			}else {		
				ttr = ttr/0.98;
				ttr = ttr.toFixed(2);	
				ttc = ttc/0.98;	
				ttc = ttc.toFixed(2);
				$('.totalettc').text(ttc+" DH");
				$('.totaleremise').text(ttr+" DH");
				$('.totalettc').attr("value", ttc);
				$('.totaleremise').attr("value", ttr);
			}
		}	
		window.onload = window.onresize = function () {
            var head = $('.headercomm').height();
            var widt = $('.bodycomm').width() + 40 + "px";
            var win = $(window).width();
            var header = -head + "px !important";
            $('.panel-heading').css({"width": widt});
            $('.bodycomm').attr("style", "margin-top:" + header +"; padding-bottom:"+ head +"px;");
            if (win <= 1024) {
                $('.bodycomm').attr("style", "margin-top: 0px !important;padding-bottom:20px;");
            }
        };
    </script>