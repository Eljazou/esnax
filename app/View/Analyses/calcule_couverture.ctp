<?php

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .box-body {
        overflow: hidden;
        overflow-y: hidden;
    }

    .dt-button {
        width: auto;
        float: left;
        margin: 5px;
        font-size: 16px;
        line-height: 22px;
        padding: 3px 8px;
        background: #337ab7;
        color: #fff;
    }

    .dt-button:hover {
        color: #fff;
        background: #1a486f;
    }

    .btn-search {
        width: auto;
        float: right;
        margin: 17px 5px 5px;
        font-size: 16px;
        line-height: 22px;
        padding: 3px 8px;
        background: #337ab7;
        color: #fff;
    }

    .btn-search:hover {
        background: #023f74;
        color: #fff;
    }

    .buttons-excel {
        display: none;
    }

    .my-btn-excel,
    .recap-excel {
        margin-right: 5px;
        background: #28a745;
        color: #fff;
    }

    /* .color-thead {
        background: #fed665;
    } */

    .recap tbody tr:nth-child(10n+1),
    .recap tbody tr:nth-child(10n+2),
    .recap tbody tr:nth-child(10n+3),
    .recap tbody tr:nth-child(10n+4),
    .recap tbody tr:nth-child(10n+5) {
        background-color: #ffedb9;
    }

    .recap tbody tr:nth-child(10n+6),
    .recap tbody tr:nth-child(10n+7),
    .recap tbody tr:nth-child(10n+8),
    .recap tbody tr:nth-child(10n+9),
    .recap tbody tr:nth-child(10n+10) {
        background-color: #ffffff;
    }

    /* ===== Design system restyle (cvg) — applies across the whole page ===== */
    .cvg-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
    }
    .cvg-wrapper .box{
        background:#fff !important;
        border:none !important;
        border-top:none !important;
        border-radius:18px !important;
        box-shadow:0 4px 20px rgba(108,99,245,0.07) !important;
        margin-bottom:22px !important;
    }
    .cvg-wrapper .box-header.with-border{
        border:none !important;
        display:flex;
        align-items:center;
        gap:12px;
        padding:20px 24px 14px 24px;
        flex-wrap:wrap;
    }
    .cvg-wrapper .box-header.with-border .box-title{
        font-size:16px;
        font-weight:600;
        color:#2d2b45;
        margin:0;
        padding:0;
    }
    .cvg-wrapper .box-header.with-border .box-title .fa{
        color:#6C63F5;
        margin-right:4px;
    }
    .cvg-wrapper .box-header.with-border .pull-right{
        margin-left:auto;
    }
    .cvg-wrapper .box-body{
        padding:20px 24px 24px 24px;
    }
    /* filter banner */
    .cvg-date-banner{
        background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
        border-radius:18px 18px 0 0;
        padding:22px 28px;
        display:flex;
        align-items:center;
        gap:16px;
        flex-wrap:wrap;
        margin:-20px -24px 20px -24px;
    }
    .cvg-date-banner .cvg-date-input{
        margin-left:auto;
        min-width:260px;
        max-width:340px;
        flex:1 1 260px;
    }
    @media (max-width:768px){
        .cvg-date-banner .cvg-date-input{
            margin-left:0;
            max-width:100%;
            flex-basis:100%;
        }
    }
    .cvg-icon-badge{
        width:44px;
        height:44px;
        min-width:44px;
        border-radius:13px;
        background:linear-gradient(135deg,#efeeff,#e3e0ff);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .cvg-icon-badge svg{
        width:20px;
        height:20px;
        stroke:#6C63F5;
    }
    .cvg-date-banner .cvg-date-title{
        font-size:14px;
        font-weight:600;
        color:#6C63F5;
        margin:0;
    }
    .cvg-wrapper .input-group{
        border:1.5px solid #e7e5f7;
        border-radius:12px;
        overflow:hidden;
        background:#fff;
        min-width:260px;
    }
    .cvg-wrapper .input-group-addon{
        background:#faf9ff;
        border:none;
        border-right:1.5px solid #e7e5f7;
        color:#6C63F5;
    }
    .cvg-wrapper .input-group .form-control{
        border:none;
        box-shadow:none;
        font-size:14px;
        padding:11px 16px;
    }
    .cvg-wrapper .form-group label{
        display:flex;
        align-items:center;
        gap:8px;
        font-size:13.5px;
        font-weight:600;
        color:#454358;
        margin-bottom:6px;
        float:none;
        width:auto;
    }
    .cvg-wrapper .form-group{
        margin-bottom:18px;
        clear:both;
        overflow:hidden;
    }
    .cvg-wrapper .form-control,
    .cvg-wrapper .select2-container .select2-selection{
        border-radius:12px !important;
        border:1.5px solid #e7e5f7 !important;
        box-shadow:none !important;
        min-height:42px;
        float:none !important;
        width:100% !important;
    }
    .cvg-wrapper .select2-selection__rendered{
        line-height:40px !important;
        padding-left:14px !important;
    }
    .cvg-wrapper .select2-selection__arrow{
        height:40px !important;
    }
    .cvg-wrapper .btn-search{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
        border:none !important;
        border-radius:999px !important;
        padding:10px 22px !important;
        font-weight:600;
        font-size:14px;
        box-shadow:0 6px 18px rgba(108,99,245,0.3) !important;
        color:#fff !important;
        width:auto !important;
        float:right !important;
    }
    /* buttons: excel / image export */
    .cvg-wrapper .my-btn-excel,
    .cvg-wrapper .recap-excel,
    .cvg-wrapper .image-btn{
        border-radius:999px !important;
        border:none !important;
        font-weight:600 !important;
        font-size:12.5px !important;
        padding:8px 16px !important;
        margin:0 0 0 8px !important;
        display:inline-flex !important;
        align-items:center;
        gap:6px;
        float:none !important;
    }
    .cvg-wrapper .my-btn-excel,
    .cvg-wrapper .recap-excel{
        background:#e8f8ee !important;
        color:#1f9d55 !important;
    }
    .cvg-wrapper .image-btn{
        background:#f1effe !important;
        color:#6C63F5 !important;
    }
    /* tables */
    .cvg-wrapper table.table-bordered thead th,
    .cvg-wrapper table.dataTable thead th{
        background:#faf9ff !important;
        color:#4a4863 !important;
        font-weight:600 !important;
        font-size:13px;
        border-bottom:2px solid #ece9fb !important;
    }
    .cvg-wrapper table.table-bordered tbody td,
    .cvg-wrapper table.dataTable tbody td{
        font-size:13px;
        color:#454358;
        vertical-align:middle;
        border-color:#eeecf9 !important;
    }
    .cvg-wrapper table.table-striped tbody tr:nth-child(odd){
        background:#fbfaff;
    }
    .cvg-wrapper .dataTables_filter input{
        border-radius:999px !important;
        border:1.5px solid #e7e5f7 !important;
        padding:6px 14px !important;
        font-size:13px;
        box-shadow:none !important;
    }
    .cvg-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:999px !important;
        border:1px solid #e7e5f7 !important;
        color:#6a6785 !important;
    }
    .cvg-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:#6C63F5 !important;
        border-color:#6C63F5 !important;
        color:#fff !important;
    }
    .cvg-wrapper .label.label-info{
        background:#6C63F5 !important;
        border-radius:999px;
        padding:4px 12px;
    }
    .cvg-wrapper .progress{
        border-radius:999px !important;
    }
    .cvg-wrapper .stat-card{
        border-radius:14px !important;
    }

    /* ===== Select2 fix + theme (forces the widget to actually render as tags,
       instead of falling back to the native multi-select listbox) ===== */
    select.select2-hidden-accessible{
        display:none !important;
    }
    .cvg-wrapper .select2-container{
        width:100% !important;
        display:block !important;
    }
    .cvg-wrapper .select2-container--default .select2-selection--multiple{
        min-height:42px !important;
        border-radius:12px !important;
        border:1.5px solid #e7e5f7 !important;
        background:#fff !important;
        padding:4px 6px !important;
    }
    .cvg-wrapper .select2-container--default.select2-container--focus .select2-selection--multiple{
        border-color:#6C63F5 !important;
    }
    .cvg-wrapper .select2-selection--multiple .select2-selection__rendered{
        line-height:normal !important;
        padding:2px 2px !important;
        display:flex;
        flex-wrap:wrap;
        gap:6px;
    }
    .cvg-wrapper .select2-selection--multiple .select2-selection__choice{
        background:#efeeff !important;
        border:none !important;
        color:#6C63F5 !important;
        border-radius:8px !important;
        padding:4px 10px !important;
        margin:2px 0 !important;
        font-size:12.5px;
        font-weight:500;
    }
    .cvg-wrapper .select2-selection--multiple .select2-selection__choice__remove{
        color:#6C63F5 !important;
        margin-right:6px;
        font-weight:700;
    }
    .cvg-wrapper .select2-selection--multiple .select2-selection__choice__remove:hover{
        color:#3d3798 !important;
    }
    .cvg-wrapper .select2-container--default .select2-selection--single{
        min-height:42px !important;
        border-radius:12px !important;
        border:1.5px solid #e7e5f7 !important;
        padding-top:5px;
    }
    .select2-dropdown{
        border-radius:12px !important;
        border:1.5px solid #e7e5f7 !important;
        overflow:hidden;
        box-shadow:0 8px 24px rgba(108,99,245,0.14);
        font-family:'Poppins',sans-serif;
    }
    .select2-search--dropdown{
        padding:10px !important;
    }
    .select2-search--dropdown .select2-search__field{
        border-radius:8px !important;
        border:1.5px solid #e7e5f7 !important;
        padding:6px 10px !important;
        outline:none;
    }
    .select2-results__option{
        font-size:13.5px;
        padding:8px 14px !important;
    }
    .select2-results__option--highlighted[aria-selected],
    .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background:#6C63F5 !important;
        color:#fff !important;
    }
    .select2-container--default .select2-results__option[aria-selected=true]{
        background:#efeeff !important;
        color:#6C63F5 !important;
    }
