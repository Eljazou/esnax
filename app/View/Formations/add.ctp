<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
    body {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f5f6fa;
    }

    /* Container Card matching mockup */
    .metronic-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border: none;
        max-width: 700px;
        margin: 40px auto;
        overflow: hidden;
    }

    .metronic-card .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #f1f1f5;
        padding: 28px 36px;
    }

    .metronic-card .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #181c32;
        margin: 0;
    }

    .metronic-card .card-body {
        padding: 32px 36px;
    }

    /* Form Labels & Inputs */
    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #181c32;
        margin-bottom: 10px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e1e3ea;
        padding: 12px 16px;
        font-size: 14px;
        color: #3f4254;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #9b87f5;
    }

    /* Native File Input Styling */
    .form-control[type="file"] {
        padding: 6px;
    }

    .form-control[type="file"]::file-selector-button {
        background-color: #f8f9fa;
        color: #5e6278;
        border: none;
        border-right: 1px solid #e1e3ea;
        padding: 8px 16px;
        margin-right: 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
    }

    /* Light Footer Container */
    .form-action-wrapper {
        background-color: #f2f0fc;
        border-radius: 14px;
        padding: 28px;
        margin-top: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-metronic-primary {
        background-color: #9b87f5;
        border-color: #9b87f5;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
        padding: 10px 32px;
        border-radius: 10px;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .btn-metronic-primary:hover {
        background-color: #8b75f3;
        border-color: #8b75f3;
        color: #ffffff;
    }
</style>

<div class="container">
    <div class="card metronic-card">
        <div class="card-header">
            <h3 class="card-title"><?php echo __('Editer une formation'); ?></h3>
        </div>
        
        <div class="card-body">
            <?php echo $this->Form->create('Formation', array('type' => 'file', 'class' => 'needs-validation')); ?>

                <!-- Gamme Dropdown Field -->
                <div class="mb-4">
                    <label class="form-label"><?php echo __('Gamme'); ?></label>
                    <?php echo $this->Form->input('game_id', array(
                        'label' => false, 
                        'class' => 'form-select',
                        'div' => false
                    )); ?>
                </div>

                <!-- Nom Field -->
                <div class="mb-4">
                    <label class="form-label"><?php echo __('Nom'); ?></label>
                    <?php echo $this->Form->input('name', array(
                        'label' => false, 
                        'class' => 'form-control',
                        'placeholder' => 'ARGUMENTAIRE CENTELYS',
                        'div' => false
                    )); ?>
                </div>

                <!-- File Field -->
                <div class="mb-4">
                    <label class="form-label"><?php echo __('Fichier / Document'); ?></label>
                    <?php echo $this->Form->file('file', array(
                        'class' => 'form-control',
                        'div' => false
                    )); ?>
                </div>

                <!-- Form Action Box -->
                <div class="form-action-wrapper">
                    <?php echo $this->Form->button(__('Envoyer'), array(
                        'class' => 'btn btn-metronic-primary', 
                        'type' => 'submit'
                    )); ?>
                </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>