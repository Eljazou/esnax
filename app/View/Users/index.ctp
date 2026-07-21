<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<style>
    @media (max-width:932px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }

    /* ===== LaboRate Purple Card System — Users ===== */
    .lb-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(154, 138, 196, 0.08);
    }
    .lb-card-header {
        background: linear-gradient(135deg, #cebdf6 0%, #d9cff3 100%);
        padding: 18px 22px;
        border: none;
    }
    .lb-header-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .lb-title-group { display: flex; align-items: center; gap: 10px; }
    .lb-icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px; height: 34px;
        background: rgba(255,255,255,0.18);
        border-radius: 9px;
        flex-shrink: 0;
    }
    .lb-card-header .box-title {
        color: #fff;
        font-weight: 600;
        margin: 0;
        font-size: 19px;
    }
    .lb-actions-group { display: flex; gap: 8px; }
    .lb-btn-solid {
        background: #fff;
        color: #8C7AC4;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        transition: all .15s ease;
    }
    .lb-btn-solid:hover { background: #EFEAFB; color: #5E4E99; transform: translateY(-1px); text-decoration: none; }
    .lb-btn-outline {
        background: transparent;
        color: #fff;
        font-weight: 600;
        border: 1.5px solid rgba(255,255,255,0.6);
        border-radius: 8px;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        transition: all .15s ease;
    }
    .lb-btn-outline:hover { background: rgba(255,255,255,0.15); border-color: #fff; color: #fff; text-decoration: none; }

    .lb-card-body { padding: 8px 20px 20px; background: #fafafd; }

    .lb-table { margin-bottom: 0; border-collapse: separate; border-spacing: 0 8px; width: 100%; }
    .lb-table thead th {
        border: none;
        color: #9086B8;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
        padding: 10px 14px;
        background: transparent;
    }
    .lb-table tbody tr.lb-row {
        background: #fff;
        box-shadow: 0 1px 4px rgba(154,138,196,0.06);
    }
    .lb-table tbody tr.lb-row:hover { box-shadow: 0 3px 10px rgba(154,138,196,0.14); }
    .lb-table tbody td {
        border: none;
        padding: 10px 14px;
        vertical-align: middle;
        color: #3d2a4a;
    }
    .lb-table tbody tr.lb-row td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .lb-table tbody tr.lb-row td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .lb-avatar {
        width: 54px; height: 54px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #E7E1F7;
        display: block;
    }
    .lb-name-cell { font-weight: 600; color: #cabbff; }

    .lb-role-pill {
        display: inline-block;
        background: #EFEAFB;
        color: #7A68C7;
        font-weight: 600;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .lb-actions-cell { display: flex; align-items: center; gap: 8px; }
    .lb-dropdown-toggle {
        background: linear-gradient(135deg, #9B8AC4 0%, #C3B5E8 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 7px 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(154,138,196,0.25);
        transition: all .15s ease;
    }
    .lb-dropdown-toggle:hover { filter: brightness(1.08); }
    .lb-dropdown-menu {
        border: none;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(154,138,196,0.18);
        padding: 6px;
        min-width: 210px;
    }
    .lb-dropdown-menu li a {
        border-radius: 6px;
        padding: 8px 12px;
        color: #4A3F7A;
        font-size: 13.5px;
        display: block;
    }
    .lb-dropdown-menu li a:hover {
        background: #EFEAFB;
        color: #8C7AC4;
        text-decoration: none;
    }

    .lb-toggle-btn {
        background: transparent;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px; height: 30px;
        border-radius: 6px;
        cursor: pointer;
        color: #AFA4DE;
        transition: all .15s ease;
    }
    .lb-toggle-btn:hover { background: #EFEAFB; color: #8C7AC4; }

    .lb-subrow td {
        background: #F6F4FC !important;
        border-radius: 0 !important;
    }
    .lb-subrow .lb-avatar { width: 42px; height: 42px; }
    .lb-subrow-arrow {
        color: #B7ABE3;
        margin-right: 6px;
        font-weight: 700;
    }
</style>

<div class="box lb-card">
    <div class="box-header lb-card-header">
        <div class="lb-header-flex">
            <div class="lb-title-group">
                <span class="lb-icon-badge">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM21 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <h3 class="box-title"><?php echo __('La liste des utilisateurs'); ?></h3>
            </div>
            <div class="lb-actions-group">
                <?php if ($this->requestAction('/droits/getrole/users/add') == 1): ?>
                    <?php echo $this->Html->link(
                        '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px;"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>Ajouter',
                        array('action' => 'add'),
                        array('class' => 'lb-btn-solid', 'escape' => false)
                    ); ?>
                <?php endif; ?>
                <?php if (AuthComponent::user('role') == 'Admin'): ?>
                    <?php echo $this->Html->link(
                        '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px;"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/></svg>Afficher tout',
                        array('action' => 'index', "tout"),
                        array('class' => 'lb-btn-outline', 'escape' => false)
                    ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="box-body lb-card-body">
        <table id="example1" class="table lb-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>Ligne</th>
                    <th>Rôle</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($users as $user):
                ?>
                <tr class="lb-row">
                    <td><?php echo $this->Html->image('users/' . $user['User']['image'], array('class' => 'lb-avatar')); ?></td>
                    <td class="lb-name-cell"><?php echo h($user['User']['name']); ?></td>
                    <td><?php echo h($user['User']['username']); ?></td>
                    <td><?php echo h($user['Ligne']['name']); ?></td>
                    <td>
                        <span class="lb-role-pill"><?php
                            if ($user['User']['role'] == 'Super viseur')
                                echo 'Superviseur';
                            else if ($user['User']['role'] == 'Ressource humain')
                                echo 'Ressources humaines';
                            else
                                echo h($user['User']['role']);
                            ?></span>
                    </td>
                    <td class="actions">
                        <div class="lb-actions-cell">
                            <div class="btn-group">
                                <button type="button" class="lb-dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu lb-dropdown-menu" role="menu" style="display:none;">
                                    <li> <?php
                                        if ($this->requestAction('/droits/getrole/users/view') == 1)
                                            echo $this->Html->link(__('Voir'), array('action' => 'view', $user['User']['id']));
                                        ?></li>
                                    <li> <?php
                                        if ($this->requestAction('/droits/getrole/listes/listeretard') == 1)
                                            echo $this->Html->link(__('Liste retard'), array("controller" => "listes", 'action' => 'listeretard', $user['User']['id']));
                                        ?></li>
                                    <li> <?php
                                        if ($this->requestAction('/droits/getrole/visites/statistique') == 1)
                                            echo $this->Html->link(__('Statistique'), array("controller" => "visites", 'action' => 'statistique', $user['User']['id']));
                                        ?></li>
                                    <li> <?php
                                        if ($this->requestAction('/droits/getrole/clients/statistique_visites') == 1)
                                            echo $this->Html->link(__('Fréquence de visite'), array("controller" => "clients", 'action' => 'statistique_visites', $user['User']['id']));
                                        ?></li>
                                    <li><?php
                                        if ($this->requestAction('/droits/getrole/users/edit') == 1)
                                            echo $this->Html->link(__('Editer'), array('action' => 'edit', $user['User']['id']));
                                        ?></li>
                                    <li><?php
                                        if ($this->requestAction('/droits/getrole/Plantournes/gestion') == 1)
                                            echo $this->Html->link('Plan de tournée', array('controller' => 'plantournes', 'action' => 'gestion', $user['User']['id']));
                                        ?></li>
                                    <li><?php
                                        if ($this->requestAction('/droits/getrole/Evaluations/add') == 1)
                                            echo $this->Html->link('Evaluer', array('controller' => 'evaluations', 'action' => 'add', $user['User']['id']));
                                        ?></li>
                                    <li><?php
                                        if ($this->requestAction('/droits/getrole/brochures/detail_vmp') == 1)
                                            echo $this->Html->link('Stat Brochure', array('controller' => 'brochures', 'action' => 'detail_vmp', $user['User']['id']));
                                        ?></li>
                                    <li><?php
                                        echo $this->Html->link('Stock', array('controller' => 'echantillons', 'action' => 'stockvmp', $user['User']['id']));
                                        ?></li>
                                    <li>  <?php
                                        if ($this->requestAction('/droits/getrole/users/admin_bloquer_user') == 1) {
                                            if ($user['User']['archive'] == 1)
                                                echo $this->Html->link(__('Bloquer'), array('action' => 'admin_bloquer_user', $user['User']['id'], -1));
                                            else
                                                echo $this->Html->link(__('Débloquer'), array('action' => 'admin_bloquer_user', $user['User']['id'], 1));
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <?php if ($user['User']['role'] == 'Super viseur' && !isset($tous)): ?>
                                <button type="button" onclick="boxtog(<?php echo $i; ?>)" class="lb-toggle-btn" title="Afficher l'équipe">
                                    <span id="icon<?php echo $i; ?>" class="lb-toggle-icon-wrap">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
                                    </span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php if ($user['User']['role'] == 'Super viseur' && !isset($tous)): ?>
                    <tbody class="boxlistes<?php echo $i++; ?>" style="display:none;">
                        <?php
                        $vmps = $this->requestAction('/users/system_get_user_for_superviseur/' . $user['User']['id']);
                        foreach ($vmps as $userr):
                            ?>
                            <tr class="lb-row lb-subrow">
                                <td><span class="lb-subrow-arrow">&#9658;</span><?php echo $this->Html->image('users/' . $userr['User']['image'], array('class' => 'lb-avatar')); ?></td>
                                <td class="lb-name-cell"><?php echo h($userr['User']['name']); ?></td>
                                <td><?php echo h($userr['User']['username']); ?></td>
                                <td><?php echo h($userr['Ligne']['name']); ?></td>
                                <td>
                                    <span class="lb-role-pill"><?php
                                        if ($userr['User']['role'] == 'Super viseur')
                                            echo 'Superviseur';
                                        else if ($userr['User']['role'] == 'Ressource humain')
                                            echo 'Ressources humaines';
                                        else
                                            echo h($userr['User']['role']);
                                        ?></span>
                                </td>
                                <td class="actions">
                                    <div class="btn-group">
                                        <button type="button" class="lb-dropdown-toggle" aria-haspopup="true" aria-expanded="false" onclick="return toggleLegacyDropdown(this, event);">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu lb-dropdown-menu" role="menu" style="display:none;">
                                            <li>  <?php
                                                if ($this->requestAction('/droits/getrole/users/admin_bloquer_user') == 1) {
                                                    if ($userr['User']['archive'] == 1)
                                                        echo $this->Html->link(__('Bloquer'), array('action' => 'admin_bloquer_user', $userr['User']['id'], -1));
                                                    else
                                                        echo $this->Html->link(__('Débloquer'), array('action' => 'admin_bloquer_user', $userr['User']['id'], 1));
                                                }
                                                ?></li>
                                            <li> <?php
                                                if ($this->requestAction('/droits/getrole/users/view') == 1)
                                                    echo $this->Html->link(__('Voir'), array('action' => 'view', $userr['User']['id']));
                                                ?></li>
                                            <li> <?php
                                                if ($this->requestAction('/droits/getrole/listes/listeretard') == 1)
                                                    echo $this->Html->link(__('Liste retard'), array("controller" => "listes", 'action' => 'listeretard', $userr['User']['id']));
                                                ?></li>
                                            <li> <?php
                                                if ($this->requestAction('/droits/getrole/visites/statistique') == 1)
                                                    echo $this->Html->link(__('Statistique'), array("controller" => "visites", 'action' => 'statistique', $userr['User']['id']));
                                                ?></li>
                                            <li> <?php
                                                if ($this->requestAction('/droits/getrole/clients/statistique_visites') == 1)
                                                    echo $this->Html->link(__('Fréquence de visite'), array("controller" => "clients", 'action' => 'statistique_visites', $userr['User']['id']));
                                                ?></li>
                                            <li><?php
                                                if ($this->requestAction('/droits/getrole/users/edit') == 1)
                                                    echo $this->Html->link(__('Editer'), array('action' => 'edit', $userr['User']['id']));
                                                ?></li>
                                            <li><?php
                                                if ($this->requestAction('/droits/getrole/Plantournes/gestion') == 1)
                                                    echo $this->Html->link('Plan de tournée', array('controller' => 'plantournes', 'action' => 'gestion', $userr['User']['id']));
                                                ?></li>
                                            <li><?php
                                                if ($this->requestAction('/droits/getrole/Evaluations/add') == 1)
                                                    echo $this->Html->link('Evaluer', array('controller' => 'evaluations', 'action' => 'add', $userr['User']['id']));
                                                ?></li>
                                            <li><?php
                                                if ($this->requestAction('/droits/getrole/brochures/detail_vmp') == 1)
                                                    echo $this->Html->link('Stat Brochure', array('controller' => 'brochures', 'action' => 'detail_vmp', $user['User']['id']));
                                                ?></li>
                                            <li><?php
                                                echo $this->Html->link('Stock', array('controller' => 'echantillons', 'action' => 'stockvmp', $user['User']['id']));
                                                ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
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

    jQuery('.btn-group .dropdown-toggle, .btn-group .lb-dropdown-toggle').not($button).attr('aria-expanded', 'false');
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
            jQuery('.btn-group .dropdown-toggle, .btn-group .lb-dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
});

$(function () {
    $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "bSort": false,
        "iDisplayLength": 250,
        "aaSorting": [],
        "language": {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        }
    });
});

var svgPlus = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>';
var svgMinus = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>';

function boxtog(id) {
    $('.boxlistes' + id).toggle(300);
    var $icon = $("#icon" + id);
    if ($icon.data('state') === 'minus') {
        $icon.html(svgPlus);
        $icon.data('state', 'plus');
    } else {
        $icon.html(svgMinus);
        $icon.data('state', 'minus');
    }
}
</script>
