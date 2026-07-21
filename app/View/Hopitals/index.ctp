<?php echo $this->Html->css('dataTables.bootstrap'); ?>
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
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .box-header .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #eee9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .box-header .icon-circle svg {
        width: 19px;
        height: 19px;
        stroke: #6b46e5;
    }

    .box-header h3.box-title {
        color: #1e1e2e;
        font-size: 17px;
        font-weight: 700;
        margin: 0;
    }

    .box-header .subtitle {
        color: #8b87a5;
        font-size: 12.5px;
        margin-top: 2px;
        font-weight: 400;
    }

    .btn-add-modern {
        background: linear-gradient(135deg, #7b5ce8 0%, #9b6ef0 100%);
        border: none;
        color: #fff !important;
        border-radius: 9px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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
        width: 14px;
        height: 14px;
        stroke: #fff;
    }

    .box-body {
        padding: 4px 20px 20px;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table.table thead th {
        background: #f2eefd;
        color: #6b5ecb;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border: none !important;
        padding: 10px 14px;
        white-space: nowrap;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 8px 14px;
        font-size: 13px;
        color: #3a3a4a;
        vertical-align: middle;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    table.table tbody td:first-child {
        color: #9a95b5;
        font-weight: 600;
    }

    .hopital-name {
        font-weight: 600;
        font-size: 13px;
        color: #2c2c3a;
    }

    .client-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        height: 24px;
        padding: 0 5px;
        border-radius: 50%;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
    }

    .client-badge.has-clients {
        background: #3e8fd6;
    }

    .client-badge.no-clients {
        background: #b7b3c9;
    }

    td.actions-cell {
        white-space: nowrap;
    }

    .actions-row {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-icon-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 7px;
        border: none;
        text-decoration: none !important;
        flex-shrink: 0;
        line-height: 0;
    }

    .btn-icon-action svg {
        width: 12px;
        height: 12px;
        stroke: #fff;
    }

    .btn-icon-edit {
        background: #f0a53c;
    }
    .btn-icon-edit:hover {
        background: #d68f28;
    }

    .btn-icon-delete {
        background: #e35a4e;
    }
    .btn-icon-delete:hover {
        background: #c8473c;
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

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        border: 1px solid #e6e2fa !important;
        color: #6b46e5 !important;
        background: #fff !important;
        margin-left: 6px;
        padding: 6px 12px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #6b46e5 !important;
        border-color: #6b46e5 !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
        background: #f2eefd !important;
        color: #4a2fc9 !important;
    }
</style>

<div class="box box-primary">
    <div class="box-header with-border">
        <div class="title-wrap">
            <div class="icon-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16"></path>
                    <path d="M2 21h20"></path>
                    <path d="M12 7v6"></path>
                    <path d="M9 10h6"></path>
                    <path d="M9 21v-4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4"></path>
                </svg>
            </div>
            <div>
                <h3 class="box-title">Gestion des hôpitaux</h3>
                <div class="subtitle">Consultez et gérez les hôpitaux enregistrés</div>
            </div>
        </div>
        <div class="box-tools pull-right">
            <?php echo $this->Html->link(
                '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Ajouter',
                array('action' => 'add'),
                array('class' => 'btn-add-modern', 'escape' => false)
            ); ?>
        </div>
    </div>
    <div class="box-body">
        <?php echo $this->Session->flash(); ?>
        <table id="tbl_hopitals" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de l'hôpital</th>
                    <th class="text-center" style="width:90px;">Clients</th>
                    <th class="text-center no-sort" style="width:100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hopitals as $hopital): ?>
                    <?php $nb = isset($counts[$hopital['Hopital']['id']]) ? $counts[$hopital['Hopital']['id']] : 0; ?>
                    <tr>
                        <td><?php echo h($hopital['Hopital']['id']); ?></td>
                        <td class="hopital-name"><?php echo h($hopital['Hopital']['name']); ?></td>
                        <td class="text-center">
                            <span class="client-badge <?php echo $nb > 0 ? 'has-clients' : 'no-clients'; ?>">
                                <?php echo $nb; ?>
                            </span>
                        </td>
                        <td class="text-center actions-cell">
                            <span class="actions-row">
                            <?php echo $this->Html->link(
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"></path></svg>',
                                array('action' => 'edit', $hopital['Hopital']['id']),
                                array('class' => 'btn-icon-action btn-icon-edit', 'escape' => false, 'title' => 'Modifier')
                            ); ?>
                            <?php echo $this->Form->postLink(
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>',
                                array('action' => 'delete', $hopital['Hopital']['id']),
                                array('class' => 'btn-icon-action btn-icon-delete', 'escape' => false, 'title' => 'Supprimer', 'confirm' => 'Supprimer cet hôpital ?')
                            ); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tbl_hopitals').DataTable({
        'order': [[1, 'asc']],
        'columnDefs': [{ 'orderable': false, 'targets': 'no-sort' }],
        'language': { 'url': '//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json' }
    });
});
</script>
