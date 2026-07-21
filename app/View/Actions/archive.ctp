<?php echo $this->Html->css('dataTables.bootstrap');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ede9ff;
    }

    body, .box, table, .dropdown-menu {
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width:572px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
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

    #example1 a {
        color: var(--primary);
        font-weight: 500;
    }

    #example1 a:hover {
        color: #5479f7;
        text-decoration: underline;
    }

    /* Actions dropdown */
    td.actions .btn-group .btn {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border: none !important;
        border-radius: 20px !important;
        padding: 6px 16px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
    }

    td.actions .btn-group .btn:hover,
    td.actions .btn-group .btn:focus {
        background: var(--primary) !important;
        color: #fff !important;
    }

    td.actions .dropdown-menu {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 8px 24px rgba(108, 99, 245, .18) !important;
        padding: 6px !important;
        overflow: hidden;
    }

    td.actions .dropdown-menu li a {
        border-radius: 8px !important;
        padding: 8px 14px !important;
        font-size: 13.5px !important;
        color: #2b2b45 !important;
    }

    td.actions .dropdown-menu li a:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
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
        <h3 class="box-title"><?php echo __('Archive des actions'); ?></h3>
        <?php echo $this->Html->link('Archiver tout', array('action' => 'archivetous'), array('style' => "float:right;margin-top: -5px;", 'class' => "btn btn-primary bg-light-blue btn-sm")); ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Game</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($actions as $action): ?>
                <tr>
                    <td><?php echo $this->Html->link($action['Client']['nom'] . ' ' . $action['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $action['Client']['id'])); ?></td>
                    <td><?php echo h($action['Game']['name']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['date_debut']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['date_fin']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <?php echo '<li>' . $this->Html->link(__('Editer'), array('action' => 'edit', $action['Action']['id'])) . '</li>';
                                echo '<li>' . $this->Html->link(__('Désarchiver'), array('action' => 'archive', $action['Action']['id'], 0)) . '</li>';
                                ?>
                            </ul>
                        </div>
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
function toggleLegacyDropdown(button, event) {
    if (event) { event.stopPropagation(); }
    var $button = jQuery(button);
    var $menu = $button.next('.dropdown-menu');
    var isOpen = $button.attr('aria-expanded') === 'true';

    jQuery('.btn-group .dropdown-toggle').not($button).attr('aria-expanded', 'false');
    jQuery('.btn-group .dropdown-menu').not($menu).hide();

    if (isOpen) {
        $button.attr('aria-expanded', 'false');
        $menu.hide();
    } else {
        $button.attr('aria-expanded', 'true');
        $menu.show();
    }

    return false;
}

jQuery(function () {
    jQuery(document).on('click', function (e) {
        if (!jQuery(e.target).closest('.btn-group').length) {
            jQuery('.btn-group .dropdown-menu').hide();
            jQuery('.btn-group .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
});

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
