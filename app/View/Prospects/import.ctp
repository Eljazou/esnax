<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .imp-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
        display:flex;
        justify-content:center;
        padding:30px 15px;
    }
    .imp-card{
        background:#fff !important;
        border:none !important;
        border-radius:18px !important;
        box-shadow:0 4px 24px rgba(108,99,245,0.08) !important;
        width:100%;
        max-width:520px;
        overflow:hidden;
    }
    .imp-card-header{
        background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
        padding:22px 26px;
        display:flex;
        align-items:center;
        gap:14px;
    }
    .imp-icon-badge{
        width:44px;
        height:44px;
        min-width:44px;
        border-radius:13px;
        background:linear-gradient(135deg,#efeeff,#e3e0ff);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .imp-icon-badge svg{
        width:20px;
        height:20px;
        stroke:#6C63F5;
    }
    .imp-card-title{
        font-size:16.5px;
        font-weight:600;
        color:#2d2b45;
        margin:0 0 4px 0;
    }
    .imp-card-header a{
        font-size:13px;
        font-weight:500;
        color:#6C63F5 !important;
        text-decoration:none;
    }
    .imp-card-header a:hover{
        text-decoration:underline;
    }
    .imp-card-body{
        background:#fff;
        padding:26px;
        overflow:hidden;
    }
    .imp-card-body:after{
        content:'';
        display:table;
        clear:both;
    }
    .imp-file-row{
        border:1.5px dashed #d8d3fb;
        border-radius:14px;
        background:#faf9ff;
        padding:22px;
        text-align:center;
        margin-bottom:22px;
        overflow:hidden;
    }
    .imp-card-body .form-control[type="file"]{
        border:none !important;
        background:transparent !important;
        box-shadow:none !important;
        display:inline-block;
        width:auto !important;
        max-width:100%;
        padding:0 !important;
        color:#6a6785;
        font-size:14px;
    }
    .imp-card-body .form-control[type="file"]::file-selector-button,
    .imp-card-body .form-control[type="file"]::-webkit-file-upload-button{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2);
        color:#fff;
        border:none;
        border-radius:999px;
        padding:9px 20px;
        font-weight:600;
        font-size:13.5px;
        margin-right:14px;
        cursor:pointer;
        transition:opacity .15s ease;
    }
    .imp-card-body .form-control[type="file"]::file-selector-button:hover,
    .imp-card-body .form-control[type="file"]::-webkit-file-upload-button:hover{
        opacity:.9;
    }
    .imp-submit-row{
        background:transparent !important;
        border:none !important;
        box-shadow:none !important;
        padding:0 !important;
        margin:0 !important;
        float:none !important;
        width:100% !important;
        clear:both;
        text-align:center;
    }
    .imp-card-body .btn.btn-primary.btn-large{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
        border:none !important;
        border-radius:999px !important;
        padding:11px 28px !important;
        font-weight:600;
        font-size:14.5px;
        box-shadow:0 6px 18px rgba(108,99,245,0.3) !important;
        color:#fff !important;
    }
</style>
<div class="imp-wrapper">
 <div class="imp-card">
    <div class="imp-card-header">
        <div class="imp-icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div>
            <h3 class="imp-card-title">Importer un fichier exel</h3>
            <?php echo $this->Html->link("Model fichier Excel ",array("controller"=>"files","action"=>"exemple","model des clients.xlsx")) ?>
        </div>
    </div>
    <div class="imp-card-body">
        <?php echo $this->Form->create('Prospect', array('type' => 'file')); ?>
        <div class="imp-file-row">
        <?php
        echo $this->Form->file('file', array('class' => 'form-control'));
        ?>
        </div>
        <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'imp-submit-row'))); ?>
    </div>
</div>
</div>
