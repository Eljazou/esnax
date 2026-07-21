<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<?php
// Helper d'affichage uniquement — calcule les initiales pour l'avatar, ne modifie aucune donnée
function ptg_initials($name){
    $parts = preg_split('/\s+/', trim($name));
    $initials = '';
    foreach($parts as $p){
        if($p !== ''){
            $initials .= strtoupper(mb_substr($p,0,1));
            if(strlen($initials) >= 2) break;
        }
    }
    return $initials;
}
?>

<style>
/* ================== MODERN RESTYLE (CSS/SVG only — no PHP logic touched) ================== */
.ptg-wrapper{
	--ptg-purple: #6C63F5;
	--ptg-purple-dark: #5750d9;
	--ptg-purple-soft: #EEECFE;
	--ptg-text: #2c2e3a;
	--ptg-muted: #8a8fa3;
	--ptg-border: #ececf5;
	--ptg-green-soft: #E4F8EE;
	--ptg-green: #1a8a55;
	--ptg-blue-soft: #E9F1FE;
	--ptg-blue: #3f6fd1;
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

/* commercial avatar chip */
.ptg-commercial{
	display: flex;
	align-items: center;
	gap: 10px;
}
.ptg-avatar{
	width: 28px;
	height: 28px;
	min-width: 28px;
	border-radius: 50%;
	background: var(--ptg-purple);
	color: #fff;
	font-size: 11px;
	font-weight: 700;
	display: flex;
	align-items: center;
	justify-content: center;
}

/* ville pin */
.ptg-ville{
	display: flex;
	align-items: center;
	gap: 6px;
	color: var(--ptg-text);
}
.ptg-ville svg{ width: 14px; height: 14px; color: var(--ptg-purple); flex: none; }

/* badges (paiement / facture) */
.ptg-badge{
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 4px 10px;
	border-radius: 8px;
	font-size: 12.5px;
	font-weight: 600;
}
.ptg-badge svg{ width: 13px; height: 13px; flex: none; }
.ptg-badge.paiement{ background: var(--ptg-green-soft); color: var(--ptg-green); }
.ptg-badge.facture{ background: var(--ptg-purple-soft); color: var(--ptg-purple-dark); }

/* produits pill link */
.ptg-produits{
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 4px 10px;
	border-radius: 8px;
	background: var(--ptg-blue-soft);
	color: var(--ptg-blue) !important;
	font-size: 12.5px;
	font-weight: 600;
	text-decoration: none !important;
}
.ptg-produits svg{ width: 13px; height: 13px; flex: none; }
.ptg-produits-zero{
	color: var(--ptg-muted);
	font-size: 12.5px;
}

/* date */
.ptg-date{
	display: flex;
	align-items: center;
	gap: 6px;
	color: var(--ptg-text);
}
.ptg-date svg{ width: 14px; height: 14px; color: var(--ptg-muted); flex: none; }

/* edit action */
.ptg-wrapper td.actions a.ptg-edit-btn{
	width: 30px;
	height: 30px;
	border-radius: 8px;
	background: var(--ptg-purple-soft);
	color: var(--ptg-purple) !important;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	text-decoration: none !important;
}
.ptg-wrapper td.actions a.ptg-edit-btn:hover{
	background: var(--ptg-purple);
	color: #fff !important;
}
.ptg-wrapper td.actions a.ptg-edit-btn svg{ width: 15px; height: 15px; }
</style>

<div class="ptg-wrapper">

<!-- Modal Bootstrap pour les détails des produits -->
<div class="modal fade" id="produitsModal" tabindex="-1" role="dialog" aria-labelledby="produitsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="produitsModalLabel">Détails des produits</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Gamme</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody id="produitsTableBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Box principale -->
<div class="box">
    <div class="box-header">
        <span class="ptg-header-icon">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h6a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"></path><line x1="9" y1="7" x2="15" y2="7"></line><line x1="9" y1="11" x2="15" y2="11"></line><line x1="9" y1="15" x2="12" y2="15"></line></svg>
		</span>
		<div>
			<h3 class="box-title">La liste des commandes</h3>
			<div class="ptg-header-sub">Consultez et gérez l'ensemble des commandes</div>
		</div>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Commercial</th>
                    <th>Client</th>
                    <th>Ville</th>
                    <th>Paiement</th>
                    <th>Facture</th>
                    <th>Total en Dhs</th>
                    <th>Produits</th>                    
                    <th>Date</th>
                    <th class="actions">#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?php echo $commande['Commande']['commande_id']; ?></td>
                        <td>
							<div class="ptg-commercial">
								<span class="ptg-avatar"><?php echo ptg_initials($commande['User']['name']); ?></span>
								<span><?php echo $commande['User']['name']; ?></span>
							</div>
						</td>
                        <td>
                            <?php   
                            if ($commande['Commande']['client_id'] != null) {
                                echo $this->Html->link($commande['Client']['nom'] . ' ' . $commande['Client']['prenom'],array('controller' => 'clients', 'action' => 'view', $commande['Client']['id']));
								
                            } else {
                                echo $commande['Commande']['code_client'];
                            }
                            ?>
                        </td>
                        <td>
							<span class="ptg-ville">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
								<?php 
								if ($commande['Commande']['client_id'] != null)
									echo $secteurs[$commande['Client']['secteur_id']];
								else
									echo "--";
								?>
							</span>
						</td>
                        <td>
							<span class="ptg-badge paiement">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
								<?php echo $commande['Commande']['type_paiement']; ?>
							</span>
						</td>
                        <td><span class="ptg-badge facture"><?php echo $commande['Commande']['type_facture']; ?></span></td>
                        <td><?php echo $commande['Commande']['montant']; ?> DH</td>
                        <td>
                            <?php 
                            $produits = json_decode($commande['Commande']['produits'], true);
                            if (!empty($produits)) {
                                // S'assure que $produits est un tableau de produits
                                if (!isset($produits[0])) {
                                    $produits = [$produits];
                                }
                                
                                // Calcule le total des quantités
                                $totalQuantite = 0;
                                foreach ($produits as $produit) {
                                    $totalQuantite += intval($produit['quanitie']);
                                }
                                
                                // Crée le lien avec les données
                                echo '<a href="#" class="show-produits ptg-produits" data-produits=\'',
                                     htmlspecialchars(json_encode($produits), ENT_QUOTES, 'UTF-8'),
                                     '\'><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
                                     $totalQuantite . ' unité' . ($totalQuantite > 1 ? 's' : ''),
                                     '</a>';
                            } else {
                                echo '<span class="ptg-produits-zero">0 unité</span>';
                            }
                            ?>
                        </td>
                        <td>
							<span class="ptg-date">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								<?php echo $commande['Commande']['date']; ?>
							</span>
						</td>
                        <td class="actions">
                            <?php 
                            if ($this->requestAction('/droits/getrole/commandes/edit') == 1) {
                                echo $this->Html->link(
                                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                                    array('action' => 'edit', $commande['Commande']['id'], 1),
                                    array('class' => 'ptg-edit-btn', 'escape' => false)
                                );
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php
// Inclusion des scripts nécessaires
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
    // Initialisation de DataTables
    var table = $("#example1").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
    
    // Gestion du clic sur le lien des produits (utilisant la délégation d'événements)
    $('#example1').on('click', '.show-produits', function(e) {
        e.preventDefault();
        var produitsData = $(this).data('produits');
        var tableBody = $('#produitsTableBody');
        tableBody.empty();

        // Si c'est un objet simple, on le met dans un tableau
        if (!Array.isArray(produitsData)) {
            produitsData = [produitsData];
        }

        // Création des lignes du tableau avec le total
        var totalQuantite = 0;
        produitsData.forEach(function(produit) {
            var row = $('<tr>');
            row.append($('<td>').text(produit.produit));
            row.append($('<td>').text(produit.gamme));
            row.append($('<td>').text(produit.quanitie));
            tableBody.append(row);
            totalQuantite += parseInt(produit.quanitie);
        });

        // Ajout d'une ligne pour le total
        var totalRow = $('<tr class="info">').append(
            $('<td colspan="2">').text('Total'),
            $('<td>').text(totalQuantite)
        );
        tableBody.append(totalRow);

        // Affichage du modal
        $('#produitsModal').modal('show');
    });

    // Réinitialisation du modal quand il est fermé
    $('#produitsModal').on('hidden.bs.modal', function () {
        $('#produitsTableBody').empty();
    });
});
</script>
