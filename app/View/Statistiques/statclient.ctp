<?php

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<?php
// These were missing entirely, which is why the multi-selects rendered as native
// (large, always-open) listboxes instead of Select2 dropdowns: without select2.min.js
// on the page, $('.choix_multi').select2() is calling a function that doesn't exist,
// and jquery.dataTables.min.js (the DataTables core) was missing too — only the
// buttons plugins were loaded, so `$(...).DataTable` was undefined. That threw a
// JS error partway through the script block, which stopped everything after it,
// including the select2 initialization line further down.
echo $this->Html->css('select2.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('select2.full.min');
?>

<style>
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-light:#f1effd;
        --accent-lighter:#f8f7fd;
        --page-bg:#F8F7FD;
        --card-bg:#ffffff;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    .box-body{ overflow:hidden; overflow-y:hidden; }

    /* ---------- Card shell ---------- */
    .box{
        background:var(--card-bg);
        border:1px solid var(--border-color);
        border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card);
        margin-bottom:24px;
    }
    .box .box-header.with-border{ border-bottom:none; padding:24px 24px 8px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }

    .section-header{ display:flex; align-items:flex-start; gap:14px; margin-bottom:6px; }
    .section-icon{
        flex:0 0 auto; width:44px; height:44px; border-radius:var(--radius-sm);
        background:var(--accent-light); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:18px;
    }
    .section-header h3.box-title{ margin:0; font-size:17px; font-weight:700; color:var(--text-dark); }
    .section-header p.section-subtitle{ margin:2px 0 0 0; font-size:13px; color:var(--text-muted); }

    /* ---------- Filter form ---------- */
    /* CakePHP's FormHelper wraps each field in <div class="input ...">, not .form-group,
       and the original template floated the inputs (pull-right). With the new
       icon-label-above-input layout that float collapses the wrapper's height to 0,
       so the next field's label renders on top of the previous input. Neutralize both. */
    #dateform{ overflow:hidden; }
    #dateform .form-group,
    #dateform > .col-md-6 > div.input{
        margin-bottom:20px !important;
        clear:both !important;
        display:block !important;
        overflow:visible;
    }
    #dateform label{
        display:flex; align-items:center; gap:8px; font-weight:700;
        font-size:13.5px; color:var(--text-dark); margin-bottom:8px;
        float:none !important; width:auto !important;
    }
    #dateform label .field-icon{
        width:26px; height:26px; border-radius:7px; background:var(--accent-light);
        color:var(--accent); display:inline-flex; align-items:center; justify-content:center;
        font-size:12px; flex:0 0 auto;
    }
    #dateform .form-control,
    #dateform select.pull-right,
    #dateform .select2.pull-right,
    #dateform .select2-container{
        float:none !important;
        width:100% !important;
        display:block !important;
    }
    #dateform .form-control,
    #dateform .select2-container .select2-selection--single,
    #dateform .select2-container .select2-selection--multiple{
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-sm) !important;
        background:var(--accent-lighter) !important;
        min-height:42px;
        box-shadow:none !important;
        font-size:14px;
        color:var(--text-dark);
    }
    #dateform .form-control:focus,
    #dateform .select2-container--focus .select2-selection{
        border-color:var(--accent) !important;
        background:#fff !important;
    }
    #dateform .select2-container{
        max-width:100% !important;
        box-sizing:border-box !important;
    }
    #dateform .select2-selection__rendered{ line-height:40px !important; padding-left:12px !important; color:var(--text-muted) !important; }
    #dateform .select2-selection__arrow{ height:40px !important; }

    /* Prevent any oversized/unconverted control from stretching the layout and
       forcing a page-wide horizontal scrollbar. */
    body{ overflow-x:hidden; }
    #dateform,
    #dateform .col-md-6,
    #dateform .input{
        max-width:100%;
        box-sizing:border-box;
        overflow-x:hidden;
    }
    #dateform select[multiple]:not(.select2-hidden-accessible){
        max-width:100%;
    }

    /* ---------- Select2: collapsed-by-default, Metronic-style tag chips ---------- */
    /* The raw <select multiple> only looks like an always-open listbox until
       Select2 actually initializes on it (see JS include fix above). Once select2
       runs, these rules turn the multi-select into a single-line, closed-by-default
       field with a search box and rounded tag pills for each choice. */
    #dateform .select2-container--default .select2-selection--multiple{
        padding:4px 8px !important;
        min-height:42px;
        display:flex;
        align-items:center;
        flex-wrap:wrap;
    }
    #dateform .select2-selection__rendered{
        display:flex !important;
        flex-wrap:wrap;
        gap:6px;
        padding:2px 0 !important;
        line-height:normal !important;
    }
    #dateform .select2-selection--multiple .select2-selection__choice{
        background:var(--accent) !important;
        border:none !important;
        border-radius:20px !important;
        color:#fff !important;
        font-size:12.5px !important;
        font-weight:600 !important;
        padding:4px 10px !important;
        margin:0 !important;
        display:flex;
        align-items:center;
        gap:6px;
    }
    #dateform .select2-selection--multiple .select2-selection__choice__remove{
        color:#fff !important;
        border:none !important;
        margin-right:0 !important;
        opacity:.8;
        font-weight:700;
    }
    #dateform .select2-selection--multiple .select2-selection__choice__remove:hover{
        opacity:1;
        background:transparent !important;
        color:#fff !important;
    }
    #dateform .select2-search--inline .select2-search__field{
        margin-top:0 !important;
        font-size:13.5px;
        color:var(--text-dark);
    }
    #dateform .select2-selection__clear{
        color:var(--text-muted) !important;
        margin-right:6px;
        font-size:16px;
    }
    .select2-dropdown{
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-sm) !important;
        box-shadow:0 10px 30px rgba(45,43,66,0.12) !important;
        overflow:hidden;
    }
    .select2-search--dropdown{ padding:10px !important; }
    .select2-search--dropdown .select2-search__field{
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-sm) !important;
        padding:8px 12px !important;
        font-size:13.5px !important;
        outline:none;
    }
    .select2-search--dropdown .select2-search__field:focus{ border-color:var(--accent) !important; }
    .select2-results__option{ font-size:13.5px !important; padding:9px 14px !important; }
    .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background:var(--accent) !important; color:#fff !important;
    }
    .select2-container--default .select2-results__option[aria-selected="true"]{
        background:var(--accent-light) !important; color:var(--accent) !important;
    }

    #dateform input[type="submit"]{
        -webkit-appearance:none; appearance:none;
        background:var(--accent) !important; border:none !important;
        border-radius:var(--radius-sm) !important; color:#fff !important;
        padding:11px 22px !important; font-weight:600; font-size:14px;
        box-shadow:0 4px 14px rgba(108,92,231,0.35) !important;
        transition:background .15s ease; cursor:pointer;
    }
    #dateform input[type="submit"]:hover{ background:var(--accent-dark) !important; }

    /* ---------- Info boxes (top summary + bottom "remplissage") ---------- */
    .stat-row{ display:flex; flex-wrap:wrap; gap:16px; margin:0 0 24px 0; }
    .stat-card{
        flex:1 1 190px; background:var(--card-bg); border:1px solid var(--border-color);
        border-radius:var(--radius-md); padding:16px 18px; display:flex; align-items:center; gap:14px;
        box-shadow:var(--shadow-card);
    }
    .stat-card .stat-icon{
        width:42px; height:42px; min-width:42px; border-radius:50%;
        display:flex; align-items:center; justify-content:center; color:#fff; font-size:16px;
    }
    .stat-card .stat-body .stat-label{ font-size:12.5px; font-weight:700; color:var(--text-muted); margin-bottom:2px; }
    .stat-card .stat-body .stat-value{ font-size:19px; font-weight:700; color:var(--text-dark); line-height:1.15; }
    .stat-card .stat-body .stat-sub{ font-size:12px; color:var(--text-muted); }

    .stat-icon.c-indigo{ background:#8b7cf6; }
    .stat-icon.c-green{ background:#2ecc71; }
    .stat-icon.c-blue{ background:#3d9be9; }
    .stat-icon.c-purple{ background:#6c5ce7; }
    .stat-icon.c-facebook{ background:#3d9be9; }
    .stat-icon.c-pink{ background:#f06595; }

    /* ---------- Table toolbar (export buttons + search) ---------- */
    .table-toolbar{ display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:14px; }
    .table-toolbar .dt-buttons{ display:flex; gap:10px; }
    .dt-button{
        width:auto !important; float:none !important; margin:0 !important;
        display:inline-flex !important; align-items:center; gap:7px;
        font-size:13.5px !important; line-height:1 !important; font-weight:600;
        padding:10px 16px !important; border-radius:var(--radius-sm) !important;
        background:#fff !important; color:var(--text-dark) !important;
        border:1px solid var(--border-color) !important; box-shadow:none !important;
    }
    .dt-button:hover{ color:var(--accent) !important; background:var(--accent-light) !important; border-color:var(--accent) !important; }
    .buttons-excel{ color:#1d8348 !important; }
    .buttons-excel:hover{ background:#eafaf1 !important; border-color:#1d8348 !important; }

    .table-toolbar .dataTables_filter{ margin:0 !important; }
    .table-toolbar .dataTables_filter label{ display:flex !important; align-items:center; margin:0; }
    .table-toolbar .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:9px 16px !important; min-width:230px; background:var(--accent-lighter) url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 12px center;
        background-size:14px 14px; padding-left:34px !important; font-size:13.5px !important; margin-left:8px;
    }
    .table-toolbar .dataTables_filter input:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }

    /* ---------- Table ---------- */
    table.display{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    table.display thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:12px 14px !important;
    }
    table.display thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    table.display thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    table.display tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:13px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    table.display tbody tr:hover td{ background:var(--accent-lighter); }
    table.display tbody tr:last-child td{ border-bottom:none !important; }

    /* ---------- Empty state ---------- */
    table.display .dataTables_empty{
        padding:56px 20px !important; text-align:center; border:none !important;
    }
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:10px; color:var(--text-muted); }
    .dt-empty-state .dt-empty-icon{
        width:64px; height:64px; border-radius:50%; background:var(--accent-light); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:26px; margin-bottom:6px;
    }
    .dt-empty-state .dt-empty-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .dt-empty-state .dt-empty-sub{ font-size:12.5px; }

    /* ---------- Pagination ---------- */
    .dataTables_wrapper .dataTables_paginate{ margin-top:16px !important; text-align:right; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 13px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ color:var(--text-muted) !important; opacity:.6; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background:var(--accent-light) !important; color:var(--accent) !important; border-color:var(--accent) !important;
    }
</style>

<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group">
            <div class="box-header with-border">
                <div class="section-header">
                    <span class="section-icon"><i class="fa fa-filter"></i></span>
                    <div>
                        <h3 class="box-title">Filtres de recherche</h3>
                        <p class="section-subtitle">Affinez votre recherche pour trouver vos clients</p>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <form action="<?php echo $this->Html->url("/statistiques/statclient") ?>" method="post" id="dateform" autocomplete="off">
                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('category', array("id" => "filter_activite", "label" => array('text' => '<span class="field-icon"><i class="fa fa-th-large"></i></span>Choisissez l\'activté', 'escape' => false), "name" => "activite",
                            'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                            'class' => 'form-control pull-right'));
                        echo $this->Form->input('potentialite', array("id" => "filter_potentialite", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-star"></i></span>Choisissez potentialité', 'escape' => false), "name" => "potentialite",
                            'options' => array("A1" => "A1", "A2" => "A2", "A3" => "A3",
                                "B1" => "B1", "B2" => "B2", "B3" => "B3",
                                "C1" => "C1", "C2" => "C2", "C3" => "C3"),
                            'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'));
                        if (AuthComponent::user('role') != 'Super viseur')
                            echo $this->Form->input('category', array("id" => "filter_secteur", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-building"></i></span>La liste des secteurs', 'escape' => false), "name" => "secteur",
                                'options' => $secteurs, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'));

                        echo $this->Form->input('category', array("id" => "filter_category", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-flask"></i></span>La liste des spécialité', 'escape' => false), "name" => "category",
                            'options' => $categories, 'class' => 'form-control pull-right choix_multi select2', 'multiple' => 'multiple'));
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('user', array("id" => "filter_users", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-users"></i></span>La liste des VM', 'escape' => false), "name" => "users",
                            'options' => $users, 'class' => 'form-control pull-right choix_multi vm select2', 'multiple' => 'multiple'));
                        echo $this->Form->input('ligne', array("id" => "filter_ligne", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-list-ul"></i></span>Les lignes', 'escape' => false), "name" => "ligne",
                            'options' => $lignes, 'class' => 'form-control pull-right choix_multi vm select2', 'multiple' => 'multiple'));
                        $types = array("1" => "Medcin", "2" => "Pharmacie",);
                        echo $this->Form->input('type', array("id" => "filter_type", "multiple" => "true", "label" => array('text' => '<span class="field-icon"><i class="fa fa-user-md"></i></span>Type de client', 'escape' => false), "name" => "type",
                            'options' => $types, 'class' => 'form-control pull-right choix_multi vm select2', 'multiple' => 'multiple'));
                        ?>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Rechercher" style="float: right;">
                    </div>
                </form>
            </div>
        </div>

        <?php if (isset($infos)): ?>
            <div class="stat-row">
                <div class="stat-card">
                    <span class="stat-icon c-blue"><i class="fa fa-mobile"></i></span>
                    <div class="stat-body">
                        <div class="stat-label">GSM</div>
                        <div class="stat-value"><?php echo $infos["tel"]; ?></div>
                        <div class="stat-sub"><?php echo round($infos["tel"] / $infos["total"] * 100, 2) . " %"; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon c-pink"><i class="fa fa-phone"></i></span>
                    <div class="stat-body">
                        <div class="stat-label">Fixe</div>
                        <div class="stat-value"><?php echo $infos["fixe"]; ?></div>
                        <div class="stat-sub"><?php echo round($infos["fixe"] / $infos["total"] * 100, 2) . " %"; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon c-green"><i class="fa fa-envelope-o"></i></span>
                    <div class="stat-body">
                        <div class="stat-label">Mail</div>
                        <div class="stat-value"><?php echo $infos["mail"]; ?></div>
                        <div class="stat-sub"><?php echo round($infos["mail"] / $infos["total"] * 100, 2) . " %"; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon c-facebook"><i class="fa fa-facebook-official"></i></span>
                    <div class="stat-body">
                        <div class="stat-label">Facebook</div>
                        <div class="stat-value"><?php echo $infos["fax"]; ?></div>
                        <div class="stat-sub"><?php echo round($infos["fax"] / $infos["total"] * 100, 2) . " %"; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-icon c-purple"><i class="fa fa-map-marker"></i></span>
                    <div class="stat-body">
                        <div class="stat-label">Géolocalisation</div>
                        <div class="stat-value"><?php echo $infos["gps"]; ?></div>
                        <div class="stat-sub"><?php echo round($infos["gps"] / $infos["total"] * 100, 2) . " %"; ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="section-header">
                        <span class="section-icon"><i class="fa fa-users"></i></span>
                        <div>
                            <h3 class="box-title">La liste des clients</h3>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <table class="table table-bordred display" id="example1">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>GSM</th>
                                    <th>Fixe</th>
                                    <th>Mail</th>
                                    <th>Facebook</th>
                                    <th>Géolocalisation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tel = $mail = $face = $fixe = $gps = 0;
                                $total = count($clients);
                                foreach ($clients as $c):
                                    $c["Client"]["tel"] = str_replace(" ", "", $c["Client"]["tel"]);
                                    $c["Client"]["fixe"] = str_replace(" ", "", $c["Client"]["fixe"]);
                                    $c["Client"]["fax"] = str_replace(" ", "", $c["Client"]["fax"]);
                                    $c["Client"]["mail"] = str_replace(" ", "", $c["Client"]["mail"]);
                                    if (strlen($c["Client"]["tel"]) == 10 || strlen($c["Client"]["tel"]) == 14)
                                        $tel++;
                                    if (strlen($c["Client"]["fixe"]) == 10 || strlen($c["Client"]["fixe"]) == 14)
                                        $fixe++;
                                    if (strlen($c["Client"]["fax"]) > 14)
                                        $face++;
                                    if (strlen($c["Client"]["mail"]) > 10 && $c["Client"]["mail"] != "test@gmail.com")
                                        $mail++;
                                    if (strlen($c["Client"]["longitude"]) > 5)
                                        $gps++;
                                    ?>
                                    <tr>
                                        <td> <?php echo $c["Client"]["nom"] . " " . $c["Client"]["prenom"]; ?> </td>
                                        <td> <?php echo $c["Client"]["tel"]; ?> </td>
                                        <td> <?php echo $c["Client"]["fixe"]; ?> </td>
                                        <td> <?php echo $c["Client"]["mail"]; ?> </td>
                                        <td> <?php echo $c["Client"]["fax"]; ?> </td>
                                        <td> <?php echo $c["Client"]["longitude"]; ?> </td>
                                        <td> <?php
                                            if ($this->requestAction('/droits/getrole/clients/edit') == 1)
                                                echo $this->Html->link(__('Editer'), array("controller" => "clients", 'action' => 'edit',
                                                    $c['Client']['id']), array("target" => "_blanck"));
                                            ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="section-header">
                        <span class="section-icon"><i class="fa fa-bar-chart"></i></span>
                        <div>
                            <h3 class="box-title">Suivi de remplissage client</h3>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="stat-row">
                        <div class="stat-card">
                            <span class="stat-icon c-indigo"><i class="fa fa-file-text-o"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">Total Affecté</div>
                                <div class="stat-value"><?php echo $total; ?></div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon c-green"><i class="fa fa-phone"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">% téléphone rempli</div>
                                <div class="stat-value"><?php
                                    if ($tel != 0)
                                        echo round($tel / $total * 100, 2) . " %";
                                    else
                                        echo "0 %";
                                    ?></div>
                                <div class="stat-sub">(<?php echo $tel; ?>)</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon c-blue"><i class="fa fa-phone-square"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">% fixe rempli</div>
                                <div class="stat-value"><?php
                                    if ($fixe != 0)
                                        echo round($fixe / $total * 100, 2) . " %";
                                    else
                                        echo "0 %";
                                    ?></div>
                                <div class="stat-sub">(<?php echo $fixe; ?>)</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon c-purple"><i class="fa fa-envelope"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">% adresse mail rempli</div>
                                <div class="stat-value"><?php
                                    if ($mail != 0)
                                        echo round($mail / $total * 100, 2) . " %";
                                    else
                                        echo "0 %";
                                    ?></div>
                                <div class="stat-sub">(<?php echo $mail; ?>)</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon c-facebook"><i class="fa fa-facebook"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">% compte face rempli</div>
                                <div class="stat-value"><?php
                                    if ($face != 0)
                                        echo round($face / $total * 100, 2) . " %";
                                    else
                                        echo "0 %";
                                    ?></div>
                                <div class="stat-sub">(<?php echo $face; ?>)</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon c-pink"><i class="fa fa-map-marker"></i></span>
                            <div class="stat-body">
                                <div class="stat-label">% compte Géolocalisation rempli</div>
                                <div class="stat-value"><?php
                                    if ($gps != 0)
                                        echo round($gps / $total * 100, 2) . " %";
                                    else
                                        echo "0 %";
                                    ?></div>
                                <div class="stat-sub">(<?php echo $gps; ?>)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>
<script>
    $(function () {
        // Select2: collapsed by default, opens on click, shows a search box,
        // and (default select2 behaviour) closes again as soon as an option is picked.
        $('.choix_multi').select2({
            placeholder: 'Choisissez...',
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: false,
            closeOnSelect: true
        });
    });

    $(function () {
        try {
            if ($('#reservationtime').length) {
                $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
                    locale: {
                        "format": "YYYY-MM-DD",
                        "separator": " -- ",
                        "applyLabel": "Valider",
                        "cancelLabel": "Annuler",
                        "fromLabel": "De",
                        "toLabel": "à",
                        "customRangeLabel": "Custom",
                        "daysOfWeek": [
                            "Dim",
                            "Lun",
                            "Mar",
                            "Mer",
                            "Jeu",
                            "Ven",
                            "Sam"
                        ],
                        "monthNames": [
                            "Janvier",
                            "Février",
                            "Mars",
                            "Avril",
                            "Mai",
                            "Juin",
                            "Juillet",
                            "Août",
                            "Septembre",
                            "Octobre",
                            "Novembre",
                            "Décembre"
                        ],
                        "firstDay": 1
                    },
                    clickApply: function (e) {
                        this.updateInputText();
                    }
                });
            }
        } catch (e) {
            console.error('daterangepicker init failed:', e);
        }
    });

    $(function () {
        try {
            $('.display').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                dom: '<"table-toolbar"Bf>rt<"dt-footer"p>',
                language: {
                    search: "",
                    searchPlaceholder: "Rechercher...",
                    emptyTable: '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-inbox"></i></span><div class="dt-empty-title">Aucune donnée disponible</div><div class="dt-empty-sub">Aucun client trouvé pour les filtres sélectionnés.</div></div>',
                    paginate: { previous: "Précédent", next: "Suivant" }
                },
                buttons: [
                    { extend: 'csv', text: '<i class="fa fa-file-text-o"></i> CSV' },
                    { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Excel' },
                    { extend: 'print', text: '<i class="fa fa-print"></i> Imprimer' }
                ]
            });
        } catch (e) {
            console.error('DataTable init failed:', e);
        }
    });

    var superarray = {
<?php
foreach ($equipes as $k => $value) {
    $ids = "";
    ?>
            "<?php echo $k; ?>id": [{"data": <?php
    foreach ($value as $key => $v) {
        $ids = $ids . ",'" . $key . "'";
    } $ids = ltrim($ids, ',');
    ?>[<?php echo $ids; ?>]}],
<?php } ?>
    };
    var item = [];
    $('.vm').on('select2:select', function (e) {
        array = [];
        var ids = $(this).val() + 'id';
        if (ids.indexOf(',') > -1) {
            var idsi = ids.split(',');
            var ids = idsi[idsi.length - 1];
        }
        console.log(ids);
        console.log(item);
        if (ids in superarray) {
            array = superarray[ids][0].data;
            console.log(ids);
            var select = [ids.replace('id', '')];
            for (var i = 0; i < array.length; i++) {
                select.push(array[i]);
            }
            console.log(select);
            $('.vm').select2('val', [select]);
            item += select;
        }
    });
</script>
