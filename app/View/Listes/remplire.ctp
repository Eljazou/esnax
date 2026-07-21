<?php
echo $this->Html->script('jquery-2.2.3.min');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
 <?php echo $this->Html->css('dataTables.bootstrap'); 
	?>
<style>
    #sortable1, #sortable2 {
        border: 1px solid #eee;
        width: 49.5%;
        min-height: 100px;
        list-style-type: none;
        margin: 0 !important;
        padding: 5px 0 0 0 !important;
        float: left !important;
        margin-right: 2px !important;
        margin-top: 10px !important;
        margin-left: 2px !important;
        cursor:move;
    }
    #sortable1 li, #sortable2 li {
        margin: 0 5px 5px 5px;
        padding: 3px;
        font-size: 0.8em;
        width: 31%;
        float: left;
        border-radius:3px;
        border-color:transparent;
        cursor:move;
    }
    #sortable1 li{background:#1188c1;color: #fff;}
    #sortable2 li{background:#11905b;color:#fff;}
	.panel.panel-primary .well.text-center .btn-primary {
		float: right;
		margin-right: 4px;
	}
	.panel.panel-primary .well.text-center {
		padding-bottom: 22px !important;
		float:left;
	}
	.panel-body{
		padding: 0px !important;
	}
	@media and screen (max-width:900px){
		 #sortable1 li, #sortable2 li {
			width: 49%;
		 }
	}
	@media (min-width: 1200px){
		.col-lg-10 {
			width: 88% !important;
		}
	}
	@media (max-width: 1200px){
		.col-lg-10 {
			width: 97% !important;
		}
	}
	@media (max-width: 1093px){
		.col-lg-10 {
			width: 100% !important;
		}
		.panel-body{
			padding:0px !important;
		}
		#sortable1 li, #sortable2 li {
			width:47% !important;
			margin: 2px;
		}
		#sortable1, #sortable2 {
			width:49% !important;
		}
	}
	@media (max-width: 1093px){
		#sortable1, #sortable2 {
			width:49% !important;
			margin-right: 0px !important;
		}
	}
	tfoot{display: table-header-group !important;}
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
.disable {
    background: #555;
    cursor: not-allowed !important;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> -->
<script>
    /*$(function () {
        $("#sortable1, #sortable2").sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();
    });*/
</script>
<div class="panel panel-primary">
    <div class="panel-heading col-lg-10 col-md-10 col-sm-12">
        <h3 class="panel-title"><?php echo 'Remplire la liste : ' . $liste['Liste']['name'] . ' de ' . $liste['User']['name']; ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create(('Affectation'),array('id'=>'myForm'));
                    echo $this->Form->input('name', array('label' => 'Nom de la liste',"value"=>$name,'class' => 'form-control'));
                    ?>
                    <div class="input select">
                        <label for="ListeUserId">Régions</label>
                        <select  class="form-control" id="regions" required="required">
				<option value="">Choisissez la région</option>
                            <?php
                            foreach ($regions as $value) { ?>
                                <option value="<?php echo $value['Secteur']['region'] . '||' . $value['Secteur']['code_region']; ?>"><?php echo $value['Secteur']['region']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input select" id="ville">

                    </div>
                    <div id="secteur" class="input select" id="secteur">

                    </div>
                    <?php 
                    $java='';
                    foreach ($types as $k=>$v) 
                    {
                        $java=$java."if(ch==$k){
                                    var chn = \"$v\";
                            }";
                    } 
                    /*echo $this->Form->input('type_id', array('class' => 'form-control', 'onchange'=>'var ch = $(this).val();
		var co = $(".sortabl1 li").length;
		'.$java.'
		$(".sortabl1 li").hide();
		for(var i=0; i<co+1; i++){
			$(".sortabl1 ."+chn+i).show();
		}'));*/
                    echo $this->Form->hidden('liste_id', array('value' => $liste['Liste']['id']));
                    ?>
					<div class="col-md-12" style="padding: 10px 0px 0px 5px;">
						<b class="col-md-12" style="padding: 10px 0px 0px 16px;float:left;width:100%;">Liste sélectionnée</b>
					</div>
				<div class="col-md-12 table-responsive" style="padding:0px;float:left;width:100%;">
                    <table id="example1" class="col-lg-12 col-md-12 col-sm-12 table table-striped display">
						<thead>
							<tr>
								<th>Id</th>
								<th>Type</th>
								<th>Nom & Prénom</th>
								<th>activite</th>
								<th>Spécialité</th>
								<th>Potentialité</th>
								<th>Secteur</th>
								<th>Affecter</th>
								<th>Check <b></b></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Type</th>
								<th>Nom & Prénom</th>
								<th>activite</th>
								<th>Spécialité</th>
								<th>Potentialité</th>
								<th>Secteur</th>
								<th>Affecter</th>
								<th>Check</th>
							</tr>
						</tfoot>
						<tbody>
                        <?php 
                        $i=0;
                        foreach ($affectations as $value)
						{
							$typeclient="";
							foreach ($types as $k=>$v) 
							{
								if($value['Client']['type_id']==$k)
									$typeclient=$v;
							} 
							$catclient="";
							foreach ($categories as $k=>$v) 
							{
								if($value['Client']['category_id']==$k)
								{
									$catclient=$v;
									break;
								}
							} 
							$secclient="";
							foreach ($secteurs as $k=>$v) 
							{
								if($value['Client']['secteur_id']==$k)
								{
									$secclient=$v;
									break;
								}
							} 
                          echo '<tr class="item' . $value['Client']['id']. '">'
                            . '<td>'. $value['Client']['id'] .'</td><td>'.$typeclient.'</td><td>'. $value['Client']['nom'] . ' ' . $value['Client']['prenom'] . '</td>
							<td>' . $value['Client']['activite'] . '</td><td>' . $catclient . '</td><td>' . $value['Client']['potentialitev2'] . '</td><td>' . $secclient . '</td><td>Oui</td>
							<td><input name="data[client][]" type="checkbox" checked value="' . $value['Client']['id'] . '"><b style="visibility:hidden;font-size:0px;position:absolute;z-index:-1;">true</b></td>
							</tr>';
						}
                        ?>
						</tbody>
                    </table>
				</div>
                    <?php echo $this->Form->end(array('type'=>'button','OnClick'=>'envoyer();','label' => 'Envoyer', 'class' => 'btn btn-primary btn-large submit', 'div' => array('class' => 'well text-center col-lg-12 col-md-12 col-sm-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('jquery.dataTables.min'); ?>
<script>

	$(function () {
		$('#example1').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": false,
			"iDisplayLength": 300,
			//"aaSorting": [],
			"order": [[ 8, "asc" ]]
		});
	});
	
		
$(document).ready(function(){
		   // Setup - add a text input to each footer cell
		   if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
				$('#example1 tfoot').remove();
		   }else {
		   var conte = 0;		
		 $('#example1 tfoot th').each(function(){
			var title = $(this).text();
			$(this).html('<input type="text" placeholder="'+title+'" class="'+conte+' inputsearch"/>');
			conte = conte+1;
		});
	 
 // DataTable
    var table = $('#example1').DataTable();
	var ci = 0; 
	var setbg = setInterval(function(){
		table.$('tbody tr').each(function(){
			var id = $(this).find('td:eq(0)').text();
				if(id.indexOf("yes") > -1 ){
					id = id.replace('yes','');
					$(this).find('td:eq(0)').text(id);
					$(this).attr('style','background:rgb(253, 230, 29);');
					ci = ci+1;
				}
			});
					var tr = table.$('tbody tr').length;
					if(ci==tr)
					clearInterval(setbg);
		},100);
  /* Apply the search for individual columns*/
 table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
}		
		
        $("#regions").change(function () {
            var id = $("#regions").val();
            var image = "<center><img src='/img/loading.gif' style='width: 30px;' ></center>";
            $("#ville").empty();
            $(image).appendTo("#ville");
            $("#ville").show();
            $.post(
				'/secteurs/system_get_ville/' + id+'/0/0/<?php echo $liste['Liste']['id']; ?>',
				{
					//id: $("#ChembreBlocId").val()
				},
				function (data)
				{
					$("#ville").empty();
					$(data).appendTo("#ville");
					$("#ville").show();
				},
				'text' // type
					
            );/**/
				var table = $('#example1').DataTable();
				var notcheck = table.$("input:not(:checked)");
				notcheck.each(function(){
					$(this).parent().parent().addClass("select");
					table.row('.select').remove().draw();
				});
        });
		var s_option = '<option selected>Sélectionnez</option>'
		$("#AffectationTypeId").prepend(s_option);
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
				console.log('mobile');
		   }else {
		setTimeout(function(){
			var table = $('#example1').DataTable();
			var check = table.$("input:checkbox:checked");	
			var ncheck = check.length;
			$("th:eq(8) b").text("");
			$("th:eq(8) b").text(ncheck);
					if(ncheck<=70)
					$("thead th:eq(8) b").css("color", "black");
			if(ncheck>70 && ncheck<=80)
					$("thead th:eq(8) b").css("color", "#fde61d");
				if(ncheck>80)
					$("thead th:eq(8) b").css("color", "red");
		},600);
		}
});		
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
				console.log('mobile');
		   }else {
		setInterval(function(){
			var table = $('#example1').DataTable();
			var check = table.$("input:checkbox:checked");
			var ncheck = check.length;
				//alert(ncheck);
			$("thead th:eq(8) b").text("");
			$("thead th:eq(8) b").text(ncheck);
				if(ncheck<=70)
					$("thead th:eq(8) b").css("color", "black");
			if(ncheck>70 && ncheck<=80)
					$("thead th:eq(8) b").css("color", "#fde61d");
				if(ncheck>80)
					$("thead th:eq(8) b").css("color", "red");
		},100);
		}
	function envoyer(){
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
			var divimage = '<div class="row" style="z-index:9999;position: fixed;top:0px;left:0px;background:rgba(0,0,0,0.6);width:100%;height:100%;float: left;margin: 0px;"><center style="z-index:99999;position: absolute;top: 25%;width:100px;height:100px;border-radius:6px;box-shadow:0px 0px 5px #000;margin:auto;left: 48%;background: #fff;"><img src="/img/loading.gif" style="width: 40px;height:40px;margin-top: 28%;float: left;margin-left: 29%;"></center></div>';
			if($('#regions').val() != '' ){
				if($('#ville select').val() != '0'){
					if($('#secteurs').val() != '0'){
						$(".submit").addClass('disabled');
						$('body').prepend(divimage);
					}
				}
			}
			setTimeout(function(){console.log("attend")},500);
			var table = $('#example1').DataTable();
			var check = table.$("input:not(:checked)");
			check.each(function(){
				$(this).parent().parent().addClass("select");
				table.row('.select').remove().draw();
			});
			console.log('mobile');
			$(".submit").attr("type","submit");
			$(".submit").trigger('click');
		}else {
		var divimage = '<div class="row" style="z-index:9999;position: fixed;top:0px;left:0px;background:rgba(0,0,0,0.6);width:100%;height:100%;float: left;margin: 0px;"><center style="z-index:99999;position: absolute;top: 25%;width:100px;height:100px;border-radius:6px;box-shadow:0px 0px 5px #000;margin:auto;left: 48%;background: #fff;"><img src="/img/loading.gif" style="width: 40px;height:40px;margin-top: 28%;float: left;margin-left: 29%;"></center></div>';
		if($('#regions').val() != '' ){
			if($('#ville select').val() != '0'){
				if($('#secteurs').val() != '0'){
					$(".submit").addClass('disabled');
					$('body').prepend(divimage);
				}
			}
		}
		setTimeout(function(){console.log("attend")},500);
		var table = $('#example1').DataTable();
		var inputt = $('#example1 .inputsearch');
			inputt.each(function(){
				$(this).val('');
			});
			table.columns(0).search($(".0").val()).columns(1).search($(".1").val()).columns(2).search($(".2").val()).columns(3).search($(".3").val()).columns(4).search($(".4").val()).columns(5).search($(".5").val()).columns(6).search($(".6").val()).columns(7).search($(".7").val()).draw();
			var check = table.$("input:not(:checked)");
			check.each(function(){
				$(this).parent().parent().addClass("select");
				table.row('.select').remove().draw();
			});
			$(".submit").attr("type","submit");
			$(".submit").trigger('click');
		}
	}

		var clientid = [];
	function select(){
		var table = $('#example1').DataTable();
			var check = table.$("input:not(:checked)");
			check.each(function() {
				$(this).parent().parent().addClass("select");
			});
		var cid = table.$("input:checkbox:checked");
		
		var ncheck = cid.length;
		$("#exemple1 tr th:eq(8) b").text(ncheck);
 		cid.each(function(){
			$(this).parent().parent().removeClass('select');
			$(this).attr("value", function(index, value) {
				clientid.push(value);
			});
		});
		return clientid;
	}
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
				console.log('mobile');
		   }else {
	/**/var checkintervale = setInterval(function(){
		var table = $('#example1').DataTable();
		table.$("input[type='checkbox']").click(function(){
			var check = table.$("input:checkbox:checked");
			var ncheck = check.length;
			//alert(ncheck);
			$("th:eq(8) b").text("");
			$("th:eq(8) b").text(ncheck);
				if(ncheck<=70)
				$("thead th:eq(8) b").css("color", "black");
				if(ncheck>70 && ncheck<=80)
					$("thead th:eq(8) b").css("color", "#fde61d");
				if(ncheck>80)
					$("thead th:eq(8) b").css("color", "red");
		});
		incheck();
	},100);
	function incheck(){
		var table = $('#example1').DataTable();
		var check = table.$("input:checkbox:checked");
		var	ncheck = check.length;
		var checkb = table.$("input:checkbox");
		var dcheck = table.$('input:disabled');
		$("th:eq(8) b").text("");
		$("th:eq(8) b").text(ncheck);
				if(ncheck>=80) {
				//table.$("input[type='checkbox']").click(function(){
					checkb.each(function(){
						if($(this).not(':checked'))
						$(this).attr("disabled","disabled");
						if($(this).is(':checked'))
						$(this).removeAttr("disabled");
					});
				//});
					alert('Vous avez atteint le nombre maximum de clients');
					clearInterval(checkintervale);
				}
				if(ncheck<80){
					$("th:eq(8) b").text("");
					$("th:eq(8) b").text(ncheck);
					setInterval(function(){
						table.$('input:disabled').removeAttr("disabled");
					},100);
				}
			}
		}
	/*function search(val)
	{
		var vale = val.toLowerCase();
		ii = document.getElementById("sortable1");
		for(i=0; i<ii.getElementsByTagName('li').length; i++)
		{
			var hamza = ii.getElementsByTagName('li')[i].innerText.toLowerCase();
			ii.getElementsByTagName('li')[i].style.display = "none";
			if(hamza.indexOf(vale) !== -1)
			{
				ii.getElementsByTagName('li')[i].style.display = "block";
			}
		}
	}*/
	//t.rows.add( [["text1","text1","text1","text1","text1","text1"],[...]] ).draw();
	//Vous avez atteint le nombre maximum de clients
	//if(jQuery.inarray(data[i][0],clientid))
</script>