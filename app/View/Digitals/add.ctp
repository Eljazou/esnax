<?php 
echo $this->Html->css("style_radio");
echo $this->Html->css("style_rapport");
echo $this->Html->css("style_range");
echo $this->Html->css("jquery.datetimepicker");
echo $this->Html->css('select2.min'); 
echo $this->Html->script("fontawesome");
?>

<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Global Container Layout Setup - Now Centered and Full Width */
    .dashboard-layout-grid {
        max-width: 1000px;
        margin: 0 auto;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        box-sizing: border-box;
    }

    /* Primary Main Application Form Panel Card */
    .panel-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
    }

    .panel-custom-heading h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }

    /* Specialized Input Fields Layout Rules */
    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 20px;
    }

    .form-group-custom label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
    }

    /* Refined Form Input Controls Styles */
    .form-control,
    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px 14px;
        font-size: 0.95rem;
        color: #1e293b;
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus,
    input[type="text"]:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    textarea {
        min-height: 110px;
        resize: vertical;
    }

    /* Search Action Specific Layout Form Elements */
    .search-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
        background-color: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        border: 1px dashed #cbd5e1;
    }

    .btn-search-custom {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        padding: 11px 32px !important;
        border-radius: 25px !important;
        border: none !important;
        cursor: pointer;
        width: 100%;
        max-width: 280px;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        transition: background-color 0.2s ease;
    }

    .btn-search-custom:hover {
        background-color: #2563eb !important;
    }

    /* Radio Question Grid Sections UI Elements */
    .radio-sections-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-top: 20px;
    }

    .radio-card-group {
        background-color: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .radio-card-group label b {
        color: #0f172a;
    }

    .autre_input {
        display: none;
        margin-top: 8px;
    }

    /* Data Presentation Table View Updates */
    .table-container-scroller {
        max-height: 180px;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin: 20px 0;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
    }

    .modern-table th {
        background-color: #1e293b;
        color: #ffffff;
        padding: 10px 14px;
        font-weight: 600;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modern-table td {
        padding: 10px 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
    }

    /* Global Interface Bottom Form Action Controls Footer */
    .form-actions {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: center;
    }

    .btn-submit {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        padding: 12px 50px !important;
        border-radius: 8px !important;
        border: none !important;
        cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
        transition: all 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #2563eb !important;
        box-shadow: 0 4px 12px -1px rgba(37, 99, 235, 0.3);
    }

    /* Select2 System Layout Resets */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        min-height: 40px !important;
        padding: 3px 6px !important;
    }
</style>

<div class="dashboard-layout-grid">
    
    <!-- Form Panel Card -->
    <div class="panel-custom">
        <div class="panel-custom-heading">
            <h3><?php echo __('Ajouter Digital'); ?></h3>
        </div>
        
        <div class="panel-custom-body">
            
            <!-- SECTION 1: Search Form Engine Interface Block -->
            <?php echo $this->Form->create('Digital'); ?>
            <div class="search-block">
                <input type="text" name="data[Digital][client]" placeholder="Société ou nom ou code_wavesoft" class="form-control" style="text-align: center;">
                <?php echo $this->Form->end(array('label' => 'Rechercher', 'class' => 'btn-search-custom', 'div' => false)); ?>
            </div>

            <!-- SECTION 2: Client Async Records Selection Grid Table -->
            <?php if(!empty($clients)): ?>
            <div class="table-container-scroller">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Téléphone</th>
                            <th style="text-align: center;">Sélectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clients as $client):
                            $nom = $client["Client"]["nom"]." ".$client["Client"]["prenom"];
                            $secteur = $client["Secteur"]["id"];
                            $client_id = $client["Client"]["id"];
                            $tel = $client["Client"]["tel"];
                        ?>
                        <tr>
                            <td><?php echo h($nom);?></td>
                            <td><?php echo h($client["Secteur"]["region"]." ".$client["Secteur"]["ville"]." ".$client["Secteur"]["secteur"]);?></td>
                            <td><?php echo h($tel);?></td>
                            <td style="text-align: center;"> 
                                <input type="radio" id="check<?php echo $secteur;?>" name="check" onchange="check(<?php echo "'$nom','$secteur','$tel','$client_id'"; ?>)">
                                <label for="check<?php echo $secteur;?>"></label>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 24px 0;">

            <!-- SECTION 3: Main Dynamic Client Specifications Storage Entry Layout -->
            <?php echo $this->Form->create('Digital'); ?>
            
            <input type="hidden" name="data[Digital][nom]" id="nomm">
            <input type="hidden" name="data[Digital][client_id]" id="client_id">
            <input type="hidden" name="data[Digital][secteur_id]" id="secteur_id">
            <input type="hidden" name="data[Digital][telephone]" id="tel">

            <div class="questions3">
                <h4 style="font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 20px; border-left: 4px solid #3b82f6; padding-left: 10px;">
                    Coordonnées demandeur
                </h4>
                
                <div class="form-group-custom">
                    <label>Nom</label>
                    <?php echo $this->Form->input('nom', array('class' => 'form-control', 'label' => false, 'div' => false));?>
                </div>

                <div class="form-group-custom">
                    <label>Régions</label> 
                    <select class="form-control select2" id="ClientRegionId" name="regions" onchange="region_change();"></select>
                </div>
                
                <div class="form-group-custom">
                    <label>Ville</label>
                    <select class="form-control select2" name="villes" id="ClientVilleId" onchange="villes_change();"></select>
                </div>

                <div class="form-group-custom">
                    <label>Secteur</label>
                    <?php echo $this->Form->input('secteur', array("name" => "data[Digital][secteur_id]", 'class' => 'form-control select2', 'label' => false, 'id' => 'ClientSecteurId', 'div' => false));?>
                </div>

                <div class="form-group-custom">
                    <label>Téléphone</label>
                    <?php echo $this->Form->input('telephone', array('class' => 'form-control', 'label' => false, 'div' => false)); ?>
                </div>

                <div class="form-group-custom">
                    <label>Autre</label>
                    <input type="text" name="data[Digital][autre]" class="form-control">
                </div>
            </div>

            <!-- Radio Selection Inquiries Grid Block Section Layout -->
            <div class="radio-sections-container">
                
                <!-- Q1 Panel Block -->
                <div class="radio-card-group">
                    <label><b>1-</b> Origine de la demande <span style="color: #ef0404; font-size: 16px;">*</span></label>
                    <p style="margin-top: 12px;"><input type="radio" id="Facebook" name="data[Digital][origine]" value="Facebook" required="required" onchange="fun_autre('Non');"> <label for="Facebook">Facebook</label></p>
                    <p><input type="radio" id="instagram" name="data[Digital][origine]" value="instagram" required="required" onchange="fun_autre('Non');"> <label for="instagram">Instagram</label></p>
                    <p><input type="radio" id="Whatsapp" name="data[Digital][origine]" value="Whatsapp" required="required" onchange="fun_autre('Non');"> <label for="Whatsapp">Whatsapp</label></p>
                    <p>
                        <input type="radio" id="autre_txt" name="data[Digital][origine]" required="required" onchange="fun_autre('autre_input');">
                        <label for="autre_txt">Autre :</label>
                        <input type="text" class="form-control autre_input" placeholder="autre" id="autre_input">
                    </p>
                </div>

                <!-- Q2 Panel Block -->
                <div class="radio-card-group">
                    <label><b>2-</b> Demandeur <span style="color: #ef0404; font-size: 16px;">*</span></label>
                    <p style="margin-top: 12px;"><input type="radio" id="Particulier" name="data[Digital][demandeur]" value="Particulier" required="required" onchange="fun_autre('rdio');"> <label for="Particulier">Particulier</label></p>
                    <p><input type="radio" id="Pharmacie" name="data[Digital][demandeur]" value="Pharmacie" required="required" onchange="fun_autre('rdio');"> <label for="Pharmacie">Pharmacie</label></p>
                    <p><input type="radio" id="Parapharmacie" name="data[Digital][demandeur]" value="Parapharmacie" required="required" onchange="fun_autre('rdio');"> <label for="Parapharmacie">Parapharmacie</label></p>
                    <p><input type="radio" id="nutrition" name="data[Digital][demandeur]" value="Magasin de nutrition" required="required" onchange="fun_autre('rdio');"> <label for="nutrition">Magasin de nutrition</label></p>
                    <p><input type="radio" id="Influenceur" name="data[Digital][demandeur]" value="Influenceur" required="required" onchange="fun_autre('rdio');"> <label for="Influenceur">Influenceur</label></p>
                    <p>
                        <input type="radio" id="Autre_demandeur_txt" name="data[Digital][demandeur]" required="required" onchange="fun_autre('autre_input1');">
                        <label for="Autre_demandeur_txt">Autre :</label>
                        <input type="text" class="form-control autre_input" placeholder="autre" id="autre_input1">
                    </p>
                </div>
            </div>

            <!-- Q4 Full Span Form Configuration Controls Block -->
            <div class="radio-card-group" style="margin-top: 24px;">
                <label><b>4-</b> Type de demande <span style="color: #ef0404; font-size: 16px;">*</span></label>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 8px; margin-top: 12px;">
                    <p><input type="radio" id="en_place" name="data[Digital][type]" value="Mise en place" required="required" onchange="fun_autre('demande');"> <label for="en_place">Mise en place</label></p>
                    <p><input type="radio" id="Point" name="data[Digital][type]" value="Point de vente " required="required" onchange="fun_autre('demande');"> <label for="Point">Point de vente</label></p>
                    <p><input type="radio" id="non_disponible" name="data[Digital][type]" value="Réclamation : Non disponible" required="required" onchange="fun_autre('demande');"> <label for="non_disponible">Réclamation : Non disponible</label></p>
                    <p><input type="radio" id="grossiste" name="data[Digital][type]" value="Réclamation : rupture grossiste" required="required" onchange="fun_autre('demande');"> <label for="grossiste">Réclamation : rupture grossiste</label></p>
                    <p><input type="radio" id="partenariat" name="data[Digital][type]" value="Demande de partenariat" required="required" onchange="fun_autre('demande');"> <label for="partenariat">Demande de partenariat</label></p>
                    <p><input type="radio" id="techniques" name="data[Digital][type]" value="Questions techniques" required="required" onchange="fun_autre('demande');"> <label for="techniques">Questions techniques</label></p>
                </div>
                <p style="margin-top: 10px;">
                    <input type="radio" id="Autre_type_txt" name="data[Digital][type]" required="required" onchange="fun_autre('autre_input2');">
                    <label for="Autre_type_txt">Autre :</label>
                    <input type="text" class="form-control autre_input" placeholder="autre" id="autre_input2">
                </p>
            </div>

            <div class="form-group-custom" style="margin-top: 24px;">
                <label>Produits demandés</label>
                <?php echo $this->Form->input('game_id', array('class' => 'form-control select2', 'label' => false, 'id' => 'game', 'multiple' => "multiple", 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <label>Commentaire</label>
                <?php echo $this->Form->input('commentaire', array('class' => 'form-control', 'label' => false, 'div' => false)); ?>
            </div>

            <div class="form-actions">
                <?php echo $this->Form->submit(__('Envoyer'), array('class' => 'btn-submit', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            
        </div>
    </div>
</div>

<!-- Core System Dynamic Vendor Scripts Injection Architecture Hooks -->
<?php 
echo $this->Html->script('jquery-2.2.3.min'); 
echo $this->Html->script('select2.full.min');
echo $this->Html->script('fontawesome'); 
?>

<script type="text/javascript">
    var regions = <?php echo json_encode($regions); ?>;
    var villes = <?php echo json_encode($villes); ?>;

    var k = 0;
    $(document).ready(function() {
        $("#ClientSecteurId, #game, #ClientVilleId, #ClientRegionId").select2({
            width: '100%'
        });

        for (var key in regions) { 
            if (regions.hasOwnProperty(key)) { 
                if (k == 0) {
                    $('#ClientRegionId').append('<option value="'+key+'" selected>'+key+'</option>');
                    k++;
                } else {
                    $('#ClientRegionId').append('<option value="'+key+'">'+key+'</option>');
                }
            } 
        } 
        region_change();
    });

    function region_change() {
        var myreg = $("#ClientRegionId").val();
        $('#ClientVilleId').empty();

        if (regions[myreg]) {
            for (var i = 0; i < regions[myreg].length - 1; i++) {
                $("#ClientVilleId").append('<option value="'+regions[myreg][i]+'" selected>'+regions[myreg][i]+'</option>');
            }
        }
        $("#ClientVilleId").trigger('change');
        villes_change();
    }

    function villes_change() {
        var myville = $("#ClientVilleId").val();
        $('#ClientSecteurId').empty();
        
        if (villes[myville]) {
            for (var key in villes[myville]) { 
                if (villes[myville].hasOwnProperty(key)) { 
                    $("#ClientSecteurId").append('<option value="'+key+'">'+villes[myville][key]+'</option>');  
                } 
            }  
        }
        $("#ClientSecteurId").trigger('change');
    }

    function fun_autre(id) {
        if (id == "Non") {
            $("#autre_input").empty().hide("slow");
        } else if (id == "rdio") {
            $("#autre_input1").empty().hide("slow");
        } else if (id == "demande") {
            $("#autre_input2").hide("slow");
        } else {
            $("#" + id).show("slow");
        }
    }

    function check(nom, secteur, tel, client_id) {
        $(".questions3").remove();
        $("#nomm").val(nom);
        $("#secteur_id").val(secteur);
        $("#tel").val(tel);
        $("#client_id").val(client_id);
    }
</script>