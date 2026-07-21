<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
	@media (max-width:896px){
		.box-body{
			overflow: scroll;
			overflow-y: hidden;
		}
	}    
	.dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
	.dt-button:hover{color:#fff;background:#1a486f;}
</style>	
<?php //debug($clients);?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('La liste des clients'); ?></h3>
        
    </div>
    <div class="box-body" id="tabclient">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
					<th>VM</th>
					<th>N° Visite</th>
                    <th>Type</th>
                    <th>Nom & prénom</th>
                    <th>Region</th>
					<th>Ville</th>
					<th>Secteur</th>
                    <th>Spécialité</th>
					<th>Pot</th>
                    <th>Pot2</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
<?php $i=0; foreach ($clients as $client): 
 if (!empty($client['Client']['id'])){?>
                <tr>
					<td><?php  foreach($visites as $v)
							   {
								   if($v['temp_table']["client_id"]==$client['Client']['id'])
								   {
									   echo $v['temp_table']["name"];
									   break;
								   }
							   }
						?>
					</td>
					<td><?php echo $nombre;?></td>
                    <td><?php  if (!empty($client['Type']['name']))
					echo $this->Html->link($client['Type']['name'], array('controller' => 'types', 'action' => 'view', $client['Type']['id'])); ?></td>
                    <td><?php if (!empty($client['Client']['nom']))
					echo h($client['Client']['nom'] . ' ' . $client['Client']['prenom']); ?>&nbsp;</td>
                    <td><?php if (!empty($client['Secteur']['region']))
								echo $client['Secteur']['region'] ;?></td>
					<td><?php if (!empty($client['Secteur']['ville']))
								echo $client['Secteur']['ville'] ;?></td>
					<td><?php if (!empty($client['Secteur']['secteur']))
								echo $client['Secteur']['secteur'] ;?></td>
                    <td><?php 
					if (!empty($client['Client']['category_id']))
                        if ($client['Client']['category_id'] != null )
                            echo $this->Html->link($client['Category']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category']['id']));
                        else
					echo $this->Html->link($client['Category1']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category1']['id']));
                        ?>
                    </td>
					<td><?php echo $client['Client']['potentialite'];?></td>
                    <td><?php if(!empty($client['Client']['potentialitev2']))
								echo h($client['Client']['potentialitev2']); ?>&nbsp;</td>
					<!-- <td>&nbsp;</td> -->
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php if ($this->requestAction('/droits/getrole/clients/view') == 1)
                            echo $this->Html->link(__('Voir'), array('action' => 'view', $client['Client']['id']));
                        ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/clients/edit') == 1)
                            echo $this->Html->link(__('Editer'), array('action' => 'edit', $client['Client']['id']));
                        ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/clients/archive') == 1)
                            echo $this->Html->link(__('Archiver'), array('action' => 'archive', $client['Client']['id'], 0));
                        ?></li>
						<li><a style="cursor:pointer;" data-toggle="modal" data-target="#myModal<?php echo $i;?>">Afficher Brochures</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
				<div id="myModal<?php echo $i++;?>" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content" style="float:left;width:100%;">
							<div class="modal-header" style="float:left;width:100%;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Brochures</h4>
							</div>	
							<div class="modal-body" style="float:left;width:100%;">
								<?php $brochures=$this->requestAction("/brochures/system_get_temp_for_client/".$client['Client']['id']."/$date_debut/$date_fin");
								foreach($brochures as $b) 
								{
									echo "<span style='background: #105e8c;color: #fff;margin: 4px 2px;width:auto;float:left;padding: 2px 3px;'>".$this->Html->link($b['brochures']['name'], array('controller' => 'brochures', 'action' => 'view', $b['brochures']['id']),array('style'=>'color:#fff;padding: 2px 4px;float: left;'))."<span style='font-size:13px;background:#164561;color: #fff;padding: 2px 4px;float: left;line-height: 20px;'> (<b style='color:red;'>".$b[0]['nombre']."</b>)</span></span>";
								}
								?>
						  </div>
						  <div class="modal-footer" style="float:left;width:100%;">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						  </div>
						</div>
					</div>
				</div>
 <?php }
endforeach; ?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<script>
    /*$(document).ready(function () {
        $("#recherche").keyup(function () {
            var id = $("#recherche").val();
            if (id.length > 2)
            {
                var image = "<center><img src='/img/loading.gif' style='width: 50px;' ></center>";
                $("#tabclient").empty();
                $(image).appendTo("#tabclient");
                $("#tabclient").show();
                $.post(
                        '/clients/system_recherche/' + id + "/<?php //echo $inn; ?>",
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
    });*/
</script>
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
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
			dom: 'Bfrtip',
			buttons: [
				 'csv', 'excel', 'print'
			]
        });
    });
</script>