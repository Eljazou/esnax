<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    /* New Premium Styles for index.ctp */
    body {
        background-color: var(--bg, #f7faf8);
        margin: 0;
        padding: 0;
    }

    /* Premium Hero Header */
    .hero-header {
        background: linear-gradient(135deg, #006241 0%, #00875A 100%);
        padding: 40px 24px 80px 24px;
        border-radius: 0 0 32px 32px;
        color: white;
        position: relative;
        box-shadow: 0 12px 32px rgba(0, 98, 65, 0.2);
    }

    .hero-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .hero-greeting {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .hero-sub {
        font-size: 15px;
        opacity: 0.9;
        font-weight: 400;
    }

    .btn-logout {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-logout:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: scale(0.95);
    }

    /* Glassmorphic Visit Card */
    .visit-card-wrapper {
        margin-top: -50px;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .visit-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 8px 32px rgba(0, 50, 30, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;
    }

    .visit-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }

    .visit-card.color-green::before {
        background: #00875A;
    }

    .visit-card.color-orange::before {
        background: #e6a817;
    }

    .visit-card.color-red::before {
        background: #d9534f;
    }

    .visit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .visit-badge {
        background: #e6f5ee;
        color: #006241;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .visit-badge i {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }

        100% {
            opacity: 1;
        }
    }

    .btn-delete-visit {
        color: #d9534f;
        background: #fdf0ef;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .visit-client-name {
        font-size: 18px;
        font-weight: 700;
        color: #1a2e24;
        margin-bottom: 4px;
    }

    .visit-stats {
        display: flex;
        gap: 16px;
        margin-top: 12px;
    }

    .v-stat {
        display: flex;
        flex-direction: column;
    }

    .v-stat-label {
        font-size: 11px;
        color: #8a9b93;
        text-transform: uppercase;
        font-weight: 600;
    }

    .v-stat-val {
        font-size: 14px;
        color: #1a2e24;
        font-weight: 600;
    }

    /* Premium Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        padding: 24px 20px 100px 20px;
    }

    .dash-item {
        background: #ffffff;
        border-radius: 20px;
        padding: 20px 16px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
        border: 1px solid #d4e0d9;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .dash-item:hover,
    .dash-item:active {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 98, 65, 0.12);
        border-color: #006241;
        text-decoration: none;
    }

    .dash-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.2s ease;
    }

    /* Primary style cards */
    .dash-item.primary .dash-icon-wrapper {
        background: #e6f5ee;
        color: #006241;
    }

    .dash-item.primary:hover .dash-icon-wrapper {
        background: linear-gradient(135deg, #006241, #00875A);
        color: white;
    }

    /* Secondary style cards */
    .dash-item.secondary .dash-icon-wrapper {
        background: #f4f8f6;
        color: #5a6b63;
    }

    .dash-item.secondary:hover .dash-icon-wrapper {
        background: #e6f5ee;
        color: #006241;
    }

    /* Accent style cards */
    .dash-item.accent .dash-icon-wrapper {
        background: #eaf2fd;
        color: #2b7de9;
    }

    .dash-item.accent:hover .dash-icon-wrapper {
        background: #2b7de9;
        color: white;
    }

    .dash-title {
        color: #1a2e24;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.3;
        margin: 0;
    }

    /* caption application footer  */
    .appfooter {
        display: flex;
        width: 100%;
        justify-content: center;
        height: 33px;
        align-items: center;
    }

    .appfooter p {
        margin: 0;
        font-size: 12px;
        font-family: 'Inter';
        opacity: 0.4;
        text-shadow: 0px 0px 13px #a5a5a5;
    }

    /* Modal specific tweaks */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 12px 40px rgba(0, 30, 20, 0.15);
    }

    .modal-header {
        border: none;
        padding: 24px 24px 0;
    }

    .modal-body {
        padding: 20px 24px;
        color: #5a6b63;
        font-size: 15px;
        text-align: center;
    }

    .modal-footer {
        border: none;
        padding: 0 24px 24px;
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .modal-footer .btn {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        width: 45%;
    }

    .modal-footer .btn-secondary {
        background: #f4f8f6;
        color: #5a6b63;
        border: none;
    }

    .modal-footer .btn-danger {
        background: #d9534f;
        color: white;
    }
</style>

<!-- Hero Section -->
<div class="hero-header">
    <div class="hero-top">
        <div>
            <h1 class="hero-greeting">👋 <?php echo $user_name; ?></h1>
            <div class="hero-sub">Bienvenue sur votre tableau de bord</div>
        </div>
        <a href="<?php echo $this->Html->Url(array("action" => "logout", $code)); ?>" class="btn-logout">
            <i data-lucide="log-out"></i>
        </a>
    </div>
</div>

<!-- Active Visit Section -->
<?php if (count($visiteencour) != 0): ?>
    <?php
    $time = $visiteencour["Visite"]["timer"];
    $array_time = explode(" ", $time);
    $numbertime = (int) $array_time[0];
    $lettretime = $array_time[1];
    $colorCard = '';
    if (($numbertime <= 30 && $lettretime == "min") || $lettretime == "sec") {
        $colorCard = 'color-green';
    } elseif ($numbertime >= 30 && $numbertime <= 45 && $lettretime == "min") {
        $colorCard = 'color-orange';
    } else {
        $colorCard = 'color-red';
    }

    $d = $visiteencour["Visite"]["date"];
    $d = explode(" ", $d);
    $d = explode(":", $d[1]);
    $heure = "$d[0]:$d[1]";
    ?>
    <div class="visit-card-wrapper">
        <a href="<?php echo $this->Html->url(array("action" => "view_client", $code, $visiteencour["Client"]["id"])); ?>"
            style="text-decoration: none;">
            <div class="visit-card <?php echo $colorCard; ?>">
                <div class="visit-header">
                    <div class="visit-badge"><i data-lucide="activity"></i> Visite en cours</div>
                    <div class="btn-delete-visit"
                        onclick="event.preventDefault(); $('#deleteConfirmationModal').modal('show');">
                        <i data-lucide="trash-2"></i>
                    </div>
                </div>
                <div class="visit-client-name">
                    <?php echo $visiteencour["Client"]["nom"] . ", " . $visiteencour["Client"]["prenom"]; ?>
                </div>

                <div class="visit-stats">
                    <div class="v-stat">
                        <span class="v-stat-label">Démarrée à</span>
                        <span class="v-stat-val"><?php echo $heure; ?></span>
                    </div>
                    <div class="v-stat">
                        <span class="v-stat-label">Temps passé</span>
                        <span class="v-stat-val"><?php echo $visiteencour["Visite"]["timer"]; ?></span>
                    </div>
                    <div class="v-stat">
                        <span class="v-stat-label">Potentiel</span>
                        <span class="v-stat-val"><?php echo $visiteencour["Client"]["potentialite"]; ?></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php else: ?>
    <div class="visit-card-wrapper">
        <a href="<?php echo $this->Html->url(array("action" => "clients", $code)); ?>"
            style="text-decoration: none;">
            <div class="visit-card" style="display: flex; align-items: center; gap: 16px; padding: 20px;">
                <div style="background: #e6f5ee; color: #006241; width: 52px; height: 52px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="coffee" style="width: 24px; height: 24px;"></i>
                </div>
                <div style="text-align: left; flex: 1;">
                    <div style="font-size: 16px; font-weight: 700; color: #1a2e24; margin-bottom: 2px;">Prêt pour la journée ?</div>
                    <div style="font-size: 13px; color: #5a6b63; font-weight: 500;">Sélectionnez un client pour démarrer.</div>
                </div>
                <div style="color: #006241; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="arrow-right" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>

<!-- Dashboard Grid -->
<div class="dashboard-grid">

    <a href="<?php echo $this->Html->url(array("action" => "clients", $code)); ?>" class="dash-item primary btn_spiner">
        <div class="dash-icon-wrapper"><i data-lucide="users"></i></div>
        <h3 class="dash-title">Clients</h3>
    </a>

    <?php if ($user_role == "Super viseur"): ?>
        <a href="<?php echo $this->Html->url(array("action" => "valider_visite_double", $code)); ?>"
            class="dash-item accent btn_spiner">
            <div class="dash-icon-wrapper"><i data-lucide="clipboard-check"></i></div>
            <h3 class="dash-title">Visites à valider</h3>
        </a>
    <?php endif; ?>

    <a href="<?php echo $this->Html->url(array("action" => "boite", $code)); ?>" class="dash-item secondary btn_spiner">
        <div class="dash-icon-wrapper"><i data-lucide="lightbulb"></i></div>
        <h3 class="dash-title">Boîte à idées</h3>
    </a>

    <a onclick="obtenirLocalisationDirectementDuWeb(this)" data-url="maps" class="dash-item primary"
        style="cursor:pointer;">
        <div class="dash-icon-wrapper"><i data-lucide="map"></i></div>
        <h3 class="dash-title">Localisation clients</h3>
    </a>

    <a href="<?php echo $this->Html->url(array("action" => "brochure", $code)); ?>"
        class="dash-item secondary btn_spiner">
        <div class="dash-icon-wrapper"><i data-lucide="book-open"></i></div>
        <h3 class="dash-title">Brochures</h3>
    </a>

    <?php if ($user_role != "Super viseur"): ?>
        <a href="<?php echo $this->Html->url(array("action" => "formations", $code)); ?>"
            class="dash-item secondary btn_spiner">
            <div class="dash-icon-wrapper"><i data-lucide="graduation-cap"></i></div>
            <h3 class="dash-title">Formations</h3>
        </a>
    <?php endif; ?>

    <a href="<?php echo $this->Html->url(array("action" => "statistique", $code)); ?>"
        class="dash-item accent btn_spiner"
        style="<?php echo ($user_role == 'Super viseur') ? 'grid-column: 1 / -1;' : ''; ?>">
        <div class="dash-icon-wrapper"><i data-lucide="pie-chart"></i></div>
        <h3 class="dash-title">Statistiques</h3>
    </a>

</div>
<div class="appfooter">
    <p>
        Esnapharm laboratoire
    </p>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <div class="alert-icon-wrapper"
                    style="background: #fdf0ef; color: #d9534f; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="alert-triangle"></i>
                </div>
            </div>
            <div class="modal-body">
                <h5 style="color: #1a2e24; font-weight: 700; margin-bottom: 12px; font-size: 20px;">Supprimer la visite
                    ?</h5>
                Êtes-vous sûr(e) de vouloir supprimer cette visite en cours ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <?php if (isset($visiteencour["Visite"]["id"])): ?>
                    <?php echo $this->Form->postLink(
                        'Supprimer',
                        array("action" => "delete_visite", $visiteencour["Visite"]["id"], $user_id),
                        array("class" => "btn_spiner btn btn-danger")
                    ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Flash Message Modal -->
<div class="modal fade" id="demarrerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <div class="alert-icon-wrapper"
                    style="background: #e6f5ee; color: #00875A; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check"></i>
                </div>
            </div>
            <div class="modal-body">
                <h5 style="color: #1a2e24; font-weight: 700; margin-bottom: 0; font-size: 20px;">
                    Action réussie !
                </h5>
            </div>
            <div class="modal-footer pb-4 pt-0">
                <button type="button" class="btn btn-primary w-100" data-dismiss="modal"
                    style="background: var(--primary); color: white; border: none; padding: 12px; border-radius: 12px;">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Location Loading Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; background: #e6f5ee; color: #006241; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulse 1.5s infinite;">
                    <i data-lucide="compass" style="width: 32px; height: 32px;"></i>
                </div>
                <h5 style="color: #1a2e24; font-weight: 700; margin-bottom: 12px;">Localisation en cours...</h5>
                <p style="color: #5a6b63; margin: 0; font-size: 14px;">Merci de patienter, nous récupérons votre
                    position GPS.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".card-alert").on("click", function(event) {
            $("#loading-overlay").css('display', 'flex');
        });

        const flash = sessionStorage.getItem('flashMessage');
        if (flash) {
            $("#demarrerModal").modal('show');
            setTimeout(() => {
                $("#demarrerModal").modal('hide');
            }, 3000);
            sessionStorage.removeItem('flashMessage');
        }
    });

    function logout() {
        if (window.ReactNativeWebView) {
            window.ReactNativeWebView.postMessage(JSON.stringify({
                action: 'logout'
            }));
        } else {
            window.location.href = '/appwebfinal/users/logout';
        }
    }

    function obtenirLocalisationDirectementDuWeb(triggerElement) {
        const data_url = triggerElement.getAttribute('data-url');
        const isMaps = data_url && data_url.includes('maps');

        $("#locationModal").modal('show');

        window.addEventListener('locationPermissionResult', function(event) {
            if (event.detail.granted) {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            const code = <?= json_encode($code) ?>;

                            if (isMaps) {
                                const url_map = `/appwebfinalv2/${data_url}/${code}/${latitude}/${longitude}`;
                                window.location.href = url_map;
                            }
                        },
                        function(error) {
                            $("#locationModal").modal('hide');
                            if (window.ReactNativeWebView) {
                                window.ReactNativeWebView.postMessage(JSON.stringify({
                                    action: 'handleLocationError'
                                }));
                            } else {
                                alert("Veuillez activer votre GPS.");
                            }
                        }, {
                            enableHighAccuracy: true,
                            timeout: 8000,
                            maximumAge: 10000
                        }
                    );
                } else {
                    $("#locationModal").modal('hide');
                    alert("La géolocalisation n'est pas supportée.");
                }
            } else {
                $("#locationModal").modal('hide');
                alert("L'utilisateur a refusé la permission.");
            }
        }, {
            once: true
        });

        if (window.ReactNativeWebView) {
            window.ReactNativeWebView.postMessage(JSON.stringify({
                action: 'requestLocationPermission'
            }));
        } else {
            window.dispatchEvent(new CustomEvent('locationPermissionResult', {
                detail: {
                    granted: true
                }
            }));
        }
    }
</script>