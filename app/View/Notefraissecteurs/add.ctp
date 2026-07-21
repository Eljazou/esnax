<?php echo $this->Html->css('select2.min'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter note frais secteurs</title>
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
            max-width: 800px;
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

        /* Section dividers for semantic grouping */
        .form-section-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin: 24px 0 12px 0;
            padding-bottom: 4px;
            border-bottom: 1px dashed #e2e8f0;
        }

        /* Flexible multi-column layouts */
        .form-row-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-col {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-col label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }

        /* Field & Dropdown Styling */
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

        .form-control:focus, 
        input[type="text"]:focus, 
        input[type="number"]:focus, 
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Seamless Select2 Custom Overrides */
        .select2-container--default .select2-selection--single {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            height: 42px !important;
            padding: 6px 10px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0 !important;
            color: #1e293b !important;
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
            background-color: #10b981 !important;
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
            background-color: #059669 !important;
        }
    </style>
</head>
<body>

<div class="panel-custom">
    <div class="panel-custom-heading">
        <h3><?php echo __('Ajouter note frais secteurs'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Notefraissecteur'); ?>

        <!-- Section 1: Route details -->
        <div class="form-section-title"><?php echo __('Itinéraire & Type'); ?></div>
        
        <div class="form-row-3">
            <div class="form-col">
                <?php echo $this->Form->input('ville', array("options" => $villes, 'class' => 'form-control', 'div' => false, 'label' => __('Ville'))); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('destination', array("options" => $villes, 'class' => 'form-control', 'div' => false, 'label' => __('Destination'))); ?>
            </div>
            <div class="form-col">
                <?php 
                $options = array("Ville" => __('Ville de départ'), 'destination' => __('Destination'));
                echo $this->Form->input('nuit', array('options' => $options, 'class' => 'form-control', 'div' => false, 'label' => __('Nuit'))); 
                ?>
            </div>
        </div>

        <!-- Section 2: Expense breakdown -->
        <div class="form-section-title"><?php echo __('Détails des Frais'); ?></div>

        <div class="form-row-2">
            <div class="form-col">
                <?php echo $this->Form->input('urbain', array('class' => 'form-control', 'div' => false, 'label' => __('Urbain'), 'type' => 'number', 'step' => 'any')); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('interville', array('class' => 'form-control', 'div' => false, 'label' => __('Interville'), 'type' => 'number', 'step' => 'any')); ?>
            </div>
        </div>

        <div class="form-row-3">
            <div class="form-col">
                <?php echo $this->Form->input('hotel', array('class' => 'form-control', 'div' => false, 'label' => __('Hôtel'), 'type' => 'number', 'step' => 'any')); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('restaurant', array('class' => 'form-control', 'div' => false, 'label' => __('Restaurant'), 'type' => 'number', 'step' => 'any')); ?>
            </div>
            <div class="form-col">
                <?php echo $this->Form->input('divers', array('class' => 'form-control', 'div' => false, 'label' => __('Divers'), 'type' => 'number', 'step' => 'any')); ?>
            </div>
        </div>

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

<?php
echo $this->Html->script('jquery-2.2.3.min'); 
echo $this->Html->script('select2.full.min'); 
?>

<script type="text/javascript">
    $(function () {
        // Initializing Select2 with the search option disabled
        $("#NotefraissecteurVille, #NotefraissecteurDestination").select2({
            width: '100%',
            minimumResultsForSearch: Infinity
        });
    });
</script>

</body>
</html>