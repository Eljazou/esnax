<?php echo $this->Html->css("style_rapport");
echo $this->Html->css('select2.min');
//debug($regions);exit();
?>
<?php

echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');

function utf8ize($mixed)
{
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, 'UTF-8', 'UTF-8');
    }
    return $mixed;
}
$secteur_clean = utf8ize($secteur);
?>

<script type="text/javascript">
    var regions = <?php echo json_encode($regions); ?>;
    var villes = <?php echo json_encode($villes); ?>;

    var mysecteur = <?php echo json_encode($secteur_clean, JSON_UNESCAPED_UNICODE); ?>;
    var k = 0;


    $(document).ready(function() {

        // Hospital Select2
        $('#ClientHopitalSelect').select2({
            tags: true,
            placeholder: '-- Choisir ou créer un hôpital --',
            allowClear: true,
            language: {
                noResults: function() { return 'Aucun hôpital trouvé'; }
            },
            createTag: function(params) {
                var term = $.trim(params.term);
                if (!term) return null;
                return { id: '__new__:' + term, text: term + ' (nouveau)', newTag: true };
            }
        });

        // Show/hide hospital field on Activité change
        $('#ClientActiviteSelect').on('change', function() {
            if ($(this).val() === 'Publique') {
                $('#hopital-field').slideDown(200);
            } else {
                $('#hopital-field').slideUp(200);
                $('#ClientHopitalSelect').val(null).trigger('change');
            }
        });

        // Printing Keys
        for (var key in regions) {
            // Printing Keys 
            var selected = "";
            if (key == mysecteur['Secteur']['region']) {
                var selected = "selected";
            }
            $('#ClientRegionId').append('<option  value="' + key + '" ' + selected + '>' + key + '</option>');

        }
        region_change();
    });

    function region_change() {
        var myreg = $("#ClientRegionId").val();
        $('#ClientVilleId').empty();
        if (mysecteur.length === 0) {

            for (var i = 0; i < regions[myreg].length; i++) {
                $("#ClientVilleId").append('<option  value="' + regions[myreg][i] + '" >' + regions[myreg][i] + '</option>');

            }
        } else {

            console.log(regions[myreg]);
            for (var i = 0; i < regions[myreg].length; i++) {
                if (regions[myreg][i] == mysecteur['Secteur']['ville']) {
                    $("#ClientVilleId").append('<option  value="' + regions[myreg][i] + '" selected>' + regions[myreg][i] + '</option>');
                } else {
                    $("#ClientVilleId").append('<option  value="' + regions[myreg][i] + '" >' + regions[myreg][i] + '</option>');
                }

            }
        }
        villes_change();
    }

    function villes_change() {
        var myville = $("#ClientVilleId").val();
        $('#ClientSecteurId').empty();
        if (mysecteur.length === 0) {
            for (var key in villes[myville]) {
                if (villes[myville].hasOwnProperty(key)) {

                    // Printing Keys 
                    $("#ClientSecteurId").append('<option  value="' + key + '" >' + villes[myville][key] + '</option>');
                }
            }

        } else {
            for (var key in villes[myville]) {
                if (villes[myville].hasOwnProperty(key)) {

                    // Printing Keys
                    if (villes[myville][key] == mysecteur['Secteur']['secteur']) {
                        $("#ClientSecteurId").append('<option  value="' + key + '" selected>' + villes[myville][key] + '</option>');
                    } else {

                        $("#ClientSecteurId").append('<option  value="' + key + '" >' + villes[myville][key] + '</option>');
                    }
                }
            }
        }
    }
</script>

