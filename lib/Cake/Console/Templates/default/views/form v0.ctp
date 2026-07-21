<div class="panel panel-primary">
	<div class="panel-heading">
        <h3 class="panel-title"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3>
    </div>
	<div class="card col-md-8">
        <div class="col-lg-8">
            <div class="panel panel-primary">
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
<?php
	echo "<?php echo \$this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center'))); ?>\n";
?>
</div>
</div>
</div>
</div>
</div>

