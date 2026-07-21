<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Produit</title>
    <style>
        /* Global & Layout Setup */
        body {
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #334155;
            padding: 24px;
            margin: 0;
            line-height: 1.5;
        }

        .view-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Top Hero Card for Product Profile */
        .product-hero-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .product-meta h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .product-meta .product-name {
            font-size: 1rem;
            color: #64748b;
            margin: 0 0 8px 0;
        }

        .product-meta .product-price {
            font-size: 1.15rem;
            font-weight: 700;
            color: #2563eb;
            margin: 0;
        }

        .btn-edit {
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-edit:hover {
            background-color: #1d4ed8;
        }

        /* Modern Navigation Tabs Layout */
        .tabs-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .tabs-nav {
            display: flex;
            background-color: #f1f5f9;
            padding: 0;
            margin: 0;
            list-style: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabs-nav a {
            display: block;
            padding: 14px 24px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .tabs-nav li.active a {
            color: #2563eb;
            border-bottom-color: #2563eb;
            background-color: #ffffff;
        }

        .tab-content {
            padding: 24px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .table-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 16px;
        }

        /* Modern Tables Data Presentation */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        .custom-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .custom-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .custom-table tr:hover td {
            background-color: #f8fafc;
        }

        /* Inline Action Links inside Tables */
        .actions-cell a {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 12px;
            color: #2563eb;
        }

        .actions-cell a:hover {
            text-decoration: underline;
        }

        .actions-cell a[id*="link"] { /* Target postLink/deletes */
            color: #dc2626;
        }

        /* Empty state notification banner */
        .empty-state {
            padding: 32px;
            text-align: center;
            color: #94a3b8;
            font-size: 0.95rem;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="view-container">

    <!-- Top Info Section -->
    <div class="product-hero-card">
        <div class="product-meta">
            <h3><?php echo h($produit['Produit']['code']); ?></h3>
            <div class="product-name"><?php echo h($produit['Produit']['name']); ?></div>
            <!-- Formatted to 2 decimal places natively -->
            <div class="product-price"><?php echo number_format((float)$produit['Produit']['prix'], 2, ',', ' ') . ' €'; ?></div>
        </div>
        <div>
            <a href="<?php echo $this->Html->url(array('action' => 'edit', $produit['Produit']['id'])); ?>" class="btn-edit">
                <?php echo __('Éditer'); ?>
            </a>
        </div>
    </div>

    <!-- Bottom Lists Section -->
    <div class="tabs-container">
        <ul class="tabs-nav">
            <li class="active"><a href="#tab_2" data-toggle="tab">Commandes</a></li>
            <li><a href="#tab_3" data-toggle="tab">Offres</a></li>
        </ul>
        
        <div class="tab-content">
            <!-- Tab 2: Commandes -->
            <div class="tab-pane active" id="tab_2">
                <h4 class="table-title"><?php echo __('Liste des commandes liées au produit'); ?></h4>
                <?php if (!empty($produit['Comander'])): ?>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th><?php echo __('Quantité'); ?></th>
                                    <th><?php echo __('Date de création'); ?></th>
                                    <th><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produit['Comander'] as $comander): ?>
                                    <tr>
                                        <td><?php echo h($comander['quantite']); ?></td>
                                        <td><?php echo h($comander['created']); ?></td>
                                        <td class="actions-cell">
                                            <?php echo $this->Html->link(__('Voir'), array('controller' => 'comanders', 'action' => 'view', $comander['id'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state"><?php echo __('Aucune commande trouvée.'); ?></div>
                <?php endif; ?>
            </div>  

            <!-- Tab 3: Offres -->
            <div class="tab-pane" id="tab_3">
                <h4 class="table-title"><?php echo __('Liste des offres liées au produit'); ?></h4>
                <?php if (!empty($produit['Offre'])): ?>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th><?php echo __('Produit'); ?></th>
                                    <th><?php echo __('Quantité'); ?></th>
                                    <th><?php echo __('Montant'); ?></th>
                                    <th><?php echo __('Date de création'); ?></th>
                                    <th><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produit['Offre'] as $offre): ?>
                                    <tr>
                                        <td><?php echo h($offre['produit_id']); ?></td>
                                        <td><?php echo h($offre['quantite']); ?></td>
                                        <td><?php echo number_format((float)$offre['mantant'], 2, ',', ' ') . ' €'; ?></td>
                                        <td><?php echo h($offre['created']); ?></td>
                                        <td class="actions-cell">
                                            <?php echo $this->Html->link(__('Voir'), array('controller' => 'offres', 'action' => 'view', $offre['id'])); ?>
                                            <?php echo $this->Html->link(__('Éditer'), array('controller' => 'offres', 'action' => 'edit', $offre['id'])); ?>
                                            <?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'offres', 'action' => 'delete', $offre['id']), array('confirm' => __('Voulez-vous vraiment supprimer cet élément ?'))); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state"><?php echo __('Aucune offre trouvée.'); ?></div>
                <?php endif; ?>
            </div>              
        </div>
    </div>
</div>

<!-- JavaScript to handle switching tabs without depending on legacy Bootstrap files -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tabs-nav a');
        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                
                // Remove active classes from navigation items
                document.querySelectorAll('.tabs-nav li').forEach(li => li.classList.remove('active'));
                // Remove active classes from display panes
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                
                // Activate clicked tab elements
                this.parentElement.classList.add('active');
                const activePaneId = this.getAttribute('href');
                document.querySelector(activePaneId).classList.add('active');
            });
        });
    });
</script>

</body>
</html>