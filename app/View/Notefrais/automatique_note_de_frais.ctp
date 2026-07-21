<style>
    @media (max-width:1237px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
.direct-chat-info {
    font-size: 17px!important;
}
.direct-chat-text
{ 
    font-size: 23px;
}
.box-header{
    color: #333;
    background-color: #f5f5f5;
}
/* ==========================================================================
   NOTE DE FRAIS: COMPLETE WHITE CARD WRAPPER (TITLE + FORM + BUTTON)
   ========================================================================== */
.box-header:has(#reservationtime) {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 24px !important;
    padding: 40px 45px !important;
    box-shadow: 0 12px 32px rgba(16, 24, 40, 0.04),
                0 4px 12px rgba(16, 24, 40, 0.02) !important;
    width: 100% !important;
    max-width: 480px !important;
    margin: 60px auto !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    box-sizing: border-box !important;
    text-align: center !important;
}

.col-md-12:has(#reservationtime),
.col-md-12:has(#reservationtime) > div {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
}

.box-header .box-title {
    font-size: 24px !important;
    font-weight: 700 !important;
    color: #101828 !important;
    letter-spacing: -0.5px !important;
    margin: 0 0 4px 0 !important;
}

.input-group.col-lg-6 {
    width: 100% !important;
    padding: 0 !important;
    float: none !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    gap: 8px !important;
}

.input-group.col-lg-6 label {
    font-size: 12px !important;
    font-weight: 700 !important;
    color: #64748b !important;
    text-transform: uppercase !important;
    letter-spacing: 0.8px !important;
}

#reservationtime.form-control {
    width: 100% !important;
    max-width: 340px !important;
    height: 48px !important;
    background-color: #f8fafc !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 14px !important;
    padding: 10px 16px 10px 44px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    text-align: center !important;
    box-sizing: border-box !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;

    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239d76fa' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: left 16px center !important;
    background-size: 16px !important;
}

#reservationtime.form-control:focus,
#reservationtime.lb-range-input-open {
    background-color: #ffffff !important;
    border-color: #9d76fa !important;
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(157, 118, 250, 0.15) !important;
}

