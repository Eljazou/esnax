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

    /* ===== Table body wrapper ===== */
    .box-body { padding: 24px 30px 30px; }

    /* Length / entries per page */
    .dataTables_length {
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

    /* Search box with embedded icon */
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
        background: #faf9ff;
        color: #8b85c9;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: .3px;
        text-transform: uppercase;
        border: none !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }

    table.table-bordered td, table.table-bordered th {
        border-color: #f1effa !important;
    }

    table.table-striped > tbody > tr:nth-of-type(odd) { background-color: #fff; }
    table.table-striped > tbody > tr { background-color: #fff; }
    table.table-striped > tbody > tr:hover { background-color: #fbfaff; }

    #example1 td { vertical-align: middle !important; padding: 14px 12px !important; }

    /* User cell: avatar + name */
    .user-cell { display: flex; align-items: center; gap: 10px; }

    .avatar-chip {
        width: 32px;
        height: 32px;
        min-width: 32px;
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
        text-decoration: none;
    }

    .user-cell a:hover { text-decoration: underline; }

    /* Besoin column */
    .besoin-text { color: #4a4a63; font-size: 13.5px; }

    /* Document + Etat badges */
    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pill svg { flex-shrink: 0; }

    /* Date column */
    .date-cell {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #6b6b85;
        font-size: 13px;
    }

    .date-cell svg { color: #b3aede; flex-shrink: 0; }

    /* Info + pagination footer */
    .dataTables_info {
        color: #6b6b85 !important;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .dataTables_info .info-icon {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: var(--primary-light);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
        </div>
        <div class="hero-text">
            <h3 class="box-title hero-title"><?php echo __('Archive des documents'); ?></h3>
            <div class="hero-subtitle">Retrouvez et consultez toutes les demandes de documents</div>
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
                    <th>User</th>
                    <th>Besoin</th>
                    <th>document</th>
                    <th>Etat</th>
                    <th>Date de demande</th>
                </tr>
            </thead>
            <?php
            // Deterministic pastel palette assigned per user (display-only, doesn't affect data)
            $avatarPalette = array(
                array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                array('bg' => '#fde8ef', 'text' => '#ea5a94'),
                array('bg' => '#e1f7ec', 'text' => '#1fae6e'),
                array('bg' => '#e1edfd', 'text' => '#3f8cf0'),
                array('bg' => '#fdf0e2', 'text' => '#e8973a'),
            );

            // Badge styling per known document type, with a neutral fallback for anything else
            $documentBadges = array(
                'Attestation de Travail' => array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                'Bordereau de déclaration de Salaire' => array('bg' => '#e1edfd', 'text' => '#3f8cf0'),
                'Bulletins de Paie' => array('bg' => '#e1f7ec', 'text' => '#1fae6e'),
                'Attestation de Salaire' => array('bg' => '#fde8e8', 'text' => '#e2554e'),
            );
            $defaultDocumentBadge = array('bg' => '#f1effa', 'text' => '#8b85c9');

            foreach ($documents as $document):
                $userName = $document['User']['name'];
                $words = preg_split('/\s+/', trim($userName));
                $initials = '';
                if (count($words) > 0) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
                }
                $colorIndex = crc32($userName) % count($avatarPalette);
                $avatarColor = $avatarPalette[$colorIndex];

                $docType = $document['Document']['document'];
                $docBadge = isset($documentBadges[$docType]) ? $documentBadges[$docType] : $defaultDocumentBadge;
                ?>
                <tr>
                    <td>
                        <div class="user-cell">
                            <span class="avatar-chip" style="background:<?php echo $avatarColor['bg']; ?>;color:<?php echo $avatarColor['text']; ?>;"><?php echo h($initials); ?></span>
                            <?php echo $this->Html->link($document['User']['name'], array('controller' => 'users', 'action' => 'view', $document['User']['id']), array('style' => 'color:' . $avatarColor['text'] . ';')); ?>
                        </div>
                    </td>
                    <td><span class="besoin-text"><?php echo h($document['Document']['description']); ?>&nbsp;</span></td>
                    <td>
                        <span class="badge-pill" style="background:<?php echo $docBadge['bg']; ?>;color:<?php echo $docBadge['text']; ?>;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
                            <?php echo h($docType); ?>&nbsp;
                        </span>
                    </td>
                    <td>
                        <span class="badge-pill" style="background:#fdf0e2;color:#e8973a;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 22h14M5 2h14M5 2v4a7 7 0 0 0 7 7 7 7 0 0 0 7-7V2M5 22v-4a7 7 0 0 1 7-7 7 7 0 0 1 7 7v4"/></svg>
                            <?php echo 'Demande annuler'; ?>&nbsp;
                        </span>
                    </td>
                    <td>
                        <div class="date-cell">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            <?php echo h($document['Document']['created']); ?>&nbsp;
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
    $(function() {
        var listIconSvg = '<span class="info-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg></span>';

        $("#example1").DataTable({
            language: {
                paginate: {
                    previous: '&laquo; Previous',
                    next: 'Next &raquo;'
                }
            },
            initComplete: function() {
                $('.dataTables_info').each(function() {
                    if (!$(this).find('.info-icon').length) {
                        $(this).prepend(listIconSvg);
                    }
                });
            },
            drawCallback: function() {
                $('.dataTables_info').each(function() {
                    if (!$(this).find('.info-icon').length) {
                        $(this).prepend(listIconSvg);
                    }
                });
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
