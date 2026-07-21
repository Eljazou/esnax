<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('btn-style');
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

    .box-body {
        padding: 8px 28px 28px;
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
        letter-spacing: 0.3px;
        border: none !important;
        padding: 12px 14px;
        white-space: nowrap;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 12px 14px;
        font-size: 13.5px;
        color: #3a3a4a;
        vertical-align: middle;
        white-space: nowrap;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    .ville-cell, .destination-cell, .nuit-cell {
        font-weight: 600;
        color: #2c2c3a;
    }

    .date-cell {
        color: #8b87a5;
    }

    td.actions {
        white-space: nowrap;
    }

    .btn-action {
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 12.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        white-space: nowrap;
        margin: 2px 4px 2px 0;
        background: #fff;
        border: 1px solid;
    }

    .btn-action svg {
        width: 13px;
        height: 13px;
    }

    .btn-editer {
        border-color: #f5d9a8;
        color: #d68f28 !important;
    }
    .btn-editer:hover {
        background: #fdf3e2;
        color: #b8791f !important;
    }

    .btn-supprimer {
        border-color: #f0b8b3;
        color: #d3453b !important;
    }
    .btn-supprimer:hover {
        background: #fdecea;
        color: #b23a32 !important;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
        margin-bottom: 16px;
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
        min-width: 200px;
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
                    <path d="M9 20l-5.447-2.724A1 1 0 0 1 3 16.382V5.618a1 1 0 0 1 1.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0 0 21 18.382V7.618a1 1 0 0 0-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
            </div>
            <div>
                <h3 class="box-title"><?php echo __('La liste des déplacements'); ?></h3>
                <div class="subtitle"><?php echo __('Consultez et gérez les notes de frais de déplacement'); ?></div>
            </div>
        </div>

        <?php echo $this->Html->link(
            '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . "Ajouter",
            array('action' => 'add'),
            array('class' => 'btn-add-modern', 'escape' => false)
        ); ?>

    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ville</th>
                    <th>destination</th>
                    <th>Nuit</th>
                    <th>urbain</th>
                    <th>interville</th>
                    <th>hotel</th>
                    <th>restaurant</th>
                    <th>divers</th>
                    <th>Date d'ajout</th>
                    <th class="actions">#</th>
                </tr>
            </thead>
            <?php foreach ($notefraissecteurs as $notefraissecteur): ?>
                <tr>
                    <td class="ville-cell"><?php echo h($notefraissecteur['Notefraissecteur']['ville']); ?>&nbsp;</td>
                    <td class="destination-cell"><?php echo h($notefraissecteur['Notefraissecteur']['destination']); ?>&nbsp;</td>
                    <td class="nuit-cell"><?php echo h($notefraissecteur['Notefraissecteur']['nuit']); ?>&nbsp;</td>
                    <td><?php echo h($notefraissecteur['Notefraissecteur']['urbain']); ?>&nbsp;Km</td>
                    <td><?php echo h($notefraissecteur['Notefraissecteur']['interville']); ?>&nbsp;Km</td>
                    <td><?php echo h($notefraissecteur['Notefraissecteur']['hotel']); ?>&nbsp;DH</td>
                    <td><?php echo h($notefraissecteur['Notefraissecteur']['restaurant']); ?>&nbsp;DH</td>
                    <td><?php echo h($notefraissecteur['Notefraissecteur']['divers']); ?>&nbsp;DH</td>
                    <td class="date-cell"><?php echo h($notefraissecteur['Notefraissecteur']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(
                            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"></path></svg>' . __('Editer'),
                            array('action' => 'edit', $notefraissecteur['Notefraissecteur']['id']),
                            array('class' => 'btn-action btn-editer', 'escape' => false)
                        ); ?>
                        <?php echo $this->Form->postLink(
                            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>' . __('Supprimer'),
                            array('action' => 'delete', $notefraissecteur['Notefraissecteur']['id']),
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
                
            ]
        });
    });
</script>
