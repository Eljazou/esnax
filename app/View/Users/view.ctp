<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
echo $this->Html->css('daterangepicker');
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    .metronic-page-shell {
        background: #f8fafc;
        padding: 30px 0;
        font-family: 'Poppins', sans-serif;
    }

    .metronic-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(22, 32, 77, 0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .metronic-card .card-header {
        padding: 20px 24px;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: transparent;
    }

    .card-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f2efff;
        color: #7c6ff0;
        font-size: 16px;
    }

    .title-text h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2940;
    }

    .metronic-card .card-body {
        padding: 0 24px 24px;
    }

    /* SIDEBAR STYLES */
    .side-card { border-radius: 16px; }
    .side-avatar-ring {
        width: 92px; height: 92px; border-radius: 50%;
        margin: 0 auto 12px;
        background: linear-gradient(135deg, #EDEAFF 0%, #E3DEFF 100%);
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    .side-avatar-ring img { width: 78px; height: 78px; border-radius: 50%; object-fit: cover; }
    .side-online-dot {
        position: absolute; bottom: 3px; right: 3px;
        width: 14px; height: 14px; border-radius: 50%;
        background: #34D399; border: 3px solid #fff;
    }
    .info-item-icon {
        width: 34px; height: 34px; border-radius: 10px;
        background: #F3F1FF; color: #6c5ce7;
        display: flex; align-items: center; justify-content: center;
    }
    .info-item-icon svg { width: 16px; height: 16px; }

    /* DATE PICKER ALIGNMENT */
    .filter-card-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px !important;
        flex-wrap: wrap;
        gap: 15px;
    }
    .filter-title-inline {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        color: #1f2940;
        font-size: 15px;
    }
    #dateform .input-group {
        background: #fff; 
        border: 1px solid #E2E8F0; 
        border-radius: 10px;
        width: 320px;
        max-width: 100%;
    }
    #dateform .input-group-text { background: transparent; border: none; color: #94A3B8; }
    #dateform .form-control { border: none; background: transparent; box-shadow: none; font-size: 13.5px; text-align: center; color: #475569; font-weight: 500; }

    /* VISITS COMPONENT */
    .visit-counter {
        border-radius: 16px; 
        padding: 30px;
        background: linear-gradient(90deg, #7c6ff0 0%, #6355e6 100%);
        display: flex; 
        align-items: center; 
        gap: 24px; 
        color: #fff;
        position: relative;
    }
    /* Simple stylized background wave matching the photo */
    .visit-counter::after {
        content: "";
        position: absolute;
        right: 0; top: 0; bottom: 0; width: 40%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3%3Cpath fill='rgba(255,255,255,0.06)' fill-opacity='1' d='M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat center right;
        background-size: cover;
        pointer-events: none;
    }
    .visit-counter-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .visit-counter-icon svg { width: 28px; height: 28px; }
    .visit-counter-text h2 { margin: 0; font-size: 36px; font-weight: 700; line-height: 1; }
    .visit-counter-text p { margin: 4px 0 0; font-size: 13px; opacity: .85; }

    /* LISTS ELEMENTS */
    .liste-row {
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
        background: #F8FAFC; border-left: 4px solid #10B981; border-radius: 12px;
        padding: 16px 20px; margin-bottom: 12px;
    }
    .liste-icon {
        width: 44px; height: 44px; border-radius: 50%;
        background: #E6F7EE; color: #10B981;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .liste-icon svg { width: 18px; height: 18px; }
    .liste-name { font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 4px; }
    .liste-count-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: #E6F7EE; color: #10B981; font-size: 11px; font-weight: 600;
        padding: 4px 12px; border-radius: 20px;
    }
    .liste-count-pill svg { width: 12px; height: 12px; fill: #10B981; }
    .btn-icon-round {
        width: 36px; height: 36px; border-radius: 8px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid #F1F5F9; background: #fff; color: #EF4444;
    }
    .btn-icon-round svg { width: 14px; height: 14px; }
    .btn-icon-round.arrow { border-color: #F1F5F9; color: #6355e6; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
</style>

<div class="metronic-page-shell">
    <div class="container-fluid px-5">
        <div class="row g-5">

            <!-- ================= SIDEBAR ================= -->
            <div class="col-xl-3">
                <div class="card metronic-card side-card h-100">
                    <div class="card-body text-center pt-5">
                        <div class="side-avatar-ring">
                            <?php echo $this->Html->image('users/' . $user['User']['image']); ?>
                            <span class="side-online-dot"></span>
                        </div>
                        <div class="fs-5 fw-bold text-gray-900"><?php echo $user['User']['name']; ?></div>
                        <div class="fs-7 text-muted mb-6"><?php echo $user['User']['role']; ?></div>

                        <div class="d-flex align-items-center text-uppercase fw-bold fs-8 text-primary mb-4">
                            <i class="ki-duotone ki-abstract-26 fs-4 me-2 text-primary"></i>
                            Informations
                        </div>

                        <div class="d-flex flex-column gap-2 text-start">
                            <div class="d-flex align-items-center bg-light rounded p-3">
                                <span class="info-item-icon me-3">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2z"/><path d="m2 7 10 6 10-6"/></svg>
                                </span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fs-9 fw-bold text-muted text-uppercase">Email</div>
                                    <div class="fs-7 fw-bold text-gray-900 text-truncate" title="<?php echo h($user['User']['username']); ?>"><?php echo h($user['User']['username']); ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center bg-light rounded p-3">
                                <span class="info-item-icon me-3">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fs-9 fw-bold text-muted text-uppercase">Téléphone</div>
                                    <div class="fs-7 fw-bold text-gray-900"><?php echo !empty($user['User']['tel']) ? h($user['User']['tel']) : 'Non renseigné'; ?></div>
                                </div>
                            </div>

							<div class="d-flex align-items-center bg-light rounded p-3">
							    <span class="info-item-icon me-3">
							    	<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
							    </span>
							    <div class="flex-grow-1 min-w-0">
							    	<div class="fs-9 fw-bold text-muted text-uppercase">Ligne</div>
							    	<?php if (!empty($user['Ligne']['name'])): ?>
							    		<div class="fs-7 fw-bold text-gray-900 text-truncate" title="<?php echo h($user['Ligne']['name']); ?>"><?php echo h($user['Ligne']['name']); ?></div>
							    	<?php else: ?>
							    		<div class="fs-7 fst-italic text-muted">Pas de ligne</div>
							    	<?php endif; ?>
							    </div>
						    </div>

						    <div class="d-flex align-items-center bg-light rounded p-3">
						    	<span class="info-item-icon me-3">
						    		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
						    	</span>
						    	<div class="flex-grow-1 min-w-0">
						    		<div class="fs-9 fw-bold text-muted text-uppercase">Recrutement</div>
						    		<?php if (!empty($user['User']['date_de_recrutement'])): ?>
						    			<div class="fs-7 fw-bold text-gray-900"><?php echo h($user['User']['date_de_recrutement']); ?></div>
						    		<?php else: ?>
						    			<div class="fs-7 fst-italic text-muted">Non renseigné</div>
						    		<?php endif; ?>
						    	</div>
						    </div>

							<div class="d-flex align-items-center bg-light rounded p-3">
							    <span class="info-item-icon me-3">
							    	<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							    </span>
							    <div class="flex-grow-1 min-w-0">
							    	<div class="fs-9 fw-bold text-muted text-uppercase">Région</div>
							    	<?php if (!empty($user['User']['region_odp'])): ?>
							    		<div class="fs-7 fw-bold text-gray-900 text-truncate" title="<?php echo h($user['User']['region_odp']); ?>"><?php echo h($user['User']['region_odp']); ?></div>
							    	<?php else: ?>
							    		<div class="fs-7 fst-italic text-muted">Non renseignée</div>
							    	<?php endif; ?>
							    </div>
						    </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= MAIN CONTENT ================= -->
            <div class="col-xl-9">
                
                <!-- WELCOME SECTION (Clean inline layout) -->
                <div class="mb-5">
                    <h2 class="fw-bolder text-gray-900 mb-1">Bonjour, <?php echo $user['User']['name']; ?> 👋</h2>
                    <div class="fs-7 text-muted">Gérez vos listes et vos clients facilement</div>
                </div>

                <!-- FILTRER PAR PERIODE CARD -->
                <div class="card metronic-card">
                    <div class="filter-card-body">
                        <div class="filter-title-inline">
                            <span class="card-icon"><i class="ki-duotone ki-calendar fs-5"></i></span>
                            <span>Filtrer par période</span>
                        </div>
                        <form action="<?php echo $this->Html->url(array("action" => "view", $id)); ?>" method="get" id="dateform" class="m-0">
                            <div class="input-group">
                                <span class="input-group-text pe-0">
                                    <i class="ki-duotone ki-calendar fs-4 text-primary"></i>
                                </span>
                                <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' → ' . $date_fin . '"'; ?> class="form-control" name="date" id="reservationtime" placeholder="Rechercher">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- VISITES CARD -->
                <div class="card metronic-card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <span class="card-icon"><i class="ki-duotone ki-check-circle fs-5"></i></span>
                            <div class="title-text"><h3>Visites</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="visit-counter mb-4">
                            <div class="visit-counter-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <div class="visit-counter-text">
                                <h2><?php echo count($user['Visite']); ?></h2>
                                <p>Visites enregistrées</p>
                            </div>
                        </div>
                        <?php if (empty($user['Visite'])): ?>
                            <div class="alert alert-info d-flex align-items-center justify-content-center gap-2 py-3 fs-7 mb-0" style="background-color: #f0f7ff; color: #0070f3; border: none; border-radius: 12px;">
                                <i class="ki-duotone ki-information-5 fs-4"></i>
                                Aucune visite pour cette période
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- LES LISTES CARD -->
                <div class="card metronic-card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <span class="card-icon"><i class="ki-duotone ki-list fs-5"></i></span>
                            <div class="title-text"><h3>Les listes</h3></div>
                        </div>
                        <?php if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'listes', 'add')) == 1): ?>
                            <?php echo $this->Html->link(
                                '<i class="ki-duotone ki-plus fs-6"></i> Ajouter une liste',
                                array('controller' => 'listes', 'action' => 'add', $user['User']['id']),
                                array('class' => 'btn btn-sm btn-primary px-4 py-2 fw-bold', 'style' => 'background: #6355e6; border: none; border-radius: 10px;', 'escape' => false)
                            ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($listes)): ?>
                            <div class="liste-scroll">
                                <?php foreach ($listes as $liste): ?>
                                    <div class="liste-row">
                                        <div class="d-flex align-items-center gap-3 min-w-0">
                                            <span class="liste-icon">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><circle cx="3" cy="6" r="1"/><circle cx="3" cy="12" r="1"/><circle cx="3" cy="18" r="1"/></svg>
                                            </span>
                                            <div class="min-w-0">
                                                <div class="liste-name text-truncate"><?php echo h($liste['name']); ?></div>
                                                <span class="liste-count-pill">
                                                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                                    <?php echo $liste['count']; ?> clients
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                            <?php if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'listes', 'archive')) == 1): ?>
                                                <?php echo $this->Form->postLink(
                                                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>',
                                                    array('controller' => 'listes', 'action' => 'archive', $liste['id'], 0, $user['User']['id']),
                                                    array('class' => 'btn-icon-round', 'escape' => false, 'confirm' => 'Êtes-vous sûr de vouloir archiver cette liste ?')
                                                ); ?>
                                            <?php endif; ?>
                                            <?php echo $this->Html->link(
                                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
                                                array('controller' => 'listes', 'action' => 'view', $liste['id'], '?' => array('date' => $date_debut . '--' . $date_fin)),
                                                array('class' => 'btn-icon-round arrow', 'escape' => false)
                                            ); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning d-flex align-items-center gap-2 py-3 fs-8 mb-0">
                                <i class="ki-duotone ki-shield-tick fs-4"></i>
                                Aucune liste
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('daterangepicker'); ?>
<script>
    $(function() {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " → ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                "monthNames": ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                "firstDay": 1
            },
            clickApply: function(e) {
                this.updateInputText();
            }
        });
        $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            var action = $('#dateform').attr('action');
            var date = action + "?date=" + startDate + "--" + endDate;
            $('#dateform').attr('action', date);
            $('#dateform').submit();
        });
    });
</script>