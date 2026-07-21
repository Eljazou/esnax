<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un pack</title>
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

        /* Matches the layout style of your dashboard */
        .panel-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            max-width: 650px; /* Constrains form to an elegant scanning width */
            margin: 0 auto;
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-sizing: border-box;
        }

        /* Clean Header Section */
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

        /* Form Controls & Wrappers */
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }

        .form-control, input[type="text"], input[type="number"] {
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

        .form-control:focus, input[type="text"]:focus, input[type="number"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Modern Grid For Dynamic Loop Rows */
        .details-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin: 24px 0 12px 0;
        }

        .pack-detail-row {
            display: flex;
            gap: 16px;
            background-color: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #f1f5f9;
            margin-bottom: 12px;
        }

        .pack-detail-col {
            flex: 1; /* Makes columns exactly equal widths */
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Form Actions & Submissions */
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
        <h3><?php echo __('Modifier un pack'); ?></h3>
    </div>
    
    <div class="panel-custom-body">
        <?php echo $this->Form->create('Pack'); ?>
        <?php echo $this->Form->hidden('id'); ?>
        
        <!-- Main Pack Field -->
        <div class="form-group">
            <?php echo $this->Form->input('nombre', array(
                "type" => "number",
                'label' => __('Nombre de pack'), 
                'class' => 'form-control',
                'div' => false
            )); ?>
        </div>

        <!-- Section Label for Loop Details -->
        <div class="details-section-title"><?php echo __('Détails du pack'); ?></div>

        <!-- Dynamic Loop Rows -->
        <?php foreach($this->request->data["Packdetail"] as $i => $d): ?>
            <div class="pack-detail-row">
                <div class="pack-detail-col">
                    <?php echo $this->Form->input("Packdetail.$i.game_id", array(
                        'class' => 'form-control',
                        'label' => __("Gamme"),
                        'div' => false
                    )); ?>
                </div>
                <div class="pack-detail-col">
                    <?php echo $this->Form->input("Packdetail.$i.nombre", array(
                        "type" => "number",
                        'class' => 'form-control',
                        'label' => __("Nombre"),
                        'div' => false
                    )); ?>
                </div>
            </div>
        <?php endforeach; ?>
                  
        <!-- Modernized action replaces legacy .well wrapper -->
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Modifier'), array(
                'class' => 'btn-submit',
                'div' => false,
                'required' => 'required'
            )); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>

</body>
</html>