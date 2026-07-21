<?php
echo $this->Html->css("style_radio");
echo $this->Html->css("style_rapport");
echo $this->Html->css("style_range");
echo $this->Html->css("jquery.datetimepicker");

echo $this->Html->script("fontawesome");
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

<?php
// Example string representing JSON-encoded vendors data
// debug($client['Client']['vendeur']);
$vendeurJson = $client['Client']['vendeur'];

if (empty($vendeurJson)) {
    $vendeurs = [];
} else {
    $decoded = json_decode($vendeurJson, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        // Ensure every element is a proper associative array
        $vendeurs = array_filter($decoded, function ($item) {
            return is_array($item) && isset($item['nom']);
        });
        $vendeurs = array_values($vendeurs); // Re-index after filter
    } else {
        // If it's a plain string like "Ahmed", wrap it properly
        // so the table doesn't break
        $vendeurs = [['nom' => $vendeurJson, 'tel' => '']];
    }
}

// debug($vendeurs);
?>


<style type="text/css">
    .fa-exclamation-triangle {
        font-size: 27px;
        color: #ec0000;
    }

    .panel-info>.panel-heading {
        color: #ffffff;
        background: linear-gradient(45deg, #019ffb, #29f499);
    }

    .statut {
        font-size: 19px !important;
    }

    .alert_pre1 {
        display: none;
    }

    .bg-chrono {
        position: fixed;
        right: 10px;
        width: auto;
        box-shadow: 0 0 16px 5px #00000029;
    }

    @media only screen and (max-width: 800px) {
        .bg-chrono {
            position: fixed;
            right: 16px;
            width: auto;
        }
    }

    @media only screen and (max-width: 600px) {
        .bg-chrono {
            zoom: 0.6;
            bottom: 30px;
        }
    }

    /*   for checkbox  */

    .checkbox {
        --background: #fff;
        --border: #D1D6EE;
        --border-hover: #009688;
        --border-active: #009688;
        --tick: #fff;
        position: relative;
    }

    .checkbox input,
    .checkbox svg {
        width: 21px;
        height: 21px;
        display: block;
    }

    .checkbox input {
        -webkit-appearance: none;
        -moz-appearance: none;
        position: relative;
        outline: none;
        background: var(--background);
        border: none;
        margin: 0;
        padding: 0;
        cursor: pointer;
        border-radius: 4px;
        transition: box-shadow 0.3s;
        box-shadow: inset 0 0 0 var(--s, 1px) var(--b, var(--border));
    }

    .checkbox input:hover {
        --s: 2px;
        --b: var(--border-hover);
    }

    .checkbox input:checked {
        --b: var(--border-active);
    }

    .checkbox svg {
        pointer-events: none;
        fill: none;
        stroke-width: 2px;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke: var(--stroke, var(--border-active));
        position: absolute;
        top: 0;
        left: 3px;
        width: 21px;
        height: 21px;
        transform: scale(var(--scale, 1)) translateZ(0);
    }

    .checkbox.bounce {
        --stroke: var(--tick);
        padding-left: 23px;
    }

    .checkbox.bounce input:checked {
        --s: 11px;
    }

    .checkbox.bounce input:checked+svg {
        -webkit-animation: bounce 0.4s linear forwards 0.2s;
        animation: bounce 0.4s linear forwards 0.2s;
    }

    .checkbox.bounce svg {
        --scale: 0;
    }

    #headingOne {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        background: #fafafa;
    }

    @-webkit-keyframes bounce {
        50% {
            transform: scale(1.2);
        }

        75% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes bounce {
        50% {
            transform: scale(1.2);
        }

        75% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    .checkbox label {
        padding-left: 10px;
        margin: 0px 0px 8px 0px;
    }

    @media (min-width: 768px) and (max-width: 1024px) {

        .bg-chrono {
            position: fixed;
            bottom: 30px;
            top: auto;
        }

    }

    .div_add_btn {
        display: flex;
        justify-content: flex-end;
        margin-top: 13px;
    }

    .questions6no,
    .questions6oui {
        display: none;
    }


    /*end checkbox*/
</style>
<div class="row">
    <div class="col-md-3">
        <div class="col-md-12 bg-wh">
            <div class="head-img">
                <img src="<?php echo $this->webroot . 'img/female-user.png'; ?>" style="width: 135px;">
            </div>
            <table style="width: 100%;">
                <?php
                //echo $this->Form->create('Client', array('div' => false));
                echo $this->Form->hidden('client_id', array('value' => $client['Client']["id"]));
                ?>
                <tr>
                    <th>Script campagne</th>
                    <td> : </td>
                    <td><a target="_blank" href="<?php echo $this->webroot . 'img/affaires/' . $affaire['Prospectcompagne']['file']; ?>"><?php echo $affaire['Prospectcompagne']['name'] ?></a></td>
                </tr>
                <tr>
                    <th>Société</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["nom"] != '')
                            echo $client['Client']["nom"];
                        else
                            echo $this->Form->input('nom', array("id" => "nom", "label" => false, 'class' => 'form-control'));
                        ?> </td>
                </tr>
                <tr>
                    <th>Nom / Prenom</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["dirigent"] != '')
                            echo $client['Client']["dirigent"];
                        else
                            echo $this->Form->input('dirigent', array("id" => "dirigent", "label" => false, 'class' => 'form-control'));
                        ?> </td>
                </tr>
                <tr>
                    <th>Vendeur</th>
                    <td> : </td>
                    <td class="vendeur_td">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#popup_vendor">
                            <i class="fa fa-users"></i>
                            <span class="count_vd"><?php
                                                    echo count($vendeurs); ?></span>
                        </button>
                        <?php
                        echo $this->Form->hidden('vendeur', array(
                            'value' => $vendeurJson, // This will be set by JavaScript
                            'id' => 'vendeur',
                            'label' => false,
                            'class' => 'form-control'
                        ));
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Mail</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["mail"] != '')
                            echo $client['Client']["mail"];
                        else
                            echo $this->Form->input('mail', array("id" => "mail", "label" => false, 'class' => 'form-control'));
                        ?></td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["adress"] != '')
                            echo $client['Client']["adress"];
                        else
                            echo $this->Form->input('adress', array("id" => "adress", "label" => false, 'class' => 'form-control'));
                        ?></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td> : </td>
                    <td><?php echo $client['Secteur']["ville"]; ?></td>
                </tr>
                <tr>
                    <th>Fixe</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["fixe"] != '')
                            echo $client['Client']["fixe"];
                        else
                            echo $this->Form->input('fixe', array("id" => "fixe", "label" => false, 'class' => 'form-control'));
                        ?></td>
                </tr>
                <tr>
                    <th>GSM</th>
                    <td> : </td>
                    <td><?php
                        if ($client['Client']["tel"] != '')
                            echo $this->Form->input('tel', array("id" => "tel", "label" => false, 'class' => 'form-control', 'value' => $client['Client']["tel"]));
                        else
                            echo $this->Form->input('tel', array("id" => "tel", "label" => false, 'class' => 'form-control'));
                        ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td> : </td>
                    <td><?php echo $client['Client']["type_pharmacie"]; ?></td>
                </tr>
                <tr>
                    <th>Catégorie</th>
                    <td> : </td>
                    <td><?php echo $client['Category']["name"]; ?></td>
                </tr>
                <tr>
                    <th>Remarque</th>
                    <td> : </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea name="data[rmq]" id="rmq" style="width: 100%;"><?php if (isset($client['Client']["rmq"])) {
                                                                                        echo trim($client['Client']["rmq"]);
                                                                                    } ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <td>
                        <button href="#" class="alert alert-info edite" onclick="editclient(<?php echo $client['Client']['id']; ?>)">Editer</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-6" style="margin-left: -11px;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Ajouter un rapport prospect'); ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Rapportprocpect', array('onsubmit' => 'return verifed()', 'class' => 'form1')); ?>

                <?php
                echo $this->Form->hidden('client_id', array('value' => $client['Client']["id"]));
                echo $this->Form->hidden('prospectfeuille_id', array('value' => $feuille_id));
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="questions questions1">
                            <label><b>1-</b> Connaissance produit ?</label>
                            <p>
                                <input type="radio" id="test1" name="data[Rapportprocpect][connaissance]" value="Oui" required="required">
                                <label for="test1">Oui</label>
                            </p>
                            <p>
                                <input type="radio" id="test2" name="data[Rapportprocpect][connaissance]" value="Non" required="required">
                                <label for="test2">Non</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="questions questions2">
                            <label><b>2-</b> Disponibilité produit</label>
                            <p>
                                <input type="radio" id="despo" name="data[Rapportprocpect][disponibilite]" value="Oui">
                                <label for="despo">Oui</label>
                            </p>
                            <p>
                                <input type="radio" id="despo2" name="data[Rapportprocpect][disponibilite]" value="Non">
                                <label for="despo2">Non</label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info alert_pre1" role="alert"><strong>faire une présentation détaillée du produit !</strong></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class=" questions questions3">
                            <label><b>3-</b> Avez vous réalisé des ventes?</label>
                            <p>
                                <input type="radio" id="realise1" name="data[Rapportprocpect][vente]" value="Oui">
                                <label for="realise1">Oui</label>
                            </p>
                            <p>
                                <input type="radio" id="realise2" name="data[Rapportprocpect][vente]" value="Non">
                                <label for="realise2">Non</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" questions questions4">
                            <label><b>4-</b> Si oui , comment</label>
                            <p>
                                <input type="radio" id="comment1" name="data[Rapportprocpect][comment]" value="Prescription">
                                <label for="comment1">Prescription</label>
                            </p>
                            <p>
                                <input type="radio" id="comment2" name="data[Rapportprocpect][comment]" value="Conseil">
                                <label for="comment2">Conseil</label>
                            </p>
                            <p>
                                <input type="radio" id="comment3" name="data[Rapportprocpect][comment]" value="Les deux">
                                <label for="comment3">Les deux</label>
                            </p>

                        </div>
                    </div>
                    <div class="col-md-12 alert_presentation">
                        <div class="alert alert-info" role="alert"><strong>Faire un rappel du produit</strong></div>
                    </div>
                </div>

                <div class="questions questions5">
                    <label><b>5-</b> Voulez vous qu'un commercial vous communique nos offres commerciales?</label>
                    <p>
                        <input type="radio" id="commmerciale1" name="data[Rapportprocpect][commercial]" value="Oui" required="required">
                        <label for="commmerciale1">Oui</label>
                    </p>
                    <p>
                        <input type="radio" id="commmerciale2" name="data[Rapportprocpect][commercial]" value="Non" required="required">
                        <label for="commmerciale2">Non</label>
                    </p>
                </div>
                <div class="questions questions6no">
                    <label><b>6-</b> Mise en place produit de la campagne </label>
                    <p>
                        <input type="radio" id="commande1" name="data[Rapportprocpect][commande]" value="Promesse">
                        <label for="commande1">Promesse </label>
                    </p>
                    <p>
                        <input type="radio" id="commande2" name="data[Rapportprocpect][commande]" value="Attente prescription">
                        <label for="commande2">Attente prescription</label>
                    </p>
                    <p>
                        <input type="radio" id="commande3" name="data[Rapportprocpect][commande]" value="Refusée">
                        <label for="commande3">Refusée</label>
                    </p>
                </div>
                <div class="questions questions6oui">
                    <label><b>6-</b> Voulez-vous qu'un commercial vous communique la campagne actuelle ?</label>
                    <p>
                        <input type="radio" id="commande4" name="data[Rapportprocpect][commercial_campagne]" value="Oui">
                        <label for="commande4">Oui</label>
                    </p>
                    <p>
                        <input type="radio" id="commande5" name="data[Rapportprocpect][commercial_campagne]" value="Non">
                        <label for="commande5">Non</label>
                    </p>
                </div>

                <div class="question questions7">
                    <label><b>7-</b> Degré de satisfaction Call Center</label>
                    <div class="page">
                        <!-- Range Control -->
                        <div class="range" data-range>
                            <input type="range" value="" min="0" max="100" step="25" list="options" class="range__input" id="bar" name="data[Rapportprocpect][appreciation]" data-range-input />

                            <!-- Options -->
                            <datalist class="range__list" id="options" required="required">
                                <option value="0" data-range-link="step-1" />
                                <option value="25" data-range-link="step-2" />
                                <option value="50" data-range-link="step-3" />
                                <option value="75" data-range-link="step-4" />
                                <option value="100" data-range-link="step-5" />
                            </datalist>
                        </div>

                        <!-- Content -->
                        <div>
                            <div data-range-step="step-1">
                                <b class="statut"><i class="fal fa-angry"></i> Très défavorable</b>
                            </div>

                            <div data-range-step="step-2">
                                <b class="statut"><i class="fal fa-frown"></i> Défavorable</b>
                            </div>

                            <div data-range-step="step-3">
                                <b class="statut"><i class="fal fa-meh-rolling-eyes"></i> Pas mal</b>
                            </div>

                            <div data-range-step="step-4">
                                <b class="statut"> <i class="fal fa-smile-beam"></i> Favorable</b>
                            </div>

                            <div data-range-step="step-5">
                                <b class="statut"> <i class="fal fa-laugh-beam"></i> Très favorable</b>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="questions questions9">
                    <label><b>8-</b>Réclamation client</label>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Demande delegue" id="commande8">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande8">Demande délégué</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Demande echantillons" id="commande9">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande9">Demande échantillons</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Demande flyer/panneaux/plv" id="commande10">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande10">Demande flyer/panneaux/plv</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Demande gadgets publicitaires" id="commande11">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande11">Demande gadgets publicitaires</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Rupture produit" id="commande12">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande12">Rupture produit</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][reclamation][]" value="Rupture produit" id="commande25">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande25">Ancienne réclamation non traitée</label>
                    </p>
                </div>
                <div class="questions questions10">
                    <label><b>9-</b>Objections</label>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Probleme de prescription" id="commande13">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande13">Problème de prescription </label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Prix produit" id="commande14">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande14">Prix produit</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Indication rare" id="commande15">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande15">Indication rare</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Retour client negatif" id="commande16">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande16">Retour client négatif</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Produit dispo mais ne se vend pas" id="commande17">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande17">Produit dispo mais ne se vend pas</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][objection][]" value="Pharmacie ne fait pas de conseil" id="commande18">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande18">Pharmacie ne fait pas de conseil</label>
                    </p>
                </div>
                <div class="question questions11">
                    <label><b>10-</b>Propositions </label>
                    <textarea class="form-control" name="data[Rapportprocpect][proposition]" placeholder="Votre réponse"></textarea>
                </div>
                <div class="questions questions12">
                    <label><b>11-</b>Qualification contact</label>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Donne du temps/ecoute" id="commande19">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande19">Donne du temps/écoute</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Mise en place assuree" id="commande20">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande20">Mise en place assurée</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Commande assuree" id="commande21">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande21">Commande assurée</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Benchmark" id="commande22">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande22">Benchmark</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Pharmacie conseil" id="commande23">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande23">Pharmacie conseil</label>
                    </p>
                    <p class="checkbox bounce ">
                        <input type="checkbox" name="data[Rapportprocpect][qualification][]" value="Interet tres faible pour la prospection telephonique" id="commande24">
                        <svg viewBox="0 0 21 21">
                            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                        </svg>
                        <label for="commande24">Intérêt très faible pour la prospection téléphonique</label>
                    </p>
                </div>
                <!-- --------------------------- begin the hide tab -------------------------------- -->
                <div id="accordion">
                    <div class="card" data-toggle="collapse" data-target="#questionsCollapse">
                        <div class="card-header" id="headingOne">
                            <label> Questionnaire commercial
                            </label>
                            <button class="btn btn-secondary">
                                <img src="/img/arrow-bottom.gif" alt="" style="width: 18px;">
                            </button>
                        </div>
                    </div>


                    <div id="questionsCollapse" class="collapse">
                        <div class="questions questions13">
                            <label><b>1-</b>Type Achat Direct Nombre de CMD</label>
                            <p>
                                <input type="radio" id="tp_achat1" name="data[Rapportprocpect][type_achat_direct]" value="Unitaire">
                                <label for="tp_achat1">Unitaire</label>
                            </p>
                            <p>
                                <input type="radio" id="tp_achat2" name="data[Rapportprocpect][type_achat_direct]" value="12">
                                <label for="tp_achat2">12</label>
                            </p>
                            <p>
                                <input type="radio" id="tp_achat3" name="data[Rapportprocpect][type_achat_direct]" value="24">
                                <label for="tp_achat3">24</label>
                            </p>
                        </div>
                        <div class="questions questions14">
                            <label><b>2-</b>Type Achat Grossiste Nombre de CMD</label>
                            <p>
                                <input type="radio" id="tp_achat_g1" name="data[Rapportprocpect][type_achat_grossiste]" value="1 fois">
                                <label for="tp_achat_g1">1 fois</label>
                            </p>
                            <p>
                                <input type="radio" id="tp_achat_g2" name="data[Rapportprocpect][type_achat_grossiste]" value="2 fois">
                                <label for="tp_achat_g2">2 fois</label>
                            </p>
                            <p>
                                <input type="radio" id="tp_achat_g3" name="data[Rapportprocpect][type_achat_grossiste]" value="3 fois">
                                <label for="tp_achat_g3">3 fois</label>
                            </p>
                            <p>
                                <input type="radio" id="tp_achat_g4" name="data[Rapportprocpect][type_achat_grossiste]" value="plus">
                                <label for="tp_achat_g4">Plus</label>
                            </p>
                        </div>
                        <div class="questions questions15">
                            <label><b>3-</b>Fréquence Passage Commercial</label>
                            <p>
                                <input type="radio" id="frequence_passage_commercial_1" name="data[Rapportprocpect][frequence_passage_commercial]" value="Retard">
                                <label for="frequence_passage_commercial_1">Retard</label>
                            </p>
                            <p>
                                <input type="radio" id="frequence_passage_commercial_2" name="data[Rapportprocpect][frequence_passage_commercial]" value="Absence">
                                <label for="frequence_passage_commercial_2">Absence</label>
                            </p>
                            <p>
                                <input type="radio" id="frequence_passage_commercial_3" name="data[Rapportprocpect][frequence_passage_commercial]" value="Fréquent">
                                <label for="frequence_passage_commercial_3">Fréquent</label>
                            </p>
                            <p>
                                <input type="radio" id="frequence_passage_commercial_4" name="data[Rapportprocpect][frequence_passage_commercial]" value="Non Renseigné">
                                <label for="frequence_passage_commercial_4">Non Renseigné</label>
                            </p>
                        </div>
                        <div class="questions questions16">
                            <label><b>4-</b>Commande Groupée</label>
                            <p>
                                <input type="radio" id="commande_groupee_1" name="data[Rapportprocpect][commande_groupee]" value="Oui">
                                <label for="commande_groupee_1">Oui</label>
                            </p>
                            <p>
                                <input type="radio" id="commande_groupee_2" name="data[Rapportprocpect][commande_groupee]" value="Non">
                                <label for="commande_groupee_2">Non</label>
                            </p>
                        </div>
                        <div class="questions questions17">
                            <label><b>5-</b>Objection Produit</label>
                            <p class="checkbox bounce">
                                <input type="checkbox" name="data[Rapportprocpect][objection_two][]" value="Prix" id="objection_1">
                                <svg viewBox="0 0 21 21">
                                    <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                                </svg>
                                <label for="objection_1">Prix</label>
                            </p>
                            <p class="checkbox bounce">
                                <input type="checkbox" name="data[Rapportprocpect][objection_two][]" value="Nombre de comprimés" id="objection_2">
                                <svg viewBox="0 0 21 21">
                                    <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                                </svg>
                                <label for="objection_2">Nombre de comprimés</label>
                            </p>
                            <p class="checkbox bounce">
                                <input type="checkbox" name="data[Rapportprocpect][objection_two][]" value="Flacon Plastique" id="objection_3">
                                <svg viewBox="0 0 21 21">
                                    <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                                </svg>
                                <label for="objection_3">Flacon Plastique</label>
                            </p>
                            <p class="checkbox bounce">
                                <input type="checkbox" name="data[Rapportprocpect][objection_two][]" value="Autres" id="objection_4">
                                <svg viewBox="0 0 21 21">
                                    <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                                </svg>
                                <label for="objection_4">Autres</label>
                            </p>
                        </div>

                        <div class="questions questions18">
                            <label><b>6-</b>Statut Client</label>
                            <p>
                                <input type="radio" id="statut_client_1" name="data[Rapportprocpect][statut_client]" value="Promoteur">
                                <label for="statut_client_1">Promoteur</label>
                            </p>
                            <p>
                                <input type="radio" id="statut_client_2" name="data[Rapportprocpect][statut_client]" value="Detracteur">
                                <label for="statut_client_2">Detracteur</label>
                            </p>
                            <p>
                                <input type="radio" id="statut_client_3" name="data[Rapportprocpect][statut_client]" value="NPS">
                                <label for="statut_client_3">NPS</label>
                            </p>
                            <p>
                                <input type="radio" id="statut_client_4" name="data[Rapportprocpect][statut_client]" value="Non Renseigné">
                                <label for="statut_client_4">Non Renseigné</label>
                            </p>
                        </div>

                    </div>
                </div>
                <?php
                echo $this->Form->hidden('duree', array('class' => 'form-control', 'id' => 'duree'));
                ?>

            </div>
            <div class="box-footer">
                <div class="well text-center"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#reportermodal" style="float: left;">
                        <i class="fas fa-bow-arrow" style="transform: rotate3d(1, 1, 36, -90deg);"></i> Reporter
                    </button>
                    <button class="btn btn-success" id="envoyer" type="submit"><i class="fas fa-share"></i> Envoyer</button>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#annulermodal" style="float: right;">
                        <i class="far fa-times-circle"> </i> Annuler
                    </button>
                </div>

            </div>
        </div>
    </div>
    </form>
    <div class="col-md-2 bg-wh bg-chrono">
        <div class="head-img">
            <img src="/img/call.png">
        </div>
        <h3>Durée de l'appel</h3>
        <div id="chronometer">
            <span id="hours">00</span>
            <span>&nbsp:&nbsp</span>
            <span id="minutes">00</span><span>&nbsp:&nbsp</span><span id="seconds">00</span><span style="display: none;" id="thousandths">0.00</span>

            <div class="chrono">
                <div id="buttons">
                    <a id="change" onclick="incrum()"><img src="/img/power-button.png"></a>
                    <a id="init"><img src="/img/reset.png"></a>
                </div>

                <table id="log"></table>
            </div>
        </div>
    </div>
