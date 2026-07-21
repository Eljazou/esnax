<style>
    #import-pot-excel{
        /* Color variables updated from harsh purple to soft lavender */
        --accent: #a78bfa; /* Soft Lavender accent */
        --accent-dark: #8b5cf6; /* Deeper Lavender for hover states */
        --accent-light: #f5f3ff; /* Very pale Lavender background for header */
        --accent-pale: #ede9fe; /* Slightly more saturated pale Lavender */

        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        /* Box shadow adjusted for the lavender tint */
        --shadow-card:0 2px 14px rgba(167, 139, 250, 0.08); 
    }

    /* Scoped under an ID to reliably out-specify existing skin styles */
    #import-pot-excel .panel.panel-primary{
        background:#fff !important; 
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-lg) !important; 
        box-shadow:var(--shadow-card) !important; 
        overflow:hidden !important;
    }
    #import-pot-excel .panel.panel-primary > .panel-heading{
        background:var(--accent-light) !important; 
        border-bottom:1px solid var(--border-color) !important;
        padding:16px 24px !important;
    }
    #import-pot-excel .panel.panel-primary > .panel-heading .panel-title{
        color:var(--text-dark) !important; 
        font-size:16px !important; 
        font-weight:700 !important;
        display:flex !important; 
        align-items:center !important; 
        margin-bottom:6px !important;
    }
    #import-pot-excel .panel.panel-primary > .panel-heading .panel-title:before{
        content:"\f0ee"; 
        font-family:"FontAwesome"; 
        display:inline-flex; 
        align-items:center; 
        justify-content:center;
        width:32px; 
        height:32px; 
        border-radius:50%; 
        margin-right:10px; 
        font-size:14px;
        background:#fff; 
        color:var(--accent-dark); 
        flex:0 0 auto;
    }
    #import-pot-excel .panel.panel-primary > .panel-heading a{
        color:var(--accent-dark) !important; 
        font-weight:600 !important; 
        font-size:13px !important;
        text-decoration:underline !important;
    }
    #import-pot-excel .panel.panel-primary > .panel-body{ 
        padding:40px 24px !important; 
    }

    /* Inner Upload Card Container (Small White Box Centered) */
    #import-pot-excel .col-lg-6 .panel.panel-primary{
        background:#fff !important;
        box-shadow:0 4px 20px rgba(0,0,0,0.03) !important; 
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-md) !important;
    }
    #import-pot-excel .col-lg-6 .panel.panel-primary .panel-body{ 
        padding:28px !important; 
    }

    #import-pot-excel .payment-form .input{ 
        margin-bottom:18px !important; 
    }
    #import-pot-excel .payment-form label{
        font-weight:700 !important; 
        font-size:13.5px !important; 
        color:var(--text-dark) !important;
        margin-bottom:8px !important; 
        display:block !important; 
        float:none !important; 
        width:auto !important;
    }
    #import-pot-excel .payment-form select.form-control,
    #import-pot-excel .payment-form input.form-control{
        border:1px solid var(--border-color) !important; 
        border-radius:var(--radius-sm) !important;
        background:#fafafa !important; 
        padding:10px 12px !important; 
        font-size:14px !important;
        color:var(--text-dark) !important; 
        width:100% !important; 
        box-shadow:none !important;
        min-height:44px !important; 
        float:none !important;
    }
    #import-pot-excel .payment-form select.form-control:focus,
    #import-pot-excel .payment-form input.form-control:focus{
        border-color:var(--accent) !important; 
        background:#fff !important; 
        outline:none !important;
    }

    /* Narrower, beautifully centered card structure */
    #import-pot-excel .col-lg-6{
        width:100% !important; 
        max-width:440px !important; 
        margin:0 auto !important; 
        float:none !important;
    }

    /* Custom File Picker Elements */
    #import-pot-excel .file-field-wrap{
        position:relative; 
        display:flex; 
        align-items:center; 
        gap:0; 
        margin-bottom:18px;
        border:1px solid var(--border-color); 
        border-radius:var(--radius-sm); 
        background:#fafafa; 
        overflow:hidden;
    }
    #import-pot-excel .file-field-wrap .file-btn{
        flex:0 0 auto; 
        background:var(--accent); 
        color:#fff; 
        font-weight:600; 
        font-size:13px;
        padding:12px 18px; 
        white-space:nowrap; 
        display:flex; 
        align-items:center; 
        gap:7px;
    }
    #import-pot-excel .file-field-wrap .file-btn i{ 
        font-size:12px; 
    }
    #import-pot-excel .file-field-wrap .file-name{
        flex:1 1 auto; 
        padding:0 14px; 
        font-size:13.5px; 
        color:var(--text-muted); 
        overflow:hidden;
        text-overflow:ellipsis; 
        white-space:nowrap;
    }
    #import-pot-excel .payment-form input[type="file"]{
        position:absolute; 
        top:0; 
        left:0; 
        width:100%; 
        height:100%; 
        opacity:0; 
        cursor:pointer; 
        margin:0 !important;
    }
    #import-pot-excel .file-field-wrap:hover .file-btn{ 
        background:var(--accent-dark); 
    }

    #import-pot-excel .payment-form .well.text-center{
        background:transparent !important; 
        border:none !important; 
        border-top:1px solid var(--border-color) !important;
        box-shadow:none !important; 
        padding:18px 0 0 0 !important; 
        margin-top:12px !important;
    }

    /* Central Lavender Submit Action Button */
    #import-pot-excel .payment-form input[type="submit"].btn-primary{
        -webkit-appearance:none !important; 
        appearance:none !important;
        background:var(--accent) !important; 
        border:none !important; 
        border-radius:var(--radius-sm) !important;
        color:#fff !important; 
        padding:11px 32px !important; 
        font-weight:600 !important; 
        font-size:14px !important;
        /* Shadow updated to reflect soft lavender tone */
        box-shadow:0 4px 12px rgba(167, 139, 250, 0.25) !important; 
        cursor:pointer !important;
        display: inline-flex !important; 
        align-items: center !important; 
        justify-content: center !important;
    }
    #import-pot-excel .payment-form input[type="submit"].btn-primary:hover{
        background:var(--accent-dark) !important;
    }
