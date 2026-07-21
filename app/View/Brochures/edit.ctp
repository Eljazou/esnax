<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .material-icons {
        font-family: 'Source Sans Pro'!important;
    }
    .imgs{
        margin: 0px!important;
        margin-top: 18px!important;
        margin-bottom: 18px!important;
    }
</style>

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
        --theme-border: #ece9f9;
        --radius-xl: 22px;
    }

    body, .panel, .form-control {
        font-family: 'Poppins', sans-serif;
    }

    /* Layout centering container */
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
        max-width: 750px; /* Forces form size limitation just like the previous design */
        margin-bottom: 30px;
    }

    .panel.panel-primary > .panel-heading {
        display: none;
    }

    .edit-hero {
        position: relative;
        overflow: hidden;
        padding: 30px 34px;
        background: linear-gradient(120deg, #ffffff 0%, #ffffff 55%, #ece7fd 100%);
        display: flex;
        align-items: flex-start;
        gap: 18px;
        border-radius: 22px 22px 0 0;
    }

    .hero-icon {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 16px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        z-index: 2;
    }

    .hero-title {
        font-size: 22px;
        font-weight: 700;
        color: #171730;
        margin: 4px 0 4px;
    }

    .hero-subtitle {
        font-size: 13.5px;
        color: #8d8da8;
        font-weight: 500;
    }

    .hero-illustration {
        position: absolute;
        top: 0;
        right: 0;
        opacity: .9;
        z-index: 1;
        pointer-events: none;
    }

    .panel-body.form-horizontal {
        padding: 28px 34px 30px !important;
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

    .field-body { flex: 1; min-width: 0; }

    .field-body label {
        font-weight: 700;
        font-size: 13.5px;
        color: #171730;
        display: block;
        margin-bottom: 8px;
    }

    .field-body .form-control,
    .field-body select.form-control {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 10px !important;
        height: auto !important;
        padding: 10px 14px !important;
        font-size: 14px !important;
        box-shadow: none !important;
        width: 100%;
    }

    .field-body .form-control:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    .file-upload-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1.5px solid #d9d6fb;
        background: #fbfaff;
        border-radius: 10px;
        padding: 8px 14px;
    }

    .file-upload-wrap svg { color: var(--primary); flex-shrink: 0; }

    .file-upload-wrap input[type="file"] {
        font-size: 13.5px;
        color: #8d8da8;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        height: auto !important;
    }

    .file-upload-wrap input[type="file"]::file-selector-button,
    .file-upload-wrap input[type="file"]::-webkit-file-upload-button {
        background: var(--primary-light);
        color: var(--primary) !important;
        border: none;
        border-radius: 20px;
        padding: 7px 18px;
        font-weight: 600;
        font-size: 13.5px;
        margin-right: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    /* FIX: Hover state readability fix */
    .file-upload-wrap input[type="file"]:hover::file-selector-button,
    .file-upload-wrap input[type="file"]:hover::-webkit-file-upload-button {
        background: var(--primary) !important;
        color: #ffffff !important;
        opacity: 0.9;
    }

    .imgs .input-images {
        border: 1.5px dashed #d9d6fb !important;
        border-radius: 10px !important;
        background: #fbfaff !important;
        min-height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--primary);
        font-weight: 700;
        font-size: 12.5px;
        padding: 10px 16px !important;
    }

    .imgs .input-images:empty:before {
        content: "Ajouter d'autres images";
        white-space: pre-line;
        color: var(--primary);
        font-weight: 700;
        line-height: 1.4;
    }

    .imgs .input-images .uploaded-image {
        border-radius: 10px !important;
        overflow: hidden;
        border: 1px solid var(--primary-light) !important;
    }

    .well.text-center.col-md-12 {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 22px 0 0 !important;
        margin-top: 8px;
        border-top: 1px solid #f1effa;
        text-align: right !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse; /* Places Action button to right and Cancel link to left edge */
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        border: 1.5px solid #e7e6f7;
        color: #6b6b85 !important;
        background: #fff;
        border-radius: 20px;
        padding: 10px 26px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none !important;
    }

    .btn-cancel:hover {
        background: #f7f6ff;
        border-color: #d9d6fb;
    }

    .well.text-center.col-md-12 input[type="submit"] {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 20px !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 10px 28px !important;
        font-size: 14px;
        box-shadow: 0 6px 16px rgba(108, 99, 245, .3);
    }

    .well.text-center.col-md-12 input[type="submit"]:hover {
        background: linear-gradient(135deg, #5f56ee, #3f66e6) !important;
    }
</style>

<!-- Added structural centering node wrapper -->
<div class="panel-center-wrapper">
    <div class="panel panel-primary">
        <div class="edit-hero">
            <div class="hero-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="m15.5 12.5-3 3 3 3"/></svg>
            </div>
            <div>
                <h3 class="hero-title"><?php echo __('Editer la Brochure'); ?></h3>
                <div class="hero-subtitle">Modifiez les informations de la brochure</div>
            </div>
            <svg class="hero-illustration" width="200" height="130" viewBox="0 0 200 130" fill="none">
                <path d="M40 130 Q100 40 200 60 L200 130 Z" fill="#ece7fd"/>
                <rect x="130" y="30" width="55" height="75" rx="6" fill="#fff" stroke="#c9bff5" stroke-width="2"/>
                <rect x="140" y="42" width="35" height="22" rx="3" fill="#ece7fd"/>
                <path d="M147 58 L157 48 L164 55 L172 44" stroke="#8f7bfb" stroke-width="1.5" fill="none"/>
                <rect x="140" y="70" width="35" height="3" rx="1.5" fill="#e2ddfb"/>
                <rect x="140" y="78" width="30" height="3" rx="1.5" fill="#e2ddfb"/>
                <rect x="140" y="86" width="25" height="3" rx="1.5" fill="#e2ddfb"/>
                <circle cx="120" cy="30" r="3" fill="#8f7bfb" opacity="0.5"/>
                <circle cx="192" cy="35" r="2.5" fill="#8f7bfb" opacity="0.6"/>
                <path d="M185 90 q10 -15 20 -5 q-10 5 -20 5z" fill="#a8e6b0" opacity="0.6"/>
            </svg>
        </div>
        
        <div class="panel-body form-horizontal payment-form">
            <div class="col-lg-12" style="width:100%; padding:0;">
                <?php
                echo $this->Form->create('Brochure', array('type' => 'file'));
                echo $this->Form->input('id', array('class' => 'form-control'));
                ?>
                
                <div class="field-row">
                    <div class="field-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    </div>
                    <div class="field-body">
                        <?php echo $this->Form->input('category_id', array('label' => 'Catégorie', 'class' => 'form-control', 'div' => false)); ?>
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 8-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M3 8l9 5 9-5"/></svg>
                    </div>
                    <div class="field-body">
                        <?php echo $this->Form->input('game_id', array('label' => 'Gamme', 'class' => 'form-control', 'div' => false)); ?>
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                    </div>
                    <div class="field-body">
                        <?php echo $this->Form->input('name', array('label' => 'Nom', 'class' => 'form-control', 'div' => false)); ?>
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                    <div class="field-body">
                        <label>Logo</label>
                        <div class="file-upload-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M17 8l-5-5-5 5"/><path d="M12 3v12"/></svg>
                            <?php echo $this->Form->file('logo', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>

                <div class='row form-group imgs'>
                    <div class="input-images" style="padding-top: .5rem; width: 100%;"></div>
                </div>
                
                <?php
                echo $this->Html->link('Annuler', array('action' => 'index'), array('class' => 'btn-cancel'));
                echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12')));
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function handlefiles(v)
    {
        var photos = $(".input-images .uploaded-image").length;
        var dataurl = null;
        var vv = 'file'+v
        var filesToUpload = document.getElementById(vv).files;
        if(parseInt(filesToUpload.length)>4){
          alert("Vous ne pouvez télécharger qu'un maximum de 4 fichiers ");
          setTimeout(() => {
            $(".uploaded div").remove();
          },500);
        }
        else
        {
            var photos = $(".input-images .uploaded-image").length;
            var file = filesToUpload[0];

            var img = document.createElement("img");
            var reader = new FileReader();

            reader.onload = function (e)
            {
                img.src = e.target.result;

                img.onload = function () {
                    var canvas = document.createElement("canvas");
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0);

                    var MAX_WIDTH = 1200;
                    var MAX_HEIGHT = 840;
                    var width = img.width;
                    var height = img.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, width, height);

                    dataurl = canvas.toDataURL("image/jpeg");
                    var input_hidden = $("<input>", { type: "hidden",name: "data[Brochure][file]["+photos+"]",multiple: "" }).appendTo($(".uploaded-image").attr("data-index", photos));
                    $($("input[name='data[Brochure][file]["+photos+"]'")).attr("value",dataurl);
                    var fd = new FormData();
                    fd.append("image", dataurl);
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<?php echo $this->Html->script("image-uploader.min"); ?>
<script>
    $(function () {
        $('div [class^="input-images"]').imageUploader();
    });
</script>