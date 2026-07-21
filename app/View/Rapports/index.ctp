<?php echo $this->Html->css('daterangepicker');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
?>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>
<?php echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<style>
    .dt-button {
        width: auto;
        float: left;
        margin: 5px;
        font-size: 16px;
        line-height: 22px;
        padding: 3px 8px;
        background: #37b733ff;
        color: #fff;
        text-decoration: none !important;
    }

    .dt-button:hover {
        color: #fff;
        background: #079102ff;
    }

    .truncate-text {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        vertical-align: middle;
    }

    .show-more-btn {
        color: #FFFFFF;
        cursor: pointer;
        font-size: 12px;
        margin-left: 5px;
        background: #3c8dbc;
        border: none;
        padding: 2px 6px;
        outline: none;
        border-radius: 4px;
        display: inline-block;

    }

    .show-more-btn:hover {
        color: #23527c;
    }

    .full-text-hidden {
        display: none;
    }

    #example1_wrapper {
        overflow-x: scroll;
    }

    /* style  */
    #dateform {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        height: 34px;
    }
</style>

<?php
function showBracket($value)
{
    if (!isset($value)) {
        return '';
    }

    if (is_string($value)) {
        $value = trim($value);
    }

    if ($value === '' || $value === null) {
        return '';
    }

    return '[' . h($value) . ']';
}

