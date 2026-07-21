<style type="text/css">
    /* Theme Customizations */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        
        --theme-success: #5ad1a8;
        --theme-success-hover: #2f9c78;
        --theme-success-light: #e6faf3;
        
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Modern Panel Card Replacement */
    .custom-panel {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
        overflow: hidden;
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

    /* Refined Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
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
    }
    .form-control:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15) !important;
    }

    /* Product Rows Layout */
    .section-subtitle {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--theme-text-dark);
        margin: 25px 0 15px 0;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--theme-primary-light);
    }
    .product-row {
        background: #ffffff;
        padding: 8px 0;
        margin-bottom: 4px;
        border-radius: var(--radius-sm);
        transition: background-color 0.2s;
    }
    .product-row:hover {
        background-color: var(--theme-primary-light);
    }
    .product-row .form-group {
        margin-bottom: 0;
    }
    .product-row label {
        display: none; /* Keeps hidden for compact table-like display rows */
    }
    .product-row .has-label label {
        display: inline-block; /* Fallback if specific rows require titles */
    }

    /* Interactive Buttons */
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

    .btn-add-product {
        background: var(--theme-success-light) !important;
        color: var(--theme-success-hover) !important;
        border: 1px dashed var(--theme-success) !important;
        border-radius: var(--radius-sm);
        padding: 8px 16px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        margin-top: 10px;
    }
    .btn-add-product:hover {
        background: var(--theme-success) !important;
        color: #ffffff !important;
    }

    /* Submit Footer Area */
    .form-actions-well {
        background: var(--theme-primary-light);
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-top: 30px;
        text-align: center;
    }
</style>

<div class="custom-panel">
    <div class="custom-panel-header">
        <h3 class="custom-panel-title"><?php echo __('Editer l\'offre'); ?></h3>
    </div>
    
    <div class="custom-panel-body">
        <div class="row">
            <div class="col-lg-8 col-md-10">
                
                <?php echo $this->Form->create('Offre'); ?>
                
                <!-- Main Details Section -->
                <div class="form-group">
                    <?php echo $this->Form->input('id', array('label' => 'Id', 'class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('titre', array('label' => 'Titre', 'class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('description', array('label' => 'Description', 'class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('montantmin', array('label' => 'Montant minimal (DH)', 'class' => 'form-control')); ?>
                </div>

                <!-- Products Selection Section -->
                <h4 class="section-subtitle"><?php echo __('Produits inclus dans l\'offre'); ?></h4>
                
                <div class="products-container">
                    <?php 
                    $i = 0;
                    // Existing items loop
                    foreach ($offres as $offre) {
                        echo '<div class="row product-row comm comm'.$i.'">';
                        echo '<div class="col-xs-6">' . $this->Form->input('produit_id', array('label' => false, 'default' => $offre['Offrespicial']['produit_id'], 'name' => "data[$i][Offrespicial][produit_id]", 'class' => 'form-control prod')) . '</div>';
                        echo '<div class="col-xs-3">' . $this->Form->input('quantite', array('label' => false, 'name' => "data[$i][Offrespicial][quantite]", 'value' => $offre['Offrespicial']['quantite'], 'class' => 'form-control prodq', 'placeholder' => 'Qté')) . '</div>';
                        echo '<div class="col-xs-3">' . $this->Form->input('reduction', array('label' => false, 'name' => "data[$i][Offrespicial][reduction]", 'value' => $offre['Offrespicial']['reduction'], 'class' => 'form-control prodr', 'placeholder' => 'Réduction')) . '</div>';
                        echo '</div>';
                        $i++;
                    }
                    
                    // Supplementary empty rows loop (up to 10 items total)
                    for ($i = count($offres); $i < 10; $i++) {
                        echo '<div class="row product-row comm comm'.$i.'">';
                        echo '<div class="col-xs-6">' . $this->Form->input('produit_id', array('label' => false, 'name' => "data[$i][Offrespicial][produit_id]", 'class' => 'form-control prod')) . '</div>';
                        echo '<div class="col-xs-3">' . $this->Form->input('quantite', array('label' => false, 'name' => "data[$i][Offrespicial][quantite]", 'class' => 'form-control prodq', 'placeholder' => 'Qté')) . '</div>';
                        echo '<div class="col-xs-3">' . $this->Form->input('reduction', array('label' => false, 'name' => "data[$i][Offrespicial][reduction]", 'class' => 'form-control prodr', 'placeholder' => 'Réduction')) . '</div>';  
                        echo '</div>';
                    }
                    ?>
                    
                    <!-- Target element where dynamic additions inject via JavaScript -->
                    <div class="commande"></div>
                </div>

                <!-- Action Button Element to Inject Rows -->
                <div class="row">
                    <div class="col-xs-12">
                        <a onclick="addcom(<?php echo $i; ?>)" class="btn btn-add-product btnaddcom" style="cursor: pointer;">
                            <i class="fa fa-plus"></i> Ajouter un produit
                        </a>
                    </div>
                </div>

                <!-- Footer Submissions Wrapper -->
                <div class="form-actions-well">
                    <?php echo $this->Form->submit('Envoyer', array('class' => 'btn btn-lavender')); ?>
                </div>
                
                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    function addcom(id) {
        var e = parseInt(id) + 1;
        var comm = $('.comm:first').html(); // Targeted the first element template to avoid nested tree errors
        var commdiv = "<div class='row product-row comm" + id + "'>" + comm + "</div>";
        
        $('.commande').append(commdiv);
        
        $('.prod:eq(' + id + ')').attr("name", "data[" + id + "][Offrespicial][produit_id]");
        $('.prodq:eq(' + id + ')').attr("name", "data[" + id + "][Offrespicial][quantite]").val('');
        $('.prodr:eq(' + id + ')').attr("name", "data[" + id + "][Offrespicial][reduction]").val('');
        
        $(".btnaddcom").attr("onclick", "addcom(" + e + ")");
    }
</script>