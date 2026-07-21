<?php 
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->css("image-uploader.min"); 
?>
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

    /* ===== Design System Restyle (ANV) ===== */
    .anv-wrapper {
        font-family: 'Poppins', sans-serif;
        color: #3a3a4a;
    }
    /* Universal Flex Centering Fix */
    .anv-center-container {
        display: flex;
        justify-content: center;
        width: 100%;
    }
    .anv-wrapper .box {
        background: #fff !important;
        border: none !important;
        border-top: none !important;
        border-radius: 18px !important;
        box-shadow: 0 4px 24px rgba(108, 99, 245, 0.08) !important;
        overflow: hidden;
        margin-bottom: 24px;
        width: 100%;
    }
    .anv-wrapper .box-header.with-border {
        border: none !important;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 26px;
        background: linear-gradient(90deg, #f4f2ff 0%, #fbfaff 100%);
    }
    .anv-icon-badge {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 13px;
        background: linear-gradient(135deg, #efeeff, #e3e0ff);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .anv-icon-badge svg {
        width: 20px;
        height: 20px;
        stroke: #6C63F5;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .anv-wrapper .box-title {
        font-size: 16px;
        font-weight: 600;
        color: #2d2b45;
        margin: 0;
        padding: 0;
        line-height: 1;
    }
    .anv-wrapper .box-body {
        padding: 24px 26px;
    }
    .anv-wrapper .form-group {
        margin-bottom: 20px;
    }
    .anv-wrapper .form-group label {
        display: block;
        font-size: 13.5px;
        font-weight: 600;
        color: #454358;
        margin-bottom: 8px;
    }
    .anv-wrapper .form-control {
        border-radius: 12px !important;
        border: 1.5px solid #e7e5f7 !important;
        box-shadow: none !important;
        min-height: 44px !important;
        width: 100% !important;
        background-color: #fff !important;
        padding: 10px 16px;
        font-size: 14px;
    }
    .anv-wrapper input[type="file"].form-control {
        padding: 8px 12px;
        height: auto;
    }
    .anv-wrapper .well.text-center {
        background: #fff !important;
        border: none !important;
        border-top: 1px solid #eeecf9 !important;
        padding: 20px 0 0 0 !important;
        margin-top: 24px;
        box-shadow: none;
    }
    .anv-wrapper .btn-primary {
        background: linear-gradient(90deg, #6C63F5, #8c7ef2) !important;
        border: none !important;
        border-radius: 999px !important;
        padding: 12px 32px !important;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 6px 18px rgba(108, 99, 245, 0.3) !important;
        color: #fff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.2s ease;
    }
    .anv-wrapper .btn-primary:hover {
        opacity: 0.92;
    }
    
    .anv-wrapper .image-uploader {
        border: 1.5px dashed #d1cdef !important;
        border-radius: 14px !important;
        background: #fafaff !important;
    }
</style>

<div class="anv-wrapper">
    <!-- Using custom flex block to bypass Bootstrap version limitations -->
    <div class="row anv-center-container">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="anv-icon-badge">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                    </div>
                    <h3 class="box-title"><?php echo __('Ajouter une brochure'); ?></h3>
                </div>
                
                <div class="box-body">
                    <?php 
                    echo $this->Form->create('Brochure', array('type' => 'file'));
                    
                    echo $this->Form->input('category_id', array(
                        'label' => 'Catégorie', 
                        'class' => 'form-control',
                        'div' => array('class' => 'form-group')
                    ));
                    
                    echo $this->Form->input('game_id', array(
                        'label' => 'Gamme', 
                        'class' => 'form-control',
                        'div' => array('class' => 'form-group')
                    ));
                    
                    echo $this->Form->input('name', array(
                        'label' => 'Nom', 
                        'class' => 'form-control',
                        'div' => array('class' => 'form-group')
                    ));
                    ?>
                    
                    <div class="form-group">
                        <label for="BrochureLogo">Logo</label>
                        <?php echo $this->Form->file('logo', array('class' => 'form-control')); ?>
                    </div>
                    
                    <div class="row form-group imgs">
                        <div class="col-xs-12">
                            <div class="input-images" style="padding-top: .5rem; width: 100%;"></div>
                        </div>
                    </div>
                    
                    <?php
                    echo $this->Form->end(array(
                        'label' => 'Ajouter', 
                        'class' => 'btn btn-primary btn-large', 
                        'div' => array('class' => 'well text-center col-md-12')
                    )); 
                    ?>
                </div>
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
        $('div[class^="input-images"]').imageUploader();
    });
</script>