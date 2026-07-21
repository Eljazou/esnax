<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    
    <style>
    /* Premium List Design */
    body {
        background-color: var(--bg, #f7faf8);
        margin: 0;
        padding: 0;
        font-family: var(--font-family, 'Inter', sans-serif);
    }

    .clients-header {
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
        margin-bottom: 20px;
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

    /* Premium Search Bar */
    .search-wrapper {
        position: relative;
    }

    .search-input {
        width: 100%;
        height: 48px;
        background: #f4f8f6;
        border: 1.5px solid transparent;
        border-radius: 14px;
        padding: 0 20px 0 48px;
        font-size: 15px;
        font-family: inherit;
        color: #1a2e24;
        transition: all 0.2s;
        outline: none;
    }

    .search-input:focus {
        background: #ffffff;
        border-color: #006241;
        box-shadow: 0 4px 16px rgba(0, 98, 65, 0.08);
    }

    .search-input::placeholder { color: #8a9b93; }

    .search-icon {
        position: absolute;
        left: 18px; top: 50%;
        transform: translateY(-50%);
        color: #8a9b93;
        font-size: 16px;
    }

    /* Client List Grid */
    .client-list-container {
        padding: 20px;
        padding-bottom: 100px;
    }

    .client-item {
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 12px;
        text-decoration: none;
        border: 1px solid #d4e0d9;
        box-shadow: 0 2px 8px rgba(0, 50, 30, 0.03);
        transition: all 0.2s;
        position: relative;
    }

    .client-item-content {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }

    .client-avatar-wrapper {
        position: relative;
    }

    .client-avatar {
        width: 52px; height: 52px;
        border-radius: 16px;
        background: #f4f8f6;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px;
        color: #006241;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .client-avatar img {
        width: 32px; height: 32px;
        object-fit: contain;
    }

    .client-info {
        flex: 1;
    }

    .client-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a2e24;
        margin: 0 0 6px 0;
        line-height: 1.2;
    }

    .client-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }

    .badge-pill {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-pot { background: #fdf0ef; color: #d9534f; }
    .badge-act { background: #e6f5ee; color: #006241; }
    .badge-time { background: #f4f8f6; color: #5a6b63; }

    /* Action Buttons */
    .client-actions {
        display: flex;
        gap: 8px;
        border-top: 1px solid #f4f8f6;
        padding-top: 12px;
    }

    .btn-action {
        flex: 1;
        padding: 10px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-valide {
        background: #e6f5ee;
        color: #006241;
    }
    
    .btn-valide:hover {
        background: #006241;
        color: #ffffff;
    }

    .btn-refuse {
        background: #fdf0ef;
        color: #d9534f;
    }
    
    .btn-refuse:hover {
        background: #d9534f;
        color: #ffffff;
    }

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

    /* Modals */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .modal-header {
        border-bottom: none;
        padding: 24px 24px 0;
    }
    .modal-title {
        font-weight: 700;
        color: #1a2e24;
    }
    .modal-body {
        padding: 20px 24px;
        text-align: center;
    }
    .modal-body p {
        color: #5a6b63;
        font-size: 15px;
    }
    .modal-body strong {
        color: #1a2e24;
        font-size: 18px;
        display: block;
        margin-top: 8px;
    }
    .modal-icon {
        font-size: 64px;
        margin-bottom: 16px;
        display: block;
    }
    .modal-icon.icon-valide { color: #006241; }
    .modal-icon.icon-refuse { color: #d9534f; }
    
    .modal-footer {
        border-top: none;
        padding: 0 24px 24px;
        display: flex;
        gap: 12px;
        flex-wrap: nowrap;
    }
    .modal-footer .btn {
        flex: 1;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
    }
    .btn-cancel {
        background: #f4f8f6;
        color: #5a6b63;
    }
    .btn-confirm-valide {
        background: #006241;
        color: white;
    }
    .btn-confirm-refuse {
        background: #d9534f;
        color: white;
    }
    </style>
</head>
<body>

<div class="clients-header">
    <div class="header-top">
        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back btn_spiner">
            <i data-lucide="chevron-left"></i>
        </a>
        <h1 class="header-title">Validation des visites</h1>
    </div>
    
    <div class="search-wrapper">
        <i data-lucide="search" class="search-icon"></i>
        <input type="text" class="quicksearch search-input" placeholder="Rechercher...">
    </div>
</div>

<div class="client-list-container">
    <div class="grid">
        <?php
        $hasClient = false;
        foreach ($visites as $client):
            $hasClient = true;
            $time_min = round((time() - strtotime($client["Visite"]["created"])) / 60);
        ?>
            <div class="client-item element-item" id="<?php echo $client["Visite"]["id"]; ?>">
                <div class="client-item-content">
                    <div class="client-avatar-wrapper">
                        <div class="client-avatar">
                            <?php echo $this->Html->image('docteur.png', array('style' => 'width:32px; height:32px; object-fit:contain;')); ?>
                        </div>
                    </div>
                    
                    <div class="client-info">
                        <h3 class="client-name"><?php echo $client["Client"]["nom"] . " " . $client["Client"]["prenom"] ?></h3>
                        <div class="client-meta">
                            <?php if (!empty($client["Client"]["potentialite"])) { ?>
                                <span class="badge-pill badge-pot"><?php echo $client["Client"]["potentialite"]; ?></span>
                            <?php } ?>
                            <span class="badge-pill badge-act"><?php echo $client["User"]["name"]; ?></span>
                            <span class="badge-pill badge-time"><i data-lucide="clock"></i> Il y a <?php echo $time_min; ?> min</span>
                        </div>
                    </div>
                </div>

                <div class="client-actions">
                    <button type="button" class="btn-action btn-valide" data-toggle="modal" data-target="#confirmationvalideModal" data-client-id="<?php echo $client["Visite"]["client_id"]; ?>" data-client-name="<?php echo addslashes($client["Client"]["nom"] . ' ' . $client["Client"]["prenom"]); ?>" data-visite-id="<?php echo $client["Visite"]["id"]; ?>">
                        <i data-lucide="check"></i> Valider
                    </button>
                    <button type="button" class="btn-action btn-refuse" data-toggle="modal" data-target="#confirmationrefuseModal" data-client-id="<?php echo $client["Visite"]["client_id"]; ?>" data-client-name="<?php echo addslashes($client["Client"]["nom"] . ' ' . $client["Client"]["prenom"]); ?>" data-visite-id="<?php echo $client["Visite"]["id"]; ?>">
                        <i data-lucide="x"></i> Refuser
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (!$hasClient): ?>
            <div class="empty-state">
                <i data-lucide="clipboard-check"></i>
                <p>Aucune visite en attente de validation.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Validation Modal -->
<div class="modal fade" id="confirmationvalideModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validation</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span><i data-lucide="x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-icon" style="color: var(--success); text-align: center; margin-bottom: 16px;">
                    <i data-lucide="check-circle" style="width: 48px; height: 48px;"></i>
                </div>
                <p>Voulez-vous valider la visite de <strong id="modalClientNameValide"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Annuler</button>
                <a id="btnOui" href="#" class="btn btn-confirm-valide btn_spiner">Confirmer</a>
            </div>
        </div>
    </div>
</div>

<!-- Refusal Modal -->
<div class="modal fade" id="confirmationrefuseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Refus</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span><i data-lucide="x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-icon" style="color: var(--error); text-align: center; margin-bottom: 16px;">
                    <i data-lucide="x-circle" style="width: 48px; height: 48px;"></i>
                </div>
                <p>Voulez-vous refuser la visite de <strong id="modalClientNameRefuse"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Annuler</button>
                <a id="btnRefuse" href="#" class="btn btn-confirm-refuse btn_spiner">Refuser</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src='https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js'></script>
<script type="text/javascript">
    var qsRegex;
    var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        layoutMode: 'fitRows',
        filter: function() {
            return qsRegex ? $(this).text().match(qsRegex) : true;
        }
    });

    var $quicksearch = $('.quicksearch').keyup(debounce(function() {
        qsRegex = new RegExp($quicksearch.val(), 'gi');
        $grid.isotope();
    }, 200));

    function debounce(fn, threshold) {
        var timeout;
        threshold = threshold || 100;
        return function debounced() {
            clearTimeout(timeout);
            var args = arguments;
            var _this = this;
            function delayed() {
                fn.apply(_this, args);
            }
            timeout = setTimeout(delayed, threshold);
        };
    }

    // Pass data to modals
    $('#confirmationvalideModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var clientName = button.data('client-name');
        var visiteId = button.data('visite-id');
        var modal = $(this);
        modal.find('#modalClientNameValide').text(clientName);
        // Assuming action link is something like: valider_visite/123
        // You may need to adapt this link based on your routing
        modal.find('#btnOui').attr('href', '<?php echo $this->Html->url(array("action" => "valider_visite", $code)); ?>/' + visiteId);
    });

    $('#confirmationrefuseModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var clientName = button.data('client-name');
        var visiteId = button.data('visite-id');
        var modal = $(this);
        modal.find('#modalClientNameRefuse').text(clientName);
        // Assuming action link is something like: refuser_visite/123
        modal.find('#btnRefuse').attr('href', '<?php echo $this->Html->url(array("action" => "refuser_visite", $code)); ?>/' + visiteId);
    });
</script>

</body>
</html>