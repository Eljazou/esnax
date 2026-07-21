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
        padding: 26px 32px;
        background: #fff;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
    }

    .hero-left { display: flex; align-items: flex-start; gap: 16px; }

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
    }

    .box-title.hero-title {
        font-size: 24px;
        font-weight: 700;
        color: #171730;
        margin: 2px 0 4px;
        display: block;
    }

    .hero-subtitle {
        font-size: 13.5px;
        color: #8d8da8;
        font-weight: 500;
    }

    .btn-add-user {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 20px !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 11px 22px !important;
        font-size: 14px;
        box-shadow: 0 6px 16px rgba(108, 99, 245, .3);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
        white-space: nowrap;
        align-self: flex-start;
    }

    .btn-add-user:hover {
        background: linear-gradient(135deg, #5f56ee, #3f66e6) !important;
        color: #fff !important;
    }

    /* ===== Body / controls ===== */
    .box-body { padding: 0 30px 28px; }

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

    table.table-bordered td, table.table-bordered th {
        border-color: #f1effa !important;
    }

    table.table-striped > tbody > tr { background-color: #fff; }
    table.table-striped > tbody > tr:hover { background-color: #fbfaff; }

    #example1 td { vertical-align: middle !important; padding: 14px 14px !important; }

    /* Avatar */
    .avatar-photo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }

    .avatar-chip {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    /* Nom & prénom */
    .name-cell { font-weight: 700; font-size: 13.5px; color: #171730; }

    /* Téléphone */
    .tel-cell { display: flex; align-items: center; gap: 8px; color: #4a4a63; font-size: 13.5px; }
    .tel-cell svg { color: #9a94c9; flex-shrink: 0; }

    /* Rôle badge */
    .badge-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Actions */
    .actions-wrap { display: flex; align-items: center; gap: 10px; }

    .btn-unlock {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 1.5px solid var(--primary);
        color: var(--primary) !important;
        background: #fff;
        border-radius: 20px;
        padding: 7px 16px;
        font-weight: 600;
        font-size: 12.5px;
        text-decoration: none !important;
        white-space: nowrap;
    }

    .btn-unlock:hover {
        background: var(--primary);
        color: #fff !important;
    }

    .kebab-btn {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #9a94c9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .kebab-btn:hover { background: var(--primary-light); color: var(--primary); }

    .actions-wrap .dropdown-menu {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 8px 24px rgba(108, 99, 245, .18) !important;
        padding: 6px !important;
        min-width: 130px;
    }

    .actions-wrap .dropdown-menu li a {
        border-radius: 8px !important;
        padding: 8px 14px !important;
        font-size: 13.5px !important;
        color: #2b2b45 !important;
    }

    .actions-wrap .dropdown-menu li a:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
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
        <div class="hero-left">
            <div class="hero-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <h3 class="box-title hero-title"><?php echo __('Utilisateurs'); ?></h3>
                <div class="hero-subtitle">Gérez les comptes et les accès des utilisateurs</div>
            </div>
        </div>
        <?php
        // NOTE: "Ajouter un utilisateur" wasn't in the original code — added assuming a
        // standard 'add' action on UsersController. Adjust the action name if needed.
        echo $this->Html->link(
            '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>&nbsp;Ajouter un utilisateur',
            array('action' => 'add'),
            array('class' => 'btn-add-user', 'escape' => false)
        );
        ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>


                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php
            // Deterministic pastel palette assigned per user for the fallback initials avatar (display-only)
            $avatarPalette = array(
                array('bg' => '#ece9fe', 'text' => '#6C63F5'),
                array('bg' => '#fde8ef', 'text' => '#ea5a94'),
                array('bg' => '#e1f7ec', 'text' => '#1fae6e'),
                array('bg' => '#e1edfd', 'text' => '#3f8cf0'),
                array('bg' => '#fdf0e2', 'text' => '#e8973a'),
            );

            $roleBadges = array(
                'Superviseur' => array('bg' => '#fdf0e2', 'text' => '#d97706'),
                'Ressources humaines' => array('bg' => '#e1edfd', 'text' => '#2f6fe0'),
            );
            $defaultRoleBadge = array('bg' => '#d3f3e0', 'text' => '#1fae6e');

            foreach ($users as $user):
                $userName = $user['User']['name'];
                $words = preg_split('/\s+/', trim($userName));
                $initials = '';
                if (count($words) > 0) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
                }
                $colorIndex = crc32($userName) % count($avatarPalette);
                $avatarColor = $avatarPalette[$colorIndex];

                if ($user['User']['role'] == 'Super viseur')
                    $roleLabel = 'Superviseur';
                else if ($user['User']['role'] == 'Ressource humain')
                    $roleLabel = 'Ressources humaines';
                else
                    $roleLabel = $user['User']['role'];
                $roleBadge = isset($roleBadges[$roleLabel]) ? $roleBadges[$roleLabel] : $defaultRoleBadge;
                ?>
                <tr>
                    <td>
                        <?php if (!empty($user['User']['image'])) { ?>
                            <?php echo $this->Html->image('users/' . $user['User']['image'], array('class' => 'avatar-photo')); ?>
                        <?php } else { ?>
                            <span class="avatar-chip" style="background:<?php echo $avatarColor['bg']; ?>;color:<?php echo $avatarColor['text']; ?>;"><?php echo h($initials); ?></span>
                        <?php } ?>
                    </td>


                    <td><span class="name-cell"><?php echo h($user['User']['name']); ?>&nbsp;</span></td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td>
                        <div class="tel-cell">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <?php echo h($user['User']['tel']); ?>&nbsp;
                        </div>
                    </td>
                    <td>
                        <span class="badge-pill" style="background:<?php echo $roleBadge['bg']; ?>;color:<?php echo $roleBadge['text']; ?>;"><?php echo h($roleLabel); ?>&nbsp;</span>
                    </td>
                    <td class="actions">
                        <div class="actions-wrap">
                            <?php echo $this->Html->link(
                                '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg>&nbsp;' . __('Débloquer'),
                                array('action' => 'archive', $user['User']['id'], 1),
                                array('class' => 'btn-unlock', 'escape' => false)
                            ); ?>
                            <!--
                                NOTE: the "..." menu wasn't backed by any action in the original code.
                                Added Voir/Editer as a best guess (other pages already link to
                                controller=>'users', action=>'view'/'edit') — remove or adjust if these
                                don't match UsersController.
                            -->
                            <div class="btn-group">
                                <button type="button" class="kebab-btn dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.8"/><circle cx="12" cy="12" r="1.8"/><circle cx="12" cy="19" r="1.8"/></svg>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" style="display:none;">
                                    <li><?php echo $this->Html->link(__('Voir'), array('action' => 'view', $user['User']['id'])); ?></li>
                                    <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $user['User']['id'])); ?></li>
                                </ul>
                            </div>
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
            searchPlaceholder: 'Rechercher un utilisateur...',
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
