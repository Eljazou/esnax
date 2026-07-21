<?php
/**
 * Element: visite_item_v2.ctp
 * Version complète, modernisée et corrigée (Alignements & Galerie ODP)
 */

$objVisiteLabels = array(
    'nouveau_produit' => 'Nouveau produit',
    'echelle_adoption' => "Échelle d'adoption",
    'suivre_prescriptions' => 'Suivre prescriptions',
    'fideliser_prescripteur' => 'Fidéliser prescripteur',
    'repondre_demande' => 'Répondre à une demande',
    'clarifier_doutes' => 'Clarifier doutes/objections'
);

$objectionLabels = array(
    'prix' => 'Prix',
    'presentation' => 'Présentation',
    'efficacite' => 'Efficacy',
    'msg_principal_1' => 'Message principal 1',
    'tolerance' => 'Tolérance',
    'disponibilite' => 'Disponibilité',
    'msg_principal_2' => 'Message principal 2',
    'msg_secondaire' => 'Message Secondaire',
    'autre' => 'Autre'
);

$feedbacks = json_decode($visite['produit_adoption'], true);

$retourColors = array(
    'positif' => 'lb-v2-bg-green',
    'mitige' => 'lb-v2-bg-orange',
    'negatif' => 'lb-v2-bg-red'
);
$retourEmojis = array(
    'positif' => 'Positif',
    'mitige' => 'Mitigé',
    'negatif' => 'Négatif'
);
$adoptClasses = array(
    'regulier' => 'lb-v2-bg-green',
    'occasionnel' => 'lb-v2-bg-orange',
    'pas_adoption' => 'lb-v2-bg-red'
);
$adoptLabels = array(
    'regulier' => 'Régulier',
    'occasionnel' => 'Occasionnel',
    'pas_adoption' => "Pas d'adoption"
);
?>

