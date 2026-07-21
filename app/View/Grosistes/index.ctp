<?php
echo $this->Html->css('dataTables.bootstrap');
?>

<!-- ===== METRONIC CARD CONTAINER ===== -->
<div class="card card-custom shadow-sm">
    
    <!-- ===== METRONIC CARD HEADER ===== -->
    <div class="card-header border-0 pt-5 pb-5">
        <h3 class="card-title align-items-center flex-row">
            <span class="symbol symbol-40 symbol-light-primary mr-3">
                <span class="symbol-label">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h1m4 0h1m-6 4h1m4 0h1m-6 4h1m4 0h1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </span>
            <span class="card-label font-weight-bolder text-dark font-size-h4">Grossistes</span>
        </h3>
        
        <div class="card-toolbar">
            <?php if ($this->requestAction('/droits/getrole/grosistes/statistiqueglobal') == 1): ?>
                <?php echo $this->Html->link(
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px; vertical-align:-2px;"><path d="M4 20V10m6 10V4m6 16v-7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>Statistique global',
                    array('action' => 'statistiqueglobal'),
                    array('class' => "btn btn-global-stats font-weight-bolder btn-sm mr-2", 'escape' => false)
                ); ?>
            <?php endif; ?>
            
            <?php if ($this->requestAction('/droits/getrole/grosistes/add') == 1): ?>
                <?php echo $this->Html->link(
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px; vertical-align:-2px;"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>Ajouter',
                    array('action' => 'add'),
                    array('class' => "btn btn-primary-lavender font-weight-bolder btn-sm", 'escape' => false)
                ); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== METRONIC CARD BODY ===== -->
    <div class="card-body py-2">
        <div class="table-responsive">
            <table id="example1" class="table table-head-custom table-vertical-center table-borderless">
                <thead>
                    <tr class="text-left text-muted text-uppercase tracking-wider">
                        <th style="min-width: 80px">Réf</th>
                        <th style="min-width: 200px">Nom</th>
                        <th style="min-width: 150px">Responsable</th>
                        <th style="min-width: 150px">Région</th>
                        <th class="text-right" style="min-width: 130px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($grosistes as $grosiste): ?>
                    <tr>
                        <!-- REF PILL -->
                        <td>
                            <span class="badge badge-light-purple font-weight-bold font-size-sm">
                                #<?php echo h($grosiste['Grosiste']['id']); ?>
                            </span>
                        </td>
                        
                        <!-- NAME -->
                        <td class="text-dark font-weight-bolder font-size-lg">
                            <?php echo h($grosiste['Grosiste']['name']); ?>
                        </td>
                        
                        <!-- MANAGER -->
                        <td class="text-muted font-weight-bold font-size-sm">
                            <?php echo $this->requestAction('/users/system_get_name_user/'.$grosiste['Grosiste']['super_id']); ?>
                        </td>
                        
                        <!-- REGION PILL -->
                        <td>
                            <span class="label label-lg label-light-region label-inline font-weight-bold">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:5px; vertical-align:-2px;">
                                    <path d="M12 21s7-6.5 7-11.5A7 7 0 0 0 5 9.5C5 14.5 12 21 12 21z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="9.5" r="2" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <?php echo h($grosiste['Grosiste']['region']); ?>
                            </span>
                        </td>
                        
                        <!-- BUTTON ACTIONS CELL -->
                        <td class="text-right pr-0">
                            <div class="d-flex justify-content-end align-items-center row-actions-wrapper">
                                <?php if ($this->requestAction('/droits/getrole/grosistes/view') == 1): ?>
                                    <?php echo $this->Html->link(
                                        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>',
                                        array('action' => 'view', $grosiste['Grosiste']['id']),
                                        array('class' => "btn btn-icon btn-action-view btn-sm mx-1", 'escape' => false, 'title' => 'Voir')
                                    ); ?>
                                <?php endif; ?>
                                
                                <?php if ($this->requestAction('/droits/getrole/grosistes/edit') == 1): ?>
                                    <?php echo $this->Html->link(
                                        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                        array('action' => 'edit', $grosiste['Grosiste']['id']),
                                        array('class' => "btn btn-icon btn-action-edit btn-sm mx-1", 'escape' => false, 'title' => 'Editer')
                                    ); ?>
                                <?php endif; ?>
                                
                                <?php if ($this->requestAction('/droits/getrole/grosistes/archive') == 1): ?>
                                    <?php echo $this->Html->link(
                                        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="4" rx="1" stroke="currentColor" stroke-width="2"/><path d="M5 8v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8M10 13h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                                        array('action' => 'archive', $grosiste['Grosiste']['id'], 0),
                                        array('class' => "btn btn-icon btn-action-archive btn-sm mx-1", 'escape' => false, 'title' => 'Archive')
                                    ); ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* ===== METRONIC DESIGN OVERRIDE ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.card.card-custom, .table, th, td, h3, span, label, a { font-family: 'Poppins', sans-serif !important; }

