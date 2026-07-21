<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Compact, clean card panel wrapper */
    .panel-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        max-width: 650px; /* Sized perfectly for multi-field dashboard forms */
        margin: 0 auto;
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    /* Header Title Style */
    .panel-custom-heading h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 28px;
    }

    /* Form Layout Column Stacking Group */
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

    /* Modern Text Input & Select Dropdown Styling */
    .form-control,
    input[type="text"],
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

    /* Specific adjustment for native select appearance */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        padding-right: 40px;
    }

    .form-control:focus,
    input[type="text"]:focus,
    select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    /* Integrated Actions Centered Footer Layout */
    .form-actions {
        margin-top: 32px;
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
        padding: 11px 36px !important;
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

<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Editer un échantillon'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Echantillon'); ?>
        
        <!-- Hidden/Default Form Primary Key Control Field -->
        <?php echo $this->Form->input('id', array('class' => 'form-control', 'div' => false)); ?>

        <!-- Form Dropdown Select Field: Game Assignment -->
        <div class="form-group-custom">
            <?php echo $this->Form->input('game_id', array(
                'label' => __('La game'), 
                'class' => 'form-control',
                'div' => false
            )); ?>
        </div>

        <!-- Form Text Field Input: Product Name -->
        <div class="form-group-custom">
            <?php echo $this->Form->input('name', array(
                'label' => __('Nom du produit'), 
                'class' => 'form-control',
                'div' => false
            )); ?>
        </div>

        <!-- Action Button Control Center -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Envoyer'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>