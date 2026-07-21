<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('btn-style');
?>  

<style type="text/css">
    #prospectaffaires-wrapper {
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

        /* Action Pill Colors */
        --blue-btn-bg: #e6f6fa;
        --blue-btn-txt: #00a7d0;
        --orange-btn-bg: #fff9e6;
        --orange-btn-txt: #f39c12;
        --red-btn-bg: #fdeaf1;
        --red-btn-txt: #e0457b;
    }

    /* Modern Card Layout */
    #prospectaffaires-wrapper .box {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-lg) !important;
        box-shadow: var(--shadow-card) !important;
        overflow: hidden !important;
        margin-bottom: 30px;
    }

    /* Flex Row Page Header Container */
    #prospectaffaires-wrapper .box-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 24px !important;
        background: #fff !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    #prospectaffaires-wrapper .box-title {
        font-size: 22px !important;
        font-weight: 800 !important;
        color: var(--text-dark) !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    /* Document Icon Indicator Prefix */
    #prospectaffaires-wrapper .box-title:before {
        content: "\f0f6";
        font-family: "FontAwesome";
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: var(--radius-sm);
        background: var(--accent-light);
        color: var(--accent-dark);
        font-size: 18px;
    }

    /* Create Action Link Component Styling */
    #prospectaffaires-wrapper .btn-sc {
        background: var(--accent) !important;
        border: none !important;
        color: #fff !important;
        border-radius: var(--radius-sm) !important;
        padding: 11px 22px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        box-shadow: 0 4px 14px rgba(0, 167, 208, 0.25) !important;
        white-space: nowrap !important;
        transition: background 0.2s ease;
    }

    #prospectaffaires-wrapper .btn-sc:hover {
        background: var(--accent-dark) !important;
        color: #fff !important;
    }

    /* Data Table Custom Body Architecture */
    #prospectaffaires-wrapper .box-body {
        padding: 24px !important;
    }

    #prospectaffaires-wrapper table.table {
        border: none !important;
        margin: 0 !important;
        width: 100% !important;
    }

    #prospectaffaires-wrapper table.table thead th {
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

    #prospectaffaires-wrapper table.table tbody td {
        padding: 16px !important;
        font-size: 14px !important;
        color: var(--text-dark) !important;
        font-weight: 600 !important;
        vertical-align: middle !important;
        border: none !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    #prospectaffaires-wrapper table.table tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* Clean Flex Alignment for Actions Pillar */
    #prospectaffaires-wrapper td.actions {
        display: flex !important;
        gap: 8px !important;
        flex-wrap: wrap !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    /* Standard Pills Shape for Row Action Links */
    #prospectaffaires-wrapper td.actions a {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 6px 14px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-transform: capitalize !important;
        border: none !important;
        box-shadow: none !important;
        text-decoration: none !important;
    }

    /* Voir Action Modifier */
    #prospectaffaires-wrapper .btn-in.btn-outline-info {
        background: var(--blue-btn-bg) !important;
        color: var(--blue-btn-txt) !important;
    }
    #prospectaffaires-wrapper .btn-in.btn-outline-info:hover {
        background: #d4f0f7 !important;
    }

    /* Editer Action Modifier */
    #prospectaffaires-wrapper .btn-wr.btn-outline-warning {
        background: var(--orange-btn-bg) !important;
        color: var(--orange-btn-txt) !important;
    }
    #prospectaffaires-wrapper .btn-wr.btn-outline-warning:hover {
        background: #fdecc8 !important;
    }

    /* Supprimer Action Modifier */
    #prospectaffaires-wrapper .btn-dn.btn-outline-danger {
        background: var(--red-btn-bg) !important;
        color: var(--red-btn-txt) !important;
    }
    #prospectaffaires-wrapper .btn-dn.btn-outline-danger:hover {
        background: #fbcfe0 !important;
    }

    /* Form View Built-in DataTables Buttons Realignment */
    #prospectaffaires-wrapper .dt-buttons {
        margin-bottom: 16px !important;
    }
    #prospectaffaires-wrapper .dt-button {
        background: #fff !important;
        border: 1px solid var(--border-color) !important;
        padding: 6px 16px !important;
        border-radius: var(--radius-sm) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        box-shadow: none !important;
    }
    #prospectaffaires-wrapper .dt-button:hover {
        background: var(--accent-light) !important;
        border-color: var(--accent) !important;
    }
</style>

<div id="prospectaffaires-wrapper">
    <div class="box">
        <div class="box-header table-responsive">
            <h3 class="box-title"><?php echo __('Prospectaffaires'); ?></h3>

            <?php if ($this->requestAction('/droits/getrole/prospectaffaires/add') == 1)
                echo $this->Html->link("Créer une affaire", array('action' => 'add'), array('class' => 'btn-sc btn btn-outline-success')); ?>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Nom</th>
                        <th>Code wavesoft</th>
                        <th>Date d'ajout</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prospectaffaires as $prospectaffaire): ?>
                        <tr>
                            <td><?php echo $prospectaffaire['User']['name']; ?></td>
                            <td><?php echo h($prospectaffaire['Prospectaffaire']['name']); ?>&nbsp;</td>
                            <td><?php echo h($prospectaffaire['Prospectaffaire']['code_wavesoft']); ?>&nbsp;</td>
                            <td><?php echo h($prospectaffaire['Prospectaffaire']['created']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php 
                                if ($this->requestAction('/droits/getrole/prospectaffaires/view') == 1)
                                    echo $this->Html->link(__('Voir'), array('action' => 'view', $prospectaffaire['Prospectaffaire']['id']), array('class' => 'fa fa-eye btn-in btn btn-outline-info'));
                                if ($this->requestAction('/droits/getrole/prospectaffaires/edit') == 1)
                                    echo $this->Html->link(__('Editer'), array('action' => 'edit', $prospectaffaire['Prospectaffaire']['id']), array('class' => 'fa fa-pencil btn-wr btn btn-outline-warning')); 
                                if ($this->requestAction('/droits/getrole/prospectaffaires/delete') == 1)
                                    echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $prospectaffaire['Prospectaffaire']['id']), array('class' => 'fa fa-trash btn-dn btn btn-outline-danger'), __('Etes-vous sur de vouloir supprimer ?')); ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>