</style>
<div class="cvg-wrapper">
<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group">
            <div class="box-body">
                <?php
                echo $this->Form->create('Analyse', array('id' => 'dateform', 'autocomplete' => 'off'));
                ?>
                <div class="cvg-date-banner">
                    <div class="cvg-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <p class="cvg-date-title">Période</p>
                    <div class="input-group cvg-date-input">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control"
                            value="<?php echo h($dateaafficherdansleview); ?>" name="date" id="reservationtime"
                            placeholder="Rechercher">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?php
                    echo $this->Form->input('activite', array(
                        "label" => "Choisissez l'activté",
                        "name" => "activite",
                        'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                        'class' => 'form-control pull-right',
                        'value' => $activite_selected
                    ));
                    echo $this->Form->input('potentialite', array(
                        "multiple" => "true",
                        "label" => "Choisissez potentialité",
                        "name" => "potentialite",
                        'options' => array(
                            "A1" => "A1",
                            "A2" => "A2",
                            "A3" => "A3",
                            "B1" => "B1",
                            "B2" => "B2",
                            "B3" => "B3",
                            "C1" => "C1",
                            "C2" => "C2",
                            "C3" => "C3"
                        ),
                        'class' => 'form-control pull-right choix_multi select2',
                        'value' => array_values($potentialite_selected)
                    ));
                    if (AuthComponent::user('role') != 'Super viseur')
                        echo $this->Form->input('secteur', array(
                            "multiple" => "true",
                            "label" => "La liste des secteurs",
                            "name" => "secteur",
                            'options' => $secteurs,
                            'class' => 'form-control pull-right choix_multi select2',
                            'value' => array_values($selected_secteur)
                        ));
                    echo $this->Form->input('category', array(
                        "multiple" => "true",
                        "label" => "La liste des spécialité",
                        "name" => "category",
                        'options' => $categories,
                        'class' => 'form-control pull-right choix_multi select2',
                        'value' => array_values($selected_categories)
                    ));
                    ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?php
                    echo $this->Form->input('user', array(
                        'multiple' => true,
                        'label' => 'La liste des VM',
                        'name' => 'users',
                        'options' => $allusers, // e.g. [1 => 'Alice', 2 => 'Bob', 16 => 'HADDANE JIHAD']
                        'class' => 'form-control pull-right choix_multi vm select2',
                        'value' => array_keys($selected_users) // <-- this gives [16]
                    ));
                    echo $this->Form->input('ligne', array(
                        "multiple" => "true",
                        "label" => "Les lignes",
                        "name" => "ligne",
                        'options' => $lignes,
                        'class' => 'form-control pull-right choix_multi vm select2',
                        'multiple' => 'multiple',
                        'value' => array_values($selected_lignes)
                    ));
                    $types = array("1" => "Medcin", "2" => "Pharmacie",);
                    echo $this->Form->input('type', array(
                        "multiple" => "true",
                        "label" => "Type de client",
                        "name" => "type",
                        'options' => $types,
                        'class' => 'form-control pull-right choix_multi vm select2',
                        'multiple' => 'multiple',
                        'value' => array_values($selected_types)
                    ));
                    ?>
                </div>
                <div class="col-md-12" style="clear:both;">
                    <input type="submit" value="Rechercher" class="btn form-control btn-search" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="clearfix"></div>
