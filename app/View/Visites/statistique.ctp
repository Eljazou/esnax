<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

// ---------------------------------------------------------------------
// Build the list of months (Y-m) between $date_debut and $date_fin
// ---------------------------------------------------------------------
$months = array();
$cursor = $date_debut;
while ($cursor <= $date_fin) {
    $months[] = date('Y-m', strtotime($cursor));
    $cursor   = date('Y-m-d', strtotime('+1 month', strtotime($cursor)));
}

// Human-readable label for each month (used as array key everywhere)
$monthLabels = array();
foreach ($months as $m) {
    $monthLabels[$m] = date('F', strtotime($m . '-01'));
}

// ---------------------------------------------------------------------
// Categories tracked per month. Each key below becomes one dataset.
// ---------------------------------------------------------------------
$potentialiteKeys = array('A1', 'A2', 'A3', 'A4', 'B1', 'B2', 'B3', 'B4', 'C1', 'C2', 'C3', 'C4', 'NR');
$partenaireKeys    = array('bien', 'moyen', 'faible');
$concurrenceKeys   = array(100, 50, '-+');

$stats = array(
    'visites'      => array_fill_keys($monthLabels, 0),
    'potentialite' => array(),
    'partenaires'  => array(),
    'concurrence'  => array(),
);
foreach ($potentialiteKeys as $k) $stats['potentialite'][$k] = array_fill_keys($monthLabels, 0);
foreach ($partenaireKeys as $k)   $stats['partenaires'][$k]  = array_fill_keys($monthLabels, 0);
foreach ($concurrenceKeys as $k)  $stats['concurrence'][$k]  = array_fill_keys($monthLabels, 0);

// ---------------------------------------------------------------------
// Tally visits into the buckets above
// ---------------------------------------------------------------------
foreach ($visites as $v) {
    $ym = date('Y-m', strtotime($v['Visite']['date']));
    if (!isset($months[0])) continue;
    if (!in_array($ym, $months)) continue;

    $label = $monthLabels[$ym];
    $stats['visites'][$label]++;

    $pot = $v['Client']['potentialite'];
    if (isset($stats['potentialite'][$pot][$label])) {
        $stats['potentialite'][$pot][$label]++;
    }

    $part = $v['Visite']['partenaires'];
    if (isset($stats['partenaires'][$part][$label])) {
        $stats['partenaires'][$part][$label]++;
    }

    $veille = $v['Visite']['veille'];
    if (isset($stats['concurrence'][$veille][$label])) {
        $stats['concurrence'][$veille][$label]++;
    }
}

$labels = array_values($monthLabels);

// ---------------------------------------------------------------------
// Package everything the JS needs into one JSON payload
// ---------------------------------------------------------------------
$chartPayload = array(
    'labels'       => $labels,
    'visites'      => $stats['visites'],
    'potentialite' => $stats['potentialite'],
    'partenaires'  => $stats['partenaires'],
    'concurrence'  => $stats['concurrence'],
);

// Detail-section definitions: id => [source bucket, key, title, color]
$detailCharts = array(
    array('PCM',   'potentialite', 'A1',    'Visites A1 par mois',    '#6C63F5'),
    array('QAM',   'potentialite', 'A2',    'Visites A2 par mois',    '#db4437'),
    array('PM',    'potentialite', 'A3',    'Visites A3 par mois',    '#cf9900'),
    array('A4',    'potentialite', 'A4',    'Visites A4 par mois',    '#db4437'),
    array('B1',    'potentialite', 'B1',    'Visites B1 par mois',    '#db4437'),
    array('B2',    'potentialite', 'B2',    'Visites B2 par mois',    '#db4437'),
    array('B3',    'potentialite', 'B3',    'Visites B3 par mois',    '#db4437'),
    array('B4',    'potentialite', 'B4',    'Visites B4 par mois',    '#db4437'),
    array('C1',    'potentialite', 'C1',    'Visites C1 par mois',    '#db4437'),
    array('C2',    'potentialite', 'C2',    'Visites C2 par mois',    '#db4437'),
    array('C3',    'potentialite', 'C3',    'Visites C3 par mois',    '#db4437'),
    array('C4',    'potentialite', 'C4',    'Visites C4 par mois',    '#db4437'),
    array('NR',    'potentialite', 'NR',    'Visites NR par mois',    '#0d854b'),
    array('BIEN',  'partenaires',  'bien',  'Visites partenaires BIEN par mois',   '#6C63F5'),
    array('MOYEN', 'partenaires',  'moyen', 'Visites partenaires MOYEN par mois',  '#db4437'),
    array('FAIBLE','partenaires',  'faible','Visites partenaires FAIBLE par mois', '#cf9900'),
    array('CENT',  'concurrence',  100,     'Visites concurrents 100 par mois',    '#6C63F5'),
    array('CINQ',  'concurrence',  50,      'Visites concurrents 50 par mois',     '#db4437'),
    array('PMO',   'concurrence',  '-+',    'Visites concurrents +- par mois',     '#cf9900'),
);

