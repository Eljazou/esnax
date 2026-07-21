<?php
/**
 * Element: visite_item_v1.ctp
 * Affiche les données d'une visite V1 (ancien format) dans la timeline
 * Variables attendues: $visite, $client, $ii, $gammes, $produits
 */
?>

<!-- ===== STYLES DESIGN TIMELINE METRONIC (LAVENDER PROFILE) ===== -->
<style>
    /* Conteneur principal de la carte de visite V1 */
    .lb-visit-item-card {
        font-family: 'Poppins', sans-serif !important;
        background: #ffffff;
        border: 1px solid #F1EDFD;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
        box-shadow: 0 2px 12px rgba(144, 125, 250, 0.02);
        margin-top: 10px;
    }

    /* Grille alignée à 2 colonnes (Clé -> Valeur) */
    .lb-visit-field-row {
        display: grid;
        grid-template-columns: 240px 1fr;
        align-items: center;
        gap: 16px;
        padding-bottom: 14px;
        border-bottom: 1px dashed #FAF9FE;
    }
    .lb-visit-field-row:last-of-type {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    /* Libellé de gauche (Clé) */
    .lb-field-key {
        font-size: 12.5px;
        font-weight: 700;
        color: #746A9F;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        display: flex;
        align-items: center;
    }

    /* Valeur de droite (Contenu) */
    .lb-field-value {
        font-size: 13.5px;
        color: #332A5B;
        font-weight: 500;
        line-height: 1.6;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    /* Boîte de texte pour le commentaire */
    .lb-comment-text {
        color: #4A3E75;
        background: #FAF9FE;
        padding: 12px 16px;
        border-radius: 8px;
        border-left: 3px solid #907DFA;
        width: 100%;
        font-size: 13.5px;
        font-style: italic;
    }

    /* Badge Violet (Assorti à vos boutons d'objectifs de visite) */
    .lb-badge-lavender {
        background: #7966E3 !important;
        color: #ffffff !important;
        padding: 6px 14px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        border-radius: 30px !important;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(121, 102, 227, 0.15);
        letter-spacing: 0.3px;
    }

    /* Badge Vert/Turquoise (Pour la concurrence ou produits vedettes) */
    .lb-badge-teal {
        background: #1B9E5A !important;
        color: #ffffff !important;
        padding: 6px 14px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        border-radius: 30px !important;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(27, 158, 90, 0.15);
        letter-spacing: 0.3px;
    }

    /* Badge de Potentialité Cabinet */
    .lb-potential-badge {
        background: #F3F1FF;
        color: #7966E3;
        border: 1px solid #E1DCFF;
        padding: 5px 14px;
        font-weight: 700;
        font-size: 13px;
        border-radius: 8px;
        letter-spacing: 0.5px;
    }

    /* Section Brochure (ODP) */
    .lb-brochure-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        width: 100%;
    }
    
    .lb-brochure-card {
        border: 1px solid #EAE6FF;
        border-radius: 10px;
        padding: 6px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(144, 125, 250, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .lb-brochure-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(144, 125, 250, 0.08);
        border-color: #C5BCFF;
    }
    
    .lb-brochure-img {
        height: 110px;
        border-radius: 6px;
        object-fit: contain;
        display: block;
    }
</style>

<div class="lb-visit-item-card">

    <!-- BLOCK: COMMENTAIRE -->
    <div class="lb-visit-field-row">
        <span class="lb-field-key">Commentaire</span>
        <div class="lb-field-value">
            <div class="lb-comment-text">
                <?php echo iconv('ASCII', 'UTF-8//IGNORE', $visite['commentaire']); ?>
            </div>
        </div>
    </div>

    <!-- BLOCK: OBJECTIONS / VEILLE -->
    <div class="lb-visit-field-row">
        <span class="lb-field-key">
            <?php echo ($client['Type']['name'] == 'Pharmacie') ? 'Veille' : 'Objections'; ?>
        </span>
        <div class="lb-field-value">
            <?php
            if ($client['Type']['name'] == 'Pharmacie') {
                // Pharmacie: format pipe-delimited
                if (!empty($visite['objection'])) {
                    $obV = explode(",", $visite['objection']);
                    foreach ($obV as $o) {
                        $products = explode('|', $o);
                        $pr = $this->requestAction('/games/system_get_name_game/' . $products[0]);
                        echo "<span class='lb-badge-lavender'>$pr</span>";
                    }
                }
            } else {
                // Médecin: format # ou * ou texte brut
                if (!empty($visite['objection'])) {
                    if (strpos($visite['objection'], '#') === 0) {
                        $visiteobjection = ltrim($visite['objection'], '#');
                        $obV = explode('\\|\\|', $visiteobjection);
                        foreach ($obV as $o) {
                            $products = explode(';', $o);
                            echo "<span class='lb-badge-lavender'>" . h($products[0]) . "</span>";
                            $ii++;
                        }
                    } elseif (strpos($visite['objection'], '*') === 0) {
                        $objection = ltrim($visite['objection'], '*');
                        $objections = explode(',', $objection);
                        array_pop($objections);
                        foreach ($objections as $obj) {
                            $objec = explode('\\|', $obj);
                            echo "<span class='lb-badge-lavender'>" . h($objec[0]) . "</span>";
                            $ii++;
                        }
                    } else {
                        echo h($visite['objection']);
                    }
                }
            }
            ?>
        </div>
    </div>

    <!-- BLOCK: CONCURRENCE (Pharmacie V1) -->
    <?php if ($client['Type']['name'] == 'Pharmacie' && !empty($visite['concurrence_p'])): ?>
    <div class="lb-visit-field-row">
        <span class="lb-field-key">Concurrence</span>
        <div class="lb-field-value">
            <?php
            $obV = explode(",", $visite['concurrence_p']);
            foreach ($obV as $o) {
                $products = explode('|', $o);
                $pr = $this->requestAction('/games/system_get_name_game/' . $products[0]);
                echo "<span class='lb-badge-teal'>$pr</span>";
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- BLOCK: POTENTIALITÉ CABINET -->
    <div class="lb-visit-field-row">
        <span class="lb-field-key">Potentialité cabinet</span>
        <div class="lb-field-value">
            <?php
            $pott = ($visite['veille'] == "100") ? '1' : (($visite['veille'] == "50") ? '2' : '3');
            $pttt = ($visite['partenaires'] == 'bien') ? 'A' : (($visite['partenaires'] == 'moyen') ? 'B' : 'C');
            ?>
            <span class="lb-potential-badge"><b><?php echo $pttt . $pott; ?></b></span>
        </div>
    </div>

    <!-- BLOCK: PRODUITS DEMANDÉS NON PRÉSENTÉS -->
    <?php if (!empty($visite['produitsNP'])): ?>
    <div class="lb-visit-field-row">
        <span class="lb-field-key">
            <?php echo ($client['Type']['name'] == 'Pharmacie') ? 'Produits partenaire de CONSEIL' : 'Produits demandés non présentés'; ?>
        </span>
        <div class="lb-field-value">
            <?php
            if ($client['Type']['name'] == 'Pharmacie') {
                $ec = explode("|", $visite['produitsNP']);
                $produitnames = "";
                if (strpos($ec[0], '*') === 0) {
                    $pps = explode(",", str_replace("*", "", $ec[0]));
                    foreach ($pps as $e) {
                        if (isset($gammes[$e]))
                            $produitnames .= "," . $gammes[$e];
                        elseif (isset($produits[$e]))
                            $produitnames .= "," . $produits[$e];
                    }
                }
                $produitnames = trim($produitnames, ",");
                echo "<span class='lb-badge-teal'><b>$produitnames</b></span>";
            } else {
                $ec = explode("|", $visite['produitsNP']);
                foreach ($ec as $e) {
                    if (!empty($e)) {
                        $nomch = $this->requestAction('/games/system_get_name_game/' . $e);
                        echo "<span class='lb-badge-teal'><b>$nomch</b></span>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- BLOCK: ORDRE DE PRÉSENTATION (ODP) -->
    <?php
    $visitesorders = $this->requestAction('/visiteordres/system_get_visiteordre/' . $visite['id']);
    if (!empty($visitesorders)): ?>
    <div class="lb-visit-field-row">
        <span class="lb-field-key">Ordre de présentation</span>
        <div class="lb-field-value">
            <div class="lb-brochure-container">
                <?php foreach ($visitesorders as $value):
                    $logo = (!empty($value["Brochure"]["logo"])) ? "/img/brochures/" . $value["Brochure"]["logo"] : "https://dummyimage.com/300x300/000/fff";
                ?>
                    <div class="lb-brochure-card">
                        <img class="lb-brochure-img" src="<?php echo $this->Html->url($logo); ?>" alt="Logo Brochure" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>