/* Main Card Wrapper */
.card.card-custom {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.75rem !important;
    box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.03) !important;
    margin-bottom: 2rem;
}

/* Header Config */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #F1F1F4 !important;
    background: transparent !important;
}
.symbol.symbol-light-primary .symbol-label { 
    background-color: #F6F4FE !important; 
    color: #7239EA !important; 
}

/* ===== TOOLBAR BUTTONS & HOVERS (MATCHED VIBE) ===== */
.btn-primary-lavender { 
    background-color: #7239EA !important; 
    color: #ffffff !important; 
    border: none !important;
    border-radius: 0.55rem !important;
    transition: all 0.2s ease !important;
}
.btn-primary-lavender:hover { 
    background-color: #5825cb !important; 
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(114, 57, 234, 0.2) !important;
}

.btn-global-stats { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
    border: none !important;
    border-radius: 0.55rem !important;
    transition: all 0.2s ease !important;
}
.btn-global-stats:hover { 
    background-color: #7239EA !important; 
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(114, 57, 234, 0.15) !important;
}

/* Table Structural Setup */
.table.table-head-custom thead th {
    font-size: 0.82rem !important;
    font-weight: 600 !important;
    color: #B5B5C3 !important;
    border: none !important;
    padding: 1.1rem 0.75rem !important;
    background-color: transparent !important;
}
.table tbody tr {
    border-bottom: 1px solid #F1F1F4 !important;
    transition: background-color 0.15s ease;
}
.table tbody tr:hover { background-color: #F9F9FA !important; }
.table tbody td {
    padding: 1.25rem 0.75rem !important;
    vertical-align: middle !important;
    border: none !important;
}

/* Custom Pilling Components */
.badge-light-purple { 
    background-color: #F6F4FE !important; 
    color: #7239EA !important; 
    padding: 0.45rem 0.75rem; 
    border-radius: 0.5rem; 
}
.label.label-light-region { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
    border-radius: 0.5rem;
    padding: 0.45rem 0.75rem;
}

/* Action Table Buttons & Modern Hovers */
.row-actions-wrapper .btn-icon {
    width: 34px !important;
    height: 34px !important;
    border-radius: 0.5rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: none !important;
    transition: all 0.2s ease !important;
}

.btn-action-view { background-color: #F3EFFF !important; color: #7239EA !important; }
.btn-action-view:hover { background-color: #7239EA !important; color: #ffffff !important; }

.btn-action-edit { background-color: #FFF8DD !important; color: #FFC700 !important; }
.btn-action-edit:hover { background-color: #FFC700 !important; color: #ffffff !important; }

.btn-action-archive { background-color: #FFF5F8 !important; color: #F1416C !important; }
.btn-action-archive:hover { background-color: #F1416C !important; color: #ffffff !important; }

/* Clean DataTables Defaults */
.dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 0.5rem !important; }
</style>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<script>
    $(function () {
        if ($.fn.DataTable) {
            $('#example1').DataTable({
                "paging": true,
                "pageLength": 100,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Traitement en cours...",
                    "sSearch":         "Rechercher&nbsp;:",
                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix":    "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst":      "Premier",
                        "sPrevious":   "Pr&eacute;c&eacute;dent",
                        "sNext":       "Suivant",
                        "sLast":       "Dernier"
                    }
                }
            });
        }
    });
</script>