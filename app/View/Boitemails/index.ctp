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
        --star-color: #ffb834;
        --star-empty: #d2cee2;
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

    /* Core Mail Grid Component Matrix with Strict Layout Controls */
    .table-mailbox {
        width: 100% !important;
        margin-bottom: 0;
        border-collapse: collapse;
        table-layout: fixed; /* Enforces precise column distribution */
    }
    .table-mailbox tr {
        border-bottom: 1px solid var(--theme-border);
        transition: background-color 0.15s ease;
    }
    .table-mailbox tr:last-child {
        border-bottom: none;
    }
    .table-mailbox tr:hover {
        background-color: var(--theme-primary-light);
    }
    .table-mailbox td {
        padding: 16px 14px;
        vertical-align: middle !important;
        color: var(--theme-text-dark);
        font-size: 14px;
    }

    /* Structured Width Matrix & Edge Controls */
    .td-star {
        width: 6%;
        min-width: 45px;
        text-align: center;
        padding-right: 0 !important;
    }
    .td-star i.fa-star {
        color: var(--star-color);
        font-size: 15px;
    }
    .td-star i.fa-star-o {
        color: var(--star-empty);
        font-size: 15px;
    }
    
    .td-name {
        width: 22%;
        min-width: 140px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .td-name a {
        color: var(--theme-primary);
        text-decoration: none;
    }
    .td-name a:hover {
        color: var(--theme-primary-hover);
        text-decoration: underline;
    }
    
    .td-subject {
        width: 47%;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .unread-mail .td-subject b {
        font-weight: 700;
        color: #000000;
    }
    
    .td-date {
        width: 25%;
        min-width: 160px;
        text-align: right;
        color: var(--theme-text-muted);
        font-size: 13px;
        padding-right: 28px !important; /* Forces the date away from the card boundary */
        white-space: nowrap;
    }

    /* Modern Pagination System Blocks */
    .custom-pagination-wrap {
        margin-top: 25px;
        margin-bottom: 30px;
        text-align: center;
    }
    .paging-container {
        display: inline-flex;
        gap: 4px;
        background: #ffffff;
        padding: 6px;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
    }
    .paging-container a, 
    .paging-container span {
        display: inline-block;
        padding: 8px 14px;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--theme-text-dark);
        text-decoration: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
    }
    .paging-container a:hover {
        background-color: var(--theme-primary-light);
        color: var(--theme-primary);
    }
    .paging-container span.current {
        background-color: var(--theme-primary);
        color: #ffffff;
    }
    .paging-container .prev, 
    .paging-container .next {
        color: var(--theme-primary);
    }
</style>

<h1 class="mailbox-main-title">Boite mail</h1>

<section class="content">
    <div class="row">
        <!-- Sidebar Navigation -->
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

        <!-- Main Message Grid Column -->
        <div class="col-md-9">
            <div class="mailbox-container">
                <div class="mailbox-header">
                    <h3 class="mailbox-title">Ma Boite</h3>
                </div>
                
                <div class="mailbox-body">
                    <div class="table-responsive" style="border: none;">
                        <table class="table table-mailbox">
                            <tbody>
                                <?php foreach ($boitemails as $boitemail): ?>
                                    <tr class="<?php echo ($boitemail['Boitemail']['vue'] == 0) ? 'unread-mail' : 'read-mail'; ?>">
                                        
                                        <td class="td-star">
                                            <a href="#">
                                                <?php if($boitemail['Boitemail']['vue'] == 0): ?>
                                                    <i class="fa fa-star"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        
                                        <td class="td-name">
                                            <?php 
                                            $name = 'Système';
                                            if($boitemail['Boitemail']['user1_id'] != 0) {
                                                $name = $boitemail['User1']['name'];
                                            }
                                            echo $this->Html->link($name, array('action' => 'view', $boitemail['Boitemail']['id'])); 
                                            ?>
                                        </td>
                                        
                                        <td class="td-subject">
                                            <b><?php echo $boitemail['Boitemail']['titre']; ?></b>
                                        </td>
                                        
                                        <td class="td-date">
                                            <?php echo $boitemail['Boitemail']['created']; ?>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pagination Control Node -->
<div class="custom-pagination-wrap">
    <div class="paging-container">
        <?php
        echo $this->Paginator->prev('< ' . __('Précédent'), array('tag' => false), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '', 'currentClass' => 'current', 'currentTag' => 'span'));
        echo $this->Paginator->next(__('Suivant') . ' >', array('tag' => false), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>