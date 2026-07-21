<style type="text/css">
    #affaire-detail-wrapper {
        --accent: #00a7d0;
        --accent-dark: #008da0;
        --accent-light: #e6f6fa;
        --border-color: #ece9f9;
        --text-dark: #2d2b42;
        --text-muted: #8b87a3;
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 2px 14px rgba(0, 167, 208, 0.06);

        /* Action Buttons Pill Palette */
        --blue-btn-bg: #e6f6fa;
        --blue-btn-txt: #00a7d0;
        --orange-btn-bg: #fff9e6;
        --orange-btn-txt: #f39c12;
        --red-btn-bg: #fdeaf1;
        --red-btn-txt: #e0457b;
    }

    /* Modern Rounded Layout Cards */
    #affaire-detail-wrapper .box {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-lg) !important;
        box-shadow: var(--shadow-card) !important;
        overflow: hidden !important;
        margin-bottom: 24px !important;
    }

    /* Header Components Structural Realignment */
    #affaire-detail-wrapper .box-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 20px 24px !important;
        background: #fff !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    #affaire-detail-wrapper .box-header h2,
    #affaire-detail-wrapper .box-title {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: var(--text-dark) !important;
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
    }

    /* Header Context Action Buttons Style */
    #affaire-detail-wrapper .box-header .btn {
        margin: 0 !important;
        float: none !important;
    }

    #affaire-detail-wrapper .edit-header-link,
    #affaire-detail-wrapper .bg-purple {
        background: transparent !important;
        color: var(--text-dark) !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        border: none !important;
        padding: 0 !important;
        box-shadow: none !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    #affaire-detail-wrapper .edit-header-link:hover,
    #affaire-detail-wrapper .bg-purple:hover {
        color: var(--accent) !important;
        background: transparent !important;
    }

    /* Metadata Info Horizontal Grid Overhaul */
    #affaire-detail-wrapper .meta-table-container {
        padding: 24px !important;
    }

    #affaire-detail-wrapper .meta-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
        gap: 24px !important;
        background: #fafafa !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-md) !important;
        padding: 20px 24px !important;
    }

    #affaire-detail-wrapper .meta-block {
        display: flex !important;
        flex-direction: column !important;
        gap: 4px !important;
    }

    #affaire-detail-wrapper .meta-label {
        font-size: 11px !important;
        font-weight: 700 !important;
        color: var(--text-muted) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    #affaire-detail-wrapper .meta-value {
        font-size: 14px !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
    }

    /* Core Application Action Button Callout */
    #affaire-detail-wrapper .btn-info {
        background: var(--accent) !important;
        border: none !important;
        color: #fff !important;
        border-radius: var(--radius-sm) !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        box-shadow: 0 4px 14px rgba(0, 167, 208, 0.25) !important;
        transition: background 0.2s ease !important;
    }

    #affaire-detail-wrapper .btn-info:hover {
        background: var(--accent-dark) !important;
        color: #fff !important;
    }

    /* Content Workspace Details Area */
    #affaire-detail-wrapper .box-body {
        padding: 24px !important;
    }

    /* Datatable Modern Redesign Elements */
    #affaire-detail-wrapper table.table {
        border: none !important;
        margin: 16px 0 0 0 !important;
        width: 100% !important;
    }

    #affaire-detail-wrapper table.table tr th {
        background: #fafafa !important;
        color: var(--text-muted) !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        font-size: 12px !important;
        letter-spacing: 0.5px !important;
        padding: 14px 16px !important;
        border: none !important;
        border-bottom: 2px solid var(--border-color) !important;
    }

    #affaire-detail-wrapper table.table tr td {
        padding: 16px !important;
        font-size: 14px !important;
        color: var(--text-dark) !important;
        font-weight: 600 !important;
        vertical-align: middle !important;
        border: none !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    #affaire-detail-wrapper table.table tr:last-child td {
        border-bottom: none !important;
    }

    /* Row Inline Control Pillars Layout Flexbox alignment */
    #affaire-detail-wrapper td.actions {
        display: flex !important;
        gap: 8px !important;
        flex-wrap: wrap !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    #affaire-detail-wrapper td.actions a,
    #affaire-detail-wrapper td.actions form,
    #affaire-detail-wrapper td.actions input[type="submit"] {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 6px 16px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        border: none !important;
        box-shadow: none !important;
        text-decoration: none !important;
        text-transform: capitalize !important;
        cursor: pointer !important;
    }

    /* Specific Row Actions Custom Modifications Mapping */
    #affaire-detail-wrapper td.actions a.btn-info,
    #affaire-detail-wrapper td.actions a:contains("Voir") {
        background: var(--blue-btn-bg) !important;
        color: var(--blue-btn-txt) !important;
        box-shadow: none !important;
    }
    #affaire-detail-wrapper td.actions a.btn-info:hover,
    #affaire-detail-wrapper td.actions a:contains("Voir"):hover {
        background: #d4f0f7 !important;
    }

    #affaire-detail-wrapper td.actions a.btn-warning,
    #affaire-detail-wrapper td.actions a:contains("Edit") {
        background: var(--orange-btn-bg) !important;
        color: var(--orange-btn-txt) !important;
    }
    #affaire-detail-wrapper td.actions a.btn-warning:hover,
    #affaire-detail-wrapper td.actions a:contains("Edit"):hover {
        background: #fdecc8 !important;
    }

    #affaire-detail-wrapper td.actions .btn-danger,
    #affaire-detail-wrapper td.actions input[type="submit"] {
        background: var(--red-btn-bg) !important;
        color: var(--red-btn-txt) !important;
    }
    #affaire-detail-wrapper td.actions .btn-danger:hover,
    #affaire-detail-wrapper td.actions input[type="submit"]:hover {
        background: #fbcfe0 !important;
    }
