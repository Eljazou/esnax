<style type="text/css">
    #add-affaire-wrapper {
        --accent: #00a7d0;
        --accent-dark: #008da0;
        --accent-light: #e6f6fa;
        --accent-pale: #d0f0f7;
        --border-color: #ece9f9;
        --text-dark: #2d2b42;
        --text-muted: #8b87a3;
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 2px 14px rgba(0, 167, 208, 0.08);
    }

    /* Out-specifies standard Bootstrap theme panel rules */
    #add-affaire-wrapper .panel.panel-primary {
        background: #fff !important; 
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-lg) !important; 
        box-shadow: var(--shadow-card) !important; 
        overflow: hidden !important;
        margin-bottom: 25px;
    }
    
    #add-affaire-wrapper .panel.panel-primary > .panel-heading {
        background: var(--accent-light) !important; 
        border-bottom: 1px solid var(--border-color) !important;
        padding: 16px 24px !important;
        width: 100% !important; /* Forces layout stability across device queries */
        float: none !important;
    }
    
    #add-affaire-wrapper .panel.panel-primary > .panel-heading .panel-title {
        color: var(--text-dark) !important; 
        font-size: 16px !important; 
        font-weight: 700 !important;
        display: flex !important; 
        align-items: center !important; 
    }
    
    #add-affaire-wrapper .panel.panel-primary > .panel-heading .panel-title:before {
        content: "\f0ee"; 
        font-family: "FontAwesome"; 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 32px; 
        height: 32px; 
        border-radius: 50%; 
        margin-right: 10px; 
        font-size: 14px;
        background: #fff; 
        color: var(--accent-dark); 
        flex: 0 0 auto;
    }
    
    #add-affaire-wrapper .panel.panel-primary > .panel-body { 
        padding: 40px 24px !important; 
    }

    /* Inner Custom Upload Card Container (Centered Small White Box) */
    #add-affaire-wrapper .col-lg-10 {
        width: 100% !important; 
        max-width: 440px !important; 
        margin: 0 auto !important; 
        float: none !important;
    }
    
    #add-affaire-wrapper .col-lg-10 .panel.panel-primary {
        background: #fff !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important; 
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-md) !important;
    }
    
    #add-affaire-wrapper .col-lg-10 .panel.panel-primary .panel-body { 
        padding: 28px 28px 10px 28px !important; 
    }

    /* Dynamic Form Element Controls Styling */
    #add-affaire-wrapper .payment-form .input { 
        margin-bottom: 18px !important; 
    }
    
    #add-affaire-wrapper .payment-form label {
        font-weight: 700 !important; 
        font-size: 13.5px !important; 
        color: var(--text-dark) !important;
        margin-bottom: 8px !important; 
        display: block !important; 
        float: none !important; 
        width: auto !important;
    }
    
    #add-affaire-wrapper .payment-form input.form-control {
        border: 1px solid var(--border-color) !important; 
        border-radius: var(--radius-sm) !important;
        background: #fafafa !important; 
        padding: 10px 12px !important; 
        font-size: 14px !important;
        color: var(--text-dark) !important; 
        width: 100% !important; 
        box-shadow: none !important;
        min-height: 44px !important; 
        float: none !important;
    }
    
    #add-affaire-wrapper .payment-form input.form-control:focus {
        border-color: var(--accent) !important; 
        background: #fff !important; 
        outline: none !important;
    }

    /* Layout Card Box Footer Structure */
    #add-affaire-wrapper .box-footer {
        background: transparent !important;
        border: none !important;
        padding: 0 28px 28px 28px !important;
    }

    #add-affaire-wrapper .well.text-center {
        background: transparent !important; 
        border: none !important; 
        border-top: 1px solid var(--border-color) !important;
        box-shadow: none !important; 
        padding: 24px 0 0 0 !important; 
        margin: 0 !important;
    }

    /* Central Blue Form Submit Link Button Styling */
    #add-affaire-wrapper .payment-form-submit,
    #add-affaire-wrapper input[type="submit"].btn-outline-info {
        -webkit-appearance: none !important; 
        appearance: none !important;
        background: var(--accent) !important; 
        border: none !important; 
        border-radius: var(--radius-sm) !important;
        color: #fff !important; 
        padding: 11px 32px !important; 
        font-weight: 600 !important; 
        font-size: 14px !important;
        box-shadow: 0 4px 12px rgba(0, 167, 208, 0.25) !important; 
        cursor: pointer !important;
        display: inline-flex !important; 
        align-items: center !important; 
        justify-content: center !important;
        transition: background 0.2s ease !important;
    }
    
    #add-affaire-wrapper input[type="submit"].btn-outline-info:hover {
        background: var(--accent-dark) !important;
        color: #fff !important;
    }
</style>

<div id="add-affaire-wrapper">
    <div class="panel panel-primary">
        <div class="panel-heading col-lg-8 col-xs-12">
            <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;">Ajouter une affaire</h3>
        </div>
        <div class="panel-body">
            <div class="col-lg-10 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-body form-horizontal payment-form">
                        <?php echo $this->Form->create('Prospectaffaire'); 
                        echo $this->Form->input('name', array("label" => "Nom", 'class' => 'form-control'));
                        ?>
                    </div>
                    <div class="box-footer">
                        <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-outline-info', 'div' => array('class' => 'well text-center'))); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>