<?php echo $this->Html->css('dataTables.bootstrap');
?>
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
        border-radius: 22px !important;
        border: none !important;
        box-shadow: 0 4px 20px rgba(108, 99, 245, 0.08) !important;
        background: #fff !important;
        overflow: hidden;
    }

    /* ===== Hero header ===== */
    .box-header {
        border: none !important;
        position: relative;
        overflow: hidden;
        padding: 30px 34px;
        background: linear-gradient(120deg, #ffffff 0%, #ffffff 55%, #ece7fd 100%);
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }

    .hero-icon {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 16px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        z-index: 2;
    }

    .hero-text { z-index: 2; }

    .box-title.hero-title {
        font-size: 22px;
        font-weight: 700;
        color: #171730;
        margin: 4px 0 4px;
        display: block;
    }

    .hero-subtitle {
        font-size: 13.5px;
        color: #8d8da8;
        font-weight: 500;
    }

    .hero-illustration {
        position: absolute;
        top: 0;
        right: 0;
        opacity: .9;
        z-index: 1;
        pointer-events: none;
    }

    /* ===== Body / controls ===== */
    .box-body { padding: 24px 30px 30px; }

    .dataTables_length,
    .dataTables_filter,
    .dataTables_info {
        color: #6b6b85 !important;
        font-size: 13.5px;
        font-weight: 500;
    }

    .dataTables_length select {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 10px !important;
        padding: 6px 12px !important;
        font-size: 13.5px;
        color: #2b2b45;
        box-shadow: none !important;
        margin: 0 6px;
    }

    .dataTables_filter label { margin: 0; }

    .dataTables_filter input {
        border: 1.5px solid #eeecfb !important;
        border-radius: 14px !important;
        padding: 11px 18px 11px 40px !important;
        font-size: 14px !important;
        margin-left: 0 !important;
        box-shadow: 0 2px 8px rgba(108, 99, 245, .05) !important;
        min-width: 260px;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a94c9' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><circle cx='11' cy='11' r='8'/><path d='m21 21-4.3-4.3'/></svg>");
        background-repeat: no-repeat;
        background-position: 14px center;
    }

    .dataTables_filter input:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    .dataTables_filter input::placeholder { color: #b3aede; }

    /* Table */
    table.dataTable thead th,
    #example1 thead th {
        background: #f7f5ff;
        color: #171730;
        font-weight: 700;
        font-size: 13.5px;
        border: none !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
        white-space: nowrap;
    }

    .th-icon {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        vertical-align: middle;
    }

    .th-icon svg { color: var(--primary); flex-shrink: 0; }

    table.table-bordered td, table.table-bordered th {
        border-color: #f1effa !important;
    }

    table.table-striped > tbody > tr { background-color: #fff; }
    table.table-striped > tbody > tr:hover { background-color: #fbfaff; }

    #example1 td { vertical-align: middle !important; padding: 14px 14px !important; }

    /* Code badge */
    .badge-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 700;
    }

    /* Produit */
    .produit-cell { font-weight: 500; font-size: 13.5px; color: #2b2b45; }

    /* Game */
    .game-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        background: #eef0fa;
        color: #b3aede;
    }

    .cell-dash { color: #c7c1e0; font-size: 14px; }

    /* Prix */
    .prix-cell { font-weight: 600; font-size: 13.5px; color: #2b2b45; }
    .prix-cell .currency { color: var(--primary); font-weight: 700; margin-left: 4px; }

    /* Actions — uniform purple, not color-matched per row */
    .actions-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        color: #fff !important;
        font-weight: 600;
        font-size: 13px;
        background: linear-gradient(135deg, #7c6df2, #6C63F5);
        box-shadow: 0 5px 12px rgba(108, 99, 245, .3);
    }

    .actions-btn:hover,
    .actions-btn:focus {
        background: linear-gradient(135deg, #6c5ff0, #5a52e0);
        outline: none;
    }

    .actions-btn.dropdown-toggle::after {
        display: none !important;
        content: none !important;
        margin: 0 !important;
        border: none !important;
    }

    td.actions .dropdown-menu {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 8px 24px rgba(108, 99, 245, .18) !important;
        padding: 6px !important;
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

    td.actions .dropdown-menu:empty { display: none; }

    /* Info + pagination footer */
    .dataTables_paginate .paginate_button {
        border-radius: 10px !important;
        border: 1.5px solid #eeecfb !important;
        color: #6b6b85 !important;
        padding: 8px 14px !important;
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

    .dataTables_paginate .paginate_button.disabled,
    .dataTables_paginate .paginate_button.disabled:hover {
        color: #cfcbe6 !important;
        background: #fff !important;
        border-color: #eeecfb !important;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        color: #c7c1ec !important;
        opacity: .7;
    }
</style>

<div class="box">
    <div class="box-header">
        <div class="hero-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 8-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M3 8l9 5 9-5"/></svg>
        </div>
        <div class="hero-text">
            <h3 class="box-title hero-title"><?php echo __('La liste des produits archivés'); ?></h3>
            <div class="hero-subtitle">Consultez tous les produits archivés dans le système</div>
        </div>
        <svg class="hero-illustration" width="220" height="130" viewBox="0 0 220 130" fill="none">
            <path d="M60 130 Q120 40 220 60 L220 130 Z" fill="#ece7fd"/>
            <rect x="150" y="70" width="40" height="30" rx="4" fill="#c9bff5" opacity="0.6"/>
            <path d="M150 76 L170 88 L190 76" stroke="#8f7bfb" stroke-width="2" fill="none" opacity="0.7"/>
            <circle cx="130" cy="45" r="3" fill="#8f7bfb" opacity="0.5"/>
            <circle cx="150" cy="30" r="2" fill="#8f7bfb" opacity="0.6"/>
            <path d="M195 55 q10 -15 20 -5 q-10 5 -20 5z" fill="#a8e6b0" opacity="0.6"/>
        </svg>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.59 2.59a2 2 0 0 0-2.83 0L2.59 9.76a2 2 0 0 0 0 2.83l8.82 8.82a2 2 0 0 0 2.83 0l7.17-7.17a2 2 0 0 0 0-2.83z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>Code</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 8-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M3 8l9 5 9-5"/></svg>Produit</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Game</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.59 2.59a2 2 0 0 0-2.83 0L2.59 9.76a2 2 0 0 0 0 2.83l8.82 8.82a2 2 0 0 0 2.83 0l7.17-7.17a2 2 0 0 0 0-2.83z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>Prix HT</span></th>
                    <th class="actions"><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Actions</span></th>
                </tr>
            </thead>
            <?php
            // Deterministic pastel palette assigned per product code (Code badge only — Actions stays uniform purple)
            $codePalette = array(
                array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                array('bg' => '#dbe9fd', 'text' => '#2f6fe0'),
                array('bg' => '#d3f3e0', 'text' => '#1fae6e'),
                array('bg' => '#fdf0dc', 'text' => '#d97706'),
                array('bg' => '#fde2ef', 'text' => '#db2777'),
                array('bg' => '#d7f6f2', 'text' => '#0e9488'),
            );

            // Guards against mixed ISO-8859-1 / UTF-8 data producing garbled accents (é → Ã©, etc.)
            if (!function_exists('safe_utf8')) {
                function safe_utf8($str) {
                    if ($str === null || $str === '') {
                        return $str;
                    }
                    return mb_check_encoding($str, 'UTF-8') ? $str : mb_convert_encoding($str, 'UTF-8', 'ISO-8859-1');
                }
            }

            foreach ($produits as $produit):
                $code = $produit['Produit']['code'];
                $colorIndex = crc32($code) % count($codePalette);
                $colors = $codePalette[$colorIndex];
                $produitName = safe_utf8($produit['Produit']['name']);
                $gameName = trim(safe_utf8($produit['Game']['name']));
                ?>
                <tr>
                    <td>
                        <span class="badge-pill" style="background:<?php echo $colors['bg']; ?>;color:<?php echo $colors['text']; ?>;"><?php echo h($code); ?>&nbsp;</span>
                    </td>
                    <td><span class="produit-cell"><?php echo h($produitName); ?>&nbsp;</span></td>
                    <td>
                        <?php if ($gameName !== '') { ?>
                            <span class="game-pill" style="background:<?php echo $colors['bg']; ?>;color:<?php echo $colors['text']; ?>;"><?php echo h($gameName); ?>&nbsp;</span>
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <span class="prix-cell"><?php echo h($produit['Produit']['prix']); ?><span class="currency">MAD</span></span>&nbsp;
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="actions-btn dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" style="display:none;">
                                <li><?php if ($this->requestAction('/droits/getrole/produits/view') == 1)
                                        echo $this->Html->link(__('Voir'), array('action' => 'view', $produit['Produit']['id'])); ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/produits/edit') == 1)
                                        echo $this->Html->link(__('Editer'), array('action' => 'edit', $produit['Produit']['id'])); ?></li>
                                <li><?php if ($this->requestAction('/droits/getrole/produits/archive') == 1)
                                        echo $this->Html->link(__('Désarchiver'), array('action' => 'archive', $produit['Produit']['id'], 1)); ?></li>
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
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "iDisplayLength": 50,
        language: {
            search: 'Rechercher\u00A0:',
            searchPlaceholder: 'Rechercher un produit...',
            info: 'Affichage de _START_ à _END_ sur _TOTAL_ entrées',
            infoEmpty: 'Affichage de 0 à 0 sur 0 entrées',
            infoFiltered: '(filtré de _MAX_ entrées au total)',
            zeroRecords: 'Aucun élément correspondant trouvé',
            paginate: {
                previous: '&lsaquo;',
                next: '&rsaquo;'
            }
        }
    });
});
</script>
