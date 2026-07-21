<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<!-- JS: load jQuery ONLY if the layout doesn't already provide it (avoids double-jQuery conflicts) -->
<script>
if (typeof jQuery === 'undefined') {
    document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"><\/script>');
}
</script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // IMPORTANT: Metronic's own plugins.bundle.js / scripts.bundle.js ship a bundled copy
    // of jQuery and silently reassign window.jQuery / window.$ later in the page.
    // We snapshot OUR jQuery instance right now, while it still has FullCalendar, DataTables
    // and Select2 attached, and use this private reference below instead of the global $,
    // so nothing that loads after us (Metronic's bundles) can break our plugins.
    window.CRMJQ = jQuery;
</script>

<!-- DataTables buttons -->
<script src="//cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
/* ================== METRONIC RESTYLE (CSS only — PHP/JS logic untouched) ================== */
.abs-wrapper{
	--bs-primary: #6C63F5;
	--bs-primary-rgb: 108, 99, 245;
	--abs-purple: #6C63F5;
	--abs-purple-dark: #5750d9;
	--abs-purple-soft: #EEECFE;
	--abs-text: #2c2e3a;
	--abs-muted: #8a8fa3;
	--abs-border: #ececf5;
}

.abs-card{
	border: 1px solid var(--abs-border);
	border-radius: 14px;
	box-shadow: 0 4px 14px rgba(108,99,245,.07);
	background: #fff;
}
.abs-card .card-header{
	min-height: auto;
	padding: 14px 18px;
	background: transparent;
	border-bottom: 1px solid var(--abs-border);
}
.abs-card .card-title{
	font-size: 14px;
	font-weight: 700;
	color: var(--abs-text);
	margin: 0;
}
.abs-card .card-body{ padding: 16px 18px; }
.abs-card .card-body.d-flex{ gap: 10px; }

/* legend pills */
.abs-wrapper .legend{ display: flex; flex-wrap: wrap; gap: 8px; }
.abs-wrapper .legend .abs-legend-badge{
	display: inline-block;
	max-width: 240px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
	padding: 6px 14px;
	border-radius: 999px;
	color: #fff;
	font-size: 12px;
	font-weight: 600;
	line-height: 1.3;
	box-shadow: 0 2px 6px rgba(0,0,0,.08);
	cursor: default;
}

/* action / filter buttons */
.abs-wrapper .btn-primary{
	background: var(--abs-purple);
	border-color: var(--abs-purple);
	border-radius: 8px;
	font-weight: 500;
}
.abs-wrapper .btn-primary:hover{
	background: var(--abs-purple-dark);
	border-color: var(--abs-purple-dark);
}

/* ===== Select2 (Metronic-proof, high specificity) ===== */
.abs-wrapper .select2-container{ width: 100% !important; }
.abs-wrapper .select2-container .select2-selection,
.abs-wrapper .select2-container--default .select2-selection--multiple{
	border: 1px solid var(--abs-border) !important;
	border-radius: 10px !important;
	min-height: 42px;
	padding: 4px 6px;
	box-shadow: none !important;
}
.abs-wrapper .select2-container--default.select2-container--focus .select2-selection--multiple,
.abs-wrapper .select2-container--default .select2-selection--multiple:focus-within{
	border-color: var(--abs-purple) !important;
}
.abs-wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice{
	background: var(--abs-purple-soft) !important;
	border: 1px solid var(--abs-purple-soft) !important;
	color: var(--abs-purple-dark) !important;
	border-radius: 6px !important;
	padding: 3px 8px 3px 22px !important;
	font-size: 12.5px;
	font-weight: 600;
	margin-top: 4px;
}
.abs-wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
	color: var(--abs-purple-dark) !important;
	border: none !important;
	margin-right: 4px;
}
.abs-wrapper .select2-dropdown{
	border: 1px solid var(--abs-border) !important;
	border-radius: 10px !important;
	box-shadow: 0 8px 24px rgba(108,99,245,.15) !important;
	overflow: hidden;
}
.abs-wrapper .select2-results__option--highlighted[aria-selected]{
	background: var(--abs-purple) !important;
}
.abs-wrapper .select2-search--dropdown .select2-search__field{
	border: 1px solid var(--abs-border) !important;
	border-radius: 8px !important;
	padding: 6px 10px !important;
}

/* calendar card */
.abs-wrapper #calendar{
	height: 650px;
	min-height: 650px;
}

