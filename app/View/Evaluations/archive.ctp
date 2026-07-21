<?php echo $this->Html->css('dataTables.bootstrap');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ede9ff;
    }

    body, .box, table {
        font-family: 'Poppins', sans-serif;
    }

    .box {
        border-radius: 18px !important;
        border: none !important;
        box-shadow: 0 4px 16px rgba(108, 99, 245, 0.06) !important;
        background: #fff !important;
    }

    .box-header {
        border: none !important;
        padding: 22px 24px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .box-title {
        font-size: 15.5px;
        font-weight: 700;
        color: #2b2b45;
    }

    .box-body {
        padding: 8px 24px 24px;
    }

    /* "Archiver tout" pill button */
    .box-header a.btn {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 20px !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 7px 20px !important;
        box-shadow: 0 4px 12px rgba(108, 99, 245, .28);
        float: none !important;
        margin-top: 0 !important;
    }

    .box-header a.btn:hover {
        background: linear-gradient(135deg, #5f56ee, #3f66e6) !important;
        color: #fff !important;
    }

    /* Table */
    table.dataTable thead th,
    #example1 thead th {
        background: #f4f2ff;
        color: #5b52e0;
        font-weight: 700;
        font-size: 13px;
        border: none !important;
    }

    table.table-bordered td, table.table-bordered th {
        border-color: #eef0fa !important;
    }

    table.table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #fbfbff;
    }

    #example1 td a {
        color: var(--primary);
        font-weight: 500;
    }

    #example1 td a:hover {
        color: #5479f7;
        text-decoration: underline;
    }

    /* Action button (Désarchiver) */
    td.actions a.btn {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border: none !important;
        border-radius: 20px !important;
        padding: 6px 16px !important;
        font-weight: 600 !important;
        font-size: 12.5px !important;
        text-decoration: none !important;
    }

    td.actions a.btn:hover {
        background: var(--primary) !important;
        color: #fff !important;
    }

    /* ===== DataTables controls: length, search, info, pagination ===== */
    .dataTables_wrapper {
        padding-top: 4px;
    }

    .dataTables_length,
    .dataTables_filter,
    .dataTables_info {
        color: #6b6b85 !important;
        font-size: 13.5px;
    }

    .dataTables_length select {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 8px !important;
        padding: 4px 10px !important;
        font-size: 13.5px;
        color: #2b2b45;
        box-shadow: none !important;
        margin: 0 6px;
    }

    .dataTables_filter input {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 20px !important;
        padding: 7px 16px !important;
        font-size: 13.5px !important;
        margin-left: 8px !important;
        box-shadow: none !important;
    }

    .dataTables_filter input:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        border: 1.5px solid transparent !important;
        color: #6b6b85 !important;
        padding: 6px 12px !important;
        margin-left: 4px !important;
        background: transparent !important;
    }

    .dataTables_paginate .paginate_button:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: transparent !important;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button.current:hover {
        background: var(--primary) !important;
        color: #fff !important;
        border-color: var(--primary) !important;
    }

    .dataTables_paginate .paginate_button.disabled,
    .dataTables_paginate .paginate_button.disabled:hover {
        color: #c7c7d8 !important;
        background: transparent !important;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        color: #a9a4f0 !important;
        opacity: .6;
    }
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Evaluations'); ?></h3>
        <?php echo $this->Html->link('Archiver tout', array('action' => 'archivetous'), array('style' => "float:right;margin-top: -5px;", 'class' => "btn btn-primary bg-light-blue btn-sm")); ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>

                    <th>Employé</th>
                    <th>Evalué par</th>
                    <th>Note</th>
                    <th>Observations</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($evaluations as $evaluation): ?>
                <tr>
                    <td><?php echo $this->Html->link($evaluation['User']['name'], array('controller' => 'users', 'action' => 'view', $evaluation['User']['id'])); ?></td>
                    <td><?php echo $this->Html->link($evaluation['User1']['name'], array('controller' => 'users', 'action' => 'view', $evaluation['User1']['id'])); ?></td>

                    <td><?php echo h($evaluation['Evaluation']['note']); ?>&nbsp;</td>
                    <td><?php echo h($evaluation['Evaluation']['observation']); ?>&nbsp;</td>
                    <td><?php echo h($evaluation['Evaluation']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Désarchiver'), array('action' => 'archive', $evaluation['Evaluation']['id'], 1), array('class' => 'btn btn-primary btn-xs')); ?>
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
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
