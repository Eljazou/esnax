<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Global Section Container */
    body {
        background-color: #f8fafc;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        color: #334155;
        padding: 24px;
        margin: 0;
        line-height: 1.5;
    }

    /* Compact, clean card panel wrapper */
    .panel-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        max-width: 600px; /* Constrained appropriately for a single input field */
        margin: 0 auto;
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
    }

    /* Header Title */
    .panel-custom-heading h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 24px;
    }

    /* Form Layout Column */
    .form-col {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .form-col label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #1e293b;
    }

    /* Modern Text Field Styling */
    .form-control,
    input[type="text"] {
        width: 100%;
        padding: 12px 14px;
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

    /* Bottom Action Footer Alignment Container */
    .form-actions {
        margin-top: 28px;
        display: flex;
        justify-content: center; /* Centered to match the screenshot exactly */
    }

    .btn-submit {
        background-color: #3b82f6 !important; /* Lighter blue to match the screenshot */
        color: #ffffff !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        padding: 12px 32px !important;
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
        <h3><?php echo __('Ajouter un type'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Type'); ?>

        <!-- Single Input Column Group -->
        <div class="form-col">
            <?php echo $this->Form->input('name', array(
                'label' => __('Nom'),
                'class' => 'form-control',
                'div' => false
            )); ?>
        </div>

        <!-- Centered Action Button Placement -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Envoyer'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>