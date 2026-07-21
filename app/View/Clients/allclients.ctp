<?php

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
:root{
    --purple: #7C5CFA;
    --purple-dark:#5b3df0;
    --purple-light:#f2effe;
    --green:#22c58f;
    --pink:#ff5c8a;
    --orange:#ff9d4d;
    --text-dark:#2b2a3d;
    --text-light:#9a9ab0;
    --bg-soft:#f6f7fb;
    --border-soft:#eceafc;
    --card-shadow: 0 6px 20px rgba(90,80,150,0.08);
}

body, .content-wrapper{
    background: var(--bg-soft) !important;
    font-family: 'Segoe UI', Raleway, sans-serif;
}

.row { max-width: 100%; margin: 0; }
.content-wrapper .row,
.content-wrapper .col-md-12 { width: 100% !important; }

/* ===== Stat cards ===== */
.stat-card{
    background: #fff;
    border-radius: 16px;
    padding: 16px 18px 14px;
    box-shadow: var(--card-shadow);
    margin-bottom: 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    text-decoration: none !important;
    transition: .25s;
    height: 100%;
    position: relative;
    overflow: hidden;
    border-bottom: 3px solid transparent;
}
.stat-card:hover{ transform: translateY(-2px); box-shadow: 0 10px 28px rgba(90,80,150,0.14); }
.stat-card .top-row{ display:flex; align-items:center; justify-content:space-between; position: relative; z-index: 1; }

.stat-card.purple{ border-bottom-color: var(--purple); }
.stat-card.green{ border-bottom-color: var(--green); }
.stat-card.pink{ border-bottom-color: var(--pink); }
.stat-card.orange{ border-bottom-color: var(--orange); }

