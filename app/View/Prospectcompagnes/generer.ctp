<?php
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('demo');
?>
<style type="text/css">
    .btn_search{
            font-family: raleway;
    width: 271px;
    border-radius: 25px;
    background-color: #009688;
    color: white;
    font-size: 18px;
    font-weight: 500;
    transition: .3s;
    }
    .btn_search:hover{
    background-color: #15e0cd;
    }
    .input_txt{
        border-radius: 25px;
        margin-bottom: 14px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<div class="row">
    <div class="col-md-12">
<div class="box box-info ">
    <div class="box-header with-border">
        <h2 class="panel-title" >Généré une liste d'appel pour un conseillier</h2>
    </div>
    <div class="box-body">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center">
                <?php
                echo $this->Form->create('Prospectcompagne', array('type' => 'file'));?>
                
                <input type="text" name="client_search"  placeholder="Société ou nom ou code_wavesoft" class="form-control input_txt" style="text-align: center;">
                 
                <?php echo $this->Form->end(array('label' => 'Rechercher ', 'class' => 'btn btn_search', 'div' => array('style' => 'display:inline-block;'))); ?>
                
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                <hr></div>
            <div class="col-md-6">
                
                <?php echo $this->Form->create('Prospectcompagne', array('type' => 'file'));
                echo $this->Form->hidden('id', array('value' => $id));

				echo $this->Form->input('user_id', array("id" => "select2",'label' => "Conseiller",'class' => 'form-control'));
                echo $this->Form->input('date_debut', array("type" => "text", 'class' => 'form-control date_debut date','value'=>$date_debut));
                echo $this->Form->input('date_fin', array("type" => "text", 'class' => 'form-control date_fin date','value'=>$date_fin));
				echo $this->Form->input('type', array("id" => "select2", 'class' => 'form-control type choix_multi',"multiple"));
				$clientcall=array("0"=>"Non","1"=>"Oui");
				echo $this->Form->input('client_call', array("options" => $clientcall, 'class' => 'form-control clientcall'));
				?>      
            </div>
            <div class="col-md-6">
                <?php echo $this->Form->input('catesgorie', array("label"=>"Catégorie","id" => "select2", 'class' => 'form-control categorie choix_multi',"multiple"));
                echo $this->Form->input('ville', array("id" => "select2" ,'search'=>'dp', 'class' => 'form-control ville choix_multi',"multiple"));
                echo $this->Form->input('limit', array('class' => 'form-control limit', 'label' => "Limite des clients à afficher",'value'=>$limite));
				echo $this->Form->input('vm_id', array("id" => "select2",'label' => "Historique du conseillier",'class' => 'vm form-control choix_multi',"multiple"));
				echo $this->Form->input('prospectcompagne_id', array("id" => "select2",'label' => "Historique du compagne",'class' => 'prospectcompagne form-control choix_multi',"multiple"));
                ?>
            </div>


                </div>
</div>
<div class="box-footer clearfix text-center">
                <button type="button" class="btn btn_search" onclick="getclients()">Rechercher </button>
            </div>
</div>

                <div class="box box-info">
                <div class="box-header table-responsive">
                    <h3 class="box-title">La liste des clients et prospects

                    </h3>
                    <div class="checkbox" style="float: right;">
                    <label>
                      <input type="checkbox" id="checkAll">
                      Sélectionner tous
                    </label>
                  </div>

                    <!-- <div style="float: right;direction: rtl;">
                <input type="checkbox" id="checkAll">Sélectionner tous
                </div> -->
                </div>

                <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Code wavesoft</th>
                        <th>Société</th>
                        <th>Type</th>
                        <th>Categorie</th>
                        <th>Ville</th>
                        <th>Secteur</th>
                        <th>FIX</th>
                        <th>Portable</th>
                        <th>Client centre appel</th>
                        <th>N° Appel</th>
                        <th>A</th>
                    </tr>
                    <tbody id='table' >
                        <?php
                        $i = 0;
                        foreach ($clients as $p):
						$appels=$this->requestAction("/prospectcompagnes/system_get_type_user_count/".$p['Client']['id']);
                            ?>
                            <tr>
                                <td><?php echo $p['Client']['code_wavsoft'] ?></td>
                                <td><?php echo $p['Client']['nom'] ?></td>
                                <td><?php echo $p['Client']['type_pharmacie'] ?></td>
                                <td><?php echo $p['Client']['categorie'] ?></td>
                                <td><?php echo $p['Client']["Secteur"]['ville'] ?></td>
                                <td><?php echo $p['Client']["Secteur"]['secteur'] ?></td>
                                <td><?php echo $p['Client']['fixe'] ?></td>
                                <td><?php echo $p['Client']['tel'] ?></td>
                                <td><?php $clientcall=array("0"=>"Non","1"=>"Oui");
								echo $clientcall[$p['Client']['client_call']]; ?></td>
                                <td><?php echo $appels ?></td>
                                <td><input name="data[Prospectfeuille][<?php echo $i ?>][client_id]" type="checkbox" value="<?php echo $p['Client']['id']; ?>"></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="box-footer clearfix">
                <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-outline-info', 'div' => array('class' => 'well text-center'))); ?>
            </div>
        </div>

            </div>

</div>

<?php
	echo $this->Html->css('datepicker3');
	echo $this->Html->script('bootstrap-datepicker'); 
	echo $this->Html->script('bootstrap-datepicker.fr'); 
	?>

<script>
    function getclients()
    {
        var limit = $(".limit").val();
        var categorie = $(".categorie").val();
        var ville = $(".ville").val();
        var type = $(".type").val();
        var clientcall = $(".clientcall").val();
        var date_debut = $(".date_debut").val();
        var date_fin = $(".date_fin").val();
        var vm = $(".vm").val();
        var prospectcompagne = $(".prospectcompagne").val();
        location.href = "<?php echo $this->Html->url(array("controller" => "prospectcompagnes", "action" => "generer", $id)); ?>/" + type + "/"+ clientcall + "/" + ville + "/" + categorie + "/" + limit + "/" + date_debut + "/" + date_fin+ "/" + vm+ "/" + prospectcompagne;

    }
</script>

<script>
    
    $(function () {
	$('.choix_multi').select2();
        $('.date').datepicker({
	  format: 'yyyy-mm-dd',
	  language: 'fr'
	});
  $( ".date" ).datepicker( "option", "showAnim", "drop" );
  
  $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 
        
    });
	
	
</script>