</style>

<div id="affaire-detail-wrapper">
    <!-- Main Object Card Details Panel -->
    <div class="box">
        <div class="box-header table-responsive">
            <h2><?php echo __('Affaire'); ?></h2>
            <?php 
            if ($this->requestAction('/droits/getrole/prospectaffaires/edit') == 1)
                echo $this->Html->link(__('Editer'), array('action' => 'edit', $prospectaffaire['Prospectaffaire']['id']), array('class' => 'edit-header-link bg-purple btn-flat')); ?>
        </div>
        <div class="meta-table-container">
            <div class="meta-grid">
                <div class="meta-block">
                    <span class="meta-label">Chef de projet</span>
                    <span class="meta-value"><?php echo $prospectaffaire['User']['name']; ?></span>
                </div>
                <div class="meta-block">
                    <span class="meta-label"><?php echo __('Nom'); ?></span>
                    <span class="meta-value"><?php echo h($prospectaffaire['Prospectaffaire']['name']); ?></span>
                </div>
                <div class="meta-block">
                    <span class="meta-label">Code wavesoft</span>
                    <span class="meta-value"><?php echo h($prospectaffaire['Prospectaffaire']['code_wavesoft']); ?></span>
                </div>
                <div class="meta-block">
                    <span class="meta-label">Date d'ajout</span>
                    <span class="meta-value"><?php echo h($prospectaffaire['Prospectaffaire']['created']); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Collections Dynamic Sub-table Card Panel -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('La liste des compagnes'); ?></h3>
            <?php
            if ($this->requestAction('/droits/getrole/prospectcompagnes/add') == 1)
                echo $this->Html->link(__('Créé une compagne'), array('controller' => 'prospectcompagnes', 'action' => 'add', $prospectaffaire['Prospectaffaire']['id']), array('class' => 'btn btn-info'));
            ?>
        </div>
        <div class="box-body">
            <div class="related table-responsive">
                <?php if (!empty($prospectaffaire['Prospectcompagne'])): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Chef de projet</th>
                                <th><?php echo __('Nom'); ?></th>
                                <th>Objectif</th>
                                <th><?php echo __('Date Debut'); ?></th>
                                <th><?php echo __('Date Fin'); ?></th>
                                <th>Date d'ajout</th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prospectaffaire['Prospectcompagne'] as $prospectcompagne): ?>
                                <tr>
                                    <td><?php echo $prospectcompagne['user']; ?></td>
                                    <td><?php echo $prospectcompagne['name']; ?></td>
                                    <td><?php echo $prospectcompagne['objectif']; ?></td>
                                    <td><?php echo $prospectcompagne['date_debut']; ?></td>
                                    <td><?php echo $prospectcompagne['date_fin']; ?></td>
                                    <td><?php echo $prospectcompagne['created']; ?></td>
                                    <td class="actions">
                                        <?php
                                        if ($this->requestAction('/droits/getrole/prospectcompagnes/view') == 1)
                                            echo $this->Html->link(__('Voir'), array('controller' => 'prospectcompagnes', 'action' => 'view', $prospectcompagne['id']), array('class' => 'btn btn-info'));
                                        if ($this->requestAction('/droits/getrole/prospectcompagnes/edit') == 1)
                                            echo $this->Html->link(__('Edit'), array('controller' => 'prospectcompagnes', 'action' => 'edit', $prospectcompagne['id']), array('class' => 'btn btn-warning'));
                                        if ($this->requestAction('/droits/getrole/prospectcompagnes/delete') == 1)
                                            echo $this->Form->postLink(__('Supprimer'), array('controller' => 'prospectcompagnes', 'action' => 'delete', $prospectcompagne['id']), array('class' => 'btn btn-danger'), __('Etes-vous sur de vouloir supprimer ?'));
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>