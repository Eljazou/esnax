<?php echo $this->Html->css('daterangepicker'); ?>
<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

	.box, .box-title, th, td, h1, h2, h3, select, input, button {
		font-family: 'Poppins', sans-serif !important;
	}

	/* ---------- CARD ---------- */
	.box {
		background: #ffffff !important;
		border: 1px solid rgba(229, 224, 251, 0.7) !important;
		border-radius: 18px !important;
		box-shadow: 0 12px 34px rgba(140, 126, 242, 0.07) !important;
		overflow: hidden;
	}

	.box-header {
		border: none !important;
		padding: 22px 24px 10px 24px !important;
	}

	.box-title {
		font-size: 16px !important;
		font-weight: 600 !important;
		color: #44444f !important;
		position: relative;
		padding-left: 20px !important;
		padding-bottom: 10px;
		display: flex !important;
		align-items: center;
		line-height: normal !important;
	}
	/* three-dot accent, pure CSS (no icon font dependency) */
	.box-title::before {
		content: '';
		position: absolute;
		left: 3px;
		top: 1px;
		width: 3px;
		height: 3px;
		border-radius: 50%;
		background: #8c7ef2;
		box-shadow: 0 5px 0 #8c7ef2, 0 10px 0 #8c7ef2;
	}
	.box-title > .btn.bg-purple {
		margin-left: auto;
	}

	/* ---------- "DEMANDER DES ECHANTILLONS" BUTTON ---------- */
	.btn.bg-purple {
		background: linear-gradient(135deg, #8f7cf6 0%, #6c5ce7 100%) !important;
		color: #ffffff !important;
		font-weight: 600 !important;
		font-size: 13px !important;
		border-radius: 10px !important;
		border: none !important;
		padding: 10px 20px !important;
		display: inline-flex !important;
		align-items: center !important;
		gap: 8px !important;
		box-shadow: 0 4px 14px rgba(140, 126, 242, 0.28) !important;
		text-decoration: none !important;
		float: none !important;
		transition: transform .15s ease, box-shadow .15s ease;
	}
	.btn.bg-purple:hover {
		color: #ffffff !important;
		transform: translateY(-1px);
		box-shadow: 0 6px 18px rgba(140, 126, 242, 0.36) !important;
	}
	/* plus icon drawn in pure CSS, no icon font needed */
	.btn.bg-purple::after {
		content: '';
		width: 11px;
		height: 11px;
		flex-shrink: 0;
		background-image: linear-gradient(#fff, #fff), linear-gradient(#fff, #fff);
		background-position: center;
		background-repeat: no-repeat;
		background-size: 100% 2px, 2px 100%;
	}

	/* ---------- CSV / EXCEL / PRINT BUTTONS ---------- */
	.box-body {
		overflow: scroll;
		overflow-y: hidden;
		padding: 8px 24px 24px 24px !important;
	}
	.box-body::-webkit-scrollbar { height: 8px; }
	.box-body::-webkit-scrollbar-thumb { background: #e5e0fb; border-radius: 8px; }
	.box-body::-webkit-scrollbar-track { background: transparent; }

	.dt-buttons { margin-bottom: 16px; overflow: hidden; }

	.dt-button {
		width: auto !important;
		float: left;
		margin: 0 8px 8px 0 !important;
		font-size: 13px !important;
		font-weight: 600 !important;
		line-height: normal !important;
		padding: 9px 16px 9px 34px !important;
		background: #ffffff !important;
		color: #44444f !important;
		border: 1px solid #ececf5 !important;
		border-radius: 10px !important;
		box-shadow: 0 4px 12px rgba(140, 126, 242, 0.06) !important;
		position: relative;
		transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
	}
	.dt-button:hover {
		background: #faf9ff !important;
		color: #6c5ce7 !important;
		transform: translateY(-1px);
		box-shadow: 0 6px 16px rgba(140, 126, 242, 0.16) !important;
	}
	.dt-button::before {
		content: '';
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		width: 14px;
		height: 14px;
		background-repeat: no-repeat;
		background-size: contain;
	}
	.buttons-csv::before {
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238c7ef2' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z'/%3E%3Cpath d='M14 2v6h6'/%3E%3C/svg%3E");
	}
	.buttons-excel::before {
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232FBE73' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='18' height='18' rx='2'/%3E%3Cline x1='3' y1='9' x2='21' y2='9'/%3E%3Cline x1='3' y1='15' x2='21' y2='15'/%3E%3Cline x1='9' y1='3' x2='9' y2='21'/%3E%3Cline x1='15' y1='3' x2='15' y2='21'/%3E%3C/svg%3E");
	}
	.buttons-print::before {
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234FA8E0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9V2h12v7'/%3E%3Cpath d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'/%3E%3Crect x='6' y='14' width='12' height='8'/%3E%3C/svg%3E");
	}

	/* ---------- TABLE ---------- */
	#example1.table {
		border: 1px solid #f1f1f8 !important;
		border-radius: 14px !important;
		border-collapse: separate !important;
		border-spacing: 0 !important;
	}

	#example1.table thead th {
		background: #FAF9FF !important;
		color: #6c5ce7 !important;
		font-weight: 600 !important;
		font-size: 11.5px !important;
		text-transform: uppercase !important;
		letter-spacing: .3px;
		border: none !important;
		border-bottom: 1px solid #f1f1f8 !important;
		padding: 13px 14px !important;
		white-space: nowrap;
	}

	#example1.table tbody td {
		vertical-align: middle !important;
		border: none !important;
		border-bottom: 1px solid #f8f8fc !important;
		padding: 12px 14px !important;
		font-size: 13px;
		color: #44444f;
		white-space: nowrap;
	}

	#example1.table.table-striped tbody tr:nth-of-type(odd) td {
		background-color: #fbfaff !important;
	}

	#example1.table tbody tr:hover td {
		background-color: #f4f2ff !important;
	}

	#example1.table tbody td a {
		color: #6c5ce7;
		font-weight: 500;
		text-decoration: none;
	}
	#example1.table tbody td a:hover {
		text-decoration: underline;
	}

	/* vertical "Total" column (last column of every row) */
	.total-col {
		font-weight: 700 !important;
		color: #6c5ce7 !important;
		background-color: #F3F1FF !important;
	}
	#example1.table.table-striped tbody tr:nth-of-type(odd) .total-col {
		background-color: #EFEBFF !important;
	}

	/* bottom-of-table "Total" row */
	.total-row td {
		font-weight: 700 !important;
		color: #1a1d36 !important;
		background-color: #F3F1FF !important;
		border-top: 2px solid #e5e0fb !important;
	}
	.total-row .total-col {
		background-color: #E5E0FB !important;
	}
