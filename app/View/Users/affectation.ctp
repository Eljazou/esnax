<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
    /* ===== LaboRate Indigo Card System — Affectations ===== */
    .lb-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(124, 111, 245, 0.10);
    }
    .lb-card-header {
        background: linear-gradient(135deg, #7C6FF5 0%, #9C8FFA 100%);
        padding: 18px 22px;
        border: none;
    }
    .lb-header-flex { display: flex; align-items: center; gap: 10px; }
    .lb-icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px; height: 34px;
        background: rgba(255,255,255,0.20);
        border-radius: 9px;
        flex-shrink: 0;
    }
    .lb-card-header .box-title {
        color: #fff;
        font-weight: 600;
        margin: 0;
        font-size: 19px;
    }

    .lb-card-body { padding: 8px 20px 20px; background: #fafafd; }

    .lb-table { margin-bottom: 0; border-collapse: separate; border-spacing: 0 8px; width: 100%; }
    .lb-table thead th {
        border: none;
        color: #8B85C7;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
        padding: 10px 14px;
        background: transparent;
    }
    .lb-table tbody tr {
        background: #fff;
        box-shadow: 0 1px 4px rgba(124,111,245,0.08);
    }
    .lb-table tbody tr:hover { box-shadow: 0 3px 10px rgba(124,111,245,0.18); }
    .lb-table tbody td {
        border: none;
        padding: 12px 14px;
        vertical-align: middle;
        color: #4A3F7A;
    }
    .lb-table tbody tr td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .lb-table tbody tr td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .lb-name-cell { font-weight: 600; color: #453E99; }

    .lb-role-pill {
        display: inline-block;
        background: #EEECFF;
        color: #5B4FE5;
        font-weight: 600;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .lb-assign-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F0EEFF;
        color: #453E99;
        font-size: 12.5px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 20px;
        margin: 2px 4px 2px 0;
    }
    .lb-assign-tag .lb-sup-link {
        color: #c2185b;
        font-weight: 600;
        font-size: 11px;
        text-decoration: none;
        border-left: 1px solid rgba(194,24,91,0.25);
        padding-left: 6px;
        margin-left: 2px;
    }
    .lb-assign-tag .lb-sup-link:hover { color: #8e0038; text-decoration: underline; }
    .lb-empty-assign { color: #B9B4E0; font-size: 12.5px; font-style: italic; }

    .lb-assign-form {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        margin: 0;
    }
    .lb-assign-form select {
        border: 1.5px solid #E4E1FF;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 13px;
        color: #4A3F7A;
        background: #fff;
        outline: none;
        transition: border-color .15s ease;
    }
    .lb-assign-form select:focus { border-color: #7C6FF5; }
    .lb-assign-form .btn-primary {
        background: linear-gradient(135deg, #7C6FF5 0%, #9C8FFA 100%);
        border: none;
        border-radius: 8px;
        padding: 7px 16px;
        font-weight: 600;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(124,111,245,0.3);
        transition: all .15s ease;
    }
    .lb-assign-form .btn-primary:hover { filter: brightness(1.06); }

    /* ===== DataTables controls (Search / Show entries / Pagination) ===== */
    .dataTables_wrapper { padding: 0; }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px;
    }
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #8B85C7;
        margin-bottom: 0;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1.5px solid #E4E1FF;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 13px;
        color: #4A3F7A;
        outline: none;
        background: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #7C6FF5;
        box-shadow: 0 0 0 3px rgba(124,111,245,0.15);
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #E4E1FF;
        border-radius: 8px;
        padding: 8px 14px 8px 36px;
        font-size: 13px;
        color: #4A3F7A;
        outline: none;
        background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7' stroke='%238B85C7' stroke-width='2'/%3E%3Cpath d='M21 21l-4.35-4.35' stroke='%238B85C7' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat 12px center;
        background-size: 15px;
        width: 240px;
        max-width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #7C6FF5;
        box-shadow: 0 0 0 3px rgba(124,111,245,0.15);
    }
    .dataTables_wrapper .dataTables_info {
        color: #8B85C7;
        font-size: 12.5px;
        padding-top: 10px;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        border: none !important;
        background: transparent !important;
        color: #4A3F7A !important;
        margin: 0 2px;
        padding: 5px 11px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #EFECFF !important;
        color: #453E99 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #7C6FF5 0%, #9C8FFA 100%) !important;
        color: #fff !important;
        box-shadow: 0 2px 6px rgba(124,111,245,0.35);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #C9C4EE !important;
    }
</style>

<div class="box lb-card">
    <div class="box-header lb-card-header">
        <div class="lb-header-flex">
            <span class="lb-icon-badge">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM19 8v6M22 11h-6" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <h3 class="box-title">La liste des affectations</h3>
        </div>
    </div>
    <div class="box-body lb-card-body">
        <table id="example1" class="table lb-table">
            <thead>
                <tr>
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>rôle</th>
                    <th>Affecté à </th>
                    <th>Affecter</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="lb-name-cell"><?php echo $user['User']['name']; ?></td>
                    <td><?php echo $user['User']['username'] ?></td>
                    <td>
                        <span class="lb-role-pill"><?php if ($user['User']['role'] == 'Super viseur')
                            echo 'Superviseur';
                        else if ($user['User']['role'] == 'Ressource humain')
                            echo 'Ressources humaines';
                        else
                            echo h($user['User']['role']); ?></span>
                    </td>
                    <td>
                        <?php
                        if (isset($user["User"]["supers"]) && !empty($user["User"]["supers"])) {
                            foreach ($user["User"]["supers"] as $sup) {
                                echo '<span class="lb-assign-tag">' . h($sup['super']) . " (" . h($sup['type']) . ")"
                                    . $this->Form->postLink(
                                        "Sup",
                                        array('controller' => 'Users', 'action' => 'supprimer_affectation', $sup['apartient_id']),
                                        array('confirm' => 'Voulez-vous vraiment supprimer cette affectation ?', 'class' => 'lb-sup-link')
                                    )
                                    . '</span>';
                            }
                        } else {
                            echo '<span class="lb-empty-assign">Aucune affectation</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $this->Form->create('Apartient', array('class' => 'lb-assign-form'));
                        echo $this->Form->hidden('user1_id', array('value' => $user['User']['id'])); ?>
                        <select name="data[Apartient][superviseurs]" id="ApartientSuperviseurs">
                            <?php foreach ($superviseurs as $k => $v):
                                $s = '';
                                if (isset($user['User']['super_id'])) {
                                    if ($user['User']['super_id'] == $k)
                                        $s = "selected";
                                }
                                ?>
                                <option <?php echo $s; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="data[Apartient][type]">
                            <option value="Normal">Normal</option>
                            <option value="ASM">ASM</option>
                        </select>
                        <?php echo $this->Form->end(array('label' => 'Valider', 'class' => 'btn btn-primary'));
                        ?>
                    </td>
                </tr>
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
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "iDisplayLength": 50,
            "autoWidth": false
        });
    });
</script>
