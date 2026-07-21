<?php echo $this->Html->css('dataTables.bootstrap');
 echo $this->Html->css('_all-skins.min');
 ?>
<?php echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<style>
	:root{
		--accent:#6c5ce7;
		--accent-grad-start:#8f7cf6;
		--accent-soft:#F3F1FF;
		--accent-text:#6c5ce7;
		--text-dark:#1a1d36;
		--text-muted:#9a9aab;
		--border-soft:#F0EDFF;
		--page-bg:#F4F3FB;
	}

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

	/* ===== Filter card ===== */
	.filter-card{
		background:#fff;
		border-radius:18px;
		padding:18px 22px;
		margin-bottom:18px;
		box-shadow:0 10px 28px rgba(140,126,242,0.07);
		overflow:visible;
	}
	.filter-bar{ display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
	.filter-bar-label{
		display:flex; align-items:center; gap:12px;
		font-size:14px; font-weight:600; color:var(--text-dark); white-space:nowrap;
	}
	.icon-badge{
		width:34px;height:34px; border-radius:10px;
		background:var(--accent-soft); color:var(--accent-text);
		display:inline-flex; align-items:center; justify-content:center; flex-shrink:0;
	}
	.icon-badge svg{ width:17px;height:17px; }
	#dateform{ flex:1; min-width:240px; }
	#dateform .input-group{
		width:100%;
		background:#FAF9FF;
		border:1px solid var(--border-soft);
		border-radius:12px;
		display:flex; align-items:center;
		padding:4px 16px 4px 4px;
	}
	#dateform .input-group-addon{ display:none; }
	#dateform .form-control{
		border:none !important; background:transparent !important; box-shadow:none !important;
		font-size:13.5px; color:#44444f; padding:10px 6px !important; cursor:pointer;
	}
	#dateform .input-group::after{
		content:'';
		width:18px;height:18px;
		flex-shrink:0;
		background-repeat:no-repeat; background-size:contain;
		background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238c7ef2' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");
	}

	/* ===== Table card ===== */
	.rapports-card{
		background:#fff;
		border-radius:18px;
		overflow:hidden;
		box-shadow:0 10px 28px rgba(140,126,242,0.07);
	}
	.rapports-card .box-body{ padding:0; overflow-x:auto; }

	table.rapports-table{ margin-bottom:0; }
	table.rapports-table thead th{
		background:var(--accent-soft);
		color:var(--accent-text);
		font-size:12px;
		text-transform:uppercase;
		letter-spacing:.03em;
		font-weight:700;
		border-bottom:1px solid var(--border-soft) !important;
		border-top:none !important;
		padding:14px 18px;
		white-space:nowrap;
	}
	table.rapports-table tbody td{
		vertical-align:middle;
		padding:12px 18px;
		border-top:1px solid var(--border-soft) !important;
		color:var(--text-dark);
		font-size:13.5px;
	}
	table.rapports-table.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
	table.rapports-table tbody tr:hover{ background-color:var(--accent-soft) !important; }

	.vm-cell{ display:flex; align-items:center; gap:10px; }
	.vm-avatar{
		flex:0 0 auto; width:30px;height:30px; border-radius:50%;
		display:flex;align-items:center;justify-content:center;
		color:#fff; font-weight:700; font-size:12px;
		background:linear-gradient(135deg, var(--accent-grad-start), var(--accent));
	}

	.client-link{ color:var(--accent-text); font-weight:600; text-decoration:none; }
	.client-link:hover{ color:var(--accent); text-decoration:underline; }

	.type-badge, .cat-badge{
		display:inline-block;
		padding:3px 11px;
		border-radius:20px;
		background:var(--accent-soft);
		color:var(--accent-text);
		font-size:11.5px;
		font-weight:700;
		white-space:nowrap;
	}

	.potentialite-badge{
		display:inline-block;
		padding:3px 11px;
		border-radius:20px;
		background:#FFF1E8;
		color:#F0784A;
		font-size:11.5px;
		font-weight:700;
	}

	.concurrent-text{ color:var(--text-muted); font-size:13px; }
	.concurrent-empty{ color:#c9c6d8; font-style:italic; }

	.date-cell{ display:inline-flex; align-items:center; gap:6px; color:var(--text-dark); font-weight:600; white-space:nowrap; }
	.date-cell svg{ width:13px;height:13px; color:var(--accent-text); flex:0 0 auto; }

	.comment-cell{
		max-width:220px;
		white-space:nowrap;
		overflow:hidden;
		text-overflow:ellipsis;
		color:var(--text-muted);
		display:block;
	}
	.comment-empty{ color:#c9c6d8; font-style:italic; }

	/* Empty state */
	.empty-state{
		display:flex;
		flex-direction:column;
		align-items:center;
		justify-content:center;
		gap:10px;
		padding:60px 20px;
		color:var(--text-muted);
	}
	.empty-state svg{ width:40px; height:40px; color:var(--accent-soft); stroke:var(--accent); }
	.empty-state p{ margin:0; font-size:14px; font-weight:600; color:var(--text-dark); }
	.empty-state span{ font-size:12.5px; color:var(--text-muted); }

	table.dataTable thead th{ cursor:pointer; }

	/* ==========================================================================
	   Self-contained "lb-range" date range picker (purple theme, no external
	   plugin/CDN). Replaces bootstrap-daterangepicker + moment.js + the
	   reloaded jquery-2.2.3.min: reloading jQuery here is the same conflict
	   that broke the calendar/select2 on the other restyled pages in this
	   project. Plain JS, no dependency, clamped to the viewport so it can
	   never force a page-wide horizontal scrollbar.
	   ========================================================================== */
	.lb-range-popup{ position:fixed; z-index:999999; background:#fff; border:1px solid var(--border-soft); border-radius:16px;
		box-shadow:0 16px 40px rgba(108,92,231,.18), 0 4px 14px rgba(16,24,40,.06); padding:18px; font-family:inherit; user-select:none; }
	.lb-range-panels{ display:flex; gap:24px; }
	.lb-range-panel{ width:250px; }
	.lb-range-divider{ width:1px; background:var(--border-soft); }
	.lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
	.lb-range-title{ font-weight:700; color:var(--text-dark); font-size:14.5px; }
	.lb-range-nav{ border:none; background:var(--accent-soft); color:var(--accent); width:28px; height:28px;
		border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
	.lb-range-nav:hover{ background:#e6e0ff; }
	.lb-range-nav-hidden{ visibility:hidden; }
	.lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
	.lb-range-weekdays span{ font-size:11px; font-weight:700; color:var(--accent); text-transform:uppercase; }
	.lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
	.lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:var(--text-dark); cursor:pointer; }
	.lb-range-day:hover{ background:var(--accent-soft); }
	.lb-range-day.other-month{ color:#cdc8ea; opacity:.6; }
	.lb-range-day.today{ box-shadow:inset 0 0 0 1px var(--accent); }
	.lb-range-day.in-range{ background:var(--accent-soft); border-radius:0; }
	.lb-range-day.range-start,.lb-range-day.range-end{ background:linear-gradient(135deg, var(--accent-grad-start), var(--accent)) !important; color:#fff !important; font-weight:700; border-radius:8px; }
	.lb-range-footer{ display:flex; align-items:center; justify-content:space-between; margin-top:14px; border-top:1px solid var(--border-soft); padding-top:12px; }
	.lb-range-preview{ font-size:12.5px; color:var(--text-muted); font-weight:500; }
	.lb-range-clear-btn{ border:none; background:none; color:#64748b; font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
	.lb-range-clear-btn:hover{ background:#f4f2ff; }
	.lb-range-apply-btn{ border:none; background:linear-gradient(135deg, var(--accent-grad-start), var(--accent)); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:8px 18px; border-radius:999px; box-shadow:0 4px 14px rgba(108,92,231,.28); }
	.lb-range-apply-btn:hover{ opacity:.93; }
	@media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<div class="page-header-card">
	<div class="page-header-icon">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11H3v10h6z"/><path d="M15 5H9v16h6z"/><path d="M21 3h-6v18h6z"/></svg>
	</div>
	<div class="page-header-text">
		<h3><?php echo __('Rapports des visites'); ?></h3>
		<p><?php echo __('Consultez le détail des visites enregistrées par vos équipes'); ?></p>
		<span class="underline"></span>
	</div>
</div>

<div class="filter-card">
	<div class="filter-bar">
		<div class="filter-bar-label">
			<span class="icon-badge">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
			</span>
			Filtrer par période
		</div>
		<form action="<?php $this->Html->url("/rapports/visites/") ?>" method="get" id="dateform">
			<div class="input-group">
				<input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
			</div>
		</form>
	</div>
</div>

<div class="rapports-card">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped rapports-table">
            <thead>
                <tr>
					<th>VM</th>
					<th>Client</th>
					<th>Type</th>
					<th>Catégorie</th>
					<th>Potentialité</th>
					<th>Concurrents</th>
					<th>Date</th>
					<th>Commentaire</th>
				</tr>
            </thead>
            <?php 
                //setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                foreach ($visites as $value):?>
					<tr>
						<td>
							<div class="vm-cell">
								<span class="vm-avatar"><?php echo strtoupper(substr($value["User"]["name"], 0, 1)); ?></span>
								<?php echo $value["User"]["name"];?>
							</div>
						</td>
						 <td><?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"]), array('class' => 'client-link')); ?></td>
							<?php 
								echo "<td><span class='type-badge'>".$types[$value["Client"]["type_id"]]."</span></td>";
								echo "<td>".(!empty($categories[$value["Client"]["category_id"]]) ? "<span class='cat-badge'>".@$categories[$value["Client"]["category_id"]]."</span>" : "<span class='concurrent-empty'>—</span>")."</td>";
								?>
							<td>
								<?php if (!empty($value["Client"]["potentialite"])): ?>
									<span class="potentialite-badge"><?php echo $value["Client"]["potentialite"];?></span>
								<?php else: ?>
									<span class="concurrent-empty">—</span>
								<?php endif; ?>
							</td>
							<td>
								<?php if (!empty($value["Visite"]["veille"])): ?>
									<span class="concurrent-text"><?php echo $value["Visite"]["veille"]; ?></span>
								<?php else: ?>
									<span class="concurrent-empty">—</span>
								<?php endif; ?>
							</td>
							<td>
								<span class="date-cell">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
									<?php $date = strtotime($value["Visite"]["date"]);
									$dat = date('Y-m-d', $date);
									echo $dat; ?>
								</span>
							</td>
							<td>
								<?php if (!empty($value["Visite"]["commentaire"])): ?>
									<span class="comment-cell" title="<?php echo h($value["Visite"]["commentaire"]); ?>"><?php echo $value["Visite"]["commentaire"]; ?></span>
								<?php else: ?>
									<span class="comment-empty">Aucun commentaire</span>
								<?php endif; ?>
							</td>
					</tr>
			<?php endforeach; ?>
        </table>
    </div>
</div>

<?php
// NOTE: bootstrap-daterangepicker, moment.js, and jquery-2.2.3.min have been
// removed on purpose. Reloading jQuery here overwrote whatever jQuery
// instance the rest of the theme (app.min.js etc.) had already attached to,
// which is the same conflict that broke calendars/select2 on the other
// restyled views in this project. Replaced with the self-contained
// "lb-range" picker below (purple theme, viewport-clamped), plus a small
// compatibility shim so the existing apply.daterangepicker handler keeps
// working unmodified.
?>
<script>
    (function () {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }

        // moment-like object: .format(fmt) supports YYYY/MM/DD tokens, and
        // toString() also returns the ISO date (this page's handler
        // concatenates startDate/endDate directly into the URL without
        // calling .format(), relying on the implicit toString()).
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

    // Existing submit + DataTable logic, kept as-is
    $(function () {
        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            var startDate = picker.startDate;
            var endDate = picker.endDate;
            var action = $('#dateform').attr('action');
            var date = action + "?date=" + startDate + "--" + endDate;
            $('#dateform').attr('action', date);
            $('#dateform').submit();
        });
    });
    $(function () {
        $('#example1, #example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "language": {
                "zeroRecords": "Aucune visite trouvée pour cette période",
                "emptyTable": "Aucune visite trouvée pour cette période"
            }
        });
    });
</script>
