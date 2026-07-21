<?php
echo $this->Html->css('select2.min');
echo $this->Html->css("style_rapport");
echo $this->Html->script('select2.full.min');
?>

<style>
    :root{
        --accent:#7C5CFA;
        --accent-grad-start:#9b82fb;
        --accent-soft:#F3EFFF;
        --accent-text:#7C5CFA;
        --text-dark:#1a1d36;
        --text-muted:#9a9aab;
        --border-soft:#F0EDFF;
        --red:#E0384D;
        --red-soft:#FDECEC;
        --green:#2FBE73;
        --green-soft:#E6F7EE;
    }

    td { text-align: left; }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:18px;
        display:flex;
        align-items:center;
        gap:16px;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:linear-gradient(135deg, var(--accent-grad-start) 0%, var(--accent) 100%);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; color:#fff; }
    .page-header-text h3{ margin:0; color:var(--text-dark); font-weight:700; font-size:22px; }
    .page-header-text p{ margin:2px 0 0; color:var(--text-muted); font-size:13px; }
    .page-header-text .underline{
        display:inline-block; width:34px; height:3px;
        background:var(--accent); border-radius:3px; margin-top:6px;
    }
    /* ===== Filter form card ===== */
    .filter-form-card{
        background:#fff;
        border-radius:18px;
        padding:24px 26px;
        margin-bottom:22px;
        box-shadow:0 10px 28px rgba(140,126,242,0.07);
    }
    .filter-form-row{
        display:flex;
        gap:24px;
        flex-wrap:wrap;
    }
    .filter-form-col{
        flex:1;
        min-width:260px;
    }
    .filter-form-card label{
        display:block;
        font-size:11.5px;
        text-transform:uppercase;
        letter-spacing:.03em;
        color:var(--text-muted);
        font-weight:700;
        margin-bottom:8px;
    }
    .filter-form-card select.form-control,
    .filter-form-card select.choix_multi,
    .filter-form-card .select2-container .select2-selection{
        border:1px solid var(--border-soft) !important;
        border-radius:10px !important;
        color:var(--text-dark);
        font-size:13.5px;
        box-shadow:none !important;
        width:100% !important;
        min-height:42px;
    }
    .filter-form-card .select2-selection__rendered{ line-height:40px !important; padding-left:12px !important; }
    .filter-form-card .select2-selection__arrow{ height:40px !important; }
    .filter-form-card select.form-control:focus{
        outline:none; border-color:var(--accent); box-shadow:0 0 0 3px var(--accent-soft) !important;
    }
    .filter-form-card select[multiple] option:checked{
        background:linear-gradient(0deg, var(--accent-soft) 0%, var(--accent-soft) 100%);
        color:var(--accent-text);
        font-weight:600;
    }
    .filter-form-card .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background:var(--accent) !important;
    }
    .filter-form-card .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background:var(--accent-soft) !important;
        color:var(--accent-text) !important;
        border:1px solid var(--border-soft) !important;
        border-radius:6px !important;
    }
    .filter-footer{
        background:transparent;
        text-align:center;
        padding-top:18px;
        margin-top:18px;
        border-top:1px solid var(--border-soft);
        clear:both;
    }
    .filter-footer .btn-envoyer{
        background:linear-gradient(135deg, var(--accent-grad-start), var(--accent));
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:600;
        font-size:13.5px;
        padding:11px 30px;
        box-shadow:0 4px 14px rgba(140,126,242,0.3);
    }
    .filter-footer .btn-envoyer:hover{ color:#fff; filter:brightness(1.03); }

    /* ===== Doublons list ===== */
    .doublons-header{
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:14px;
    }
    .doublons-header h4{
        margin:0;
        font-size:15px;
        font-weight:700;
        color:var(--text-dark);
    }
    .doublons-header .icon-badge{
        width:32px;height:32px;
        border-radius:9px;
        background:var(--accent-soft);
        color:var(--accent-text);
        display:flex;align-items:center;justify-content:center;
    }
    .doublons-header .icon-badge svg{ width:16px;height:16px; }

    .duplicate-pair{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:18px;
        margin-bottom:22px;
    }
    @media (max-width:900px){ .duplicate-pair{ grid-template-columns:1fr; } }

    .client-card{
        background:#fff;
        border:1px solid var(--border-soft);
        border-radius:16px;
        padding:18px 20px;
        box-shadow:0 6px 18px rgba(140,126,242,0.06);
    }
    .client-card h4{
        margin:0 0 12px;
        font-size:15px;
        font-weight:700;
    }
    .client-card h4 a{ color:var(--accent-text); text-decoration:none; }
    .client-card h4 a:hover{ text-decoration:underline; }

    .client-info-row{
        display:flex;
        justify-content:space-between;
        gap:10px;
        padding:7px 0;
        border-bottom:1px solid #F5F3FD;
        font-size:13px;
    }
    .client-info-row:last-of-type{ border-bottom:none; }
    .client-info-row .label{ color:var(--text-muted); font-weight:600; white-space:nowrap; }
    .client-info-row .value{ color:var(--text-dark); text-align:right; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .client-info-row .value.empty{ color:#c9c6d8; font-style:italic; }

    .client-card-actions{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
        margin-top:14px;
        padding-top:14px;
        border-top:1px solid var(--border-soft);
    }
    .btn-archiver{
        background:var(--red-soft);
        color:var(--red);
        border:none;
        border-radius:9px;
        font-weight:600;
        font-size:12.5px;
        padding:8px 14px;
        display:inline-flex;
        align-items:center;
        gap:6px;
    }
    .btn-archiver:hover{ background:#FBDADD; color:var(--red); text-decoration:none; }
    .btn-envoyer-comment{
        background:var(--green-soft);
        color:var(--green);
        border:none;
        border-radius:9px;
        font-weight:600;
        font-size:12.5px;
        padding:8px 14px;
        display:inline-flex;
        align-items:center;
        gap:6px;
    }
    .btn-envoyer-comment:hover{ background:#D5F2E3; color:var(--green); text-decoration:none; }
    .btn-archiver svg, .btn-envoyer-comment svg{ width:13px;height:13px; }

    /* #example1 is used purely as a semantic wrapper for the pair rows, not an actual DataTable */
    table#example1{ border:none !important; background:transparent !important; }
    table#example1 thead{ display:none; }
    table#example1, table#example1 tbody, table#example1 tr, table#example1 td{
        display:block; width:100%; border:none !important; background:transparent !important; padding:0 !important;
    }
</style>

<div class="page-header-card">
    <div class="page-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="page-header-text">
        <h3>La liste des clients en double</h3>
        <p>Détectez et fusionnez les fiches clients en doublon</p>
        <span class="underline"></span>
    </div>
</div>

<div class="filter-form-card">
    <?php echo $this->Form->create('Client'); ?>
    <div class="filter-form-row">
        <div class="filter-form-col">
            <label>Type</label>
            <?php
            echo $this->Form->input('type', array('options' => $types, "name" => "type", 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="filter-form-col">
            <label>Champs</label>
            <?php
            $names = array("nom" => "Nom", "prenom" => "Prenom", "adress" => "Adresse", "category_id" => "Categorie", "secteur_id" => "Secteur", 'tel' => 'Tel', 'fixe' => 'Fix', 'fax' => 'Fax', 'mail' => 'mail');
            echo $this->Form->input('champs', array("options" => $names, "name" => "champs[]", 'class' => 'form-control choix_multi', 'multiple' => 'multiple', 'label' => false, 'div' => false));
            ?>
        </div>
    </div>
    <div class="filter-footer">
        <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn-envoyer', 'div' => false)); ?>
    </div>
</div>

<div class="doublons-header">
    <span class="icon-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
    </span>
    <h4>Résultats</h4>
</div>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Client</th>
            <th>Doublon</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client): ?>
            <?php if (!isset($client[0]['Client']) || !isset($client[1]['Client'])) continue; ?>
            <tr>
                <td colspan="2">
                    <div class="duplicate-pair">

                        <!-- ===== Client 0 ===== -->
                        <div class="client-card">
                            <h4>
                                <?php echo $this->Html->link($client[0]['Client']['nom'] . ' ' . $client[0]['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $client[0]['Client']['id']), array("target" => "_blank")); ?>
                            </h4>

                            <?php if (isset($client[0]['Client']['secteur_id'])): ?>
                                <?php foreach ($secteurs as $s): ?>
                                    <?php if ($s["Secteur"]["id"] == $client[0]['Client']['secteur_id']): ?>
                                        <div class="client-info-row"><span class="label">Région</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["region"]); ?></span></div>
                                        <div class="client-info-row"><span class="label">Ville</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["ville"]); ?></span></div>
                                        <div class="client-info-row"><span class="label">Secteur</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["secteur"]); ?></span></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="client-info-row"><span class="label">Adresse</span><span class="value" title="<?php echo htmlspecialchars($client[0]['Client']['adress']); ?>"><?php echo htmlspecialchars($client[0]['Client']['adress']) !== '' ? htmlspecialchars($client[0]['Client']['adress']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">GSM</span><span class="value"><?php echo htmlspecialchars($client[0]['Client']['tel']) !== '' ? htmlspecialchars($client[0]['Client']['tel']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">Fix</span><span class="value"><?php echo htmlspecialchars($client[0]['Client']['fixe']) !== '' ? htmlspecialchars($client[0]['Client']['fixe']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">Mail</span><span class="value" title="<?php echo htmlspecialchars($client[0]['Client']['mail']); ?>"><?php echo htmlspecialchars($client[0]['Client']['mail']) !== '' ? htmlspecialchars($client[0]['Client']['mail']) : '—'; ?></span></div>

                            <div class="client-card-actions">
                                <?php echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Archiver', array('controller' => 'clients', 'action' => 'archive', $client[0]['Client']['id'], 0), array("target" => "_blank", 'class' => 'btn-archiver', 'escape' => false)); ?>
                                <?php if ($this->requestAction('/droits/getrole/visites/migration') == 1) {
                                    echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Envoyer les commentaires', array('controller' => 'visites', 'action' => 'migration', $client[0]['Client']['id'], $client[1]['Client']['id']), array('class' => 'btn-envoyer-comment', 'escape' => false));
                                } ?>
                            </div>
                        </div>

                        <!-- ===== Client 1 (doublon) ===== -->
                        <div class="client-card">
                            <h4>
                                <?php echo $this->Html->link($client[1]['Client']['nom'] . ' ' . $client[1]['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $client[1]['Client']['id']), array("target" => "_blank")); ?>
                            </h4>

                            <?php if (isset($client[1]['Client']['secteur_id'])): ?>
                                <?php foreach ($secteurs as $s): ?>
                                    <?php if ($s["Secteur"]["id"] == $client[1]['Client']['secteur_id']): ?>
                                        <div class="client-info-row"><span class="label">Région</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["region"]); ?></span></div>
                                        <div class="client-info-row"><span class="label">Ville</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["ville"]); ?></span></div>
                                        <div class="client-info-row"><span class="label">Secteur</span><span class="value"><?php echo htmlspecialchars($s["Secteur"]["secteur"]); ?></span></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="client-info-row"><span class="label">Adresse</span><span class="value" title="<?php echo htmlspecialchars($client[1]['Client']['adress']); ?>"><?php echo htmlspecialchars($client[1]['Client']['adress']) !== '' ? htmlspecialchars($client[1]['Client']['adress']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">GSM</span><span class="value"><?php echo htmlspecialchars($client[1]['Client']['tel']) !== '' ? htmlspecialchars($client[1]['Client']['tel']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">Fix</span><span class="value"><?php echo htmlspecialchars($client[1]['Client']['fixe']) !== '' ? htmlspecialchars($client[1]['Client']['fixe']) : '—'; ?></span></div>
                            <div class="client-info-row"><span class="label">Mail</span><span class="value" title="<?php echo htmlspecialchars($client[1]['Client']['mail']); ?>"><?php echo htmlspecialchars($client[1]['Client']['mail']) !== '' ? htmlspecialchars($client[1]['Client']['mail']) : '—'; ?></span></div>

                            <div class="client-card-actions">
                                <?php echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Archiver', array('controller' => 'clients', 'action' => 'archive', $client[1]['Client']['id'], 0), array("target" => "_blank", 'class' => 'btn-archiver', 'escape' => false)); ?>
                                <?php if ($this->requestAction('/droits/getrole/visites/migration') == 1) {
                                    echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Envoyer les commentaires', array('controller' => 'visites', 'action' => 'migration', $client[1]['Client']['id'], $client[0]['Client']['id']), array('class' => 'btn-envoyer-comment', 'escape' => false));
                                } ?>
                            </div>
                        </div>

                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('.choix_multi').select2({
            width: '100%',
            placeholder: 'Sélectionner...'
        });
    });
</script>
