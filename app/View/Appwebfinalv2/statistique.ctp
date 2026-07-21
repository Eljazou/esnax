<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        /* Premium Statistics Design */
        body {
            background-color: var(--bg, #f7faf8);
            margin: 0;
            padding: 0;
            font-family: var(--font-family, 'Inter', sans-serif);
        }

        /* Header */
        .page-header {
            background: #ffffff;
            padding: 24px 20px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
            border-bottom: 1px solid #d4e0d9;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-back {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f4f8f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a2e24;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #e6f5ee;
            color: #006241;
            text-decoration: none;
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a2e24;
            margin: 0;
        }

        /* Content Area */
        .content-container {
            padding: 24px 20px;
        }

        /* Custom Tabs */
        .premium-tabs {
            background: #ffffff;
            border-radius: 16px;
            padding: 6px;
            display: flex;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 50, 30, 0.03);
            border: 1px solid #d4e0d9;
            margin-bottom: 24px;
        }

        .premium-tab-btn {
            display: block;
            text-align: center;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #5a6b63;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }

        .premium-tab-btn.active {
            background: #006241;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 98, 65, 0.2);
        }

        .premium-tab-btn:hover:not(.active) {
            background: #f4f8f6;
        }

        /* Stats Grid */
        .stats-buttons-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-badge-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 12px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
            border: 1px solid #d4e0d9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .stat-badge-card:hover {
            transform: translateY(-2px);
        }

        .stat-badge-card.theme-0 {
            background: #e6f5ee;
            border-color: #00875A;
        }

        .stat-badge-card.theme-1 {
            background: #eaf2fd;
            border-color: #2b7de9;
        }

        .stat-badge-card.theme-2 {
            background: #fdf0ef;
            border-color: #d9534f;
        }

        .stat-badge-card.theme-3 {
            background: #fef9e7;
            border-color: #e6a817;
        }

        .stat-badge-card.theme-4 {
            background: #f0ecfa;
            border-color: #6f42c1;
        }

        .stat-badge-card.theme-5 {
            background: #e8f7fa;
            border-color: #17a2b8;
        }

        .stat-badge-val {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 4px;
            line-height: 1;
        }

        .stat-badge-card.theme-0 .stat-badge-val {
            color: #006241;
        }

        .stat-badge-card.theme-1 .stat-badge-val {
            color: #1e5ba8;
        }

        .stat-badge-card.theme-2 .stat-badge-val {
            color: #c9302c;
        }

        .stat-badge-card.theme-3 .stat-badge-val {
            color: #d39e00;
        }

        .stat-badge-card.theme-4 .stat-badge-val {
            color: #5a32a3;
        }

        .stat-badge-card.theme-5 .stat-badge-val {
            color: #117a8b;
        }

        .stat-badge-label {
            font-size: 13px;
            font-weight: 600;
            color: #5a6b63;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Charts Grid */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (min-width: 768px) {
            .charts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .chart-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
            border: 1px solid #d4e0d9;
            text-align: center;
        }

        .chart-title {
            font-size: 15px;
            font-weight: 700;
            color: #1a2e24;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .apexcharts-datalabel-value {
            font-family: 'Inter', sans-serif !important;
            font-weight: 800 !important;
            fill: #1a2e24 !important;
        }
    </style>
</head>

<body>

    <div class="page-header">
        <div class="header-top">
            <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back btn_spiner">
                <i data-lucide="chevron-left" style="width: 20px; height: 20px;"></i>
            </a>
            <h1 class="header-title">Statistiques</h1>
        </div>
    </div>

