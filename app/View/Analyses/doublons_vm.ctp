<style>
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-light:#f1effd;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px; border-top:3px solid var(--accent);
    }
    .box .box-header.with-border{ border-bottom:none; padding:20px 24px 8px 24px; }
    .box .box-body{ padding:16px 24px 24px 24px; }

    .box-title{ margin:0; font-size:15.5px; font-weight:700; color:var(--text-dark); display:flex; align-items:center; }
    .box-title i{
        display:inline-flex; align-items:center; justify-content:center;
        width:30px; height:30px; border-radius:50%; margin-right:10px; font-size:13px;
        background:var(--accent-light); color:var(--accent); flex:0 0 auto;
    }
    .box-title .vm-name{ color:var(--accent); font-weight:700; }

    .table-responsive::-webkit-scrollbar{ width:8px; }
    .table-responsive::-webkit-scrollbar-thumb{ background:var(--border-color); border-radius:8px; }

    table.table{ width:100% !important; border-collapse:separate !important; border-spacing:0; margin-bottom:0; }
    table.table thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:11px 14px !important; position:sticky; top:0; z-index:1;
    }
    table.table thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    table.table thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    table.table tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:11px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    table.table.table-striped tbody tr:nth-of-type(odd){ background:#fcfbff; }
    table.table tbody tr:hover td{ background:var(--accent-light); }
    table.table tbody tr:last-child td{ border-bottom:none !important; }
    table.table a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    table.table a:hover{ color:var(--accent); text-decoration:underline; }

    .nb-badge{
        display:inline-flex; align-items:center; justify-content:center;
        min-width:26px; height:22px; padding:0 8px; border-radius:11px;
        background:#fdeaf1; color:#e0457b; font-weight:700; font-size:12.5px;
    }
    .listes-cell{ color:var(--text-muted); font-size:12.5px; }
</style>

<div class="row">
<?php foreach ($data as $vmId => $clients): ?>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-copy"></i>
                    Médecins en doublons — VM #<?php echo $vmId; ?>
                    (<span class="vm-name"><?php echo h($clients[0]['vm']); ?></span>)
                </h3>
            </div>
            <div class="box-body">
                <div class="table-responsive" style="max-height:400px; overflow-y:auto; cursor:pointer;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom du Médecin</th>
                                <th>Spécialité</th>
                                <th>Localisation</th>
                                <th>NB</th>
                                <th>Listes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $c): ?>
                            <tr>
                                <td>
                                    <?php echo $this->Html->link(
                                        $c['client'].".",
                                        ["controller"=>"clients","action"=>'view',$c["client_id"]],
                                        ['target'=>'_blank']
                                    ); ?>
                                </td>
                                <td><?php echo h($c['specialite']); ?></td>
                                <td><?php echo h($c['localisation']); ?></td>
                                <td><span class="nb-badge"><?php echo h($c['nb_listes']); ?></span></td>
                                <td class="listes-cell"><?php echo h($c['listes']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