/* ===== FullCalendar toolbar, Metronic-proof purple theme ===== */
.abs-wrapper .fc{ font-family: inherit; }
.abs-wrapper .fc-toolbar.fc-header-toolbar{
	margin-bottom: 18px;
	flex-wrap: wrap;
	gap: 10px;
	padding: 4px 2px;
}
.abs-wrapper .fc-toolbar h2{
	font-size: 18px;
	font-weight: 700;
	color: var(--abs-text) !important;
	text-transform: capitalize;
}
.abs-wrapper .fc-button,
.abs-wrapper .fc-button.fc-corner-left,
.abs-wrapper .fc-button.fc-corner-right{
	background: #fff !important;
	background-image: none !important;
	border: 1px solid var(--abs-border) !important;
	color: var(--abs-text) !important;
	text-shadow: none !important;
	box-shadow: none !important;
	border-radius: 8px !important;
	font-weight: 500;
	font-size: 13px;
	text-transform: capitalize;
	padding: 7px 14px;
	height: auto;
	line-height: 1.3;
}
.abs-wrapper .fc-button:hover{
	background: var(--abs-purple-soft) !important;
	color: var(--abs-purple-dark) !important;
	border-color: var(--abs-purple-soft) !important;
}
.abs-wrapper .fc-button.fc-state-active,
.abs-wrapper .fc-button.fc-state-down,
.abs-wrapper .fc-button.fc-state-active:hover{
	background: var(--abs-purple) !important;
	background-image: none !important;
	border-color: var(--abs-purple) !important;
	color: #fff !important;
}
.abs-wrapper .fc-button-group{ display: inline-flex; }
.abs-wrapper .fc-button-group .fc-button{ margin: 0 3px; }
.abs-wrapper .fc-state-disabled{ opacity: .45; }

