<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('btn-style');
echo $this->Html->css("style_radio");
echo $this->Html->css('daterangepicker');
?>	


<style type="text/css">
    :root{
        --accent:#9b90e0;
        --accent-dark:#7e71cf;
        --accent-light:#f4f2fc;
        --accent-pale:#ece7fb;
        --mint:#5ad1a8;
        --mint-dark:#2f9c78;
        --mint-light:#e6faf3;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.06);
    }

    input[type=text] {
        border-radius: 0px;
    }
.fa-clock-o {
    position: relative;
    left: -11px;
    top: 9px;
    color: white;
    cursor: pointer;
    float: left;
}
    .calendar{
    border-radius: 0px;
    padding: 6px 16px;
    margin-right: -12px;
    float: left;
    }
    a {
    color: var(--accent-dark);
    cursor: pointer;
}
.questions p{
    display: inline-block;
}

    /* ---------- Card shell ---------- */
    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px;
    }
    .box .box-header{ border-bottom:none; padding:20px 24px 10px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }
    .box-title, #dateform .title{ margin:0; font-size:16px; font-weight:700; color:var(--text-dark); display:flex; align-items:center; }
    .box-title:before, #dateform .title:before{
        content:"\f0d6"; font-family:"FontAwesome"; display:inline-flex; align-items:center; justify-content:center;
        width:32px; height:32px; border-radius:50%; margin-right:10px; font-size:14px;
        background:var(--accent-light); color:var(--accent-dark); flex:0 0 auto;
    }
    #dateform .title:before{ content:"\f073"; }

    /* ---------- Filter card ---------- */
    #dateform{ padding-top:6px; }
    #dateform .input-group{ display:flex; align-items:center; gap:0; float:none !important; margin-bottom:20px; max-width:460px; }
    #dateform .btn.calendar{
        background:var(--accent) !important; border:none !important; color:#fff !important;
        border-radius:var(--radius-sm) 0 0 var(--radius-sm) !important; padding:11px 14px !important;
        float:none !important; margin:0 !important;
    }
    #dateform .fa-clock-o{
        position:static !important; left:0; top:0; float:none !important; color:#fff !important;
        pointer-events:none;
    }
    #dateform input#reservationtime{
        border:1px solid var(--border-color) !important; border-left:none !important;
        border-radius:0 var(--radius-sm) var(--radius-sm) 0 !important; background:#fff !important;
        box-shadow:none !important; min-height:42px; font-size:14px; color:var(--text-dark);
        margin-left:0 !important; width:100% !important;
    }
    #dateform input#reservationtime:focus{ border-color:var(--accent) !important; outline:none; }

    /* Type radio toggle */
    .questions{ display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:20px; }
    .questions h3{ font-size:14.5px !important; font-weight:700; color:var(--text-dark); margin:0 !important; }
    .questions p{ margin:0 !important; display:flex !important; align-items:center; gap:6px; }
    .questions input[type="radio"]{ accent-color:var(--accent); width:16px; height:16px; margin:0; cursor:pointer; }
    .questions label{ font-weight:600; font-size:13.5px; color:var(--text-dark); margin:0; cursor:pointer; }

    #dateform .btn-success{
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        color:#fff !important; padding:11px 26px !important; font-weight:600; font-size:14px !important;
        box-shadow:0 3px 10px rgba(108,92,231,0.25) !important;
    }
    #dateform .btn-success:hover{ background:var(--accent-dark) !important; }

    /* ---------- Table ---------- */
    .table-scroll{ overflow-x:auto; border:1px solid var(--border-color); border-radius:var(--radius-sm); }
    table.display, #example1{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    #example1 thead th{
        background:var(--accent-pale) !important; color:var(--accent-dark) !important;
        font-size:11.5px; font-weight:700; text-transform:uppercase; letter-spacing:.02em;
        border:none !important; padding:11px 10px !important; white-space:nowrap;
    }
    #example1 tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:10px !important; font-size:12.5px; color:var(--text-dark); vertical-align:middle; white-space:nowrap;
    }
    #example1.table-striped tbody tr:nth-of-type(odd){ background:#fcfbff; }
    #example1 tbody tr:hover td{ background:var(--accent-light); }

    .dt-buttons{ margin-bottom:14px; }
    .dt-button{
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:13px !important; font-weight:600; line-height:1 !important;
        padding:9px 16px !important; border-radius:var(--radius-sm) !important;
        background:var(--mint-light) !important; color:var(--mint-dark) !important;
        border:1px solid #cdeee1 !important; box-shadow:none !important;
    }
    .dt-button:hover{ background:#d8f4e9 !important; }

    .dataTables_filter{ margin-bottom:14px !important; }
    .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:8px 14px !important; font-size:13px !important; background:#fafafa !important; margin-left:8px;
    }
    .dataTables_filter input:focus{ border-color:var(--accent) !important; background:#fff !important; outline:none; }
</style>	


<div class="row ">
    <div class="col-md-2">
    </div>
    <div class="col-md-8" style="margin-bottom: 24px;"> 

        <div class="box form-group">
            <div class="box-header with-border">
                <div class="box-title">
                    <h3 class="title" >
                        Rechercher, veuillez sélectionner une date :
                    </h3></div>

                <div class="col-md-12">
                    <form action="#" method="get" id="dateform">
                        <div class="input-group col-lg-12 col-md-12" >
                            <div class="col-md-12">
                            <input  type="button" onclick="document.getElementById('reservationtime').click()" class="btn btn-info calendar " >
                            <i onclick="document.getElementById('reservationtime').click()"  class="fa fa-clock-o"></i>
                            <input type="text" value="<?php echo $date; ?>" class="form-control " name="date" id="reservationtime" placeholder="Rechercher" style="margin-left: -2px;width: 81%;">
                        </div>
    
                            <div class="questions ">
                    <h3 style="display: inline-block;"> Type : </h3>
                    <p>
                        <input type="radio" name="type" value="0" id="Type0">
                        <label for="Type0">Non exporter</label>
                    </p>
                    <p>
                        <input type="radio" name="type" value="1" id="Type1">
                        <label for="Type1">Déja exporter</label>
                    </p>
                    <p>
                        <input type="radio"  name="type" value="2" id="Type2" checked="checked">
                        <label for="Type2">Tous les appels</label>
                    </p>
                </div>
                            <div class="col-md-12 text-center">
                            <input type="submit" value="Rechercher" class="btn btn-sm btn-success" style="    padding: 7px;"></div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>


<div class="box">
    <div class="box-header table-responsive">
        <h3 class="box-title">La liste des appels à exporter</h3>
    </div>
    <div class="box-body">
        <div class="table-scroll">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>type_tiers</th>
                    <th>code prospect/client</th>
                    <th>Code actions</th>
                    <th>état</th>
                    <th>Type action</th>
                    <th>intervenant_code</th>
                    <th>dordre_code</th>
                    <th>campagne</th>
                    <th>affaire</th>
                    <th>Objet</th>
                    <th>Priorité</th>
                    <th>date debut</th>
                    <th>date fin</th>
					<th>Heure debut</th>
                    <th>Heure fin</th>
					<th>connaissance</th>
					<th>disponibilite</th>
					<th>vente</th>
					<th>comment</th>
					<th>commercial</th>
					<th>commande</th>
                    <th>Apprécation</th>
                    <th>Question</th>
					<th>Objections</th>
					<th>Reclamations</th>
					<th>Propositions</th>
					<th>duree</th>
					<th>Actions CRM</th>
					
                </tr>
            </thead>
            <?php foreach ($appels as $appel):
			$campagne=$this->requestaction("/prospectaffaires/system_getaffaire/".$appel["Prospectfeuille"]["prospectcompagne_id"]);
			$ref="ACP".date("y")."_";
			for($i=0;$i<9-strlen($appel["Rapportprocpect"]["id"]);$i++)
				$ref.="0";
			$ref.=$appel["Rapportprocpect"]["id"];
			$date=explode(" ",$appel["Rapportprocpect"]["created"]); 
			$dat=explode("-",$date[0]);
			$dat="$dat[2]/$dat[1]/$dat[0]";
			$duree=explode(":",$appel["Rapportprocpect"]["duree"]);
			if(count($duree)==3)
				$duree=3600 * $duree[0] + 60 * $duree[1] + $duree[2];
			else
				$duree=0;
			$heure=explode(":",$date[1]);
			if($heure[1]>52)
				$heure[0]++;
			if($heure[0]==24)
				$heure[0]="00";
			if($heure[1]%15<7)
				$heure[1]=15*$heure[1]/15 - $heure[1]%15;
			else
				$heure[1]=15*$heure[1]/15 + (15-$heure[1]%15);
			$heur_debut=$heure[0].$heure[1];
			if($heure[1]==45)
			{
				$heure[0]++;
				$heure[1]="00";
			}
			else
				$heure[1]+=15;
			if($heure[0]==24)
				$heure[0]="00";
			$heur_fin=$heure[0].$heure[1];
			
					
			?>
                <tr>
				<td><?php echo $appel["Client"]["type_pharmacie"][0] ?></td>
                    <td><?php echo $appel["Client"]["code_wavsoft"] ?></td>
                    <td> <?php echo $ref ;?></td>
                    <td><?php echo $appel["Prospectfeuille"]["etat"][0] ?></td>
                    <td>TS</td>
                    <td><?php echo $appel["User"]["code_wavsoft"] ?></td>
                    <td><?php echo $campagne["User"]["code_wavsoft"] ?></td>
                    <td><?php echo $campagne["Prospectcompagne"]["code_wavesoft"]; ?></td>
                    <td><?php echo $campagne["Prospectaffaire"]["code_wavesoft"] ?></td>
					<td><?php echo $campagne["Prospectcompagne"]["name"]; ?></td>
					<td>N</td>
                    <td><?php echo $dat; ?></td>
                    <td><?php echo $dat; ?></td>
                    <td><?php echo $heur_debut; ?></td>
                    <td><?php echo $heur_fin; ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["connaissance"][0] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["disponibilite"][0] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["vente"][0] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["comment"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["commercial"][0] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["commande"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["appreciation"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["question"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["objection"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["reclamation"] ?></td>
                    <td><?php echo $appel["Rapportprocpect"]["proposition"] ?></td>
                    <td><?php echo $duree; ?></td>
					<td>O</td>                    
                </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('daterangepicker');
?>
<script>
                                var date = "";
                                document.addEventListener('DOMContentLoaded', function () {
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
                                        date = startDate + "--" + endDate;
                                    });
                                });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip'
			,
            buttons: [
                'excel'
            ]
        });
    });
</script>