.stat-icon{
    width: 38px; height: 38px;
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: #fff;
    position: relative; z-index: 1;
}
.stat-card.purple .stat-icon{ background: linear-gradient(135deg,var(--purple),var(--purple-dark)); }
.stat-card.green .stat-icon{ background: linear-gradient(135deg,#3fe0b0,var(--green)); }
.stat-card.pink .stat-icon{ background: linear-gradient(135deg,#ff8aa8,var(--pink)); }
.stat-card.orange .stat-icon{ background: linear-gradient(135deg,#ffc37e,var(--orange)); }

.stat-card h3{ font-size: 21px; font-weight: 700; margin: 0; color: var(--text-dark); position: relative; z-index: 1; }
.stat-card.purple h3{ color: var(--purple-dark); }
.stat-card.green h3{ color: #189b71; }
.stat-card.pink h3{ color: #e13a67; }
.stat-card.orange h3{ color: #d97a26; }
.stat-card p{ margin: 0; color: var(--text-light); font-size: 12px; font-weight: 600; position: relative; z-index: 1; }

.stat-link{
    font-size: 11.5px;
    font-weight: 600;
    text-decoration: none !important;
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    margin-top: 2px;
    position: relative; z-index: 1;
    width: fit-content;
}
.stat-card.purple .stat-link{ color: var(--purple-dark); background: rgba(124,92,255,0.12); }
.stat-card.green .stat-link{ color: #189b71; background: rgba(34,197,143,0.12); }
.stat-card.pink .stat-link{ color: #e13a67; background: rgba(255,92,138,0.12); }
.stat-card.orange .stat-link{ color: #d97a26; background: rgba(255,157,77,0.12); }

.stat-decor{
    position: absolute;
    top: 0; right: 0;
    width: 100%; height: 100%;
    z-index: 0;
    opacity: 0.35;
    pointer-events: none;
}
.stat-card.purple .stat-decor{ color: var(--purple); }
.stat-card.green .stat-decor{ color: var(--green); }
.stat-card.pink .stat-decor{ color: var(--pink); }
.stat-card.orange .stat-decor{ color: var(--orange); }

/* ======================================================= */
/* ===== Metronic 8 / Bootstrap 5 style search toolbar ===== */
/* ======================================================= */
#searchCard.card-flush{
    background:#fff;
    border-radius:16px;
    border:1px solid var(--border-soft);
    box-shadow: var(--card-shadow);
    margin-bottom:24px;
    overflow:hidden;
}
#searchCard .card-header{
    border-bottom:1px solid var(--border-soft);
    padding:20px 28px;
    min-height:auto;
    display:flex;
    align-items:center;
}
#searchCard .card-title{
    display:flex;
    align-items:center;
    gap:14px;
    margin:0;
}
.search-icon-box{
    width:42px; height:42px;
    border-radius:12px;
    background: var(--purple-light);
    color: var(--purple);
    display:flex; align-items:center; justify-content:center;
    font-size:16px;
    flex-shrink:0;
}
#searchCard .card-title h2{
    font-size:16px;
    font-weight:700;
    color:var(--text-dark);
    margin:0;
    line-height:1.3;
}
#searchCard .card-title .subtitle{
    font-size:12.5px;
    color:var(--text-light);
    font-weight:500;
}
#searchCard .card-body{
    padding:22px 28px 26px;
}

/* Both CakePHP forms sit in one visual row. NOTE: we deliberately do
   NOT use `display:contents` on the <form> tags — it has long-standing
   rendering bugs in Chromium/WebKit where a form's children silently
   lose layout, especially under heavy templates like Metronic that
   also style `form`. Instead each <form> is its own flex row, and the
   outer wrapper is a flex row too, so everything still lines up. */
.toolbar-row{
    display:flex;
    flex-wrap:wrap;
    align-items:flex-end;
    gap:16px;
}
.toolbar-form-global,
.toolbar-form-filters{
    display:flex;
    flex-wrap:wrap;
    align-items:flex-end;
    gap:16px;
    margin:0;
    padding:0;
    border:0;
}

.toolbar-field{
    display:flex;
    flex-direction:column;
    gap:6px;
}
.toolbar-field.grow{ flex: 1 1 240px; }
.toolbar-field.mid{ flex: 1 1 200px; min-width:200px; }
.toolbar-field.small{ flex: 0 1 130px; }

.toolbar-field label,
.box-body label{
    font-size:12.5px;
    font-weight:600;
    color:var(--text-dark);
    margin:0 0 2px 2px;
    text-transform:uppercase;
    letter-spacing:.02em;
}

/* Solid Metronic-style inputs */
.form-control-solid.search-pill{
    border-radius:10px !important;
    border:1px solid transparent !important;
    background:var(--bg-soft) !important;
    padding:11px 16px 11px 40px;
    box-shadow:none;
    width:100%;
    font-size:13.5px;
    height:44px;
}
.form-control-solid.search-pill:focus{
    background:#fff !important;
    border-color:var(--purple) !important;
    box-shadow:0 0 0 3px rgba(124,92,250,0.15) !important;
}
.search-wrap{ position:relative; }
.search-wrap i{
    position:absolute; left:16px; top:50%; transform:translateY(-50%);
    color:var(--text-light);
    z-index:2;
}

.btn_search.btn-primary{
    border-radius:10px;
    background: var(--purple) !important;
    border-color: var(--purple) !important;
    color:#fff !important;
    font-size:13.5px;
    font-weight:600;
    padding:0 24px;
    height:44px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    transition:.2s;
    box-shadow: 0 4px 12px rgba(124,92,250,0.28);
    white-space:nowrap;
}
.btn_search.btn-primary:hover{ background:var(--purple-dark) !important; border-color:var(--purple-dark) !important; transform:translateY(-1px); }

.btn-light-primary{
    border-radius:10px;
    background: var(--purple-light) !important;
    border-color: var(--purple-light) !important;
    color: var(--purple-dark) !important;
    font-size:13.5px;
    font-weight:600;
    padding:0 20px;
    height:44px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    white-space:nowrap;
    text-decoration:none !important;
    transition:.2s;
}
.btn-light-primary:hover{ background:#e7e1fd !important; color:var(--purple-dark) !important; }

.toolbar-divider{
    width:1px;
    align-self:stretch;
    min-height:44px;
    background:var(--border-soft);
    margin:0 2px;
}

/* ============================================================
   Select2 -> Metronic "solid" chip look.
   IMPORTANT: select2 hides the original <select> and inserts its
   widget as a SIBLING (.select2-container), never as a descendant
   of the <select>. So we scope styles to #searchCard, not to a
   class that lives on the <select> itself.
   ============================================================ */
#searchCard .select2-container{
    width:100% !important;
}
#searchCard .select2-container .select2-selection{
    border-radius:10px !important;
    border:1px solid transparent !important;
    background:var(--bg-soft) !important;
    min-height:44px !important;
    box-shadow:none !important;
}
#searchCard .select2-container--default .select2-selection--multiple{
    padding:5px 8px;
    display:flex;
    align-items:center;
    flex-wrap:wrap;
}
#searchCard .select2-selection__rendered{
    display:flex !important;
    flex-wrap:wrap;
    gap:6px;
    padding:0 !important;
}
#searchCard .select2-selection__choice{
    background: var(--purple-light) !important;
    border:none !important;
    color: var(--purple-dark) !important;
    font-size:12.5px;
    font-weight:600;
    border-radius:6px !important;
    padding:4px 8px !important;
    margin:0 !important;
}
#searchCard .select2-selection__choice__remove{
    color: var(--purple) !important;
    border:none !important;
    margin-right:4px !important;
}
#searchCard .select2-selection__choice__remove:hover{
    background:transparent !important;
    color: var(--purple-dark) !important;
}
#searchCard .select2-container--default.select2-container--focus .select2-selection--multiple,
#searchCard .select2-container--open .select2-selection--multiple{
    border-color: var(--purple) !important;
    box-shadow:0 0 0 3px rgba(124,92,250,0.15);
    background:#fff !important;
}
#searchCard .select2-search--inline .select2-search__field{
    font-size:13px;
    margin-top:2px;
}
/* Deliberately NOT force-hiding select.choix_multi here. select2
   hides the original <select> itself once it successfully mounts.
   If we hide it unconditionally in CSS and select2 fails to load
   for any reason, the field goes completely blank with nothing to
   click — a native fallback listbox is better than nothing. */
