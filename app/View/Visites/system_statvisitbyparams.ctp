<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
?>

<!-- ===== CONTENEUR PRINCIPAL METRONIC ===== -->
<div class="card card-custom shadow-sm my-4">
    
    <!-- EN-TÊTE -->
    <div class="card-header border-0 pt-5 pb-3">
        <h3 class="card-title align-items-center flex-row">
            <span class="symbol symbol-40 symbol-light-primary mr-3">
                <span class="symbol-label">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </span>
            <span class="card-label font-weight-bolder text-dark font-size-h4">Historique des Visites</span>
        </h3>
    </div>

    <!-- CORPS / TABLEAU -->
    <div class="card-body pt-2 pb-5">
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center overflow-hidden display id-metronic-table" id="visitesTable">
                <thead>
                    <tr class="text-left text-uppercase text-muted font-weight-bolder font-size-sm">
                        <th>Client</th>
                        <th>Genre</th>
                        <th>Catégorie</th>
                        <th>Objections</th>
                        <th>Concurrents</th>
                        <th>Partenaires</th>
                        <th>Échantillons</th>
                        <th>Produit donné</th>
                        <th>Non présentés</th>
                        <th>Date</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $ii = 0;
                    $iii = 0;                 
                    foreach($visites as $val): 
                    ?>
                        <tr>
                            <!-- Client -->
                            <td class="font-weight-bolder text-dark">
                                <?php echo $val['Client']['nom'].' '.$val['Client']['prenom'] ;?>
                            </td>

                            <!-- Genre -->
                            <td>
                                <?php 
                                if($val['Client']['sexe'] == "f") {
                                    echo '<span class="badge badge-light-danger font-weight-bold">Femme</span>';
                                } elseif($val['Client']['sexe'] == "h") {
                                    echo '<span class="badge badge-light-info font-weight-bold">Homme</span>';
                                } 
                                ?>
                            </td>

                            <!-- Catégorie -->
                            <td>
                                <span class="text-muted font-weight-bold">
                                    <?php 
                                    foreach($categories as $p => $value){
                                        if($p == $val['Client']['category_id']){
                                            echo $value;
                                        }
                                    }
                                    ?>
                                </span>
                            </td>

                            <!-- Objections -->
                            <td class="min-w-200px"> 
                                <?php
                                if(strpos($val["Visite"]["objection"], '#') === 0) {
                                    $visiteobjection = ltrim($val["Visite"]["objection"], '#');
                                    $obV = explode('||', $visiteobjection);
                                    
                                    foreach($obV as $o) {
                                        $products = explode(';', $o);
                                ?>
                                        <div class="mb-2">
                                            <span class="badge badge-lavender font-weight-bolder p-2 d-inline-flex align-items-center justify-content-between w-100">
                                                <span>
                                                    <?php 
                                                    foreach($produits as $key => $p) {
                                                        if($key == $products[0]) echo $p;
                                                    }
                                                    ?>
                                                </span>
                                                <i class="fa fa-plus text-white cursor-pointer ml-2" id="iconpr<?php echo $ii;?>" onclick="boxtogprod(<?php echo $ii;?>)"></i>
                                            </span>

                                            <div class="boxtogprod<?php echo $ii;?> mt-2 pl-2 border-left-lavender" style="display:none;">
                                                <?php 
                                                $objections = explode(',', $products[1]);
                                                array_pop($objections);
                                                foreach($objections as $obj) {
                                                    $objec = explode('|', $obj);
                                                ?>
                                                    <div class="card card-sub-item p-2 mb-1">
                                                        <div class="d-flex justify-content-between align-items-center cursor-pointer" onclick="boxtogpo(<?php echo $iii;?>)">
                                                            <strong class="text-primary-lavender font-size-sm"><?php echo $objec[0];?></strong>
                                                            <i id="iconpo<?php echo $iii;?>" class="fa fa-plus font-size-xs text-muted"></i>
                                                        </div>
                                                        <ul class="boxtogpo<?php echo $iii;?> list-unstyled mb-0 mt-1 pl-2 font-size-xs text-muted" style="display:none;">
                                                            <?php for($j = 1; $j < count($objec); $j++): ?>
                                                                <li class="py-1 border-bottom-dashed"><?php echo $objec[$j];?></li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                <?php $iii++; } ?>
                                            </div>
                                        </div>
                                <?php 
                                        $ii++;
                                    }
                                } else if(strpos($val["Visite"]["objection"], '*') === 0) {
                                    $objection = ltrim($val["Visite"]["objection"], '*');
                                    $objections = explode(',', $objection);
                                    array_pop($objections);
                                    foreach($objections as $obj) {
                                        $words = '';
                                        $objec = explode('|', $obj);
                                ?>
                                        <div class="font-size-sm mb-1">
                                            <strong class="text-dark"><?php echo $objec[0];?> :</strong>
                                            <span class="text-muted">
                                                <?php 
                                                for($j = 1; $j < count($objec); $j++) {
                                                    $words .= ', ' . $objec[$j];
                                                }
                                                echo ltrim($words, ', ');
                                                ?>
                                            </span>
                                        </div>
                                <?php 
                                    }
                                } else {
                                    echo '<span class="text-muted font-size-sm">' . $val["Visite"]["objection"] . '</span>';
                                }
                                ?>
                            </td>

                            <!-- Concurrents -->
                            <td class="text-muted font-size-sm"><?php echo $val["Visite"]["veille"];?></td>

                            <!-- Partenaires -->
                            <td class="text-muted font-size-sm"><?php echo $val["Visite"]["partenaires"];?></td>

                            <!-- Échantillons -->
                            <td>
                                <?php 
                                $ech = explode("||", $val["Visite"]['echantillons']);
                                $ec = explode("-", $val["Visite"]['echantillons']);
                                if(count($ec) > 1) {
                                    for($ch = 0; $ch < count($ech); $ch++) {
                                        $ec = explode("-", $ech[$ch]);
                                        $nomch = $this->requestAction('/echantillons/system_get_name/' . $ec[0]);
                                        echo "<span class='badge badge-light-success font-weight-bolder mr-1 mb-1 p-2'>$nomch <span class='badge badge-success ml-1'>$ec[1]</span></span>";
                                    }
                                }
                                ?>
                            </td>

                            <!-- Produit donné -->
                            <td>
                                <?php 
                                if(!empty($val["Visite"]['produits'])) {
                                    $ec = explode("|", $val["Visite"]['produits']);
                                    if(strpos($ec[0], '*') === 0) {
                                        $gams = ltrim($ec[0], '*');
                                        $gams = explode(",", $gams);
                                        $gam = "";
                                        foreach($gams as $g) {
                                            $nom = $this->requestAction('/games/system_get_name_game/' . $g);
                                            $gam .= " | " . $nom;
                                        }
                                        $nomch = ltrim($gam, " | ");
                                    } else {
                                        $nomch = $this->requestAction('/produits/system_get_name_produit/' . $ec[0]);
                                    }
                                    echo "<span class='badge badge-light-primary font-weight-bolder p-2'>$nomch <span class='badge badge-primary-lavender text-white ml-1'>$ec[1]</span></span>";
                                }
                                ?>
                            </td>

                            <!-- Produits non présentés -->
                            <td>
                                <?php 
                                if(!empty($val["Visite"]['produitsNP'])) {
                                    $ec = explode("|", $val["Visite"]['produitsNP']);
                                    foreach($ec as $e) {
                                        $nomch = $this->requestAction('/games/system_get_name_game/' . $e);
                                        echo "<span class='badge badge-light-warning font-weight-bolder mb-1 p-2 d-inline-block'>$nomch</span><br>";
                                    }
                                }
                                ?>
                            </td>

                            <!-- Date -->
                            <td class="text-nowrap text-dark font-weight-bold font-size-sm">
                                <?php 
                                $date = strtotime($val["Visite"]["date"]);
                                echo date('Y-m-d', $date);
                                ?>
                            </td>

                            <!-- Commentaire -->
                            <td class="text-muted font-size-sm max-w-200px">
                                <?php echo $val["Visite"]["commentaire"];?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* ===== DESIGN METRONIC OVERRIDE ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.card.card-custom, table, span, button, div, h3 { font-family: 'Poppins', sans-serif !important; }

