<div class="row">
    <?php
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @media (max-width: 980px){
            .tablebox{margin-top:0px !important;}
        }
        .stv-wrapper{
            font-family:'Poppins',sans-serif;
            color:#3a3a4a;
        }
        .stv-wrapper .box{
            background:#fff;
            border:none;
            border-radius:18px;
            box-shadow:0 4px 24px rgba(108,99,245,0.08);
            padding:26px 28px;
        }
        .stv-wrapper .box-header{
            border:none;
            display:flex;
            align-items:center;
            gap:16px;
            padding:0;
        }
        .stv-wrapper .stv-icon-badge{
            width:44px;
            height:44px;
            min-width:44px;
            border-radius:13px;
            background:linear-gradient(135deg,#efeeff,#e3e0ff);
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .stv-wrapper .stv-icon-badge svg{
            width:20px;
            height:20px;
            stroke:#6C63F5;
        }
        .stv-wrapper .box-title{
            font-size:15.5px;
            font-weight:500;
            color:#454358;
            float:none;
            width:auto;
        }
        .stv-wrapper #dateform{
            width:100%;
        }
        .stv-wrapper .input-group{
            width:100%;
            border:1.5px solid #e7e5f7;
            border-radius:12px;
            overflow:hidden;
            background:#fff;
        }
        .stv-wrapper .input-group-addon{
            background:#faf9ff;
            border:none;
            border-right:1.5px solid #e7e5f7;
            color:#6C63F5;
        }
        .stv-wrapper .input-group .form-control{
            border:none;
            box-shadow:none;
            font-size:14px;
            padding:11px 16px;
        }
        .stv-wrapper .input-group .form-control:focus{
            box-shadow:none;
        }
        .stv-chart-row{
            display:flex;
            gap:24px;
            align-items:stretch;
            flex-wrap:wrap;
        }
        .stv-chart-col{
            flex:2.2;
            min-width:320px;
        }
        .stv-stats-col{
            flex:1;
            min-width:260px;
            display:flex;
            flex-direction:column;
            gap:16px;
        }
        .stv-chart-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:14px;
        }
        .stv-chart-title-group{
            display:flex;
            align-items:center;
            gap:14px;
        }
        .stv-chart-heading{
            font-size:17px;
            font-weight:600;
            color:#2d2b45;
            margin:0;
        }
        .stv-chart-subtitle{
            font-size:12.5px;
            color:#9a97b3;
            margin-top:2px;
        }
        .stv-wrapper .btn-primary.btn-click,
        .stv-wrapper a.btn-click{
            background:#f1effe !important;
            color:#6C63F5 !important;
            border:none !important;
            border-radius:999px !important;
            font-weight:600;
            font-size:13px;
            padding:8px 18px !important;
            display:inline-flex;
            align-items:center;
            gap:6px;
            float:none !important;
            position:static !important;
        }
        .stv-stat-card{
            border-radius:16px;
            padding:18px 20px;
            display:flex;
            align-items:flex-start;
            gap:14px;
        }
        .stv-stat-card .stv-stat-icon{
            width:38px;
            height:38px;
            min-width:38px;
            border-radius:11px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .stv-stat-card .stv-stat-icon svg{
            width:18px;
            height:18px;
        }
        .stv-stat-card .stv-stat-label{
            font-size:12.5px;
            color:#6a6785;
            margin-bottom:4px;
        }
        .stv-stat-card .stv-stat-value{
            font-size:22px;
            font-weight:700;
            color:#2d2b45;
        }
        .stv-stat-card.purple{background:#f4f2ff;}
        .stv-stat-card.purple .stv-stat-icon{background:#e3e0ff;}
        .stv-stat-card.purple .stv-stat-icon svg{stroke:#6C63F5;}
        .stv-stat-card.blue{background:#eef5fd;}
        .stv-stat-card.blue .stv-stat-icon{background:#dbebfc;}
        .stv-stat-card.blue .stv-stat-icon svg{stroke:#3b82f6;}
        .stv-stat-card.green{background:#eaf9f2;}
        .stv-stat-card.green .stv-stat-icon{background:#d6f3e4;}
        .stv-stat-card.green .stv-stat-icon svg{stroke:#22b573;}
        .stv-stat-card.orange{background:#fdf3e9;}
        .stv-stat-card.orange .stv-stat-icon{background:#fbe4cd;}
        .stv-stat-card.orange .stv-stat-icon svg{stroke:#f0923d;}
        .stv-wrapper .boxlistes table.dataTable thead th{
            background:#faf9ff;
            color:#4a4863;
            font-weight:600;
            font-size:13.5px;
            border-bottom:2px solid #ece9fb;
        }
        .stv-wrapper .boxlistes table.dataTable tbody td{
            font-size:14px;
            color:#454358;
            vertical-align:middle;
        }
        .stv-wrapper .boxlistes table.dataTable.table-striped tbody tr.odd{
            background:#fbfaff;
        }
        .stv-wrapper .table.table-bordered.table-striped{
            border:1px solid #eeecf9;
            border-radius:12px;
            overflow:hidden;
        }
        .stv-wrapper td:first-child{
            color:#6C63F5;
            font-weight:600;
        }
        .stv-wrapper .btn.bg-blue{
            background:transparent !important;
            color:#6C63F5 !important;
            border:1.5px solid #d8d3fb !important;
            border-radius:999px !important;
            font-weight:600;
            font-size:13px;
            padding:6px 16px !important;
            display:inline-flex;
            align-items:center;
            gap:5px;
            transition:background .15s ease;
        }
        .stv-wrapper .btn.bg-blue:hover{
            background:#f1effe !important;
        }
        .stv-wrapper h1{
            font-size:19px;
            font-weight:600;
            color:#2d2b45;
            margin:28px 0 14px 0;
        }

        /* ---------- Custom date-range picker (vanilla JS, no external dependency) ---------- */
        .stv-wrapper .date-field-wrap{ position:relative; width:100%; }
        .stv-wrapper input.lb-date-input{
            cursor:pointer;
            background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%236C63F5' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none'/><path d='M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM7 11h5v5H7z'/></svg>") no-repeat right 14px center !important;
            background-size:15px 15px !important;
        }
        .lb-cal-popup{
            position:absolute; z-index:9999; background:#fff; border:1px solid #e7e5f7;
            border-radius:16px; box-shadow:0 10px 34px rgba(108,99,245,0.18);
            padding:16px; width:auto; font-family:'Poppins',sans-serif; -webkit-user-select:none; user-select:none;
        }
        .lb-cal-panels{ display:flex; gap:22px; }
        .lb-cal-panel{ width:240px; }
        .lb-cal-panel + .lb-cal-panel{ border-left:1px solid #f1effe; padding-left:22px; }
        .lb-cal-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
        .lb-cal-title{ font-weight:600; color:#2d2b45; font-size:14.5px; text-transform:capitalize; }
        .lb-cal-nav{
            border:none; background:#f1effe; color:#6C63F5; width:28px; height:28px;
            border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center;
            line-height:1; padding:0;
        }
        .lb-cal-nav:hover{ background:#e3e0ff; }
        .lb-cal-nav-spacer{ width:28px; height:28px; display:inline-block; }
        .lb-cal-range-preview{
            display:flex; justify-content:space-between; gap:8px; margin-top:14px;
            background:#faf9ff; border:1px solid #eeecf9; border-radius:10px; padding:8px 10px;
            font-size:12px; color:#6a6785;
        }
        .lb-cal-range-preview b{ color:#2d2b45; font-weight:600; }
        .lb-cal-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
        .lb-cal-weekdays span{ font-size:11px; font-weight:700; color:#6C63F5; text-transform:uppercase; }
        .lb-cal-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
        .lb-cal-day{
            border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px;
            color:#3a3a4a; cursor:pointer;
        }
        .lb-cal-day:hover{ background:#e3e0ff; }
        .lb-cal-day.other-month{ color:#8b87a8; opacity:.5; }
        .lb-cal-day.today{ box-shadow:inset 0 0 0 1px #3fb37f; }
        .lb-cal-day.in-range{ background:#efeeff !important; border-radius:0; color:#2d2b45; }
        .lb-cal-day.range-start, .lb-cal-day.range-end{
            background:#6C63F5 !important; color:#fff !important; font-weight:700;
        }
        .lb-cal-day.range-start{ border-top-left-radius:8px; border-bottom-left-radius:8px; }
        .lb-cal-day.range-end{ border-top-right-radius:8px; border-bottom-right-radius:8px; }
        .lb-cal-footer{ display:flex; justify-content:space-between; align-items:center; margin-top:10px; border-top:1px solid #eeecf9; padding-top:10px; }
        .lb-cal-clear-btn{
            border:none; background:none; color:#8b87a8; font-size:12.5px; font-weight:600; cursor:pointer;
            padding:6px 9px; border-radius:8px;
        }
        .lb-cal-clear-btn:hover{ background:#faf9ff; color:#2d2b45; }
        .lb-cal-actions{ display:flex; gap:8px; }
        .lb-cal-cancel-btn, .lb-cal-apply-btn{
            border:none; font-size:12.5px; font-weight:600; cursor:pointer;
            padding:7px 14px; border-radius:999px;
        }
        .lb-cal-cancel-btn{ background:#f1effe; color:#6a6785; }
        .lb-cal-cancel-btn:hover{ background:#e3e0ff; }
        .lb-cal-apply-btn{ background:#6C63F5; color:#fff; }
        .lb-cal-apply-btn:hover{ background:#5a51e0; }
    </style>
    <div class="stv-wrapper" style="width:100%;">
    <div class="col-md-12" style="margin-bottom: 24px;"> 
        <div class="box form-group">
            <div class="box-header with-border">
                <div class="stv-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <label class="box-title" style="margin-top: 0;padding-left:0;margin-bottom: 0px;">Pour des statistiques d'une période précise, veuillez sélectionner une date :</label>
                <div class="col-md-6">
                    <form action="/clients/statistique_visites<?php if($user_id!=0) echo "/$user_id"; ?>" method="get" id="dateform">
                        <div class="input-group col-lg-12" style="float:left;">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="date-field-wrap">
                                <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right lb-date-input" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Nombre de visites', 'Nombre de clients visités'],
<?php
foreach ($visites as $visite) {


    echo "[ " . $visite['visite']['nbvisite'] . " , " . $visite[0]['nbclientvisiter'] . " ],";
}
?>
            ]);

            var options = {
                chart: {
                    title: 'Performance des visites de <?php echo $date_debut . ' à ' . $date_fin; ?> ',

                },
                colors: ['#6C63F5']
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, options);
        }
    </script>
    <?php
    /* Simple display-only aggregates derived from the existing $visites data, added purely for the
       summary cards below. No existing business logic is modified. */
    $stv_total_clients = 0;
    $stv_total_visites = 0;
    foreach ($visites as $visite) {
        $stv_total_clients += (int)$visite[0]['nbclientvisiter'];
        $stv_total_visites += (int)$visite['visite']['nbvisite'] * (int)$visite[0]['nbclientvisiter'];
    }
    $stv_moyenne = $stv_total_clients > 0 ? round($stv_total_visites / $stv_total_clients, 2) : 0;
    ?>
    <div class="col-md-12">
        <div class="stv-chart-row">
            <div class="stv-chart-col">
                <div class="box" style="height:100%;">
                    <div class="box-body" style="padding:0;">
                        <div class="stv-chart-header">
                            <div class="stv-chart-title-group">
                                <div class="stv-icon-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></svg>
                                </div>
                                <div>
                                    <p class="stv-chart-heading">Performance des visites</p>
                                    <div class="stv-chart-subtitle">Période : <?php echo $date_debut . ' à ' . $date_fin; ?></div>
                                </div>
                            </div>
                            <?php if ( $type == 0) : ?>
                                <a href="" class="btn-click btn btn-primary btn-md">Statistiques des VM</a>
                            <?php endif; ?>
                        </div>
                        <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
            <div class="stv-stats-col">
                <div class="stv-stat-card purple">
                    <div class="stv-stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="stv-stat-label">Total clients visités</div>
                        <div class="stv-stat-value"><?php echo number_format($stv_total_clients, 0, ',', ' '); ?></div>
                    </div>
                </div>
                <div class="stv-stat-card blue">
                    <div class="stv-stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div>
                        <div class="stv-stat-label">Nombre total de visites</div>
                        <div class="stv-stat-value"><?php echo number_format($stv_total_visites, 0, ',', ' '); ?></div>
                    </div>
                </div>
                <div class="stv-stat-card green">
                    <div class="stv-stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <div>
                        <div class="stv-stat-label">Moyenne de visites par client</div>
                        <div class="stv-stat-value"><?php echo str_replace('.', ',', $stv_moyenne); ?></div>
                    </div>
                </div>
                <div class="stv-stat-card orange">
                    <div class="stv-stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="stv-stat-label">Clients avec 1+ visite</div>
                        <div class="stv-stat-value"><?php echo number_format($stv_total_clients, 0, ',', ' '); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="margin-top:24px;">
        <div class="box">
            <div class="box-body boxlistes">
                <table id="example1" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Nombre de visites</th>
                            <th>Nombre de clients visités</th>
                            <th>Détail</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>0</td>
                        <td></td>
                        <td><?php
                            if ($this->requestAction('/droits/getrole/clients/detail_visites') == 1)
                                if ($type == 0)
                                    echo $this->Html->link('Détail', array('action' => 'detail_visites', 0, $date_debut, $date_fin), array('class' => "btn bg-blue btn-flat", 'style' => "float:right;"));
                                else
                                    echo $this->Html->link('Détail', array('action' => 'detail_visites', 0, $date_debut, $date_fin, $user_id), array('class' => "btn bg-blue btn-flat", 'style' => "float:right;"));
                            ?></td>
                    </tr>
                    <?php
                    foreach ($visites as $visite) {
                        $nbvisite = $visite['visite']['nbvisite'];
                        $nbclientvisiter = $visite[0]['nbclientvisiter'];
                        ?>
                        <tr>
                            <td><?php echo $nbvisite; ?></td>
                            <td><?php echo $nbclientvisiter; ?></td>
                            <td><?php
                                if ($this->requestAction('/droits/getrole/clients/detail_visites') == 1)
                                    if ($user_id == 0)
                                        echo $this->Html->link('Détail', array('action' => 'detail_visites', $nbvisite, $date_debut, $date_fin), array('class' => "btn bg-blue btn-flat", 'style' => "float:right;"));
                                    else
                                        echo $this->Html->link('Détail', array('action' => 'detail_visites', $nbvisite, $date_debut, $date_fin, $user_id), array('class' => "btn bg-blue btn-flat", 'style' => "float:right;"));
                                ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
	<?php if(isset($super)) : ?>
	<h1>La listes des Super viseur</h1>
	 <div class="col-md-12">
        <div class="box">
            <div class="box-body boxlistes">
                <table id="example1" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Nom</th>
                            <th>Détail</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($super as $s) {
                        ?>
                        <tr>
                            <td><?php echo $s["User"]["name"]; ?></td>
                            <td><?php  echo $this->Html->link('Détail', array('action' => 'statistique_visites',$s["User"]["id"]), array('class' => "btn bg-blue btn-flat", 'style' => "float:right;")); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
	<?php endif; ?>

	
	
</div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
?>

<script>
        $(function () {
            $('#example1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "iDisplayLength": 250,
                "aaSorting": []
            });
        });
        //document.getElementById('note').innerHTML = '<?php //echo $notetotal;          ?>';

        // ---------- Custom date-range picker (vanilla JS, no external dependency) ----------
        // Replaces the old daterangepicker plugin, which was throwing
        // "e.indexOf is not a function" / "reading 'options'" and never opened.
        // Self-contained, built in its own IIFE so it can never be blocked
        // by an unrelated script/plugin failing to load. Shows two months
        // side by side (current + next), like a typical range picker.
        (function() {
            var MONTH_NAMES = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
            var WEEKDAYS = ['Lu','Ma','Me','Je','Ve','Sa','Di'];

            function pad2(n){ return (n < 10 ? '0' : '') + n; }

            function parseISO(val) {
                if (!val) return null;
                var parts = val.split('-');
                if (parts.length !== 3) return null;
                var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
                return isNaN(d.getTime()) ? null : d;
            }

            function formatISO(d) {
                return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
            }

            function formatDisplay(d) {
                return pad2(d.getDate()) + '/' + pad2(d.getMonth() + 1) + '/' + d.getFullYear();
            }

            function sameDay(a, b) {
                return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
            }

            function stripTime(d) {
                var c = new Date(d);
                c.setHours(0, 0, 0, 0);
                return c;
            }

            function LBRangeCalendar(input, form) {
                this.input = input;
                this.form = form;
                this.popup = null;

                var initial = (input.value || '').split('--');
                var start = parseISO((initial[0] || '').trim());
                var end = parseISO((initial[1] || '').trim());

                this.start = start;
                this.end = end;
                this.viewDate = start ? new Date(start) : new Date();
                this._outsideHandler = null;
                this._reflowHandler = null;
                this.bind();
            }

            LBRangeCalendar.prototype.bind = function() {
                var self = this;
                this.input.setAttribute('readonly', 'readonly');
                this.input.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (self.popup) { self.close(); } else { self.open(); }
                });
            };

            LBRangeCalendar.prototype.open = function() {
                var self = this;
                this.popup = document.createElement('div');
                this.popup.className = 'lb-cal-popup';
                document.body.appendChild(this.popup);
                this.position();
                this.render();

                this._outsideHandler = function(e) {
                    if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) {
                        self.close();
                    }
                };
                this._reflowHandler = function() { self.position(); };

                setTimeout(function() {
                    document.addEventListener('click', self._outsideHandler);
                    window.addEventListener('resize', self._reflowHandler);
                    window.addEventListener('scroll', self._reflowHandler, true);
                }, 0);
            };

            LBRangeCalendar.prototype.position = function() {
                if (!this.popup) return;
                var rect = this.input.getBoundingClientRect();
                this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
                this.popup.style.left = (window.scrollX + rect.left) + 'px';
            };

            LBRangeCalendar.prototype.close = function() {
                if (this.popup) {
                    this.popup.parentNode.removeChild(this.popup);
                    this.popup = null;
                }
                if (this._outsideHandler) {
                    document.removeEventListener('click', this._outsideHandler);
                    this._outsideHandler = null;
                }
                if (this._reflowHandler) {
                    window.removeEventListener('resize', this._reflowHandler);
                    window.removeEventListener('scroll', this._reflowHandler, true);
                    this._reflowHandler = null;
                }
            };

            LBRangeCalendar.prototype.submit = function() {
                if (!this.start || !this.end) return;
                var a = this.start <= this.end ? this.start : this.end;
                var b = this.start <= this.end ? this.end : this.start;
                var startStr = formatISO(a);
                var endStr = formatISO(b);
                this.input.value = startStr + ' -- ' + endStr;

                var action = this.form.getAttribute('action').split('?')[0];
                this.form.setAttribute('action', action + '?date=' + startStr + '--' + endStr);
                this.form.submit();
            };

            // Builds the HTML for a single month grid (used twice per render, side by side)
            function buildMonthPanel(year, month, a, b, today, navSide) {
                var html = '<div class="lb-cal-panel">';
                html += '<div class="lb-cal-header">';
                if (navSide === 'left') {
                    html += '<button type="button" class="lb-cal-nav" data-nav="prev">&#8249;</button>';
                } else {
                    html += '<span class="lb-cal-nav-spacer"></span>';
                }
                html += '<span class="lb-cal-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
                if (navSide === 'right') {
                    html += '<button type="button" class="lb-cal-nav" data-nav="next">&#8250;</button>';
                } else {
                    html += '<span class="lb-cal-nav-spacer"></span>';
                }
                html += '</div>';

                html += '<div class="lb-cal-weekdays">';
                WEEKDAYS.forEach(function(w) { html += '<span>' + w + '</span>'; });
                html += '</div>';
                html += '<div class="lb-cal-grid">';

                var firstDay = new Date(year, month, 1);
                var startOffset = (firstDay.getDay() + 6) % 7; // Monday = 0
                var daysInMonth = new Date(year, month + 1, 0).getDate();
                var daysInPrevMonth = new Date(year, month, 0).getDate();
                var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

                for (var i = 0; i < totalCells; i++) {
                    var dayNum, cellDate, otherMonth = false;
                    if (i < startOffset) {
                        dayNum = daysInPrevMonth - startOffset + i + 1;
                        cellDate = new Date(year, month - 1, dayNum);
                        otherMonth = true;
                    } else if (i >= startOffset + daysInMonth) {
                        dayNum = i - startOffset - daysInMonth + 1;
                        cellDate = new Date(year, month + 1, dayNum);
                        otherMonth = true;
                    } else {
                        dayNum = i - startOffset + 1;
                        cellDate = new Date(year, month, dayNum);
                    }

                    var classes = ['lb-cal-day'];
                    if (otherMonth) classes.push('other-month');
                    if (sameDay(cellDate, today)) classes.push('today');

                    if (a && sameDay(cellDate, a)) classes.push('range-start');
                    if (b && sameDay(cellDate, b)) classes.push('range-end');
                    if (a && b && cellDate > a && cellDate < b) classes.push('in-range');

                    html += '<button type="button" class="' + classes.join(' ') + '" data-date="' + formatISO(cellDate) + '">' + dayNum + '</button>';
                }

                html += '</div></div>';
                return html;
            }

            LBRangeCalendar.prototype.render = function() {
                var self = this;
                var leftYear = this.viewDate.getFullYear();
                var leftMonth = this.viewDate.getMonth();
                var rightRef = new Date(leftYear, leftMonth + 1, 1);
                var rightYear = rightRef.getFullYear();
                var rightMonth = rightRef.getMonth();
                var today = stripTime(new Date());

                var a = this.start && this.end ? (this.start <= this.end ? this.start : this.end) : this.start;
                var b = this.start && this.end ? (this.start <= this.end ? this.end : this.start) : this.end;

                var html = '';
                html += '<div class="lb-cal-panels">';
                html += buildMonthPanel(leftYear, leftMonth, a, b, today, 'left');
                html += buildMonthPanel(rightYear, rightMonth, a, b, today, 'right');
                html += '</div>';

                html += '<div class="lb-cal-range-preview">';
                html += '<span>De : <b>' + (a ? formatDisplay(a) : '--') + '</b></span>';
                html += '<span>à : <b>' + (b ? formatDisplay(b) : '--') + '</b></span>';
                html += '</div>';

                html += '<div class="lb-cal-footer">';
                html += '<button type="button" class="lb-cal-clear-btn" data-action="clear">Effacer</button>';
                html += '<div class="lb-cal-actions">';
                html += '<button type="button" class="lb-cal-cancel-btn" data-action="cancel">Annuler</button>';
                html += '<button type="button" class="lb-cal-apply-btn" data-action="apply">Valider</button>';
                html += '</div>';
                html += '</div>';

                this.popup.innerHTML = html;

                var navBtns = this.popup.querySelectorAll('[data-nav]');
                for (var n = 0; n < navBtns.length; n++) {
                    navBtns[n].addEventListener('click', function(e) {
                        e.stopPropagation();
                        var dir = this.getAttribute('data-nav');
                        self.viewDate.setMonth(self.viewDate.getMonth() + (dir === 'next' ? 1 : -1));
                        self.render();
                        self.position();
                    });
                }

                var dayBtns = this.popup.querySelectorAll('.lb-cal-day');
                for (var d = 0; d < dayBtns.length; d++) {
                    dayBtns[d].addEventListener('click', function(e) {
                        e.stopPropagation();
                        var val = parseISO(this.getAttribute('data-date'));

                        if (!self.start || (self.start && self.end)) {
                            // start a fresh selection
                            self.start = val;
                            self.end = null;
                        } else {
                            // second click completes the range
                            self.end = val;
                        }
                        self.render();
                    });
                }

                var clearBtn = this.popup.querySelector('[data-action="clear"]');
                if (clearBtn) {
                    clearBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        self.start = null;
                        self.end = null;
                        self.render();
                    });
                }

                var cancelBtn = this.popup.querySelector('[data-action="cancel"]');
                if (cancelBtn) {
                    cancelBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        self.close();
                    });
                }

                var applyBtn = this.popup.querySelector('[data-action="apply"]');
                if (applyBtn) {
                    applyBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        self.close();
                        self.submit();
                    });
                }
            };

            function initPicker() {
                var el = document.getElementById('reservationtime');
                var form = document.getElementById('dateform');
                if (el && form && !el._lbRangeCalendar) {
                    el._lbRangeCalendar = new LBRangeCalendar(el, form);
                }
            }

            if (document.readyState === 'interactive' || document.readyState === 'complete') {
                initPicker();
            } else {
                document.addEventListener('DOMContentLoaded', initPicker);
            }
        })();

        function boxtog() {
            $('.boxlistes').toggle(300);
            var clas = $("#icon").attr("class");
            if (clas == 'fa fa-minus') {
                $("#icon").attr("class", "fa fa-plus");
            }
            if (clas == 'fa fa-plus') {
                $("#icon").attr("class", "fa fa-minus");
            }
        }
        $(window).load(function () {
            var lien = location.href;
            if (lien.indexOf("date") !== -1)
                $('.btn-click').attr('href', lien + '&type=1');
            else
                $('.btn-click').attr('href', lien + '?type=1');
        });
</script>
