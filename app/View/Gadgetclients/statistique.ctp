<?php echo $this->Html->css('dataTables.bootstrap');
?>

<style type="text/css">
    :root{
        --accent:#6c5ce7;
        --accent-dark:#5849c2;
        --accent-light:#f1effd;
        --green:#1a9c74;
        --green-light:#e8f8f2;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    .box-body{ overflow: scroll; }
    tfoot{ display: table-header-group; }

    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px; position:relative; overflow:hidden;
    }
    .box:after{
        content:""; position:absolute; left:0; right:0; bottom:0; height:4px;
        background:linear-gradient(90deg, var(--border-color) 0%, var(--accent) 45%, var(--border-color) 45%);
    }
    .box .box-header{ border-bottom:none; padding:0; }
    .box .box-body{ padding:24px; }

    /* ---------- Date range banner ---------- */
    .date-banner{
        display:flex; align-items:center; gap:16px; flex-wrap:wrap;
        background:var(--green-light); border-radius:var(--radius-md);
        padding:20px 24px; margin:24px 24px 0 24px;
    }
    .date-banner .section-icon{
        flex:0 0 auto; width:44px; height:44px; border-radius:var(--radius-sm);
        background:var(--green); color:#fff; display:flex; align-items:center; justify-content:center; font-size:18px;
    }
    .date-banner .date-banner-text{ flex:0 1 auto; font-size:14px; color:var(--text-dark); line-height:1.4; }
    .date-banner .date-banner-text strong{ display:block; font-weight:700; }
    .date-banner form{ display:flex; align-items:center; gap:12px; flex:1 1 auto; margin:0; }
    .date-banner .input-date{
        float:none !important; width:auto !important; flex:1 1 320px; margin:0 !important;
        max-width:420px;
    }
    .date-banner .input-group-addon{ display:none; }
    .date-banner .form-control{
        border:1px solid var(--border-color) !important;
        border-radius:var(--radius-sm) !important;
        background:#fff !important; box-shadow:none !important; min-height:44px; font-size:14px;
        padding:10px 16px 10px 40px !important; cursor:pointer;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231a9c74' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E") !important;
        background-repeat:no-repeat !important; background-position:left 14px center !important; background-size:15px !important;
    }
    .date-banner .form-control:focus,
    .date-banner .form-control.lb-range-input-open{ border-color:var(--green) !important; box-shadow:0 0 0 3px rgba(26,156,116,.14) !important; }
    .btn-date-submit{
        background:var(--green) !important; border:none !important; color:#fff !important;
        border-radius:var(--radius-sm) !important; padding:11px 22px !important; font-weight:600;
        font-size:14px; box-shadow:0 3px 10px rgba(26,156,116,0.3) !important; cursor:pointer;
    }
    .btn-date-submit:after{ font-family:"FontAwesome"; content:"\f061"; margin-left:8px; }
    .btn-date-submit:hover{ background:#158564 !important; }

    /* ---------- Section heading ---------- */
    .list-heading{ display:flex; align-items:center; gap:16px; margin:28px 24px 18px 24px; }
    .list-heading .section-icon{
        width:52px; height:52px; border-radius:50%; background:var(--accent-light); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:21px; flex:0 0 auto;
    }
    .list-heading h3.box-title{
        margin:0; font-size:26px; font-weight:800; color:var(--text-dark); position:relative; padding-bottom:10px;
    }
    .list-heading h3.box-title .accent{ color:var(--green); }
    .list-heading h3.box-title:after{
        content:""; position:absolute; left:0; bottom:0; width:70px; height:3px;
        background:linear-gradient(90deg, var(--border-color) 0%, var(--border-color) 45%, var(--accent) 45%, var(--accent) 100%);
        border-radius:2px;
    }

    /* ---------- Toolbar ---------- */
    .table-toolbar{ display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; padding:0 24px 16px 24px; }
    .dt-buttons{ display:flex; gap:10px; }
    .dt-button.buttons-excel{
        display:inline-flex !important; align-items:center; gap:8px;
        background:var(--green-light) !important; color:var(--green) !important;
        border:1px solid #cdeee1 !important; border-radius:var(--radius-sm) !important;
        padding:11px 18px !important; font-weight:700 !important; font-size:14px !important; box-shadow:none !important;
    }
    .dt-button.buttons-excel:hover{ background:#d8f4e9 !important; }
    .table-toolbar .dataTables_filter{ margin:0 !important; }
    .table-toolbar .dataTables_filter label{ display:flex !important; align-items:center; margin:0; }
    .table-toolbar .dataTables_filter input{
        border:1px solid var(--accent) !important; border-radius:20px !important;
        padding:9px 16px 9px 34px !important; min-width:230px;
        background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%236c5ce7' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 12px center;
        background-size:14px 14px; font-size:13.5px !important;
    }

    /* ---------- Table ---------- */
    #example1{ width:100% !important; border-collapse:separate !important; border-spacing:0; margin:0 24px 0 24px; width:calc(100% - 48px) !important; }
    #example1 thead th{
        background:var(--accent-light) !important; color:var(--text-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:13px 14px !important; white-space:nowrap;
    }
    #example1.dataTable thead .sorting:after,
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--text-muted); opacity:.55; }
    #example1.dataTable thead .sorting_asc:after,
    #example1.dataTable thead .sorting_desc:after{ color:var(--accent); opacity:1; }

    /* per-column search row (built from tfoot, displayed as second header row) */
    #example1 tfoot th{
        background:#fff !important; border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:10px 14px !important;
    }
    #example1 tfoot input{
        width:100%; border:1px solid var(--border-color); border-radius:20px;
        padding:7px 14px 7px 30px; font-size:12.5px; font-weight:400; color:var(--text-dark);
        background:var(--accent-light) url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 10px center;
        background-size:12px 12px;
    }
    #example1 tfoot input:focus{ border-color:var(--accent); background-color:#fff; outline:none; }

    #example1 tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:13px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    #example1.table-striped tbody tr:nth-of-type(odd){ background:#fcfbff; }
    #example1 tbody tr:hover td{ background:var(--accent-light); }
    #example1 tbody tr:last-child td{ border-bottom:none !important; }
    #example1 a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    #example1 a:hover{ color:var(--accent); text-decoration:underline; }

    /* ---------- Empty state ---------- */
    #example1 .dataTables_empty{ padding:56px 20px !important; text-align:center; border:none !important; }
    .dt-empty-state{ display:flex; flex-direction:column; align-items:center; gap:8px; color:var(--text-muted); }
    .dt-empty-state .dt-empty-icon{
        width:60px; height:60px; border-radius:50%; background:var(--accent-light); color:var(--accent);
        display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:4px;
    }
    .dt-empty-state .dt-empty-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }

    /* ---------- Footer / pagination ---------- */
    .table-footer{ display:flex; align-items:center; justify-content:space-between; padding:14px 24px 20px 24px; flex-wrap:wrap; gap:10px; }
    .dataTables_wrapper .dataTables_info{ color:var(--text-muted) !important; font-size:13px !important; padding:0 !important; }
    .dataTables_wrapper .dataTables_info b{ color:var(--text-dark); }
    .dataTables_wrapper .dataTables_paginate{ margin:0 !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 12px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important; min-width:34px; text-align:center;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ color:var(--text-muted) !important; opacity:.5; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled){
        background:var(--accent-light) !important; color:var(--accent) !important; border-color:var(--accent) !important;
    }

    /* ==========================================================================
       Self-contained "lb-range" date range picker (green accent, matching the
       "date-banner" section). Replaces bootstrap-daterangepicker + moment.js
       + the reloaded jquery-2.2.3.min: reloading jQuery here is the same
       conflict that broke calendars/select2 on the other restyled pages in
       this project. Plain JS, no dependency, clamped to the viewport.
       ========================================================================== */
    .lb-range-popup{ position:fixed; z-index:999999; background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-md);
        box-shadow:0 16px 40px rgba(45,43,66,.16), 0 4px 14px rgba(16,24,40,.06); padding:18px; font-family:inherit; user-select:none; }
    .lb-range-panels{ display:flex; gap:24px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:var(--border-color); }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .lb-range-nav{ border:none; background:var(--green-light); color:var(--green); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:#d3f0e4; }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--green); text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:var(--text-dark); cursor:pointer; }
    .lb-range-day:hover{ background:var(--green-light); }
    .lb-range-day.other-month{ color:#cac7dc; opacity:.6; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--green); }
    .lb-range-day.in-range{ background:var(--accent-light); border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:var(--green) !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; align-items:center; justify-content:space-between; margin-top:14px; border-top:1px solid var(--border-color); padding-top:12px; }
    .lb-range-preview{ font-size:12.5px; color:var(--text-muted); font-weight:500; }
    .lb-range-clear-btn{ border:none; background:none; color:var(--text-muted); font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:var(--accent-light); }
    .lb-range-apply-btn{ border:none; background:var(--green); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:8px 18px; border-radius:999px; box-shadow:0 4px 14px rgba(26,156,116,.28); }
    .lb-range-apply-btn:hover{ background:#158564; }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="date-banner">
                    <span class="section-icon"><i class="fa fa-clock-o"></i></span>
                    <div class="date-banner-text">
                        Pour des statistiques d'une période précise,
                        <strong>veuillez sélectionner une date :</strong>
                    </div>
                    <?php echo $this->Form->create('Client'); ?>
                    <div class="input-group input-date">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" readonly <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher">
                    </div>
                    <input type="submit" class="btn btn-success btn-date-submit">
                    </form>
                </div>
            </div>
            <div class="list-heading">
                <span class="section-icon"><i class="fa fa-users"></i></span>
                <h3 class="box-title">Liste <span class="accent">des clients</span></h3>
            </div>
            <div class="box-body" style="padding-top:0;">
                <div class="table-toolbar">
                    <div class="dt-buttons-slot"></div>
                    <div class="dataTables_filter_slot"></div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>VM</th>
                            <th>Client</th>
                            <th>Spécialité</th>
                            <th>Secteur</th>
                            <th>POT</th>
                            <th>Gadget</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>VM</th>
                            <th>Client</th>
                            <th>Spécialité</th>
                            <th>Secteur</th>
                            <th>POT</th>
                            <th>Gadget</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <?php
                    foreach ($gadgetclients as $g):  ?>
                        <tr >
                            <td><?php echo $g["User"]["name"]; ?></td>
                            <td><?php echo $this->Html->link($g["Client"]['nom'],array("controller"=>"clients","action"=>"view",$g["Client"]['id'])); ?></td>
                            <td><?php echo $categories[$g["Client"]["category_id"]]; ?></td>
                            <td><?php echo $secteurs[$g["Client"]["secteur_id"]]; ?></td>
                            <td><?php echo $g["Client"]['potentialite']; ?></td>
                            <td><?php echo $g["Gadgetclient"]['name']; ?></td>
                            <td><?php echo $g["Gadgetclient"]['quantite']; ?></td>
                            <td><?php echo $g["Gadgetclient"]['created']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>

<!-- NOTE: jquery-2.2.3.min, moment.js, bootstrap-daterangepicker (JS+CSS),
     buttons.flash and the rawgit-hosted pdfmake/vfs_fonts have all been
     removed on purpose:
       - jquery-2.2.3.min reloaded jQuery on top of whatever instance the
         rest of the theme already attached to, which is the same conflict
         that broke calendars/select2 on the other restyled pages here.
       - buttons.flash and pdfmake/vfs_fonts are dead weight: only the
         'excel' button is configured below, and cdn.rawgit.com has been
         shut down for years anyway (those two <script> tags 404 silently).
     Kept: dataTables.buttons + jszip + buttons.html5, which is everything
     the Excel export actually needs. -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

<script>
(function ($) {
        var table = $("#example1").DataTable({
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<input type="text" placeholder="Recherche"/>')
                        .appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            },
            "paging": true,
            "pagingType": "full_numbers",
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'B<"table-toolbar-inner">frt<"table-footer"ip>',
            language: {
                emptyTable: '<div class="dt-empty-state"><span class="dt-empty-icon"><i class="fa fa-inbox"></i></span><div class="dt-empty-title">Aucune donnée disponible dans le tableau</div></div>'
            },
            buttons: [
                { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Excel' }
            ]
        });
        // move the generated export buttons and search box into the styled toolbar row
        $('.dt-buttons').detach().appendTo('.dt-buttons-slot');
        $('#example1_filter').detach().appendTo('.dataTables_filter_slot');
})(jQuery);
</script>

<script>
    (function () {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }

        function formatToken(d, fmt) {
            fmt = fmt || 'YYYY-MM-DD';
            return fmt
                .replace('YYYY', d.getFullYear())
                .replace('MM', pad2(d.getMonth() + 1))
                .replace('DD', pad2(d.getDate()));
        }
        function momentLike(d) {
            return {
                format: function (fmt) { return formatToken(d, fmt); },
                toString: function () { return formatISO(d); }
            };
        }

        function parseRangeValue(val) {
            if (!val) return { start: null, end: null };
            var parts = val.split(' -- ');
            var toDate = function (s) {
                var p = (s || '').trim().split('-');
                if (p.length !== 3) return null;
                var d = new Date(parseInt(p[0], 10), parseInt(p[1], 10) - 1, parseInt(p[2], 10));
                return isNaN(d.getTime()) ? null : d;
            };
            return { start: toDate(parts[0]), end: toDate(parts[1]) };
        }

        function LBRangePicker(input) {
            this.input = input;
            var parsed = parseRangeValue(input.value);
            this.start = parsed.start;
            this.end = parsed.end;
            this.viewDate = this.start ? new Date(this.start) : new Date();
            this.popup = null;
            this._outsideHandler = null;
            this._reflowHandler = null;
            this.bind();
        }

        LBRangePicker.prototype.bind = function () {
            var self = this;
            this.input.addEventListener('click', function (e) {
                e.stopPropagation();
                if (self.popup) self.close(); else self.open();
            });
        };

        LBRangePicker.prototype.open = function () {
            var self = this;
            this.popup = document.createElement('div');
            this.popup.className = 'lb-range-popup';
            this.popup.style.left = '-9999px';
            this.popup.style.top = '-9999px';
            document.body.appendChild(this.popup);
            this.input.classList.add('lb-range-input-open');
            this.render();
            this.position();
            this._outsideHandler = function (e) { if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) self.close(); };
            this._reflowHandler = function () { self.position(); };
            setTimeout(function () {
                document.addEventListener('click', self._outsideHandler);
                window.addEventListener('resize', self._reflowHandler);
                window.addEventListener('scroll', self._reflowHandler, true);
            }, 0);
        };

        LBRangePicker.prototype.position = function () {
            if (!this.popup) return;
            var margin = 10;
            var rect = this.input.getBoundingClientRect();
            var popupWidth = this.popup.offsetWidth || 560;
            var popupHeight = this.popup.offsetHeight || 380;

            var left = rect.left;
            if (left + popupWidth > window.innerWidth - margin) left = window.innerWidth - popupWidth - margin;
            if (left < margin) left = margin;

            var top = rect.bottom + 6;
            if (top + popupHeight > window.innerHeight - margin && rect.top - popupHeight - 6 > margin) {
                top = rect.top - popupHeight - 6;
            }
            if (top < margin) top = margin;

            this.popup.style.left = left + 'px';
            this.popup.style.top = top + 'px';
        };

        LBRangePicker.prototype.close = function () {
            if (this.popup) { this.popup.parentNode.removeChild(this.popup); this.popup = null; }
            this.input.classList.remove('lb-range-input-open');
            if (this._outsideHandler) { document.removeEventListener('click', this._outsideHandler); this._outsideHandler = null; }
            if (this._reflowHandler) {
                window.removeEventListener('resize', this._reflowHandler);
                window.removeEventListener('scroll', this._reflowHandler, true);
                this._reflowHandler = null;
            }
        };

        LBRangePicker.prototype.updateInputText = function () {
            if (this.start && this.end) this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.end);
            else if (this.start) this.input.value = formatISO(this.start) + ' -- ' + formatISO(this.start);
            else this.input.value = '';
            this.input.dispatchEvent(new Event('change'));
        };

        // Compatibility shim for the existing apply.daterangepicker handler
        // (kept below for parity with the original code, even though that
        // handler targets a #dateform id this form doesn't actually have —
        // the real submission on this page happens via the visible
        // "Submit" button, which needs no JS at all).
        LBRangePicker.prototype.applyCompat = function () {
            if (!this.start) return;
            var start = this.start;
            var end = this.end || this.start;
            var picker = { startDate: momentLike(start), endDate: momentLike(end) };
            if (window.jQuery) {
                window.jQuery(this.input).trigger('apply.daterangepicker', [picker]);
            }
        };

        LBRangePicker.prototype.renderPanel = function (year, month, showPrev, showNext) {
            var self = this;
            var today = stripTime(new Date());
            var html = '<div class="lb-range-panel"><div class="lb-range-header">';
            html += '<button type="button" class="lb-range-nav' + (showPrev ? '' : ' lb-range-nav-hidden') + '" data-nav="prev">&#8249;</button>';
            html += '<span class="lb-range-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
            html += '<button type="button" class="lb-range-nav' + (showNext ? '' : ' lb-range-nav-hidden') + '" data-nav="next">&#8250;</button></div>';
            html += '<div class="lb-range-weekdays">';
            WEEKDAYS.forEach(function (w) { html += '<span>' + w + '</span>'; });
            html += '</div><div class="lb-range-grid">';

            var firstDay = new Date(year, month, 1);
            var startOffset = (firstDay.getDay() + 6) % 7;
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var daysInPrevMonth = new Date(year, month, 0).getDate();
            var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

            for (var i = 0; i < totalCells; i++) {
                var dayNum, cellDate, otherMonth = false;
                if (i < startOffset) { dayNum = daysInPrevMonth - startOffset + i + 1; cellDate = new Date(year, month - 1, dayNum); otherMonth = true; }
                else if (i >= startOffset + daysInMonth) { dayNum = i - startOffset - daysInMonth + 1; cellDate = new Date(year, month + 1, dayNum); otherMonth = true; }
                else { dayNum = i - startOffset + 1; cellDate = new Date(year, month, dayNum); }

                var classes = ['lb-range-day'];
                if (otherMonth) classes.push('other-month');
                if (sameDay(cellDate, today)) classes.push('today');
                if (sameDay(cellDate, self.start)) classes.push('range-start');
                if (sameDay(cellDate, self.end)) classes.push('range-end');
                if (self.start && self.end && cellDate > self.start && cellDate < self.end) classes.push('in-range');
                html += '<button type="button" class="' + classes.join(' ') + '" data-date="' + formatISO(cellDate) + '">' + dayNum + '</button>';
            }
            html += '</div></div>';
            return html;
        };

        LBRangePicker.prototype.render = function () {
            var self = this;
            var leftYear = this.viewDate.getFullYear();
            var leftMonth = this.viewDate.getMonth();
            var rightRef = new Date(leftYear, leftMonth + 1, 1);

            var preview = (this.start ? formatISO(this.start) : '…') + ' -- ' + (this.end ? formatISO(this.end) : (this.start ? formatISO(this.start) : '…'));

            var html = '<div class="lb-range-panels">';
            html += this.renderPanel(leftYear, leftMonth, true, false);
            html += '<div class="lb-range-divider"></div>';
            html += this.renderPanel(rightRef.getFullYear(), rightRef.getMonth(), false, true);
            html += '</div><div class="lb-range-footer">';
            html += '<span class="lb-range-preview">' + preview + '</span>';
            html += '<span><button type="button" class="lb-range-clear-btn" data-action="clear">Annuler</button>';
            html += '<button type="button" class="lb-range-apply-btn" data-action="apply">Valider</button></span></div>';
            this.popup.innerHTML = html;

            var navBtns = this.popup.querySelectorAll('[data-nav]');
            for (var n = 0; n < navBtns.length; n++) {
                navBtns[n].addEventListener('click', function (e) {
                    e.stopPropagation();
                    self.viewDate.setMonth(self.viewDate.getMonth() + (this.getAttribute('data-nav') === 'next' ? 1 : -1));
                    self.render();
                    self.position();
                });
            }

            var dayBtns = this.popup.querySelectorAll('.lb-range-day');
            for (var d = 0; d < dayBtns.length; d++) {
                dayBtns[d].addEventListener('click', function (e) {
                    e.stopPropagation();
                    var p = this.getAttribute('data-date').split('-');
                    var picked = new Date(parseInt(p[0], 10), parseInt(p[1], 10) - 1, parseInt(p[2], 10));
                    if (!self.start || (self.start && self.end)) { self.start = picked; self.end = null; }
                    else if (picked < self.start) { self.end = self.start; self.start = picked; }
                    else self.end = picked;
                    self.render();
                    self.position();
                });
            }

            var clearBtn = this.popup.querySelector('[data-action="clear"]');
            if (clearBtn) clearBtn.addEventListener('click', function (e) { e.stopPropagation(); self.start = null; self.end = null; self.updateInputText(); self.close(); });

            var applyBtn = this.popup.querySelector('[data-action="apply"]');
            if (applyBtn) applyBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                self.updateInputText();
                self.applyCompat();
                self.close();
            });
        };

        function initRangePicker() {
            var el = document.getElementById('reservationtime');
            if (el && !el._lbRangeBound) { el._lbRangeBound = true; new LBRangePicker(el); }
        }
        document.addEventListener('DOMContentLoaded', initRangePicker);
        if (document.readyState === 'interactive' || document.readyState === 'complete') initRangePicker();
    })();
</script>
