<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo $this->Html->css('daterangepicker');
    ?>
    <style>
        @media (max-width: 980px){
            .tablebox{margin-top:0px !important;}
        }
    </style>
	<div class="row ">
        <div class="col-md-12" style="margin-bottom: 24px;"> 
            <div class="box form-group">
                <div class="box-header with-border">
                    <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Pour des statistiques d'une période précise,veuillez sélectionner une date :</label>
                    <div class="col-md-6">
                        <form action="/clients/statistique_pot/" method="get" id="dateform">
                            <div class="input-group col-lg-12" style="float:left;">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php foreach ($users as $vmp): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Rapport des visites de l'équipe de <?php echo $vmp['super']['User']['name']; ?>
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover"  border="0">
                        <tbody>
                            <tr>
                                <th>POTENTIALITE</th>
                                <th>Nbr Clients</th>
                                <th>Nbr Affectee</th>
                                <th>Nbr  Visite</th>
                                <th>Nbr de retard</th>
                                <th>% de retard</th>
                                <th>% des clients jamais visiter</th>
                                <th>NB action</th>
                                <th>Détail</th>
                            </tr>
                        </tbody>
                        <?php foreach ($info[$vmp['super']['User']['id']] as $v) :?>
                                <tr>
                                    <th><?php echo $v["pot"]; ?></th>
                                    <th><?php echo $v["nombre"]; ?></th>
                                    <th><?php echo $v["visite_planifier"]; ?></th>
                                    <th><?php echo $v["visite"]; ?></th>
                                    <th><?php echo $v["visite_planifier"]-$v["visite"]; ?></th>
                                    <?php 
									$t=0;
									if($v["visite_planifier"]!=0)
										$t=($v["visite_planifier"]-$v["visite"])*100/$v["visite_planifier"];
                                    if ($t < 30)
                                        $c = "#34c180";
                                    else if ($t < 50 && $t >=30)
                                        $c = "#f5aa02";
                                    else
                                        $c = "red";?>
                                    <td style='color:<?php echo $c; ?>;font-weight:bold;'><?php echo round($t,2); ?> % </td>
                                    <th><?php //echo $v["visite0"]; ?>En cours</th>
                                    <th><?php echo $v["action"]; ?></th>
                                    <th><?php echo $this->Html->link("+",array('action'=>'statistique_pot_detail',$vmp['super']['User']['id'],$v["pot"], $date_debut , $date_fin)); ?></th>
                                </tr>
                        <?php endforeach;   ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
<?php echo $this->Html->script('daterangepicker'); ?>
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
                    //document.getElementById('note').innerHTML = '<?php //echo $notetotal;    ?>';
                    $(function () {
                        $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
                            locale: {
                                "format": "YYYY-MM-DD",
                                "separator": "--",
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
                            clickApply: function (e) {
                                this.updateInputText();
                            }
                        });
                        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
                            var startDate = picker.startDate;
                            var endDate = picker.endDate;
                            var action = $('#dateform').attr('action');
                            var date = action + "?date=" + startDate + "--" + endDate;
                            $('#dateform').attr('action', date);
                            $('#dateform').submit();
                        });

                    });

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
	function boxtogl(id){
		$('.boxlistes'+id).toggle(300);
		var clas = $("#icon"+id).attr("class");
		if(clas=='fa fa-minus'){
			$("#icon"+id).attr("class", "fa fa-plus");
		}
		if(clas=='fa fa-plus'){
			$("#icon"+id).attr("class", "fa fa-minus");
		}
	}
	
</script>