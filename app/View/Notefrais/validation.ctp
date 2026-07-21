<?php
$months = [
    '01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril',
    '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août',
    '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
];
?>

<style>
.notes-frais-panel {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border: 1px solid #eef0f5;
    overflow: hidden;
}

.notes-frais-panel .panel-heading {
    background: #fff !important;
    padding: 24px 24px 16px !important;
    border-bottom: none;
}

.notes-frais-panel .card-title {
    font-size: 18px;
    font-weight: 600;
    color: #2d2d3a;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.notes-frais-panel .card-title i {
    color: #6f5ce0;
    font-size: 20px;
}

.notes-frais-panel hr {
    border-top: 1px solid #eef0f5 !important;
    margin: 16px 0 0;
}

.notes-frais-panel .row-wrapper {
    padding: 24px;
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
}

.notes-frais-panel .col-lg-3 {
    padding: 10px;
}

.notes-frais-panel .small-box {
    border-radius: 12px;
    padding: 20px;
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    color: #fff;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.notes-frais-panel .small-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

.notes-frais-panel .small-box .inner h3 {
    font-size: 30px;
    font-weight: 700;
    margin: 0 0 4px;
}

.notes-frais-panel .small-box .inner p {
    font-size: 13px;
    margin: 0;
    opacity: 0.9;
}

.notes-frais-panel .small-box-footer {
    display: block;
    text-align: center;
    padding: 8px 0 0;
    margin-top: 12px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border-top: 1px solid rgba(255,255,255,0.25);
}

.notes-frais-panel .small-box-footer:hover {
    color: #fff;
    text-decoration: underline;
}

/* Palette pastel harmonisée au lieu des couleurs bg-info/success/warning/danger par défaut */
.notes-frais-panel .bg-info    { background: linear-gradient(135deg, #6fb8f0 0%, #4a9de0 100%) !important; }
.notes-frais-panel .bg-success { background: linear-gradient(135deg, #7fd9a8 0%, #4fc98a 100%) !important; }
.notes-frais-panel .bg-warning { background: linear-gradient(135deg, #f5c869 0%, #f0af3d 100%) !important; }
.notes-frais-panel .bg-danger  { background: linear-gradient(135deg, #f28b8b 0%, #e8615f 100%) !important; }
</style>

<div class="container">
    <div class="panel panel-default notes-frais-panel">
        <div class="panel-heading text-center">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                La liste des notes de frais à valider
            </h3>
            <hr>
        </div>
        <div class="row-wrapper">
        <?php
        $styles = ["bg-info", "bg-success", "bg-warning", "bg-danger"];
        foreach($moisCount as $mois => $nombre):

            $year = explode("_",$mois);
            $moisname = $months[$year[1]];
            $year=$year[0];
            $i = rand(0, 3);
        ?>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box <?php echo $styles[$i]; ?>">
                <div class="inner">
                    <h3><?php echo $nombre; ?></h3>
                    <p>Liste du mois de <?php echo $moisname . ' ' . $year; ?></p>
                </div>
                <?php echo $this->Html->link("Voir la liste", ["action" => "index", $valide, $mois], ["class" => "small-box-footer"]) ?>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>