// Detail links: id => [action param, label param]
$detailLinks = array(
    'PCM' => 'A1', 'QAM' => 'A2', 'PM' => 'A3', 'A4' => 'A4',
    'B1' => 'B1', 'B2' => 'B2', 'B3' => 'B3', 'B4' => 'B4',
    'C1' => 'C1', 'C2' => 'C2', 'C3' => 'C3', 'C4' => 'C4', 'NR' => 'NR',
    'BIEN' => 'bien', 'MOYEN' => 'moyen', 'FAIBLE' => 'faible',
    'CENT' => 100, 'CINQ' => 50, 'PMO' => '-+',
);
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
        --text-dark: #2b2b45;
        --text-muted: #8b85c9;
    }
    body, .box, .chart-card, .stat-title { font-family: 'Poppins', sans-serif; }

    .stat-box {
        border: none !important;
        border-radius: 18px !important;
        box-shadow: 0 4px 18px rgba(108, 99, 245, 0.08) !important;
        background: #fff !important;
        overflow: visible;
    }
    .stat-box .box-header {
        border: none !important;
        padding: 22px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .stat-box .box-title { font-size: 19px; font-weight: 700; color: var(--text-dark); margin: 0; }

    .btn-voir-detail {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 20px !important;
        color: #fff !important;
        font-weight: 600 !important;
        font-size: 13px;
        padding: 9px 20px !important;
        box-shadow: 0 4px 12px rgba(108, 99, 245, .28);
        text-decoration: none !important;
        display: inline-block;
    }
    .btn-voir-detail:hover { background: linear-gradient(135deg, #5f56ee, #3f66e6) !important; color: #fff !important; }

    .stat-box .box-body { padding: 4px 26px 26px; }

    /* ---------- date range field (styled input, calendar handled by lb-range widget below) ---------- */
    #dateform .input-group { max-width: 320px; }
    #dateform .input-group-addon {
        display: none; /* icon baked into the input's own background-image instead */
    }
    #dateform #reservationtime {
        border: 1.5px solid #eeecfb !important;
        border-radius: 10px !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        box-shadow: none !important;
        height: 42px;
        width: 100%;
        padding: 8px 14px 8px 40px !important;
        background-color: #faf9ff !important;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236C63F5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: left 12px center;
        background-size: 15px;
    }
    #dateform #reservationtime:focus,
    #dateform #reservationtime.lb-range-input-open {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(108, 99, 245, .12) !important;
        outline: none;
    }

    .chart-card {
        background: #fff;
        border: 1px solid #eeecfb;
        border-radius: 14px;
        padding: 16px 18px 18px;
        margin-bottom: 22px;
        box-shadow: 0 2px 10px rgba(108, 99, 245, 0.05);
    }
    .stat-section-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
        margin: 8px 0 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-light);
    }
    #detail { margin-top: 10px; }

    /* ==========================================================================
       Self-contained "lb-range" date range picker (purple theme, no external
       plugin/CDN). Replaces bootstrap-daterangepicker + moment.js: that combo
       either renders unstyled or, on pages where jQuery gets reloaded by
       another script, fails to bind at all. This widget is plain JS, has no
       dependency to break, and is clamped to the viewport (position:fixed +
       edge clamping) so it can never force a page-wide horizontal scrollbar.
       ========================================================================== */
    .lb-range-popup{ position:fixed; z-index:999999; background:#fff; border:1px solid #eeecfb; border-radius:16px;
        box-shadow:0 16px 40px rgba(108,99,245,.18), 0 4px 14px rgba(16,24,40,.06); padding:18px; font-family:'Poppins',sans-serif; user-select:none; }
    .lb-range-panels{ display:flex; gap:24px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:var(--primary-light); }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
    .lb-range-nav{ border:none; background:var(--primary-light); color:var(--primary); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:#ded8ff; }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--primary); text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:var(--text-dark); cursor:pointer; }
    .lb-range-day:hover{ background:var(--primary-light); }
    .lb-range-day.other-month{ color:#c7c3ee; opacity:.6; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--primary); }
    .lb-range-day.in-range{ background:var(--primary-light); border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:linear-gradient(135deg,#8c7ef2,var(--primary)) !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; align-items:center; justify-content:space-between; margin-top:14px; border-top:1px solid var(--primary-light); padding-top:12px; }
    .lb-range-preview{ font-size:12.5px; color:var(--text-muted); font-weight:500; }
    .lb-range-clear-btn{ border:none; background:none; color:#64748b; font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:#f4f2ff; }
    .lb-range-apply-btn{ border:none; background:linear-gradient(135deg, var(--primary), #5479f7); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:8px 18px; border-radius:999px; box-shadow:0 4px 14px rgba(108,99,245,.28); }
    .lb-range-apply-btn:hover{ opacity:.93; }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
(function () {
    // Single JSON payload replaces the old per-chart PHP foreach loops
    var STATS = <?php echo json_encode($chartPayload); ?>;
    var DETAILS = <?php echo json_encode($detailCharts); ?>;

    function toRows(bucketOrValues, key) {
        var rows = [];
        STATS.labels.forEach(function (label) {
            var value = key ? bucketOrValues[key][label] : bucketOrValues[label];
            rows.push([label, value || 0]);
        });
        return rows;
    }

    function drawArea(elId, title, color, rows) {
        var data = google.visualization.arrayToDataTable(
            [['Mois', 'Nbr de visites']].concat(rows)
        );
        var options = {
            title: title,
            hAxis: { title: 'Mois', titleTextStyle: { color: '#333' } },
            vAxis: { minValue: 0 },
            colors: [color]
        };
        new google.visualization.AreaChart(document.getElementById(elId)).draw(data, options);
    }

    function drawMultiBar(elId, title, subtitle, header, seriesRows) {
        var data = google.visualization.arrayToDataTable([header].concat(seriesRows));
        var options = { chart: { title: title, subtitle: subtitle } };
        new google.charts.Bar(document.getElementById(elId)).draw(data, google.charts.Bar.convertOptions(options));
    }

    function drawTopCharts() {
        // Visites par mois
        drawMultiBar('visite', 'Evolution des visites', 'visites par mois',
            ['Mois', 'Visite'], toRows(STATS.visites));

        // Visites par potentialite (multi-series)
        var potHeader = ['Mois'].concat(Object.keys(STATS.potentialite));
        var potRows = STATS.labels.map(function (label) {
            var row = [label];
            Object.keys(STATS.potentialite).forEach(function (k) {
                row.push(STATS.potentialite[k][label] || 0);
            });
            return row;
        });
        drawMultiBar('potentialite', 'Evolution des visites par potentialité', 'visites par mois', potHeader, potRows);

        // Partenariats
        var partHeader = ['Mois'].concat(Object.keys(STATS.partenaires));
        var partRows = STATS.labels.map(function (label) {
            var row = [label];
            Object.keys(STATS.partenaires).forEach(function (k) {
                row.push(STATS.partenaires[k][label] || 0);
            });
            return row;
        });
        drawMultiBar('partenaires', 'Evolution des partenariats', 'visites par mois', partHeader, partRows);

        // Concurrence
        var concHeader = ['Mois'].concat(Object.keys(STATS.concurrence));
        var concRows = STATS.labels.map(function (label) {
            var row = [label];
            Object.keys(STATS.concurrence).forEach(function (k) {
                row.push(STATS.concurrence[k][label] || 0);
            });
            return row;
        });
        drawMultiBar('concurrents', 'Evolution de la concurrence', 'visites par mois', concHeader, concRows);
    }

    function drawDetailCharts() {
        DETAILS.forEach(function (d) {
            var elId = d[0], bucket = d[1], key = d[2], title = d[3], color = d[4];
            drawArea(elId, title, color, toRows(STATS[bucket], key));
        });
    }

    google.charts.load('current', { packages: ['bar'] });
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawTopCharts);
    google.charts.setOnLoadCallback(drawDetailCharts);

    $(function () {
        $('.detail').click(function () {
            $('html,body').animate({ scrollTop: $('#detail').offset().top - 10 }, 1000);
        });
    });
})();
</script>

<?php
// NOTE: bootstrap-daterangepicker + moment.js have been removed on purpose.
// That plugin never picked up this page's purple theme, and on other pages
// in this project a reloaded jQuery broke it from binding at all. Replaced
// below with the self-contained "lb-range" picker (purple, viewport-clamped)
// plus a small compatibility shim so the existing
// apply.daterangepicker / picker.startDate.format('DD-MM-YYYY') logic in
// this file's submit handler keeps working unmodified.
?>
<script>
    (function () {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }

        // moment-like .format(fmt) supporting the tokens this project actually uses
        function formatToken(d, fmt) {
            fmt = fmt || 'YYYY-MM-DD';
            return fmt
                .replace('YYYY', d.getFullYear())
                .replace('MM', pad2(d.getMonth() + 1))
                .replace('DD', pad2(d.getDate()));
        }
        function momentLike(d) { return { format: function (fmt) { return formatToken(d, fmt); } }; }

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
            this.input.setAttribute('readonly', 'readonly');
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

        // Compatibility shim for existing code expecting
        // $('#reservationtime').on('apply.daterangepicker', function(ev, picker){...})
        // with picker.startDate.format('DD-MM-YYYY') / picker.endDate.format(...)
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

    // Existing submit logic, kept as-is (just no longer depends on the old plugin)
    $(function () {
        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            var action = $('#dateform').attr('action');
            var date = action + '/' + picker.startDate.format('DD-MM-YYYY') + '/' + picker.endDate.format('DD-MM-YYYY');
            $('#dateform').attr('action', date);
            $('#dateform').submit();
        });
    });
</script>

<div class="row" style="margin:0px;">
    <div class="col-md-12" style="float:none;margin:auto;">
        <div class="box stat-box">
            <div class="box-header with-border">
                <h3 class="box-title">Statistique</h3>
                <a class="btn-voir-detail detail" style="cursor:pointer;">Voir Détail</a>
            </div>
            <div class="box-body">
                <form action="<?php echo $this->Html->url("/visites/statistique/$id") ?>" method="post" id="dateform">
                    <div class="input-group" style="max-width:320px;">
                        <input type="text" class="form-control" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                    </div>
                </form>

                <!-- FIX 1: the input-group above used to be float:left with nothing
                     clearing it, so the rows below wrapped up alongside the float
                     instead of starting on a new line -> the big empty gap.
                     Removed the float; input-group is flex by default in BS5.
                     FIX 2: these two rows were wrapped in .col-md-12 instead of .row,
                     so the col-md-6 children weren't flex items and stacked
                     vertically. Changed to .row. -->
                <div class="row" style="margin-top:30px;clear:both;">
                    <div class="col-md-6"><div class="chart-card"><div id="visite" style="width:100%;height:300px;"></div></div></div>
                    <div class="col-md-6"><div class="chart-card"><div id="potentialite" style="width:100%;height:300px;"></div></div></div>
                </div>

                <div class="row" style="margin-top:20px;margin-bottom:20px;">
                    <div class="col-md-6"><div class="chart-card"><div id="partenaires" style="width:100%;height:300px;"></div></div></div>
                    <div class="col-md-6"><div class="chart-card"><div id="concurrents" style="width:100%;height:300px;"></div></div></div>
                </div>

                <div class="row" id="detail">
                    <h4 class="stat-section-title col-md-12">Détail potentialité</h4>
                    <?php foreach (array('PCM','QAM','PM','A4','B1','B2','B3','B4','C1','C2','C3','C4','NR') as $id_) : ?>
                    <div class="col-md-6">
                        <div class="chart-card">
                            <div id="<?php echo $id_ ?>" style="width:100%;height:300px;"></div>
                            <?php echo $this->Html->link(__('Voir détail'), array('controller' => 'visites', 'action' => 'system_statvisitbyparams', $detailLinks[$id_], $id), array('class' => 'btn-voir-detail', 'style' => 'float:right;')); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <h4 class="stat-section-title col-md-12">Détail partenaires</h4>
                    <?php foreach (array('BIEN','MOYEN','FAIBLE') as $id_) : ?>
                    <div class="col-md-6">
                        <div class="chart-card">
                            <div id="<?php echo $id_ ?>" style="width:100%;height:300px;"></div>
                            <?php echo $this->Html->link(__('Voir détail'), array('controller' => 'visites', 'action' => 'system_statvisitbyparams', $detailLinks[$id_]), array('class' => 'btn-voir-detail', 'style' => 'float:right;')); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-md-6"><div class="chart-card"><div id="R" style="width:100%;height:300px;"></div></div></div>

                    <h4 class="stat-section-title col-md-12">Détail concurrence</h4>
                    <?php foreach (array('CENT','CINQ','PMO') as $id_) : ?>
                    <div class="col-md-6">
                        <div class="chart-card">
                            <div id="<?php echo $id_ ?>" style="width:100%;height:300px;"></div>
                            <?php echo $this->Html->link(__('Voir détail'), array('controller' => 'visites', 'action' => 'system_statvisitbyparams', $detailLinks[$id_]), array('class' => 'btn-voir-detail', 'style' => 'float:right;')); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-md-6"><div class="chart-card"><div id="V" style="width:100%;height:300px;"></div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
