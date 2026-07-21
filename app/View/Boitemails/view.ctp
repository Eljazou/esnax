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
        padding: 0;
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

    /* Mail Reading Panel Specifics */
    .mailbox-read-info-custom {
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
        background: #ffffff;
    }
    .mailbox-read-info-custom h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--theme-text-dark);
        margin: 0 0 12px 0;
        line-height: 1.4;
    }
    .mailbox-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .mailbox-meta-sender {
        font-size: 14px;
        font-weight: 600;
        color: var(--theme-text-dark);
        margin: 0;
    }
    .mailbox-read-time-custom {
        font-size: 13px;
        color: var(--theme-text-muted);
        font-weight: 500;
    }

    /* Message Body Elements Container */
    .mailbox-read-message-custom {
        padding: 30px 28px;
        font-size: 15px;
        line-height: 1.7;
        color: var(--theme-text-dark);
        background: #ffffff;
    }
    .mailbox-read-message-custom p {
        margin-bottom: 20px;
    }

    /* Lavender Action Button Framework */
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
        display: inline-block;
        text-decoration: none !important;
        box-shadow: none !important;
    }
    .btn-lavender:hover {
        background: var(--theme-primary-hover) !important;
    }
    .message-actions-footer {
        border-top: 1px solid var(--theme-border);
        padding: 20px 28px;
        background: #ffffff;
        text-align: right;
    }
</style>

<h1 class="mailbox-main-title">Boite mail</h1>

<section class="content">
    <div class="row">
        <!-- Sidebar Folders Component -->
        <div class="col-md-3">
            <a href="<?php echo $this->Html->url(array('action' => 'add')); ?>" class="btn-compose">
                <i class="fa fa-pencil" style="margin-right: 6px;"></i> Nouveau message
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

        <!-- Mail Reading Element View -->
        <div class="col-md-9">
            <div class="mailbox-container">
                <div class="mailbox-header">
                    <h3 class="mailbox-title">Lire mail</h3>
                </div>
                
                <div class="mailbox-body">
                    <!-- Heading Meta Block Matrix -->
                    <div class="mailbox-read-info-custom">
                        <h3><?php echo h($boitemail['Boitemail']['titre']); ?></h3>
                        <div class="mailbox-meta-row">
                            <h5 class="mailbox-meta-sender">
                                <?php 
                                $name = 'Système';
                                if($boitemail['Boitemail']['user1_id'] != 0) {
                                    $name = "De : " . h($boitemail['User1']['name']) . " à " . h($boitemail['User']['name']);
                                }
                                echo $name; 
                                ?>
                            </h5>
                            <span class="mailbox-read-time-custom">
                                <i class="fa fa-clock-o" style="margin-right: 4px;"></i> 
                                <?php echo $boitemail['Boitemail']['created']; ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content Core Message Block -->
                    <div class="mailbox-read-message-custom">
                        <p><?php echo $boitemail['Boitemail']['message']; ?></p>
                    </div>

                    <!-- Dynamic Attachment Action Footer -->
                    <?php if(!empty($boitemail['Boitemail']['lien'])): ?>
                        <div class="message-actions-footer">
                            <a href="/esna<?php echo $boitemail['Boitemail']['lien']; ?>" class="btn-lavender">
                                <i class="fa fa-eye" style="margin-right: 6px;"></i> Voir
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>