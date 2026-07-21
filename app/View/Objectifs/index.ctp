<?php echo $this->Html->css('dataTables.bootstrap');?>
<!-- ===== MODERN LAVENDER CARD STYLE SYSTEM ===== -->
<style>
    /* ===== GLOBAL TYPOGRAPHY UNIFICATION ===== */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .lb-card, 
    .lb-card-header .box-title, 
    .lb-table, 
    .dataTables_wrapper, 
    .lb-obj-card {
        font-family: 'Poppins', sans-serif !important;
    }

    @media (max-width:1070px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }

    /* ===== LaboRate Lavender Card Design ===== */
    .lb-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 22px rgba(144, 125, 250, 0.08);
        background: #ffffff;
    }
    .lb-card-header {
        background: linear-gradient(135deg, #907DFA 0%, #AFA2FF 100%);
        padding: 18px 24px;
        border: none;
    }
    .lb-header-flex { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
    }
    .lb-icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; 
        height: 36px;
        background: rgba(255, 255, 255, 0.22);
        border-radius: 9px;
        flex-shrink: 0;
    }
    .lb-card-header .box-title {
        color: #ffffff;
        font-weight: 600;
        margin: 0;
        font-size: 19px;
        letter-spacing: -0.2px;
    }

    .lb-card-body { 
        padding: 12px 24px 24px; 
        background: #FAF9FE; 
    }

    /* ===== REFINED DATA TABLES LAYOUT ===== */
    .lb-table { 
        margin-bottom: 0; 
        border-collapse: separate; 
        border-spacing: 0 10px; 
        width: 100%; 
    }
    .lb-table thead th {
        border: none;
        color: #9C93D9;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 700;
        padding: 12px 16px;
        background: transparent;
    }
    .lb-table tbody tr {
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(144, 125, 250, 0.04);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .lb-table tbody tr:hover { 
        box-shadow: 0 5px 15px rgba(144, 125, 250, 0.12);
        transform: translateY(-1px);
    }
    .lb-table tbody td {
        border: none;
        padding: 14px 16px;
        vertical-align: middle;
        color: #554B82;
        font-size: 14px;
    }
    .lb-table tbody tr td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .lb-table tbody tr td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .lb-name-cell { 
        font-weight: 600; 
        color: #7966E3; 
    }
    .lb-empty-obj { 
        color: #C1BAED; 
        font-size: 13px; 
        font-style: italic; 
    }

    /* ===== OBJECTIVES MODULE CARDS ===== */
    .lb-obj-list { 
        display: flex; 
        flex-direction: column; 
        gap: 8px; 
    }
    .lb-obj-card {
        border: 1px solid #EAE6FF;
        border-radius: 10px;
        overflow: hidden;
        background: #ffffff;
    }
    .lb-obj-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #907DFA 0%, #AFA2FF 100%);
        color: #ffffff;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 600;
    }
    .lb-obj-head .lb-obj-close {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 14px;
        line-height: 1;
        padding: 2px 4px;
        border-radius: 4px;
        transition: background .15s ease;
    }
    .lb-obj-head .lb-obj-close:hover { 
        background: rgba(255, 255, 255, 0.2); 
        color: #ffffff; 
    }
    .lb-obj-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
    }
    .lb-obj-date { 
        font-size: 12.5px; 
        color: #9C93D9; 
        font-weight: 500; 
    }
    .lb-obj-count {
        font-size: 12px;
        font-weight: 700;
        color: #816EEB;
        background: #F3F1FF;
        padding: 3px 12px;
        border-radius: 20px;
    }
    .lb-obj-divider { border: none; border-top: 1px dashed #EAE6FF; margin: 2px 0; }

    /* ===== BUGFIX: FAILSAFE SVG VECTOR ACTION BUTTONS ===== */
    .lb-actions-cell { 
        display: flex; 
        gap: 8px; 
        align-items: center;
    }
    .lb-icon-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 34px !important; 
        height: 34px !important;
        border-radius: 8px !important;
        border: none !important;
        padding: 0 !important;
        cursor: pointer;
        position: relative;
        transition: all .2s ease;
    }

    /* CSS Embedded Failsafe Icon: View */
    .lb-icon-view { 
        background: #F3F1FF !important; 
    }
    .lb-icon-view::before {
        content: "";
        display: block;
        width: 16px;
        height: 16px;
        background-color: #907DFA;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' /%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' /%3E%3C/svg%3E") no-repeat center;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' /%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' /%3E%3C/svg%3E") no-repeat center;
    }
    .lb-icon-view:hover { 
        background: #907DFA !important; 
    }
    .lb-icon-view:hover::before {
        background-color: #ffffff !important;
    }

    /* CSS Embedded Failsafe Icon: Add */
    .lb-icon-add { 
        background: #EAF8F0 !important; 
    }
    .lb-icon-add::before {
        content: "";
        display: block;
        width: 15px;
        height: 15px;
        background-color: #1B9E5A;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M12 4.5v15m7.5-7.5h-15' /%3E%3C/svg%3E") no-repeat center;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M12 4.5v15m7.5-7.5h-15' /%3E%3C/svg%3E") no-repeat center;
    }
    .lb-icon-add:hover { 
        background: #1B9E5A !important; 
    }
    .lb-icon-add:hover::before {
        background-color: #ffffff !important;
    }

    /* ===== DATATABLES CONTROLS INTERFACE ===== */
    .dataTables_wrapper { padding: 0; }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px;
    }
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #9C93D9;
        margin-bottom: 0;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1.5px solid #EAE6FF;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 13px;
        color: #554B82;
        outline: none;
        background: #ffffff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #907DFA;
        box-shadow: 0 0 0 3px rgba(144, 125, 250, 0.15);
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #EAE6FF;
        border-radius: 8px;
        padding: 8px 14px 8px 36px;
        font-size: 13px;
        color: #554B82;
        outline: none;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7' stroke='%239C93D9' stroke-width='2.5'/%3E%3Cpath d='M21 21l-4.35-4.35' stroke='%239C93D9' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat 12px center;
        background-size: 14px;
        width: 240px;
        max-width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #907DFA;
        box-shadow: 0 0 0 3px rgba(144, 125, 250, 0.15);
    }
    .dataTables_wrapper .dataTables_info {
        color: #9C93D9;
        font-size: 13px;
        padding-top: 14px;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 14px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        border: none !important;
        background: transparent !important;
        color: #554B82 !important;
        margin: 0 3px;
        padding: 6px 12px !important;
        font-size: 13px;
        font-weight: 500;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #F3F1FF !important;
        color: #7966E3 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #907DFA 0%, #AFA2FF 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 3px 10px rgba(144, 125, 250, 0.3);
        font-weight: 600;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #D4CEF5 !important;
    }
