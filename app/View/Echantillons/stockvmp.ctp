<style type="text/css">
    /* Theme Core Global Parameters */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Unified Content Containers */
    .stock-box-custom {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin: 20px 0 30px 0;
    }
    .stock-box-custom .box-header-custom {
        background: #ffffff;
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
    }
    .stock-box-custom .box-title-custom {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .stock-box-custom .box-body-custom {
        padding: 0;
    }

    /* Core Matrix Table Layout */
    .table-stock-custom {
        width: 100% !important;
        margin-bottom: 0;
        border-collapse: collapse;
        table-layout: fixed; /* Enforces strict alignment */
    }
    
    /* Header Row Matrix */
    .table-stock-custom thead th {
        background-color: var(--theme-primary-light);
        color: var(--theme-primary);
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.6px;
        font-weight: 700;
        padding: 16px 28px;
        border: none;
        border-bottom: 2px solid var(--theme-border);
    }

    /* Body Data Rows */
    .table-stock-custom tbody td {
        padding: 16px 28px;
        vertical-align: middle !important;
        border: none;
        border-bottom: 1px solid var(--theme-border);
        color: var(--theme-text-dark);
        font-size: 14px;
        font-weight: 500;
    }
    .table-stock-custom tbody tr:hover {
        background-color: var(--theme-primary-light);
    }

    /* Precision Width Allocations */
    .td-product {
        width: 75%;
        text-align: left;
    }
    .td-quantity {
        width: 25%;
        text-align: right;
    }

    /* Clean Styled Badges for Quantities */
    .stock-badge {
        display: inline-block;
        min-width: 42px;
        padding: 6px 12px;
        border-radius: 20px;
        background-color: var(--theme-primary-pale);
        color: var(--theme-primary);
        font-weight: 700;
        font-size: 13px;
        text-align: center;
        margin: 0;
    }

    /* Bold Summary Footer Elements */
    .table-stock-custom tbody tr.total-row-highlight {
        background-color: var(--theme-primary-light) !important;
    }
    .table-stock-custom tbody tr.total-row-highlight td {
        font-weight: 700;
        color: var(--theme-primary);
        font-size: 15px;
        border-top: 2px solid var(--theme-border);
        border-bottom: none;
    }
    .table-stock-custom tbody tr.total-row-highlight .stock-badge {
        background-color: var(--theme-primary);
        color: #ffffff;
    }
</style>

<div class="stock-box-custom">
    <div class="box-header-custom">
        <h3 class="box-title-custom"><?php echo __('Stock temps réel'); ?></h3>
    </div>
    <div class="box-body-custom">
        <div class="table-responsive" style="border: none;">
            <table class="table-stock-custom">
                <thead>
                    <tr>
                        <th class="td-product">Produit</th>
                        <th class="td-quantity">Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $t = 0;
                    $i = 0;
                    foreach ($stock as $value):
                        ?>
                        <tr>
                            <td class="td-product">
                                <?php echo h($value['Echantillon']['name']); ?>
                            </td>
                            <td class="td-quantity">
                                <span class="stock-badge">
                                    <?php
                                    echo $value['Stockgadjet']['quantite'];
                                    $t = $t + $value['Stockgadjet']['quantite'];
                                    ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <!-- Unified Summary Footer Row -->
                    <tr class="total-row-highlight">
                        <td class="td-product">Total</td>
                        <td class="td-quantity">
                            <span class="stock-badge">
                                <?php echo $t; ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>