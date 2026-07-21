<?php echo $this->Html->css('dataTables.bootstrap'); ?>	

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
	border-radius: 18px !important;
	box-shadow: 0 6px 22px rgba(108,99,245,0.1);
	overflow: hidden;
}
.ptg-wrapper .box-header{
	border: none !important;
	background: transparent;
	padding: 24px 26px 16px 26px;
	display: flex;
	align-items: center;
	gap: 16px;
}
.ptg-header-icon{
	width: 52px;
	height: 52px;
	min-width: 52px;
	border-radius: 50%;
	background: linear-gradient(135deg, var(--ptg-purple), var(--ptg-purple-dark));
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: 0 6px 16px rgba(108,99,245,0.3);
}
.ptg-header-icon svg{ width: 24px; height: 24px; }
.ptg-wrapper .box-header .box-title{
	font-weight: 800 !important;
	font-size: 20px !important;
	color: var(--ptg-text) !important;
	margin: 0 !important;
	width: auto;
	float: none;
}
.ptg-header-underline{
	display: flex;
	align-items: center;
	gap: 6px;
	margin-top: 8px;
}
.ptg-header-underline .bar{
	width: 30px;
	height: 4px;
	border-radius: 4px;
	background: var(--ptg-purple);
}
.ptg-header-underline .dot{
	width: 4px;
	height: 4px;
	border-radius: 50%;
	background: var(--ptg-purple);
}
.ptg-wrapper .box-body{
	padding: 0 26px 26px 26px;
	border-top: 1px solid var(--ptg-border);
	margin-top: 6px;
	padding-top: 20px;
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
	padding: 12px 16px !important;
	white-space: nowrap;
}
.ptg-th-icon{ display: inline-flex; align-items: center; gap: 8px; }
.ptg-th-icon svg{ width: 14px; height: 14px; }
.ptg-wrapper table.dataTable thead tr th:first-child{ border-radius: 10px 0 0 10px; }
.ptg-wrapper table.dataTable thead tr th:last-child{ border-radius: 0 10px 10px 0; }
.ptg-wrapper table.dataTable tbody td{
	border-top: 1px solid var(--ptg-border) !important;
	padding: 12px 16px;
	font-size: 13.5px;
	color: var(--ptg-text);
	vertical-align: middle;
}
.ptg-wrapper table.dataTable.table-striped tbody tr:nth-of-type(odd){ background: #fafaff; }
.ptg-wrapper table.dataTable tbody tr:hover{ background: #f5f4ff; }

/* empty state */
.ptg-wrapper td.dataTables_empty{
	padding: 60px 10px !important;
	color: var(--ptg-text);
	font-size: 15px;
	font-weight: 700;
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
.ptg-wrapper .dataTables_wrapper{ padding-top: 4px; }
.ptg-wrapper .dataTables_length label,
.ptg-wrapper .dataTables_filter label{
	font-size: 13.5px;
	color: var(--ptg-text);
	font-weight: 500;
}
.ptg-wrapper .dataTables_length select{
	border: 1px solid var(--ptg-border) !important;
	border-radius: 8px !important;
	padding: 4px 8px !important;
	box-shadow: none !important;
}
.ptg-wrapper .dataTables_filter{ margin-bottom: 14px; }
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
.ptg-wrapper .dataTables_paginate{ margin-top: 14px; }
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
.ptg-wrapper .dataTables_info{ color: var(--ptg-muted); font-size: 13px; }

/* etat badges */
.ptg-badge{
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 4px 11px;
	border-radius: 20px;
	font-size: 12px;
	font-weight: 600;
	white-space: nowrap;
}
.ptg-badge svg{ width: 12px; height: 12px; flex: none; }
.ptg-badge.validation{ background: #E9F1FE; color: #2f5fd0; }
.ptg-badge.preparation{ background: #FEF3C7; color: #9a6b00; }
.ptg-badge.pret{ background: #D1FAE5; color: #147a4d; }
.ptg-badge.annule{ background: #FDE7E7; color: #c53030; }

/* action buttons */
.ptg-wrapper td.actions a.ptg-valider-btn{
	background: var(--ptg-purple) !important;
	color: #fff !important;
	border: none !important;
	border-radius: 9px !important;
	padding: 6px 14px !important;
	font-weight: 500;
	font-size: 12.5px;
	box-shadow: 0 3px 10px rgba(108,99,245,0.25);
}
.ptg-wrapper td.actions a.ptg-valider-btn:hover{ background: var(--ptg-purple-dark) !important; }
.ptg-wrapper td.actions a.ptg-archiver-btn{
	background: #fff !important;
	color: var(--ptg-muted) !important;
	border: 1px solid var(--ptg-border) !important;
	border-radius: 9px !important;
	padding: 6px 14px !important;
	font-weight: 500;
	font-size: 12.5px;
}
.ptg-wrapper td.actions a.ptg-archiver-btn:hover{
	background: #FDE7E7 !important;
	color: #c53030 !important;
	border-color: #FDE7E7 !important;
}
</style>

<div class="ptg-wrapper">
<div class="box">
    <div class="box-header">
        <span class="ptg-header-icon">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><path d="M9 15l2 2 4-4"></path></svg>
		</span>
		<div>
			<h3 class="box-title"><?php echo __('Validations des documents'); ?></h3>
			<div class="ptg-header-underline"><span class="bar"></span><span class="dot"></span></div>
		</div>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>User</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Besoin</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>document</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>Etat</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Date de demande</span></th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?php echo $this->Html->link($document['User']['name'], array('controller' => 'users', 'action' => 'view', $document['User']['id'])); ?></td>
                    <td><?php echo h($document['Document']['description']); ?>&nbsp;</td>
                    <td><?php echo h($document['Document']['document']); ?>&nbsp;</td>
                    <td>
						<?php
                        if ($document['Document']['archive'] == 0)
                            echo '<span class="ptg-badge validation"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><polyline points="12 7 12 12 15 14"></polyline></svg>en cours de validation</span>';
                        else if ($document['Document']['archive'] == 1)
                            echo '<span class="ptg-badge preparation"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>en cours de préparation</span>';
                        else if ($document['Document']['archive'] == 2)
                            echo '<span class="ptg-badge pret"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>Document prés</span>';
                        else if ($document['Document']['archive'] == -1)
                            echo '<span class="ptg-badge annule"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>Demande annuler</span>';
                        ?>&nbsp;</td>
                    <td><?php echo h($document['Document']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php
                        if ($this->requestAction('/droits/getrole/documents/valider') == 1 && $document['Document']['archive'] == 0) {
                            echo $this->Html->link(__('Valider '), array('action' => 'valider', $document['Document']['id'], 1),array('class'=>"btn btn-primary ptg-valider-btn",'style'=>'margin:0px 2px;')) ;
                            echo $this->Html->link(__(' Archiver'), array('action' => 'valider', $document['Document']['id'], -1),array('class'=>"btn btn-primary ptg-archiver-btn",'style'=>'margin:0px 2px;'));
                        }
                        else if ($this->requestAction('/droits/getrole/documents/valider') == 1 && $document['Document']['archive'] == 1) {
                            echo $this->Html->link(__('Valider '), array('action' => 'valider', $document['Document']['id'], 2),array('class'=>"btn btn-primary ptg-valider-btn",'style'=>'margin:0px 2px;')) ;
                            echo $this->Html->link(__(' Archiver'), array('action' => 'valider', $document['Document']['id'], -1),array('class'=>"btn btn-primary ptg-archiver-btn",'style'=>'margin:0px 2px;'));
                        }
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
            "language": {
                "zeroRecords": "Aucune donnée disponible dans le tableau<span class=\"ptg-empty-sub\">Ajoutez des validations pour les voir ici.</span>",
                "emptyTable": "Aucune donnée disponible dans le tableau<span class=\"ptg-empty-sub\">Ajoutez des validations pour les voir ici.</span>"
            }
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>