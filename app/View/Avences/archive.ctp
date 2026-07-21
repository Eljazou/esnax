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
        white-space: nowrap;
    }

    table.table-bordered td, table.table-bordered th {
        border-color: #f1effa !important;
    }

    table.table-striped > tbody > tr { background-color: #fff; }
    table.table-striped > tbody > tr:hover { background-color: #fbfaff; }

    #example1 td { vertical-align: middle !important; padding: 14px 12px !important; }

    /* Nom cell: avatar + name */
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

    /* Montant */
    .montant-cell { color: var(--primary); font-weight: 700; font-size: 13.5px; }

    /* Echeances */
    .echeances-cell {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        color: #4a4a63;
        font-size: 13px;
        line-height: 1.5;
    }

    .echeances-cell svg { color: #b3aede; flex-shrink: 0; margin-top: 2px; }

    .cell-dash { color: #c7c1e0; font-size: 14px; }

    /* Pills (type / etat / réponse / motif short) */
    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 13px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pill svg { flex-shrink: 0; }

    /* Note box (long motif / réponse text) */
    .note-box {
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 12.5px;
        line-height: 1.5;
        max-width: 260px;
    }

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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7l-2-2H5a2 2 0 0 0-2 2z"/></svg>
        </div>
        <div class="hero-text">
            <h3 class="box-title hero-title"><?php echo __('Archive des avences'); ?></h3>
            <div class="hero-subtitle">Consultez et gérez toutes les avances enregistrées</div>
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
                    <th>Nom</th>
                    <th>type</th>
                    <th>montant</th>
                    <th>echeances</th>
                    <th>motif</th>
                    <th>Etat</th>
                    <th>Répense</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
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

            $typeBadges = array(
                'Prêt' => array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                'Avance' => array('bg' => '#fde8ef', 'text' => '#ea5a94'),
            );
            $defaultTypeBadge = array('bg' => '#f1effa', 'text' => '#8b85c9');

            $motifPalette = array(
                array('bg' => '#e1edfd', 'text' => '#3f8cf0'),
                array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                array('bg' => '#e1f7ec', 'text' => '#1fae6e'),
                array('bg' => '#fdf0e2', 'text' => '#e8973a'),
                array('bg' => '#fde8ef', 'text' => '#ea5a94'),
            );

            $noteLengthThreshold = 45;

            // Guards against mixed ISO-8859-1 / UTF-8 data producing garbled accents (mb_check_encoding + convert only when needed)
            if (!function_exists('safe_utf8')) {
                function safe_utf8($str) {
                    if ($str === null || $str === '') {
                        return $str;
                    }
                    return mb_check_encoding($str, 'UTF-8') ? $str : mb_convert_encoding($str, 'UTF-8', 'ISO-8859-1');
                }
            }

            foreach ($documents as $avence):
                $userName = $avence['User']['name'];
                $words = preg_split('/\s+/', trim($userName));
                $initials = '';
                if (count($words) > 0) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
                }
                $colorIndex = crc32($userName) % count($avatarPalette);
                $avatarColor = $avatarPalette[$colorIndex];

                $typeText = safe_utf8($avence['Avence']['type']);
                $typeBadge = isset($typeBadges[$typeText]) ? $typeBadges[$typeText] : $defaultTypeBadge;

                $motifText = safe_utf8($avence['Avence']['motif']);
                $motifIndex = $motifText ? (crc32($motifText) % count($motifPalette)) : 0;
                $motifColor = $motifPalette[$motifIndex];

                $repenseText = safe_utf8($avence['Avence']['repense']);
                ?>
                <tr>
                    <td>
                        <div class="user-cell">
                            <span class="avatar-chip" style="background:<?php echo $avatarColor['bg']; ?>;color:<?php echo $avatarColor['text']; ?>;"><?php echo h($initials); ?></span>
                            <?php echo $this->Html->link($avence['User']['name'], array('controller' => 'users', 'action' => 'view', $avence['User']['id']), array('style' => 'color:' . $avatarColor['text'] . ';')); ?>
                        </div>
                    </td>
                    <td>
                        <span class="badge-pill" style="background:<?php echo $typeBadge['bg']; ?>;color:<?php echo $typeBadge['text']; ?>;"><?php echo h($typeText); ?>&nbsp;</span>
                    </td>
                    <td>
                        <span class="montant-cell">
                            <?php
                            $montantRaw = $avence['Avence']['montant'];
                            // Avoid a duplicate "DH" suffix when the stored value already includes a unit (e.g. "2000 dh")
                            if (preg_match('/dh/i', $montantRaw)) {
                                echo h($montantRaw);
                            } else {
                                echo h($montantRaw) . '&nbsp;DH';
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($avence['Avence']['echeances'] != null) {
                            $echeances = $avence['Avence']['echeances'];
                            ?>
                            <div class="echeances-cell">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                <span>
                                    <?php
                                    if (is_numeric($echeances) && (float) $echeances != 0) {
                                        echo h($echeances) . "mois";
                                        echo "<br>" . number_format($avence['Avence']['montant'] / $echeances, 2) . " Dh/mois";
                                    } else {
                                        // Non-numeric échéances (e.g. "1250 dhmois") shown as-is instead of dividing/crashing
                                        echo h($echeances);
                                    }
                                    ?>&nbsp;
                                </span>
                            </div>
                        <?php } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($motifText) {
                            if (strlen($motifText) > $noteLengthThreshold) { ?>
                                <div class="note-box" style="background:<?php echo $motifColor['bg']; ?>;color:<?php echo $motifColor['text']; ?>;"><?php echo h($motifText); ?>&nbsp;</div>
                            <?php } else { ?>
                                <span class="badge-pill" style="background:<?php echo $motifColor['bg']; ?>;color:<?php echo $motifColor['text']; ?>;"><?php echo h($motifText); ?>&nbsp;</span>
                            <?php }
                        } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        if ($avence['Avence']['valide'] == 1) {
                            echo '<span class="badge-pill" style="background:#e1f7ec;color:#1fae6e;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>Validé&nbsp;</span>';
                        }
                        if ($avence['Avence']['valide'] == 0) {
                            echo '<span class="badge-pill" style="background:#fdf0e2;color:#e8973a;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>En cours&nbsp;</span>';
                        }
                        if ($avence['Avence']['valide'] == -1) {
                            echo '<span class="badge-pill" style="background:#fde8e8;color:#e2554e;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>Réfusé&nbsp;</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($repenseText) {
                            if (strlen($repenseText) > $noteLengthThreshold) { ?>
                                <div class="note-box" style="background:#fdf0e2;color:#8a6a2f;"><?php echo h($repenseText); ?>&nbsp;</div>
                            <?php } elseif (strtolower(trim($repenseText)) === 'ras') { ?>
                                <span class="badge-pill" style="background:#e1f7ec;color:#1fae6e;"><?php echo h($repenseText); ?>&nbsp;</span>
                            <?php } else { ?>
                                <span class="besoin-text"><?php echo h($repenseText); ?>&nbsp;</span>
                            <?php }
                        } else { ?>
                            <span class="cell-dash">&mdash;</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="date-cell" style="display:flex;align-items:center;gap:7px;color:#6b6b85;font-size:13px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b3aede" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            <?php echo h($avence['Avence']['created']); ?>&nbsp;
                        </div>
                    </td>
                    <td class="actions">
                        <?php
                        echo $this->Html->link(
                            '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 6"/></svg>&nbsp;' . __('Désarchiver'),
                            array('action' => 'valider', $avence['Avence']['id'], 0),
                            array('class' => 'btn-desarchiver', 'escape' => false)
                        );
                        ?>
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
                    previous: '&laquo; Précédent',
                    next: 'Suivant &raquo;'
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
