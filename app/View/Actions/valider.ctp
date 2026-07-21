<?php echo $this->Html->css('dataTables.bootstrap'); ?>	
<style>
     @media (max-width:1282px){
        .box-body{
            overflow: scroll;
            overflow-y: auto;
			padding-bottom:60px;
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
	--ptg-green: #21a366;
	--ptg-yellow: #e0a800;
	--ptg-red: #e5484d;
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

/* empty state */
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
.ptg-empty-sub{
	display: block;
	margin-top: 6px;
	font-size: 13px;
	font-weight: 400;
	color: var(--ptg-muted);
}

/* DataTables chrome */
.ptg-wrapper .dataTables_wrapper{
	padding-top: 4px;
}
.ptg-wrapper .dataTables_filter{
	margin-bottom: 14px;
}
.ptg-wrapper .dataTables_filter label{
	font-size: 13.5px;
	color: var(--ptg-text);
	font-weight: 500;
}
.ptg-wrapper .dataTables_filter input{
	border: 1px solid var(--ptg-border) !important;
	border-radius: 10px !important;
	padding: 8px 14px 8px 34px !important;
	box-shadow: none !important;
	font-size: 13.5px;
	min-width: 220px;
	background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238a8fa3' stroke-width='2'><circle cx='11' cy='11' r='7'></circle><line x1='21' y1='21' x2='16.65' y2='16.65'></line></svg>") no-repeat 10px center;
	background-size: 15px 15px;
}
.ptg-wrapper .dataTables_filter input:focus{ border-color: var(--ptg-purple) !important; }
.ptg-wrapper .dataTables_paginate{
	margin-top: 14px;
}
.ptg-wrapper .dataTables_paginate .paginate_button{
	border-radius: 8px !important;
	border: 1px solid var(--ptg-border) !important;
	margin-left: 4px;
	color: var(--ptg-text) !important;
	background: #fff !important;
	padding: 6px 14px !important;
}
.ptg-wrapper .dataTables_paginate .paginate_button.current{
	background: var(--ptg-purple) !important;
	border-color: var(--ptg-purple) !important;
	color: #fff !important;
}
.ptg-wrapper .dataTables_paginate .paginate_button.disabled{
	color: var(--ptg-muted) !important;
	opacity: .6;
}

/* badges */
.ptg-wrapper .badge{
	border-radius: 20px;
	font-weight: 600;
	font-size: 11.5px;
	padding: 5px 12px;
	letter-spacing: .02em;
}
.ptg-wrapper .badge.bg-yellow{ background: #FFF4D6 !important; color: #9a6b00 !important; }
.ptg-wrapper .badge.bg-green{ background: #DEFBEC !important; color: #14804a !important; }
.ptg-wrapper .badge.bg-red{ background: #FDE7E7 !important; color: #c53030 !important; }

/* actions dropdown */
.ptg-wrapper td.actions .btn-group .btn{
	border-radius: 10px;
	background: var(--ptg-purple);
	border: none;
	color: #fff;
	padding: 7px 14px;
	box-shadow: 0 3px 10px rgba(108,99,245,0.25);
}
.ptg-wrapper td.actions .btn-group .btn:hover,
.ptg-wrapper td.actions .btn-group .btn:focus{
	background: var(--ptg-purple-dark);
	color: #fff;
}
.ptg-wrapper td.actions .dropdown-menu{
	border-radius: 12px;
	border: 1px solid var(--ptg-border);
	box-shadow: 0 8px 24px rgba(0,0,0,0.1);
	padding: 6px;
}
.ptg-wrapper td.actions .dropdown-menu li a{
	border-radius: 8px;
	padding: 8px 12px;
	font-size: 13.5px;
	color: var(--ptg-text);
}
.ptg-wrapper td.actions .dropdown-menu li a:hover{
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple-dark);
}
</style>

<div class="ptg-wrapper">
<div class="box">
    <div class="box-header">
        <span class="ptg-header-icon">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h6a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"></path><line x1="9" y1="7" x2="15" y2="7"></line><line x1="9" y1="11" x2="15" y2="11"></line><line x1="9" y1="15" x2="12" y2="15"></line></svg>
		</span>
		<div>
			<h3 class="box-title"><?php echo __('Validation des actions'); ?></h3>
			<div class="ptg-header-sub">Consultez et validez les actions en attente</div>
		</div>
    </div>
    <div class="box-body" style="">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Responsable</th>
                    <th>Game</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Nature</th>
                    <th>Titre</th>
                    <th>Déscription</th>
                    <th>Durée</th>
                    <th>Reste</th>
                    <th>Etat</th>
                    <th class="actions">#</th>
                </tr>
            </thead>
            <?php foreach ($actions as $action): ?>
                <tr>
                    <td><?php echo $this->Html->link($action['Client']['nom'] . ' ' . $action['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $action['Client']['id'])); ?></td>
                    <td><?php echo h($action['User']['name']); ?>&nbsp;</td>
                    <td><?php echo str_replace(",","\n",h($action['Action']['game_id'])); ?>&nbsp;</td>
                    
                    <td><?php echo h($action['Action']['date_debut']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['date_fin']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['nature']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['name']); ?>&nbsp;</td>
                    <td><?php echo h($action['Action']['description']); ?>&nbsp;</td>
                    <td><?php
                        $now = strtotime($action['Action']['date_debut']);
                        $your_date = strtotime($action['Action']['date_fin']);
                        $datediff = $your_date - $now;
                        $j = floor($datediff / (60 * 60 * 24));
                        echo "$j jours";
                        ?>
                    </td>
                    <td>
                        <?php
                        $now = time();
                        $your_date = strtotime($action['Action']['date_fin']);
                        $datediff = $your_date - $now;
                        $j = floor($datediff / (60 * 60 * 24));
                        if ($action['Action']['date_debut'] > date('Y-m-d'))
                            echo '----';
                        else if ($j >= 0)
                            echo "$j jours";
                        else
                            echo '----';
                        ?>
                    </td>
                    <td><?php
                        if ($action['Action']['date_debut'] > date('Y-m-d'))
                            echo '<span class="badge bg-yellow">Prochainement</span>';
                        else if ($j >= 0)
                            echo '<span class="badge bg-green">En cours</span>';
                        else
                            echo '<span class="badge bg-red">Terminé</span>';
                        ?></td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
							  </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $action['Action']['id'])); ?></li>
                                <li><?php
                    $valide = $action['Action']['archive'];
					//HAdi validation mounir supprimer le 11/02/2021
					//si m3a le temps on doit refaire mounir comme validateur final khass la promotion medecal yrdha 1 et mounir 2
                    //if (AuthComponent::user('id') == 213)
                    //    $valide = 2;
					if (AuthComponent::user('role') == "Super viseur")
                        $valide = 1;
                    if (AuthComponent::user('role') == "Responsable promotion") 
                        $valide = 2;
                    if (AuthComponent::user('role') == "Admin") 
                        $valide = 2;
                    echo $this->Html->link(__('Valider'), array('action' => 'valider', $action['Action']['id'], $valide));
                        ?></li>
                                <li><?php echo $this->Html->link(__('Archiver'), array('action' => 'archive', $action['Action']['id'], -1));
                                ?></li>
                            </ul>
                        </div>
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
        //$("#example1").DataTable();
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50,
            "language": {
                "search": "",
                "searchPlaceholder": "Rechercher...",
                "zeroRecords": "Aucune donnée disponible dans le tableau<span class=\"ptg-empty-sub\">Aucune action à afficher pour le moment.</span>",
                "paginate": {
                    "previous": "Précédent",
                    "next": "Suivant"
                }
            }
        });
    });
</script>