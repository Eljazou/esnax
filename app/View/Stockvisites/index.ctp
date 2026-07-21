<?php echo $this->Html->css('dataTables.bootstrap');
        echo $this->Html->css('btn-style');
		?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
	.sv-wrapper{
		font-family:'Poppins',sans-serif;
		color:#3a3a4a;
	}
	.sv-wrapper .box{
		background:#fff;
		border-radius:18px;
		border:none;
		box-shadow:0 4px 24px rgba(108,99,245,0.08);
		padding:28px 30px;
		margin-bottom:24px;
	}
	.sv-wrapper .box-header{
		display:flex;
		align-items:center;
		gap:14px;
		padding:0 0 22px 0;
		border:none;
	}
	.sv-wrapper .box-header .sv-icon-badge{
		width:48px;
		height:48px;
		min-width:48px;
		border-radius:14px;
		background:linear-gradient(135deg,#efeeff,#e3e0ff);
		display:flex;
		align-items:center;
		justify-content:center;
	}
	.sv-wrapper .box-header .sv-icon-badge svg{
		width:24px;
		height:24px;
		stroke:#6C63F5;
	}
	.sv-wrapper .box-title{
		font-size:22px;
		font-weight:600;
		color:#2d2b45;
		margin:0;
	}
	.sv-wrapper .box-subtitle{
		font-size:13.5px;
		color:#9a97b3;
		margin-top:2px;
	}
	.sv-wrapper label{
		font-weight:600;
		font-size:14px;
		color:#4a4863;
		margin-bottom:6px;
	}
	.sv-wrapper .form-control{
		border-radius:12px;
		border:1.5px solid #e7e5f7;
		padding:11px 16px;
		font-size:14.5px;
		height:auto;
		box-shadow:none;
		transition:border-color .15s ease, box-shadow .15s ease;
	}
	.sv-wrapper .form-control:focus{
		border-color:#8c7ef2;
		box-shadow:0 0 0 3px rgba(140,126,242,0.15);
	}
	.sv-wrapper .sv-form-row{
		display:flex;
		gap:24px;
		flex-wrap:wrap;
	}
	.sv-wrapper .sv-form-row > div{
		flex:1;
		min-width:220px;
	}
	.sv-wrapper .sv-field-icon{
		display:inline-flex;
		align-items:center;
		justify-content:center;
		width:36px;
		height:36px;
		border-radius:10px;
		background:#f1effe;
		margin-right:10px;
	}
	.sv-wrapper .sv-field-icon svg{
		width:16px;
		height:16px;
		stroke:#6C63F5;
	}
	.sv-wrapper .sv-field-label{
		display:flex;
		align-items:center;
	}
	.sv-wrapper .marl{
		display:flex;
		align-items:center;
		gap:14px;
		padding:16px 18px;
		border-radius:14px;
		background:#faf9ff;
		border-left:4px solid #d8d5f0;
		margin-bottom:14px;
		margin-top:0;
	}
	.sv-wrapper .marl.etat-rouge{border-left-color:#e6524d;}
	.sv-wrapper .marl.etat-vert{border-left-color:#3fb37f;}
	.sv-wrapper .marl.etat-jaune{border-left-color:#e6b93d;}
	.sv-wrapper .marl.etat-orange{border-left-color:#e68a3d;}
	.sv-wrapper .marl .sv-pin{
		width:38px;
		height:38px;
		min-width:38px;
		border-radius:50%;
		display:flex;
		align-items:center;
		justify-content:center;
	}
	.sv-wrapper .marl.etat-rouge .sv-pin{background:#fce9e8;}
	.sv-wrapper .marl.etat-vert .sv-pin{background:#e6f6ee;}
	.sv-wrapper .marl.etat-jaune .sv-pin{background:#fdf5e0;}
	.sv-wrapper .marl.etat-orange .sv-pin{background:#fdece0;}
	.sv-wrapper .marl .sv-pin svg{width:18px;height:18px;}
	.sv-wrapper .marl.etat-rouge .sv-pin svg{stroke:#e6524d;}
	.sv-wrapper .marl.etat-vert .sv-pin svg{stroke:#3fb37f;}
	.sv-wrapper .marl.etat-jaune .sv-pin svg{stroke:#e6b93d;}
	.sv-wrapper .marl.etat-orange .sv-pin svg{stroke:#e68a3d;}
	.sv-wrapper .marl h4{
		margin:0;
		font-size:14.5px;
		font-weight:500;
		color:#454358;
	}
	.sv-wrapper .box-footer{
		background:transparent;
		border:none;
		padding:24px 0 0 0;
	}
	.sv-wrapper .btn.bg-purple{
		width:100%;
		background:linear-gradient(90deg,#6C63F5,#8c7ef2);
		border:none;
		border-radius:999px;
		padding:14px 0;
		font-size:15.5px;
		font-weight:600;
		letter-spacing:.2px;
		box-shadow:0 6px 18px rgba(108,99,245,0.3);
		transition:transform .15s ease, box-shadow .15s ease;
	}
	.sv-wrapper .btn.bg-purple:hover{
		transform:translateY(-1px);
		box-shadow:0 8px 22px rgba(108,99,245,0.38);
	}
	.sv-wrapper .well{
		background:transparent;
		border:none;
		box-shadow:none;
		padding:0;
	}
	.sv-wrapper #map-canvas{
		border-radius:16px;
		overflow:hidden;
		border:1px solid #ece9fb;
	}
	.sv-wrapper .tb tr th,.sv-wrapper .tb tr td{
		text-align:left;
		font-size:15px;
		border-color:#eeecf9;
	}
	.sv-wrapper .tb tr th{
		width:112px;
		color:#6a6785;
		font-weight:600;
	}
	.sv-wrapper .table.table-bordered.table-striped{
		border:1px solid #eeecf9;
		border-radius:12px;
		overflow:hidden;
	}
	.sv-wrapper table.dataTable thead th{
		background:#faf9ff;
		color:#4a4863;
		font-weight:600;
		font-size:13.5px;
		border-bottom:2px solid #ece9fb;
	}
	.sv-wrapper table.dataTable tbody td{
		font-size:14px;
		color:#454358;
		vertical-align:middle;
	}
	.sv-wrapper table.dataTable.table-striped tbody tr.odd{
		background:#fbfaff;
	}
	.sv-wrapper .btn-danger.btn-xs{
		border-radius:999px;
		background:#f4544e;
		border:none;
		padding:4px 12px;
		font-size:12px;
	}
	.sv-wrapper .modal-content{
		border-radius:16px;
		border:none;
	}
	.sv-wrapper .modal-header{
		border-bottom:1px solid #eeecf9;
	}
	.sv-wrapper .modal-title{
		font-weight:600;
		color:#2d2b45;
	}
	.sv-wrapper .dt-buttons .btn{
		border-radius:999px;
		background:#f1effe;
		color:#6C63F5;
		border:none;
		font-weight:600;
		font-size:13px;
		padding:6px 16px;
	}
</style>
<div class="sv-wrapper">
<div class="box">
      <div class="box-header table-responsive">
           <div class="sv-icon-badge">
			   <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
		   </div>
		   <div>
			   <h3 class="box-title">Stock visites</h3>
			   <div class="box-subtitle">Recherchez les niveaux de stock d'un produit</div>
		   </div>
      </div>
	<div class="box-body">
		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="font-size: 23px;" id="exampleModalLabel">Stock visites</h5>
				<button type="button" style="margin-top: -28px;" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="contents">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			</div>
			</div>
		</div>
		</div>
		<!-- fin div modal -->
		<div class="card-body">
				<?php echo $this->Form->create('Stockvisite');
				echo $this->Form->input('produit_id',array('class'=>'form-control'));
			?>
			<div class="sv-form-row">
				<?php echo $this->Form->input('quantite_min',array("label"=>"Quantité minimal",'class'=>'form-control'));
				echo $this->Form->input('quantite_max',array("label"=>"Quantité maximal",'class'=>'form-control'));
			?>
			</div>
		</div>
		<div>
		<div class="box box-warning direct-chat direct-chat-warning" style="margin-top:20px;box-shadow:none;padding:20px 22px;">
			<div class="box-header with-border" style="padding-bottom:16px;">
				<div class="sv-icon-badge" style="width:38px;height:38px;min-width:38px;">
					<svg viewBox="0 0 24 24" fill="none" stroke="#6C63F5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
				</div>
				<h3 class="box-title" style="font-size:18px;">Informations</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="marl etat-rouge">
							<span class="sv-pin"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
							<?php echo $this->Html->image("marker/rouge",array('style'=>'display:none'));?>
							<h4>Quantité &lt; 4</h4>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="marl etat-vert">
							<span class="sv-pin"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
							<?php echo $this->Html->image("marker/vert",array('style'=>'display:none'));?>
							<h4>Quantité &gt; 4 rempli il y a moins de 15j</h4>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="marl etat-jaune">
							<span class="sv-pin"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
							<?php echo $this->Html->image("marker/jaune",array('style'=>'display:none'));?>
							<h4>Quantité &gt; 4 rempli entre 15j et 30j</h4>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="marl etat-orange">
							<span class="sv-pin"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
							<?php echo $this->Html->image("marker/orange",array('style'=>'display:none'));?>
							<h4>Quantité &gt; 4 rempli il y a plus de 30j</h4>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		</div>
		<div class="box-footer">
		<?php echo $this->Form->end(array('label' => 'Rechercher','class'=>'btn bg-purple btn-flat','div' => array('class' => 'well text-center'))); ?>

		</div>

		<div id="map-canvas" class="col-md-12" style="height: 680px;"></div>
	<?php $i=0;foreach ($stockvisites as $stockvisite):
			$etat="";
			$days = (time() - strtotime($stockvisite['Stockvisite']['created'])) / (60 * 60 * 24);
			$span="";
			if($stockvisite['Stockvisite']['quantite']<4){$etat= "Rouge";$span="red";}
			else if($days<15){$etat= "Vert";$span="green";}
			else if($days<30){$etat= "Jaune";$span="yellow";}
			else if($days>30){$etat= "Orange";$span="orange";}
	?>
	<div class="<?php echo $i;?>" style="display:none">
	    <div class="row r<?php echo $i;?>">
			<div class="col-md-12">
				<table class="table table-bordered table-striped tb">
					<tr>
						<th>Produit</th>
						<td><?php echo $stockvisite['Produit']['name']; ?>&nbsp;</td>
					</tr>
					<tr>
						<th>Client</th>
						<td><?php  echo $this->Html->link(h($stockvisite['Client']['nom']),array("controller"=>"clients","action"=>"view",$stockvisite['Client']['id'])); ?>&nbsp;</td>
					</tr>
					<tr>
						<th>VM</th>
						<td><?php echo $stockvisite['User']['name']; ?>&nbsp;</td>
					</tr>
					<tr>
						<th>Quantité</th>
						<td><?php echo h($stockvisite['Stockvisite']['quantite']); ?>&nbsp;</td>
					</tr> 
					<tr>
						<th>Date</th>
						<td><?php echo h($stockvisite['Stockvisite']['created']); ?>&nbsp;</td>
					</tr>
					<tr>
						<th>Type</th>
						<td><?php echo h($stockvisite['Stockvisite']['type']); ?>&nbsp;</td>
					</tr>
					<tr>
						<th>N° Jour</th>
						<td><?php echo round($days,0); ?>&nbsp; Jour</td>
					</tr>
					<tr>
						<th>Commentaire</th>
						<td><?php echo h($stockvisite['Stockvisite']['commentaire']); ?>&nbsp;</td>
					</tr>
					<?php $stockvisites[$i]['Stockvisite']["etat"]=$etat; ?>
				</table>
			</div>		
		</div>
	</div>
<?php $i++; endforeach; ?>
	</div>
<div class="box">
      <div class="box-header table-responsive">
           <div class="sv-icon-badge">
			   <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="9" x2="9" y2="21"/></svg>
		   </div>
		   <h3 class="box-title"><?php echo __('Stockvisites'); ?></h3>
      </div>
	<div class="box-body">
         <table id="example1" class="table table-bordered table-striped">
		 <thead>
			<tr>
				<th>L</th>
				<th>VM</th>
				<th>Client</th>
				<th>Secteur</th>
				<th>Produit</th>
				<th>Quantité</th>
				<th>Commentaire</th>
				<th>Type</th>
				<th>Etat</th>
				<th>Date</th>
				<th>#</th>
			</tr>
	</thead>
	<?php foreach ($stockvisites as $stockvisite): ?>
	<tr>
		<td><?php if($stockvisite['Client']['latitude']==null || $stockvisite['Client']['latitude']=="0") echo "<span style='color:red'> P </span>";  ?>&nbsp;</td>
		<td><?php echo h($stockvisite['User']['name']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(h($stockvisite['Client']['nom']),array("controller"=>"clients","action"=>"view",$stockvisite['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo $secteurs[$stockvisite['Client']['secteur_id']]; ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Produit']['name']); ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Stockvisite']['quantite']); ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Stockvisite']['commentaire']); ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Stockvisite']['type']); ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Stockvisite']['etat']); ?>&nbsp;</td>
		<td><?php echo h($stockvisite['Stockvisite']['created']); ?>&nbsp;</td>
		<td><?php if ($this->requestAction('/droits/getrole/stockvisites/supprimer') == 1)
                     echo $this->Html->link('Sup', array( 'action' => 'supprimer', $stockvisite['Stockvisite']["id"]), array( 'class' => 'btn btn-danger btn-xs'));?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	</div>
	</div>


	</div>
</div>
	<?php echo $this->Html->script('jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('app.min');
        echo $this->Html->script('jquery.dataTables.min');
        echo $this->Html->script('jquery.slimscroll.min');
        echo $this->Html->script('fastclick');
        echo $this->Html->script('demo');
        ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q&amp;"></script>
<script>
  $(function () {
    $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
			dom: 'Bfrtip',
			buttons: [
				 'excel'
			]
        });
  });
  function initialize() {
    var mapOptions = {
    zoom: 6,
    center: new google.maps.LatLng(31.79,-7.08)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var loca = <?php echo json_encode($stockvisites,512, JSON_UNESCAPED_UNICODE); ?>;
for (let index = 0; index < loca.length; index++) 
{
	var marker = new google.maps.Marker({
		position : new google.maps.LatLng(loca[index]['Client']['latitude'],loca[index]['Client']['longitude']),
		map: map,
		label:{
			text:""+loca[index]['Stockvisite']['quantite'],
			color: 'black',
		},
		title:loca[index]['Client']['nom']+" | "+loca[index]['Stockvisite']['quantite'],
		icon: {
		url: "<?php $this->Html->url('/', true)?>img/marker/"+loca[index]['Stockvisite']["etat"].toLowerCase()+".png",
		scaledSize: new google.maps.Size(45, 45),
		labelOrigin: new google.maps.Point(22, 13)
		}
	});
	google.maps.event.addListener(marker, 'click', (function(marker, index) {
     return function() {
		$("#contents div").remove();
		$("#contents").append($(".r"+index).clone());
      $("#exampleModal").modal("show");
    }
 })(marker, index)); 	  
}  
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
