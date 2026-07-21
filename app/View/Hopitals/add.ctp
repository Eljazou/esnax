<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Compact, clean card panel wrapper */
    .panel-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        max-width: 600px; /* Constrained appropriately for single input layouts */
        margin: 0 auto;
        padding: 28px;
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
        margin-bottom: 24px;
    }

    /* Form Layout Column Group */
    .form-col {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
    }

    .form-col label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 4px;
    }

    /* Modernized Text Field Input Styling */
    .form-control,
    input[type="text"] {
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
    input[type="text"]:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }
    
    .form-control::placeholder,
    input[type="text"]::placeholder {
        color: #94a3b8;
    }

    /* Integrated Action Footer Layout */
    .form-actions {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between; /* Keeps button left and return link cleanly aligned */
        align-items: center;
    }

    .btn-submit {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        padding: 10px 24px !important;
        border-radius: 8px !important;
        border: none !important;
        cursor: pointer;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: background-color 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #2563eb !important;
    }

    .btn-back {
        color: #64748b;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s ease;
    }

    .btn-back:hover {
        color: #334155;
    }
</style>

<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Ajouter un hôpital'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Hopital'); ?>

        <!-- Form Column Field Group -->
        <div class="form-col">
            <?php echo $this->Form->input('name', array(
                'label' => __("Nom de l'hôpital"), 
                'class' => 'form-control', 
                'placeholder' => __("Nom de l'hôpital"),
                'div' => false
            )); ?>
        </div>

        <!-- Integrated Navigation Actions Footer -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Enregistrer'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
            
            <?php echo $this->Html->link(
                '<i class="fa fa-arrow-left"></i> ' . __('Retour'), 
                array('action' => 'index'), 
                array('class' => 'btn-back', 'escape' => false)
            ); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>