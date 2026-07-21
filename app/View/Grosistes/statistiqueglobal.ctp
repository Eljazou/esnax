<?php 
echo $this->Html->css('dataTables.bootstrap');
		?>	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --primary: #6C63F5;
    --primary-light: #ece9fe;
}

body, .box, .form-control { font-family: 'Poppins', sans-serif; }

/* Kill the AdminLTE box chrome; we build our own card look */
.box {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* ===== Hero header ===== */
.gro-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(120deg, #ffffff 0%, #ffffff 55%, #ece7fd 100%);
    border-radius: 22px;
    box-shadow: 0 4px 20px rgba(108, 99, 245, 0.08);
    padding: 26px 30px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 20px;
}

.gro-hero-icon {
    width: 54px;
    height: 54px;
    min-width: 54px;
    border-radius: 16px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}

.gro-hero-text { z-index: 2; }

.box-title {
    font-weight: 700 !important;
    color: #171730 !important;
    margin: 0 !important;
    display: inline-block;
}

.gro-hero-text .box-title:first-of-type { font-size: 22px !important; }
.gro-hero-text .box-title:nth-of-type(2) { font-size: 22px !important; color: var(--primary) !important; margin-left: 8px !important; }

.gro-hero-subtitle {
    font-size: 13.5px;
    color: #8d8da8;
    font-weight: 500;
    margin-top: 4px;
}

.gro-hero-illustration {
    position: absolute;
    top: 0;
    right: 0;
    opacity: .9;
    z-index: 1;
    pointer-events: none;
}

/* ===== Controls row: year select + total card ===== */
.gro-controls-row {
    display: flex;
    align-items: stretch;
    gap: 20px;
    margin-bottom: 22px;
    flex-wrap: wrap;
}

.gro-year-card {
    flex: 1;
    min-width: 260px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(108, 99, 245, 0.06);
    padding: 20px 22px;
}

.gro-year-card label {
    font-weight: 700;
    font-size: 13.5px;
    color: #171730;
    display: block;
    margin-bottom: 10px;
}

.gro-year-select-wrap {
    position: relative;
}

.gro-year-select-wrap svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary);
    pointer-events: none;
}

#annee {
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    border: 1.5px solid #e7e6f7;
    border-radius: 10px;
    padding: 10px 14px 10px 40px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    color: #171730;
    background: #fff;
}

#annee:focus { border-color: var(--primary); outline: none; }

.gro-total-card {
    min-width: 220px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(108, 99, 245, 0.06);
    padding: 20px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
}

.gro-total-card .gro-total-label {
    font-size: 13.5px;
    font-weight: 700;
    color: #171730;
    margin-bottom: 6px;
}

.gro-total-card .gro-total-value {
    font-size: 26px;
    font-weight: 700;
    color: #171730;
}

.gro-total-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 12px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== Section cards (Total + per-ville tables) ===== */
.box-body.table-responsive {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(108, 99, 245, 0.06);
    padding: 24px 26px 26px;
    margin-bottom: 22px;
}

.box-body.table-responsive > big {
    display: block;
    font-size: 16px;
    font-weight: 700;
    color: #171730;
    margin-bottom: 14px;
}

/* ===== CSV / Excel buttons ===== */
.dt-buttons { margin-bottom: 16px !important; }

.dt-button {
    width: auto !important;
    float: none !important;
    display: inline-flex !important;
    align-items: center;
    gap: 6px;
    margin: 0 10px 0 0 !important;
    font-size: 13.5px !important;
    font-weight: 600;
    line-height: 1.4 !important;
    padding: 8px 18px !important;
    border-radius: 20px !important;
    border: none !important;
    color: #fff !important;
    background: var(--primary) !important;
}

.dt-buttons .dt-button:nth-child(1) {
    background: var(--primary) !important;
}

.dt-buttons .dt-button:nth-child(2) {
    background: #2fbf71 !important;
}

.dt-button:hover {
    filter: brightness(0.92);
    color: #fff !important;
}

.dt-button:before {
    content: "";
    width: 14px;
    height: 14px;
    display: inline-block;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/%3E%3Cpath d='M14 2v6h6'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
}

/* ===== Table ===== */
table.display {
    border-collapse: collapse !important;
    width: 100% !important;
}

table.display thead tr th {
    font-size: 13px !important;
    font-weight: 700 !important;
    color: #6b6b85 !important;
    background: #fbfaff !important;
    padding: 10px 8px !important;
    border-bottom: 1.5px solid #e7e6f7 !important;
    border-top: none !important;
    white-space: nowrap;
}

