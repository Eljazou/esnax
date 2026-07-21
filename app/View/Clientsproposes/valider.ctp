<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
	@media (max-width:1269px){
		.box-body{
			overflow: scroll;
			overflow-y: hidden;
		}
	}
</style>

<style>
/* ================== MODERN RESTYLE (CSS/SVG only — no PHP logic touched) ================== */
.ptg-wrapper{
	--ptg-purple: #6C63F5;
	--ptg-purple-dark: #5750d9;
	--ptg-purple-soft: #EEECFE;
	--ptg-text: #2c2e3a;
	--ptg-muted: #8a8fa3;
	--ptg-border: #ececf5;
}
.ptg-wrapper .box{
	background: #fff;
	border: 1px solid var(--ptg-border);
	border-radius: 16px !important;
	box-shadow: 0 4px 18px rgba(108,99,245,0.08);
	overflow: hidden;
}
.ptg-wrapper .box-header{
	border: none !important;
	background: transparent;
	padding: 22px 24px 18px 24px;
	display: flex;
	align-items: flex-start;
	gap: 14px;
}
.ptg-header-icon{
	width: 46px;
	height: 46px;
	min-width: 46px;
	border-radius: 12px;
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple);
	display: flex;
	align-items: center;
	justify-content: center;
}
.ptg-header-icon svg{ width: 22px; height: 22px; display: block; }
.ptg-wrapper .box-header .box-title{
	font-weight: 700 !important;
	font-size: 17px !important;
	color: var(--ptg-text) !important;
	margin: 0 !important;
	width: auto;
	float: none;
}
.ptg-header-sub{
	font-size: 13px;
	color: var(--ptg-muted);
	margin-top: 3px;
	font-weight: 400;
}
.ptg-wrapper .box-body{
	padding: 0 24px 24px 24px;
}

/* table */
.ptg-wrapper table.dataTable{
	border-collapse: separate !important;
	border-spacing: 0;
}
.ptg-wrapper table.dataTable thead tr th{
	background: var(--ptg-purple-soft) !important;
	color: var(--ptg-purple-dark) !important;
	font-weight: 700;
	font-size: 12.5px;
	text-transform: uppercase;
	letter-spacing: .02em;
	border-bottom: none !important;
	padding: 12px 14px !important;
	white-space: nowrap;
}
.ptg-wrapper table.dataTable thead tr th:first-child{ border-radius: 10px 0 0 10px; }
.ptg-wrapper table.dataTable thead tr th:last-child{ border-radius: 0 10px 10px 0; }
.ptg-wrapper table.dataTable tbody td{
	border-top: 1px solid var(--ptg-border) !important;
	padding: 12px 14px;
	font-size: 13.5px;
	color: var(--ptg-text);
	vertical-align: middle;
}
.ptg-wrapper table.dataTable.table-striped tbody tr:nth-of-type(odd){
	background: #fafaff;
}
.ptg-wrapper table.dataTable tbody tr:hover{
	background: #f5f4ff;
}

/* empty state (in case DataTables ever renders it) */
.ptg-wrapper td.dataTables_empty{
	padding: 60px 10px !important;
	color: var(--ptg-text);
	font-size: 15px;
	font-weight: 600;
}
.ptg-wrapper td.dataTables_empty::before{
	content: "";
	display: block;
	width: 56px;
	height: 56px;
	margin: 0 auto 14px auto;
	background: var(--ptg-purple-soft);
	border-radius: 14px;
}

/* action button */
.ptg-wrapper td.actions .btn{
	border-radius: 10px !important;
	background: var(--ptg-purple) !important;
	border: none !important;
	color: #fff !important;
	padding: 6px 16px !important;
	font-weight: 500;
	font-size: 13px;
	box-shadow: 0 3px 10px rgba(108,99,245,0.25);
}
.ptg-wrapper td.actions .btn:hover{
	background: var(--ptg-purple-dark) !important;
	color: #fff !important;
}
</style>

<div class="ptg-wrapper">
<div class="box">
    <div class="box-header">
        <span class="ptg-header-icon">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
		</span>
		<div>
			<h3 class="box-title"><?php echo __('Liste des clients proposés'); ?></h3>
			<div class="ptg-header-sub">Consultez les clients proposés par les employés</div>
		</div>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                 <tr>
                     <th>Employé</th>
                    <th>Type</th>
                    <th>Secteur</th>
                    <th>Spécialité</th>
                    <th>Tendance</th>
                    <th>Nom & prénom</th>
                    <th>Titre</th>
                    <th>Potentialité</th>
                    <th>Téléphone</th>
                    <th>Fixe</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($clientsproposes as $clientspropose): ?>
                <tr>
                    <td><?php echo $this->Html->link($clientspropose['User']['name'], array('controller' => 'users', 'action' => 'view', $clientspropose['User']['id'])); ?></td>
                    <td><?php echo $clientspropose['Type']['name']; ?></td>
                    <td><?php echo $clientspropose['Secteur']['region'].' '.$clientspropose['Secteur']['ville'].' '.$clientspropose['Secteur']['secteur']; ?></td>
                    <td><?php if($clientspropose['Clientspropose']['category1_id']==null)
                                echo $clientspropose['Category']['name'];
                              else
                                echo $clientspropose['Category1']['name']; ?>&nbsp;</td>
                    <td><?php echo $clientspropose['Category']['name'] ?></td>
                    <td><?php echo h($clientspropose['Clientspropose']['nom'].' '.$clientspropose['Clientspropose']['prenom']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['titre']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['potentialitev2']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['tel']); ?>&nbsp;</td>
                    <td><?php echo h($clientspropose['Clientspropose']['fixe']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php 
                        if($this->requestAction('/droits/getrole/clientsproposes/view')==1)
                            echo $this->Html->link(__('Voir'), array('action' => 'view', $clientspropose['Clientspropose']['id']), array('class'=>"btn btn-primary bg-aqua btn-sm")); 
                        ?>
                    </td>
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
<script>
$(function () {
    $("#example1").DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "iDisplayLength": 50,
        "language": {
            "zeroRecords": "Aucune donnée disponible dans le tableau"
        }
    });
    $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "iDisplayLength": 50,
        "language": {
            "zeroRecords": "Aucune donnée disponible dans le tableau"
        }
    });
});
</script>