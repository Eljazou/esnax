<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('btn-style');
echo $this->Html->script('fontawesome');
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
        --amber-dark:#e08a17;
        --amber-light:#fff4e2;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
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

    /* ---------- Card / table shell ---------- */
    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px;
    }
    .box .box-header{ border-bottom:none; padding:20px 24px 8px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }
    .box-title{ margin:0; font-size:16px; font-weight:700; color:var(--text-dark); display:flex; align-items:center; }
    .box-title:before{
        content:"\f0d6"; font-family:"FontAwesome"; display:inline-flex; align-items:center; justify-content:center;
        width:32px; height:32px; border-radius:50%; margin-right:10px; font-size:14px;
        background:var(--accent-light); color:var(--accent-dark);
    }

    table.display, #example1{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    #example1 thead th{
        background:var(--accent-pale) !important; color:var(--accent-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:12px 14px !important;
    }
    #example1 thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    #example1 thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    #example1 tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:12px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    #example1 tbody tr:hover td{ background:var(--accent-light); }
    #example1 tbody tr:last-child td{ border-bottom:none !important; }
    #example1 a{ font-weight:600; text-decoration:none; }
    #example1 a:hover{ text-decoration:underline; }

    /* status badge (mirrors the existing etat === "Terminer" condition) */
    .etat-badge{
        display:inline-block; padding:.35em .9em; border-radius:20px; font-size:12.5px; font-weight:700;
    }
    .etat-badge.etat-termine{ background:var(--mint-light); color:var(--mint-dark); }
    .etat-badge.etat-a-traiter{ background:var(--amber-light); color:var(--amber-dark); }
    .etat-badge.etat-autre{ background:var(--accent-pale); color:var(--accent-dark); }

    .btn-in.btn-outline-info{
        background:var(--accent-light) !important; color:var(--accent-dark) !important;
        border:1px solid var(--accent-pale) !important; border-radius:20px !important;
        padding:5px 14px !important; font-size:12.5px !important; font-weight:600; box-shadow:none !important;
    }
    .btn-in.btn-outline-info:hover{ background:var(--accent-pale) !important; }

    .dataTables_wrapper .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:8px 14px !important; font-size:13.5px !important; background:#fafafa !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus{ border-color:var(--accent) !important; background:#fff !important; outline:none; }
</style>	


<div class="row">
    
    <div class="col-md-12">
        <div class="box">
            <div class="box-header table-responsive">
                <h3 class="box-title">La liste des opportunités</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Type</th>
                            <th>Ville</th>
                            <th>Region</th>
                            <th>Campagne</th>
                            <th>Etat</th>
                            <th>Date d'appel</th>
                            <th class="actions">#</th>
                        </tr>
                    </thead>
                    <?php foreach ($opportinites as $opportinite): ?>
                        <tr  <?php
                        if ($opportinite['Prospectfeuille']['etat'] == "Terminer")
                            echo 'style="background-color: #e6faf3;"';
                        ?>
						>
                            <td><?php echo $this->Html->link($opportinite['Client']['nom'], array('controller' => 'clients', 'action' => 'view', $opportinite['Client']['id'])); ?></td>
                            <td><?php echo $opportinite['Client']['type_pharmacie']; ?>&nbsp;</td>
                            <td><?php echo $opportinite['Secteur']['ville']; ?>&nbsp;</td>
                            <td><?php echo $opportinite['Secteur']['region']; ?>&nbsp;</td>
                            <td><?php echo $opportinite['Prospectcompagne']['name']; ?></td>
                            <td>
                                <?php
                                $etat = $opportinite['Prospectfeuille']['etat'];
                                $etat_class = 'etat-autre';
                                if ($etat == 'Terminer')
                                    $etat_class = 'etat-termine';
                                elseif ($etat == 'A traiter')
                                    $etat_class = 'etat-a-traiter';
                                ?>
                                <span class="etat-badge <?php echo $etat_class; ?>"><?php echo $etat; ?></span>
                            </td>
                            <td><?php echo $opportinite['Rapportprocpect']['created']; ?>&nbsp;</td>
                            <td class="actions">
                                <?php
								echo $opportinite['Prospectfeuille']['commercial_programmer'];
                                if ($this->requestAction('/droits/getrole/rapportprocpects/traiter') == 1
								&& $opportinite['Prospectfeuille']['etat']=='A traiter') 
                                        echo "<br>".$this->Html->link(" Traité", array('action' => 'traiter',$opportinite['Prospectcompagne']['id'], $opportinite['Rapportprocpect']['id']), array('class' => 'ion-android-call btn-in btn btn-outline-info'));
                                ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
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
            date = startDate + "--" + endDate;
        });
    });
</script>

<script>
    $(function () {
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
                    //,
                    //buttons: [
                    //'excel'
                    //]
        });
    });
</script>