#searchCard select.choix_multi{
    min-height:44px;
}

.limit-input{
    text-align:center;
    font-weight:600;
    font-size:13.5px;
    color:var(--text-dark);
    padding:0 12px !important;
    width:100%;
}
.limit-input:focus{
    border-color:var(--purple) !important;
    box-shadow:0 0 0 3px rgba(124,92,250,0.15) !important;
    background:#fff !important;
}

.btn-ajouter{
    background: var(--purple) !important;
    color:#fff !important;
    border-radius:10px !important;
    border:none !important;
    padding:10px 22px !important;
    font-weight:600 !important;
    font-size:13.5px !important;
    float:none;
    box-shadow: 0 4px 12px rgba(124,92,250,0.28);
    transition:.2s;
}
.btn-ajouter:hover{ background:var(--purple-dark) !important; transform:translateY(-1px); }

/* ===== Table card ===== */
.table-card.card-flush{
    background:#fff;
    border-radius:16px;
    border:1px solid var(--border-soft);
    box-shadow: var(--card-shadow);
    overflow:hidden;
}
.table-card .card-header{
    border-bottom:1px solid var(--border-soft);
    padding:20px 28px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:12px;
}
.table-card .card-title{
    font-size:16px;
    font-weight:700;
    color:var(--text-dark);
    margin:0;
}

#tabclient{
    padding: 0 !important;
}

.dataTables_filter{
    float: right;
    margin: 16px 24px 0 0;
}
.dataTables_filter label{
    display: flex;
    align-items: center;
    gap: 0;
}
.dataTables_filter input{
    border-radius: 10px !important;
    border: 1px solid var(--border-soft) !important;
    background: var(--bg-soft) !important;
    padding: 9px 16px 9px 34px !important;
    font-size: 13px !important;
    box-shadow: none !important;
    width: 220px;
}
.dataTables_filter label::before{
    font-family: FontAwesome;
    content: "\f002";
    position: relative;
    left: 26px;
    color: var(--text-light);
    font-size: 12px;
}

/* ===== Table ===== */
#tabclient table.dataTable{ border-collapse:collapse !important; width:100% !important; margin:0 !important; }

