<div class="row m-t-25">
    <div class="col"></div>
    <div class="col-sm-10 col-lg-8">
        <div class="card ">
            <div class="card-header"><strong><?php echo 'Add Boiteidee'; ?></strong>
            </div>

            <div class="card-body">

                    <?php echo $this->Form->create('Boiteidee');?>
                    <div class='row form-group'>
                    		 <?php echo $this->Form->input('user_id',array('label' => false,'class'=>'form-control','placeholder'=>'user_id','div' => array('class' => 'col-md-6 m-b-25'))); ?>
		 <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'name','div' => array('class' => 'col-md-6 m-b-25'))); ?>
                </div>                                  

            </div>
            <div class="card-footer text-center">
                <?php echo $this->Form->end(array('label' => 'Envoyer')); ?>
 

            </div>
        </div>

    </div>
    <div class="col"></div>
</div>
