<?php echo $this->Html->css('dataTables.bootstrap');
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
echo $this->Html->css('daterangepicker');
?>	
<div class="row">
    <div class="col-md-12" style="margin-bottom: 24px;"> 
        <div class="box form-group">
            <div class="box-header with-border">
                <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;
                       font-weight: normal;width: auto;text-align:left;float:left;">
                    Pour des documents d'une période précise,veuillez sélectionner une date :
                </label>
                <div class="col-md-6">
                    <form action="<?php echo $this->Html->url(array("action" => "index", $user_id)); ?>" method="get" id="dateform">
                        <div class="input-group col-lg-12" style="float:left;">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
	<div class="col-md-12"> 
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Documents'); ?></h3>
				<?php echo $this->Html->link(__("Demande de document"), array('action' => 'add'), array('class'=>"btn bg-purple btn-flat margin",'style'=>'float:right;')); ?>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>User</th>
							<th>Besoin</th>
							<th>Document</th>
							<th>Etat</th>
							<th>Date de demande</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<?php foreach ($documents as $document): ?>
						<tr>
							<td><?php echo $this->Html->link($document['User']['name'], array('controller' => 'users', 'action' => 'view', $document['User']['id'])); ?></td>
							<td><?php echo h($document['Document']['description']); ?>&nbsp;</td>
							<td><?php echo h($document['Document']['document']); ?>&nbsp;</td>
							<td><?php
								if ($document['Document']['archive'] == 0)
									echo 'en cours de validation';
								else if ($document['Document']['archive'] == 1)
									echo 'en cours de préparation';
								else if ($document['Document']['archive'] == 2)
									echo 'Document prêt';
								else if ($document['Document']['archive'] == -1)
									echo 'Demande annulé';
								?>&nbsp;</td>
							<td><?php echo h($document['Document']['created']); ?>&nbsp;</td>
							<td class="actions">
								<?php if ($document['Document']['user_id'] == AuthComponent::user('id') && $document['Document']['archive'] == 1 &&
											$this->requestAction('/droits/getrole/documents/edit') == 1)
								{
									echo $this->Html->link(__('Editer'), array('action' => 'edit', $document['Document']['id']),array('class'=>'btn btn-primary','style'=>'margin-right:4px;'));
									echo $this->Html->link(__('Relance'), array('action' => 'system_relance', $document['Document']['id']),array('class'=>'btn btn-primary','style'=>'margin-right:4px;'));
								}?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<?php if (!empty($users)): ?>
				<div class="box-header">
					<h3 class="box-title">La liste des employés</h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Utilisateur</th>
								<th>Rôle</th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<?php
						$i = 0;
						foreach ($users['User'] as $u) :
							?>
							<tr>
								<td><?php echo $u["name"]; ?></td>
								<td><?php echo $u["role"]; ?></td>
								<td><?php echo $this->Html->link("Voir", array("action" => "index", $u["id"])); ?></td>
							</tr>        
							<?php
							$i++;
						endforeach;
						?>
					</table>
				</div>
			<?php endif; ?>
		</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    
    $(function () {
        $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " -- ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function (e) {
                this.updateInputText();
            }
        });
        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            var startDate = picker.startDate;
            var endDate = picker.endDate;
            var action = $('#dateform').attr('action');
            var date = action + "?date=" + startDate + "--" + endDate;
            $('#dateform').attr('action', date);
            $('#dateform').submit();
        });
    });

</script>