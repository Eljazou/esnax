<?php echo $this->Html->css('select2.min'); ?>

<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Form Section Layout Containers */
    .panel-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        max-width: 800px; /* Increased to allow comfortable spacing for dual columns or larger field forms */
        margin: 0 auto 32px auto;
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    /* Section Heading Component */
    .panel-custom-heading h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 28px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }

    /* Grid Layout Container for Fields */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
    }

    /* Individual Form Input Blocks */
    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
    }

    /* Layout override for items that need full horizontal span */
    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-group-custom label,
    .input select + label,
    .input label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        display: block;
        margin-bottom: 4px;
    }

    /* Core Input/Selection Controls Styling */
    .form-control,
    input[type="text"],
    input[type="file"],
    select {
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
    select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    /* File upload specific presentation */
    input[type="file"] {
        padding: 8px 12px;
        background-color: #f8fafc;
        cursor: pointer;
    }

    /* User Profile Image Thumbnail Wrapper */
    .profile-img-preview {
        margin: 8px 0 14px 0;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
    }

    /* Select2 Skin Overrides to Match UI */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        min-height: 42px !important;
        padding: 4px 8px !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #3b82f6 !important;
    }

    /* Form Bottom Action Containers */
    .form-actions {
        margin-top: 32px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end; /* Clean layout placement right-aligned */
    }

    .btn-submit {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        padding: 11px 28px !important;
        border-radius: 8px !important;
        border: none !important;
        cursor: pointer;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: background-color 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #2563eb !important;
    }
</style>

<!-- CARD 1: Edit Main User Details -->
<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Editer un utilisateur'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('User', array('type' => 'file')); ?>
        
        <!-- Primary Key Hidden Context Row -->
        <?php echo $this->Form->input('id', array('class' => 'form-control', 'div' => false)); ?>

        <div class="form-grid">
            <div class="form-group-custom">
                <?php echo $this->Form->input('name', array('label' => __('Nom & prénom'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('username', array('label' => __('E-mail'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('ligne_id', array('label' => __('Ligne'), 'class' => 'form-control select2', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('date_de_naissance', array('label' => __('Date de naissance'), 'class' => 'form-control date', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('tel', array('label' => __('Téléphone'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php 
                $roles = array(
                    "Admin" => "Admin", "Directeur" => "Directeur", "Responsable promotion" => "Responsable promotion",
                    "Super viseur" => "Super viseur", "Coordinateur" => "Coordinateur", "VMP" => "VMP", 
                    "Teleconseiller" => "Teleconseiller", "Ressource humain" => "Ressource humain"
                );
                echo $this->Form->input('role', array('options' => $roles, 'class' => 'form-control', 'label' => __('Rôle'), 'div' => false)); 
                ?>
            </div>

            <div class="form-group-custom form-group-full">
                <?php echo $this->Form->input('adresse', array('label' => __('Adresse'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <!-- Profile Image Layout Group -->
            <div class="form-group-custom form-group-full">
                <label><?php echo __('Image de profil'); ?></label>
                <?php if (!empty($this->request->data['User']['image'])): ?>
                    <div class="profile-img-preview">
                        <?php echo $this->Html->image('users/' . $this->request->data['User']['image'], array('style' => 'height: 100px; display: block;')); ?>
                    </div>
                <?php endif; ?>
                <?php echo $this->Form->file('image', array('class' => 'form-control', 'div' => false)); ?>
            </div>

            <!-- Town/City Multi-Select Group -->
            <div class="form-group-custom form-group-full">
                <label for="select2_villes"><?php echo __('Ville'); ?></label>
                <select name="ville[]" id="select2_villes" search="dp" class="form-control choix_multi" multiple="multiple">
                    <?php foreach ($villes as $region => $ville): ?>
                        <optgroup label="<?php echo h($region); ?>">
                            <?php foreach ($ville as $k => $v): 
                                $select = "";
                                foreach ($selected as $kk => $vv) {
                                    if ($kk == $k) {
                                        $select = 'selected="selected"';
                                        break;
                                    }
                                }
                            ?>
                                <option value="<?php echo h($k); ?>" <?php echo $select; ?>><?php echo h($v); ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group-custom form-group-full">
                <?php 
                $vv = array();
                foreach ($villes as $region => $ville) {
                    foreach ($ville as $k => $v) {
                        $vv[$v] = $v;
                    }
                }
                echo $this->Form->input('notefrais_qg', array("id" => "select2_notefrais", "label" => __("Ville officielle note frais"), 'search' => 'dp', 'class' => 'form-control choix_multi', "options" => $vv, 'div' => false)); 
                ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('kilometrage_urbain', array('label' => __('Prix kilométrage urbain'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('kilometrage_interville', array('label' => __('Prix kilométrage interville'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('code_wavsoft', array('label' => __('Code wavsoft'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php echo $this->Form->input('mat_rh', array('label' => __('Matricule RH'), 'class' => 'form-control', 'div' => false)); ?>
            </div>

            <div class="form-group-custom">
                <?php 
                $identifications = array("OTC" => "OTC", "Medical" => "Medical");
                echo $this->Form->input('identification', array('options' => $identifications, 'class' => 'form-control', 'label' => __('Identification'), 'div' => false)); 
                ?>
            </div>

            <div class="form-group-custom">
                <?php 
                $region_odp = array("CASA" => "CASA", "ORIENT" => "ORIENT", "RABAT" => "RABAT", "MARRAKECH" => "MARRAKECH", "TANGER" => "TANGER", "AGADIR" => "AGADIR");
                echo $this->Form->input('region_odp', array("options" => $region_odp, 'class' => 'form-control', 'label' => __('Région ODP'), 'div' => false)); 
                ?>
            </div>
        </div>

        <div class="form-actions">
            <?php echo $this->Form->submit(__('Envoyer'), array('class' => 'btn-submit', 'div' => false)); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<!-- CARD 2: Security Credentials Adjustment (Changer mot de passe) -->
<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Changer mot de passe'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('User'); ?>
        
        <!-- Primary Key Hidden Context Row -->
        <?php echo $this->Form->input('id', array('class' => 'form-control', 'div' => false)); ?>

        <div class="form-group-custom">
            <?php echo $this->Form->input('password', array('value' => '', 'label' => __('Nouveau mot de passe'), 'class' => 'form-control', 'div' => false)); ?>
        </div>

        <div class="form-actions">
            <?php echo $this->Form->submit(__('Changer mot de passe'), array('class' => 'btn-submit', 'div' => false)); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<!-- Dynamic Vendor Script Injections -->
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->css('datepicker3');
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->script('bootstrap-datepicker.fr');
?>

<script type="text/javascript">
    $(function () {
        // Initialize dynamic select filters
        $('.choix_multi').select2({
            width: '100%'
        });

        // Initialize user-friendly date components
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'fr',
            autoclose: true
        });
    });
</script>