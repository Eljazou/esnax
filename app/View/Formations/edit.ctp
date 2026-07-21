<style type="text/css">
    /* Theme Customizations */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Outer Wrapper for Grid-Independent Centering */
    .panel-center-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 0 15px;
    }

    /* Modern Panel Card Replacement */
    .custom-panel {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
        overflow: hidden;
        width: 100%;
        max-width: 750px; /* Restricts the panel from stretching out too wide */
    }
    .custom-panel-header {
        background: #ffffff;
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
    }
    .custom-panel-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .custom-panel-body {
        padding: 28px;
    }

    /* Refined Form Layout Styles */
    .form-group-custom {
        margin-bottom: 20px;
    }
    .form-group-custom label {
        font-weight: 600;
        color: var(--theme-text-dark);
        font-size: 13.5px;
        margin-bottom: 8px;
        display: inline-block;
    }
    .form-control {
        height: 42px;
        border: 1px solid var(--theme-border);
        background-color: #ffffff;
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--theme-text-dark);
        box-shadow: none !important;
        transition: all 0.2s ease;
        width: 100%;
    }
    .form-control:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15) !important;
    }
    
    /* Clean up file input spacing inside .form-control architecture */
    input[type="file"].form-control {
        padding-top: 9px;
        padding-left: 12px;
        cursor: pointer;
    }

    /* Interactive Action Controls */
    .btn-lavender {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .btn-lavender:hover {
        background: var(--theme-primary-hover) !important;
    }

    /* Form Actions Section */
    .form-actions-well {
        background: var(--theme-primary-light);
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-top: 30px;
        text-align: center;
    }
</style>

<!-- Main utility wrapper that pulls the panel into dead center -->
<div class="panel-center-wrapper">
    <div class="custom-panel">
        <div class="custom-panel-header">
            <h3 class="custom-panel-title"><?php echo __('Editer une formation'); ?></h3>
        </div>
        
        <div class="custom-panel-body">
            <?php echo $this->Form->create('Formation', array('type' => 'file')); ?>
            
            <div class="form-group-custom">
                <?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
            </div>
            
            <div class="form-group-custom">
                <?php echo $this->Form->input('game_id', array('label' => 'Gamme', 'class' => 'form-control')); ?>
            </div>
            
            <div class="form-group-custom">
                <?php echo $this->Form->input('name', array('label' => 'Nom', 'class' => 'form-control')); ?>
            </div>
            
            <div class="form-group-custom">
                <label for="FormationFile"><?php echo __('Fichier / Document'); ?></label>
                <?php echo $this->Form->file('file', array('class' => 'form-control')); ?>
            </div>
            
            <div class="form-actions-well">
                <?php echo $this->Form->submit('Envoyer', array('class' => 'btn btn-lavender')); ?>
            </div>
            
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>