<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;">Proposer la modification d'un client</h3>
    </div>
    <?php if ($this->request->data['Clientspropose']['type_id'] == '1'): ?>
        <div class="panel-body">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-body form-horizontal payment-form">
                        <?php echo $this->Form->create('Clientspropose'); ?>
                        <?php
                        if ($editer == null)
                            echo $this->Form->hidden('client_id', array('value' => $client_id));
                        else
                            echo $this->Form->hidden('id', array('value' => $client_id));
                        //echo $this->Form->input('region_id', array('id' => "regions", 'label' => 'Région', 'class' => 'form-control select2'));
                        ?>
						<!-- début autres infos à modifier -->
                        <!-- <div class="input select">
                            // <label for="regions">Région</label>
                            // <select name="data[Clientspropose][region_id]" id="regions" class="form-control select2">
                                // <?php //foreach ($regions as $va) 
                                    // {
                                        // $selected="";
                                        // if($va['Secteur']['code_region']==$secteur['Secteur']['code_region'])
                                            // $selected = ' selected ';
                                        // echo '<option '.$selected.' value="'.$va['Secteur']['code_region'].'">'.$va['Secteur']['region'].'</option>';
                                    // } ?>
                            // </select>
                        // </div>
                        // <div class="input select" id="ville">
                            // <label for="regions">Ville</label>
                            // <select name="data[Clientspropose][]" class="form-control" id="ClientsproposeCategoryId">
                                // <option  value='<?php //echo $secteur['Secteur']['id']; ?>'><?php //echo $secteur['Secteur']['ville']; ?></option>
                            // </select>
                        // </div>
                        // <div id="secteur" class="input select" id="secteur">
                            // <label for="regions">Secteur</label>
                            // <select name="data[Clientspropose][secteur_id]" class="form-control" id="ClientsproposeCategoryId">
                                // <option  value='<?php //echo $secteur['Secteur']['id']; ?>'><?php //echo $secteur['Secteur']['secteur']; ?></option>
                            // </select>
                        // </div>
                        // <?php //echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                        // ?>
                        // <div class="input select">
                            // <label for="ClientsproposeCategoryId">Tendance</label>
                            // <select name="data[Clientspropose][category1_id]" class="form-control" id="ClientsproposeCategoryId">
                                // <option value="">Choisissez</option>
                                // <?php
                                // foreach ($categories as $key => $value) {
                                    // $selected = '';
                                    // if ($key == $this->request->data['Clientspropose']['category1_id'])
                                        // $selected = ' selected ';
                                    // echo "<option $selected value='$key'>$value</option>";
                                // }
                                // ?>
                            // </select>
                        // </div>
                        // <div class="input select">
                            // <label for="ClientsproposeCategoryId">Titre</label>
                            // <select name="data[Clientspropose][titre]" class="form-control" id="ClientsproposeCategoryId">
                                // <?php
                                // $selected = '';
                                // if ("Docteur" == $this->request->data['Clientspropose']['titre']){
								// $selected = ' selected ';}
                                // echo "<option $selected value='Docteur'>Docteur</option>";
                                // $selected = '';
                                // if ("Professeur" == $this->request->data['Clientspropose']['titre']){
								// $selected = ' selected ';}
                                // echo "<option $selected value='Professeur'>Professeur</option>";
                                // ?>
                            // </select>
                        // </div>
                        // <div class="input select">
                            // <label for="ClientsproposeCategoryId">Activité</label>
                            // <select name="data[Clientspropose][activite]" class="form-control" id="ClientsproposeCategoryId">
                                // <?php
                                // $selected = '';
                                // if ("Prive" == $this->request->data['Clientspropose']['activite']){
								// $selected = ' selected ';}
                                // echo "<option $selected value='Prive'>Privé</option>";
                                // $selected = '';
                                // if ("Publique" == $this->request->data['Clientspropose']['activite']){
								// $selected = ' selected ';}
                                // echo "<option $selected  value='Publique'>Publique</option>";
                                // ?>
                            // </select>
                        // </div>
                        // <div class="input select">
                            // <label for="ClientsproposeCategoryId">Exercice <?php 
							// $this->request->data['Clientspropose']['exercice']=trim($this->request->data['Clientspropose']['exercice']); ?></label>
                            // <select name="data[Clientspropose][exercice]" class="form-control" id="ClientsproposeCategoryId">
                                // <?php
                                // $selected = '';
                                // if ("Centre de sante" == $this->request->data['Clientspropose']['exercice']){
                                    // $selected = ' selected ';}
                                // echo "<option $selected value='Centre de sante'>Centre de santé</option>";
                                // $selected = '';
                                // if ("Cabinet prive" == $this->request->data['Clientspropose']['exercice'] || $this->request->data['Clientspropose']['exercice']=="Cabinet privee"){
								// $selected = ' selected ';}
                                // echo "<option $selected  value='Cabinet prive'>Cabinet privé</option>";
                                // $selected = '';
                                // if ("Hopital" == $this->request->data['Clientspropose']['exercice']){
								// $selected = ' selected ';}
                                // echo "<option $selected  value='Hopital'>Hôpital</option>";
                                // $selected = '';
                                // if ("Penitencier" == $this->request->data['Clientspropose']['exercice']){
								// $selected = ' selected ';}
                                // echo "<option $selected  value='Penitencier'>Pénitencier</option>";
                                // $selected = '';
                                // if ("Clinique" == $this->request->data['Clientspropose']['exercice']){
								// $selected = ' selected ';}
                                // echo "<option $selected  value='Clinique'>Clinique</option>";
                                // ?>
                            // </select>
                        // </div> -->