.table-scroll{
    overflow-x:auto;
    padding: 0 4px 20px;
}

#tabclient table.dataTable thead th,
#tabclient table.dataTable tfoot th{
    position: sticky;
    top: 0;
    z-index: 2;
    background: #faf9ff;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing:.03em;
    border-bottom: 2px solid var(--border-soft) !important;
    border-top:none !important;
    padding: 16px 12px;
    text-align: left;
    white-space:nowrap;
}
#tabclient table.dataTable tfoot th{ top: unset; position: static; }

#tabclient table.dataTable thead th:first-child{ padding-left:24px; }
#tabclient table.dataTable thead th:last-child{ padding-right:24px; text-align:center; }

#tabclient table.dataTable thead th:nth-child(1)  { color: var(--purple-dark); }
#tabclient table.dataTable thead th:nth-child(2)  { color: #3fa9e0; }
#tabclient table.dataTable thead th:nth-child(3)  { color: var(--text-dark); }
#tabclient table.dataTable thead th:nth-child(4)  { color: #189b71; }
#tabclient table.dataTable thead th:nth-child(5)  { color: #3f7ee0; }
#tabclient table.dataTable thead th:nth-child(6)  { color: #7c5cff; }
#tabclient table.dataTable thead th:nth-child(7)  { color: #1fb5a3; }
#tabclient table.dataTable thead th:nth-child(8)  { color: #d97a26; }
#tabclient table.dataTable thead th:nth-child(9)  { color: #e13a67; }
#tabclient table.dataTable thead th:nth-child(10) { color: var(--text-light); }
#tabclient table.dataTable thead th:nth-child(11) { color: var(--purple-dark); }
#tabclient table.dataTable thead th:nth-child(12) { color: var(--purple-dark); }
#tabclient table.dataTable thead th:nth-child(13) { color: var(--text-light); text-align:center; }

#tabclient table.dataTable thead th.sorting:after,
#tabclient table.dataTable thead th.sorting_asc:after,
#tabclient table.dataTable thead th.sorting_desc:after{
    color: inherit;
    opacity: 0.6;
}

#tabclient tfoot th{
    background: #fff !important;
    padding: 10px 12px 18px !important;
}
#tabclient tfoot th:first-child{ padding-left:24px !important; }
#tabclient tfoot th:last-child{ padding-right:24px !important; }
#tabclient tfoot input{
    border-radius: 8px !important;
    border: 1px solid var(--border-soft) !important;
    background: var(--bg-soft) !important;
    font-size: 12px !important;
    font-weight:500;
    padding: 8px 12px !important;
    width: 100%;
    box-sizing: border-box;
    text-align: left;
    color: var(--text-dark);
}
#tabclient tfoot input:focus{
    border-color: var(--purple) !important;
    background:#fff !important;
    outline:none;
}
#tabclient tfoot input::placeholder{
    color: var(--text-light);
    font-weight:400;
}

#tabclient table.dataTable tbody td{
    font-size: 13.5px;
    color: var(--text-dark);
    border-bottom: 1px solid #f4f3fa !important;
    border-top:none !important;
    padding: 14px 12px;
    text-align: left;
    vertical-align:middle;
}
#tabclient table.dataTable tbody td:first-child{ padding-left:24px; font-weight:600; color:var(--purple-dark); }
#tabclient table.dataTable tbody td.actions{ text-align:center; padding-right:24px; }

#tabclient table.dataTable tbody tr{ transition:.15s; }
#tabclient table.dataTable tbody tr:hover{ background: var(--purple-light); }
#tabclient table.dataTable tbody tr:hover td:first-child{ color: var(--purple-dark); }

#tabclient table.dataTable tbody td.dataTables_empty{
    padding: 48px 0 !important;
    color: var(--text-light);
    font-size: 13px;
    text-align:center;
}