</div>


<!-- Modal annulation -->
<div class="modal fade" id="annulermodal" tabindex="-1" role="dialog" aria-labelledby="annulermodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Motif d'annulation</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('Rapportprocpect', array('url' => array('action' => 'annuler_appel')));
                echo $this->Form->hidden('prospectfeuille_id', array('value' => $feuille_id)); ?>
                <textarea name="data[Rapportprocpect][motif]" class="form-control" id="RapportprocpectMotif"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fal fa-arrow-left"> </i> Retour</button>
                <button class="btn btn btn-danger" type="submit" value="Annuler"><i class="far fa-calendar-times"></i> Annuler Le rapport</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal report -->
<div class="modal fade" id="reportermodal" tabindex="-1" role="dialog" aria-labelledby="reportermodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Date et heure du report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Rapportprocpect', array('url' => array('action' => 'reporter_appel')));
                echo $this->Form->hidden('prospectfeuille_id', array('value' => $feuille_id));
                echo $this->Form->input('rappel', array('label' => "Date et heure", 'class' => 'form-control', 'type' => 'text', "id" => "datetimepicker", "autocomplete" => "off"));

                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fal fa-arrow-left"> </i> Retour</button>
                <button class="btn btn-info" type="submit" value="Reporter"><i class="fas fa-bow-arrow" style="transform: rotate3d(1, 1, 36, -90deg);"></i> Reporter</button>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- Modal 1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title"><i class="fal fa-exclamation-triangle"></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="red()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body text-center">
                <h3>
                    Vous n'avez pas lancé le temps d'appel</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="red()" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title"><i class="fal fa-exclamation-triangle"></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="red()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body text-center">
                <h3>
                    Voulez-vous arrêter la durée de l'appel ?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="arreter()" data-dismiss="modal">Oui ,Et envoyer </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non pas encore</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal 3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title"><i class="fal fa-exclamation-triangle"></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="red()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body text-center">
                <h3>
                    Vous avez stopper la durée de l'appel, Voulez-vous continuer?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" id="stop" class="btn btn-primary" onclick="stopper()" data-dismiss="modal">Oui continuer </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="popup_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="popup_vendorLabel">Ajouter plusieurs vendeurs</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php


                    if ($client['Client']["vendeur"] != '' && is_array($vendeurs)) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Tel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vendeurs as $vendeur) : ?>
                                    <tr>
                                        <td><?php echo isset($vendeur['nom']) ? h($vendeur['nom']) : ''; ?></td>
                                        <td><?php echo isset($vendeur['tel']) ? h($vendeur['tel']) : ''; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php }
                    ?>

                </div>
                <div class="all_content">
                    <div class="row vendor-row">
                        <div class="col-md-6">
                            <label>Nom :</label>
                            <input type="text" class="form-control vendor-nom">
                        </div>
                        <div class="col-md-6">
                            <label>Tel :</label>
                            <input type="text" class="form-control vendor-tel">
                        </div>
                    </div>
                </div>
                <div class="div_add_btn">
                    <button class="btn btn-default" onclick="addVendorRow()"> + </button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="assembleVendors()">Ok</button>
            </div>
        </div>
    </div>