<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-12" id="tableContainer2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Calcul automatisé des réalisations avec tous les
                    détails</h3>
                <button class="btn image-btn pull-right"
                    onclick="exportTableAsImage(event, 'tableContainer2', 'couvertureTable')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
                <button class="btn my-btn-excel  pull-right" data-table="1">
                    <i class="fa fa-file-excel-o"></i> Excel
                </button>
            </div>

            <table class="table table-bordered table-striped table-one table-1 ">
                <thead class="color-thead">
                    <tr>
                        <th>VMP</th>
                        <th>Jours ouvrés théoriques</th>
                        <th>Jours d'absences/fériés</th>
                        <th>Jours à travailler réels</th>
                        <th>Objectif initial</th>
                        <th>Objectif ajusté</th>
                        <th>Visites réalisées</th>
                        <th>Taux de réalisation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totals = [];
                    $totals['jours_ouvres'] = 0;
                    $totals['absences'] = 0;
                    $totals['jours_travailles'] = 0;
                    $totals['Total_objectif'] = 0;
                    $totals['objectif_initial'] = 0;
                    $totals['visites'] = 0;
                    foreach ($realisations as $vm => $d):
                        if (!isset($d['visites'])) {
                            $d['visites'] = 0;
                        }
                        $taux_realisation = 0;
                        if (!empty($d['Total_objectif'])) {
                            $taux_realisation = (float)$d['visites'] / (float)$d['Total_objectif'] * 100;
                        }
                        $objectif_journalier = $d['Total_objectif'] / $d['jours_travailles'];
                        $objectif_initial = $objectif_journalier * $d['jours_ouvres'];


                        $totals['jours_ouvres'] += $d['jours_ouvres'];
                        $totals['absences'] += $d['absences'];
                        $totals['jours_travailles'] += $d['jours_travailles'];
                        $totals['Total_objectif'] += $d['Total_objectif'];
                        $totals['objectif_initial'] += $objectif_initial;
                        $totals['visites'] += $d['visites'];
                    ?>
                        <tr>
                            <td><?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></td>
                            <td><?php echo number_format($d['jours_ouvres'], 2, ',', ''); ?></td>
                            <td><?php echo number_format($d['absences'], 2, ',', ''); ?></td>
                            <td><?php echo number_format($d['jours_travailles'], 2, ',', ''); ?></td>
                            <td><?php echo $objectif_initial; ?></td>
                            <td><?php echo number_format($d['Total_objectif'], 2, ',', ''); ?></td>
                            <td><?php echo h($d['visites']); ?></td>
                            <td><?php echo h(number_format($taux_realisation, 2, ',', '')); ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th>Total</th>
                        <th><?php echo number_format($totals['jours_ouvres'], 2, ',', ''); ?></th>
                        <th><?php echo number_format($totals['absences'], 2, ',', ''); ?></th>
                        <th><?php echo number_format($totals['jours_travailles'], 2, ',', ''); ?></th>
                        <th><?php echo $totals['objectif_initial']; ?></th>
                        <th><?php echo number_format($totals['Total_objectif'], 2, ',', ''); ?></th>
                        <th><?php echo h($totals['visites']); ?></th>
                        <td><?php
                            $taux_realisation = 0;
                            if ($totals['Total_objectif'] > 0) {
                                $taux_realisation = number_format(($totals['visites'] / $totals['Total_objectif']) * 100, 2, ',', '');
                            }
                            echo $taux_realisation . '%'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="clearfix"></div>
