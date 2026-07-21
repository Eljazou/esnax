<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"> <?php echo __('Ajouter une offre'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Offre'); ?>
                    <?php
                    echo $this->Form->input('titre', array('label' => 'Titre','class' => 'form-control'));
                    echo $this->Form->input('description', array('label' => 'Description','class' => 'form-control'));
                    echo $this->Form->input('montantmin', array('label' => 'Montant minimal(DH)','class' => 'form-control','value' => '0'));
                    for($i=0;$i<10;$i++)
                    {
						echo '<div class="row comm comm'.$i.' col-md-12" style="float: left;padding: 0px;margin: auto;margin-top: 6px;">';
                        echo $this->Form->input('produit_id', array('name'=>"data[$i][Offrespicial][produit_id]",'class' => 'form-control prod','div'=>array('class'=>'col-xs-6','style'=>'padding: 0px;')));
                        echo $this->Form->input('quantite', array('name'=>"data[$i][Offrespicial][quantite]",'class' => 'form-control prodq','label'=>'Quantité','div'=>array('class'=>'col-xs-3','style'=>'padding: 0px 4px;')));
                        echo $this->Form->input('reduction', array('name'=>"data[$i][Offrespicial][reduction]",'class' => 'form-control prodr','label'=>'Réduction','div'=>array('class'=>'col-xs-3','style'=>'padding: 0px 3px;')));
						echo '</div>';
                    }?>
					<div class="row col-md-12 commande" style="padding:0px;float:left;margin:auto;margin-top: 6px;">
                    </div>
					<div class="row">
                        <a onclick="addcom(10)" class="btn btn-primary btn-xs btnaddcom" style="cursor:pointer;float:left;margin-left: 30px;margin-top: 8px;">Ajouter un produit</a>
                    </div>
					<?php
                    echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
	function addcom(id) {
		var e = parseInt(id)+1;
        var comm = $('.comm').html();
        var commdiv = "<div class='col-md-12 comm"+id+"' style='float: left;padding: 0px;margin: auto;margin-top: 6px;'>"+comm+"</div>";
        $('.commande').append(commdiv);
        $('.prod:eq('+id+')').attr("name", "data["+id+"][Offrespicial][produit_id]");
        $('.prodq:eq('+id+')').attr("name", "data["+id+"][Offrespicial][quantite]");
        $('.prodr:eq('+id+')').attr("name", "data["+id+"][Offrespicial][reduction]");
		$(".btnaddcom").attr("onclick","addcom("+e+")");
    }
</script>