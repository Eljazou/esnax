<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Gamme</title>
    <style>
        /* Modern Container & Global Styles */
        body {
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #334155;
            padding: 24px;
            margin: 0;
            line-height: 1.5;
        }

        .box {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
            padding: 24px;
            border: 1px solid #e2e8f0;
        }

        /* Clean Header Layouts */
        .box-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 8px;
        }

        /* Accent indicator line under headers */
        .box-header h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        /* Top Gamme Details Header */
        dl {
            margin: 0;
        }
        dt h3 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin: 0;
        }
        /* Overriding inline styles cleanly */
        dd h4 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin: 6px 0 0 0 !important;
            padding: 0 !important; 
        }

        /* Table Modernization */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 8px;
        }

        .table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            border-bottom: 2px solid #e2e8f0;
        }

        .table td {
            padding: 14px 16px;
            font-size: 0.9rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #ffffff;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f8fafc;
        }

        .table tr:hover td {
            background-color: #f1f5f9;
        }

        /* Standalone Document Links */
        .table td a:not(.btn) {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }
        
        .table td a:not(.btn):hover {
            text-decoration: underline;
        }

        /* Converting CakePHP links into sleek action buttons */
        .table td.actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .table td.actions a.btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 14px !important;
            font-size: 0.8rem !important;
            font-weight: 500 !important;
            border-radius: 6px !important;
            text-decoration: none !important;
            transition: all 0.2s ease;
            margin: 0 !important; /* Removes layoutbreaking margins */
            border: 1px solid transparent;
        }

        /* Dynamic targeting for button types based on text/order */
        /* Voir (View) Button Style */
        .table td.actions a.btn:nth-child(1) {
            background-color: #eff6ff !important;
            color: #1d4ed8 !important;
        }
        .table td.actions a.btn:nth-child(1):hover {
            background-color: #dbeafe !important;
        }

        /* Editer (Edit) Button Style */
        .table td.actions a.btn:nth-child(2) {
            background-color: #fef3c7 !important;
            color: #b45309 !important;
        }
        .table td.actions a.btn:nth-child(2):hover {
            background-color: #fde68a !important;
        }

        /* Archiver (Archive) Button Style */
        .table td.actions a.btn:nth-child(3) {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
        }
        .table td.actions a.btn:nth-child(3):hover {
            background-color: #fca5a5 !important;
        }
    </style>
</head>
<body>

<!-- Box 1: Gamme details header -->
<div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
        <dl>
            <dt><h3><?php echo __('La gamme'); ?></h3></dt>
            <dd><h4><?php echo h($game['Game']['name']); ?></h4></dd>
        </dl>
    </div>
</div>

<!-- Box 2: Brochures Linked Table -->
<div class="box">
    <div class="box-header">
        <h3><?php echo __('Brochures liées à la gamme'); ?></h3>
    </div>
    <div class="box-body">
    <?php if (!empty($game['Brochure'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __('Nom de la brochure'); ?></th>
                    <th><?php echo __('Brochure'); ?></th>
                    <th><?php echo __('Date de création'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($game['Brochure'] as $brochure): ?>
                <tr>
                    <td><?php echo $brochure['name']; ?></td>
                    <td><a href="/img/brochures/<?php echo $brochure['file']; ?>">Visualiser</a></td>
                    <td><?php echo $brochure['created']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Voir'), array('controller' => 'brochures', 'action' => 'view', $brochure['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Editer'), array('controller' => 'brochures', 'action' => 'edit', $brochure['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Archiver'), array('controller' => 'brochures', 'action' => 'archive', $brochure['id']), array("class"=>"btn bg-blue btn-flat"), 0); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
</div>

<!-- Box 3: Samples Linked Table -->
<div class="box">
    <div class="box-header">
        <h3><?php echo __('Echantillons liés à la gamme'); ?></h3>
    </div>
    <div class="box-body">
    <?php if (!empty($game['Echantillon'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __('Echantillon'); ?></th>
                    <th><?php echo __('Date de création'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($game['Echantillon'] as $echantillon): ?>
                <tr>
                    <td><?php echo $echantillon['name']; ?></td>
                    <td><?php echo $echantillon['created']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Voir'), array('controller' => 'echantillons', 'action' => 'view', $echantillon['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Editer'), array('controller' => 'echantillons', 'action' => 'edit', $echantillon['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Archiver'), array('controller' => 'echantillons', 'action' => 'archive', $echantillon['id']), array("class"=>"btn bg-blue btn-flat"), 0); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
</div>

<!-- Box 4: Products Linked Table (With Cleaned Container Closures) -->
<div class="box">
    <div class="box-header">
        <h3><?php echo __('Produits liés à la gamme'); ?></h3>
    </div>
    <div class="box-body">
    <?php if (!empty($game['Produit'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __('Code du produit'); ?></th>
                    <th><?php echo __('Produit'); ?></th>
                    <th><?php echo __('Prix'); ?></th>
                    <th><?php echo __('Created'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($game['Produit'] as $produit): ?>
                <tr>
                    <td><?php echo $produit['code']; ?></td>
                    <td><?php echo $produit['name']; ?></td>
                    <td><?php echo $produit['prix']; ?></td>
                    <td><?php echo $produit['created']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Voir'), array('controller' => 'produits', 'action' => 'view', $produit['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Editer'), array('controller' => 'produits', 'action' => 'edit', $produit['id']), array("class"=>"btn bg-blue btn-flat")); ?>
                        <?php echo $this->Html->link(__('Archiver'), array('controller' => 'produits', 'action' => 'archive', $produit['id']), array("class"=>"btn bg-blue btn-flat"), 0); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
</div>

</body>
</html>