<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-12" id="tableContainer1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Calcul automatisé de la couverture</h3>
                <button class="btn image-btn pull-right"
                    onclick="exportTableAsImage(event, 'tableContainer1', 'tableau_realisations')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
                <button class="btn my-btn-excel  pull-right" data-table="2">
                    <i class="fa fa-file-excel-o"></i> Excel
                </button>
            </div>

            <table class="table table-bordered table-striped table-2 ">
                <thead class="color-thead">
                    <tr>
                        <th>VMP</th>
                        <th>Client dans la liste</th>
                        <th>Clients Visitès</th>
                        <th>Jours d'absences</th>
                        <th>Jours à travailler</th>
                        <th>Jours travaillés</th>
                        <th>Clients attendus</th>
                        <th>Couverture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totals = [];
                    $totals['affectations'] = 0;
                    $totals['clients_visites'] = 0;
                    $totals['absences'] = 0;
                    $totals['jours_ouvres'] = 0;
                    $totals['jours_travailles'] = 0;
                    $totals['clients_attendu'] = 0;

                    foreach ($data_view as $k => $data):
                        $i = 0;
                        foreach ($data as $mois => $d):
                            if ($i == 1)
                                break;
                            $i++;
                            $totals['affectations'] += $d['affectations'];
                            $totals['clients_visites'] += $d['clients_visites'];
                            $totals['absences'] += $d['absences'];
                            $totals['jours_ouvres'] += $d['jours_ouvres'];
                            $totals['jours_travailles'] += $d['jours_travailles'];
                            $totals['clients_attendu'] += $d['clients_attendu'];

                    ?>
                            <tr>
                                <td><?php echo $tout_user_pour_affchage_dans_le_view[$k]; ?></td>
                                <td><?php echo h($d['affectations']); ?></td>
                                <td><?php echo h($d['clients_visites']); ?></td>
                                <td><?php echo number_format($d['absences'], 2, ',', ''); ?></td>
                                <td><?php echo h($d['jours_ouvres']); ?></td>
                                <td><?php echo number_format($d['jours_travailles'], 2, ',', ''); ?></td>
                                <td><?php echo number_format($d['clients_attendu'], 2, ',', ''); ?></td>
                                <td><?php echo h(number_format($d['couverture'], 2, ',', '')); ?>%</td>
                            </tr>
                    <?php endforeach;
                    endforeach; ?>
                    <tr>
                        <th>Total</th>
                        <th><?php echo h($totals['affectations']); ?></th>
                        <th><?php echo h($totals['clients_visites']); ?></th>
                        <th><?php echo number_format($totals['absences'], 2, ',', ''); ?></th>
                        <th><?php echo h($totals['jours_ouvres']); ?></th>
                        <th><?php echo number_format($totals['jours_travailles'], 2, ',', ''); ?></th>
                        <th><?php echo number_format($totals['clients_attendu'], 2, ',', ''); ?></th>
                        <th><?php
                            if ($totals['clients_attendu'] == 0)
                                $couverture = 0;
                            else
                                $couverture = number_format(($totals['clients_visites'] / $totals['clients_attendu']) * 100, 2, ',', '');
                            echo h($couverture); ?>%</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>


