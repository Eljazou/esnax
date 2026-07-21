<style>
    :root{
        --purple-primary:#7C3AED;
        --purple-dark:#5B21B6;
        --purple-light:#EDE9FE;
        --purple-bg:#F5F3FF;
        --text-dark:#1F1147;
        --text-muted:#8A83A3;
        --border-soft:#EEEAFB;
        --blue-primary:#3B82F6;
        --blue-light:#EFF6FF;
    }

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
        background:linear-gradient(135deg,#8B5CF6 0%,#6D28D9 100%);
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
        background:linear-gradient(135deg,#8B5CF6 0%,#6D28D9 100%);
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:600;
        font-size:13px;
        padding:10px 20px;
    }
    .page-header-card .btn-purple-solid:hover{ filter:brightness(1.05); color:#fff; }

    /* ===== Table card ===== */
    .types-card{
        background:#fff;
        border-radius:18px;
        box-shadow:0 4px 18px rgba(109,40,217,0.08);
        overflow:hidden;
        margin-top:16px;
    }
    .types-card .box-body{ padding:0; }

    table.types-table{ margin-bottom:0; }
    table.types-table thead th{
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
    table.types-table thead th .th-icon{ margin-right:6px; }
    table.types-table tbody td{
        vertical-align:middle;
        padding:12px 20px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:14px;
    }
    table.types-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
    table.types-table tbody tr:hover{ background-color:var(--purple-bg) !important; }

    .type-cell{ display:flex; align-items:center; gap:12px; }
    .type-icon{
        flex:0 0 auto;
        width:34px;height:34px;
        border-radius:50%;
        background:var(--purple-light);
        display:flex;align-items:center;justify-content:center;
    }
    .type-icon svg{ width:16px;height:16px; color:var(--purple-primary); }

    .btn-voir, .btn-editer{
        display:inline-flex; align-items:center; gap:5px;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
        padding:6px 12px;
        margin:0 2px;
        border:1px solid transparent;
    }
    .btn-voir svg, .btn-editer svg{ width:13px;height:13px; }
    .btn-voir{
        background:var(--purple-light);
        color:var(--purple-dark);
        border-color:var(--purple-light);
    }
    .btn-voir:hover{ background:#e2dafc; color:var(--purple-dark); }
    .btn-editer{
        background:#fff;
        color:var(--blue-primary);
        border-color:var(--blue-light);
    }
    .btn-editer:hover{ background:var(--blue-light); color:var(--blue-primary); }
</style>

<?php
// Map a type name to an icon key. Falls back to a generic tag icon if not found.
function typeIconKey($name) {
    $n = mb_strtolower(trim($name));
    $map = array(
        'medecin'                          => 'stethoscope',
        'médecin'                          => 'stethoscope',
        'pharmacie'                        => 'flask',
        'grossiste'                        => 'box',
        'salles de sport'                  => 'dumbbell',
        'autres professions de la sante'   => 'plus',
        'autres professions de la santé'   => 'plus',
        'magasin de nutrition sportive'    => 'leaf',
        'salon de beaute'                  => 'sparkle',
        'salon de beauté'                  => 'sparkle',
    );
    return isset($map[$n]) ? $map[$n] : 'default';
}

function typeIconSvg($key) {
    $icons = array(
        'stethoscope' => '<path d="M5 3v6a4 4 0 0 0 8 0V3"/><path d="M9 15a6 6 0 0 0 6-6V7"/><circle cx="19" cy="17" r="2.5"/><path d="M15 15v1a4 4 0 0 0 4 4"/>',
        'flask'       => '<path d="M9 2h6v4l4 9a2 2 0 0 1-2 3H7a2 2 0 0 1-2-3l4-9z"/><path d="M7 14h10"/>',
        'box'         => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/>',
        'dumbbell'    => '<path d="M4 7v10"/><path d="M2 9v6"/><path d="M20 7v10"/><path d="M22 9v6"/><path d="M6 12h12"/>',
        'plus'        => '<circle cx="12" cy="12" r="9"/><path d="M12 8v8"/><path d="M8 12h8"/>',
        'leaf'        => '<path d="M4 20c8 0 16-4 16-16-12 0-16 8-16 16z"/><path d="M8 16c2-4 6-7 9-9"/>',
        'sparkle'     => '<path d="M12 3l1.8 4.8L18.5 9l-4.7 1.7L12 15.5l-1.8-4.8L5.5 9l4.7-1.2L12 3z"/><path d="M18 15l.9 2.4L21 18l-2.1.6L18 21l-.9-2.4L15 18l2.1-.6z"/>',
        'default'     => '<path d="M20.6 9.4l-8-8H4v8.6l8 8a2 2 0 0 0 2.8 0l5.8-5.8a2 2 0 0 0 0-2.8z"/><circle cx="8.5" cy="8.5" r="1.5"/>',
    );
    return isset($icons[$key]) ? $icons[$key] : $icons['default'];
}
?>

<div class="page-header-card">
    <div class="page-header-left">
        <div class="page-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h6v4l4 9a2 2 0 0 1-2 3H7a2 2 0 0 1-2-3l4-9z"/><path d="M7 14h10"/></svg>
        </div>
        <div class="page-header-text">
            <h3><?php echo __('Liste des types'); ?></h3>
            <p><?php echo __('Consultez et gérez les types disponibles'); ?></p>
            <span class="underline"></span>
        </div>
    </div>
    <?php if($this->requestAction('/droits/getrole/types/add')==1)
        echo $this->Html->link('<i class="fa fa-plus"></i> Ajouter', array('action' => 'add'), array('class' => "btn btn-purple-solid", 'escape' => false)); ?>
</div>

<div class="types-card">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped types-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($types as $type): ?>
                <?php
                    $iconKey = typeIconKey($type['Type']['name']);
                    $iconSvg = typeIconSvg($iconKey);
                ?>
                <tr>
                    <td>
                        <div class="type-cell">
                            <span class="type-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $iconSvg; ?></svg>
                            </span>
                            <?php echo h($type['Type']['name']); ?>
                        </div>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg> Voir', array('action' => 'view', $type['Type']['id']), array('class' => 'btn-voir', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg> Éditer', array('action' => 'edit', $type['Type']['id']), array('class' => 'btn-editer', 'escape' => false)); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
