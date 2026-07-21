<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .de, .de * { font-family:'Poppins',sans-serif; }

    /* ---------- CARD ---------- */
    .de.box {
        background:#ffffff !important;
        border:1px solid rgba(229,224,251,.7) !important;
        border-radius:18px !important;
        box-shadow:0 12px 34px rgba(140,126,242,.07) !important;
        overflow:visible;
    }
    .de .box-header {
        border:none !important;
        padding:24px 24px 16px 24px !important;
        display:flex; align-items:center; flex-wrap:wrap; gap:16px;
    }
    .de .box-title {
        font-size:18px !important; font-weight:700 !important; color:#2d2b45 !important;
        margin:0 !important; line-height:normal !important;
    }
    .de .input-group-date {
        margin-left:auto !important; float:none !important;
        width:auto !important; max-width:320px; margin-bottom:0 !important;
    }
    .de .input-group-date .input-group-addon {
        display:none; /* icon now baked into the input's background-image */
    }
    .de #reservationtime.form-control {
        width:100% !important; min-width:230px;
        height:44px !important;
        background-color:#faf9ff !important;
        border:1.5px solid #e7e5f7 !important;
        border-radius:12px !important;
        padding:10px 14px 10px 40px !important;
        font-size:13.5px !important; font-weight:600 !important; color:#454358 !important;
        cursor:pointer;
        box-shadow:none !important;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236C63F5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E") !important;
        background-repeat:no-repeat !important;
        background-position:left 12px center !important;
        background-size:15px !important;
    }
    .de #reservationtime.form-control:focus,
    .de #reservationtime.lb-range-input-open {
        border-color:#6C63F5 !important;
        box-shadow:0 0 0 3px rgba(108,99,245,.12) !important;
    }

    /* ---------- BODY / TABLE ---------- */
    .de .box-body {
        overflow:scroll; overflow-y:hidden;
        padding:8px 24px 24px 24px !important;
    }
    .de .box-body::-webkit-scrollbar{ height:8px; }
    .de .box-body::-webkit-scrollbar-thumb{ background:#e5e0fb; border-radius:8px; }
    .de .box-body::-webkit-scrollbar-track{ background:transparent; }

    .de #example1.table {
        border:1px solid #f1f1f8 !important;
        border-radius:14px !important;
        border-collapse:separate !important;
        border-spacing:0 !important;
        margin-top:0 !important;
    }
    .de #example1.table thead th {
        background:#FAF9FF !important;
        color:#6C63F5 !important;
        font-weight:700 !important;
        font-size:11.5px !important;
        text-transform:uppercase !important;
        letter-spacing:.3px;
        border:none !important;
        border-bottom:1px solid #f1f1f8 !important;
        padding:13px 14px !important;
        white-space:nowrap;
    }
    .de #example1.table tbody td {
        vertical-align:middle !important;
        border:none !important;
        border-bottom:1px solid #f8f8fc !important;
        padding:10px 12px !important;
        font-size:13px; color:#44444f;
        white-space:nowrap;
    }
    .de #example1.table.table-striped tbody tr:nth-of-type(odd) td {
        background-color:#fbfaff !important;
    }
    .de #example1.table tbody tr:hover td {
        background-color:#f4f2ff !important;
    }
    .de #example1.table tbody td a {
        color:#6C63F5; font-weight:600; text-decoration:none;
    }
    .de #example1.table tbody td a:hover { text-decoration:underline; }

    /* superviseur row marker "⇒▶" -- keep but recolor to match */
    .de #example1.table tbody td:first-child { font-weight:600; }

    /* quantity inputs */
    .de input.qte {
        width:64px !important;
        height:38px !important;
        border:1.5px solid #e7e5f7 !important;
        border-radius:10px !important;
        text-align:center !important;
        font-size:13.5px !important; font-weight:600 !important; color:#2d2b45 !important;
        box-shadow:none !important;
        transition:border-color .15s ease, box-shadow .15s ease, background-color .3s ease;
    }
    .de input.qte:focus {
        border-color:#6C63F5 !important;
        box-shadow:0 0 0 3px rgba(108,99,245,.12) !important;
        outline:none !important;
    }

    /* submit button */
    .de .well.text-center {
        background:transparent !important; border:none !important; box-shadow:none !important;
        padding:20px 24px 26px !important; margin:0 !important;
    }
    .de .submit.btn.btn-primary {
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
        border:none !important;
        border-radius:999px !important;
        padding:12px 40px !important;
        font-weight:600 !important;
        font-size:14.5px !important;
        color:#fff !important;
        box-shadow:0 6px 18px rgba(108,99,245,.3) !important;
    }
    .de .submit.btn.btn-primary:hover { opacity:.94; }

    /* ==========================================================================
       Self-contained "lb-range" date range picker (purple theme).
       Replaces bootstrap-daterangepicker + moment.js + the reloaded jQuery
       2.2.3: reloading jQuery here overwrote Metronic's own jQuery instance,
       which is why the plugin either failed silently or (as seen in the
       screenshot) rendered unstyled/unthemed. This widget has no external
       dependency and runs on whichever jQuery/plain JS is already on the
       page, so it can't be broken by a later script tag.
       ========================================================================== */
    .lb-range-popup{ position:absolute; z-index:999999; background:#fff; border:1px solid #e7e5f7; border-radius:16px;
        box-shadow:0 16px 40px rgba(108,99,245,.18), 0 4px 14px rgba(16,24,40,.06); padding:18px; font-family:'Poppins',sans-serif; user-select:none; }
    .lb-range-panels{ display:flex; gap:24px; }
    .lb-range-panel{ width:250px; }
    .lb-range-divider{ width:1px; background:#eeecf9; }
    .lb-range-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-range-title{ font-weight:700; color:#2d2b45; font-size:14.5px; }
    .lb-range-nav{ border:none; background:#efeeff; color:#6C63F5; width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; }
    .lb-range-nav:hover{ background:#ded8ff; }
    .lb-range-nav-hidden{ visibility:hidden; }
    .lb-range-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-range-weekdays span{ font-size:11px; font-weight:700; color:#6C63F5; text-transform:uppercase; }
    .lb-range-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-range-day{ border:none; background:transparent; padding:8px 0; border-radius:8px; font-size:13px; color:#2d2b45; cursor:pointer; }
    .lb-range-day:hover{ background:#efeeff; }
    .lb-range-day.other-month{ color:#b9b9d1; opacity:.5; }
    .lb-range-day.today{ box-shadow:inset 0 0 0 1px #6C63F5; }
    .lb-range-day.in-range{ background:#efeeff; border-radius:0; }
    .lb-range-day.range-start,.lb-range-day.range-end{ background:linear-gradient(135deg,#8c7ef2,#6C63F5) !important; color:#fff !important; font-weight:700; border-radius:8px; }
    .lb-range-footer{ display:flex; align-items:center; justify-content:space-between; margin-top:14px; border-top:1px solid #eeecf9; padding-top:12px; }
    .lb-range-preview{ font-size:12.5px; color:#8a879e; font-weight:500; }
    .lb-range-clear-btn{ border:none; background:none; color:#64748b; font-size:12.5px; font-weight:600; cursor:pointer; padding:5px 9px; border-radius:8px; }
    .lb-range-clear-btn:hover{ background:#f4f2ff; }
    .lb-range-apply-btn{ border:none; background:linear-gradient(90deg,#6C63F5,#8c7ef2); color:#fff; font-size:12.5px; font-weight:700; cursor:pointer; padding:8px 18px; border-radius:999px; box-shadow:0 4px 14px rgba(108,99,245,.28); }
    .lb-range-apply-btn:hover{ opacity:.93; }
    @media (max-width:600px){ .lb-range-panels{ flex-direction:column; gap:10px; } .lb-range-divider{ display:none; } }
</style>

<div class="box de">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Demande d\'échantillons'); ?></h3>
        <div class="input-group input-group-date">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            <input type="text" class="form-control" id="reservationtime" name="reservationtime" placeholder="Rechercher" autocomplete="off">
        </div>
    </div>
    <?php echo $this->Form->create('Gadjet', array("onsubmit" => "return Validationqte()"));
    echo $this->Form->hidden("json");
    ?>
    <div class="box-body">

        <table id="example1" class="table table-bordered table-striped" style="float: left;">

            <thead>
                <tr>
                    <th>Employé</th>
                    <?php foreach ($echantillons as $key => $value) {
                        echo "<th>$value</th>";
                    } ?>
                </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($users as $super): ?>
                <tr>
                    <td>&rArr;&#9658;<?php echo $this->Html->link($super['User']['name'], array('controller' => 'users', 'action' => 'view', $super['User']['id'])); ?></td>
                    <?php
                    foreach ($echantillons as $key => $value) {
                        echo "<td class='$i'>" . $this->Form->hidden('user_id', array('name' => "data[g][$i][Gadjet][user_id]", 'value' => $super['User']['id']));
                        echo $this->Form->hidden('echantillon_id', array('name' => "data[g][$i][Gadjet][echantillon_id]", 'value' => $key));
                        echo $this->Form->input('quantite', array('name' => "data[g][$i][Gadjet][quantite]", 'style' => "width: 60px", 'label' => false, 'div' => false, 'class' => "qte", "alt" => "$i")) . "</td>";
                        $i++;
                    } ?>
                </tr>
                <?php
                $vmps = $this->requestAction('/users/system_get_user_for_superviseur/' . $super['User']['id']);
                foreach ($vmps as $user): ?>
                    <tr>
                        <td><?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></td>
                        <?php
                        foreach ($echantillons as $key => $value) {
                            echo "<td class='$i'>" . $this->Form->hidden('user_id', array('name' => "data[g][$i][Gadjet][user_id]", 'value' => $user['User']['id']));
                            echo $this->Form->hidden('echantillon_id', array('name' => "data[g][$i][Gadjet][echantillon_id]", 'value' => $key));
                            echo $this->Form->input('quantite', array('name' => "data[g][$i][Gadjet][quantite]", 'style' => "width: 60px", 'label' => false, 'div' => false, 'class' => "qte", "alt" => "$i")) . "</td>";
                            $i++;
                        } ?>
                    </tr>
            <?php endforeach;
            endforeach; ?>
        </table>
    </div>
    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'submit btn btn-primary btn-large', 'div' => array('class' => 'well text-center'))); ?>
</div>

<?php
// NOTE: bootstrap-daterangepicker, moment.js, and the reloaded jquery-2.2.3.min
// have been removed on purpose. Reloading jQuery here overwrote Metronic's own
// jQuery instance (same root cause as the other restyled views in this
// project), and the plugin's own CSS never matched this page's purple theme
// anyway. Replaced with the self-contained "lb-range" picker below, styled
// to match, with a small compatibility shim so the existing
// getSelectedRange()/apply.daterangepicker logic keeps working unmodified.
?>
<script>
    (function () {
        var MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        var WEEKDAYS = ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'];

        function pad2(n) { return (n < 10 ? '0' : '') + n; }
        function formatISO(d) { return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate()); }
        function sameDay(a, b) { return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function stripTime(d) { var c = new Date(d); c.setHours(0, 0, 0, 0); return c; }
        function momentLike(d) { return { format: function () { return formatISO(d); } }; }

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

        // Compatibility shim: expose the same shape existing code expects
        // ($(el).data('daterangepicker').startDate/endDate) and fire the
        // same 'apply.daterangepicker' event, via jQuery if present.
        LBRangePicker.prototype.applyCompat = function () {
            if (!this.start) return;
            var start = this.start;
            var end = this.end || this.start;
            if (window.jQuery) {
                var $input = window.jQuery(this.input);
                $input.data('daterangepicker', { startDate: momentLike(start), endDate: momentLike(end) });
                $input.trigger('apply.daterangepicker', [{ startDate: momentLike(start), endDate: momentLike(end) }]);
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

<script>
    // ---- existing logic, unchanged ----
    $(function() {

        // helper: get start & end from daterangepicker (now backed by the shim above)
        function getSelectedRange() {
            let drp = $('#reservationtime').data('daterangepicker');
            if (drp && drp.startDate && drp.endDate) {
                return {
                    start: drp.startDate.format('YYYY-MM-DD'),
                    end: drp.endDate.format('YYYY-MM-DD')
                };
            }
            return null;
        }

        // Append / update hidden inputs for one TD
        function setHiddenInputs($td, alt, range) {
            $td.find("input.date-debut, input.date-fin").remove();
            $td.append(
                `<input type="hidden" class="date-debut" 
                name="data[g][${alt}][Gadjet][date_debut]" 
                value="${range.start}">`
            );
            $td.append(
                `<input type="hidden" class="date-fin" 
                name="data[g][${alt}][Gadjet][date_fin]" 
                value="${range.end}">`
            );
        }

        // When qte changes
        $(document).on("change", ".qte", function() {
            let $qte = $(this);
            let alt = $qte.attr("alt");
            let $td = $qte.closest("td");
            let range = getSelectedRange();

            if (!range) return;

            $td.find("input.date-debut, input.date-fin").remove();

            $td.append(
                `<input type="hidden" class="date-debut" 
                name="data[g][${alt}][Gadjet][date_debut]" 
                value="${range.start}">`
            );
            $td.append(
                `<input type="hidden" class="date-fin" 
                name="data[g][${alt}][Gadjet][date_fin]" 
                value="${range.end}">`
            );

            // Optional: highlight qte to indicate dates are attached
            $qte.css("background-color", "#eef0ff");
        });


        $('#reservationtime').on('apply.daterangepicker', function() {
            let range = getSelectedRange();
            if (!range) return;

            $(".qte").each(function() {
                let $qte = $(this);
                let alt = $qte.attr("alt");
                let $td = $qte.closest("td");

                if ($.trim($qte.val()) !== "") {
                    setHiddenInputs($td, alt, range);
                }
            });
        });
    });

    function Validationqte() {
        $('.qte').filter(function() {
            return !this.value; // retourne vrai si la valeur est vide
        }).each(function() {
            $(this).parent().remove();
        });
    }
</script>