// Function to truncate text for display
function truncateText($text, $limit = 50)
{
    if (empty($text)) {
        return '';
    }

    $text = trim($text);

    if (strlen($text) <= $limit) {
        return h($text);
    }

    $truncated = substr($text, 0, $limit);
    $fullText = h($text);
    $displayText = h($truncated);

    return '<span class="truncate-wrapper">' .
        '<span class="truncate-text">' . $displayText . '...</span>' .
        '<span class="full-text-hidden">' . $fullText . '</span>' .
        '<a class="show-more-btn" onclick="showFullText(this)">Voir plus</a>' .
        '</span>';
}
?>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 24px;">
        <div class="box form-group">
            <div class="box-header with-border">
                <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Date du rapport</label>
                <div class="col-md-10">
                    <?php echo $this->Form->create(false, array(
                        'url' => array('controller' => 'rapports', 'action' => 'index'),
                        'type' => 'post',
                        'id' => 'dateform'
                    )); ?>
                    <div class="input-group col-md-5" style="float:left;">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text"
                            <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?>
                            class="form-control pull-right"
                            name="date"
                            id="reservationtime"
                            placeholder="Rechercher">
                    </div>

                    <div class="col-md-5">
                        <select name="type_user" id="type_user" class="form-control">
                            <option value="Tout" selected>Tout</option>
                            <option value="DSM">DSM</option>
                            <option value="VMP">VMP</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Filtrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Rapports'); ?></h3>
                <div class="box-tools pull-right">
                    <?php
                    $currentDay  = date('N'); // 1 = Monday, 7 = Sunday

                    $isAllowed = false;

                    // Friday (5), Saturday (6), Sunday (7)
                    if (in_array($currentDay, [1,5, 6, 7])) {
                        $isAllowed = true;
                    }


                    if ($isAllowed || AuthComponent::user('role') == 'Admin') {

                        if ($this->requestAction('/droits/getrole/rapports/add') == 1) {
                            echo $this->Html->link(
                                __('Ajouter'),
                                ['action' => 'add'],
                                ['class' => 'btn bg-purple btn-flat', 'style' => 'float:right;']
                            );
                        }
                        if ($this->requestAction('/droits/getrole/rapports/addsp') == 1 || AuthComponent::user('role') == 'Admin' ) {
                            $sup = "";
                            if (AuthComponent::user('role') == 'Admin') {
                                $sup = "Sup";
                            }
                            echo $this->Html->link(
                                __('Ajouter ' . $sup),
                                ['action' => 'addsp'],
                                ['class' => 'btn bg-purple btn-flat', 'style' => 'float:right;margin-right: 9px;']
                            );
                        }
                    } else {
                    ?>
                        <span class="badge bg-red" data-toggle="tooltip"
                            title="L'ajout est autorisé du vendredi jusqu'au lundi matin">
                            L'ajout est bloqué !
                        </span>
                    <?php } ?>

                </div>
            </div>

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ligne</th>
                            <th>Employé</th>
                            <th>Période début</th>
                            <th>Période fin</th>
                            <th>Date d'ajout</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>l'activité</th>
                            <th>Globale</th>
                            <th>Produits</th>
                            <th>Concurrents</th>
                            <th>Degrés d'agressivité</th>
                            <th>Type de l'offre</th>
                            <th>L'offre</th>
                            <th>Commentaires</th>
                            <th class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                        $rapportss = '';
                        foreach ($rapports as $rapport):
                            $rapportss = $rapportss . " " . $rapport['Rapport']['description'];
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    if (isset($rapport['Rapport']['ligne_name']))
                                        echo h($rapport['Rapport']['ligne_name']);
                                    ?>
                                    &nbsp;
                                </td>

                                <td>
                                    <?php
                                    if (isset($rapport['User']['id']) && isset($rapport['User']['name'])) {
                                        echo $this->Html->link(
                                            h($rapport['User']['name']),
                                            array('controller' => 'users', 'action' => 'view', $rapport['User']['id'])
                                        );
                                    }
                                    ?>
                                    &nbsp;
                                </td>

                                <td><?php
                                    if (isset($rapport['Rapport']['date_debut']))
                                        echo strftime("%A le %d-%m-%Y", strtotime($rapport['Rapport']['date_debut']));
                                    ?>&nbsp;
                                </td>

                                <td><?php
                                    if (isset($rapport['Rapport']['date_fin']))
                                        echo strftime("%A le %d-%m-%Y", strtotime($rapport['Rapport']['date_fin']));
                                    ?>&nbsp;
                                </td>

                                <td><?php
                                    if (isset($rapport['Rapport']['created']))
                                        echo strftime("%A le %d-%m-%Y", strtotime($rapport['Rapport']['created']));
                                    ?>&nbsp;
                                </td>

                                <td><?php echo truncateText($rapport['Rapport']['titre'], 20); ?>&nbsp;</td>

                                <td><?php echo truncateText($rapport['Rapport']['description'], 20); ?>&nbsp;</td>

                                <td><?php echo truncateText($rapport['Rapport']['activite'], 20); ?>&nbsp;</td>

                                <td>
                                    <?php
                                    if (isset($rapport['Rapport']['globale'])) {
                                        $color = '';
                                        if ($rapport['Rapport']['globale'] > 75) {
                                            $color = "background:green;color:#fff;";
                                        } elseif ($rapport['Rapport']['globale'] > 50) {
                                            $color = "background:yellow;color:#333;";
                                        } else {
                                            $color = "background:red;color:#fff;";
                                        }
                                        echo '<span style="' . $color . 'border-radius:4px;padding:4px 8px;margin:5px;">'
                                            . h($rapport['Rapport']['globale']) . '%</span>';
                                    }
                                    ?>
                                    &nbsp;
                                </td>

                                <td><?php echo showBracket($rapport['Rapport']['our_produits']); ?>&nbsp;</td>
                                <td><?php echo showBracket($rapport['Rapport']['concurances']); ?>&nbsp;</td>
                                <td><?php echo showBracket($rapport['Rapport']['agressivite']); ?>&nbsp;</td>
                                <td><?php echo showBracket($rapport['Rapport']['type_offre']); ?>&nbsp;</td>
                                <td><?php echo truncateText($rapport['Rapport']['offre'], 40); ?>&nbsp;</td>
                                <td><?php echo truncateText($rapport['Rapport']['commentaires'], 50); ?>&nbsp;</td>

                                <td class="actions">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <?php
                                                if ($this->requestAction('/droits/getrole/rapports/view') == 1) {
                                                    if ($rapport['Rapport']['moyen_visite'] != null && $this->requestAction('/droits/getrole/rapports/viewsp') == 1)
                                                        echo $this->Html->link(__('Voir'), array('action' => 'viewsp', $rapport['Rapport']['id']));
                                                    else
                                                        echo $this->Html->link(__('Voir'), array('action' => 'view', $rapport['Rapport']['id']));
                                                }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                if ($this->requestAction('/droits/getrole/rapports/edit') == 1)
                                                    echo $this->Html->link(__('Editer'), array('action' => 'edit', $rapport['Rapport']['id']));
                                                if ($rapport['Rapport']['moyen_visite'] != null && $this->requestAction('/droits/getrole/rapports/editsp') == 1)
                                                    echo $this->Html->link(__('Editer'), array('action' => 'editsp', $rapport['Rapport']['id']));
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                if ($this->requestAction('/droits/getrole/rapports/archive') == 1) {
                                                    if ($rapport['Rapport']['archive'] == -1)
                                                        echo $this->Html->link(__('Valider'), array('action' => 'archive', $rapport['Rapport']['id'], 1));
                                                    else
                                                        echo $this->Html->link(__('Archiver'), array('action' => 'archive', $rapport['Rapport']['id'], -1));
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                        $parts = preg_split(
                            '!([^ ]* [^ ]*) !',
                            $rapportss,
                            -1,
                            PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
                        );
                        $array = array_diff($parts, [" ", " *"]);
                        $frequencyA = array_count_values($array);
                        arsort($frequencyA);
                        foreach ($frequencyA as $key => $value) {
                            if (strlen($key) <= 3) {
                                unset($frequencyA[$key]);
                            }
                        }
                        $rapportssA = array_slice($frequencyA, 0, 50);
                        $words = str_word_count($rapportss, 1);
                        $frequency = array_count_values($words);
                        arsort($frequency);
                        foreach ($frequency as $key => $value) {
                            if (strlen($key) <= 3) {
                                unset($frequency[$key]);
                            }
                        }
                        $rapportss = array_slice($frequency, 0, 30);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- Modal for full text -->
<div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="textModalLabel">Texte complet</h4>
            </div>
            <div class="modal-body" id="modalTextContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('daterangepicker'); ?>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    // Function to show full text in modal
    function showFullText(element) {
        var wrapper = $(element).closest('.truncate-wrapper');
        var fullText = wrapper.find('.full-text-hidden').text();
        $('#modalTextContent').text(fullText);
        $('#textModal').modal('show');
    }

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
                "daysOfWeek": ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                "monthNames": [
                    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function(e) {
                this.updateInputText();
            }
        });


        // Auto-submit on select change (optional)



        // $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
        //     var startDate = picker.startDate;
        //     var endDate = picker.endDate;
        //     var action = $('#dateform').attr('action');
        //     var date = action + "?date=" + startDate + "--" + endDate;
        //     $('#dateform').attr('action', date);
        //     $('#dateform').submit();
        // });
    });

    $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csv',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            // Check if cell contains truncated text
                            var fullTextElement = $(node).find('.full-text-hidden');
                            if (fullTextElement.length > 0) {
                                // Return the full text for export
                                return fullTextElement.text();
                            }
                            // For cells without truncation, return as is (strip HTML)
                            return $(node).text();
                        }
                    }
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            // Check if cell contains truncated text
                            var fullTextElement = $(node).find('.full-text-hidden');
                            if (fullTextElement.length > 0) {
                                // Return the full text for export
                                return fullTextElement.text();
                            }
                            // For cells without truncation, return as is (strip HTML)
                            return $(node).text();
                        }
                    }
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            // Check if cell contains truncated text
                            var fullTextElement = $(node).find('.full-text-hidden');
                            if (fullTextElement.length > 0) {
                                // Return the full text for export
                                return fullTextElement.text();
                            }
                            // For cells without truncation, return as is (strip HTML)
                            return $(node).text();
                        }
                    }
                }
            }
        ]
    });
</script>