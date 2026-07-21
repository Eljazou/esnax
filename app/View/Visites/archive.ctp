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

    #example1 td { vertical-align: middle !important; padding: 12px 14px !important; }

    /* Utilisateur */
    .user-cell { display: flex; align-items: center; gap: 10px; }

    .avatar-chip {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11.5px;
        font-weight: 700;
    }

    .user-cell a {
        font-weight: 600;
        font-size: 13px;
        color: #2b2b45;
        text-decoration: none;
    }

    .user-cell a:hover { text-decoration: underline; }

    /* Client */
    .client-pill {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 8px;
        background: #eaf2fe;
        color: #3f8cf0;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
    }

    .client-pill:hover { background: #d9e9fd; color: #2f6fe0; }

    .cell-dash { color: #c7c1e0; font-size: 14px; }

    /* Veille pills */
    .badge-pill {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12.5px;
    }

    /* Date */
    .date-cell { display: flex; align-items: center; gap: 8px; color: #4a4a63; font-size: 13px; line-height: 1.4; }
    .date-cell svg { color: #b3aede; flex-shrink: 0; }

    /* Actions */
    .btn-desarchiver {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 1.5px solid var(--primary);
        color: var(--primary) !important;
        background: #fff;
        border-radius: 20px;
        padding: 6px 16px;
        font-weight: 600;
        font-size: 12.5px;
        text-decoration: none !important;
        white-space: nowrap;
    }

    .btn-desarchiver:hover {
        background: var(--primary);
        color: #fff !important;
    }

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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
        <div class="hero-text">
            <h3 class="box-title hero-title"><?php echo __('Archive des visites'); ?></h3>
            <div class="hero-subtitle">Consultez l'historique de toutes les visites archivées</div>
        </div>
        <svg class="hero-illustration" width="220" height="130" viewBox="0 0 220 130" fill="none">
            <path d="M60 130 Q120 40 220 60 L220 130 Z" fill="#ece7fd"/>
            <rect x="150" y="65" width="45" height="35" rx="4" fill="#c9bff5" opacity="0.6"/>
            <path d="M150 72 L172 86 L194 72" stroke="#8f7bfb" stroke-width="2" fill="none" opacity="0.7"/>
            <circle cx="130" cy="45" r="3" fill="#8f7bfb" opacity="0.5"/>
            <path d="M195 55 q10 -15 20 -5 q-10 5 -20 5z" fill="#a8e6b0" opacity="0.6"/>
        </svg>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>Utilisateur</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V8l9-5 9 5v13"/><path d="M9 21v-6h6v6"/></svg>Client</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Commentaire</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg>Objectifs</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>Veille</span></th>
                    <th><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>Date</span></th>
                    <th class="actions"><span class="th-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Actions</span></th>
                </tr>
            </thead>
            <?php
            // Deterministic pastel palette assigned per user (display-only, matches the same user across rows)
            $avatarPalette = array(
                array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                array('bg' => '#fde8ef', 'text' => '#ea5a94'),
                array('bg' => '#d3f3e0', 'text' => '#1fae6e'),
                array('bg' => '#dbe9fd', 'text' => '#2f6fe0'),
                array('bg' => '#fdf0dc', 'text' => '#d97706'),
            );

            foreach ($visites as $visite):
                $userName = $visite['User']['name'];
                $words = preg_split('/\s+/', trim($userName));
                $initials = '';
                if (count($words) > 0) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
                }
                $colorIndex = crc32($userName) % count($avatarPalette);
                $avatarColor = $avatarPalette[$colorIndex];

                $commentaire = trim($visite['Visite']['commentaire']);
                $objection = trim($visite['Visite']['objection']);
                $veille = trim($visite['Visite']['veille']);

                // Veille badge color: known short-hand values get a specific color, everything else falls back to lavender
                if ($veille === '' || $veille === '-') {
                    $veilleColor = null; // rendered as a dash below
                } elseif ($veille === '50') {
                    $veilleColor = array('bg' => '#d3f3e0', 'text' => '#1fae6e');
                } elseif ($veille === '--') {
                    $veilleColor = array('bg' => '#fdf0dc', 'text' => '#d97706');
                } elseif ($veille === '-+') {
                    $veilleColor = array('bg' => '#dbe9fd', 'text' => '#2f6fe0');
                } else {
                    $veilleColor = array('bg' => '#ece9fe', 'text' => '#6C63F5');
                }

                // Split "YYYY-MM-DD HH:MM:SS" into two display lines when a time part is present
                $dateRaw = $visite['Visite']['date'];
                $dateParts = explode(' ', trim($dateRaw), 2);
                ?>
                <tr>
                    <td>
                        <div class="user-cell">
                            <span class="avatar-chip" style="background:<?php echo $avatarColor['bg']; ?>;color:<?php echo $avatarColor['text']; ?>;"><?php echo h($initials); ?></span>
                            <?php echo $this->Html->link($visite['User']['name'], array('controller' => 'users', 'action' => 'view', $visite['User']['id'])); ?>
                        </div>
                    </td>
                    <td>
                        <?php echo $this->Html->link($visite['Client']['id'], array('controller' => 'clients', 'action' => 'view', $visite['Client']['id']), array('class' => 'client-pill')); ?>
                    </td>
                    <td>
                        <?php if ($commentaire !== '') { ?>
                            <?php echo h($commentaire); ?>&nbsp;
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($objection !== '') { ?>
                            <?php echo h($objection); ?>&nbsp;
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($veilleColor !== null) { ?>
                            <span class="badge-pill" style="background:<?php echo $veilleColor['bg']; ?>;color:<?php echo $veilleColor['text']; ?>;"><?php echo h($veille); ?>&nbsp;</span>
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="date-cell">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            <span>
                                <?php echo h($dateParts[0]); ?>
                                <?php if (isset($dateParts[1]) && trim($dateParts[1]) !== '') { ?>
                                    <br><?php echo h($dateParts[1]); ?>
                                <?php } ?>
                            </span>
                        </div>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(
                            __('Désarchiver'),
                            array('action' => 'archive', $visite['Visite']['id'], 1),
                            array('class' => 'btn-desarchiver')
                        ); ?>
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
        $("#example1").DataTable({
            language: {
                lengthMenu: 'Afficher _MENU_ entrées',
                search: 'Rechercher\u00A0:',
                searchPlaceholder: 'Rechercher une visite...',
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
