<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter ligne</title>
    <style>
        /* Modern Container & Global Styles */
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
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-sizing: border-box;
        }

        /* Header Title with Bottom Accent Line */
        .panel-custom-heading h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 8px;
        }

        .panel-custom-heading h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        /* Form Layout Column */
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
        }

        /* Modern Input Text Field Styling */
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

        /* Bottom Action Footer Alignment Container */
        .form-actions {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
        }

        .btn-submit {
            background-color: #2563eb !important;
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
            background-color: #1d4ed8 !important;
        }
    </style>
</head>
<body>

<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Ajouter ligne'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Ligne'); ?>

        <!-- Single Input Column Group -->
        <div class="form-col">
            <?php echo $this->Form->input('name', array(
                'label' => __('Ligne'),
                'class' => 'form-control',
                'div' => false
            )); ?>
        </div>

        <!-- Clean Action Button Placement -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Envoyer'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

</body>
</html>