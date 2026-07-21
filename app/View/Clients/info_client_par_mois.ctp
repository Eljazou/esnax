<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style>
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-soft:#f0eefc;
        --border-color:#e8e7ee;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(45,43,66,0.05);
    }

    .box{
        background:#fff;
        border:1px solid var(--border-color);
        border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card);
        margin-bottom:20px;
    }
    .box .box-header{ border-bottom:none; padding:22px 24px 6px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }

    .section-header{ display:flex; align-items:flex-start; gap:14px; margin-bottom:18px; }
    .section-icon{
        flex:0 0 auto; width:42px; height:42px; border-radius:var(--radius-sm);
        background:var(--accent-soft); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:17px;
    }
    .section-header h3.box-title{ margin:0; font-size:16.5px; font-weight:700; color:var(--text-dark); }
    .section-header p.section-subtitle{ margin:2px 0 0 0; font-size:12.5px; color:var(--text-muted); }

    /* VM select form */
    #ClientVmForm .input{ margin-bottom:0 !important; }
    #ClientVmForm label{
        display:flex; align-items:center; gap:8px; font-weight:700;
        font-size:13.5px; color:var(--text-dark); margin-bottom:8px;
    }
    #ClientVmForm label .field-icon{
        width:26px; height:26px; border-radius:7px; background:var(--accent-soft);
        color:var(--accent); display:inline-flex; align-items:center; justify-content:center;
        font-size:12px; flex:0 0 auto;
    }
    #ClientVmForm select.form-control{
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-sm) !important;
        background:#fafafa !important;
        min-height:46px;
        box-shadow:none !important;
        font-size:14.5px;
        color:var(--text-dark);
        width:100%;
    }
    #ClientVmForm select.form-control:focus{ border-color:var(--accent) !important; background:#fff !important; }
    .well.text-center.col-md-12{
        background:transparent !important; border:none !important; box-shadow:none !important;
        padding:18px 0 0 0 !important; text-align:center;
    }
    .envoyer{
        background:var(--accent) !important; border:none !important;
        border-radius:var(--radius-sm) !important; color:#fff !important;
        padding:11px 26px !important; font-weight:600; font-size:14px;
        box-shadow:0 3px 10px rgba(108,92,231,0.25) !important;
        transition:background .15s ease; cursor:pointer;
    }
    .envoyer:before{
        font-family:"FontAwesome"; content:"\f1d8"; margin-right:8px;
    }
    .envoyer:hover{ background:var(--accent-dark) !important; }

    /* Toolbar / search */
    .table-toolbar{ display:flex; align-items:center; justify-content:flex-end; margin-bottom:14px; }
    .table-toolbar .dataTables_filter{ margin:0 !important; }
    .table-toolbar .dataTables_filter label{ display:flex !important; align-items:center; margin:0; }
    .table-toolbar .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px 9px 34px !important; min-width:220px; background:#fafafa
        url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>")
        no-repeat 12px center; background-size:14px 14px; font-size:13.5px !important;
    }
    .table-toolbar .dataTables_filter input:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }
    .table-toolbar .dataTables_length{ display:none !important; }

    /* Table */
    #example1{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    #example1 thead th{
        background:#fafafa !important; color:var(--text-dark) !important;
        font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:12px 12px !important; white-space:nowrap;
    }
    #example1 thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    #example1 thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    #example1.dataTable thead .sorting:after,
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--text-muted); opacity:.6; }
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--accent); opacity:1; }
    #example1 tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:12px !important; font-size:13.5px; vertical-align:middle;
    }
    #example1.table-striped tbody tr:nth-of-type(odd){ background:#fcfcfd; }
    #example1 tbody tr:hover td{ background:var(--accent-soft); }
    #example1 tbody tr:last-child td{ border-bottom:none !important; }
    #example1 a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    #example1 a:hover{ color:var(--accent); text-decoration:underline; }

    /* Empty state */
    #example1_processing,
    .dataTables_empty{
        padding:56px 20px !important; text-align:center; border:none !important;
    }
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:8px; color:var(--text-muted); }
    .dt-empty-state .dt-empty-icon{
        width:60px; height:60px; border-radius:50%; background:var(--accent-soft); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:4px;
    }
    .dt-empty-state .dt-empty-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .dt-empty-state .dt-empty-sub{ font-size:12.5px; }
</style>

<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-user-md"></i></span>
                    <div>
                        <h3 class="box-title">Choisissez un VM</h3>
                        <p class="section-subtitle">Sélectionnez le visiteur médical pour afficher la liste des clients.</p>
                    </div>
                </div>
                <?php
                echo $this->Form->create('Client');
                echo $this->Form->input('user_id', array('class' => 'form-control', 'label' => array('text' => '<span class="field-icon"><i class="fa fa-user"></i></span>Choisissez un VM', 'escape' => false)));
                echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large envoyer', 'div' => array('class' => 'well text-center col-md-12')));
                ?>
            </div>
        </div>

        <div class="box">
            <div class="box-body" style="padding-top:24px;">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-list"></i></span>
                    <div>
                        <h3 class="box-title">Liste des clients</h3>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Spécialité</th>
                            <th>Secteur</th>
                            <th>POT</th>
                            <?php for ($i = 1; $i < 13; $i++) echo "<th>$i</th>" ?>
                        </tr>
                    </thead>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td style="text-align: left;"><?php echo $this->Html->link($client['Client']['nom'] . " " . $client['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?></td>
                            <td style="text-align: left;"><?php echo $cats[$client['Client']['category_id']]; ?></td>
                            <td style="text-align: left;"><?php echo $secteurs[$client['Client']['secteur_id']]; ?></td>
                            <td><?php echo $client['Client']['potentialite']; ?></td>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                if ($i < 10)
                                    $i = "0$i";
                                $nombre = 0;
                                $color = "red";
                                if (isset($client["mois"][$i]))
                                    $nombre = $client["mois"][$i];
                                if ($nombre != 0)
                                    $color = "green";
                                echo "<td style='color: $color;'>$nombre</td>";
                            }
                            ?>
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
    $(function () {
        $("#example1").DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            dom: '<"table-toolbar"f>rt',
            language: {
                search: "",
                searchPlaceholder: "Rechercher...",
                emptyTable: '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-inbox"></i></span><div class="dt-empty-title">Aucune donnée disponible</div><div class="dt-empty-sub">Aucun client trouvé pour le moment.</div></div>'
            }
        });
    });
</script>
