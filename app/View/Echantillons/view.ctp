<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'échantillon</title>
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

        /* Horizontal Profile Card */
        .profile-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            width: 100%;
            box-sizing: border-box;
            padding: 16px 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .profile-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .profile-badges {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-id, .badge-date {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
        }

        .badge-id {
            color: #2563eb;
            background-color: #eff6ff;
        }

        .badge-date {
            color: #0891b2;
            background-color: #ecfeff;
        }

        /* Form Actions & Buttons */
        .btn-primary-block {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563eb !important;
            color: #ffffff !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            padding: 8px 20px !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            transition: background-color 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: none;
            cursor: pointer;
        }

        .btn-primary-block:hover {
            background-color: #1d4ed8 !important;
        }

        /* Table Section */
        .box {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 24px;
            border: 1px solid #e2e8f0;
            width: 100%;
            box-sizing: border-box;
        }

        .box-header h3.box-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 8px;
        }

        .box-header h3.box-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
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

        .table td a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .table td a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .table tbody tr:hover td {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>

<!-- Profile Block — single horizontal card -->
<div class="profile-card">

    <!-- Left: title -->
    <h3 class="profile-title"><?php echo h($echantillon['Echantillon']['name']); ?></h3>

    <!-- Center: ID + date badges -->
    <div class="profile-badges">
        <span class="badge-id">ID: <?php echo h($echantillon['Echantillon']['id']); ?></span>
        <span class="badge-date"><?php echo $echantillon['Echantillon']['created']; ?></span>
    </div>

    <!-- Right: edit button -->
    <a href="<?php echo $this->Html->url(array('action' => 'edit', $echantillon['Echantillon']['id'])); ?>" class="btn-primary-block">
        Editer
    </a>

</div>

<!-- Demands List Data Table Block -->
<?php if (!empty($echantillon['Gadjet'])): ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('Liste des demandes'); ?></h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo __('Utilisateur'); ?></th>
                        <th><?php echo __('Quantité'); ?></th>
                        <th><?php echo __('Date début'); ?></th>
                        <th><?php echo __('Date fin'); ?></th>
                        <th><?php echo __('Date de création'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($echantillon['Gadjet'] as $gadjet): ?>
                        <tr>
                            <td>
                                <?php 
                                $user = $this->requestAction('/users/system_get_name_user/'.$gadjet['user_id']);
                                echo $this->Html->link($user, array('controller' => 'users', 'action' => 'view', $gadjet['user_id'])); 
                                ?>
                            </td>
                            <td><strong><?php echo $gadjet['quantite']; ?></strong></td>
                            <td><?php echo !empty($gadjet['date_debut']) ? $gadjet['date_debut'] : '—'; ?></td>
                            <td><?php echo !empty($gadjet['date_fin']) ? $gadjet['date_fin'] : '—'; ?></td>
                            <td><?php echo $gadjet['created']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

</body>
</html>