/* Styles généraux de carte */
.card.card-custom {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.75rem !important;
}
.symbol.symbol-light-primary .symbol-label { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
}

/* En-têtes du tableau */
.table-head-custom th {
    background-color: #F9F9FA !important;
    color: #B5B5C3 !important;
    font-size: 0.75rem !important;
    letter-spacing: 0.05rem;
    border-top: none !important;
    border-bottom: 1px solid #E4E6EF !important;
    padding: 1rem 0.75rem !important;
}
.table td {
    border-top: 1px solid #F3F3F7 !important;
    padding: 0.85rem 0.75rem !important;
    vertical-align: middle !important;
}

/* Badges Metronic Custom */
.badge { border-radius: 0.42rem; font-size: 0.8rem; }
.badge-light-primary { background-color: #F3EFFF; color: #7239EA; }
.badge-light-info { background-color: #E1F0FF; color: #3699FF; }
.badge-light-danger { background-color: #FFE2E5; color: #F64E60; }
.badge-light-success { background-color: #C9F7F5; color: #1BC5BD; }
.badge-light-warning { background-color: #FFF4DE; color: #FFA800; }

.badge-lavender { background-color: #7239EA !important; color: #ffffff; }
.badge-primary-lavender { background-color: #5825cb !important; }

.text-primary-lavender { color: #7239EA !important; }
.border-left-lavender { border-left: 2px solid #7239EA !important; }

/* Sous-cartes dépliables */
.card-sub-item {
    background-color: #F8F9FA;
    border: 1px solid #E4E6EF;
    border-radius: 0.45rem;
}
.border-bottom-dashed { border-bottom: 1px dashed #E4E6EF; }
.cursor-pointer { cursor: pointer; }

/* Datatables Customization */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #7239EA !important;
    color: #ffffff !important;
    border-radius: 0.45rem !important;
    border: none !important;
}
.dataTables_wrapper .dataTables_filter input {
    border: 1.5px solid #E4E6EF !important;
    border-radius: 0.55rem !important;
    padding: 0.3rem 0.75rem !important;
    outline: none;
}
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #7239EA !important;
}
</style>

<script>
    $(function () {
        $('#visitesTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50,
            "language": {
                "search": "Rechercher :",
                "paginate": {
                    "next": "►",
                    "previous": "◄"
                }
            }
        });
    });

    function boxtogpo(id) {
        $(".boxtogpo" + id).slideToggle(150);
        var icon = $("#iconpo" + id);
        if(icon.hasClass("fa-plus")) {
            icon.removeClass("fa-plus").addClass("fa-minus");
        } else {
            icon.removeClass("fa-minus").addClass("fa-plus");
        }
    }

    function boxtogprod(id) {
        $(".boxtogprod" + id).slideToggle(150);
        var icon = $("#iconpr" + id);
        if(icon.hasClass("fa-plus")) {
            icon.removeClass("fa-plus").addClass("fa-minus");
        } else {
            icon.removeClass("fa-minus").addClass("fa-plus");
        }
    }
</script>