<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
    :root{
        --purple-primary:#9B8AFB;
        --purple-dark:#7C6BEF;
        --purple-light:#EFEBFE;
        --purple-bg:#F8F6FF;
        --text-dark:#332E52;
        --text-muted:#9B96B5;
        --border-soft:#EFEBFA;
    }

    .dt-button{
        width:auto;
        display:inline-flex;
        align-items:center;
        gap:6px;
        margin:0 8px 8px 0;
        font-size:13px;
        font-weight:600;
        line-height:1.4;
        padding:8px 16px;
        border-radius:8px;
        border:1px solid var(--border-soft);
        background:#fff;
        color:var(--text-dark);
        cursor:pointer;
    }
    .dt-button:hover{ background:var(--purple-bg); color:var(--purple-dark); }
    .dt-button.buttons-csv{ color:var(--text-muted); }
    .dt-button.buttons-excel{ color:#1E9E5A; border-color:#D6F0DF; }
    .dt-button.buttons-excel:hover{ background:#F0FBF3; }
    .dt-button.buttons-print{ color:var(--purple-dark); border-color:var(--purple-light); }
    .dt-button.buttons-print:hover{ background:var(--purple-bg); }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:0;
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
    }
    .page-header-left{ display:flex; align-items:center; gap:16px; }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:linear-gradient(135deg,#B3A6FB 0%,#8F7EF2 100%);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; }
    .page-header-text h3{
        margin:0;
        color:var(--text-dark);
        font-weight:700;
        font-size:22px;
    }
    .page-header-text p{
        margin:2px 0 0;
        color:var(--text-muted);
        font-size:13px;
    }
    .page-header-text .underline{
        display:inline-block;
        width:34px;height:3px;
        background:var(--purple-primary);
        border-radius:3px;
        margin-top:6px;
    }
    .page-header-card .btn-purple-solid{
        background:linear-gradient(135deg,#B3A6FB 0%,#8F7EF2 100%);
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:600;
        font-size:13px;
        padding:10px 20px;
    }
    .page-header-card .btn-purple-solid:hover{ filter:brightness(1.05); color:#fff; }

    /* ===== Table card ===== */
    .specialites-card{
        background:#fff;
        border-radius:18px;
        box-shadow:0 4px 18px rgba(139,126,242,0.08);
        overflow:hidden;
        margin-top:16px;
    }
    .specialites-card .box-body{ padding:0; }

    table.spec-table{ margin-bottom:0; }
    table.spec-table thead th{
        background:var(--purple-bg);
        color:var(--purple-dark);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:2px solid var(--border-soft) !important;
        border-top:none !important;
        padding:14px 20px;
    }
    table.spec-table thead th .th-icon{ margin-right:6px; }
    table.spec-table tbody td{
        vertical-align:middle;
        padding:12px 20px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:14px;
    }
    table.spec-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFF; }
    table.spec-table tbody tr:hover{ background-color:var(--purple-bg) !important; }

    .spec-cell{ display:flex; align-items:center; gap:12px; }
    .spec-icon{
        flex:0 0 auto;
        width:34px;height:34px;
        border-radius:10px;
        background:var(--purple-light);
        display:flex;align-items:center;justify-content:center;
    }
    .spec-icon svg{ width:16px;height:16px; color:var(--purple-primary); }

    .actions-toggle{
        background:linear-gradient(135deg,#B3A6FB 0%,#8F7EF2 100%);
        color:#fff;
        border:none;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
        padding:6px 12px;
    }
    .actions-toggle i, .actions-toggle .caret{ color:#fff !important; }
    .actions-toggle:hover{ color:#fff; filter:brightness(1.05); }
    .dropdown-menu{
        border-radius:10px;
        border:1px solid var(--border-soft);
        box-shadow:0 8px 24px rgba(139,126,242,0.12);
        padding:6px;
    }
    .dropdown-menu>li>a{
        border-radius:6px;
        color:var(--text-dark);
        font-size:13px;
        padding:8px 12px;
    }
    .dropdown-menu>li>a:hover{ background:var(--purple-bg); color:var(--purple-dark); }

    /* Matrix table card below */
    .tablebox .box{
        border:none;
        border-radius:18px;
        box-shadow:0 4px 18px rgba(139,126,242,0.08);
        overflow:hidden;
    }
    .tablebox .box-header.with-border{
        border-bottom:1px solid var(--border-soft);
        background:var(--purple-bg);
        padding:16px 20px;
        margin-bottom:0;
    }
    .tablebox .box-title{ color:var(--purple-dark); font-weight:700; margin:0; }
    .tablebox .box-body{ padding:24px 20px; }

    #example2.dataTable{
        border-collapse:separate !important;
        border-spacing:0;
        width:100% !important;
    }
    #example2.dataTable thead th{
        background:var(--purple-bg);
        color:var(--purple-dark);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:2px solid var(--border-soft) !important;
        border-top:none !important;
        padding:12px 16px;
        white-space:nowrap;
    }
    #example2.dataTable tbody td{
        vertical-align:middle;
        padding:11px 16px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:13.5px;
        white-space:nowrap;
    }
    #example2.dataTable tbody td:first-child{ font-weight:600; white-space:normal; }
    #example2.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFF; }
    #example2 tbody tr:hover{ background-color:var(--purple-bg) !important; }
    #example2.dataTable.table-bordered{ border:none; }

    div.dataTables_wrapper div.dataTables_filter{ margin-bottom:14px; }
    div.dataTables_wrapper div.dataTables_filter label{
        color:var(--text-muted);
        font-weight:600;
        font-size:13px;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:8px;
        padding:6px 12px;
        font-size:13px;
        outline:none;
        min-width:180px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus{ border-color:var(--purple-primary); }
    div.dataTables_wrapper div.dataTables_info{ color:var(--text-muted); font-size:13px; }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button{
        border-radius:8px !important;
        margin:0 2px;
        border:1px solid var(--border-soft) !important;
        color:var(--text-dark) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current{
        background:var(--purple-primary) !important;
        border-color:var(--purple-primary) !important;
        color:#fff !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover{
        background:var(--purple-light) !important;
        color:var(--purple-dark) !important;
    }
</style>

<?php
// Map specialty name (lowercase, accents stripped where relevant) to an icon key.
// Falls back to a generic medical icon if not found.
function specialiteIconKey($name) {
    $n = mb_strtolower(trim($name));
    $map = array(
        'cardiologue'        => 'heart',
        'chirurgien'         => 'scalpel',
        'dentiste'           => 'tooth',
        'dermatologue'       => 'lotion',
        'endocrinologue'     => 'gland',
        'gastro enterologue' => 'stomach',
        'gastro-enterologue' => 'stomach',
        'generaliste'        => 'user',
        'généraliste'        => 'user',
        'gynecologue'        => 'female',
        'gynécologue'        => 'female',
        'hematologue'        => 'drop',
        'hématologue'        => 'drop',
        'interniste'         => 'stethoscope',
        'medecin de sport'   => 'running',
        'médecin de sport'   => 'running',
    );
    return isset($map[$n]) ? $map[$n] : 'default';
}

function specialiteIconSvg($key) {
    $icons = array(
        'heart'       => '<path d="M20.8 8.6a4.6 4.6 0 0 0-7.8-3.3L12 6.3l-1-1a4.6 4.6 0 0 0-7.8 3.3c0 2.4 1.8 4 3.6 5.6L12 19l5.2-5c1.8-1.6 3.6-3.2 3.6-5.4z"/><path d="M8 12h1.5l1-2 2 4 1-2H16"/>',
        'scalpel'     => '<path d="M4 20l7-7"/><path d="M14.5 3.5l6 6L15 15l-6-6z"/><circle cx="18.5" cy="5.5" r="1.5"/>',
        'tooth'       => '<path d="M12 4c-2 0-3 1-4 1S6 4 5 4C3 4 2 6 2 8c0 3 1 4 1.5 8 .3 2.3 1 4 2.5 4 1 0 1-2 1.5-4s1-3 1.5-3 1 1 1.5 3 .5 4 1.5 4c1.5 0 2.2-1.7 2.5-4C15 12 16 11 16 8c0-2-1-4-3-4-1 0-2 1-4 1"/>',
        'lotion'      => '<rect x="9" y="2" width="6" height="4" rx="1"/><path d="M8 6h8l1 4-2 2v8a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-8l-2-2z"/>',
        'gland'       => '<circle cx="9" cy="9" r="4"/><circle cx="16" cy="16" r="4"/><path d="M9 13v3"/>',
        'stomach'     => '<path d="M7 3c0 3-3 4-3 8 0 5 4 9 9 9 4 0 7-3 7-6 0-2-1-3-3-3s-3 1-5 1-3-1-3-3c0-3 2-4 2-6 0 0 0-1-1-1S7 2 7 3z"/>',
        'user'        => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>',
        'female'      => '<circle cx="12" cy="8" r="5"/><path d="M12 13v8"/><path d="M9 18h6"/>',
        'drop'        => '<path d="M12 2s6 7 6 12a6 6 0 0 1-12 0c0-5 6-12 6-12z"/>',
        'stethoscope' => '<path d="M5 3v6a4 4 0 0 0 8 0V3"/><path d="M9 15a6 6 0 0 0 6-6V7"/><circle cx="19" cy="17" r="2.5"/><path d="M15 15v1a4 4 0 0 0 4 4"/>',
        'running'     => '<circle cx="15" cy="4" r="2"/><path d="M13 8l-3 3 2 2-1 5"/><path d="M10 11l-4 2"/><path d="M12 13l3 2 3-1"/><path d="M11 18l-3 3"/>',
        'default'     => '<path d="M9 2h6v4H9z"/><path d="M8 6h8l1 5-3 2v6a2 2 0 0 1-2 2h-0a2 2 0 0 1-2-2v-6l-3-2z"/>',
    );
    return isset($icons[$key]) ? $icons[$key] : $icons['default'];
}
?>

<div class="page-header-card">
    <div class="page-header-left">
        <div class="page-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3"/><path d="M9 15a6 6 0 0 0 6-6V7"/><circle cx="19" cy="17" r="2.5"/><path d="M15 15v1a4 4 0 0 0 4 4"/></svg>
        </div>
        <div class="page-header-text">
            <h3><?php echo __('Liste des spécialités'); ?></h3>
            <p><?php echo __('Gérez les spécialités disponibles'); ?></p>
            <span class="underline"></span>
        </div>
    </div>
    <?php
    if ($this->requestAction('/droits/getrole/categories/add') == 1)
        echo $this->Html->link('<i class="fa fa-plus"></i> Ajouter', array('action' => 'add'), array('class' => "btn btn-purple-solid", 'escape' => false));
    ?>
</div>

<div class="specialites-card">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped spec-table">
            <thead>
                <tr>
                    <th>Spécialité</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($categories as $category): ?>
                <?php
                    $iconKey = specialiteIconKey($category['Category']['name']);
                    $iconSvg = specialiteIconSvg($iconKey);
                ?>
                <tr>
                    <td>
                        <div class="spec-cell">
                            <span class="spec-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $iconSvg; ?></svg>
                            </span>
                            <?php echo h($category['Category']['name']); ?>
                        </div>
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="actions-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="return toggleLegacyDropdown(this);">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <li>  <?php echo $this->Html->link(__('Voir'), array('action' => 'view', $category['Category']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $category['Category']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Archiver'), array('action' => 'archive', $category['Category']['id'], 0)); ?></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<div class="tablebox col-md-12 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Spécialités</h3>
        </div>
        <div class="box-body" style="height: 243px;overflow-y: scroll;overflow-x: hidden;">
            <table id="example2" class="display table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Spécialités</th>
                        <th>A1</th>
                        <th>A2</th>
                        <th>A3</th>
						<th>A4</th>
						<th>B1</th>
                        <th>B2</th>
                        <th>B3</th>
						<th>B4</th>
						<th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
						<th>C4</th>
                        <th>NR</th>
                        <th>Nombre de clients afféctés</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data=array();
					//debug($clients);
                    foreach ($clients as $client) {
                        if ($client['Client']['potentialite'] == "A1")
                        {
                            if(!isset($data[$client['Client']['category_id']]["A1"]))
                            {
                                $data[$client['Client']['category_id']]["A1"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["A1"]=$data[$client['Client']['category_id']]["A1"]+1;
                        }
                        if ($client['Client']['potentialite'] == "A2")
                        {
                            if(!isset($data[$client['Client']['category_id']]["A2"]))
                            {
                                $data[$client['Client']['category_id']]["A2"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["A2"]=$data[$client['Client']['category_id']]["A2"]+1;
                        }
                        if ($client['Client']['potentialite'] == "A3")
                        {
                            if(!isset($data[$client['Client']['category_id']]["A3"]))
                            {
                                $data[$client['Client']['category_id']]["A3"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["A3"]=$data[$client['Client']['category_id']]["A3"]+1;
                        }
						if ($client['Client']['potentialite'] == "A4")
                        {
                            if(!isset($data[$client['Client']['category_id']]["A4"]))
                            {
                                $data[$client['Client']['category_id']]["A4"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["A4"]=$data[$client['Client']['category_id']]["A4"]+1;
                        }
						//
						 if ($client['Client']['potentialite'] == "B1")
                        {
                            if(!isset($data[$client['Client']['category_id']]["B1"]))
                            {
                                $data[$client['Client']['category_id']]["B1"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["B1"]=$data[$client['Client']['category_id']]["B1"]+1;
                        }
                        if ($client['Client']['potentialite'] == "B2")
                        {
                            if(!isset($data[$client['Client']['category_id']]["B2"]))
                            {
                                $data[$client['Client']['category_id']]["B2"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["B2"]=$data[$client['Client']['category_id']]["B2"]+1;
                        }
                        if ($client['Client']['potentialite'] == "B3")
                        {
                            if(!isset($data[$client['Client']['category_id']]["B3"]))
                            {
                                $data[$client['Client']['category_id']]["B3"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["B3"]=$data[$client['Client']['category_id']]["B3"]+1;
                        }
						if ($client['Client']['potentialite'] == "B4")
                        {
                            if(!isset($data[$client['Client']['category_id']]["B4"]))
                            {
                                $data[$client['Client']['category_id']]["B4"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["B4"]=$data[$client['Client']['category_id']]["B4"]+1;
                        }
						//
						if ($client['Client']['potentialite'] == "C1")
                        {
                            if(!isset($data[$client['Client']['category_id']]["C1"]))
                            {
                                $data[$client['Client']['category_id']]["C1"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["C1"]=$data[$client['Client']['category_id']]["C1"]+1;
                        }
                        if ($client['Client']['potentialite'] == "C2")
                        {
                            if(!isset($data[$client['Client']['category_id']]["C2"]))
                            {
                                $data[$client['Client']['category_id']]["C2"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["C2"]=$data[$client['Client']['category_id']]["C2"]+1;
                        }
                        if ($client['Client']['potentialite'] == "C3")
                        {
                            if(!isset($data[$client['Client']['category_id']]["C3"]))
                            {
                                $data[$client['Client']['category_id']]["C3"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["C3"]=$data[$client['Client']['category_id']]["C3"]+1;
                        }
						if ($client['Client']['potentialite'] == "C4")
                        {
                            if(!isset($data[$client['Client']['category_id']]["C4"]))
                            {
                                $data[$client['Client']['category_id']]["C4"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["C4"]=$data[$client['Client']['category_id']]["C4"]+1;
                        }
						//
                        if ($client['Client']['potentialite'] == "NR")
                        {
                            if(!isset($data[$client['Client']['category_id']]["NR"]))
                            {
                                $data[$client['Client']['category_id']]["NR"]=1;
                                foreach ($categories as $category)
                                {
                                    if($category["Category"]["id"]==$client['Client']['category_id'])
                                    {
                                        $data[$client['Client']['category_id']]["cat"]=$category["Category"]["name"];
                                        break;
                                    }
                                }
                            }
                            else
                                $data[$client['Client']['category_id']]["NR"]=$data[$client['Client']['category_id']]["NR"]+1;
                        }
                    }
                    foreach ($data as $value):
                        $stotal = 0
                        ?>
                        <tr>
                            <td><?php if (isset($value["cat"])) 
                                        echo $value["cat"]; ?></td>
                            <td><?php
                                if (isset($value["A1"])) {
                                    $stotal = $stotal + $value["A1"];
                                    echo $value["A1"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["A2"])) {
                                    $stotal = $stotal + $value["A2"];
                                    echo $value["A2"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["A3"])) {
                                    $stotal = $stotal + $value["A3"];
                                    echo $value["A3"];
                                } else
                                    echo "0";
                                ?></td>
								<td><?php
                                if (isset($value["A4"])) {
                                    $stotal = $stotal + $value["A4"];
                                    echo $value["A4"];
                                } else
                                    echo "0";
                                ?></td>
								 <td><?php
                                if (isset($value["B1"])) {
                                    $stotal = $stotal + $value["B1"];
                                    echo $value["B1"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["B2"])) {
                                    $stotal = $stotal + $value["B2"];
                                    echo $value["B2"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["B3"])) {
                                    $stotal = $stotal + $value["B3"];
                                    echo $value["B3"];
                                } else
                                    echo "0";
                                ?></td>
								<td><?php
                                if (isset($value["B4"])) {
                                    $stotal = $stotal + $value["B4"];
                                    echo $value["B4"];
                                } else
                                    echo "0";
                                ?></td>
								<td><?php
                                if (isset($value["C1"])) {
                                    $stotal = $stotal + $value["C1"];
                                    echo $value["C1"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["C2"])) {
                                    $stotal = $stotal + $value["C2"];
                                    echo $value["C2"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["C3"])) {
                                    $stotal = $stotal + $value["C3"];
                                    echo $value["C3"];
                                } else
                                    echo "0";
                                ?></td>
								<td><?php
                                if (isset($value["C4"])) {
                                    $stotal = $stotal + $value["C4"];
                                    echo $value["C4"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php
                                if (isset($value["NR"])) {
                                    $stotal = $stotal + $value["NR"];
                                    echo $value["NR"];
                                } else
                                    echo "0";
                                ?></td>
                            <td><?php echo $stotal; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    // Snapshot our jQuery instance right after our plugins load, before Metronic's own
    // bundles (plugins.bundle.js / app.min.js) can silently reassign window.jQuery,
    // and before any global auto-init runs on document ready.
    window.CRMJQ = jQuery;

    function toggleLegacyDropdown(button) {
        var $button = CRMJQ(button);
        var $menu = $button.next('.dropdown-menu');
        var isOpen = $button.attr('aria-expanded') === 'true';

        CRMJQ('.btn-group .dropdown-toggle').not($button).attr('aria-expanded', 'false');
        CRMJQ('.btn-group .dropdown-menu').not($menu).hide();

        if (isOpen) {
            $button.attr('aria-expanded', 'false');
            $menu.hide();
        } else {
            $button.attr('aria-expanded', 'true');
            $menu.show();
        }

        return false;
    }

    // IMPORTANT: we do NOT use $(document).ready() / CRMJQ(function(){...}) for the code
    // below. This layout registers an earlier ready-callback (app.min.js) that throws an
    // uncaught error; in jQuery 2.2.3 that breaks the internal ready-callback chain and
    // silently prevents every ready handler registered after it from ever running.
    // Since this <script> tag is placed after all the page's HTML, those elements already
    // exist in the DOM right now, so we run immediately instead of waiting for "ready".
    (function () {
        CRMJQ(document).on('click', function (e) {
            if (!CRMJQ(e.target).closest('.btn-group').length) {
                CRMJQ('.btn-group .dropdown-menu').hide();
                CRMJQ('.btn-group .dropdown-toggle').attr('aria-expanded', 'false');
            }
        });

        CRMJQ('.display').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
        });
    })();
</script>
