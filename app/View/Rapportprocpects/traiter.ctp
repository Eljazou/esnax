<style type="text/css">
    #suivi-opportunite-container {
        --accent: #00a7d0;
        --accent-dark: #008da0;
        --accent-success: #06c773;
        --accent-success-dark: #05a861;
        --accent-warning: #f4a100;
        --border-color: #ece9f9;
        --text-dark: #2d2b42;
        --text-muted: #8b87a3;
        --bg-light: #f8f9fa;
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 2px 14px rgba(0, 167, 208, 0.06);
    }

    /* Layout & Structure Card Rules */
    #suivi-opportunite-container .panel {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-lg) !important;
        box-shadow: var(--shadow-card) !important;
        margin-bottom: 24px !important;
        overflow: hidden !important;
    }

    #suivi-opportunite-container .panel-heading {
        padding: 20px 24px !important;
        background: #fff !important;
        border-bottom: 1px solid var(--border-color) !important;
        position: relative !important;
    }

    #suivi-opportunite-container .panel-title {
        font-size: 18px !important;
        font-weight: 800 !important;
        color: var(--text-dark) !important;
        margin: 0 !important;
    }

    #suivi-opportunite-container .panel-body {
        padding: 24px !important;
    }

    /* Custom Radio Input Layout Rules */
    #suivi-opportunite-container .radio-group-wrapper {
        margin-bottom: 24px !important;
    }

    #suivi-opportunite-container .section-label {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
        margin-bottom: 14px !important;
        display: block !important;
    }

    #suivi-opportunite-container .radio-option {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        margin-bottom: 10px !important;
        cursor: pointer !important;
    }

    #suivi-opportunite-container .radio-option input[type="radio"] {
        margin: 0 !important;
        width: 18px !important;
        height: 18px !important;
        accent-color: var(--accent) !important;
        cursor: pointer !important;
    }

    #suivi-opportunite-container .radio-option label {
        font-size: 14px !important;
        font-weight: 500 !important;
        color: var(--text-dark) !important;
        margin: 0 !important;
        cursor: pointer !important;
    }

    /* Standard Interactive Textarea Fields styling */
    #suivi-opportunite-container .form-control {
        width: 100% !important;
        padding: 12px 16px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: var(--text-dark) !important;
        background-color: #fff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-sm) !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }

    #suivi-opportunite-container .form-control:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(0, 167, 208, 0.1) !important;
        outline: 0 !important;
    }

    #suivi-opportunite-container textarea.form-control {
        min-height: 100px !important;
        resize: vertical !important;
    }

    /* Actions and Submission Footers */
    #suivi-opportunite-container .panel-footer {
        background: var(--bg-light) !important;
        border-top: 1px solid var(--border-color) !important;
        padding: 16px 24px !important;
        display: flex !important;
        gap: 12px !important;
        justify-content: center !important;
    }

    /* Buttons Typography Override Rules */
    #suivi-opportunite-container .btn {
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        border-radius: var(--radius-sm) !important;
        border: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: none !important;
        transition: background 0.2s ease !important;
    }

    #suivi-opportunite-container .btn-success {
        background: var(--accent-success) !important;
        color: #fff !important;
    }
    #suivi-opportunite-container .btn-success:hover {
        background: var(--accent-success-dark) !important;
    }

    #suivi-opportunite-container .btn-primary {
        background: var(--accent) !important;
        color: #fff !important;
    }
    #suivi-opportunite-container .btn-primary:hover {
        background: var(--accent-dark) !important;
    }

    /* Customer & Report Details Tables Architecture styling */
    #suivi-opportunite-container .table {
        margin: 0 !important;
        width: 100% !important;
    }

    #suivi-opportunite-container .table > tbody > tr > th {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--text-muted) !important;
        border-top: none !important;
        padding: 10px 4px !important;
        width: 55% !important;
    }

    #suivi-opportunite-container .table > tbody > tr > td {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        border-top: none !important;
        padding: 10px 4px !important;
    }

    /* User Profile Card Styling Modifications */
    #suivi-opportunite-container .bg-wh {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-lg) !important;
        padding: 24px !important;
        box-shadow: var(--shadow-card) !important;
        text-align: center !important;
    }

    #suivi-opportunite-container .head-img {
        margin-bottom: 20px !important;
        display: flex !important;
        justify-content: center !important;
    }

    #suivi-opportunite-container .bg-wh table th {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--text-muted) !important;
        padding: 8px 0 !important;
        text-align: left !important;
    }

    #suivi-opportunite-container .bg-wh table td {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        padding: 8px 0 !important;
        text-align: left !important;
    }

    /* Dynamic Badges Realignment styling blocks */
    #suivi-opportunite-container .panel-warning .panel-heading {
        display: flex !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 20px 24px !important;
    }

    #suivi-opportunite-container .panel-warning .panel-heading h4 {
        margin: 0 !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
        flex-grow: 1 !important;
    }

    #suivi-opportunite-container .badge-pill {
        position: static !important;
        float: none !important;
        padding: 6px 12px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        border-radius: 20px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    #suivi-opportunite-container .badge-time { background-color: var(--accent) !important; color: #fff !important; }
    #suivi-opportunite-container .badge-date { background-color: #f44336 !important; color: #fff !important; }
    #suivi-opportunite-container .badge-duration { background-color: var(--accent-success) !important; color: #fff !important; }

    /* Modal Styling Architecture Framework overrides */
    .modal-content {
        border-radius: var(--radius-lg) !important;
        border: none !important;
        overflow: hidden !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    .modal-header {
        padding: 20px 24px !important;
        border-bottom: 1px solid var(--border-color) !important;
    }
    .modal-title {
        font-weight: 800 !important;
        color: var(--text-dark) !important;
        font-size: 18px !important;
    }
    .modal-body {
        padding: 24px !important;
    }
    .modal-footer {
        padding: 16px 24px !important;
        border-top: 1px solid var(--border-color) !important;
        background: var(--bg-light) !important;
    }
    .modal-footer .btn-secondary {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-muted) !important;
    }
    .modal-footer .btn-secondary:hover {
        background: var(--bg-light) !important;
    }
    .modal-body label {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
        margin-bottom: 6px !important;
    }
