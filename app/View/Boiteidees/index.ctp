<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style>
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-light:#f1effd;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    .box{
        background:#fff;
        border:1px solid var(--border-color);
        border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card);
        margin-bottom:20px;
    }
    .box .box-header{ border-bottom:none; padding:24px 24px 6px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }

    .section-header{ display:flex; align-items:flex-start; gap:14px; margin-bottom:20px; }
    .section-icon{
        flex:0 0 auto; width:46px; height:46px; border-radius:50%;
        background:var(--accent); color:#fff;
        display:flex; align-items:center; justify-content:center; font-size:19px;
    }
    .section-header h3.box-title{ margin:0; font-size:18px; font-weight:700; color:var(--text-dark); }
    .section-header p.section-subtitle{ margin:2px 0 0 0; font-size:13px; color:var(--text-muted); }

    /* Toolbar: length + search */
    .table-toolbar{ display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:16px; }
    .table-toolbar .dataTables_length{ font-size:13.5px; color:var(--text-muted); display:flex; align-items:center; gap:6px; }
    .table-toolbar .dataTables_length select{
        border:1px solid var(--border-color) !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; padding:8px 10px !important; font-size:13.5px !important;
        color:var(--text-dark) !important; margin:0 4px;
    }
    .table-toolbar .dataTables_filter{ margin:0 !important; }
    .table-toolbar .dataTables_filter label{ display:flex !important; align-items:center; margin:0; }
    .table-toolbar .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px 9px 34px !important; min-width:230px;
        background:var(--accent-light) url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 12px center;
        background-size:14px 14px; font-size:13.5px !important;
    }
    .table-toolbar .dataTables_filter input:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }

    /* Table */
    #example1{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    #example1 thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:13px 16px !important;
    }
    #example1 thead th .th-icon{ color:var(--accent); margin-right:6px; }
    #example1 thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    #example1 thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    #example1.dataTable thead .sorting:after,
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--text-muted); opacity:.55; }
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--accent); opacity:1; }
    #example1 tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:14px 16px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    #example1.table-striped tbody tr:nth-of-type(odd){ background:#fcfbff; }
    #example1 tbody tr:hover td{ background:var(--accent-light); }
    #example1 tbody tr:last-child td{ border-bottom:none !important; }

    .vm-cell{ display:flex; align-items:center; gap:10px; white-space:nowrap; }
    .vm-avatar{
        width:32px; height:32px; border-radius:50%; background:var(--accent); color:#fff;
        display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; flex:0 0 auto;
    }
    .idea-cell{ display:flex; align-items:flex-start; gap:8px; }
    .idea-cell i{ color:var(--accent); margin-top:2px; flex:0 0 auto; }
    .date-cell{ display:flex; align-items:center; gap:8px; white-space:nowrap; color:var(--text-muted); }
    .date-cell i{ color:var(--accent); }

    td.actions{ text-align:right; }
    .btn-delete{
        display:inline-flex; align-items:center; gap:6px;
        border:1px solid #f1c9d6; color:#e0457b !important; background:#fff;
        border-radius:var(--radius-sm); padding:7px 14px; font-size:13px; font-weight:600;
        text-decoration:none !important; transition:background .15s ease;
    }
    .btn-delete:hover{ background:#fdeef2; }

    /* Pagination */
    .dataTables_wrapper .dataTables_paginate{ margin-top:4px !important; text-align:right; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 13px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ color:var(--text-muted) !important; opacity:.6; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current){
        background:var(--accent-light) !important; color:var(--accent) !important; border-color:var(--accent) !important;
    }
    .dataTables_wrapper .dataTables_info{ color:var(--text-muted) !important; font-size:13px !important; padding-top:8px !important; }
    .table-footer{ display:flex; align-items:center; justify-content:space-between; margin-top:14px; }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-lightbulb-o"></i></span>
                    <div>
                        <h3 class="box-title">Boite à idées</h3>
                        <p class="section-subtitle">Consultez et gérez les idées proposées par les visiteurs médicaux.</p>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><i class="fa fa-user th-icon"></i>VM</th>
                            <th><i class="fa fa-lightbulb-o th-icon"></i>Idée</th>
                            <th><i class="fa fa-calendar th-icon"></i>Date d'ajout</th>
                            <th class="actions">#</th>
                        </tr>
                    </thead>
                    <?php foreach ($boiteidees as $boiteidee) : ?>
                        <?php
                        $vmName = $boiteidee['User']['name'];
                        $vmParts = preg_split('/\s+/', trim($vmName));
                        $vmInitials = '';
                        foreach (array_slice($vmParts, 0, 2) as $part)
                            $vmInitials .= mb_strtoupper(mb_substr($part, 0, 1));
                        ?>
                        <tr>
                            <td>
                                <div class="vm-cell">
                                    <span class="vm-avatar"><?php echo $vmInitials; ?></span>
                                    <?php echo $vmName; ?>
                                </div>
                            </td>
                            <td>
                                <div class="idea-cell">
                                    <i class="fa fa-lightbulb-o"></i>
                                    <span><?php echo $boiteidee['Boiteidee']['name'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="date-cell">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo $boiteidee['Boiteidee']['created'] ?>
                                </div>
                            </td>
                            <td class="actions">
                                <?php
                                if ($this->requestAction('/droits/getrole/boiteidees/delete') == 1)
                                    echo $this->Form->postLink('<i class="fa fa-trash-o"></i> Supprimer', array('action' => 'delete', $boiteidee['Boiteidee']['id']), array('class' => 'btn-delete', 'escape' => false), 'Etes-vous sur de vouloir supprimer # %s?', $boiteidee['Boiteidee']['name']);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
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
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: '<"table-toolbar"lf>rt<"table-footer"ip>',
            language: {
                lengthMenu: "Afficher _MENU_ entrées",
                search: "",
                searchPlaceholder: "Rechercher...",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                infoEmpty: "Aucune entrée disponible",
                paginate: { previous: "← Précédent", next: "Suivant →" },
                emptyTable: '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-inbox"></i></span><div class="dt-empty-title">Aucune idée disponible</div></div>'
            }
        });
    });
</script>
