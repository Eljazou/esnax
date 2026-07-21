<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style type="text/css">
    /* Theme Base Definitions */
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

    /* Modern Container Card */
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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .custom-panel-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .custom-panel-body {
        padding: 24px 28px;
    }

    /* Responsive Grid Wrapper */
    .table-responsive-custom {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Styled Clean Data Matrix */
    .table-custom {
        width: 100% !important;
        margin-bottom: 0;
        border-collapse: collapse;
    }
    .table-custom thead th {
        background-color: transparent;
        border-bottom: 2px solid var(--theme-border) !important;
        color: var(--theme-text-dark);
        font-weight: 700;
        font-size: 13.5px;
        padding: 14px 16px;
        text-transform: none;
        border-top: none !important;
    }
    .table-custom tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-custom tbody tr:hover {
        background-color: var(--theme-primary-light);
    }
    .table-custom tbody td {
        padding: 14px 16px;
        vertical-align: middle !important;
        border-top: 1px solid var(--theme-border) !important;
        color: var(--theme-text-dark);
        font-size: 14px;
    }

    /* Custom Typography inside Links */
    .table-custom tbody td a:not(.btn) {
        color: var(--theme-primary);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .table-custom tbody td a:not(.btn):hover {
        color: var(--theme-primary-hover);
        text-decoration: underline;
    }

    /* Interactive Buttons Architecture */
    .btn-lavender {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 8px 18px;
        font-weight: 600;
        font-size: 13px;
        transition: background 0.2s ease, transform 0.15s ease;
        display: inline-block;
        box-shadow: none !important;
    }
    .btn-lavender:hover {
        background: var(--theme-primary-hover) !important;
    }
    .btn-lavender-sm {
        padding: 6px 14px;
        font-size: 12.5px;
    }
</style>

<div class="custom-panel">
    <div class="custom-panel-header">
        <h3 class="custom-panel-title"><?php echo __('La liste des clients'); ?></h3>
        <?php echo $this->Html->link('Archiver tout', array('action' => 'archivetous'), array('class' => 'btn btn-lavender btn-lavender-sm')); ?>
    </div>
    
    <div class="custom-panel-body">
        <div class="table-responsive-custom">
            <table id="example1" class="table table-custom">
                <thead>
                    <tr>
                        <th>Nom & prénom</th>
                        <th>Type</th>
                        <th>Secteur</th>
                        <th>Spécialité</th>
                        <th>Potentialité</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo $this->Html->link($client['Client']['nom'].' '.$client['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?></td>
                            <td><?php echo $client['Type']['name']; ?></td>
                            <td><?php echo $client['Secteur']['full_name']; ?></td>
                            <td>
                                <?php 
                                if($client['Client']['category1_id'] == null) {
                                    echo $client['Category']['name'];
                                } else {
                                    echo $client['Category1']['name']; 
                                }
                                ?>&nbsp;
                            </td>
                            <td><?php echo h($client['Client']['potentialite']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('Désarchiver'), array('action' => 'archive', $client['Client']['id'], 1), array('class' => 'btn btn-lavender btn-lavender-sm')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50
        });
    });
</script>