<style>
    /* --- CONTENEUR PRINCIPAL --- */
    .visite-v2-container {
        font-family: 'Inter', sans-serif !important;
        color: #1E1E2D !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        padding: 5px 0 !important;
        margin-left: 0 !important;
        clear: both !important;
    }
    
    /* --- SECTIONS VERTICALES --- */
    .v2-section {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        padding-bottom: 18px !important;
        border-bottom: 1px dashed #EAECF3 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .v2-section:last-of-type {
        border-bottom: none !important;
        padding-bottom: 0 !important;
    }
    
    .v2-section-title {
        font-weight: 700 !important;
        font-size: 12px !important;
        color: #7C3AED !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
    }
    
    .v2-content-block {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* --- COMMENTAIRES & BADGES --- */
    .v2-comment-card {
        background: #F9F9FC !important;
        border-left: 4px solid #7C3AED !important;
        padding: 14px 16px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        color: #332A5B !important;
        font-style: italic !important;
        line-height: 1.5 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .v2-badge-container {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
    }
    
    .v2-badge-purple {
        background: linear-gradient(135deg,#7C3AED,#6425D0) !important;
        color: #ffffff !important;
        font-size: 12px !important;
        padding: 7px 15px !important;
        border-radius: 999px !important;
        font-weight: 700 !important;
        display: inline-block !important;
        box-shadow: 0 3px 8px rgba(124, 58, 237, 0.22) !important;
    }
    
    /* --- FEEDBACK PRODUITS --- */
    .product-adoption-card {
        background: #ffffff !important;
        border: 1px solid #EAECF3 !important;
        border-radius: 14px !important;
        padding: 16px !important;
        box-shadow: 0 2px 8px rgba(124, 58, 237, 0.03) !important;
        width: 100% !important;
        box-sizing: border-box !important;
        margin-bottom: 12px !important;
        transition: box-shadow .15s ease, transform .15s ease !important;
    }

    .product-adoption-card:hover {
        box-shadow: 0 10px 22px -10px rgba(124, 58, 237, 0.28) !important;
        transform: translateY(-1px) !important;
    }
    
    .product-adoption-card:last-of-type {
        margin-bottom: 0 !important;
    }
    
    .product-card-header {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding-bottom: 10px !important;
        margin-bottom: 12px !important;
        border-bottom: 1px solid #F9F9FC !important;
    }
    
    .product-name {
        font-weight: 800 !important;
        font-size: 14.5px !important;
        color: #1E1E2D !important;
    }
    
    /* Couleurs de Statuts */
    .lb-v2-bg-green { background: #17974C !important; color: #ffffff !important; }
    .lb-v2-bg-orange { background: #F5A623 !important; color: #ffffff !important; }
    .lb-v2-bg-red { background: #F1416C !important; color: #ffffff !important; }
    .lb-v2-bg-gray { background: #A1A5B7 !important; color: #ffffff !important; }

    .adoption-badge {
        font-size: 11px !important;
        padding: 5px 13px !important;
        border-radius: 999px !important;
        font-weight: 700 !important;
    }
    
    .objections-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }

    .objection-item {
        background: #F9F9FC !important;
        border-left: 3px solid #7C3AED !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
    }
    
    .objection-header {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }
    
    .objection-name {
        font-weight: 700 !important;
        font-size: 13px !important;
        color: #332A5B !important;
    }
    
    .objection-status {
        font-size: 11px !important;
        padding: 4px 11px !important;
        border-radius: 999px !important;
        font-weight: 700 !important;
    }
    
    .objection-precision {
        font-size: 12.5px !important;
        color: #7E8299 !important;
        margin-top: 6px !important;
        font-style: italic !important;
    }

    /* --- CONCURRENTS --- */
    .competitor-card {
        background: #FEF3F5 !important;
        border-left: 4px solid #F1416C !important;
        border-radius: 10px !important;
        padding: 12px 16px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        margin-bottom: 8px !important;
    }
    
    .competitor-product-info {
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #99183A !important;
    }
    
    .competitor-brand {
        color: #F1416C !important;
        font-weight: 700 !important;
    }

    /* --- MATÉRIEL EMG --- */
    .emg-container {
        background: #F2ECFE !important;
        border-left: 4px solid #7C3AED !important;
        padding: 14px !important;
        border-radius: 10px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .emg-item {
        background: #ffffff !important;
        border: 1px solid #E1D4FC !important;
        padding: 5px 13px !important;
        border-radius: 999px !important;
        font-size: 12px !important;
        color: #7C3AED !important;
        font-weight: 700 !important;
        display: inline-block !important;
        margin-top: 6px !important;
        margin-right: 6px !important;
    }

    /* --- BANNIÈRE REQUÊTE CRM --- */
    .crm-request-banner {
        background: #FFF6E8 !important;
        border-left: 4px solid #F5A623 !important;
        padding: 14px !important;
        border-radius: 10px !important;
        color: #92400E !important;
        font-size: 13.5px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* --- VERROUILLAGE SÉCURITÉ GALERIE ODP --- */
    .odp-gallery {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        gap: 12px !important;
        width: 100% !important;
        margin-top: 5px !important;
    }
    
    .odp-image-wrapper {
        width: 110px !important;
        max-width: 110px !important;
        height: 90px !important;
        position: relative !important;
        border-radius: 10px !important;
        overflow: hidden !important;
        border: 1px solid #EAECF3 !important;
        background: #ffffff !important;
        padding: 4px !important;
        box-sizing: border-box !important;
        display: inline-block !important;
    }
    
    .odp-image-wrapper img {
        width: 100% !important;
        max-width: 100% !important;
        height: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        display: block !important;
        margin: 0 !important;
    }

    .odp-order-badge {
        position: absolute !important;
        bottom: 6px !important;
        right: 6px !important;
        background: rgba(30, 30, 45, 0.82) !important;
        color: #ffffff !important;
        font-size: 10px !important;
        padding: 2px 6px !important;
        border-radius: 5px !important;
        font-weight: 700 !important;
        line-height: 1 !important;
    }
</style>

<div class="visite-v2-container">
    
    <!-- 1. Commentaire -->
    <?php if (!empty($visite['commentaire'])): ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-commenting-o"></i> Commentaire</div>
            <div class="v2-content-block">
                <div class="v2-comment-card">
                    <?php echo iconv('ASCII', 'UTF-8//IGNORE', $visite['commentaire']); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 2. Objectif de visite -->
    <?php if (!empty($visite['objectif_visite'])): ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-bullseye"></i> Objectifs</div>
            <div class="v2-content-block">
                <div class="v2-badge-container">
                    <?php
                    foreach (explode(',', $visite['objectif_visite']) as $o) {
                        $lbl = isset($objVisiteLabels[trim($o)]) ? $objVisiteLabels[trim($o)] : $o;
                        echo "<span class='v2-badge-purple'>$lbl</span>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 3. Feedback Produits -->
    <?php if (!empty($feedbacks)): ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-medkit"></i> Feedback Produits</div>
            <div class="v2-content-block">
                <?php foreach ($feedbacks as $pid => $fb):
                    $pname = $this->requestAction('/games/system_get_name_game/' . $pid);
                    $adoptionVal = isset($fb['adoption']) ? $fb['adoption'] : '';
                    $adoptionClass = isset($adoptClasses[$adoptionVal]) ? $adoptClasses[$adoptionVal] : 'lb-v2-bg-gray';
                    $adoptionLbl = isset($adoptLabels[$adoptionVal]) ? $adoptLabels[$adoptionVal] : $adoptionVal;
                ?>
                    <div class="product-adoption-card">
                        <div class="product-card-header">
                            <span class="product-name"><?php echo $pname; ?></span>
                            <?php if (!empty($adoptionVal)): ?>
                                <span class="adoption-badge <?php echo $adoptionClass; ?>"><?php echo $adoptionLbl; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (!empty($fb['objections']) && is_array($fb['objections'])): ?>
                            <div class="objections-list">
                                <?php foreach ($fb['objections'] as $objKey => $objData):
                                    $objName = isset($objectionLabels[$objKey]) ? $objectionLabels[$objKey] : ucfirst(str_replace('_', ' ', $objKey));
                                    $retVal = isset($objData['retour']) ? $objData['retour'] : '';
                                    $retClass = isset($retourColors[$retVal]) ? $retourColors[$retVal] : 'lb-v2-bg-gray';
                                    $retLbl = isset($retourEmojis[$retVal]) ? $retourEmojis[$retVal] : $retVal;
                                ?>
                                    <div class="objection-item">
                                        <div class="objection-header">
                                            <span class="objection-name"><?php echo $objName; ?></span>
                                            <?php if (!empty($retVal)): ?>
                                                <span class="objection-status <?php echo $retClass; ?>"><?php echo $retLbl; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($objData['preciser'])): ?>
                                            <div class="objection-precision">
                                                <i class="fa fa-quote-left" style="font-size:10px; margin-right:6px; opacity:0.6;"></i>
                                                <?php echo h($objData['preciser']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- 4. Concurrents -->
    <?php
    if (!empty($visite['concurrence_p']) && substr(trim($visite['concurrence_p']), 0, 1) === '['):
        $concurrents = json_decode($visite['concurrence_p'], true);
        if (!empty($concurrents)):
    ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-balance-scale"></i> Concurrents</div>
            <div class="v2-content-block">
                <?php foreach ($concurrents as $cc):
                    $cpname = $this->requestAction('/games/system_get_name_game/' . $cc['produit_id']);
                ?>
                    <div class="competitor-card">
                        <div class="competitor-product-info">
                            <?php echo $cpname; ?> <i class="fa fa-long-arrow-right" style="margin: 0 6px; opacity: 0.4;"></i>
                            <span class="competitor-brand"><?php echo h($cc['concurrent']); ?></span>
                            <?php if (!empty($cc['frequence'])): ?>
                                <span class="adoption-badge lb-v2-bg-orange" style="margin-left:8px; font-size:11px;"><?php echo ucfirst($cc['frequence']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; endif; ?>

    <!-- 5. Distribution EMG -->
    <?php if (!empty($visite['distribution_emg'])):
        $emg = json_decode($visite['distribution_emg'], true);
    ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-gift"></i> Matériel EMG</div>
            <div class="v2-content-block">
                <div class="emg-container">
                    <?php if (!empty($emg['distribue'])): ?>
                        <span class="adoption-badge lb-v2-bg-green"><i class="fa fa-check"></i> Distribué</span>
                        <div style="margin-top: 4px;">
                            <?php if (!empty($emg['produits'])):
                                foreach ($emg['produits'] as $ep):
                                    $epname = $this->requestAction('/games/system_get_name_game/' . $ep['produit_id']);
                            ?>
                                <span class="emg-item"><?php echo $epname; ?> (<b><?php echo $ep['quantite']; ?></b>)</span>
                            <?php endforeach; endif; ?>
                        </div>
                    <?php else: ?>
                        <span class="adoption-badge lb-v2-bg-red"><i class="fa fa-times"></i> Non distribué</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 6. ODP (Ordre de présentation) -->
    <?php
    $visitesorders = $this->requestAction('/visiteordres/system_get_visiteordre/' . $visite['id']);
    if (!empty($visitesorders)): ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-image"></i> Ordre Présentation</div>
            <div class="v2-content-block">
                <div class="odp-gallery">
                    <?php 
                    $ord = 1;
                    foreach ($visitesorders as $value):
                        $logo = (!empty($value["Brochure"]["logo"])) ? "/img/brochures/" . $value["Brochure"]["logo"] : "https://dummyimage.com/300x300/eee/999&text=No+Logo";
                    ?>
                        <div class="odp-image-wrapper">
                            <img src="<?php echo $this->Html->url($logo); ?>" alt="Brochure" />
                            <div class="odp-order-badge"><?php echo $ord++; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 7. Requête CRM -->
    <?php if (!empty($visite['requete_crm'])): ?>
        <div class="v2-section">
            <div class="v2-section-title"><i class="fa fa-bell"></i> Requête CRM</div>
            <div class="v2-content-block">
                <div class="crm-request-banner">
                    <span><?php echo h($visite['requete_crm']); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