<div class="content-container">
    <!-- Tabs -->
    <ul class="nav premium-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" style="flex:1;">
            <a class="premium-tab-btn active" id="pills-jour-tab" data-toggle="pill" href="#pills-jour" role="tab">Par Jour</a>
        </li>
        <li class="nav-item" style="flex:1;">
            <a class="premium-tab-btn" id="pills-semaine-tab" data-toggle="pill" href="#pills-semaine" role="tab">Par Semaine</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        
        <!-- Onglet Par Jour -->
        <div class="tab-pane fade show active" id="pills-jour" role="tabpanel">
            <div class="stats-buttons-grid">
                <?php 
                $btnIndex = 0;
                foreach($data as $type => $values): 
                    if($type !== 'objectif'): 
                ?>
                        <div class="stat-badge-card theme-<?php echo $btnIndex % 6; ?>">
                            <div class="stat-badge-val"><?php echo $values['jour']; ?></div>
                            <div class="stat-badge-label"><?php echo $type; ?></div>
                        </div>
                <?php 
                    $btnIndex++;
                    endif;
                endforeach; 
                ?>
            </div>
            
            <div class="charts-grid">
                <?php 
                $chartIndex = 0;
                foreach($data as $type => $values): 
                    if($type !== 'objectif'): 
                ?>
                        <div class="chart-card">
                            <h2 class="chart-title"><?php echo $type; ?></h2>
                            <div id="chart-jour-<?php echo $chartIndex; ?>"></div>
                        </div>
                <?php 
                    $chartIndex++;
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
        
        <!-- Onglet Par Semaine -->
        <div class="tab-pane fade" id="pills-semaine" role="tabpanel">
            <div class="stats-buttons-grid">
                <?php 
                $btnIndex = 0;
                foreach($data as $type => $values): 
                    if($type !== 'objectif'): 
                ?>
                        <div class="stat-badge-card theme-<?php echo $btnIndex % 6; ?>">
                            <div class="stat-badge-val"><?php echo $values['nb_visiter']; ?></div>
                            <div class="stat-badge-label"><?php echo $type; ?></div>
                        </div>
                <?php 
                    $btnIndex++;
                    endif;
                endforeach; 
                ?>
            </div>
            
            <div class="charts-grid">
                <?php 
                $chartIndex = 0;
                foreach($data as $type => $values): 
                    if($type !== 'objectif'): 
                ?>
                        <div class="chart-card">
                            <h2 class="chart-title"><?php echo $type; ?></h2>
                            <div id="chart-semaine-<?php echo $chartIndex; ?>"></div>
                        </div>
                <?php 
                    $chartIndex++;
                    endif;
                endforeach; 
                ?>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
    lucide.createIcons();
    <?php 
    $chartDataJour = [];
    $chartDataSemaine = [];
    $chartIndex = 0;
    
    $colors = ['#006241', '#2b7de9', '#d9534f', '#e6a817', '#6f42c1', '#17a2b8'];
    
    foreach($data as $type => $values): 
        if($type !== 'objectif'): 
            $chartDataJour[] = [
                'type' => $type,
                'value' => $values['globaljour'] * 100,
                'index' => $chartIndex,
                'color' => $colors[$chartIndex % count($colors)]
            ];
            $chartDataSemaine[] = [
                'type' => $type,
                'value' => $values['objectifjour'] * 100,
                'index' => $chartIndex,
                'color' => $colors[$chartIndex % count($colors)]
            ];
            $chartIndex++;
        endif;
    endforeach;
    ?>

    // Default radial chart config
    function getChartConfig(value, color) {
        return {
            chart: { height: 220, type: "radialBar" },
            series: [value],
            colors: [color],
            plotOptions: {
                radialBar: {
                    hollow: { margin: 15, size: "65%" },
                    track: { background: "#f4f8f6" },
                    dataLabels: {
                        showOn: "always",
                        name: { show: false },
                        value: {
                            color: color,
                            fontSize: "20px",
                            show: true,
                            offsetY: 8,
                            formatter: function (val) {
                                return Math.round(val) + "%";
                            }
                        }
                    }
                }
            },
            stroke: { lineCap: "round" },
            labels: [""]
        };
    }

    // Init charts for 'Par Jour'
    <?php foreach($chartDataJour as $chart): ?>
        new ApexCharts(
            document.querySelector("#chart-jour-<?php echo $chart['index']; ?>"), 
            getChartConfig(<?php echo $chart['value']; ?>, "<?php echo $chart['color']; ?>")
        ).render();
    <?php endforeach; ?>

    // Init charts for 'Par Semaine'
    <?php foreach($chartDataSemaine as $chart): ?>
        new ApexCharts(
            document.querySelector("#chart-semaine-<?php echo $chart['index']; ?>"), 
            getChartConfig(<?php echo $chart['value']; ?>, "<?php echo $chart['color']; ?>")
        ).render();
    <?php endforeach; ?>
</script>

</body>
</html>