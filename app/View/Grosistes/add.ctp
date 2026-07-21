<!-- ===== METRONIC CENTERED FORM CONTAINER ===== -->
<div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-5 lb-centered-wrapper">
    <div class="card card-custom shadow-sm w-100 lb-form-card">
        
        <!-- ===== CARD HEADER ===== -->
        <div class="card-header border-0 pt-6 pb-4">
            <h3 class="card-title align-items-center flex-row">
                <span class="symbol symbol-40 symbol-light-primary mr-3">
                    <span class="symbol-label">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </span>
                </span>
                <span class="card-label font-weight-bolder text-dark font-size-h4"><?php echo __('Ajouter une grossiste'); ?></span>
            </h3>
        </div>

        <!-- ===== CARD BODY & FORM ===== -->
        <div class="card-body pt-2 pb-6">
            <?php echo $this->Form->create('Grosiste', array('class' => 'form')); ?>
                
                <!-- FIELD: NOM -->
                <div class="form-group mb-6">
                    <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Nom</label>
                    <?php echo $this->Form->input('name', array(
                        'label' => false,
                        'class' => 'form-control form-control-solid h-auto py-3 px-4',
                        'placeholder' => 'Entrez le nom...'
                    )); ?>
                </div>

                <!-- FIELD: RESPONSABLE -->
                <div class="form-group mb-6">
                    <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Responsable</label>
                    <?php echo $this->Form->input('super_id', array(
                        'label' => false,
                        'class' => 'form-control form-control-solid h-auto py-3 px-4 custom-select-styled',
                        'options' => $super_id, 
                        'empty' => '(choisissez)'
                    )); ?>
                </div>

                <!-- FIELD: REGION -->
                <div class="form-group mb-8">
                    <label class="font-weight-bold font-size-sm text-muted text-uppercase tracking-wider">Région</label>
                    <?php echo $this->Form->input('region', array(
                        'label' => false,
                        'class' => 'form-control form-control-solid h-auto py-3 px-4 custom-select-styled',
                        'options' => $region, 
                        'empty' => '(choisissez)'
                    )); ?>
                </div>

                <!-- SUBMIT ACTION -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-purple font-weight-bolder px-9 py-3 btn-lg">
                        Envoyer
                    </button>
                </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<style>
/* ===== METRONIC STYLE & CENTER LOGIC OVERRIDES ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.lb-centered-wrapper, .lb-form-card, .form-group label, .form-control, .btn, option {
    font-family: 'Poppins', sans-serif !important;
}

/* Page alignment wrapper to guarantee vertical and horizontal centering */
.lb-centered-wrapper {
    min-height: calc(100vh - 120px);
    width: 100% !important;
}

/* Perfect form max-width layout */
.lb-form-card {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.65rem !important;
    max-width: 650px !important; 
    box-shadow: 0px 0px 35px 0px rgba(82, 63, 105, 0.05) !important;
}

/* Header style adjustments */
.lb-form-card .card-header {
    background: transparent !important;
    border-bottom: 1px solid #F1F1F4 !important;
}
.symbol.symbol-light-primary .symbol-label {
    background-color: #F8F5FF !important;
    color: #7239EA !important;
}

/* Inputs design */
.form-group label {
    display: block;
    margin-bottom: 0.5rem !important;
    font-size: 0.8rem !important;
    letter-spacing: 0.5px;
}
.form-control-solid {
    background-color: #F5F8FA !important;
    border: 1px solid #F5F8FA !important;
    color: #181C32 !important;
    border-radius: 0.475rem !important;
    transition: all 0.2s ease !important;
}

/* Input hover and active state */
.form-control-solid:hover {
    background-color: #F8F5FF !important; /* Elegant light lavender background on filter hover */
    border-color: #7239EA !important;     /* Purple brand border line */
}
.form-control-solid:focus {
    background-color: #ffffff !important;
    border-color: #7239EA !important;
    box-shadow: 0 0 0 3px rgba(114, 57, 234, 0.15) !important;
    outline: none !important;
}

/* Modern Native Dropdown Custom Setup */
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

/* DROPDOWN OPTIONS LIST OVERRIDES */
.custom-select-styled option {
    background-color: #ffffff !important;
    color: #3F4254 !important;
    padding: 14px !important;
    font-size: 0.95rem !important;
}

/* 
 * OVERRIDING OPERATING SYSTEM HOVER & GRAY BACKGROUNDS 
 * Uses background gradients to lock clean lavender tint color over any system default highlights.
 */
.custom-select-styled option:hover,
.custom-select-styled option:focus,
.custom-select-styled option:active,
.custom-select-styled option:checked {
    color: #7239EA !important;
    background: #F1EDFD linear-gradient(0deg, #F1EDFD 0%, #F1EDFD 100%) !important;
    background-color: #F1EDFD !important;
    box-shadow: 0 0 10px 100px #F1EDFD inset !important;
}

/* CakePHP Input automatic div removal wrapper override */
.form-group div {
    display: block !important;
    width: 100% !important;
}

/* FIXED PURPLE SUBMIT BUTTON */
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