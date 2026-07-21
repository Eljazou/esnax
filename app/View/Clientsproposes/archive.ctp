<?php echo $this->Html->css('dataTables.bootstrap');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    @media (max-width:1269px) {
        .box-body {
            overflow: scroll;
            overflow-y: hidden;
        }
    }
</style>

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
    }

    body, .box, table, .dropdown-menu {
        font-family: 'Poppins', sans-serif;
    }

    .box {
        border-radius: 18px !important;
        border: none !important;
        box-shadow: 0 4px 16px rgba(108, 99, 245, 0.06) !important;
        background: #fff !important;
    }

    .box-header {
        border: none !important;
        padding: 22px 24px 16px;
    }

    .box-title {
        font-size: 15.5px;
        font-weight: 700;
        color: #2b2b45;
    }

    .box-body {
        padding: 8px 24px 24px;
    }

    /* Table */
    table.dataTable thead th,
    #example1 thead th {
        background: #faf9ff;
        color: #8b85c9 !important;
        font-weight: 700 !important;
        font-size: 12px;
        letter-spacing: .3px;
        text-transform: uppercase;
        border: none !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
        white-space: nowrap;
    }

    table.table-bordered td, table.table-bordered th {
        border-color: #eef0fa !important;
    }

    table.table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #fbfbff;
    }

    #example1 td a {
        color: var(--primary);
        font-weight: 500;
    }

    #example1 td a:hover {
        color: #5479f7;
        text-decoration: underline;
    }

    /* Actions dropdown */
    td.actions .btn-group .btn {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border: none !important;
        border-radius: 20px !important;
        padding: 6px 16px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
    }

    td.actions .btn-group .btn:hover,
    td.actions .btn-group .btn:focus {
        background: var(--primary) !important;
        color: #fff !important;
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

    /* If neither permission check passes, avoid showing a blank dropdown */
    td.actions .dropdown-menu:empty {
        display: none;
    }

    /* ===== DataTables controls: sorting icons (paging/search/info are disabled on this table) ===== */
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        color: #a9a4f0 !important;
        opacity: .7;
    }
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Liste des clients proposés'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Type</th>
                    <th>Secteur</th>
                    <th>Spécialité</th>
                    <th>Tendance</th>
                    <th>Nom & prénom</th>
                    <th>Titre</th>
                    <th>Potentialité</th>
                    <th>Téléphone</th>
                    <th>Fixe</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($clientsproposes as $clientspropose): ?>
                <tr>
                    <td><?php echo $this->Html->link($clientspropose['User']['name'], array('controller' => 'users', 'action' => 'view', $clientspropose['User']['id'])); ?></td>
                    <td><?php echo $clientspropose['Type']['name']; ?></td>
                    <td><?php echo $clientspropose['Secteur']['region'] . ' ' . $clientspropose['Secteur']['ville'] . ' ' . $clientspropose['Secteur']['secteur']; ?></td>
                    <td><?php if ($clientspropose['Clientspropose']['category1_id'] == null)
                            echo $clientspropose['Category']['name'];
                        else
                            echo $clientspropose['Category1']['name']; ?>&nbsp;</td>
                    <td><?php echo $clientspropose['Category']['name'] ?></td>
                    <td><?php echo h($clientspropose['Clientspropose']['nom'] . ' ' . $clientspropose['Clientspropose']['prenom']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['titre']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['potentialite']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['tel']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['fixe']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                if ($this->requestAction('/droits/getrole/clientsproposes/view') == 1)
                                    echo '<li>' . $this->Html->link(__('Voir'), array('action' => 'view', $clientspropose['Clientspropose']['id'])) . '</li>';
                                if ($this->requestAction('/droits/getrole/clientsproposes/archive') == 1)
                                    echo '<li>' . $this->Html->link('Désarchiver', array('action' => 'archive', $clientspropose['Clientspropose']['id'], 0)) . '</li>';
                                ?>
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
    $(function() {
        $("#example1").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50
        });
    });
</script>