.dt-button{
    border-radius:8px !important;
    background: var(--purple) !important;
    border:none !important;
    color:#fff !important;
    padding:6px 16px !important;
    font-size:13px !important;
}
.dt-button:hover{ background:var(--purple-dark) !important; color:#fff !important; }
.dt-buttons{ display: none; }

.actions .dropdown-toggle{
    border-radius:8px !important;
    background:var(--bg-soft) !important;
    border:1px solid var(--border-soft) !important;
    color: var(--text-dark) !important;
    padding:7px 12px !important;
    font-size:12.5px;
}
.actions .dropdown-toggle:hover{ background:var(--purple-light) !important; color:var(--purple-dark) !important; }
.actions .dropdown-menu{
    border-radius:10px;
    border:1px solid var(--border-soft);
    box-shadow: 0 10px 28px rgba(90,80,150,0.14);
    padding:6px;
}
.actions .dropdown-menu li a{
    border-radius:6px;
    padding:8px 12px;
    font-size:13px;
    color:var(--text-dark);
}
.actions .dropdown-menu li a:hover{ background:var(--purple-light); color:var(--purple-dark); }

/* ===== Pagination ===== */
.dataTables_wrapper .dataTables_paginate{
    float: right;
    margin: 16px 24px 20px 0;
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
    border-radius: 8px !important;
    border: 1px solid var(--border-soft) !important;
    background: var(--bg-soft) !important;
    color: var(--text-dark) !important;
    padding: 7px 16px !important;
    margin-left: 8px !important;
    font-size: 13px;
    font-weight: 600;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
    opacity: 0.5;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current{
    background: var(--purple) !important;
    color: #fff !important;
    border: none !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover{
    background: var(--purple) !important;
    color: #fff !important;
    border-color: var(--purple) !important;
}

.dataTables_wrapper .dataTables_info{
    float: left;
    font-size: 13px;
    color: var(--text-light);
    padding: 20px 0 20px 24px;
}

@media (max-width:896px){
    .toolbar-row{ flex-direction:column; align-items:stretch; }
    .toolbar-field.small{ flex-basis:auto; }
    .toolbar-divider{ display:none; }
}
</style>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <a href="<?php echo $this->Html->Url(array('action' => 'index')); ?>" class="stat-card purple">
            <div class="top-row">
                <div class="stat-icon"><i class="ion ion-bag"></i></div>
            </div>
            <h3 id="nbmedcin"><?php echo $nb_clients; ?></h3>
            <p>N° Clients</p>
            <span class="stat-link">Voir détails &rarr;</span>
        </a>
    </div>
    <div class="col-lg-3 col-xs-6">
        <a href="<?php echo $this->Html->Url(array('action' => 'index', '1')); ?>" class="stat-card green">
            <div class="top-row">
                <div class="stat-icon"><i class="ion ion-stats-bars"></i></div>
            </div>
            <h3 id="visitetotal"><?php echo $nb_client_affecter; ?></h3>
            <p>N° clients affectés</p>
            <span class="stat-link">Voir détails &rarr;</span>
        </a>
    </div>
    <div class="col-lg-3 col-xs-6">
        <a href="<?php echo $this->Html->Url(array('action' => 'index', '-1')); ?>" class="stat-card pink">
            <div class="top-row">
                <div class="stat-icon"><i class="ion ion-help"></i></div>
            </div>
            <h3 id="nbuser"><?php echo ($nb_clients - $nb_client_affecter); ?></h3>
            <p>N° Clients non affectés</p>
            <span class="stat-link">Voir détails &rarr;</span>
        </a>
    </div>
    <?php if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'clients', 'remettre0')) == 1): ?>
        <div class="col-lg-3 col-xs-6">
            <a href="<?php echo $this->Html->Url(array('action' => 'remettre0')); ?>" class="stat-card orange">
                <div class="top-row">
                    <div class="stat-icon"><i class="ion ion-minus-circled"></i></div>
                </div>
                <h3 id="nbresetclients">Remettre à 0</h3>
                <p>Tout remettre à 0</p>
                <span class="stat-link">Réinitialiser &rarr;</span>
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-flush" id="searchCard">
            <div class="card-header">
                <div class="card-title">
                    <div class="search-icon-box"><i class="fa fa-search"></i></div>
                    <div>
                        <h2>Recherche</h2>
                        <div class="subtitle">Rechercher et filtrer les clients</div>
                    </div>
                </div>
            </div>
            <div class="card-body box-body">
                <div class="toolbar-row">
                    <?php echo $this->Form->create('Client', array('class' => 'toolbar-form-global')); ?>
                    <div class="toolbar-field grow">
                        <label>Recherche globale</label>
                        <div class="search-wrap">
                            <i class="fa fa-search"></i>
                            <input type="text" name="client_search" placeholder="Société ou nom ou code_wavesoft" class="form-control form-control-solid input_txt search-pill">
                        </div>
                    </div>
                    <?php echo $this->Form->end(array('label' => 'Rechercher', 'class' => 'btn btn_search btn-primary', 'div' => false)); ?>

                    <div class="toolbar-divider"></div>

                    <?php echo $this->Form->create('Client', array('class' => 'toolbar-form-filters')); ?>
                    <div class="toolbar-field mid">
                        <?php echo $this->Form->input('catesgorie', array("id" => "cat", "name" => "data[Client][catesgorie][]", 'class' => 'form-select form-select-solid categorie choix_multi', "multiple", 'label' => 'Catégorie')); ?>
                    </div>
                    <div class="toolbar-field mid">
                        <?php echo $this->Form->input('secteurs', array("id" => "secteur", "name" => "data[Client][secteur][]", 'search' => 'dp', 'class' => 'form-select form-select-solid ville choix_multi', "multiple", 'label' => 'Secteur')); ?>
                    </div>
                    <div class="toolbar-field small">
                        <?php echo $this->Form->input('limit', array('class' => 'form-control form-control-solid limit-input limit', 'label' => "Limite à afficher", 'value' => $limite)); ?>
                    </div>
                    <button type="submit" class="btn btn_search btn-primary">Rechercher</button>
                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i>&nbsp; Réinitialiser', array('action' => 'index'), array('class' => 'btn-light-primary', 'escape' => false)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card table-card card-flush">
            <div class="card-header">
                <h3 class="card-title"><?php echo __('La liste des clients'); ?></h3>
                <?php
                if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'clients', 'add')) == 1)
                    echo $this->Html->link(__('Ajouter +'), array('action' => 'add', "Médecin"), array("target" => "_blanck", 'class' => "btn-ajouter", 'escape' => false));
                ?>
            </div>
            <div class="box-body" id="tabclient">
                <div class="table-scroll">
                <table id="example1" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Nom & prénom</th>
                            <th>Activité</th>
                            <th>Hôpital</th>
                            <th>Region</th>
                            <th>Ville</th>
                            <th>Secteur</th>
                            <th>Spécialité</th>
                            <th>Tendance</th>
                            <th>Pot V1</th>
                            <th>Pot V2</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php
                                $typ = substr($client['Category']['name'], 0, 3);
                                $typ = strtoupper($typ);
                                echo $client['Secteur']["code_region"] . $client['Secteur']["code_ville"] . $client['Secteur']["code_secteur"] . $typ . $client['Client']['id'];
                                ?>
                            </td>
                            <td><?php echo $this->Html->link($client['Type']['name'], array('controller' => 'types', 'action' => 'view', $client['Type']['id']), array("target" => "_blanck")); ?></td>
                            <td><?php echo $this->Html->link($client['Client']['nom'] . ' ' . $client['Client']['prenom'], array('action' => 'view', $client['Client']['id']), array("target" => "_blanck")); ?>&nbsp;</td>
                            <td><?php echo h($client['Client']['activite']); ?>&nbsp;</td>
                            <td><?php echo !empty($client['Hopital']['name']) ? h($client['Hopital']['name']) : '—'; ?>&nbsp;</td>
                            <td><?php echo h($client['Secteur']['region']); ?>&nbsp;</td>
                            <td><?php echo h($client['Secteur']['ville']); ?>&nbsp;</td>
                            <td><?php echo $this->Html->link($client['Secteur']['secteur'], array('controller' => 'secteurs', 'action' => 'view', $client['Secteur']['id']), array("target" => "_blanck")); ?></td>
                            <td><?php echo $this->Html->link($client['Category']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category']['id']), array("target" => "_blanck")); ?></td>
                            <td><?php echo $this->Html->link($client['Category1']['name'], array('controller' => 'categories', 'action' => 'view', $client['Category1']['id']), array("target" => "_blanck")); ?></td>
                            <td><?php echo h($client['Client']['potentialite']); ?>&nbsp;</td>
                            <td><?php echo h($client['Client']['potentialitev2']); ?>&nbsp;</td>
                            <td class="actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><?php
                                            if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'clients', 'view')) == 1)
                                                echo $this->Html->link(__('Voir'), array('action' => 'view', $client['Client']['id']), array("target" => "_blanck"));
                                            ?></li>
                                        <li><?php
                                            if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'clients', 'edit')) == 1)
                                                echo $this->Html->link(__('Editer'), array('action' => 'edit', $client['Client']['id']), array("target" => "_blanck"));
                                            ?></li>
                                        <li><?php
                                            if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'clients', 'archive')) == 1)
                                                echo $this->Html->link(__('Archiver'), array('action' => 'archive', $client['Client']['id'], 0), array("target" => "_blanck"));
                                            ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script('jquery.dataTables.min');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script>
    $(document).ready(function () {
        $("#search").click(function () {
            var id = $("#recherche").val();
            if (id.length > 2)
            {
                var image = "<center><img src='/img/loading.gif' style='width: 50px;' ></center>";
                $("#tabclient").empty();
                $(image).appendTo("#tabclient");
                $("#tabclient").show();
                id = id.replace("/", "||");
                $.post(
                        '/clients/system_recherche/' + id + "/<?php //echo $inn; ?>",

                        function (data)
                        {
                            $("#tabclient").empty();
                            $(data).appendTo("#tabclient");
                            $("#tabclient").show();
                        },
                        'text' // type
                        );
            }
        });
    });
