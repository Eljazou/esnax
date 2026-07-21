<?php
echo $this->Html->css('dataTables.bootstrap');
?>

<!-- ===== METRONIC CARD CONTAINER ===== -->
<div class="card card-custom shadow-sm">
    
    <!-- ===== METRONIC CARD HEADER ===== -->
    <div class="card-header border-0 pt-6 pb-6">
        <div class="header-main-info">
            <h3 class="card-title align-items-center flex-row mb-1">
                <span class="symbol symbol-40 symbol-light-primary mr-3">
                    <span class="symbol-label">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 20V10m6 10V4m6 16v-7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        </svg>
                    </span>
                </span>
                <span class="card-label font-weight-bolder text-dark font-size-h4">Tableau des Ventes — Année <?php echo h($anne); ?></span>
            </h3>
            <h2 class="sub-entity-title"><?php echo h($grosiste['Grosiste']['name']); ?></h2>
        </div>
        
        <div class="card-toolbar align-items-center">
            <!-- Filter Form -->
            <div class="form-group-filter mr-4">
                <label for="annee" class="font-weight-bold font-size-sm text-muted mr-2">Année :</label>
                <select id="annee" name="annee" class="custom-select-lavender" onchange="changerAnnee()">
                    <option value="">-- Sélectionner --</option>
                    <?php for($i=date("Y"); $i>date("Y")-3; $i--) {
                        $selected = ($i == $anne) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    } ?>
                </select>
            </div>
            
            <!-- Action Button -->
            <?php echo $this->Html->link(
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px; vertical-align:-2px;"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>Remplir sortie grossiste', 
                array('controller' => 'groventes', 'action' => 'add', $grosiste['Grosiste']['id']), 
                array('class' => "btn btn-primary-lavender font-weight-bolder btn-sm", 'escape' => false)
            ); ?>
        </div>
    </div>

    <!-- ===== METRONIC CARD BODY ===== -->
    <div class="card-body py-4">
        <?php if (!empty($grosiste['Grovente'])): ?>
            <div class="table-responsive">
                <table id="example1" class="table table-head-custom table-vertical-center table-borderless table-hover">
                    <thead>
                        <tr class="text-left text-muted text-uppercase tracking-wider">
                            <th style="min-width: 180px;">Produit</th>
                            <?php for($i=1; $i<13; $i++): ?>
                                <th class="text-center" style="min-width: 65px;"><?php echo $i . "-" . $anne; ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groproduits as $id => $p): ?>
                            <tr>
                                <td class="font-weight-bolder text-dark font-size-base product-name-cell">
                                    <?php echo h($p); ?>
                                </td>
                                <?php 
                                for($i=1; $i<13; $i++) {
                                    $quan = 0;
                                    $zero = ($i < 10) ? "0" : "";
                                    $date = $anne . "-" . $zero . $i;
                                    
                                    foreach ($grosiste['Grovente'] as $grovente) {                        
                                        $dv = explode("-", $grovente['date']);
                                        $dv = $dv[0] . "-" . $dv[1];
                                        if($dv == $date && $grovente['groproduit_id'] == $id) {
                                            $quan += $grovente['quantite'];
                                        }
                                    }
                                    
                                    // Highlight cells containing active quantities
                                    $cell_class = ($quan > 0) ? 'qty-active font-weight-bold' : 'qty-zero';
                                ?>
                                    <td class="text-center <?php echo $cell_class; ?>">
                                        <?php if ($quan > 0): ?>
                                            <?php echo $this->Html->link($quan, array('controller' => 'groventes', 'action' => 'view', $id, $date), array('class' => 'sales-link')); ?>
                                        <?php else: ?>
                                            <span class="text-muted-light">0</span>
                                        <?php endif; ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state-wrapper text-center py-8">
                <span class="text-muted font-size-lg">Aucune donnée de vente disponible pour ce grossiste sur l'année sélectionnée.</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* ===== METRONIC DESIGN OVERRIDE ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.card.card-custom, .table, th, td, h3, h2, span, label, select, a { font-family: 'Poppins', sans-serif !important; }

/* Main Card Wrapper */
.card.card-custom {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.75rem !important;
    box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.03) !important;
    margin-bottom: 2rem;
}

