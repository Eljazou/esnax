<style type="text/css">
    /* Theme Core Global Parameters */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Header Title Stylings */
    .mailbox-main-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--theme-text-dark);
        margin: 0 0 25px 0;
    }

    /* Unified Content Containers */
    .mailbox-container {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 30px;
    }
    .mailbox-header {
        background: #ffffff;
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
    }
    .mailbox-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .mailbox-body {
        padding: 28px;
    }

    /* Left Sidebar Navigation Controls */
    .btn-compose {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 12px 20px;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        width: 100%;
        display: block;
        transition: background 0.2s ease;
        margin-bottom: 20px;
        box-shadow: none !important;
        text-decoration: none !important;
    }
    .btn-compose:hover {
        background: var(--theme-primary-hover) !important;
    }

    .folder-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .folder-nav-list li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        color: var(--theme-text-dark);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        margin-bottom: 4px;
    }
    .folder-nav-list li a:hover {
        background-color: var(--theme-primary-light);
        color: var(--theme-primary);
    }
    .folder-nav-list li a i {
        margin-right: 10px;
        font-size: 16px;
        color: var(--theme-text-muted);
    }
    .folder-nav-list li a:hover i {
        color: var(--theme-primary);
    }
    .folder-badge {
        background-color: var(--theme-primary-pale);
        color: var(--theme-primary);
        font-size: 12px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* Modernized Form Element Blocks */
    .form-group {
        margin-bottom: 22px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 14px;
        color: var(--theme-text-dark);
        margin-bottom: 8px;
    }
    .mailbox-input {
        width: 100%;
        height: 46px;
        padding: 10px 16px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--theme-text-dark);
        background-color: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-sm);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .mailbox-input:focus {
        border-color: var(--theme-primary);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15);
    }
    textarea.mailbox-input {
        height: auto !important;
        min-height: 180px;
        resize: vertical;
        padding-top: 12px;
    }

    /* Action Elements Footer Area */
    .mailbox-footer-custom {
        border-top: 1px solid var(--theme-border);
        padding: 20px 28px;
        background: #ffffff;
        display: flex;
        justify-content: flex-end;
    }
    .btn-send {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 12px 26px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: none !important;
    }
    .btn-send:hover {
        background: var(--theme-primary-hover) !important;
    }
</style>

<h1 class="mailbox-main-title">Boite mail</h1>

<section class="content">
    <div class="row">
        <!-- Sidebar Controls Left Pane -->
        <div class="col-md-3">
            <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn-compose">
                <i class="fa fa-arrow-left" style="margin-right: 6px;"></i> Retour
            </a>

            <div class="mailbox-container" style="padding: 15px 12px;">
                <h4 style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--theme-text-muted); margin: 5px 0 12px 12px; font-weight: 700;">Dossiers</h4>
                <ul class="folder-nav-list">
                    <li>
                        <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>">
                            <span><i class="fa fa-inbox"></i> Boite de réception</span>
                            <span class="folder-badge">
                                <?php echo $this->requestAction('/boitemails/system_get_nombre_mail'); ?>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Html->url(array('action' => 'index', -1)); ?>">
                            <span><i class="fa fa-paper-plane-o"></i> Boite d'envoi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Compose Envelope Window Workspace -->
        <div class="col-md-9">
            <div class="mailbox-container">
                <div class="mailbox-header">
                    <h3 class="mailbox-title">Envoyer un message</h3>
                </div>
                
                <?php echo $this->Form->create('Boitemail'); ?>
                
                <div class="mailbox-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('user_id', array(
                            'label' => 'Utilisateur',
                            'class' => 'mailbox-input',
                            'div' => false
                        )); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo $this->Form->input('titre', array(
                            'label' => 'Titre',
                            'placeholder' => "Sujet : ",
                            'class' => 'mailbox-input',
                            'div' => false
                        )); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo $this->Form->input('message', array(
                            'label' => 'Message',
                            'type' => 'textarea',
                            'class' => 'mailbox-input',
                            'div' => false
                        )); ?>
                    </div>
                </div>
                
                <div class="mailbox-footer-custom">
                    <button type="submit" class="btn-send">
                        <i class="fa fa-envelope-o"></i> Envoyer
                    </button>
                </div>
                
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>