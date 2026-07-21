<?php
echo $this->Html->css('daterangepicker');
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('markerclusterer_compiled');

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<style>
	 .rouge {
        background-color: red;
		color: white;
    }
    .jaune {
        background-color: yellow;
    }
    .vert {
        background-color: green;
		color: white;
    }
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

    * {
        padding: 0;
    }

    .col-lg-1,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-md-1,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-sm-1,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-xs-1,
    .col-xs-10,
    .col-xs-11,
    .col-xs-12,
    .col-xs-2,
    .col-xs-3,
    .col-xs-4,
    .col-xs-5,
    .col-xs-6,
    .col-xs-7,
    .col-xs-8,
    .col-xs-9 {
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .info-box {
        overflow: hidden;
    }

    .inbox {
        position: relative;
        top: 11%;
    }

    .info-box-icon {
        height: 125px;
    }

    .my-12 {
        margin: 12px 0 12px;
        display: flex;
        justify-content: space-between;
    }

    .progress-div {
        display: inline-block;
        width: 300px;
    }

    .logo-soceite {
        display: inline-block;
    }

    .nomber {
        font-size: 17px;
        font-weight: 700;
        font-family: arial;
        margin-left: 12px;
    }

    .panel-body-order {
        display: flex;
        flex-direction: column;
    }

    #example1_wrapper {
        overflow-x: scroll;
        padding-bottom: 15px;
    }
