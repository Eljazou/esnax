<?php

echo $this->Html->css('dataTables.bootstrap');
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

    .ref-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 30px;
        padding: 0 8px;
        border-radius: 10px;
        background: #eee9fd;
        color: #5a3fd6;
        font-weight: 700;
        font-size: 13px;
    }

    .produit-name {
        font-weight: 600;
        color: #2c2c3a;
    }

    .date-cell {
        color: #8b87a5;
        white-space: nowrap;
    }

    td.actions {
        white-space: nowrap;
    }

    .btn-action {
        background: #fff;
        border: 1px solid #d9cffb;
        color: #6b46e5 !important;
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
    }

    .btn-action:hover {
        background: #f2eefd;
        color: #4a2fc9 !important;
    }

    .btn-action svg {
        width: 14px;
        height: 14px;
    }

    /* DataTables search + pagination restyle */
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

    .dataTables_wrapper .dataTables_info {
        color: #8b87a5;
        font-size: 13px;
        padding-top: 18px;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px;
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

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #c9c4e0 !important;
        background: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
        background: #f2eefd !important;
        color: #4a2fc9 !important;
    }
</style>
<div class="box">
    <div class="box-header">
        <div class="title-wrap">
            <div class="icon-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </div>
            <div>
                <h3 class="box-title"><?php echo __('La listes des produits lié au grossistes'); ?></h3>
                <div class="subtitle"><?php echo __('Gérez et consultez les produits liés aux grossistes'); ?></div>
            </div>
        </div>
        <?php if ($this->requestAction('/droits/getrole/groproduits/add') == 1):
                echo $this->Html->link(
                    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . __('Ajouter'),
                    array('action' => 'add'),
                    array('class' => "btn-add-modern", 'escape' => false)
                );
            endif; ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Réf</th>
                    <th>Nom</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
	<?php foreach ($groproduits as $groproduit): ?>
            <tr>
                <td><span class="ref-badge"><?php echo h($groproduit['Groproduit']['id']); ?></span>&nbsp;</td>
                <td class="produit-name"><?php echo h($groproduit['Groproduit']['name']); ?>&nbsp;</td>
                <td class="date-cell"><?php echo h($groproduit['Groproduit']['created']); ?>&nbsp;</td>
                <td class="actions">
			<?php echo $this->Html->link(
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' . __('Voir'),
                array('action' => 'view', $groproduit['Groproduit']['id']),
                array("class"=>"btn-action", 'escape' => false)
            ); ?>
			<?php echo $this->Html->link(
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"></path></svg>' . __('Éditer'),
                array('action' => 'edit', $groproduit['Groproduit']['id']),
                array("class"=>"btn-action", 'escape' => false)
            ); ?>
                    <?php echo $this->Html->link(
                        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="5" rx="1"></rect><path d="M4 8v11a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V8"></path><line x1="10" y1="12" x2="14" y2="12"></line></svg>' . __('Archivé'),
                        array('action' => 'archive', $groproduit['Groproduit']['id'],0),
                        array("class"=>"btn-action", 'escape' => false)
                    ); ?>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
	<?php echo $this->Html->script('jquery-2.2.3.min');
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
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}
        });
    });
</script>