table.display thead tr th:first-child {
    text-align: left;
}

table.display tbody tr td {
    border: none !important;
    border-bottom: 1px solid #f1effa !important;
    padding: 10px 6px !important;
    font-size: 13.5px;
    color: #171730;
    text-align: center;
}

table.display.table-striped tbody tr:nth-of-type(odd) {
    background: #fff !important;
}

table.display tbody tr td:first-child {
    text-align: left;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    max-width: none !important;
}

table.display tbody tr td:first-child:before {
    content: "";
    width: 26px;
    height: 26px;
    min-width: 26px;
    border-radius: 8px;
    background: var(--primary-light);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236C63F5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'/%3E%3Cpolyline points='3.27 6.96 12 12.01 20.73 6.96'/%3E%3Cline x1='12' y1='22.08' x2='12' y2='12'/%3E%3C/svg%3E");
    background-size: 15px 15px;
    background-position: center;
    background-repeat: no-repeat;
    display: inline-block;
}

table.display tbody tr td:not(:first-child) {
    background: #fbfaff;
    border-radius: 8px;
}

/* ===== DataTables pagination footer ===== */
.dataTables_wrapper .dataTables_info {
    font-size: 13px;
    color: #8d8da8;
    padding-top: 14px !important;
}

.dataTables_wrapper .dataTables_length {
    font-size: 13px;
    color: #8d8da8;
}

.dataTables_wrapper .dataTables_length select {
    border: 1.5px solid #e7e6f7;
    border-radius: 8px;
    padding: 4px 8px;
    font-family: 'Poppins', sans-serif;
    margin: 0 4px;
}

.dataTables_wrapper .dataTables_paginate {
    padding-top: 10px !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 8px !important;
    border: 1.5px solid #e7e6f7 !important;
    margin-left: 4px !important;
    padding: 5px 11px !important;
    color: #6b6b85 !important;
    background: #fff !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: var(--primary) !important;
    border-color: var(--primary) !important;
    color: #fff !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--primary-light) !important;
    border-color: var(--primary-light) !important;
    color: var(--primary) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: .5;
}
</style>