.col-md-12:has(#reservationtime) div:has(.btn-primary),
.col-md-12:has(#reservationtime) .well {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
    margin-top: 26px !important;
    box-shadow: none !important;
    width: 100% !important;
    display: flex !important;
    justify-content: center !important;
}

.col-md-12:has(#reservationtime) .btn-primary {
    background: linear-gradient(135deg, #b497ff 0%, #9d76fa 100%) !important;
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    border: none !important;
    border-radius: 14px !important;
    width: 100% !important;
    max-width: 220px !important;
    height: 48px !important;
    cursor: pointer !important;
    box-shadow: 0 8px 24px rgba(157, 118, 250, 0.25) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.25s ease !important;
}

.col-md-12:has(#reservationtime) .btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 28px rgba(157, 118, 250, 0.4) !important;
    opacity: 0.95 !important;
}

.col-md-12:has(#reservationtime) .btn-primary:active {
    transform: translateY(0px) !important;
}

/* ==========================================================================
   Self-contained "lb-range" date range picker (no external plugin/CDN).
   Replaces the old bootstrap-daterangepicker + moment.js combo, which broke
   because this view reloaded an old jQuery 2.2.3 copy AFTER Metronic had
   already attached its own modern jQuery — the plugin ended up bound to a
   jQuery instance that wasn't the one running the page, so the popup never
   opened. Keep this self-contained; don't reintroduce the CDN plugin.
   ========================================================================== */
.lb-range-popup{ position:absolute; z-index:999999; background:#fff; border:1px solid #e4e6fb; border-radius:14px;
    box-shadow:0 12px 32px rgba(16,24,40,.14), 0 4px 12px rgba(16,24,40,.06); padding:16px; font-family:inherit; user-select:none; }
.lb-range-panels{ display:flex; gap:22px; }
.lb-range-panel{ width:250px; }
.lb-range-divider{ width:1px; background:#eef0f7; }
.lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
.lb-range-title{ font-weight:700; color:#101828; font-size:14.5px; }
.lb-range-nav{ border:none; background:#f0ecff; color:#9d76fa; width:28px; height:28px;
    border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
.lb-range-nav:hover{ background:#e4d9ff; }
.lb-range-nav-hidden{ visibility:hidden; }
.lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
.lb-range-weekdays span{ font-size:11px; font-weight:700; color:#9d76fa; text-transform:uppercase; }
.lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
.lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:#334155; cursor:pointer; }
.lb-range-day:hover{ background:#f0ecff; }
.lb-range-day.other-month{ color:#cbd5e1; opacity:.7; }
.lb-range-day.today{ box-shadow:inset 0 0 0 1px #9d76fa; }
.lb-range-day.in-range{ background:#f0ecff; border-radius:0; }
.lb-range-day.range-start,.lb-range-day.range-end{ background:linear-gradient(135deg,#b497ff,#9d76fa) !important; color:#fff !important; font-weight:700; border-radius:8px; }
.lb-range-footer{ display:flex; justify-content:space-between; margin-top:14px; border-top:1px solid #eef0f7; padding-top:10px; }
.lb-range-clear-btn{ border:none; background:none; color:#64748b; font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
.lb-range-clear-btn:hover{ background:#f8fafc; }
.lb-range-apply-btn{ border:none; background:linear-gradient(135deg,#b497ff,#9d76fa); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:6px 14px; border-radius:16px; }
.lb-range-apply-btn:hover{ opacity:.92; }

.box-header:has(#reservationtime),
.col-md-12:has(#reservationtime) {
    overflow: visible !important;
}
</style>
<div class="box-header">
        <h3 class="box-title">
            <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
            echo __('Note de frais'); ?>
        </h3>
        <div class="col-md-12" style="margin-bottom: 24px;"> 
                
                    <?php echo $this->Form->create('Notefrai', array("type" => "get", "id" => "dateform")); ?>
                        <div class="input-group col-lg-6" style="float:left;">
                            
                            <label for="">Date </label>
                            <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' -- ' . $date_fin . '"'; ?> 
							class="form-control pull-right" name="date" id="reservationtime" placeholder="Rechercher" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <?php
                        echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12 col-xs-12','style'=>'margin:10px 0px;'))); ?>
    </div>
    </div>

<?php
// NOTE: jquery-2.2.3.min / moment.js / daterangepicker plugin have been
// removed on purpose — see comment above the .lb-range-popup CSS.
// Metronic's own plugins.bundle.js already provides jQuery for this page.
?>
<script>
    (function () {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }

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
            document.body.appendChild(this.popup);
            this.input.classList.add('lb-range-input-open');
            this.position();
            this.render();
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
            var rect = this.input.getBoundingClientRect();
            this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
            this.popup.style.left = (window.scrollX + rect.left) + 'px';
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

            var html = '<div class="lb-range-panels">';
            html += this.renderPanel(leftYear, leftMonth, true, false);
            html += '<div class="lb-range-divider"></div>';
            html += this.renderPanel(rightRef.getFullYear(), rightRef.getMonth(), false, true);
            html += '</div><div class="lb-range-footer">';
            html += '<button type="button" class="lb-range-clear-btn" data-action="clear">Annuler</button>';
            html += '<button type="button" class="lb-range-apply-btn" data-action="apply">Valider</button></div>';
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
            if (applyBtn) applyBtn.addEventListener('click', function (e) { e.stopPropagation(); self.updateInputText(); self.close(); });
        };

        function initRangePicker() {
            var el = document.getElementById('reservationtime');
            if (el && !el._lbRangeBound) { el._lbRangeBound = true; new LBRangePicker(el); }
        }
        document.addEventListener('DOMContentLoaded', initRangePicker);
        if (document.readyState === 'interactive' || document.readyState === 'complete') initRangePicker();
    })();
</script>