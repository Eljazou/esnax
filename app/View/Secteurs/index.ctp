<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style>
    :root{
        --purple-primary:#7C3AED;
        --purple-dark:#5B21B6;
        --purple-light:#EDE9FE;
        --purple-bg:#F5F3FF;
        --text-dark:#1F1147;
        --text-muted:#8A83A3;
        --border-soft:#EEEAFB;
        --blue-primary:#3B82F6;
        --blue-light:#EFF6FF;
        --amber-primary:#F59E0B;
        --amber-light:#FFF7E6;
        --green-primary:#16A34A;
    }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        overflow:hidden;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:18px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
        box-shadow:0 4px 18px rgba(109,40,217,0.06);
    }
    .page-header-left{ display:flex; align-items:center; gap:16px; }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:50%;
        background:linear-gradient(135deg,#8B5CF6 0%,#6D28D9 100%);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:22px;height:22px; }
    .page-header-text h3{
        margin:0;
        color:var(--text-dark);
        font-weight:700;
        font-size:22px;
    }
    .page-header-text p{
        margin:2px 0 0;
        color:var(--text-muted);
        font-size:13px;
    }
    .page-header-text .underline{
        display:inline-block;
        width:34px;height:3px;
        background:var(--purple-primary);
        border-radius:3px;
        margin-top:6px;
    }
    .page-header-actions{ display:flex; gap:10px; flex-wrap:wrap; }
    .page-header-actions .btn{
        border-radius:10px;
        font-size:13px;
        font-weight:600;
        padding:9px 18px;
        border:none;
    }
    .btn-purple-solid{ background:var(--purple-primary); color:#fff; }
    .btn-purple-solid:hover{ background:var(--purple-dark); color:#fff; }
    .btn-blue-solid{ background:var(--blue-primary); color:#fff; }
    .btn-blue-solid:hover{ background:#2563EB; color:#fff; }
    .btn-amber-solid{ background:var(--amber-primary); color:#fff; }
    .btn-amber-solid:hover{ background:#D97706; color:#fff; }

    /* ===== Table card ===== */
    .box.box-primary{
        border:none;
        border-radius:18px;
        box-shadow:0 4px 18px rgba(109,40,217,0.08);
        background:#fff;
    }
    .box.box-primary .box-header{ display:none; }
    .box-body{ padding:20px 24px 8px; }

    /* Toolbar row (export buttons + search) */
    .dt-buttons{ margin-bottom: 16px; display:flex; gap:10px; flex-wrap:wrap; }
    .dt-button{
        display:inline-flex; align-items:center; gap:6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight:600;
        background:#fff;
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        cursor: pointer;
        color: var(--text-dark);
    }
    .dt-button svg{ width:15px; height:15px; }
    .dt-button.buttons-excel{ color:var(--green-primary); border-color:#D6F0DF; }
    .dt-button.buttons-excel:hover{ background:#F0FBF3; }
    .dt-button.buttons-csv{ color:var(--text-muted); }
    .dt-button.buttons-csv:hover{ background:var(--purple-bg); }
    .dt-button.buttons-print{ color:var(--purple-primary); border-color:var(--purple-light); }
    .dt-button.buttons-print:hover{ background:var(--purple-bg); }

    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:10px;
        padding:8px 12px 8px 32px;
        color:var(--text-dark);
        width:220px;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238A83A3' stroke-width='2'><circle cx='11' cy='11' r='7'/><line x1='21' y1='21' x2='16.65' y2='16.65'/></svg>") no-repeat 10px center;
        background-size:14px;
    }
    div.dataTables_wrapper div.dataTables_filter label{ color:var(--text-muted); font-size:0; }
    div.dataTables_wrapper div.dataTables_info{ color:var(--text-muted); font-size:13px; }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button{
        border-radius:8px !important;
        margin:0 2px;
        border:1px solid var(--border-soft) !important;
        color:var(--text-dark) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current{
        background:var(--purple-primary) !important;
        border-color:var(--purple-primary) !important;
        color:#fff !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover{
        background:var(--purple-light) !important;
        color:var(--purple-dark) !important;
    }

    /* Table look */
    table.dataTable{ border-collapse:separate !important; border-spacing:0; }
    table.dataTable thead th{
        background:var(--purple-bg);
        color:var(--text-muted);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:2px solid var(--border-soft) !important;
        border-top:none !important;
        padding:12px 14px;
        cursor:pointer;
    }
    table.dataTable thead th.no-sort{ cursor:default; }
    table.dataTable tbody td{
        vertical-align:middle;
        padding:14px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:13px;
    }
    table.dataTable.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
    table.dataTable tbody tr:hover{ background-color:var(--purple-bg) !important; }

    /* Region pill (with icon) */
    .region-pill{
        display:inline-flex; align-items:center; gap:6px;
        padding:4px 10px;
        border-radius:8px;
        background:var(--purple-light);
        color:var(--purple-dark);
        font-weight:600;
        font-size:12px;
    }
    .region-pill svg{ width:13px;height:13px; }

    /* Ville cell with icon */
    .icon-cell{ display:inline-flex; align-items:center; gap:6px; color:var(--text-dark); }
    .icon-cell svg{ width:14px;height:14px; color:var(--purple-primary); flex:0 0 auto; }

    /* Secteur badge */
    .secteur-badge{
        display:inline-block;
        padding:3px 12px;
        border-radius:20px;
        background:var(--purple-bg);
        color:var(--purple-dark);
        font-size:12px;
        font-weight:700;
    }

    /* Clients pill */
    .clients-pill{
        display:inline-block;
        min-width:34px;
        text-align:center;
        padding:4px 10px;
        border-radius:20px;
        color:#fff;
        font-size:12px;
        font-weight:700;
    }

    /* Actions dropdown */
    .actions-toggle{
        width:32px;height:32px;
        border-radius:8px;
        border:1px solid var(--border-soft);
        background:#fff;
        display:inline-flex;align-items:center;justify-content:center;
        cursor:pointer;
    }
    .actions-toggle:hover{ background:var(--purple-bg); }
    .actions-toggle svg{ width:16px;height:16px; color:var(--text-muted); }
    .dropdown-menu{
        border-radius:10px;
        border:1px solid var(--border-soft);
        box-shadow:0 8px 24px rgba(109,40,217,0.12);
        padding:6px;
        z-index:1050;
    }
    .dropdown-menu>li>a{
        border-radius:6px;
        color:var(--text-dark);
        font-size:13px;
        padding:8px 12px;
    }
    .dropdown-menu>li>a:hover{ background:var(--purple-bg); color:var(--purple-dark); }
</style>

<div class="page-header-card">
    <div class="page-header-left">
        <div class="page-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
        </div>
        <div class="page-header-text">
            <h3><?php echo __('Secteurs'); ?></h3>
            <p><?php echo __('Gérez la liste des secteurs'); ?></p>
            <span class="underline"></span>
        </div>
    </div>
    <div class="page-header-actions">
        <?php
        if ($this->requestAction('/droits/getrole/secteurs/add') == 1)
            echo $this->Html->link('<i class="fa fa-plus"></i> Ajouter', array('action' => 'add'), array('class' => 'btn btn-purple-solid', 'escape' => false));
        if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == "Responsable promotion")
            echo $this->Html->link('<i class="fa fa-globe"></i> Afficher le Maroc', array('action' => 'view', "A", "all"), array('class' => 'btn btn-blue-solid', 'escape' => false));
        if ($this->requestAction('/droits/getrole/secteurs/archive') == 1)
            echo $this->Html->link('<i class="fa fa-archive"></i> Archives', array('action' => 'archive'), array('class' => 'btn btn-amber-solid', 'escape' => false));
        ?>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-map-marker"></i> <?php echo __('Secteurs'); ?></h3>
    </div>
    <div class="box-body">
        <table id="tbl_secteurs" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Région</th>
                    <th>Ville</th>
                    <th>IMS région</th>
                    <th>Secteur</th>
                    <th>Ville secteur</th>
                    <th>IMS Secteur</th>
                    <th class="text-center" style="width:70px;">Clients</th>
                    <th class="text-center no-sort" style="width:60px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($secteurs as $secteur): ?>
                <?php
                $sid = $secteur['Secteur']['id'];
                $nb  = isset($clientCounts[$sid]) ? $clientCounts[$sid] : 0;
                ?>
                <tr>
                    <td><?php echo h($secteur['Secteur']['id']); ?></td>
                    <td>
                        <span class="region-pill">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-6h6v6"/></svg>
                            <?php echo h($secteur['Secteur']['region']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="icon-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo h($secteur['Secteur']['ville']); ?>
                        </span>
                    </td>
                    <td><?php echo h($secteur['Secteur']['ville_ims']); ?></td>
                    <td><span class="secteur-badge"><?php echo h($secteur['Secteur']['secteur']); ?></span></td>
                    <td>
                        <span class="icon-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-6h6v6"/></svg>
                            <?php echo h($secteur['Secteur']['ville']); ?> <?php echo h($secteur['Secteur']['secteur']); ?>
                        </span>
                    </td>
                    <td><?php echo h($secteur['Secteur']['secteur_ims']); ?></td>
                    <td class="text-center" data-order="<?php echo $nb; ?>">
                        <span class="clients-pill" style="background:<?php echo $nb > 0 ? '#7C3AED' : '#B9B4CC'; ?>">
                            <?php echo $nb; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="actions-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="return toggleLegacyDropdown(this);">
                                <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.8"/><circle cx="12" cy="12" r="1.8"/><circle cx="12" cy="19" r="1.8"/></svg>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <?php if ($this->requestAction('/droits/getrole/secteurs/view') == 1): ?>
                                    <li><?php echo $this->Html->link('<i class="fa fa-eye fa-fw"></i> Voir', array('action' => 'view', $secteur['Secteur']['id']), array('escape' => false)); ?></li>
                                <?php endif; ?>
                                <?php if ($this->requestAction('/droits/getrole/secteurs/edit') == 1): ?>
                                    <li><?php echo $this->Html->link('<i class="fa fa-pencil fa-fw"></i> Éditer', array('action' => 'edit', $secteur['Secteur']['id']), array('escape' => false)); ?></li>
                                <?php endif; ?>
                                <?php if ($this->requestAction('/droits/getrole/secteurs/delete') == 1): ?>
                                    <li class="divider"></li>
                                    <li><?php echo $this->Form->postLink('<i class="fa fa-trash fa-fw"></i> Supprimer', array('action' => 'delete', $secteur['Secteur']['id']), array('escape' => false), 'Êtes-vous sûr ?'); ?></li>
                                <?php endif; ?>
                                <?php if ($this->requestAction('/droits/getrole/secteurs/archive') == 1): ?>
                                    <li><?php echo $this->Html->link('<i class="fa fa-archive fa-fw"></i> Archiver', array('action' => 'archive', $secteur['Secteur']['id'], 0), array('escape' => false)); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $this->Html->script('jquery-2.2.3.min'); ?>
<?php echo $this->Html->script('jquery.dataTables.min'); ?>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

<script>
function toggleLegacyDropdown(button) {
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
    $('#tbl_secteurs').DataTable({
        "paging":      true,
        "pageLength":  10,
        "searching":   true,
        "ordering":    true,
        "info":        true,
        "autoWidth":   false,
        "order":       [[0, 'asc']],
        "columnDefs":  [{ "orderable": false, "targets": "no-sort" }],
        "language": {
            "search":         "",
            "searchPlaceholder": "Rechercher...",
            "lengthMenu":     "Afficher _MENU_ lignes",
            "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty":      "Aucun secteur",
            "infoFiltered":   "(filtré sur _MAX_ total)",
            "zeroRecords":    "Aucun secteur trouvé",
            "paginate": {
                "first":    "«",
                "last":     "»",
                "next":     "›",
                "previous": "‹"
            }
        },
        dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend:    'excel',
                text:      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 8l8 8M16 8l-8 8"/></svg> Excel',
                title:     'Secteurs',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
            },
            {
                extend:    'csv',
                text:      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg> CSV',
                title:     'Secteurs',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
            },
            {
                extend:    'print',
                text:      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg> Imprimer',
                title:     'Liste des Secteurs',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
            }
        ]
    });
});
</script>
