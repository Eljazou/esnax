<style>
    .brochure {
        float: left;
        width: 23.20%;
        height: auto;
        border-bottom: 2px solid #000000;
        padding-bottom: 4px;
        background: #fff;
        box-shadow: 0px 0px 4px #555;
        margin: 9px;
        padding: 0px;
    }
    .brochure h1 {
        z-index: 999;
        float: right;
        margin-top: -1px !important;
        padding: 2px 6px;
        display: block;
        height: 38px;
        width: 102%;
        color: #FFF !important;
        font-size: 20px !important;
        text-align: center;
        margin-right: -5px;
        line-height: 28px;
        border-right: 5px solid #3c8dbc;
        position: relative;
        background: rgba(26, 25, 25, 0.64) !important;
    }
    .brochure b {
        z-index: 999;
        position: relative;
        width: 100%;
        font-size: 19px;
        text-align: center;
    }
    .brochure p{color: #fff;font-size: 15px;line-height: 23px;font-weight: normal;width: 96%;padding: 5px;text-align: left;	float: right;background: rgba(0, 0, 0, 0.45);margin-top: -79px;border-left: 5px solid #E1483F;z-index: 999;position: relative;max-height: 69px;}
    .brochure span{width: auto;height: auto;padding: 3px 8px 3px 8px;font-size: 18px !important;text-align: left;border-left: 6px solid #4F4F4F;margin-bottom: 15px;color: rgb(51, 145, 199); float: left;margin-right: 10px;line-height: 40px;z-index: 9999;margin-top: 10px;position: relative;}
    .brochure span b { margin: 0px; font-size: 16px;}
    .brochure .prix {float: left;}
    .brochure .surface {float: right;margin-right: 0px;border-left: 0px;border-right: 6px solid #4F4F4F;}
    .brochure .labeltype {width: 90px;height: 90px;float: left;z-index: 999;position: relative;margin-top: -170px;opacity: 0.7;}
    .brochure .supannonce {width: 35px; height: 35px; float: right; background: rgba(0, 0, 0, 0.98);border-radius: 45px;z-index: 9999;position: relative; margin-top: -165px; margin-right: 5px; display: none; transition: 1.5s;opacity:0;}
    .supannonce a {color: #fff;width: 100%;height: 100%;text-align: center;float: left;line-height: 35px;font-size: 23px;}
    .brochure:hover .supannonce, .brochure:hover .voirannonce, .brochure:hover .modannonce, .brochure:hover k{display:block;transition:1.5s;opacity:1;}
    .brochure:hover .voirannonce, .brochure:hover .modannonce {
        margin-top: -147px;
        transition: 0.4s;
        z-index: 99999;
        opacity: 1;
    }
    .brochure:hover .voirannonce a, .brochure:hover .modannonce a, .modannonce a, .voirannonce a {
        color: #fff !important;
        width: 100%;
        text-align: center;
        float: left;
        line-height: 44px;
        font-size: 21px;
        text-decoration: none !important;
    }
    .brochure:hover {
        border-bottom: 2px solid rgb(60, 141, 188);
        transition: 2s;
    }
    .brochure .voirannonce {
        width: 45px;
        height: 45px;
        float: left;
        background: rgba(0, 0, 0, 0.98);
        border-radius: 45px;
        z-index: -9;
        position: relative;
        margin-top: -38px;
        margin-left: 47px;
        display: block;
        transition: 0.5s;
        opacity: 0;
    }
    .brochure .modannonce {
        width: 45px;
        height: 45px;
        float: right;
        background: rgba(0, 0, 0, 0.98);
        border-radius: 45px;
        z-index: -99;
        position: relative;
        margin-top: -38px;
        margin-right: 47px;
        display: block;
        transition: 0.5s;
        opacity: 0;
    }
    .brochure .voirannonce:hover, .brochure .supannonce:hover, .brochure .modannonce:hover {
        background: rgb(60, 141, 188);
        transition: 1s;
        color: #fff !important;
    }
</style>
<?php echo $this->Html->css('dataTables.bootstrap');
?>	
<div class="col-md-12" style="float:none;margin:auto;">
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title"><?php echo __('La liste des brochures'); ?></h2>
        </div>
        <div class="box-body">
            <?php
            $i = 0;
            foreach ($brochures as $b): if ($i % 3 == 0 && $i != 0)
                    echo "</tr><tr>";$i++;
                ?>
                <a href="img/brochures/<?php echo $b['brochures']['file']; ?>" target="_blanck">
                    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom:10px;">
                        <div class="info-box" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.1) !important;">
                            <span class="info-box-icon bg-aqua-active"><i class="fa fa-bold"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text" style="color:#444;text-decoration:none;">Spécialité : <?php echo $b['categories']['name']; ?></span>
                                <span class="info-box-text" style="color:#444;text-decoration:none;"><?php echo $b['brochures']['name']; ?></span>
                                <span class="info-box-text" style="color:#444;text-decoration:none;">Nombre de fois présenté : <?php echo $b[0]['count(brochures.id)']; ?></span>
                                <span class="info-box-text" style="color:#444;text-decoration:none;">Temps moyen passé : <?php echo round($b[0]['sum(temps.durree)']/$b[0]['count(brochures.id)'],1); ?> Min</span>
                                <span class="info-box-text" style="margin-top:5px;"></span>
                            </div>
							<a href="img/brochures/<?php echo $b['brochures']['file']; ?>" target="_blanck" class="btn btn-primary btn-sm bg-light-blue" style="background: #fff !important;border: none;float: right;box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.11); */background-color: white;margin-top: -5px;color: #00a7d0 !important;">Visualiser</a>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

