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
        background: linear-gradient(120deg, #f3f1fe 0%, #ece7fd 55%, #f6f0fb 100%);
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }

    .hero-icon {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary), #8f7bfb);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        box-shadow: 0 8px 18px rgba(108, 99, 245, .35);
        z-index: 2;
    }

    .hero-text { z-index: 2; }

    .box-title.hero-title {
        font-size: 22px;
        font-weight: 700;
        color: #2b2b45;
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
        top: 6px;
        right: 10px;
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
        padding: 11px 40px 11px 18px !important;
        font-size: 14px !important;
        margin-left: 8px !important;
        box-shadow: 0 2px 8px rgba(108, 99, 245, .05) !important;
        min-width: 260px;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a94c9' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><circle cx='11' cy='11' r='8'/><path d='m21 21-4.3-4.3'/></svg>");
        background-repeat: no-repeat;
        background-position: right 14px center;
    }

    .dataTables_filter input:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    .dataTables_filter input::placeholder { color: #b3aede; }

    /* Table */
    table.dataTable thead th,
    #example1 thead th {
        background: #faf9ff;
        color: #6C63F5;
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

    #example1 td { vertical-align: middle !important; padding: 16px 14px !important; }

    /* User cell */
    .user-cell { display: flex; align-items: center; gap: 12px; }

    .avatar-chip {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .user-cell a {
        font-weight: 600;
        font-size: 13.5px;
        color: #2b2b45;
        text-decoration: none;
    }

    .user-cell a:hover { text-decoration: underline; }

    .cell-dash { color: #c7c1e0; font-size: 14px; }

    /* Titre cell */
    .titre-cell { display: flex; align-items: center; gap: 12px; }

    .titre-icon-box {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .titre-cell span.titre-label { font-weight: 600; font-size: 13.5px; color: #2b2b45; }

    /* Date cell */
    .date-cell { display: flex; align-items: center; gap: 12px; }

    .date-icon-box {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .date-cell .date-text { font-size: 13px; color: #4a4a63; line-height: 1.5; }

    /* Actions button */
    .actions-btn-group { display: flex; justify-content: center; position: relative; }

    .actions-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 12px;
        padding: 9px 16px;
        color: #fff !important;
        font-weight: 600;
        font-size: 13px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, .12);
    }

    .actions-btn:focus { outline: none; }

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

    td.actions .dropdown-menu:empty { display: none; }

    /* Info + pagination footer */
    .dataTables_info {
        display: inline-flex;
        align-items: center;
    }

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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7l-2-2H5a2 2 0 0 0-2 2z"/></svg>
        </div>
        <div class="hero-text">
            <h3 class="box-title hero-title"><?php echo __('Les rapports archivées'); ?></h3>
            <div class="hero-subtitle">Consultez et gérez tous vos rapports archivés</div>
        </div>
        <svg class="hero-illustration" width="150" height="110" viewBox="0 0 150 110" fill="none">
            <rect x="70" y="55" width="55" height="42" rx="6" fill="#c9bff5" opacity="0.55"/>
            <path d="M70 60 L97 78 L124 60" stroke="#8f7bfb" stroke-width="2" fill="none" opacity="0.7"/>
            <rect x="82" y="20" width="30" height="40" rx="3" fill="#fff" stroke="#c9bff5" stroke-width="2" opacity="0.9"/>
            <rect x="90" y="30" width="14" height="2.5" rx="1" fill="#c9bff5"/>
            <rect x="90" y="37" width="14" height="2.5" rx="1" fill="#c9bff5"/>
            <rect x="90" y="44" width="9" height="2.5" rx="1" fill="#c9bff5"/>
            <circle cx="128" cy="26" r="3" fill="#8f7bfb" opacity="0.6"/>
            <circle cx="136" cy="40" r="2" fill="#8f7bfb" opacity="0.5"/>
            <circle cx="60" cy="35" r="2.5" fill="#8f7bfb" opacity="0.4"/>
        </svg>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <?php if (AuthComponent::user('role') != "Super viseur")
                        echo '<th><span class="th-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>Employé</span></th>'; ?>
                    <th><span class="th-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>Titre</span></th>
                    <th><span class="th-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Description</span></th>
                    <th><span class="th-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>Date de rapport</span></th>
                    <th class="actions" style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <?php
            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

            // Row-cycling accent palette (pastel for avatar/icon chips, solid for the action button)
            $rowPalette = array(
                array('pastelBg' => '#ece9fe', 'pastelText' => '#6C63F5', 'solid' => 'linear-gradient(135deg,#7c6df2,#6C63F5)'),
                array('pastelBg' => '#d3f3e0', 'pastelText' => '#1fae6e', 'solid' => 'linear-gradient(135deg,#22c55e,#16a34a)'),
                array('pastelBg' => '#dbe9fd', 'pastelText' => '#2f6fe0', 'solid' => 'linear-gradient(135deg,#3b82f6,#2563eb)'),
                array('pastelBg' => '#fdf0dc', 'pastelText' => '#d97706', 'solid' => 'linear-gradient(135deg,#f59e0b,#ea8c07)'),
                array('pastelBg' => '#fde2ef', 'pastelText' => '#db2777', 'solid' => 'linear-gradient(135deg,#ec4899,#db2777)'),
            );
            $rowCount = 0;

            foreach ($rapports as $rapport):
                $colors = $rowPalette[$rowCount % count($rowPalette)];
                $rowCount++;

                $userName = trim($rapport['User']['name']);
                $initials = '';
                if ($userName !== '') {
                    $words = preg_split('/\s+/', $userName);
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
                }

                $titre = trim($rapport['Rapport']['titre']);
                $description = trim($rapport['Rapport']['description']);
                ?>
                <tr>
                    <?php if (AuthComponent::user('role') != "Super viseur"): ?>
                        <td>
                            <div class="user-cell">
                                <?php if ($userName !== '') { ?>
                                    <span class="avatar-chip" style="background:<?php echo $colors['pastelBg']; ?>;color:<?php echo $colors['pastelText']; ?>;"><?php echo h($initials); ?></span>
                                    <?php echo $this->Html->link($rapport['User']['name'], array('controller' => 'users', 'action' => 'view', $rapport['User']['id'])); ?>
                                <?php } else { ?>
                                    <span class="avatar-chip" style="background:#f1effa;color:#b3aede;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
                                    </span>
                                    <span class="cell-dash">&mdash;</span>
                                <?php } ?>
                            </div>
                        </td>
                    <?php endif; ?>
                    <td>
                        <div class="titre-cell">
                            <span class="titre-icon-box" style="background:<?php echo $colors['pastelBg']; ?>;color:<?php echo $colors['pastelText']; ?>;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
                            </span>
                            <?php if ($titre !== '') { ?>
                                <span class="titre-label"><?php echo h($titre); ?>&nbsp;</span>
                            <?php } else { ?>
                                <span class="cell-dash">&mdash;</span>
                            <?php } ?>
                        </div>
                    </td>
                    <td>
                        <?php if ($description !== '') { ?>
                            <span class="besoin-text"><?php echo h($description); ?>&nbsp;</span>
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="date-cell">
                            <span class="date-icon-box" style="background:<?php echo $colors['pastelBg']; ?>;color:<?php echo $colors['pastelText']; ?>;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            </span>
                            <span class="date-text">
                                <?php echo strftime("%A le %d-%m-%Y", strtotime($rapport['Rapport']['date_debut'])) . ' à<br>' .
                                    strftime("%A le %d-%m-%Y", strtotime($rapport['Rapport']['date_fin'])); ?>
                            </span>
                        </div>
                    </td>
                    <td class="actions">
                        <div class="btn-group actions-btn-group">
                            <button type="button" class="actions-btn dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);" style="background:<?php echo $colors['solid']; ?>;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <?php
                                if ($this->requestAction('/droits/getrole/rapports/archive') == 1) {
                                    if ($rapport['Rapport']['archive'] == -1)
                                        echo '<li>' . $this->Html->link(__('Valider'), array('action' => 'archive', $rapport['Rapport']['id'], 1)) . '</li>';
                                    else
                                        echo '<li>' . $this->Html->link(__('Archiver'), array('action' => 'archive', $rapport['Rapport']['id'], -1)) . '</li>';
                                } ?>
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
    $("#example1").DataTable({
        language: {
            lengthMenu: 'Afficher _MENU_ entrées',
            search: 'Rechercher\u00A0:',
            searchPlaceholder: 'Rechercher...',
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
