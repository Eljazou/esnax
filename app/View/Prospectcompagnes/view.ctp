<style type="text/css">
	th{
		text-align: left !important;
	}
</style>
<div class="box">
	<div class="box-header table-responsive">
<h2>Campagne <a href="#"> <?php echo $prospectcompagne['Prospectcompagne']['name'] ?></a>
&nbsp;&nbsp;
<?php echo $this->Html->link(__('Editer'), array('action' => 'edit',$prospectcompagne['Prospectcompagne']['id']), array('class'=>'btn btn-warning', 'style'=>'float:right;margin-left: 3px;'));
echo $this->Html->link(__('Générer une liste des appels'), array('action' => 'generer',$prospectcompagne['Prospectcompagne']['id']), array('class'=>'btn btn-info', 'style'=>'float:right;'));?>

</h2>
		 			
		 			
</div>
<div class="box-body">
	<div class="col-md-6">
		<table class="table table-striped">
	<tr>
		<th><?php echo __('Affaire'); ?></th>
		<td>
			<?php echo $this->Html->link($prospectcompagne['Prospectaffaire']['name'], array('controller' => 'prospectaffaires', 'action' => 'view', $prospectcompagne['Prospectaffaire']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Chef de projet'); ?></th>
		<td>
			<?php echo $this->Html->link($prospectcompagne['User']['name'], array('controller' => 'users', 'action' => 'view', $prospectcompagne['User']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Nom'); ?></th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Objectif'); ?></th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['objectif']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Code wavesoft'); ?></th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['code_wavesoft']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		
	</tr>
</table>
</div>
<div class="col-md-6">
<table class="table table-striped">
	<tr>
		<th><?php echo __('Script'); ?></th>
		<td>
			<a target="_blank" href="<?php echo $this->webroot.'img/affaires/'.$prospectcompagne['Prospectcompagne']['file']; ?>">Voir</a>&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Date Debut'); ?></th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['date_debut']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Date Fin'); ?></th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['date_fin']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th>Date d'ajout</th>
		<td>
			<?php echo h($prospectcompagne['Prospectcompagne']['created']); ?>
			&nbsp;
		</td>
	</tr>
</table>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
 <div class="col-md-12" style="padding: 0px;">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">les appels En cours</a></li>
                <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">les appels annulés</a></li>
                <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">les appels terminés</a></li>
                <li><a href="#tab_4" data-toggle="tab" aria-expanded="true">les appels A traiter</a></li>
            </ul>
            <div class="tab-content">
                
                <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-xs-12">
                               <div class="related">
	<?php if (!empty($prospectcompagne['Prospectfeuille'])): ?>
		<div style="padding: 14px 0;">
		
		<a  class="btn btn-danger" id="sup_all" onclick="if (confirm('Etes-vous sur de vouloir supprimer ?')) { document.post_5f295097c56d8209377613.submit(); } event.returnValue = false; return false;">Supprimer</a>
		</div>
	<table class="table table-bordered table-striped">
	<tr>
		<th >
			<input type="checkbox" id="checkAll">
		</th>
		<th>Prospect</th>
		<th>Type</th>
		<th>Ville</th>
		<th>Secteur</th>
		<th>Conseiller</th>
		<th><?php echo __('Etat'); ?></th>
		<th><?php echo __('Date Debut'); ?></th>
		<th><?php echo __('Date Fin'); ?></th>
		<th>Date d'ajout</th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		
	</tr>
	<?php $i=0;
		foreach ($prospectcompagne['Prospectfeuille'] as $prospectfeuille):
			if($prospectfeuille['etat'] == "En cours"){
		 ?>
		<tr >
			<td>

				 <?php if ( $prospectfeuille['etat'] == "En cours"){ ?>
				<input type="checkbox" name="check" value="<?php echo $prospectfeuille['id'] ?>" class="form-controle chech_btn <?php echo $prospectfeuille['etat']; ?>" onchange="puch('<?php echo $i ?>')" id="check<?php echo $i ?>" >
			<?php } ?>
			</td>
			<td><?php 
			$client['Client']=$clients[$prospectfeuille['client_id']];
			echo $this->Html->link($client['Client']['nom'], array('controller' => 'clients', 'action' => 'view', $prospectfeuille['client_id']));?></td>
			<td><?php echo $prospectfeuille['id'] ." -- ".$client["Client"]['type_pharmacie']; ?></td>
			<td><?php 
			$secteur="";
			foreach ($secteurs as $s)
			{
				if($client["Client"]["secteur_id"]==$s["Secteur"]["id"])
				{
					echo $s["Secteur"]['ville'];
					$secteur= $s["Secteur"]['secteur'];
					break;
				}
			} ?></td>
			<td><?php echo $secteur; ?></td>
			<td><?php echo $users[$prospectfeuille['user_id']]; ?></td>
			<td><?php echo $prospectfeuille['etat']; ?></td>
			<td><?php echo $prospectfeuille['date_debut']; ?></td>
			<td><?php echo $prospectfeuille['date_fin']; ?></td>
			<td><?php echo $prospectfeuille['created']; ?></td>
			<td class="actions">
				<?php 
				if ($this->requestAction('/droits/getrole/prospectcompagnes/delete_appel') == 1)
					echo $this->Form->postLink(__('Supprimer'), array('controller' => 'prospectcompagnes', 'action' => 'delete_appel', $prospectfeuille['id']),array('class'=>'btn btn-danger','id'=>$prospectfeuille['id']), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
			
		</tr>

	<?php 
	}
	$i++;
	endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
                            </div>
                        </div>
                </div>
                <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-xs-12">
                                

<div class="related">
	<?php if (!empty($prospectcompagne['Prospectfeuille'])): ?>
	<table class="table table-bordered table-striped">
	<tr>
		<th>Prospect</th>
		<th>Type</th>
		<th>Ville</th>
		<th>Secteur</th>
		<th>Conseiller</th>
		<th><?php echo __('Etat'); ?></th>
		<th><?php echo __('Date Debut'); ?></th>
		<th><?php echo __('Date Fin'); ?></th>
		<th>Date d'ajout</th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		
	</tr>
	<?php $i=0;
		foreach ($prospectcompagne['Prospectfeuille'] as $prospectfeuille):
			if($prospectfeuille['etat'] == "Annuler"){
		 ?>
		<tr >

			<td><?php 
			$client['Client']=$clients[$prospectfeuille['client_id']];
			echo $this->Html->link($client['Client']['nom'], array('controller' => 'clients', 'action' => 'view', $prospectfeuille['client_id']));?></td>
			<td><?php echo $client["Client"]['type_pharmacie']; ?></td>
			<td><?php 
			foreach ($secteurs as $s)
			{
				if($client["Client"]["secteur_id"]==$s["Secteur"]["id"])
				{
					echo $s["Secteur"]['ville'];
					$secteur= $s["Secteur"]['secteur'];
					break;
				}
			} ?></td>
			<td><?php echo $secteur; ?></td>
			<td><?php echo $users[$prospectfeuille['user_id']]; ?></td>
			<td><?php echo $prospectfeuille['etat']; ?></td>
			<td><?php echo $prospectfeuille['date_debut']; ?></td>
			<td><?php echo $prospectfeuille['date_fin']; ?></td>
			<td><?php echo $prospectfeuille['created']; ?></td>
			<td class="actions">
				<?php 
				if ($this->requestAction('/droits/getrole/prospectcompagnes/delete_appel') == 1)
					echo $this->Form->postLink(__('Supprimer'), array('controller' => 'prospectcompagnes', 'action' => 'delete_appel', $prospectfeuille['id']),array('class'=>'btn btn-danger','id'=>$prospectfeuille['id']), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
			
		</tr>

	<?php 
	}
	$i++;
	endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
                            </div>
                        </div>
                </div>
                <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-xs-12">
                               
                               <div class="related">
	<?php if (!empty($prospectcompagne['Prospectfeuille'])): ?>

	<table class="table table-bordered table-striped">
	<tr>
		<th>Prospect</th>
		<th>Type</th>
		<th>Ville</th>
		<th>Secteur</th>
		<th>Conseiller</th>
		<th><?php echo __('Etat'); ?></th>
		<th><?php echo __('Date Debut'); ?></th>
		<th><?php echo __('Date Fin'); ?></th>
		<th>Date d'ajout</th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		
	</tr>
	<?php $i=0;
		foreach ($prospectcompagne['Prospectfeuille'] as $prospectfeuille):
			if($prospectfeuille['etat'] == "Terminer"){
		 ?>
		<tr >
			<td><?php 
			$client['Client']=$clients[$prospectfeuille['client_id']];
			echo $this->Html->link($client['Client']['nom'], array('controller' => 'clients', 'action' => 'view', $prospectfeuille['client_id']));?></td>
			<td><?php echo $client["Client"]['type_pharmacie']; ?></td>
			<td><?php 
			foreach ($secteurs as $s)
			{
				if($client["Client"]["secteur_id"]==$s["Secteur"]["id"])
				{
					echo $s["Secteur"]['ville'];
					$secteur= $s["Secteur"]['secteur'];
					break;
				}
			} ?></td>
			<td><?php echo $secteur; ?></td>
			<td><?php echo $users[$prospectfeuille['user_id']]; ?></td>
			<td><?php echo $prospectfeuille['etat']; ?></td>
			<td><?php echo $prospectfeuille['date_debut']; ?></td>
			<td><?php echo $prospectfeuille['date_fin']; ?></td>
			<td><?php echo $prospectfeuille['created']; ?></td>
			<td class="actions">
				<?php 
				if ($this->requestAction('/droits/getrole/prospectcompagnes/delete_appel') == 1)
					echo $this->Form->postLink(__('Supprimer'), array('controller' => 'prospectcompagnes', 'action' => 'delete_appel', $prospectfeuille['id']),array('class'=>'btn btn-danger','id'=>$prospectfeuille['id']), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
			
		</tr>

	<?php 
	}
	$i++;
	endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
                            </div>
                        </div>
                </div>
                <div class="tab-pane" id="tab_4">
                        <div class="row">
                            <div class="col-xs-12">
                                

<div class="related">
	<?php if (!empty($prospectcompagne['Prospectfeuille'])): ?>
	<table class="table table-bordered table-striped">
	<tr>
		<th>Prospect</th>
		<th>Type</th>
		<th>Ville</th>
		<th>Secteur</th>
		<th>Conseiller</th>
		<th><?php echo __('Etat'); ?></th>
		<th><?php echo __('Date Debut'); ?></th>
		<th><?php echo __('Date Fin'); ?></th>
		<th>Date d'ajout</th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		
	</tr>
	<?php $i=0;
		foreach ($prospectcompagne['Prospectfeuille'] as $prospectfeuille):
			if($prospectfeuille['etat'] == "A traiter"){
		 ?>
		<tr >

			<td><?php 
			$client=$this->requestaction("/clients/system_get_client_all/".$prospectfeuille['client_id']);
			echo $this->Html->link($client['Client']['nom'], array('controller' => 'clients', 'action' => 'view', $prospectfeuille['client_id']));?></td>
			<td><?php echo $client["Client"]['type_pharmacie']; ?></td>
			<td><?php 
			foreach ($secteurs as $s)
			{
				if($client["Client"]["secteur_id"]==$s["Secteur"]["id"])
				{
					echo $s["Secteur"]['ville'];
					$secteur= $s["Secteur"]['secteur'];
					break;
				}
			} ?></td>
			<td><?php echo $secteur ?></td>
			<td><?php echo $users[$prospectfeuille['user_id']]; ?></td>
			<td><?php echo $prospectfeuille['etat']; ?></td>
			<td><?php echo $prospectfeuille['date_debut']; ?></td>
			<td><?php echo $prospectfeuille['date_fin']; ?></td>
			<td><?php echo $prospectfeuille['created']; ?></td>
			<td class="actions">
				<?php 
				if ($this->requestAction('/droits/getrole/prospectcompagnes/delete_appel') == 1)
					echo $this->Form->postLink(__('Supprimer'), array('controller' => 'prospectcompagnes', 'action' => 'delete_appel', $prospectfeuille['id']),array('class'=>'btn btn-danger','id'=>$prospectfeuille['id']), __('Etes-vous sur de vouloir supprimer ?')); ?>
			</td>
			
		</tr>

	<?php 
	}
	$i++;
	endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>



 <?php
echo $this->Html->script('jquery-2.2.3.min'); 
?>
<script type="text/javascript">
	list_sup= [];
	function puch(id){
		
	}
		$("#checkAll").click(function(){
			
			if($("#checkAll").is(':checked')){
				    $('input:checkbox').not(this).prop('checked', this.checked);
			}
			else{
				$('input:checkbox').not(this).prop('checked', this.checked);
			}
});


$("#sup_all").click(function(){
list_sup = [];
		$.each($("input[name='check']:checked"), function(){            
                list_sup.push($(this).val());
            });
		$("#sup_all").attr("href","<?php echo $this->Html->url('/prospectcompagnes/delete_appel/'); ?>"+list_sup);
});



</script>

