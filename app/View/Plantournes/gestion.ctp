<?php echo $this->Html->css('daterangepicker'); ?>

<!-- ===== CONTAINER PRINCIPAL ===== -->
<div class="card card-custom shadow-sm mb-6">
    
    <!-- ===== EN-TÊTE DU DASHBOARD ===== -->
    <div class="card-header border-0 pt-6 pb-4">
        <div class="card-title align-items-center flex-row">
            <span class="symbol symbol-40 symbol-light-primary mr-3">
                <span class="symbol-label">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </span>
            <div>
                <h3 class="card-label font-weight-bolder text-dark font-size-h4 mb-0">Gestion du plan de tournée</h3>
                <span class="text-muted font-weight-bold font-size-sm">Planification et affectation des circuits par semaine</span>
            </div>
        </div>
    </div>

    <div class="card-body pt-0">
        
        <!-- ===== BARRE DE FILTRE DATE ===== -->
        <div class="filter-card p-4 mb-6 rounded-lg">
            <label class="font-weight-bolder text-dark font-size-sm mb-2 d-block">Plan de tournée d'une date précise :</label>
            <form action="/plantournes/gestion/<?php echo $user_id; ?>" method="get" id="dateform">
                <div class="input-group search-input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-right-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="#7239EA" stroke-width="2"/>
                                <path d="M12 6v6l4 2" stroke="#7239EA" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </div>
                    <input type="text" <?php if ($date_debut != '') echo 'value="' . $date_debut . ' +--+ ' . $date_fin . '"'; ?> class="form-control form-control-solid border-left-0" name="date" id="reservationtime" placeholder="Sélectionner une plage de dates">
                </div>
            </form>
        </div>

        <!-- ===== FORMULAIRE PLAN DE TOURNÉE ===== -->
        <?php echo $this->Form->create(('Plantourne'), array("class" => "w-100")); ?>
        <input type="hidden" name="data[Plantourne][0][user_id]" value="<?php echo $user_id; ?>">

        <?php
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        $now = strtotime($date_fin);
        $your_date = strtotime($date_debut);
        $datediff = $now - $your_date;
        $j = floor($datediff / (60 * 60 * 24 * 7));
        $week = date("W", strtotime($date_debut));
        $year = date("o", strtotime($date_debut));

        $date = getStartAndEndDate($week, $year);

        $week = date("W", strtotime($date_fin));
        $year = date("o", strtotime($date_fin));
        
        $datef = getStartAndEndDate($week, $year);
        ?>

        <div class="row">
            <?php
            for ($i = 0; $i <= $j; $i++) {
                $day = $i * 7;
                $semaine = date('Y-m-d', strtotime('next Monday', strtotime($date[0] . " $day day")));
                ?>
                <input type="hidden" name="data[Plantourne][<?php echo $i; ?>][date]" value="<?php echo $semaine; ?>">
                
                <!-- CARTE SEMAINE -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card week-card shadow-sm h-100">
                        <div class="week-card-header px-4 py-3">
                            <span class="font-weight-bolder text-dark font-size-sm">
                                <?php echo 'La semaine du ' . strftime("%A %d-%m-%Y", strtotime($semaine)); ?>
                            </span>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div class="form-group mb-3">
                                <label class="text-muted font-size-xs font-weight-bold mb-1">Liste associée :</label>
                                <select name="data[Plantourne][<?php echo $i; ?>][liste_id]" class="form-control custom-select-lavender" id="PlantourneListeId">
                                    <option value="0">Choisissez...</option>
                                    <?php
                                    $id = 0;
                                    foreach ($listes as $key => $value) {
                                        $selected = '';
                                        foreach ($plans as $plan) {
                                            if ($plan['Plantourne']['liste_id'] == $key && $plan['Plantourne']['date'] == $semaine) {
                                                $selected = 'selected';
                                                $id = $plan['Plantourne']['id'];
                                                break;
                                            }
                                        }
                                        echo "<option $selected value='$key'>$value</option>";
                                    }
                                    if ($id != 0)
                                        echo "<option value='-1'>-- Vider --</option>";
                                    ?>
                                </select>
                            </div>

                            <?php if ($id != 0 && $this->requestAction('/droits/getrole/Plantournes/retarder') == 1): ?>
                                <div class="dropdown mt-2">
                                    <button class="btn btn-sm btn-light-danger dropdown-toggle font-weight-bolder w-100 d-flex justify-content-between align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Retarder la semaine</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right w-100 shadow-sm border-0">
                                        <?php
                                        echo $this->Html->link('1 Semaine', array('action' => 'retarder', $id, 1, $date[0], $datef[0]), array('class' => 'dropdown-item font-size-sm'));
                                        echo $this->Html->link('2 Semaines', array('action' => 'retarder', $id, 2, $date[0], $datef[0]), array('class' => 'dropdown-item font-size-sm'));
                                        echo $this->Html->link('3 Semaines', array('action' => 'retarder', $id, 3, $date[0], $datef[0]), array('class' => 'dropdown-item font-size-sm'));
                                        echo $this->Html->link('4 Semaines', array('action' => 'retarder', $id, 4, $date[0], $datef[0]), array('class' => 'dropdown-item font-size-sm'));
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" name="data[Plantourne][<?php echo $i; ?>][id]" value="<?php echo $id; ?>">
                </div>
            <?php } ?>
        </div>

        <!-- ===== BARRE DE VALIDATION ===== -->
        <div class="card-footer d-flex justify-content-end bg-transparent border-0 px-0 pt-4 pb-2">
            <?php echo $this->Form->button(
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:6px; vertical-align:-2px;"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Valider le plan', 
                array(
                    'type' => 'submit',
                    'class' => 'btn btn-primary-lavender font-weight-bolder btn-md px-6',
                    'escape' => false
                )
            ); ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<style>