.abs-wrapper .fc-view-container{
	border-radius: 12px;
	overflow: hidden;
	border: 1px solid var(--abs-border);
}
.abs-wrapper .fc-widget-header{
	background: #faf9ff !important;
	border-color: var(--abs-border) !important;
}
.abs-wrapper thead .fc-day-header{
	padding: 10px 4px;
	font-size: 12px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: .03em;
	color: var(--abs-muted);
}
.abs-wrapper .fc-widget-content{ border-color: var(--abs-border) !important; }
.abs-wrapper .fc-day-number{
	font-size: 12.5px;
	color: var(--abs-text);
	padding: 6px 8px !important;
	font-weight: 600;
}
.abs-wrapper .fc-day-grid-container,
.abs-wrapper .fc-day-grid{ background: #fff; }
.abs-wrapper .fc-other-month{ background: #fbfaff; }
.abs-wrapper .fc-other-month .fc-day-number{ color: var(--abs-muted); opacity: .6; }
.abs-wrapper .fc-today{ background: var(--abs-purple-soft) !important; }
.abs-wrapper .fc-today .fc-day-number{
	background: var(--abs-purple);
	color: #fff;
	border-radius: 50%;
	width: 24px; height: 24px;
	display: inline-flex; align-items: center; justify-content: center;
	padding: 0 !important;
}
.abs-wrapper .fc-event, .abs-wrapper .fc-day-grid-event{
	background: var(--abs-purple);
	border: none;
	border-radius: 6px;
	padding: 3px 7px;
	font-weight: 600;
	font-size: 11.5px;
	margin: 2px 4px;
}
.abs-wrapper .fc-event:hover{ filter: brightness(0.92); }
.abs-wrapper .fc-time{ display: none !important; }
.abs-wrapper .fc-more{ color: var(--abs-purple-dark); font-weight: 600; }

/* modals */
.abs-wrapper ~ .modal .modal-content,
.modal .modal-content{ border-radius: 14px; border: none; }
.modal .modal-header{ border-bottom: 1px solid var(--abs-border, #ececf5); }
.modal .modal-title{ font-weight: 700; }
</style>

<div class="abs-wrapper">
    <div class="row g-3">
        <!-- Legend / Actions / Filter -->
        <div class="col-lg-4">

            <div class="card abs-card mb-3">
                <div class="card-header">
                    <h4 class="card-title">Types</h4>
                </div>
                <div class="card-body">
                    <div class="legend">
                        <?php foreach ($colors as $k => $v): ?>
                            <span class="abs-legend-badge" style="background-color:<?= $v ?>;" title="<?= $k ?>"><?= $k ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card abs-card mb-3">
                <div class="card-header">
                    <h4 class="card-title">Actions</h4>
                </div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <?php echo $this->Html->link('Ajouter une activité', ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']); ?>
                    <button id="btn_show_table" class="btn btn-primary btn-sm">Afficher les absences</button>
                </div>
            </div>

            <div class="card abs-card">
                <div class="card-header">
                    <h4 class="card-title">Filtré par la liste des utilisateurs</h4>
                </div>
                <div class="card-body">
                    <?php echo $this->Form->create(); ?>
                    <div class="d-flex gap-2 align-items-end">
                        <div class="flex-grow-1">
                            <?php echo $this->Form->input("vmp_id", [
                                "type" => "select",
                                'id' => 'filter_user',
                                "options" => $vmps,
                                "multiple" => true,
                                "label" => false,
                                "class" => "form-control select2"
                            ]); ?>
                        </div>
                        <div>
                            <?php echo $this->Form->submit("Filtrer", ['class' => 'btn btn-primary btn-sm', 'div' => false]); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>

        <!-- Calendar -->
        <div class="col-lg-8">
            <div class="card abs-card">
                <div class="card-body p-2">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal détail absence -->
<div class="modal fade" id="popup_view" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Collaborateur: <span id="user"></span></p>
                <p>Type: <span id="type_m"></span></p>
                <p>Description: <span id="description"></span></p>
                <p>Date d’arrêt de travail: <span id="date_debut"></span></p>
                <p>Date de reprise de travail: <span id="date_fin"></span></p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary ml-auto" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal table absences -->
<div class="modal fade" id="modal_table" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Absences</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <table id="table_absences" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>VMP</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Jour</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="modal-footer justify-content-end">

            </div>

        </div>

    </div>
</div>

<script>
    CRMJQ(function() {

        var absences = <?php echo json_encode($absences); ?>;
        console.log('Absences:', absences);

        // Works whether the layout loads Bootstrap 5's vanilla JS (bootstrap.Modal)
        // or still exposes the older jQuery .modal() plugin.
        function showModal(id) {
            var el = document.getElementById(id);
            if (window.bootstrap && bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(el).show();
            } else if (typeof CRMJQ(el).modal === 'function') {
                CRMJQ(el).modal();
            }
        }

        // FullCalendar
        CRMJQ('#calendar').fullCalendar({
            locale: 'fr', // ← French language
            height: 650, // explicit height: without it, FullCalendar can compute
                          // a 0px container size on first render and show nothing
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: absences,
            editable: false,
            eventClick: function(e) {
                CRMJQ('#user').text(e.user);
                CRMJQ('#type_m').text(e.type);
                CRMJQ('#description').text(e.description);
                CRMJQ('#date_debut').text(e.date_debut);
                CRMJQ('#date_fin').text(e.date_fin);
                CRMJQ('#jour').text(e.jour);
                showModal('popup_view');
            }
        });

        // DataTables + Select2
        var table = CRMJQ('#table_absences').DataTable({
            dom: 'Bfrtip',
            searching: true,
            sort : false,
            buttons: [{
                extend: 'excelHtml5',
                text: 'Exporter Excel',
                className: 'btn btn-success btn-sm mr-2'
            }]
        });

        CRMJQ('#filter_user').select2();



        // Afficher modal table
        CRMJQ('#btn_show_table').click(function() {
            var tbody = '';
            absences.forEach(function(a) {
                // 👇 on ignore si type = Jour férié
                if (a.type === "Jour férié") {
                    return; // skip this iteration
                }

                tbody += '<tr>' +
                    '<td>' + a.user + '</td>' +
                    '<td>' + a.title + '</td>' +
                    '<td>' + a.type + '</td>' +
                    '<td>' + a.description + '</td>' +
                    '<td>' + a.date_debut + '</td>' +
                    '<td>' + (a.date_fin ?? '') + '</td>' +
                    '<td>' + a.jour + '</td>' +
                    '<td>';
                <?php if (AuthComponent::user("role") === "Admin") { ?>
                    tbody += '<a href="<?php echo $this->Html->url(array("action" => "edit")); ?>/' + a.id + '">Modifier </a>' +
                        '<a href="<?php echo $this->Html->url(array("action" => "supprimer")); ?>/' + a.id + '"> Supprimer</a>';
                <?php } ?>
                tbody += '</td>' +
                    '</tr>';
            });

            table.clear().rows.add(CRMJQ(tbody)).draw();
            showModal('modal_table');
        });

    });
</script>