</div>


<?php ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<?php

echo $this->Html->script("chrono");
echo $this->Html->script("script_range");
?>


<script type="text/javascript">
    k = false;
    envoyer_2fois = 0;
    $('.form1 :input').on('change', function() {

        if (c == 2) {

            k = true;
            $(this).removeAttr("checked");
            verifed();

        } else {
            k = false;
        }
        return k;
    });


    $('input:radio[name="data[Rapportprocpect][connaissance]"]').change(
        function() {
            if ($(this).val() == 'Non') {
                $(".questions2, .questions3, .questions4, .alert_presentation").hide("slow");
                $(".alert_pre1").show("slow");
                $('.questions2 input:radio, .questions3 input:radio').removeAttr("required");
            } else {
                $(".questions2, .questions3, .questions4, .alert_presentation").show("slow");
                $(".alert_pre1").hide("slow");
                $('.questions2 input:radio, .questions3 input:radio').attr("required", "required");
            }
        });
    $('input:radio[name="data[Rapportprocpect][commercial]"]').change(
        function() {
            if ($(this).val() == 'Oui') {
                $(".questions6no").hide("slow");
                $('.questions6no input:radio').removeAttr("required");
                $(".questions6oui").show("slow");
                $('.questions6oui input:radio').attr("required", "required");
            } else {
                $(".questions6no").show("slow");
                $('.questions6no input:radio').attr("required", "required");
                $(".questions6oui").hide("slow");
                $('.questions6oui input:radio').removeAttr("required");
            }
        });
    $('input:radio[name="data[Rapportprocpect][vente]"]').change(
        function() {
            if ($(this).val() == 'Non') {
                $(".questions4").hide("slow");
                $('.questions4 input:radio').removeAttr("required");
            } else {
                $(".questions4").show("slow");
                $('.questions4 input:radio').attr("required", "required");
            }
        });
    var c = 0;
    $(".form1 :input, .form1 :submit").prop("disabled", true);

    function incrum() {


        if (c == 1) {
            $(".form1 :input, .form1 :submit").prop("disabled", false);
            c = 2;

        } else if (c == 0) {
            $(".form1 :input, .form1 :submit").prop("disabled", false);
            c = 1;

        } else if (c == 2) {
            c = 1;
            $(".form1 :input, .form1 :submit").prop("disabled", false);
        }
        console.log(c);
        return c;
    }

    function arreter() {
        $('#change').trigger('click');
        $('#envoyer').trigger('click');
    }

    function stopper() {
        $('#change').trigger('click');
        c = 1;
    }

    function verifed() {
        var isChecked = $('.questions12 input[type="checkbox"]:checked').length > 0;
        if (!isChecked) {
            event.preventDefault();
            alert("La question 11 est obligatoire.");
            return false;
        }
        if (c == 0) {
            $('#exampleModal').modal('show');
            return false;
        } else if (c == 1) {
            $('#exampleModal2').modal('show');
            return false;
        } else {
            if (k == true) {
                $('#exampleModal3').modal('show');
                return false;
            } else {
                if (envoyer_2fois == 0) {
                    envoyer_2fois = 1;
                    return true;
                    console.log(envoyer_2fois);
                } else {
                    return false;
                    console.log(envoyer_2fois);
                }
            }
        }

    }


    function red() {
        $(".bg-wh")
            .animate({
                right: "13px"
            }, 100)
            .animate({
                right: "10px"
            }, 100)
            .animate({
                right: "13px"
            }, 110)
            .animate({
                right: "10px"
            }, 110)
            .animate({
                right: "13px"
            }, 115)
            .animate({
                right: "10px"
            }, 115)
            .animate({
                right: "13px"
            }, 120)
            .animate({
                right: "10px"
            }, 120)
            .animate({
                right: "13px"
            }, 125)
            .animate({
                right: "10px"
            }, 125)
            .animate({
                right: "13px"
            }, 120)
            .animate({
                right: "10px"
            }, 120)
            .animate({
                right: "13px"
            }, 115)
            .animate({
                right: "10px"
            }, 115);
    }
    var slider = $("#slider").val();
    console.log(slider);

    function editclient(client_id) {
        tel = fixe = adress = vendeur = mail = nom = dirigent = "";
        if ($('#tel').val() != 'undefined')
            tel = $("#tel").val();
        console.log(tel);
        if ($('#fixe').val())
            fixe = $("#fixe").val();
        if ($('#adress').val() != 'undefined')
            adress = $("#adress").val();
        if ($('#mail').val())
            mail = $("#mail").val();
        if ($('#vendeur').val())
            vendeur = $("#vendeur").val();
        if ($('#nom').val() != 'undefined')
            nom = $("#nom").val();
        if ($('#dirigent').val())
            dirigent = $("#dirigent").val();
        if ($('#rmq').val() != 'undefined')
            rmq = $("#rmq").val();


        console.log($('#adress').val());
        $.ajax({
            url: "<?php echo $this->Html->url(array("controller" => "rapportprocpects", "action" => "edit_client_champ_vide")); ?>",
            method: "POST",
            data: {
                client_id: client_id,
                tel: tel,
                fixe: fixe,
                adress: adress,
                mail: mail,
                vendeur: vendeur,
                nom: nom,
                dirigent: dirigent,
                rmq: rmq
            },
        }).done(function(response) {
            console.log(response);
            $("#tel").prop('disabled', true);
            $("#fixe").prop('disabled', true);
            $("#adress").prop('disabled', true);
            $("#mail").prop('disabled', true);
            $("#vendeur").prop('disabled', true);
            $("#dirigent").prop('disabled', true);
            $("#nom").prop('disabled', true);
            alert("Merci, modification effectué avec succès");
        }).fail(function(jqXHR, textStatus) {
            alert("Erreur");
        });


    }