/* Header Elements */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #F1F1F4 !important;
    background: transparent !important;
    flex-wrap: wrap;
    gap: 15px;
}
.sub-entity-title {
    margin: 4px 0 0 52px;
    font-size: 1.15rem;
    font-weight: 600;
    color: #7239EA;
}
.symbol.symbol-light-primary .symbol-label { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
}

/* Filter Selector Style */
.custom-select-lavender {
    background-color: #F8F9FA;
    border: 1.5px solid #E4E6EF;
    color: #3F4254;
    border-radius: 0.55rem;
    padding: 0.45rem 2rem 0.45rem 0.8rem;
    font-size: 0.9rem;
    font-weight: 500;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
}
.custom-select-lavender:focus {
    border-color: #7239EA;
    background-color: #ffffff;
}

/* Action Button Hover Controls */
.btn-primary-lavender { 
    background-color: #7239EA !important; 
    color: #ffffff !important; 
    border: none !important;
    border-radius: 0.55rem !important;
    padding: 0.6rem 1.2rem !important;
    font-size: 0.88rem !important;
    transition: all 0.2s ease !important;
}
.btn-primary-lavender:hover { 
    background-color: #5825cb !important; 
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(114, 57, 234, 0.2) !important;
}

/* Structural Grid Table Setup */
.table.table-head-custom thead th {
    font-size: 0.82rem !important;
    font-weight: 600 !important;
    color: #B5B5C3 !important;
    border: none !important;
    padding: 1.1rem 0.6rem !important;
    background-color: #F9F9FA !important;
}
.table.table-head-custom thead tr th:first-child {
    border-top-left-radius: 0.55rem;
    border-bottom-left-radius: 0.55rem;
}
.table.table-head-custom thead tr th:last-child {
    border-top-right-radius: 0.55rem;
    border-bottom-right-radius: 0.55rem;
}

.table tbody tr {
    border-bottom: 1px solid #F1F1F4 !important;
    transition: background-color 0.15s ease;
}
.table tbody tr:hover { background-color: #FAFAFC !important; }
.table tbody td {
    padding: 1rem 0.6rem !important;
    vertical-align: middle !important;
    border: none !important;
    font-size: 0.92rem;
}

/* Product Column Cell Styling */
.product-name-cell {
    color: #2b2c45 !important;
    letter-spacing: -0.1px;
}

/* Data Cell Formatting Rules */
.qty-zero {
    opacity: 0.45;
}
.text-muted-light {
    color: #A1A5B7;
}

/* Modern Hover States for Sales Targets */
.sales-link {
    color: #7239EA !important;
    background-color: #F3EFFF;
    padding: 4px 10px;
    border-radius: 6px;
    text-decoration: none !important;
    display: inline-block;
    min-width: 36px;
    transition: all 0.15s ease;
}
.sales-link:hover {
    background-color: #7239EA;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(114, 57, 234, 0.2);
}

.empty-state-wrapper {
    color: #B5B5C3;
    font-style: italic;
}
</style>

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
        if ($.fn.DataTable) {
            $('#example1').DataTable({
                "paging": true,
                "pageLength": 500,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Traitement en cours...",
                    "sSearch":         "Rechercher&nbsp;:",
                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix":    "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst":      "Premier",
                        "sPrevious":   "Pr&eacute;c&eacute;dent",
                        "sNext":       "Suivant",
                        "sLast":       "Dernier"
                    }
                }
            });
        }
    });

    function changerAnnee() {
        var select = document.getElementById("annee");
        var annee = select.options[select.selectedIndex].value;
        if(annee) {
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
    }
</script>