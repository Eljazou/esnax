<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* =========================================================
       THEME MATCHED DESIGN — Modern Lavender / Premium Tracking
       ========================================================= */
    body, .box, .box-title, .table, th, td, .callout, .btn, .badge {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* 1. CONTAINER PRINCIPAL (BOX) */
    .box.box-primary {
        background: #ffffff !important;
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 10px 30px rgba(31, 41, 82, 0.05) !important;
        padding: 24px 28px !important;
        margin: 20px auto !important;
    }

    /* 2. ENTÊTE */
    .box-header.with-border {
        background: transparent !important;
        border: none !important;
        border-bottom: 1px solid #eef0f7 !important;
        padding: 0 0 16px 0 !important;
        margin-bottom: 24px !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .box-title {
        font-size: 22px !important;
        font-weight: 800 !important;
        color: #1a1d36 !important;
        margin: 0 !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .box-title i {
        color: #8c7ef2 !important;
    }

    /* 3. ALERTE INFORMATIVE (CALLOUT) */
    .callout.callout-info {
        background-color: #f8f9fd !important;
        border: 1px solid #e4e6fb !important;
        border-left: 4px solid #8c7ef2 !important;
        border-radius: 12px !important;
        color: #2b2c45 !important;
        padding: 16px 20px !important;
        margin-bottom: 24px !important;
        box-shadow: none !important;
    }

    .callout.callout-info h4 {
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #1a1d36 !important;
        margin-top: 0 !important;
        margin-bottom: 8px !important;
    }

    .callout.callout-warning {
        background-color: #fff6f9 !important;
        border: 1px solid #fcdde7 !important;
        border-left: 4px solid #e2679a !important;
        border-radius: 12px !important;
        color: #d04377 !important;
        padding: 16px 20px !important;
    }

    /* 4. TABLEAU DE DONNÉES MODERNISÉ */
    .table-responsive {
        border: none !important;
        margin-top: 15px;
    }

    .table.table-bordered {
        border: 1px solid #e4e6fb !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border-radius: 14px !important;
        overflow: hidden !important;
    }

    .table thead tr {
        background: #f8f9fd !important;
    }

    .table thead th {
        color: #6b6d85 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border: none !important;
        border-bottom: 2px solid #eef0f7 !important;
        padding: 14px 16px !important;
    }

    .table tbody td {
        padding: 14px 16px !important;
        font-size: 13.5px !important;
        color: #2b2c45 !important;
        border: none !important;
        border-bottom: 1px solid #eef0f7 !important;
        vertical-align: middle !important;
        background: #ffffff !important;
    }

    .table tbody tr:last-child td {
        border-bottom: none !important;
    }

    .table-hover tbody tr:hover td {
        background-color: #fafbfe !important;
    }

    /* Liens dans la table */
    .info-auto a {
        color: #8c7ef2 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }
    .info-auto a:hover {
        text-decoration: underline !important;
    }

    /* 5. GESTION DES BADGES & STATUTS D'ALERTE */
    .flag-badge {
        font-size: 12px !important;
        font-weight: 700 !important;
        padding: 6px 14px !important;
        border-radius: 8px !important;
        display: inline-block !important;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        box-shadow: none !important;
    }

    .flag-vert {
        background-color: #e3fbf2 !important;
        color: #069865 !important;
    }

    .flag-jaune {
        background-color: #fff4e5 !important;
        color: #d97706 !important;
    }

    .flag-rouge {
        background-color: #fff0f3 !important;
        color: #e2679a !important;
    }

    .text-red {
        color: #e2679a !important;
        font-weight: 700 !important;
    }

    /* 6. COMPOSANTS DE NAVIGATION (BOUTONS) */
    .btn-default {
        height: 36px !important;
        padding: 0 16px !important;
        background: #ffffff !important;
        border: 1.5px solid #e4e6fb !important;
        border-radius: 10px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #6b6d85 !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease !important;
    }

    .btn-default:hover {
        background: #f8f9fd !important;
        color: #2b2c45 !important;
        border-color: #d0d3f0 !important;
    }

    /* Bouton Export Excel Custom pour DataTables */
    .dt-buttons .btn-success, 
    .table-responsive + .dt-buttons .btn-success {
        height: 38px !important;
        padding: 0 20px !important;
        background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(140, 126, 242, 0.2) !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dt-buttons .btn-success:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px rgba(140, 126, 242, 0.3) !important;
    }

    /* 7. CUSTOMISATION INTERFACE DATATABLES (Pagination & Filtres) */
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #e4e6fb !important;
        border-radius: 8px !important;
        padding: 6px 10px !important;
        background-color: #ffffff !important;
        color: #2b2c45 !important;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #8c7ef2 !important;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1.5px solid #e4e6fb !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
    }
    .dataTables_wrapper .dataTables_info {
        color: #6b6d85 !important;
        font-size: 13px;
        padding-top: 15px !important;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #8c7ef2 !important;
        color: white !important;
        border: none !important;
        border-radius: 6px !important;
    }

    /* Responsive fallbacks */
    @media (max-width: 1282px) {
        .box-body {
            overflow-x: auto;
            padding-bottom: 30px;
        }
    }
</style>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-flag"></i> <?php echo __('Suivi des Rapports d\'Actions'); ?></h3>
        <div class="box-tools pull-right">
            <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn btn-default btn-sm">
                <i class="fa fa-list"></i> Retour aux rapports
            </a>
        </div>
    </div>

    <div class="box-body">

        <div class="callout callout-info">
            <h4><i class="icon fa fa-info-circle"></i> Objectif de cette page</h4>
            <p>Permet d'identifier rapidement les médecins/actions en cours qui manquent de rapports. Le compteur indique le <b>nombre de jours écoulés depuis le dernier rapport</b> (ou depuis le début de l'action si aucun rapport n'a été fait).</p>
            <p style="margin-top: 12px; margin-bottom: 0;">
                <span class="badge flag-badge flag-vert">Vert</span> < 15 jours &nbsp;&nbsp;&nbsp;
                <span class="badge flag-badge flag-jaune">Jaune</span> ≥ 15 jours &nbsp;&nbsp;&nbsp;
                <span class="badge flag-badge flag-rouge">Rouge</span> ≥ 30 jours (Alerte critique)
            </p>
        </div>

        <?php if (empty($suivi_actions)): ?>
            <div class="callout callout-warning">
                <h4>Aucune action en cours</h4>
                <p>Il n'y a aucune action promotionnelle active trouvée dans votre périmètre.</p>
            </div>
        <?php Stein: else: ?>

            <div class="table-responsive">
                <table id="tableSuivi" class="table table-bordered table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>État</th>
                            <th>Jours depuis le dernier rapport</th>
                            <?php if ($role == 'Admin' || $role == 'Super viseur'): ?>
                                <th>Délégué</th>
                            <?php endif; ?>
                            <th>Code CRM</th>
                            <th>Médecin (Nom & Prénom)</th>
                            <th>Secteur CRM</th>
                            <th>Gamme</th>
                            <th>Dernier Rapport Saisi</th>
                            <th>Date Fin Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suivi_actions as $suivi):
                            $client = $suivi['Client'];
                            $action = $suivi['Action'];

                            $classe_flag = 'flag-' . $suivi['statut'];
                            $label_etat = '';
                            if ($suivi['statut'] == 'vert') $label_etat = 'À jour';
                            elseif ($suivi['statut'] == 'jaune') $label_etat = 'Attention (>15j)';
                            elseif ($suivi['statut'] == 'rouge') $label_etat = 'Alerte (>30j)';
                        ?>
                            <tr>
                                <td style="text-align:center;">
                                    <span style="display:none;"><?php echo ($suivi['statut'] == 'rouge') ? '1' : (($suivi['statut'] == 'jaune') ? '2' : '3'); ?></span>
                                    <span class="badge flag-badge <?php echo $classe_flag; ?>">
                                        <?php echo $label_etat; ?>
                                    </span>
                                </td>

                                <td style="text-align:center; font-weight:bold; font-size:14px;" class="<?php echo ($suivi['statut'] == 'rouge') ? 'text-red' : ''; ?>">
                                    <?php echo $suivi['jours_depuis']; ?> jour(s)
                                </td>

                                <?php if ($role == 'Admin' || $role == 'Super viseur'): ?>
                                    <td><?php echo isset($suivi['User']['name']) ? h($suivi['User']['name']) : ''; ?></td>
                                <?php endif; ?>

                                <td class="info-auto"><?php echo $this->Html->link($client['id'], array('controller' => 'clients', 'action' => 'view', $client['id'])); ?></td>

                                <td>
                                    <strong>
                                        <?php echo h($client['nom'] . ' ' . $client['prenom']); ?>
                                    </strong>
                                </td>

                                <td><?php echo isset($client['secteur_id']) ? h($client['secteur_id']) : ''; ?></td>

                                <td class="info-auto"><?php echo isset($action['game_id']) ? rtrim($action['game_id'], ',') : ''; ?></td>

                                <td>
                                    <?php
                                    if ($suivi['dernier_rapport']) {
                                        echo date('d/m/Y H:i', strtotime($suivi['dernier_rapport']));
                                    } else {
                                        echo '<em>Aucun rapport</em>';
                                    }
                                    ?>
                                </td>

                                <td><?php echo date('d/m/Y', strtotime($action['date_fin'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('dataTables.bootstrap.min');
?>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
    $(function() {
        if ($.fn.DataTable) {
            $('#tableSuivi').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "scrollX": true,
                "order": [
                    [0, "asc"],
                    [1, "desc"]
                ],
                "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                       "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> Exporter Excel',
                    className: 'btn btn-success btn-sm'
                }],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
                }
            });
        }
    });
</script>