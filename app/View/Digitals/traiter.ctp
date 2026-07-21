<?php

?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

<!-- Injecting Modern Dashboard Styles Directly into this View -->
<style type="text/css">
    /* Global Container Layout Setup - Centered and Scoped Width */
    .dashboard-layout-container {
        max-width: 800px;
        margin: 20px auto;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        box-sizing: border-box;
        padding: 0 15px;
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
    textarea {
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
    textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    textarea {
        min-height: 140px;
        resize: vertical;
    }

    /* Global Interface Bottom Form Action Controls Footer */
    .form-actions {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: center;
    }

    /* Primary Submission Button updated to Dashboard Premium Blue */
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
</style>

<div class="dashboard-layout-container">
    
    <!-- Form Panel Card -->
    <div class="panel-custom">
        <div class="panel-custom-heading">
            <h3><?php echo __('Traiter la demande'); ?></h3>
        </div>
        
        <div class="panel-custom-body">
            <?php 
            echo $this->Form->create('Digital');
            echo $this->Form->hidden('id', array('value' => $id));
            ?>
            
            <div class="form-group-custom">
                <label><?php echo __('Réponse'); ?></label>
                <?php echo $this->Form->input('repense', array('class' => 'form-control', 'label' => false, 'div' => false)); ?>
            </div>

            <div class="form-actions">
                <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn-submit', 'onclick' => 'env();', 'div' => false)); ?>
            </div>
        </div>
    </div>
    
</div>