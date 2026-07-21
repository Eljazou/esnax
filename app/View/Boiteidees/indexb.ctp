<div class="row">       
    <div class="col"></div>
    <div class="col-lg-11 m-t-25">
        <h2 class="title-1 m-b-25"><?php echo 'Boiteidees'; ?></h2>
            <div class="float-right">

                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#popup_add">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
                <div class="modal fade" id="popup_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo 'Index Boiteidee'; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $this->Form->create('Boiteidee',array('url'=>array('action'=>'add'))); ?>

                                <div class='row form-group'>
                                    	<?php
		echo $this->Form->input('user_id',array('label'=>false,'class'=>'form-control','placeholder'=>'user_id','div' => array('class' => 'col-md-6 m-b-25')));
		echo $this->Form->input('name',array('label'=>false,'class'=>'form-control','placeholder'=>'name','div' => array('class' => 'col-md-6 m-b-25')));
	?>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <?php echo $this->Form->end(array('label' => 'Ajouter','class'=>'au-btn au-btn--green')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="table-responsive table--no-card ">
            <table class="table table-borderless table-striped table-earning" id="example">
                <thead class="thead-dark">
                    <tr>
                                                    <th>id</th>
                                                    <th>user_id</th>
                                                    <th>name</th>
                                                    <th>created</th>
                                                <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($boiteidees as $boiteidee): ?>
	<tr>
		<td><?php echo h($boiteidee['Boiteidee']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($boiteidee['User']['name'], array('controller' => 'users', 'action' => 'view', $boiteidee['User']['id'])); ?></td>
		<td><?php echo h($boiteidee['Boiteidee']['name']); ?>&nbsp;</td>
		<td><?php echo h($boiteidee['Boiteidee']['created']); ?>&nbsp;</td>
		<td><div  class="table-data-feature">
			<?php echo $this->Html->link('', array('action' => 'view', $boiteidee['Boiteidee']['id']),array('class'=>'item item-view fas fa-eye','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Voir')); ?>
			<?php echo $this->Html->link('', array('action' => 'edit', $boiteidee['Boiteidee']['id']), array('class' => 'item item-edit fas fa-pencil-alt','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Éditer')); ?>
			<?php echo $this->Form->postLink('', array('action' => 'delete', $boiteidee['Boiteidee']['id']),array('class'=>'item item-remove far fa-trash-alt','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Supprimer'), __('Etes-vous sur de vouloir supprimer ?'));?>
		</div></td>
	</tr>
<?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>