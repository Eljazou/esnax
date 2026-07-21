<?php echo $this->Html->css('dataTables.bootstrap');
		?>
<style>
    body { background: #f4f5fa; }

    .box {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(99, 60, 200, 0.08);
        overflow: hidden;
    }

    .box-header {
        background: #fff;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
        flex-wrap: wrap;
        gap: 12px;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .box-header .icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #eee9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .box-header .icon-circle svg {
        width: 24px;
        height: 24px;
        stroke: #6b46e5;
    }

    .box-header h3.box-title {
        color: #1e1e2e;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-groupe-modern {
        background: linear-gradient(135deg, #7b5ce8 0%, #9b6ef0 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s ease;
        text-decoration: none !important;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(123, 92, 232, 0.3);
    }

    .btn-groupe-modern:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    .btn-simple-modern {
        background: linear-gradient(135deg, #1e9e5a 0%, #35c47c 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s ease;
        text-decoration: none !important;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(30, 158, 90, 0.3);
    }

    .btn-simple-modern:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    .header-actions svg {
        width: 15px;
        height: 15px;
        stroke: #fff;
    }

    .box-body {
        padding: 8px 28px 28px;
    }

    .date-panel {
        background: #fbfaff;
        border: 1px solid #f0eefa;
        border-radius: 14px;
        padding: 24px;
        margin: 16px 0 24px;
    }

    .date-panel label {
        font-weight: 700;
        color: #2c2c3a;
        font-size: 14px;
        margin-bottom: 10px;
        display: block;
    }

    .date-panel select.form-control{
        border-radius: 10px;
        border: 1px solid #e0dbf7;
        padding: 10px 40px 10px 14px;
        font-size: 14px;
        height: auto;
        max-width: 420px;
        appearance: none;
        -webkit-appearance: none;
        background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b5ecb' stroke-width='2'><polyline points='6 9 12 15 18 9'/></svg>") no-repeat right 14px center;
        background-size: 16px;
        cursor: pointer;
    }

    .date-panel select.form-control:focus {
        border-color: #7b5ce8;
        box-shadow: none;
        outline: none;
    }

    .date-panel .well {
        background: none;
        border: none;
        box-shadow: none;
        padding: 16px 0 0;
        text-align: left !important;
    }

    .btn-envoyer {
        background: linear-gradient(135deg, #4a7bf0 0%, #6b9bf5 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 14px rgba(74, 123, 240, 0.3);
    }

    .btn-envoyer:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table.table thead th {
        background: #f2eefd;
        color: #6b5ecb;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none !important;
        padding: 12px 14px;
        white-space: nowrap;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 12px 14px;
        font-size: 13.5px;
        color: #3a3a4a;
        vertical-align: middle;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    table.table tbody td:first-child {
        font-weight: 600;
        color: #2c2c3a;
    }

    table.table tbody td a {
        color: #6b46e5;
        font-weight: 600;
        text-decoration: none;
    }

    table.table tbody td a:hover {
        text-decoration: underline;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
        margin-bottom: 16px;
    }

    .dataTables_wrapper .dataTables_filter label {
        color: #4a4a5a;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        border: 1px solid #e0dbf7;
        padding: 8px 14px;
        font-size: 14px;
        margin-left: 0 !important;
        min-width: 200px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #7b5ce8;
    }
</style>
<div class="box">
      <div class="box-header table-responsive">
           <div class="title-wrap">
                <div class="icon-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                </div>
                <h3 class="box-title">Nombre de contacts à atteindre par région et par produit</h3>
           </div>
		 	<div class="header-actions">
                <?php echo $this->Html->link(
                    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . __('Ajout groupé'),
                    array('action' => 'add'),
                    array('class'=>'btn-groupe-modern', 'escape' => false)
                );
                echo $this->Html->link(
                    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . "Ajout simple",
                    array('action' => 'ajout_unique'),
                    array('class'=>'btn-simple-modern', 'escape' => false)
                ); ?>
            </div>
      </div>
		<div class="box-body">
			<div class="panel-body">
			<div class="col-lg-6">
				<div class="date-panel">
					<?php echo $this->Form->create('Odpobjectif'); ?>
				<?php
					echo $this->Form->input('dates',array("options"=>$dates,'label' => 'Choix des dates','class'=>'form-control no-auto-select2'));
				?>
			<?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn-envoyer','div' => array('class' => 'well text-center col-md-12'))); ?>
			</div>
		</div>
		</div>
		</div>
		 <?php if(!empty($odps)): ?>
         <table id="example1" class="table table-bordered table-striped">
		 <thead>
			<tr>
				<th>Regions</th>
				<?php $region_odp=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR"); 
					 foreach($region_odp as $k=>$v)
						echo "<th>$v</th>";
				?>
				<th>Début</th>
				<th>fin</th>
				<th>#</th>
			</tr>
	</thead>
	<?php foreach ($brochures as $id=>$v): 
	?>
	<tr>
		<td> <?php echo $v; ?></td>
		<?php $region_odp=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR");
				foreach($region_odp as $k=>$v)
				{
					$found = false;
					foreach($odps as $odp)
					{
						if($odp["Odpobjectif"]["region"]==$v && $odp["Odpobjectif"]["brochure_id"]==$id)
						{
							echo "<td>".$this->Html->link($odp["Odpobjectif"]["objectif"], array('action' => 'edit', $odp['Odpobjectif']['id']))."</td>";
							$found = true;
							break;
						}
					}
					if (!$found) {
						echo "<td>-</td>";
					}
				}
				echo "<td>".$odp["Odpobjectif"]["date_debut"]."</td>";
				echo "<td>".$odp["Odpobjectif"]["date_fin"]."</td>";
				echo '<td class="actions">';
				//echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $odp['Odpobjectif']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $odp['Odpobjectif']['id'])));
				echo '</td>';
				?>
	</tr>
<?php endforeach; ?>
	</table>
	<?php endif; ?>
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
    // Snapshot our jQuery instance right after our plugins load, before Metronic's own
    // bundles can silently reassign window.jQuery.
    window.CRMJQ = jQuery;

    // IMPORTANT: we do NOT use $(document).ready() / CRMJQ(function(){...}) here.
    // This page's layout registers an earlier ready-callback (from app.min.js) that
    // throws an uncaught error. In jQuery 2.2.3, that breaks the internal ready-callback
    // chain and silently prevents every ready handler registered AFTER it from ever
    // running — including ours. Since this <script> tag is placed after all the page's
    // HTML (select, table, etc.), those elements already exist in the DOM right now,
    // so we can just run immediately instead of waiting for "ready" at all.
    (function () {
        var $datesSelect = CRMJQ('.date-panel select.no-auto-select2');
        try {
            if ($datesSelect.data('select2')) {
                $datesSelect.select2('destroy');
            }
        } catch (e) { /* no-op: nothing to destroy */ }
        $datesSelect.prop('disabled', false).show();

        CRMJQ('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    })();
</script>
