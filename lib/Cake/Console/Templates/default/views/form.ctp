<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="card card-info">
	<div class="card-header">
        <h3 class="card-title"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3>
    </div>
	
        
            
                <div class="card-body">
				<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}',array('class'=>'form-control'));\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
			   echo "\t\techo \$this->Form->input('{$assocName}',array('class'=>'form-control'));\n";
			}
		}
		echo "\t?>\n";
?>
	
</div>
<div class="box-footer">
<?php
	echo "<?php echo \$this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-outline-info','div' => array('class' => 'well text-center'))); ?>\n";
?>

</div>
</div>
</div>
</div>




