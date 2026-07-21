<!-- ===== METRONIC LAVENDER FORM LAYOUT DESIGN ===== -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .lb-form-card, 
    .lb-form-card * {
        font-family: 'Poppins', sans-serif !important;
        box-sizing: border-box;
    }

    /* Card Wrapper Layout */
    .lb-form-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 22px rgba(144, 125, 250, 0.08);
        background: #ffffff;
        margin-bottom: 30px;
    }
    .lb-form-header {
        background: linear-gradient(135deg, #907DFA 0%, #AFA2FF 100%);
        padding: 18px 24px;
        border: none;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .lb-form-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.22);
        border-radius: 9px;
        color: #ffffff;
        flex-shrink: 0;
    }
    .lb-form-header .panel-title {
        color: #ffffff !important;
        font-weight: 600;
        margin: 0;
        font-size: 19px;
        letter-spacing: -0.2px;
    }

    /* Body & Row Elements */
    .lb-form-body {
        padding: 24px;
        background: #FAF9FE;
    }
    .lb-input-group-row {
        background: #ffffff;
        border: 1px solid #EAE6FF;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 2px 6px rgba(144, 125, 250, 0.02);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .lb-input-group-row:hover {
        border-color: #C5BCFF;
        box-shadow: 0 4px 12px rgba(144, 125, 250, 0.06);
    }

    /* Label Styling */
    .lb-field-label {
        font-size: 13px;
        font-weight: 600;
        color: #9C93D9;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        width: 140px;
        margin-bottom: 0;
        flex-shrink: 0;
    }

    /* Input Field Overrides */
    .lb-input-disabled {
        background: #F6F5FD !important;
        border: 1px solid #E4E0FC !important;
        color: #7966E3 !important;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        padding: 10px 16px;
        height: 44px;
        width: 100%;
        max-width: 320px;
    }
    .lb-input-value {
        background: #ffffff;
        border: 1.5px solid #EAE6FF;
        color: #554B82;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
        padding: 10px 16px;
        height: 44px;
        width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .lb-input-value:focus {
        outline: none;
        border-color: #907DFA;
        box-shadow: 0 0 0 3px rgba(144, 125, 250, 0.15);
    }

    /* Actions and Submit Button Styling */
    .lb-form-footer-container {
        background: transparent;
        border: none;
        padding: 15px 0 0 0;
        margin: 0;
        text-align: center;
    }
    .lb-btn-submit {
        background: linear-gradient(135deg, #907DFA 0%, #AFA2FF 100%) !important;
        color: #ffffff !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        padding: 12px 36px !important;
        border-radius: 10px !important;
        border: none !important;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(144, 125, 250, 0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }
    .lb-btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(144, 125, 250, 0.45);
    }
    .lb-btn-submit:active {
        transform: translateY(1px);
    }
</style>

<div class="panel lb-form-card">
    <div class="panel-heading lb-form-header">
        <span class="lb-form-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4.5v15m7.5-7.5h-15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </span>
        <h3 class="panel-title"><?php echo __('Ajouter un objectif'); ?></h3>
    </div>
    
    <div class="panel-body lb-form-body">
        <div class="payment-form">
            <?php echo $this->Form->create('Objectif');
            $i=-1;
            foreach ($types as $key => $value) : $i++;
            echo $this->Form->hidden('user_id', array('name' =>'data['.$i.'][user_id]','value' => $user_id));
            ?>
                <div class="lb-input-group-row">
                    <label class="lb-field-label">Objectif</label>
                    
                    <!-- Hidden Control Reference -->
                    <input value="<?php echo $key; ?>" name="data[<?php echo $i; ?>][type]" type="hidden" >
                    
                    <!-- Objective Category Display -->
                    <input value="<?php echo h($value); ?>" name="data[<?php echo $i; ?>][name]" class="lb-input-disabled" type="text" disabled="disabled" >
                    
                    <!-- Target Interactive Entry Field -->
                    <input value="0" name="data[<?php echo $i; ?>][objectif]" class="lb-input-value" type="text" placeholder="Entrez la valeur cible..." >
                </div>
            <?php endforeach;
            
            // Render structured footer submission area matching premium template architecture
            echo $this->Form->end(array(
                'label' => 'Envoyer', 
                'class' => 'btn lb-btn-submit', 
                'div' => array('class' => 'lb-form-footer-container')
            )); ?>
        </div>
    </div>
</div>