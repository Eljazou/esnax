<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
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

        /* Sleek card panel wrapper */
        .panel-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            max-width: 700px;
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

        /* Two-column responsive grid row */
        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Label Styles & CakePHP Required Asterisk Handling */
        .form-col label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            display: inline-flex;
            align-items: center;
        }

        /* Inline, clean styling for the required indicator */
        .form-col label th::after, 
        .form-col .required label::after {
            content: ' *';
            color: #dc2626;
            margin-left: 4px;
        }

        /* Modern Input fields & Dropdowns */
        .form-control, 
        input[type="text"], 
        input[type="number"], 
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

        /* Form Dropdown Polish */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
            cursor: pointer;
        }

        .form-control:focus, 
        input[type="text"]:focus, 
        input[type="number"]:focus, 
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Bottom Action Footer Container */
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
        <h3><?php echo __('Ajouter un produit'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Produit'); ?>

        <!-- Row 1: Code & Game Selection -->
        <div class="form-row">
            <div class="form-col">
                <?php echo $this->Form->input('code', array(
                    'label' => __('Code'),
                    'class' => 'form-control',
                    'div' => false
                )); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('game_id', array(
                    'label' => __('Game'), 
                    'class' => 'form-control',
                    'div' => false
                )); ?>
            </div>
        </div>

        <!-- Row 2: Product Name (Full Width) -->
        <div class="form-row">
            <div class="form-col">
                <?php echo $this->Form->input('name', array(
                    'label' => __('Produit'), 
                    'class' => 'form-control',
                    'div' => false
                )); ?>
            </div>
        </div>

        <!-- Row 3: Price & Stock Dropdown -->
        <div class="form-row">
            <div class="form-col">
                <?php echo $this->Form->input('prix', array(
                    'label' => __('Prix'),
                    'class' => 'form-control',
                    'div' => false
                )); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('stock', array(
                    'label' => __('Stock'),
                    'options' => array("0" => __("Non"), "1" => __("Oui")),
                    'class' => 'form-control',
                    'div' => false
                )); ?>
            </div>
        </div>

        <!-- Aligned Action Button -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Ajouter'), array(
                'class' => 'btn-submit',
                'div' => false
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

</body>
</html>