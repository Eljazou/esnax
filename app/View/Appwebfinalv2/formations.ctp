<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
    /* Premium Formations Design */
    body {
        background-color: var(--bg, #f7faf8);
        margin: 0;
        padding: 0;
        font-family: var(--font-family, 'Inter', sans-serif);
    }

    /* Header */
    .page-header {
        background: #ffffff;
        padding: 24px 20px 20px;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
        border-bottom: 1px solid #d4e0d9;
    }

    .header-top {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .btn-back {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: #f4f8f6;
        display: flex; align-items: center; justify-content: center;
        color: #1a2e24;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #e6f5ee;
        color: #006241;
        text-decoration: none;
    }

    .header-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a2e24;
        margin: 0;
    }

    /* Content Area */
    .content-container {
        padding: 24px 20px;
    }

    .formation-grid {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .formation-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #d4e0d9;
        box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .formation-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: #006241;
        opacity: 0;
        transition: all 0.2s;
    }

    .formation-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 50, 30, 0.08);
        border-color: #00875A;
        text-decoration: none;
    }

    .formation-card:hover::before {
        opacity: 1;
    }

    .formation-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: #e6f5ee;
        color: #006241;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px;
    }

    .formation-info {
        flex: 1;
    }

    .formation-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a2e24;
        margin: 0 0 4px 0;
    }

    .formation-game {
        font-size: 13px;
        color: #5a6b63;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .formation-arrow {
        color: #d4e0d9;
        font-size: 18px;
        transition: all 0.2s;
    }

    .formation-card:hover .formation-arrow {
        color: #006241;
        transform: translateX(2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 48px; color: #d4e0d9; margin-bottom: 16px;
    }

    .empty-state p {
        color: #5a6b63; font-size: 15px; font-weight: 500;
    }
    </style>
</head>

<body>

<div class="page-header">
    <div class="header-top">
        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back btn_spiner">
            <i data-lucide="chevron-left"></i>
        </a>
        <h1 class="header-title">Liste des formations</h1>
    </div>
</div>

<div class="content-container">
    <div class="formation-grid">
        <?php
        $hasFormation = false;
        foreach ($formations as $d) {
            $hasFormation = true;
        ?>
            <a href="<?php echo $this->Html->url("/img/formations/" . $d["Formation"]["file"]); ?>" class="formation-card">
                <div class="formation-icon">
                    <i data-lucide="graduation-cap"></i>
                </div>
                <div class="formation-info">
                    <h3 class="formation-title"><?php echo $d["Formation"]["name"] ?></h3>
                    <p class="formation-game">
                        <i data-lucide="layers"></i> <?php echo $d["Game"]["name"]; ?>
                    </p>
                </div>
                <i data-lucide="chevron-right" class="formation-arrow"></i>
            </a>
        <?php
        }

        if (!$hasFormation) {
            echo "<div class='empty-state'>
                    <i data-lucide='folder-open'></i>
                    <p>Aucune formation n'est disponible pour le moment.</p>
                  </div>";
        }
        ?>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
</body>
</html>