<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Editer une gamme</title>
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

        /* Matches the card look of the view page */
        .panel-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            max-width: 600px; /* Constrains the form width beautifully */
            margin: 0 auto; /* Centers the form on the page */
            padding: 28px;
            border: 1px solid #e2e8f0;
        }

        /* Clean Header Layout */
        .panel-custom-heading h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 8px;
        }

        /* Accent indicator line under the form title */
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

        /* Form Group Styles (CakePHP wrappers) */
        .form-group, .input {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Input Labels */
        .form-group label, .input label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }

        /* Modern Input Text Styling */
        .form-control, .input input[type="text"] {
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

        /* Interactive Focus Highlight */
        .form-control:focus, .input input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Button Layout container */
        .form-actions {
            margin-top: 28px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end; /* Aligns button to the bottom right */
        }

        /* Primary Button Accent styling */
        .btn-submit, input[type="submit"] {
            background-color: #2563eb !important;
            color: #ffffff !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            border: none !important;
            cursor: pointer;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover, input[type="submit"]:hover {
            background-color: #1d4ed8 !important;
        }
    </style>
</head>
<body>

<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Editer une gamme'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Game'); ?>
        
        <!-- Field Container wrapper -->
        <div class="form-group">
            <?php
            // Renders the hidden id field safely
            echo $this->Form->input('id', array('type' => 'hidden'));
            
            // Renders the core label and structured input field 
            echo $this->Form->input('name', array(
                'label' => __('La gamme'),
                'class' => 'form-control',
                'div' => false // Prevents old CakePHP default layout structures from breaking the grid
            ));
            ?>
        </div>

        <!-- Custom Actions container alignment replaces the old .well helper class -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Modifier'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

</body>
</html>