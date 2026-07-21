<style type="text/css">
    /* Theme Variables Integration */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        
        --theme-success: #5ad1a8;
        --theme-success-hover: #2f9c78;
        --theme-success-light: #e6faf3;

        --theme-info: #64b5f6;
        --theme-info-dark: #1e88e5;
        --theme-info-light: #e3f2fd;
        
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        
        --shadow-sm: 0 4px 14px rgba(155, 144, 224, 0.05);
        --shadow-md: 0 8px 24px rgba(155, 144, 224, 0.1);
    }

    /* Modern Metric KPI Grid Cards */
    .metric-card {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-lg);
        padding: 20px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    .metric-card .metric-info h3 {
        margin: 0 0 6px 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .metric-card .metric-info p {
        margin: 0;
        font-size: 13px;
        font-weight: 600;
        color: var(--theme-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }
    .metric-card .metric-icon {
        font-size: 32px;
        transition: transform 0.2s ease;
    }
    .metric-card:hover .metric-icon {
        transform: scale(1.15);
    }

    /* Metric Theme Variants */
    .metric-lavender { border-left: 4px solid var(--theme-primary); }
    .metric-lavender .metric-icon { color: var(--theme-primary); }
    
    .metric-info-variant { border-left: 4px solid var(--theme-info); }
    .metric-info-variant .metric-icon { color: var(--theme-info); }
    
    .metric-mint { border-left: 4px solid var(--theme-success); }
    .metric-mint .metric-icon { color: var(--theme-success); }

    /* Modernized Detail Block Header */
    .offer-details-box {
        background: linear-gradient(135deg, var(--theme-primary-light) 0%, #ffffff 100%);
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-sm);
    }
    .offer-details-box h3.title {
        margin: 0 0 8px 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .offer-details-box h5.desc {
        margin: 0 0 16px 0;
        font-size: 14px;
        color: var(--theme-text-muted);
        line-height: 1.5;
    }
    .offer-details-box .min-amount-badge {
        display: inline-block;
        background: #ffffff;
        border: 1px solid var(--theme-border);
        padding: 6px 14px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 13.5px;
        color: var(--theme-primary-hover);
    }

    /* Clean Styled Data Table Card */
    .box-info-custom {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 30px;
    }
    .box-info-custom .box-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--theme-border);
    }
    .box-info-custom .box-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .box-info-custom .box-body {
        padding: 0;
    }

    /* Clean Embedded Data Matrix Layout */
    table.table-custom {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }
    table.table-custom thead th {
        background: var(--theme-primary-light);
        color: var(--theme-primary-hover);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 14px 20px;
        border-bottom: 1px solid var(--theme-border);
    }
    table.table-custom tbody td {
        padding: 14px 20px;
        font-size: 14px;
        color: var(--theme-text-dark);
        border-bottom: 1px solid var(--theme-border);
        vertical-align: middle;
    }
    table.table-custom tbody tr:last-child td {
        border-bottom: none;
    }
    table.table-custom tbody tr:hover td {
        background-color: #fafbfe;
    }

    /* Modern Styled Controls and Buttons */
    .box-footer-custom {
        padding: 16px 24px;
        background: #fafbfe;
        border-top: 1px solid var(--theme-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .btn-theme {
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
        border-radius: var(--radius-sm);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-theme-primary {
        background: var(--theme-primary);
        color: #ffffff !important;
    }
    .btn-theme-primary:hover {
        background: var(--theme-primary-hover);
    }
    .btn-theme-muted {
        background: #ffffff;
        color: var(--theme-text-muted) !important;
        border: 1px solid var(--theme-border);
    }
    .btn-theme-muted:hover {
        background: var(--theme-primary-light);
        color: var(--theme-primary-hover) !important;
    }
</style>

<!-- Metric Cards Block Matrix -->
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-3 col-sm-6" style="margin-bottom:20px;">
        <div class="metric-card metric-lavender">
            <div class="metric-info">
                <h3 id="ptht">—</h3>
                <p>Prix total (HT)</p>
            </div>
            <div class="metric-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6" style="margin-bottom:20px;">
        <div class="metric-card metric-lavender">
            <div class="metric-info">
                <h3 id="ptttc">—</h3>
                <p>Prix total (TTC)</p>
            </div>
            <div class="metric-icon">
                <i class="fa fa-bar-chart"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6" style="margin-bottom:20px;">
        <div class="metric-card metric-info-variant">
            <div class="metric-info">
                <h3 id="ptsreduction">—</h3>
                <p>Prix brut sans réduction</p>
            </div>
            <div class="metric-icon">
                <i class="fa fa-tags"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6" style="margin-bottom:20px;">
        <div class="metric-card metric-mint">
            <div class="metric-info">
                <h3 id="totalsave">—</h3>
                <p>Total à gagner</p>
            </div>
            <div class="metric-icon">
                <i class="fa fa-pie-chart"></i>
            </div>
        </div>
    </div>
</div>

<!-- Header Configuration Info Area -->
<div class="row">
    <div class="col-md-6">
        <div class="offer-details-box">
            <h3 class="title"><?php echo h($offre['Offre']['titre']); ?></h3>
            <h5 class="desc"><?php echo h($offre['Offre']['description']); ?></h5>
            <div class="min-amount-badge">
                <i class="fa fa-money"></i> Montant minimal : <strong><?php echo h($offre['Offre']['montantmin']); ?> DH</strong>
            </div>
        </div>
    </div>
</div>

<!-- Data Sheet Module Box -->
<div class="box-info-custom">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Liste des produits'); ?></h3>
    </div>
    
    <div class="box-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Réduction</th>
                        <th>Prix HT</th>
                        <th>Prix TTC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $prixtotalht = 0;
                    $prixtotalsansrduction = 0;
                    foreach ($offre['Offrespicial'] as $value) :
                    ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--theme-text-dark);"><?php echo h($value['Produit']['name']); ?></td>
                            <td><?php echo number_format(round($value['Produit']['prix'], 2), 2, '.', ' '); ?> Dhs</td>
                            <td style="font-weight: 600;"><?php echo h($value['quantite']); ?></td>
                            <td><span class="label" style="background: var(--theme-primary-light); color: var(--theme-primary-hover); font-weight: 700; padding: 4px 8px; border-radius: 4px;"><?php echo h($value['reduction']); ?>%</span></td>
                            <td style="font-weight: 600;">
                                <?php
                                $prixht = $value['Produit']['prix'] * $value['quantite'] * (1 - $value['reduction'] / 100);
                                echo number_format(round($prixht, 2), 2, '.', ' ');
                                $prixtotalht += $prixht;
                                $prixtotalsansrduction += $value['Produit']['prix'] * $value['quantite'];
                                ?> Dhs
                            </td>
                            <td style="font-weight: 600; color: var(--theme-success-hover);"><?php echo number_format(round($prixht * 1.2, 2), 2, '.', ' '); ?> Dhs</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Footer Controls Matrix Actions -->
    <div class="box-footer-custom">
        <div>
            <?php
            if ($this->requestAction('/droits/getrole/offres/edit') == 1)
                echo $this->Html->link('<i class="fa fa-pencil" style="margin-right: 6px;"></i> ' . __('Editer l\'offre'), array('action' => 'edit', $offre['Offre']['id']), array('class' => "btn-theme btn-theme-primary", 'escape' => false));
            ?>
        </div>
        <div>
            <?php
            if ($this->requestAction('/droits/getrole/offres/archive') == 1)
                echo $this->Html->link('<i class="fa fa-archive" style="margin-right: 6px;"></i> ' . __('Archiver l\'offre'), array('action' => 'archive', $offre['Offre']['id'], 0), array('class' => "btn-theme btn-theme-muted", 'escape' => false));
            ?>
        </div>
    </div>
</div>

<!-- Reactive Scripting Matrix -->
<script>
    document.getElementById('ptht').innerHTML = "<?php echo number_format(round($prixtotalht, 2), 2, '.', ' '); ?> Dhs";
    document.getElementById('ptttc').innerHTML = "<?php echo number_format(round($prixtotalht * 1.2, 2), 2, '.', ' '); ?> Dhs";
    document.getElementById('ptsreduction').innerHTML = "<?php echo number_format(round($prixtotalsansrduction * 1.2, 2), 2, '.', ' '); ?> Dhs";
    document.getElementById('totalsave').innerHTML = "<?php echo number_format(round(($prixtotalsansrduction - $prixtotalht) * 1.2, 2), 2, '.', ' '); ?> Dhs";
</script>