<div class="card">
    <div class="card-header">
        <h3 class="card-title fw-bold"><?php echo __('Editer un client'); ?></h3>
    </div>
    <div class="card-body">
        <div class="form-horizontal payment-form">
            <?php if ($this->request->data['Client']['type_id'] == 1 || $this->request->data['Client']['type_id'] == 5): ?>
                <?php echo $this->Form->create('Client'); ?>
                <div class="row">
                <div class="col-lg-6 col-md-6">
                    <?php
                    echo $this->Form->input('id', array('class' => 'form-control'));
                    echo $this->Form->input('type_id', array('label' => 'Type', 'class' => 'form-control'));
                    // echo $this->Form->input('secteur_id', array('label' => 'Secteur', 'class' => 'form-control'));
                    ?>
                    <div class="input select">
                        <label for="regions">Région</label>
                        <select name="data[Client][region_id]" id="ClientRegionId" class="form-control select2" onchange="region_change();">

                        </select>
                    </div>
                    <div class="input select" id="ville">
                        <label for="regions">Ville</label>
                        <select name="data[Client][]" class="form-control" id="ClientVilleId" onchange="villes_change();">
                            <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['ville']; ?></option>
                        </select>
                    </div>
                    <div id="secteur" class="input select" id="secteur">
                        <label for="regions">Secteur</label>
                        <select name="data[Client][secteur_id]" class="form-control" id="ClientSecteurId">
                            <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['secteur']; ?></option>
                        </select>
                    </div>

                    <?php
                    echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                    ?>
                    <div class="input select">
                        <label for="ClientCategoryId">Tendance</label>
                        <select name="data[Client][category1_id]" class="form-control" id="ClientCategoryId">
                            <option value="">Choisissez</option>
                            <?php
                            foreach ($categories as $key => $value) {
                                $selected = '';
                                if ($key == $this->request->data['Client']['category1_id'])
                                    $selected = ' selected ';
                                echo "<option $selected value='$key'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input select">
                        <label for="ClientCategoryId">Titre</label>
                        <select name="data[Client][titre]" class="form-control" id="ClientCategoryId">
                            <?php
                            $selected = '';
                            if ("Docteur" == $this->request->data['Client']['titre']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Docteur'>Docteur</option>";
                            $selected = '';
                            if ("Professeur" == $this->request->data['Client']['titre']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Professeur'>Professeur</option>";
                            ?>
                        </select>
                    </div>
                    <div class="input select">
                        <label for="ClientActiviteSelect">Activité</label>
                        <select name="data[Client][activite]" class="form-control" id="ClientActiviteSelect">
                            <?php
                            $selected = '';
                            if ("Prive" == $this->request->data['Client']['activite']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Prive'>Privé</option>";

                            $selected = '';
                            if ("Publique" == $this->request->data['Client']['activite']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected  value='Publique'>Publique</option>";
                            ?>
                        </select>
                    </div>

                    <div class="input select" id="hopital-field" style="display:<?php echo (strtolower($this->request->data['Client']['activite']) === 'publique') ? 'block' : 'none'; ?>;">
                        <label>Hôpital</label>
                        <select name="data[Client][hopital_id]" id="ClientHopitalSelect" class="form-control" style="width:100%">
                            <option value="">-- Choisir ou créer un hôpital --</option>
                            <?php foreach ($all_hopitals as $h_id => $h_name): ?>
                                <option value="<?php echo $h_id; ?>" <?php echo ($this->request->data['Client']['hopital_id'] == $h_id) ? 'selected' : ''; ?>>
                                    <?php echo h($h_name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input select">
                        <label for="ClientCategoryId">Exercice</label>
                        <select name="data[Client][exercice]" class="form-control" id="ClientCategoryId">
                            <?php
                            $selected = '';
                            if ("Centre de sante" == $this->request->data['Client']['exercice']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Centre de sante'>Centre de santé</option>";
                            $selected = '';
                            if ("Cabinet prive" == $this->request->data['Client']['exercice']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected  value='Cabinet prive'>Cabinet privé</option>";
                            $selected = '';
                            if ("Hopital" == $this->request->data['Client']['exercice']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Hopital'>Hôpital</option>";
                            $selected = '';
                            if ("Penitencier" == $this->request->data['Client']['exercice']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Penitencier'>Pénitencier</option>";
                            $selected = '';
                            if ("Clinique" == $this->request->data['Client']['exercice']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='Clinique'>Clinique</option>";
                            ?>
                        </select>
                    </div>

                    <div class="input select">
                        <label for="ClientCategoryId">Patients par Jour</label>
                        <select name="data[Client][A]" class="form-control" id="ClientCategoryId">
                            <?php
                            $selected = '';
                            $this->request->data['Client']['A'] = $this->request->data['Client']['potentialite'][0];
                            $this->request->data['Client']['1'] = $this->request->data['Client']['potentialite'][1];
                            //debug($this->request->data['Client']['A']);
                            //$this->request->data['Client']['A'];
                            if ("A" == $this->request->data['Client']['A']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='A'>Plus de 20</option>";
                            $selected = '';
                            if ("B" == $this->request->data['Client']['A']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='B'>Entre 10 et 20</option>";
                            $selected = '';
                            if ("C" == $this->request->data['Client']['A']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected  value='C'>Moins de 10</option>";
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="input select">
                        <label for="ClientsproposeCategoryId">Classification</label>
                        <select name="data[Client][potentialitev2]" class="form-control" id="ClientsproposeCategoryId">
                            <option <?php if ($this->request->data['Client']['potentialitev2'] == "PCM") echo ' selected '; ?> value="PCM">PCM</option>
                            <option <?php if ($this->request->data['Client']['potentialitev2'] == "QAM") echo ' selected '; ?> value="QAM">QAM</option>
                            <option <?php if ($this->request->data['Client']['potentialitev2'] == "PM") echo ' selected '; ?> value="PM">PM</option>
                        </select>
                    </div>
                    <div class="input select">
                        <label for="ClientCategoryId">Adoption des produits Esnapharm</label>
                        <select name="data[Client][1]" class="form-control" id="ClientCategoryId">
                            <?php
                            $selected = '';
                            if ("1" == $this->request->data['Client']['1']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='1'>Exclusif</option>";
                            $selected = '';
                            if ("2" == $this->request->data['Client']['1']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected value='2'>Fidèle</option>";
                            $selected = '';
                            if ("3" == $this->request->data['Client']['1']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected  value='3'>Rare</option>";
                            $selected = '';
                            if ("4" == $this->request->data['Client']['1']) {
                                $selected = ' selected ';
                            }
                            echo "<option $selected  value='4'>Non</option>";
                            ?>
                        </select>
                    </div>

                    <?php
                    echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                    echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                    echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                    echo $this->Form->input('tel', array('label' => 'GSM', 'class' => 'form-control'));
                    echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                    echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                    echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                    ?>
                    <div class="input select">
                        <label>La liste des produits</label>
                        <select name="data[Client][produits][]" id="produit_list" class="form-control select2" multiple="multiple">
                            <?php
                            foreach ($produits as $va => $value) {
                                $selected = "";
                                $prods = explode(",", $this->request->data['Client']['produit']);
                                if (strlen($prods[0]) > 0) {
                                    for ($i = 0; $i < count($prods); $i++) {
                                        if ($prods[$i] == $va)
                                            $selected = ' selected ';
                                    }
                                }
                                echo '<option ' . $selected . ' value="' . $va . '">' . $value . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="input select">
                        <label>Map</label>
                        <table class="table">
                            <tr>
                                <td><label>Latitude:</label></td>
                                <td><?php echo $this->Form->input('latitude', array('id' => 'latitude_mag', 'label' => false)); ?></td>
                                <td><label>Longitude:</label></td>
                                <td><?php echo $this->Form->input('longitude', array('id' => 'longitude_mag', 'label' => false)); ?></td>
                            </tr>
                        </table>
                        <div id="map-canvas" style="width:100%;height:400px;border-radius:8px;"></div>
                    </div>
                </div>
                </div>
            <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary', 'div' => array('class' => 'text-center col-md-12 mt-4')));

            elseif ($this->request->data['Client']['type_id'] == 2):
                echo $this->Form->create('Client'); ?>
                <div class="row">
                <div class="col-md-6">
                    <?php
                    echo $this->Form->input('id', array('class' => 'form-control'));

                    echo $this->Form->input('type_id', array('label' => 'Type', 'class' => 'form-control'));
                    echo $this->Form->input('code_wavsoft', array('label' => 'Code wavsoft', 'class' => 'form-control'));
                    echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                    $types = array("Client" => "Client", "Prospect" => "Prospect");
                    echo $this->Form->input('type_pharmacie', array('class' => 'form-control', 'options' => $types));
                    //echo $this->Form->input('secteur_id', array('label' => 'Secteur','class' => 'form-control'));
                    ?>
                    <div class="input select">
                        <label for="regions">Région</label>
                        <select name="data[Client][region_id]" id="ClientRegionId" class="form-control select2" onchange="region_change();">

                        </select>
                    </div>
                    <div class="input select" id="ville">
                        <label for="regions">Ville</label>
                        <select name="data[Client][]" class="form-control" id="ClientVilleId" onchange="villes_change();">
                            <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['ville']; ?></option>
                        </select>
                    </div>
                    <div id="secteur" class="input select" id="secteur">
                        <label for="regions">Secteur</label>
                        <select name="data[Client][secteur_id]" class="form-control" id="ClientSecteurId">
                            <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['secteur']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    $clientcall = array("0" => "Non", "1" => "Oui");
                    echo $this->Form->input('client_call', array("options" => $clientcall, 'label' => "Client de centre d'appel", 'class' => 'form-control'));
                    echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                    echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                    echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                    echo $this->Form->input('tel', array('label' => 'GSM', 'class' => 'form-control'));
                    echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                    echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                    echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="input select">
                            <label>Type de pharmacie</label>
                            <select name="data[Client][A]" class="form-control">
                                <?php
                                $selected = '';
                                $this->request->data['Client']['A'] = $this->request->data['Client']['potentialite'][0];
                                $this->request->data['Client']['1'] = $this->request->data['Client']['potentialite'][1];
                                $this->request->data['Client']['e'] = substr($this->request->data['Client']['potentialite'], 2);
                                if ("A" == $this->request->data['Client']['A']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='A'>Pharmacie grande</option>";
                                $selected = '';
                                if ("B" == $this->request->data['Client']['A']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='B'>Pharmacie moyenne</option>";
                                $selected = '';
                                if ("C" == $this->request->data['Client']['A']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected  value='C'>Pharmacie petite</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="input select">
                            <label>Commande des produits</label>
                            <select name="data[Client][1]" class="form-control" id="ClientCategoryId">
                                <?php
                                $selected = '';
                                if ("1" == $this->request->data['Client']['1']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='1'>Commande (cliente directe)</option>";
                                $selected = '';
                                if ("2" == $this->request->data['Client']['1']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='2'>Pack (cliente indirecte)</option>";
                                $selected = '';
                                if ("3" == $this->request->data['Client']['1']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected  value='3'>Non cliente</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="input select">
                            <label>Emplacement du pharmacie</label>
                            <select name="data[Client][e]" class="form-control">
                                <?php
                                $selected = '';
                                if ("Centre" == $this->request->data['Client']['e']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='Centre'>Centre</option>";
                                $selected = '';
                                if ("Moyen" == $this->request->data['Client']['e']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected value='Moyen'>Moyen</option>";
                                $selected = '';
                                if ("Periphérique" == $this->request->data['Client']['e']) {
                                    $selected = ' selected ';
                                }
                                echo "<option $selected  value='Periphérique'>Périphérique</option>";
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="input select">
                            <label>Map</label>
                            <table class="table">
                                <tr>
                                    <td><label>Latitude:</label></td>
                                    <td><?php echo $this->Form->input('latitude', array('id' => 'latitude_mag', 'label' => false)); ?></td>
                                    <td><label>Longitude:</label></td>
                                    <td><?php echo $this->Form->input('longitude', array('id' => 'longitude_mag', 'label' => false)); ?></td>
                                </tr>
                            </table>
                            <div id="map-canvas" style="width:100%;height:400px;border-radius:8px;"></div>
                        </div>
                    </div>
                    </div>
                <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary', 'div' => array('class' => 'text-center col-md-12 mt-4')));

            else :
                echo $this->Form->create('Client'); ?>
                    <div class="col-lg-12 col-md-12">
                        <?php
                        echo $this->Form->input('id', array('class' => 'form-control'));
                        echo $this->Form->input('type_id', array('label' => 'Type', 'class' => 'form-control'));
                        echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control'));
                        $types = array("Client" => "Client", "Prospect" => "Prospect");
                        echo $this->Form->input('type_pharmacie', array('label' => 'Type de client', 'class' => 'form-control', 'options' => $types));
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control'));
                        echo $this->Form->input('tel', array('label' => 'GSM', 'class' => 'form-control'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control', 'type' => 'text'));
                        echo $this->Form->input('code_wavsoft', array('class' => 'form-control'));
                        ?>
                        <div class="input select">
                            <label for="regions">Région</label>
                            <select name="data[Client][region_id]" id="ClientRegionId" class="form-control select2" onchange="region_change();">

                            </select>
                        </div>
                        <div class="input select" id="ville">
                            <label for="regions">Ville</label>
                            <select name="data[Client][]" class="form-control" id="ClientVilleId" onchange="villes_change();">
                                <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['ville']; ?></option>
                            </select>
                        </div>
                        <div id="secteur" class="input select" id="secteur">
                            <label for="regions">Secteur</label>
                            <select name="data[Client][secteur_id]" class="form-control" id="ClientSecteurId">
                                <option value='<?php echo $secteur['Secteur']['id']; ?>'><?php echo $secteur['Secteur']['secteur']; ?></option>
                            </select>
                        </div>


                    </div>
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary', 'div' => array('class' => 'text-center col-md-12 mt-4'))); ?>

                    <div class="col-lg-12 col-md-12">
                        <div class="input select">
                            <label>Map</label>
                            <table class="table">
                                <tr>
                                    <td><label>Latitude:</label></td>
                                    <td><?php echo $this->Form->input('latitude', array('id' => 'latitude_mag', 'label' => false)); ?></td>
                                    <td><label>Longitude:</label></td>
                                    <td><?php echo $this->Form->input('longitude', array('id' => 'longitude_mag', 'label' => false)); ?></td>
                                </tr>
                            </table>
                            <div id="map-canvas" style="width:100%;height:400px;border-radius:8px;"></div>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
echo $this->Html->script('jquery-2.2.3.min');
?>
<script>
    $(document).ready(function() {
        $("#regions").change(function() {
            var id = $("#regions").val();
            var image = "<center><img src='/img/loading.gif' style='width: 30px;' ></center>";
            $("#ville").empty();
            $(image).appendTo("#ville");
            $("#ville").show();
            $.post(
                '/clientsproposes/system_get_ville/' + id, {
                    //id: $("#ChembreBlocId").val()
                },
                function(data) {
                    $("#ville").empty();
                    $(data).appendTo("#ville");
                    $("#ville").show();
                },
                'text' // type
            );
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q&amp;"></script>

<script>
    var map;
    var markers = [];

    function initialize() {
        var haightAshbury = new google.maps.LatLng(<?php
                                                    if (!empty($this->request->data['Client']['latitude'])) {
                                                        echo $this->request->data['Client']['latitude'];
                                                    ?>, <?php
                                                        echo $this->request->data['Client']['longitude'];
                                                    } else {
                                                        echo "33.536814 , -7.600853";
                                                    }
                                                        ?>);
        var mapOptions = {
            zoom: 10,
            center: haightAshbury,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        // This event listener will call addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(event) {
            addMarker(event.latLng);
            document.getElementById("latitude_mag").value = event.latLng.lat();
            document.getElementById("longitude_mag").value = event.latLng.lng();
        });


        // Adds a marker at the center of the map.
        var mypos = new google.maps.LatLng(<?php
                                            if (!empty($this->request->data['Client']['latitude'])) {
                                                echo $this->request->data['Client']['latitude'];
                                            ?>, <?php
                                                echo $this->request->data['Client']['longitude'];
                                            } else {
                                                echo '';
                                            }
                                                ?>);
        addMarker(mypos);

    }

    // Add a marker to the map and push to the array.
    function addMarker(location) {
        deleteOverlays();
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            animation: google.maps.Animation.DROP
        });
        markers.push(marker);

    }
    // Deletes all markers in the array by removing references to them
    function deleteOverlays() {
        if (markers) {
            for (i in markers) {
                markers[i].setMap(null);
            }
            markers.length = 0;
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php echo $this->Html->script('select2.full.min'); ?>
<script type="text/javascript">
    $(function() {
        $("#ClientSecteurId, #game, #produit_list, #ClientVilleId, #ClientRegionId").select2();
    });
</script>