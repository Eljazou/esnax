<?php //echo date("i:s"); if($id=="3000") echo $this->element('sql_dump'); ?>
<style>
    .col-md-8 label{float: left;margin-top: 6px;font-weight: normal;}
    @media (max-width: 810px) {
        .panel-heading{width:100% !important;}
    }

:root {
    --lr-accent: #6C5CE7;
    --lr-accent-dark: #5b4bd6;
    --lr-accent-soft: #EFECFD;
    --lr-text: #1F2430;
    --lr-muted: #8A8FA3;
    --lr-border: #EEF0F5;
    --lr-bg: #F6F7FB;
    --lr-warn-soft: #FFF1E0;
    --lr-warn: #E08A2E;
}

body { background: var(--lr-bg); }
.panel.panel-primary { border: none; box-shadow: none; background: transparent; }
.col-md-8 label { float: left; margin-top: 6px; font-weight: normal; }
@media (max-width: 810px) { .panel-heading { width: 100% !important; } }

/* ===== CARDS & HEADERS ===== */
.lr-card {
    background: #fff; border-radius: 18px; padding: 24px; margin-bottom: 20px;
    border: 1px solid var(--lr-border); box-shadow: 0 4px 24px rgba(31,36,48,0.06);
}
.lr-card-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 18px; }
.lr-header-left { display: flex; align-items: center; gap: 14px; }
.lr-title { margin: 0; font-size: 18px; font-weight: 700; color: var(--lr-text); }
.lr-subtitle { margin: 2px 0 0; font-size: 13px; color: var(--lr-muted); }