<!-- fin autres infos à modifier -->
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Patients par Jour</label>
                            <select name="data[Clientspropose][A]" class="form-control" id="ClientsproposeCategoryId">
                                <?php
                                $selected = '';
                                $this->request->data['Clientspropose']['A']=$this->request->data['Clientspropose']['potentialite'][0];
                                $this->request->data['Clientspropose']['1']=$this->request->data['Clientspropose']['potentialite'][1];
                                if ("A" == $this->request->data['Clientspropose']['A']){
								$selected = ' selected ';}
                                echo "<option $selected value='A'>Plus de 20</option>";
                                $selected = '';
                                if ("B" == $this->request->data['Clientspropose']['A']){
								$selected = ' selected ';}
                                echo "<option $selected  value='B'>Entre 10 et 20</option>";
                                $selected = '';
                                if ("C" == $this->request->data['Clientspropose']['A']){
								$selected = ' selected ';}
                                echo "<option $selected  value='C'>Moins de 10</option>";
                                ?>
                            </select>
                        </div>

                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Adoption des produits Esnapharm</label>
                            <select name="data[Clientspropose][1]" class="form-control" id="ClientsproposeCategoryId">
                                <?php
                                $selected = '';
                                if ("1" == $this->request->data['Clientspropose']['1']){
								$selected = ' selected ';}
                                echo "<option $selected value='1'>Exclusif</option>";
                                $selected = '';
                                if ("2" == $this->request->data['Clientspropose']['1']){
                                    $selected = ' selected ';}
                                echo "<option $selected  value='2'>Fidèle</option>";
                                $selected = '';
                                if ("3" == $this->request->data['Clientspropose']['1']){
								$selected = ' selected ';}
                                echo "<option $selected  value='3'>Rare</option>";
                                $selected = '';
                                if ("4" == $this->request->data['Clientspropose']['1']){
								$selected = ' selected ';}
                                echo "<option $selected  value='4'>Non</option>";
                                ?>
                            </select>
                        </div>

                        <?php
                        // echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                        // echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                        // echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                        // echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control'));
                        // echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                        // echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                        // echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control'));
                        ?>
                      <!--  <div class="input select">
                            <label for="ClientsproposeCategoryId">Classification</label>
                            <select name="data[Clientspropose][potentialitev2]" class="form-control" id="ClientsproposeCategoryId">
                                <option <?php //if ($this->request->data['Clientspropose']['potentialitev2'] == "PCM") echo ' selected '; ?> value="PCM">PCM</option>
                                <option <?php //if ($this->request->data['Clientspropose']['potentialitev2'] == "QAM") echo ' selected '; ?> value="QAM">QAM</option>
                                <option <?php //if ($this->request->data['Clientspropose']['potentialitev2'] == "PM") echo ' selected '; ?> value="PM">PM</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="regions">La liste des produits</label>
                            <select name="data[Clientspropose][produits][]" id="regions" class="form-control select2" multiple = "multiple">
                                // <?php //foreach ($produits as $va=>$value) 
                                    // {
                                        // $selected="";
                                        // $prods=  explode(",", $this->request->data['Clientspropose']['produit']);
                                        // if(strlen($prods[0])>0)
                                        // {
                                            // for($i=0;$i<count($prods);$i++)
                                            // {
                                                // if($prods[$i]==$va)
                                                    // $selected = ' selected ';
                                            // }
                                        // }
                                        // echo '<option '.$selected.' value="'.$va.'">'.$value.'</option>';
                                    // } ?>
                            </select>
                            <?php
                            
                            //echo $this->Form->input('produits', array('name' => "data[Clientspropose][produits][]", 'label' => 'La liste des produits', 'class' => 'form-control select2', 'multiple' => "multiple"));
                            ?>
                        </div>-->
    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12', 'style' => 'float:left;'))); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
    if ($this->request->data['Clientspropose']['type_id'] == '2'):
        ?>
        <div class="panel-body">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-body form-horizontal payment-form">
                        <?php echo $this->Form->create('Clientspropose'); ?>
                        <?php
                        if ($editer == null)
                            echo $this->Form->hidden('client_id', array('value' => $client_id));
                        else
                            echo $this->Form->hidden('id', array('value' => $client_id));
                        //echo $this->Form->input('region_id', array('id' => "regions", 'label' => 'Region', 'class' => 'form-control select2'));
                        ?>
                        <div class="input select">
                            <label for="regions">Région</label>
                            <select name="data[Clientspropose][region_id]" id="regions" class="form-control select2">
                                <?php foreach ($regions as $va) 
                                    {
                                        $selected="";
                                        if($va['Secteur']['code_region']==$secteur['Secteur']['code_region'])
                                            $selected = ' selected ';
                                        echo '<option '.$selected.' value="'.$va['Secteur']['code_region'].'">'.$va['Secteur']['region'].'</option>';
                                    } ?>
                            </select>
                        </div>
                        <div class="input select" id="ville">
                            <label for="regions">Ville</label>
                            <select name="data[Clientspropose][n]" class="form-control" id="ClientsproposeCategoryId">
                                <option  value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['ville']; ?></option>
                            </select>
                        </div>
                        <div id="secteur" class="input select" id="secteur">
                            <label for="regions">Secteur</label>
                            <select name="data[Clientspropose][secteur]" class="form-control" id="ClientsproposeCategoryId">
                                <option  value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['secteur']; ?></option>
                            </select>
                        </div>
                        <?php
                        echo $this->Form->input('dirigent', array('label' => 'Dirigent', 'class' => 'form-control'));
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                        echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control'));
                        echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center')));
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif;
if ($this->request->data['Clientspropose']['type_id'] == '3'):
    ?>
        <div class="panel-body">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-body form-horizontal payment-form">
                        <?php echo $this->Form->create('Clientspropose'); ?>
                        <?php
                        if ($editer == null)
                            echo $this->Form->hidden('client_id', array('value' => $client_id));
                        else
                            echo $this->Form->hidden('id', array('value' => $client_id));
                        //echo $this->Form->input('region_id', array('id' => "regions", 'label' => 'Region', 'class' => 'form-control select2'));
                        ?>
                        <div class="input select">
                            <label for="regions">Région</label>
                            <select name="data[Clientspropose][region_id]" id="regions" class="form-control select2">
                                <?php foreach ($regions as $va) 
                                    {
                                        $selected="";
                                        if($va['Secteur']['code_region']==$secteur['Secteur']['code_region'])
                                            $selected = ' selected ';
                                        echo '<option '.$selected.' value="'.$va['Secteur']['code_region'].'">'.$va['Secteur']['region'].'</option>';
                                    } ?>
                            </select>
                        </div>
                        <div class="input select" id="ville">
                            <label for="regions">Ville</label>
                            <select name="data[Clientspropose][n]" class="form-control" id="ClientsproposeCategoryId">
                                <option  value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['ville']; ?></option>
                            </select>
                        </div>
                        <div id="secteur" class="input select" id="secteur">
                            <label for="regions">Secteur</label>
                            <select name="data[Clientspropose][secteur]" class="form-control" id="ClientsproposeCategoryId">
                                <option  value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['secteur']; ?></option>
                            </select>
                        </div>
                        <?php
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                        echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control'));
                        echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center')));
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
?>
<script>
    $(document).ready(function () {
        $("#regions").change(function () {
            var id = $("#regions").val();
            var image = "<center><img src='/img/loading.gif' style='width: 30px;' ></center>";
            $("#ville").empty();
            $(image).appendTo("#ville");
            $("#ville").show();
            $.post(
                    '/clientsproposes/system_get_ville/' + id,
                    {
                        //id: $("#ChembreBlocId").val()
                    },
                    function (data)
                    {
                        $("#ville").empty();
                        $(data).appendTo("#ville");
                        $("#ville").show();
                    },
                    'text' // type
                    );
        });
    });
</script>