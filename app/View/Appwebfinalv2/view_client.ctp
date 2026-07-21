<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
/* Premium Client Details Design */
body {
    background-color: var(--bg, #f7faf8);
    margin: 0;
    padding: 0;
    font-family: var(--font-family, 'Inter', sans-serif);
    padding-bottom: 180px; /* space for footer */
}

/* Premium Profile Header */
.client-hero {
    background: linear-gradient(135deg, #006241 0%, #00875A 100%);
    padding: 24px 20px 56px 20px;
    border-radius: 0 0 32px 32px;
    color: white;
    position: relative;
    box-shadow: 0 12px 32px rgba(0, 98, 65, 0.2);
}

.hero-top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.btn-back-hero {
    width: 44px; height: 44px;
    border-radius: 14px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    display: flex; align-items: center; justify-content: center;
    color: white; text-decoration: none;
    transition: all 0.2s;
}

.btn-back-hero:hover { background: rgba(255,255,255,0.3); color: white; transform: scale(0.95); }

.profile-avatar-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.avatar-circle {
    width: 60px; height: 60px;
    border-radius: 18px;
    background: white;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    margin-bottom: 8px;
    position: relative;
    padding: 8px;
}

.avatar-circle img {
    width: 100%; height: 100%;
    object-fit: contain;
}

.hero-client-name {
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 4px 0;
    letter-spacing: -0.5px;
}

.hero-client-cat {
    background: rgba(255,255,255,0.2);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    backdrop-filter: blur(4px);
}

/* Glassmorphic Stats Row */
.stats-row {
    display: flex;
    gap: 12px;
    padding: 0 20px;
    margin-top: -30px;
    position: relative;
    z-index: 10;
}

.stat-item {
    flex: 1;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 16px 12px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(0, 50, 30, 0.08);
    border: 1px solid rgba(255,255,255,0.5);
    text-decoration: none;
    color: #1a2e24;
}

.stat-icon {
    width: 40px; height: 40px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 8px;
    font-size: 18px;
}

.stat-phone { background: #eaf2fd; color: #2b7de9; }
.stat-pot { background: #fef9e7; color: #e6a817; }
.stat-note { background: #e6f5ee; color: #006241; }

.stat-val { font-size: 14px; font-weight: 700; }

/* Details Section */
.content-section {
    padding: 24px 20px;
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #1a2e24;
    margin: 0 0 16px 0;
}

.details-card {
    background: white;
    border-radius: 20px;
    padding: 20px;
    border: 1px solid #d4e0d9;
    box-shadow: 0 2px 8px rgba(0, 50, 30, 0.03);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f4f8f6;
}

.detail-row:last-child { border-bottom: none; padding-bottom: 0; }
.detail-row:first-child { padding-top: 0; }

.detail-label { color: #8a9b93; font-size: 14px; font-weight: 500; width: 35%; }
.detail-val { color: #1a2e24; font-size: 14px; font-weight: 600; width: 65%; text-align: right; word-break: break-word; }

/* Visits Scroll */
.visits-scroll {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    padding-bottom: 20px;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
}
.visits-scroll::-webkit-scrollbar { display: none; }

.visit-card {
    min-width: 260px;
    background: white;
    border-radius: 20px;
    padding: 20px;
    border: 1px solid #d4e0d9;
    box-shadow: 0 4px 16px rgba(0, 50, 30, 0.04);
    scroll-snap-align: start;
}

.visit-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.visit-avatar {
    width: 36px; height: 36px;
    border-radius: 12px;
    background: #e6f5ee;
    color: #006241;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 16px;
}

.visit-time {
    background: #f4f8f6;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    color: #5a6b63;
    font-weight: 600;
}

.visit-rep { font-size: 14px; font-weight: 700; color: #1a2e24; margin: 0 0 2px 0; }
.visit-date { font-size: 12px; color: #8a9b93; margin: 0; }
.visit-comment { font-size: 14px; color: #5a6b63; line-height: 1.5; margin-top: 12px; }

/* Fixed Footer */
.fixed-footer {
    position: fixed;
    bottom: 0; left: 0; width: 100%;
    background: white;
    padding: 16px 20px 24px;
    border-top: 1px solid #d4e0d9;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
    z-index: 99;
}

.btn-main-action {
    background: linear-gradient(135deg, #006241, #00875A);
    color: white;
    width: 100%;
    border: none;
    border-radius: 16px;
    padding: 16px;
    font-size: 16px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0, 98, 65, 0.25);
    transition: all 0.2s;
    text-align: center;
    text-decoration: none;
    display: block;
}

.btn-main-action:hover {
    background: linear-gradient(135deg, #004d33, #006241);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

/* Modals */
.modal-content { border-radius: 24px; border: none; box-shadow: 0 12px 40px rgba(0,30,20,0.15); }
.modal-header { border: none; padding: 24px 24px 0; }
.modal-body { padding: 20px 24px; color: #5a6b63; font-size: 15px; }
.modal-footer { border: none; padding: 0 24px 24px; display: flex; gap: 12px; }
.modal-footer .btn { border-radius: 12px; padding: 12px; font-weight: 600; flex: 1; }
.btn-secondary { background: #f4f8f6; color: #5a6b63; border: none; }
.btn-danger { background: #d9534f; color: white; border: none; }
.btn-danger:hover { background: #c9302c; color: white; }
.btn-outline-success { border: 2px solid #00875A; color: #00875A; background: transparent; }
.btn-outline-success:hover { background: #e6f5ee; color: #006241; }
.btn-outline-danger { border: 2px solid #d9534f; color: #d9534f; background: transparent; }
.btn-outline-danger:hover { background: #fdf0ef; color: #c9302c; }

.quiz-progress { display: flex; align-items: center; justify-content: center; padding: 6px 0 2px; }
.quiz-dot { width: 10px; height: 10px; border-radius: 50%; background-color: #e0e0e0; flex-shrink: 0; }
.quiz-dot.active { background-color: #006241; }
.quiz-line { width: 36px; height: 2px; background-color: #e0e0e0; }
.quiz-line.active { background-color: #006241; }
.quiz-step-panel { display: none; }
.quiz-step-panel.active { display: block; }

.form-control { border-radius: 12px; border: 1.5px solid #d4e0d9; padding: 12px 16px; height: auto; }
.form-control:focus { border-color: #006241; box-shadow: 0 0 0 3px rgba(0, 98, 65, 0.1); }
</style>

<!-- Hero Profile -->
<div class="client-hero">
    <div class="hero-top-bar">
        <a href="<?php echo $this->Html->url(array("action" => "clients", $code)); ?>" class="btn-back-hero btn_spiner">
            <i data-lucide="chevron-left"></i>
        </a>
        <div style="width: 44px;"></div> <!-- spacer -->
    </div>
    
    <div class="profile-avatar-container">
        <div class="avatar-circle">
            <?php if ($client['Client']['type_id'] == 1 || $client['Client']['type_id'] == 5) { ?>
                <?php echo $this->Html->image('docteur.png'); ?>
            <?php } else if ($client['Client']['type_id'] == 3) { ?>
                <?php echo $this->Html->image('paragrossiste.png'); ?>
            <?php } else { ?>
                <?php echo $this->Html->image('pharma.png'); ?>
            <?php } ?>
        </div>
        <h1 class="hero-client-name">
            <?php echo 'Dr. ' . ucfirst(strtolower($client['Client']['nom'])) . ' ' . ucfirst(strtolower($client['Client']['prenom'])); ?>
        </h1>
        <div class="hero-client-cat"><?php echo ucfirst(strtolower($client['Client']['category'])); ?></div>
    </div>
</div>

<!-- Stats Row -->
<div class="stats-row">
    <a href="tel:+212<?php echo h($client['Client']['tel']); ?>" class="stat-item">
        <div class="stat-icon stat-phone"><i data-lucide="phone"></i></div>
        <div class="stat-val">Appeler</div>
    </a>
    <div class="stat-item">
        <div class="stat-icon stat-pot"><i data-lucide="zap"></i></div>
        <div class="stat-val"><?php echo $client['Client']['potentialite']; ?></div>
    </div>
    <div class="stat-item" data-toggle="modal" data-target="#checkeditorModalLong" style="cursor:pointer;">
        <div class="stat-icon stat-note"><i data-lucide="sticky-note"></i></div>
        <div class="stat-val">Notes</div>
    </div>
</div>

<!-- Details Section -->
<div class="content-section">
    <h2 class="section-title">Détails</h2>
    <div class="details-card">
        <div class="detail-row">
            <div class="detail-label">Activité</div>
            <div class="detail-val"><?php echo h($client['Client']['activite']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Exercice</div>
            <div class="detail-val"><?php echo h($client['Client']['exercice']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Mail</div>
            <div class="detail-val"><?php echo h($client['Client']['mail']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Fixe</div>
            <div class="detail-val"><?php echo h($client['Client']['fixe']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Secteur</div>
            <div class="detail-val"><?php echo $client["Client"]["secteur"]; ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Adresse</div>
            <div class="detail-val"><?php echo h($client['Client']['adress']); ?></div>
        </div>
    </div>
</div>

<!-- Visits Section -->
<?php if (!empty($client['Client']['Visite'])) { ?>
<div class="content-section" style="padding-top: 0;">
    <h2 class="section-title">Historique des visites</h2>
    <div class="visits-scroll">
        <?php foreach ($client['Client']['Visite'] as $c): ?>
        <div class="visit-card">
            <div class="visit-card-head">
                <div style="display:flex; gap:12px; align-items:center;">
                    <div class="visit-avatar"><?php echo substr($c['responsable'], 0, 1); ?></div>
                    <div>
                        <h4 class="visit-rep"><?php echo $c['responsable']; ?></h4>
                        <p class="visit-date">
                            <?php 
                            $date = new DateTime($c['date']);
                            echo $date->format('d/m/Y');
                            ?>
                        </p>
                    </div>
                </div>
                <div class="visit-time"><?php echo date('H:i', strtotime($c['date'])); ?></div>
            </div>
            <div class="visit-comment"><?php echo $c['commentaire']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php } ?>

<!-- Spacer for fixed footer -->
<div style="height: 140px; width: 100%;"></div>

<!-- Fixed Footer -->
<div class="fixed-footer">
    <?php if (count($visiteencour) == 0) { ?>
        <button type="button" class="btn-main-action" data-toggle="modal" data-target="#ConfirmationModal">
            <i data-lucide="play" style="margin-right:8px;"></i> Démarrer la Visite
        </button>
    <?php } else { 
        if ($client["Client"]["id"] == $visiteencour["Visite"]["client_id"]) {
            $action = ($client["Client"]["type_id"] == 1 || $client["Client"]["type_id"] == 5) ? "add_rapport_v2" : "add_rapport_pharmacie_v2";
    ?>
            <a href="<?php echo $this->Html->url(array("action" => $action, $code, $client["Client"]["id"], $visiteencour["Visite"]["id"])); ?>" class="btn-main-action btn_spiner">
                <i data-lucide="send" style="margin-right:8px;"></i> Envoyer le Rapport
            </a>
        <?php } else { ?>
            <a href="<?php echo $this->Html->url(array("action" => "view_client", $code, $visiteencour["Client"]["id"])); ?>" class="btn-main-action btn_spiner">
                Remplir rapport : <?php echo $visiteencour["Client"]["nom"]; ?>
            </a>
    <?php } } ?>
</div>


<!-- MODALS -->

<!-- Note Modal -->
<div class="modal fade" id="checkeditorModalLong" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:#1a2e24;font-weight:700;">Note Spécialité</h5>
                <button type="button" class="close" data-dismiss="modal" style="background:none;border:none;font-size:24px;color:#8a9b93;">&times;</button>
            </div>
            <div class="modal-body checkeditor_body"></div>
            <div class="modal-footer pb-4">
                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Multi-step visite modal -->
<?php
$isPublique = strtolower($client['Client']['activite']) === 'publique';
$isPubliqueWithHopital = $isPublique && !empty($hopital_id);
?>
<div class="modal fade" id="ConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-header d-flex justify-content-center pt-4 pb-2" style="position:relative;">
                <div class="modal-icon" style="background: #e6f5ee; color: #006241; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="flag"></i>
                </div>
                <button type="button" class="close" data-dismiss="modal" style="position:absolute; right:20px; top:20px; background:none; border:none; font-size:24px; color:#8a9b93;">&times;</button>
            </div>

            <?php if ($isPubliqueWithHopital): ?>
            <div class="quiz-progress" id="quiz-progress">
                <div class="quiz-dot active" id="qdot-1"></div>
                <div class="quiz-line" id="qline-1"></div>
                <div class="quiz-dot" id="qdot-2"></div>
            </div>
            <?php endif; ?>

            <!-- STEP 1 -->
            <div class="quiz-step-panel active" id="quiz-panel-1">
                <div class="modal-body text-center">
                    <h5 style="color:#1a2e24;font-weight:700;margin-bottom:16px;">Type de visite</h5>
                    <p style="margin-bottom:20px;">Est-ce que cette visite est une visite double ?</p>
                    
                    <select class="form-control mb-3" id="select_type_visite">
                        <option value="">-- Sélectionnez --</option>
                        <option value="solo">Visite solo</option>
                        <option value="double">Visite double</option>
                    </select>
                    
                    <select class="form-control" id="select_sup" style="display:none;">
                        <option value="">-- Sélectionnez le superviseur --</option>
                        <?php foreach ($doubles as $key => $value): ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <?php if ($isPubliqueWithHopital): ?>
                        <button type="button" class="btn btn-main-action" style="padding:12px;" id="btn-step1-next">Suivant</button>
                    <?php else: ?>
                        <button id="<?php echo $client['Client']['id']; ?>" class="btn btn-main-action set_chez_client" style="padding:12px;">Démarrer</button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($isPubliqueWithHopital): ?>
            <!-- STEP 2 -->
            <div class="quiz-step-panel" id="quiz-panel-2">
                <div class="modal-body text-center">
                    <h5 style="color:#1a2e24;font-weight:700;margin-bottom:16px;">Présence du client</h5>
                    <p>Est-ce que ce client est absent ?</p>
                    <div style="display:flex; gap:12px; margin-top:20px;">
                        <button type="button" class="btn btn-outline-success w-50" id="btn-client-present">Non, présent</button>
                        <button type="button" class="btn btn-outline-danger w-50" id="btn-client-absent">Oui, absent</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100" id="btn-step2-back">Retour</button>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="quiz-step-panel" id="quiz-panel-3">
                <div class="modal-body">
                    <h5 class="text-center" style="color:#1a2e24;font-weight:700;margin-bottom:16px;">Remplaçant</h5>
                    
                    <?php if (!empty($hopital_clients)): ?>
                        <label style="font-size:13px; font-weight:600; margin-bottom:8px; display:block;">Sélectionnez un remplaçant :</label>
                        <select class="form-control mb-3" id="select_remplacant">
                            <option value="">-- Choisir --</option>
                            <?php foreach ($hopital_clients as $hc): ?>
                                <option value="<?php echo $hc['id']; ?>"><?php echo h($hc['nom']) . ' ' . h($hc['prenom']); ?></option>
                            <?php endforeach; ?>
                            <option value="__new__">+ Ajouter un nouveau client</option>
                        </select>
                    <?php else: ?>
                        <p style="font-size:14px;color:#666;margin-bottom:10px;text-align:center;">Aucun autre client. Ajoutez-en un :</p>
                        <input type="hidden" id="existing_hopital_id" value="<?php echo h($hopital_id); ?>">
                    <?php endif; ?>

                    <div id="new-client-form" style="display:<?php echo ($hopital_id && !empty($hopital_clients)) ? 'none' : 'block'; ?>">
                        <input type="text" class="form-control mb-3" id="new_client_nom" placeholder="Nom">
                        <input type="text" class="form-control mb-3" id="new_client_prenom" placeholder="Prénom">
                        <select class="form-control" id="new_client_category">
                            <option value="">-- Spécialité --</option>
                            <?php foreach ($categories as $cat_id => $cat_name): ?>
                                <option value="<?php echo $cat_id; ?>" <?php echo ($cat_id == $client['Client']['category_id']) ? 'selected' : ''; ?>><?php echo h($cat_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-step3-back">Retour</button>
                    <button type="button" class="btn btn-main-action" style="padding:12px;" id="btn-confirm-remplacant">Confirmer</button>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Location Loading Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: #e6f5ee; color: #006241; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulse 1.5s infinite;">
                    <i data-lucide="compass" style="width: 32px; height: 32px;"></i>
                </div>
                <h5 style="color: #1a2e24; font-weight: 700; margin-bottom: 12px;">Localisation en cours...</h5>
                <p style="color: #5a6b63; margin: 0; font-size: 14px;">Merci de patienter pendant que nous récupérons vos coordonnées.</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal for Client Creation -->
<div class="modal fade" id="clientCreatedSuccessModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center pt-4 pb-2" style="position:relative;">
                <div style="background: #e6f5ee; color: #00875A; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check" style="width: 32px; height: 32px;"></i>
                </div>
            </div>
            <div class="modal-body text-center">
                <h5 style="color: #1a2e24; font-weight: 700; margin-bottom: 12px; font-size: 20px;">Client créé avec succès !</h5>
                <p style="color: #5a6b63; margin: 0; font-size: 14px;">Le nouveau client remplaçant a été enregistré dans le système.</p>
            </div>
            <div class="modal-footer pb-4">
                <button type="button" class="btn btn-main-action w-100" id="btn-success-ok" style="padding:12px;">Continuer la visite</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var checkval = <?php echo json_encode($lignespecialiteinfo); ?>;
    if (!jQuery.isEmptyObject(checkval)) {
        $(".checkeditor_body").append(checkval[0].Lignespecialiteinfo.text);
        $('#checkeditorModalLong').modal('toggle');
    }
});

// ── Quiz state ──────────────────────────────────────────────────────────────
var quizIsPublique   = <?= json_encode($isPublique) ?>;
var quizCurrentId    = <?= json_encode((int)$client['Client']['id']) ?>;
var quizHopitalId    = <?= json_encode($hopital_id ? (int)$hopital_id : null) ?>;
var quizHasClients   = <?= json_encode(!empty($hopital_clients)) ?>;

function quizShowStep(step) {
    $('.quiz-step-panel').removeClass('active');
    $('#quiz-panel-' + step).addClass('active');
    if (quizIsPublique) {
        if (step === 1) {
            $('#qdot-1').addClass('active');
            $('#qdot-2, #qline-1').removeClass('active');
        } else {
            $('#qdot-1, #qdot-2, #qline-1').addClass('active');
        }
    }
}

$('#ConfirmationModal').on('hidden.bs.modal', function() {
    quizShowStep(1);
    $('#select_type_visite').val('');
    $('#select_sup').hide().val('');
    if ($('#select_remplacant').length) {
        $('#select_remplacant').val('');
        $('#new-client-form').hide();
    }
    $('#new_client_nom, #new_client_prenom').val('');
});

$('.set_chez_client').on('click', function() {
    var typeVisite = $('#select_type_visite').val();
    if (typeVisite === 'solo') {
        window._pendingVisite = { clientId: this.id, typeVisite: 'solo', supId: null };
        obtenirLocalisationDirectementDuWeb();
    } else if (typeVisite === 'double') {
        var supId = $('#select_sup').val();
        if (!supId) { alert('Veuillez sélectionner un superviseur.'); return; }
        window._pendingVisite = { clientId: this.id, typeVisite: 'double', supId: supId };
        obtenirLocalisationDirectementDuWeb();
    } else {
        alert('Veuillez sélectionner le type de visite.');
    }
});

$('#select_type_visite').on('change', function() {
    if (this.value === 'double') $('#select_sup').fadeIn(300);
    else $('#select_sup').fadeOut(300);
});

$('#btn-step1-next').on('click', function() {
    var typeVisite = $('#select_type_visite').val();
    if (!typeVisite) { alert('Veuillez sélectionner le type de visite.'); return; }
    if (typeVisite === 'double' && !$('#select_sup').val()) {
        alert('Veuillez sélectionner un superviseur.'); return;
    }
    window._pendingVisite = {
        clientId: quizCurrentId,
        typeVisite: typeVisite,
        supId: typeVisite === 'double' ? $('#select_sup').val() : null,
        createNewClient: false
    };
    quizShowStep(2);
});

$('#btn-step2-back').on('click', function() { quizShowStep(1); });
$('#btn-client-present').on('click', function() { obtenirLocalisationDirectementDuWeb(); });
$('#btn-client-absent').on('click', function() { quizShowStep(3); });
$('#btn-step3-back').on('click', function() { quizShowStep(2); });

$('#select_remplacant').on('change', function() {
    if ($(this).val() === '__new__') $('#new-client-form').slideDown();
    else $('#new-client-form').slideUp();
});

$('#btn-confirm-remplacant').on('click', function() {
    var $sel = $('#select_remplacant');
    if ($sel.length) {
        var val = $sel.val();
        if (!val) { alert('Veuillez sélectionner un remplaçant.'); return; }
        if (val !== '__new__') {
            window._pendingVisite.clientId        = val;
            window._pendingVisite.createNewClient = false;
            window._pendingVisite.replacedClientId = quizCurrentId;
            obtenirLocalisationDirectementDuWeb();
            return;
        }
    }

    var nom = $('#new_client_nom').val().trim();
    if (!nom) { alert('Veuillez saisir le nom du client.'); return; }

    var existingHopId = quizHopitalId;
    var $hiddenHop = $('#existing_hopital_id');
    if ($hiddenHop.length) existingHopId = $hiddenHop.val() || existingHopId;

    window._pendingVisite.createNewClient = true;
    window._pendingVisite.newClientData   = {
        nom:               nom,
        prenom:            $('#new_client_prenom').val().trim(),
        category_id:       $('#new_client_category').val(),
        hopital_id:        existingHopId,
        current_client_id: quizCurrentId
    };
    obtenirLocalisationDirectementDuWeb();
});

// ── Location + visit creation ────────────────────────────────────────────────
function obtenirLocalisationDirectementDuWeb() {
    $('#ConfirmationModal').modal('hide');
    $("#locationModal").modal('show');

    window.addEventListener('locationPermissionResult', function(event) {
        if (!event.detail.granted) {
            $("#locationModal").modal('hide');
            alert("L'utilisateur a refusé la permission.");
            return;
        }

        if (!("geolocation" in navigator)) {
            $("#locationModal").modal('hide');
            alert("La géolocalisation n'est pas supportée.");
            return;
        }

        function proceedWithLocation(lat, lon) {
            var code = <?= json_encode($code) ?>;
            var pending = window._pendingVisite || {};

            function startVisite(clientId) {
                return fetch('<?= $this->webroot ?>appwebfinalv2/set_chez_client', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        latitude:   lat,
                        longitude:  lon,
                        code:       code,
                        clientId:   clientId,
                        typeVisite: pending.typeVisite || 'solo',
                        supId:      pending.supId || null,
                        replacedClientId: pending.replacedClientId || null
                    })
                })
                .then(res => res.json())
                .then(data => {
                    $("#locationModal").modal('hide');
                    window._pendingVisite = null;
                    if (data.success) {
                        sessionStorage.setItem('flashMessage', data.message);
                        window.location.href = data.redirect;
                    } else {
                        alert("Erreur : " + data.message);
                    }
                });
            }

            if (pending.createNewClient && pending.newClientData) {
                var nd = pending.newClientData;
                nd.latitude  = lat;
                nd.longitude = lon;
                nd.code      = code;
                fetch('<?= $this->webroot ?>appwebfinalv2/create_replacement_client', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(nd)
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) throw new Error(data.message || 'Erreur création client');
                    $("#locationModal").modal('hide');
                    $("#clientCreatedSuccessModal").modal('show');
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    
                    return new Promise(function(resolve) {
                        $("#btn-success-ok").off('click').on('click', function() {
                            $("#clientCreatedSuccessModal").modal('hide');
                            $("#locationModal").modal('show');
                            resolve(startVisite(data.client_id));
                        });
                    });
                })
                .catch(err => {
                    $("#locationModal").modal('hide');
                    alert("Erreur : " + err.message);
                });
            } else {
                startVisite(pending.clientId).catch(err => {
                    $("#locationModal").modal('hide');
                    alert("Erreur lors de l'envoi des données.");
                });
            }
        }

        navigator.geolocation.getCurrentPosition(
            function(position) { proceedWithLocation(position.coords.latitude, position.coords.longitude); },
            function(error) {
                if (window.ReactNativeWebView) {
                    $("#locationModal").modal('hide');
                    window.ReactNativeWebView.postMessage(JSON.stringify({ action: 'handleLocationError' }));
                } else {
                    proceedWithLocation(null, null);
                }
            },
            { enableHighAccuracy: true, timeout: 8000, maximumAge: 10000 }
        );
    }, { once: true });

    if (window.ReactNativeWebView) {
        window.ReactNativeWebView.postMessage(JSON.stringify({ action: 'requestLocationPermission' }));
    } else {
        window.dispatchEvent(new CustomEvent('locationPermissionResult', { detail: { granted: true } }));
    }
}
</script>