/* Icons */
.lr-icon-circle {
    width: 44px; height: 44px; min-width: 44px; border-radius: 50%; flex-shrink: 0;
    background: var(--lr-accent-soft); color: var(--lr-accent); display: flex; align-items: center; justify-content: center;
}
.lr-icon-circle svg { width: 20px; height: 20px; stroke: var(--lr-accent); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
.lr-icon-circle.lr-warn { background: var(--lr-warn-soft); }
.lr-icon-circle.lr-warn svg { stroke: var(--lr-warn); }

/* ===== FIELDS & FORM CONTROLS ===== */
.lr-select-filter, .lr-date-field input.date_f {
    border: 1px solid var(--lr-border); background: #fff; border-radius: 10px; padding: 9px 14px; font-size: 13.5px; color: var(--lr-text); outline: none; cursor: pointer;
}
.lr-select-filter:focus, .lr-date-field input.date_f:focus { border-color: var(--lr-accent) !important; box-shadow: 0 0 0 3px var(--lr-accent-soft); }
.lr-date-field { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.lr-date-field label { font-weight: 600; font-size: 14px; color: var(--lr-text); margin: 0; white-space: nowrap; }
.lr-date-field input.date_f { max-width: 180px; }

/* Buttons */
.lr-submit-wrap { text-align: center; margin: 4px 0; }
.lr-submit-wrap input[type="submit"], .lr-submit-wrap button {
    background: var(--lr-accent) !important; color: #fff !important; border: none !important; border-radius: 12px !important;
    padding: 12px 28px !important; font-weight: 600 !important; font-size: 14.5px !important; transition: background .15s ease;
}
.lr-submit-wrap input[type="submit"]:hover, .lr-submit-wrap button:hover { background: var(--lr-accent-dark) !important; }

/* ===== TABLES & MAP ===== */
.lr-table-wrap { border: 1px solid var(--lr-border); border-radius: 14px; overflow: auto; max-height: 420px; }
table.lr-table { width: 100%; border-collapse: collapse; margin-bottom: 0 !important; }
table.lr-table th, table.lr-table td { padding: 12px 14px; text-align: left; vertical-align: middle; white-space: nowrap; }
table.lr-table thead th { background: #FAFAFC; color: var(--lr-text); font-size: 13px; font-weight: 700; border-bottom: 1px solid var(--lr-border) !important; position: sticky; top: 0; z-index: 1; }
table.lr-table tbody td { font-size: 13.5px; color: var(--lr-text); border-top: 1px solid var(--lr-border) !important; }
table.lr-table tbody tr:hover { background: #FAFAFF; }
table.lr-table tbody tr td a { color: var(--lr-accent); font-weight: 600; text-decoration: none; }
table.lr-table tbody tr td input[type="checkbox"] { width: 17px; height: 17px; accent-color: var(--lr-accent); cursor: pointer; }
#map-canvas { border-radius: 14px; overflow: hidden; height: 430px; }

/* DataTables Filter styling */
.dataTables_filter { text-align: right; margin-bottom: 12px; }
.dataTables_filter label { font-weight: 600; font-size: 13px; color: var(--lr-text); display: inline-flex; align-items: center; gap: 8px; margin: 0; }
.dataTables_filter input { border: 1px solid var(--lr-border) !important; border-radius: 10px !important; padding: 8px 12px !important; font-size: 13.5px; outline: none; min-width: 220px; }
.dataTables_filter input:focus { border-color: var(--lr-accent) !important; box-shadow: 0 0 0 3px var(--lr-accent-soft); }

/* ===== FIXING THE CALENDAR POPOVER DECORATION ===== */
.ui-datepicker, .datepicker, #ui-datepicker-div {
    background: #fff !important; border: 1px solid var(--lr-border) !important; border-radius: 14px !important;
    box-shadow: 0 10px 30px rgba(31,36,48,0.12) !important; padding: 14px !important; z-index: 9999 !important; width: auto !important; max-width: 300px;
}
.ui-datepicker-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; font-weight: 700; color: var(--lr-text); font-size: 14px; }
.ui-datepicker-prev, .ui-datepicker-next { color: var(--lr-accent) !important; font-weight: 600; cursor: pointer; font-size: 12px; text-decoration: none; padding: 2px 6px; border-radius: 6px; background: var(--lr-accent-soft); }
.ui-datepicker-calendar { width: 100% !important; border-collapse: separate !important; border-spacing: 4px !important; }
.ui-datepicker-calendar th { font-size: 11px; text-transform: uppercase; color: var(--lr-muted); font-weight: 700; padding: 4px 0; text-align: center; }
.ui-datepicker-calendar td { padding: 0 !important; text-align: center; }
.ui-datepicker-calendar td a, .ui-datepicker-calendar td span {
    display: flex !important; align-items: center; justify-content: center; width: 32px; height: 32px; 
    border-radius: 8px !important; font-size: 13px; font-weight: 500; text-decoration: none !important; color: var(--lr-text) !important; transition: all 0.15s ease;
}
.ui-datepicker-calendar td a:hover { background: var(--lr-accent-soft) !important; color: var(--lr-accent) !important; }
.ui-datepicker-calendar .ui-state-active, .ui-datepicker-calendar .ui-state-highlight { background: var(--lr-accent) !important; color: #fff !important; font-weight: 600; }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuwmNaUU3JfRgdkYbhaV0hptTkcTKqn8Q"></script>
<div class="row">
    <div class="col-md-11" style="float:none;margin:auto;">
        <div class="panel panel-primary">
            <?php
            echo $this->Form->create('Feuilleroute');
            if (!empty($liste_id))
                echo $this->Form->hidden('liste_id', array('value' => $liste_id));
            ?>

            <div class="lr-card">
                <div class="lr-card-header" style="margin-bottom:0;">
                    <div class="lr-header-left">
                        <div class="lr-icon-circle">
                            <svg viewBox="0 0 24 24"><path d="M4 19l6-14 4 10 3-6 3 10"/><path d="M4 19h16"/></svg>
                        </div>
                        <div>
                            <h3 class="lr-title">Nouvelle feuille de route</h3>
                            <p class="lr-subtitle">Choisissez la date et sélectionnez les clients à visiter.</p>
                        </div>
                    </div>
                    <div class="lr-date-field">
                        <?php echo $this->Form->input('date', array('type' => 'text', 'class' => 'form-control date_f', 'style' => 'float:none;width:auto;margin:0;', 'id' => 'datepicker', 'label' => "Date de la feuille de route", 'div' => false)); ?>
                    </div>
                </div>
                <div class="col-md-12 liste_double" style="padding:0;"></div>
            </div>

            <div class="lr-card">
                <div class="lr-card-header">
                    <div class="lr-header-left">
                        <div class="lr-icon-circle">
                            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>
                        </div>
                        <div>
                            <h3 class="lr-title">La liste de la semaine</h3>
                            <p class="lr-subtitle">Clients à visiter cette semaine.</p>
                        </div>
                    </div>
                    <select onchange="search(this.value)" class="lr-select-filter">
                        <option value="t">Sélectionnez</option>
                        <option value="m">Médecin</option>
                        <option value="p">Pharmacie</option>
                        <option value="g">Grossiste</option>
                        <option value="a">Autre</option>
                    </select>
                </div>
                <div class="lr-table-wrap">
                    <table id="example1" class="display table table-bordered lr-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Spécialité</th>
                                <th>Pot</th>
                                <th>Type</th>
                                <th>Secteur</th>
                                <th>Sélections</th>
                            </tr>
                        </thead>
                        <?php
                        $map = "";
                        $i = 0;
                        if (!empty($liste)) {
                            foreach ($liste as $value):
                                $i++;
                                $lan = $lal = 0;
                                if ($value["Client"]["longitude"] != null && $value["Client"]["longitude"] != "")
                                    $lan = $value["Client"]["longitude"];
                                if ($value["Client"]["latitude"] != null && $value["Client"]["latitude"] != "")
                                    $lal = $value["Client"]["latitude"];
                                $value["Client"]["nom"]=str_replace("'", " ", $value["Client"]["nom"]);
                                $map = $map . "['" . $value["Client"]["nom"] . "','" . $value["Client"]["activite"] . "','" . $value["Client"]["potentialite"] . "',$lan,$lal,0,''],";


                                if ($value["Client"]["visite"]!= 0)
                                    continue;
                                if ($value["Client"]["type_id"] == 1) {
                                    $s = "m";
                                }
                                if ($value["Client"]["type_id"] == 2) {
                                    $s = "p";
                                }
                                if ($value["Client"]["type_id"] == 3) {
                                    $s = "g";
                                }else{
                                    $s = "a";
                                }
                                ?>
                                <tr class="<?php echo $s; ?>">
                                    <td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?></td>
                                    <td><?php echo isset($types[$value["Client"]["type_id"]]) ? $types[$value["Client"]["type_id"]] : ""; ?></td>
                                    <td><?php echo isset($categories[$value["Client"]["category_id"]]) ? $categories[$value["Client"]["category_id"]] : ""; ?></td>
                                    <td><?php echo $value["Client"]["potentialite"]; ?></td>
                                    <td><?php echo $value["Client"]["type_pharmacie"]; ?></td>
                                    <td><?php echo isset($secteurs[$value["Client"]["secteur_id"]]) ? $secteurs[$value["Client"]["secteur_id"]] : ""; ?></td>
                                    <td>
                                        <input type="checkbox" alt="0" name="data[client_id][]" value="<?php echo $value['Client']['id']; ?>" class="flat-red check<?php echo $i; ?>"  onclick="check(<?php echo $i; ?>)">
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lr-card">
                <div class="lr-card-header">
                    <div class="lr-header-left">
                        <div class="lr-icon-circle lr-warn">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.01"/></svg>
                        </div>
                        <div>
                            <h3 class="lr-title">La liste des retards</h3>
                            <p class="lr-subtitle">Clients en retard de visite.</p>
                        </div>
                    </div>
                </div>
                <div class="lr-table-wrap">
                    <table id="example2" class="display table table-bordered lr-table">
                        <thead>
                            <tr>
                                <th>Liste</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Spécialité</th>
                                <th>Pot</th>
                                <th>Type</th>
                                <th>Secteur</th>
                                <th>Nb° de Retards</th>
                                <th>Sélections</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($clients as $value):
                            $i++;
                            $lan = $lal = 0;
                            if ($value["Client"]["longitude"] != null && $value["Client"]["longitude"] != "")
                                $lan = $value["Client"]["longitude"];
                            if ($value["Client"]["latitude"] != null && $value["Client"]["latitude"] != "")
                                $lal = $value["Client"]["latitude"];
                            $value["Client"]["nom"]=str_replace("'", " ", $value["Client"]["nom"]);
                            $map = $map . "['" . $value["Client"]["nom"] . "','" . $value["Client"]["activite"] . "','" . $value["Client"]["potentialite"] . "',$lan,$lal,0,''],";

                            if ($value["Client"]["type_id"] == 1) {
                                $s = "m";
                            }
                            if ($value["Client"]["type_id"] == 2) {
                                $s = "p";
                            }
                            if ($value["Client"]["type_id"] == 3) {
                                $s = "g";
                            }
                            ?>
                            <tr class="<?php echo $s; ?>">
                                <td><?php echo $value["Client"]["info"]["liste_name"]; ?></td>
                                <td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?></td>
                                <td><?php echo $types[$value["Client"]["type_id"]];?></td>
                                <td><?php echo $categories[$value["Client"]["category_id"]];?></td>
                                <td><?php echo $value["Client"]["potentialite"]; ?></td>
                                <td><?php echo $value["Client"]["type_pharmacie"]; ?></td>
                                <td><?php echo $secteurs[$value["Client"]["secteur_id"]];?>
                                </td>
                                <td><?php echo $value["Client"]["info"]["retard"];; ?> </td>
                                <td>
                                    <input type="checkbox" alt="0" name="data[client_id][]" value="<?php echo $value['Client']['id']; ?>" class="flat-red check<?php echo $i; ?>"  onclick="check(<?php echo $i; ?>)">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- -->
            <?php if (AuthComponent::user('role') == 'Super viseur' && !empty($clientss))  {  ?>
                <div class="lr-card">
                    <div class="lr-card-header">
                        <div class="lr-header-left">
                            <div class="lr-icon-circle lr-warn">
                                <svg viewBox="0 0 24 24"><path d="M12 3l9 17H3z"/><path d="M12 10v4M12 17v.01"/></svg>
                            </div>
                            <div>
                                <h3 class="lr-title">Clients A1 / B1 en retard</h3>
                                <p class="lr-subtitle">Retards de la semaine dernière (potentialité A1 et B1).</p>
                            </div>
                        </div>
                    </div>
                    <div class="lr-table-wrap">
                        <table id="example3" class="display table table-bordered lr-table">
                            <thead>
                                <tr>
                                    <th>Liste</th>
                                    <th>Nom</th>
                                   <!-- <th>Type</th>-->
                                    <th>Activité</th>
                                    <th>Spécialité</th>
                                    <th>Potentialité</th>
                                    <th>Secteur</th>
                                    <th>Date dernière visite</th>
                                    <!--   <th >Nb° de Retards</th>-->
                                    <th>Sélections</th>
                                </tr>
                            </thead>
                            <?php
                            $map = "";
                            $typemap = $catmap = "";
                            foreach ($clientss as $key => $vv):
                                $i++;
                                $value = $this->requestAction("/clients/system_get_client/$key");
                                $lan = $lal = 0;
                                if ($value["Client"]["longitude"] != null && $value["Client"]["longitude"] != "")
                                    $lan = $value["Client"]["longitude"];
                                if ($value["Client"]["latitude"] != null && $value["Client"]["latitude"] != "")
                                    $lal = $value["Client"]["latitude"];
                                $value["Client"]["nom"]=str_replace("'", " ", $value["Client"]["nom"]);
                                $map = $map . "['" . $value["Client"]["nom"] . "','" . $value["Client"]["activite"] . "','" . $value["Client"]["potentialite"] . "',$lan,$lal,0,''],";

                                if ($value["Client"]["type_id"] == 1) {
                                    $s = "m";
                                }
                                if ($value["Client"]["type_id"] == 2) {
                                    $s = "p";
                                }
                                if ($value["Client"]["type_id"] == 3) {
                                    $s = "g";
                                }
                                ?>
                                <tr class="<?php echo $s; ?>">
                                    <td><?php echo $this->requestAction("/listes/system_get_name_list_for_client/$key"); ?></td>
                                    <td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?></td>

                                    <td><?php echo $value["Client"]["activite"]; ?></td>
                                    <td><?php
                                        foreach ($categories as $key => $v) {
                                            if ($key == $value["Client"]["category_id"]) {
                                                echo $v;
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value["Client"]["potentialite"] ?></td>
                                    <td><?php
                                        foreach ($secteurs as $key => $v) {
                                            if ($key == $value["Client"]["secteur_id"]) {
                                                echo $v;
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $vv; ?> </td>
                                    <td>
                                        <input type="checkbox" alt="0" name="data[client_id][]" value="<?php echo $value['Client']['id']; ?>" class="flat-red check<?php echo $i; ?>"  onclick="check(<?php echo $i; ?>)">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
            <div class="lr-submit-wrap">
                <?php echo $this->Form->end(array('label' => 'Enregistrer la feuille de route', 'class' => '', 'div' => false)); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="lr-card">
                    <div class="lr-card-header">
                        <div class="lr-header-left">
                            <div class="lr-icon-circle">
                                <svg viewBox="0 0 24 24"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            </div>
                            <div>
                                <h3 class="lr-title">Carte</h3>
                                <p class="lr-subtitle">Localisation des clients sélectionnés.</p>
                            </div>
                        </div>
                    </div>
                    <div id="map-canvas" class="col-md-12"></div>
                    <input type="hidden" class="mapzoom" value="12">
                    <input type="hidden" class="maplatleng" value="0">
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
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<script>
                                            $(function () {
                                                $('.display').DataTable({
                                                    "paging": false,
                                                    "lengthChange": false,
                                                    "searching": true,
                                                    "ordering": true,
                                                    "info": false,
                                                    "autoWidth": false,
                                                    "iDisplayLength": 250,
                                                    "aaSorting": [],
                                                    "language": {
                                                        "sSearch": "Rechercher&nbsp;:",
                                                        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                                                        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau"
                                                    }
                                                });
                                            });
</script>
<script>
    (function (factory) {
        if (typeof define === "function" && define.amd) {
            define(["../widgets/datepicker"], factory);
        } else {
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {
        datepicker.regional.fr = {
            closeText: "Fermer",
            prevText: "Précédent",
            nextText: "Suivant",
            currentText: "Aujourd'hui",
            monthNames: ["janvier", "février", "mars", "avril", "mai", "juin",
                "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
                "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
            weekHeader: "Sem.",
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""};
        datepicker.setDefaults(datepicker.regional.fr);

        return datepicker.regional.fr;

    }));
    $("#datepicker").datepicker($.datepicker.regional['fr']).datepicker("setDate", new Date());
    function search(val) {
        var ex1 = $('#example1 tr').length;
        var ex2 = $('#example2 tr').length;
        $('table tr').hide();
        $('thead tr').show();
        $("." + val).show();
        if (val == "t") {
            $('.m, .p, .g').show();
        }
    }
</script>
<script>
    var mapzoom = $(".mapzoom").attr("value");
    var mapz = parseInt(mapzoom);
    var locations = [<?php echo $map; ?>];
    console.log(locations);
    var pt = locations[2][2];
    var last = locations.length - 1;
    var last = parseInt(last);
    var maps = new google.maps.LatLng(33.5719036, -7.5873685);
    //console.log(locations[0][3]+","+locations[last][4]);
    function initialize()
    {

        var mapOptions = {
            zoom: 6 ,
            center: maps,
            mapTypeId: google.maps.MapTypeId.terrain
        };

        map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
        google.maps.event.addListenerOnce(map, "zoom_changed", function () {
            mapz = map.getZoom();
            $(".mapzoom").attr("value", mapz);
            //console.log(oldZoom);
        });
        google.maps.event.addListenerOnce(map, "center_changed", function () {
            maps = map.getCenter();
            $(".maplatleng").attr("value", maps);
            //console.log(oldCenter);
        });
        google.maps.event.addListenerOnce(map, "mouseup, click, double_click", function () {
            maps = map.getCenter();
            $(".maplatleng").attr("value", maps);
            mapz = map.getZoom();
            $(".mapzoom").attr("value", mapz);
            //console.log(oldCenter);
        });
        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (var i = 0; i < locations.length; i++) {
            var check = $(".check" + i).attr("alt");

            if (check == 0 && locations[i][2] === "A1" || locations[i][2] === "A2" || locations[i][2] === "A3") {
                if (locations[i][2] === "A1") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/A1.png')); ?>';
                } else if (locations[i][2] === "A2") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/A2.png')); ?>';
                } else {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/A3.png')); ?>';
                }
            } else if (check == 0 && locations[i][2] === "B1" || locations[i][2] === "B2" || locations[i][2] === "B3") {
                if (locations[i][2] === "B1") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/B1.png')); ?>';
                } else if (locations[i][2] === "B2") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/B2.png')); ?>';
                } else {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/B3.png')); ?>';
                }

            } else if (check == 0 && locations[i][2] === "C1" || locations[i][2] === "C2" || locations[i][2] === "C3") {
                if (locations[i][2] === "C1") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/C1.png')); ?>';
                } else if (locations[i][2] === "C2") {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/C2.png')); ?>';
                } else {
                    var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/C3.png')); ?>';
                }

            } else if (check == 0 && locations[i][2] === "NR") {
                var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/NR.png')); ?>';
            }
            else if (check == 1) {
                var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/marker-v.png')); ?>';
            } else{
                var v = '<?php echo $this->Html->url(array('controller' => '', 'action' => 'img/marker-r.png')); ?>';
            }

            var markerimg = {
                url: v,
                size: new google.maps.Size(30, 38),
                scaledSize: new google.maps.Size(30, 38),
                labelOrigin: new google.maps.Point(14, 13),
            }



             if(locations[i][4]!="" && locations[i][3]!=""){
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][4], locations[i][3]),
                map: map,
                icon: markerimg,
                label: locations[i][6],
                animation: google.maps.Animation.DROP
            })
            google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0] + '<br>' + locations[i][1] + '<br>' + locations[i][2]);
                    infowindow.open(map, marker);
                }
            })(marker, i));

            google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
                return function () {
                    infowindow.close(map, marker);
                }
            })(marker, i));
            }
            else{

            }
            
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function check(id) {
        var check = $(".check" + id).attr("alt");
        if (check == 0) {
            $(".check" + id).attr('alt', 1);
            if(locations[id][4] == 0 && locations[id][3] ==0){
                
            }else{
            initialize();
            
        }
        }
        if (check == 1) {
            $(".check" + id).attr('alt', 0);
            
        }

        
    }


    $(window).load(function () {
        var h = $(window).height();
        $('#map-canvas, .annoncesmaps').height("430px");
    });

</script>

<?php //echo date("i:s");  ?>