</style>

<?php
echo $this->Html->css("style_radio");
echo $this->Html->css("style_rapport");
echo $this->Html->css("jquery.datetimepicker");
echo $this->Html->script("fontawesome");
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

<div id="suivi-opportunite-container" class="container-fluid" style="padding: 0;">
    <div class="row">
        <!-- Main Panel Action Stream Column -->
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Suivi Opportunité</h3>
                </div>
                
                <?php echo $this->Form->create('Prospectfeuille', array('div' => false)); 
                    echo $this->Form->hidden("prospectfeuille_id", array("value" => $rapportprocpect["Rapportprocpect"]["prospectfeuille_id"]));
                ?>
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 radio-group-wrapper questions1">
                            <span class="section-label"><b>A- </b>Type de l'action</span>
                            <div class="radio-option">
                                <input type="radio" id="Appel" name="data[Prospectfeuille][commercial_type]" value="Appel" required="required">
                                <label for="Appel">Appel</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Visite" name="data[Prospectfeuille][commercial_type]" value="Visite" required="required">
                                <label for="Visite">Visite</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Les_deux" name="data[Prospectfeuille][commercial_type]" value="Les deux" required="required">
                                <label for="Les_deux">Les deux</label>
                            </div>
                        </div>

                        <div class="col-md-6 radio-group-wrapper questions2">
                            <span class="section-label"><b>B- </b>Opportunité concrétisée</span>
                            <div class="radio-option">
                                <input type="radio" id="Commande" name="data[Prospectfeuille][commercial_opportunite]" value="Commande" required="required" onchange="display_text()" class="Opportu">
                                <label for="Commande">Commande</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Pack" name="data[Prospectfeuille][commercial_opportunite]" value="Pack" required="required" onchange="display_text()" class="Opportu">
                                <label for="Pack">Pack</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="deux_opp" name="data[Prospectfeuille][commercial_opportunite]" value="Commande et pack" required="required" onchange="display_text()" class="Opportu">
                                <label for="deux_opp">Commande et pack</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Non_int" name="data[Prospectfeuille][commercial_opportunite]" value="Non intéressé" required="required" onchange="display_text()" class="Opportu">
                                <label for="Non_int">Non intéressé</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 radio-group-wrapper questions3" style="display: none;">
                            <span class="section-label"><b>C- </b>Produits vendus</span>
                            <div class="radio-option">
                                <input type="radio" id="Produit" name="data[Prospectfeuille][commercial_produits]" value="Produit de la campagne">
                                <label for="Produit">Produit de la campagne</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Autre_pro" name="data[Prospectfeuille][commercial_produits]" value="Autre produits">
                                <label for="Autre_pro">Autre produits</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="Les_deux_pro" name="data[Prospectfeuille][commercial_produits]" value="Les deux">
                                <label for="Les_deux_pro">Les deux</label>
                            </div>
                        </div>

                        <div class="col-md-12 questions4" style="margin-bottom: 20px; display: none;">
                            <span class="section-label"><b>C- </b>Raison non intéressé</span>
                            <textarea class="form-control" name="data[Prospectfeuille][commercial_raison]"></textarea>
                        </div>

                        <div class="col-md-12 question" style="margin-bottom: 10px;">
                            <span class="section-label"><b><i class="fal fa-comments-alt"></i> </b>Commentaire</span>
                            <textarea class="form-control" name="data[Prospectfeuille][commercial_commentaire]"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="panel-footer">
                    <button class="btn btn-success" type="submit" value="Envoyer">
                        Envoyer <i class="far fa-share"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportermodal">
                        <i class="far fa-alarm-clock"></i> Programmer
                    </button>
                </div>
                </form>
            </div>

            <!-- Pre-existing Survey Log Analytics Sub-Panel Info View -->
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <?php $date = explode(" ", $rapportprocpect["Rapportprocpect"]["created"]); ?>
                    <h4><i class="fas fa-user"></i> <?php echo $rapportprocpect["User"]["name"]; ?></h4>
                    <span class="badge badge-pill badge-duration"><i class="far fa-phone-alt"></i> <?php echo $rapportprocpect["Rapportprocpect"]["duree"]; ?></span>
                    <span class="badge badge-pill badge-date"><i class="fal fa-calendar-alt"></i> <?php echo $date[0]; ?></span>
                    <span class="badge badge-pill badge-time"><i class="far fa-clock"></i> <?php echo $date[1]; ?></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Connaissance produit ?</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["connaissance"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Disponibilité produit</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["disponibilite"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Avez vous réalisé des ventes ?</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["vente"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Si Oui, Comment ?</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["comment"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Voulez vous qu'un commercial ?</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["commercial"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Mise en place produit de la campagne</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["commande"]; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Pack hors campagne</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["hors_campagne"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Appréciation du produit présenté</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["appreciation"]; ?>%</td>
                                </tr>
                                <tr>
                                    <th>Questions</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["question"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Objections</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["objection"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Réclamations</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["reclamation"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Propositions</th>
                                    <td>:</td>
                                    <td><?php echo $rapportprocpect["Rapportprocpect"]["proposition"]; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Accounts Metadata Panel Column Info Card -->
        <div class="col-md-4">
            <div class="bg-wh">
                <div class="head-img">
                    <img src="<?php echo $this->webroot . 'img/female-user.png'; ?>" style="width: 120px; height: auto;">
                </div>
                <table style="width: 100%;">
                    <tr><th>Nom / Prenom</th><td>:</td><td><?php echo $rapportprocpect["Client"]["nom"]; ?></td></tr>
                    <tr><th>Adresse</th><td>:</td><td><?php echo $rapportprocpect["Client"]["adress"]; ?></td></tr>
                    <tr><th>Ville</th><td>:</td><td><?php echo $rapportprocpect["Client"]["ville"]; ?></td></tr>
                    <tr><th>Région</th><td>:</td><td><?php echo $rapportprocpect["Client"]["region"]; ?></td></tr>
                    <tr><th>Fix</th><td>:</td><td><?php echo $rapportprocpect["Client"]["fixe"]; ?></td></tr>
                    <tr><th>Mobile</th><td>:</td><td><?php echo $rapportprocpect["Client"]["tel"]; ?></td></tr>
                </table>
            </div>  
        </div>
    </div>
</div>

<!-- Modal report Architecture configuration UI block element view -->
<div class="modal fade" id="reportermodal" tabindex="-1" role="dialog" aria-labelledby="reportermodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Programmer Opportunité</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo $this->Form->create('Prospectfeuille', array('url' => array('controller' => 'rapportprocpects','action' => 'programmer_opportunites'))); ?>
            <div class="modal-body row" style="margin: 0;">
                <div class="col-md-6" style="padding-left: 0;">
                    <?php 
                    echo $this->Form->hidden('prospectfeuille_id', array('value' => $rapportprocpect["Rapportprocpect"]["prospectfeuille_id"]));
                    echo $this->Form->input('date_programmer', array('label' => "Date et heure", 'class' => 'form-control', 'type' => 'text', "id" => "datetimepicker", "autocomplete" => "off", 'div' => false));
                    ?>
                </div>
                <div class="col-md-6" style="padding-right: 0;">
                    <label>Type visite</label>
                    <select name="data[Prospectfeuille][type_visite]" class="form-control">
                        <option value="A visiter">A visiter</option>
                        <option value="A appeler">A appeler</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fal fa-arrow-left"></i> Retour</button>
                <button class="btn btn-primary" type="submit" value="Reporter"><i class="far fa-alarm-clock"></i> Programmer</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript">
    function display_text() {
        var radios = document.getElementsByClassName('Opportu');
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == "Non intéressé") {
                    $(".questions4").show("slow");
                    $(".questions3").hide("slow");
                    $('.questions3 input:radio').removeAttr("required");
                    $('.questions4 textarea').attr("required", "required");
                } else {
                    $(".questions4").hide("slow");
                    $(".questions3").show("slow");
                    $('.questions4 textarea').removeAttr("required");
                    $('.questions3 input:radio').attr("required", "required");
                }
                break;
            }
        }
    }
</script>

<script>
    jQuery.datetimepicker.setLocale('fr');
    jQuery('#datetimepicker').datetimepicker({
        format:'Y-m-d H:i'
    });
</script>