</style>

<div class="box lb-card">
    <div class="box-header lb-card-header">
        <div class="lb-header-flex">
            <span class="lb-icon-badge">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="9" stroke="#fff" stroke-width="1.8"/>
                    <circle cx="12" cy="12" r="5" stroke="#fff" stroke-width="1.8"/>
                    <circle cx="12" cy="12" r="1.3" fill="#fff"/>
                </svg>
            </span>
            <h3 class="box-title"><?php echo __('Les objectifs'); ?></h3>
        </div>
    </div>
    <div class="box-body lb-card-body">
        <table id="example1" class="table lb-table">
            <thead>
                <tr>
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Objectifs</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user):
            if(AuthComponent::user('role')!='Super viseur')
                $user['User1']=$user['User'];
            ?>
                <tr>
                    <td class="lb-name-cell"><?php echo h($user['User1']['name']); ?></td>
                    <td><?php echo h($user['User1']['username']); ?></td>
                    <td><?php echo h($user['User1']['tel']); ?></td>
                    <td style="text-align:left;width:220px">
                    <?php
                    $d="";
                    $objectifs = $this->requestAction('/objectifs/system_get_objectif_by_date/'.$user['User1']['id']);
                    $hasObjectifs = false;
                    foreach ($objectifs as $value)
                    {
                        if(empty($value))
                        {
                            continue;
                        }
                        $hasObjectifs = true;
                        break;
                    }
                    if (!$hasObjectifs) {
                        echo '<span class="lb-empty-obj">Aucun objectif</span>';
                    } else {
                        echo '<div class="lb-obj-list">';
                        foreach ($objectifs as $value)
                        {
                            if(empty($value)) { continue; }
                            $datee=explode(" ",$value['Objectif']['created']);
                            if($d=="")
                                $d=$datee[0];
                            if($d!=$datee[0])
                                echo '<hr class="lb-obj-divider">';
                            $d = $datee[0];
                            ?>
                            <div class="lb-obj-card">
                                <div class="lb-obj-head">
                                    <span><?php echo h($value['Type']['name']); ?></span>
                                    <?php echo $this->Html->link(
                                        '&times;',
                                        array('action' => 'delete', $value['Objectif']['id']),
                                        array('class' => 'lb-obj-close', 'escape' => false)
                                    ); ?>
                                </div>
                                <div class="lb-obj-body">
                                    <span class="lb-obj-date"><?php echo h($datee[0]); ?></span>
                                    <span class="lb-obj-count"><?php echo h($value['Objectif']['objectif']); ?> Visites</span>
                                </div>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    }
                    ?>
                    </td>
                    <td class="actions">
                        <div class="lb-actions-cell">
                            <?php echo $this->Html->link(
                                '', /* Empty string here because the SVG icon is dynamically injected by CSS mask safely */
                                array('controller' => 'users','action' => 'view', $user['User1']['id']),
                                array('class' => 'btn lb-icon-btn lb-icon-view', 'escape' => false, 'title' => 'Voir')
                            ); ?>
                            <?php echo $this->Html->link(
                                '', /* Empty string here because the SVG icon is dynamically injected by CSS mask safely */
                                array('controller'=>'objectifs','action' => 'add', $user['User1']['id']),
                                array('class' => 'btn lb-icon-btn lb-icon-add', 'escape' => false, 'title' => 'Ajouter')
                            ); ?>
                        </div>
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
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50
        });
    });
</script>