</style>

<div id="import-pot-excel">
 <div class="panel panel-primary">
     <div class="panel-heading">
         <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;">Importer un fichier Excel</h3>
         <?php echo $this->Html->link("Model fichier Excel", '/files/exemple/pots.xlsx') ?>
     </div>
     <div class="panel-body">
         <div class="col-lg-6">
             <div class="panel panel-primary">
                 <div class="panel-body form-horizontal payment-form">
                     <?php echo $this->Form->create('Pot', array('type' => 'file')); ?>
                     <?php
                        echo $this->Form->input('game_id', array('label' => 'Gamme', 'class' => 'form-control'));
                        echo $this->Form->input('user_id', array('label' => 'VM', 'class' => 'form-control'));
                        ?>
                     <div class="file-field-wrap">
                        <span class="file-btn"><i class="fa fa-upload"></i> Choisir un fichier</span>
                        <span class="file-name" id="pot-file-name">Aucun fichier choisi</span>
                        <?php echo $this->Form->file('file', array('class' => 'form-control')); ?>
                     </div>
                     <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>

<script>
    (function(){
        var wrap = document.querySelector('#import-pot-excel .file-field-wrap');
        if (!wrap) return;
        var input = wrap.querySelector('input[type="file"]');
        var label = document.getElementById('pot-file-name');
        if (input && label) {
            input.addEventListener('change', function(){
                label.textContent = input.files && input.files.length ? input.files[0].name : 'Aucun fichier choisi';
            });
        }
    })();
</script>