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
                    <th>Nom & prénom</th>
                    <th>Dirigent</th>
					<th>Region</th>
					<th>Ville</th>
                    <th>Secteur</th>
					<th>Adresse</th>
                    <th>tel</th>
                    <th>fix</th>
                    <th>fax</th>
                    <th>mail</th>
                    <th>date d'ajout</th>
                </tr>
            </thead>
           <tfoot>
                <tr>
					<th>Code</th>
                    <th>Nom & prénom</th>
                    <th>Dirigent</th>
					<th>Region</th>
					<th>Ville</th>
                    <th>Secteur</th>
					<th>Adresse</th>
                    <th>tel</th>
                    <th>fix</th>
                    <th>fax</th>
                    <th>mail</th>
                    <th>date d'ajout</th>
                </tr>
           </tfoot>
<?php foreach ($p as $client): ?>
                <tr>
					<td><?php  echo $client['Client']['id'];?></td>
                    <td><?php echo $client['Client']['nom']; ?>&nbsp;</td>
                    <td><?php echo $client['Client']['dirigent']; ?>&nbsp;</td>
					<?php 
					$region=$ville=$secteur="";
					foreach($s as $ss)
					{
						if($ss["Secteur"]["id"]==$client['Client']['secteur_id'])
						{
							$region=$ss['Secteur']['region'];
							$ville=$ss['Secteur']['ville'];
							$secteur=$ss['Secteur']['secteur'];
							break;
						}
					}					
					?>
					<td><?php echo $region; ?></td>
					<td><?php echo $ville; ?>&nbsp;</td>
                    <td><?php echo $secteur; ?></td>
                    <td><?php echo $client['Client']['adress'] ?></td>
					<td><?php echo h($client['Client']['tel']); ?>&nbsp;</td>
                    <td><?php echo h($client['Client']['fixe']); ?>&nbsp;</td>
                    <td><?php echo h($client['Client']['fax']); ?>&nbsp;</td>
                    <td><?php echo h($client['Client']['mail']); ?>&nbsp;</td>
                    <td><?php echo h($client['Client']['created']); ?>&nbsp;</td>
                    
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
            "iDisplayLength": 50000,
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

   
</script>
