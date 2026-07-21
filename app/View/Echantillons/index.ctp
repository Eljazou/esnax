<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<style>
    :root{
        --accent:#7C6FF0;
        --accent-soft:#F2F0FF;
        --accent-soft-hover:#E6E1FF;
        --accent-text:#6B5BE8;
        --text-dark:#2B2740;
        --text-muted:#8C88A6;
        --border-soft:#E7E4F7;
        --page-bg:#F8F7FD;
    }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:18px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
        border:1px solid var(--border-soft);
    }
    .page-header-left{ display:flex; align-items:center; gap:16px; }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:var(--accent-soft);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; color:var(--accent-text); }
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
        background:var(--accent);
        border-radius:3px;
        margin-top:6px;
    }
    .page-header-card .btn-add{
        background:var(--accent);
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:600;
        font-size:13px;
        padding:10px 20px;
    }
    .page-header-card .btn-add:hover{ background:var(--accent-text); color:#fff; }

    /* ===== Table card ===== */
    .echantillons-card{
        background:#fff;
        border-radius:18px;
        border:1px solid var(--border-soft);
        overflow:hidden;
    }
    .echantillons-card .box-body{ padding:0; }

    table.ech-table{ margin-bottom:0; }
    table.ech-table thead th{
        background:var(--accent-soft);
        color:var(--accent-text);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:1px solid var(--border-soft) !important;
        border-top:none !important;
        padding:14px 20px;
    }
    table.ech-table tbody td{
        vertical-align:middle;
        padding:12px 20px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:14px;
    }
    table.ech-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFD; }
    table.ech-table tbody tr:hover{ background-color:var(--accent-soft) !important; }

    .ech-cell{ display:flex; align-items:center; gap:12px; }
    .ech-icon{
        flex:0 0 auto;
        width:32px;height:32px;
        border-radius:9px;
        background:var(--accent-soft);
        display:flex;align-items:center;justify-content:center;
    }
    .ech-icon svg{ width:15px;height:15px; color:var(--accent-text); }

    .game-badge{
        display:inline-block;
        padding:3px 12px;
        border-radius:20px;
        background:var(--accent-soft);
        color:var(--accent-text);
        font-size:12px;
        font-weight:700;
    }

    .date-cell{ display:inline-flex; align-items:center; gap:6px; color:var(--text-muted); }
    .date-cell svg{ width:13px;height:13px; flex:0 0 auto; color:var(--accent-text); }

    .actions-toggle{
        width:34px;height:34px;
        border-radius:9px;
        border:1px solid var(--border-soft);
        background:#fff;
        display:inline-flex;align-items:center;justify-content:center;
        cursor:pointer;
    }
    .actions-toggle:hover{ background:var(--accent-soft); }
    .actions-toggle svg{ width:15px;height:15px; color:var(--text-muted); }
    .dropdown-menu{
        border-radius:10px;
        border:1px solid var(--border-soft);
        box-shadow:0 8px 24px rgba(46,42,61,0.08);
        padding:6px;
    }
    .dropdown-menu>li>a{
        border-radius:6px;
        color:var(--text-dark);
        font-size:13px;
        padding:8px 12px;
    }
    .dropdown-menu>li>a:hover{ background:var(--accent-soft); color:var(--accent-text); }

    /* ===== DataTables controls (Afficher / Rechercher / pagination) ===== */
    div.dataTables_wrapper{ padding:0 20px; }
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter{
        padding:16px 0;
        margin:0;
    }
    div.dataTables_wrapper div.dataTables_length label,
    div.dataTables_wrapper div.dataTables_filter label{
        display:flex;
        align-items:center;
        gap:8px;
        color:var(--text-muted);
        font-size:13px;
        font-weight:600;
        margin:0;
    }
    div.dataTables_wrapper div.dataTables_length select{
        border:1px solid var(--border-soft);
        border-radius:8px;
        padding:6px 28px 6px 10px;
        color:var(--text-dark);
        font-size:13px;
        font-weight:600;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23918C9E' stroke-width='2'><polyline points='6 9 12 15 18 9'/></svg>") no-repeat right 8px center;
        background-size:12px;
        appearance:none;
        -webkit-appearance:none;
    }
    div.dataTables_wrapper div.dataTables_length select:focus{ outline:none; border-color:var(--accent); }
    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:9px;
        padding:9px 14px 9px 36px;
        color:var(--text-dark);
        font-size:13px;
        width:230px;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23918C9E' stroke-width='2'><circle cx='11' cy='11' r='7'/><line x1='21' y1='21' x2='16.65' y2='16.65'/></svg>") no-repeat 12px center;
        background-size:14px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus{
        outline:none;
        border-color:var(--accent);
        box-shadow:0 0 0 3px var(--accent-soft);
    }
    div.dataTables_wrapper div.dataTables_filter input::placeholder{ color:var(--text-muted); }

    div.dataTables_wrapper div.dataTables_info{
        padding:18px 0;
        color:var(--text-muted);
        font-size:13px;
    }
    div.dataTables_wrapper div.dataTables_paginate{
        padding:14px 0;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button{
        border-radius:8px !important;
        margin:0 3px;
        padding:7px 13px !important;
        border:1px solid var(--border-soft) !important;
        background:#fff !important;
        color:var(--text-dark) !important;
        font-size:13px;
        font-weight:600;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover{
        background:var(--accent) !important;
        border-color:var(--accent) !important;
        color:#fff !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover{
        background:var(--accent-soft) !important;
        border-color:var(--accent-soft) !important;
        color:var(--accent-text) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled:hover{
        background:#fff !important;
        border-color:var(--border-soft) !important;
        color:var(--text-muted) !important;
        opacity:.6;
    }
</style>

<div class="page-header-card">
    <div class="page-header-left">
        <div class="page-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h6v4l4 9a2 2 0 0 1-2 3H7a2 2 0 0 1-2-3l4-9z"/><path d="M7 14h10"/></svg>
        </div>
        <div class="page-header-text">
            <h3><?php echo __('Echantillons'); ?></h3>
            <p><?php echo __('Consultez et gérez les échantillons disponibles'); ?></p>
            <span class="underline"></span>
        </div>
    </div>
    <?php echo $this->Html->link('<i class="fa fa-plus"></i> Ajouter un échantillon', array('action' => 'add'), array('class' => "btn btn-add", 'escape' => false)); ?>
</div>

<div class="echantillons-card">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped ech-table">
            <thead>
                <tr>
                    <th>Nom de l'échantillon</th>
                    <th>Game</th>
                    <th>Date d'ajout</th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <?php foreach ($echantillons as $echantillon): ?>
                <tr>
                    <td>
                        <div class="ech-cell">
                            <span class="ech-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 2h6v4l4 9a2 2 0 0 1-2 3H7a2 2 0 0 1-2-3l4-9z"/><path d="M7 14h10"/></svg>
                            </span>
                            <?php echo h($echantillon['Echantillon']['name']); ?>
                        </div>
                    </td>
                    <td><span class="game-badge"><?php echo h($echantillon['Game']['name']); ?></span></td>
                    <td>
                        <span class="date-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <?php echo h($echantillon['Echantillon']['created']); ?>
                        </span>
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="actions-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="return toggleLegacyDropdown(this);">
                                <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.8"/><circle cx="12" cy="12" r="1.8"/><circle cx="12" cy="19" r="1.8"/></svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" style="display:none;">
                                <li><?php echo $this->Html->link(__('Voir'), array('action' => 'view', $echantillon['Echantillon']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $echantillon['Echantillon']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Archiver'), array('action' => 'archive', $echantillon['Echantillon']['id'], 0)); ?></li>
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
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
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
    $("#example1").DataTable({
        "language": {
            "lengthMenu": "Afficher _MENU_ entrées",
            "zeroRecords": "Aucun résultat trouvé",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Aucune entrée disponible",
            "infoFiltered": "(filtré depuis _MAX_ entrées au total)",
            "search": "Rechercher\u00a0:",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        }
    });
});
</script>
