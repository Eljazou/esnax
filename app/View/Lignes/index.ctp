<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
    body { background: #f4f5fa; }

    .box {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(99, 60, 200, 0.08);
        overflow: hidden;
    }

    .box-header {
        background: #fff;
        padding: 24px 28px 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .box-header .icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #eee9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .box-header .icon-circle svg {
        width: 24px;
        height: 24px;
        stroke: #6b46e5;
    }

    .box-header h3.box-title {
        color: #1e1e2e;
        font-size: 21px;
        font-weight: 700;
        margin: 0;
    }

    .box-header .subtitle {
        color: #8b87a5;
        font-size: 14px;
        margin-top: 3px;
        font-weight: 400;
    }

    .btn-add-modern {
        background: linear-gradient(135deg, #7b5ce8 0%, #9b6ef0 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s ease;
        text-decoration: none !important;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(123, 92, 232, 0.35);
    }

    .btn-add-modern:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    .btn-add-modern svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
    }

    .btn-excel-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1e8e5a;
        color: #fff !important;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none !important;
        margin: 0 28px 18px;
    }

    .btn-excel-modern svg {
        width: 14px;
        height: 14px;
        stroke: #fff;
    }

    .dt-button {
        display: inline-flex !important;
        align-items: center;
        gap: 8px;
        background: #1e8e5a !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        margin: 0 0 18px 28px !important;
        float: none !important;
    }

    .dt-button:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    .box-body {
        padding: 0 28px 28px;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table.table thead th {
        background: #f2eefd;
        color: #6b5ecb;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border: none !important;
        padding: 14px 16px;
        white-space: nowrap;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 14px 16px;
        font-size: 14px;
        color: #3a3a4a;
        vertical-align: middle;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    .ligne-name {
        font-weight: 600;
        color: #2c2c3a;
    }

    .collab-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 28px;
        padding: 0 10px;
        border-radius: 20px;
        background: #efeafc;
        color: #5a3fd6;
        font-weight: 700;
        font-size: 13px;
    }

    td.actions {
        white-space: nowrap;
    }

    .btn-action {
        border: none;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        white-space: nowrap;
        margin-right: 6px;
        color: #fff !important;
    }

    .btn-action svg {
        width: 14px;
        height: 14px;
    }

    .btn-voir {
        background: #8b7cf0;
    }
    .btn-voir:hover {
        background: #7360e0;
        color: #fff !important;
    }

    .btn-editer {
        background: #b18ae8;
    }
    .btn-editer:hover {
        background: #9c6fdc;
        color: #fff !important;
    }

    .btn-supprimer {
        background: #d6588e;
    }
    .btn-supprimer:hover {
        background: #c1447a;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
        margin-bottom: 18px;
    }

    .dataTables_wrapper .dataTables_filter label {
        color: #4a4a5a;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        border: 1px solid #e0dbf7;
        padding: 8px 14px;
        font-size: 14px;
        margin-left: 0 !important;
        min-width: 220px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #7b5ce8;
    }
</style>
<div class="box">
    <div class="box-header table-responsive">
        <div class="title-wrap">
            <div class="icon-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </div>
            <div>
                <h3 class="box-title"><?php echo __('Lignes'); ?></h3>
                <div class="subtitle"><?php echo __('Consultez et gérez les lignes disponibles'); ?></div>
            </div>
        </div>
        <?php echo $this->Html->link(
            '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . __('Ajouter'),
            array('action' => 'add'),
            array('class' => 'btn-add-modern', 'escape' => false)
        ); ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ligne</th>
                    <th>N° de collaborateurs</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php 
            foreach ($lignes as $ligne):  ?>
                <tr>
                    <td class="ligne-name"><?php echo h($ligne['Ligne']['name']); ?>&nbsp;</td>
                    <td><span class="collab-badge"><?php echo count($ligne['User']); ?></span></td>
                    <td class="actions">
                        <?php 
                        if ($this->requestAction('/droits/getrole/lignes/view') == 1)
                            echo $this->Html->link(
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' . __('Voir'),
                                array('action' => 'view', $ligne['Ligne']['id']),
                                array('class' => 'btn-action btn-voir', 'escape' => false)
                            );
                        if ($this->requestAction('/droits/getrole/lignes/edit') == 1)
                            echo $this->Html->link(
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"></path></svg>' . __('Editer'),
                                array('action' => 'edit', $ligne['Ligne']['id']),
                                array('class' => 'btn-action btn-editer', 'escape' => false)
                            );
                        if ($this->requestAction('/droits/getrole/lignes/delete') == 1)
                            echo $this->Form->postLink(
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>' . __('Supprimer'),
                                array('action' => 'delete', $ligne['Ligne']['id']),
                                array('class' => 'btn-action btn-supprimer', 'escape' => false),
                                __('Etes-vous sur de vouloir supprimer ?')
                            ); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
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