<!-- Inclure Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>



<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
    /* Styles personnalisés pour les graphiques */
    .box-body {
        position: relative;
        max-height: fit-content;
        min-height: 370px;
    }

    .box-footer {
        background-color: #f9f9f9;
        border-top: 1px solid #f4f4f4;
    }

    .box-title {
        font-weight: 600;
    }

    /* Responsive pour mobile */
    @media (max-width: 768px) {
        .col-md-6 {
            margin-bottom: 20px;
        }

        .box-body {
            height: 300px;
        }
    }
</style>

<script>
    // ===== Select2 init — deliberately NOT wrapped in $(document).ready() =====
    // With jQuery 2.2.3, an uncaught exception thrown inside one ready-callback
    // (e.g. app.min.js / plugins.bundle.js erroring on this legacy page) aborts
    // the *entire* ready-callback queue, so any handler registered after it —
    // including a $(document).ready() call for Select2 — would simply never run.
    // This script tag is placed right after the form in the HTML, so the
    // <select> elements already exist in the DOM at this point: we can init
    // Select2 immediately, without waiting on the (unreliable) ready queue.
    (function initChoixMulti() {
        try {
            if (typeof jQuery === 'undefined' || typeof jQuery.fn.select2 === 'undefined') {
                // Scripts not parsed yet for some reason — retry shortly.
                return setTimeout(initChoixMulti, 50);
            }
            jQuery('.choix_multi').select2({
                width: '100%',
                placeholder: 'Choisissez...',
                allowClear: true,
                closeOnSelect: false
            });
        } catch (e) {
            console.error('Erreur init Select2:', e);
        }
    })();

    // Safety net in case the immediate call above ran before the DOM was fully
    // parsed in some edge case (won't double-init: select2() on an already
    // initialized element is a harmless no-op/refresh).
    window.addEventListener('load', function() {
        try {
            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                jQuery('.choix_multi:not(.select2-hidden-accessible)').select2({
                    width: '100%',
                    placeholder: 'Choisissez...',
                    allowClear: true,
                    closeOnSelect: false
                });
            }
        } catch (e) {
            console.error('Erreur init Select2 (fallback load):', e);
        }
    });
</script>

