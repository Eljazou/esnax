<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
    }

    body, .box, table, .dropdown-menu {
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
    }

    .box-title {
        font-size: 15.5px;
        font-weight: 700;
        color: #2b2b45;
    }

    .box-body {
        padding: 8px 24px 24px;
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
        min-width: 140px;
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

    /* If none of the permission checks pass, the dropdown would render with an
       empty menu — keep it visually tidy rather than showing a blank white box */
    td.actions .dropdown-menu:empty {
        display: none;
    }

    /* ===== DataTables controls: length, search, sorting icons ===== */
    div.dataTables_length label,
    div.dataTables_filter label,
    div.dataTables_info {
        color: #6b6b85 !important;
        font-size: 13.5px;
        font-weight: 500;
    }

    div.dataTables_length select {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 10px !important;
        padding: 6px 10px !important;
        font-size: 13.5px;
        color: #2b2b45;
        box-shadow: none !important;
    }

    div.dataTables_filter input {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 20px !important;
        padding: 8px 16px 8px 34px !important;
        font-size: 13.5px !important;
        box-shadow: none !important;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%239a94c9' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><circle cx='11' cy='11' r='8'/><path d='m21 21-4.3-4.3'/></svg>");
        background-repeat: no-repeat;
        background-position: 12px center;
    }

    div.dataTables_filter input:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    table.dataTable thead th {
        background: #faf9ff;
        color: #8b85c9 !important;
        font-weight: 700 !important;
        font-size: 12px;
        letter-spacing: .3px;
        text-transform: uppercase;
        border: none !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        color: #a9a4f0 !important;
        opacity: .7;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 10px !important;
        border: 1.5px solid #eeecfb !important;
        color: #6b6b85 !important;
        padding: 7px 13px !important;
        margin-left: 6px !important;
        background: #fff !important;
        font-weight: 500;
    }

    .dataTables_paginate .paginate_button:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: var(--primary-light) !important;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button.current:hover {
        background: var(--primary) !important;
        color: #fff !important;
        border-color: var(--primary) !important;
        box-shadow: 0 4px 10px rgba(108, 99, 245, .35);
    }
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('La liste des offres archivées'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>N° de produit</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($offres as $offre): ?>
                <tr>
                    <td><?php echo h($offre['Offre']['titre']); ?>&nbsp;</td>
                    <td><?php echo h($offre['Offre']['description']); ?>&nbsp;</td>
                    <td><?php echo count($offre['Offrespicial']); ?>&nbsp;</td>
                    <td><?php echo h($offre['Offre']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <li><?php
                                    if ($this->requestAction('/droits/getrole/offres/view') == 1)
                                        echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['id'])); ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/offres/edit') == 1)
                                        echo $this->Html->link(__('Editer'), array('action' => 'edit', $offre['Offre']['id'])); ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/offres/archive') == 1)
                                        echo $this->Html->link(__('Désarchiver'), array('action' => 'archive', $offre['Offre']['id'], 1));
                                    ?></li>
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
