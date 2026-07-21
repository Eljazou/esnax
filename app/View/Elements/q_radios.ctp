<style>
    .q-options-container {
        display: flex;
        justify-content: space-around;
        width: 100%;
        max-width: 350px;
        background: #fcfcfc;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 5px;
    }
    .radio-item {
        flex: 1;
        text-align: center;
        padding: 5px;
        cursor: pointer;
        transition: all 0.2s;
        border-radius: 4px;
    }
    .radio-item:hover {
        background: #f0f7fd;
    }
    .radio-item label {
        display: block;
        margin: 0;
        cursor: pointer;
        width: 100%;
    }
    .radio-item input[type="radio"] {
        display: block;
        margin: 5px auto;
        cursor: pointer;
        width: 16px;
        height: 16px;
    }
    .radio-desc {
        font-size: 9px;
        text-transform: uppercase;
        color: #888;
        display: block;
        line-height: 1;
        margin-bottom: 2px;
    }
    .radio-val {
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }
    /* Highlight selected radio item background if possible via neighboring sibling or future CSS, 
       but for now we'll stick to basic styling */
</style>

<div class="q-options-container">
    <?php for($i=1; $i<=4; $i++): 
        $label = '';
        switch($i) {
            case 1: $label = 'Insuffisant'; break;
            case 2: $label = 'Accompagnement'; break;
            case 3: $label = 'Conforme'; break;
            case 4: $label = 'Senior'; break;
        }
    ?>
    <div class="radio-item">
        <label>
            <span class="radio-desc"><?php echo $label; ?></span>
            <input type="radio" name="data[Evaluation][<?php echo $name; ?>]" value="<?php echo $i; ?>" 
                <?php echo (isset($this->request->data['Evaluation'][$name]) && $this->request->data['Evaluation'][$name] == $i) ? 'checked' : ''; ?> 
                required>
            <span class="radio-val"><?php echo $i; ?></span>
        </label>
    </div>
    <?php endfor; ?>
</div>
