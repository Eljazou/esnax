<?php echo $this->Html->css('dataTables.bootstrap');?>
<style>
	@media (max-width:896px){
		.box-body{
			overflow: scroll;
			overflow-y: hidden;
		}
	}    
	.dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
	.dt-button:hover{color:#fff;background:#1a486f;}
	tfoot{display: table-header-group !important;}
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>	
<div class="row">
    <div class="col-lg-3 col-xs-6">
	<a href="<?php echo $this->Html->Url(array('action'=>'index')); ?>" style="color:#fff;text-decoration:none !important;">
      <div class="small-box bg-aqua">
        <div class="inner">
            <h3 id="nbmedcin"><?php echo $nb_clients; ?></h3>
            <p>N° Clients</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
	  </a>
    </div>
    <div class="col-lg-3 col-xs-6">
	<a href="<?php echo $this->Html->Url(array('action'=>'index','1')); ?>" style="color:#fff;text-decoration:none !important;">
      <div class="small-box bg-green">
        <div class="inner">
            <h3 id="visitetotal"><?php echo $nb_client_affecter; ?></h3>
          <p>N° clients affectés</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
	  </a>
    </div>
    <div class="col-lg-3 col-xs-6">
	<a href="<?php echo $this->Html->Url(array('action'=>'index','-1')); ?>" style="color:#fff;text-decoration:none !important;">
      <div class="small-box bg-red">
        <div class="inner">
          <h3 id="nbuser"><?php echo ($nb_clients - $nb_client_affecter); ?></h3>
          <p>N° Clients non affectés</p>
        </div>
        <div class="icon">
          <i class="ion ion-help"></i>
        </div>
      </div>
	  </a>
    </div>
	<?php if ($this->requestAction('/droits/getrole/clients/remettre0') == 1):?>
	<div class="col-lg-3 col-xs-6">
	<a href="<?php echo $this->Html->Url(array('action'=>'remettre0')); ?>" style="color:#fff;text-decoration:none !important;">
      <div class="small-box bg-red">
        <div class="inner">
          <h3 id="nbuser"><b class="btn btn-primary">Remettre à 0</b></h3>
          <p>Tout remettre à 0</p>
        </div>
        <div class="icon">
          <i class="ion ion-minus-circled"></i>
        </div>
      </div>
	  </a>
    </div>
	<?php endif; ?>
</div>
<?php //foreach ($types as $key => $value) :
//    $info=$this->requestAction("/clients/system_getcount_client/$key/$inn");
//    $info=  explode("||", $info);
//    $nb_clients=$info[0];
//    $nb_client_affecter=$info[1];
//    ?>
<!--<div class="row">
    <h3 >//<?php //echo $value; ?></h3>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
            <h3 id="nbmedcin">//<?php //echo $nb_clients; ?></h3>
            <a href="//<?php //echo $this->Html->Url(array('action'=>'index','0',$key)); ?>">ici</a>
            <p>N° Clients</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
            <h3 id="visitetotal">//<?php //echo $nb_client_affecter; ?></h3>
            <a href="//<?php //echo $this->Html->Url(array('action'=>'index','1',$key)); ?>">ici</a>
          <p>N° clients affectés</p>
        </div>

        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3 id="nbuser">//<?php //echo ($nb_clients - $nb_client_affecter); ?></h3>
          <a href="//<?php //echo $this->Html->Url(array('action'=>'index','-1',$key)); ?>">ici</a>
          <p>N° Clients non affectés</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>
</div>
<?php //endforeach; ?>-->
<div class="box input text" style="margin:10px 0px;">
    <div class="box-header"><h3 class="box-title" for="ClientMail">Recherche par client</h3></div>
    <div class="box-body">
		<div class="col-md-7"><input name="data[Client][mail]" class="form-control" type="text" id="recherche" placeholder="Recherche par client"></div></br></br>
		<div class="col-md-12" style="float:left;"><b id="search" class="btn btn-flat bg-blue" style="float:left;cursor:pointer;">Rechercher</b></div>
	</div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('La liste des clients'); ?></h3>
        <?php if ($this->requestAction('/droits/getrole/clients/add') == 1)
            echo $this->Html->link(__('Ajouter'), array('action' => 'add',"Médecin"), array("target"=>"_blanck",'class'=>"btn bg-purple btn-flat", 'style'=>"float:right;"));
        ?>
    </div>
    <div class="box-body" id="tabclient">
        <table id="example1" class="table table-bordered table-striped display">
            <thead>
                <tr>
					<th>Code</th>
                    <th>Type</th>
                    <th>Nom & prénom</th>
					<th>Activité</th>
					<th>Region</th>
					<th>Ville</th>
                    <th>Secteur</th>
                    <th>Spécialité</th>
					<th>Tendance</th>
					<th>Pot V1</th>
                    <th>Pot V2</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
           <tfoot>
                <tr>
					<th>Code</th>
                    <th>Type</th>
                    <th>Nom & prénom</th>
					<th>Activité</th>
					<th>Region</th>
					<th>Ville</th>
                    <th>Secteur</th>
                    <th>Spécialité</th>
					<th>Tendance</th>
					<th>Pot V1</th>
                    <th>Pot V2</th>
                    <th>Actions</th>
                </tr>
           </tfoot>
<?php foreach ($clients as $client): ?>
                <tr>
					<td><?php $typ=substr($client['Category']['name'], 0, 3);
							$typ = strtoupper($typ);
							echo $client['Secteur']["code_region"].$client['Secteur']["code_ville"].$client['Secteur']["code_secteur"].$typ.$client['Client']['id'];?>
					</td>
                    <td><?php echo $this->Html->link($client['Type']['name'], array('controller' => 'types', 'action' => 'view', $client['Type']['id']),array("target"=>"_blanck")); ?></td>
                    <td><?php echo $this->Html->link($client['Client']['nom'].' '.$client['Client']['prenom'], array('action' => 'view', $client['Client']['id']),array("target"=>"_blanck")); ?>&nbsp;</td>
					<td><?php echo h($client['Client']['activite']); ?>&nbsp;</td>
					<td><?php echo h($client['Secteur']['region']); ?>&nbsp;</td>
					<td><?php echo h($client['Secteur']['ville']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($client['Secteur']['secteur'], array('controller' => 'secteurs', 'action' => 'view', $client['Secteur']['id']),array("target"=>"_blanck")); ?></td>
                    <td><?php
                            echo $this->Html->link($client['Category']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category']['id']),array("target"=>"_blanck"));                            
                        ?>
                    </td>
					<td><?php echo $this->Html->link($client['Category1']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category1']['id']),array("target"=>"_blanck")); ?></td>
					<td><?php echo h($client['Client']['potentialite']); ?>&nbsp;</td>
                    <td><?php echo h($client['Client']['potentialitev2']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php if ($this->requestAction('/droits/getrole/clients/view') == 1)
                            echo $this->Html->link(__('Voir'), array('action' => 'view', $client['Client']['id']),array("target"=>"_blanck"));
                        ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/clients/edit') == 1)
                            echo $this->Html->link(__('Editer'), array('action' => 'edit', $client['Client']['id']),array("target"=>"_blanck"));
                        ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/clients/archive') == 1)
                            echo $this->Html->link(__('Archiver'), array('action' => 'archive', $client['Client']['id'], 0),array("target"=>"_blanck"));
                        ?></li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
//echo $this->Html->script('bootstrap.min');
//echo $this->Html->script('app.min');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<?php
echo $this->Html->script('jquery.dataTables.min');
//echo $this->Html->script('jquery.slimscroll.min');
//echo $this->Html->script('fastclick');
//echo $this->Html->script('demo');
?>

<!-- --><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script> 
<script>

    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			},
			dom: 'Bfrtip',
			buttons: [
				 'csv', 'excel', 'print'
			]
        });
    });
	$(document).ready(function () {
		     // Setup - add a text input to each footer cell
		   var conte = 0;		
		 $('#example1 tfoot th').each(function(){
			var title = $(this).text();
			$(this).html('<input type="text" placeholder="'+title+'" class="'+conte+'"/>');
			conte = conte+1;
		});
	 
 // DataTable
    var table = $('#example1').DataTable();
 
    // Apply the search
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
});

    $(document).ready(function () {
        $("#search").click(function () {
            var id = $("#recherche").val();
            if (id.length > 2)
            {
                var image = "<center><img src='/img/loading.gif' style='width: 50px;' ></center>";
                $("#tabclient").empty();
                $(image).appendTo("#tabclient");
                $("#tabclient").show();
				id = id.replace("/", "||");
                $.post(
                        '/clients/system_recherche/' + id+"/<?php echo $inn; ?>",
                        {
                            //id: $("#ChembreBlocId").val()
                        },
                        function (data)
                        {
                            $("#tabclient").empty();
                            $(data).appendTo("#tabclient");
                            $("#tabclient").show();
                        },
                        'text' // type
                        );
            }
        });
    });
</script>
