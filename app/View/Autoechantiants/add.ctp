<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Auto echantiant</title>
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

        /* Modern card panel wrapper */
        .panel-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            max-width: 850px;
            margin: 0 auto;
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-sizing: border-box;
        }

        /* Header Title */
        .panel-custom-heading h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 28px;
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

        /* Individual Sample Row Container */
        .sample-block {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 16px;
            transition: border-color 0.2s ease;
        }

        .sample-block:hover {
            border-color: #cbd5e1;
        }

        /* Row Subheading Title Styles */
        .sample-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Number Badge Indicator */
        .sample-badge {
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 9999px;
            text-transform: uppercase;
        }

        /* Two-column layout grid */
        .form-row {
            display: grid;
            grid-template-columns: 2fr 1fr; /* Gives the text input more room than the count field */
            gap: 16px;
        }

        .form-col {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-col label {
            font-size: 0.825rem;
            font-weight: 600;
            color: #475569;
        }

        /* Field Inputs & Custom styling */
        .form-control, 
        input[type="text"], 
        input[type="number"] {
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
        input[type="number"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Action Footer Section Layout */
        .form-actions {
            margin-top: 28px;
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
            padding: 10px 28px !important;
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
        <h3><?php echo __('Auto echantiant'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php
        echo $this->Form->create('Autoechantiant');
        echo $this->Form->hidden('category_id', array('value' => $category_id));
        echo $this->Form->hidden('classification', array('value' => $pot));
        
        // Loop generation
        for ($i = 0; $i < 5; $i++) {
        ?>
            <div class="sample-block">
                <div class="sample-title">
                    <span class="sample-badge"><?php echo __('Échantillon') . ' ' . ($i + 1); ?></span>
                </div>
                
                <div class="form-row">
                    <!-- Column 1: Item Name selection -->
                    <div class="form-col">
                        <?php echo $this->Form->input('a.'.$i.'.echantillons', array(
                            'label' => __("Echantillon"),
                            'class' => 'form-control',
                            'div' => false
                        )); ?>
                    </div>
                    
                    <!-- Column 2: Box Quantities -->
                    <div class="form-col">
                        <?php echo $this->Form->input('a.'.$i.'.nombre', array(
                            'label' => __("Nombre de boite"),
                            'class' => 'form-control',
                            'type' => 'number',
                            'min' => '0',
                            'div' => false
                        )); ?>
                    </div>
                </div>
            </div>
        <?php 
        } 
        ?>

        <!-- Aligned Action Button Container -->
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