</style>
<div class="row"> 
    <div class="col-md-12"> 
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Stcok temps reél'); ?>
                    <?php if ($this->requestAction('/droits/getrole/Gadjets/add') == 1)
                        echo $this->Html->link(__('Demander des échantillons'), array('action' => 'add'), array('class' => "btn bg-purple btn-flat margin"));
                    ?>
                </h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <?php
                            foreach ($echantillons as $key => $value) {
                                echo "<th>$value</th>";
                            }
                            ?>                    
                            <th>Total</th>
                        </tr>
                    </thead>
                    <?php
                    $totalvertical = array();
                    if (!isset($super))
                        $super = array();
                    foreach ($super as $supe):
                        $vmps=$this->requestAction('/users/system_get_user_for_superviseur/'.$supe['User']['id']);
                            foreach ($vmps as $user):
                                $stock=$this->requestAction('/echantillons/system_get_stock/'.$user['User']['id']);
                                ?>
                                <tr >
                                    <td><?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></td>
                                    <?php
                                    $total = 0;
                                    $i = 0;
                                    foreach ($echantillons as $key => $value) {
                                        if (!isset($totalvertical[$i]))
                                            $totalvertical[$i] = 0;
                                        if (empty($stock))
                                            echo "<td>0</td>";
                                        else {
                                            $g = 0;
                                            foreach ($stock as $gadjet) 
                                            {
                                                if($gadjet['Stockgadjet']['echantillon_id']==$key)
                                                $g =  $gadjet['Stockgadjet']['quantite'];
                                            }
                                            echo "<td>$g</td>";
                                            $total = $total + $g;
                                            $totalvertical[$i] = $totalvertical[$i] + $g;
                                        }
                                        $i++;
                                    }
                                    ?>  
                                    <td class="total-col"><?php echo $total; ?></td>
                                </tr>
                                <?php 
                            endforeach;
                        endforeach; ?>
                    <tr class="total-row">
                        <td>Total</td>
                        <?php
                        $nbrEch = count($echantillons);
                        if (!empty($totalvertical)) {
                            foreach ($totalvertical as $key => $value)
                                echo "<td>$value</td>";
                        } else {
                            for ($i = 0; $i < $nbrEch + 1; $i++) {
                                echo "<td>&nbsp;</td>";
                            }
                        }
                        ?>
                        <td class="total-col">&nbsp;</td>
                    </tr>
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
<?php
echo $this->Html->script('daterangepicker');
?>
<script>
    $(function () {
        $("#example1").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "order": [1, 1],
            "iDisplayLength": 50,
			dom: 'Bfrtip',
			buttons: [
				 'csv', 'excel', 'print'
			]
        });
    });
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
</script>
