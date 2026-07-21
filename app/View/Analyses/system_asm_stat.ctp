<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
?>

<style>
    .table-dsm {
        text-align: center;
        vertical-align: middle;
        border-collapse: separate;
        border-spacing: 1px;
        width: 100%;
        background-color: #fff;
    }

    .table-dsm th,
    .table-dsm td {
        padding: 12px;
        vertical-align: middle !important;
        border: 1px solid #ffffff;
    }

    .bg-dsm-head {
        background-color: #38e5ab;
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .bg-type-head {
        background-color: #6a329f;
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .bg-name {
        background-color: #5ab1ce;
        color: white;
        font-weight: bold;
        font-size: 18px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .bg-row-light {
        background-color: #c9e8f5;
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .bg-row-dark {
        background-color: #d7d8e8;
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .bg-val-light {
        background-color: #e2e8f0;
        font-weight: bold;
        font-size: 15px;
        color: #555;
    }

    .bg-val-dark {
        background-color: #edeaf1;
        font-weight: bold;
        font-size: 15px;
        color: #555;
    }

    .clickable-cell {
        cursor: pointer;
        color: #0056b3;
        text-decoration: underline;
    }

    .clickable-cell:hover {
        background-color: #cbd5e1;
        color: #000;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tableau de bord Superviseurs - Visites Doubles</h3>
            </div>
            <div class="box-body">
                <!-- Filtre par mois -->
                <form action="<?php echo $this->Html->url(array('controller' => 'analyses', 'action' => 'system_asm_stat')); ?>" method="post" class="form-inline" style="margin-bottom: 25px; background: #f9f9f9; padding: 15px; border-radius: 5px; border: 1px solid #eee;">
                    <div class="form-group">
                        <label for="mois" style="margin-right: 10px;">Choisir le mois : </label>
                        <input type="month" name="data[Filtre][mois]" id="mois" class="form-control" value="<?php echo h($mois_choisi); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-left: 10px;"><i class="fa fa-filter"></i> Filtrer</button>
                </form>

                <!-- Tableau Principal -->
                <div class="table-responsive" style="background-color:#9e9c91; padding: 10px; border-radius: 8px;">
                    <table class="table-dsm">
                        <thead>
                            <tr>
                                <th class="bg-dsm-head">DSM</th>
                                <th class="bg-type-head">Type de visites</th>
                                <th class="bg-type-head">S1</th>
                                <th class="bg-type-head">S2</th>
                                <th class="bg-type-head">S3</th>
                                <th class="bg-type-head">S4</th>
                                <th class="bg-type-head">S5</th>
                                <th class="bg-type-head">Total</th>
                                <th class="bg-type-head">% de realisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats as $super_id => $data): ?>
                                <tr>
                                    <td rowspan="2" class="bg-name"><?php echo h($data['nom']); ?></td>

                                    <td class="bg-row-light">Visites Solo (Obj : <?php echo $objectif_solo; ?>)</td>

                                    <!-- Visites Solo -->
                                    <?php foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $s): ?>
                                        <td class="bg-val-light <?php echo ($data['solo'][$s . '_count'] > 0) ? 'clickable-cell' : ''; ?>"
                                            <?php if ($data['solo'][$s . '_count'] > 0): ?>
                                            onclick='openDatesModal("<?php echo addslashes($data['nom']); ?>", "solo", "<?php echo $s; ?>", <?php echo json_encode($data['solo'][$s], JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'
                                            <?php endif; ?>>
                                            <?php echo $data['solo'][$s . '_count']; ?>
                                        </td>
                                    <?php endforeach; ?>

                                    <td class="bg-val-light"><?php echo $data['solo']['total_jours']; ?></td>
                                    <td class="bg-val-light"><?php echo str_replace('.', ',', $data['solo']['realisation']); ?>%</td>
                                </tr>
                                <tr>
                                    <td class="bg-row-dark">Visites Double (Obj : <?php echo $objectif_double; ?>)</td>

                                    <!-- Visites Double -->
                                    <?php foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $s): ?>
                                        <td class="bg-val-dark <?php echo ($data['double'][$s . '_count'] > 0) ? 'clickable-cell' : ''; ?>"
                                            <?php if ($data['double'][$s . '_count'] > 0): ?>
                                            onclick='openDatesModal("<?php echo addslashes($data['nom']); ?>", "double", "<?php echo $s; ?>", <?php echo json_encode($data['double'][$s], JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'
                                            <?php endif; ?>>
                                            <?php echo $data['double'][$s . '_count']; ?>
                                        </td>
                                    <?php endforeach; ?>

                                    <td class="bg-val-dark"><?php echo $data['double']['total_jours']; ?></td>
                                    <td class="bg-val-dark"><?php echo str_replace('.', ',', $data['double']['realisation']); ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Premier Modal: Liste des dates travaillées -->
<div class="modal fade" id="datesModal" tabindex="-1" role="dialog" aria-labelledby="datesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="datesModalLabel">Jours travaillés</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-hover" id="datesTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th style="text-align:center;">Nombre de visites</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Deuxième Modal: Détails des visites pour un jour donné -->
<div class="modal fade" id="visitesModal" tabindex="-1" role="dialog" aria-labelledby="visitesModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff; opacity:1;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="visitesModalLabel" style="color:#fff;">Détails des visites</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="visitesTable">
                        <thead>
                            <tr>
                                <th>VMP (Accompagné)</th>
                                <th>Client</th>
                                <th>Spécialité</th>
                                <th>Localisation</th>
                                <th>Date & Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="$('#visitesModal').modal('hide'); $('body').addClass('modal-open');">Retour</button>
            </div>
        </div>
    </div>
</div>

<script>
    var globalVisitesData = {};
    var baseUrl = '<?php echo $this->Html->url(array("controller" => "clients", "action" => "view")); ?>/';

    function openDatesModal(nom, type, semaine, datesData) {
        var tLabel = type === 'solo' ? 'Solo' : 'Double';
        $('#datesModalLabel').text('Jours travaillés - ' + nom + ' (' + tLabel + ') - ' + semaine);

        var tbody = $('#datesTable tbody');
        tbody.empty();

        $.each(datesData, function(dateStr, visitesArray) {
            var nbVisites = visitesArray.length;
            var key = encodeURIComponent(nom + '_' + type + '_' + semaine + '_' + dateStr);
            globalVisitesData[key] = visitesArray;

            var tr = $('<tr>');
            tr.append($('<td>').text(dateStr).css('vertical-align', 'middle'));

            // Le nombre de visite est cliquable comme demandÃ©
            var valBtn = $('<button>').addClass('btn btn-sm btn-info').text(nbVisites + ' visite(s)')
                .attr('onclick', "openVisitesModal('" + key + "', '" + dateStr + "')");

            tr.append($('<td>').css('text-align', 'center').append(valBtn));

            var actBtn = $('<button>').addClass('btn btn-sm btn-primary').html('<i class="fa fa-eye"></i> Détails')
                .attr('onclick', "openVisitesModal('" + key + "', '" + dateStr + "')");
            tr.append($('<td>').css('text-align', 'center').append(actBtn));

            tbody.append(tr);
        });

        $('#datesModal').modal('show');
    }

    function openVisitesModal(dataKey, dateStr) {
        var visitesArray = globalVisitesData[dataKey];
        if (!visitesArray) return;

        $('#visitesModalLabel').text('Détails des visites pour le ' + dateStr);
        var tbody = $('#visitesTable tbody');
        tbody.empty();

        $.each(visitesArray, function(index, v) {
            var tr = $('<tr>');
            tr.append($('<td>').text(v.User.name));

            var clientAnchor = $('<a>')
                .attr('href', baseUrl + v.Client.id)
                .attr('target', '_blank')
                .text(v.Client.nom + ' ' + v.Client.prenom);
            tr.append($('<td>').append(clientAnchor));

            tr.append($('<td>').text(v.Category.name));

            var loc = (v.Secteur.region || '') + ' - ' + (v.Secteur.ville || '');
            tr.append($('<td>').text(loc));

            tr.append($('<td>').text(v.Visite.date));

            tbody.append(tr);
        });

        $('#visitesModal').modal('show');
    }
</script>