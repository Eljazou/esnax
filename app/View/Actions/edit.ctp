<?php echo $this->Html->css('select2.min'); ?>
<!--
  NOTE ON SCRIPTS REMOVED FROM THIS VIEW (do not re-add):
  - jquery-1.12.4.js / jquery-ui.js / jquery-ui.css from code.jquery.com: jQuery is
    already loaded globally by Metronic's plugins.bundle.js, so this second copy was
    redundant (and risked the same window.$ overwrite issue fixed on the other pages).
    jQuery UI's datepicker is replaced below with the same self-contained calendar
    widget used on the "Visites Doubles" dashboard — it has zero CDN dependency, so a
    dead/blocked host can never break it again, and it already matches this theme's
    lavender palette.
  - The "Gamme" field (id="game_id", class "choix_multi") previously had no select2
    initializer anywhere in this view, so the browser rendered it as a raw, tall,
    always-expanded native multi-select instead of a collapsed searchable dropdown.
    Fixed below by loading select2 and initializing it in its OWN isolated
    $(function(){...}) block (see note further down for why it must stay isolated).
-->

<style type="text/css">
    /* Theme Base Definitions */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
        --shadow-sm: 0 4px 18px rgba(155, 144, 224, 0.06);
    }

    /* Core Layout Architecture */
    .custom-panel {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
        overflow: hidden;
    }
    .custom-panel-header {
        background: #ffffff;
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
    }
    .custom-panel-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
    }
    .custom-panel-body {
        padding: 28px;
    }

    /* Form Fields Architecture */
    .form-group-custom {
        margin-bottom: 20px;
    }
    .form-group-custom label {
        font-weight: 600;
        color: var(--theme-text-dark);
        font-size: 13.5px;
        margin-bottom: 8px;
        display: inline-block;
    }
    .form-control {
        height: 42px;
        border: 1px solid var(--theme-border);
        background-color: #ffffff;
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--theme-text-dark);
        box-shadow: none !important;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15) !important;
    }
    textarea.form-control {
        height: auto;
        min-height: 100px;
        padding: 12px;
    }
    select[multiple].form-control {
        height: auto;
        min-height: 120px;
        padding: 8px;
    }

    /* Select2 — themed to match the lavender palette (Gamme field) */
    .form-group-custom .select2-container .select2-selection{
        border-radius: var(--radius-sm) !important;
        border: 1px solid var(--theme-border) !important;
        min-height: 42px !important;
        box-shadow: none !important;
    }
    .form-group-custom .select2-container--default .select2-selection__rendered{
        line-height: 40px !important;
        padding-left: 12px !important;
        color: var(--theme-text-dark);
    }
    .form-group-custom .select2-container--default .select2-selection__arrow{
        height: 40px !important;
    }
    .form-group-custom .select2-container--default.select2-container--focus .select2-selection,
    .form-group-custom .select2-container--default.select2-container--open .select2-selection{
        border-color: var(--theme-primary) !important;
        box-shadow: 0 0 0 3px rgba(155, 144, 224, 0.15) !important;
    }
    .form-group-custom .select2-container--default .select2-selection__choice{
        background: var(--theme-primary-pale) !important;
        border: 1px solid var(--theme-primary-pale) !important;
        color: var(--theme-text-dark) !important;
        border-radius: 6px !important;
    }
    .form-group-custom .select2-container--default .select2-selection__choice__remove{
        color: var(--theme-primary-hover) !important;
    }
    .select2-dropdown{
        border-color: var(--theme-border) !important;
        border-radius: var(--radius-sm) !important;
        overflow: hidden;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background-color: var(--theme-primary) !important;
    }

    /* Compact Date Wrapper */
    .date-row {
        margin-left: -10px;
        margin-right: -10px;
        display: flex;
    }
    .date-col {
        padding-left: 10px;
        padding-right: 10px;
        flex: 1;
    }

    /* ---------- Themed calendar popup (ported from asm_visites_double.ctp) ---------- */
    .date-field-wrap{ position:relative; }
    .form-control.lb-date-input{
        padding-right:38px !important; cursor:pointer;
    }
    .form-control.lb-date-input.lb-date-open{
        border-color:var(--theme-primary) !important;
        box-shadow:0 0 0 3px var(--theme-primary-pale) !important;
    }
    .date-field-wrap .date-field-icon{
        position:absolute; right:12px; bottom:12px; color:var(--theme-primary-hover);
        pointer-events:none; font-size:14px;
    }

    .lb-cal-popup{
        position:absolute; z-index:9999; background:#fff; border:1px solid var(--theme-border);
        border-radius:var(--radius-lg); box-shadow:0 10px 34px rgba(155,144,224,0.25);
        padding:14px; width:270px; font-family:inherit; -webkit-user-select:none; user-select:none;
    }
    .lb-cal-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .lb-cal-title{ font-weight:700; color:var(--theme-text-dark); font-size:14.5px; text-transform:capitalize; }
    .lb-cal-nav{
        border:none; background:var(--theme-primary-light); color:var(--theme-primary-hover); width:28px; height:28px;
        border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center;
        line-height:1; padding:0;
    }
    .lb-cal-nav:hover{ background:var(--theme-primary-pale); }
    .lb-cal-weekdays{ display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .lb-cal-weekdays span{ font-size:11px; font-weight:700; color:var(--theme-primary-hover); text-transform:uppercase; }
    .lb-cal-grid{ display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .lb-cal-day{
        border:none; background:transparent; padding:8px 0; border-radius:var(--radius-sm); font-size:13px;
        color:var(--theme-text-dark); cursor:pointer;
    }
    .lb-cal-day:hover{ background:var(--theme-primary-pale); }
    .lb-cal-day.other-month{ color:var(--theme-text-muted); opacity:.5; }
    .lb-cal-day.today{ box-shadow:inset 0 0 0 1px var(--theme-primary-hover); }
    .lb-cal-day.selected{ background:var(--theme-primary) !important; color:#fff !important; font-weight:700; }
    .lb-cal-footer{ display:flex; justify-content:space-between; margin-top:10px; border-top:1px solid var(--theme-border); padding-top:10px; }
    .lb-cal-today-btn, .lb-cal-clear-btn{
        border:none; background:none; color:var(--theme-primary-hover); font-size:12.5px; font-weight:600; cursor:pointer;
        padding:5px 9px; border-radius:var(--radius-sm);
    }
    .lb-cal-today-btn:hover, .lb-cal-clear-btn:hover{ background:var(--theme-primary-light); }

    /* Button Layout */
    .btn-lavender {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 10px 32px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s ease;
        display: inline-block;
    }
    .btn-lavender:hover {
        background: var(--theme-primary-hover) !important;
    }
    .form-actions-well {
        background: var(--theme-primary-light);
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-top: 30px;
        text-align: center;
    }
</style>

<div class="custom-panel">
    <div class="custom-panel-header">
        <h3 class="custom-panel-title"><?php echo __('Editer l\'action'); ?></h3>
    </div>
    
    <div class="custom-panel-body">
        <div class="row">
            <div class="col-lg-7 col-md-9">
                
                <?php echo $this->Form->create('Action'); ?>
                
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'div' => 'form-group-custom')); ?>
                
                <!-- Date Boundaries Group Matrix -->
                <div class="date-row">
                    <div class="date-col">
                        <div class="form-group-custom">
                            <div class="date-field-wrap">
                                <?php echo $this->Form->input('date_debut', ['type' => 'text', 'class' => 'form-control lb-date-input', 'id' => 'datepicker', 'label' => "Date début", 'div' => false, 'autocomplete' => 'off']); ?>
                                <i class="fa fa-calendar date-field-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="date-col">
                        <div class="form-group-custom">
                            <div class="date-field-wrap">
                                <?php echo $this->Form->input('date_fin', ['type' => 'text', 'class' => 'form-control lb-date-input', 'id' => 'datepicker1', 'label' => "Date fin", 'div' => false, 'autocomplete' => 'off']); ?>
                                <i class="fa fa-calendar date-field-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Context Options Matrix -->
                <div class="form-group-custom">
                    <?php echo $this->Form->input('game_id', array('label' => 'Gamme', 'class' => 'form-control choix_multi', "multiple", "name" => "gamme[]")); ?>
                </div>
                
                <div class="form-group-custom">
                    <?php 
                    $option = array("F" => "F", "SF" => "SF");
                    echo $this->Form->input('nature', array('label' => 'Nature action', 'options' => $option, 'class' => 'form-control')); 
                    ?>
                </div>
                
                <div class="form-group-custom">
                    <?php echo $this->Form->input('name', array('label' => 'Action', 'class' => 'form-control')); ?>
                </div>
                
                <div class="form-group-custom">
                    <?php echo $this->Form->input('description', array('label' => 'Description', 'class' => 'form-control', 'type' => 'textarea')); ?>
                </div>
                
                <!-- Form Submission Container -->
                <div class="form-actions-well">
                    <?php echo $this->Form->submit('Envoyer', array('class' => 'btn btn-lavender')); ?>
                </div>
                
                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    /*
      IMPORTANT: select2 init is deliberately its OWN $(function(){...}) block,
      separate from the calendar widget script below. Keeping unrelated widget
      inits isolated means a failure in one (e.g. a future change to the calendar)
      can never silently prevent select2 from running on this field again.
    */
    $(function () {
        $('.choix_multi').select2({
            placeholder: 'Choisissez...',
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
    // ---------- Themed date pickers (self-contained, no external library) ----------
    // Ported from asm_visites_double.ctp — built from scratch so it never depends on
    // a CDN being reachable, and matches this page's lavender theme natively.
    (function() {
        var MONTH_NAMES = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        var WEEKDAYS = ['Lu','Ma','Me','Je','Ve','Sa','Di'];

        function pad2(n){ return (n < 10 ? '0' : '') + n; }

        function parseISO(val) {
            if (!val) return null;
            var parts = val.split('-');
            if (parts.length !== 3) return null;
            var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
            return isNaN(d.getTime()) ? null : d;
        }

        function formatISO(d) {
            return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
        }

        function sameDay(a, b) {
            return !!a && !!b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
        }

        function LBCalendar(input) {
            this.input = input;
            this.popup = null;
            this.selected = parseISO(input.value);
            this.viewDate = this.selected ? new Date(this.selected) : new Date();
            this._outsideHandler = null;
            this._reflowHandler = null;
            this.bind();
        }

        LBCalendar.instances = [];

        LBCalendar.closeAll = function(except) {
            LBCalendar.instances.forEach(function(inst) {
                if (inst !== except) inst.close();
            });
        };

        LBCalendar.prototype.bind = function() {
            var self = this;
            this.input.setAttribute('readonly', 'readonly');
            this.input.addEventListener('click', function(e) {
                e.stopPropagation();
                LBCalendar.closeAll(self);
                if (self.popup) { self.close(); } else { self.open(); }
            });
        };

        LBCalendar.prototype.open = function() {
            var self = this;
            this.popup = document.createElement('div');
            this.popup.className = 'lb-cal-popup';
            document.body.appendChild(this.popup);
            this.input.classList.add('lb-date-open');
            this.position();
            this.render();

            this._outsideHandler = function(e) {
                if (self.popup && !self.popup.contains(e.target) && e.target !== self.input) {
                    self.close();
                }
            };
            this._reflowHandler = function() { self.position(); };

            setTimeout(function() {
                document.addEventListener('click', self._outsideHandler);
                window.addEventListener('resize', self._reflowHandler);
                window.addEventListener('scroll', self._reflowHandler, true);
            }, 0);
        };

        LBCalendar.prototype.position = function() {
            if (!this.popup) return;
            var rect = this.input.getBoundingClientRect();
            this.popup.style.top = (window.scrollY + rect.bottom + 6) + 'px';
            this.popup.style.left = (window.scrollX + rect.left) + 'px';
        };

        LBCalendar.prototype.close = function() {
            if (this.popup) {
                this.popup.parentNode.removeChild(this.popup);
                this.popup = null;
            }
            this.input.classList.remove('lb-date-open');
            if (this._outsideHandler) {
                document.removeEventListener('click', this._outsideHandler);
                this._outsideHandler = null;
            }
            if (this._reflowHandler) {
                window.removeEventListener('resize', this._reflowHandler);
                window.removeEventListener('scroll', this._reflowHandler, true);
                this._reflowHandler = null;
            }
        };

        LBCalendar.prototype.render = function() {
            var self = this;
            var year = this.viewDate.getFullYear();
            var month = this.viewDate.getMonth();
            var today = new Date();
            today.setHours(0, 0, 0, 0);

            var html = '';
            html += '<div class="lb-cal-header">';
            html += '<button type="button" class="lb-cal-nav" data-nav="prev">&#8249;</button>';
            html += '<span class="lb-cal-title">' + MONTH_NAMES[month] + ' ' + year + '</span>';
            html += '<button type="button" class="lb-cal-nav" data-nav="next">&#8250;</button>';
            html += '</div>';
            html += '<div class="lb-cal-weekdays">';
            WEEKDAYS.forEach(function(w) { html += '<span>' + w + '</span>'; });
            html += '</div>';
            html += '<div class="lb-cal-grid">';

            var firstDay = new Date(year, month, 1);
            var startOffset = (firstDay.getDay() + 6) % 7; // Monday = 0
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var daysInPrevMonth = new Date(year, month, 0).getDate();
            var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

            for (var i = 0; i < totalCells; i++) {
                var dayNum, cellDate, otherMonth = false;
                if (i < startOffset) {
                    dayNum = daysInPrevMonth - startOffset + i + 1;
                    cellDate = new Date(year, month - 1, dayNum);
                    otherMonth = true;
                } else if (i >= startOffset + daysInMonth) {
                    dayNum = i - startOffset - daysInMonth + 1;
                    cellDate = new Date(year, month + 1, dayNum);
                    otherMonth = true;
                } else {
                    dayNum = i - startOffset + 1;
                    cellDate = new Date(year, month, dayNum);
                }

                var classes = ['lb-cal-day'];
                if (otherMonth) classes.push('other-month');
                if (sameDay(cellDate, self.selected)) classes.push('selected');
                if (sameDay(cellDate, today)) classes.push('today');

                html += '<button type="button" class="' + classes.join(' ') + '" data-date="' + formatISO(cellDate) + '">' + dayNum + '</button>';
            }

            html += '</div>';
            html += '<div class="lb-cal-footer">';
            html += '<button type="button" class="lb-cal-today-btn" data-action="today">Aujourd\'hui</button>';
            html += '<button type="button" class="lb-cal-clear-btn" data-action="clear">Effacer</button>';
            html += '</div>';

            this.popup.innerHTML = html;

            var navBtns = this.popup.querySelectorAll('[data-nav]');
            for (var n = 0; n < navBtns.length; n++) {
                navBtns[n].addEventListener('click', function(e) {
                    e.stopPropagation();
                    var dir = this.getAttribute('data-nav');
                    self.viewDate.setMonth(self.viewDate.getMonth() + (dir === 'next' ? 1 : -1));
                    self.render();
                    self.position();
                });
            }

            var dayBtns = this.popup.querySelectorAll('.lb-cal-day');
            for (var d = 0; d < dayBtns.length; d++) {
                dayBtns[d].addEventListener('click', function(e) {
                    e.stopPropagation();
                    var val = this.getAttribute('data-date');
                    self.selected = parseISO(val);
                    self.input.value = val;
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }

            var todayBtn = this.popup.querySelector('[data-action="today"]');
            if (todayBtn) {
                todayBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var t = new Date();
                    self.selected = t;
                    self.viewDate = new Date(t);
                    self.input.value = formatISO(t);
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }

            var clearBtn = this.popup.querySelector('[data-action="clear"]');
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    self.selected = null;
                    self.input.value = '';
                    self.input.dispatchEvent(new Event('change'));
                    self.close();
                });
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            ['datepicker', 'datepicker1'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        });

        // In case this script runs after DOMContentLoaded already fired (e.g. deferred include)
        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            ['datepicker', 'datepicker1'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el && !LBCalendar.instances.some(function(inst){ return inst.input === el; })) {
                    LBCalendar.instances.push(new LBCalendar(el));
                }
            });
        }
    })();
</script>