/* ===== METRONIC VIOLET DESIGN OVERRIDE ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.card.card-custom, .form-control, label, h3, span, button, a, select { font-family: 'Poppins', sans-serif !important; }

/* Wrapper global */
.card.card-custom {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 0.75rem !important;
    box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.03) !important;
}

.symbol.symbol-light-primary .symbol-label { 
    background-color: #F3EFFF !important; 
    color: #7239EA !important; 
}

/* Zone Filtre */
.filter-card {
    background-color: #F9F9FA;
    border: 1px solid #F1F1F4;
}

/* Inputs & Form Controls */
.form-control-solid {
    background-color: #ffffff !important;
    border: 1.5px solid #E4E6EF !important;
    color: #3F4254 !important;
    border-radius: 0.55rem !important;
    padding: 0.65rem 1rem !important;
    font-size: 0.92rem !important;
    transition: all 0.2s ease !important;
}
.form-control-solid:focus {
    border-color: #7239EA !important;
    box-shadow: 0 0 0 0.2rem rgba(114, 57, 234, 0.1) !important;
}

.custom-select-lavender {
    background-color: #F8F9FA;
    border: 1.5px solid #E4E6EF;
    color: #3F4254;
    border-radius: 0.55rem;
    padding: 0.45rem 0.8rem;
    font-size: 0.88rem;
    font-weight: 500;
    outline: none;
    transition: all 0.2s ease;
}
.custom-select-lavender:focus {
    border-color: #7239EA;
    background-color: #ffffff;
}

/* Cartes Semaines */
.week-card {
    border: 1px solid #F1F1F4 !important;
    border-radius: 0.65rem !important;
    transition: all 0.2s ease;
}
.week-card:hover {
    border-color: #E4E6EF !important;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.04) !important;
}
.week-card-header {
    background-color: #F3EFFF;
    border-bottom: 1px solid #EAE3FF;
    border-top-left-radius: 0.65rem;
    border-top-right-radius: 0.65rem;
    color: #7239EA;
}

/* Boutons */
.btn-primary-lavender { 
    background-color: #7239EA !important; 
    color: #ffffff !important; 
    border: none !important;
    border-radius: 0.55rem !important;
    padding: 0.65rem 1.5rem !important;
    font-size: 0.9rem !important;
    transition: all 0.2s ease !important;
    cursor: pointer;
}
.btn-primary-lavender:hover { 
    background-color: #5825cb !important; 
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(114, 57, 234, 0.25) !important;
}

.btn-light-danger {
    background-color: #FFE2E5 !important;
    color: #F64E60 !important;
    border: none !important;
    border-radius: 0.45rem !important;
    padding: 0.4rem 0.8rem !important;
    transition: all 0.2s ease;
}
.btn-light-danger:hover, .btn-light-danger:focus {
    background-color: #F64E60 !important;
    color: #ffffff !important;
}