</script>

<script type="text/javascript">
    /* ===================================================================
       select2 loading fix
       -------------------------------------------------------------------
       select2.full.min.js is intentionally NOT echoed via CakePHP's
       Html->script() helper anywhere in this file. It used to be loaded
       near the top of the file, but the layout footer reloads
       jquery-2.2.3.min AFTER that point, which creates a brand-new
       jQuery object with an empty .fn — wiping out the select2 plugin
       that had been bound to the previous jQuery instance. That's why
       #cat / #secteur were falling back to plain native <select
       multiple> boxes instead of showing the pill/chip Select2 widget.

       Fix: wait for window.load. By then every script tag on the page —
       including the layout's jQuery reload — has already executed in
       document order, so window.jQuery is guaranteed to be the FINAL
       live jQuery instance the rest of the page is actually using.
       Only then do we dynamically inject select2.full.min.js and bind
       it, so it always attaches to the right jQuery object regardless
       of include order elsewhere in the layout.
       =================================================================== */
    function initClientFilterSelect2() {
        var $j = window.jQuery || window.$;
        if (!$j || !$j.fn.select2) {
            console.warn('select2 still unavailable on the final jQuery instance — falling back to native multi-select.');
            return false;
        }
        $j("#cat, #secteur").each(function () {
            if ($j(this).data('select2')) {
                $j(this).select2('destroy');
            }
        });
        $j("#cat, #secteur").select2({ width: '100%' });
        return true;
    }

    function loadSelect2AgainstFinalJQuery() {
        var s = document.createElement('script');
        s.src = "<?php echo $this->webroot; ?>js/select2.full.min.js";
        s.onload = initClientFilterSelect2;
        s.onerror = function () {
            console.warn('Failed to load select2.full.min.js — filters will remain native multi-select boxes.');
        };
        document.body.appendChild(s);
    }

    if (window.addEventListener) {
        window.addEventListener('load', loadSelect2AgainstFinalJQuery);
    } else {
        // very old IE fallback
        window.attachEvent('onload', loadSelect2AgainstFinalJQuery);
    }
</script>

<script type="text/javascript">
    $(function () {
        if ($.fn.DataTable.isDataTable('#example1')) {
            $('#example1').DataTable().destroy();
        }

        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "iDisplayLength": 50,
            "language": {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
        });

        var conte = 0;
        $('#example1 tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" class="' + conte + '"/>');
            conte = conte + 1;
        });

        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
    });
</script>