<div class="row">
<div class="col-xs-12">

	<div class="box">
    <div class="box-header">
        <div class="gro-hero">
            <div class="gro-hero-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
            </div>
            <div class="gro-hero-text">
                <h3 class="box-title"><?php echo __('Grossistes'); ?></h3>
		        <h3 class="box-title"><?php echo $anne; ?></h3>
                <div class="gro-hero-subtitle">Suivez les grossistes mois par mois</div>
            </div>
            <svg class="gro-hero-illustration" width="200" height="130" viewBox="0 0 200 130" fill="none">
                <path d="M40 130 Q100 40 200 60 L200 130 Z" fill="#ece7fd"/>
                <rect x="130" y="30" width="55" height="75" rx="6" fill="#fff" stroke="#c9bff5" stroke-width="2"/>
                <rect x="140" y="42" width="35" height="22" rx="3" fill="#ece7fd"/>
                <path d="M147 58 L157 48 L164 55 L172 44" stroke="#8f7bfb" stroke-width="1.5" fill="none"/>
                <rect x="140" y="70" width="35" height="3" rx="1.5" fill="#e2ddfb"/>
                <rect x="140" y="78" width="30" height="3" rx="1.5" fill="#e2ddfb"/>
                <rect x="140" y="86" width="25" height="3" rx="1.5" fill="#e2ddfb"/>
                <circle cx="120" cy="30" r="3" fill="#8f7bfb" opacity="0.5"/>
                <circle cx="192" cy="35" r="2.5" fill="#8f7bfb" opacity="0.6"/>
                <path d="M185 90 q10 -15 20 -5 q-10 5 -20 5z" fill="#a8e6b0" opacity="0.6"/>
            </svg>
        </div>

        <div class="gro-controls-row">
            <div class="gro-year-card">
                <label for="annee">Sélectionnez une année :</label>
                <form method="POST" action="">
                    <div class="gro-year-select-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <select id="annee" name="annee" onchange="changerAnnee()">
                            <option value="">--Choisir une année--</option>
                              <?php for($i=date("Y");$i>date("Y")-3;$i--)
                              {
                                  echo "<option value='$i'>$i</option>";
                              }?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="gro-total-card">
                <div>
                    <div class="gro-total-label">Total général</div>
                    <div class="gro-total-value" id="gro-grand-total">0</div>
                </div>
                <div class="gro-total-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body table-responsive">
	
    <big>Total</big>
      	
        <table id="example1" class="display table table-bordered table-striped">
            <thead>
			<tr>
				<th>Produit</th>
				<?php for($i=1;$i<13;$i++)
						echo "<th>$i-".$anne."</th>"; ?>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach ($groproduits as $id=>$p):  ?>
        <tr>
            <td style="max-width:150px;"><?php echo $p; ?></td>
            <?php 
            for($i=1;$i<13;$i++)
            {
                $quan=0;
                $zero="";
                if($i<10)
                    $zero="0";
                $date=$anne."-$zero$i";
				foreach($grosistes as $grosiste)
				{
					foreach ($grosiste['Grovente'] as $grovente) {                        
							$dv=$grovente['date'];
							$dv=explode("-", $dv);
							$dv=$dv[0]."-".$dv[1];
							//echo $grovente['quantite']." :: $dv : $date <br>";
							if($dv==$date && $grovente['groproduit_id']==$id)
							{
								$quan=$quan+$grovente['quantite'];
								$dd=$date;
							}
					 }
				}?>
				<td><?php echo $quan; ?></td>
            <?php } ?>

        </tr>
	<?php endforeach; ?>
	</tbody>
    </table>
 </div>
 
 <?php foreach ($villes as $ville) :?>
 <div class="box-body table-responsive">
	
    <big><?php echo $ville['grosistes']['region']; ?></big>
      	
        <table id="example1" class="display table table-bordered table-striped">
            <thead>
			<tr>
				<th>Produit</th>
				<?php for($i=1;$i<13;$i++)
						echo "<th>$i-".date("Y")."</th>"; ?>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach ($groproduits as $id=>$p):  ?>
        <tr>
            <td style="max-width:150px;"><?php echo $p; ?></td>
            <?php 
            for($i=1;$i<13;$i++)
            {
                $quan=0;
                $zero="";
                if($i<10)
                    $zero="0";
                $date=date('Y')."-$zero$i";
				foreach($grosistes as $grosiste)
				{
					if($grosiste["Grosiste"]["region"]==$ville['grosistes']['region'])
					{
						foreach ($grosiste['Grovente'] as $grovente) {                        
								$dv=$grovente['date'];
								$dv=explode("-", $dv);
								$dv=$dv[0]."-".$dv[1];
								//echo $grovente['quantite']." :: $dv : $date <br>";
								if($dv==$date && $grovente['groproduit_id']==$id)
								{
									$quan=$quan+$grovente['quantite'];
									$dd=$date;
								}
						 }
					}
				}?>
				<td><?php echo $quan; ?></td>
            <?php } ?>

        </tr>
	<?php endforeach; ?>
	</tbody>
    </table>
 </div>
 <?php endforeach;?>
	
	 </div>
	</div>
</div>
 
	<?php echo $this->Html->script('jquery-2.2.3.min');
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
<script>
    $(function () {
        $('.display').DataTable({
            "paging": true,
			"pageLength": 10,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
			"language": {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "_MENU_ par page",
				"sInfo":           "Affichage de _START_ à _END_ sur _TOTAL_ produits",
				"sInfoEmpty":      "Affichage de 0 à 0 sur 0 produit",
				"sInfoFiltered":   "(filtré de _MAX_ produits au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun élément à afficher",
				"sEmptyTable":     "Aucune donnée disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "«",
					"sNext":       "»",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre décroissant"
				}
			},
			dom: 'Bfrtip',
			buttons: [
				 'csv', 'excel'
			]
        });

        // Compute the grand total across the full "Total" table (all rows, all months),
        // independent of DataTables' pagination — presentational only, no data logic changed.
        var grandTotal = 0;
        $('#example1').first().find('tbody tr').each(function () {
            $(this).find('td:not(:first-child)').each(function () {
                var v = parseFloat($(this).text());
                if (!isNaN(v)) { grandTotal += v; }
            });
        });
        $('#gro-grand-total').text(grandTotal);
    });
</script>

<script>
function changerAnnee() {
  var select = document.getElementById("annee");
  var annee = select.options[select.selectedIndex].value;
  var form = document.createElement("form");
  form.setAttribute("method", "POST");
  form.setAttribute("action", "");
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "annee");
  input.setAttribute("value", annee);
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}
</script>
