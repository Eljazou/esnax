<?php
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
?>
<div class="col-xs-12">
<div class="box">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
				<th>Liste</th>
                <th>Type</th>
                <th>Client</th>
                <th>Region</th>
                <th>Ville</th>
                <th>Secteur</th>
                <th>Spécialité</th>
                <th>Tendance</th>
                <th>POT</th>
                <th>Activite</th>
                <th>VM</th>
				<th>Ligne</th>
            </tr>
        </thead>
        <?php foreach ($data as $k=>$vv):
				$k=explode("--",$k);
				$nom_liste=$k[1];
				$k=$k[0];
                foreach ($vv["client"] as $v):  ?>
            <tr>
				<td><?php echo $nom_liste; ?>&nbsp;</td>
				<td><?php echo $types[$v['Client']['type_id']]; ?>&nbsp;</td>
                <td><?php echo $v['Client']['nom']." ".$v['Client']['prenom']; ?>&nbsp;</td>
                <?php 
				$region=$ville=$secteur="";
				foreach($secteurs as $s)
					{
						if($v['Client']['secteur_id']==$s["Secteur"]["id"])
						{
							$region=$s["Secteur"]["region"];
							$ville=$s["Secteur"]["ville"];
							$secteur=$s["Secteur"]["secteur"];
							break;
						}
					}?>
				<td><?php echo $region; ?>&nbsp;</td>
				<td><?php echo $ville; ?>&nbsp;</td>
				<td><?php echo $secteur; ?>&nbsp;</td>
                <td><?php echo $categories[$v['Client']['category_id']]; ?>&nbsp;</td>
				<td><?php if($v['Client']['category1_id']!="" && $v['Client']['category1_id']!=null)
							echo $categories[$v['Client']['category1_id']]; ?>&nbsp;</td>
                <td><?php echo $v['Client']['potentialite']; ?>&nbsp;</td>
                <td><?php echo $v['Client']['activite']; ?>&nbsp;</td>
                <td><?php echo $k; ?>&nbsp;</td>
				<td><?php 
					foreach($lignes as $ligne)
					{
						if($k==$ligne["users"]["name"])
						{
							echo $ligne["lignes"]["name"];
							break;
						}
					}?>&nbsp;</td>
            </tr>
        <?php endforeach; 
        endforeach;
        ?>
    </table>
</div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(function () {
        //$("#example1").DataTable();
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
        });
    });
</script>
