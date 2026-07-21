<!-- ===== METRONIC CARD CONTAINER ===== -->
<div class="card card-custom shadow-sm col-lg-8 mx-auto p-0">
    
    <!-- ===== METRONIC CARD HEADER ===== -->
    <div class="card-header border-0 pt-5 pb-5">
        <h3 class="card-title align-items-center flex-row">
            <span class="symbol symbol-40 symbol-light-primary mr-3">
                <span class="symbol-label">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </span>
            <span class="card-label font-weight-bolder text-dark font-size-h4"><?php echo __('Edit Grossiste'); ?></span>
        </h3>
    </div>

    <!-- ===== METRONIC CARD BODY ===== -->
    <?php echo $this->Form->create('Grosiste', array('class' => 'form-horizontal')); ?>
    <div class="card-body py-4">
        
        <?php echo $this->Form->input('id'); ?>

        <div class="form-group mb-5">
            <label class="font-weight-bolder text-dark font-size-sm"><?php echo __('Nom'); ?></label>
            <?php echo $this->Form->input('name', array(
                'label' => false,
                'class' => 'form-control form-control-solid',
                'placeholder' => 'Saisir le nom...'
            )); ?>
        </div>

        <div class="form-group mb-5">
            <label class="font-weight-bolder text-dark font-size-sm"><?php echo __('Responsable'); ?></label>
            <?php echo $this->Form->input('super_id', array(
                'label' => false,
                'class' => 'form-control form-control-solid custom-select-lavender',
                'options' => $super_id, 
                'default' => $this->request->data['Grosiste']["super_id"]
            )); ?>
        </div>

        <div class="form-group mb-5">
            <label class="font-weight-bolder text-dark font-size-sm"><?php echo __('Région'); ?></label>
            <?php echo $this->Form->input('region', array(
                'label' => false,
                'class' => 'form-control form-control-solid custom-select-lavender',
                'options' => $region, 
                'default' => $this->request->data['Grosiste']["region"]
            )); ?>
        </div>

    </div>

    <!-- ===== METRONIC CARD FOOTER ===== -->
    <div class="card-footer d-flex justify-content-end bg-transparent border-0 pt-0 pb-6">
        <?php echo $this->Form->button(
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px; vertical-align:-2px;"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Enregistrer', 
            array(
                'type' => 'submit',
                'class' => 'btn btn-primary-lavender font-weight-bolder btn-md',
                'escape' => false
            )
        ); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<style>
/* ===== METRONIC DESIGN OVERRIDE ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.card.card-custom, .form-control, label, h3, span, button { font-family: 'Poppins', sans-serif !important; }

/* Main Card Wrapper */
.card.card-custom {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.75rem !important;
    box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.03) !important;
    margin-bottom: 2rem;
}

/* Header Config */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #F1F1F4 !important;
    background: transparent !important;
}
.symbol.symbol-light-primary .symbol-label { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
}

/* Modern Form Controls */
.form-control-solid {
    background-color: #F8F9FA !important;
    border: 1.5px solid #E4E6EF !important;
    color: #3F4254 !important;
    border-radius: 0.55rem !important;
    padding: 0.65rem 1rem !important;
    font-size: 0.92rem !important;
    transition: all 0.2s ease !important;
}
.form-control-solid:focus {
    border-color: #7239EA !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 0.2rem rgba(114, 57, 234, 0.1) !important;
    outline: none !important;
}

/* Primary Lavender Button with Hover Effects */
.btn-primary-lavender { 
    background-color: #7239EA !important; 
    color: #ffffff !important; 
    border: none !important;
    border-radius: 0.55rem !important;
    padding: 0.65rem 1.5rem !important;
    font-size: 0.9rem !important;
    transition: all 0.2s ease !important;
    cursor: pointer;
}
.btn-primary-lavender:hover { 
    background-color: #5825cb !important; 
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(114, 57, 234, 0.25) !important;
}
</style>