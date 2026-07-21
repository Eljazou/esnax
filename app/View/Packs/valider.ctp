<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<style>
    :root{
        --accent:#6c5ce7;
        --accent-grad-start:#8f7cf6;
        --accent-soft:#F3F1FF;
        --accent-text:#6c5ce7;
        --text-dark:#1a1d36;
        --text-muted:#9a9aab;
        --border-soft:#F0EDFF;
    }

    @media (max-width:1282px){
        .box-body{
            overflow: scroll;
            overflow-y: auto;
			padding-bottom:60px;
        }
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
        gap:16px;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:linear-gradient(135deg, var(--accent-grad-start) 0%, var(--accent) 100%);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; color:#fff; }
    .page-header-text h3{ margin:0; color:var(--text-dark); font-weight:700; font-size:22px; }
    .page-header-text p{ margin:2px 0 0; color:var(--text-muted); font-size:13px; }
    .page-header-text .underline{
        display:inline-block; width:34px; height:3px;
        background:var(--accent); border-radius:3px; margin-top:6px;
    }

    /* ===== Table card ===== */
    .packs-card{
        background:#fff;
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    .packs-card .box-body{ padding:0; }

    table.packs-table{ margin-bottom:0; }
    table.packs-table thead th{
        background:var(--accent-soft);
        color:var(--accent-text);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:1px solid var(--border-soft) !important;
        border-top:none !important;
        padding:14px 18px;
    }
    table.packs-table tbody td{
        vertical-align:middle;
        padding:12px 18px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:13.5px;
    }
    table.packs-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
    table.packs-table tbody tr:hover{ background-color:var(--accent-soft) !important; }

    .client-link{ color:var(--accent-text); font-weight:600; text-decoration:none; }
    .client-link:hover{ color:var(--accent); text-decoration:underline; }

    .nombre-badge{
        display:inline-block;
        min-width:26px;
        text-align:center;
        padding:3px 10px;
        border-radius:20px;
        background:var(--accent-soft);
        color:var(--accent-text);
        font-size:12.5px;
        font-weight:700;
    }

    .detail-line{
        display:block;
        font-size:12.5px;
        color:var(--text-dark);
        padding:2px 0;
    }
    .detail-line .game-name{ font-weight:600; color:var(--accent-text); }

    .date-cell{ display:inline-flex; align-items:center; gap:6px; color:var(--text-muted); white-space:nowrap; }
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
        box-shadow:0 8px 24px rgba(26,29,54,0.08);
        padding:6px;
    }
    .dropdown-menu>li>a{
        border-radius:6px;
        color:var(--text-dark);
        font-size:13px;
        padding:8px 12px;
    }
    .dropdown-menu>li>a:hover{ background:var(--accent-soft); color:var(--accent-text); }

    /* ===== DataTables controls ===== */
    div.dataTables_wrapper{ padding:0 18px; }
    div.dataTables_wrapper div.dataTables_filter{ padding:16px 0; margin:0; }
    div.dataTables_wrapper div.dataTables_filter label{
        display:flex; align-items:center; gap:8px;
        color:var(--text-muted); font-size:13px; font-weight:600; margin:0;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:9px;
        padding:9px 14px 9px 36px;
        color:var(--text-dark);
        font-size:13px;
        width:230px;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239a9aab' stroke-width='2'><circle cx='11' cy='11' r='7'/><line x1='21' y1='21' x2='16.65' y2='16.65'/></svg>") no-repeat 12px center;
        background-size:14px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus{
        outline:none; border-color:var(--accent); box-shadow:0 0 0 3px var(--accent-soft);
    }
    div.dataTables_wrapper div.dataTables_paginate{ padding:14px 0; }
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
    <div class="page-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>
    </div>
    <div class="page-header-text">
        <h3><?php echo __('Validation des packs'); ?></h3>
        <p><?php echo __('Consultez et validez les packs en attente'); ?></p>
        <span class="underline"></span>
    </div>
</div>

<div class="packs-card">
    <div class="box-body" style="">
        <table id="example1" class="table table-bordered table-striped packs-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Responsable</th>
                    <th>Nombre</th>
                    <th>Detail</th>
                    <th>Date</th>
                    <th class="actions">#</th>
                </tr>
            </thead>
            <?php foreach ($packs as $pack): ?>
                <tr>
                    <td><?php echo $this->Html->link($pack['Client']['nom'] . ' ' . $pack['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $pack['Client']['id']), array('class' => 'client-link')); ?></td>
                    <td><?php echo h($pack['User']['name']); ?>&nbsp;</td>

                    <td><span class="nombre-badge"><?php echo h($pack['Pack']['nombre']); ?></span></td>
                    <td><?php foreach($pack["Packdetail"] as $v)
								echo "<span class='detail-line'><span class='game-name'>".$games[$v['game_id']]."</span> : ".$v["nombre"]."</span>"; ?>&nbsp;</td>
                   <td>
                        <span class="date-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <?php echo h($pack['Pack']['created']); ?>
                        </span>
                    </td>


                    <td class="actions">
                        <div class="btn-group dropdown">
                            <button type="button" class="actions-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="return toggleLegacyDropdown(this);">
														<svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.8"/><circle cx="12" cy="12" r="1.8"/><circle cx="12" cy="19" r="1.8"/></svg>
										  </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" style="display:none;">
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $pack['Pack']['id'])); ?></li>
                                <li><?php
									echo $this->Html->link(__('Valider'), array('action' => 'valider', $pack['Pack']['id'], 1));
                        ?></li>
                                <li><?php echo $this->Html->link(__('Archiver'), array('action' => 'archive', $pack['Pack']['id'], -1));
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
function toggleLegacyDropdown(button) {
    var $button = jQuery(button);
    var $menu = $button.next('.dropdown-menu');
    var isOpen = $button.attr('aria-expanded') === 'true';

    jQuery('.btn-group.dropdown .dropdown-toggle').not($button).attr('aria-expanded', 'false');
    jQuery('.btn-group.dropdown .dropdown-menu').not($menu).hide();

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
        if (!jQuery(e.target).closest('.btn-group.dropdown').length) {
            jQuery('.btn-group.dropdown .dropdown-menu').hide();
            jQuery('.btn-group.dropdown .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });

    $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "iDisplayLength": 50,
        "language": {
            "search": "",
            "searchPlaceholder": "Rechercher...",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            }
        }
    });
});
</script>
