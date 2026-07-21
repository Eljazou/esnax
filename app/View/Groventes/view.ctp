<?php

echo $this->Html->css('dataTables.bootstrap');
		?>	
<style>
thead tr th{font-size: 15px;font-weight: 600;padding:5px 3px !important;}
</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title" style="font-size:24px;"><?php echo __('Sorti'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
			<tr>
				<th>Grossiste</th>
				<th>VM</th>
				<th>Produit</th>
				<th>Quanitité</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php $i=0; foreach ($ventes as $p):  ?>
			<tr>
				<td><?php echo $p["Grosiste"]["name"]; ?></td>
				<td><?php echo $p["User"]["name"]; ?></td>
				<td><?php echo $p["Groproduit"]["name"]; ?></td>
				<td class="q<?php echo $i; ?>"><span class="<?php echo $p['Grovente']['quantite']; ?>" id="<?php echo $p['Grovente']['id']; ?>" style="cursor:pointer;" <?php 
				if($p['Grovente']['user_id']==AuthComponent::user('id') ||AuthComponent::user('role') == 'Super viseur' || AuthComponent::user('role') == 'Admin') echo 'onclick="changenbr('.$i.')"'; ?>
				
				><b class="btn btn-primary"><?php echo $p['Grovente']['quantite']; ?></b></span></td>
				<td><?php echo $p['Grovente']['date']; ?></td>
			</tr>
		<?php $i++; endforeach; ?>
		</tbody>
    </table>
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
<script>
	
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
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
			}
        });
    });
	function changenbr(i){
		var id = $(".q"+i+" span").attr("id");
		var value = $(".q"+i+" span").attr("class");
		var forme = '<?php  echo $this->Form->create("Grovente",array("action"=>"edit")); ?><input type="hidden" name="data[Grovente][id]" value="'+id+'"/><input name="data[Grovente][quantite]" type="number" value="'+value+'" class="col-md-2" min="0"/><button type="submit" class="fa fa-check-square-o btn btn-primary" style=" margin-left: 4px; "></button></form>';
		$(".q"+i).empty();
		$(".q"+i).html(forme);
	}
</script>