<script>
    $(function() {
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
    });

    $(function() {
        try {
            // Initialize all DataTables (one time)
            $('.table-1, .table-2, .table-3').DataTable({
                paging: false,
                lengthChange: false,
                searching: true,
                ordering: false,
                info: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: ['excel']
            });

            // Hide all default Excel buttons
            $('.dt-buttons').hide();

            // Custom Excel button click handler
            $('.my-btn-excel').on('click', function() {
                // Get the number from data-table attribute (1, 2, etc.)
                const tableNumber = $(this).data('table');

                // Find the table with that number
                const $table = $('.table-' + tableNumber);

                if ($table.length) {
                    // Find its DataTables button container (dt-buttons)
                    // It’s usually placed before the table in the DOM after init
                    const $dtButtons = $table.closest('.dataTables_wrapper').find('.dt-buttons');

                    // Trigger click on the Excel button inside it
                    $dtButtons.find('.buttons-excel').click();
                } else {
                    console.warn('❌ Table not found for data-table=' + tableNumber);
                }
            });
            $.fn.dataTable.ext.buttons.excelHtml5.available = function() {
                return true;
            };


            $('.recap').DataTable({
                paging: false,
                lengthChange: false,
                searching: true,
                ordering: false,
                info: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    customize: function(xlsx) {
                        let sheet = xlsx.xl.worksheets['sheet1.xml'];
                        let rows = $('row', sheet);

                        rows.each(function(index) {
                            // skip header row (index === 0)
                            if (index === 0) return;

                            // Excel rows start at 1, data rows at 2
                            let dataRowIndex = index - 1;

                            // 6 gray / 6 white logic
                            let isGray = Math.floor(dataRowIndex / 5) % 2 === 0;

                            if (isGray) {
                                $('c', this).attr('s', '15'); // gray style
                            }
                        });
                    }
                }]
            });

            $('.recap-excel').on('click', function() {
                const $table = $('.recap');
                // Find its DataTables button container (dt-buttons)
                // It’s usually placed before the table in the DOM after init
                const $dtButtons = $table.closest('.dataTables_wrapper').find('.dt-buttons');
                // Trigger click on the Excel button inside it
                $dtButtons.find('.buttons-excel').click();

            });
        } catch (e) {
            console.error('Erreur init DataTables/Excel:', e);
        }
    });


    async function exportTableAsImage(event, containerId, filename) {
        const tableContainer = document.getElementById(containerId);

        if (!tableContainer) {
            alert('Tableau introuvable');
            return;
        }

        try {
            // Show loading state
            const exportBtn = event.target.closest('button');
            const originalHTML = exportBtn.innerHTML;
            exportBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Génération...';
            exportBtn.disabled = true;

            // Generate image
            const canvas = await html2canvas(tableContainer, {
                backgroundColor: '#ffffff',
                scale: 2,
                useCORS: true,
                allowTaint: true,
                logging: false
            });

            // Download image directly
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename + '_' + new Date().getTime() + '.png';
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
            alert('Erreur lors de l\'export de l\'image');

            // Reset button
            const exportBtn = event.target.closest('button');
            exportBtn.innerHTML = originalHTML;
            exportBtn.disabled = false;
        }
    }
</script>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bar-chart"></i> Couverture par VM et par mois</h3>
            </div>
            <div class="box-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-12" id="tableContainer3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i>Récapitulatif de performance</h3>
                <button class="btn image-btn pull-right"
                    onclick="exportTableAsImage(event, 'tableContainer3', 'couvertureTable')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
                <button class="btn recap-excel pull-right" data-table="3">
                    <i class="fa fa-file-excel-o"></i> Excel
                </button>
            </div>

            <?php
            // Récupérer tous les mois
            $allmois = array();
            foreach ($data_view as $vm => $d) {
                foreach ($d as $mois => $v) {
                    if (!in_array($mois, $allmois)) {
                        $allmois[] = $mois;
                    }
                }
            }
            ?>
            <table class="table table-bordered table-striped recap">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="color-thead">
                    <?php foreach ($data_view as $vm => $d): ?>

                        <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Couverture</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td>
                                    <?php
                                    // change . to , and round to 1 decimal
                                    echo isset($d[$mois])
                                        ? str_replace('.', ',', round($d[$mois]['couverture'], 1)) . '%'
                                        : '-';
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <!-- <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Moyenne de visite</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td>
                                    <?php
                                    // change . to , and round to 1 decimal
                                    echo isset($d[$mois])
                                        ? str_replace('.', ',', round($d[$mois]['moyenne_visites_jour'], 1)) . ''
                                        : '-';
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>-->
                        <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Visite instantanée</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td>
                                    <?php
                                    echo isset($d[$mois])
                                        ? str_replace('.', ',', round($d[$mois]['visites_instantanees'], 1)) . '%'
                                        : '-';
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Moyenne heure premiere visite</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td>
                                    <?php echo isset($d[$mois]) ? $d[$mois]['heure_debut_moyenne'] : '-'; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Moyenne heure dernière visite</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td><?php echo isset($d[$mois]) ? $d[$mois]['heure_fin_moyenne'] : '-'; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <?php foreach ($allmois as $mois)
                                echo "<th>$mois</th>"; ?>
                            <th>VMP <?php echo $tout_user_pour_affchage_dans_le_view[$vm]; ?></th>
                            <td>Moyenne temp de travail</td>
                            <?php foreach ($allmois as $mois): ?>
                                <td><?php echo isset($d[$mois]) ? $d[$mois]['temps_travail_moyen'] : '-'; ?></td>
                            <?php endforeach; ?>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section Analyse des Performances Visuelles -->