</style>
<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">
        
        
        <div class="box form-group">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                <div class="col-xs-12">
                    <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: bold;width: auto;text-align:left;float:left;">choisissez une date</label>
                    <form action="#" method="post" id="dateform" autocomplete="off">
                        <div class="input-group col-lg-10 col-md-10 col-xs-12" style="float:right;margin-bottom:30px;">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" <?php if ($dateaafficherdansleview != "") echo 'value="' . $dateaafficherdansleview . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php
                            echo $this->Form->input('category', array(
                                "label" => "Choisissez une activité", "name" => "activite",
                                'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                                'class' => 'form-control pull-right'
                            ));
                            echo $this->Form->input('potentialite', array(
                                "multiple" => "true", "label" => "Choisissez potentialité", "name" => "potentialite",
                                'options' => array(
                                    "A1" => "A1", "A2" => "A2", "A3" => "A3", "A4" => "A4",
                                    "B1" => "B1", "B2" => "B2", "B3" => "B3", "B4" => "B4",
                                    "C1" => "C1", "C2" => "C2", "C3" => "C3", "C4" => "C4"
                                ),
                                'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'
                            ));
                            if (AuthComponent::user('role') != 'Super viseur')
                                echo $this->Form->input('category', array(
                                    "multiple" => "true", "label" => "La liste des secteurs", "name" => "secteur",
                                    'options' => $secteurs, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'
                                ));

                            echo $this->Form->input('category', array(
                                "multiple" => "true", "label" => "La liste des spécialité", "name" => "category",
                                'options' => $categories, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'
                            ));
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php
                            echo $this->Form->input('user', array(
                                "multiple" => "true", "label" => "La liste des VM", "name" => "users",
                                'options' => $users, 'class' => 'form-control pull-right choix_multi vm select2', 'multiple' => 'multiple'
                            ));
                            echo $this->Form->input('ligne', array(
                                "multiple" => "true", "label" => "Les lignes", "name" => "ligne",
                                'options' => $lignes, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'
                            ));
                            $typess = array("1" => "Medcin", "2" => "Pharmacie");
                            echo $this->Form->input('type', array(
                                "multiple" => "true", "label" => "Type de client", "name" => "type",
                                'options' => $typess, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'
                            ));
                            ?>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Rechercher" style="float: right;-webkit-appearance:  none;background: #367fa9;border: none;border-radius: 3px;color: #fff;padding: 3px 5px;box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.52);">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
		<?php
        if (!empty($ordredeprentation_regions)) :
			$classement_ydar=0;
			foreach($ordredeprentation_regions as $region=>$ordredeprentation): 
				if($classement_ydar==0)
				{
					$classement = array();
					for ($i = 1; $i <= count($ordredeprentation); $i++)
						$classement[$i] = "C $i";
					$classement_ydar++;
				}
		?>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ODP de <?php echo $region; if($category!="") echo " de la spécialité : ".$categories[$category]; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12">
                            <table class="table table-bordred display">

                                <thead>
                                    <tr>
                                        <td>Brochure</td>
                                        <?php foreach ($classement as $key => $values) echo "<th>$values</th>"; ?>
                                        <td>Seuil</td>
                                        <td>Seuil en %</td>
                                        <td>Contact</td>
                                        <td>Contact en %</td>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($brochures as $brochure) 
									{
                                        $total = 0;
										foreach ($classement as $k => $v) 
										{
                                            foreach ($ordredeprentation as $key => $value) {
                                                foreach ($value as $idd => $vv) {
                                                    if ($k == $key && $idd == $brochure["Brochure"]["id"]) {
                                                        $total += $vv["nombre"];
                                                    }
                                                }
                                            }
                                        }
										if($total==0)
											continue;
                                        echo '<tr><td><div class="logo-soceite">
											<img class="img-responsive" style="width: 116px;height: 23px !important;object-fit: cover;" src="' . $this->Html->url("/img/brochures/" . $brochure["Brochure"]["logo"]) . '" />
											</div></td>';
										foreach ($classement as $k => $v) {
                                            $kain = 0;
                                            foreach ($ordredeprentation as $key => $value) {
                                                foreach ($value as $idd => $vv) {
                                                    if ($k == $key && $idd == $brochure["Brochure"]["id"]) {
                                                        $kain = 1;
														$class="";
														$nombre=round($vv["nombre"]/$total*100,0);
														if(isset($cat_ordres[$brochure["Brochure"]["id"]]))
														{
															if($k==$cat_ordres[$brochure["Brochure"]["id"]])
															{
																$class="vert";
															}
														}
                                                        echo "<td class='$class'>" . $nombre . " %</td>";
                                                    }
                                                }
                                            }
                                            if ($kain == 0)
                                                echo "<td>0 %</td>";
                                        }
										echo "<td>".$total." / ".$nombredeclientvisiter."</td>";
										 echo "<td>".round($total/$nombredeclientvisiter*100,2)." %</td>";
										if(!isset($odpobjectifs[$region][$brochure["Brochure"]["id"]]))
											$odpobjectifs[$region][$brochure["Brochure"]["id"]]=0;
										echo "<td>" . $total." / ".$odpobjectifs[$region][$brochure["Brochure"]["id"]] . " </td>";
										if($odpobjectifs[$region][$brochure["Brochure"]["id"]]==0)
											echo "<td>--</td>";
										else
											echo "<td>" . round($total/$odpobjectifs[$region][$brochure["Brochure"]["id"]]*100,0) . " %</td></tr>";
                                       
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
		endforeach;
		endif; ?>
    </div>

   

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<?php

echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>


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
        //        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
        //            var startDate = picker.startDate;
        //            var endDate = picker.endDate;
        //            var action = $('#dateform').attr('action');
        //            var date = action + "?date=" + startDate + "--" + endDate;
        //            $('#dateform').attr('action', date);
        //            $('#dateform').submit();
        //        });
    });
    $(function() {
        $('.display').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
        });
        $('.choix_multi').select2();
    });
</script>

<script>
    $(document).ready(function() {
        // Function to highlight the maximum value in each row
        $('.display tbody tr').each(function() {
            var $lastCell = $(this).find('td:last');
            var lastCellValue = parseFloat($lastCell.text());

            if (lastCellValue >= 0 && lastCellValue <= 50) {
                $lastCell.addClass('rouge');
            } else if (lastCellValue > 50 && lastCellValue <= 75) {
                $lastCell.addClass('jaune');
            } else if (lastCellValue > 75) {
                $lastCell.addClass('vert');
            }
        });
    });
</script>