.dropdown-menu {
    border-radius: 0.55rem;
    padding: 0.5rem 0;
}
.dropdown-item {
    padding: 0.5rem 1.2rem;
    color: #3F4254;
    transition: all 0.15s ease;
}
.dropdown-item:hover {
    background-color: #F3EFFF;
    color: #7239EA;
}

/* ===== Daterangepicker calendar popup ===== */
.daterangepicker {
    font-family: 'Poppins', sans-serif !important;
    border: none !important;
    border-radius: 0.75rem !important;
    box-shadow: 0px 8px 28px rgba(114, 57, 234, 0.18) !important;
    padding: 6px;
}
.daterangepicker:before,
.daterangepicker:after { display: none !important; }

.daterangepicker .calendar-table {
    border: none !important;
    background: #fff !important;
}
.daterangepicker td, .daterangepicker th { font-size: 12.5px; }

.daterangepicker th.month {
    color: #3F4254;
    font-weight: 700;
    font-size: 13.5px;
}

.daterangepicker th.prev,
.daterangepicker th.next {
    border-radius: 0.45rem !important;
}
.daterangepicker th.prev span,
.daterangepicker th.next span {
    border-color: #7239EA !important;
}
.daterangepicker th.prev:hover,
.daterangepicker th.next:hover {
    background: #F3EFFF !important;
}

.daterangepicker td.available:hover,
.daterangepicker th.available:hover {
    background: #F3EFFF !important;
    color: #7239EA !important;
}

.daterangepicker td.in-range {
    background: #F3EFFF !important;
    color: #3F4254 !important;
}

.daterangepicker td.active,
.daterangepicker td.active:hover {
    background: #7239EA !important;
    border-color: #7239EA !important;
    color: #fff !important;
}

.daterangepicker td.off,
.daterangepicker td.off.in-range,
.daterangepicker td.off.start-date,
.daterangepicker td.off.end-date {
    background: #fff !important;
    color: #D7D1F1 !important;
}

.daterangepicker select.monthselect,
.daterangepicker select.yearselect,
.daterangepicker select.hourselect,
.daterangepicker select.minuteselect {
    border: 1.5px solid #E4E6EF !important;
    border-radius: 0.45rem !important;
    padding: 3px 6px !important;
    color: #3F4254 !important;
    font-size: 12.5px !important;
}

.daterangepicker .drp-buttons {
    border-top: 1px solid #F1F1F4 !important;
    padding: 10px 10px 6px !important;
}

.daterangepicker .drp-selected {
    color: #A1A5B7 !important;
    font-size: 12.5px !important;
}

.daterangepicker .drp-buttons .btn {
    border-radius: 0.55rem !important;
    font-weight: 600 !important;
    font-size: 12.5px !important;
    padding: 7px 18px !important;
    border: none !important;
}

.daterangepicker .drp-buttons .cancelBtn {
    background: #F3EFFF !important;
    color: #7239EA !important;
}
.daterangepicker .drp-buttons .cancelBtn:hover {
    background: #EAE3FF !important;
}

.daterangepicker .drp-buttons .applyBtn {
    background: #7239EA !important;
    color: #fff !important;
    box-shadow: 0 4px 10px rgba(114, 57, 234, .28);
}
.daterangepicker .drp-buttons .applyBtn:hover {
    background: #5825cb !important;
}

.daterangepicker .ranges li.active {
    background: #7239EA !important;
    color: #fff !important;
}
.daterangepicker .ranges li:hover {
    background: #F3EFFF !important;
    color: #7239EA !important;
}
</style>

<?php
function getStartAndEndDate($week, $year)
{
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    $start = $dto->format('Y-n-j');

    $dto->modify('+6 days');
    $end = $dto->format('Y-n-j');

    return [$start, $end];
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php 
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>

<script>
    $(function () {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": "--",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Personnalisé",
                "daysOfWeek": ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                "monthNames": [
                    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function (e) {
                this.updateInputText();
            }
        });

        $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            var action = $('#dateform').attr('action');
            var date = action + "?date=" + startDate + "+--+" + endDate;
            $('#dateform').attr('action', date);
            $('#dateform').submit();
        });
    });
</script>
