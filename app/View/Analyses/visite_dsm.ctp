<?php
echo $this->Html->css('daterangepicker');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('select2.min');
?>

<style>
    :root{
        --accent:#7C5CFA;
        --accent-dark:#6a45f5;
        --accent-light:#F3EFFF;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(124,92,250,0.07);
    }

    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px; border-top:3px solid var(--accent);
    }
    .box .box-header.with-border{ border-bottom:none; padding:22px 24px 8px 24px; display:flex; align-items:flex-start; justify-content:space-between; }
    .box .box-body{ padding:20px 24px 24px 24px; }

    .section-header{ display:flex; align-items:flex-start; gap:14px; }
    .section-icon{
        flex:0 0 auto; width:44px; height:44px; border-radius:50%;
        background:var(--accent-light); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:17px;
    }
    .box-title{ margin:0; font-size:17px; font-weight:700; color:var(--text-dark); display:flex; align-items:center; }
    .box-title i{
        display:inline-flex; align-items:center; justify-content:center;
        width:32px; height:32px; border-radius:50%; margin-right:10px; font-size:14px;
        background:var(--accent-light); color:var(--accent);
    }
    .section-subtitle{ margin:2px 0 0 0; font-size:12.5px; color:var(--text-muted); }

    /* ---------- Filter card ---------- */
    .filter-card{ position:relative; overflow:hidden; }
    .filter-card .box-header.with-border{ padding-bottom:4px; }
    .filter-decor{
        position:absolute; top:14px; right:24px; display:flex; align-items:center; gap:8px;
        color:var(--border-color); font-size:22px; opacity:.7; pointer-events:none;
    }
    .filter-decor i:last-child{
        width:34px; height:34px; border-radius:50%; background:var(--accent); color:#fff;
        display:inline-flex; align-items:center; justify-content:center; font-size:15px; opacity:1;
    }
    #dateform{
        display: flex;
        flex-wrap: wrap;
        gap:20px;
        position:relative;
        padding-top:6px;
    }
    #dateform .input-group{
        margin-bottom:0 !important; width:calc(50% - 10px) !important; display:block !important;
    }
    #dateform label{
        display:block; font-weight:700; font-size:13.5px; color:var(--text-dark); margin-bottom:8px; float:none !important;
    }
    #dateform input.form-control,
    #dateform .select2-container .select2-selection--single,
    #dateform .select2-container .select2-selection--multiple{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        background:#fafafa !important; min-height:44px; box-shadow:none !important;
        font-size:14px; color:var(--text-dark); width:100% !important; float:none !important;
        padding-left:16px !important;
    }
    #dateform input.form-control:focus,
    #dateform .select2-container--focus .select2-selection{ border-color:var(--accent) !important; background:#fff !important; }
    #dateform .select2-selection__rendered{ line-height:42px !important; padding-left:16px !important; color:var(--text-muted) !important; }
    #dateform .select2-selection__arrow{ height:42px !important; }
    #dateform .select2-container{ width:100% !important; float:none !important; }

    /* Select2 multi-value pills, sized to fit inside the pill-shaped field */
    #dateform .select2-selection--multiple{ min-height:44px !important; padding:4px 8px !important; }
    #dateform .select2-selection__rendered{ line-height:normal !important; padding-left:8px !important; display:flex !important; flex-wrap:wrap; gap:6px; }
    #dateform .select2-selection__choice{
        background:var(--accent-light) !important; border:1px solid var(--accent) !important; color:var(--accent-dark) !important;
        border-radius:14px !important; padding:2px 8px !important; font-size:12.5px !important; margin:2px 0 !important;
    }
    #dateform .select2-dropdown{ border-color:var(--accent) !important; border-radius:var(--radius-sm) !important; overflow:hidden; }
    #dateform .select2-results__option--highlighted{ background:var(--accent) !important; }

    #dateform .col-md-12{
        position:absolute; top:-70px; right:0; width:auto !important; margin:0;
    }
    #dateform input[type="submit"]{
        -webkit-appearance:none; appearance:none;
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        color:#fff !important; padding:12px 26px !important; font-weight:600; font-size:14px;
        box-shadow:0 4px 14px rgba(124,92,250,0.3) !important; cursor:pointer;
    }
    #dateform input[type="submit"]:before{ font-family:"FontAwesome"; content:"\f002"; margin-right:8px; }
    #dateform input[type="submit"]:hover{ background:var(--accent-dark) !important; }

    /* ---------- Chart / table card headers ---------- */
    .box-header .btn{
        border-radius:20px !important; font-size:13px !important; font-weight:600; padding:8px 18px !important;
        border:none !important; box-shadow:none !important;
    }
    .box-header .btn-info{ background:var(--accent) !important; color:#fff !important; }
    .box-header .btn-info:hover{ background:var(--accent-dark) !important; }

    /* ---------- Badges / labels ---------- */
    .badge.bg-aqua{ background:#e6f7fb !important; color:#17a2b8 !important; font-weight:700; }
    .badge.bg-red{ background:#fdeaf1 !important; color:#e0457b !important; font-weight:700; }
    .badge.bg-yellow{ background:#fff4e2 !important; color:#e08a17 !important; font-weight:700; }
    .label-danger{ background:#fdeaf1 !important; color:#e0457b !important; font-weight:600; border-radius:20px; padding:.4em .9em; }
    .label-warning{ background:#fff4e2 !important; color:#e08a17 !important; font-weight:600; border-radius:20px; padding:.4em .9em; }

    /* ---------- Table ---------- */
    table.display{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    table.display thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:12px 14px !important;
    }
    table.display thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    table.display thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    table.display tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:12px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    table.display tbody tr:hover td{ background:var(--accent-light); }
    table.display tbody tr:last-child td{ border-bottom:none !important; }
    table.display a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    table.display a:hover{ color:var(--accent); text-decoration:underline; }

    .dt-button{
        width:auto !important; float:none !important; margin:0 0 12px 0 !important;
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:13px !important; font-weight:600; line-height:1 !important;
        padding:9px 16px !important; border-radius:var(--radius-sm) !important;
        background:#e6f9f0 !important; color:#1a9c74 !important;
        border:1px solid #cdeee1 !important; box-shadow:none !important;
    }
    .dt-button:hover{ background:#d8f4e9 !important; }

    .dataTables_filter{ margin-bottom:12px !important; }
    .dataTables_filter label{ display:flex !important; align-items:center; }
    .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px !important; font-size:13.5px !important; background:#fafafa !important; margin-left:8px;
    }
    .dataTables_filter input:focus{ border-color:var(--accent) !important; background:#fff !important; outline:none; }

    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 13px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background:var(--accent-light) !important; color:var(--accent) !important; border-color:var(--accent) !important;
    }
</style>

<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group filter-card">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-filter"></i></span>
                    <div>
                        <h3 class="box-title" style="display:block;">Filtrer par date</h3>
                        <p class="section-subtitle">Sélectionnez une période et d'autres critères</p>
                    </div>
                </div>
                <div class="filter-decor">
                    <i class="fa fa-calendar-o"></i>
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
            <div class="box-body">
                <form action="<?php echo $this->Html->url("/analyses/visite_dsm") ?>" method="post" id="dateform"
                    autocomplete="off">

                    <div class="input-group" style="margin-bottom:30px;width: 45%;">
                        <label for="reservationtime">Date</label>
                        <input type="text" class="form-control pull-right" value="<?php echo h($dateaafficherdansleview); ?>" name="date" id="reservationtime" placeholder="Rechercher">
                    </div>
                    <div class="input-group" style="margin-bottom:30px;width: 45%;">
                        <?php echo $this->Form->input('super', array('class' => "form-control pull-right choix_multi", 'label' => 'La liste des VM', 'options' => $supers, 'multiple' => true)); ?>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" value="Rechercher">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bar-chart"></i>Statistiques par superviseur</h3>
            </div>
            <div class="box-body">
                <canvas id="chartVisites" height="500"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-clipboard"></i></span>
                    <div>
                        <h3 class="box-title" style="display:block;">Résumé par superviseur</h3>
                        <p class="section-subtitle">Aperçu des performances et des visites</p>
                    </div>
                </div>
                <button class="btn btn-info" onclick="exportTableAsImage()">
                    <i class="fa fa-camera"></i> Exporter en image
                </button>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover display" id="tableContainer">
                    <thead>
                        <tr>
                            <th>Superviseur</th>
                            <th>Visites solo</th>
                            <th>Visites en double</th>
                            <th>Total des visites</th>
                            <th>Clients visités</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $super_id => $info): ?>
                            <tr>
                                <td><?= h($super_id) ?></td>
                                <td><span class="badge bg-aqua"><?= $info["solo"] ?></span></td>
                                <td><span class="badge bg-red"><?= $info["double"] ?></span></td>
                                <td><span class="badge bg-red"><?= $info["total"] ?></span></td>
                                <td><span class="badge bg-yellow"><?= $info["nb_client"] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-list-alt"></i>Détails des clients visités</h3>
            </div>
            <div class="box-body" style="max-height:500px; overflow-y:auto;">
                <table class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Superviseur</th>
                            <th>VMP</th>
                            <th>Client</th>
                            <th>Potentialité</th>
                            <th>Spécialité</th>
                            <th>Type de visite</th>
                            <th>Date de la visite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $super_id => $info): ?>
                            <?php foreach ($info["clients"] as $c): ?>
                                <tr>
                                    <td><?= h($super_id) ?></td>
                                    <td><?php echo $users[$c['Visite']['user_id']] ?></td>
                                    <td><?php echo  $this->Html->link($c['Client']['nom']." ".$c['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $c['Client']['id']),['target'=>'_blank']) ?></td>
                                    <td><?= h($c['Client']['potentialite']) ?></td>
                                    <td><?= h($c['Category']['name']) ?></td>
                                    <td>
                                        <?php if ($c['Visite']['type_visite'] == "double"): ?>
                                            <span class="label label-danger">Double</span>
                                        <?php else: ?>
                                            <span class="label label-warning">Solo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= h($c['Visite']['created']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- =======================
     Script Chart.js
======================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    async function exportTableAsImage() {
        const tableContainer = document.getElementById('tableContainer');

        try {
            // Show loading state
            const exportBtn = event.target;
            const originalHTML = exportBtn.innerHTML;
            exportBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Génération...';
            exportBtn.disabled = true;

            // Generate image
            const canvas = await html2canvas(tableContainer, {
                backgroundColor: '#ffffff',
                scale: 2,
                useCORS: true,
                allowTaint: true
            });

            // Download image directly
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'resume_superviseurs.png';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);

                // Reset button
                exportBtn.innerHTML = originalHTML;
                exportBtn.disabled = false;
            }, 'image/png', 1.0);

        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'export');

            // Reset button
            exportBtn.innerHTML = originalHTML;
            exportBtn.disabled = false;
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var ctx = document.getElementById("chartVisites").getContext("2d");

        var labels = <?= json_encode(array_keys($data)) ?>;
        var clients = <?= json_encode(array_map(function ($d) {
                            return $d["nb_client"];
                        }, $data)) ?>;
        var doubles = <?= json_encode(array_map(function ($d) {
                            return $d["double"];
                        }, $data)) ?>;
        var solos = <?= json_encode(array_map(function ($d) {
                        return $d["solo"];
                    }, $data)) ?>;
        var total = <?= json_encode(array_map(function ($d) {
                        return $d["total"];
                    }, $data)) ?>;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: "Nombre de clients visités",
                        backgroundColor: "#b39ef0",
                        data: clients,
                        categoryPercentage: 0.6,
                        barPercentage: 0.8
                    },
                    {
                        label: "Nombre de visites en double",
                        backgroundColor: "#f5a3c7",
                        data: doubles,
                        categoryPercentage: 0.6,
                        barPercentage: 0.8
                    },
                    {
                        label: "Nombre de visites solo",
                        backgroundColor: "#ffd873",
                        data: solos,
                        categoryPercentage: 0.6,
                        barPercentage: 0.8
                    },
                    {
                        label: "Total des visites",
                        backgroundColor: "#7fe3c9",
                        data: total,
                        categoryPercentage: 0.6,
                        barPercentage: 0.8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: false,
                        ticks: {
                            padding: 10
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    datalabels: {
                        anchor: 'end', // position du texte
                        align: 'end', // alignement (au-dessus)
                        color: '#333', // couleur du texte
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // activation du plugin
        });


    });
</script>
<?php
echo $this->Html->script('jquery.dataTables.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<?php
echo $this->Html->script('daterangepicker');
?>

<script>
(function ($) {
    try {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " -- ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function(e) {
                this.updateInputText();
            }
        });
    } catch (err) {
        console.error('daterangepicker init failed:', err);
    }

    try {
        $('.table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    } catch (err) {
        console.error('DataTable init failed:', err);
    }

    try {
        $('.choix_multi').select2({
            placeholder: "Sélectionner un ou plusieurs VM",
            width: '100%'
        });
    } catch (err) {
        console.error('select2 init failed:', err);
    }
})(jQuery);
</script>
