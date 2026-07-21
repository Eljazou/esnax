<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
        --theme-border: #ece9f9;
        --radius-xl: 22px;
        --text-dark: #171730;
        --text-muted: #8d8da8;
    }

    body, .panel, .form-control {
        font-family: 'Poppins', sans-serif;
    }

    /* Centering Layout */
    .panel-center-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 0 15px;
    }

    .panel.panel-primary {
        border-radius: var(--radius-xl) !important;
        border: 1px solid var(--theme-border) !important;
        box-shadow: 0 4px 20px rgba(108, 99, 245, 0.06) !important;
        background: #fff !important;
        overflow: hidden;
        width: 100%;
        max-width: 650px;
        margin-bottom: 30px;
    }

    .panel.panel-primary > .panel-heading {
        display: none;
    }

    /* Hero Banner Header */
    .edit-hero {
        position: relative;
        overflow: hidden;
        padding: 28px 32px;
        background: linear-gradient(120deg, #ffffff 0%, #ffffff 55%, #ece7fd 100%);
        display: flex;
        align-items: center;
        gap: 16px;
        border-bottom: 1px solid var(--theme-border);
    }

    .hero-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 16px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        z-index: 2;
    }

    .hero-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        line-height: 1.3;
    }

    /* Form Content Body */
    .panel-body.form-horizontal {
        padding: 28px 32px 30px !important;
        background: #fff;
    }

    .field-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
    }

    .field-icon-box {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2px;
    }

    .field-body { 
        flex: 1; 
        min-width: 0; 
    }

    .field-body label {
        font-weight: 700;
        font-size: 13.5px;
        color: var(--text-dark);
        display: block;
        margin-bottom: 8px;
    }

    .field-body .form-control {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 10px !important;
        height: auto !important;
        padding: 11px 14px !important;
        font-size: 14px !important;
        box-shadow: none !important;
        width: 100%;
        color: var(--text-dark);
        transition: border-color 0.2s ease;
    }

    .field-body .form-control:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    /* Submit Section Styling */
    .well.text-center {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 20px 0 0 !important;
        margin-top: 8px;
        border-top: 1px solid #f1effa;
        display: flex;
        justify-content: flex-end;
    }

    .well.text-center input[type="submit"] {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 20px !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 10px 32px !important;
        font-size: 14px;
        box-shadow: 0 6px 16px rgba(108, 99, 245, .3);
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .well.text-center input[type="submit"]:hover {
        background: linear-gradient(135deg, #5f56ee, #3f66e6) !important;
        box-shadow: 0 8px 20px rgba(108, 99, 245, .4);
    }
</style>

<div class="panel-center-wrapper">
    <div class="panel panel-primary">
        <div class="edit-hero">
            <div class="hero-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </div>
            <div>
                <h3 class="hero-title"><?php echo 'Ajouter une liste : '.$users['User']['name']; ?></h3>
            </div>
        </div>

        <div class="panel-body form-horizontal payment-form">
            <?php echo $this->Form->create('Liste'); ?>
            <?php echo $this->Form->hidden('user_id', array('value' => $users['User']['id'])); ?>

            <div class="field-row">
                <div class="field-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </div>
                <div class="field-body">
                    <?php echo $this->Form->input('name', array('label' => 'Nom', 'class' => 'form-control', 'div' => false)); ?>
                </div>
            </div>

            <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center'))); ?>
        </div>
    </div>
</div>