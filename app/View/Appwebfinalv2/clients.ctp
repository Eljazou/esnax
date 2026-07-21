<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
.grid {
    width: 100%;
}

.client-list-container {
    padding: 20px;
    padding-bottom: 100px;
}

.client-item {
    width: 100%;
    box-sizing: border-box;
    background: #ffffff;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 16px;
    text-decoration: none;
    border: 1px solid #d4e0d9;
    box-shadow: 0 2px 8px rgba(0, 50, 30, 0.03);
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
}

.client-item:hover, .client-item:active {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 50, 30, 0.08);
    border-color: #00875A;
    text-decoration: none;
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

.star-badge {
    position: absolute;
    top: -6px; right: -6px;
    background: #e6a817;
    color: white;
    width: 22px; height: 22px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
.badge-cat { background: #f4f8f6; color: #5a6b63; }

.client-arrow {
    color: #d4e0d9;
    font-size: 18px;
    transition: all 0.2s;
}

.client-item:hover .client-arrow {
    color: #006241;
    transform: translateX(2px);
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
</style>

<!-- Header & Search -->
<div class="clients-header">
    <div class="header-top">
        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back btn_spiner">
            <i data-lucide="chevron-left"></i>
        </a>
        <h1 class="header-title">Liste des clients</h1>
    </div>
    
    <div class="search-wrapper">
        <i data-lucide="search" class="search-icon"></i>
        <input type="text" class="quicksearch search-input" placeholder="Rechercher un client, une ville...">
    </div>
</div>

<!-- Client List -->
<div class="client-list-container">
    <div class="grid">
        <?php $hasClient = false; foreach ($data as $client) : $hasClient = true; ?>
        
        <a href="<?php echo $this->Html->url(array("action" => "view_client", $code, $client["id"])); ?>" class="client-item element-item btn_spiner" id="<?php echo $client["id"]; ?>">
            <div class="client-avatar-wrapper">
                <div class="client-avatar">
                    <?php if ($client['type'] == "Médecin") { ?>
                        <?php echo $this->Html->image('docteur.png'); ?>
                    <?php } else if ($client['type'] == "Grossiste") { ?>
                        <?php echo $this->Html->image('paragrossiste.png'); ?>
                    <?php } else { ?>
                        <?php echo $this->Html->image('pharma.png'); ?>
                    <?php } ?>
                </div>
                <?php if ($client['action'] != 0) { ?>
                    <div class="star-badge"><i data-lucide="star"></i></div>
                <?php } ?>
            </div>
            
            <div class="client-info">
                <h3 class="client-name"><?php echo $client["name"]; ?></h3>
                <div class="client-meta">
                    <?php if (!empty($client["potentialite"])) { ?>
                        <span class="badge-pill badge-pot"><?php echo $client["potentialite"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($client["activite"])) { ?>
                        <span class="badge-pill badge-act"><?php echo $client["activite"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($client["category"])) { ?>
                        <span class="badge-pill badge-cat"><?php echo $client["category"]; ?></span>
                    <?php } ?>
                </div>
            </div>
            
            <i data-lucide="chevron-right" class="client-arrow"></i>
        </a>
        
        <?php endforeach; ?>
        
        <?php if (!$hasClient) : ?>
            <div class="empty-state">
                <i data-lucide="folder-open"></i>
                <p>Aucun client n'est disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src='https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js'></script>
<script>
    // Isotope filtering
    var qsRegex;
    var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        layoutMode: 'vertical',
        filter: function() { return qsRegex ? $(this).text().match(qsRegex) : true; }
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
            function delayed() { fn.apply(_this, args); }
            timeout = setTimeout(delayed, threshold);
        };
    }

    // React Native Bridge
    $(document).ready(function() { returnToApp(); });
    function returnToApp() {
        if (document.readyState === 'complete') {
            if(window.ReactNativeWebView) window.ReactNativeWebView.postMessage('location');
        } else {
            window.addEventListener('load', function() {
                if(window.ReactNativeWebView) window.ReactNativeWebView.postMessage('location');
            });
        }
    }
</script>