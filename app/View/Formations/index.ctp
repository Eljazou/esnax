<style type="text/css">
    /* ---------- GLOBAL STRUCTURE ---------- */
    div.box {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        font-family: 'Poppins', sans-serif !important;
    }

    /* ---------- ABSOLUTE HEADER SPACING FIX ---------- */
    div.box-header {
        background: transparent !important;
        padding: 40px 15px 50px 15px !important;
        position: relative !important;
        border-bottom: none !important;
        display: block !important;
        height: auto !important;
        min-height: 80px !important;
    }

    div.box-header h3.box-title {
        font-size: 32px !important;
        font-weight: 700 !important;
        color: #11142d !important;
        float: left !important;
        margin: 0 !important;
        display: block !important;
    }

    div.box-header h3.box-title::after {
        content: "Gérez et consultez toutes les formations disponibles" !important;
        display: block !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #92929d !important;
        margin-top: 10px !important;
        text-transform: none !important;
        letter-spacing: 0.2px !important;
    }

    div.box-header a.btn, 
    div.box-header [class*="add"] a,
    div.box-header > a {
        position: absolute !important;
        right: 15px !important;
        top: 35px !important;
        background-color: #8c7ef2 !important;
        color: #ffffff !important;
        font-weight: 500 !important;
        font-size: 14px !important;
        padding: 14px 28px !important;
        border-radius: 16px !important;
        border: none !important;
        box-shadow: 0 10px 24px rgba(140, 126, 242, 0.25) !important;
        transition: all 0.3s ease !important;
        float: none !important;
        z-index: 999 !important;
    }

    div.box-header a.btn:hover {
        background-color: #7262eb !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 14px 28px rgba(140, 126, 242, 0.35) !important;
    }

    div.box-header a.btn::before {
        content: "+ " !important;
        font-weight: 600 !important;
        font-size: 15px !important;
    }

    /* ---------- GRID BODY ---------- */
    div.box-body {
        background: transparent !important;
        padding: 15px !important;
        clear: both !important;
    }

    @media (min-width: 992px) {
        .col-md-3 {
            width: 23.5% !important;
            margin: 0 0.75% 24px 0.75% !important;
            float: left !important;
        }
    }

    /* ---------- CARDS FORMAT ---------- */
    div.info-box {
        background: #ffffff !important;
        border-radius: 24px !important;
        border: 1px solid rgba(229, 224, 251, 0.5) !important;
        box-shadow: 0 10px 30px rgba(140, 126, 242, 0.02) !important;
        min-height: 250px !important;
        padding: 24px !important;
        margin: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        position: relative !important;
        transition: all 0.3s ease !important;
    }

    div.info-box:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 16px 36px rgba(140, 126, 242, 0.08) !important;
    }

    /* Card area linking to the file */
    .info-box-link-wrapper {
        text-decoration: none !important;
        display: block !important;
        width: 100% !important;
    }

    /* ---------- CARD ICONS AND COLORS ---------- */
    div.info-box span.info-box-icon {
        width: 60px !important;
        height: 60px !important;
        border-radius: 18px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        float: none !important;
        margin-bottom: 20px !important;
    }
    div.info-box span.info-box-icon i {
        font-size: 22px !important;
    }

    .col-md-3:nth-of-type(4n+1) span.info-box-icon { background: rgba(140, 126, 242, 0.12) !important; color: #8c7ef2 !important; }
    .col-md-3:nth-of-type(4n+1) span.info-box-icon i::before { content: "\f0f1" !important; } 
    .col-md-3:nth-of-type(4n+1) span.info-box-text span.info-box-text { color: #8c7ef2 !important; }

    .col-md-3:nth-of-type(4n+2) span.info-box-icon { background: rgba(56, 189, 248, 0.12) !important; color: #0ea5e9 !important; }
    .col-md-3:nth-of-type(4n+2) span.info-box-icon i::before { content: "\f21e" !important; } 
    .col-md-3:nth-of-type(4n+2) span.info-box-text span.info-box-text { color: #0ea5e9 !important; }

    .col-md-3:nth-of-type(4n+3) span.info-box-icon { background: rgba(52, 211, 153, 0.12) !important; color: #10b981 !important; }
    .col-md-3:nth-of-type(4n+3) span.info-box-icon i::before { content: "\f13d" !important; } 
    .col-md-3:nth-of-type(4n+3) span.info-box-text span.info-box-text { color: #10b981 !important; }

    .col-md-3:nth-of-type(4n+4) span.info-box-icon { background: rgba(251, 113, 133, 0.12) !important; color: #f43f5e !important; }
    .col-md-3:nth-of-type(4n+4) span.info-box-icon i::before { content: "\f0c3" !important; } 
    .col-md-3:nth-of-type(4n+4) span.info-box-text span.info-box-text { color: #f43f5e !important; }

    /* ---------- CARD TEXT ---------- */
    div.info-box-content {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }

    span.info-box-text {
        display: block !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #11142d !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        text-transform: uppercase !important;
    }

    span.info-box-text span.info-box-text {
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: none !important;
        margin-top: 6px !important;
    }

    /* ---------- CARD BUTTONS CONTAINER ---------- */
    .card-actions-container {
        position: absolute !important;
        bottom: 22px !important;
        left: 24px !important;
        right: 24px !important;
        width: calc(100% - 48px) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-direction: row-reverse !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    div.info-box a.btn, .btn-primary, .btn-warning, .btn-danger {
        border: none !important;
        box-shadow: none !important;
    }

    /* "Modifier" Link Styling */
    .btn-action-edit {
        background-color: transparent !important;
        color: #8c7ef2 !important;
        border: 1px solid rgba(140, 126, 242, 0.25) !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 8px 20px !important;
        border-radius: 12px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
    }
    
    .btn-action-edit::before {
        content: "\f044" !important;
        font-family: "FontAwesome" !important;
        margin-right: 6px !important;
        font-size: 12px !important;
    }

    .btn-action-edit:hover {
        background-color: rgba(140, 126, 242, 0.05) !important;
        border-color: #8c7ef2 !important;
    }

    /* "Archiver" Trash Button Styling */
    .btn-action-archive {
        background-color: #fff1f2 !important;
        color: #f43f5e !important;
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        border-radius: 50% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 0px !important;
        text-decoration: none !important;
    }

    .btn-action-archive::before {
        content: "\f1f8" !important;
        font-family: "FontAwesome" !important;
        font-size: 14px !important;
    }

    .btn-action-archive:hover {
        background-color: #f43f5e !important;
        color: #ffffff !important;
    }
</style>

<div class="row col-md-12" style="float:none;margin:auto;">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('La liste des formations'); ?></h3>
            <?php if ($this->requestAction('/droits/getrole/Formations/add') == 1)
                echo $this->Html->link(__('Ajouter'), array('action' => 'add'), array('class' => "btn bg-purple btn-flat", 'style' => "float:right;"));
            ?>
        </div>
        
        <div class="box-body">
            <div class="col-md-12" style="padding: 0px;">
                <?php foreach ($formations as $f): ?>
                    <div class="col-md-3 col-sm-5 col-xs-12" style="padding: 0px;margin: 6px;">
                        <div class="info-box" style="margin-bottom: 0px;box-shadow: 1px 1px 1px rgba(0,0,0,0.1) !important;">
                            
                            <!-- The file link only wraps the visual upper content elements -->
                            <a href="img/formations/<?php echo h($f['Formation']['file']); ?>" target="_blank" class="info-box-link-wrapper">
                                <span class="info-box-icon bg-light-blue"><i class="fa fa-graduation-cap"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text" style="color:#444;"><?php echo h($f['Formation']['name']); ?></span>
                                    <span class="info-box-text" style="color:#444;">Gamme : <?php echo h($f['Game']['name']); ?></span>
                                </div>
                            </a>

                            <!-- Independent structural actions row container placed outside the file hyperlink block -->
                            <div class="card-actions-container">
                                <?php
                                if ($this->requestAction('/droits/getrole/Formations/edit') == 1) {
                                    echo '<a href="' . $this->Html->URL(array('action' => 'edit', $f['Formation']['id'])) . '" class="btn-action-edit" title="Modifier">Modifier</a>';
                                }
                                if ($this->requestAction('/droits/getrole/Formations/archive') == 1) {
                                    echo '<a href="' . $this->Html->URL(array('action' => 'archive', $f['Formation']['id'], 0)) . '" class="btn-action-archive" title="Archiver">Archiver</a>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>