<div class="row" style="margin-top: 20px;">
    <?php
    foreach ($data_view as $vm => $d):
        foreach ($allmois as $mois):
            if (!isset($d[$mois]))
                continue;

            $donnees = $d[$mois];
            $vmp_name = $tout_user_pour_affchage_dans_le_view[$vm];
            $couverture = floatval($donnees['couverture']);
            $visite_instantanee = floatval($donnees['visites_instantanees']);
            $moyenne_visite = isset($donnees['moyenne_visites_jour']) ? $donnees['moyenne_visites_jour'] : 0;

            // Déterminer la classe de couleur pour la couverture
            $couverture_class = '';
            $couverture_color = '';
            if ($couverture < 50) {
                $couverture_class = 'progress-danger';
                $couverture_color = '#d9534f';
            } elseif ($couverture >= 50 && $couverture < 75) {
                $couverture_class = 'progress-warning';
                $couverture_color = '#f0ad4e';
            } else {
                $couverture_class = 'progress-success';
                $couverture_color = '#5cb85c';
            }

            // Déterminer la classe de couleur pour la visite instantanée
            $visite_class = '';
            $visite_color = '';
            if ($visite_instantanee < 50) {
                $visite_class = 'progress-danger';
                $visite_color = '#d9534f';
            } elseif ($visite_instantanee >= 50 && $visite_instantanee < 75) {
                $visite_class = 'progress-warning';
                $visite_color = '#f0ad4e';
            } else {
                $visite_class = 'progress-success';
                $visite_color = '#5cb85c';
            }
    ?>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-user"></i> <?php echo h($vmp_name); ?>
                        </h3>
                        <span class="label label-info pull-right"><?php echo h($mois); ?></span>
                    </div>
                    <div class="box-body">
                        <!-- Taux de Couverture -->
                        <div class="performance-item" style="margin-bottom: 25px;">
                            <div style="margin-bottom: 8px;">
                                <span style="font-weight: 600; color: #333;">Taux de Couverture</span>
                                <span class="pull-right" style="font-weight: 700; color: <?php echo $couverture_color; ?>;">
                                    <?php echo h(round($couverture, 1)); ?>%
                                </span>
                            </div>
                            <div class="progress" style="height: 25px; margin-bottom: 0;">
                                <div class="bar <?php echo $couverture_class; ?>"
                                    style="width: <?php echo $couverture; ?>%; line-height: 25px; font-weight: bold;">
                                    <?php echo h(round($couverture, 1)); ?>%
                                </div>
                            </div>
                        </div>

                        <!-- Visite Instantanée -->
                        <div class="performance-item" style="margin-bottom: 25px;">
                            <div style="margin-bottom: 8px;">
                                <span style="font-weight: 600; color: #333;">Visite Instantanée</span>
                                <span class="pull-right" style="font-weight: 700; color: <?php echo $visite_color; ?>;">
                                    <?php echo h(round($visite_instantanee, 1)); ?>%
                                </span>
                            </div>
                            <div class="progress" style="height: 25px; margin-bottom: 0;">
                                <div class="bar <?php echo $visite_class; ?>"
                                    style="width: <?php echo $visite_instantanee; ?>%; line-height: 25px; font-weight: bold;">
                                    <?php echo h(round($visite_instantanee, 1)); ?>%
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques supplémentaires -->
                        <div class="row-fluid" style="margin-top: 20px;">
                            <div class="span4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                            padding: 15px; 
                                            border-radius: 8px; 
                                            text-align: center; 
                                            color: white;">
                                    <div style="font-size: 11px; opacity: 0.9; margin-bottom: 5px;">
                                        Moy. Visite/Jour
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700;">
                                        <?php echo h($moyenne_visite); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); 
                                            padding: 15px; 
                                            border-radius: 8px; 
                                            text-align: center; 
                                            color: white;">
                                    <div style="font-size: 11px; opacity: 0.9; margin-bottom: 5px;">
                                        Première Visite
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700;">
                                        <?php echo h($donnees['heure_debut_moyenne']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); 
                                            padding: 15px; 
                                            border-radius: 8px; 
                                            text-align: center; 
                                            color: white;">
                                    <div style="font-size: 11px; opacity: 0.9; margin-bottom: 5px;">
                                        Dernière Visite
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700;">
                                        <?php echo h($donnees['heure_fin_moyenne']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Temps de travail -->
                        <div class="row-fluid" style="margin-top: 15px;">
                            <div class="span12">
                                <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); 
                                            padding: 15px; 
                                            border-radius: 8px; 
                                            text-align: center; 
                                            color: white;">
                                    <div style="font-size: 11px; opacity: 0.9; margin-bottom: 5px;">
                                        ⏱️ Temps de Travail Moyen
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700;">
                                        <?php echo h($donnees['temps_travail_moyen']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php endforeach;
    endforeach; ?>
</div>
</div>

<style>
    /* Amélioration visuelle pour Bootstrap 2 */
    .performance-item {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #e3e3e3;
    }

    .progress {
        background-color: #e2e8f0;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        height: 20px;
        overflow: hidden;
        border-radius: 4px;
    }

    .progress .bar {
        float: left;
        width: 0;
        height: 100%;
        font-size: 12px;
        color: #fff;
        text-align: center;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, .25);
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        -webkit-transition: width 0.6s ease;
        -moz-transition: width 0.6s ease;
        -o-transition: width 0.6s ease;
        transition: width 0.6s ease;
    }

    .progress-danger .bar,
    .progress .bar.progress-danger {
        background-color: #d9534f;
        background-image: -moz-linear-gradient(top, #d9534f, #c9302c);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#d9534f), to(#c9302c));
        background-image: -webkit-linear-gradient(top, #d9534f, #c9302c);
        background-image: -o-linear-gradient(top, #d9534f, #c9302c);
        background-image: linear-gradient(to bottom, #d9534f, #c9302c);
    }

    .progress-warning .bar,
    .progress .bar.progress-warning {
        background-color: #f0ad4e;
        background-image: -moz-linear-gradient(top, #f0ad4e, #ec971f);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f0ad4e), to(#ec971f));
        background-image: -webkit-linear-gradient(top, #f0ad4e, #ec971f);
        background-image: -o-linear-gradient(top, #f0ad4e, #ec971f);
        background-image: linear-gradient(to bottom, #f0ad4e, #ec971f);
    }

    .progress-success .bar,
    .progress .bar.progress-success {
        background-color: #5cb85c;
        background-image: -moz-linear-gradient(top, #5cb85c, #449d44);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5cb85c), to(#449d44));
        background-image: -webkit-linear-gradient(top, #5cb85c, #449d44);
        background-image: -o-linear-gradient(top, #5cb85c, #449d44);
        background-image: linear-gradient(to bottom, #5cb85c, #449d44);
    }

    .box {
        margin-bottom: 20px;
    }

    .label {
        font-size: 12px;
        padding: 5px 10px;
    }

    .stat-card {
        margin-bottom: 10px;
    }

    /* Support des anciennes versions de navigateurs */
    .row-fluid [class*="span"] {
        display: block;
        float: left;
        width: 100%;
        min-height: 30px;
        margin-left: 2.127659574468085%;
        *margin-left: 2.074468085106383%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .row-fluid [class*="span"]:first-child {
        margin-left: 0;
    }

    .row-fluid .span4 {
        width: 31.914893617021278%;
        *width: 31.861702127659576%;
    }

    .row-fluid .span12 {
        width: 100%;
    }
</style>




<script>
    $(function() {
        // Données envoyées depuis PHP
        var dataView = <?php echo json_encode($data_view); ?>;
        var users = <?php echo json_encode($tout_user_pour_affchage_dans_le_view); ?>;

        // Extraire la liste unique des mois
        var moisLabels = [];
        Object.values(dataView).forEach(function(userData) {
            Object.keys(userData).forEach(function(mois) {
                if (!moisLabels.includes(mois)) {
                    moisLabels.push(mois);
                }
            });
        });
        moisLabels.sort();

        // Préparer les datasets (un par mois)
        var couleurs = [
            '#6C63F5', '#8c7ef2', '#a99df5', '#e8c3b9',
            '#c45850', '#ff9800', '#009688', '#9c27b0'
        ];
        var datasets = [];
        var moisIndex = 0;

        moisLabels.forEach(function(mois) {
            var dataMois = [];

            Object.keys(dataView).forEach(function(userId) {
                if (dataView[userId][mois]) {
                    // Exemple : on prend la couverture
                    dataMois.push(dataView[userId][mois]['couverture']);
                } else {
                    dataMois.push(0);
                }
            });

            datasets.push({
                label: mois,
                backgroundColor: couleurs[moisIndex % couleurs.length],
                data: dataMois
            });

            moisIndex++;
        });

        // Construire le graphique
        var ctx = document.getElementById("barChart").getContext("2d");
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(dataView).map(function(id) {
                    return users[id]; // noms des utilisateurs
                }),
                datasets: datasets
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: "Couverture (%) par VM et par mois"
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex].label +
                                ": " + tooltipItem.yLabel + "%";
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: false
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return value + "%";
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Couverture (%)"
                        }
                    }]
                }
            }
        });
    });
</script>
