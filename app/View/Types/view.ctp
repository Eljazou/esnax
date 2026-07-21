<?php echo $this->Html->css('dataTables.bootstrap');?>	
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <p class="text-muted text-center" style="font-size:18px;"><?php echo $type['Type']['name']; ?></p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nombre de clients</b> <a class="pull-right"><?php echo count($type['Client']); ?></a>
                        </li>

                    </ul>
                    <a href="<?php echo $this->Html->url(array('action' => 'edit', $type['Type']['id'])); ?>" class="btn btn-primary btn-block"><b>Editer</b></a>
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Potentialité des clients</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
				<div class="box-body">
                    <div id="bar-chart1" style="height: 300px;"></div>
                </div>
                <!-- /.box-body-->
            </div>
        </div>
    </div>    
</section>
<?php if (!empty($type['Client'])): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Liste des clients</h3>
                </div>
                <div class="box-body table-responsive no-padding" style="height: 375px;overflow-y: scroll;overflow-x: hidden;padding: 0px 0px 50px 0px !important;">
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('ccrm'); ?></th>
                                <th><?php echo __('Nom'); ?></th>
                                <th><?php echo __('Type'); ?></th>
                                <th><?php echo __('Code'); ?></th>
								<th><?php echo __('Secteur'); ?></th>
								<th><?php echo __('FIXE'); ?></th>
								<th><?php echo __('GSM'); ?></th>
                                <th><?php echo __('Activié'); ?></th>
                                <th><?php echo __('Exercice'); ?></th>
                                <th><?php echo __('Spécialité '); ?></th>
								<th><?php echo __('Pot'); ?></th>
                            </tr>
						</thead>
						<tbody>
                            <?php
                            $i = 0;
                            $nbmedcin = 0;
							$pot=array();
                            // debug($type['Client']);
                            foreach ($type['Client'] as $client):
								
                                $nbmedcin++;
								if(!isset($pot[$client['potentialite']]))
									$pot[$client['potentialite']]=0;
								$pot[$client['potentialite']]=$pot[$client['potentialite']]+1;
                                
                                ?>
                                <tr>
									<td><?php echo $client['id']; ?>&nbsp;</td>
                                    <td><?php echo $this->Html->link($client['nom'] . " " . $client['prenom'], array('controller' => 'clients', 'action' => 'view', $client['id'])); ?>&nbsp;</td>
									<td><?php echo $client['type_pharmacie']; ?>&nbsp;</td>
									<td><?php echo $client['code_wavsoft']; ?>&nbsp;</td>
									<td><?php echo $secteurs[$client['secteur_id']];?>&nbsp;</td>
									<td><?php echo $client['fixe'];?>&nbsp;</td>
									<td><?php echo $client['tel'];?>&nbsp;</td>
									<td><?php echo $client['activite']; ?>&nbsp;</td>
									<td><?php echo $client['exercice']; ?>&nbsp;</td>
									<td><?php if(isset($categories[$client['category_id']])) echo $categories[$client['category_id']]; ?>&nbsp;</td>
									<td><?php echo $client['potentialite']; ?>&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
<?php endif; ?>
<?php
echo $this->Html->script('jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('app.min');
        echo $this->Html->script('jquery.dataTables.min');
        echo $this->Html->script('jquery.slimscroll.min');
        echo $this->Html->script('fastclick');
        echo $this->Html->script('demo'); 
?>
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
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ]
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawVisualization1);

    

    function drawVisualization1() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Potentialité V1', 'Nombre de clients'],
            <?php
			foreach ($pot as $k=>$v)
				echo "['$k',$v],"; ?>
            
        ]);

        var options = {
            'legend': 'top',
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('bar-chart1'));
        chart.draw(data, options);
    }
</script>

<script>

    /* END BAR CHART */
</script>