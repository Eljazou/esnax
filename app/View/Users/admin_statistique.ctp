<?php echo $this->Html->css('dataTables.bootstrap');
?>	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
    .dt-button:hover{color:#fff;background:#1a486f;}
</style>
<div class="row">
    <?php
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    $sdata = array();
    ?>
    <style>
        @media (max-width: 980px){
            .tablebox{margin-top:0px !important;}
        }
        .modal .objet, .objet {
            padding: 0px;
            float: left;
            width: 100%;
            margin-right: 3px;
            margin-left: 0px;
            border: 1px solid #337ab7;
        }
        .modal .objet .optionh, .objet .optionh {
            min-width: 80px;
            width: 100%;
            float: left;
            border-radius: 0px;
            padding: 2px 0px 2px 5px;
            color: #337ab7;
            border-bottom: 1px solid;
            background: none;
            z-index: 99;
            position: relative;
        }
        .modal .objet .optionh .fa, .objet .optionh .fa {
            float: right;
            height: 100%;
            width: 25px;
            text-align: center;
            line-height: 20px;
            border-left: 1px solid;
            padding: 2px;
            cursor: pointer;
            margin-left: 2px;
        }
        .modal .objet .optionb, .objet .optionb {
            min-width: 80px;
            width: 100%;
            left: 0px;
            border-radius: 5px;
            padding: 7px 8px;
            margin-bottom: 4px;
            display: none;
            background: none;
            list-style: none;
            color: #337ab7;
            position: relative;
            z-index: 9;
            text-shadow: none !important;
            margin: 0px;
            box-shadow: none !important;
        }
        .modal .objet .optionb li, .objet .optionb li {
            color: #337ab7;
            text-shadow: none;
            border-bottom: 1px dashed;
        }

        /* ===== Design system restyle (avs) ===== */
        .avs-wrapper{
            font-family:'Poppins',sans-serif;
            color:#3a3a4a;
        }
        .avs-wrapper .box{
            background:#fff;
            border:none;
            border-radius:18px;
            box-shadow:0 4px 24px rgba(108,99,245,0.08);
        }
        .avs-wrapper .row > .col-md-12 > .box{
            padding:0;
            overflow:hidden;
        }
        .avs-icon-badge{
            width:52px;
            height:52px;
            min-width:52px;
            border-radius:50%;
            background:linear-gradient(135deg,#efeeff,#e3e0ff);
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .avs-icon-badge svg{
            width:24px;
            height:24px;
            stroke:#6C63F5;
        }
        /* date filter banner */
        .avs-datebanner{
            background:linear-gradient(90deg,#f4f2ff,#eceaff);
            border-radius:18px;
            padding:26px 30px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:24px;
            flex-wrap:wrap;
        }
        .avs-datebanner-left{
            display:flex;
            align-items:center;
            gap:18px;
        }
        .avs-datebanner-title{
            font-size:16.5px;
            font-weight:600;
            color:#2d2b45;
            margin:0;
        }
        .avs-datebanner-sub{
            font-size:13.5px;
            color:#8b87a8;
            margin-top:2px;
        }
        .avs-wrapper #dateform{
            min-width:280px;
        }
        .avs-wrapper .input-group{
            border:1.5px solid #ded9fb;
            border-radius:12px;
            overflow:hidden;
            background:#fff;
        }
        .avs-wrapper .input-group-addon{
            background:#faf9ff;
            border:none;
            border-right:1.5px solid #ded9fb;
            color:#6C63F5;
        }
        .avs-wrapper .input-group .form-control{
            border:none;
            box-shadow:none;
            font-size:14px;
            padding:11px 16px;
        }
        /* Liste des visites banner */
        .avs-listbanner{
            background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
            border-radius:18px;
            padding:24px 30px;
            display:flex;
            align-items:center;
            gap:18px;
        }
        .avs-listbanner-title{
            font-size:22px;
            font-weight:700;
            color:#2d2b45;
            margin:0;
        }
        .avs-listbanner .avs-icon-badge{
            background:linear-gradient(135deg,#6C63F5,#8c7ef2);
        }
        .avs-listbanner .avs-icon-badge svg{
            stroke:#fff;
        }
        /* employee cards (generated inside the PHP loop) */
        .avs-wrapper .row .col-md-12 > .box > .box[style*="padding:1%"]{
            border:1px solid #eeecf9 !important;
            border-radius:16px !important;
            box-shadow:none;
            margin-bottom:18px !important;
        }
        .avs-wrapper .box-header.with-border{
            border:none;
            padding:14px 16px;
        }
        .avs-wrapper .box-title{
            color:#2d2b45;
        }
        .avs-wrapper .badge.bg-red{background:#f4544e;border-radius:999px;padding:4px 10px;}
        .avs-wrapper .badge.bg-yellow{background:#e6b93d;border-radius:999px;padding:4px 10px;color:#4a3c07;}
        .avs-wrapper .badge.bg-green{background:#3fb37f;border-radius:999px;padding:4px 10px;}
        .avs-wrapper .progress.progress-xs{
            border-radius:999px;
            background:#f1effe;
            overflow:hidden;
        }
        .avs-wrapper .progress-bar-red{background:#f4544e;}
        .avs-wrapper .progress-bar-yellow{background:#e6b93d;}
        .avs-wrapper .progress-bar-green{background:#3fb37f;}
        .avs-wrapper .btn-box-tool{
            color:#6C63F5;
        }
        .avs-wrapper .btn-box-tool i.fa{
            color:#6C63F5 !important;
        }
        .avs-wrapper table.table-bordered{
            border-radius:12px;
            overflow:hidden;
            border-color:#eeecf9;
        }
        .avs-wrapper table.table-bordered thead th{
            background:#faf9ff;
            color:#4a4863;
            font-weight:600;
            border-color:#eeecf9;
        }
        .avs-wrapper table.table-bordered td, .avs-wrapper table.table-bordered th{
            border-color:#eeecf9;
        }
        .avs-wrapper .label.bg-aqua{
            background:#6C63F5 !important;
            border-radius:10px;
        }
        .avs-wrapper .btn-danger.btn-xs{
            border-radius:999px;
            background:#f4544e;
            border:none;
        }
        /* Tableau global card */
        .avs-tableheader{
            display:flex;
            align-items:center;
            gap:14px;
            padding:22px 26px 10px 26px;
        }
        .avs-tableheader-title{
            font-size:18px;
            font-weight:600;
            color:#2d2b45;
            margin:0;
            position:relative;
            display:inline-block;
        }
        .avs-tableheader-title:after{
            content:'';
            position:absolute;
            left:0;
            bottom:-6px;
            width:38px;
            height:3px;
            border-radius:3px;
            background:linear-gradient(90deg,#6C63F5,#8c7ef2);
        }
        .avs-wrapper .tablebox .box-body{
            padding:20px 26px 26px 26px !important;
        }
        .avs-wrapper .dt-buttons{
            display:flex;
            gap:10px;
            margin-bottom:16px;
        }
        .avs-wrapper .dt-button,
        .avs-wrapper .dt-buttons .btn{
            border-radius:999px !important;
            border:none !important;
            font-weight:600 !important;
            font-size:13.5px !important;
            padding:8px 18px !important;
            margin:0 !important;
            float:none !important;
        }
        .avs-wrapper .buttons-csv{background:#f1effe !important;color:#6C63F5 !important;}
        .avs-wrapper .buttons-excel{background:#e8f8ee !important;color:#1f9d55 !important;}
        .avs-wrapper .buttons-print{background:#f1effe !important;color:#6C63F5 !important;}
        .avs-wrapper .dataTables_filter input{
            border-radius:999px;
            border:1.5px solid #e7e5f7;
            padding:8px 16px;
            font-size:13.5px;
        }
        .avs-wrapper .dataTables_filter label{
            font-weight:500;
            color:#6a6785;
        }
        .avs-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button{
            border-radius:999px !important;
            border:1px solid #e7e5f7 !important;
            margin:0 3px;
            color:#6a6785 !important;
        }
        .avs-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current{
            background:#6C63F5 !important;
            border-color:#6C63F5 !important;
            color:#fff !important;
        }
        .avs-wrapper .dataTables_info{
            color:#8b87a8;
            font-size:13px;
        }

        /* ---------- Custom date-range picker (vanilla JS, no external dependency) ---------- */
        .avs-datebanner .date-field-wrap{ position:relative; flex:1; }
        .avs-wrapper input.lb-date-input{
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
        .lb-cal-range-preview{ margin-top:14px; }
        .lb-cal-range-preview{
            display:flex; justify-content:space-between; gap:8px; margin-bottom:10px;
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
    <?php echo $this->Html->css('dataTables.bootstrap'); ?>
    <div class="avs-wrapper" style="width:100%;">
    <div class="col-md-12" style="margin-bottom: 24px;"> 
        <div class="avs-datebanner">
            <div class="avs-datebanner-left">
                <div class="avs-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <p class="avs-datebanner-title">Pour des statistiques d'une période précise,</p>
                    <div class="avs-datebanner-sub">veuillez sélectionner une date :</div>
                </div>
            </div>
                <div class="col-md-6" style="padding:0;">
                    <form action="<?php echo $this->Html->url(array("controller" => "users", "action" => "admin_statistique")); ?>" method="get" id="dateform">
                        <div class="input-group col-lg-12" style="float:left;">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="date-field-wrap" style="flex:1;">
                                <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right lb-date-input" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    </div>
</div>
<?php
foreach ($users as $u) {
    foreach ($visites as $v) {
        if ($u["User"]["id"] == $v['Visite']['user_id']) 
		{
			$name=$v['User']['name'] . '|' . $v['User']['id'] . '|' . $u['User']['role'];
			if(!isset($somme[$name]))
				$somme[$name]=0;
            $somme[$name] = $somme[$name] = $somme[$name] + 1;
        }
    }
}

?>

<div class="avs-wrapper">
<div class="row">
    <div class="col-md-12" style="float:none;margin:auto;">
        <div class="box" style="border-color:#3c8dbc;">
            <div class="avs-listbanner">
                <div class="avs-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></svg>
                </div>
                <h3 class="avs-listbanner-title">Liste des visites</h3>
            </div>
            <div style="padding:18px 20px 20px 20px;">
            <?php
            $i = 0;
            $j = 0;
//debug($somme);
            $datedebutinit = $date_debut;
            if (!empty($somme)) {
                foreach ($somme as $key1 => $value) {
                    $date_debut = $datedebutinit;
                    foreach ($types as $t) {
                        $objByType[$t] = 0;
                        $typess[] = $t;
                        //$types=array_unique($typess);
                    }
                    //debug($types);
                    $infos = explode("|", $key1);
                    $name = $infos[0];
                    $id = $infos[1];
                    $role = $infos[2];
                    if ($role == 'Super viseur')
                        $role = 'Superviseur';

                    $j++;
                    ?>
                    <div class="box" style="padding:1% 0%;width:98%;margin:auto;">
                        <?php
                        $class = "";
                        $objectifglobale = 0;
                        $nbraffbypotv2 = $this->requestAction('/rapports/system_get_nbr_affectation_potv2/' . $id . "/" . $date_debut . "/" . $date_fin);

                        //Recuperation de combien de jours je doit déduire d'objectif 
                        //car ils ont demander que le calcule doit ce faire un objectif journalier
                        //exemple ila khtar mn un mardi le systeme doit pas contablisé lundi 
                        //ila khtar jeudi je ne doit pas prendre vendredi
                        //ici il kan date_debut samedi oula dimanche tanzid f date debut wach twli lundi 
                        if (date('N', strtotime($date_debut)) == '6' || date('N', strtotime($date_debut)) == '7')
                            $date_debut = date('Y-m-d', strtotime('next monday', strtotime($date_debut)));
                        $jourNonComptabliser = date('N', strtotime($date_debut)) - 1;
                        if ((5 - date('N', strtotime($date_fin))) > 0)
                            $jourNonComptabliser = $jourNonComptabliser + (5 - date('N', strtotime($date_fin)));
                        
                        
                        while (str_replace("-", "", $date_debut) <= str_replace("-", "", $date_fin)):
                            $plan = $this->requestAction('/plantournes/system_existeplanification/' . $id . '/' . $date_debut);
                            //objectif global d'une semaine me permet dayro f had vaiable
                            $objectifsemaineglobale=0;
                            
                            if ($plan != 0) 
                            {
                                $objectif = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $id . "/" . $date_debut);
                                foreach ($objectif as $obj) {
                                    foreach ($types as $t) {
                                        if ($obj['Type']['name'] == $t)
                                            $objByType[$t] = $objByType[$t] + $obj['Objectif']['objectif'];
                                    }
                                    $objectifsemaineglobale+= $obj['Objectif']['objectif'];
                                    $objectifglobale = $objectifglobale + $obj['Objectif']['objectif'];
                                }
                            }
                            $date_debut = date('Y-m-d', strtotime($date_debut . ' + 7days'));
                        endwhile;
                        if ($objectifglobale != 0) {
                            //Annuler objectif li khaj mn mes dates
                            $jourNonComptabliserObjectif = ($objectifsemaineglobale / 5) * $jourNonComptabliser;
                            //$objectifglobale = $objectifglobale - $jourNonComptabliserObjectif;
                            //---------------------Fin-----------//

                            $prog = $value / $objectifglobale * 100;
                            if ($prog < 50)
                                $class = "red";
                            else if ($prog <= 75)
                                $class = "yellow";
                            else
                                $class = "green";
                        }
                        $sdata[$name]["name"] = $name;
                        $sdata[$name]["role"] = $role;
                        $sdata[$name]["nbvisite"] = $value;
                        $sdata[$name]["nbretard"] = $objectifglobale - $value;
                        $sdata[$name]["objectif"] = $objectifglobale;
                        if ($objectifglobale != 0)
                            $sdata[$name]["progression"] = $value / $objectifglobale * 100;
                        else
                            $sdata[$name]["progression"] = 0;
                        ?>

                        <div class="box-header with-border">
                            <div class="box-title col-md-10" style="padding: 0px;">
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;"><b>Employé : </b></br><span><?php echo $name; ?></span></div>
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;width: 11%;"><b>Rôle : </b></br><span><?php echo $role; ?></span></div>
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;width: 27%;">
                                    <div class="col-md-6" style="font-size: 15px;"><b>NB Visite : </b></br><span><?php echo $value; ?></span></div>
                                    <div class="col-md-6" style="font-size: 15px;"><b>NB Retard : </b></br><span><?php echo $objectifglobale - $value; ?></span></div>
                                </div>
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;width: 11%;"><b>Objectif : </b></br><span><?php echo $objectifglobale; ?></span></div>
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;"><b>Progression : </b></br>
                                    <div class="progress progress-xs" style="margin-top:8px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
                                        if ($objectifglobale != 0) {
                                            echo $value / $objectifglobale * 100;
                                        } else {
                                            echo 0;
                                        }
                                        ?>%"></div>
                                    </div> 
                                </div>
                                <?php
                                if ($objectifglobale == 0) {
                                    $class = 'green';
                                }
                                ?>
                                <div class="col-md-2" style="font-size: 15px;padding: 4px;"><b>Pourcentage : </b></br><span class="badge bg-<?php echo $class; ?>" style="padding: 1px 3px;">	
                                        <?php
                                        if ($objectifglobale == 0)
                                            echo '100%';
                                        else
                                            echo round($value / $objectifglobale * 100, 2) . '%';
                                        ?> 
                                        <button type="button" onclick="boxtogl(<?php echo $i; ?>)" class="btn btn-box-tool" style="font-size:16px; border-radius:0px;border-left:1px solid #fff;padding: 0px 4px;"><i id="iconl<?php echo $i; ?>" class="fa fa-plus" style="color:#fff;"></i></button>
                                    </span></div>
                            </div>
                            <button type="button" onclick="boxtog(<?php echo $i; ?>)" class="btn btn-box-tool" style="float: right;font-size:15px;">Voir tout les visites <i id="icon<?php echo $i; ?>" class="fa fa-plus" style="color:#aaa;"></i></button>
                            <div class="col-md-12 boxtogl<?php echo $i; ?>" style="display:none;overflow: scroll;overflow-y: hidden;">
                                <table class="table table-bordered" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Objectif</th>
                                            <th>N° visites effectuées</th>
                                            <th style="width:30%;">Progression</th>
                                            <th>Pourcentage</th>
                                            <th>Détail potentialité</th>
                                        </tr>
                                    </thead>
                                    <?php
									
                                    foreach ($objByType as $keyO => $obt):
                                        $nbVisit = 0;
                                        $nbVisitQAM = 0;
                                        $nbVisitPCM = 0;
                                        $nbVisitPM = 0;
                                        $nbVisitNR = 0;
                                        $typ = '';
										
                                        ?>

                                        <tr>
                                            <td><?php echo $keyO; ?></td>
                                            <td>
                                                <?php
                                                $jourNonComptabliserObg = ($obt / 5) * $jourNonComptabliser;
                                                $obt = $obt - $jourNonComptabliserObg;
                                                echo $obt;
                                                ?>
                                            </td>

                                            <td><?php
												$public=$prive=0;
                                                foreach ($visites as $v) {
                                                    if ($v['User']['name'] == $name) {
                                                        //debug($types);
														if($v["Client"]["activite"]=="Publique")
															$public++;
														if($v["Client"]["activite"]=="Prive")
															$prive++;
                                                        if ($v["Client"]["potentialitev2"] == 'QAM') {
                                                            $nbVisitQAM = $nbVisitQAM + 1;
                                                        } elseif ($v["Client"]["potentialitev2"] == 'PCM') {
                                                            $nbVisitPCM = $nbVisitPCM + 1;
                                                        } elseif ($v["Client"]["potentialitev2"] == 'PM') {
                                                            $nbVisitPM = $nbVisitPM + 1;
                                                        } else {
                                                            $nbVisitNR = $nbVisitNR + 1;
                                                        }

                                                        foreach ($types as $key => $t) {
                                                            // echo $v["Client"]["type_id"];
                                                            // echo nl2br("\n");
                                                            // echo 'hada lkey : '.$key;
                                                            if ($v["Client"]["type_id"] == $key) {
                                                                $typ = $t;
                                                                break;
                                                            }
                                                        }
                                                        if ($typ == $keyO) {
                                                            $nbVisit = $nbVisit + 1;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <?php echo $nbVisit; ?>
                                            </td>
                                            <?php
                                            if ($obt != 0) {
                                                $prog = $nbVisit / $obt * 100;
                                                if ($prog < 50)
                                                    $class = "red";
                                                else if ($prog <= 75)
                                                    $class = "yellow";
                                                else
                                                    $class = "green";
                                            } else {
                                                $class = "red";
                                            }
                                            ?>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
                                                    if ($obt != 0) {
                                                        echo $nbVisit / $obt * 100;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%"></div>
                                                </div></td>
                                            <td>
                                                <span class="badge bg-<?php echo $class; ?>"><?php
                                                    if ($obt != 0) {
                                                        echo round($nbVisit / $obt * 100, 2);
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%</span></td>
                                            <td>
                                                <?php if ($keyO == "Médecin"): ?><button type="button" onclick="boxtogp(<?php echo $i; ?>)" class="btn btn-box-tool" style="float: none;margin:auto;font-size:16px;"><i id="iconp<?php echo $i; ?>" class="fa fa-plus" style="color:#aaa;"></i></button><?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php if ($keyO == "Médecin"): ?>
                                            <tbody class="boxtogp<?php echo $i; ?>" style="display:none;">
                                                <?php foreach ($nbraffbypotv2 as $key => $v) { ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $v; ?></td>
                                                        <td><?php
                                                            if ($key == 'QAM') {
                                                                echo $nbVisitQAM;
                                                            } elseif ($key == 'PCM') {
                                                                echo $nbVisitPCM;
                                                            } elseif ($key == 'PM') {
                                                                echo $nbVisitPM;
                                                            } else {
                                                                echo $nbVisitNR;
                                                            }
                                                            ?></td>
                                                        <?php
                                                        if ($v != 0) {
                                                            if ($key == 'QAM') {
                                                                $prog = $nbVisitQAM / $v * 100;
                                                            } elseif ($key == 'PCM') {
                                                                $prog = $nbVisitPCM / $v * 100;
                                                            } elseif ($key == 'PM') {
                                                                $prog = $nbVisitPM / $v * 100;
                                                            } else {
                                                                $prog = $nbVisitNR / $v * 100;
                                                            }
                                                            if ($prog < 50) {
                                                                $class = "red";
                                                            } elseif ($prog <= 75) {
                                                                $class = "yellow";
                                                            } else {
                                                                $class = "green";
                                                            }
                                                        } elseif ($v == 0) {
                                                            $class = "red";
                                                        }
                                                        ?>
                                                        <td><div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-striped progress-bar-<?php echo $class; ?>" style="width: <?php
                                                                if ($v != 0) {
                                                                    if ($key == 'QAM') {
                                                                        echo $nbVisitQAM / $v * 100;
                                                                    } elseif ($key == 'PCM') {
                                                                        echo $nbVisitPCM / $v * 100;
                                                                    } elseif ($key == 'PM') {
                                                                        echo $nbVisitPM / $v * 100;
                                                                    } else {
                                                                        echo $nbVisitNR / $v * 100;
                                                                    }
                                                                } else {
                                                                    echo 0;
                                                                }
                                                                ?>%"></div>
                                                            </div></td>
                                                        <td>

                                                            <span class="badge bg-<?php echo $class; ?>"><?php
                                                                if ($v != 0) {
                                                                    if ($key == 'QAM') {
                                                                        echo round($nbVisitQAM / $v * 100, 2);
                                                                    } elseif ($key == 'PCM') {
                                                                        echo round($nbVisitPCM / $v * 100, 2);
                                                                    } elseif ($key == 'PM') {
                                                                        echo round($nbVisitPM / $v * 100, 2);
                                                                    } else {
                                                                        echo round($nbVisitNR / $v * 100, 2);
                                                                    }
                                                                } else
                                                                    echo 0;
                                                                ?>%</span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
										<tr>
                                            <th>Prive</th>
                                            <th>-</th>
                                            <th><?php echo $prive ?></th>
                                            <th style="width:30%;">-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
										<tr>
                                            <th>Publique</th>
                                            <th>-</th>
                                            <th><?php echo $public ?></th>
                                            <th style="width:30%;">-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-body boxtog<?php echo $i; ?>" style="display:none;overflow: scroll;overflow-y: hidden;padding: 0px;">
                            <table class="table table-bordered display" id="e<?php echo $j ?>">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Type</th>
                                        <th>Catégorie</th>
                                        <th>Partenaires</th>
                                        <th>Activité</th>
                                        <th>Date</th>
                                        <th>Commentaire</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($visites as $value):
                                    if ($value['User']['name'] == $name):
                                        ?>
                                        <tr>
                                            <td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?></td>
                                            <?php
                                            foreach ($types as $key => $v) {
                                                if ($value["Client"]["type_id"] == $key) {
                                                    $k = $v;
                                                    break;
                                                }
                                            }
                                            echo "<td>$k</td>";
                                            $k = "";
                                            foreach ($categories as $key => $v) {
                                                if ($value["Client"]["category_id"] == $key) {
                                                    $k = $v;
                                                    break;
                                                }
                                            }
                                            echo "<td>$k</td>";
                                            ?>
                                            <td> 
                                                <?php
                                                $ii = 0;
                                                $iii = 0;
                                                if (strpos($value["Visite"]["objection"], '#') === 0) {
                                                    $visiteobjection = ltrim($value["Visite"]["objection"], '#');
                                                    $obV = explode('||', $visiteobjection);

                                                    foreach ($obV as $o) {
                                                        $products = explode(';', $o);
                                                        ?>
                                                        <div class="col-xs-12" style="float:left;padding: 0px;margin-bottom: 4px;">
                                                            <span class="label bg-aqua" style="width: 100%;padding: 7px 5px;margin-right: 3px;vertical-align: middle;float:left;font-size: 13px;"><b style="margin-right: 0px;"><?php
                                                                    //debug($product);
                                                                    foreach ($produits as $key => $p) {
                                                                        if ($key == $products[0]) {
                                                                            echo $p;
                                                                        }
                                                                    }
                                                                    //echo $products[0];
                                                                    ?>
                                                                </b> <i class="fa fa-plus" id="iconpr<?php echo $ii; ?>" style="cursor:pointer;border-left: 2px solid #fff;padding: 0px 5px;" onclick="boxtogprod(<?php echo $ii; ?>)"></i></span>
                                                            <div class="boxtogprod<?php echo $ii; ?>" style="display:none;">
                                                                <?php
                                                                $objections = explode(',', $products[1]);
                                                                array_pop($objections);
                                                                foreach ($objections as $obj) {
                                                                    $objec = explode('|', $obj);
                                                                    ?>
                                                                    <div class="col-md-2 objet objeto<?php echo $iii; ?>">
                                                                        <span class="optionh optionho<?php echo $iii; ?>" onclick="boxtogpo(<?php echo $iii; ?>)"><?php echo $objec[0]; ?> <i id="iconpo<?php echo $iii; ?>" class="fa fa-plus"></i></span>
                                                                        <ul class="optionb optionbo boxtogpo<?php echo $iii; ?>">
                                                                            <?php for ($j = 1; $j < count($objec); $j++) { ?>
                                                                                <li><?php echo $objec[$j]; ?></li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                    <?php
                                                                    $iii++;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $ii++;
                                                    }
                                                } else if (strpos($value["Visite"]["objection"], '*') === 0) {
                                                    $objection = ltrim($value["Visite"]["objection"], '*');
                                                    $objections = explode(',', $objection);
                                                    array_pop($objections);
                                                    //debug($objections);
                                                    foreach ($objections as $obj) {
                                                        $words = '';
                                                        $objec = explode('|', $obj);
                                                        ?>
                                                        <div class="col-md-12" style="padding:0px;min-width:150px;float:left;">
                                                            <b><?php echo $objec[0]; ?> :</b>
                                                            <span><?php
                                                                for ($j = 1; $j < count($objec); $j++) {
                                                                    $words = $words . ',' . $objec[$j];
                                                                    $words = ltrim($words, ',');
                                                                }
                                                                ?><?php echo $words; ?> </span>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                    echo $value["Visite"]["objection"];
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $value["Client"]["activite"]; ?></td>
                                            
                                            
                                            <td>
                                                <b style="min-width:73px;float: left;">	
                                                    <?php
                                                    $date = strtotime($value["Visite"]["date"]);
                                                    $dat = date('Y-m-d', $date);
                                                    echo $dat;
                                                    ?>
                                                </b>
                                            </td>
                                            <td><div style="min-width:150px;"><?php echo $value["Visite"]["commentaire"]; ?></div></td>
                                            <td>
                                                <a class="btn btn-danger btn-xs"href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'archive', $value['Visite']['id'], 0)); ?>" title="Archive">Archiver</a>
                                            </td>
                                        </tr>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </table>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
            </div>
        </div>
    </div>
    <div class="tablebox col-md-12 col-sm-12 col-xs-12">
        <div class="box">
            <div class="avs-tableheader">
                <div class="avs-icon-badge" style="width:40px;height:40px;min-width:40px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
                </div>
                <h3 class="avs-tableheader-title">Tableau global</h3>
            </div>
            <div class="box-body" style="height: 243px;overflow-y: scroll;overflow-x: hidden;padding: 20px 26px 26px 26px;">
                <table id="examplen" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Employé </th>
                            <th>Rôle</th>
                            <th>NB Visite</th>
                            <th>NB Retard</th>
                            <th>Objectif</th>
                            <th>Progression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sdata as $value):
                            ?>
                            <tr>
                                <td><?php echo $value["name"]; ?></td>
                                <td><?php echo $value["role"]; ?></td>
                                <td><?php echo $value["nbvisite"]; ?></td>
                                <td><?php echo $value["nbretard"]; ?></td>
                                <td><?php echo $value["objectif"]; ?></td>
                                <td><?php echo number_format($value["progression"], 0); ?> %</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
                                                                            $(function () {
                                                                                $('#examplen').DataTable({
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
                                                                            });
</script>
<script>
    $(function () {
        $('table.display').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel'
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
        });
    });

    /*$(function () {
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
     });*/
//document.getElementById('note').innerHTML = '<?php //echo $notetotal;                    ?>';

    // ---------- Custom date-range picker (vanilla JS, no external dependency) ----------
    // Replaces the old daterangepicker plugin, which was throwing
    // "e.indexOf is not a function" / "reading 'options'" and never opened.
    // Self-contained, built in its own ready block so it can never be blocked
    // by an unrelated script/plugin failing to load.
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

    function boxtog(id) {
        $(".boxtog" + id).toggle();
        var clas = $("#icon" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#icon" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#icon" + id).attr("class", "fa fa-minus");
        }
    }
    function boxtogl(id) {
        $(".boxtogl" + id).toggle();
        var clas = $("#iconl" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#iconl" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#iconl" + id).attr("class", "fa fa-minus");
        }
    }
    function boxtogp(id) {
        $(".boxtogp" + id).toggle();
        var clas = $("#iconp" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#iconp" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#iconp" + id).attr("class", "fa fa-minus");
        }
    }
    function boxtogpo(id) {
        $(".boxtogpo" + id).toggle();
        var clas = $("#iconpo" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#iconpo" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#iconpo" + id).attr("class", "fa fa-minus");
        }
    }
    function boxtogprod(id) {
        $(".boxtogprod" + id).toggle();
        var clas = $("#iconpr" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#iconpr" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#iconpr" + id).attr("class", "fa fa-minus");
        }
    }

</script>