</script>




<script>
    function addVendorRow() {
        var newRowHtml = '<div class="row vendor-row">' +
            '<div class="col-md-6">' +
            '<label>Nom :</label>' +
            '<input type="text" class="form-control vendor-nom">' +
            '</div>' +
            '<div class="col-md-6">' +
            '<label>Tel :</label>' +
            '<input type="text" class="form-control vendor-tel">' +
            '</div>' +
            '</div>';
        $('.all_content').append(newRowHtml);
    }

    function assembleVendors() {
        var vendors = <?php echo json_encode($vendeurs); ?>;
        console.log(vendors);

        if (Array.isArray(vendors)) {
            $('.vendor-row').each(function() {
                var nom = $(this).find('.vendor-nom').val();
                var tel = $(this).find('.vendor-tel').val();
                if (nom && tel) {
                    vendors.push({
                        nom: nom,
                        tel: tel
                    });
                }
            });
        }

        // Prepare data for hidden input
        var vendeurInput = $('#vendeur');
        vendeurInput.val(JSON.stringify(vendors)); // Convert to JSON string or format as needed
        $("#popup_vendor").modal('hide');
        var client_id = <?php echo $client['Client']['id']; ?>;

        editclient(client_id)
        setTimeout(function() {
            location.reload();
        }, 1000);

        // Optionally, you can submit form or perform further actions here
        // Example: $('#myForm').submit();
    }
</script>

<script>
    jQuery.datetimepicker.setLocale('fr');
    jQuery('#datetimepicker').datetimepicker({
        format: 'Y-m-d H:i'
    });
</script>