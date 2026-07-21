<!-- ===== METRONIC CENTERED FORM CONTAINER ===== -->
<div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-5 lb-centered-wrapper">
    <div class="card card-custom shadow-sm w-100 lb-form-card">
        
        <!-- ===== CARD HEADER ===== -->
        <div class="card-header border-0 pt-6 pb-4">
            <h3 class="card-title align-items-center flex-row">
                <span class="symbol symbol-40 symbol-light-primary mr-3">
                    <span class="symbol-label">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-4-8-4z" fill="currentColor"/>
                        </svg>
                    </span>
                </span>
                <span class="card-label font-weight-bolder text-dark font-size-h4"><?php echo __('Ajouter un utilisateur'); ?></span>
            </h3>
        </div>

        <!-- ===== CARD BODY & FORM ===== -->
        <div class="card-body pt-4 pb-6">
            <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form')); ?>
                
                <!-- PHOTO UPLOAD -->
                <div class="form-group mb-6">
                    <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Photo d'utilisateur</label>
                    <div class="custom-file-upload-wrapper">
                        <?php echo $this->Form->file('image', array('label' => false, 'class' => 'form-control-file-hidden', 'id' => 'userImageFileInput')); ?>
                        <label for="userImageFileInput" class="btn btn-light-primary btn-bold px-6 py-3 d-inline-flex align-items-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Choisir un fichier...
                        </label>
                        <span id="file-chosen-text" class="text-muted ml-3 font-size-sm">Aucun fichier choisi</span>
                    </div>
                </div>

                <!-- PERFECTLY BALANCED 2-COLUMN GRID SECTION (8 Fields Left / 8 Fields Right) -->
                <div class="row">
                    <!-- COLUMN LEFT (8 Fields) -->
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Ligne</label>
                            <?php echo $this->Form->input('ligne_id', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4 select2 custom-select-styled')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Nom & prénom</label>
                            <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4', 'placeholder' => 'Ex: Jean Dupont')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">E-mail</label>
                            <?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4', 'placeholder' => 'exemple@domaine.com')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Mot de passe</label>
                            <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Date de naissance</label>
                            <?php echo $this->Form->input('date_de_naissance', ['type' => 'text', 'class' => 'form-control form-control-solid h-auto py-3 px-4 date', 'label' => false, 'placeholder' => 'AAAA-MM-JJ']); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Téléphone</label>
                            <?php echo $this->Form->input('tel', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4', 'placeholder' => '+212...')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Role</label>
                            <?php 
                            $roles = array("Admin" => "Admin", "Directeur" => "Directeur", "Responsable promotion" => "Responsable promotion",
                                "Super viseur" => "Super viseur", "Coordinateur" => "Coordinateur", "VMP" => "VMP", "Teleconseiller" => "Teleconseiller","Ressource humain"=>"Ressource humain");
                            echo $this->Form->input('role', array('options' => $roles, 'label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4 custom-select-styled')); 
                            ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Adresse</label>
                            <?php echo $this->Form->input('adresse', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4', 'placeholder' => 'Rue, Ville, Code Postal')); ?>
                        </div>
                    </div>

                    <!-- COLUMN RIGHT (8 Fields) -->
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Ville (Sélection multiple)</label>
                            <?php echo $this->Form->input('ville', array("id" => "select2_ville", "name" => "ville[]", 'label' => false, 'class' => 'form-control form-control-solid choix_multi_ville', "multiple" => true)); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Ville officiel note frais</label>
                            <?php 
                            $vv=array();
                            foreach ($villes as $region => $ville) {
                                foreach ($ville as $k => $v) {
                                    $vv[$v]=$v;
                                }
                            }
                            echo $this->Form->input('notefrais_qg', array("id" => "select2_notefrais", "label" => false, 'class' => 'form-control form-control-solid choix_multi', "options"=>$vv)); 
                            ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Prix kilométrage urbain</label>
                            <?php echo $this->Form->input('kilometrage_urbain', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Prix kilométrage interville</label>
                            <?php echo $this->Form->input('kilometrage_interville', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Code wavsoft</label>
                            <?php echo $this->Form->input('code_wavsoft', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Matricule RH</label>
                            <?php echo $this->Form->input('mat_rh', array('label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4')); ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Identification</label>
                            <?php 
                            $identifications=array("OTC"=>"OTC","Medical"=>"Medical");
                            echo $this->Form->input('identification', array('options' => $identifications, 'label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4 custom-select-styled')); 
                            ?>
                        </div>

                        <div class="form-group mb-6">
                            <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Région ODP</label>
                            <?php 
                            $region_odp=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR");
                            echo $this->Form->input('region_odp', array("options" => $region_odp, 'label' => false, 'class' => 'form-control form-control-solid h-auto py-3 px-4 custom-select-styled')); 
                            ?>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT ACTION -->
                <div class="d-flex justify-content-center mt-6">
                    <button type="submit" class="btn btn-purple font-weight-bolder px-12 py-3 btn-lg">
                        Ajouter
                    </button>
                </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<style>
/* ===== METRONIC DESIGN LANGUAGE OVERRIDES ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.lb-centered-wrapper, .lb-form-card, .form-group label, .form-control, .btn, option, .select2-container {
    font-family: 'Poppins', sans-serif !important;
}

.lb-centered-wrapper {
    min-height: calc(100vh - 80px);
    width: 100% !important;
}

.lb-form-card {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.65rem !important;
    max-width: 950px !important; 
    box-shadow: 0px 0px 35px 0px rgba(82, 63, 105, 0.05) !important;
}

.lb-form-card .card-header {
    background: transparent !important;
    border-bottom: 1px solid #F1F1F4 !important;
}
.symbol.symbol-light-primary .symbol-label {
    background-color: #F8F5FF !important;
    color: #7239EA !important;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem !important;
    font-size: 0.75rem !important;
    letter-spacing: 0.6px;
}

.form-control-solid {
    background-color: #F5F8FA !important;
    border: 1px solid #F5F8FA !important;
    color: #181C32 !important;
    border-radius: 0.475rem !important;
    transition: all 0.2s ease !important;
}

.form-control-solid:hover {
    background-color: #F8F5FF !important; 
    border-color: #7239EA !important;     
}
.form-control-solid:focus {
    background-color: #ffffff !important;
    border-color: #7239EA !important;
    box-shadow: 0 0 0 3px rgba(114, 57, 234, 0.15) !important;
    outline: none !important;
}

/* Custom File Upload Input Config */
.custom-file-upload-wrapper {
    display: flex;
    align-items: center;
}
.form-control-file-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}
.btn-light-primary {
    background-color: #F8F5FF !important;
    color: #7239EA !important;
    border: none !important;
    border-radius: 0.475rem !important;
}
.btn-light-primary:hover {
    background-color: #7239EA !important;
    color: #ffffff !important;
}

/* Modern Native Dropdowns Dynamic Structure */
.custom-select-styled {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237239EA' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 1.25rem center !important;
    background-size: 12px !important;
    padding-right: 3rem !important;
}

.custom-select-styled option {
    background-color: #ffffff !important;
    color: #3F4254 !important;
    padding: 10px 12px !important;
}

.custom-select-styled option:hover, .custom-select-styled option:checked {
    color: #7239EA !important;
    background: #F1EDFD linear-gradient(0deg, #F1EDFD 0%, #F1EDFD 100%) !important;
    box-shadow: 0 0 10px 100px #F1EDFD inset !important;
}

/* ===== ADVANCED SELECT2 METRONIC LOOKS ===== */
.select2-container--default .select2-selection--single, 
.select2-container--default .select2-selection--multiple {
    background-color: #F5F8FA !important;
    border: 1px solid #F5F8FA !important;
    border-radius: 0.475rem !important;
    min-height: 45px !important;
    padding: 4px 8px !important;
    transition: all 0.2s ease !important;
}
.select2-container--default .select2-selection--single:hover,
.select2-container--default .select2-selection--multiple:hover {
    background-color: #F8F5FF !important;
    border-color: #7239EA !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
    background-color: #ffffff !important;
    border-color: #7239EA !important;
}

/* Selected Multi tags pills color customization */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #F1EDFD !important;
    border: 1px solid #E8E2FA !important;
    color: #7239EA !important;
    border-radius: 0.42rem !important;
    padding: 4px 10px !important;
    font-weight: 500 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #a894e6 !important;
    margin-right: 6px !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #5014D0 !important;
}

/* Dropdown Container */
.select2-dropdown {
    border: 1px solid #E4E6EF !important;
    box-shadow: 0px 10px 30px 0px rgba(82, 63, 105, 0.08) !important;
    border-radius: 0.475rem !important;
    z-index: 9999 !important;
}

/* Hides the Select2 search field input element layout container */
.select2-search--dropdown {
    display: none !important;
}

.select2-results__option {
    padding: 10px 14px !important;
    border-radius: 0.35rem !important;
    margin: 2px 4px !important;
}
.select2-container--default .select2-results__option--highlighted[aria-selected],
.select2-container--default .select2-results__option[aria-selected="true"] {
    background-color: #F1EDFD !important;
    color: #7239EA !important;
}

/* CakePHP Core structure fixes */
.form-group div {
    display: block !important;
    width: 100% !important;
}

/* SUBMIT BUTTON PURPLE STATE */
.btn-purple {
    background-color: #7239EA !important;
    border-color: #7239EA !important;
    color: #ffffff !important;
    border-radius: 0.475rem !important;
    transition: background-color 0.15s ease !important;
}
.btn-purple:hover {
    background-color: #5014D0 !important;
    border-color: #5014D0 !important;
    color: #ffffff !important;
}
</style>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->css('datepicker3');
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->script('bootstrap-datepicker.fr');
?>

<script>
    $(function () {
        // FIXED: minimumResultsForSearch: Infinity turns off the dropdown input box entirely
        $('.choix_multi, .choix_multi_ville').select2({
            placeholder: "Sélectionnez des options...",
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: Infinity
        });
        
        // Updates text label when user loads file
        $('#userImageFileInput').change(function(e){
            var fileName = e.target.files[0].name;
            $('#file-chosen-text').text(fileName);
        });
    });
    
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr'
    });
</script>